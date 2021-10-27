$(document).on("click", function(event) {
    if ($(event.target).closest("div#add_refund_receipt_Modal .modal-footer-check .right-option").length === 0) {
        $("div#add_refund_receipt_Modal .modal-footer-check .sub-option").hide();
    }
    if ($(event.target).closest("#add_refund_receipt_Modal .modal-footer-check .middle-links .print-preview-option").length === 0) {
        $("#add_refund_receipt_Modal .pint-pries-option-section").hide();
    }
    if ($(event.target).closest("#add_refund_receipt_Modal .email-cc-bcc-section").length === 0) {
        $("#add_refund_receipt_Modal .email-cc-bcc-section .email-cc-bcc-panel").hide();
    }
});
$(document).on("click", "#add_refund_receipt_Modal .modal-footer-check .middle-links .print-preview-option", function(event) {
    event.preventDefault();
    $("#add_refund_receipt_Modal .pint-pries-option-section").show();
});
$(document).on("keyup", "#add_refund_receipt_Modal .items-section table input[name='items[]']", function(event) {
    var iteam_search = $(this).val();
    var suggestions = $(this).parent("td").children(".suggestions");
    get_search_items(iteam_search, suggestions);
});

$(document).on("focus", "#add_refund_receipt_Modal .items-section table input[name='items[]']", function(event) {
    var iteam_search = $(this).val();
    var suggestions = $(this).parent("td").children(".suggestions");
    $(this).attr("autocomplete", "off");
    get_search_items(iteam_search, suggestions);
});

$(document).on("click", "#add_refund_receipt_Modal  .items-section table .suggestions li", function(event) {
    $(this).parent("ul").parent("td").children("input[name='item_ids[]']").val($(this).attr('data-id'));
    $(this).parent("ul").parent("td").children("input[name='items[]']").val($(this).html());
    $(this).parent("ul").parent("td").parent("tr").find("input[name='quantity[]']").val(1);
    $(this).parent("ul").parent("td").parent("tr").find("input[name='price[]']").val($(this).attr('data-price'));
    $(this).parent("ul").parent("td").parent("tr").find("input[name='discount[]']").val($(this).attr('data-discount'));
    var tax_computed = $(this).attr('data-price') * 0.075;
    $(this).parent("ul").parent("td").parent("tr").find("input[name='tax[]']").val(Number(tax_computed).toLocaleString('en'));
    $(this).parent("ul").parent("td").parent("tr").find("input.tax-hide").val("7.5");
    var total = tax_computed + parseFloat($(this).attr('data-price'));
    $(this).parent("ul").parent("td").parent("tr").find(".total_per_item_rr").html(Number(total).toLocaleString('en'));
    $(this).parent("ul").parent("td").parent("tr").find("input[name='total[]']").val(total);
    $("#add_refund_receipt_Modal  .items-section table .suggestions").html("");
    compute_grand_total_refund_receipt();
});

$(document).on("change", "#add_refund_receipt_Modal  .items-section table td input", function(event) {
    var qty = $(this).parent("td").parent("tr").find("input[name='quantity[]']").val();
    var price = $(this).parent("td").parent("tr").find("input[name='price[]']").val();
    var discount = $(this).parent("td").parent("tr").find("input[name='discount[]']").val();
    if ($(this).attr("data-type") == "tax") {
        $(this).parent("td").parent("tr").find("input.tax-hide").val($(this).val());
        var computed_tax = parseFloat(price) * parseFloat($(this).val());
        $(this).val(Number(computed_tax).toLocaleString('en'));
    }
    var tax = $(this).parent("td").parent("tr").find("input.tax-hide").val();
    var total = ((qty * price) + ((qty * price) * (tax / 100))) - discount;
    $(this).parent("td").parent("tr").find("input[name='tax[]']").val(Number((qty * price) * (tax / 100)).toLocaleString('en'));
    $(this).parent("td").parent("tr").find(".total_per_item_rr").html(Number(total).toLocaleString('en'));
    $(this).parent("td").parent("tr").find("input[name='total[]']").val(total);
    compute_grand_total_refund_receipt();

});


