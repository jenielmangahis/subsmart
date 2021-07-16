var payment_method_information = "";
$(document).ready(function() {
    payment_method_information = $("div#customer_receive_payment_modal .payment_method_information").html();
    $("div#customer_receive_payment_modal .payment_method_information").html("");
    $("div#addsalesreceiptModal .payment_method_information").html("");
});

$('#addsalesreceiptModal .recurring-form-part.below .date-part .input-field-1 .datepicker').datepicker({
    uiLibrary: 'bootstrap'
});
$('#addsalesreceiptModal .recurring-form-part.below .date-part .input-field-3 .by-end-date .datepicker').datepicker({
    uiLibrary: 'bootstrap'
});
$('#receive_payment_form .form-group .datepicker').datepicker({
    uiLibrary: 'bootstrap'
});
$('#receive_payment_form .form-group .filter-panel .date-filter .date-from .datepicker').datepicker({
    uiLibrary: 'bootstrap'
});
$('#receive_payment_form .form-group .filter-panel .date-filter .date-to .datepicker').datepicker({
    uiLibrary: 'bootstrap'
});

$(document).on("click", "#customer_receive_payment_modal .customer_receive_payment_modal_content .close-btn", function(event) {
    $("#customer_receive_payment_modal").fadeOut();
    event.preventDefault();
});

$(document).on("click", function(event) {
    if ($(event.target).closest("div#customer_receive_payment_modal .customer_receive_payment_modal_content .customer_receive_payment_modal_footer .right-option").length === 0) {
        $("div#customer_receive_payment_modal .customer_receive_payment_modal_content .customer_receive_payment_modal_footer .right-option .sub-option").hide();
    }
    if ($(event.target).closest("#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices .filter").length === 0) {
        $("#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices .filter .filter-panel").hide();
    }

    if ($(event.target).closest("#customer_receive_payment_modal .find-by-invoice-no-section").length === 0) {
        $("#customer_receive_payment_modal .find-by-invoice-no-panel").hide();
    }
    if ($(event.target).closest("div#customer_receive_payment_modal .customer_receive_payment_modal_content .customer_receive_payment_modal_footer .center-options").length === 0) {
        $("div#customer_receive_payment_modal .customer_receive_payment_modal_content .customer_receive_payment_modal_footer .more-sub-option").hide();
    }

});
$(document).on("click", "#customer_receive_payment_modal .customer_receive_payment_modal_content .customer_receive_payment_modal_footer .clear-btn", function(event) {
    var customer_id = $("#customer_receive_payment_modal #receive_payment_form select[name='customer_id']").val();
    get_customer_info_for_receive_payment_modal(customer_id);
    event.preventDefault();
});
$(document).on("click", "#receive_payment_form .form-group .find-by-invoice-no", function(event) {
    event.preventDefault();
    $("#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices .filter .filter-panel").show();
});
$(document).on("click", "#customer_receive_payment_modal .find-by-invoice-no-section button.find-by-invoice-no", function(event) {
    event.preventDefault();
    $("#customer_receive_payment_modal .find-by-invoice-no-panel").show();
});
$(document).on("click", "#customer_receive_payment_modal .find-by-invoice-no-section button.cancel-btn", function(event) {
    event.preventDefault();
    $("#customer_receive_payment_modal .find-by-invoice-no-panel").hide();
});

$(document).on("click", "#customer_receive_payment_modal .find-by-invoice-no-section button.find-btn", function(event) {
    event.preventDefault();
    $.ajax({
        url: baseURL + "/accounting/find_cutsomer_by_invoice_number",
        type: "POST",
        dataType: "json",
        data: {
            find_inv_no: $("#customer_receive_payment_modal .find-by-invoice-no-section .find-by-invoice-no-panel input[name='find-by-invoice-no']").val()
        },
        success: function(data) {
            if (data.customer_id != "") {
                $("#customer_receive_payment_modal .find-by-invoice-no-section .find-by-invoice-no-panel label.error").hide();
                $("#customer_receive_payment_modal #receive_payment_form select[name='customer_id']").val(data.customer_id);
                get_customer_info_for_receive_payment_modal(data.customer_id);
            } else {
                $("#customer_receive_payment_modal .find-by-invoice-no-section .find-by-invoice-no-panel label.error").show();
            }
        },
    });
});

