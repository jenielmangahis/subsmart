window.document.addEventListener("DOMContentLoaded", async () => {
  window.api = await import("./api.js");
  window.helpers = await import("./helpers.js");
  window.jsPDF = window.jspdf.jsPDF;

  const params = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, prop) => searchParams.get(prop),
  });

  const { data: customer } = await window.api.getCustomer(params.customer_id);
  const $customerName = document.querySelector(".esigneditor__title span");
  $customerName.textContent = `${customer.first_name} ${customer.last_name}`;

  Promise.all([
    initCategories(),
    initLetters(),
    initSaveForm(customer),
    initPlaceholders(customer),
    initCustomerCustomFields(customer),
  ]).then(() => {
    handleSubmit(customer);
    document.querySelector(".wrapper").classList.remove("wrapper--loading");
  });
});

async function initCategories() {
  const { data: categories } = await window.api.getCategories();
  const $select = document.getElementById("category");
  categories.forEach((category) => {
    const $option = window.helpers.htmlToElement(
      `<option value="${category.id}">${category.name}</option>`
    );
    $select.appendChild($option);
  });

  $select.appendChild(
    window.helpers.htmlToElement(`<option value="favorite">Favorites</option>`)
  );

  if (categories.length) {
    const $option = $select.querySelector("option");
    initLetters($option.value);
  }

  $select.addEventListener("change", (event) => {
    initLetters(event.target.value);
  });
}

async function initLetters(categoryId) {
  if (categoryId === undefined) return;

  const $select = document.getElementById("letter");
  $select.innerHTML = "";

  $($select).select2({
    placeholder: "Select letter",
    ajax: {
      url: `${window.api.prefixURL}/EsignEditor/apiGetLetterByCategoryId/${categoryId}`,
      data: (params) => {
        const limit = 10;
        const page = params.page || 1;

        return {
          limit,
          search: params.term,
          offset: page === 1 ? 0 : (page - 1) * limit,
        };
      },
      processResults: (response) => {
        return {
          results: response.data.map((letter) => ({
            id: letter.id,
            text: letter.title,
          })),
          pagination: {
            more: !response.is_last,
          },
        };
      },
    },
  });
}

async function initPlaceholders(customer) {
  const $placeholderList = document.querySelector(".placeholders__list");
  $placeholderList.innerHTML = "";
  const { data: placeholders } = await window.api.getCustomerPlaceholders(
    customer.prof_id
  );
  placeholders.sort((a, b) => a.code.localeCompare(b.code));
  placeholders.forEach(appendPlaceholderInList);
}

function appendPlaceholderInList(placeholder) {
  const $placeholderList = document.querySelector(".placeholders__list");
  const $item = window.helpers.htmlToElement(
    `<li>
      {${placeholder.code}} - <strong>${placeholder.description}</strong>
    </li>`
  );
  $placeholderList.appendChild($item);
}

async function initCustomerCustomFields(customer) {
  let { data: customFields } = await window.api.getCustomerCustomFields(
    customer.prof_id
  );

  const $modal = document.getElementById("manageCustomFieldsModal");
  const $fieldsWrapper = $modal.querySelector(".fields");
  const template = $modal.querySelector("template");

  let copyId = 0;
  function createCopy() {
    copyId++;

    const $copy = document.importNode(template.content, true);
    const $root = $copy.querySelector(".customerCustomField");
    $root.setAttribute("data-id", copyId);

    const $button = $copy.querySelector(".btn");
    $button.addEventListener("click", () => {
      $root.remove();
    });

    $fieldsWrapper.append($copy);
    const $retval = $fieldsWrapper.querySelector(`[data-id="${copyId}"]`);
    $retval.scrollIntoView();
    return $retval;
  }

  // sets up add field link
  const $addLink = $modal.querySelector(".link");
  $addLink.addEventListener("click", (event) => {
    event.preventDefault();
    createCopy();
  });

  const $submit = $modal.querySelector("[data-action=submit]");
  $submit.addEventListener("click", async () => {
    // validate for empty value
    const $inputs = $modal.querySelectorAll("[data-key]");
    for (let index = 0; index < $inputs.length; index++) {
      const $input = $inputs[index];
      const value = $input.value.trim();

      if (!value.length) {
        $input.focus();
        return;
      }
    }

    const $customFields = $modal.querySelectorAll(".customerCustomField");
    const payload = [];
    $customFields.forEach(($field) => {
      const field = {};
      const $inputs = $field.querySelectorAll("[data-key]");
      $inputs.forEach(($input) => {
        field[$input.dataset.key] = $input.value.trim();
      });

      payload.push(field);
    });

    const result = await window.helpers.submitBtn($submit, () => {
      return Promise.all([
        window.api.saveCustomerCustomFields(customer.prof_id, { fields: payload }), // prettier-ignore
        initPlaceholders(customer),
      ]);
    });

    const [{ data }] = result;
    customFields = data;
    $($modal).modal("hide");
  });

  // set up advance customer link
  const $link = $modal.querySelector("[data-base-url]");
  const url = `${$link.dataset.baseUrl}/${customer.prof_id}?section=custom_field`;
  $link.setAttribute("href", url);

  $($modal).on("show.bs.modal", () => {
    $fieldsWrapper.innerHTML = "";
    customFields.forEach((field) => {
      const $copy = createCopy();
      const $inputs = $copy.querySelectorAll("[data-key]");
      $inputs.forEach(($input) => {
        $input.value = field[$input.dataset.key];
      });
    });
  });
}

