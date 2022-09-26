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
        disabled: savedAgencies.some(({ name }) => name === currAgency),
      };
    });

    allAgencies = [
      { text: "Saved Agencies", disabled: true },
      ...savedAgencies.map((a) => a.name),
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

    payload.name = payload.name.replaceAll(":", ", ");
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

    if (!$sidebar.hasClass("customRate--combined")) {
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
      return;
    }

    const $inputs = $sidebar.find("#rateCombinedWrapper [data-type]");
    for (let index = 0; index < $inputs.length; index++) {
      const input = $inputs[index];
      const value = input.value;

      const $input = $(input);
      const $formGroup = $input.closest(".form-group");

      $formGroup.removeClass("form-group--error");
      if (!value) {
        $formGroup.addClass("form-group--error");
        $input.focus();
        return;
      }
    }

    const $items = $("#rateCombinedItems .rateCombined");
    const items = [];
    const name = $("#rateCombinedWrapper [data-type=name]").val();
    $items.each((_, itemEl) => {
      const item = {};
      const $inputs = $(itemEl).find("[data-type]");

      for (let index = 0; index < $inputs.length; index++) {
        const input = $inputs[index];
        const { value } = input;
        const { type: key } = input.dataset;

        if (key === "agency") {
          const match = savedAgencies.find(({ agency }) => agency === value);
          if (match) {
            item["agency_id"] = match.id;
            continue;
          }
        }

        item[key] = value;
      }

      items.push(item);
    });

    $(this).attr("disabled", true);
    $(this).text("Saving...");

    const response = await fetch(`${prefixURL}/AccountingSales/apiSaveRate`, {
      method: "post",
      body: JSON.stringify({ rates: items, name }),
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
    const htmls = combinedRates.map((data, index, array) => {
      const copy = document.importNode(template, true);
      const $copy = $(copy);
      const $inputs = $copy.find("input");

      $copy.find(".rateCombined__title").text(`Rate ${index + 1}`);
      new Accounting__DropdownWithSearch(
        $copy.find(".dropdownWithSearch"),
        allAgencies
      );

      $copy.find(".rateCombined__btn--delete").on("click", function () {
        combinedRates = combinedRates.filter((_, i) => i !== index);
        renderCombinedRates();
      });

      $inputs.each((_, element) => {
        element.value = data[element.dataset.type] || "";
      });

      $inputs.on("change", function (event) {
        combinedRates = combinedRates.map((d, i) => {
          if (i !== index) return d;
          return { ...d, [event.target.dataset.type]: event.target.value };
        });
      });

      if (array.length <= 2) {
        $copy.find(".rateCombined").addClass("rateCombined--noDelete");
      }

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

  const $rateCombinedExampleToggle = $(".rateCombined__exampleToggle button");
  const $rateCombinedExample = $(".rateCombined__example");
  $rateCombinedExampleToggle.on("click", function () {
    if ($rateCombinedExample.hasClass("rateCombined__example--show")) {
      $rateCombinedExample.removeClass("rateCombined__example--show");
      $(this).text("Show example");
    } else {
      $rateCombinedExample.addClass("rateCombined__example--show");
      $(this).text("Hide example");
    }
  });
})();

window.prefixURL = "";

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
