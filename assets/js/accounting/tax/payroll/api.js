window.prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";

export async function getPayrollTaxPayments() {
  const endpoint = `${window.prefixURL}/AccountingPayroll/getPayrollTaxPayments`;
  const response = await fetch(endpoint);
  return response.json();
}
