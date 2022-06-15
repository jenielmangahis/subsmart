import * as api from "./api.js";

const MAX_SIZE_IN_MB = 500;

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

  const uploader = new plupload.Uploader({
    runtimes: "html5",
    browse_button: $createModal.querySelector(".ss-upload-btn"),
    multi_selection: false,
    url: `${api.prefixURL}/SlideShare/apiUpload`,
    filters: {
      max_file_size: `${MAX_SIZE_IN_MB}mb`,
      mime_types: [{ title: "Video files", extensions: "mp4" }],
    },
    init: {
      FilesAdded: (up, [file]) => {
        // https://stackoverflow.com/a/32398581/8062659
        up.files.splice(0, up.files.length - 1);

        const $text = $createModal.querySelector(".ss-upload-btn .text");
        const $feedback = $createModal.querySelector(".invalid-feedback");
        $text.textContent = file.name;
        $fileSelect.value = file.name;
        $feedback.classList.remove("d-block");
      },
      UploadProgress: (_, file) => {
        const $submitBtn = $createModal.querySelector("button.primary");
        $submitBtn.textContent = `Saving (${file.percent}%)...`;
      },
      Error: (_, error) => {
        if (error.message === "File size error.") {
          const $feedback = $createModal.querySelector(".invalid-feedback");
          $feedback.textContent = `File size must be less than ${MAX_SIZE_IN_MB}MB`;
          $feedback.classList.add("d-block");
        }
      },
      StateChanged: () => {
        const $inputs = [...$createForm.querySelectorAll("[data-type]")];
        const $uploadButton = $createForm.querySelector(".ss-upload-btn");

        $inputs.forEach(($input) => {
          if (isUploading()) {
            $input.setAttribute("disabled", true);
          } else {
            $input.removeAttribute("disabled");
          }
        });

        if (isUploading()) {
          $uploadButton.classList.add("disabled");
        } else {
          $uploadButton.classList.remove("disabled");
        }
      },
    },
  });

  window.__uploader = uploader;
  uploader.init();

  window.addEventListener("beforeunload", onBeforeUnload, { capture: true });
});

function onBeforeUnload(event) {
  event.preventDefault();

  if (isUploading()) {
    return (event.returnValue = "Changes that you made may not be saved");
  }
}

function isUploading() {
  return window.__uploader && window.__uploader.state === plupload.STARTED;
}

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
$($previewModal).on("hide.bs.modal", () => {
  const $video = $previewModal.querySelector(".video");
  $video.setAttribute("src", "");
});

$createBtn.addEventListener("click", () => {
  $($createModal).modal("show");
});

$createForm.addEventListener("submit", async (event) => {
  event.preventDefault();

  const $submitBtn = $createModal.querySelector("button.primary");
  $submitBtn.textContent = "Saving...";
  $submitBtn.setAttribute("disabled", true);

  const modalData = $createModal.__row;
  const isEdit = Boolean(modalData);

  if (!isEdit) {
    window.__uploader.start();
    window.__uploader.unbind("FileUploaded", fileUploadedHandler);
    window.__uploader.bind("FileUploaded", fileUploadedHandler);
    return;
  }

  const payload = getPayload();
  if (payload === null) {
    resetSubmitBtn();
    return;
  }

  const response = await api.edit({ ...payload, id: modalData.id });
  updateRowData(response.data);
  resetSubmitBtn();
  $($createModal).modal("hide");
});

async function fileUploadedHandler(_, __, result) {
  const payload = getPayload();
  if (payload === null) {
    resetSubmitBtn();
    return;
  }

  const response = JSON.parse(result.response);
  const { data } = response;
  payload.name = data.name;
  payload.size = data.size;

  try {
    const { data: newData } = await api.save(payload);
    inserRowData(newData);
    $($createModal).modal("hide");
  } catch (error) {
    console.error(error);
  } finally {
    resetSubmitBtn();
  }
}

function resetSubmitBtn() {
  const $submitBtn = $createModal.querySelector("button.primary");
  $submitBtn.textContent = $submitBtn.dataset.textDefault;
  $submitBtn.removeAttribute("disabled");
}

function getPayload() {
  const payload = {};
  const $inputs = $createForm.querySelectorAll("[data-type]");
  for (let index = 0; index < $inputs.length; index++) {
    const $input = $inputs[index];
    const name = $input.dataset.type;
    const value = $input.value.trim();

    if ($input.hasAttribute("required") && !value.length) {
      $input.focus();
      return null;
    }

    payload[name] = value;
  }

  return payload;
}

$($createModal).on("show.bs.modal", () => {
  // Reset files.
  window.__uploader.files.forEach((file) => {
    window.__uploader.removeFile(file);
  });

  // Reset input values.
  const $inputs = [...$createForm.querySelectorAll("[data-type]")];
  $inputs.forEach(($input) => {
    $input.value = "";
    $input.removeAttribute("disabled");
  });

  // Reset file select input.
  const $uploadGroup = $createModal.querySelector(".upload-group");
  const $uploadButton = $uploadGroup.querySelector(".ss-upload-btn");
  $uploadButton.classList.remove("disabled");

  const $uploadButtonText = $uploadButton.querySelector(".text");
  $uploadButtonText.textContent = $uploadButtonText.dataset.textDefault;

  const $uploadFeedback = $uploadGroup.querySelector(".invalid-feedback");
  $uploadFeedback.classList.remove("d-block");

  // Reset modal title.
  const $title = $createModal.querySelector(".modal-title");
  $title.textContent = $title.dataset.textDefault;

  const data = $createModal.__row;
  if (!data) return;

  $title.textContent = data.display_name;
  $inputs.forEach(($input) => {
    $input.value = data[$input.dataset.type];
  });

  $uploadButton.classList.add("disabled");
  $uploadButtonText.textContent = data.name;
});
$($createModal).on("hide.bs.modal", (event) => {
  if (isUploading()) {
    event.preventDefault();
    event.stopPropagation();
    return false;
  }

  $createModal.__row = null;
});

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
