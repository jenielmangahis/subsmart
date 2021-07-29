class Accounting__TaxItem {
  constructor() {
    this.$modal = $("#reviewSalesTaxModal");
  }

  createElement(data) {
    const $templateCopy = $(document.importNode(this.$template.get(0).content, true)); // prettier-ignore
    const dataNames = ["date", "address", "due_date", "price"];
    dataNames.forEach((name) => {
      $templateCopy.find(`[data-value=${name}]`).text(data[name]);
    });

    const $button = $templateCopy.find(".btn-primary");
    $button.on("click", () => {
      this.$modal.modal("show");
    });

    return $templateCopy;
  }
}

class Accounting__OverdueItem extends Accounting__TaxItem {
  constructor() {
    super();
    this.$template = $("#overdueItemTemplate");
    this.createElement = super.createElement.bind(this);
  }
}

class Accounting__DueItem extends Accounting__TaxItem {
  constructor() {
    super();
    this.$template = $("#dueItemTemplate");
    this.createElement = super.createElement.bind(this);
  }
}

class Accounting__UpcomingItem extends Accounting__TaxItem {
  constructor() {
    super();
    this.$template = $("#upcomingItemTemplate");
    this.createElement = super.createElement.bind(this);
  }
}

(async function Accounting__SalesTax() {
  const data = [
    {
      date: "July 2020",
      address: "Philippines",
      due_date: "August 2020",
      price: "$34.22",
    },
    {
      date: "August 2020",
      address: "Florida",
      due_date: "December 2020",
      price: "$44.30",
    },
    {
      date: "September 2020",
      address: "Canada",
      due_date: "January 2021",
      price: "$12.21",
    },
  ];

  const $overdueContainer = $("#overdueContainer");
  const $dueContainer = $("#dueContainer");
  const $upcomingContainer = $("#upcomingContainer");

  const overdueItem = new Accounting__OverdueItem();
  const dueItem = new Accounting__DueItem();
  const upcoming = new Accounting__UpcomingItem();

  const overdueItems = data.map(overdueItem.createElement);
  const dueItems = data.map(dueItem.createElement);
  const upcomings = data.map(upcoming.createElement);

  await sleep(2500);

  $overdueContainer.html(overdueItems);
  $dueContainer.html(dueItems);
  $upcomingContainer.html(upcomings);

  const $sidebar = $("#addAdjustment");
  const $sidebarCloseBtn = $sidebar.find(".addAdjustment__close");
  const $modal = $("#reviewSalesTaxModal");
  const $addAdjustmentLink = $modal.find("#addAdjustmentLink");

  $addAdjustmentLink.on("click", (event) => {
    event.preventDefault();
    $sidebar.addClass("addAdjustment--show");
  });

  $sidebarCloseBtn.on("click", () => {
    $sidebar.removeClass("addAdjustment--show");
  });

  $sidebar.on("click", (event) => {
    if ($sidebar.is(event.target)) {
      $sidebar.removeClass("addAdjustment--show");
    }
  });

  // https://stackoverflow.com/a/38614737/8062659
  $modal.on("shown.bs.modal", () => {
    $(document).off("focusin.modal");
  });

  // setup dropdown with search
  const $dueStart = $("#dueDateInputs [data-type=due_start]");
  const $dueEnd = $("#dueDateInputs [data-type=due_end]");
  const $dueButton = $("#dueDateInputs .btn-primary");

  const $dueStartInput = $dueStart.find("input");
  const $dueEndInput = $dueEnd.find("input");
  const $error = $("#dueDateInputs .dropdownWithSearchContainer__error");

  const dates = [
    "August 2020",
    "September 2020",
    "October 2020",
    "November 2020",
    "December 2020",
    "January 2021",
    "February 2021",
    "March 2021",
    "April 2021",
    "May 2021",
    "June 2021",
    "July 2021",
  ];

  [$dueStart, $dueEnd].forEach(($element) => {
    const element = $element.get(0);
    const dropdown = new Accounting__DropdownWithSearch(element, dates);
    dropdown.onChange = function () {
      const dueEnd = new Date($dueEndInput.val()).getTime();
      const dueStart = new Date($dueStartInput.val()).getTime();

      if (isNaN(dueStart) || dueStart > dueEnd) {
        $dueButton.attr("disabled", true);
        $error.removeClass("d-none");
      } else {
        $dueButton.removeAttr("disabled");
        $error.addClass("d-none");
      }
    };
  });

  const creditOrDiscountOptions = [
    {
      text: "Accounting",
      right_text: "Expenses",
    },
    {
      text: "Advertising/Promotional/Incentives",
      right_text: "Expenses",
    },
    {
      text: "Auto Expense",
      right_text: "Expenses",
    },
    {
      text: "Building Expense",
      right_text: "Expenses",
    },
    {
      text: "Commission",
      right_text: "Expenses",
    },
    {
      text: "Customer Reimbursement",
      sub_texts: ["Intuit Return", "NMI"],
      right_text: "Expenses",
    },
    {
      text: "Depreciation Expense",
      right_text: "Expenses",
    },
    {
      text: "Donations",
      right_text: "Expenses",
    },
    {
      text: "Gifts",
      right_text: "Expenses",
    },
    {
      text: "Legal Exspenses",
      right_text: "Expenses",
    },
    {
      text: "License",
      right_text: "Expenses",
    },
    {
      text: "Loan",
      right_text: "Expenses",
    },
    {
      text: "Loss of Income",
      sub_texts: ["Collections", "Late - Overdue >90 days"],
      right_text: "Expenses",
    },
    {
      text: "Merchant Fees",
      sub_texts: ["Intuit / QuickBooks", "NMI"],
      right_text: "Expenses",
    },
    {
      text: "Office Expenses",
      right_text: "Expenses",
    },
    {
      text: "Office/General Administrative E",
      right_text: "Expenses",
    },
    {
      text: "Payroll Expenses",
      sub_texts: ["Taxes", "Wages"],
      right_text: "Expenses",
    },
    {
      text: "Purchases-1",
      right_text: "Expenses",
    },
    {
      text: "QuickBooks Payments Fees",
      right_text: "Expenses",
    },
    {
      text: "QuickBooks Payments Fees-1",
      right_text: "Expenses",
    },
    {
      text: "Reimburstment",
      right_text: "Expenses",
    },
    {
      text: "Rental Reimbursement",
      right_text: "Expenses",
    },
    {
      text: "Technician/Installer",
      right_text: "Expenses",
    },
    {
      text: "Travel Meals",
      right_text: "Expenses",
    },
    {
      text: "Unapplied Cash Bill Payment Exp",
      right_text: "Expenses",
    },
    {
      text: "Unapplied Cash Bill Payment Expense",
      right_text: "Expenses",
    },
    {
      text: "Uncategorized Expense",
      right_text: "Expenses",
    },
    {
      text: "Utilities",
      right_text: "Expenses",
    },
    {
      text: "Other Miscellaneous Expense",
      right_text: "Other Expenses",
    },
    {
      text: "Reconciliation Discrepancies",
      right_text: "Other Expenses",
    },
  ];

  const priorPrepaymentsOptions = creditOrDiscountOptions;

  const prePaymentsOptions = [
    {
      text: "Accounting",
      right_text: "Expenses",
    },
    {
      text: "Advertising/Promotional/Incentives",
      right_text: "Expenses",
    },
    {
      text: "Auto Expense",
      right_text: "Expenses",
    },
    {
      text: "Building Expense",
      right_text: "Expenses",
    },
    {
      text: "Commission",
      right_text: "Expenses",
    },
    {
      text: "Customer Reimbursement",
      sub_texts: ["Intuit Return", "NMI"],
      right_text: "Expenses",
    },
    {
      text: "Depreciation Expense",
      right_text: "Expenses",
    },
    {
      text: "Donations",
      right_text: "Expenses",
    },
    {
      text: "Gifts",
      right_text: "Expenses",
    },
    {
      text: "Legal Exspenses",
      right_text: "Expenses",
    },
    {
      text: "License",
      right_text: "Expenses",
    },
    {
      text: "Loan",
      right_text: "Expenses",
    },
    {
      text: "Loss of Income",
      sub_texts: ["Collections", "Late - Overdue &gt;90 days"],
      right_text: "Expenses",
    },
    {
      text: "Merchant Fees",
      sub_texts: ["Intuit / QuickBooks", "NMI"],
      right_text: "Expenses",
    },
    {
      text: "Office Expenses",
      right_text: "Expenses",
    },
    {
      text: "Office/General Administrative E",
      right_text: "Expenses",
    },
    {
      text: "Payroll Expenses",
      sub_texts: ["Taxes", "Wages"],
      right_text: "Expenses",
    },
    {
      text: "Purchases-1",
      right_text: "Expenses",
    },
    {
      text: "QuickBooks Payments Fees",
      right_text: "Expenses",
    },
    {
      text: "QuickBooks Payments Fees-1",
      right_text: "Expenses",
    },
    {
      text: "Reimburstment",
      right_text: "Expenses",
    },
    {
      text: "Rental Reimbursement",
      right_text: "Expenses",
    },
    {
      text: "Technician/Installer",
      right_text: "Expenses",
    },
    {
      text: "Travel Meals",
      right_text: "Expenses",
    },
    {
      text: "Unapplied Cash Bill Payment Exp",
      right_text: "Expenses",
    },
    {
      text: "Unapplied Cash Bill Payment Expense",
      right_text: "Expenses",
    },
    {
      text: "Uncategorized Expense",
      right_text: "Expenses",
    },
    {
      text: "Utilities",
      right_text: "Expenses",
    },
    {
      text: "Other Miscellaneous Expense",
      right_text: "Other Expenses",
    },
    {
      text: "Reconciliation Discrepancies",
      right_text: "Other Expenses",
    },
  ];

  const otherOptions = [
    {
      text: "Accounting",
      right_text: "Expenses",
    },

    {
      text: "Advertising/Promotional/Incentives",
      right_text: "Expenses",
    },

    {
      text: "Auto Expense",
      right_text: "Expenses",
    },

    {
      text: "Building Expense",
      right_text: "Expenses",
    },

    {
      text: "Commission",
      right_text: "Expenses",
    },

    {
      text: "Customer Reimbursement",
      sub_texts: ["Intuit Return", "NMI"],
      right_text: "Expenses",
    },

    {
      text: "Depreciation Expense",
      right_text: "Expenses",
    },

    {
      text: "Donations",
      right_text: "Expenses",
    },

    {
      text: "Gifts",
      right_text: "Expenses",
    },

    {
      text: "Legal Exspenses",
      right_text: "Expenses",
    },

    {
      text: "License",
      right_text: "Expenses",
    },

    {
      text: "Loan",
      right_text: "Expenses",
    },

    {
      text: "Loss of Income",
      sub_texts: ["Collections", "Late - Overdue >90 days"],
      right_text: "Expenses",
    },

    {
      text: "Merchant Fees",
      sub_texts: ["Intuit / QuickBooks", "NMI"],
      right_text: "Expenses",
    },

    {
      text: "Office Expenses",
      right_text: "Expenses",
    },

    {
      text: "Office/General Administrative E",
      right_text: "Expenses",
    },

    {
      text: "Payroll Expenses",
      sub_texts: ["Taxes", "Wages"],
      right_text: "Expenses",
    },

    {
      text: "Purchases-1",
      right_text: "Expenses",
    },

    {
      text: "QuickBooks Payments Fees",
      right_text: "Expenses",
    },

    {
      text: "QuickBooks Payments Fees-1",
      right_text: "Expenses",
    },

    {
      text: "Reimburstment",
      right_text: "Expenses",
    },

    {
      text: "Rental Reimbursement",
      right_text: "Expenses",
    },

    {
      text: "Technician/Installer",
      right_text: "Expenses",
    },

    {
      text: "Travel Meals",
      right_text: "Expenses",
    },

    {
      text: "Unapplied Cash Bill Payment Exp",
      right_text: "Expenses",
    },

    {
      text: "Unapplied Cash Bill Payment Expense",
      right_text: "Expenses",
    },

    {
      text: "Uncategorized Expense",
      right_text: "Expenses",
    },

    {
      text: "Utilities",
      right_text: "Expenses",
    },

    {
      text: "ACH Settlement / NMI",
      right_text: "Expenses",
    },

    {
      text: "Billable Expense Income",
      right_text: "Expenses",
    },

    {
      text: "Guardian",
      right_text: "Expenses",
    },

    {
      text: "Income - Revenue",
      sub_texts: [
        "ACH Settlement",
        "Check Deposits - Regions",
        "Intuit Payments",
        "NMI Processing",
      ],
      right_text: "Expenses",
    },

    {
      text: "Insurance",
      right_text: "Expenses",
    },

    {
      text: "Intuit",
      right_text: "Expenses",
    },

    {
      text: "Markup",
      right_text: "Expenses",
    },

    {
      text: "Reimbursements/Bkcd Charge",
      sub_texts: ["ACH Settlement", "Intuit", "NMI"],
      right_text: "Expenses",
    },

    {
      text: "Rental Property Transfer",
      right_text: "Expenses",
    },

    {
      text: "Returned payment",
      right_text: "Expenses",
    },

    {
      text: "Sales",
      right_text: "Expenses",
    },

    {
      text: "Sales of Product Income",
      right_text: "Expenses",
    },

    {
      text: "Sales of Product Income-1",
      right_text: "Expenses",
    },

    {
      text: "Shipping Income",
      right_text: "Expenses",
    },

    {
      text: "Unapplied Cash Payment Income",
      right_text: "Expenses",
    },

    {
      text: "Unapplied Cash Payment Income-1",
      right_text: "Expenses",
    },

    {
      text: "Other Miscellaneous Expense",
      right_text: "Expenses",
    },

    {
      text: "Reconciliation Discrepancies",
      right_text: "Expenses",
    },

    {
      text: "Additional Income",
      sub_texts: [
        "Activations",
        "Customer Processing Fees",
        "Early Termination",
        "Equipment",
        "Equipment Removal",
        "Installations",
        "Invoicing",
        "Late Fees",
        "Other Miscellaneous Income",
        "Service Calls",
        "Service Cancellation (BOC)",
        "System Move",
      ],
      right_text: "Expenses",
    },
  ];

  const options = {
    credit_or_discount: creditOrDiscountOptions,
    prior_prepayments: priorPrepaymentsOptions,
    pre_payments: prePaymentsOptions,
    other: otherOptions,
  };

  const $reasonInput = $("#addAdjustment #reason");
  const $adjustmentAccount = $("#adjustmentAccount");

  const { credit_or_discount: defaultOption } = options;
  new Accounting__DropdownWithSearch($adjustmentAccount, defaultOption);

  $reasonInput.on("change", function () {
    $adjustmentAccount.find("#account").val("");
    $adjustmentAccount.find(".dropdownWithSearch__options").remove();
    new Accounting__DropdownWithSearch($adjustmentAccount, options[this.value]);
  });
})();

function sleep(ms) {
  return new Promise((resolve) => setTimeout(resolve, ms));
}
