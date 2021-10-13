window.prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";

export const prefixURL = window.prefixURL;

export async function saveRate(payload) {
  const response = await fetch(`${prefixURL}/AccountingRules/apiSaveRule`, {
    method: "post",
    body: JSON.stringify(payload),
    headers: {
      accept: "application/json",
      "content-type": "application/json",
    },
  });

  return response.json();
}

export async function editRate(id, payload) {
  const endpoint = `${window.prefixURL}/AccountingRules/apiEditRule/${id}`;
  const response = await fetch(endpoint, {
    method: "post",
    body: JSON.stringify(payload),
    headers: {
      accept: "application/json",
      "content-type": "application/json",
    },
  });

  return await response.json();
}

export async function batchEditRate(ids, payload) {
  const endpoint = `${window.prefixURL}/AccountingRules/apiBatchEditRule`;
  const response = await fetch(endpoint, {
    method: "post",
    body: JSON.stringify({ ids, ...payload }),
    headers: {
      accept: "application/json",
      "content-type": "application/json",
    },
  });

  return await response.json();
}

export async function batchDeleteRate(ids) {
  const endpoint = `${window.prefixURL}/AccountingRules/apiBatchDeleteRule`;
  const response = await fetch(endpoint, {
    method: "post",
    body: JSON.stringify({ ids }),
    headers: {
      accept: "application/json",
      "content-type": "application/json",
    },
  });

  return await response.json();
}

export async function editRulePriorities(payload) {
  const endpoint = `${window.prefixURL}/AccountingRules/apiEditRulePriorities`;
  const response = await fetch(endpoint, {
    method: "post",
    body: JSON.stringify(payload),
    headers: {
      accept: "application/json",
      "content-type": "application/json",
    },
  });

  return await response.json();
}
