import * as api from "./api.js";

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
  const $wrapper = document.querySelector(`[data-document-type="${documentType}"]`); // prettier-ignore

  const $deleteBtn = $wrapper.querySelector("[data-action=delete]");
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
    $deleteBtn.textContent = "Delete";
    $deleteBtn.removeAttribute("disabled");
  }
}

$fileInput.addEventListener("change", async function () {
  const documentType = this.getAttribute("document-type");
  const $wrapper = document.querySelector(`[data-document-type="${documentType}"]`); // prettier-ignore
  const $label = $wrapper.querySelector("[data-type=document_label]");
  const documentLabel = $label ? $label.textContent.trim() : null;

  const $uploadBtn = $wrapper.querySelector("[data-action=upload]");
  $uploadBtn.textContent = "Uploading...";
  $uploadBtn.setAttribute("disabled", true);

  const payload = {
    document: this.files[0],
    document_type: documentType,
    customer_id: getCustomerId(),
    document_label: documentLabel,
  };

  try {
    await api.uploadCustomerDocument(payload);
    const $buttons = $wrapper.querySelector(".buttons");
    $buttons.classList.add("has-document");
  } catch (error) {
  } finally {
    $uploadBtn.textContent = "Upload";
    $uploadBtn.removeAttribute("disabled");
  }

  this.value = "";
});

function getCustomerId() {
  return window.location.pathname.split("/").at(-1);
}

function getButtonDocumentType($button) {
  const $wrapper = $button.closest("[data-document-type]");
  return $wrapper ? $wrapper.dataset.documentType : null;
}
