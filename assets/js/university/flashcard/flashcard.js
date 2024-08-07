import * as api from "./api.js";

const $table = document.getElementById("flashcardtable");

window.document.addEventListener("DOMContentLoaded", async () => {
  const $loader = document.querySelector(".fc-loader");
  const columns = getColumns();
  const table = $($table).DataTable({
    bInfo: false,
    bLengthChange: false,
    order: [0, "desc"],
    ajax: {
      url: `${api.prefixURL}/FlashCard/apiGetDecks`,
      data: (param) => {
        $loader.classList.remove("hide");
        return param;
      },
      dataSrc: (json) => {
        $loader.classList.add("hide");
        return json.data;
      },
    },
    columns: [
      {
        render: columns.id,
        sortable: false,
        visible: false,
        searchable: false,
      },
      {
        render: columns.name,
        sortable: false,
      },
      {
        render: columns.createdBy,
        sortable: false,
        searchable: false,
      },
      {
        render: columns.createdAt,
        sortable: false,
        searchable: false,
      },
      {
        render: columns.actions,
        sortable: false,
        searchable: false,
      },
    ],
    rowId: (row) => `row${row.id}`,
    createdRow: (row, data) => {
      $(row).attr("data-id", data.id);
      $(row).find("[data-toggle=tooltip]").tooltip();
    },
  });

  const actions = getActions();
  table.on("click", "[data-action]", async (event) => {
    event.preventDefault();

    let $target = event.target;
    if (!$target.dataset.action) {
      $target = $target.closest("[data-action]");
    }

    const $parent = $target.closest("tr");
    const rows = table.rows().data().toArray();

    const rowIndex = $parent.dataset.id;
    const row = rows.find(({ id }) => id == rowIndex);

    const action = $target.dataset.action;
    if (!action || !actions[action]) return;

    const func = actions[action].bind(this);
    await func(row);
  });
});

function getColumns() {
  return {
    id: (_, __, row) => {
      return row.id;
    },
    name: (_, __, row) => {
      return `
        <div class="nsm-text-primary fw-bold mb-1">
          ${row.title}
        </div>
    `;
    },
    createdBy: (_, __, row) => {
      return `<div>${row.uploaded_by_firstname} ${row.uploaded_by_lastname}</div>`;
    },
    createdAt: (_, __, row) => {
      const createdAt = moment.utc(row.created_at).fromNow();
      return `<div>${createdAt}</div>`;
    },
    actions: () => {
      return `
        <div class="d-flex align-items-center" style="width: max-content;">
          <button type="button" class="nsm-button mb-0" data-action="addcards">
              <i class="bx bx-fw bx-plus"></i> <span>Add cards</span>
          </button>

          <button type="button" class="nsm-button mb-0" data-action="studycards" title="Study cards" data-toggle="tooltip" data-placement="bottom">
              <i class="bx bx-fw bx-play"></i>
          </button>

          <div class="dropdown table-management">
            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bx bx-fw bx-dots-horizontal-rounded"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" style="">
                <li>
                  <a class="dropdown-item" href="javascript:void(0);" data-action="edit">Edit</a>
                </li>
                <li>
                  <a class="dropdown-item" href="javascript:void(0);" data-action="remove">Delete</a>
                </li>
            </ul>
          </div>
        </div>
      `;
    },
  };
}

function getActions() {
  return {
    addcards: (row) => {
      window.location = `${api.prefixURL}/flashcard/add-cards/${row.id}`;
    },
    studycards: async (row) => {
      if (row.cards && row.cards.length >= 1) {
        window.location = `${api.prefixURL}/flashcard/study-cards/${row.id}`;
        return;
      }

      const result = await Swal.fire({
        title: "This Deck Has No Cards",
        text: "Before you can study this deck, you must add cards to this deck.",
        icon: "info",
        confirmButtonText: "Add cards",
        showCancelButton: true,
        cancelButtonText: "Okay",
      });

      if (result.isConfirmed) {
        getActions().addcards(row);
      }
    },
    remove: async (row) => {
      const result = await Swal.fire({
        title: "Delete Deck",
        text: "Deleting a deck will also remove its cards. Are you sure you want to delete this deck?",
        icon: "question",
        confirmButtonText: "Yes, delete",
        showCancelButton: true,
        cancelButtonText: "Cancel",
      });

      if (!result.isConfirmed) return;

      const { data } = await api.removeDeck(row.id);
      const table = $($table).DataTable();
      table.row(`#row${data.id}`).remove().draw();
    },
    edit: (row) => {
      $createModal.__row = row;
      $($createModal).modal("show");
    },
  };
}

const $createBtn = document.getElementById("flashcardcreate");
const $createModal = document.getElementById("flashcardcreatemodal");
const $createForm = document.getElementById("flashcardcreateform");

$createBtn.addEventListener("click", () => {
  $($createModal).modal("show");
});

$createForm.addEventListener("submit", async (event) => {
  event.preventDefault();

  const $name = $createForm.querySelector("#fc-name");
  const $isPublic = $createForm.querySelector("#ss-private");
  const $button = $createModal.querySelector(".nsm-button.primary");
  const name = $name.value.trim();
  const isPublic = $isPublic.checked;

  if (!name.length) {
    $name.focus();
    return;
  }

  $button.textContent = "Saving...";
  $button.setAttribute("disabled", true);

  try {
    const modalData = $createModal.__row;
    const isEdit = Boolean(modalData);
    const table = $($table).DataTable();

    if (isEdit) {
      const payload = {
        ...modalData,
        title: name,
        is_shared_in_company: isPublic,
      };

      const { data } = await api.updateDeck(payload);
      table.row(`#row${data.id}`).data(data).draw();
    } else {
      const { data } = await api.createDeck({ title: name });
      table.row.add(data).draw();
    }

    $($createModal).modal("hide");
  } catch (error) {
  } finally {
    $button.textContent = $button.dataset.textDefault;
    $button.removeAttribute("disabled");
  }
});

$($createModal).on("show.bs.modal", () => {
  const $name = $createForm.querySelector("#fc-name");
  const $isPublic = $createForm.querySelector("#ss-private");
  const $button = $createModal.querySelector(".nsm-button.primary");

  $name.value = "";
  $isPublic.checked = false;
  $button.textContent = $button.dataset.textDefault;
  $button.removeAttribute("disabled");

  // Reset modal title.
  const $title = $createModal.querySelector(".modal-title");
  $title.textContent = $title.dataset.textDefault;

  const $formCheck = $createModal.querySelector(".form-check");
  $formCheck.classList.remove("d-none");

  const data = $createModal.__row;
  if (!data) return;

  if (data.current_user_id !== data.user_id) {
    $formCheck.classList.add("d-none");
  } else {
    $formCheck.classList.remove("d-none");
  }

  $title.textContent = data.title;
  $isPublic.checked = data.is_shared_in_company == 1;
  $name.value = data.title;
});
$($createModal).on("hide.bs.modal", (event) => {
  $createModal.__row = null;
});
