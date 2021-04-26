function TemplateCreate() {
  const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";
  const validFileExtensions = ["pdf"];

  const maxRecipients = 10;
  let recipients = [];
  let templateId = undefined;
  let template = {};
  let files = [];

  const $form = $("#templateForm");
  const $docModal = $("#documentModal");
  const $formList = $("#setup-recipient-list");
  const $addRecipientButton = $("#add-recipient-button");

  async function createFilePreview(event, file) {
    const fileId = Date.now();
    const fileExtension = file.name.split(".").pop().toLowerCase();

    if (!validFileExtensions.includes(fileExtension)) {
      return;
    }

    let document = null;
    const documentUrl = URL.createObjectURL(file);

    try {
      document = await PDFJS.getDocument({ url: documentUrl });
    } catch (error) {
      alert(error);
      return;
    }

    const html = `
      <div class="esignBuilder__docPreview h-100" data-id="${fileId}">
        <canvas></canvas>
        <div class="esignBuilder__docInfo">
            <h5 class="esignBuilder__docTitle"></h5>
            <span class="esignBuilder__docPageCount"></span>
        </div>

        <div class="esignBuilder__uploadProgress" width="100%">
            <span></span>
        </div>

        <div class="esignBuilder__uploadProgressCheck">
            <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>Check</title>
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#28a745"></path>
                </g>
            </svg>
        </div>
      </div>
    `;

    const $docPreview = createElementFromHTML(html);
    $(".fileupload").append($docPreview);

    const $progress = $docPreview.find(".esignBuilder__uploadProgress");
    const $progressCheck = $docPreview.find(".esignBuilder__uploadProgressCheck"); // prettier-ignore

    const documentPage = await document.getPage(1);

    const $canvas = $docPreview.find("canvas").get(0);
    const $docTitle = $docPreview.find(".esignBuilder__docTitle");
    const $docPageCount = $docPreview.find(".esignBuilder__docPageCount");
    const $docModalTitle = $docModal.find(".modal-title");
    const context = $canvas.getContext("2d");

    $docPreview.removeClass("d-none");
    context.clearRect(0, 0, $canvas.width, $canvas.height);
    $docPreview.removeClass("esignBuilder__docPreview--completed");
    $progress.removeClass("esignBuilder__uploadProgress--completed");
    $progressCheck.removeClass("esignBuilder__uploadProgressCheck--completed");

    await sleep(1000);

    $docTitle.text(file.name);
    $docModalTitle.text(file.name);
    $docPageCount.text(`${document.numPages} page`);

    const scaleRequired = $canvas.width / documentPage.getViewport(1).width;
    const viewport = documentPage.getViewport(scaleRequired);
    const canvasContext = {
      viewport,
      canvasContext: context,
    };

    await documentPage.render(canvasContext);

    $docPreview.addClass("esignBuilder__docPreview--completed");
    $progress.addClass("esignBuilder__uploadProgress--completed");

    await sleep(500);

    $progress.removeClass("esignBuilder__uploadProgress--completed");
    $progressCheck.addClass("esignBuilder__uploadProgressCheck--completed");

    files.push({ file, documentUrl, id: fileId });
    $docPreview.on("click", showDocument);

    const $target = $(event.target);
    $target.val("");
    $target.removeAttr("required");

    const $subject = $form.find("#subject");
    const filenames = files.map(({ file }) => file.name);
    $subject.val(`${$subject.prop("placeholder")} ${filenames.join(", ")}`);
  }

  async function onChangeFile(event) {
    const { files } = event.target;
    const promises = [...files].map((file) => createFilePreview(event, file));
    await Promise.all(promises);
  }

  function prepareForm() {
    const dateNow = moment().format("MM/DD/YYYY");
    const timeNow = moment().format("hh:mm:ss A");

    $form.find("#name").attr("placeholder", `Untitled ${dateNow} | ${timeNow}`);

    if (templateId) {
      $("#pageTitle").text(template.name);
      $("#templateInfo").hide();
      $("#templateDocument").hide();
      $addRecipientButton.hide();
    }
  }

  async function showDocument(event) {
    const $parent = $(event.target).closest(".esignBuilder__docPreview");
    const fileId = $parent.attr("data-id");
    const { documentUrl } = files.find(({ id }) => id == fileId);

    $modalBody = $docModal.find(".modal-body");
    $modalBody.empty();

    const document = await PDFJS.getDocument({ url: documentUrl });
    for (index = 1; index <= document.numPages; index++) {
      const canvas = window.document.createElement("canvas");
      $modalBody.append(canvas);

      const documentPage = await document.getPage(index);
      const viewport = documentPage.getViewport(1);
      canvas.height = viewport.height;
      canvas.width = viewport.width;

      documentPage.render({
        viewport,
        canvasContext: canvas.getContext("2d"),
      });
    }

    $docModal.modal("show");
  }

  function attachEventHandlers({ templateId: templateIdParam = null }) {
    $form.on("submit", async function (event) {
      event.preventDefault();

      const $this = $(this);
      const $name = $this.find("#name");
      const $description = $this.find("#description");
      const $file = $this.find("#docFile");
      const $subject = $this.find("#subject");
      const $message = $this.find("#message");

      if (templateIdParam) {
        $(this).attr("disabled", true);
        $(this).find(".spinner-border").removeClass("d-none");

        const payload = {
          recipients: recipients.map((r) => r.getData()),
          subject: $subject.val(),
          message: $message.val(),
        };

        const endpoint = `${prefixURL}/DocuSign/apiSendTemplate/${templateIdParam}`;
        const response = await fetch(endpoint, {
          method: "POST",
          body: JSON.stringify(payload),
          headers: {
            accepts: "application/json",
            "content-type": "application/json",
          },
        });

        const data = await response.json();
        window.location = `${prefixURL}/DocuSign/manage?view=sent`;
        return;
      }

      const payload = {
        name: $name.val() || $name.prop("placeholder"),
        description: $description.val(),
        // file: $file.get(0).files[0],
        subject: $subject.val(),
        message: $message.val(),
        recipients: JSON.stringify(recipients.map((r) => r.getData())), // :v
      };

      const formData = new FormData();
      for (const key in payload) {
        formData.append(key, payload[key]);
      }

      files.forEach(({ file }) => {
        formData.append("files[]", file);
      });

      $(this).attr("disabled", true);
      $(this).find(".spinner-border").removeClass("d-none");

      const response = await fetch(`${prefixURL}/DocuSign/apiStoreTemplate`, {
        method: "POST",
        body: formData,
      });

      const { data } = await response.json();
      const { id: templateId } = data;

      $(this).attr("disabled", false);
      $(this).find(".spinner-border").addClass("d-none");

      window.location = `${prefixURL}/esign/Files?template_id=${templateId}&next_step=3`;
    });

    $form.find("#docFile").on("change", onChangeFile);
    // $docPreview.on("click", showDocument);

    $addRecipientButton.on("click", () => addRecipient());
  }

  function removeRecipient(id) {
    recipients = recipients.filter((recipient) => {
      return recipient.getData().id !== id;
    });

    renderRecipientsForm();
    if (recipients.length <= maxRecipients) {
      $addRecipientButton.show();
    }
  }

  function addRecipient(data = {}) {
    const colors = [
      "#ffd65b",
      "#acdce6",
      "#c0a5cf",
      "#97c9bf",
      "#f7b994",
      "#c3d5e6",
      "#cfdb7f",
      "#ff9980",
      "#e6c6e6",
      "#ffb3c6",
    ];

    if ($.isEmptyObject(data)) {
      data.id = new Date().getTime();
      data.role_name = "";
      data.name = "";
      data.email = "";
      data.role = "Needs to Sign";

      const takenColors = recipients.map((recipient) => {
        return recipient.getData().color;
      });

      for (let index = 0; index < colors.length; index++) {
        const color = colors[index];
        if (!takenColors.includes(color)) {
          data.color = color;
          break;
        }
      }
    }

    const { isPreparingTemplate = false } = data;
    const newRecipient = new Recipient({
      data,
      onRemove: removeRecipient,
      isPreparingTemplate,
    });

    recipients = [...recipients, newRecipient];
    renderRecipientsForm();

    if (recipients.length >= maxRecipients) {
      $addRecipientButton.hide();
    }
  }

  function renderRecipientsForm() {
    const $recipientForms = recipients.map((recipient) => {
      return recipient.createForm();
    });

    $formList.empty();
    $formList.append($recipientForms);
  }

  async function fetchTemplate() {
    const endpoint = `${prefixURL}/DocuSign/apiTemplate/${templateId}`;
    const response = await fetch(endpoint);
    const { data } = await response.json();
    template = data;
  }

  async function fetchTemplateFile() {
    const endpoint = `${prefixURL}/DocuSign/apiTemplateFile/${templateId}`;
    const response = await fetch(endpoint);
    const { data } = await response.json();
    template.file = data;
  }

  async function fetchTemplateRecipients() {
    const endpoint = `${prefixURL}/DocuSign/apiTemplateRecipients/${templateId}`;
    const response = await fetch(endpoint);
    const { data } = await response.json();
    template.recipients = data;
  }

  async function setFormValues({ isPreparingTemplate = false }) {
    await Promise.all([
      fetchTemplate(),
      fetchTemplateFile(),
      fetchTemplateRecipients(),
    ]);

    const { name, description, subject, message, file, recipients } = template;
    const { path: filePath, name: fileName } = file;

    const fileResponse = await fetch(`${prefixURL}${filePath}`);
    const blob = await fileResponse.blob();
    const templateFile = new File([blob], fileName);

    const $name = $form.find("#name");
    const $description = $form.find("#description");
    const $file = $form.find("#docFile");
    const $subject = $form.find("#subject");
    const $message = $form.find("#message");

    $name.val(name);
    $description.val(description);
    $subject.val(subject);
    $message.val(message);
    $file.removeAttr("required");

    const fakeEvent = { target: { files: [templateFile] } };
    await onChangeFile(fakeEvent);

    recipients.forEach((recipient) =>
      addRecipient({
        ...recipient,
        isPreparingTemplate,
      })
    );

    $form.find("[type=submit] .text").text("Send");
  }

  async function init() {
    const urlParams = new URLSearchParams(window.location.search);
    templateId = urlParams.get("id");
    const isPreparingTemplate = Boolean(templateId);

    if (templateId) {
      await setFormValues({ isPreparingTemplate });
    } else {
      addRecipient();
    }

    prepareForm();
    attachEventHandlers({ templateId });
    $(".card--loading").removeClass("card--loading");
  }

  return { init };
}

