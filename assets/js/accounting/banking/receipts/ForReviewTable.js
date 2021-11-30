export class ForReviewTable {
  constructor($table) {
    this.$table = $table;
    const $uploadPath = $("#uploadPath");
    this.uploadPath = $uploadPath.val();

    this.loadDeps().then(() => {
      this.init();
    });
  }

  async loadDeps() {
    this.api = await import("./api.js");
    this.utils = await import("./utils.js");
  }

  get columns() {
    const fallback = "Not Found";

    const isEmpty = (string) => {
      if (typeof string !== "string") return true;
      return string.trim().length === 0;
    };

    return {
      checkbox: () => {
        return '<input type="checkbox" class="receiptsTable__checkbox" />';
      },
      receipt: (_, __, row) => {
        return `<img src="${this.uploadPath}/${row.receipt_img}" class="receiptsTable__img">`;
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
        const { __select2_bank_account: account } = row;
        return account ? account.text : fallback;
      },
      amountOrTax: (_, __, row) => {
        return Number(row.total_amount) <= 0 ? fallback : row.total_amount;
      },
      category: (_, __, row) => {
        const { __select2_category: category } = row;
        return category ? category.text : fallback;
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
      review: (row, rows) => {
        this.actions.view(row, rows);
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
      view: (row, rows) => {
        this.utils.resetStep3();

        const $modal = $("#receiptModal");
        const $form = $modal.find("form");
        const $dataTypesStep1 = $modal.find("[data-step=1] [data-type]");
        const $dataTypesStep2 = $modal.find("[data-step=2] [data-type]");

        const $image = $modal.find("#receiptImage");
        $image.attr("src", `${this.uploadPath}${row.receipt_img}`);

        const $createdAt = $modal.find("#receiptImageCreatedAt");
        const createdAt = moment(row.created_at).format("hh:mm A MM/DD/YYYY");
        $createdAt.text(`Added ${createdAt}`);

        for (let index = 0; index < $dataTypesStep1.length; index++) {
          const $element = $dataTypesStep1[index];
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

        for (let index = 0; index < $dataTypesStep2.length; index++) {
          const $element = $dataTypesStep2[index];
          const { type } = $element.dataset;
          let value = row[type];

          if (!value) {
            continue;
          }

          if (value.text) {
            value = value.text;
          }

          if (type === "transaction_date") {
            value = moment(value).format("MM/DD/YYYY");
          }

          if (type === "total_amount") {
            value = accounting.formatMoney(value);
          }

          $element.textContent = value;
        }

        let hasAllRequiredDetails = true;
        for (let index = 0; index < $dataTypesStep1.length; index++) {
          const $element = $dataTypesStep1[index];
          if ($element.hasAttribute("required")) {
            const { type } = $element.dataset;
            if (row[type] === null) {
              hasAllRequiredDetails = false;
              break;
            }
          }
        }
        $form.attr("data-active-step", hasAllRequiredDetails ? 2 : 1);

        // step 1: save receipt
        const $saveReceipt = $modal.find("[data-action=savereceipt]");
        const $errorMessage = $modal.find(".formError");

        $saveReceipt.off(); // remove previous event handlers
        $saveReceipt.on("click", async (event) => {
          event.preventDefault();

          const payload = {};
          let hasError = false;

          for (let index = 0; index < $dataTypesStep1.length; index++) {
            const $element = $dataTypesStep1[index];
            const { type } = $element.dataset;
            payload[type] = $element.value;

            $element.classList.remove("inputError");

            if (!isEmpty($element.value)) {
              continue;
            }

            if (!$element.hasAttribute("required")) {
              continue;
            }

            $element.classList.add("inputError");
            $errorMessage.addClass("formError--show");
            hasError = true;
          }

          if (hasError) {
            return;
          }

          $errorMessage.removeClass("formError--show");
          $saveReceipt.addClass("receiptsButton--isLoading");
          $saveReceipt.prop("disabled", true);

          await this.api.editReceipt(row.id, payload);

          $saveReceipt.removeClass("receiptsButton--isLoading");
          $saveReceipt.prop("disabled", false);

          const { actionAfter } = $saveReceipt.get(0).dataset;
          if (actionAfter === "close") {
            $modal.modal("hide");
          }

          if (actionAfter === "next") {
            $form.attr("data-active-step", "2");
          }
        });

        // step 1: delete receipt
        const $deleteButton = $modal.find("[data-action=deletereceipt]");
        $deleteButton.off(); // remove previous event handlers
        $deleteButton.on("click", () => {
          this.actions.delete(row);
        });

        // step 2: create expense
        const $createExpense = $modal.find("[data-action=createexpense]");
        const $handlenextreceipt = $modal.find("#handlenextreceipt");
        const rowIndex = rows.findIndex(({ id }) => id === row.id);
        const nextRow = rows[rowIndex + 1];

        $createExpense.off(); // remove previous event handlers
        $createExpense.on("click", async (event) => {
          event.preventDefault();
          $createExpense.addClass("receiptsButton--isLoading");
          $createExpense.prop("disabled", true);

          await this.api.editReceipt(row.id, { to_expense: 1 });

          $createExpense.removeClass("receiptsButton--isLoading");
          $createExpense.prop("disabled", false);

          if (!nextRow) {
            window.location.reload();
          } else if ($handlenextreceipt.is(":checked")) {
            this.actions.view(nextRow, rows);
          }
        });

        // step 3: matching
        const $matchReceipt = $modal.find("[data-action=matchreceipt]");
        $matchReceipt.off(); // remove previous event handlers
        $matchReceipt.on("click", async (event) => {
          event.preventDefault();

          const $step3 = $modal.find("[data-step=3]");
          const $table = $step3.find("#searchedReceipts");
          const $error = $step3.find(".formError");
          const $selected = $table.find(".receiptsTable__row--selected");

          $error.removeClass("formError--show");
          if (!$selected.length || $selected.length > 1) {
            $error.addClass("formError--show");
            return;
          }

          const selectedRowIds = [];
          $selected.each((_, $item) => {
            selectedRowIds.push(Number.parseInt($item.dataset.id));
          });

          const tableData = $table.DataTable().table().rows().data().toArray();
          const selectedData = tableData.find(
            ({ id }) => id == selectedRowIds[0]
          );

          if (Number(selectedData.total_amount) !== Number(row.total_amount)) {
            const { isConfirmed } = await Swal.fire({
              title: "Are you sure you want to match?",
              text: "The total amount of the selected transaction is not equal to the amount on the document.",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#2ca01c",
              cancelButtonColor: "#d33",
              confirmButtonText: "Confirm",
            });

            if (!isConfirmed) {
              return;
            }
          }

          $matchReceipt.addClass("receiptsButton--isLoading");
          $matchReceipt.prop("disabled", true);

          const receiptId = $modal.find("[data-type=id]").val();
          const matches = selectedRowIds.map((id) => ({ match_id: id }));
          await this.api.saveMatch(receiptId, { matches });

          if (!nextRow) {
            window.location.reload();
          } else {
            this.actions.view(nextRow, rows);
          }

          $matchReceipt.removeClass("receiptsButton--isLoading");
          $matchReceipt.prop("disabled", false);
        });

        $modal.modal("show");
      },
      createExpense: async (row) => {
        await this.api.editReceipt(row.id, { to_expense: 1 });
        window.location.reload();
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
      func(row, rows, table, event);
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
