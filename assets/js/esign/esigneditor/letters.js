window.document.addEventListener("DOMContentLoaded", async () => {
  window.api = await import("./api.js");
  window.helpers = await import("./helpers.js");

  await initCategories();
  await initCustomers();

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
    let actions = [
      {
        value: "edit",
        text: "Edit",
        isPrimary: true,
      },
      {
        value: "delete",
        text: "Delete",
      },
      {
        value: "print",
        text: "Print",
      },
      {
        value: "duplicate",
        text: "Duplicate",
      },
      {
        value: "send_pdf",
        text: "Send PDF",
      },
    ];

    if (row.user_id === null) {
      actions = actions.filter((action) => {
        return !["edit", "delete"].includes(action.value);
      });

      actions = actions.map((action) => {
        action.isPrimary = action.value === "duplicate";
        return action;
      });
    }

    const primary = actions.find((action) => action.isPrimary);
    const menus = actions.map((action) => {
      if (action.isPrimary) return null;
      return `
      <li>
        <a class="dropdown-item" href="#" data-action="${action.value}">
          ${action.text}
        </a>
      </li>
      `;
    });

    return `
    <div class="dropdown table-management">
      <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
          <i class="bx bx-fw bx-dots-vertical-rounded"></i>
      </a>
      <ul class="dropdown-menu dropdown-menu-end">
        <li>
          <a class="dropdown-item" href="#" data-action="${primary.value}">
            ${primary.text}
          </a>
        </li>
        ${menus.join("")}
      </ul>
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
  print: (row) => {
    if (window.__isExporting === true) {
      return;
    }

    const $modal = document.getElementById("customersModal");
    const $next = removeButtonListeners($modal.querySelector(".btn-primary"));

    $next.addEventListener("click", async () => {
      const $selected = $modal.querySelector(".customer--isSelected");
      if (!$selected) return;

      const payload = {
        content: row.content,
        letter_id: row.id,
        customer_id: $selected.dataset.id,
      };

      window.__isExporting = true;
      const { data } = await window.helpers.submitBtn($next, () =>
        window.api.exportLetterAsPDF(payload)
      );

      window.helpers.htmlToPDF(data.content);
      window.__isExporting = false;
    });

    $($modal).modal("show");
  },
  send_pdf: (row) => {
    const $modal = document.getElementById("customersModal");
    const $next = removeButtonListeners($modal.querySelector(".btn-primary"));

    const $sendModal = document.getElementById("sendLetterModal");
    const $preview = $sendModal.querySelector(".preview");
    const $sendBtn = removeButtonListeners($sendModal.querySelector(".btn-primary")); // prettier-ignore

    async function sendEmailHandler() {
      const { is_sent } = await window.helpers.submitBtn($sendBtn, async () => {
        const payload = {};
        const $inputs = $sendModal.querySelectorAll("[data-type]");

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

        const pdfUri = await window.helpers.generatePDF($preview.innerHTML);
        const response = await fetch(pdfUri);
        const pdf = await response.blob();

        const form = new FormData();
        form.append("subject", payload.subject);
        form.append("email", payload.email);
        form.append("message", payload.message);
        form.append("pdf", pdf);

        await window.helpers.sleep(1);
        return window.api.emailCustomerLetter(form);
      });

      if (is_sent !== true) {
        const $alert = $($sendModal).find("[data-step=email] .alert-danger");
        $alert.removeClass("d-none");
        $($sendModal).get(0).scrollTo({ top: 0, behavior: "smooth" });
      } else {
        $($sendModal).modal("hide");
      }
    }

    async function nextHandler() {
      const $selected = $modal.querySelector(".customer--isSelected");
      if (!$selected) return;

      const payload = {
        content: row.content,
        letter_id: row.id,
        customer_id: $selected.dataset.id,
      };
      const { data } = await window.helpers.submitBtn($next, () =>
        window.api.exportLetterAsPDF(payload)
      );
      $preview.innerHTML = `<div class="preview__item">${data.content}</div>`;

      $sendBtn.addEventListener("click", sendEmailHandler);
      $($modal).modal("hide");
      $($sendModal).modal("show");
    }

    $next.addEventListener("click", nextHandler);
    $($modal).modal("show");
  },
  duplicate: async (row) => {
    const { data } = await window.api.duplicateLetter(row.id);
    window.location.href = `${window.api.prefixURL}/EsignEditor/edit?id=${data.id}`;
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

async function initCustomers() {
  const { data: customers } = await window.api.getCustomers();
  const $modal = document.getElementById("customersModal");

  const $fragment = document.createDocumentFragment();
  customers.forEach((customer) => {
    $fragment.appendChild(createCustomer(customer));
  });
  const $customers = $modal.querySelector(".customers");
  $customers.appendChild($fragment);

  $($modal).on("hidden.bs.modal", () => {
    unselectAllCustomers();
  });
}

function createCustomer(customer) {
  const $modal = document.getElementById("customersModal");
  const $template = $modal.querySelector("template");

  const $copy = document.importNode($template.content, true);
  const name = `${customer.first_name} ${customer.last_name}`;

  const $image = $copy.querySelector(".customer__img");
  $image.setAttribute("alt", name);
  $image.setAttribute("src", customer.profile);

  const $name = $copy.querySelector(".customer__name");
  $name.textContent = name;

  const $email = $copy.querySelector(".customer__email");
  $email.textContent = customer.email || customer.phone_m;

  const $customer = $copy.querySelector(".customer");
  $customer.setAttribute("data-id", customer.prof_id);

  $customer.addEventListener("click", () => {
    unselectAllCustomers();
    $customer.classList.add("customer--isSelected");
  });

  return $customer;
}

function unselectAllCustomers() {
  const $modal = document.getElementById("customersModal");
  const $selected = [...$modal.querySelectorAll(".customer--isSelected")];

  $selected.forEach(($node) => {
    $node.classList.remove("customer--isSelected");
  });
}

function removeButtonListeners($button) {
  const $newButton = $button.cloneNode(true);
  $button.parentNode.replaceChild($newButton, $button);
  return $newButton;
}
