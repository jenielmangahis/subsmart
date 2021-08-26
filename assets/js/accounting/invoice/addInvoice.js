window.isSales = $("#addRateSidebar").attr("data-isSales") === "true";
const selectors = {
  table: window.isSales ? "items_table_body_sales_receipt" : "jobs_items_table_body", // prettier-ignore
  totalTax: window.isSales ? "total_tax_sr_" : "total_tax_",
  grandTotal: window.isSales ? "grand_total_sr" : "grand_total",
  subTotal: window.isSales ? "span_sub_total_sr" : "span_sub_total_invoice",
};

(async () => {
  const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";
  const { Accounting__DropdownWithSearch } = await import("../tax/dropdown-with-search/dropdown-with-search.js"); // prettier-ignore
  const { rateAgencies } = await import("../tax/settings/rateAgencies.js");

  const $taxRateSelect = $("#invoiceTaxRate");
  const taxRateDefault = $taxRateSelect.find("[default]").val();
  const $sidebar = $("#addRateSidebar");
  const $taxDisplay = $(`#${selectors.totalTax}`);
  const $grandTotalDisplay = $(`#${selectors.grandTotal}`);
  const $subTotalDisplay = $(`#${selectors.subTotal}`);

  const showCustomRateOptions = (options) => {
    options.forEach(({ id, name, rate }) => {
      if ($taxRateSelect.find(`[data-id=${id}]`).length === 0) {
        $taxRateSelect.append(
          `<option data-id="${id}" value="${id}">${name} (${rate}%)</option>`
        );
      }
    });
    $taxRateSelect.prop("disabled", false);
  };

  const displayValues = (config = {}) => {
    let taxValue = undefined;

    if (config.rateId) {
      const price = calculateSubtotal();
      const customRate = customRates.find((rate) => rate.id == config.rateId);
      taxValue = (Number(customRate.rate) / 100) * price;
    } else {
      taxValue = calculateTax();
    }

    $taxDisplay.text(formatCurrency(taxValue));
    $grandTotalDisplay.text(formatCurrency(calculateGrandTotal()));
    $subTotalDisplay.text(formatCurrency(calculateSubtotal()));
  };

  const closeSidebar = (value = null) => {
    $sidebar.find(".form-control").val("");
    $sidebar.removeClass("sidebarForm--show");
    $taxRateSelect.val(value ? value : taxRateDefault);

    if (value === null) {
      displayValues({ rateId: value });
    }
  };

  let { data: customRates } = await fetchCustomRates();
  showCustomRateOptions(customRates);

  const $rateAgencySelect = $("#rateAgencySelect");
  new Accounting__DropdownWithSearch($rateAgencySelect, rateAgencies);

  const $addRateBtn = $("#addRateBtn");
  $addRateBtn.on("click", async function () {
    const $sidebar = $(this).closest(".sidebarForm");
    const $inputs = $sidebar.find("[data-type]");

    const payload = {};

    for (let index = 0; index < $inputs.length; index++) {
      const input = $inputs[index];
      const value = input.value;
      const key = input.dataset.type;

      const $input = $(input);
      const $formGroup = $input.closest(".form-group");

      $formGroup.removeClass("form-group--error");
      if (!value) {
        $formGroup.addClass("form-group--error");
        $input.focus();
        return;
      }

      if ($(input).is(":checkbox") && !input.checked) {
        continue;
      }

      payload[key] = value;
    }

    $(this).attr("disabled", true);
    $(this).text("Saving...");

    const response = await fetch(`${prefixURL}/AccountingSales/apiSaveRate`, {
      method: "post",
      body: JSON.stringify(payload),
      headers: {
        accept: "application/json",
        "content-type": "application/json",
      },
    });

    const json = await response.json();
    customRates = [...customRates, json.data];
    showCustomRateOptions(customRates);
    closeSidebar(json.data.id);
  });

  const showAddRateSidebar = () => {
    const $sidebarCloseBtn = $sidebar.find("[data-action=close]");

    $sidebar.addClass("sidebarForm--show");

    $sidebarCloseBtn.on("click", () => {
      closeSidebar();
    });

    $sidebar.on("click", (event) => {
      if ($sidebar.is(event.target)) {
        closeSidebar();
      }
    });
  };

  $taxRateSelect.on("change", function () {
    const { value } = this;

    if (value === "add_custom") {
      showAddRateSidebar();
      return;
    }

    if (value === taxRateDefault) {
      displayValues();
      return;
    }

    displayValues({ rateId: value });
  });
})();

async function fetchCustomRates() {
  const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";
  const response = await fetch(`${prefixURL}/AccountingSales/apiGetRates`);
  return response.json();
}

function formatCurrency(number) {
  return accounting.formatMoney(number, { symbol: "" });
}

function calculateTax() {
  let total = 0;
  const $rows = $(`#${selectors.table} tr`);

  $rows.each((_, row) => {
    const $tax = $(row).find("input[name='tax[]']");
    total += Number($tax.val());
  });

  return Number(total);
}

function calculateSubtotal() {
  let total = 0;
  const $rows = $(`#${selectors.table} tr`);

  $rows.each((_, row) => {
    const $price = $(row).find("input[name='price[]']");
    const $quantity = $(row).find("input[name='quantity[]']");
    const $discount = $(row).find("input[name='discount[]']");

    const price = Number($price.val());
    const quantity = Number($quantity.val());
    const discount = Number($discount.val());

    total += price * quantity - discount;
  });

  return Number(total);
}

function calculateGrandTotal() {
  const totalTax = accounting.unformat($(`#${selectors.totalTax}`).text());
  return Number(calculateSubtotal()) + Number(totalTax);
}
