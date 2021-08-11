(async () => {
  const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";
  const $sidebarTriggers = $("[data-action]");

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

  const { agencies } = await import("./agencies.js");
  const $agencySelect = $("#agencySelect");
  new Accounting__DropdownWithSearch($agencySelect, agencies);

  const $saveAgency = $("#saveAgency");
  $saveAgency.on("click", async function () {
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

    const response = await fetch(`${prefixURL}/AccountingSales/apiSaveAgency`, {
      method: "post",
      body: JSON.stringify(payload),
      headers: {
        accept: "application/json",
        "content-type": "application/json",
      },
    });

    const json = await response.json();
    $(this).attr("disabled", false);
    $(this).text("Save");
    closeSidebar($sidebar);
  });
})();
