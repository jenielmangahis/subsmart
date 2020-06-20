$(document).ready(function () {
  $(
    "#jobListTable, #addItemsTable, #currentFormsTable, #jobHistoryTable"
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
    $("#addItemsTableDiv").hide();
    $("#itemsTableSubTotal").hide();
    $("#addItemsForms").fadeIn();
  });

  $("#finishedItemForm").click(function () {
    $("#addItemsForms").hide();
    $("#addItemsTableDiv").fadeIn();
    $("#itemsTableSubTotal").fadeIn();
  });

  $("#newJobBtn, #cancelJobBtn").click(function () {
    $.LoadingOverlay("show");
  });

  $("#invoiceCreatedDate, #workOrderCreatedDate, #estimateDate").datetimepicker(
    {
      format: "L",
    }
  );

  $("#expiryDateEstimate, #billingDate, #billingExpDate").datetimepicker({
    format: "L",
  });

  $("#saveJobInvoice").click(function () {
    $.LoadingOverlay("show");
    var param = {
      createdDate: $("#invoiceCreatedDate").val(),
      dueDate: "",
      status: $("#invoiceStatus").val(),
      description: $("#invoiceDescription").val(),
      totalDue: 0,
      balance: 0,
      billingType: "payment plan",
      jobId: $("#jobId").val(),
      customerId: $("#customer_id").val(),
      invoiceNumber: $("#invoiceNumber").val(),
    };
    saveJobInvoice(param);
  });

  $("#jobPickItems").change(function () {
    var table = "";
    if (
      $("#jobPickItems").val() == "service" ||
      $("#jobPickItems").val() == "Fees"
    ) {
      $("#itemsFeesDiv").fadeIn();
      $("#addOnsItemsDiv").hide();
      table = "itemsFeesTable";
    } else {
      if ($("#jobPickItems").val() == "material") {
        $("#addOnsItemsDiv").hide();
        $("#itemsFeesDiv").hide();
        table = "";
      } else {
        $("#addOnsItemsDiv").fadeIn();
        $("#itemsFeesDiv").hide();
        table = "addOnsItemTable";
      }
    }
    getItems($("#jobPickItems").val(), table);
  });

  $(".payment_method").click(function () {
    switch ($("input[name='payment_method']:checked").val()) {
      case "creditcard":
        $("#creditcarddiv").fadeIn();
        $("#checkdiv").hide();
        $("#cashdiv").hide();
        $("#paypaldiv").hide();
        break;

      case "check":
        $("#checkdiv").fadeIn();
        $("#creditcarddiv").hide();
        $("#cashdiv").hide();
        $("#paypaldiv").hide();
        break;

      case "cash":
        $("#cashdiv").fadeIn();
        $("#checkdiv").hide();
        $("#creditcarddiv").hide();
        $("#paypaldiv").hide();
        break;

      case "paypal":
        $("#paypaldiv").fadeIn();
        $("#cashdiv").hide();
        $("#checkdiv").hide();
        $("#creditcarddiv").hide();
        break;
    }
  });

  $(".addInvoiceItem").click(function () {
    console.log("tset");
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

function getItems(param, table) {
  var items = [];
  $.ajax({
    type: "GET",
    url: base_url + "job/getItems",
    data: { index: param },
    success: function (data) {
      var result = jQuery.parseJSON(data);
      for (var i = 0; i < result.length; i++) {
        var item = [
          '<button type="button" id="" class="addInvoiceItem btn btn-primary btn-sm"><span class="fa fa-plus"></span> Add</button>',
          result[i].title,
          result[i].vendor_id,
          result[i].price,
          "",
        ];
        items.push(item);
      }
      $("#" + table).DataTable({
        scrollX: true,
        destroy: true,
        data: items,
      });
    },
  });
}

function saveJobInvoice(param) {
  var location = [];
  $.ajax({
    type: "POST",
    url: base_url + "job/saveInvoice",
    data: param,
    success: function (data) {
      window.location.reload();
    },
  });
  return location;
}