$(document).on("click", "#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices .filter .filter-panel .buttons .cancel-btn", function(event) {
    event.preventDefault();
    $("#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices .filter .filter-panel").hide();
    $("#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices .filter input[name='filter_date_from']").val("");
    $("#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices .filter input[name='filter_date_to']").val("");
    $("#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices .filter input[name='filter_overdue']").prop('checked', false);
    var customer_id = $("#customer_receive_payment_modal #receive_payment_form select[name='customer_id']").val();
    get_customer_info_for_receive_payment_modal(customer_id);
});



$(document).on("click", ".customer_receive_payment_btn", function(event) {
    $("#customer_receive_payment_modal").fadeIn();
    event.preventDefault();
    var customer_id = $(this).attr("data-customer-id");
    $("#customer_receive_payment_modal #receive_payment_form select[name='customer_id']").val(customer_id);
    get_customer_info_for_receive_payment_modal(customer_id);
    $('#new-popup').modal('hide');
});

$(document).on("click", "#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices .filter .filter-panel .buttons .apply-btn", function(event) {
    event.preventDefault();
    var filter_date_from = $("#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices .filter input[name='filter_date_from']").val();
    var filter_date_to = $("#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices .filter input[name='filter_date_to']").val();
    var filter_overdue = $("#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices .filter input[name='filter_overdue']").is(':checked');
    var customer_id = $("#customer_receive_payment_modal #receive_payment_form select[name='customer_id']").val();

    $("#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices .filter input[name='filter_date_from']").removeClass("empty");
    $("#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices .filter input[name='filter_date_to']").removeClass("empty");
    get_customer_filtered_info_for_receive_payment_modal(filter_date_from, filter_date_to, filter_overdue, customer_id);
    $("#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices .filter .filter-panel").fadeOut();

});
$("#customer_receive_payment_modal #receive_payment_form select[name='customer_id']").change(function() {
    var customer_id = $(this).val();
    get_customer_info_for_receive_payment_modal(customer_id);

}).change();
$("#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices input[name='checkbox-all-action']").change(function() {
    for (var i = 0; i < invoice_count; i++) {
        $("#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices input[name='inv_cb_" + i + "']").prop("checked", $(this).is(":checked"));
    }
}).change();

$(document).on("change", "#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices .inv_cb", function(event) {
    var unchecked_found = false;
    for (var i = 0; i < invoice_count; i++) {
        if (!$("#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices input[name='inv_cb_" + i + "']").is(":checked")) {
            unchecked_found = true;
        }
    }
    if (unchecked_found) {
        $("#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices input[name='checkbox-all-action']").prop("checked", false);
    } else {
        $("#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices input[name='checkbox-all-action']").prop("checked", true);
    }
})

$(document).on("click", "div#customer_receive_payment_modal .customer_receive_payment_modal_content .customer_receive_payment_modal_footer .btn-save-dropdown", function(event) {
    event.preventDefault();
    $("div#customer_receive_payment_modal .customer_receive_payment_modal_content .customer_receive_payment_modal_footer .right-option .sub-option").show();
});
var invoice_count = 0;

