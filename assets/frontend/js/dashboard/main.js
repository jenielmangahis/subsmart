$(document).ready(function () {
    $("#job_customer").change(function () {
      $("#customer_id").val($("#job_customer").val());
      var param = {
        id: $("#job_customer").val(),
      };
      getCustomerLocations(param);
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
  
  function saveNewCustomerLocation(param) {
    var items = [];
    $.ajax({
      type: "POST",
      url: base_url + "job/saveNewCustomerLocation",
      data: param,
      success: function (data) {
        $.LoadingOverlay("hide");
        $("#modalAddressLocation").modal("show");
        $("#address1").val("");
        $("#address2").val("");
        $("#city").val("");
        $("#state").val("");
        $("#postal_code").val("");
        var result = jQuery.parseJSON(data);
        $("#customer_location").empty();
        for (var i = 0; i < result.length; i++) {
          $("#customer_location").append(
            '<option selected="selected" value="' +
              result[i].address_id +
              '">' +
              result[i].address1 +
              " " +
              result[i].city +
              " " +
              result[i].state +
              " " +
              result[i].postal_code +
              "</option>"
          );
        }
      },
    });
  }
  
  function getCustomerLocations(param) {
    $.ajax({
      type: "POST",
      url: base_url + "job/getCustomerLocations",
      data: param,
      success: function (response) {
        var result = jQuery.parseJSON(response);
        $("#newLocationBtn").show();
        $("#customer_location").empty();
        for (var i = 0; i < result.length; i++) {
          $("#customer_location").append(
            '<option selected="selected" value="' +
              result[i].address_id +
              '">' +
              result[i].address1 +
              " " +
              result[i].city +
              " " +
              result[i].state +
              " " +
              result[i].postal_code +
              "</option>"
          );
        }
      },
    });
  }
  