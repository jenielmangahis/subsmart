$(document).on("click", "div#delayed_credit_modal", function(event) {
    if ($(event.target).closest("div#delayed_credit_modal table ul.suggestions").length === 0 && $(event.target).closest("#delayed_credit_modal .items-section table input[name='items[]']").length == 0) {
        $("div#delayed_credit_modal table ul.suggestions").html("");
    }

});
$(document).on("change", "div#delayed_credit_modal form select[name='payment_method']", function(event) {
    if (this.value == 'Cash') {
        // alert('cash');
        // $('#exampleModal').modal('toggle');
        $('div#delayed_credit_modal #cash_area').show();
        $('div#delayed_credit_modal #check_area').hide();
        $('div#delayed_credit_modal #credit_card').hide();
        $('div#delayed_credit_modal #debit_card').hide();
        $('div#delayed_credit_modal #ach_area').hide();
        $('div#delayed_credit_modal #venmo_area').hide();
        $('div#delayed_credit_modal #paypal_area').hide();
        $('div#delayed_credit_modal #invoicing').hide();
        $('div#delayed_credit_modal #square_area').hide();
        $('div#delayed_credit_modal #warranty_area').hide();
        $('div#delayed_credit_modal #home_area').hide();
        $('div#delayed_credit_modal #e_area').hide();
        $('div#delayed_credit_modal #other_credit_card').hide();
        $('div#delayed_credit_modal #other_payment_area').hide();
    } else if (this.value == 'Invoicing') {
        $('div#delayed_credit_modal #cash_area').hide();
        $('div#delayed_credit_modal #check_area').hide();
        $('div#delayed_credit_modal #invoicing').show();
        $('div#delayed_credit_modal #credit_card').hide();
        $('div#delayed_credit_modal #debit_card').hide();
        $('div#delayed_credit_modal #ach_area').hide();
        $('div#delayed_credit_modal #venmo_area').hide();
        $('div#delayed_credit_modal #paypal_area').hide();
        $('div#delayed_credit_modal #square_area').hide();
        $('div#delayed_credit_modal #warranty_area').hide();
        $('div#delayed_credit_modal #home_area').hide();
        $('div#delayed_credit_modal #e_area').hide();
        $('div#delayed_credit_modal #other_credit_card').hide();
        $('div#delayed_credit_modal #other_payment_area').hide();
    } else if (this.value == 'Check') {
        // alert('Check');
        $('div#delayed_credit_modal #cash_area').hide();
        $('div#delayed_credit_modal #check_area').show();
        $('div#delayed_credit_modal #credit_card').hide();
        $('div#delayed_credit_modal #debit_card').hide();
        $('div#delayed_credit_modal #invoicing').hide();
        $('div#delayed_credit_modal #ach_area').hide();
        $('div#delayed_credit_modal #venmo_area').hide();
        $('div#delayed_credit_modal #paypal_area').hide();
        $('div#delayed_credit_modal #square_area').hide();
        $('div#delayed_credit_modal #warranty_area').hide();
        $('div#delayed_credit_modal #home_area').hide();
        $('div#delayed_credit_modal #e_area').hide();
        $('div#delayed_credit_modal #other_credit_card').hide();
        $('div#delayed_credit_modal #other_payment_area').hide();
    } else if (this.value == 'Credit Card') {
        // alert('Credit card');
        $('div#delayed_credit_modal #cash_area').hide();
        $('div#delayed_credit_modal #check_area').hide();
        $('div#delayed_credit_modal #credit_card').show();
        $('div#delayed_credit_modal #debit_card').hide();
        $('div#delayed_credit_modal #invoicing').hide();
        $('div#delayed_credit_modal #ach_area').hide();
        $('div#delayed_credit_modal #venmo_area').hide();
        $('div#delayed_credit_modal #paypal_area').hide();
        $('div#delayed_credit_modal #square_area').hide();
        $('div#delayed_credit_modal #warranty_area').hide();
        $('div#delayed_credit_modal #home_area').hide();
        $('div#delayed_credit_modal #e_area').hide();
        $('div#delayed_credit_modal #other_credit_card').hide();
        $('div#delayed_credit_modal #other_payment_area').hide();
    } else if (this.value == 'Debit Card') {
        // alert('Credit card');
        $('div#delayed_credit_modal #cash_area').hide();
        $('div#delayed_credit_modal #check_area').hide();
        $('div#delayed_credit_modal #credit_card').hide();
        $('div#delayed_credit_modal #debit_card').show();
        $('div#delayed_credit_modal #ach_area').hide();
        $('div#delayed_credit_modal #venmo_area').hide();
        $('div#delayed_credit_modal #invoicing').hide();
        $('div#delayed_credit_modal #paypal_area').hide();
        $('div#delayed_credit_modal #square_area').hide();
        $('div#delayed_credit_modal #warranty_area').hide();
        $('div#delayed_credit_modal #home_area').hide();
        $('div#delayed_credit_modal #e_area').hide();
        $('div#delayed_credit_modal #other_credit_card').hide();
        $('div#delayed_credit_modal #other_payment_area').hide();
    } else if (this.value == 'ACH') {
        // alert('Credit card');
        $('div#delayed_credit_modal #cash_area').hide();
        $('div#delayed_credit_modal #check_area').hide();
        $('div#delayed_credit_modal #credit_card').hide();
        $('div#delayed_credit_modal #debit_card').hide();
        $('div#delayed_credit_modal #invoicing').hide();
        $('div#delayed_credit_modal #ach_area').show();
        $('div#delayed_credit_modal #venmo_area').hide();
        $('div#delayed_credit_modal #paypal_area').hide();
        $('div#delayed_credit_modal #square_area').hide();
        $('div#delayed_credit_modal #warranty_area').hide();
        $('div#delayed_credit_modal #home_area').hide();
        $('div#delayed_credit_modal #e_area').hide();
        $('div#delayed_credit_modal #other_credit_card').hide();
        $('div#delayed_credit_modal #other_payment_area').hide();
    } else if (this.value == 'Venmo') {
        // alert('Credit card');
        $('div#delayed_credit_modal #cash_area').hide();
        $('div#delayed_credit_modal #check_area').hide();
        $('div#delayed_credit_modal #credit_card').hide();
        $('div#delayed_credit_modal #debit_card').hide();
        $('div#delayed_credit_modal #ach_area').hide();
        $('div#delayed_credit_modal #invoicing').hide();
        $('div#delayed_credit_modal #venmo_area').show();
        $('div#delayed_credit_modal #paypal_area').hide();
        $('div#delayed_credit_modal #square_area').hide();
        $('div#delayed_credit_modal #warranty_area').hide();
        $('div#delayed_credit_modal #home_area').hide();
        $('div#delayed_credit_modal #e_area').hide();
        $('div#delayed_credit_modal #other_credit_card').hide();
        $('div#delayed_credit_modal #other_payment_area').hide();
    } else if (this.value == 'Paypal') {
        // alert('Credit card');
        $('div#delayed_credit_modal #cash_area').hide();
        $('div#delayed_credit_modal #check_area').hide();
        $('div#delayed_credit_modal #credit_card').hide();
        $('div#delayed_credit_modal #debit_card').hide();
        $('div#delayed_credit_modal #invoicing').hide();
        $('div#delayed_credit_modal #ach_area').hide();
        $('div#delayed_credit_modal #venmo_area').hide();
        $('div#delayed_credit_modal #paypal_area').show();
        $('div#delayed_credit_modal #square_area').hide();
        $('div#delayed_credit_modal #warranty_area').hide();
        $('div#delayed_credit_modal #home_area').hide();
        $('div#delayed_credit_modal #e_area').hide();
        $('div#delayed_credit_modal #other_credit_card').hide();
        $('div#delayed_credit_modal #other_payment_area').hide();
    } else if (this.value == 'Square') {
        // alert('Credit card');
        $('div#delayed_credit_modal #cash_area').hide();
        $('div#delayed_credit_modal #check_area').hide();
        $('div#delayed_credit_modal #credit_card').hide();
        $('div#delayed_credit_modal #invoicing').hide();
        $('div#delayed_credit_modal #debit_card').hide();
        $('div#delayed_credit_modal #ach_area').hide();
        $('div#delayed_credit_modal #venmo_area').hide();
        $('div#delayed_credit_modal #paypal_area').hide();
        $('div#delayed_credit_modal #square_area').show();
        $('div#delayed_credit_modal #warranty_area').hide();
        $('div#delayed_credit_modal #home_area').hide();
        $('div#delayed_credit_modal #e_area').hide();
        $('div#delayed_credit_modal #other_credit_card').hide();
        $('div#delayed_credit_modal #other_payment_area').hide();
    } else if (this.value == 'Warranty Work') {
        // alert('Credit card');
        $('div#delayed_credit_modal #cash_area').hide();
        $('div#delayed_credit_modal #check_area').hide();
        $('div#delayed_credit_modal #credit_card').hide();
        $('div#delayed_credit_modal #invoicing').hide();
        $('div#delayed_credit_modal #debit_card').hide();
        $('div#delayed_credit_modal #ach_area').hide();
        $('div#delayed_credit_modal #venmo_area').hide();
        $('div#delayed_credit_modal #paypal_area').hide();
        $('div#delayed_credit_modal #square_area').hide();
        $('div#delayed_credit_modal #warranty_area').show();
        $('div#delayed_credit_modal #home_area').hide();
        $('div#delayed_credit_modal #e_area').hide();
        $('div#delayed_credit_modal #other_credit_card').hide();
        $('div#delayed_credit_modal #other_payment_area').hide();
    } else if (this.value == 'Home Owner Financing') {
        // alert('Credit card');
        $('div#delayed_credit_modal #cash_area').hide();
        $('div#delayed_credit_modal #check_area').hide();
        $('div#delayed_credit_modal #credit_card').hide();
        $('div#delayed_credit_modal #debit_card').hide();
        $('div#delayed_credit_modal #invoicing').hide();
        $('div#delayed_credit_modal #ach_area').hide();
        $('div#delayed_credit_modal #venmo_area').hide();
        $('div#delayed_credit_modal #paypal_area').hide();
        $('div#delayed_credit_modal #square_area').hide();
        $('div#delayed_credit_modal #warranty_area').hide();
        $('div#delayed_credit_modal #home_area').show();
        $('div#delayed_credit_modal #e_area').hide();
        $('div#delayed_credit_modal #other_credit_card').hide();
        $('div#delayed_credit_modal #other_payment_area').hide();
    } else if (this.value == 'e-Transfer') {
        // alert('Credit card');
        $('div#delayed_credit_modal #cash_area').hide();
        $('div#delayed_credit_modal #check_area').hide();
        $('div#delayed_credit_modal #credit_card').hide();
        $('div#delayed_credit_modal #debit_card').hide();
        $('div#delayed_credit_modal #invoicing').hide();
        $('div#delayed_credit_modal #ach_area').hide();
        $('div#delayed_credit_modal #venmo_area').hide();
        $('div#delayed_credit_modal #paypal_area').hide();
        $('div#delayed_credit_modal #square_area').hide();
        $('div#delayed_credit_modal #warranty_area').hide();
        $('div#delayed_credit_modal #home_area').hide();
        $('div#delayed_credit_modal #e_area').show();
        $('div#delayed_credit_modal #other_credit_card').hide();
        $('div#delayed_credit_modal #other_payment_area').hide();
    } else if (this.value == 'Other Credit Card Professor') {
        // alert('Credit card');
        $('div#delayed_credit_modal #cash_area').hide();
        $('div#delayed_credit_modal #check_area').hide();
        $('div#delayed_credit_modal #credit_card').hide();
        $('div#delayed_credit_modal #debit_card').hide();
        $('div#delayed_credit_modal #invoicing').hide();
        $('div#delayed_credit_modal #ach_area').hide();
        $('div#delayed_credit_modal #venmo_area').hide();
        $('div#delayed_credit_modal #paypal_area').hide();
        $('div#delayed_credit_modal #square_area').hide();
        $('div#delayed_credit_modal #warranty_area').hide();
        $('div#delayed_credit_modal #home_area').hide();
        $('div#delayed_credit_modal #e_area').hide();
        $('div#delayed_credit_modal #other_credit_card').show();
        $('div#delayed_credit_modal #other_payment_area').hide();
    } else if (this.value == 'Other Payment Type') {
        // alert('Credit card');
        $('div#delayed_credit_modal #cash_area').hide();
        $('div#delayed_credit_modal #check_area').hide();
        $('div#delayed_credit_modal #credit_card').hide();
        $('div#delayed_credit_modal #debit_card').hide();
        $('div#delayed_credit_modal #invoicing').hide();
        $('div#delayed_credit_modal #ach_area').hide();
        $('div#delayed_credit_modal #venmo_area').hide();
        $('div#delayed_credit_modal #paypal_area').hide();
        $('div#delayed_credit_modal #square_area').hide();
        $('div#delayed_credit_modal #warranty_area').hide();
        $('div#delayed_credit_modal #home_area').hide();
        $('div#delayed_credit_modal #e_area').hide();
        $('div#delayed_credit_modal #other_credit_card').hide();
        $('div#delayed_credit_modal #other_payment_area').show();
    }
});

