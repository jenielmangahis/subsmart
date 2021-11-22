export class ForReviewTable {
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
        return moment(transaction_date).format("MM/DD/YYYY");
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

        let primaryOption = `
          <a class="receiptsTable__link action" href="#" data-action="createExpense">
            Create Expense
          </a>
        `;

        if (
          isEmpty(row.transaction_date) &&
          isEmpty(row.description) &&
          isEmpty(row.__select2_bank_account) &&
          isEmpty(row.total_amount) &&
          isEmpty(row.__select2_category)
        ) {
          primaryOption = `
            <a class="receiptsTable__link action" href="#" data-action="review">
              Review
            </a>
          `;

          delete subOptions.makeInactive;
          delete subOptions.makeActive;
        }

        return `
            <div class="receiptsTable__actions">
              ${primaryOption}

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

  get actions() {
    return {
      review: (row) => {
        this.actions.view(row);
      },
      delete: async ({ id }) => {
        const { isConfirmed } = await Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ca01c",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!",
        });

        if (!isConfirmed) return;
        await this.api.deleteReceipt(id);
        window.location.reload();
      },
      findMatch: () => {},
<<<<<<< HEAD
=======
      view: (row) => {
        const $modal = $("#receiptModal");
        const $dataTypes = $modal.find("[data-type]");

        const $image = $modal.find("#receiptImage");
        $image.attr("src", `${this.uploadPath}${row.receipt_img}`);

        const $createdAt = $modal.find("#receiptImageCreatedAt");
        const createdAt = moment(row.created_at).format("hh:mm A MM/DD/YYYY");
        $createdAt.text(`Added ${createdAt}`);

        for (let index = 0; index < $dataTypes.length; index++) {
          const $element = $dataTypes[index];
          const { type } = $element.dataset;

          if (!row.hasOwnProperty(type)) {
            continue;
          }

          let value = row[type];
          if (type === "transaction_date") {
            value = moment(value).format("YYYY-MM-DD");
          }

          if ($element.classList.contains("select2-hidden-accessible")) {
            $($element).find("option:not(:first-child)").remove(); // remove appended options
            $($element).val("").trigger("change"); // reset value

            if (type === "payee" && row.__select2_payee) {
              const { __select2_payee: payee } = row;
              const $option = `<option value="${payee.value}" selected="selected">${payee.text}</option>`;
              $($element).append($option);
            }

            if (type === "bank_account_id" && row.__select2_bank_account) {
              const { __select2_bank_account: account } = row;
              const $option = `<option value="${account.value}" selected="selected">${account.text}</option>`;
              $($element).append($option);
            }

            if (type === "category_id" && row.__select2_category) {
              const { __select2_category: category } = row;
              const $option = `<option value="${category.value}" selected="selected">${category.text}</option>`;
              $($element).append($option);
            }
          }

          $element.value = value;
        }

        $modal.modal("show");
      },
>>>>>>> staging
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
