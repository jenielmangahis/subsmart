$(document).on("click", ".first-option.customer_craete_invoice_btn", function(event) {
    event.preventDefault();
    $('#create_invoice_modal').modal('toggle');
});
$(document).on("click", "#create_invoice_modal .item-buttons .add-lines", function(event) {
    $("#create_invoice_modal table tbody").append("<tr>" + $("#create_invoice_modal table tbody tr:last-child").html() + "</tr>");
    $("#create_invoice_modal table tbody tr:last-child").find(".total_per_item").html("0.00");
    $("#create_invoice_modal table tbody").append("<tr>" + $("#create_invoice_modal table tbody tr:last-child").html() + "</tr>");
    $("#create_invoice_modal table tbody tr:last-child").find(".total_per_item").html("0.00");
    $("#create_invoice_modal table tbody").append("<tr>" + $("#create_invoice_modal table tbody tr:last-child").html() + "</tr>");
    $("#create_invoice_modal table tbody tr:last-child").find(".total_per_item").html("0.00");
    $("#create_invoice_modal table tbody").append("<tr>" + $("#create_invoice_modal table tbody tr:last-child").html() + "</tr>");
    $("#create_invoice_modal table tbody tr:last-child").find(".total_per_item").html("0.00");
});

function clear_all_lines() {
    var new_tr = "<tr>" + $("#create_invoice_modal table tbody tr:last-child").html() + "</tr>";
    $("#create_invoice_modal table tbody").html(new_tr);
    $("#create_invoice_modal table tbody tr:last-child").find(".total_per_item").html("0.00");
    compute_grand_total();
}
$(document).on("click", "#create_invoice_modal .item-buttons .clear-all-lines", function(event) {
    clear_all_lines();
});


$(document).on("keyup", "#create_invoice_modal .items-section table input[name='items[]']", function(event) {
    var iteam_search = $(this).val();
    var suggestions = $(this).parent("td").children(".suggestions");
    get_search_items(iteam_search, suggestions);
});

$(document).on("focus", "#create_invoice_modal .items-section table input[name='items[]']", function(event) {
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
$(document).on("click", "#create_invoice_modal table .suggestions li", function(event) {
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
    $("#create_invoice_modal table .suggestions").html("");
    compute_grand_total();
});

$(document).on("change", "#create_invoice_modal table td input", function(event) {
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
    compute_grand_total();

});

$(document).on("change", "#create_invoice_modal form .item-totals input[name='adjustment_value']", function(event) {
    if ($(this).val() == "") {
        $(this).val("0.00");
    } else {
        $(this).val(parseFloat($(this).val().replace(/,/g, '')));
        $(this).val(Number($(this).val()).toLocaleString('en'));
    }
    compute_grand_total();
});

function compute_grand_total() {
    var qty_array = $("#create_invoice_modal table tr td input[name='quantity[]']").map(function() { return $(this).val(); }).get();
    var price_array = $("#create_invoice_modal table tr td input[name='price[]']").map(function() { return $(this).val(); }).get();
    var discount_array = $("#create_invoice_modal table tr td input[name='discount[]']").map(function() { return $(this).val(); }).get();
    var tax_pecent_array = $("#create_invoice_modal table tr td input[name='tax_percent[]']").map(function() { return $(this).val(); }).get();
    var grand_total = 0;
    var total_taxes = 0;
    var subtotal = 0;
    for (var i = 0; i < qty_array.length; i++) {
        grand_total += ((qty_array[i] * price_array[i]) + ((qty_array[i] * price_array[i]) * (parseFloat(tax_pecent_array[i] / 100)))) - discount_array[i];
        total_taxes += ((qty_array[i] * price_array[i]) * (parseFloat(tax_pecent_array[i] / 100)));
        subtotal += (qty_array[i] * price_array[i]);
    }

    grand_total -= parseFloat($("#create_invoice_modal form .item-totals input[name='adjustment_value']").val().replace(/,/g, ''));
    $("#create_invoice_modal .item-totals .amount .subtotal").html("$" + Number(subtotal).toLocaleString('en'));
    $("#create_invoice_modal .item-totals .amount .taxes").html("$" + Number(total_taxes).toLocaleString('en'));
    $("#create_invoice_modal .item-totals .amount .grand-total").html("$" + Number(grand_total).toLocaleString('en'));
    $("#create_invoice_modal form input[name='grand_total_amount']").val(grand_total);
}
$(document).on("focus", "#create_invoice_modal table tr td", function(event) {

    if (!$(this).is(':last-child')) {
        if ($(this).parent("tr").is(':last-child')) {
            $("#create_invoice_modal table tbody").append("<tr>" + $(this).parent("tr").html() + "</tr>");
            $("#create_invoice_modal table tbody tr:last-child").find(".total_per_item").html("0.00");
        }
    }
});

$(document).on("click", "#create_invoice_modal table tr td a.delete-item", function(event) {
    if ($("#create_invoice_modal table tbody tr").length > 1) {
        $(this).parent("td").parent("tr").remove();
        compute_grand_total();
    }

});