$(document).on("click", "#delayed_credit_modal .modal-footer-check .middle-links.end a", function(event) {
    event.preventDefault();
    $("#delayed_credit_modal .recurring-form-part").show();
    $("#delayed_credit_modal .modal-footer-check .middle-links").hide();
    $("#delayed_credit_modal .modal-footer-check #cancel_recurring").show();
    $("#delayed_credit_modal .modal-footer-check #closeCheckModal").hide();
    $("#delayed_credit_modal form input[name='recurring_selected']").val(1);
    $("#delayed_credit_modal .customer-info").addClass("recurring-customer-info");
    $("#delayed_credit_modal form input[name='recurring-template-name']").val($("#delayed_credit_modal form #sel-customer2 option:selected").attr("data-text"));
    $("#delayed_credit_modal #grand_total_sr_t").addClass("hidden");
    $("#delayed_credit_modal .label-grand_total_sr_t").addClass("hidden");
    $("#delayed_credit_modal .error-message-section").hide();
});
$(document).on("click", "#delayed_credit_modal .modal-footer-check #cancel_recurring", function(event) {
    event.preventDefault();
    $("#delayed_credit_modal .modal-footer-check #cancel_recurring").hide();
    $("#delayed_credit_modal .recurring-form-part").hide();
    $("#delayed_credit_modal .modal-footer-check .middle-links").show();
    $("#delayed_credit_modal .modal-footer-check #closeCheckModal").show();
    $("#delayed_credit_modal form input[name='recurring_selected']").val("");
    $("#delayed_credit_modal .customer-info").removeClass("recurring-customer-info");
    $("#delayed_credit_modal #grand_total_sr_t").removeClass("hidden");
    $("#delayed_credit_modal .label-grand_total_sr_t").removeClass("hidden");
});
$('#delayed_credit_modal').on('hidden.bs.modal', function() {
    $("#delayed_credit_modal .modal-footer-check #cancel_recurring").hide();
    $("#delayed_credit_modal .recurring-form-part").hide();
    $("#delayed_credit_modal .modal-footer-check .middle-links").show();
    $("#delayed_credit_modal .modal-footer-check #closeCheckModal").show();
    $("#delayed_credit_modal form input[name='recurring_selected']").val("");
    $("#delayed_credit_modal .customer-info").removeClass("recurring-customer-info");
    $('#delayed_credit_modal form').trigger("reset");
    $("#delayed_credit_modal #grand_total_sr_t").removeClass("hidden");
    $("#delayed_credit_modal .label-grand_total_sr_t").removeClass("hidden");
    delayed_credit_clear_all_lines();
});
$(document).on("click", "#delayed_credit_modal .modal-footer-check #clearsalereceipt", function(event) {
    event.preventDefault();
    var recurring_selected = $("#delayed_credit_modal form input[name='recurring_selected']").val();
    $('#delayed_credit_modal form').trigger("reset");
    $("#delayed_credit_modal form textarea").html("");
    $("#delayed_credit_modal form input[name='recurring_selected']").val(recurring_selected);
});
$(document).on("change", "#delayed_credit_modal select[name='recurring-interval']", function(event) {
    $("#delayed_credit_modal .recurring-form-part.below .interval-part .monthly").hide();
    $("#delayed_credit_modal .recurring-form-part.below .interval-part .daily").hide();
    $("#delayed_credit_modal .recurring-form-part.below .interval-part .weekly").hide();
    $("#delayed_credit_modal .recurring-form-part.below .interval-part .yearly").hide();
    if ($(this).val() == "Daily") {
        $("#delayed_credit_modal .recurring-form-part.below .interval-part .daily").show();
    } else if ($(this).val() == "Weekly") {
        $("#delayed_credit_modal .recurring-form-part.below .interval-part .weekly").show();
    } else if ($(this).val() == "Monthly") {
        $("#delayed_credit_modal .recurring-form-part.below .interval-part .monthly").show();
    } else if ($(this).val() == "Yearly") {
        $("#delayed_credit_modal .recurring-form-part.below .interval-part .yearly").show();
    }
});
$(document).on("change", "#delayed_credit_modal select[name='recurring-type']", function(event) {
    $("#delayed_credit_modal .recurring-form-part .schedule-type").hide();
    $("#delayed_credit_modal .recurring-form-part .reminder-type").hide();
    $("#delayed_credit_modal .recurring-form-part .unschedule-type").hide();
    if ($(this).val() == "Schedule") {
        $("#delayed_credit_modal .recurring-form-part .schedule-type").show();
        $("#delayed_credit_modal .recurring-form-part.below ").show();
    } else if ($(this).val() == "Reminder") {
        $("#delayed_credit_modal .recurring-form-part .reminder-type").show();
        $("#delayed_credit_modal .recurring-form-part.below ").show();
    } else if ($(this).val() == "Unschedule") {
        $("#delayed_credit_modal .recurring-form-part .unschedule-type").show();
        $("#delayed_credit_modal .recurring-form-part.below ").hide();
    }
});
$(document).on("change", "#delayed_credit_modal .recurring-form-part.below .date-part .input-field-2 select", function(event) {
    $("#delayed_credit_modal .recurring-form-part.below .date-part .input-field-3 .by-end-date").hide();
    $("#delayed_credit_modal .recurring-form-part.below .date-part .input-field-3 .after-occurrences").hide();
    if ($(this).val() == "By") {
        $("#delayed_credit_modal .recurring-form-part.below .date-part .input-field-3 .by-end-date").show();
    } else if ($(this).val() == "After") {
        $("#delayed_credit_modal .recurring-form-part.below .date-part .input-field-3 .after-occurrences").show();
    }
});
$(document).on("keyup", "#delayed_credit_modal .items-section table input[name='items[]']", function(event) {
    var iteam_search = $(this).val();
    var suggestions = $(this).parent("td").children(".suggestions");
    get_search_items(iteam_search, suggestions);
});

