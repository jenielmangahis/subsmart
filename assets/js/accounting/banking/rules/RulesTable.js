export class RulesTable {
  constructor($table) {
    this.$table = $table;

    this.$batchActions = $("#batchActions");
    this.$batchActionsBtn = this.$batchActions.find(".btn");

    this.loadDeps().then(() => {
      this.setUpTable();
    });
  }

  async loadDeps() {
    this.api = await import("./api.js");
  }

  setUpTable() {
    const actions = {
      makeActive: async ({ id }) => {
        await this.api.editRule(id, { is_active: 1 });
        window.location.reload();
      },
      makeInactive: async ({ id }) => {
        await this.api.editRule(id, { is_active: 0 });
        window.location.reload();
      },
      batchMakeActive: async (ids) => {
        await this.api.batchEditRule(ids, { is_active: 1 });
        window.location.reload();
      },
      batchMakeInactive: async (ids) => {
        await this.api.batchEditRule(ids, { is_active: 0 });
        window.location.reload();
      },
      batchDelete: async (ids) => {
        const response = await Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ca01c",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete!",
        });

        if (!response.isConfirmed) return;

        await this.api.batchDeleteRule(ids);
        window.location.reload();
      },
    };

    const columns = {
      drag: () => {
        return `
          <button class="rulesTable__drag"></button>
        `;
      },
      checkbox: () => {
        return '<input type="checkbox" class="rulesTable__checkbox" />';
      },
      priority: (_, __, row) => {
        return Number(row.priority) + 1;
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
      rowReorder: {
        snapX: true,
        dataSrc: "priority",
        selector: ".rulesTable__drag",
      },
      ajax: {
        url: `${this.api.prefixURL}/AccountingRules/apiGetRules`,
      },
      columns: [
        {
          sortable: false,
          orderable: true,
          render: columns.drag,
          class: "rulesTable__dragColumn",
        },
        {
          sortable: false,
          orderable: true,
          render: columns.checkbox,
          targets: 0,
          class: "rulesTable__selectColumn",
        },
        {
          sortable: true,
          orderable: true,
          render: columns.priority,
        },
        {
          sortable: false,
          orderable: true,
          render: columns.name,
        },
        {
          sortable: false,
          orderable: true,
          render: columns.appliedTo,
        },
        {
          sortable: false,
          orderable: true,
          render: columns.conditions,
          class: "rulesTable__conditionsColumn",
        },
        {
          sortable: false,
          orderable: true,
          render: columns.settings,
          class: "rulesTable__assignmentsColumn",
        },
        {
          sortable: false,
          orderable: true,
          render: columns.autoAdd,
          class: "rulesTable__autoAddColumn",
        },
        {
          sortable: false,
          orderable: true,
          render: columns.status,
        },
        {
          sortable: false,
          orderable: true,
          render: columns.actions,
        },
      ],
      rowId: (row) => `row${row.id}`,
      createdRow: (row, data) => {
        $(row).attr("data-id", data.id);
      },
    });

    this.$batchActions.on("click", ".dropdown-item", async (event) => {
      const $target = $(event.target);
      const action = $target.data("action");
      const func = actions[action];

      if (!func) return;

      const $selected = this.$table.find(".rulesTable__row--selected");
      const ids = [...$selected].map((row) => row.dataset.id);
      await actions[action](ids);
    });

    table.on("click", "th .rulesTable__checkbox", (event) => {
      const isChecked = event.target.checked;
      const rows = table.rows({ search: "applied" }).nodes();
      $("input[type=checkbox]", rows).prop("checked", isChecked);

      const func = isChecked ? "addClass" : "removeClass";
      $(rows)[func]("rulesTable__row--selected");
      this.onCheckboxStateChange();
    });

    table.on(
      "change",
      "[role=row] .rulesTable__checkbox:not(.rulesTable__checkbox--primary)",
      (event) => {
        const $parent = $(event.target).closest("tr");

        if (event.target.checked) {
          $parent.addClass("rulesTable__row--selected");
        } else {
          $parent.removeClass("rulesTable__row--selected");
        }

        this.onCheckboxStateChange();
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

    let isReordering = false;
    table.on("row-reorder.dt", async () => {
      if (isReordering) return;

      isReordering = true;
      const tableData = table.data().toArray();
      const updates = tableData.map(({ id, priority }) => ({ id, priority }));

      await this.api.editRulePriorities(updates);
      isReordering = false;
    });
  }

  onCheckboxStateChange() {
    const $rows = this.$table.find("tr[data-id]");
    const $selected = this.$table.find(".rulesTable__row--selected");
    const $mainCheckbox = this.$table.find("th .rulesTable__checkbox").get(0);

    if ($selected.length === 0) {
      this.$batchActions.addClass("d-none");
    } else {
      this.$batchActions.removeClass("d-none");
    }

    if ($selected.length === $rows.length) {
      $mainCheckbox.indeterminate = false;
      $mainCheckbox.checked = true;
      return;
    }

    if ($selected.length >= 1) {
      $mainCheckbox.indeterminate = true;
      return;
    }

    $mainCheckbox.indeterminate = false;
    $mainCheckbox.checked = false;
  }
}
