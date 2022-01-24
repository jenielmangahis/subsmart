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

export async function getUser() {
  const endpoint = `${prefixURL}/AccountingARSummary/apiGetCurrentUser`;
  const response = await fetch(endpoint);
  return response.json();
}

export async function sendEmail(payload) {
  const endpoint = `${prefixURL}/AccountingARSummary/apiSendEmail`;
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

export async function getTableInfo() {
  const endpoint = `${prefixURL}/AccountingARSummary/apiGetTableInfo`;
  const response = await fetch(endpoint);
  return response.json();
}

export async function saveTableInfo(payload) {
  const endpoint = `${prefixURL}/AccountingARSummary/apiSaveTableInfo`;
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

export async function runReport(payload) {
  const endpoint = `${prefixURL}/AccountingARSummary/apiRunReport`;
  const response = await fetch(endpoint, {
    method: "post",
    body: JSON.stringify(payload),
    headers: {
      accept: "application/json",
      "content-type": "application/json",
    },
  });

  await sleep(3);
  return response.json();
}

export async function runReportCustomize(payload) {
  const endpoint = `${prefixURL}/AccountingARSummary/apiRunReportCustomize`;
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

export async function getReportCustomizeFormValues() {
  const endpoint = `${prefixURL}/AccountingARSummary/apiGetReportCustomize`;
  const response = await fetch(endpoint);
  return response.json();
}

function sleep(time) {
  return new Promise((resolve) => setTimeout(resolve, time * 1000));
}
