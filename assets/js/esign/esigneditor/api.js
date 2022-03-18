export const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";

export function getCategories() {
  return http.get(`${prefixURL}/EsignEditor/apiGetCategories`);
}

export function createCategory(payload) {
  return http.post(`${prefixURL}/EsignEditor/apiCreateCategory`, payload);
}

export function deleteCategory(id) {
  return http.delete(`${prefixURL}/EsignEditor/apiDeleteCategory/${id}`);
}

export function editCategory(payload) {
  return http.post(`${prefixURL}/EsignEditor/apiEditCategory/${payload.id}`, {
    name: payload.name,
  });
}

export function createLetter(payload) {
  return http.post(`${prefixURL}/EsignEditor/apiCreateLetter`, payload);
}

export function getLetters() {
  return http.get(`${prefixURL}/EsignEditor/apiGetLetters`);
}

export function deleteLetter(id) {
  return http.delete(`${prefixURL}/EsignEditor/apiDeleteLetter/${id}`);
}

export function getLetter(id) {
  return http.delete(`${prefixURL}/EsignEditor/apiGetLetter/${id}`);
}

export function editLetter(payload) {
  const { id, ...rest } = payload;
  return http.post(`${prefixURL}/EsignEditor/apiEditLetter/${id}`, rest);
}

export function getPlaceholders() {
  return http.get(`${prefixURL}/EsignEditor/apiGetPlaceholders`);
}

export function createPlaceholder(payload) {
  return http.post(`${prefixURL}/EsignEditor/apiCreatePlaceholder`, payload);
}

export function getLetterByCategoryId(categoryId) {
  return http.get(
    `${prefixURL}/EsignEditor/apiGetLetterByCategoryId/${categoryId}`
  );
}

export function getCustomer(id) {
  return http.get(`${prefixURL}/EsignEditor/apiGetCustomer/${id}`);
}

export function exportLetterAsPDF(payload) {
  return http.post(`${prefixURL}/EsignEditor/apiExportLetterAsPDF`, payload);
}

export function createCustomerLetter(payload) {
  return http.post(`${prefixURL}/EsignEditor/apiCreateCustomerLetter`, payload);
}

export function getCustomerLetters(customerId) {
  return http.get(
    `${prefixURL}/EsignEditor/apiGetCustomerLetters/${customerId}`
  );
}

export function getCustomerPlaceholders(customerId) {
  return http.get(
    `${prefixURL}/EsignEditor/apiGetCustomerPlaceholders/${customerId}`
  );
}

export function editCustomerLetter(payload) {
  const { id, ...rest } = payload;
  return http.post(
    `${prefixURL}/EsignEditor/apiEditCustomerLetter/${id}`,
    rest
  );
}

export function deleteCustomerLetter(id) {
  return http.delete(`${prefixURL}/EsignEditor/apiDeleteCustomerLetter/${id}`);
}

export function printCustomerLetters(payload) {
  return http.post(`${prefixURL}/EsignEditor/apiPrintCustomerLetters`, payload);
}

export function batchEditCustomerLetters(payload) {
  return http.post(
    `${prefixURL}/EsignEditor/apiBatchEditCustomerLetters`,
    payload
  );
}

export function emailCustomerLetter(payload) {
  return http.post(`${prefixURL}/EsignEditor/apiEmailCustomerLetter`, payload);
}

const http = {
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
