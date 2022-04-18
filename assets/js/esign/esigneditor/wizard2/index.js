window.document.addEventListener("DOMContentLoaded", async () => {
  window.api = await import("../api.js");
  window.helpers = await import("../helpers.js");

  const params = window.helpers.getParams();
  const { data: customer } = await window.api.getCustomer(params.customer_id);
  const $customerName = document.querySelector(".esigneditor__title span");
  $customerName.textContent = `${customer.first_name} ${customer.last_name}`;

  Promise.all([
    initCategories(),
    initPlaceholders(customer),
    initCustomerCustomFields(customer),
    initSaveForm(customer),
    initAddCreditorForm(),
    initDisputeForm(),
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
    step2_generate_letter: () => step2GenerateLetter(customer),
    on_export_pdf: () => onExportPDF(customer),
    step3_generate_letter: () => step3GenerateLetter(customer),
    show_creditor_modal: showCreditorModal,
    show_manage_reasons_modal: showManageReasonsModal,
    back_to_add_dispute_modal: backToAddDisputeModal,
    toggle_add_creaditor_modal_optional_inputs: toggleAddCreaditorModalOptionalInputs, // prettier-ignore
    add_new_reasons: addNewReasons,
    hide_reason_form: hideReasonForm,
    toggle_instructions: toggleInstructions,
    save_creditor: saveCreditor,
    save_reason: saveReason,
    save_dispute_item: () => saveDisputeItem(customer),
    to_customer_dashboard: () => toDustomerDashboard(customer),
    to_customer_dispute_items: () => toCustomerDisputeItems(customer),
  };

  $actions.forEach(($action) => {
    const key = $action.dataset.action;
    if (typeof actions[key] !== "function") return;

    const eventType = $($action).is(":radio") ? "change" : "click";
    $action.addEventListener(eventType, actions[key]);
  });

  const $addItemModal = document.getElementById("additemmodal");
  $($addItemModal).on("show.bs.modal", displayCustomerDisputeItems);

  const $reasonsModal = document.getElementById("manageReasonModal");
  $($reasonsModal).on("show.bs.modal", displayReasons);
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
    window.helpers.showError("Choose letter name");
    return;
  }

  const $button = document.querySelector("[data-action=on_no_dispute_next]");
  const { data: letter } = await window.helpers.submitBtn($button, () =>
    window.api.getLetter(letterId)
  );

  const $letter = $("#letterContent");
  window.helpers.wysiwygEditor($letter, letter.content);
  window.__wizardLetterId = letter.id;

  document.querySelector(".part1").classList.add("d-none");
  document.querySelector(".part2").classList.remove("d-none");
  document.querySelector(".letterInfo").classList.add("d-none");
}

function onBackToPart1() {
  document.querySelector(".part1").classList.remove("d-none");
  document.querySelector(".letterInfo").classList.remove("d-none");

  const $part2 = document.querySelector(".part2");
  $part2.classList.add("d-none");
  $part2.classList.remove("part2--withdispute");
}

async function onExportPDF(customer) {
  if (window.__wizardIsExporting) return;

  let letterId = window.__wizardLetterId;
  if (!letterId) {
    const $letterSelect = document.getElementById("chooseLetter_letter");
    letterId = Number($letterSelect.value);
    if (Number.isNaN(letterId) || letterId <= 0) {
      window.helpers.showError("Choose letter name");
      return;
    }
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

async function step2SaveContinue() {
  if (!(await getSelectedDisputeItemRows()).length) {
    window.helpers.showError("Please select at least one dispute item.");
    return;
  }

  const $step1 = document.querySelector(".step-1");
  const $step2 = document.querySelector(".step-2");
  const $step3 = document.querySelector(".step-3");

  $step1.classList.remove("step--active");
  $step2.classList.remove("step--active");
  $step3.classList.remove("step--disabled");
  $step3.classList.add("step--active");
}

async function getSelectedDisputeItemRows() {
  const $table = document.getElementById("selecteddisputeitemstable");
  if (!$.fn.DataTable.isDataTable($table)) return [];

  const { Table } = await import("./selecteditemsdatatable.js");
  const rows = Table.getRowsData();
  return rows;
}

async function step2GenerateLetter(customer) {
  const rows = await getSelectedDisputeItemRows();
  if (!rows.length) {
    window.helpers.showError("Please select at least one dispute item.");
    return;
  }

  const $button = document.querySelector("[data-action=step2_generate_letter]");
  const response = await window.helpers.submitBtn($button, () => {
    return window.api.generateDisputeLetter({
      customer_id: customer.prof_id,
      dispute_ids: rows.map((row) => row.id),
    });
  });

  window.__wizardLetterId = response.letter_id;
  displayGeneratedDisputeLetter(response);
}

async function step3GenerateLetter(customer) {
  const rows = await getSelectedDisputeItemRows();
  if (!rows.length) {
    window.helpers.showError("Please select at least one dispute item.");
    return;
  }

  const $letterSelect = document.getElementById("step3_letter");
  const letterId = Number($letterSelect.value);
  if (Number.isNaN(letterId) || letterId <= 0) {
    window.helpers.showError("Choose letter name");
    return;
  }

  const $button = document.querySelector("[data-action=step3_generate_letter]");
  const response = await window.helpers.submitBtn($button, () => {
    return window.api.generateDisputeLetter({
      customer_id: customer.prof_id,
      dispute_ids: rows.map((row) => row.id),
      letter_id: letterId,
    });
  });

  window.__wizardLetterId = response.letter_id;
  displayGeneratedDisputeLetter(response);
}

function displayGeneratedDisputeLetter(response) {
  const { data, ...rest } = response;
  if (!Object.keys(data).length) {
    return; // handle error
  }

  // set letter id to export
  window.__wizardLetterId = rest.letter_id;

  const $disputetab = document.querySelector(".disputetab");
  $disputetab.setAttribute("class", "disputetab");

  const displayTabContent = (bureau) => {
    const $target = $disputetab.querySelector(`[data-bureau=${bureau}]`);
    if (!$target) return;

    const $tabPanel = $disputetab.querySelector($target.getAttribute("href"));
    if ($tabPanel.innerHTML !== "") return;

    const $template = $disputetab.querySelector("template");
    const $copy = document.importNode($template.content, true);
    const $customer = $copy.querySelector("[data-detail=customer]");
    const $bureau = $copy.querySelector("[data-detail=bureau]");

    $customer.innerHTML = `
      <div>${rest.customer.name}</div>
      <div>${rest.customer.address}</div>
    `;
    $bureau.innerHTML = rest.bureau_address[bureau];
    $tabPanel.appendChild($copy);
  };

  const $part1 = document.querySelector(".part1");
  const $part2 = document.querySelector(".part2");
  const $letter = $("#letterContent");

  Object.keys(data).forEach((key, index) => {
    displayTabContent(key);
    $disputetab.classList.add(`disputetab--${key}`);

    if (index === 0) {
      window.helpers.wysiwygEditor($letter, data[key]);
    }
  });

  const $tabLinks = $($disputetab).find('a[data-toggle="tab"]');
  $tabLinks.off("shown.bs.tab");
  $tabLinks.on("shown.bs.tab", (event) => {
    const { bureau } = event.target.dataset;
    window.helpers.wysiwygEditor($letter, data[bureau]);
  });

  $part1.classList.add("d-none");
  $part2.classList.remove("d-none");
  $part2.classList.add("part2--withdispute");
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
  if (!pending.Table.getSelectedRowsData().length) {
    window.helpers.showError("Please select at least one dispute item.");
    return;
  }

  const selected = await import("./selecteditemsdatatable.js");
  $("#additemmodal").modal("hide");
  const table = new selected.Table();
  table.onRemoveRow = () => {
    if (!selected.Table.getRowsData().length) {
      const $step2 = document.querySelector(".step-2");
      $step2.classList.add("step--active");

      const $step3 = document.querySelector(".step-3");
      $step3.classList.add("step--disabled");
      $step3.classList.remove("step--active");
    }
  };
}

async function initCategories() {
  const { data: categories } = await window.api.getCategories();

  const selects = [...document.querySelectorAll("[data-name=category_id]")];

  selects.forEach(($select) => {
    categories.forEach((category) => {
      const $option = window.helpers.htmlToElement(
        `<option value="${category.id}">${category.name}</option>`
      );
      $select.appendChild($option);
    });

    $select.appendChild(
      window.helpers.htmlToElement(
        `<option value="favorite">Favorites</option>`
      )
    );

    const $letterSelect = document.querySelector($select.dataset.letter);
    if (categories.length) {
      const $option = $select.querySelector("option");
      initLetters($option.value, $letterSelect);
    }

    $select.addEventListener("change", (event) => {
      initLetters(event.target.value, $letterSelect);
    });
  });
}

async function initLetters(categoryId, $select) {
  if (categoryId === undefined) return;

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

function initSaveForm(customer) {
  const $modal = document.getElementById("saveLetterModal");
  const $name = $modal.querySelector("[data-name=name]");
  const $saveButton = $modal.querySelector(".btn");
  const $toggleButtons = $("[data-action=save_for_later], [data-action=save_and_print]"); // prettier-ignore
  const $letter = $("#letterContent");

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
      letter_id: window.__wizardLetterId,
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

function showCreditorModal() {
  $("#newdisputemodal").modal("hide");
  $("#addCreditorModal").modal("show");
}

function showManageReasonsModal() {
  $("#newdisputemodal").modal("hide");
  $("#manageReasonModal").modal("show");
}

function backToAddDisputeModal() {
  $("#newdisputemodal").modal("show");
  $("#manageReasonModal").modal("hide");
  $("#addCreditorModal").modal("hide");
}

function toggleAddCreaditorModalOptionalInputs() {
  const $modal = document.getElementById("addCreditorModal");
  const $button = $modal.querySelector("[data-action=toggle_add_creaditor_modal_optional_inputs]"); // prettier-ignore

  if ($modal.classList.contains("addCreditorModal--showOptional")) {
    $button.textContent = "+More Details (optional)";
    $modal.classList.remove("addCreditorModal--showOptional");
  } else {
    $button.textContent = "-Less Details (optional)";
    $modal.classList.add("addCreditorModal--showOptional");
  }
}

function addNewReasons() {
  const $table = document.getElementById("reasonsTable");
  $table.classList.add("reasonsTable--showForm");
}

function hideReasonForm() {
  const $table = document.getElementById("reasonsTable");
  $table.classList.remove("reasonsTable--showForm");
}

function initAddCreditorForm() {
  const $modal = document.getElementById("addCreditorModal");
  const $select = $modal.querySelector("#addCreditorModal__state");
  const states = [
    "AL",
    "AK",
    "AS",
    "AZ",
    "AR",
    "CA",
    "CO",
    "CT",
    "DE",
    "DC",
    "FM",
    "FL",
    "GA",
    "GU",
    "HI",
    "ID",
    "IL",
    "IN",
    "IA",
    "KS",
    "KY",
    "LA",
    "ME",
    "MH",
    "MD",
    "MA",
    "MI",
    "MN",
    "MS",
    "MO",
    "MT",
    "NE",
    "NV",
    "NH",
    "NJ",
    "NM",
    "NY",
    "NC",
    "ND",
    "MP",
    "OH",
    "OK",
    "OR",
    "PW",
    "PA",
    "PR",
    "RI",
    "SC",
    "SD",
    "TN",
    "TX",
    "UT",
    "VT",
    "VI",
    "VA",
    "WA",
    "WV",
    "WI",
    "WY",
    "AE",
    "AA",
    "AP",
  ];

  $($select).select2({
    placeholder: "Select state",
    data: states,
  });
}

function initDisputeForm() {
  const $modal = document.getElementById("newdisputemodal");

  const $creditorSelect = $modal.querySelector("#newdisputemodal_creditor");
  $($creditorSelect).select2({
    placeholder: "Add Creditor/Furnisher",
    ajax: {
      url: `${window.api.prefixURL}/autocomplete/_company_furnishers`,
      dataType: "json",
      data: (params) => {
        return { q: params.term, page: params.page };
      },
      processResults: (data, params) => {
        params.page = params.page || 1;
        return { results: data };
      },
    },
    templateResult: (repo) => {
      if (repo.loading) {
        return repo.text;
      }

      return $(
        `<div><b>${repo.text}</b></div><div class="autocomplete-right"><small>${repo.address}</small></div>`
      );
    },
  });

  const $reasonSelect = $modal.querySelector("#newdisputemodal_reason");
  $($reasonSelect).select2({
    placeholder: "Select a reason for your dispute",
    ajax: {
      url: `${window.api.prefixURL}/autocomplete/_company_reasons`,
      dataType: "json",
      data: (params) => {
        return { q: params.term, page: params.page };
      },
      processResults: (data, params) => {
        params.page = params.page || 1;
        return { results: data };
      },
    },
  });

  const $instructionsSelect = $modal.querySelector("#newdisputemodal_instruction"); // prettier-ignore
  $($instructionsSelect).select2({
    placeholder: "Choose instructions",
    ajax: {
      url: `${window.api.prefixURL}/autocomplete/_company_instructions`,
      dataType: "json",
      data: (params) => {
        return { q: params.term, page: params.page };
      },
      processResults: (data, params) => {
        params.page = params.page || 1;
        return { results: data };
      },
    },
  });

  const $accNumRadio = $($modal).find("[name=newdisputemodal_accnum]");
  const $accNums = $modal.querySelector(".accnums");
  $accNumRadio.change(function () {
    const $all = $accNums.querySelector("[data-for=all]");
    const $bureaus = $accNums.querySelectorAll('[data-for^="#"]');

    if (this.value === "same") {
      $all.classList.remove("d-none");
      $bureaus.forEach(($node) => {
        $node.classList.add("d-none");
      });
    } else {
      $all.classList.add("d-none");
      $bureaus.forEach(($node) => {
        const $bureauCheckbox = $modal.querySelector($node.dataset.for);
        if ($bureauCheckbox.checked) {
          $node.classList.remove("d-none");
        } else {
          $node.classList.add("d-none");
        }
      });
    }
  });

  const $bureaus = $($modal).find("[name=bureau]");
  $bureaus.change(function () {
    const $radio = $modal.querySelector("#newdisputemodal_diffbureaus");
    if (!$radio.checked) return;

    const id = this.getAttribute("id");
    $input = $modal.querySelector(`[data-for="#${id}"]`);
    $input.classList[this.checked ? "remove" : "add"]("d-none");
  });
}

function toggleInstructions() {
  const $modal = document.getElementById("newdisputemodal");
  const $instructions = $modal.querySelector(".instructions");
  $instructions.classList.toggle("instructions--showInput");

  if ($instructions.classList.contains("instructions--showInput")) {
    const $select = $modal.querySelector("#newdisputemodal_instruction");
    $($select).empty().trigger("change");
  } else {
    const $input = $modal.querySelector("#newdisputemodal_instruction_input");
    $input.value = "";
  }
}

async function saveCreditor() {
  const $modal = document.getElementById("addCreditorModal");
  const $dataTypes = $modal.querySelectorAll("[data-type]");
  const $button = $modal.querySelector("[data-action=save_creditor]");
  const payload = {};

  for (let index = 0; index < $dataTypes.length; index++) {
    const $input = $dataTypes[index];
    const key = $input.dataset.type;
    const value = $input.value.trim();

    if (!value.length && $input.hasAttribute("required")) {
      $input.focus();
      return;
    }

    if (value.length) {
      payload[key] = value;
    }
  }

  await window.helpers.submitBtn($button, () => {
    return window.api.saveFurnisher(payload);
  });

  [...$dataTypes].forEach(($input) => {
    $input.value = "";
  });

  backToAddDisputeModal();
}

async function displayReasons() {
  const $modal = document.getElementById("manageReasonModal");
  const $table = $modal.querySelector("table");

  if ($table.classList.contains("loaded")) {
    return;
  }

  const { data } = await window.api.fetchReasons();
  const $fragment = document.createDocumentFragment();
  data.forEach((currData) => {
    $fragment.appendChild(createReasonRow(currData));
  });

  $table.querySelector("tbody").appendChild($fragment);
  $table.classList.add("loaded");

  const $loader = $modal.querySelector(".wrapper--loading");
  $loader.classList.remove("wrapper--loading");
}

function createReasonRow(data) {
  const $modal = document.getElementById("manageReasonModal");
  const $template = $modal.querySelector("template");

  const $copy = document.importNode($template.content, true);
  const $name = $copy.querySelector("[data-detail=name]");
  $name.textContent = data.reason;

  const $actions = $copy.querySelector("[data-detail=actions]");
  const $locked = $copy.querySelector("[data-detail=locked]");
  if (data.company_id == 0) {
    $actions.classList.remove("d-inline-flex");
    $actions.classList.add("d-none");
    $locked.classList.remove("d-none");
  } else {
    $locked.classList.add("d-none");
  }

  const actions = {
    delete: async () => {
      if (!confirm("Are you sure you want to delete this reason?")) return;
      await window.api.deleteReason(data.id);
      const $row = $modal.querySelector(`[data-id="${data.id}"]`);
      if ($row) {
        $row.remove();
      }
    },
    edit: async () => {
      const newReason = prompt("Enter name:", data.reason);
      if (newReason && newReason.trim().length) {
        const response = await window.api.editReason(data.id, {
          reason: newReason,
        });

        const $row = $modal.querySelector(`[data-id="${data.id}"]`);
        if ($row) {
          $row.querySelector("[data-detail=name]").textContent =
            response.data.reason;
        }
      }
    },
  };

  const $buttons = $actions.querySelectorAll("[data-action]");
  $buttons.forEach(($button) => {
    const action = $button.dataset.action;
    if (typeof actions[action] === "function") {
      $button.addEventListener("click", actions[action]);
    }
  });

  const $retval = $copy.firstElementChild;
  $retval.dataset.id = data.id;
  return $retval;
}

async function saveReason() {
  const $modal = document.getElementById("manageReasonModal");
  const $input = $modal.querySelector("[data-type=reason]");

  const value = $input.value.trim();
  if (!value.length) {
    $input.focus();
    return;
  }

  const $button = $modal.querySelector("[data-action=save_reason]");
  const { data } = await window.helpers.submitBtn($button, () => {
    return window.api.saveReason({ reason: value });
  });

  const $table = $modal.querySelector("table");
  const $row = createReasonRow(data);
  $table.querySelector("tbody").appendChild($row);
  $input.value = "";
}

async function saveDisputeItem(customer) {
  const $modal = document.getElementById("newdisputemodal");
  const $dataTypes = $modal.querySelectorAll("[data-type]");
  const payload = { bureaus: [], customer_id: customer.prof_id };

  const $bureaus = $modal.querySelectorAll("[name=bureau]");
  $bureaus.forEach(($bureau) => {
    if ($bureau.checked) {
      payload.bureaus.push($bureau.getAttribute("value"));
    }
  });

  if (!payload.bureaus.length) {
    window.helpers.showError("Please select bureau");
    return;
  }

  $dataTypes.forEach(($input) => {
    if ($($input).is(":radio") || $($input).is(":checkbox")) {
      payload[$input.dataset.type] = $input.checked;
      return;
    }

    const value = $input.value;
    if (value.trim().length) {
      payload[$input.dataset.type] = value;
    }
  });

  if (payload.company_reason_id === undefined) {
    window.helpers.showError("Please select reason");
    return;
  }

  // stores account number
  const $sameAccNum = $modal.querySelector("#newdisputemodal_samebureaus");
  if ($sameAccNum.checked) {
    const $accNumInput = $modal.querySelector("[data-for=all] input");
    if ($accNumInput.value.trim().length) {
      payload.account_number = $accNumInput.value.trim();
    }
  } else {
    const $diffAccNum = $modal.querySelector("#newdisputemodal_diffbureaus");
    if ($diffAccNum.checked) {
      const $accNums = $modal.querySelectorAll('[data-for^="#"] input');
      $accNums.forEach(($input) => {
        const $parent = $input.closest(".form-group");
        const $bureau = $modal.querySelector($parent.dataset.for);
        if (!$bureau.checked) return;

        // if bureau is selected, save bureau account number value
        // if not empty

        if (!payload.account_numbers) {
          payload.account_numbers = {};
        }

        if ($input.value.trim().length) {
          const bureau = $bureau.getAttribute("value");
          payload.account_numbers[bureau] = $input.value.trim();
        }
      });
    }
  }

  if (!payload.furnisher_id) {
    window.helpers.showError("Please select creditor/furnisher");
    return;
  }

  const $button = document.querySelector("[data-action=save_dispute_item]");
  const { data } = await window.helpers.submitBtn($button, () =>
    window.api.saveDisputeItem(payload)
  );

  const $table = document.getElementById("customerdisputestable");
  if ($.fn.DataTable.isDataTable($table)) {
    const table = $($table).DataTable();
    table.row.add(data).draw();
  }

  $($modal).modal("hide");
}

function toDustomerDashboard(customer) {
  window.location = `${window.api.prefixURL}/customer/add_dispute_item/${customer.prof_id}`;
}

function toCustomerDisputeItems(customer) {
  window.location = `${window.api.prefixURL}/customer/credit_industry/${customer.prof_id}`;
}
