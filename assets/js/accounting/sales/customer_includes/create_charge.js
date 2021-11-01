$(document).on("click", "div#create_charge_modal", function(event) {
    if ($(event.target).closest("div#create_charge_modal table ul.suggestions").length === 0 && $(event.target).closest("#create_charge_modal .items-section table input[name='items[]']").length == 0) {
        $("div#create_charge_modal table ul.suggestions").html("");
    }

});
$(document).on("change", "div#create_charge_modal form select[name='payment_method']", function(event) {
    if (this.value == 'Cash') {
        // alert('cash');
        // $('#exampleModal').modal('toggle');
        $('div#create_charge_modal #cash_area').show();
        $('div#create_charge_modal #check_area').hide();
        $('div#create_charge_modal #credit_card').hide();
        $('div#create_charge_modal #debit_card').hide();
        $('div#create_charge_modal #ach_area').hide();
        $('div#create_charge_modal #venmo_area').hide();
        $('div#create_charge_modal #paypal_area').hide();
        $('div#create_charge_modal #invoicing').hide();
        $('div#create_charge_modal #square_area').hide();
        $('div#create_charge_modal #warranty_area').hide();
        $('div#create_charge_modal #home_area').hide();
        $('div#create_charge_modal #e_area').hide();
        $('div#create_charge_modal #other_credit_card').hide();
        $('div#create_charge_modal #other_payment_area').hide();
    } else if (this.value == 'Invoicing') {
        $('div#create_charge_modal #cash_area').hide();
        $('div#create_charge_modal #check_area').hide();
        $('div#create_charge_modal #invoicing').show();
        $('div#create_charge_modal #credit_card').hide();
        $('div#create_charge_modal #debit_card').hide();
        $('div#create_charge_modal #ach_area').hide();
        $('div#create_charge_modal #venmo_area').hide();
        $('div#create_charge_modal #paypal_area').hide();
        $('div#create_charge_modal #square_area').hide();
        $('div#create_charge_modal #warranty_area').hide();
        $('div#create_charge_modal #home_area').hide();
        $('div#create_charge_modal #e_area').hide();
        $('div#create_charge_modal #other_credit_card').hide();
        $('div#create_charge_modal #other_payment_area').hide();
    } else if (this.value == 'Check') {
        // alert('Check');
        $('div#create_charge_modal #cash_area').hide();
        $('div#create_charge_modal #check_area').show();
        $('div#create_charge_modal #credit_card').hide();
        $('div#create_charge_modal #debit_card').hide();
        $('div#create_charge_modal #invoicing').hide();
        $('div#create_charge_modal #ach_area').hide();
        $('div#create_charge_modal #venmo_area').hide();
        $('div#create_charge_modal #paypal_area').hide();
        $('div#create_charge_modal #square_area').hide();
        $('div#create_charge_modal #warranty_area').hide();
        $('div#create_charge_modal #home_area').hide();
        $('div#create_charge_modal #e_area').hide();
        $('div#create_charge_modal #other_credit_card').hide();
        $('div#create_charge_modal #other_payment_area').hide();
    } else if (this.value == 'Credit Card') {
        // alert('Credit card');
        $('div#create_charge_modal #cash_area').hide();
        $('div#create_charge_modal #check_area').hide();
        $('div#create_charge_modal #credit_card').show();
        $('div#create_charge_modal #debit_card').hide();
        $('div#create_charge_modal #invoicing').hide();
        $('div#create_charge_modal #ach_area').hide();
        $('div#create_charge_modal #venmo_area').hide();
        $('div#create_charge_modal #paypal_area').hide();
        $('div#create_charge_modal #square_area').hide();
        $('div#create_charge_modal #warranty_area').hide();
        $('div#create_charge_modal #home_area').hide();
        $('div#create_charge_modal #e_area').hide();
        $('div#create_charge_modal #other_credit_card').hide();
        $('div#create_charge_modal #other_payment_area').hide();
    } else if (this.value == 'Debit Card') {
        // alert('Credit card');
        $('div#create_charge_modal #cash_area').hide();
        $('div#create_charge_modal #check_area').hide();
        $('div#create_charge_modal #credit_card').hide();
        $('div#create_charge_modal #debit_card').show();
        $('div#create_charge_modal #ach_area').hide();
        $('div#create_charge_modal #venmo_area').hide();
        $('div#create_charge_modal #invoicing').hide();
        $('div#create_charge_modal #paypal_area').hide();
        $('div#create_charge_modal #square_area').hide();
        $('div#create_charge_modal #warranty_area').hide();
        $('div#create_charge_modal #home_area').hide();
        $('div#create_charge_modal #e_area').hide();
        $('div#create_charge_modal #other_credit_card').hide();
        $('div#create_charge_modal #other_payment_area').hide();
    } else if (this.value == 'ACH') {
        // alert('Credit card');
        $('div#create_charge_modal #cash_area').hide();
        $('div#create_charge_modal #check_area').hide();
        $('div#create_charge_modal #credit_card').hide();
        $('div#create_charge_modal #debit_card').hide();
        $('div#create_charge_modal #invoicing').hide();
        $('div#create_charge_modal #ach_area').show();
        $('div#create_charge_modal #venmo_area').hide();
        $('div#create_charge_modal #paypal_area').hide();
        $('div#create_charge_modal #square_area').hide();
        $('div#create_charge_modal #warranty_area').hide();
        $('div#create_charge_modal #home_area').hide();
        $('div#create_charge_modal #e_area').hide();
        $('div#create_charge_modal #other_credit_card').hide();
        $('div#create_charge_modal #other_payment_area').hide();
    } else if (this.value == 'Venmo') {
        // alert('Credit card');
        $('div#create_charge_modal #cash_area').hide();
        $('div#create_charge_modal #check_area').hide();
        $('div#create_charge_modal #credit_card').hide();
        $('div#create_charge_modal #debit_card').hide();
        $('div#create_charge_modal #ach_area').hide();
        $('div#create_charge_modal #invoicing').hide();
        $('div#create_charge_modal #venmo_area').show();
        $('div#create_charge_modal #paypal_area').hide();
        $('div#create_charge_modal #square_area').hide();
        $('div#create_charge_modal #warranty_area').hide();
        $('div#create_charge_modal #home_area').hide();
        $('div#create_charge_modal #e_area').hide();
        $('div#create_charge_modal #other_credit_card').hide();
        $('div#create_charge_modal #other_payment_area').hide();
    } else if (this.value == 'Paypal') {
        // alert('Credit card');
        $('div#create_charge_modal #cash_area').hide();
        $('div#create_charge_modal #check_area').hide();
        $('div#create_charge_modal #credit_card').hide();
        $('div#create_charge_modal #debit_card').hide();
        $('div#create_charge_modal #invoicing').hide();
        $('div#create_charge_modal #ach_area').hide();
        $('div#create_charge_modal #venmo_area').hide();
        $('div#create_charge_modal #paypal_area').show();
        $('div#create_charge_modal #square_area').hide();
        $('div#create_charge_modal #warranty_area').hide();
        $('div#create_charge_modal #home_area').hide();
        $('div#create_charge_modal #e_area').hide();
        $('div#create_charge_modal #other_credit_card').hide();
        $('div#create_charge_modal #other_payment_area').hide();
    } else if (this.value == 'Square') {
        // alert('Credit card');
        $('div#create_charge_modal #cash_area').hide();
        $('div#create_charge_modal #check_area').hide();
        $('div#create_charge_modal #credit_card').hide();
        $('div#create_charge_modal #invoicing').hide();
        $('div#create_charge_modal #debit_card').hide();
        $('div#create_charge_modal #ach_area').hide();
        $('div#create_charge_modal #venmo_area').hide();
        $('div#create_charge_modal #paypal_area').hide();
        $('div#create_charge_modal #square_area').show();
        $('div#create_charge_modal #warranty_area').hide();
        $('div#create_charge_modal #home_area').hide();
        $('div#create_charge_modal #e_area').hide();
        $('div#create_charge_modal #other_credit_card').hide();
        $('div#create_charge_modal #other_payment_area').hide();
    } else if (this.value == 'Warranty Work') {
        // alert('Credit card');
        $('div#create_charge_modal #cash_area').hide();
        $('div#create_charge_modal #check_area').hide();
        $('div#create_charge_modal #credit_card').hide();
        $('div#create_charge_modal #invoicing').hide();
        $('div#create_charge_modal #debit_card').hide();
        $('div#create_charge_modal #ach_area').hide();
        $('div#create_charge_modal #venmo_area').hide();
        $('div#create_charge_modal #paypal_area').hide();
        $('div#create_charge_modal #square_area').hide();
        $('div#create_charge_modal #warranty_area').show();
        $('div#create_charge_modal #home_area').hide();
        $('div#create_charge_modal #e_area').hide();
        $('div#create_charge_modal #other_credit_card').hide();
        $('div#create_charge_modal #other_payment_area').hide();
    } else if (this.value == 'Home Owner Financing') {
        // alert('Credit card');
        $('div#create_charge_modal #cash_area').hide();
        $('div#create_charge_modal #check_area').hide();
        $('div#create_charge_modal #credit_card').hide();
        $('div#create_charge_modal #debit_card').hide();
        $('div#create_charge_modal #invoicing').hide();
        $('div#create_charge_modal #ach_area').hide();
        $('div#create_charge_modal #venmo_area').hide();
        $('div#create_charge_modal #paypal_area').hide();
        $('div#create_charge_modal #square_area').hide();
        $('div#create_charge_modal #warranty_area').hide();
        $('div#create_charge_modal #home_area').show();
        $('div#create_charge_modal #e_area').hide();
        $('div#create_charge_modal #other_credit_card').hide();
        $('div#create_charge_modal #other_payment_area').hide();
    } else if (this.value == 'e-Transfer') {
        // alert('Credit card');
        $('div#create_charge_modal #cash_area').hide();
        $('div#create_charge_modal #check_area').hide();
        $('div#create_charge_modal #credit_card').hide();
        $('div#create_charge_modal #debit_card').hide();
        $('div#create_charge_modal #invoicing').hide();
        $('div#create_charge_modal #ach_area').hide();
        $('div#create_charge_modal #venmo_area').hide();
        $('div#create_charge_modal #paypal_area').hide();
        $('div#create_charge_modal #square_area').hide();
        $('div#create_charge_modal #warranty_area').hide();
        $('div#create_charge_modal #home_area').hide();
        $('div#create_charge_modal #e_area').show();
        $('div#create_charge_modal #other_credit_card').hide();
        $('div#create_charge_modal #other_payment_area').hide();
    } else if (this.value == 'Other Credit Card Professor') {
        // alert('Credit card');
        $('div#create_charge_modal #cash_area').hide();
        $('div#create_charge_modal #check_area').hide();
        $('div#create_charge_modal #credit_card').hide();
        $('div#create_charge_modal #debit_card').hide();
        $('div#create_charge_modal #invoicing').hide();
        $('div#create_charge_modal #ach_area').hide();
        $('div#create_charge_modal #venmo_area').hide();
        $('div#create_charge_modal #paypal_area').hide();
        $('div#create_charge_modal #square_area').hide();
        $('div#create_charge_modal #warranty_area').hide();
        $('div#create_charge_modal #home_area').hide();
        $('div#create_charge_modal #e_area').hide();
        $('div#create_charge_modal #other_credit_card').show();
        $('div#create_charge_modal #other_payment_area').hide();
    } else if (this.value == 'Other Payment Type') {
        // alert('Credit card');
        $('div#create_charge_modal #cash_area').hide();
        $('div#create_charge_modal #check_area').hide();
        $('div#create_charge_modal #credit_card').hide();
        $('div#create_charge_modal #debit_card').hide();
        $('div#create_charge_modal #invoicing').hide();
        $('div#create_charge_modal #ach_area').hide();
        $('div#create_charge_modal #venmo_area').hide();
        $('div#create_charge_modal #paypal_area').hide();
        $('div#create_charge_modal #square_area').hide();
        $('div#create_charge_modal #warranty_area').hide();
        $('div#create_charge_modal #home_area').hide();
        $('div#create_charge_modal #e_area').hide();
        $('div#create_charge_modal #other_credit_card').hide();
        $('div#create_charge_modal #other_payment_area').show();
    }
});

