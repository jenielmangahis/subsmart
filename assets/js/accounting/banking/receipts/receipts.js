window.addEventListener("DOMContentLoaded", async () => {
  const { ReceiptsReviewTable } = await import("./ReceiptsReviewTable.js");
  const api = await import("./api.js");

  new ReceiptsReviewTable($("#receiptsReview"));

  const $batchActions = $("#batchActions");
  $batchActions.on("click", async (event) => {
    event.preventDefault();

    const $selected = $(".receiptsTable__row--selected");
    const ids = $.map($selected, ($element) => $element.dataset.id);

    if (!ids.length) return;

    const { target: $target } = event;
    const { action } = $target.dataset;
    if (action !== "delete") return;

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
  });
});
