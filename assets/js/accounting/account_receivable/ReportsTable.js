export class ReportsTable {
  constructor($table) {
    this.$table = $($table);
    this.$orderRadios = $("[name=sortTable]");
    this.$rowDensityCheckbox = $("#tableCompact");

    this.loadDeps().then(() => {
      this.init();
    });
  }

  async loadDeps() {
    this.api = await import("./api.js");
  }

  async init() {
    const { data } = await this.api.getReports();
    const columns = Object.keys(data[0]).reduce((carry, key) => {
      if (key === "customer_id") return carry;
      return [
        ...carry,
        {
          data: key,
          sortable: false,
          title: formatHeader(key),
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
