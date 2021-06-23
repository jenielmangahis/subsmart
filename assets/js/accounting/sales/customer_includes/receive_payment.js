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

$(document).on("click", "#customer_receive_payment_modal .customer_receive_payment_modal_content .customer_receive_payment_modal_footer .clear-btn", function(event) {
    var customer_id = $("#customer_receive_payment_modal #receive_payment_form select[name='customer_id']").val();
    get_customer_info_for_receive_payment_modal(customer_id);
    event.preventDefault();
});
$(document).on("click", "#receive_payment_form .form-group .find-by-invoice-no", function(event) {
    event.preventDefault();
    $("#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices .filter .filter-panel").show();
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

$(document).on("click", "div#customer_receive_payment_modal .customer_receive_payment_modal_content .customer_receive_payment_modal_footer .btn-save-dropdown", function(event) {
    event.preventDefault();
    $("div#customer_receive_payment_modal .customer_receive_payment_modal_content .customer_receive_payment_modal_footer .right-option .sub-option").show();
});
$(document).on("click", function(event) {
    if ($(event.target).closest("div#customer_receive_payment_modal .customer_receive_payment_modal_content .customer_receive_payment_modal_footer .right-option").length === 0) {
        $("div#customer_receive_payment_modal .customer_receive_payment_modal_content .customer_receive_payment_modal_footer .right-option .sub-option").hide();
    }
    if ($(event.target).closest("#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices .filter").length === 0) {
        $("#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices .filter .filter-panel").hide();
    }
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
    console.log("Pasok");
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

$(document).on("click", ".customer_receive_payment_btn", function(event) {
    $("#customer_receive_payment_modal").fadeIn();
    event.preventDefault();
    var customer_id = $(this).attr("data-customer-id");
    $("#customer_receive_payment_modal #receive_payment_form select[name='customer_id']").val(customer_id);
    get_customer_info_for_receive_payment_modal(customer_id);
});

var invoice_count = 0;

function get_customer_info_for_receive_payment_modal(customer_id) {
    $.ajax({
        url: baseURL + "/accounting/get_customer_info_for_receive_payment",
        type: "POST",
        dataType: "json",
        data: { customer_id: customer_id },
        success: function(data) {
            $('#customer_receive_payment_modal #customer_invoice_table .table-body').html(data.html);
            $('#receive_payment_form .total-receive-payment .amount').html("$" + data.display_receivable_payment);
            $('div#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .total-amount .amount-to-apply .amount').html("$" + data.display_receivable_payment);
            $("#customer_receive_payment_modal #receive_payment_form input[name='amount_received']").val(data.display_receivable_payment);
            invoice_count = parseFloat(data.inv_count);

            $("#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices input[name='checkbox-all-action']").prop("checked", true);
            $("#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices .filter input[name='filter_date_from']").val("");
            $("#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices .filter input[name='filter_date_to']").val("");
            $("#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices .filter input[name='filter_overdue']").prop('checked', false);

            $("#customer_receive_payment_modal .customer_receive_payment_modal_content input[name='payment_date']").val("");
            $("#customer_receive_payment_modal .customer_receive_payment_modal_content select[name='payment_method']").val("");
            $("#customer_receive_payment_modal .customer_receive_payment_modal_content input[name='ref_no']").val("");
            $("#customer_receive_payment_modal .customer_receive_payment_modal_content select[name='deposite_to']").val("");
        },
    });
}

function get_customer_filtered_info_for_receive_payment_modal(filter_date_from, filter_date_to, filter_overdue, customer_id) {
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
            $("#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices input[name='checkbox-all-action']").prop("checked", true);
        },
    });
}
$("#customer_receive_payment_modal #receive_payment_form .filter input[name='invoice_number']").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#customer_receive_payment_modal #customer_invoice_table tbody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});


$(document).on("change", "div#customer_receive_payment_modal .customer_receive_payment_modal_content #customer_invoice_table td .inv_grand_amount", function(event) {
    var receivable_payment = 0;
    console.log(invoice_count);
    for (var i = 0; i < invoice_count; i++) {
        if ($("div#customer_receive_payment_modal .customer_receive_payment_modal_content #customer_invoice_table td input[name='inv_cb_" + i + "']").is(":checked")) {
            var inv_amount = $("div#customer_receive_payment_modal .customer_receive_payment_modal_content #customer_invoice_table td input[name='inv_" + i + "']").val();
            receivable_payment += parseFloat(inv_amount.replace(/,/g, ''));
            console.log(receivable_payment);
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
});


function formatMoney(n) {
    return "" + (Math.round(n * 100) / 100).toLocaleString();
}

$("#customer_receive_payment_modal #receive_payment_form").submit(function(event) {
    event.preventDefault();
});

$(document).on("click", "#customer_receive_payment_modal #receive_payment_form button[type='submit']", function(event) {
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
            $.ajax({
                url: baseURL + "/accounting/save_receive_payment_from_modal",
                type: "POST",
                dataType: "json",
                data: $("#customer_receive_payment_modal #receive_payment_form").serialize(),
                success: function(data) {
                    var submit_type = $(this).attr('data-submit-type');
                    if (submit_type == "save-new") {
                        $("#customer_receive_payment_modal #receive_payment_form select[name='customer_id']").val("");
                        get_customer_info_for_receive_payment_modal('');
                    }
                },
            });
        });

    }
});