$(document).on("click", "#create_charge_modal .modal-footer-check .middle-links.end a", function(event) {
    event.preventDefault();
    $("#create_charge_modal .recurring-form-part").show();
    $("#create_charge_modal .modal-footer-check .middle-links").hide();
    $("#create_charge_modal .modal-footer-check #cancel_recurring").show();
    $("#create_charge_modal .modal-footer-check #closeCheckModal").hide();
    $("#create_charge_modal form input[name='recurring_selected']").val(1);
    $("#create_charge_modal .customer-info").addClass("recurring-customer-info");
    $("#create_charge_modal form input[name='recurring-template-name']").val($("#create_charge_modal form #sel-customer2 option:selected").attr("data-text"));
    $("#create_charge_modal #grand_total_sr_t").addClass("hidden");
    $("#create_charge_modal .label-grand_total_sr_t").addClass("hidden");
    $("#create_charge_modal .error-message-section").hide();
});
$(document).on("click", "#create_charge_modal .modal-footer-check #cancel_recurring", function(event) {
    event.preventDefault();
    $("#create_charge_modal .modal-footer-check #cancel_recurring").hide();
    $("#create_charge_modal .recurring-form-part").hide();
    $("#create_charge_modal .modal-footer-check .middle-links").show();
    $("#create_charge_modal .modal-footer-check #closeCheckModal").show();
    $("#create_charge_modal form input[name='recurring_selected']").val("");
    $("#create_charge_modal .customer-info").removeClass("recurring-customer-info");
    $("#create_charge_modal #grand_total_sr_t").removeClass("hidden");
    $("#create_charge_modal .label-grand_total_sr_t").removeClass("hidden");
});
$('#create_charge_modal').on('hidden.bs.modal', function() {
    $("#create_charge_modal .modal-footer-check #cancel_recurring").hide();
    $("#create_charge_modal .recurring-form-part").hide();
    $("#create_charge_modal .modal-footer-check .middle-links").show();
    $("#create_charge_modal .modal-footer-check #closeCheckModal").show();
    $("#create_charge_modal form input[name='recurring_selected']").val("");
    $("#create_charge_modal .customer-info").removeClass("recurring-customer-info");
    $('#create_charge_modal form').trigger("reset");
    $("#create_charge_modal #grand_total_sr_t").removeClass("hidden");
    $("#create_charge_modal .label-grand_total_sr_t").removeClass("hidden");
    clear_all_lines();
});
$(document).on("click", "#create_charge_modal .modal-footer-check #clearsalereceipt", function(event) {
    event.preventDefault();
    var recurring_selected = $("#create_charge_modal form input[name='recurring_selected']").val();
    $('#create_charge_modal form').trigger("reset");
    $("#create_charge_modal form textarea").html("");
    $("#create_charge_modal form input[name='recurring_selected']").val(recurring_selected);
});
$(document).on("change", "#create_charge_modal select[name='recurring-interval']", function(event) {
    $("#create_charge_modal .recurring-form-part.below .interval-part .monthly").hide();
    $("#create_charge_modal .recurring-form-part.below .interval-part .daily").hide();
    $("#create_charge_modal .recurring-form-part.below .interval-part .weekly").hide();
    $("#create_charge_modal .recurring-form-part.below .interval-part .yearly").hide();
    if ($(this).val() == "Daily") {
        $("#create_charge_modal .recurring-form-part.below .interval-part .daily").show();
    } else if ($(this).val() == "Weekly") {
        $("#create_charge_modal .recurring-form-part.below .interval-part .weekly").show();
    } else if ($(this).val() == "Monthly") {
        $("#create_charge_modal .recurring-form-part.below .interval-part .monthly").show();
    } else if ($(this).val() == "Yearly") {
        $("#create_charge_modal .recurring-form-part.below .interval-part .yearly").show();
    }
});
$(document).on("change", "#create_charge_modal select[name='recurring-type']", function(event) {
    $("#create_charge_modal .recurring-form-part .schedule-type").hide();
    $("#create_charge_modal .recurring-form-part .reminder-type").hide();
    $("#create_charge_modal .recurring-form-part .unschedule-type").hide();
    if ($(this).val() == "Schedule") {
        $("#create_charge_modal .recurring-form-part .schedule-type").show();
        $("#create_charge_modal .recurring-form-part.below ").show();
    } else if ($(this).val() == "Reminder") {
        $("#create_charge_modal .recurring-form-part .reminder-type").show();
        $("#create_charge_modal .recurring-form-part.below ").show();
    } else if ($(this).val() == "Unschedule") {
        $("#create_charge_modal .recurring-form-part .unschedule-type").show();
        $("#create_charge_modal .recurring-form-part.below ").hide();
    }
});
$(document).on("change", "#create_charge_modal .recurring-form-part.below .date-part .input-field-2 select", function(event) {
    $("#create_charge_modal .recurring-form-part.below .date-part .input-field-3 .by-end-date").hide();
    $("#create_charge_modal .recurring-form-part.below .date-part .input-field-3 .after-occurrences").hide();
    if ($(this).val() == "By") {
        $("#create_charge_modal .recurring-form-part.below .date-part .input-field-3 .by-end-date").show();
    } else if ($(this).val() == "After") {
        $("#create_charge_modal .recurring-form-part.below .date-part .input-field-3 .after-occurrences").show();
    }
});
$(document).on("keyup", "#create_charge_modal .items-section table input[name='items[]']", function(event) {
    var iteam_search = $(this).val();
    var suggestions = $(this).parent("td").children(".suggestions");
    get_search_items(iteam_search, suggestions);
});