$(document).on("focus", "#delayed_credit_modal .items-section table input[name='items[]']", function(event) {
    var iteam_search = $(this).val();
    var suggestions = $(this).parent("td").children(".suggestions");
    $(this).attr("autocomplete", "off");
    get_search_items(iteam_search, suggestions);
});
$(document).on("click", "#delayed_credit_modal table .suggestions li", function(event) {
    $(this).parent("ul").parent("td").children("input[name='item_ids[]']").val($(this).attr('data-id'));
    $(this).parent("ul").parent("td").children("input[name='items[]']").val($(this).html());
    $(this).parent("ul").parent("td").parent("tr").find("input[name='quantity[]']").val(1);
    $(this).parent("ul").parent("td").parent("tr").find("input[name='price[]']").val($(this).attr('data-price'));
    $(this).parent("ul").parent("td").parent("tr").find("input[name='discount[]']").val($(this).attr('data-discount'));
    var tax_computed = $(this).attr('data-price') * 0.075;
    $(this).parent("ul").parent("td").parent("tr").find("input[name='tax[]']").val(Number(tax_computed).toLocaleString('en'));
    $(this).parent("ul").parent("td").parent("tr").find("input.tax-hide").val("7.5");
    var total = tax_computed + parseFloat($(this).attr('data-price'));
    $(this).parent("ul").parent("td").parent("tr").find(".total_per_item").html(Number(total).toLocaleString('en'));
    $(this).parent("ul").parent("td").parent("tr").find("input[name='total[]']").val(total);
    $("#delayed_credit_modal table .suggestions").html("");
    delayed_credit_compute_grand_total();
});

