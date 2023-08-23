import * as api from "../api.js";
import * as common from "../common.js";

export async function onClickViewEsign() {
  const DATE_FORMAT = "MM/DD/YYYY hh:mm A";

  const $modal = document.getElementById("viewesigndocumentdetails");
  const $title = $modal.querySelector(".modal-title");
  const $loader = $modal.querySelector(".esign-loader");
  const $content = $modal.querySelector(".esign-content");

  $title.textContent = "";
  $loader.classList.remove("d-none");
  $content.classList.add("d-none");
  $($modal).modal("show");

  const esignId = this.dataset.id;
  const { data } = await api.getEsignDetails(esignId);

  $title.innerHTML = '<i class="bx bx-file"></i> ' + data.unique_key;

  const $recipients = $modal.querySelector(".esign-recipients");
  $recipients.innerHTML = "";
  data.recipients.forEach((recipient) => {
    const $item = document.createElement("div");
    $item.classList.add("d-flex");
    $item.classList.add("justify-content-between");
    $item.classList.add("mb-1");

    const $name = document.createElement("div");
    $name.textContent = `${recipient.name} (${recipient.email})`;

    const $completedAt = document.createElement("div");
    $completedAt.classList.add("nsm-badge");
    $completedAt.classList.add("success");
    $completedAt.classList.add("d-flex");
    $completedAt.classList.add("align-items-center");
    $completedAt.textContent = moment(recipient.completed_at).format(
      DATE_FORMAT
    );

    $item.appendChild($name);
    $item.appendChild($completedAt);

    $recipients.appendChild($item);
  });

  const $createdAt = $modal.querySelector(".esign-created-at");
  $createdAt.textContent = moment(data.created_at).format(DATE_FORMAT);

  const $esignSubject = $modal.querySelector(".esign-subject");
  $esignSubject.textContent = data.subject;

  const $esignTemplate = $modal.querySelector(".esign-template");
  $esignTemplate.textContent = data.name;

  const $esignCustomer = $modal.querySelector(".esign-customer");
  if( data.customer_firstname === null && data.customer_lastname === null ){
    $esignCustomer.textContent = 'Customer Not Found';
  }else{
    $esignCustomer.textContent = data.customer_firstname + ' ' + data.customer_lastname;  
  }  

  const $link = $modal.querySelector(".esign-link");
  $link.textContent = data.signing_url;
  $link.setAttribute("href", data.signing_url);

  const $download = $modal.querySelector(".esign-download");
  const documentType = getButtonDocumentType(this);
  const downloadQuery = {
    customer_id: common.getCustomerId(),
    document_type: documentType,
    generated_esign_id: esignId,
  };
  const downloadParams = new URLSearchParams(downloadQuery).toString();
  $download.setAttribute(
    "href",
    `${api.prefixURL}/CustomerDashboardQuickActions/downloadCustomerDocument?${downloadParams}`
  );

  $loader.classList.add("d-none");
  $content.classList.remove("d-none");
}

export function getButtonDocumentType($button) {
  const $wrapper = $button.closest("[data-document-type]");
  return $wrapper ? $wrapper.dataset.documentType : null;
}

export async function importEsignToCustomer() {
  const customerId = getCustomerIdFromUrl();
  if (!customerId) {
    return;
  }

  const esignId = this.dataset.id;

  this.setAttribute("disabled", true);
  const textContent = this.textContent;
  this.textContent = "Loading...";

  const { data } = await api.http.post("/Customer/apiAttachGeneratedEsign", {
    customer_id: customerId,
    esign_id: esignId,
  });

  this.removeAttribute("disabled");
  this.textContent = textContent;

  const itemMarkup = `
    <div class="col-12" data-document-type="esign">
      <div class="row g-2 align-items-center">
          <div class="col-12 col-md-6 position-relative">
              <div class="form-check d-inline-block" style="padding: 0;">
                  <input class="form-check-input d-none" type="checkbox" id="esign${data.id}">
                  <label class="form-check-label" for="esign${data.id}">
                      ${data.label}
                  </label>
              </div>
          </div>
          <div class="col-12 col-md-6 text-end buttons has-document">
              <button type="button" class="nsm-button btn-sm" data-action="download" data-id="${data.docfile_id}">
                Download
              </button>

              <button type="button" class="nsm-button btn-sm" data-action="view_esign" data-id="${data.docfile_id}">
                View details
              </button>

              <button type="button" class="nsm-button error btn-sm" data-action="delete_attached_generated_pdf_entry" data-attached-generated-pdf-entry-id="${data.attached_generated_pdf_entry.id}">
                Delete
              </button>
          </div>
      </div>
    </div>
  `;

  const actions = {
    download: onClickDownload,
    view_esign: onClickViewEsign,
    delete_attached_generated_pdf_entry: onDeleteAttachedPDF,
  };

  const $item = createElementFromHTML(itemMarkup);
  const $buttons = $item.querySelectorAll("[data-action]");
  [...$buttons].forEach(($button) => {
    const action = actions[$button.dataset.action];
    if (typeof action === "function") {
      $button.addEventListener("click", action);
    }
  });

  const $wrapper = document.getElementById("generatedpdfwrapper");
  $wrapper.appendChild($item);

  const $modal = this.closest(".modal");
  $($modal).modal("hide");
}

function getCustomerIdFromUrl() {
  const pathRegex = /^\/customer\/module\/(?<customer_id>\d*)/i;
  const match = window.location.pathname.match(pathRegex);

  if (!match || !match.groups.customer_id) {
    return null;
  }

  return match.groups.customer_id;
}

export async function onDeleteAttachedPDF() {
  const id = this.dataset.attachedGeneratedPdfEntryId;

  this.setAttribute("disabled", true);
  this.textContent = "Deleting...";

  await api.http.post("/Customer/apiDeleteAttachedGeneratedEsign", { id });
  this.closest("[data-document-type=esign]").remove();
}

// https://stackoverflow.com/a/494348/8062659
function createElementFromHTML(htmlString) {
  var div = document.createElement("div");
  div.innerHTML = htmlString.trim();
  return div.firstChild;
}

export function onClickDownload() {
  const customerId = getCustomerIdFromUrl();
  const documentType = getButtonDocumentType(this);

  const params = {
    customer_id: customerId,
    document_type: documentType,
  };

  if (documentType === "esign") {
    params.generated_esign_id = this.dataset.id;
  }

  const queryString = new URLSearchParams(params).toString();
  window.open(
    `${api.prefixURL}/CustomerDashboardQuickActions/downloadCustomerDocument?${queryString}`,
    "_blank"
  );
}
