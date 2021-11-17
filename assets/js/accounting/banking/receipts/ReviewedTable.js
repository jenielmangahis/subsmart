export class ReviewedTable {
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
      amountOrTax: (_, __, row) => {
        return Number(row.total_amount) <= 0 ? fallback : row.total_amount;
      },
      linkedRecord: () => {
        return fallback;
      },
      actions: () => {
        return `<a class="receiptsTable__link action" href="#" data-action="undoAdd">Undo add</a>`;
      },
    };
  }

  get actions() {
    return {
      undoAdd: async ({ id }) => {
        await this.api.editReceipt(id, { to_expense: 0 });
        window.location.reload();
      },
    };
  }

  async init() {
    const { data } = await this.api.fetchReceipts(true);
    const table = this.$table.DataTable({
      filter: false,
      data,
      columns: [
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
          render: this.columns.amountOrTax,
        },
        {
          render: this.columns.linkedRecord,
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

    table.on("click", ".action", async (event) => {
      event.preventDefault();

      const $target = $(event.target);
      const $parent = $target.closest("tr");
      const rows = table.rows().data().toArray();

      const rowId = $parent.data("id");
      const row = rows.find(({ id }) => id == rowId);

      const action = $target.data("action");
      const func = this.actions[action].bind(this);

      if (!func) return;
      func(row, table, event);
    });
  }
}
