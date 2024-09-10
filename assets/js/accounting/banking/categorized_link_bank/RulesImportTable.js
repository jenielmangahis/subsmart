export class RulesImportTable {
  _onCheckboxChange = null;

  constructor($table) {
    this.$table = $($table);
  }

  set onCheckboxChange(func) {
    this._onCheckboxChange = func;
  }

  render(data) {
    const columns = {
      checkbox: () => {
        return '<input type="checkbox" class="rulesTable__checkbox" />';
      },
      name: (_, __, row) => {
        return row["Rule Name"];
      },
      for: (_, __, row) => {
        return "Money out";
      },
      conditions: (_, __, row) => {
        const conditionsArray = row["Rule Conditions"];
        const conditions = conditionsArray.map((condition) => {
          const { type, equation, value } = condition;
          const text = `${type} ${equation.toLowerCase()} "${value}"`;
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
        const assignmentsArray = row["Rule Outputs"];
        const assignments = assignmentsArray.map((assignment) => {
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
        return "";
      },
    };

    const handleFirstRender = () => {
      const $rows = this.$table.find("tr");

      $rows.each((_, $row) => {
        const $checkbox = $row.querySelector("[type=checkbox]");
        $checkbox.checked = true;
        if (!$checkbox.classList.contains("rulesTable__checkbox--primary")) {
          $row.classList.add("rulesTable__row--selected");
        }
      });
    };

    const table = this.$table.on("draw.dt", handleFirstRender).DataTable({
      destroy: true,
      searching: false,
      data,
      columns: [
        {
          sortable: false,
          render: columns.checkbox,
          targets: 0,
          class: "rulesTable__selectColumn",
        },
        {
          sortable: false,
          render: columns.name,
        },
        {
          sortable: false,
          render: columns.for,
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
      ],
    });

    this.table = table;

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
  }

  onCheckboxStateChange() {
    const $rows = this.$table.find("tbody [role=row]");
    const $selected = this.$table.find(".rulesTable__row--selected");
    const $mainCheckbox = this.$table.find("th .rulesTable__checkbox").get(0);

    if ($selected.length === $rows.length) {
      $mainCheckbox.indeterminate = false;
      $mainCheckbox.checked = true;
    } else if ($selected.length >= 1) {
      $mainCheckbox.indeterminate = true;
    } else {
      $mainCheckbox.indeterminate = false;
      $mainCheckbox.checked = false;
    }

    if (typeof this._onCheckboxChange === "function") {
      this._onCheckboxChange();
    }
  }
}
