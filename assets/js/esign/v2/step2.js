// https://stackoverflow.com/a/494348/8062659
function createElementFromHTML(htmlString) {
  var div = document.createElement("div");
  div.innerHTML = htmlString.trim();
  return $(div.firstChild);
}

// https://stackoverflow.com/a/46181/8062659
function isValidEmail(string) {
  const regex =
    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return regex.test(String(string).toLowerCase());
}

function isValidName(string) {
  return string && 0 !== string.length;
}

function Recipient({ data: dataParam, onRemove: onRemoveParam }) {
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
    $parent.find("a.dropdown-toggle").html($target.html());
  }

  function createForm() {
    const roles = [
      {
        icon: "fa-pencil",
        value: "Needs to Sign",
      },
      {
        icon: "fa-pencil",
        value: "Signs in Person",
      },
      {
        icon: "fa-clone",
        value: "Receives a copy",
      },
    ];

    const { id, color, name, email } = data;
    const role = roles.find(({ value }) => value === data.role);

    const html = `
    <div
        class="form-box recipientForm"
        data-form-id=${id}
        style="border-left-width: 5px; border-left-color : ${color}"
    >
        <input type="hidden" name="role" value="${role.value}">
        <input type="hidden" name="color" value="${color}">

        <a class="clos-bx">
            <i class="bx bx-x"></i>
        </a>
        <div class="row">
            <div class="col-md-7 col-sm-7">
                <div class="leffm">
                    <div class="form-group">
                        <label>Name *</label>
                        <input type="text" data-key="name" name="name" value="${name}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email *</label>
                        <input type="email" data-key="email" name="email" value="${email}" class="form-control" required>
                        <div class="invalid-feedback">Invalid Email</div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-sm-5">
                <div class="action-envlo">
                    <ul style="list-style-type: none; margin: 0; padding: 0; margin-top: 18px;">
                        <li class="dropdown" data-key="role">
                            <a href="#" class="nsm-button dropdown-toggle" data-toggle="dropdown" data-bs-toggle="dropdown" style="display: inline-block; margin: 0;">
                                <i class="fa ${role.icon}"></i>
                                ${role.value}
                            </a>
                            <ul class="dropdown-menu">
                                ${roles
                                  .map(
                                    (currRole) =>
                                      `<li>
                                        <a class="dropdown-item" href="#">
                                          <i class="fa ${currRole.icon}"></i>
                                          ${currRole.value}
                                        </a>
                                      </li>`
                                  )
                                  .join("")}
                            </ul>
                        </li>
                        <li class="dropdown"><a href="#" class="dropdown-toggle d-none" data-toggle="dropdown">More</a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="fa fa-key"></i>Add access authentication</a></li>
                                <li><a href="#"><i class="fa fa-comment"></i>Add private message</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    `;

    const $element = createElementFromHTML(html);
    const $nameInput = $element.find("[data-key=name]");
    const $emailInput = $element.find("[data-key=email]");
    const $removeButton = $element.find(".clos-bx");
    const $roleDropdownItem = $element.find("[data-key=role] li");

    validateName($nameInput);
    validateEmail($emailInput);

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

function Step2() {
  const maxRecipients = 10;
  let recipients = [];

  const $form = $("[data-form-step=2]");
  const $formList = $("#setup-recipient-list");
  const $addRecipientButton = $("#add-recipient-button");
  const $formAdderButton = $(".esignBuilder__addForm");
  const prefixURL = "";

  async function fetchRecipients() {
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get("id");

    const endpoint = `${prefixURL}/esign/apiGetDocumentRecipients/${id}`;
    const response = await fetch(endpoint);
    return response.json();
  }

  function removeRecipient(id) {
    recipients = recipients.filter((recipient) => {
      return recipient.getData().id !== id;
    });

    renderRecipientsForm();
    if (recipients.length <= maxRecipients) {
      $formAdderButton.show();
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

    const newRecipient = new Recipient({ data, onRemove: removeRecipient });
    recipients = [...recipients, newRecipient];
    renderRecipientsForm();

    if (recipients.length >= maxRecipients) {
      $formAdderButton.hide();
    }
  }

  function renderRecipientsForm() {
    const $recipientForms = recipients.map((recipient) => {
      return recipient.createForm();
    });

    $formList.empty();
    $formList.append($recipientForms);
  }

  async function onSubmit(event) {
    event.preventDefault();

    const $invalidInputs = $form.find(".is-invalid");
    if ($invalidInputs.length !== 0) {
      $invalidInputs[0].focus();
      return;
    }

    const data = recipients.map((recipient) => recipient.getData());
    const docId = parseInt($form.find("[name=file_id]").val());

    await fetch($form.attr("action"), {
      method: "POST",
      body: JSON.stringify({ recipients: data, doc_id: docId }),
      headers: {
        accepts: "application/json",
        "content-type": "application/json",
      },
    });

    window.location = `${prefixURL}/esign/Files?id=${docId}&next_step=3`;
  }

  function attachEventHandlers() {
    $addRecipientButton.on("click", () => addRecipient());
    $form.on("submit", onSubmit);
  }

  async function init() {
    const data = await fetchRecipients();

    if (data.length === 0) {
      addRecipient();
    } else {
      data.forEach(addRecipient);
    }

    attachEventHandlers();
  }

  return { init };
}

$(document).ready(function () {
  const urlParams = new URLSearchParams(window.location.search);
  if (parseInt(urlParams.get("next_step")) === 2) {
    const step = new Step2();
    step.init();
  }
});
