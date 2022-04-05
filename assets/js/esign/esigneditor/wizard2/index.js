window.document.addEventListener("DOMContentLoaded", async () => {
  window.api = await import("../api.js");
  window.helpers = await import("../helpers.js");

  const params = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, prop) => searchParams.get(prop),
  });

  const { data: customer } = await window.api.getCustomer(params.customer_id);
  const $customerName = document.querySelector(".esigneditor__title span");
  $customerName.textContent = `${customer.first_name} ${customer.last_name}`;

  Promise.all([
    initCategories(),
    initPlaceholders(customer),
    initCustomerCustomFields(customer),
  ]).then(() => {
    document.querySelector(".wrapper").classList.remove("wrapper--loading");
  });

  const $actions = document.querySelectorAll("[data-action]");
  const actions = {
    on_no_dispute: onNoDispute,
    on_no_dispute_back: onNoDisputeBack,
    on_choose_letter_type: onChooseLetterType,
    on_choose_letter_recipient: onChooseLetterRecipient,
    step2_save_and_continue: step2SaveContinue,
    on_add_to_dispute: addToDispute,
    on_no_dispute_next: onNoDisputeNext,
    on_back_to_part1: onBackToPart1,
    on_export_pdf: () => onExportPDF(customer),
  };

  $actions.forEach(($action) => {
    const key = $action.dataset.action;
    if (typeof actions[key] !== "function") return;

    const eventType = $($action).is(":radio") ? "change" : "click";
    $action.addEventListener(eventType, actions[key]);
  });

  const $addItemModal = document.getElementById("additemmodal");
  $($addItemModal).on("show.bs.modal", displayCustomerDisputeItems);
});

function onNoDispute() {
  const $step1 = document.querySelector(".step-1");
  const $step2 = document.querySelector(".step-2");
  const $step3 = document.querySelector(".step-3");
  const $radios = $step1.querySelectorAll("[type=radio");
  const $selects = $step1.querySelector(".step__1Selects");
  const $chooseLetter = $step1.querySelector(".step__chooseLetter");
  const $recipientSelect = $step1.querySelector(".step__letterRecipient");

  $step1.classList.add("step--active");
  $step2.classList.add("d-none");
  $selects.classList.add("step--disabled");
  $chooseLetter.classList.remove("d-none");
  $radios.forEach(($radio) => {
    $radio.checked = false;
  });
  $recipientSelect.classList.add("d-none");
  $step3.classList.add("d-none");
}

function onNoDisputeBack() {
  const $step1 = document.querySelector(".step-1");
  const $step2 = document.querySelector(".step-2");
  const $step3 = document.querySelector(".step-3");
  const $radios = $step1.querySelectorAll("[type=radio");
  const $selects = $step1.querySelector(".step__1Selects");
  const $chooseLetter = $step1.querySelector(".step__chooseLetter");
  const $step2Form = $step2.querySelector(".step__step2Form");
  const $step2Message = $step2.querySelector(".step__step2Message");
  const $step2DisputeCols = $step2.querySelectorAll(".step__step2DisputeCol");

  $selects.classList.remove("step--disabled");
  $step2.classList.remove("d-none");
  $step2.classList.remove("step--active");
  $step2.classList.add("step--disabled");
  $chooseLetter.classList.add("d-none");
  $radios.forEach(($radio) => {
    $radio.checked = false;
  });
  $step2Form.classList.add("d-none");
  $step2Message.classList.remove("d-none");
  $step3.classList.add("d-none");
  $step2DisputeCols.forEach(($col) => {
    $col.classList.remove("d-none");
  });
}

