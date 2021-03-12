var options = {
  urlGetAll: base_url + "invoice/customer/json_list",
  urlGetAllJob: base_url + "invoice/job/json_list",
  urlAdd: base_url + "invoice/source/save/json",
  urlServiceAddressForm: base_url + "invoice/service_address_form",
  urlSaveServiceAddress: base_url + "invoice/save_service_address",
  urlGetServiceAddress: base_url + "invoice/json_get_address_services",
  urlRemoveServiceAddress: base_url + "invoice/remove_address_services",
  urlAdditionalContactForm: base_url + "invoice/new_customer_form",
  urlRecordPaymentForm: base_url + "invoice/record_payment_form",
  urlPayNowForm: base_url + "invoice/pay_now_form",
  urlSaveAdditionalContact: base_url + "invoice/save_new_customer",
  urlGetAdditionalContacts: base_url + "invoice/json_get_new_customers",
  urlRemoveInvoice: base_url + "invoice/delete",
  urlCloneInvoice: base_url + "invoice/clone",
  urlMarkAsSentInvoice: base_url + "invoice/mark_as_sent",
  urlSavePaymentRecord: base_url + "invoice/save_payment_record",
  urlPayNow: base_url + "invoice/stripePost",
};

$(document).ready(function () {
  $(document).on("click", "#modalAddNewSource .save", function (e) {
    e.preventDefault();

    $("#frm_add_new_source").submit();
  });

  $(document).on("submit", "#frm_add_new_source", function (e) {
    e.preventDefault();

    var saveButton = $("#modalAddNewSource .save");
    var saveButtontext = $(saveButton).html();

    $(saveButton).attr("disabled", true);

    jQuery.ajax({
      url: options.urlAdd,
      type: "POST",
      data: $(this).serialize(),
      beforeSend: function () {
        $(saveButton).text("saving...");
      },
      success: function (response) {
        console.log(response);

        $("#modalAddNewSource").modal("hide");
      },
    });
  });

  $("#invoice_customer").select2({
    ajax: {
      url: options.urlGetAll,
      dataType: "json",
      delay: 250,
      data: function (params) {
        return {
          q: params.term, // search term
          page: params.page,
        };
      },
      processResults: function (data, params) {
        // parse the results into the format expected by Select2
        // since we are using custom formatting functions we do not need to
        // alter the remote JSON data, except to indicate that infinite
        // scrolling can be used
        params.page = params.page || 1;

        return {
          results: data,
          // pagination: {
          //   more: (params.page * 30) < data.total_count
          // }
        };
      },
      cache: true,
    },
    placeholder: "Select Customer",
    minimumInputLength: 0,
    templateResult: formatRepo,
    templateSelection: formatRepoSelection,
  });

  $("#invoice_job_location").select2({
    ajax: {
      url: options.urlGetAllJob,
      dataType: "json",
      delay: 250,
      data: function (params) {
        return {
          q: params.term, // search term
          page: params.page,
        };
      },
      processResults: function (data, params) {
        // parse the results into the format expected by Select2
        // since we are using custom formatting functions we do not need to
        // alter the remote JSON data, except to indicate that infinite
        // scrolling can be used
        params.page = params.page || 1;

        return {
          results: data,
          // pagination: {
          //   more: (params.page * 30) < data.total_count
          // }
        };
      },
      cache: true,
    },
    placeholder: "Select Address",
    minimumInputLength: 0,
    templateResult: formatRepo,
    templateSelection: formatRepoSelection,
  });

  // open service address form
  $("#modalServiceAddress").on("shown.bs.modal", function (e) {
    var element = $(this);
    $(element).find(".modal-body").html("loading...");

    // console.log($(e.relatedTarget).attr('data-inquiry-id'));

    var service_address_index = $(e.relatedTarget).attr("data-id");
    var inquiry_id = $(e.relatedTarget).attr("data-inquiry-id");

    if (service_address_index && inquiry_id) {
      $.ajax({
        url: options.urlServiceAddressForm,
        type: "GET",
        data: { index: service_address_index, inquiry_id: inquiry_id },
        success: function (response) {
          // console.log(response);

          $(element).find(".modal-body").html(response);
        },
      });
    } else {
      $.ajax({
        url: options.urlServiceAddressForm,
        type: "GET",
        success: function (response) {
          // console.log(response);

          $(element).find(".modal-body").html(response);
        },
      });
    }
  });

  $(document).on(
    "click",
    "#modalServiceAddress .modal-footer > button:last-child",
    function (e) {
      e.preventDefault();

      $("#frm_serice_address").submit();
    }
  );

  $(document).on("submit", "#frm_serice_address", function (e) {
    e.preventDefault();

    $.ajax({
      url: options.urlSaveServiceAddress,
      type: "POST",
      data: $(this).serialize(),
      success: function (response) {
        console.log(response);
        var json = JSON.parse(response);

        if (json.inquiry_id) {
          get_service_address(json.inquiry_id);
        }

        $("#modalServiceAddress").modal("hide");

        // $(element).find('.modal-body').html(response);
      },
    });
  });

  // remove service address
  $(document).on("click", ".inquiry-address-list__delete", function () {
    if (confirm("Are you sure to delete this item")) {
      var service_address_index = $(this).attr("data-id");
      var inquiry_id = $(this).attr("data-inquiry-id");
      var row = $(this).closest("li.inquiry-address-list__item");

      $(row).css("opacity", 0.5);
      $(row).find("a").attr("disabled", true);

      $.ajax({
        url: options.urlRemoveServiceAddress,
        type: "POST",
        data: { index: service_address_index, inquiry_id: inquiry_id },
        success: function (response) {
          console.log(response);

          var json = JSON.parse(response);

          if (json.status == "success") {
            $(row).remove();
          } else {
            alert("Something went wrong!");
            $(row).css("opacity", 1);
            $(row).find("a").attr("disabled", false);
          }

          // get_service_address();
        },
      });
    }
  });

  // get_service_address();

  /* Contact */

  // open additional contact form
  $("#modalNewCustomer").on("shown.bs.modal", function (e) {
    var element = $(this);
    $(element).find(".modal-body").html("loading...");

    var service_address_index = $(e.relatedTarget).attr("data-id");
    var inquiry_id = $(e.relatedTarget).attr("data-inquiry-id");

    if (service_address_index && inquiry_id) {
      $.ajax({
        url: options.urlAdditionalContactForm,
        type: "GET",
        data: {
          index: service_address_index,
          inquiry_id: inquiry_id,
          action: "edit",
        },
        success: function (response) {
          // console.log(response);

          $(element).find(".modal-body").html(response);
        },
      });
    } else {
      $.ajax({
        url: options.urlAdditionalContactForm,
        type: "GET",
        success: function (response) {
          $(element).find(".modal-body").html(response);
        },
      });
    }
  });

  $(document).on(
    "click",
    ".openConvertToWorkOrder, .openCloneInvoice, .openDeleteInvoice, .openMarkAsSent",
    function () {
      var invoice_number = $(this).data("invoice-number");
      var id = $(this).data("id");

      $("#workOrderInvoiceId").text(invoice_number);

      $("#markAsSentId").text(invoice_number);
      $("#markAsSentBtn").attr("href", options.urlMarkAsSentInvoice + "/" + id);

      $("#cloneInvoiceId").text(invoice_number);
      $("#cloneInvoiceBtn").attr("href", options.urlCloneInvoice + "/" + id);

      $("#deleteInvoiceId").text(invoice_number);
      $("#deleteInvoiceBtn").attr("href", options.urlRemoveInvoice + "/" + id);
    }
  );

  $(document).ready(function () {
    if ($("#autoOpenModalRP").val() === "payment_add") {
      $("#modalRecordPayment").modal("show");
    }
  });

  // open record payment form
  $("#modalRecordPayment").on("shown.bs.modal", function (e) {
    var element = $(this);
    $(element).find(".modal-body").html("loading...");

    var invoice_id = $("#recordPaymentInvoiceId").val();
    if (invoice_id) {
      $.ajax({
        url: options.urlRecordPaymentForm,
        type: "GET",
        data: {
          invoice_id: invoice_id,
          action: "edit",
        },
        success: function (response) {
          // console.log(response);

          $(element).find(".modal-body").html(response);
        },
      });
    } else {
      $.ajax({
        url: options.urlRecordPaymentForm,
        type: "GET",
        success: function (response) {
          $(element).find(".modal-body").html(response);
        },
      });
    }
  });

  // open record payment form
  $("#modalPayNow").on("shown.bs.modal", function (e) {
    var element = $(this);
    $(element).find(".modal-body").html("loading...");

    var invoice_id = $(e.relatedTarget).attr("data-id");
    if (invoice_id) {
      $.ajax({
        url: options.urlPayNowForm,
        type: "GET",
        data: {
          invoice_id: invoice_id,
          action: "edit",
        },
        success: function (response) {
          // console.log(response);

          $(element).find(".modal-body").html(response);
        },
      });
    } else {
      $.ajax({
        url: options.urlPayNowForm,
        type: "GET",
        success: function (response) {
          $(element).find(".modal-body").html(response);
        },
      });
    }
  });

  $(document).on(
    "click",
    "#modalNewCustomer .modal-footer > button:last-child",
    function (e) {
      e.preventDefault();

      $("#frm_new_customer").submit();
    }
  );

  $(document).on("submit", "#frm_new_customer", function (e) {
    e.preventDefault();

    $.ajax({
      url: options.urlSaveAdditionalContact,
      type: "POST",
      data: $(this).serialize(),
      success: function (response) {
        console.log(response);
        var json = JSON.parse(response);

        if (json.invoice_id) {
          get_new_customers(json.invoice_id);
        }

        $("#modalNewCustomer").modal("hide");
      },
    });
  });

  // remove service address
  $(document).on("click", ".inquiry-contact-list__delete", function () {
    if (confirm("Are you sure to delete this item")) {
      var service_address_index = $(this).attr("data-id");
      var inquiry_id = $(this).attr("data-inquiry-id");
      var row = $(this).closest("li.inquiry-contact-list__item");

      $(row).css("opacity", 0.5);
      $(row).find("a").attr("disabled", true);

      $.ajax({
        url: options.urlRemoveAdditionalContact,
        type: "POST",
        data: { index: service_address_index, inquiry_id: inquiry_id },
        success: function (response) {
          console.log(response);

          var json = JSON.parse(response);

          if (json.status == "success") {
            $(row).remove();
          } else {
            alert("Something went wrong!");
            $(row).css("opacity", 1);
            $(row).find("a").attr("disabled", false);
          }
        },
      });
    }
  });

  // get_new_customers();

  // save inquiry
  $(document).on("submit", "#inquiry_form", function (e) {
    e.preventDefault();
    var button = $(this).find("button[type='submit']");
    var button_text = $(button).html();
    $(button).text("saving...");
    $(button).attr("disabled", true);

    $.ajax({
      url: $(this).attr("action"),
      type: "POST",
      data: $(this).serialize(),
      success: function (response) {
        console.log(response);

        var json = JSON.parse(response);

        if (json.url) {
          location.href = json.url;
        } else {
          $(button).text(button_text);
          $(button).attr("disabled", false);
        }
      },
    });
  });

  toggle_advance_options();
  toggle_add_more_info();

  $(document).on("click", "#inv-set-commercial", function (e) {
    e.preventDefault();
    $("#tab_residential").hide();
    $("#tab_commercial").show();
    $("#res_li").removeClass("active");
    $("#com_li").addClass("active");
    $("#invoice_type").val("commercial");
  });

  $(document).on("click", "#inv-set-residential", function (e) {
    e.preventDefault();
    $("#tab_commercial").hide();
    $("#tab_residential").show();
    $("#com_li").removeClass("active");
    $("#res_li").addClass("active");
    $("#invoice_type").val("residential");
  });

  $(document).on("click", "#same_as_residential", function (e) {
    if ($("#same_as_residential").is(":checked")) {
      $("#message_commercial").text($("#message").val());
      $("#terms_commercial").text($("#terms").val());
    } else {
      $("#message_commercial").text("");
      $("#terms_commercial").text("");
    }
  });

  $("#technician_arrival_time, #technician_departure_time").datetimepicker({
    format: "LT",
  });

  $("#due_date").datetimepicker({
    format: "L",
  });

  $("#issued_date").datetimepicker({
    format: "L",
  });

  $("#email_scheduled_date").datetimepicker({
    minDate: new Date(),
    format: "DD-MMM-Y",
  });

  $("#recurring_until").datetimepicker({
    format: "DD-MMM-Y",
  });

  $("#start_on").datetimepicker({
    format: "DD-MMM-Y",
  });

  $("#start_on").datetimepicker({
    defaultDate: new Date(),
    format: "DD/MM/YYYY HH:mm",
  });

  $("#recurring_scheduled_time").timepicker({});

  $("#email_scheduled_time").timepicker({});

  $("body").delegate("#paymentCalendar", "focusin", function () {
    $(this).datetimepicker({
      format: "L",
    });
  });

  $("body").delegate("#date_payment", "focusin", function () {
    $(this).datetimepicker({
      format: "YYYY-MM-DD",
    });
  });

  // remove item from list
  $(document).on("click", ".remove-data-item", function (e) {
    e.preventDefault();

    var button = $(this);
    var row = $(this).parent().parent();

    if (confirm("Do you really want to delete this item ?")) {
      $(button).attr("disabled", true);
      $(row).css({ opacity: ".50" });

      jQuery.ajax({
        url: $(this).attr("href"),
        type: "DELETE",
        success: function (response) {
          console.log(response);
          $(row).remove();
        },
        error: function (err) {
          $(button).attr("disabled", false);
          $(row).css({ opacity: "1" });
        },
      });
    }
  });
});

