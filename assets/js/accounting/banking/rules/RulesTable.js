window.prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";

export class RulesTable {
  constructor($table) {
    this.$table = $table;
    this.setUpTable();
  }

  setUpTable() {
    const columns = {
      checkbox: () => {
        return '<input type="checkbox" class="rulesTable__checkbox" />';
      },
      priority: (_, __, ___, meta) => {
        return meta.row + 1;
      },
      name: (_, __, row) => {
        return row.rules_name;
      },
      appliedTo: () => {
        return "appliedTo";
      },
      conditions: () => {
        return "conditions";
      },
      settings: () => {
        return "settings";
      },
      autoAdd: () => {
        return "autoAdd";
      },
      status: () => {
        return "status";
      },
      actions: (_, __, row) => {
        return `
            <div class="rulesTable__actions">
                <a
                    href="${window.prefixURL}/accounting/edit_rules?id=${row.id}"
                    class="rulesTable__link">
                    View/Edit
                </a>

                <div class="dropdown">
                    <span class="fa fa-chevron-down" data-toggle="dropdown"></span>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="#" id="deleteRules" data-id="${row.id}">Delete</a></li>
                    </ul>
                </div>
            </div>
        `;
      },
    };

    const table = this.$table.DataTable({
      searching: true,
      ajax: {
        url: `${window.prefixURL}/AccountingRules/apiGetRules`,
      },
      columns: [
        {
          sortable: false,
          render: columns.checkbox,
          targets: 0,
          class: "rulesTable__selectColumn",
        },
        {
          sortable: true,
          render: columns.priority,
        },
        {
          sortable: false,
          render: columns.name,
        },
        {
          sortable: false,
          render: columns.appliedTo,
        },
        {
          sortable: false,
          render: columns.conditions,
        },
        {
          sortable: false,
          render: columns.settings,
        },
        {
          sortable: false,
          render: columns.autoAdd,
        },
        {
          sortable: false,
          render: columns.status,
        },
        {
          sortable: false,
          render: columns.actions,
        },
      ],
      rowId: (row) => `row${row.id}`,
    });

    table.on("click", "th .rulesTable__checkbox", function () {
      const rows = table.rows({ search: "applied" }).nodes();
      $("input[type=checkbox]", rows).prop("checked", this.checked);
    });

    table.on("change", "[role=row] .rulesTable__checkbox", function () {
      if (this.checked) return;
      const $table = $(this.closest("table"));
      const $mainCheckbox = $table.find("th .rulesTable__checkbox").get(0);
      $mainCheckbox.indeterminate = true;
    });
  }
}
