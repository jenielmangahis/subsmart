function TemplateCreate() {
  const PDFJS = pdfjsLib;

  const prefixURL = "";
  const validFileExtensions = ["pdf"];

  const maxRecipients = 10;
  let recipients = [];
  let templateId = undefined;
  let template = {};
  let files = [];
  let workorder = undefined;
  let job = undefined;
  let customer = undefined;

  const $form = $("#templateForm");
  const $docModal = $("#documentModal");
  const $formList = $("#setup-recipient-list");
  const $addRecipientButton = $("#add-recipient-button");
  const $sortable = $("#sortable");

  const ACTIONS = {
    CREATE: "CREATE",
    UPDATE: "UPDATE",
    PREPARE: "PREPARE",
  };

  async function createFilePreview(event, file) {
    // await sleep(1000);
    const fileId = Date.now();
    const fileExtension = file.name.split(".").pop().toLowerCase();

    if (!validFileExtensions.includes(fileExtension)) {
      return;
    }

    let document = null;
    const documentUrl = URL.createObjectURL(file);

    try {
      document = await PDFJS.getDocument({ url: documentUrl });
      document = await document.promise;
    } catch (error) {
      alert(error);
      return;
    }

    const html = `
      <div class="esignBuilder__docPreview h-100" data-id="${fileId}">
        <div class="esignBuilder__docPreviewHover"></div>

        <canvas></canvas>
        <div class="esignBuilder__docInfo">
            <div class="esignBuilder__docInfoText">
              <h5 class="esignBuilder__docTitle"></h5>
              <span class="esignBuilder__docPageCount"></span>
            </div>

            <div class="dropdown">
              <button
                class="btn dropdown-toggle esignBuilder__docInfoActions"
                type="button"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i class="fa fa-ellipsis-v"></i>
              </button>

              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" data-action="preview" href="#">Preview</a>
                <a class="dropdown-item" data-action="delete" href="#">Delete</a>
              </div>
            </div>
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

    $docPreview.removeClass("d-none");
    $docPreview.removeClass("esignBuilder__docPreview--completed");
    $progress.removeClass("esignBuilder__uploadProgress--completed");
    $progressCheck.removeClass("esignBuilder__uploadProgressCheck--completed");

    // await sleep(1000);

    $docTitle.text(file.name);
    $docModalTitle.text(file.name);
    $docPageCount.text(`${document.numPages} page`);

    const viewport = documentPage.getViewport({ scale: 1 });
    $canvas.height = viewport.height;
    $canvas.width = viewport.width;

    await documentPage.render({
      viewport,
      canvasContext: $canvas.getContext("2d"),
    });

    $docPreview.addClass("esignBuilder__docPreview--completed");
    $progress.addClass("esignBuilder__uploadProgress--completed");

    // await sleep(500);

    $progress.removeClass("esignBuilder__uploadProgress--completed");
    $progressCheck.addClass("esignBuilder__uploadProgressCheck--completed");

    files.push({ file, documentUrl, id: fileId });
    // $docPreview
    //   .find(".esignBuilder__docPreviewHover")
    //   .on("click", showDocument);

    const actions = {
      preview: showDocument,
      delete: function (event) {
        const _file = files.find((f) => f.name == file.name);

        if (!_file || !_file.total_fields) {
          actions._delete(event);
          return;
        }

        const $modal = $("#deleteDocument");
        const $buttonPrimary = $modal.find(".nsm-button.primary");

        $modal.find(".total-fields").html(_file.total_fields);
        $modal.modal("show");

        $buttonPrimary.off();
        $buttonPrimary.on("click", () => {
          actions._delete(event);
          $modal.modal("hide");
        });
      },
      _delete: function (event) {
        files = files.filter((f) => f.id != fileId);
        const $parent = $(event.target).closest(".esignBuilder__docPreview");
        $parent.remove();
        setSubjectFromFiles();
      },
    };

    $docPreview.find(".dropdown-item").on("click", function (event) {
      event.preventDefault();
      const action = $(this).attr("data-action");
      actions[action](event);
    });

    const $target = $(event.target);
    $target.val("");
    $target.removeAttr("required");

    setSubjectFromFiles();
  }

  function setSubjectFromFiles() {
    if (template.subject) {
      return;
    }

    const $subject = $form.find("#subject");
    const filenames = files.map(({ file }) => file.name);

    let value = "";
    if (filenames.length) {
      value = `${$subject.prop("placeholder")} ${filenames.join(", ")}`;
    }

    $subject.val(value);
  }

  async function onChangeFile(event) {
    const { files: eventFiles } = event.target;

    if (files && files.length) {
      for (let index = 0; index < eventFiles.length; index++) {
        const file = eventFiles[index];
        if (files.find((f) => f.file.name === file.name)) {
          alert(`File name already exists: ${file.name}`);
          return;
        }
      }
    }

    // We could use Promise.all, but that wont display
    // previews in order, but a lot faster.
    for (let index = 0; index < eventFiles.length; index++) {
      const file = eventFiles[index];
      await createFilePreview(event, file);
    }
  }

  function prepareForm({ action }) {
    const dateNow = moment().format("MM/DD/YYYY");
    const timeNow = moment().format("hh:mm A");

    $form.find("#name").attr("placeholder", `Untitled ${dateNow} | ${timeNow}`);

    if (action === ACTIONS.CREATE) {
      return;
    }

    $("#pageTitle").text(template.name);
    const $submitBtn = $form.find("[type=submit]");
    const $submitBtnText = $submitBtn.find(".text");

    if (action === ACTIONS.PREPARE) {
      $("#templateInfo").hide();
      $("#templateDocument").hide();
      $("#add-recipient-button").hide();
      $submitBtnText.text("Send");
      return;
    }

    const $saveAndClose = $("#saveandclose");
    const $discardChanges = $("#discardChanges");

    $saveAndClose.removeClass("d-none");
    $saveAndClose.addClass("d-flex");
    $discardChanges.removeClass("d-none");
    $submitBtnText.text("Next");
  }

  async function showDocument(event) {
    const $parent = $(event.target).closest(".esignBuilder__docPreview");
    const fileId = $parent.attr("data-id");
    const { documentUrl } = files.find(({ id }) => id == fileId);

    $modalBody = $docModal.find(".modal-body");
    $modalBody.empty();

    let document = await PDFJS.getDocument({ url: documentUrl });
    document = await document.promise;

    for (index = 1; index <= document.numPages; index++) {
      const canvas = window.document.createElement("canvas");
      $modalBody.append(canvas);

      const documentPage = await document.getPage(index);
      const viewport = documentPage.getViewport({ scale: 1.3 });
      canvas.height = viewport.height;
      canvas.width = viewport.width;

      await documentPage.render({
        viewport,
        canvasContext: canvas.getContext("2d"),
      });
    }

    $docModal.modal("show");
  }

  function attachEventHandlers({ templateId: templateIdParam = null, action }) {
    $form.find("#docFile").on("change", onChangeFile);
    // $docPreview.on("click", showDocument);

    $addRecipientButton.on("click", () => addRecipient());

    $form.on("submit", (e) => sendForm(e, templateIdParam, action));
    $("#saveandclose").on("click", (e) => sendForm(e, templateIdParam, action));
  }

  async function sendForm(event, templateIdParam, action, redirect = true) {
    event.preventDefault();

    const $name = $form.find("#name");
    const $description = $form.find("#description");
    const $subject = $form.find("#subject");
    const $message = $form.find("#message");

    if (!templateIdParam && action !== ACTIONS.CREATE) {
      return;
    }

    if (action === ACTIONS.PREPARE) {
      const $button = $form.find(".nsm-button.primary");
      $button.attr("disabled", true);
      $button.find(".spinner-border").removeClass("d-none");

      const payload = {
        recipients: recipients.map((r) => r.getData()),
        subject: $subject.val(),
        message: $message.val(),
        workorder_id: workorder ? workorder.id : null,
        job_id: job ? job.id : null,
      };

      if (job && !payload.job_id) {
        const urlParams = new URLSearchParams(window.location.search);
        payload.job_id = urlParams.get("job_id");
      }

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
      let nextUrl = `${prefixURL}/eSign_v2/manage?view=sent`;
      if (data.hash) {
        nextUrl = `${prefixURL}/eSign/signing?hash=${data.hash}`;
      }

      if (redirect) {
        window.location = nextUrl;
      } else {
        return data;
      }
      return;
    }

    const $items = $(".esignBuilder__docPreview");
    let documentSequence = $items.map((_, item) => {
      const file = files.find((f) => f.id == $(item).attr("data-id"));
      return file === undefined ? null : file.file.name;
    });

    documentSequence = [...documentSequence].filter(Boolean);
    documentSequence = JSON.stringify({ sequence: documentSequence });

    const payload = {
      name: $name.val() || $name.prop("placeholder"),
      description: $description.val(),
      subject: $subject.val(),
      message: $message.val(),
      recipients: JSON.stringify(recipients.map((r) => r.getData())), // :v
      id: templateIdParam,
      document_sequence: documentSequence,
    };

    const formData = new FormData();
    for (const key in payload) {
      formData.append(key, payload[key]);
    }

    files.forEach(({ file }) => {
      formData.append("files[]", file);
    });

    let $button = $(event.currentTarget);
    if (event.type.toLowerCase() === "submit") {
      $button = $form.find(".enter-fields");
    }

    $button.attr("disabled", true);
    $button.find(".spinner-border").removeClass("d-none");

    const response = await fetch(`${prefixURL}/DocuSign/apiStoreTemplate`, {
      method: "POST",
      body: formData,
    });

    const { data } = await response.json();
    const { id: templateId } = data;

    $button.attr("disabled", false);
    $button.find(".spinner-border").addClass("d-none");

    let nextUrl = `${prefixURL}/vault_v2/mylibrary`;
    if ($button.hasClass("enter-fields")) {
      nextUrl = `${prefixURL}/esign_v2/Files?template_id=${templateId}&next_step=3`;
    }

    if (redirect) {
      window.location = nextUrl;
    } else {
      return data;
    }
  }

  function removeRecipient(id) {
    let recipient = recipients.find((r) => r.getData().id == id);
    recipient = recipient.getData();

    if (!recipient.total_fields) {
      _removeRecipient(id);
      return;
    }

    const $modal = $("#deleteRecipient");
    const $buttonPrimary = $modal.find(".nsm-button.primary");

    $modal.find(".total-fields").html(recipient.total_fields);
    $modal.modal("show");

    $buttonPrimary.off();
    $buttonPrimary.on("click", () => {
      _removeRecipient(id);
      $modal.modal("hide");
    });
  }

  function _removeRecipient(id) {
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
      data.id = `temp_${new Date().getTime()}`;
      data.role_name = "";
      data.name = "";
      data.email = "";
      data.role = "Signs in Person";

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
    template.files = data;
  }

  async function fetchTemplateRecipients() {
    const endpoint = `${prefixURL}/DocuSign/apiTemplateRecipients/${templateId}`;
    const response = await fetch(endpoint);
    const { data } = await response.json();
    template.recipients = data;
  }

  async function setFormValues({ isPreparingTemplate = false, action }) {
    await fetchTemplate();
    await fetchTemplateRecipients();

    if (action === ACTIONS.UPDATE) {
      await fetchTemplateFile();
    }

    const {
      name,
      description,
      subject,
      message,
      recipients,
      files = [],
    } = template;

    let templateFiles = files.map(async (file) => {
      const { path: filePath, name: fileName } = file;

      const fileResponse = await fetch(`${prefixURL}${filePath}`);
      const blob = await fileResponse.blob();
      return new File([blob], fileName);
    });

    templateFiles = await Promise.all(templateFiles);

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

    const fakeEvent = { target: { files: templateFiles } };
    await onChangeFile(fakeEvent);

    let _recipients = recipients.map((r) => {
      if (!workorder && !job) return r;
      if (r.name || r.email) return r;
      if (!["CLIENT", "CUSTOMER"].includes(r.role_name.toUpperCase())) {
        return r;
      }

      // for admin, get workorder or job admin
      if (r.role_name.toUpperCase() === "ADMIN") {
        const { admin } = workorder || job;

        if (admin) {
          const { first_name, last_name, email } = admin;
          if (email) {
            r.email = email;
          }

          if (first_name && last_name) {
            r.name = `${first_name} ${last_name}`;
          }
        }

        return r;
      }

      if (!["CLIENT", "CUSTOMER"].includes(r.role_name.toUpperCase())) {
        const { first_name, last_name, email } = workorder || job;
        if (email) {
          r.email = email;
        }

        if (first_name && last_name) {
          r.name = `${first_name} ${last_name}`;
        }

        return r;
      }

      return r;
    });

    // force autopopulate customer/client if customer is set
    if (customer && "first_name" in customer && "last_name" in customer) {
      _recipients = _recipients.map((r) => {
        if (!["CLIENT", "CUSTOMER"].includes(r.role_name.toUpperCase())) {
          return r;
        }

        const { first_name, last_name, email } = customer;
        if (email) {
          r.email = email;
        }

        if (first_name && last_name) {
          r.name = `${first_name} ${last_name}`;
        }

        return r;
      });
    }

    if (!job || !job.id) {
      return _recipients.forEach((recipient) =>
        addRecipient({
          ...recipient,
          isPreparingTemplate,
        })
      );
    }

    // For jobs that are using the Master template.
    _recipients.forEach((recipient) => {
      let { role_name: role } = recipient;
      role = role.toUpperCase();

      if (role === "ESA REP") {
        if (job.employee) {
          if (job.employee.email) {
            recipient.email = job.employee.email;
          }

          if (job.employee.FName && job.employee.LName) {
            recipient.name = `${job.employee.FName} ${job.employee.LName}`;
          }
        }
      }

      if (role === "CLIENT" || role === "CUSTOMER") {
        if (job.email) {
          recipient.email = job.email;
        }

        if (job.first_name && job.last_name) {
          recipient.name = `${job.first_name} ${job.last_name}`;
        }
      }

      if (role === "ADMIN") {
        if (job.admin) {
          if (job.admin.email) {
            recipient.email = job.admin.email;
          }

          if (job.admin.FName && job.admin.LName) {
            recipient.name = `${job.admin.FName} ${job.admin.LName}`;
          }
        }
      }
    });

    if (_recipients.every((recipient) => !recipient.email && !recipient.name)) {
      // Nothing is set, or this job is not using the Master template,
      // we'll set the first recipient as the job customer.
      _recipients.forEach((recipient, index) => {
        if (index === 0) {
          recipient.email = job.email;
          recipient.name = `${job.first_name} ${job.last_name}`;
        }
      });
    }

    _recipients.forEach((recipient) => {
      addRecipient({ ...recipient, isPreparingTemplate });
    });
  }

  async function getWorkorderCustomer(workorderId) {
    const endpoint = `${prefixURL}/DocuSign/getWorkorderCustomer/${workorderId}`;
    const response = await fetch(endpoint);
    const { data } = await response.json();
    workorder = data;
  }

  async function getJobCustomer(customerId) {
    const endpoint = `${prefixURL}/DocuSign/getJobCustomer/${customerId}`;
    const response = await fetch(endpoint);
    const { data } = await response.json();
    job = data;
  }

  async function getCustomer(customerId) {
    const endpoint = `${prefixURL}/DocuSign/getCustomer/${customerId}`;
    const response = await fetch(endpoint);
    const { data } = await response.json();
    customer = data;
  }

  async function init() {
    const urlParams = new URLSearchParams(window.location.search);
    templateId = urlParams.get("id");

    const { pathname } = window.location;
    let action = ACTIONS.CREATE;

    if (/edit/i.test(pathname)) {
      action = ACTIONS.UPDATE;
      $(".nsm-nav .nsm-page-title h4").text("Edit Template");
      $(".active-header-nav").text("Edit Template");
    }

    if (/prepare/i.test(pathname)) {
      action = ACTIONS.PREPARE;
      $(".nsm-nav .nsm-page-title h4").text("Prepare Template");
      $(".active-header-nav").text("Prepare Template");
    }

    const isPreparingTemplate = action === ACTIONS.PREPARE;

    if (templateId) {
      const workorderId = urlParams.get("workorder_id");
      const jobId = urlParams.get("job_id");
      const customerId = urlParams.get("customer_id");

      if (workorderId) {
        await getWorkorderCustomer(workorderId);
      }

      if (jobId) {
        await getJobCustomer(jobId);
      }

      if (customerId) {
        await getCustomer(customerId);
      }

      await setFormValues({ isPreparingTemplate, action });
    } else {
      addRecipient();
    }

    prepareForm({ action });
    attachEventHandlers({ templateId, action });
    $(".card--loading").removeClass("card--loading");
    $(".loader").addClass("d-none");

    $sortable.disableSelection();
    $sortable.sortable({
      placeholder: "ui-state-highlight",
      items: "> .esignBuilder__docPreview",
      cursor: "move",
    });
  }

  function submitForm(templateIdParam) {
    const fakeEvent = {
      preventDefault: () => {},
      currentTarget: null,
      type: "submit",
    };

    const action =
      templateIdParam || templateId ? ACTIONS.UPDATE : ACTIONS.CREATE;
    return sendForm(fakeEvent, templateIdParam, action, false);
  }

  return { init, submitForm };
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
    $parent.find("button.nsm-button").html($target.html());
  }

  function createForm() {
    const roles = [
      {
        icon: "fa-pencil",
        value: "Needs to Sign",
      },
      {
        icon: "fa-user",
        value: "Signs in Person",
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
        <div class="form-group mb-3 recipientForm">
          <div class="row">
            <div class="col-md-8">
              <div class="form-group mb-2">
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

              <div class="form-group mb-2">
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

              <div class="form-group mb-2">
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

            <div class="col-6 col-md-4">
                <div class="dropdown" style="position: relative; top: 20px;" data-key="role">
                  <button
                    class="nsm-button"
                    type="button"
                    id="dropdownMenuButton"
                    data-bs-toggle="dropdown"
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
                            <a class="dropdown-item" href="#">
                                <i class="fa ${currRole.icon}"></i>&nbsp;${currRole.value}
                              </a>
                           </li>`
                      )
                      .join("")}
                  </div>
                </div>
            </div>
          </div>
        </div>
        <a class="delete-icon nsm-link" href="#">
          <i class="bx bx-fw bx-x m-0"></i>
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

