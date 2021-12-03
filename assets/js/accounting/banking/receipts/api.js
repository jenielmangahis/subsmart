window.prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";
export const prefixURL = window.prefixURL;

export async function fetchReceipts(isReviewed = false) {
  const endpoint = `${window.prefixURL}/AccountingReceipts/apiGetReceipts?isReviewed=${isReviewed}`;
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

export async function deleteReceipt(id) {
  const endpoint = `${window.prefixURL}/AccountingReceipts/apiDeleteReceipt/${id}`;
  const response = await fetch(endpoint, {
    method: "delete",
    headers: {
      accept: "application/json",
    },
  });

  return response.json();
}

export async function editReceipt(id, payload) {
  const endpoint = `${window.prefixURL}/AccountingReceipts/apiEditReceipt/${id}`;
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

export async function searchExpenses(payload) {
  const endpoint = `${window.prefixURL}/AccountingReceipts/apiSearchExpenses`;
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

export async function saveMatch(id, payload) {
  const endpoint = `${window.prefixURL}/AccountingReceipts/apiSaveMatch/${id}`;
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

export async function getExpenseModal(expenseId) {
  const endpoint = `${window.prefixURL}/accounting/view-transaction/expense/${expenseId}`;
  const response = await fetch(endpoint);
  return response.text();
}

export async function searchReceipts(payload) {
  const endpoint = `${window.prefixURL}/AccountingReceipts/apiSearchReceipts`;
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

function sleep(seconds) {
  return new Promise((resolve) => setTimeout(resolve, seconds * 1000));
}
