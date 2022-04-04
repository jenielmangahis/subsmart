window.document.addEventListener("DOMContentLoaded", async () => {
  window.api = await import("../api.js");

  const $actions = document.querySelectorAll("[data-action]");
  const actions = {
    on_no_dispute: onNoDispute,
    on_no_dispute_back: onNoDisputeBack,
    on_choose_letter_type: onChooseLetterType,
    on_choose_letter_recipient: onChooseLetterRecipient,
    step2_save_and_continue: step2SaveContinue,
    on_add_to_dispute: addToDispute,
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

function onChooseLetterRecipient(event) {
  const $step2 = document.querySelector(".step-2");
  const $step2DisputeCols = $step2.querySelectorAll(".step__step2DisputeCol");
  const classListFunc = event.target.value === "credit_bureau" ? "remove" : "add"; // prettier-ignore

  $step2DisputeCols.forEach(($col) => {
    $col.classList[classListFunc]("d-none");
  });
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
