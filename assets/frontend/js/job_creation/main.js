$(document).ready(function () {
  $("#addInvoice").click(function () {
    $("#currentForms").hide();
    $("#estimateForms").hide();
    $("#workOrderForms").hide();
    $("#invoiceForms").fadeIn();
  });

  $("#addEstimate").click(function () {
    $("#currentForms").hide();
    $("#invoiceForms").hide();
    $("#workOrderForms").hide();
    $("#estimateForms").fadeIn();
  });

  $("#addWorkOrder").click(function () {
    $("#currentForms").hide();
    $("#invoiceForms").hide();
    $("#estimateForms").hide();
    $("#workOrderForms").fadeIn();
  });

  $("#addItems").click(function () {
    $("#itemsTable").hide();
    $("#itemsTableSubTotal").hide();
    $("#addItemsForms").fadeIn();
  });

  $("#invoiceCreatedDate, #workOrderCreatedDate, #estimateDate").datetimepicker(
    {
      format: "L",
    }
  );

  $("#expiryDateEstimate, #billingDate, #billingExpDate").datetimepicker({
    format: "L",
  });
});