function toggle_advance_options() {
  //
  if (!$("#company_div").is("hidden")) {
    $("#company_div, #company_div span").each(function (index, element) {
      $(element).attr("disabled", false);
    });
  }

  //choose advance inquiry option
  $(document).on("change", '#inquiry_type_group input[type="radio"]', function (
    e
  ) {
    if ($(this).val() === "Commercial") {
      $("#company_div, #company_div_empty").show();
      $("#company_div, #company_div_empty").each(function (index, element) {
        $(element).attr("disabled", false);
      });

      $("#company_div span").each(function (index, element) {
        $(element).attr("disabled", true);
      });
    } else {
      $("#company_div, #company_div_empty").hide();
      $("#company_div, #company_div_empty").each(function (index, element) {
        $(element).attr("disabled", true);
      });

      $("#company_div span").each(function (index, element) {
        $(element).attr("disabled", false);
      });
    }
  });
}

function toggle_add_more_info() {
  $(document).on("click", "#show_more_info", function (e) {
    $("#show_more_info").hide();
    $("#hide_more_info").show();
    $("#customer_additional_info").show();
    $("#customer_additional_info, #customer_additional_info div").each(
      function (index, element) {
        $(element).attr("disabled", false);
      }
    );
  });

  $(document).on("click", "#hide_more_info", function (e) {
    $("#show_more_info").show();
    $("#hide_more_info").hide();
    $("#customer_additional_info").hide();
    $("#customer_additional_info, #customer_additional_info div").each(
      function (index, element) {
        $(element).attr("disabled", true);
      }
    );
  });

  $(document).on("change", "#show_qty_type", function (e) {
    var qty_type = $("#show_qty_type").val();
    $("#qty_type_value").html(qty_type);
  });
}

