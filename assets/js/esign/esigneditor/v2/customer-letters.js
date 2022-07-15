window.document.addEventListener("DOMContentLoaded", async () => {
  window.api = await import("../api.js");
  window.helpers = await import("../helpers.js");
  window.jsPDF = window.jspdf.jsPDF;
  window.PDFDocument = window.PDFLib.PDFDocument;

  const parts = window.location.pathname.split("/");
  const customerId = parts.pop();

  const { data: customer } = await window.api.getCustomer(customerId);
  const $title = document.querySelector(".nsm-page-title h4");
  $title.textContent = `Send Letters (${customer.first_name} ${customer.last_name})`;

  Promise.all([initTable(customer), initSendModal()]).then(() => {
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
    status: (_, __, row) => {
      return row.print_status;
    },
    sentAt: (_, __, row) => {
      if (row.sent_at === null) return "—";
      return moment(row.sent_at).format("MM/DD/YYYY h:mmA");
    },
    actions: () => {
      return `
      <div>
        <button class=" nsm-button primary action" data-action="preview">
          View/Edit
        </button>
        <button class="nsm-button action" data-action="delete">
          <fa class="fa fa-trash"></fa>
        </button>
      </div>
      `;
    },
  };

  const actions = {
    preview: (letter, table) => {
      const $modal = $("#letterModal");
      const $button = $modal.find(".nsm-button.primary");

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
        render: columns.status,
        sortable: false,
      },
      {
        render: columns.sentAt,
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

  const $filter = $("[name=letterStatusFilter]");
  $filter.on("change", () => {
    $selected = $("[name=letterStatusFilter]:checked");
    let filtered = null;
    if ($selected.val() === "unprinted") {
      filtered = data.filter((row) => {
        return row.print_status === "Pending Print";
      });
    }

    table.clear();
    table.rows.add(filtered === null ? data : filtered).draw();
    $table.find(".table__checkbox--primary").prop("checked", false);
  });
}

function initSendModal() {
  const $modal = $("#sendLetterModal");
  const $radios = $modal.find("[name=sendOption]");
  const $print = $modal.find("#sendOptionPrint");
  const $nextBtn = $modal.find("[data-action=next]");
  const $modalTrigger = $("[data-action=select-send-option]");
  const $printBtn = $modal.find("[data-action=print]");
  const $emailBtn = $modal.find("[data-action=email]");

  const generatePDF = () => {
    const $previews = $modal.find(".preview__item");
    const htmls = [...$previews.map((_, $preview) => $preview.innerHTML)];
    return window.helpers.generatePDF(htmls);
  };

  const updateTable = (updatedRows) => {
    const $table = document.getElementById("letters");
    const table = $($table).DataTable();
    updatedRows.forEach((letter) => {
      table.row(`#row${letter.id}`).data(letter).draw();
    });

    const $checkbox = $table.querySelector(".table__checkbox--primary");
    $checkbox.indeterminate = false;
    $checkbox.checked = false;

    const $selected = $table.querySelectorAll(".table__row--selected");
    [...$selected].forEach(($row) => {
      $row.querySelector(".table__checkbox").checked = false;
      $row.classList.remove("table__row--selected");
    });
  };

  $modalTrigger.on("click", () => {
    const $table = $("#letters");
    const $selectedRows = $table.find(".table__row--selected");

    if ($selectedRows.length) {
      $modal.modal("show");
    }
  });

  $radios.on("change", (event) => {
    const $prevActive = document.querySelector(".sendLetter__option--active");
    if ($prevActive) {
      $prevActive.classList.remove("sendLetter__option--active");
    }

    const $parent = event.target.closest(".sendLetter__option");
    $parent.classList.add("sendLetter__option--active");
  });

  $nextBtn.on("click", async () => {
    const $selected = $modal.find("[name=sendOption]:checked");
    const method = $selected.val();

    let $previewContainer = $modal.find("[data-step=email] .preview");
    if (method === "print") {
      $previewContainer = $modal.find("[data-step=print] .preview");
    }

    const ids = getSelectedRowData().map((row) => row.id);
    const { data: letters } = await window.helpers.submitBtn($nextBtn, () =>
      window.api.printCustomerLetters({ ids })
    );

    $previewContainer.empty();
    letters.forEach((letter) => {
      $previewContainer.append(`<div class="preview__item">${letter}</div>`);
    });

    $modal.get(0).dataset.stepActive = method;
  });

  $printBtn.on("click", () => {
    window.helpers.submitBtn($printBtn, async () => {
      const docUri = await generatePDF();
      const letters = getSelectedRowData().map((row) => ({
        id: row.id,
        print_status: "Printed/Sent",
        sent_at: moment().format("YYYY-MM-DD H:mm:ss"),
      }));

      const response = await window.api.batchEditCustomerLetters({ letters });
      await window.helpers.sleep(1);

      const win = window.open("", "_blank");
      win.document.write(`
        <html>
          <body style="margin:0!important">
            <embed width="100%" height="100%" src="${docUri}" type="application/pdf" />
          </body>
        </html>
      `);

      $modal.modal("hide");
      updateTable(response.data);
    });
  });

  $emailBtn.on("click", () => {
    window.helpers.submitBtn($emailBtn, async () => {
      const payload = {};
      const $inputs = $modal.find("[data-type]");

      for (let index = 0; index < $inputs.length; index++) {
        const $input = $inputs[index];
        const value = $input.value.trim();
        const key = $input.dataset.type;

        if (!value.length) {
          $input.focus();
          return;
        }

        if (key === "email" && !window.helpers.isEmail(value)) {
          $input.focus();
          return;
        }

        payload[key] = value;
      }

      const ids = getSelectedRowData().map((row) => row.id);
      const pdfUri = await generatePDF();
      const response = await fetch(pdfUri);
      const pdf = await response.blob();

      const form = new FormData();
      form.append("ids", ids);
      form.append("subject", payload.subject);
      form.append("email", payload.email);
      form.append("message", payload.message);
      form.append("pdf", pdf);

      await window.helpers.sleep(1);
      const sendResponse = await window.api.emailCustomerLetter(form);
      if (sendResponse.is_sent !== true) {
        const $alert = $modal.find("[data-step=email] .alert-danger");
        $alert.removeClass("d-none");
        $modal.get(0).scrollTo({ top: 0, behavior: "smooth" });
      } else {
        $modal.modal("hide");
        updateTable(sendResponse.data);
      }
    });
  });

  $($modal).on("show.bs.modal", () => {
    const $inputs = $modal.find("[data-type]");
    $inputs.each((_, $input) => {
      $input.value = "";
    });

    $print.trigger("change");
    $print.prop("checked", true);
    $modal.get(0).dataset.stepActive = "select";

    const $alert = $modal.find("[data-step=email] .alert-danger");
    $alert.addClass("d-none");
  });
}

function getSelectedRowData() {
  const $table = $("#letters");
  const table = $table.DataTable();
  const rowsData = [];
  table.rows(".table__row--selected").every((index) => {
    rowsData.push(table.row(index).data());
  });

  return rowsData;
}
