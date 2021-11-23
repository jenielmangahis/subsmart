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
    $select: $("#payeeID"),
    field: "payee",
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
