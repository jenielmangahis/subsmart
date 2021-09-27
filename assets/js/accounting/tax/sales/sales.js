class Accounting__TaxItem {
  constructor() {
    this.$modal = $("#reviewSalesTaxModal");
  }

  createElement(data) {
    const $templateCopy = $(document.importNode(this.$template.get(0).content, true)); // prettier-ignore
    const dataNames = ["date", "address", "due_date", "price"];

    data.date = this.formatDate(data.date_issued);
    data.due_date = this.formatDate(data.due_date);
    data.address = data.billing_address || data.job_location;
    data.agency_name = data.agency ? data.agency.name : "";
    data.price = formatCurrencyWithSign(this.getTotalDue(data));

    dataNames.forEach((name) => {
      $templateCopy.find(`[data-value=${name}]`).text(data[name]);
    });

    const $button = $templateCopy.find(".btn-primary");
    $button.on("click", () => {
      this.onShowModal(data);
      this.$modal.modal("show");
    });

    // https://stackoverflow.com/a/38614737/8062659
    this.$modal.on("shown.bs.modal", () => {
      $(document).off("focusin.modal");
    });

    return $templateCopy;
  }

  onShowModal(data) {
    const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";
    const $dataTypes = this.$modal.find("[data-type]");
    const $sidebar = $("#addAdjustment");
    const $sidebarCloseBtn = $sidebar.find(".addAdjustment__close");
    const $addAdjustmentLink = this.$modal.find("#addAdjustmentLink");
    const $addAdjustmentBtn = $sidebar.find("#addAdjustmentBtn");
    const $openRecordPaymentBtn = this.$modal.find("#openRecordPaymentBtn");
    const $recordPaymentModal = $("#recordPaymentModal");
    const $savePaymentBtn = $recordPaymentModal.find("#savePayment");
    const hasPayment = Array.isArray(data.payments) && data.payments.length;

    $addAdjustmentLink.off();
    $sidebarCloseBtn.off();
    $sidebar.off();
    $addAdjustmentBtn.off();
    $openRecordPaymentBtn.off();
    $savePaymentBtn.off();

    data.date_issued = this.formatDate(data.date_issued);
    data.due_date = this.formatDate(data.due_date);

    // display tax agency
    const { items } = data;
    const $emptyMessageRow = this.$modal.find(".emptyMessageRow");
    const $dataRow = this.$modal.find(".dataRow");
    let tableData = {
      agency_name: "",
      gross: 0,
      nontaxable: 0,
      taxable: 0,
      tax: 0,
      tax_adjusted: 0,
    };

    if (items && items.length) {
      const getSumCurrency = (numbers) =>
        formatCurrency(numbers.reduce((p, c) => p + c, 0));

      const gross = getSumCurrency(items.map((i) => Number(i.total)));
      const nontaxable = 0;
      const taxable = gross;
      const tax = getSumCurrency(items.map((i) => Number(i.tax)));

      tableData = {
        agency_name: data.agency_name,
        gross,
        nontaxable,
        taxable,
        tax,
      };

      $emptyMessageRow.addClass("d-none");
      $dataRow.removeClass("d-none");
    } else {
      $emptyMessageRow.removeClass("d-none");
      $dataRow.addClass("d-none");
    }

    const totalAdjustments = this.getTotalAdjustments(data);
    const taxAdjusted = Number(tableData.tax) - Number(totalAdjustments);
    tableData.tax_adjusted = formatCurrencyWithSign(taxAdjusted);

    const $dataTableTypes = this.$modal.find("[data-table-type]");
    $dataTableTypes.each(function (_, element) {
      element.textContent = getValueByString(
        tableData,
        element.dataset.tableType
      );
    });

    // display tax adjustments
    const { adjustments } = data;
    const $adjustmentsWrapper = this.$modal.find("#adjustmentsWrapper");
    $adjustmentsWrapper.empty();

    if (adjustments && adjustments.length) {
      const $adjustments = adjustments.map((adjustment) => {
        // Gets the select item's text by value
        const reasonText = $sidebar.find(`[value=${adjustment.reason}]`).text();

        return `
          <div class="taxModal__adjustmentItem">
            <span>${reasonText}</span>
            <span>-$${formatCurrency(adjustment.amount)}</span>
          </div>
        `;
      });

      $adjustmentsWrapper.append($adjustments);
    }

    const totalPaid = this.getTotalPayments(data);
    const totalDue = this.getTotalDue(data);
    const isTaxPaid = hasPayment && totalDue <= 0;

    this.$modal.removeClass("taxModal--hasPayment");
    if (hasPayment) {
      this.$modal.addClass("taxModal--hasPayment");

      const template = this.$modal.find("#paymentTemplate").get(0).content;
      const $wrapper = this.$modal.find("#paymentsWrapper");
      const $totalPaid = this.$modal.find("#paymentItemsTotalAmount");
      const $totalDue = this.$modal.find("#paymentTotalDue");
      const $totalPaymentItems = this.$modal.find("#paymentTotalItems");
      const $viewPaymentModal = $("#viewPaymentModal");
      const $viewPaymentModalDatatypes = $viewPaymentModal.find("[data-type]");

      const items = data.payments.map((payment) => {
        payment.agency = data.agency;
        payment.amount = formatCurrency(payment.amount);
        payment.date_payment = this.formatDate(payment.date_payment, {
          month: "2-digit",
        });

        const $copy = $(document.importNode(template, true));
        const $link = $copy.find(".taxModal__link");
        const $dataTypes = $copy.find("[data-type]");

        $dataTypes.each((_, element) => {
          $(element).text(payment[element.dataset.type]);
        });

        $link.on("click", function (event) {
          event.preventDefault();
          $viewPaymentModalDatatypes.each((_, element) => {
            $(element).text(getValueByString(payment, element.dataset.type));
          });

          $viewPaymentModal.modal("show");
        });

        return $copy;
      });

      $wrapper.empty();
      $wrapper.append(items);
      $totalPaid.text(formatCurrency(totalPaid));
      $totalDue.text(formatCurrencyWithSign(totalDue));
      $totalPaymentItems.text(items.length);
    }

    this.$modal.removeClass("taxModal--paid");
    if (isTaxPaid) {
      this.$modal.addClass("taxModal--paid");
    }

    $dataTypes.each(function (_, element) {
      element.textContent = getValueByString(data, element.dataset.type);
    });

    $addAdjustmentLink.on("click", (event) => {
      event.preventDefault();
      $sidebar.addClass("addAdjustment--show");
      $sidebar.find("[data-type=tax_adjusted]").text(tableData.tax_adjusted);
    });

    $sidebarCloseBtn.on("click", () => {
      $sidebar.removeClass("addAdjustment--show");
    });

    $sidebar.on("click", (event) => {
      if ($sidebar.is(event.target)) {
        $sidebar.removeClass("addAdjustment--show");
      }
    });

    $addAdjustmentBtn.on("click", async function () {
      const $inputs = $sidebar.find("input[data-type], select[data-type], textarea[data-type]"); // prettier-ignore
      const $memo = $sidebar.find("#memoFormGroup");

      const payload = { invoice_id: data.id };
      for (let index = 0; index < $inputs.length; index++) {
        const input = $inputs[index];
        const key = input.dataset.type;

        let isRequired = true;
        let value = input.value;

        const $input = $(input);
        const $formGroup = $input.closest(".form-group");

        if ($memo.has($input).length && $memo.hasClass("d-none")) {
          isRequired = false;
          value = null;
        }

        $formGroup.removeClass("form-group--error");
        if (isRequired && !value) {
          $formGroup.addClass("form-group--error");
          $input.focus();
          return;
        }

        payload[key] = value;
      }

      $(this).attr("disabled", true);

      const response = await fetch(
        `${prefixURL}/AccountingSales/apiSaveAdjustment`,
        {
          method: "post",
          body: JSON.stringify(payload),
          headers: {
            accept: "application/json",
            "content-type": "application/json",
          },
        }
      );

      const json = await response.json();
      window.location.reload();
    });

    if (!isTaxPaid) {
      $openRecordPaymentBtn.on("click", () => {
        const $dataTypes = $recordPaymentModal.find("[data-type]");
        const $bankAccount = $recordPaymentModal.find("#bank_account");

        const data = {
          total_paid: formatCurrencyWithSign(totalPaid),
          total_due: formatCurrencyWithSign(totalDue),
        };
        $dataTypes.each(function (_, element) {
          element.textContent = getValueByString(data, element.dataset.type);
        });

        $recordPaymentModal.modal("show");

        this.initBankAccountSelect($bankAccount);
        this.$modal.modal("hide");
      });
    }

    $recordPaymentModal.on("hide.bs.modal", () => {
      this.$modal.modal("show");
    });

    $recordPaymentModal.on("shown.bs.modal", function () {
      $(document).off("focusin.modal");
    });

    $savePaymentBtn.on("click", async function () {
      const $form = $recordPaymentModal.find("form");
      const $inputs = $form.find("[data-type]");

      const payload = { invoice_id: data.id };
      for (let index = 0; index < $inputs.length; index++) {
        const input = $inputs[index];
        const key = input.dataset.type;

        let isRequired = true;
        let value = input.value;

        const $input = $(input);
        const $formGroup = $input.closest(".form-group");

        $formGroup.removeClass("form-group--error");
        if (isRequired && !value) {
          $formGroup.addClass("form-group--error");
          $input.focus();
          return;
        }

        payload[key] = value;
      }

      $(this).attr("disabled", true);

      const response = await fetch(
        `${prefixURL}/AccountingSales/apiSavePayment`,
        {
          method: "post",
          body: JSON.stringify(payload),
          headers: {
            accept: "application/json",
            "content-type": "application/json",
          },
        }
      );

      const json = await response.json();
      window.location.reload();
    });
  }

  getTotalDue(data) {
    return (
      Number(data.taxes) -
      Number(this.getTotalAdjustments(data)) -
      this.getTotalPayments(data)
    );
  }

  getTotalPayments(data) {
    if (!data.adjustments) return 0;
    return data.payments.reduce((c, p) => c + Number(p.amount), 0);
  }

  getTotalAdjustments(data) {
    if (!data.adjustments) return 0;
    return data.adjustments.reduce((c, a) => c + Number(a.amount), 0);
  }

  formatDate(date, options = {}) {
    const dateObject = new Date(date);
    const _options = {
      month: "long",
      day: "2-digit",
      year: "numeric",
      ...options,
    };

    return new Intl.DateTimeFormat("en", _options).format(dateObject);
  }

  initBankAccountSelect($select) {
    const formatResult = (optionElement) => {
      var searchField = $(".select2-search__field");
      var text = optionElement.text;
      var searchVal = $(searchField[searchField.length - 1]).val();
      if (searchVal === "") {
        return text;
      }

      return $(`<span>${text}</span>`);
    };

    const optionSelect = (data) => {
      var text = data.text;
      text = text.replaceAll("<strong>", "");
      text = text.replaceAll("</strong>", "");
      text = $.trim(text);
      return text;
    };

    $select.select2({
      templateResult: formatResult,
      templateSelection: optionSelect,
      ajax: {
        url: "/accounting/get-dropdown-choices",
        dataType: "json",
        data: (params) => ({
          search: params.term,
          type: "public",
          field: "bank-account",
          modal: "checkModal",
        }),
      },
    });

    const $modalContainer = $("#modal-container div.full-screen-modal");
    $select.on("change", function () {
      if ($(this).val() !== "add-new") {
        return;
      }

      $.get(
        "/accounting/get-dropdown-modal/account_modal?modal=check&field=bank-account",
        (result) => {
          $modalContainer.html(result);
          initAccountModal(); // global function

          $("#account-modal").on("hide.bs.modal", function () {
            // Assign value to nonexisting option, this is the only
            // way I was able to successfully empty the value.
            $select.select2("val", "_");
          });
        }
      );
    });
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
  const { Accounting__DropdownWithSearch } = await import("../dropdown-with-search/dropdown-with-search.js"); // prettier-ignore

  const displayTaxedInvoices = (data) => {
    const render = ($element, items) => {
      $element.html(items.length === 0 ? "<p>No item to display.</p>" : items);
    };

    const $overdueContainer = $("#overdueContainer");
    const $dueContainer = $("#dueContainer");
    const $upcomingContainer = $("#upcomingContainer");

    const overdueItem = new Accounting__OverdueItem();
    const dueItem = new Accounting__DueItem();
    const upcoming = new Accounting__UpcomingItem();

    const overdueItems = data.overdue.map(overdueItem.createElement);
    const dueItems = data.due.map(dueItem.createElement);
    const upcomings = data.upcoming.map(upcoming.createElement);

    render($overdueContainer, overdueItems);
    render($dueContainer, dueItems);
    render($upcomingContainer, upcomings);

    const $totalTax = $("#totalTax");
    const total = data.overdue.reduce((carry, curr) => {
      return carry + Number(overdueItem.getTotalDue(curr));
    }, 0);

    $totalTax.text(formatCurrencyWithSign(total));
  };

  const { data: taxedInvoice } = await fetchGetTaxedInvoices();
  displayTaxedInvoices(taxedInvoice);

  // setup dropdown with search
  const $dueStart = $("#dueDateInputs [data-type=due_start]");
  const $dueEnd = $("#dueDateInputs [data-type=due_end]");
  const $dueButton = $("#dueDateInputs .btn-primary");
  const $refreshListBtn = $("#refreshList");

  const $dueStartInput = $dueStart.find("input");
  const $dueEndInput = $dueEnd.find("input");
  const $error = $("#dueDateInputs .dropdownWithSearchContainer__error");

  const { data: dueDates } = await fetchTaxedInvoicesDueDates();

  // Maybe use find function? We're just expecting here
  // that the last element is for the current month.
  const currentMonth = dueDates[dueDates.length - 1];

  $refreshListBtn.prop("disabled", false);
  [$dueStart, $dueEnd].forEach(($element) => {
    const element = $element.get(0);

    // We expect that the list shows the records of the current month.
    $element.find("input").val(currentMonth);

    const dropdown = new Accounting__DropdownWithSearch(element, dueDates);
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

  $refreshListBtn.on("click", async function () {
    const dueStart = $dueStartInput.val();
    const dueEnd = $dueEndInput.val();

    if (isEmptyString(dueStart) || isEmptyString(dueEnd)) return;
    if (!dueDates.some((d) => d === dueStart)) return;
    if (!dueDates.some((d) => d === dueEnd)) return;

    $refreshListBtn.prop("disabled", true);
    const { data: taxedInvoice } = await fetchGetTaxedInvoices({
      due_start: dueStart,
      due_end: dueEnd,
    });

    displayTaxedInvoices(taxedInvoice);
    $refreshListBtn.prop("disabled", false);
  });

  const creditOrDiscountOptions = [
    {
      text: "ACH Settlement / NMI",
      right_text: "Income",
    },
    {
      text: "Billable Expense Income",
      right_text: "Income",
    },
    {
      text: "Guardian",
      right_text: "Income",
    },
    {
      text: "Income - Revenue",
      right_text: "Income",
      sub_texts: [
        {
          text: "ACH Settlement",
          right_text: "Income",
        },
        {
          text: "Check Deposits - Regions",
          right_text: "Income",
        },
        {
          text: "Intuit Payments",
          right_text: "Income",
        },
        {
          text: "NMI Processing",
          right_text: "Income",
        },
      ],
    },
    {
      text: "Insurance",
      right_text: "Income",
    },
    {
      text: "Intuit",
      right_text: "Income",
    },
    {
      text: "Markup",
      right_text: "Income",
    },
    {
      text: "Reimbursements/Bkcd Charge",
      right_text: "Income",
      sub_texts: [
        {
          text: "ACH Settlement",
          right_text: "Income",
        },
        {
          text: "Intuit Payments",
          right_text: "Income",
        },
        {
          text: "NMI Processing",
          right_text: "Income",
        },
      ],
    },
    {
      text: "Rental Property Transfer",
      right_text: "Income",
    },
    {
      text: "Returned payment",
      right_text: "Income",
    },
    {
      text: "Sales",
      right_text: "Income",
    },
    {
      text: "Sales of Product Income",
      right_text: "Income",
    },
    {
      text: "Sales of Product Income-1",
      right_text: "Income",
    },
    {
      text: "Shipping Income",
      right_text: "Income",
    },

    {
      text: "Unapplied Cash Payment Income",
      right_text: "Income",
    },
    {
      text: "Unapplied Cash Payment Income-1",
      right_text: "Income",
    },
    {
      text: "Additional Income",
      right_text: "Other Income",
      sub_texts: [
        {
          text: "Activations",
          right_text: "Other Income",
        },
        {
          text: "Customer Processing Fees",
          right_text: "Other Income",
        },
        {
          text: "Early Termination",
          right_text: "Other Income",
        },

        {
          text: "Equipment",
          right_text: "Other Income",
        },
        {
          text: "Equipment Removal",
          right_text: "Other Income",
        },
        {
          text: "Installations",
          right_text: "Other Income",
        },
        {
          text: "Invoicing",
          right_text: "Other Income",
        },
        {
          text: "Late Fees",
          right_text: "Other Income",
        },
        {
          text: "Other Miscellaneous Income",
          right_text: "Other Income",
        },
        {
          text: "Service Calls",
          right_text: "Other Income",
        },
        {
          text: "Service Cancellation (BOC)",
          right_text: "Other Income",
        },
        {
          text: "System Move",
          right_text: "Other Income",
        },
      ],
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
  const $memoFormGroup = $("#memoFormGroup");
  const $memoTextarea = $memoFormGroup.find("textarea");
  const memoDefaultValue = "Other (penalties, interest, rounding errors)";

  const { credit_or_discount: defaultOption } = options;
  new Accounting__DropdownWithSearch($adjustmentAccount, defaultOption);

  $reasonInput.on("change", function () {
    $adjustmentAccount.find("#account").val("");
    $adjustmentAccount.find(".dropdownWithSearch__options").remove();
    new Accounting__DropdownWithSearch($adjustmentAccount, options[this.value]);

    $memoTextarea.val(memoDefaultValue);
    $memoFormGroup.removeClass("form-group--error");

    if (this.value === "other") {
      $memoFormGroup.removeClass("d-none");
    } else {
      $memoFormGroup.addClass("d-none");
    }
  });
})();

function sleep(ms) {
  return new Promise((resolve) => setTimeout(resolve, ms));
}

const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";

async function fetchGetTaxedInvoices(payload = {}) {
  const endpoint = `${prefixURL}/AccountingSales/apiGetTaxedInvoices`;
  const response = await fetch(endpoint, {
    method: "POST",
    headers: { "content-Type": "application/json" },
    body: JSON.stringify(payload),
  });

  return await response.json();
}

async function fetchTaxedInvoicesDueDates() {
  const endpoint = `${prefixURL}/AccountingSales/apiGetTaxedInvoicesDueDates`;
  const response = await fetch(endpoint);
  return await response.json();
}

function isEmptyString(string) {
  return !string || string.length === 0;
}

function getValueByString(object, string) {
  if (object === null) {
    return null;
  }

  const parts = string.split(".");
  const newObject = object[parts[0]];

  if (!parts[1]) {
    return newObject;
  }

  parts.splice(0, 1);
  var newString = parts.join(".");
  return getValueByString(newObject, newString);
}

function formatCurrencyWithSign(number, currency = "$") {
  const _number = Number(number);

  if (_number < 0) {
    return `-${currency}${formatCurrency(Math.abs(_number))}`;
  }

  return `${currency}${formatCurrency(_number)}`;
}
