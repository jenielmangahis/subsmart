(async function Accounting__Payroll() {
  const taxes = [
    {
      type: {
        title: "FL Unemployment Tax",
        date_range: "4/1/2021 — 6/30/2021",
      },
      status: "Ready to pay",
      amount: "0.27",
      due_date: "8/2/2021",
      payment_method: {
        primary_text: "Manual",
        secondary_text: "Pay by 8/2/2021",
      },
      show_actions: true,
      secondary_data: {
        type: {
          title: "FL SUI Employer",
        },
        amount: "0.27",
      },
    },
    {
      type: {
        title: "Federal Unemployment (940)",
        date_range: "1/1/2021 — 12/31/2021",
      },
      status: "Accruing",
      amount: "0.06",
      due_date: "1/31/2022",
      payment_method: {
        primary_text: "Electronic",
        secondary_text: "Withdrawal on 1/19/2022",
      },
      show_actions: false,
      secondary_data: {
        type: {
          title: "FUTA Employer",
        },
        amount: "0.06",
      },
    },
  ];

  const $container = $("#taxRowContainer");
  const template = $("#taxRowTemplate").get(0).content;

  taxes.forEach((tax) => {
    const $row = $(document.importNode(template, true));
    const $dataElements = $row.find("[data-type]");
    const $actions = $row.find(".payrollTax__actions");
    const $expandBtn = $row.find(".payrollTax__taxTypeBtn");

    $dataElements.each((_, element) => {
      const $element = $(element);
      const key = $element.attr("data-type");
      const value = Accounting__getValue(tax, key);

      $element.text(value);
      if (key === "status" && value === "Accruing") {
        $element.addClass("payrollTax__paymentStatus--accruing");
      }
    });

    if (tax.show_actions) {
      $actions.removeClass("d-none");
    }

    $expandBtn.on("click", function () {
      const $root = $(this).closest(".payrollTax__row");
      const expandClass = "payrollTax__row--expanded";

      // $root.hasClass(expandClass) is not working correctly here :/
      if ($root.get(0).classList.contains(expandClass)) {
        $root.removeClass(expandClass);
        return;
      }

      $root.addClass(expandClass);
    });

    $container.append($row);
  });
})();

// https://stackoverflow.com/a/6394197/8062659
function Accounting__getValue(object, selector) {
  const parts = selector.split(".");
  const newObj = object[parts[0]];

  if (!parts[1]) {
    return newObj;
  }

  parts.splice(0, 1);
  const nextSelector = parts.join(".");
  return Accounting__getValue(newObj, nextSelector);
}