function get_customer_info_for_receive_payment_modal(customer_id) {
    $("#loader-modal").show();
    $("#customer_receive_payment_modal #receive_payment_form input[name='receive_payment_id']").val("");
    $("#customer_receive_payment_modal #receive_payment_form input[name='ref_no']").removeAttr("disabled");
    $("#customer_receive_payment_modal #receive_payment_form input[name='payment_date']").removeAttr("disabled");
    $.ajax({
        url: baseURL + "/accounting/get_customer_info_for_receive_payment",
        type: "POST",
        dataType: "json",
        data: { customer_id: customer_id },
        success: function(data) {
            if (data.html == "") {
                $("#customer_receive_payment_modal .invoices .outstanding-transactions").hide();
            } else {
                $("#customer_receive_payment_modal .invoices .outstanding-transactions").show();
            }
            $('#customer_receive_payment_modal #customer_invoice_table .table-body').html(data.html);
            $('#receive_payment_form .total-receive-payment .amount').html("$" + data.display_receivable_payment);
            $('div#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .total-amount .amount-to-apply .amount').html("$" + data.display_receivable_payment);
            $("#customer_receive_payment_modal #receive_payment_form input[name='amount_received']").val(data.display_receivable_payment);
            invoice_count = parseFloat(data.inv_count);
            $("#customer_receive_payment_modal #receive_payment_form input[name='invoice_count']").val(data.inv_count);

            $("#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices input[name='checkbox-all-action']").prop("checked", true);
            $("#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices .filter input[name='filter_date_from']").val("");
            $("#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices .filter input[name='filter_date_to']").val("");
            $("#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices .filter input[name='filter_overdue']").prop('checked', false);

            $("#customer_receive_payment_modal .customer_receive_payment_modal_content input[name='payment_date']").val("");
            $("#customer_receive_payment_modal .customer_receive_payment_modal_content select[name='payment_method']").val("");
            $("#customer_receive_payment_modal .customer_receive_payment_modal_content input[name='ref_no']").val("");
            $("#customer_receive_payment_modal .customer_receive_payment_modal_content select[name='deposite_to']").val("");
            $("div#customer_receive_payment_modal .customer_receive_payment_modal_content .customer_receive_payment_modal_footer .btn-more").hide();
            $("#loader-modal").hide();
        },
    });
}

function get_customer_filtered_info_for_receive_payment_modal(filter_date_from, filter_date_to, filter_overdue, customer_id) {

    $("#loader-modal").show();
    $.ajax({
        url: baseURL + "/accounting/get_customer_filtered_info_for_receive_payment_modal",
        type: "POST",
        dataType: "json",
        data: {
            customer_id: customer_id,
            filter_date_from: filter_date_from,
            filter_date_to: filter_date_to,
            filter_overdue: filter_overdue
        },
        success: function(data) {
            $('#customer_receive_payment_modal #customer_invoice_table .table-body').html(data.html);
            $('#receive_payment_form .total-receive-payment .amount').html("$" + data.display_receivable_payment);
            $('div#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .total-amount .amount-to-apply .amount').html("$" + data.display_receivable_payment);
            $("#customer_receive_payment_modal #receive_payment_form input[name='amount_received']").val(data.display_receivable_payment);
            invoice_count = parseFloat(data.inv_count);
            $("#customer_receive_payment_modal #receive_payment_form input[name='invoice_count']").val(data.inv_count);
            $("#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices input[name='checkbox-all-action']").prop("checked", true);

            $("#loader-modal").hide();
        },
    });
}
$("#customer_receive_payment_modal #receive_payment_form .filter input[name='invoice_number']").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#customer_receive_payment_modal #customer_invoice_table tbody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
});