function handleSubmit(customer) {
  const $form = document.getElementById("selectLetterForm");
  const $letterSelect = $form.querySelector("#letter");
  const $button = $form.querySelector(".btn-primary");
  const $exportAsPDFLink = $form.querySelector("[data-action=export]");
  const $backLink = $form.querySelector("[data-action=back]");
  const $letter = $("#letterContent");

  let isExporting = false;
  const exportAsPDF = (payload) => async (event) => {
    event.preventDefault();

    if (isExporting) return;

    isExporting = true;
    payload.content = $letter.summernote("code");
    const { data } = await window.helpers.submitBtn($exportAsPDFLink, () =>
      window.api.exportLetterAsPDF(payload)
    );

    isExporting = false;
    htmlToPDF(decodeHtml(data.content));
  };

  $button.addEventListener("click", async () => {
    const letterId = Number($letterSelect.value);
    if (Number.isNaN(letterId) || letterId <= 0) {
      return;
    }

    const { data: letter } = await window.helpers.submitBtn($button, () =>
      window.api.getLetter(letterId)
    );

    window.helpers.wysiwygEditor($letter, letter.content);

    $form.classList.add("wizardForm--step2");
    $exportAsPDFLink.removeEventListener("click", exportAsPDF);
    $exportAsPDFLink.addEventListener(
      "click",
      exportAsPDF({
        letter_id: letter.id,
        customer_id: customer.prof_id,
      })
    );
  });

  $backLink.addEventListener("click", (event) => {
    event.preventDefault();
    $form.classList.remove("wizardForm--step2");
  });
}

function htmlToPDF(string) {
  const doc = new jsPDF({
    orientation: "portrait",
    format: "a4",
    unit: "px",
    hotfixes: ["px_scaling"],
  });

  const margin = { x: 48, y: 48 };
  let { width, height } = doc.internal.pageSize;
  width = width - margin.x * 2;

  doc.html(
    `<div style="width:${width}px;">
      ${string}
    </div>`,
    {
      margin: [margin.y, margin.x, margin.y, margin.x],
      autoPaging: "text",
      callback: (doc) => {
        doc.output("dataurlnewwindow");
      },
    }
  );
}

// https://stackoverflow.com/a/7394787/8062659
function decodeHtml(html) {
  const txt = document.createElement("textarea");
  txt.innerHTML = html;
  return txt.value;
}

function initSaveForm(customer) {
  const $modal = document.getElementById("saveLetterModal");
  const $name = $modal.querySelector("[data-name=name]");
  const $saveButton = $modal.querySelector(".btn");
  const $toggleButtons = $("[data-action=save_for_later], [data-action=save_and_print]"); // prettier-ignore
  const $letter = $("#letterContent");
  const $letterSelect = document.querySelector("#selectLetterForm #letter");

  $toggleButtons.on("click", (event) => {
    $modal.setAttribute("data-action", event.target.dataset.action);
    $($modal).modal("show");
  });

  $saveButton.addEventListener("click", async () => {
    const name = $name.value.trim();
    if (!name.length) {
      $name.focus();
      return;
    }

    const payload = {
      name,
      customer_id: customer.prof_id,
      letter_id: $letterSelect.value,
      content: $letter.summernote("code"),
    };

    await window.helpers.submitBtn($saveButton, () =>
      window.api.createCustomerLetter(payload)
    );

    if ($modal.dataset.action === "save_and_print") {
      window.location.href = `${window.api.prefixURL}/EsignEditor/customers/${customer.prof_id}`;
    } else {
      $($modal).modal("hide");
    }
  });

  $($modal).on("show.bs.modal", () => {
    $name.value = "";
  });
}
