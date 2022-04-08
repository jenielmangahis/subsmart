import * as common from "./common.js";
import * as pending from "./pendingitemsdatatable.js";

export class Table {
  static tableId = "selecteddisputeitemstable";

  constructor() {
    this.$table = document.getElementById(Table.tableId);
    this.$$table = $(this.$table);

    this.initTable();
  }

  get columns() {
    return common.tableColumns;
  }

  get actions() {
    return {
      remove: (letter, table) => {
        if (!letter) return;
        table.row(`#row${letter.id}`).remove().draw();

        if (typeof this.onRemoveRow === "function") {
          this.onRemoveRow(letter);
        }
      },
    };
  }

  initTable() {
    const $recipient2 = $("#recipient2");
    const recipient2IsChecked = $recipient2.is(":checked");

    const table = this.$$table.DataTable({
      data: pending.Table.getSelectedRowsData(),
      paging: false,
      filter: false,
      bInfo: false,
      bDestroy: true,
      columns: [
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
          render: this.columns.equifax,
          sortable: false,
          bVisible: !recipient2IsChecked,
        },
        {
          render: this.columns.experian,
          sortable: false,
          bVisible: !recipient2IsChecked,
        },
        {
          render: this.columns.transunion,
          sortable: false,
          bVisible: !recipient2IsChecked,
        },
        {
          render: this.columns.remove,
          sortable: false,
        },
      ],
      rowId: (row) => `row${row.id}`,
      createdRow: (row, data) => {
        $(row).attr("data-id", data.id);
      },
    });

    table.on("click", ".action", async (event) => {
      event.preventDefault();

      const $target = $(event.currentTarget);
      const $parent = $target.closest("tr");
      const rows = table.rows().data().toArray();

      const rowId = $parent.data("id");
      const row = rows.find(({ id }) => id == rowId);

      const action = $target.data("action");
      const func = this.actions[action];

      if (!func) return;
      func(row, table, event);
    });
  }

  static getRowsData() {
    const $table = $(`#${Table.tableId}`);
    const table = $table.DataTable();
    const rowsData = [];
    table.rows("tbody tr").every((index) => {
      rowsData.push(table.row(index).data());
    });

    return rowsData;
  }
}
