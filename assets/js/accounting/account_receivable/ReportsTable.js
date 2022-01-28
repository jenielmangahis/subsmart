export class ReportsTable {
  constructor($table, data = null) {
    this.$table = $($table);
    this.$orderRadios = $("[name=sortTable]");
    this.$rowDensityCheckbox = $("#tableCompact");
    this.data = data;

    this.loadDeps().then(() => {
      this.init();
    });
  }

  async loadDeps() {
    this.api = await import("./api.js");
  }

  async init() {
    if ($.fn.DataTable.isDataTable(this.$table)) {
      this.$table.DataTable().destroy();
      this.$table.empty("");
    }

    let data = this.data;
    if (!this.data) {
      const response = await this.api.getReports();
      data = response.data;
    }

    const { data: config } = await this.api.getReportCustomizeFormValues();
    const withoutCents = Number(config.without_cents);
    const divideBy1000 = Number(config.divide_by_1000);
    const exceptZeroAmount = Number(config.except_zero_amount);

    data = data.map((record) => {
      Object.keys(record).forEach((key) => {
        const keyLower = key.toLowerCase();
        // prettier-ignore
        if (!/\dto\d/.test(key) && keyLower !== "total" && !keyLower.endsWith("andover")) {
          return;
        }

        let value = Number(record[key]);

        if (exceptZeroAmount && value === 0) {
          record[key] = "";
          return;
        }

        value = value.toFixed(withoutCents ? 0 : 2);
        value = divideBy1000 ? value / 1000 : value;
        record[key] = value;
      });

      return record;
    });

    console.log(data);

    const columns = Object.keys(data[0]).reduce((carry, key) => {
      if (key === "customer_id") return carry;
      return [
        ...carry,
        {
          data: key,
          sortable: false,
          title: key === "name" ? "" : formatHeader(key),
          ...(key !== "name" && { className: "text-right" }),
        },
      ];
    }, []);

    const table = this.$table.DataTable({
      data,
      columns,
      filter: false,
      searching: false,
      bInfo: false,
      paging: false,
      processing: true,
      dom: "Bfrtip",
      bDestroy: true,
      buttons: [
        {
          extend: "print",
          className: "hidden",
          title: () => {
            const title = $("[data-type=title]").text();
            const subtitle = $("[data-type=subtitle]").text();
            return `<div>
              <center><h1 style="margin:0;">${title}</h1></center>
              <center><h3 style="margin:0;">${subtitle}</h3></center>
            </div>`;
          },
          customize: (pageWindow) => {
            pageWindow.document.querySelector("head > title").textContent = "";
          },
        },
        {
          extend: "pdf",
          className: "hidden",
          title: "",
          filename: `${new Date().getTime()}`,
        },
      ],
      language: {
        processing:
          '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>',
      },
    });

    table.buttons(".hidden").nodes().css("display", "none");

    this.$orderRadios.on("change", (event) => {
      const { value } = event.target;
      const totalIndex = columns.findIndex((column) => column.data === "total");

      if (value === "default") {
        table.order([0, "asc"]);
      } else {
        table.order([totalIndex, value === "total_ascending" ? "asc" : "desc"]);
      }

      table.draw();
    });

    this.$rowDensityCheckbox.on("change", (event) => {
      if (event.target.checked) {
        this.$table.addClass("table-sm");
      } else {
        this.$table.removeClass("table-sm");
      }
    });
  }
}

function formatHeader(string) {
  const stringLower = string.toLowerCase();
  if (stringLower === "total") {
    return string.toUpperCase();
  }

  if (stringLower.endsWith("andover")) {
    return stringLower.replace("andover", " and over").toUpperCase();
  }

  if (/\dto\d/.test(string)) {
    return string.replace("to", " - ");
  }

  return string.toUpperCase();
}