function compute_grand_total_refund_receipt() {
    var qty_array = $("#add_refund_receipt_Modal table tr td input[name='quantity[]']").map(function() { return $(this).val(); }).get();
    var price_array = $("#add_refund_receipt_Modal table tr td input[name='price[]']").map(function() { return $(this).val(); }).get();
    var discount_array = $("#add_refund_receipt_Modal table tr td input[name='discount[]']").map(function() { return $(this).val(); }).get();
    var tax_pecent_array = $("#add_refund_receipt_Modal table tr td input[name='tax_percent[]']").map(function() { return $(this).val(); }).get();
    var grand_total = 0;
    var total_taxes = 0;
    var subtotal = 0;
    for (var i = 0; i < qty_array.length; i++) {
        grand_total += ((qty_array[i] * price_array[i]) + ((qty_array[i] * price_array[i]) * (parseFloat(tax_pecent_array[i] / 100)))) - discount_array[i];
        total_taxes += ((qty_array[i] * price_array[i]) * (parseFloat(tax_pecent_array[i] / 100)));
        subtotal += (qty_array[i] * price_array[i]);
    }
    grand_total -= parseFloat($("#add_refund_receipt_Modal form .item-totals input[name='adjustment_value']").val().replace(/,/g, ''));
    $("#add_refund_receipt_Modal .item-totals .amount .subtotal").html("$" + Number(subtotal).toLocaleString('en'));
    $("#add_refund_receipt_Modal .item-totals .amount .taxes").html("$" + Number(total_taxes).toLocaleString('en'));
    $("#add_refund_receipt_Modal .item-totals .amount .grand-total").html("$" + Number(grand_total).toLocaleString('en'));
    $("#add_refund_receipt_Modal form input[name='grand_total']").val(grand_total);
    $("#add_refund_receipt_Modal form input[name='subtotal']").val(subtotal);
    $("#add_refund_receipt_Modal form input[name='taxes']").val(total_taxes);
    $("#add_refund_receipt_Modal form h2 span.grand_total_sr_t.bigdisplay").html("$" + Number(grand_total).toLocaleString('en'));
}
$(document).on("change", "#add_refund_receipt_Modal form .item-totals input[name='adjustment_value']", function(event) {
    if ($(this).val() == "") {
        $(this).val("0.00");
    } else {
        $(this).val(parseFloat($(this).val().replace(/,/g, '')));
        $(this).val(Number($(this).val()).toLocaleString('en'));
    }
    compute_grand_total_refund_receipt();
});
$(document).on("focus", "#add_refund_receipt_Modal .items-section table tr td", function(event) {

    if (!$(this).is(':last-child')) {
        if ($(this).parent("tr").is(':last-child')) {
            $("#add_refund_receipt_Modal .items-section table tbody").append("<tr>" + $(this).parent("tr").html() + "</tr>");
            $("#add_refund_receipt_Modal .items-section table tbody tr:last-child").find(".total_per_item_rr").html("0.00");
        }
    }
});

$(document).on("click", "#add_refund_receipt_Modal .items-section table tr td a.delete-item", function(event) {
    if ($("#add_refund_receipt_Modal .items-section table tbody tr").length > 1) {
        $(this).parent("td").parent("tr").remove();
        compute_grand_total_refund_receipt();
    }
});

