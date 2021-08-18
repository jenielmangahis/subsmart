(async () => {
  // Some functions are from from /assets/js/custom.js.

  const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";
  const { Accounting__DropdownWithSearch } = await import("../tax/dropdown-with-search/dropdown-with-search.js"); // prettier-ignore
  const { rateAgencies } = await import("../tax/settings/rateAgencies.js");

  const $taxRateSelect = $("#invoiceTaxRate");
  const taxRateDefault = $taxRateSelect.find("[default]").val();
  const $sidebar = $("#addRateSidebar");
  const $taxDisplay = $("#total_tax_");

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

  const closeSidebar = (value = null) => {
    $sidebar.find(".form-control").val("");
    $sidebar.removeClass("sidebarForm--show");
    $taxRateSelect.val(value ? value : taxRateDefault);

    if (value === null) {
      $taxDisplay.text(calculateInvoiceTax());
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
      $taxDisplay.text(calculateInvoiceTax());
      return;
    }

    const price = calculateInvoicePrice();
    const customRate = customRates.find((rate) => rate.id == value);
    const taxValue = numberWithDecimal((Number(customRate.rate) / 100) * price);
    $taxDisplay.text(taxValue);
  });
})();

async function fetchCustomRates() {
  const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";
  const response = await fetch(`${prefixURL}/AccountingSales/apiGetRates`);
  return response.json();
}