function Recipient({
  data: dataParam,
  onRemove: onRemoveParam,
  isPreparingTemplate = false,
}) {
  let data = dataParam;

  function onChange(event) {
    const { name, value } = event.target;
    data = { ...data, [name]: value };

    if (name === "name") {
      validateName($(event.target));
    }

    if (name === "email") {
      validateEmail($(event.target));
    }
  }

  function validateEmail($target) {
    const value = $target.val();
    if (value.length === 0) {
      return false;
    }

    const isValid = isValidEmail(value);
    addValidationClassName(isValid, $target);
  }

  function validateName($target) {
    const value = $target.val();
    if (value.length === 0) {
      return false;
    }

    const isValid = isValidName(value.length !== 0);
    addValidationClassName(isValid, $target);
  }

  function addValidationClassName(isValid, $target) {
    if (isValid) {
      $target.addClass("is-valid");
      $target.removeClass("is-invalid");
      return;
    }

    $target.addClass("is-invalid");
    $target.removeClass("is-valid");
  }

  function onRemove(event) {
    event.preventDefault();
    if ($(".recipientForm").length > 1) {
      onRemoveParam(data.id);
    }
  }

  function onChangeRole(event) {
    event.preventDefault();

    $target = $(event.target);
    $parent = $target.closest(".dropdown");

    data.role = $target.text().trim();
    $parent.find("button.dropdown-toggle").html($target.html());
  }

  function createForm() {
    const roles = [
      {
        icon: "fa-pencil",
        value: "Needs to Sign",
      },
      {
        icon: "fa-clone",
        value: "Receives a copy",
      },
    ];

    const { name, email, role_name = "" } = data;
    const role = roles.find(({ value }) => value === data.role);
    const requireFields = isPreparingTemplate;

    const html = `
      <div class="recipientForm__container">
        <div class="form-group recipientForm">
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                <label>Role</label>
                <input
                  type="text"
                  data-key="role_name"
                  name="role_name"
                  value="${role_name}"
                  class="form-control"
                  required
                >
              </div>

              <div class="form-group">
                <label>Name</label>
                <input
                  type="text"
                  data-key="name"
                  name="name"
                  value="${name}"
                  class="form-control"
                  ${requireFields ? "required" : ""}
                >
              </div>

              <div class="form-group">
                <label>Email</label>
                <input
                  type="email"
                  data-key="email"
                  name="email"
                  value="${email}"
                  class="form-control"
                  ${requireFields ? "required" : ""}
                >
              </div>
            </div>

            <div>
              <div class="col-6 col-md-4">
                  <div class="dropdown" style="position: relative; top: 29px;" data-key="role">
                    <button
                      class="btn btn-outline-secondary dropdown-toggle"
                      type="button"
                      id="dropdownMenuButton"
                      data-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                      tabindex="-1"
                    >
                      <i class="fa ${role.icon}"></i>
                      ${role.value}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start">
                      ${roles
                        .map(
                          (currRole) =>
                            `<li>
                              <a href="#">
                                <i class="fa ${currRole.icon}"></i>
                                ${currRole.value}
                              </a>
                            </li>`
                        )
                        .join("")}
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <a class="delete-icon" href="#">
          <i class="fa fa-times-circle-o"></i>
        </a>
      </div>
    `;

    const $element = createElementFromHTML(html);
    const $roleInput = $element.find("[data-key=role_name]");
    const $nameInput = $element.find("[data-key=name]");
    const $emailInput = $element.find("[data-key=email]");
    const $removeButton = $element.find(".delete-icon");
    const $roleDropdownItem = $element.find("[data-key=role] li");

    validateName($nameInput);
    validateEmail($emailInput);

    $roleInput.on("keyup", onChange);
    $nameInput.on("keyup", onChange);
    $emailInput.on("keyup", onChange);
    $removeButton.on("click", onRemove);
    $roleDropdownItem.on("click", onChangeRole);

    return $element;
  }

  function getData() {
    return data;
  }

  return { getData, createForm };
}

$(document).ready(function () {
  new TemplateCreate().init();
});

// https://stackoverflow.com/a/47480429/8062659
const sleep = (ms) => new Promise((res) => setTimeout(res, ms));

// https://stackoverflow.com/a/46181/8062659
function isValidEmail(string) {
  const regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return regex.test(String(string).toLowerCase());
}

function isValidName(string) {
  return string && 0 !== string.length;
}

// https://stackoverflow.com/a/494348/8062659
function createElementFromHTML(htmlString) {
  var div = document.createElement("div");
  div.innerHTML = htmlString.trim();
  return $(div.firstChild);
}
