window.document.addEventListener("DOMContentLoaded", async () => {
  window.api = await import("./api.js");
  window.helpers = await import("./helpers.js");

  const { data } = await window.api.getLetters();
  await initCategories();

  const $table = $("#letters");
  const table = $table.DataTable({
    data,
    pageLength: 50,
    lengthChange: false,
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

  const $categorySelect = $("#category");
  const $statusSelect = $("#status");

  function filterTable() {
    const status = $statusSelect.val();
    const category = $categorySelect.val();

    if (status === "all" && category === "all") {
      table.clear();
      table.rows.add(data).draw();
      return;
    }

    const statusInt = status === "active" ? 1 : 0;
    const filtered = data.filter((row) => {
      if (category !== "all" && row.name !== category) return false;
      if (status === "all") return true;
      return Number.parseInt(row.is_active) === statusInt;
    });

    table.clear();
    table.rows.add(filtered).draw();
  }

  $categorySelect.on("change", filterTable);
  $statusSelect.on("change", filterTable);
  $categorySelect.val("all").trigger("change");
  $statusSelect.val("all").trigger("change");

  // table has been loaded
  document.querySelector(".wrapper").classList.remove("wrapper--loading");
});

const columns = {
  title: (_, __, row) => {
    return `<a href="#" class="link" data-action="preview">${row.title}</a>`;
  },
  category: (_, __, row) => {
    return row.name;
  },
  status: (_, __, row) => {
    return Number.parseInt(row.is_active) ? "Active" : "Inactive";
  },
  actions: (_, __, row) => {
    if (row.user_id === null) {
      return "<span></span>";
    }

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
    window.location.href = `${window.api.prefixURL}/EsignEditor/edit?id=${row.id}`;
  },
  delete: async (row, table, event) => {
    if (confirm("Are you sure you want to delete letter?")) {
      await window.api.deleteLetter(row.id);

      const $target = $(event.target);
      const $row = $target.closest("tr");
      table.row($row).remove().draw();
    }
  },
  preview: (row) => {
    const $modal = $("#previewLetterModal");
    const $preview = $modal.find(".preview");
    const $title = $modal.find(".modal-title");

    const $letter = $("<div/>").html(row.content);
    $letter.addClass("preview__item");
    $letter.find(".pageBreak").removeAttr("style");
    $title.text(row.title);

    $preview.html($letter);
    $modal.modal("show");
  },
};

async function initCategories() {
  const categories = await window.api.getCategories();
  const $select = document.getElementById("category");
  categories.data.forEach((category) => {
    const $option = window.helpers.htmlToElement(
      `<option value="${category.name}">${category.name}</option>`
    );
    $select.appendChild($option);
  });
}