$(document).on("change", "#delayed_credit_modal table td input", function(event) {
    var qty = $(this).parent("td").parent("tr").find("input[name='quantity[]']").val();
    var price = $(this).parent("td").parent("tr").find("input[name='price[]']").val();
    var discount = $(this).parent("td").parent("tr").find("input[name='discount[]']").val();
    if ($(this).attr("data-type") == "tax") {
        $(this).parent("td").parent("tr").find("input.tax-hide").val($(this).val());
        var computed_tax = parseFloat(price) * parseFloat($(this).val());
        $(this).val(Number(computed_tax).toLocaleString('en'));
        console.log($(this).parent("td").parent("tr").find("input.tax-hide").val());
    }
    var tax = $(this).parent("td").parent("tr").find("input.tax-hide").val();
    var total = ((qty * price) + ((qty * price) * (tax / 100))) - discount;
    $(this).parent("td").parent("tr").find("input[name='tax[]']").val(Number((qty * price) * (tax / 100)).toLocaleString('en'));
    $(this).parent("td").parent("tr").find(".total_per_item").html(Number(total).toLocaleString('en'));
    $(this).parent("td").parent("tr").find("input[name='total[]']").val(total);
    delayed_credit_compute_grand_total();

});

function delayed_credit_compute_grand_total() {
    var qty_array = $("#delayed_credit_modal table tr td input[name='quantity[]']").map(function() { return $(this).val(); }).get();
    var price_array = $("#delayed_credit_modal table tr td input[name='price[]']").map(function() { return $(this).val(); }).get();
    var discount_array = $("#delayed_credit_modal table tr td input[name='discount[]']").map(function() { return $(this).val(); }).get();
    var tax_pecent_array = $("#delayed_credit_modal table tr td input[name='tax_percent[]']").map(function() { return $(this).val(); }).get();
    var grant_total = 0;
    for (var i = 0; i < qty_array.length; i++) {
        grant_total += ((qty_array[i] * price_array[i]) + ((qty_array[i] * price_array[i]) * (parseFloat(tax_pecent_array[i] / 100)))) - discount_array[i];
    }
    $("#delayed_credit_modal .item-totals .amount").html("$" + Number(grant_total).toLocaleString('en'));
    $("#delayed_credit_modal form input[name='grand_total_amount']").val(grant_total);
}
$(document).on("focus", "#delayed_credit_modal table tr td", function(event) {

    if (!$(this).is(':last-child')) {
        if ($(this).parent("tr").is(':last-child')) {
            $("#delayed_credit_modal table tbody").append("<tr>" + $(this).parent("tr").html() + "</tr>");
            $("#delayed_credit_modal table tbody tr:last-child").find(".total_per_item").html("0.00");
        }
    }
});

