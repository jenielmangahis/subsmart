export class TaxAgencyTable {
  constructor() {
    this.$table = $("#agencyTable");
    this.render();
  }

  render() {
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

        const $sidebar = $("#editAgency");
        const $sidebarCloseBtn = $sidebar.find("[data-action=close]");
        const closeSidebar = () => {
          $sidebar.removeClass("sidebarForm--show");
          $sidebar.off("click");
          $sidebarCloseBtn.off("click");
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
      },
    };

    const table = this.$table.DataTable({
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

    this.$table.find("tbody").on("click", ".action", async function (event) {
      const $parent = $(this).closest("tr");
      const rows = table.rows().data().toArray();

      const rowId = $parent.data("id");
      const row = rows.find(({ id }) => id == rowId);

      const action = $(this).data("action");
      await actions[action](row, table, event);
    });
  }
}
