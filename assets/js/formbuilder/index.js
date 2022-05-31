const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";

const columns = {
  formName: (_, __, row) => {
    return row.name;
  },
  results: () => {
    return "";
  },
  favorite: (_, __, row) => {
    return row.favorite == 0
      ? `<i class="bx bx-fw bx-heart"/>`
      : `<i class="bx bx-fw bxs-heart" style="color: #fc2e63;"/>`;
  },
  dailyResults: () => {
    return "";
  },
  modified: (_, __, row) => {
    return moment(row.updated_at).format("MMMM DD, YYYY");
  },
  actions: () => {
    return `
    <div class="dropdown table-management">
      <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
          <i class='bx bx-fw bx-dots-vertical-rounded'></i>
      </a>
      <ul class="dropdown-menu dropdown-menu-end">
          <li>
              <a class="dropdown-item" href="#">Preview</a>
          </li>
          <li>
              <a class="dropdown-item" href="#">Edit</a>
          </li>
          <li>
              <a class="dropdown-item" href="#">Delete</a>
          </li>
      </ul>
    </div>
    `;
  },
};

window.document.addEventListener("DOMContentLoaded", async () => {
  const { data: forms } = await getForms();

  const $table = document.getElementById("formbuildertable");
  $($table).DataTable({
    data: forms,
    paging: false,
    filter: false,
    bInfo: false,
    columns: [
      {
        render: columns.formName,
        sortable: false,
      },
      {
        render: columns.results,
        sortable: false,
      },
      {
        render: columns.favorite,
        sortable: false,
      },
      {
        render: columns.dailyResults,
        sortable: false,
      },
      {
        render: columns.modified,
        sortable: false,
      },
      {
        render: columns.actions,
        sortable: false,
      },
    ],
    rowId: (row) => `row${row.id}`,
    createdRow: (row, data) => {
      $(row).attr("data-id", data.id);
    },
  });
});

async function getForms() {
  const response = await fetch(`${prefixURL}/fb/getByActiveUser`);
  return response.json();
}