$('#customer_receive_payment_modal').on('hidden.bs.modal', function() {
    $("#customer_receive_payment_modal #receive_payment_form input[name='ref_no']").removeAttr("disabled");
    $("#customer_receive_payment_modal #receive_payment_form input[name='payment_date']").removeAttr("disabled");
    $('#customer_receive_payment_modal form').trigger("reset");
    get_customer_info_for_receive_payment_modal('');
});
$(document).on("click", "#customer_receive_payment_modal #receive_payment_form button[data-action='print']", function(event) {

    var submit_type = $(this).attr('data-submit-type');
    $("#customer_receive_payment_modal #receive_payment_form input[name='submit_option']").val(submit_type);
    var empty_flds = 0;
    $("#customer_receive_payment_modal #receive_payment_form  .required").each(function() {
        if (!$.trim($(this).val())) {
            empty_flds++;
        }
    });

    if (empty_flds == 0) {
        event.preventDefault();
        // $("#customer_receive_payment_modal #receive_payment_form").attr("action", baseURL + "/accounting/print_receive_payment");
        // $("#customer_receive_payment_modal #receive_payment_form").attr("target", "_blank");
        // $("#customer_receive_payment_modal #receive_payment_form").attr("method", "POST");
        // $("#customer_receive_payment_modal #receive_payment_form").submit();
        $("#loader-modal").show();

        $("#customer_receive_payment_modal #receive_payment_form input[name='ref_no']").removeAttr("disabled");
        $("#customer_receive_payment_modal #receive_payment_form input[name='payment_date']").removeAttr("disabled");
        $.ajax({
            url: baseURL + "/accounting/print_receive_payment",
            type: "POST",
            dataType: "json",
            data: $("#customer_receive_payment_modal #receive_payment_form").serialize(),
            success: function(data) {
                if (data.count_save > 0) {
                    $('#sales_receipt_pdf_preview_modal').modal('show');
                    $('#sales_receipt_pdf_preview_modal .send_sales_receipt_section').hide();
                    $("#sales_receipt_pdf_preview_modal .pdf-print-preview").html(
                        '<iframe src="' + data.file_location + '"></iframe>');
                    $("#sales_receipt_pdf_preview_modal .pdf_preview_section .print-button").attr("href", data.file_location);
                    $("#sales_receipt_pdf_preview_modal .pdf_preview_section .download-button").attr("href", data.file_location);
                    $("div#customer_receive_payment_modal .customer_receive_payment_modal_content .customer_receive_payment_modal_footer .btn-more").show();
                    $("div#customer_receive_payment_modal .customer_receive_payment_modal_content .customer_receive_payment_modal_footer .more-sub-option").hide();
                }
                $("#loader-modal").hide();
            },
        });
    }
});
$(document).on("click", "#customer_receive_payment_modal #receive_payment_form button[data-action='save']", function(event) {
    $("#customer_receive_payment_modal #receive_payment_form").removeAttr("target");
    $("#customer_receive_payment_modal #receive_payment_form").removeAttr("action");
    var submit_type = $(this).attr('data-submit-type');
    $("#customer_receive_payment_modal #receive_payment_form input[name='submit_option']").val(submit_type);
    var empty_flds = 0;
    $("#customer_receive_payment_modal #receive_payment_form  .required").each(function() {
        if (!$.trim($(this).val())) {
            empty_flds++;
        }
    });
    if (empty_flds == 0) {
        event.preventDefault();
        Swal.fire({
            title: "Save Receive Payment?",
            html: "Are you sure you want to save this?",
            showCancelButton: true,
            imageUrl: baseURL + "/assets/img/accounting/customers/folder.png",
            cancelButtonColor: "#d33",
            confirmButtonColor: "#2ca01c",
            confirmButtonText: $(this).html(),
        }).then((result) => {
            if (result.value) {
                $("#loader-modal").show();

                $("#customer_receive_payment_modal #receive_payment_form input[name='ref_no']").removeAttr("disabled");
                $("#customer_receive_payment_modal #receive_payment_form input[name='payment_date']").removeAttr("disabled");
                console.log($("#customer_receive_payment_modal #receive_payment_form input[name='receive_payment_id']").val());
                $.ajax({
                    url: baseURL + "/accounting/save_receive_payment_from_modal",
                    type: "POST",
                    dataType: "json",
                    data: $("#customer_receive_payment_modal #receive_payment_form").serialize(),
                    success: function(data) {
                        if (data.count_save > 0) {
                            $("div#customer_receive_payment_modal .customer_receive_payment_modal_content .customer_receive_payment_modal_footer .btn-more").show();
                            $("#customer_receive_payment_modal #receive_payment_form input[name='receive_payment_id']").val(data.receive_payment_id);
                            $("#customer_receive_payment_modal #receive_payment_form input[name='ref_no']").attr("disabled", "true");
                            $("#customer_receive_payment_modal #receive_payment_form input[name='payment_date']").attr("disabled", "true");
                            get_load_customers_table();
                            if (submit_type == "save-send") {
                                Swal.fire({
                                    showConfirmButton: false,
                                    timer: 2000,
                                    title: "Success",
                                    html: "Receive payment has been saved.",
                                    icon: "success",
                                });
                                $('#sales_receipt_pdf_preview_modal').modal('show');
                                $('#sales_receipt_pdf_preview_modal .send_sales_receipt_section').show();
                                $('#sales_receipt_pdf_preview_modal .pdf_preview_section').hide();
                                $('#sales_receipt_pdf_preview_modal .modal-title').html("Send email");
                                $('#sales_receipt_pdf_preview_modal form#send_sales_receipt input[name="receive_payment_id"]').val(data.receive_payment_id);
                                $('#sales_receipt_pdf_preview_modal form#send_sales_receipt input[name="email"]').val(data.customer_email);
                                $('#sales_receipt_pdf_preview_modal form#send_sales_receipt input[name="subject"]').val("Payment Receipt from " + data.business_name);
                                $('#sales_receipt_pdf_preview_modal form#send_sales_receipt textarea[name="body"]').val(`Please find our payment receipt attached to this email.

Thank you.
                                
Have a great day,
` + data.business_name);
                                $("#sales_receipt_pdf_preview_modal .modal-footer .send_sales_receipt_section .download-button").attr('href', data.file_location);
                                $("#sales_receipt_pdf_preview_modal .send_sales_receipt_section .send_sales_receipt-preview").html(
                                    '<iframe src="' + data.file_location + '"></iframe>');
                                get_load_customers_table();
                            } else {
                                Swal.fire({
                                    showConfirmButton: false,
                                    timer: 2000,
                                    title: "Success",
                                    html: "Receive payment has been saved.",
                                    icon: "success",
                                });
                            }
                        } else {
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: "Error",
                                html: "No payment saved. Please double check your inputs.",
                                icon: "error",
                            });
                        }
                        if (submit_type == "save-new") {
                            $("#customer_receive_payment_modal #receive_payment_form select[name='customer_id']").val("");
                            get_customer_info_for_receive_payment_modal('');
                        } else if (submit_type == "save-close") {
                            $("#customer_receive_payment_modal").fadeOut();
                        }
                    },
                });
            }
        });

    }
});
$(document).on("change", "div#customer_receive_payment_modal .customer_receive_payment_modal_content #customer_invoice_table td .inv_grand_amount", function(event) {
    receive_payment_inv_grand_amount_changed();
});
$(document).on("click", "div#customer_receive_payment_modal .customer_receive_payment_modal_content button.clear-payment", function(event) {
    for (var i = 0; i < invoice_count; i++) {
        $("div#customer_receive_payment_modal .customer_receive_payment_modal_content #customer_invoice_table td input[name='inv_" + i + "']").val(0);
    }
    receive_payment_inv_grand_amount_changed();
});

