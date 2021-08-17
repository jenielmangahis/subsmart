(async () => {
  const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";
  const { Accounting__DropdownWithSearch } = await import("../tax/dropdown-with-search/dropdown-with-search.js"); // prettier-ignore
  const { rateAgencies } = await import("../tax/settings/rateAgencies.js");

  const $taxRateSelect = $("#invoiceTaxRate");
  const $sidebar = $("#addRateSidebar");

  const showCustomRateOptions = (options) => {
    options.forEach(({ id, name, rate }) => {
      $taxRateSelect.append(
        `<option data-id="${id}" value="${id}">${name} (${rate}%)</option>`
      );
    });
    $taxRateSelect.prop("disabled", false);
  };

  const closeSidebar = () => {
    $sidebar.find(".form-control").val("");
    $sidebar.removeClass("sidebarForm--show");
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
    closeSidebar();
  });

  const showAddRateSidebar = () => {
    const $sidebarCloseBtn = $sidebar.find("[data-action=close]");

    $sidebar.addClass("sidebarForm--show");

    $sidebarCloseBtn.on("click", () => {
      closeSidebar($sidebar);
    });

    $sidebar.on("click", (event) => {
      if ($sidebar.is(event.target)) {
        closeSidebar($sidebar);
      }
    });
  };

  $taxRateSelect.on("change", function () {
    const { value } = this;
    if (value === "add_custom") {
      showAddRateSidebar();
    }
  });
})();

async function fetchCustomRates() {
  const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";
  const response = await fetch(`${prefixURL}/AccountingSales/apiGetRates`);
  return response.json();
}
