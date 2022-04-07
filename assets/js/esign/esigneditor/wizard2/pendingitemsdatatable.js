import * as api from "../api.js";
import * as common from "./common.js";
import * as selected from "./selecteditemsdatatable.js";
import * as helpers from "../helpers.js";

export class Table {
  static tableId = "customerdisputestable";

  constructor() {
    this.onCheckboxStateChange = this.onCheckboxStateChange.bind(this);

    this.$modal = document.getElementById("additemmodal");
    this.$table = this.$modal.querySelector(`#${Table.tableId}`);
    this.$$table = $(this.$table);

    this.initTable();
    this.initModal();
  }

  get columns() {
    return common.tableColumns;
  }

  async initTable() {
    const params = helpers.getParams();
    const { data } = await api.getCustomerDisputeItems(params.customer_id);

    const table = this.$$table.DataTable({
      data,
      paging: false,
      filter: false,
      bInfo: false,
      columns: [
        {
          render: this.columns.checkbox,
          sortable: false,
          class: "table__selectColumn",
        },
        {
          render: this.columns.creditor,
          sortable: false,
        },
        {
          render: this.columns.accountNumber,
          sortable: false,
          class: "accountnum",
        },
        {
          render: this.columns.reason,
          sortable: false,
        },
        {
          render: this.columns.isDisputed,
          sortable: false,
        },
        {
          render: this.columns.equifax,
          sortable: false,
        },
        {
          render: this.columns.experian,
          sortable: false,
        },
        {
          render: this.columns.transunion,
          sortable: false,
        },
      ],
      rowId: (row) => `row${row.id}`,
      createdRow: (row, data) => {
        $(row).attr("data-id", data.id);
      },
    });
    this.table = table;

    table.on("click", "th .table__checkbox", (event) => {
      const isChecked = event.target.checked;
      const rows = table.rows({ search: "applied" }).nodes();
      $("input[type=checkbox]", rows).prop("checked", isChecked);

      const func = isChecked ? "addClass" : "removeClass";
      $(rows)[func]("table__row--selected");
      this.onCheckboxStateChange();
    });

    table.on("click", "tbody tr", (event) => {
      const $tr = $(event.target).closest("tr");
      const $checkbox = $tr.find("input[type=checkbox]");
      $checkbox.prop("checked", !$checkbox.prop("checked"));

      if ($checkbox.is(":checked")) {
        $tr.addClass("table__row--selected");
      } else {
        $tr.removeClass("table__row--selected");
      }

      this.onCheckboxStateChange();
    });
  }

  onCheckboxStateChange() {
    const $rows = this.$$table.find("tr[data-id]");
    const $selected = this.$$table.find(".table__row--selected");
    const $mainCheckbox = this.$$table.find("th .table__checkbox").get(0);

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

  initModal() {
    $(this.$modal).on("show.bs.modal", () => {
      // uncheck all first
      const rows = this.table.rows({ search: "applied" }).nodes();
      $(".table__checkbox", rows).prop("checked", false);
      $(rows).removeClass("table__row--selected");

      // check all selected
      const ids = selected.Table.getRowsData().map((row) => row.id);
      ids.forEach((id) => {
        const $row = $(this.table.row(`#row${id}`).node());
        $row.addClass("table__row--selected");
        $row.find(".table__checkbox").prop("checked", true);
      });

      this.onCheckboxStateChange();
    });
  }

  static getSelectedRowsData() {
    const $table = $(`#${Table.tableId}`);
    const table = $table.DataTable();
    const rowsData = [];
    table.rows(".table__row--selected").every((index) => {
      rowsData.push(table.row(index).data());
    });

    return rowsData;
  }
}
