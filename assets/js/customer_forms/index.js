import * as api from "./api.js";

const $table = document.getElementById("customformstable");
const $modal = document.getElementById("cf--modal");
const $modalForm = $modal.querySelector("form");

const $dropdown = document.getElementById("formdropdown");
const $formList = $dropdown.querySelector(".dropdown-menu");
const $dropdownText = $dropdown.querySelector(".dropdown-toggle span");

const $loader = document.querySelector(".customerforms-loader");
const $search = document.getElementById("labelssearch");

window.document.addEventListener("DOMContentLoaded", async () => {
  const columns = getColumns();
  const table = $($table).DataTable({
    bInfo: false,
    bLengthChange: false,
    ajax: {
      url: `${api.prefixURL}/CustomerForms/apiGetLabels`,
      data: (param) => {
        $loader.classList.remove("hide");
        param.form = $formList.dataset.form;
        return param;
      },
      dataSrc: (json) => {
        const form = $formList.dataset.form;
        const $item = $formList.querySelector(`[data-form="${form}"]`);

        $dropdownText.textContent = $item.textContent.trim();
        $loader.classList.add("hide");

        return json.data;
      },
    },
    columns: [
      {
        render: columns.name,
        sortable: false,
      },
      {
        render: columns.customName,
        sortable: false,
      },
      {
        render: columns.hidden,
        sortable: false,
      },
      {
        render: columns.actions,
        sortable: false,
      },
    ],
    rowId: (row) => `row${row.index}`,
    createdRow: (row, data) => {
      $(row).attr("data-index", data.index);
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

    const rowIndex = $parent.dataset.index;
    const row = rows.find(({ index }) => index == rowIndex);

    const action = $target.dataset.action;
    if (!action || !actions[action]) return;

    const func = actions[action].bind(this);
    await func(row);
  });

  $($formList)
    .find("li a")
    .click(function (event) {
      event.preventDefault();

      const currForm = $formList.dataset.form;
      const nextForm = this.dataset.form;

      if (currForm !== nextForm) {
        $dropdownText.textContent = this.textContent.trim();
        $formList.setAttribute("data-form", nextForm);
        table.ajax.reload();
      }
    });

  $search.addEventListener("input", function () {
    table.search(this.value).draw();
  });
});

function getColumns() {
  return {
    name: (_, __, row) => {
      return `
        <div class="content-subtitle fw-bold">
          ${row.name}
        </div>
    `;
    },
    customName: (_, __, row) => {
      if (!row.custom) {
        return `<div class="content-subtitle">--</div>`;
      }

      if (row.custom.name === row.name) {
        return `<div class="content-subtitle">--</div>`;
      }

      return `<div class="content-subtitle">${row.custom.name}</div>`;
    },
    hidden: (_, __, row) => {
      if (row.custom && row.custom.is_hidden == "1") {
        return `<div class="content-subtitle">Yes</div>`;
      }

      return `<div class="content-subtitle">--</div>`;
    },
    actions: (_, __, row) => {
      const isHidden = row.custom && row.custom.is_hidden == "1";

      const buttons = {
        rename: `
          <button type="button" class="nsm-button" data-action="rename">
            <i class="bx bx-fw bx-pencil"></i> <span>Rename</span>
          </button>
        `,
        hide: `
          <button type="button" class="nsm-button" data-action="hide">
            <i class="bx bx-fw bx-hide"></i> <span>Hide</span>
          </button>
        `,
        unhide: `
          <button type="button" class="nsm-button" data-action="unhide">
            <i class="bx bx-fw bx-show"></i> <span>Unhide</span>
          </button>
        `,
      };

      return `
        <div class="d-flex" style="width: max-content;">
          ${[buttons.rename, buttons[isHidden ? "unhide" : "hide"]].join("")}
        </div>
    `;
    },
  };
}

function getActions() {
  const updateIsHidden = async (row, isHiddenValue) => {
    const payload = {
      name: row.custom ? row.custom.name : row.name,
      default: row.name,
      form: row.form,
      is_hidden: isHiddenValue,
    };

    const action = Boolean(isHiddenValue) ? "hide" : "unhide";
    const $row = $table.querySelector(`#row${row.index}`);
    const $button = $row.querySelector(`[data-action="${action}"]`);
    const $buttonText = $button.querySelector("span");

    $button.setAttribute("disabled", true);
    $buttonText.textContent = "Saving...";

    const response = await api.saveCustomName(payload);
    updateRowData({ ...row, custom: response.data });
  };

  return {
    rename: async (row) => {
      if ($modal.hasAttribute("data-saving")) {
        return;
      }

      $modal.__row = row;
      $($modal).modal("show");
    },
    hide: (row) => {
      updateIsHidden(row, 1);
    },
    unhide: (row) => {
      updateIsHidden(row, 0);
    },
  };
}

$($modal).on("show.bs.modal", () => {
  const data = $modal.__row;
  const $input = $modal.querySelector("input");
  const $text = $modal.querySelector(".form-text");
  const name = data.custom ? data.custom.name : data.name;

  $input.value = name;
  $input.setAttribute("placeholder", $modal.__row.name);
  $text.innerHTML = `You are about to rename the <i>${name}</i>.`;
});

$modalForm.addEventListener("submit", async (event) => {
  event.preventDefault();

  const $input = $modalForm.querySelector("input");
  const $submit = $modalForm.querySelector(".nsm-button");

  const value = $input.value.trim();
  if (!value.length) {
    $input.focus();
    return;
  }

  $submit.setAttribute("disabled", true);
  $modal.setAttribute("data-saving", true);
  const submitText = $submit.textContent;
  $submit.textContent = "Saving...";

  const data = $modal.__row;
  const payload = { default: data.name, name: value, form: data.form };
  const response = await api.saveCustomName(payload);
  updateRowData({ ...data, custom: response.data });

  $submit.removeAttribute("disabled");
  $modal.removeAttribute("data-saving");
  $submit.textContent = submitText;

  $($modal).modal("hide");
});

function updateRowData(data) {
  const table = $($table).DataTable();
  table.row(`#row${data.index}`).data(data).draw();
}