$(document).on("click", "#delayed_credit_modal table tr td a.delete-item", function(event) {
    if ($("#delayed_credit_modal table tbody tr").length > 1) {
        $(this).parent("td").parent("tr").remove();
        delayed_credit_compute_grand_total();
    }

});
$(document).on("click", ".create-charge-btn", function(event) {
    $("#delayed_credit_modal form select[name='customer_id']").val($(this).attr("data-customer-id"));

});

$(document).on("click", "#delayed_credit_modal .item-buttons .add-lines", function(event) {
    $("#delayed_credit_modal table tbody").append("<tr>" + $("#delayed_credit_modal table tbody tr:last-child").html() + "</tr>");
    $("#delayed_credit_modal table tbody tr:last-child").find(".total_per_item").html("0.00");
    $("#delayed_credit_modal table tbody").append("<tr>" + $("#delayed_credit_modal table tbody tr:last-child").html() + "</tr>");
    $("#delayed_credit_modal table tbody tr:last-child").find(".total_per_item").html("0.00");
    $("#delayed_credit_modal table tbody").append("<tr>" + $("#delayed_credit_modal table tbody tr:last-child").html() + "</tr>");
    $("#delayed_credit_modal table tbody tr:last-child").find(".total_per_item").html("0.00");
    $("#delayed_credit_modal table tbody").append("<tr>" + $("#delayed_credit_modal table tbody tr:last-child").html() + "</tr>");
    $("#delayed_credit_modal table tbody tr:last-child").find(".total_per_item").html("0.00");
});

