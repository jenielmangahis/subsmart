window.prefixURL = "";

export async function getPayrollTaxPayments() {
  const endpoint = `${window.prefixURL}/AccountingPayroll/apiGetPayrollTaxPayments`;
  const response = await fetch(endpoint);
  return response.json();
}
