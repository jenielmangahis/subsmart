(async () => {
  const { Accounting__DropdownWithSearch } = await import("../dropdown-with-search/dropdown-with-search.js"); // prettier-ignore
  const { TaxAgencyTable } = await import("./TaxAgencyTable.js");
  const { TaxRateTable } = await import("./TaxRateTable.js");
  const { agencies } = await import("./agencies.js");
  const { rateAgencies } = await import("./rateAgencies.js");

  const { data: savedAgencies } = await fetchAgencies();

  new TaxAgencyTable(savedAgencies);
  new TaxRateTable();

  const $sidebarTriggers = $("[data-action^=add]");
  const $settingsButton = $("#settingsButton");

  const $includeInactiveSwitch = $("#includeInactive");
  const includeInactiveKey = "nsmartrac::taxEditSettings__includeInactive";
  const includeInactive = Boolean(JSON.parse(localStorage.getItem(includeInactiveKey))); // prettier-ignore

  $settingsButton.on("click", function () {
    const $parent = $settingsButton.closest(".settings__dropdown");
    $parent.addClass("settings__dropdown--active");
  });

  $includeInactiveSwitch.prop("checked", includeInactive);
  $includeInactiveSwitch.on("change", function () {
    localStorage.setItem(includeInactiveKey, this.checked);
    window.location.reload();
  });

  const closeSidebar = ($sidebar) => {
    $sidebar.find(".form-control").val("");
    $sidebar.removeClass("sidebarForm--show");
  };

  $sidebarTriggers.on("click", function () {
    const sidebarId = $(this).attr("data-action");
    const $sidebar = $(`#${sidebarId}`);
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
  });

  const $agencySelect = $("#agencySelect");
  new Accounting__DropdownWithSearch($agencySelect, agencies);

  const $rateAgencySelect = $("#rateAgencySelect");
  let allAgencies = rateAgencies;
  if (savedAgencies.length) {
    // Disable saved agencies.
    allAgencies = allAgencies.map((currAgency) => {
      return {
        text: currAgency,
        disabled: savedAgencies.some(({ agency }) => agency === currAgency),
      };
    });

    allAgencies = [
      { text: "Saved Agencies", disabled: true },
      ...savedAgencies.map((a) => a.agency),
      ...allAgencies,
    ];
  }
  new Accounting__DropdownWithSearch($rateAgencySelect, allAgencies);

  const $addAgencyBtn = $("#addAgencyBtn");
  $addAgencyBtn.on("click", async function () {
    const $sidebar = $(this).closest(".sidebarForm");
    const $inputs = $sidebar.find("[data-type]");

    const payload = {
      start_period: `${new Date().getFullYear()}-01-01`,
    };

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

      payload[key] = value;
    }

    $(this).attr("disabled", true);
    $(this).text("Saving...");

    payload.agency = payload.agency.replaceAll(":", ", ");
    const response = await fetch(`${prefixURL}/AccountingSales/apiSaveAgency`, {
      method: "post",
      body: JSON.stringify(payload),
      headers: {
        accept: "application/json",
        "content-type": "application/json",
      },
    });

    const json = await response.json();
    window.location.reload();
  });

  const $addRateBtn = $("#addRateBtn");
  $addRateBtn.on("click", async function () {
    const $sidebar = $(this).closest(".sidebarForm");
    const $inputs = $sidebar.find("#rateSingleWrapper [data-type]");

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

      if (key === "agency") {
        const match = savedAgencies.find(({ agency }) => agency === value);
        if (match) {
          payload["agency_id"] = match.id;
        }
      }

      if ($(input).is(":radio") && !input.checked) {
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
    window.location.reload();
  });

  const $rateTypes = $("input[type=radio][name=rateType]");
  const $addRateSidebar = $("#addRate");
  const $rateCombinedWrapper = $addRateSidebar.find("#rateCombinedWrapper");
  const $rateCombinedItems = $rateCombinedWrapper.find("#rateCombinedItems");
  const $template = $rateCombinedWrapper.find("template");
  const $addCombineItem = $rateCombinedWrapper.find("#addCombinedItemBtn");

  let combinedRates = [{}];
  const template = $template.get(0).content;
  const renderCombinedRates = () => {
    const htmls = combinedRates.map((_, index) => {
      const copy = document.importNode(template, true);
      const $copy = $(copy);

      $copy.find(".rateCombined__title").text(`Rate ${index + 1}`);
      new Accounting__DropdownWithSearch(
        $copy.find(".dropdownWithSearch"),
        allAgencies
      );

      return $copy;
    });

    $rateCombinedItems.empty();
    $rateCombinedItems.append(htmls);
  };

  $rateTypes.change(function () {
    if (this.value === "combined") {
      $addRateSidebar.addClass("customRate--combined");
      renderCombinedRates();
      return;
    }

    $addRateSidebar.removeClass("customRate--combined");
    combinedRates = [{}];
  });

  $addCombineItem.on("click", function () {
    combinedRates.push({});
    renderCombinedRates();
  });
})();

window.prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";

async function fetchAgencies() {
  const includeInactive = shouldIncludeInactive();
  const endpoint = `${prefixURL}/AccountingSales/apiGetAgencies?include_inactive=${includeInactive}`;
  const response = await fetch(endpoint);
  return response.json();
}

function shouldIncludeInactive() {
  const includeInactiveKey = "nsmartrac::taxEditSettings__includeInactive";
  return Boolean(JSON.parse(localStorage.getItem(includeInactiveKey)));
}