$(document).on("click", "#add_refund_receipt_Modal .item-buttons .add-lines", function(event) {
    $("#add_refund_receipt_Modal .items-section table tbody").append("<tr>" + $("#add_refund_receipt_Modal .items-section table tbody tr:last-child").html() + "</tr>");
    $("#add_refund_receipt_Modal .items-section table tbody tr:last-child").find(".total_per_item_rr").html("0.00");
    $("#add_refund_receipt_Modal .items-section table tbody").append("<tr>" + $("#add_refund_receipt_Modal .items-section table tbody tr:last-child").html() + "</tr>");
    $("#add_refund_receipt_Modal .items-section table tbody tr:last-child").find(".total_per_item_rr").html("0.00");
    $("#add_refund_receipt_Modal .items-section table tbody").append("<tr>" + $("#add_refund_receipt_Modal .items-section table tbody tr:last-child").html() + "</tr>");
    $("#add_refund_receipt_Modal .items-section table tbody tr:last-child").find(".total_per_item_rr").html("0.00");
    $("#add_refund_receipt_Modal .items-section table tbody").append("<tr>" + $("#add_refund_receipt_Modal .items-section table tbody tr:last-child").html() + "</tr>");
    $("#add_refund_receipt_Modal .items-section table tbody tr:last-child").find(".total_per_item_rr").html("0.00");
});

function clear_all_lines_refund_receipt() {
    var new_tr = "<tr>" + $("#add_refund_receipt_Modal .items-section table tbody tr:last-child").html() + "</tr>";
    $("#add_refund_receipt_Modal .items-section table tbody").html(new_tr);
    $("#add_refund_receipt_Modal .items-section table tbody tr:last-child").find(".total_per_item_rr").html("0.00");
    compute_grand_total_refund_receipt();
}
$(document).on("click", "#add_refund_receipt_Modal .item-buttons .clear-all-lines", function(event) {
    clear_all_lines_refund_receipt();
});
$(document).on("click", "div#add_refund_receipt_Modal .modal-footer-check .btn-save-dropdown", function(event) {
    event.preventDefault();
    $("div#add_refund_receipt_Modal .modal-footer-check .sub-option").show();
});


$(document).on("change", "#add_refund_receipt_Modal .recurring-form-part.below .date-part .input-field-2 select", function(event) {
    $("#add_refund_receipt_Modal .recurring-form-part.below .date-part .input-field-3 .by-end-date").hide();
    $("#add_refund_receipt_Modal .recurring-form-part.below .date-part .input-field-3 .after-occurrences").hide();
    if ($(this).val() == "By") {
        $("#add_refund_receipt_Modal .recurring-form-part.below .date-part .input-field-3 .by-end-date").show();
    } else if ($(this).val() == "After") {
        $("#add_refund_receipt_Modal .recurring-form-part.below .date-part .input-field-3 .after-occurrences").show();
    }
});

$(document).on("change", "#add_refund_receipt_Modal select[name='recurring-interval']", function(event) {
    $("#add_refund_receipt_Modal .recurring-form-part.below .interval-part .monthly").hide();
    $("#add_refund_receipt_Modal .recurring-form-part.below .interval-part .daily").hide();
    $("#add_refund_receipt_Modal .recurring-form-part.below .interval-part .weekly").hide();
    $("#add_refund_receipt_Modal .recurring-form-part.below .interval-part .yearly").hide();
    if ($(this).val() == "Daily") {
        $("#add_refund_receipt_Modal .recurring-form-part.below .interval-part .daily").show();
    } else if ($(this).val() == "Weekly") {
        $("#add_refund_receipt_Modal .recurring-form-part.below .interval-part .weekly").show();
    } else if ($(this).val() == "Monthly") {
        $("#add_refund_receipt_Modal .recurring-form-part.below .interval-part .monthly").show();
    } else if ($(this).val() == "Yearly") {
        $("#add_refund_receipt_Modal .recurring-form-part.below .interval-part .yearly").show();
    }
});

$(document).on("change", "#add_refund_receipt_Modal select[name='recurring-type']", function(event) {
    $("#add_refund_receipt_Modal .recurring-form-part .schedule-type").hide();
    $("#add_refund_receipt_Modal .recurring-form-part .reminder-type").hide();
    $("#add_refund_receipt_Modal .recurring-form-part .unschedule-type").hide();
    if ($(this).val() == "Schedule") {
        $("#add_refund_receipt_Modal .recurring-form-part .schedule-type").show();
        $("#add_refund_receipt_Modal .recurring-form-part.below ").show();
    } else if ($(this).val() == "Reminder") {
        $("#add_refund_receipt_Modal .recurring-form-part .reminder-type").show();
        $("#add_refund_receipt_Modal .recurring-form-part.below ").show();
    } else if ($(this).val() == "Unschedule") {
        $("#add_refund_receipt_Modal .recurring-form-part .unschedule-type").show();
        $("#add_refund_receipt_Modal .recurring-form-part.below ").hide();
    }
});

