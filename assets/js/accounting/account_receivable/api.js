window.prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";

export const prefixURL = window.prefixURL;

export async function getReports() {
  const endpoint = `${prefixURL}/AccountingARSummary/apiGetReports`;
  const response = await fetch(endpoint);
  return response.json();
}

export async function exportAsExcel() {
  const endpoint = `${window.prefixURL}/AccountingARSummary/apiExportExcel`;
  const response = await fetch(endpoint);

  if (response.status !== 200) {
    return;
  }

  let filename = response.headers.get("content-disposition");
  filename = filename.match(/(?<=")(?:\\.|[^"\\])*(?=")/)[0];

  const blob = await response.blob();
  download(blob, filename, "application/octet-stream");
}
