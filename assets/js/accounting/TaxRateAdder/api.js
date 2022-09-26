window.prefixURL = "";

export async function getRates() {
  const prefixURL = "";
  const response = await fetch(`${prefixURL}/AccountingSales/apiGetRates`);
  return response.json();
}

export async function saveRate(payload) {
  const response = await fetch(`${prefixURL}/AccountingSales/apiSaveRate`, {
    method: "post",
    body: JSON.stringify(payload),
    headers: {
      accept: "application/json",
      "content-type": "application/json",
    },
  });

  return response.json();
}

export async function getAgencies() {
  const endpoint = `${prefixURL}/AccountingSales/apiGetAgencies?include_inactive=true`;
  const response = await fetch(endpoint);
  return response.json();
}