$(document).on("click", "#add_refund_receipt_Modal .modal-footer-check .middle-links.end a", function(event) {
    event.preventDefault();
    $("#add_refund_receipt_Modal .recurring-form-part").show();
    $("#add_refund_receipt_Modal .modal-footer-check .middle-links").hide();
    $("#add_refund_receipt_Modal .modal-footer-check #cancel_recurring").show();
    $("#add_refund_receipt_Modal .modal-footer-check #closeCheckModal").hide();
    $("#add_refund_receipt_Modal form input[name='recurring_selected']").val(1);
    $("#add_refund_receipt_Modal .customer-info").addClass("recurring-customer-info");
    $("#add_refund_receipt_Modal form input[name='recurring-template-name']").val($("#add_refund_receipt_Modal form #sel-customer2 option:selected").attr("data-text"));
    $("#add_refund_receipt_Modal #grand_total_sr_t").addClass("hidden");
    $("#add_refund_receipt_Modal .label-grand_total_sr_t").addClass("hidden");
    $("#add_refund_receipt_Modal .error-message-section").hide();
});
$(document).on("click", "#add_refund_receipt_Modal .modal-footer-check #clearsalereceipt", function(event) {
    event.preventDefault();
    $("#add_refund_receipt_Modal form .attachement-file-section input[name='attachment-file']").val("");
    upload_attachment("#add_refund_receipt_Modal form");
    var recurring_selected = $("#add_refund_receipt_Modal form input[name='recurring_selected']").val();
    $('#add_refund_receipt_Modal form').trigger("reset");
    $("#add_refund_receipt_Modal form textarea").html("");
    $("#add_refund_receipt_Modal form input[name='recurring_selected']").val(recurring_selected);
    clear_all_lines_sales_receipt();
});

$(document).on("click", "#add_refund_receipt_Modal .modal-footer-check #cancel_recurring", function(event) {
    event.preventDefault();
    $("#add_refund_receipt_Modal .modal-footer-check #cancel_recurring").hide();
    $("#add_refund_receipt_Modal .recurring-form-part").hide();
    $("#add_refund_receipt_Modal .modal-footer-check .middle-links").show();
    $("#add_refund_receipt_Modal .modal-footer-check #closeCheckModal").show();
    $("#add_refund_receipt_Modal form input[name='recurring_selected']").val("");
    $("#add_refund_receipt_Modal .customer-info").removeClass("recurring-customer-info");
    $("#add_refund_receipt_Modal #grand_total_sr_t").removeClass("hidden");
    $("#add_refund_receipt_Modal .label-grand_total_sr_t").removeClass("hidden");
});
$('#add_refund_receipt_Modal').on('hidden.bs.modal', function() {
    $("#add_refund_receipt_Modal form .attachement-file-section input[name='attachment-file']").val("");
    upload_attachment("#add_refund_receipt_Modal form");
    $("#add_refund_receipt_Modal .modal-footer-check #cancel_recurring").hide();
    $("#add_refund_receipt_Modal .recurring-form-part").hide();
    $("#add_refund_receipt_Modal .modal-footer-check .middle-links").show();
    $("#add_refund_receipt_Modal .modal-footer-check #closeCheckModal").show();
    $("#add_refund_receipt_Modal form input[name='recurring_selected']").val("");
    $("#add_refund_receipt_Modal .customer-info").removeClass("recurring-customer-info");
    $('#add_refund_receipt_Modal form').trigger("reset");
    $("#add_refund_receipt_Modal #grand_total_sr_t").removeClass("hidden");
    $("#add_refund_receipt_Modal .label-grand_total_sr_t").removeClass("hidden");
    $("#add_refund_receipt_Modal .modal-title .sales_receipt_number").html("");
});
$(document).on("change", "#add_refund_receipt_Modal form select[name='customer_id']", function(event) {
    refund_receipt_modal_customer_changed($(this).val());
});

