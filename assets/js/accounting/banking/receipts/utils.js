export function resetStep3() {
  const $modal = $("#receiptModal");
  const $step3 = $modal.find("[data-step=3]");
  const $dataTypes = $step3.find("[data-type]");
  const $table = $step3.find("#searchedReceipts");

  if ($.fn.DataTable.isDataTable($table)) {
    $table.DataTable().clear();
    $table.DataTable().draw();
  }

  for (let index = 0; index < $dataTypes.length; index++) {
    const $element = $dataTypes[index];

    $element.value = "";
    if ($element.classList.contains("select2-hidden-accessible")) {
      $($element).val("").trigger("change");
    }
  }
}
