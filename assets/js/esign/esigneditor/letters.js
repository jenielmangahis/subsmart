window.document.addEventListener("DOMContentLoaded", async () => {
  window.api = await import("./api.js");
  window.helpers = await import("./helpers.js");
  await initCategories();

  const $table = $("#letters");
  const $categorySelect = $("#category");
  const $statusSelect = $("#status");

  const table = $table.DataTable({
    serverSide: true,
    processing: true,
    lengthChange: false,
    pageLength: 20,
    ajax: {
      url: `${window.api.prefixURL}/EsignEditor/apiGetLetters`,
      data: (param) => {
        param.status = parseInt($statusSelect.val());
        param.category = parseInt($categorySelect.val());
        return param;
      },
    },
    language: {
      search: '<div class="icon"><i class="fa fa-search"></i></div>',
      searchPlaceholder: "Search...",
    },
    columns: [
      {
        render: columns.title,
      },
      {
        sortable: false,
        render: columns.category,
      },
      {
        sortable: false,
        render: columns.status,
      },
      {
        sortable: false,
        render: columns.favorite,
        class: "text-center",
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

    let $target = $(event.target);
    if (!$target.get(0).dataset.action) {
      $target = $target.closest("[data-action]");
    }

    const $parent = $target.closest("tr");
    const rows = table.rows().data().toArray();

    const rowId = $parent.data("id");
    const row = rows.find(({ id }) => id == rowId);

    const action = $target.data("action");
    if (!action || !actions[action]) return;

    const func = actions[action].bind(this);
    await func(row, table, event);
  });

  const filterTable = table.draw;
  $categorySelect.on("change", filterTable);
  $statusSelect.on("change", filterTable);

  // table has been loaded
  document.querySelector(".wrapper").classList.remove("wrapper--loading");
});

const columns = {
  title: (_, __, row) => {
    return `<a href="#" class="link" data-action="preview">${row.title}</a>`;
  },
  category: (_, __, row) => {
    return row.category;
  },
  status: (_, __, row) => {
    return Number.parseInt(row.is_active) ? "Active" : "Inactive";
  },
  favorite: (_, __, { is_favorite }) => {
    const $button = window.helpers.htmlToElement(`
      <button class="btn-favorite" data-action="favorite">
        <i class="fa fa-heart"></i>
      </button>`);

    if (is_favorite === true || is_favorite == 1) {
      $button.classList.add("btn-favorite--active");
    }

    return $button.outerHTML;
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
  favorite: async (row, table) => {
    const { data } = await window.api.toggleFavoriteLetter(row.id);
    row.is_favorite = data.is_favorite;
    table.row(`#row${row.id}`).data(row).invalidate();
  },
};

async function initCategories() {
  const categories = await window.api.getCategories();
  const $select = document.getElementById("category");
  categories.data.forEach((category) => {
    const $option = window.helpers.htmlToElement(
      `<option value="${category.id}">${category.name}</option>`
    );
    $select.appendChild($option);
  });
}
