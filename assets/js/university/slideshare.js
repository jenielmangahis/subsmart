import * as api from "./api.js";

const MAX_SIZE_IN_MB = 8;

const $table = document.getElementById("slidesharetable");
const $loader = document.querySelector(".ss-loader");

const $search = document.getElementById("slidesharesearch");
const $previewModal = document.getElementById("slidesharemodalpreview");

const $createBtn = document.getElementById("slidesharecreate");
const $createModal = document.getElementById("slidesharemodalcreate");
const $fileSelect = $createModal.querySelector("#ss-file");
const $createForm = $createModal.querySelector("#slidesharcreateform");

window.document.addEventListener("DOMContentLoaded", async () => {
  const columns = getColumns();
  const table = $($table).DataTable({
    bInfo: false,
    bLengthChange: false,
    order: [0, "desc"],
    ajax: {
      url: `${api.prefixURL}/SlideShare/apiGetItems`,
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
        render: columns.size,
        sortable: false,
        searchable: false,
      },
      {
        render: columns.uploadedAt,
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

  $search.addEventListener("input", function () {
    table.search(this.value).draw();
  });
});

function getColumns() {
  return {
    id: (_, __, row) => {
      return row.id;
    },
    name: (_, __, row) => {
      return `
        <div>
          <div class="nsm-text-primary fw-bold mb-1">
            ${row.display_name}
          </div>
          <div class="content-subtitle ellipsis">
            ${row.description}
          </div>
        </div>
    `;
    },
    size: (_, __, row) => {
      return `<div>${formatBytes(row.size)}</div>`;
    },
    uploadedAt: (_, __, row) => {
      const createdAt = moment.utc(row.created_at).fromNow();
      return `<div>${createdAt}</div>`;
    },
    actions: () => {
      return `
        <div class="d-flex align-items-center" style="width: max-content;">
            <button type="button" class="nsm-button mb-0" data-action="play">
                <i class="bx bx-fw bx-play"></i> <span>Play</span>
            </button>

            <div class="dropdown table-management">
              <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bx bx-fw bx-dots-vertical-rounded"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" style="">
                  <li>
                    <a class="dropdown-item" href="javascript:void(0);" data-action="edit">Edit</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="javascript:void(0);">Copy Shareable Link</a>
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
    play: (row) => {
      $previewModal.__row = row;
      $($previewModal).modal("show");
    },
    edit: (row) => {
      $createModal.__row = row;
      $($createModal).modal("show");
    },
    remove: async (row) => {
      const result = await Swal.fire({
        title: "Delete Demo",
        text: "Are you sure you want to delete this demo?",
        icon: "question",
        confirmButtonText: "Yes, delete",
        showCancelButton: true,
        cancelButtonText: "Cancel",
      });

      if (result.isConfirmed) {
        const { data } = await api.remove(row.id);
        removeRowData(data);
      }
    },
  };
}

$($previewModal).on("show.bs.modal", () => {
  const data = $previewModal.__row;
  const $video = $previewModal.querySelector(".video");
  const $title = $previewModal.querySelector(".modal-title");
  const $description = $previewModal.querySelector(".description");

  const url = data.url.replace(/^\/|\/$/g, "");
  $video.setAttribute("src", `${api.prefixURL}/${url}`);
  $title.textContent = data.display_name;
  $description.textContent = data.description;
});

$createBtn.addEventListener("click", () => {
  $($createModal).modal("show");
});

$fileSelect.addEventListener("change", async function () {
  const [file] = this.files;
  const $text = $createModal.querySelector(".ss-upload-btn .text");
  const textDefault = $text.textContent;
  $text.textContent = file.name;

  if (!validateFileSize(this.files[0], MAX_SIZE_IN_MB)) {
    const $group = this.closest(".upload-group");
    const $feedback = $group.querySelector(".invalid-feedback");
    $feedback.textContent = `File size must be less than ${MAX_SIZE_IN_MB}MB`;
    $feedback.classList.add("d-block");
    $text.textContent = textDefault;
    this.value = "";
  }
});

$createForm.addEventListener("submit", async (event) => {
  event.preventDefault();

  const payload = {};
  const $inputs = $createForm.querySelectorAll("[data-type]");
  for (let index = 0; index < $inputs.length; index++) {
    const $input = $inputs[index];
    const name = $input.dataset.type;
    const value = $input.files ? $input.files[0] : $input.value.trim();

    if ($input.hasAttribute("required")) {
      if (typeof value === "string" && !value.length) {
        $input.focus();
        return;
      }
    }

    payload[name] = value;
  }

  const $submitBtn = $createModal.querySelector("button.primary");
  const btnText = $submitBtn.textContent;

  $submitBtn.textContent = "Saving...";
  $submitBtn.setAttribute("disabled", true);

  try {
    const modalData = $createModal.__row;
    const isEdit = Boolean(modalData);
    const apiFunc = isEdit ? api.edit : api.upload;
    const _payload = isEdit ? { ...payload, id: modalData.id } : payload;
    const { data } = await apiFunc(_payload);

    if (isEdit) {
      updateRowData(data);
    } else {
      inserRowData(data);
    }

    $($createModal).modal("hide");
  } catch (error) {
    console.error(error);
  } finally {
    $submitBtn.textContent = btnText;
    $submitBtn.removeAttribute("disabled");
  }
});

$($createModal).on("show.bs.modal", () => {
  const $inputs = [...$createForm.querySelectorAll("[data-type]")];
  $inputs.forEach(($input) => {
    $input.value = "";
    $input.removeAttribute("disabled");

    if ($input.type === "file") {
      const $group = $input.closest(".upload-group");
      const $button = $group.querySelector(".ss-upload-btn");
      $button.classList.remove("disabled");

      const $text = $group.querySelector(".text");
      $text.textContent = $text.dataset.textDefault.trim();

      const $feedback = $group.querySelector(".invalid-feedback");
      $feedback.classList.remove("d-block");
    }
  });

  const $title = $createModal.querySelector(".modal-title");
  $title.textContent = $title.dataset.textDefault;

  const data = $createModal.__row;
  if (!data) return;

  $title.textContent = data.display_name;
  $inputs.forEach(($input) => {
    if ($input.type !== "file") {
      $input.value = data[$input.dataset.type];
      return;
    }

    const $group = $input.closest(".upload-group");
    const $button = $group.querySelector(".ss-upload-btn");

    $button.classList.add("disabled");
    $input.setAttribute("disabled", true);

    const $text = $group.querySelector(".text");
    $text.textContent = data.display_name;
  });
});
$($createModal).on("hide.bs.modal", () => {
  $createModal.__row = null;
});

// https://stackoverflow.com/a/44505315/8062659
function validateFileSize(file, maxMB = 8) {
  const fileSize = file.size / 1024 / 1024; // in MiB
  return fileSize <= maxMB;
}

// https://stackoverflow.com/a/18650828/8062659
function formatBytes(bytes, decimals = 2) {
  if (bytes === 0) return "0 Bytes";

  const k = 1024;
  const dm = decimals < 0 ? 0 : decimals;
  const sizes = ["Bytes", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"];
  const i = Math.floor(Math.log(bytes) / Math.log(k));
  return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + " " + sizes[i];
}

function updateRowData(data) {
  const table = $($table).DataTable();
  table.row(`#row${data.id}`).data(data).draw();
}

function inserRowData(data) {
  const table = $($table).DataTable();
  table.row.add(data).draw();
}

function removeRowData(data) {
  const table = $($table).DataTable();
  table.row(`#row${data.id}`).remove().draw();
}
