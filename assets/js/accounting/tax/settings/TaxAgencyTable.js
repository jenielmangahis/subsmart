export class TaxAgencyTable {
  constructor() {
    this.$table = $("#agencyTable");
    this.render();
  }

  render() {
    const columns = {
      agency: (_, __, row) => {
        const isActive = row.is_active === "1";
        return `<span>${row.agency} ${!isActive ? "(inactive)" : ""}</span>`;
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
        if (row.is_active !== "1") {
          return `
            <button data-action="makeActive" type="button" class="btn btn-sm btnGroup__main action">Make active</button>
          `;
        }

        return `
            <div class="btn-group btnGroup">
                <button data-action="edit" type="button" class="btn btn-sm btnGroup__main action">Edit</button>
                <button type="button" class="btn btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu">
                    <a data-action="makeInactive" class="dropdown-item action" href="#">Make inactive</a>
                </div>
            </div>
        `;
      },
    };

    const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";
    const includeInactive = this.shouldIncludeInactive();

    const actions = {
      edit: (row) => {
        row.start_period = moment(row.start_period).format("MMMM");
        row.start_date = moment(row.start_date).format("YYYY-MM-DD");

        const $sidebar = $("#editAgency");
        const $sidebarCloseBtn = $sidebar.find("[data-action=close]");
        const $sidebarSaveBtn = $sidebar.find("#editAgencyBtn");
        const $editAgencyInactiveBtn = $sidebar.find("#editAgencyInactiveBtn");

        const closeSidebar = () => {
          $sidebar.removeClass("sidebarForm--show");
          $sidebar.off("click");
          $sidebarCloseBtn.off("click");
          $sidebarSaveBtn.off("click");
          $editAgencyInactiveBtn.off("click");
        };

        const $data = $sidebar.find("[data-type]");
        $data.each((_, element) => {
          element.value = row[element.dataset.type];
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

        $sidebarSaveBtn.on("click", async function () {
          const $inputs = $sidebar.find("[data-type]");
          const payload = { ...row };

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

          payload.start_period = `${new Date().getFullYear()}-01-01`;

          $(this).attr("disabled", true);
          $(this).text("Saving...");

          const response = await fetch(
            `${prefixURL}/AccountingSales/apiEditAgency/${row.id}`,
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

        $editAgencyInactiveBtn.on("click", async function () {
          $(this).attr("disabled", true);
          await actions.makeInactive(row);
        });
      },
      makeInactive: async (row) => {
        const result = await Swal.fire({
          title: `Change ${row.agency} to inactive`,
          text: "Are you sure you want to make this tax agency inactive? This means that you'll stop collecting tax for it.",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Make inactive",
        });

        if (!result.isConfirmed) {
          return;
        }

        const payload = { ...row, is_active: 0 };
        payload.start_period = `${new Date().getFullYear()}-01-01`;

        const response = await fetch(
          `${prefixURL}/AccountingSales/apiEditAgency/${row.id}`,
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
      },
      makeActive: async (row) => {
        const payload = { ...row, is_active: 1 };
        payload.start_period = `${new Date().getFullYear()}-01-01`;

        const response = await fetch(
          `${prefixURL}/AccountingSales/apiEditAgency/${row.id}`,
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
      },
    };

    const table = this.$table.DataTable({
      searching: false,
      ajax: `${prefixURL}/AccountingSales/apiGetAgencies?include_inactive=${includeInactive}`,
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
        if (data.is_active !== "1") {
          $(row).addClass("row--inactive");
        }
      },
    });

    this.$table.find("tbody").on("click", ".action", async function (event) {
      event.preventDefault();

      const $parent = $(this).closest("tr");
      const rows = table.rows().data().toArray();

      const rowId = $parent.data("id");
      const row = rows.find(({ id }) => id == rowId);

      const action = $(this).data("action");
      const func = actions[action];

      if (!func) return;
      await actions[action](row, table, event);
    });
  }

  shouldIncludeInactive() {
    const includeInactiveKey = "nsmartrac::taxEditSettings__includeInactive";
    return Boolean(JSON.parse(localStorage.getItem(includeInactiveKey)));
  }
}