function receive_payment_inv_grand_amount_changed() {
    var receivable_payment = 0;
    for (var i = 0; i < invoice_count; i++) {
        if ($("div#customer_receive_payment_modal .customer_receive_payment_modal_content #customer_invoice_table td input[name='inv_cb_" + i + "']").is(":checked")) {
            var inv_amount = $("div#customer_receive_payment_modal .customer_receive_payment_modal_content #customer_invoice_table td input[name='inv_" + i + "']").val();
            receivable_payment += parseFloat(inv_amount.replace(/,/g, ''));
        }
    }
    const formatter = new Intl.NumberFormat('en-US', {
        notation: "scientific",
        minimumFractionDigits: 2
    })
    $('#receive_payment_form .total-receive-payment .amount').html("$" + formatMoney(receivable_payment));
    $('div#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .total-amount .amount-to-apply .amount').html("$" + formatMoney(receivable_payment));
    $("#customer_receive_payment_modal #receive_payment_form input[name='amount_received']").val(formatMoney(receivable_payment));
    $(this).val(formatMoney($(this).val().replace(/,/g, '')));
}


function formatMoney(n) {
    return "" + (Math.round(n * 100) / 100).toLocaleString();
}

$("#customer_receive_payment_modal #receive_payment_form").submit(function(event) {
    if ($("#customer_receive_payment_modal #receive_payment_form").attr("target") == "") {
        event.preventDefault();
    }
});

