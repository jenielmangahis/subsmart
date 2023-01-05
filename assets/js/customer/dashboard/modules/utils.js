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

  $title.textContent = data.name;

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
  const pathRegex = /^\/customer\/module\/(?<customer_id>\d*)/i;
  const match = window.location.pathname.match(pathRegex);

  if (!match || !match.groups.customer_id) {
    return;
  }

  const customerId = match.groups.customer_id;
  const esignId = this.dataset.id;

  this.setAttribute("disabled", true);
  const textContent = this.textContent;
  this.textContent = "Loading...";

  await api.http.post("/Customer/apiAttachGeneratedEsign", {
    customer_id: customerId,
    esign_id: esignId,
  });

  this.removeAttribute("disabled");
  this.textContent = textContent;

  const $modal = this.closest(".modal");
  $($modal).modal("hide");
}