function refund_receipt_modal_customer_changed(id) {
    if (id == "") {
        $("#add_refund_receipt_Modal form input[name='invoice_job_location']").val('');
        $("#add_refund_receipt_Modal form input[name='customer_email']").val('');
        $("#add_refund_receipt_Modal form textarea[name='shipping_to_address']").html('');
        $("#add_refund_receipt_Modal form textarea[name='billing_address']").html('');
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

                $("#add_refund_receipt_Modal form input[name='invoice_job_location']").removeAttr("disabled");
                $("#create_iadd_refund_receipt_Modalnvoice_modal form input[name='invoice_job_location']").val(cross + ' ' + city + ' ' + state + ' ' +
                    country);
                $("#add_refund_receipt_Modal form input[name='customer_email']").val(response['customer'].email);
                $("#add_refund_receipt_Modal form textarea[name='shipping_to_address']").html(response['customer'].mail_add);
                $("#add_refund_receipt_Modal form textarea[name='billing_address']").html(response['customer'].mail_add);

            },
            error: function(response) {
                alert('Error' + response);
            }
        });
    }
}
$(document).on("click", "#add_refund_receipt_Modal .modal-footer-check button[data-action='close-modal']", function(event) {
    reset_refund_receipt_form();
    $('#add_refund_receipt_Modal').modal('hide');
});

function reset_refund_receipt_form() {
    $("#add_refund_receipt_Modal form .attachement-file-section input[name='attachment-file']").val("");
    upload_attachment("#add_refund_receipt_Modal form");
    var customer_id = $("#add_refund_receipt_Modal form select[name='customer_id']").val();
    $('#add_refund_receipt_Modal form').trigger("reset");
    $("#add_refund_receipt_Modal form select[name='customer_id']").val(customer_id);
    refund_receipt_modal_customer_changed(customer_id);
    clear_all_lines_refund_receipt();
}
$(document).on("click", "#add_refund_receipt_Modal .email-cc-bcc-section a.cc-bcc-btn", function(event) {
    event.preventDefault();
    $("#add_refund_receipt_Modal .email-cc-bcc-section .email-cc-bcc-panel").show();
});

$(document).on("click", "#add_refund_receipt_Modal .email-cc-bcc-panel button.cancel-btn", function(event) {
    $("#add_refund_receipt_Modal form input[name='email-cc']").val("");
    $("#add_refund_receipt_Modal form input[name='email-bcc']").val("");
    $("#add_refund_receipt_Modal .email-cc-bcc-section .email-cc-bcc-panel").hide();
});
$(document).on("click", "#add_refund_receipt_Modal .email-cc-bcc-panel button.done-btn", function(event) {
    $("#add_refund_receipt_Modal .email-cc-bcc-section .email-cc-bcc-panel").hide();
});

$("#add_refund_receipt_Modal form").submit(function(event) {
    event.preventDefault();
});
$(document).on("click", "#add_refund_receipt_Modal form button[type='submit']", function(event) {
    var submit_type = $(this).attr("data-submit-type");
    save_refund_receipt(submit_type, this);

});


