window.document.addEventListener("DOMContentLoaded", async () => {
  window.api = await import("./api.js");
  window.helpers = await import("./helpers.js");

  const parts = window.location.pathname.split("/");
  const customerId = parts.pop();

  const { data: customer } = await window.api.getCustomer(customerId);
  const $customerName = document.querySelector(".esigneditor__title span");
  $customerName.textContent = `${customer.first_name} ${customer.last_name}`;

  Promise.all([initTable(customer)]).then(() => {
    document.querySelector(".wrapper").classList.remove("wrapper--loading");
  });
});

async function initTable(customer) {
  const { data } = await window.api.getCustomerLetters(customer.prof_id);
  const $table = $("#letters");
  const $letter = $("#letterTextarea");

  window.helpers.wysiwygEditor($letter);

  const columns = {
    checkbox: () => {
      return '<input type="checkbox" class="table__checkbox" />';
    },
    title: (_, __, row) => {
      return row.name;
    },
    created: (_, __, row) => {
      return moment(row.created_at).fromNow();
    },
    actions: () => {
      return `
      <div>
        <button class="btn btn-sm btn-primary mr-1 action" data-action="preview">
          View/Edit
        </button>
        <button class="btn btn-light btn-sm action" data-action="delete">
          <fa class="fa fa-trash"></fa>
        </button>
      </div>
      `;
    },
  };

  const actions = {
    preview: (letter, table) => {
      const $modal = $("#letterModal");
      const $button = $modal.find(".btn-primary.esigneditor__btn");

      $modal.find("[name=name]").val(letter.name);
      $letter.summernote("code", letter.content);
      $modal.modal("show");

      $button.off();
      $button.on("click", async () => {
        await window.helpers.submitBtn($button.get(0), async () => {
          const payload = { ...letter, content: $letter.summernote("code") };
          const response = await window.api.editCustomerLetter(payload);
          table.row(`#row${letter.id}`).data(response.data).draw();
          $modal.modal("hide");
        });
      });
    },
    delete: async (letter, table) => {
      const message =
        "Are you sure you want to delete this letter? This will permanently delete this letter from this client's account too.";
      if (!confirm(message)) {
        return;
      }

      await window.api.deleteCustomerLetter(letter.id);
      table.row(`#row${letter.id}`).remove().draw();
    },
  };

  function onCheckboxStateChange() {
    const $rows = $table.find("tr[data-id]");
    const $selected = $table.find(".table__row--selected");
    const $mainCheckbox = $table.find("th .table__checkbox").get(0);

    if ($selected.length === $rows.length) {
      $mainCheckbox.indeterminate = false;
      $mainCheckbox.checked = true;
      return;
    }

    if ($selected.length >= 1) {
      $mainCheckbox.indeterminate = true;
      return;
    }

    $mainCheckbox.indeterminate = false;
    $mainCheckbox.checked = false;
  }

  const table = $table.DataTable({
    data,
    paging: false,
    filter: false,
    bInfo: false,
    columns: [
      {
        render: columns.checkbox,
        sortable: false,
        class: "table__selectColumn",
      },
      {
        render: columns.title,
        sortable: false,
      },
      {
        render: columns.created,
        sortable: false,
      },
      {
        render: columns.actions,
        class: "table__actions",
      },
    ],
    rowId: (row) => `row${row.id}`,
    createdRow: (row, data) => {
      $(row).attr("data-id", data.id);
    },
  });

  table.on("click", "th .table__checkbox", (event) => {
    const isChecked = event.target.checked;
    const rows = table.rows({ search: "applied" }).nodes();
    $("input[type=checkbox]", rows).prop("checked", isChecked);

    const func = isChecked ? "addClass" : "removeClass";
    $(rows)[func]("table__row--selected");
    onCheckboxStateChange();
  });

  table.on(
    "change",
    ".table__checkbox:not(.table__checkbox--primary)",
    (event) => {
      const $parent = $(event.target).closest("tr");

      if (event.target.checked) {
        $parent.addClass("table__row--selected");
      } else {
        $parent.removeClass("table__row--selected");
      }

      onCheckboxStateChange();
    }
  );

  table.on("click", ".action", async (event) => {
    event.preventDefault();

    const $target = $(event.currentTarget);
    const $parent = $target.closest("tr");
    const rows = table.rows().data().toArray();

    const rowId = $parent.data("id");
    const row = rows.find(({ id }) => id == rowId);

    const action = $target.data("action");
    const func = actions[action];

    if (!func) return;
    func(row, table, event);
  });
}
