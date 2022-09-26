export const prefixURL = "";

export function getItems() {
  return http.get(`${prefixURL}/SlideShare/apiGetItems`);
}

export function edit(payload) {
  return http.post(`${prefixURL}/SlideShare/apiEdit`, payload);
}

export function remove(id) {
  return http.delete(`${prefixURL}/SlideShare/apiDelete?id=${id}`);
}

export function save(payload) {
  return http.post(`${prefixURL}/SlideShare/apiSave`, payload);
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
