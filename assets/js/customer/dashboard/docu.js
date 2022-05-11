import * as api from "./api.js";
import * as common from "./common.js";

const $section = document.querySelector("[module-id=profiledocuments]");
const $fileInput = $section.querySelector("#docufileinput");
const $buttons = [...$section.querySelectorAll("[data-action]")];

const actions = {
  upload: onClickUpload,
  download: onClickDownload,
  delete: onClickDelete,
};

$buttons.forEach(($button) => {
  const action = actions[$button.dataset.action];
  if (typeof action === "function") {
    $button.addEventListener("click", action);
  }
});

function onClickUpload() {
  $fileInput.setAttribute("document-type", getButtonDocumentType(this));
  $fileInput.click();
}

function onClickDownload() {
  const customerId = getCustomerId();
  const documentType = getButtonDocumentType(this);
  window.open(
    `${api.prefixURL}/CustomerDashboardQuickActions/downloadCustomerDocument?customer_id=${customerId}&document_type=${documentType}`,
    "_blank"
  );
}

async function onClickDelete() {
  const documentType = getButtonDocumentType(this);
  const $wrapper = $section.querySelector(`[data-document-type="${documentType}"]`); // prettier-ignore

  const $deleteBtn = $wrapper.querySelector("[data-action=delete]");
  const prevText = $deleteBtn.textContent;
  $deleteBtn.textContent = "Deleting...";
  $deleteBtn.setAttribute("disabled", true);

  try {
    const payload = {
      document_type: documentType,
      customer_id: getCustomerId(),
    };

    await api.deleteCustomerDocument(payload);
    const $buttons = $wrapper.querySelector(".buttons");
    $buttons.classList.remove("has-document");
  } catch (error) {
  } finally {
    $deleteBtn.textContent = prevText;
    $deleteBtn.removeAttribute("disabled");
  }
}

$fileInput.addEventListener("change", async function () {
  const documentType = this.getAttribute("document-type");
  const $wrapper = $section.querySelector(`[data-document-type="${documentType}"]`); // prettier-ignore
  const $label = $wrapper.querySelector("[data-type=document_label]");
  const documentLabel = $label ? $label.textContent.trim() : null;

  const payload = {
    document: this.files[0],
    document_type: documentType,
    customer_id: getCustomerId(),
    document_label: documentLabel,
  };

  const maxSizeInMB = 8;
  if (!validateFileSize(payload.document)) {
    const $error = $section.querySelector(".nsm-callout.error");
    $error.textContent = `Selected file size should not be greater than ${maxSizeInMB}MB.`;
    $error.classList.remove("d-none");
    window.setTimeout(() => $error.classList.add("d-none"), 3500);
  } else {
    const $uploadBtn = $wrapper.querySelector("[data-action=upload]");
    const prevText = $uploadBtn.textContent;
    $uploadBtn.textContent = "Uploading...";
    $uploadBtn.setAttribute("disabled", true);

    try {
      await api.uploadCustomerDocument(payload);
      const $buttons = $wrapper.querySelector(".buttons");
      $buttons.classList.add("has-document");
    } catch (error) {
      console.error(error);
    } finally {
      $uploadBtn.textContent = prevText;
      $uploadBtn.removeAttribute("disabled");
    }
  }

  this.value = "";
});

// https://stackoverflow.com/a/44505315/8062659
function validateFileSize(file, maxMB = 8) {
  const fileSize = file.size / 1024 / 1024; // in MiB
  return fileSize <= maxMB;
}

function getButtonDocumentType($button) {
  const $wrapper = $button.closest("[data-document-type]");
  return $wrapper ? $wrapper.dataset.documentType : null;
}

function getCustomerId() {
  return common.getCustomerId();
}

