import * as api from "./api.js";

window.document.addEventListener("DOMContentLoaded", async () => {
  const $table = document.getElementById("flashcardtable");
  const $loader = document.querySelector(".fc-loader");

  const columns = getColumns();
  const table = $($table).DataTable({
    bInfo: false,
    bLengthChange: false,
    order: [0, "desc"],
    ajax: {
      url: `${api.prefixURL}/FlashCard/apiGetDecs`,
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
    actions: () => {
      return ``;
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
  const $button = $createModal.querySelector(".nsm-button.primary");
  const name = $name.value.trim();

  if (!name.length) {
    $name.focus();
    return;
  }

  $button.textContent = "Saving...";
  $button.setAttribute("disabled", true);

  try {
    const response = await api.createDeck({ title: name });
    $($createModal).modal("hide");
  } catch (error) {
  } finally {
    $button.textContent = $button.dataset.textDefault;
    $button.removeAttribute("disabled");
  }
});

$($createModal).on("show.bs.modal", () => {
  const $name = $createForm.querySelector("#fc-name");
  const $button = $createModal.querySelector(".nsm-button.primary");

  $name.value = "";
  $button.textContent = $button.dataset.textDefault;
  $button.removeAttribute("disabled");
});
