const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";

const columns = {
  formName: (_, __, row) => {
    return row.name;
  },
  results: () => {
    return "";
  },
  favorite: (_, __, row) => {
    const icon =
      row.favorite == 0
        ? `<i class="bx bx-fw bx-heart"></i>`
        : `<i class="bx bx-fw bxs-heart" style="color: #fc2e63;"></i>`;

    return `
      <button class="fb-btn" data-action="favorite">
        ${icon}
      </button>
    `;
  },
  dailyResults: () => {
    return "";
  },
  modified: (_, __, row) => {
    return moment(row.updated_at).format("MMMM DD, YYYY");
  },
  actions: (_, __, row) => {
    return `
    <div class="dropdown table-management">
      <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
          <i class='bx bx-fw bx-dots-vertical-rounded'></i>
      </a>
      <ul class="dropdown-menu dropdown-menu-end">
          <li>
              <a class="dropdown-item" href="${prefixURL}/fb/view/${row.id}">Preview</a>
          </li>
          <li>
              <a class="dropdown-item" href="${prefixURL}/fb/edit/${row.id}">Edit</a>
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
        class: "text-center",
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