(() => {
  const customerId = getCustomerId();
  api.getCustomerDocuments(customerId).then((response) => {
    const notPrefined = response.data.filter((item) => item.is_predefined == 0);

    const loaders = document.querySelectorAll(".documents-loader");
    loaders.forEach((loader) => loader.remove());

    createSwitchAndUpload(notPrefined);
  });

  const $button = document.getElementById("managecustomerdocumentsbtn");
  const $modal = document.getElementById("managecustomerdocuments");
  const $wrapper = $modal.querySelector(".documents-wrapper");

  $button.addEventListener("click", function () {
    $($modal).modal("show");
  });

  const $form = $modal.querySelector("form");
  const $createBtn = $form.querySelector(".primary");

  $form.addEventListener("submit", async (event) => {
    event.preventDefault();

    const $input = $form.querySelector("input");
    const value = $input.value.trim();

    if (!value.length) {
      $input.focus();
      return;
    }

    const prevText = $createBtn.textContent;
    $createBtn.setAttribute("disabled", true);
    $createBtn.textContent = "Creating...";

    try {
      const response = await api.createCustomerDocumentLabel({
        customer_id: customerId,
        document_type: value.replace(/\s+/g, "_").toLowerCase(),
        document_label: value,
      });

      if (response.success !== false) {
        createSwitchAndUpload(response.data);
      } else {
        const $error = $wrapper.querySelector(".nsm-callout.error");
        $error.textContent =
          "Something went wrong. Make sure the document label you're adding does not already exist.";
        $error.classList.remove("d-none");
        window.setTimeout(() => $error.classList.add("d-none"), 3500);
      }
    } catch (error) {
      console.error(error);
    } finally {
      $input.value = "";
      $createBtn.removeAttribute("disabled");
      $createBtn.textContent = prevText;
    }
  });

  function createSwitchAndUpload(data) {
    if (!Array.isArray(data)) {
      data = [data];
    }

    const $switchFragment = document.createDocumentFragment();
    data.forEach((currData) => {
      $switchFragment.appendChild(createDocumentLabelSwitch(currData));
    });

    const $uploadFragment = document.createDocumentFragment();
    data.forEach((currData) => {
      $uploadFragment.appendChild(createDocumentLabelUpload(currData));
    });

    const $section = document.querySelector("[module-id=profiledocuments]");
    const $uploadsWrapper = $section.querySelector(".upload-wrapper");

    $wrapper.appendChild($switchFragment);
    $uploadsWrapper.appendChild($uploadFragment);
  }
  function createDocumentLabelSwitch(data) {
    const $template = $modal.querySelector("template");
    const $copy = document.importNode($template.content, true);

    const $title = $copy.querySelector(".content-title");
    const $switch = $copy.querySelector("[type=checkbox]");
    const $deleteBtn = $copy.querySelector(".delete");

    if (data.is_active == 1) {
      $switch.setAttribute("checked", true);
    } else {
      $switch.removeAttribute("checked");
    }

    $title.textContent = data.document_label;

    $switch.addEventListener("click", (event) => {
      handleSwitchChange(event, data);
    });

    $deleteBtn.addEventListener("click", (event) => {
      handleDeleteDocument(event, data);
    });

    return $copy.firstElementChild;
  }
  function createDocumentLabelUpload(data) {
    const $section = document.querySelector("[module-id=profiledocuments]");
    const $wrapper = $section.querySelector(".upload-wrapper");

    const $template = $wrapper.querySelector("template");
    const $copy = document.importNode($template.content, true);

    const $checkbox = $copy.querySelector(".form-check-input");
    $checkbox.setAttribute("id", data.document_type);
    $checkbox.setAttribute("name", data.document_type);

    const $label = $copy.querySelector(".form-check-label");
    $label.setAttribute("for", data.document_type);
    $label.textContent = data.document_label;

    const $retval = $copy.firstElementChild;
    $retval.setAttribute("data-document-type", data.document_type);

    const $buttons = [...$copy.querySelectorAll("[data-action]")];
    $buttons.forEach(($button) => {
      const action = actions[$button.dataset.action];
      if (typeof action === "function") {
        $button.addEventListener("click", action);
      }
    });

    if (data.file_name && data.file_name.trim().length) {
      const $buttonWrapper = $copy.querySelector(".buttons");
      $buttonWrapper.classList.add("has-document");
    }

    if (data.is_active == 0) {
      $retval.classList.add("d-none");
    }

    return $retval;
  }

  async function handleSwitchChange(event, data) {
    const $section = document.querySelector("[module-id=profiledocuments]");
    const $wrapper = $section.querySelector(".upload-wrapper");
    const $upload = $wrapper.querySelector(`[data-document-type="${data.document_type}"]`); // prettier-ignore
    const isChecked = event.target.checked;

    try {
      const payload = {
        document_type: data.document_type,
        customer_id: getCustomerId(),
        is_active: isChecked,
      };

      const response = await api.updateCustomerDocument(payload);
      $upload.classList[response.data.is_active == 1 ? "remove" : "add"]("d-none"); // prettier-ignore
    } catch (error) {
      console.error(error);
    }
  }

  async function handleDeleteDocument(event, data) {
    const $section = document.querySelector("[module-id=profiledocuments]");
    const $wrapper = $section.querySelector(".upload-wrapper");
    const $upload = $wrapper.querySelector(`[data-document-type="${data.document_type}"]`); // prettier-ignore
    const $thisBtn = event.target;
    const $parent = $thisBtn.closest(".nsm-card");

    $thisBtn.setAttribute("disabled", true);

    try {
      const payload = {
        document_type: data.document_type,
        customer_id: getCustomerId(),
      };

      await api.deleteCustomerDocument(payload, { delete: true });
      $parent.remove();
      $upload.remove();
    } catch (error) {
      console.error(error);
    } finally {
      $thisBtn.removeAttribute("disabled");
    }
  }
})();