$(document).on("focus", "#create_charge_modal .items-section table input[name='items[]']", function(event) {
    var iteam_search = $(this).val();
    var suggestions = $(this).parent("td").children(".suggestions");
    $(this).attr("autocomplete", "off");
    get_search_items(iteam_search, suggestions);
});

function get_search_items(iteam_search, suggestions) {
    $.ajax({
        url: baseURL + "/accounting/get_search_items",
        type: "POST",
        dataType: "json",
        data: {
            iteam_search: iteam_search,
        },
        success: function(data) {
            suggestions.html(data.html);
        },
    });
}
$(document).on("click", "#create_charge_modal table .suggestions li", function(event) {
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
    $("#create_charge_modal table .suggestions").html("");
    compute_grand_total();
});

$(document).on("change", "#create_charge_modal table td input", function(event) {
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
    compute_grand_total();

});

function compute_grand_total() {
    var qty_array = $("#create_charge_modal table tr td input[name='quantity[]']").map(function() { return $(this).val(); }).get();
    var price_array = $("#create_charge_modal table tr td input[name='price[]']").map(function() { return $(this).val(); }).get();
    var discount_array = $("#create_charge_modal table tr td input[name='discount[]']").map(function() { return $(this).val(); }).get();
    var tax_pecent_array = $("#create_charge_modal table tr td input[name='tax_percent[]']").map(function() { return $(this).val(); }).get();
    var grant_total = 0;
    for (var i = 0; i < qty_array.length; i++) {
        grant_total += ((qty_array[i] * price_array[i]) + ((qty_array[i] * price_array[i]) * (parseFloat(tax_pecent_array[i] / 100)))) - discount_array[i];
    }
    $("#create_charge_modal .item-totals .amount").html("$" + Number(grant_total).toLocaleString('en'));
    $("#create_charge_modal form input[name='grand_total_amount']").val(grant_total);
}
$(document).on("focus", "#create_charge_modal table tr td", function(event) {

    if (!$(this).is(':last-child')) {
        if ($(this).parent("tr").is(':last-child')) {
            $("#create_charge_modal table tbody").append("<tr>" + $(this).parent("tr").html() + "</tr>");
            $("#create_charge_modal table tbody tr:last-child").find(".total_per_item").html("0.00");
        }
    }
});

