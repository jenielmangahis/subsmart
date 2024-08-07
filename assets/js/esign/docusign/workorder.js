(() => {
  const $esignButton = $("#esignButton");
  const $templateModal = $("#docusignTemplateModal");
  const $table = $("#templatesTable");
  const workorderId = $("#workorderId").val();
  const jobId = $("#esignJobId").val();
  const urlPrefix = "";

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
            let url = `${urlPrefix}/eSign/templatePrepare?id=${row.id}&job_id=${jobId}`;
            if (workorderId) {
              url = `${urlPrefix}/eSign/templatePrepare?id=${row.id}&workorder_id=${workorderId}`;
            }

            return `
              <a href=${url} class="btn btn-sm btn-primary">
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
