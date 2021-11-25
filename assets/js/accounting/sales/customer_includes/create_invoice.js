$(document).on("click", ".customer_craete_invoice_btn", function(event) {
    // event.preventDefault();
    reset_create_invoice_modal_form();
    // $('#create_invoice_modal').modal('toggle');
    $("#create_invoice_modal form select[name='customer_id']").val($(this).attr("data-customer-id"));
    create_invoice_modal_customer_changed($(this).attr("data-customer-id"));
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

$(document).on("click", "#create_invoice_modal table tr td a.delete-item", function(event) {
    if ($("#create_invoice_modal table tbody tr").length > 1) {
        $(this).parent("td").parent("tr").remove();
        create_invoice_modal_compute_grand_total();
    }
});

$(document).on("keyup", "#create_invoice_modal .items-section table input[name='items[]']", function(event) {
    var iteam_search = $(this).val();
    var suggestions = $(this).parent("td").children(".suggestions");
    create_invoice_modal_get_search_items(iteam_search, suggestions);
});

$(document).on("focus", "#create_invoice_modal .items-section table input[name='items[]']", function(event) {
    var iteam_search = $(this).val();
    var suggestions = $(this).parent("td").children(".suggestions");
    $(this).attr("autocomplete", "off");
    create_invoice_modal_get_search_items(iteam_search, suggestions);
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
    create_invoice_modal_compute_grand_total();

});


$(document).on("change", "#create_invoice_modal form select[name='customer_id']", function(event) {
    create_invoice_modal_customer_changed($(this).val());
});



function create_invoice_modal_compute_grand_total() {
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
    $("#create_invoice_modal form input[name='grand_total']").val(grand_total);
    $("#create_invoice_modal form input[name='subtotal']").val(subtotal);
    $("#create_invoice_modal form input[name='taxes']").val(total_taxes);
}
$(document).on("click", "#create_invoice_modal table .suggestions li", function(event) {
    $(this).parent("ul").parent("td").children("input[name='itemid[]']").val($(this).attr('data-id'));
    $(this).parent("ul").parent("td").children("input[name='items[]']").val($(this).html());
    $(this).parent("ul").parent("td").parent("tr").find("input[name='quantity[]']").val(1);
    $(this).parent("ul").parent("td").parent("tr").find("input[name='price[]']").val($(this).attr('data-price'));
    $(this).parent("ul").parent("td").parent("tr").find("input[name='discount[]']").val($(this).attr('data-discount'));
    var tax_computed = $(this).attr('data-price') * 0.075;
    $(this).parent("ul").parent("td").parent("tr").find("input[name='tax[]']").val(Number(tax_computed).toLocaleString('en'));
    $(this).parent("ul").parent("td").parent("tr").find("input.tax-hide").val("7.5");
    var total = tax_computed + parseFloat($(this).attr('data-price'));
    $(this).parent("ul").parent("td").parent("tr").find("input[name='total[]']").val(total);
    $(this).parent("ul").parent("td").parent("tr").find(".total_per_item").html(Number(total).toLocaleString('en'));
    $("#create_invoice_modal table .suggestions").html("");
    create_invoice_modal_compute_grand_total();
});
$(document).on("focus", "#create_invoice_modal table tr td", function(event) {

    if (!$(this).is(':last-child')) {
        if ($(this).parent("tr").is(':last-child')) {
            $("#create_invoice_modal table tbody").append("<tr>" + $(this).parent("tr").html() + "</tr>");
            $("#create_invoice_modal table tbody tr:last-child").find(".total_per_item").html("0.00");
        }
    }
});


function create_invoice_modal_get_search_items(iteam_search, suggestions) {
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

function create_invoice_modal_customer_changed(id) {
    if (id == "") {
        $("#create_invoice_modal form input[name='invoice_job_location']").val('');
        $("#create_invoice_modal form input[name='customer_email']").val('');
        $("#create_invoice_modal form textarea[name='shipping_to_address']").html('');
        $("#create_invoice_modal form textarea[name='billing_address']").html('');
    } else {
        $.ajax({
            type: 'POST',
            url: baseURL + "accounting/addLocationajax",
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                // alert('success');
                console.log(response['customer']);

                if (response['customer'].cross_street == null || response['customer'].cross_street.trim().length == 0) {
                    var cross = '';
                } else {
                    var cross = response['customer'].cross_street;
                }

                if (response['customer'].city == null || response['customer'].city.trim().length == 0) {
                    var city = '';
                } else {
                    var city = response['customer'].city;
                }

                if (response['customer'].state == null || response['customer'].state.trim().length == 0) {
                    var state = '';
                } else {
                    var state = response['customer'].state;
                }

                if (response['customer'].country == null || response['customer'].country.trim().length == 0) {
                    var country = '';
                } else {
                    var country = response['customer'].country;
                }

                $("#create_invoice_modal form input[name='invoice_job_location']").removeAttr("disabled");
                $("#create_invoice_modal form input[name='invoice_job_location']").val(cross + ' ' + city + ' ' + state + ' ' +
                    country);
                $("#create_invoice_modal form input[name='customer_email']").val(response['customer'].email);
                $("#create_invoice_modal form textarea[name='shipping_to_address']").html(response['customer'].mail_add);
                $("#create_invoice_modal form textarea[name='billing_address']").html(response['customer'].mail_add);

            },
            error: function(response) {
                alert('Error' + response);
            }
        });
    }
}


$("#create_invoice_modal form").submit(function(event) {
    event.preventDefault();
});
$(document).on("click", "#create_invoice_modal form button[data-action='save']", function(event) {
    $("#create_invoice_modal form input[name='invoice_job_location']").removeAttr("disabled");
    var submit_type = $(this).attr('data-submit-type');
    $("#create_invoice_modal form input[name='submit-type']").val("invoice_modal");
    var customer_id = $("#create_invoice_modal form select[name='customer_id']").val();
    var empty_flds = 0;
    $("#create_invoice_modal form  .required").each(function() {
        if (!$.trim($(this).val())) {
            empty_flds++;
        }
    });
    if (empty_flds == 0) {
        event.preventDefault();
        Swal.fire({
            title: "Save this Invoice?",
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
                    url: baseURL + "/accounting/addInvoice",
                    type: "POST",
                    dataType: "json",
                    data: $("#create_invoice_modal form").serialize(),
                    success: function(data) {
                        if (data.count_save > 0) {
                            $("#create_invoice_modal form input[name='invoice_id']").val(data.invoice_id);
                            get_load_customers_table();
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: "Success",
                                html: "Invoice has been saved.",
                                icon: "success",
                            }).then((result) => {
                                if (submit_type == "save-preview") {
                                    window.location.href = baseURL + "invoice/genview/" + data.invoice_id;
                                } else if (submit_type == "save") {
                                    $("#create_invoice_modal form .attachement-file-section input[name='attachment-file']").val("");
                                    $("#create_invoice_modal form .attachement-file-section input[name='attachement-filenames']").val("");
                                    upload_attachment("#create_invoice_modal form");
                                    reset_create_invoice_modal_form();
                                    $('#create_invoice_modal').modal('hide');
                                }
                            });

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
$(document).on("change", "#create_invoice_modal form .item-totals input[name='adjustment_value']", function(event) {
    if ($(this).val() == "") {
        $(this).val("0.00");
    } else {
        $(this).val(parseFloat($(this).val().replace(/,/g, '')));
        $(this).val(Number($(this).val()).toLocaleString('en'));
    }
    create_invoice_modal_compute_grand_total();
});

$(document).on("click", "#create_invoice_modal .modal-footer-check button[data-action='close-modal']", function(event) {
    reset_create_invoice_modal_form();
    $('#create_invoice_modal').modal('hide');
});

$(document).on("click", "#create_invoice_modal .modal-footer-check button[data-action='clear-modal-form']", function(event) {
    reset_create_invoice_modal_form();
});
$('#create_invoice_modal').on('hidden.bs.modal', function() {
    reset_create_invoice_modal_form();
})


function create_invoice_modal_clear_all_lines() {
    var new_tr = "<tr>" + $("#create_invoice_modal table tbody tr:last-child").html() + "</tr>";
    $("#create_invoice_modal table tbody").html(new_tr);
    $("#create_invoice_modal table tbody tr:last-child").find(".total_per_item").html("0.00");
    create_invoice_modal_compute_grand_total();
}
$(document).on("click", "#create_invoice_modal .item-buttons .clear-all-lines", function(event) {
    create_invoice_modal_clear_all_lines();
});

function reset_create_invoice_modal_form() {
    $("#create_invoice_modal form .attachement-file-section input[name='attachment-file']").val("");
    upload_attachment("#create_invoice_modal form");
    var customer_id = $("#create_invoice_modal form select[name='customer_id']").val();
    $('#create_invoice_modal form').trigger("reset");
    $("#create_invoice_modal form select[name='customer_id']").val(customer_id);
    create_invoice_modal_customer_changed(customer_id);
    create_invoice_modal_clear_all_lines();
}

$(document).on("click", "#create_invoice_modal form .attachement-file-section button.attachment-btn", function(event) {
    // $(this).preventDefault();
    $("#create_invoice_modal form input[name='attachment-file']").trigger('click');
});
$(document).on("change", "div#create_invoice_modal form input[name='attachment-file']", function(event) {
    upload_attachment("#create_invoice_modal form");
});