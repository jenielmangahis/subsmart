//export const prefixURL = "http://127.0.0.1/ci/nsmart_v2";
export const prefixURL = "";

export function getActions() {
  return http.get(`${prefixURL}/CustomerDashboardQuickActions/list`);
}

export function createAction(payload) {
  return http.post(
    `${prefixURL}/CustomerDashboardQuickActions/create`,
    payload
  );
}

export function deleteAction(payload) {
  return http.post(
    `${prefixURL}/CustomerDashboardQuickActions/delete`,
    payload
  );
}

export function getCustomerActions(customerId) {
  return http.get(
    `${prefixURL}/CustomerDashboardQuickActions/getCustomerActions/${customerId}`
  );
}

export function getCustomerById(customerId) {
  return http.get(
    `${prefixURL}/CustomerDashboardQuickActions/getCustomerById/${customerId}`
  );
}

export async function uploadCustomerDocument(payload) {
  const formData = new FormData();
  Object.entries(payload).forEach(([key, value]) => {
    formData.append(key, value);
  });

  const endpoint = `${prefixURL}/CustomerDashboardQuickActions/uploadCustomerDocument`;
  const response = await fetch(endpoint, {
    method: "POST",
    body: formData,
    headers: {
      accepts: "application/json",
    },
  });

  return response.json();
}

export async function fetchCustomerTotalClientAgreement(cid){
  const data = new FormData();
  data.append("cid", cid);
  const response = await fetch(`${prefixURL}/CustomerDashboardQuickActions/customerTotalClientAgreement`, {
    method: "POST",
    body: data,
    headers: {
      accepts: "application/json",
    },
  });
  return response.json();
}

export async function fetchCustomerTotalSitePhotos(cid){
  const data = new FormData();
  data.append("cid", cid);
  const response = await fetch(`${prefixURL}/CustomerDashboardQuickActions/customerTotalSitePhotos`, {
    method: "POST",
    body: data,
    headers: {
      accepts: "application/json",
    },
  });
  return response.json();
}

export async function clientAgreementMaxUploadConfirmation() {
  const alert =  await Swal.fire({
    title: 'Max Client Agreement',
    text: `Continue uploading will overwrite recent saved data.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Proceed',
    cancelButtonText: 'Cancel'
  });
  return !!(alert.value && alert.value === true);
}

export async function sitePhotosMaxUploadConfirmation() {
  const alert =  await Swal.fire({
    title: 'Max Site Photos',
    text: `Continue uploading will overwrite recent saved data.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Proceed',
    cancelButtonText: 'Cancel'
  });
  return !!(alert.value && alert.value === true);
}

export async function deleteConfirmation(dataType) {
  let document = 'document';
  if( dataType == 'customer_signature' ){
    document = 'signature';
  }

  const alert =  await Swal.fire({
    title: 'Delete Document',
    text: `Continue deleting selected ${document}?`,
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: 'Proceed',
    cancelButtonText: 'Cancel'
  });
  return !!(alert.value && alert.value === true);
}

export function deleteCustomerDocument(payload, urlGetParams = null) {
  let endpoint = `${prefixURL}/CustomerDashboardQuickActions/deleteCustomerDocument`;
  if (urlGetParams !== null) {
    endpoint = `${endpoint}?` + new URLSearchParams(urlGetParams).toString();
  }

  return http.post(endpoint, payload);
}

export function createCustomerDocumentLabel(payload) {
  return http.post(
    `${prefixURL}/CustomerDashboardQuickActions/createCustomerDocumentLabel`,
    payload
  );
}

export function getCustomerDocuments(customerId) {
  return http.get(
    `${prefixURL}/CustomerDashboardQuickActions/getCustomerDocuments/${customerId}`
  );
}

export function updateCustomerDocument(payload) {
  return http.post(
    `${prefixURL}/CustomerDashboardQuickActions/updateCustomerDocument`,
    payload
  );
}

export function getEmailTemplates(urlGetParams = null) {
  let endpoint = `${prefixURL}/EsignEditor/apiGetEmailTemplates`;
  if (urlGetParams !== null) {
    endpoint = `${endpoint}?` + new URLSearchParams(urlGetParams).toString();
  }

  return http.get(endpoint);
}

export function setDefaultEmailTemplate(payload, urlGetParams = null) {
  let endpoint = `${prefixURL}/EsignEditor/apiSetDefaultEmailTemplate`;
  if (urlGetParams !== null) {
    endpoint = `${endpoint}?` + new URLSearchParams(urlGetParams).toString();
  }

  return http.post(endpoint, payload);
}

export function sendWelcomeEmail(payload) {
  return http.post(`${prefixURL}/customer/send_welcome_email`, payload);
}

export function getEsignDetails(id) {
  return http.get(`${prefixURL}/DocuSign/apiGetEsignDetails/${id}`);
}

export const http = {
  post: sendPost,
  delete: sendDelete,
  get: sendGet,
};

async function sendPost(url, payload) {
  let body = JSON.stringify(payload);
  const headers = {
    accept: "application/json",
    "content-type": "application/json",
  };

  if (payload instanceof FormData) {
    body = payload;
    delete headers["content-type"];
  }

  const response = await fetch(url, { method: "post", body, headers });
  return response.json();
}

async function sendDelete(url) {
  const response = await fetch(url, {
    method: "delete",
    headers: {
      accept: "application/json",
    },
  });

  return await response.json();
}

async function sendGet(url) {
  const response = await fetch(url);
  return response.json();
}
