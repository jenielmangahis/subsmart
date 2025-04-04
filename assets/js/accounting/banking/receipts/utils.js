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

export function isEmail(string) {
  const regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(string);
}

export function isReceiptReviewed(receipt) {
  const requiredFields = [
    "transaction_date",
    "description",
    "__select2_bank_account",
    "total_amount",
    "__select2_category",
  ];

  for (const field of requiredFields) {
    if (!isEmpty(receipt[field])) {
      return true;
    }
  }

  return false;
}

export function isEmpty(string) {
  if (typeof string !== "string") return true;
  return string.trim().length === 0;
}
