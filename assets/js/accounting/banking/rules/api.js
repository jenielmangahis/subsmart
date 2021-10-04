window.prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";

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