function delayed_credit_clear_all_lines() {
    var new_tr = "<tr>" + $("#delayed_credit_modal table tbody tr:last-child").html() + "</tr>";
    $("#delayed_credit_modal table tbody").html(new_tr);
    $("#delayed_credit_modal table tbody tr:last-child").find(".total_per_item").html("0.00");
    delayed_credit_compute_grand_total();
}
$(document).on("click", "#delayed_credit_modal .item-buttons .clear-all-lines", function(event) {
    delayed_credit_clear_all_lines();
});
$("#delayed_credit_modal form").submit(function(event) {
    event.preventDefault();
});
$(document).on("click", "#delayed_credit_modal form button[data-action='save']", function(event) {
    var submit_type = $(this).attr('data-submit-type');
    $("#delayed_credit_modal form input[name='submit_option']").val(submit_type);
    var customer_id = $("#delayed_credit_modal form select[name='customer_id']").val();
    var empty_flds = 0;
    $("#delayed_credit_modal form  .required").each(function() {
        if (!$.trim($(this).val())) {
            empty_flds++;
        }
    });
    if (empty_flds == 0) {
        event.preventDefault();
        Swal.fire({
            title: "Save this Delayed Credit?",
            html: "Are you sure you want to save this?",
            showCancelButton: true,
            imageUrl: baseURL + "/assets/img/accounting/customers/folder.png",
            cancelButtonColor: "#d33",
            confirmButtonColor: "#2ca01c",
            confirmButtonText: $(this).html(),
        }).then((result) => {
            if (result.value) {
                $("#loader-modal").show();
                $.ajax({
                    url: baseURL + "/accounting/addDelayedCredit",
                    type: "POST",
                    dataType: "json",
                    data: $("#delayed_credit_modal form").serialize(),
                    success: function(data) {
                        if (data.count_save > 0) {
                            $("#delayed_credit_modal form input[name='delayed_credit_id']").val(data.delayed_credit_id);
                            get_load_customers_table();
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: "Success",
                                html: "Delayed charge has been saved.",
                                icon: "success",
                            });

                            if (submit_type == "save-new") {
                                $('#delayed_credit_modal form').trigger("reset");
                                $("#delayed_credit_modal form select[name='customer_id']").val(customer_id);
                            } else if (submit_type == "save-close") {
                                $("#delayed_credit_modal").modal('hide');
                            }
                            if (submit_type != "save") {
                                delayed_credit_clear_all_lines();
                                delayed_credit_compute_grand_total();
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
                    },
                });
            }
        });

    }
});
$(document).on("click", "#delayed_credit_modal form .attachement-file-section button.attachment-btn", function(event) {
    // $(this).preventDefault();
    $("#delayed_credit_modal form input[name='attachment-file']").trigger('click');
});
$(document).on("change", "#delayed_credit_modal form input[name='attachment-file']", function(event) {
    upload_attachment("#delayed_credit_modal form");
});