$(document).ready(async function () {
  const templateCreate = new TemplateCreate();
  templateCreate.init();

  const $form = document.getElementById("templateForm");
  if (!$form) return;

  const { FormAutoSave, FormAutoSaveConfig } = await import(
    "/assets/js/customer/add_advance/FormAutoSave.js"
  );

  let errorTimeout = null;
  let hasChangedUrl = false;
  let templateId = null;

  const config = new FormAutoSaveConfig({
    onChange: async () => {
      try {
        const result = await templateCreate.submitForm(templateId);
        templateId = result.id;

        if (!hasChangedUrl) {
          window.history.replaceState({}, "", `/eSign_v2/templateEdit?id=${templateId}`); // prettier-ignore
          hasChangedUrl = true;
        }
      } catch (error) {
        if (error.toString().toLowerCase().includes("is not valid json")) {
          return;
        }

        console.error(error);
        window.clearTimeout(errorTimeout);

        FormAutoSave.toggleSavingErrorIndicator();
        errorTimeout = window.setTimeout(() => {
          FormAutoSave.toggleSavingErrorIndicator(false);
        }, 5000);
      }
    },
  });

  const form = new FormAutoSave($form, config);
  form.listen();
});

// https://stackoverflow.com/a/47480429/8062659
const sleep = (ms) => new Promise((res) => setTimeout(res, ms));

// https://stackoverflow.com/a/46181/8062659
function isValidEmail(string) {
  const regex =
    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
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
