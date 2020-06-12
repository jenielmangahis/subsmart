$(document).ready(function () {
  $(
    "#jobListTable, #itemsTable, #currentFormsTable, #jobHistoryTable"
  ).DataTable({
    scrollX: true,
  });

  $("#job_customer").autocomplete({
    source: getCustomers(),
    change: function (event, ui) {
      $("#job_customer_id").val(ui.item.id);
    },
  });

  $("#job_location").autocomplete({
    source: getAddresses(),
    change: function (event, ui) {
      $("#job_location_id").val(ui.item.id);
    },
  });

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

  $("#newJobBtn, #cancelJobBtn").click(function () {
    $.LoadingOverlay("show");
  });

  $("#jobPickItems").change(function () {
    getItems($("#jobPickItems").val());
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

function getCustomers() {
  var customers = [];
  $.ajax({
    type: "GET",
    url: base_url + "job/getCustomers",
    success: function (data) {
      var result = jQuery.parseJSON(data);
      $.each(result, function (key, val) {
        customers.push({
          id: val.id,
          label:
            capitalizeFirstLetter(val.FName) + capitalizeFirstLetter(val.LName),
        });
      });
    },
  });
  return customers;
}

function capitalizeFirstLetter(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}

function getAddresses() {
  var location = [];
  $.ajax({
    type: "GET",
    url: base_url + "job/getAddresses",
    success: function (data) {
      var result = jQuery.parseJSON(data);
      $.each(result, function (key, val) {
        location.push({
          id: val.address_id,
          label:
            capitalizeFirstLetter(val.address1) +
            " " +
            capitalizeFirstLetter(val.city) +
            " " +
            capitalizeFirstLetter(val.state) +
            " " +
            val.zip,
        });
      });
    },
  });
  return location;
}

function getItems(param) {
  var location = [];
  $.ajax({
    type: "GET",
    url: base_url + "job/getItems",
    data: { index: param },
    success: function (data) {
      var result = jQuery.parseJSON(data);
      console.log(result);
    },
  });
  return location;
}
