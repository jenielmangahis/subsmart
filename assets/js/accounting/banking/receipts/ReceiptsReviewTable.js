export class ReceiptsReviewTable {
  constructor($table) {
    this.$table = $table;

    this.loadDeps().then(() => {
      this.init();
    });
  }

  async loadDeps() {
    this.api = await import("./api.js");
  }

  get columns() {
    const $uploadPath = $("#uploadPath");
    const uploadPath = $uploadPath.val();
    const fallback = "Not Found";

    const isEmpty = (string) => {
      if (string === null) return true;
      return string.trim().length === 0;
    };

    return {
      checkbox: () => {
        return '<input type="checkbox" class="receiptsTable__checkbox" />';
      },
      receipt: (_, __, row) => {
        return `<img src="${uploadPath}/${row.receipt_img}" class="receiptsTable__img">`;
      },
      date: (_, __, row) => {
        const { transaction_date } = row;
        if (transaction_date === null) return fallback;
        if (transaction_date === "0000-00-00") return fallback;
        return transaction_date;
      },
      description: (_, __, row) => {
        return isEmpty(row.description) ? fallback : row.description;
      },
      paymentAccount: (_, __, row) => {
        return Number(row.payee_id) === 0 ? fallback : row.payee_id;
      },
      amountOrTax: (_, __, row) => {
        return Number(row.total_amount) <= 0 ? fallback : row.total_amount;
      },
      category: (_, __, row) => {
        return isEmpty(row.category) ? fallback : row.category;
      },
      actions: (_, __, row) => {
        const subOptions = {
          delete: `<li><a href="#" class="action" data-action="review">Review</a></li>`,
          makeInactive: `<li><a href="#" class="action" data-action="delete">Delete</a></li>`,
          makeActive: `<li><a href="#" class="action" data-action="findMatch">Find Match</a></li>`,
        };

        return `
            <div class="receiptsTable__actions">
              <a class="receiptsTable__link action" href="#" data-action="reateExpense">
                Create Expense
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
  }

  async init() {
    const { data } = await this.api.fetchReceipts();
    const table = this.$table.DataTable({
      filter: false,
      data,
      columns: [
        {
          render: this.columns.checkbox,
          class: "receiptsTable__selectColumn",
        },
        {
          render: this.columns.receipt,
        },
        {
          render: this.columns.date,
        },
        {
          render: this.columns.description,
        },
        {
          render: this.columns.paymentAccount,
        },
        {
          render: this.columns.amountOrTax,
        },
        {
          render: this.columns.category,
        },
        {
          render: this.columns.actions,
        },
      ],
      rowId: (row) => `row${row.id}`,
      createdRow: (row, data) => {
        $(row).attr("data-id", data.id);
        $(row).addClass("receiptsTable__row");
      },
    });

    table.on("mouseover", ".receiptsTable__img", (event) => {
      $(".receiptsTable__preview").remove();

      const { target: $target } = event;
      const { top, left } = $target.getBoundingClientRect();
      const adjustedLeft = left + $target.width + 16;
      const $preview = $(`
        <div class="receiptsTable__preview" style="top:${top}px;left:${adjustedLeft}px;">
          <img src="${event.target.src}" />
        </div>
      `);

      $preview.appendTo("body");
    });

    table.on("mouseleave", ".receiptsTable__img", () => {
      $(".receiptsTable__preview").remove();
    });

    table.on("click", "th .receiptsTable__checkbox", (event) => {
      const isChecked = event.target.checked;
      const rows = table.rows({ search: "applied" }).nodes();
      $("input[type=checkbox]", rows).prop("checked", isChecked);

      const func = isChecked ? "addClass" : "removeClass";
      $(rows)[func]("receiptsTable__row--selected");
      this.onCheckboxStateChange();
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
