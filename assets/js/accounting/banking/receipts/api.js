window.prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";

export async function fetchReceipts() {
  const endpoint = `${window.prefixURL}/AccountingReceipts/apiGetReceipts`;
  const response = await fetch(endpoint);
  return response.json();
}

export async function batchDeleteReceipts(ids) {
  const endpoint = `${window.prefixURL}/AccountingReceipts/apiBatchDeleteReceipts`;
  const response = await fetch(endpoint, {
    method: "post",
    body: JSON.stringify({ ids }),
    headers: {
      accept: "application/json",
      "content-type": "application/json",
    },
  });

  return response.json();
}

export async function batchConfirmReceipts(ids) {
  const endpoint = `${window.prefixURL}/AccountingReceipts/apiBatchConfirmReceipts`;
  const response = await fetch(endpoint, {
    method: "post",
    body: JSON.stringify({ ids }),
    headers: {
      accept: "application/json",
      "content-type": "application/json",
    },
  });

  return response.json();
}