function get_service_address(inquiry_id) {
  $.ajax({
    url: options.urlGetServiceAddress,
    type: "get",
    data: { inquiry_id: inquiry_id },
    success: function (response) {
      console.log(response);

      $("#service_address_container").html(response);
    },
  });
}

function get_new_customers(inquiry_id) {
  $.ajax({
    url: options.urlGetAdditionalContacts,
    type: "get",
    data: { inquiry_id: inquiry_id },
    success: function (response) {
      console.log(response);

      $("#new_customers_container").html(response);
    },
  });
}

function formatRepo(repo) {
  if (repo) {
    return repo.first_name
      ? repo.first_name + " " + repo.last_name
      : "";
  }

  var $container = $(
    "<div class='select2-result-repository clearfix'>" +
      "<div class='select2-result-repository__meta'>" +
      "<div class='select2-result-repository__title'></div>" +
      "</div>" +
      "</div>" +
      "</div>"
  );

  $container.find(".select2-result-repository__title").text(repo.first_name);

  return $container;
}

function formatRepoSelection(repo) {
  return repo.first_name ? repo.first_name + " " + repo.last_name : "";
}

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $("#img_profile").attr("src", e.target.result).width(100).height(100);
    };

    reader.readAsDataURL(input.files[0]);
  }
}
