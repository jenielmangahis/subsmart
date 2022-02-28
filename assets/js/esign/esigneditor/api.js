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

const http = {
  post: sendPost,
  delete: sendDelete,
  get: sendGet,
};

async function sendPost(url, payload) {
  const response = await fetch(url, {
    method: "post",
    body: JSON.stringify(payload),
    headers: {
      accept: "application/json",
      "content-type": "application/json",
    },
  });

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