function onChooseLetterType(event) {
  const $step1 = document.querySelector(".step-1");
  const $step2 = document.querySelector(".step-2");
  const $step3 = document.querySelector(".step-3");
  const $recipientSelect = $step1.querySelector(".step__letterRecipient");
  const $recipient1 = $recipientSelect.querySelector("#recipient1");
  const $step2Form = $step2.querySelector(".step__step2Form");
  const $step2Message = $step2.querySelector(".step__step2Message");
  const $step2GenerateLetterBtn = $step2.querySelector("[data-action=step2_generate_letter]"); // prettier-ignore
  const $step2SaveContinue = $step2.querySelector("[data-action=step2_save_and_continue]"); // prettier-ignore

  $step1.classList.remove("step--active");
  $step2.classList.remove("step--disabled");
  $step2.classList.add("step--active");
  $step2Form.classList.remove("d-none");

  if (event.target.value === "round1") {
    $recipientSelect.classList.add("d-none");
    $step3.classList.add("d-none");
    $step3.classList.remove("step--active");
    $step3.classList.add("step--disabled");

    $step2Message.classList.remove("d-none");
    $step2GenerateLetterBtn.classList.remove("d-none");
    $step2SaveContinue.classList.add("d-none");
  } else {
    $recipient1.checked = true;
    $recipientSelect.classList.remove("d-none");
    $step3.classList.remove("d-none");
    $step2Message.classList.add("d-none");
    $step2GenerateLetterBtn.classList.add("d-none");
    $step2SaveContinue.classList.remove("d-none");
  }
}

function onChooseLetterRecipient() {
  const $table = $("#selecteddisputeitemstable");
  if (!$.fn.DataTable.isDataTable($table)) return;

  const table = $table.DataTable();
  // 3, 4, 5 are the columns of equifax, experian, and transunion
  [3, 4, 5].forEach((colNumber) => {
    const column = table.column(colNumber);
    column.visible(!column.visible());
  });
}

async function onNoDisputeNext() {
  const $letterSelect = document.getElementById("chooseLetter_letter");
  const letterId = Number($letterSelect.value);
  if (Number.isNaN(letterId) || letterId <= 0) {
    return;
  }

  const $button = document.querySelector("[data-action=on_no_dispute_next]");
  const { data: letter } = await window.helpers.submitBtn($button, () =>
    window.api.getLetter(letterId)
  );

  const $letter = $("#letterContent");
  window.helpers.wysiwygEditor($letter, letter.content);

  document.querySelector(".part1").classList.add("d-none");
  document.querySelector(".part2").classList.remove("d-none");
  document.querySelector(".letterInfo").classList.add("d-none");
}

function onBackToPart1() {
  document.querySelector(".part1").classList.remove("d-none");
  document.querySelector(".part2").classList.add("d-none");
  document.querySelector(".letterInfo").classList.remove("d-none");
}

async function onExportPDF(customer) {
  if (window.__wizardIsExporting) return;

  const $letterSelect = document.getElementById("chooseLetter_letter");
  const letterId = Number($letterSelect.value);
  if (Number.isNaN(letterId) || letterId <= 0) {
    return;
  }

  const $button = document.querySelector("[data-action=on_export_pdf]");
  window.__wizardIsExporting = false;

  const payload = {
    letter_id: letterId,
    customer_id: customer.prof_id,
  };

  const $letter = $("#letterContent");
  payload.content = $letter.summernote("code");

  const { data } = await window.helpers.submitBtn($button, () =>
    window.api.exportLetterAsPDF(payload)
  );

  window.helpers.htmlToPDF(data.content);
  window.__wizardIsExporting = false;
}

function step2SaveContinue() {
  const $step1 = document.querySelector(".step-1");
  const $step2 = document.querySelector(".step-2");
  const $step3 = document.querySelector(".step-3");

  $step1.classList.remove("step--active");
  $step2.classList.remove("step--active");
  $step3.classList.remove("step--disabled");
  $step3.classList.add("step--active");
}

async function displayCustomerDisputeItems(event) {
  const $modal = event.target;
  const $table = $modal.querySelector("table");

  if (!$.fn.DataTable.isDataTable($table)) {
    const { Table } = await import("./pendingitemsdatatable.js");
    new Table();
  }
}

async function addToDispute() {
  const pending = await import("./pendingitemsdatatable.js");
  if (pending.Table.getSelectedRowsData().length) {
    const selected = await import("./selecteditemsdatatable.js");
    $("#additemmodal").modal("hide");
    new selected.Table();
  }
}

async function initCategories() {
  const { data: categories } = await window.api.getCategories();
  const $select = document.getElementById("chooseLetter_category");

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

  const $select = document.getElementById("chooseLetter_letter");
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
