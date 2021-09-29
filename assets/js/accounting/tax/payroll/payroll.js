(async function Accounting__Payroll() {
  const { UpcomingTaxPaymentsTable } = await import(
    "./UpcomingTaxPaymentsTable.js"
  );

  new UpcomingTaxPaymentsTable();
})();
