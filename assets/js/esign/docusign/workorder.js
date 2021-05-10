(() => {
  const $esignButton = $("#esignButton");
  const $templateModal = $("#docusignTemplateModal");
  const $table = $("#templatesTable");
  const workorderId = $("#workorderId").val();

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
      ajax: `${urlPrefix}/DocuSign/apiTemplates`,
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
            return `
              <a href="${urlPrefix}/DocuSign/templatePrepare?id=${row.id}&workorder_id=${workorderId}" class="btn btn-sm btn-primary">
                Use Template
              </a>
            `;
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
