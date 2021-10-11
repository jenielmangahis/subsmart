export class RulesTable {
  constructor($table) {
    this.$table = $table;

    this.loadDeps().then(() => {
      this.setUpTable();
    });
  }

  async loadDeps() {
    this.api = await import("./api.js");
  }

  setUpTable() {
    console.clear();

    const actions = {
      makeActive: async ({ id }) => {
        await this.api.editRate(id, { is_active: 1 });
        window.location.reload();
      },
      makeInactive: async ({ id }) => {
        await this.api.editRate(id, { is_active: 0 });
        window.location.reload();
      },
    };

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
      appliedTo: (_, __, row) => {
        const text = row.banks === "1" ? "All accounts" : "Checking";
        return `<span class="rulesTable__applied">${text}</span>`;
      },
      conditions: (_, __, row) => {
        const conditions = row.conditions.map((condition) => {
          const { description, contain, comment } = condition;
          const text = `${description} ${contain.toLowerCase()} "${comment}"`;
          return text.replace(/'/g, "&#39;");
        });

        const conditionString = conditions.join(", and ");
        return `
          <span class="rulesTable__conditions" title='${conditionString}'>
            ${conditionString}
          </span>
        `;
      },
      settings: (_, __, row) => {
        if (!row.assignments.length) {
          return "—";
        }

        const assignments = row.assignments.map((assignment) => {
          const { type, value } = assignment;
          const text = `Set ${type} to "${value}"`;
          return text.replace(/'/g, "&#39;");
        });

        const assignmentString = assignments.join(", and ");
        return `
          <span class="rulesTable__assignments" title='${assignmentString}'>
            ${assignmentString}
          </span>
        `;
      },
      autoAdd: () => {
        return `
          <div class="rulesTable__autoAdd">
            <button class="rulesTable__autoAddBtn">
              <i class="fa fa-plus-square"></i>
            </button>
          </div>
        `;
      },
      status: (_, __, row) => {
        const status = row.is_active === "1" ? "Active" : "Inactive";
        return `<span>${status}</span>`;
      },
      actions: (_, __, row) => {
        const subOptions = {
          delete: `<li><a href="#" id="deleteRules" data-id="${row.id}">Delete</a></li>`,
          makeInactive: `<li><a href="#" class="action" data-action="makeInactive">Disable</a></li>`,
          makeActive: `<li><a href="#" class="action" data-action="makeActive">Enable</a></li>`,
        };

        delete subOptions[
          row.is_active === "1" ? "makeActive" : "makeInactive"
        ];

        return `
          <div class="rulesTable__actions">
            <a
              class="rulesTable__link"
              href="${this.api.prefixURL}/accounting/edit_rules?id=${row.id}"
            >
              View/Edit
            </a>

            <div class="dropdown">
                <span class="fa fa-chevron-down" data-toggle="dropdown"></span>
                <ul class="dropdown-menu dropdown-menu-right">
                    ${Object.values(subOptions).join("")}
                </ul>
            </div>
          </div>
        `;
      },
    };

    const table = this.$table.DataTable({
      searching: true,
      ajax: {
        url: `${this.api.prefixURL}/AccountingRules/apiGetRules`,
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
          class: "rulesTable__conditionsColumn",
        },
        {
          sortable: false,
          render: columns.settings,
          class: "rulesTable__assignmentsColumn",
        },
        {
          sortable: false,
          render: columns.autoAdd,
          class: "rulesTable__autoAddColumn",
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
      createdRow: (row, data) => {
        $(row).attr("data-id", data.id);
      },
    });

    table.on("click", "th .rulesTable__checkbox", function () {
      const rows = table.rows({ search: "applied" }).nodes();
      $("input[type=checkbox]", rows).prop("checked", this.checked);

      $(rows)[this.checked ? "addClass" : "removeClass"](
        "rulesTable__row--selected"
      );
    });

    table.on(
      "change",
      "[role=row] .rulesTable__checkbox:not(.rulesTable__checkbox--primary)",
      function () {
        const $parent = $(this).closest("tr");

        if (this.checked) {
          $parent.addClass("rulesTable__row--selected");
          return;
        }

        const $table = $(this.closest("table"));
        const $mainCheckbox = $table.find("th .rulesTable__checkbox").get(0);
        $mainCheckbox.indeterminate = true;
        $parent.removeClass("rulesTable__row--selected");
      }
    );

    table.on("click", ".action", async (event) => {
      event.preventDefault();

      const $target = $(event.target);
      const $parent = $target.closest("tr");
      const rows = table.rows().data().toArray();

      const rowId = $parent.data("id");
      const row = rows.find(({ id }) => id == rowId);

      const action = $target.data("action");
      const func = actions[action].bind(this);

      if (!func) return;
      await actions[action](row, table, event);
    });
  }
}
