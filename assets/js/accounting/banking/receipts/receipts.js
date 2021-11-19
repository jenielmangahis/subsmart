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
    $select: $("#bank_account"),
    field: "bank-account",
  });
  rulesUtils.initSelect({
    $select: $("#account_category"),
    field: "bank-account",
  });
  rulesUtils.initSelect({
    $select: $("#payeeID"),
    field: "payee",
  });

  const $saveAndNextButton = $("#saveAndNextButton");
  const $errorMessage = $(".formError");
  $saveAndNextButton.on("click", async (event) => {
    event.preventDefault();
    const $form = $(event.target).closest("form");
    const $dataTypes = $form.find("[data-type]");

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
