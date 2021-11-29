export class SearchedReceiptsTable {
  constructor($table, data) {
    this.$table = $table;
    this.data = data;

    const $mainCheckbox = this.$table
      .find("th .receiptsTable__checkbox")
      .get(0);
    $mainCheckbox.indeterminate = false;
    $mainCheckbox.checked = false;

    this.init();
  }

  get columns() {
    const fallback = "Not Found";
    return {
      checkbox: () => {
        return '<input type="checkbox" class="receiptsTable__checkbox" />';
      },
      type: (_, __, row) => {
        return row.type ? row.type : fallback;
      },
      date: (_, __, row) => {
        const { payment_date } = row;
        if (payment_date === null) return fallback;
        if (payment_date === "0000-00-00") return fallback;
        return moment(payment_date).format("MM/DD/YYYY");
      },
      payee: (_, __, row) => {
        const { __select2_payee: payee } = row;
        return payee ? payee.text : fallback;
      },
      paymentAccount: (_, __, row) => {
        const { __select2_account: account } = row;
        return account ? account.text : fallback;
      },
      transactionAmount: (_, __, row) => {
        return accounting.formatMoney(row.total_amount);
      },
    };
  }

  async init() {
    const table = this.$table.DataTable({
      iDisplayLength: -1,
      bLengthChange: false,
      bDestroy: true,
      bPaginate: false,
      filter: false,
      data: this.data,
      columns: [
        {
          render: this.columns.checkbox,
          class: "receiptsTable__selectColumn",
        },
        {
          render: this.columns.date,
        },
        {
          render: this.columns.type,
        },
        {
          render: this.columns.payee,
        },
        {
          render: this.columns.paymentAccount,
        },
        {
          render: this.columns.transactionAmount,
        },
      ],
      rowId: (row) => `row${row.id}`,
      createdRow: (row, data) => {
        $(row).attr("data-id", data.id);
        $(row).addClass("receiptsTable__row");
      },
    });

    table.on("click", "th .receiptsTable__checkbox", (event) => {
      const isChecked = event.target.checked;
      const rows = table.rows({ search: "applied" }).nodes();
      $("input[type=checkbox]", rows).prop("checked", isChecked);

      const func = isChecked ? "addClass" : "removeClass";
      $(rows)[func]("receiptsTable__row--selected");
      this.onCheckboxStateChange();
    });

    table.on("click", ".receiptsTable__row", (event) => {
      const { target: $target } = event;
      if ($target.classList.contains("receiptsTable__checkbox")) return;
      if ($target.classList.contains("receiptsTable__selectColumn")) return;
      if ($target.classList.contains("action")) return;

      const $parent = $($target).closest("tr");
      const rowId = $parent.data("id");
      const rows = table.rows().data().toArray();
      const row = rows.find(({ id }) => id == rowId);
      this.actions.view(row, rows);
    });

    table.on(
      "change",
      "[role=row] .receiptsTable__checkbox:not(.receiptsTable__checkbox--primary)",
      (event) => {
        const $parent = $(event.target).closest("tr");

        if (event.target.checked) {
          $parent.addClass("receiptsTable__row--selected");
        } else {
          $parent.removeClass("receiptsTable__row--selected");
        }

        this.onCheckboxStateChange();
      }
    );
  }

  onCheckboxStateChange() {
    const $rows = this.$table.find("tr[data-id]");
    const $selected = this.$table.find(".receiptsTable__row--selected");
    const $mainCheckbox = this.$table
      .find("th .receiptsTable__checkbox")
      .get(0);

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
