window.addEventListener("DOMContentLoaded", async () => {
  const { FilterForm } = await import("./FilterForm.js");
  const { ForReviewTable } = await import("./ForReviewTable.js");
  const { ReviewedTable } = await import("./ReviewedTable.js");
  const { SearchedReceiptsTable } = await import("./SearchedReceiptsTable.js");
  const { GoogleDrive } = await import("./GoogleDrive.js");
  const { ReceiptForwarding } = await import("./ReceiptForwarding.js");

  const api = await import("./api.js");
  const utils = await import("./utils.js");
  const rulesUtils = await import("../rules/utils.js");

  new FilterForm();
  new GoogleDrive();
  new ReceiptForwarding();
  new ForReviewTable($("#receiptsReview"));
  new ReviewedTable($("#receiptsReviewed"));

  rulesUtils.initSelect({
    $select: $("[data-select2-type=bank_account]"),
    field: "bank-account",
  });
  rulesUtils.initSelect({
    $select: $("[data-select2-type=bank_credit_account]"),
    field: "bank-credit-account",
  });
  rulesUtils.initSelect({
    $select: $("[data-select2-type=payee]"),
    field: "payee",
  });
  rulesUtils.initSelect({
    $select: $("[data-select2-type=payment_account]"),
    field: "payment-account",
  });

  const $receiptModal = $("#receiptModal");
  $receiptModal.on("show.bs.modal", () => {
    document.documentElement.style.overflow = "hidden";
  });
  $receiptModal.on("hidden.bs.modal", () => {
    document.documentElement.style.overflow = "initial";
  });

  const $toEditReceipt = $("#toEditReceipt");
  $toEditReceipt.on("click", (event) => {
    event.preventDefault();
    const $form = $(event.target).closest("form");
    $form.attr("data-active-step", "1");
  });

  const $searchManually = $("#searchManually");
  $searchManually.on("click", (event) => {
    const $form = $(event.target).closest("form");
    $form.attr("data-active-step", "3");
  });

  const $toFindMatch = $("#toFindMatch");
  $toFindMatch.on("click", (event) => {
    event.preventDefault();
    const $form = $(event.target).closest("form");
    $form.attr("data-active-step", 2);
  });

  const $searchExpenses = $("#searchExpenses");
  const $searchsearchExpensesForm = $receiptModal.find("[data-step=3]");
  const $searchedReceiptsTable =
    $searchsearchExpensesForm.find("#searchedReceipts");
  $searchExpenses.on("click", async (event) => {
    event.preventDefault();
    const $dataTypes = $searchsearchExpensesForm.find("[data-type]");
    const payload = {};

    for (let index = 0; index < $dataTypes.length; index++) {
      const $element = $dataTypes[index];
      const { value } = $element;
      const { type } = $element.dataset;

      if (value.trim().length === 0) {
        continue;
      }

      payload[type] = value;

      if (type.endsWith("date")) {
        payload[type] = moment(value).format("YYYY-MM-DD");
      }
    }

    if (Object.keys(payload).length === 0) {
      return;
    }

    $searchExpenses.addClass("receiptsButton--isLoading");
    $searchExpenses.prop("disabled", true);

    const { data } = await api.searchExpenses(payload);

    $searchExpenses.removeClass("receiptsButton--isLoading");
    $searchExpenses.prop("disabled", false);
    new SearchedReceiptsTable($searchedReceiptsTable, data);
  });

  Dropzone.autoDiscover = false;
  new Dropzone("#receiptsUploadDropzone", {
    url: `${api.prefixURL}/AccountingReceipts/uploadImage`,
    acceptedFiles: "image/jpeg,image/jpg,image/png",
    addRemoveLinks: true,
    init: function () {
      const $table = $("#receiptsReview");

      this.on("success", (file, { data, ...rest }) => {
        if (rest.success === false) return;
        $table.DataTable().row.add(data).draw();
        file.previewElement.parentNode.removeChild(file.previewElement);
      });

      this.on("error", (file, { error }) => {
        const $error = $(file.previewElement).find(".dz-error-message span");
        $error.text(error);
      });

      this.on("removedfile", async (file) => {
        const $previews = this.element.querySelectorAll(".dz-image-preview");
        if (!$previews.length) {
          this.element.classList.remove("dz-started");
        }

        if (!file.xhr) return;
        const { data } = JSON.parse(file.xhr.response);
        if (!data || !data.id) return;
        await api.deleteReceipt(data.id);
        $table.DataTable().row(`#row${data.id}`).remove().draw();
      });
    },
  });

  const urlSearchParams = new URLSearchParams(window.location.search);
  const params = Object.fromEntries(urlSearchParams.entries());
  const $reviewedTabLink = $("[href='#reviewed']");
  const $forReviewedTabLink = $("[href='#forReview']");

  if (params.tab && params.tab === "reviewed") {
    $reviewedTabLink.click();
  }

  $reviewedTabLink.on("click", () => {
    window.history.replaceState(null, null, "?tab=reviewed");
  });

  $forReviewedTabLink.on("click", () => {
    window.history.replaceState({}, document.title, window.location.pathname);
  });

  const $batchActionsButton = $("#batchActionsButton");
  $batchActionsButton.on("click", () => {
    const $table = $("#receiptsReview");
    const $batchActionsLink = $("#batchActions li");
    const $actionConfirm = $("#batchActions li:first-child");

    const table = $table.DataTable();
    const selected = table
      .rows(".receiptsTable__row--selected")
      .data()
      .toArray();

    $batchActionsLink.removeClass("disabled");

    if (!selected.length) {
      console.log($batchActionsLink);
      $batchActionsLink.addClass("disabled");
      return;
    }

    if (!selected.every((row) => utils.isReceiptReviewed(row))) {
      $actionConfirm.addClass("disabled");
    }
  });
});

window.addEventListener("DOMContentLoaded", function () {
  const isLocalhost = ["localhost", "127.0.0.1"].includes(location.hostname);
  if (!isLocalhost) return;

  $.ajaxSetup({
    beforeSend: function (_, settings) {
      if (settings.url.startsWith("/accounting/")) {
        settings.url = settings.url.replace(
          "/accounting/",
          "/nsmartrac/accounting/"
        );
      }
    },
  });
});
