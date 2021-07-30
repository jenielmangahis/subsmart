(async function Accounting__Payroll() {
  const helpers = await import("./helpers.js");
  const taxes = [
    {
      form_type: "FL RT-6",
      status: "Due Soon",
      period: {
        quarter: "Quarterly (Q2)",
        date_range: "Apr-Jun 2021",
      },
      due: {
        primary_text: "8/2/2021",
        secondary_text: "Manually file",
      },
    },
    {
      form_type: "941",
      status: "Accepted",
      period: {
        quarter: "Quarterly (Q2)",
        date_range: "Apr-Jun 2021",
      },
      due: {
        primary_text: "8/2/2021",
        secondary_text: "Filed on 7/20/2021",
      },
    },
  ];

  const $container = $("#taxRowContainer");
  const $loader = $container.find(".payrollTax__loaderRow");
  const template = $("#taxRowTemplate").get(0).content;

  taxes.forEach((tax) => {
    const $row = $(document.importNode(template, true));
    const $dataElements = $row.find("[data-type]");

    $dataElements.each((_, element) => {
      const $element = $(element);
      const key = $element.attr("data-type");
      const value = helpers.Accounting__getValue(tax, key);
      $element.text(value);

      if (key === "status") {
        const statusType = value.replace(/\s+/g, "-").toLowerCase();
        $element.addClass(`payrollTax__paymentStatus--${statusType}`);
      }
    });

    $container.append($row);
  });

  $loader.addClass("d-none");
})();
