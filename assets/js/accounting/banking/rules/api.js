window.prefixURL = "";

export const prefixURL = window.prefixURL;

export async function saveRule(payload) {
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

export async function editRule(id, payload) {
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

export async function batchEditRule(ids, payload) {
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

export async function batchDeleteRule(ids) {
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

export async function deleteRule(id) {
  const endpoint = `${window.prefixURL}/AccountingRules/apiDeleteRule/${id}`;
  const response = await fetch(endpoint, {
    method: "delete",
    headers: {
      accept: "application/json",
    },
  });

  return await response.json();
}

export async function exportRules() {
  const endpoint = `${window.prefixURL}/AccountingRules/apiExportRules`;
  const response = await fetch(endpoint);

  if (response.status !== 200) {
    return;
  }

  let filename = response.headers.get("content-disposition");
  filename = filename.match(/(?<=")(?:\\.|[^"\\])*(?=")/)[0];

  const blob = await response.blob();
  download(blob, filename, "application/octet-stream");
}

export async function parseFile(file) {
  const formData = new FormData();
  formData.append("files[]", file);

  const endpoint = `${window.prefixURL}/AccountingRules/apiPrepare`;
  const response = await fetch(endpoint, {
    method: "POST",
    body: formData,
    headers: {
      accept: "application/json",
    },
  });

  return response.json();
}

export async function apiImportRules(payload) {
  const endpoint = `${window.prefixURL}/AccountingRules/apiImportRules`;
  const response = await fetch(endpoint, {
    method: "post",
    body: JSON.stringify(payload),
    headers: {
      accept: "application/json",
      "content-type": "application/json",
    },
  });

  return response.json();
}