function save_refund_receipt(submit_type, element) {
    var empty_flds = 0;
    $("#add_refund_receipt_Modal form .required").each(function() {
        if (!$.trim($(this).val())) {
            empty_flds++;
        }
    });
    if (empty_flds == 0) {
        $("#add_refund_receipt_Modal .error-message-section").hide();
        $("#add_refund_receipt_Modal form input[name='submit_type']").val(submit_type);
        Swal.fire({
            title: "Save Refund Receipt?",
            html: "Are you sure you want to save this?",
            showCancelButton: true,
            imageUrl: baseURL + "/assets/img/accounting/customers/folder.png",
            cancelButtonColor: "#d33",
            confirmButtonColor: "#2ca01c",
            confirmButtonText: $(element).html(),
        }).then((result) => {
            if (result.value) {
                $("#loader-modal").show();
                $.ajax({
                    url: baseURL + "/accounting/add_refund_receipt",
                    type: "POST",
                    dataType: "json",
                    data: $("#add_refund_receipt_Modal form").serialize(),
                    success: function(data) {
                        if (data.count_save > 0) {
                            if (submit_type == "save-send") {
                                $('#sales_receipt_pdf_preview_modal').modal('show');
                                $('#sales_receipt_pdf_preview_modal .send_sales_receipt_section').show();
                                $('#sales_receipt_pdf_preview_modal .pdf_preview_section').hide();
                                $('#sales_receipt_pdf_preview_modal .modal-title').html("Send email");
                                $('#sales_receipt_pdf_preview_modal form#send_sales_receipt input[name="sales_receipt_id"]').val(data.sales_receipt_id);
                                $('#sales_receipt_pdf_preview_modal form#send_sales_receipt input[name="email"]').val(data.customer_email);
                                $('#sales_receipt_pdf_preview_modal form#send_sales_receipt input[name="subject"]').val("Sales Receipt " + data.sales_receipt_id + " from " + data.business_name);
                                $('#sales_receipt_pdf_preview_modal form#send_sales_receipt textarea[name="body"]').val(`Dear ` + data.customer_full_name + `,

Please review the sales receipt below.
We appreciate it very much.
                            
Thanks for your business!
` + data.business_name);
                                $("#sales_receipt_pdf_preview_modal .modal-footer .send_sales_receipt_section .download-button").attr('href', data.file_location);
                                $("#sales_receipt_pdf_preview_modal .send_sales_receipt_section .send_sales_receipt-preview").html(
                                    '<iframe src="' + data.file_location + '"></iframe>');

                                // Swal.fire({
                                //     showConfirmButton: false,
                                //     timer: 2000,
                                //     title: "Success",
                                //     html: "Sales receipt has been saved and sent.",
                                //     icon: "success",
                                // });
                            } else {
                                $("#saved-notification-modal-section").fadeIn();
                                $("#saved-notification-modal-section .body").slideDown("slow");
                                setTimeout(function() { $("#saved-notification-modal-section").fadeOut(); }, 2000);
                            }
                            $("#add_refund_receipt_Modal form input[name='current_sales_recept_number']").val(data.sales_receipt_id);
                            $("#add_refund_receipt_Modal .modal-title .sales_receipt_number").html("#" + data.sales_receipt_id);
                            $("#create_invoice_modal form .attachement-file-section input[name='attachment-file']").val("");
                            $("#create_invoice_modal form .attachement-file-section input[name='attachement-filenames']").val("");
                        } else {
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: "Error",
                                html: "No sales receipt saved. Please double check your inputs.",
                                icon: "error",
                            });
                        }
                        if (submit_type == "save-new") {
                            $("#create_invoice_modal form .attachement-file-section input[name='attachment-file']").val("");
                            $("#create_invoice_modal form .attachement-file-section input[name='attachement-filenames']").val("");
                            upload_attachment("#create_invoice_modal form");
                            $('#add_refund_receipt_Modal form').trigger("reset");
                            $("#add_refund_receipt_Modal .modal-title .sales_receipt_number").html("");
                        } else if (submit_type == "save-close") {
                            $("#add_refund_receipt_Modal").modal('hide');
                            $('#add_refund_receipt_Modal form').trigger("reset");
                            $("#add_refund_receipt_Modal .modal-title .sales_receipt_number").html("");
                        }
                        $("#loader-modal").hide();
                    },
                });
            }
        });
    } else {
        $("#add_refund_receipt_Modal .error-message-section").show();
    }
}



$(document).on("change", "div#add_refund_receipt_Modal form select[name='payment_method']", function(event) {
    $("div#add_refund_receipt_Modal .payment_method_information").html("");
    $("div#addsalesreceiptModal .payment_method_information").html("");

    $("div#add_refund_receipt_Modal .payment_method_information").html(payment_method_information);
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