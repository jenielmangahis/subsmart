$(document).ready(function () {
  $(
    "#jobListTable, #addItemsTable, #currentFormsTable, #jobHistoryTable, #jobTypeTable"
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
    $("#itemsTableSubTotal").hide();
    $("#addItemsTableDiv").fadeIn();
  });

  $("#newJobBtn, #cancelJobBtn").click(function () {
    $.LoadingOverlay("show");
  });

  $(".deleteJobTypeBtn").click(function () {
    $.LoadingOverlay("show");
  });

  $("#invoiceCreatedDate, #workOrderCreatedDate, #estimateDate").datetimepicker(
    {
      format: "L",
    }
  );

  $("#expiryDateEstimate, #billingDate").datetimepicker({
    format: "L",
  });

  $("#billingExpDate").datetimepicker({
    format: "YYYY/MM",
  });

  $("#cvv").attr("maxlength", 4);

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

  $(document).on("click", ".addInvoiceItem", function () {
    var param = {
      job_id: $("#jobId").val(),
      item_id: $(this).data("id"),
      qty: 1,
      total_value: $(this).data("cost"),
    };
    $.LoadingOverlay("show");
    saveInvoiceItems(param);
  });

  $("#dialog").dialog({
    autoOpen: false,
    show: {
      effect: "fadeIn",
      duration: 100,
    },
    hide: {
      effect: "fadeOut",
      duration: 100,
    },
  });
  $(document).on("click", ".deductItemQty", function () {
    if (parseInt($(this).data("value")) > 1) {
      var param = {
        id: $(this).data("id"),
        qty: $(this).data("value"),
        type: "minus",
        job_id: $("#jobId").val(),
      };
      updateItemQty(param);
    }
  });

  $(document).on("click", ".addItemQty", function () {
    var param = {
      id: $(this).data("id"),
      qty: $(this).data("value"),
      type: "add",
      job_id: $("#jobId").val(),
    };
    updateItemQty(param);
  });

  $("#cardNumber").change(function () {
    cardNumber($("#cardNumber").val());
  });

  $("#cvv").change(function () {
    validateCVV($("#cardNumber").val(), $("#cvv").val());
  });

  $("#jobTypeAddCloseBtn").click(function () {
    var param = {
      settingType: $("#settingType").val(),
    };
    saveJobType(param);
  });

  $(".editJobTypeBtn").click(function () {
    $("#newJobTypeModal").modal("show");
    $("#settingType").val($(this).data("jobtype"));
  });

  $("#sendEmailCustomer").click(function () {
    $.LoadingOverlay("show");
    var param = {
      email: "jeykell125@gmail.com",
      job_id: $("#jobId").val(),
      customer_id: $("#customer_id").val(),
    };
    sendEmailToCustomer(param);
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
          '<button type="button" data-id="' +
            result[i].id +
            '" data-cost="' +
            result[i].price +
            '" class="addInvoiceItem btn btn-primary btn-sm"><span class="fa fa-plus"></span> Add</button>',
          result[i].title,
          result[i].vendor_id,
          result[i].price,
          "",
        ];
        items.push(item);
      }
      if (table) {
        $("#" + table).DataTable({
          scrollX: true,
          destroy: true,
          data: items,
        });
      }
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

function saveInvoiceItems(param) {
  var items = [];
  $.ajax({
    type: "POST",
    url: base_url + "job/saveInvoiceItems",
    data: param,
    success: function (data) {
      $.LoadingOverlay("hide");
      $("#addItemsTableDiv").fadeIn();
      $("#addItemsForms").hide();
      var result = jQuery.parseJSON(data);
      for (var i = 0; i < result.length; i++) {
        var item = [
          result[i].title,
          result[i].type,
          "",
          result[i].qty,
          "<a>Set Location</a>",
          result[i].price,
          result[i].discount,
          "",
          "",
        ];
        items.push(item);
      }
      $("#addItemsTable").DataTable({
        scrollX: true,
        destroy: true,
        data: items,
      });
    },
  });
}

function cardNumber(inputTxt) {
  var discover = /^(?:6(?:011|5[0-9][0-9])[0-9]{12})$/;
  var master = /^(?:5[1-5][0-9]{14})$/;
  var visa = /^(?:4[0-9]{12}(?:[0-9]{3})?)$/;
  var amex = /^(?:3[47][0-9]{13})$/;

  if (
    !inputTxt.match(discover) &&
    !inputTxt.match(master) &&
    !inputTxt.match(visa) &&
    !inputTxt.match(amex)
  ) {
    $("#dialog").dialog("open");
    $("#dialogMsg").text("Not a valid a number!");
    $("#cardNumber").val("");
  }
}

function validateCVV(creditCard, cvv) {
  var acceptedCreditCards = {
    visa: /^4[0-9]{12}(?:[0-9]{3})?$/,
    mastercard: /^5[1-5][0-9]{14}$|^2(?:2(?:2[1-9]|[3-9][0-9])|[3-6][0-9][0-9]|7(?:[01][0-9]|20))[0-9]{12}$/,
    amex: /^3[47][0-9]{13}$/,
    discover: /^65[4-9][0-9]{13}|64[4-9][0-9]{13}|6011[0-9]{12}|(622(?:12[6-9]|1[3-9][0-9]|[2-8][0-9][0-9]|9[01][0-9]|92[0-5])[0-9]{10})$/,
    diners_club: /^3(?:0[0-5]|[68][0-9])[0-9]{11}$/,
    jcb: /^(?:2131|1800|35[0-9]{3})[0-9]{11}$/,
  };

  var creditCard = creditCard.replace(/\D/g, "");
  var cvv = cvv.replace(/\D/g, "");
  if (acceptedCreditCards.amex.test(creditCard)) {
    if (/^\d{4}$/.test(cvv)) return true;
  } else if (/^\d{3}$/.test(cvv)) {
    return true;
  }
  $("#dialog").dialog("open");
  $("#dialogMsg").text("Not a valid CVV number!");
  $("#cvv").val("");
}

function saveJobType(param) {
  var items = [];
  $.ajax({
    type: "POST",
    url: base_url + "job/saveJobType",
    data: param,
    success: function (data) {
      var result = jQuery.parseJSON(data);
      for (var i = 0; i < result.length; i++) {
        var item = [
          result[i].setting_type,
          '<button type="button" data-id="' +
            result[i].id +
            '" class="editJobTypeBtn btn btn-warning btn-sm"><span class="fa fa-plus"></span> Edit</button> ' +
            '<button type="button" data-id="' +
            result[i].id +
            '" class="deleteJobTypeBtn btn btn-danger btn-sm"><span class="fa fa-plus"></span> Delete</button>',
        ];
        items.push(item);
      }

      $("#newJobTypeModal").modal("toggle");
      $("#jobTypeTable").DataTable({
        scrollX: true,
        destroy: true,
        data: items,
      });
    },
  });
}

function updateItemQty(param) {
  var items = [];
  $.ajax({
    type: "POST",
    url: base_url + "job/updateJobItemQty",
    data: param,
    success: function (data) {
      var result = jQuery.parseJSON(data);
      var subTotal = 0;
      for (var i = 0; i < result.length; i++) {
        subTotal += parseFloat(result[i].price) * parseInt(result[i].qty);
        var item = [
          "<span class='pl-2'>" + result[i].title + "</span>",
          "<span class='pl-2'>" + result[i].type + "</span>",
          "",
          "<span style='cursor:pointer;' data-id='" +
            result[i].ihi_id +
            "' data-value='" +
            result[i].qty +
            "' class='fa fa-lg fa-minus-circle pl-2 pr-3 deductItemQty'></span>" +
            result[i].qty +
            "<span style='cursor:pointer;' data-id='" +
            result[i].ihi_id +
            "' data-value='" +
            result[i].qty +
            "' class='fa fa-lg fa-plus-circle pl-3 addItemQty'></span>",
          "<a href='javascript:void(0)' class='pl-2' data-toggle='modal' data-target='#modalItemLocation'>Set Location</a>",
          "<span class='pl-3'>" +
            new Intl.NumberFormat("en-US", { minimumFractionDigits: 2 }).format(
              parseFloat(result[i].price)
            ) +
            "</span>",
          "<span class='pl-3'>" +
            new Intl.NumberFormat("en-US", { minimumFractionDigits: 2 }).format(
              parseFloat(result[i].discount)
            ) +
            "</span>",
          "<span class='pl-3'>" +
            new Intl.NumberFormat("en-US", { minimumFractionDigits: 2 }).format(
              parseFloat(0)
            ) +
            "</span>",
          "<span class='pl-3'>" +
            new Intl.NumberFormat("en-US", { minimumFractionDigits: 2 }).format(
              parseFloat(result[i].price) * parseInt(result[i].qty)
            ) +
            "</span>",
        ];
        items.push(item);
      }
      $("#invoice_sub_total").text(
        "$" +
          new Intl.NumberFormat("en-US", { minimumFractionDigits: 2 }).format(
            subTotal
          )
      );
      $("#invoice_grand_total").text(
        "$" +
          new Intl.NumberFormat("en-US", { minimumFractionDigits: 2 }).format(
            subTotal
          )
      );
      $("#addItemsTable").DataTable({
        scrollX: true,
        destroy: true,
        data: items,
      });
    },
  });
}

function sendEmailToCustomer(param) {
  $.ajax({
    type: "POST",
    url: base_url + "job/sendEstimateEmail",
    data: param,
    success: function (data) {
      $.LoadingOverlay("hide");
    },
  });
}
