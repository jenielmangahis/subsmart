(() => {
  const $esignButton = $("#esignButton");
  const $templateModal = $("#docusignTemplateModal");
  const $table = $("#templatesTable");

  const urlPrefix = location.hostname === "localhost" ? "/nsmartrac" : "";

  function addEventListeners() {
    $esignButton.on("click", function (event) {
      event.preventDefault();
      $templateModal.modal("show");
    });
  }

  function initTable() {
    return $table.DataTable({
      searching: false,
      ajax: `${urlPrefix}/Docusign/apiTemplates`,
      columns: [
        {
          sortable: false,
          data: "name",
        },
        {
          sortable: false,
          render: function (_, _, row) {
            console.log(row);

            const date = moment(row.created_at);
            const dateFormatted = date.format("MM/DD/YYYY");
            const timeFormatted = date.format("HH:mm:ss A");
            return `
                <div>${dateFormatted}</div>
                <div>${timeFormatted}</div>
            `;
          },
        },
        {
          sortable: false,
          render: function (_, _, row) {
            return `<button class="btn btn-sm btn-primary">Use Template</button>`;
          },
        },
      ],
      rowId: function (row) {
        return `row${row.id}`;
      },
      createdRow: function (row, data) {
        $(row).attr("data-id", data.id);
      },
    });
  }

  function init() {
    initTable();
    addEventListeners();
  }

  init();
})();
