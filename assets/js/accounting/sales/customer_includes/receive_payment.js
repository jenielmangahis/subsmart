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
$(document).on("click", "#receive_payment_form .form-group .find-by-invoice-no", function(event) {
    event.preventDefault();
    $("#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices .filter .filter-panel").show();
});
$(document).on("click", "#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices .filter .filter-panel .buttons .cancel-btn", function(event) {
    event.preventDefault();
    $("#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices .filter .filter-panel").hide();
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
    $("#customer_receive_payment_modal .customer_receive_payment_modal_content .invoicing-part .invoices .filter .filter-panel").hide();

});
$("#customer_receive_payment_modal #receive_payment_form select[name='customer_id']").change(function() {
    var customer_id = $(this).val();
    get_customer_info_for_receive_payment_modal(customer_id);
}).change();

$(document).on("click", ".customer_receive_payment_btn", function(event) {
    $("#customer_receive_payment_modal").fadeIn();
    event.preventDefault();
    var customer_id = $(this).attr("data-customer-id");
    $("#customer_receive_payment_modal #receive_payment_form select[name='customer_id']").val(customer_id);
    get_customer_info_for_receive_payment_modal(customer_id);
});

var invooice_count = 0;


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
            invooice_count = parseFloat(data.inv_count);
        },
    });
}
$("#customer_receive_payment_modal #receive_payment_form .filter input[name='invoice_number']").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#customer_receive_payment_modal #customer_invoice_table tbody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});


$(document).on("keyup", "div#customer_receive_payment_modal .customer_receive_payment_modal_content #customer_invoice_table td input", function(event) {
    var receivable_payment = 0;
    console.log(invooice_count);
    for (var i = 0; i < invooice_count; i++) {
        var inv_amount = $("div#customer_receive_payment_modal .customer_receive_payment_modal_content #customer_invoice_table td input[name='inv_" + i + "']").val();
        receivable_payment += parseFloat(inv_amount.replace(/,/g, ''));
        console.log(receivable_payment);
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