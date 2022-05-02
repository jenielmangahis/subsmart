export const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";

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
