window.addEventListener("DOMContentLoaded", async () => {
  const { ForReviewTable } = await import("./ForReviewTable.js");
  const { ReviewedTable } = await import("./ReviewedTable.js");
  const api = await import("./api.js");
  const rulesUtils = await import("../rules/utils.js");

  new ForReviewTable($("#receiptsReview"));
  new ReviewedTable($("#receiptsReviewed"));

  const $batchActions = $("#batchActions");
  $batchActions.on("click", async (event) => {
    event.preventDefault();

    const $selected = $(".receiptsTable__row--selected");
    const ids = $.map($selected, ($element) => $element.dataset.id);

    if (!ids.length) return;

    const { target: $target } = event;
    const { action } = $target.dataset;

    if (action === "delete") {
      const { isConfirmed } = await Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#2ca01c",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      });

      if (!isConfirmed) return;

      await api.batchDeleteReceipts(ids);
      window.location.reload();
    }

    if (action === "confirm") {
      await api.batchConfirmReceipts(ids);
      window.location.reload();
    }
  });

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

  const $saveReceipt = $("[data-action=savereceipt]");
  const $errorMessage = $(".formError");
  $saveReceipt.on("click", async (event) => {
    event.preventDefault();
    const $this = $(event.target);
    const $modal = $this.closest(".modal");
    const $form = $this.closest("form");
    const $dataTypes = $form.find("[data-step=1] [data-type]");

    const payload = {};
    let hasError = false;

    for (let index = 0; index < $dataTypes.length; index++) {
      const $element = $dataTypes[index];
      const { type } = $element.dataset;
      payload[type] = $element.value;

      $element.classList.remove("inputError");

      if (!isEmpty($element.value)) {
        continue;
      }

      if (!$element.hasAttribute("required")) {
        continue;
      }

      $element.classList.add("inputError");
      $errorMessage.addClass("formError--show");
      hasError = true;
    }

    if (hasError) {
      return;
    }

    $errorMessage.removeClass("formError--show");
    await api.editReceipt(payload.id, payload);

    const { actionAfter } = $this.get(0).dataset;
    if (actionAfter === "close") {
      $modal.modal("hide");
    }

    if (actionAfter === "next") {
      $form.attr("data-active-step", "2");
    }
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

function isEmpty(string) {
  // https://stackoverflow.com/a/3261380/8062659
  return !string || string.length === 0;
}