$(document).on("click", "div#customer_receive_payment_modal .customer_receive_payment_modal_content .customer_receive_payment_modal_footer .more-sub-option li", function(event) {
    event.preventDefault();
    var receive_payment_id = $("#customer_receive_payment_modal #receive_payment_form input[name='receive_payment_id']").val();
    if (receive_payment_id != "") {
        Swal.fire({
            title: "",
            html: "This transaction is linked to others. Are you sure you want to " + $(this).html() + " it?",
            showCancelButton: true,
            imageUrl: baseURL + "/assets/img/accounting/customers/exclamation-mark.png",
            cancelButtonColor: "#d33",
            confirmButtonColor: "#2ca01c",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
        }).then((result) => {
            if (result.value) {
                var action = "";
                if ($(this).attr("data-option-type") == "void") {
                    action = "void";
                } else if ($(this).attr("data-option-type") == "delete") {
                    action = "delete";
                }
                $.ajax({
                    url: baseURL + "/accounting/receive_payment_more_option",
                    type: "POST",
                    dataType: "json",
                    data: {
                        receive_payment_id: receive_payment_id,
                        action: action
                    },
                    success: function(data) {
                        if (data.result == "success") {

                            if (action == "delete") {
                                $("#customer_receive_payment_modal #receive_payment_form input[name='receive_payment_id']").val("");
                                action = "deleted.";
                                $("div#customer_receive_payment_modal .customer_receive_payment_modal_content .customer_receive_payment_modal_footer .btn-more").hide();
                            } else {
                                action = "voided.";
                            }
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: "Success",
                                html: "Transaction has been" + action,
                                icon: "success",
                            });
                        } else {
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: "Something went wrong.",
                                icon: "error",
                            });
                        }
                    },
                });
            }
        });
    }
});

$(document).on("click", "div#customer_receive_payment_modal .customer_receive_payment_modal_content .customer_receive_payment_modal_footer .btn-more", function(event) {
    $("div#customer_receive_payment_modal .customer_receive_payment_modal_content .customer_receive_payment_modal_footer .more-sub-option").show();
});
$(document).on("change", "div#customer_receive_payment_modal form select[name='payment_method']", function(event) {
    $("div#customer_receive_payment_modal .payment_method_information").html("");
    $("div#addsalesreceiptModal .payment_method_information").html("");

    $("div#customer_receive_payment_modal .payment_method_information").html(payment_method_information);
    if (this.value == 'Cash') {
        // alert('cash');
        // $('#exampleModal').modal('toggle');
        $('#cash_area').show();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#invoicing').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    } else if (this.value == 'Invoicing') {

        $('#cash_area').hide();
        $('#check_area').hide();
        $('#invoicing').show();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    } else if (this.value == 'Check') {
        // alert('Check');
        $('#cash_area').hide();
        $('#check_area').show();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#invoicing').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    } else if (this.value == 'Credit Card') {
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').show();
        $('#debit_card').hide();
        $('#invoicing').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    } else if (this.value == 'Debit Card') {
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').show();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#invoicing').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    } else if (this.value == 'ACH') {
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#invoicing').hide();
        $('#ach_area').show();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    } else if (this.value == 'Venmo') {
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#ach_area').hide();
        $('#invoicing').hide();
        $('#venmo_area').show();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    } else if (this.value == 'Paypal') {
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#invoicing').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').show();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    } else if (this.value == 'Square') {
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#invoicing').hide();
        $('#debit_card').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').show();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    } else if (this.value == 'Warranty Work') {
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#invoicing').hide();
        $('#debit_card').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').show();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    } else if (this.value == 'Home Owner Financing') {
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#invoicing').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').show();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    } else if (this.value == 'e-Transfer') {
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#invoicing').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').show();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    } else if (this.value == 'Other Credit Card Professor') {
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#invoicing').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').show();
        $('#other_payment_area').hide();
    } else if (this.value == 'Other Payment Type') {
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#invoicing').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').show();
    }
});