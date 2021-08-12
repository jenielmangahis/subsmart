const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";

(async () => {
  const $sidebarTriggers = $("[data-action^=add]");

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

  const { rateAgencies } = await import("./rateAgencies.js");
  const $rateAgencySelect = $("#rateAgencySelect");
  new Accounting__DropdownWithSearch($rateAgencySelect, rateAgencies);

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
    window.location.reload();
    // $(this).attr("disabled", false);
    // $(this).text("Save");
    // closeSidebar($sidebar);
  });

  (function Accounting__TaxEditSettings() {
    const $table = $("#agencyTable");

    const columns = {
      agency: (_, __, row) => {
        return `<span>${row.agency}</span>`;
      },
      fillingFrequency: (_, __, row) => {
        return `<span class="text-capitalize">${row.frequency}</span>`;
      },
      startOfTaxPeriod: (_, __, row) => {
        return `<span>${moment(row.start_period).format("MMMM")}</span>`;
      },
      startDate: (_, __, row) => {
        return `<span>${moment(row.start_date).format("MM/DD/YYYY")}</span>`;
      },
      actions: (_, __, row) => {
        return `
          <div class="btn-group btnGroup">
              <button data-action="edit" type="button" class="btn btn-sm btnGroup__main action">Edit</button>
              <button type="button" class="btn btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="sr-only">Toggle Dropdown</span>
              </button>
              <div class="dropdown-menu">
                  <a class="dropdown-item action" href="#">Make inactive</a>
              </div>
          </div>
        `;
      },
    };

    const actions = {
      edit: (row) => {
        row.start_period = moment(row.start_period).format("MMMM");
        row.start_date = moment(row.start_date).format("YYYY-MM-DD");

        const $sidebar = $("#agencyInfo");
        const $sidebarCloseBtn = $sidebar.find("[data-action=close]");
        const closeSidebar = () => {
          $sidebar.removeClass("sidebarForm--show");
          $sidebar.off("click");
          $sidebarCloseBtn.off("click");
        };

        const $data = $sidebar.find("[data-type]");
        $data.each((_, element) => {
          const key = element.dataset.type;
          const value = row[element.dataset.type];
          if (key === "agency") {
            element.textContent = value;
          } else {
            element.value = value;
          }
        });

        $sidebar.addClass("sidebarForm--show");

        $sidebarCloseBtn.on("click", () => {
          closeSidebar();
        });

        $sidebar.on("click", (event) => {
          if ($sidebar.is(event.target)) {
            closeSidebar();
          }
        });
      },
    };

    const table = $table.DataTable({
      searching: false,
      ajax: `${prefixURL}/AccountingSales/apiGetAgencies`,
      columns: [
        {
          sortable: false,
          render: columns.agency,
        },
        {
          sortable: false,
          render: columns.fillingFrequency,
        },
        {
          sortable: false,
          render: columns.startOfTaxPeriod,
        },
        {
          sortable: false,
          render: columns.startDate,
        },
        {
          sortable: false,
          render: columns.actions,
        },
      ],
      rowId: function (row) {
        return `row${row.id}`;
      },
      createdRow: function (row, data) {
        $(row).attr("data-id", data.id);
      },
    });

    $table.find("tbody").on("click", ".action", async function (event) {
      const $parent = $(this).closest("tr");
      const rows = table.rows().data().toArray();

      const rowId = $parent.data("id");
      const row = rows.find(({ id }) => id == rowId);

      const action = $(this).data("action");
      await actions[action](row, table, event);
    });
  })();
})();
