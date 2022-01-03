export class ReportsTable {
  constructor($table) {
    this.$table = $($table);

    this.loadDeps().then(() => {
      this.init();
    });
  }

  async loadDeps() {
    this.api = await import("./api.js");
  }

  get columns() {
    return {
      name: (_, __, row) => {
        return row.name;
      },
      current: (_, __, row) => {
        return row.current;
      },
      ["1to30"]: (_, __, row) => {
        return row["1to30"];
      },
      ["31to60"]: (_, __, row) => {
        return row["31to60"];
      },
      ["61to90"]: (_, __, row) => {
        return row["61to90"];
      },
      ["91andOver"]: (_, __, row) => {
        return row["91andOver"];
      },
      total: (_, __, row) => {
        return row.total;
      },
    };
  }

  async init() {
    this.$table.DataTable({
      ajax: `${window.prefixURL}/AccountingARSummary/apiGetReports`,
      filter: false,
      searching: false,
      bInfo: false,
      paging: false,
      processing: true,
      language: {
        processing:
          '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>',
      },
      columns: [
        {
          sortable: false,
          render: this.columns.name,
        },
        {
          sortable: false,
          render: this.columns.current,
          className: "text-right",
        },
        {
          sortable: false,
          render: this.columns["1to30"],
          className: "text-right",
        },
        {
          sortable: false,
          render: this.columns["31to60"],
          className: "text-right",
        },
        {
          sortable: false,
          render: this.columns["61to90"],
          className: "text-right",
        },
        {
          sortable: false,
          render: this.columns["91andOver"],
          className: "text-right",
        },
        {
          sortable: false,
          render: this.columns.total,
          className: "text-right",
        },
      ],
    });
  }
}