$(document).on("click", "#create_charge_modal table tr td a.delete-item", function(event) {
    if ($("#create_charge_modal table tbody tr").length > 1) {
        $(this).parent("td").parent("tr").remove();
        compute_grand_total();
    }

});
$(document).on("click", ".create-charge-btn", function(event) {
    $("#create_charge_modal form select[name='customer_id']").val($(this).attr("data-customer-id"));

});

$(document).on("click", "#create_charge_modal .item-buttons .add-lines", function(event) {
    $("#create_charge_modal table tbody").append("<tr>" + $("#create_charge_modal table tbody tr:last-child").html() + "</tr>");
    $("#create_charge_modal table tbody tr:last-child").find(".total_per_item").html("0.00");
    $("#create_charge_modal table tbody").append("<tr>" + $("#create_charge_modal table tbody tr:last-child").html() + "</tr>");
    $("#create_charge_modal table tbody tr:last-child").find(".total_per_item").html("0.00");
    $("#create_charge_modal table tbody").append("<tr>" + $("#create_charge_modal table tbody tr:last-child").html() + "</tr>");
    $("#create_charge_modal table tbody tr:last-child").find(".total_per_item").html("0.00");
    $("#create_charge_modal table tbody").append("<tr>" + $("#create_charge_modal table tbody tr:last-child").html() + "</tr>");
    $("#create_charge_modal table tbody tr:last-child").find(".total_per_item").html("0.00");
});