(() => {
  const $section = document.querySelector("[module-id=profiledocuments]");
  const $wrapper = $section.querySelector(".upload-wrapper");

  const $delete = document.getElementById("managecustomerdocumentsbtn--delete");
  $delete.addEventListener("click", async function () {
    const checkboxes = [...$wrapper.querySelectorAll(".form-check-input")];
    const checked = checkboxes.filter(($checkbox) => $checkbox.checked);
    if (!checked.length) {
      const $error = $section.querySelector(".nsm-callout.error");
      $error.textContent = "Please select at least one document to continue.";
      $error.classList.remove("d-none");
      window.setTimeout(() => $error.classList.add("d-none"), 3500);
      return;
    }

    const documentTypes = checked.map(($checkbox) => $checkbox.id);
    const payloads = documentTypes.map((type) => ({
      document_type: type,
      customer_id: getCustomerId(),
    }));

    const $text = $delete.querySelector(".text");
    const prevText = $text.textContent;
    $delete.setAttribute("disabled", true);
    $text.textContent = "Deleting...";

    try {
      // We probably want to create a controller that
      // processes these in one request. 😄
      const promises = payloads.map((payload) => {
        return api.deleteCustomerDocument(payload);
      });

      const results = await Promise.allSettled(promises);
      results.forEach((result) => {
        if (result.status !== "fulfilled") return;
        if (!result.value.deleted) return;

        const { deleted } = result.value;
        const $upload = $wrapper.querySelector(`[data-document-type=${deleted.document_type}]`); // prettier-ignore
        $upload.querySelector(".buttons").classList.remove("has-document");
      });
    } catch (error) {
      console.error(error);
    } finally {
      $delete.removeAttribute("disabled");
      $text.textContent = prevText;

      checkboxes.forEach(($checkbox) => {
        $checkbox.checked = false;
      });
    }
  });

  const $download = document.getElementById("managecustomerdocumentsbtn--download"); // prettier-ignore
  $download.addEventListener("click", async function () {
    const checkboxes = [...$wrapper.querySelectorAll(".form-check-input")];
    const checked = checkboxes.filter(($checkbox) => $checkbox.checked);
    if (!checked.length) {
      const $error = $section.querySelector(".nsm-callout.error");
      $error.textContent = "Please select at least one document to continue.";
      $error.classList.remove("d-none");
      window.setTimeout(() => $error.classList.add("d-none"), 3500);
      return;
    }

    const customerId = getCustomerId();
    let documentTypes = checked.map(($checkbox) => $checkbox.id);
    documentTypes = documentTypes.join(",");

    window.open(
      `${api.prefixURL}/CustomerDashboardQuickActions/downloadCustomerDocument?customer_id=${customerId}&document_type=${documentTypes}`,
      "_blank"
    );
  });
})();
