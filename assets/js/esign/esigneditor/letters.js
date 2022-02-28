window.document.addEventListener("DOMContentLoaded", async () => {
  window.api = await import("./api.js");
  const { data } = await window.api.getLetters();

  const $table = $("#letters");
  const table = $table.DataTable({
    data,
    paging: false,
    language: {
      search: '<div class="icon"><i class="fa fa-search"></i></div>',
      searchPlaceholder: "Search...",
    },
    columns: [
      {
        render: columns.title,
      },
      {
        render: columns.category,
      },
      {
        render: columns.status,
      },
      {
        filter: false,
        sortable: false,
        render: columns.actions,
      },
    ],
    rowId: (row) => `row${row.id}`,
    createdRow: (row, data) => {
      $(row).attr("data-id", data.id);
    },
  });

  table.on("click", "[data-action]", async (event) => {
    event.preventDefault();

    const $target = $(event.target);
    const $parent = $target.closest("tr");
    const rows = table.rows().data().toArray();

    const rowId = $parent.data("id");
    const row = rows.find(({ id }) => id == rowId);

    const action = $target.data("action");
    const func = actions[action].bind(this);

    if (!func) return;
    await actions[action](row, table, event);
  });
});

const columns = {
  title: (_, __, row) => {
    return row.title;
  },
  category: (_, __, row) => {
    return row.name;
  },
  status: (_, __, row) => {
    return Number.parseInt(row.is_active) ? "Active" : "Inactive";
  },
  actions: () => {
    return `
    <div class="btn-group">
      <button type="button" class="btn btn-sm btn-primary" data-action="edit">Edit</button>
      <button type="button" class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="sr-only">Toggle Dropdown</span>
      </button>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="#" data-action="delete">Delete</a>
      </div>
    </div>
  `;
  },
};

const actions = {
  edit: async (row) => {
    window.location.href = `${window.api.prefixURL}/esigneditor/edit?id=${row.id}`;
  },
  delete: async (row, table, event) => {
    if (confirm("Are you sure you want to delete letter?")) {
      await window.api.deleteLetter(row.id);

      const $target = $(event.target);
      const $row = $target.closest("tr");
      table.row($row).remove().draw();
    }
  },
};