function clear_all_lines() {
    var new_tr = "<tr>" + $("#create_charge_modal table tbody tr:last-child").html() + "</tr>";
    $("#create_charge_modal table tbody").html(new_tr);
    $("#create_charge_modal table tbody tr:last-child").find(".total_per_item").html("0.00");
    compute_grand_total();
}
$(document).on("click", "#create_charge_modal .item-buttons .clear-all-lines", function(event) {
    clear_all_lines();
});
$("#create_charge_modal form").submit(function(event) {
    event.preventDefault();
});
$(document).on("click", "#create_charge_modal form button[data-action='save']", function(event) {
    var submit_type = $(this).attr('data-submit-type');
    $("#create_charge_modal form input[name='submit_option']").val(submit_type);
    var customer_id = $("#create_charge_modal form select[name='customer_id']").val();
    var empty_flds = 0;
    $("#create_charge_modal form  .required").each(function() {
        if (!$.trim($(this).val())) {
            empty_flds++;
        }
    });
    if (empty_flds == 0) {
        event.preventDefault();
        Swal.fire({
            title: "Save this Delayed Charge?",
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
                    url: baseURL + "/accounting/addDelayedCharge",
                    type: "POST",
                    dataType: "json",
                    data: $("#create_charge_modal form").serialize(),
                    success: function(data) {
                        if (data.count_save > 0) {
                            $("#create_charge_modal form input[name='delayed_charge_id']").val(data.delayed_charge_id);
                            get_load_customers_table();
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: "Success",
                                html: "Delayed charge has been saved.",
                                icon: "success",
                            });

                            if (submit_type == "save-new") {
                                $('#create_charge_modal form').trigger("reset");
                                $("#create_charge_modal form select[name='customer_id']").val(customer_id);
                            } else if (submit_type == "save-close") {
                                $("#create_charge_modal").modal('hide');
                            }
                            if (submit_type != "save") {
                                clear_all_lines();
                                compute_grand_total();
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
$(document).on("click", "#create_charge_modal form .attachement-file-section button.attachment-btn", function(event) {
    // $(this).preventDefault();
    $("#create_charge_modal form input[name='attachment-file']").trigger('click');
});
$(document).on("change", "#create_charge_modal form input[name='attachment-file']", function(event) {
    upload_attachment("#create_charge_modal form");
});