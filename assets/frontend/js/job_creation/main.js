$(document).ready(function () {
  $(
    "#jobListTable, #addItemsTable, #currentFormsTable, #jobHistoryTable, #jobTypeTable, #assignEmpTable"
  ).DataTable({
    destroy: true,
    columnDefs: [
      {
        targets: [0], //first column / numbering column
        orderable: false, //set not orderable
      },
    ],
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

  $(".previewCurrentJobTable").click(function () {
    $("#currentForms").fadeIn();
    $("#estimateForms").hide();
    $("#workOrderForms").hide();
    $("#invoiceForms").hide();
  });

  $(
    "#newJobBtn, #cancelJobBtn, .deleteJobCurrentForm, .editDeleteBeforeAfterBtn, .editDeleteBeforeAfterBtn #saveBtn, #editBtn"
  ).click(function () {
    $.LoadingOverlay("show");
  });

  $(document).on("click", ".deleteJobTypeBtn", function () {
    var param = {
      job_id: $("#jobId").val(),
      item_id: $(this).data("id"),
      qty: 1,
      total_value: $(this).data("cost"),
    };
    $.LoadingOverlay("show");
    saveInvoiceItems(param);
  });

  $("#invoiceCreatedDate, #workOrderCreatedDate").datetimepicker({
    format: "L",
  });

  $("#estimateDate").datetimepicker({
    format: "L",
    minDate: new Date(),
  });

  $("#expiryDateEstimate").datetimepicker({
    format: "L",
    minDate: new Date(),
  });

  $("#billingDate").datetimepicker({
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
      jobNumber: $("#jobNum").val(),
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

  $("#jobTypeAddAnotherBtn").click(function () {
    var send = false;
    var param = {
      settingType: $("#settingType").val(),
      type: "add",
    };

    if (!send && $("#settingType").val() != "") {
      $.LoadingOverlay("show");
      send = true;
      saveJobType(param, "add_another");
    } else {
      $("#error_settingType").fadeIn();
    }
  });

  $("#settingType").keypress(function () {
    $("#error_settingType").hide();
  });

  $("#jobTypeAddCloseBtn").click(function () {
    var send = false;
    var param = {
      settingType: $("#settingType").val(),
      type: "add",
    };

    if (!send && $("#settingType").val() != "") {
      $.LoadingOverlay("show");
      send = true;
      saveJobType(param, "add");
    } else {
      $("#error_settingType").fadeIn();
    }
  });

  $("#jobTypeEditBtn").click(function () {
    var send = false;
    var param = {
      settingType: $("#settingType").val(),
      type: "update",
      id: $("#settingTypeId").val(),
    };

    if (!send && $("#settingType").val() != "") {
      $.LoadingOverlay("show");
      send = true;
      saveJobType(param, "edit");
    } else {
      $("#error_settingType").fadeIn();
    }
  });

  $("#newJobTypeBtn").click(function () {
    $("#jobTypeAddAnotherBtn").show();
    $("#jobTypeAddCloseBtn").show();
    $("#jobTypeEditBtn").hide();
    $("#settingType").val("");
  });

  $(document).on("click", ".editJobTypeBtn", function () {
    $("#newJobTypeModal").modal("show");
    $("#jobTypeAddAnotherBtn").hide();
    $("#jobTypeAddCloseBtn").hide();
    $("#jobTypeEditBtn").show();
    $("#settingTypeId").val($(this).data("id"));
    $("#settingType").val($(this).data("jobtype"));
  });

  $("#sendEmailCustomer").click(function () {
    if ($("#jobId").val() != "") {
      $.LoadingOverlay("show");
      var param = {
        company: $("#job_owner_name").val(),
        from_email: $("#job_owner_email").val(),
        email: $("#customer_email").val(),
        job_id: $("#jobId").val(),
        customer_id: $("#customer_id").val(),
      };
      sendEmailToCustomer(param);
    }
  });

  $("#saveEstimate").click(function () {
    if ($("#jobId").val() != "") {
      $.LoadingOverlay("show");
      var param = {
        estimate_date: $("#estimateDate").val(),
        expiry_date: $("#expiryDateEstimate").val(),
        description: $("#estimateDescription").val(),
        status: $("#estimateStatus").val(),
        job_id: $("#jobId").val(),
        employee_id: $("#customer_id").val(),
        estimate_value: $("#estimate_value").val(),
        deposit_request: $("#deposit_request").val(),
        jobNumber: $("#jobNum").val(),
      };
      saveEstimate(param);
    }
  });

  $("#jobCheckbox").click(function () {
    $("input:checkbox").not(this).prop("checked", this.checked);
    var selectedIds = [];

    $("input:checkbox").each(function () {
      if ($(this).prop("checked")) selectedIds.push($(this).data("id"));
    });
    $("#selectedIds").val(selectedIds);
  });

  $(".deleteSelect").click(function () {
    $.LoadingOverlay("show");
    var param = {
      ids: $("#selectedIds").val(),
    };
    deleteMultiple(param);
  });

  $("#assign_role").change(function () {
    var param = {
      id: $("#assign_role").val(),
    };
    getEmpByRole(param);
  });

  $("#add_assign_emp").click(function () {
    if ($("#jobId").val() != "0") {
      var param = {
        job_id: $("#jobId").val(),
        role_id: $("#assign_role").val(),
        emp_id: $("#assign_emp").val(),
      };
      addAssignEmp(param);
    }
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

function saveJobType(param, action) {
  var items = [];
  $.ajax({
    type: "POST",
    url: base_url + "job/saveJobType",
    data: param,
    success: function (data) {
      var result = jQuery.parseJSON(data);
      for (var i = 0; i < result.length; i++) {
        var item = [
          result[i].value,
          '<a href="javascript:void(0)" data-toggle="modal" data-target="#newJobTypeModal" data-id="' +
            result[i].job_settings_id +
            '" data-jobtype="' +
            result[i].value +
            '" class="editJobTypeBtn btn btn-warning btn-sm pr-2"><span class="fa fa-plus"></span> Edit</a>&nbsp; ' +
            '<a href="' +
            base_url +
            "job/deleteJobType?id=" +
            result[i].job_settings_id +
            '" data-id="' +
            result[i].job_settings_id +
            '" class="deleteJobTypeBtn btn btn-danger btn-sm"><span class="fa fa-plus"></span> Delete</a>',
        ];
        items.push(item);
      }
      $.LoadingOverlay("hide");
      if (action != "add_another") {
        $("#newJobTypeModal").modal("toggle");
      }
      $("#settingType").val("");
      $("#jobTypeTable").DataTable({
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

function saveEstimate(param) {
  $.ajax({
    type: "POST",
    url: base_url + "job/saveEstimate",
    data: param,
    success: function (data) {
      window.location.href = "";
    },
  });
}

function dropdownAccounting(n) {
  var id = $(n).attr("href");
  var sidebar = $("#sidebar").width();
  var s;
  if (sidebar == 40) {
    s = "41px";
  } else if (sidebar == 210) {
    s = "211px";
  } else {
    s = "261px";
  }

  if ($(id).css("display") == "none") {
    $(".sidebar-accounting li ul").hide();
    $("#sidebar ul li > ul").css("left", s);
    $(id).slideDown();
  } else {
    $(id).slideUp();
  }
}

function deleteMultiple(param) {
  $.ajax({
    type: "POST",
    url: base_url + "job/deleteMultiple",
    data: param,
    success: function (response) {
      window.location.href = "";
    },
  });
}

function getEmpByRole(param) {
  $.ajax({
    type: "POST",
    url: base_url + "job/getEmpByRole",
    data: param,
    success: function (response) {
      var result = jQuery.parseJSON(response);
      $("#assign_emp").empty();
      for (var i = 0; i < result.length; i++) {
        $("#assign_emp").append(
          '<option selected="selected" value="' +
            result[i].id +
            '">' +
            result[i].title +
            "</option>"
        );
      }
    },
  });
}

function addAssignEmp(param) {
  var items = [];
  $.ajax({
    type: "POST",
    url: base_url + "job/saveAssignEmp",
    data: param,
    success: function (data) {
      var result = jQuery.parseJSON(data);
      for (var i = 0; i < result.length; i++) {
        var item = [result[i].title, result[i].emp_role];
        items.push(item);
      }
      $("#assignEmpTable").DataTable({
        destroy: true,
        data: items,
      });
    },
  });
}
