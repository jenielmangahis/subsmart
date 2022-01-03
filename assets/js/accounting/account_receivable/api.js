window.prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";

export const prefixURL = window.prefixURL;

export async function getReports() {
  const endpoint = `${prefixURL}/AccountingARSummary/apiGetReports`;
  const response = await fetch(endpoint);
  return response.json();
}
