$("#addsalesreceiptModal form").submit(function(event) {
    event.preventDefault();
});
$(document).on("click", "#addsalesreceiptModal form button[type='submit']", function(event) {
    var submit_type = $(this).attr("data-submit-type");
    console.log("pumasok");
    save_sales_receipt(submit_type, this);

});
$(document).on("click", "#addsalesreceiptModal .modal-footer-check  #closeCheckModal", function() {
    $("#addsalesreceiptModal").modal('hide');
});

$(document).on('show.bs.modal', '#addsalesreceiptModal', function() {
    clear_all_lines_sales_receipt();
})

function save_sales_receipt(submit_type, element) {
    var empty_flds = 0;
    $("#addsalesreceiptModal form .required").each(function() {
        if (!$.trim($(this).val())) {
            empty_flds++;
        }
    });
    console.log(empty_flds);
    if (empty_flds == 0) {

        $("#addsalesreceiptModal .error-message-section").hide();
        $("#addsalesreceiptModal form input[name='submit_type']").val(submit_type);
        Swal.fire({
            title: "Save Sales Receipt?",
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
                    url: baseURL + "/accounting/addSalesReceipt",
                    type: "POST",
                    dataType: "json",
                    data: $("#addsalesreceiptModal form").serialize(),
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
                            $("#addsalesreceiptModal form input[name='current_sales_recept_number']").val(data.sales_receipt_id);
                            $("#addsalesreceiptModal .modal-title .sales_receipt_number").html("#" + data.sales_receipt_id);
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
                            $('#addsalesreceiptModal form').trigger("reset");
                            $("#addsalesreceiptModal .modal-title .sales_receipt_number").html("");
                        } else if (submit_type == "save-close") {
                            $("#addsalesreceiptModal").modal('hide');
                            $('#addsalesreceiptModal form').trigger("reset");
                            $("#addsalesreceiptModal .modal-title .sales_receipt_number").html("");
                        }
                        $("#loader-modal").hide();
                    },
                });
            }
        });
    } else {
        $("#addsalesreceiptModal .error-message-section").show();
    }
}
$(document).on("change", "#addsalesreceiptModal .recurring-form-part.below .date-part .input-field-2 select", function(event) {
    $("#addsalesreceiptModal .recurring-form-part.below .date-part .input-field-3 .by-end-date").hide();
    $("#addsalesreceiptModal .recurring-form-part.below .date-part .input-field-3 .after-occurrences").hide();
    if ($(this).val() == "By") {
        $("#addsalesreceiptModal .recurring-form-part.below .date-part .input-field-3 .by-end-date").show();
    } else if ($(this).val() == "After") {
        $("#addsalesreceiptModal .recurring-form-part.below .date-part .input-field-3 .after-occurrences").show();
    }
});

$(document).on("change", "#addsalesreceiptModal select[name='recurring-interval']", function(event) {
    $("#addsalesreceiptModal .recurring-form-part.below .interval-part .monthly").hide();
    $("#addsalesreceiptModal .recurring-form-part.below .interval-part .daily").hide();
    $("#addsalesreceiptModal .recurring-form-part.below .interval-part .weekly").hide();
    $("#addsalesreceiptModal .recurring-form-part.below .interval-part .yearly").hide();
    if ($(this).val() == "Daily") {
        $("#addsalesreceiptModal .recurring-form-part.below .interval-part .daily").show();
    } else if ($(this).val() == "Weekly") {
        $("#addsalesreceiptModal .recurring-form-part.below .interval-part .weekly").show();
    } else if ($(this).val() == "Monthly") {
        $("#addsalesreceiptModal .recurring-form-part.below .interval-part .monthly").show();
    } else if ($(this).val() == "Yearly") {
        $("#addsalesreceiptModal .recurring-form-part.below .interval-part .yearly").show();
    }
});

$(document).on("change", "#addsalesreceiptModal select[name='recurring-type']", function(event) {
    $("#addsalesreceiptModal .recurring-form-part .schedule-type").hide();
    $("#addsalesreceiptModal .recurring-form-part .reminder-type").hide();
    $("#addsalesreceiptModal .recurring-form-part .unschedule-type").hide();
    if ($(this).val() == "Schedule") {
        $("#addsalesreceiptModal .recurring-form-part .schedule-type").show();
        $("#addsalesreceiptModal .recurring-form-part.below ").show();
    } else if ($(this).val() == "Reminder") {
        $("#addsalesreceiptModal .recurring-form-part .reminder-type").show();
        $("#addsalesreceiptModal .recurring-form-part.below ").show();
    } else if ($(this).val() == "Unschedule") {
        $("#addsalesreceiptModal .recurring-form-part .unschedule-type").show();
        $("#addsalesreceiptModal .recurring-form-part.below ").hide();
    }
});

$(document).on("click", "#addsalesreceiptModal .modal-footer-check .middle-links.end a", function(event) {
    event.preventDefault();
    $("#addsalesreceiptModal .recurring-form-part").show();
    $("#addsalesreceiptModal .modal-footer-check .middle-links").hide();
    $("#addsalesreceiptModal .modal-footer-check #cancel_recurring").show();
    $("#addsalesreceiptModal .modal-footer-check #closeCheckModal").hide();
    $("#addsalesreceiptModal form input[name='recurring_selected']").val(1);
    $("#addsalesreceiptModal .customer-info").addClass("recurring-customer-info");
    $("#addsalesreceiptModal form input[name='recurring-template-name']").val($("#addsalesreceiptModal form #sel-customer2 option:selected").attr("data-text"));
    $("#addsalesreceiptModal #grand_total_sr_t").addClass("hidden");
    $("#addsalesreceiptModal .label-grand_total_sr_t").addClass("hidden");
    $("#addsalesreceiptModal .error-message-section").hide();
});
$(document).on("click", "#addsalesreceiptModal .modal-footer-check #clearsalereceipt", function(event) {
    event.preventDefault();
    $("#addsalesreceiptModal form .attachement-file-section input[name='attachment-file']").val("");
    upload_attachment("#addsalesreceiptModal form");
    var recurring_selected = $("#addsalesreceiptModal form input[name='recurring_selected']").val();
    $('#addsalesreceiptModal form').trigger("reset");
    $("#addsalesreceiptModal form textarea").html("");
    $("#addsalesreceiptModal form input[name='recurring_selected']").val(recurring_selected);
    clear_all_lines_sales_receipt();
});

$(document).on("click", "#addsalesreceiptModal .modal-footer-check #cancel_recurring", function(event) {
    event.preventDefault();
    $("#addsalesreceiptModal .modal-footer-check #cancel_recurring").hide();
    $("#addsalesreceiptModal .recurring-form-part").hide();
    $("#addsalesreceiptModal .modal-footer-check .middle-links").show();
    $("#addsalesreceiptModal .modal-footer-check #closeCheckModal").show();
    $("#addsalesreceiptModal form input[name='recurring_selected']").val("");
    $("#addsalesreceiptModal .customer-info").removeClass("recurring-customer-info");
    $("#addsalesreceiptModal #grand_total_sr_t").removeClass("hidden");
    $("#addsalesreceiptModal .label-grand_total_sr_t").removeClass("hidden");
});
$('#addsalesreceiptModal').on('hidden.bs.modal', function() {
    $("#addsalesreceiptModal form .attachement-file-section input[name='attachment-file']").val("");
    upload_attachment("#addsalesreceiptModal form");
    $("#addsalesreceiptModal .modal-footer-check #cancel_recurring").hide();
    $("#addsalesreceiptModal .recurring-form-part").hide();
    $("#addsalesreceiptModal .modal-footer-check .middle-links").show();
    $("#addsalesreceiptModal .modal-footer-check #closeCheckModal").show();
    $("#addsalesreceiptModal form input[name='recurring_selected']").val("");
    $("#addsalesreceiptModal .customer-info").removeClass("recurring-customer-info");
    $('#addsalesreceiptModal form').trigger("reset");
    $("#addsalesreceiptModal #grand_total_sr_t").removeClass("hidden");
    $("#addsalesreceiptModal .label-grand_total_sr_t").removeClass("hidden");
    $("#addsalesreceiptModal .modal-title .sales_receipt_number").html("");
});
$('#sales_receipt_pdf_preview_modal').on('hidden.bs.modal', function() {
    $('#sales_receipt_pdf_preview_modal .pdf_preview_section').show();
    $('#sales_receipt_pdf_preview_modal .modal-title').html("Print preview");
    $('#sales_receipt_pdf_preview_modal .send_sales_receipt_section').hide();
    $('#sales_receipt_pdf_preview_modal form').trigger("reset");
});


$(document).on("click", function(event) {
    if ($(event.target).closest("#addsalesreceiptModal .modal-footer-check .middle-links .print-preview-option").length === 0) {
        $("#addsalesreceiptModal .pint-pries-option-section").hide();
    }
});

$(document).on("click", "#addsalesreceiptModal .modal-footer-check .middle-links .print-preview-option", function(event) {
    event.preventDefault();
    $("#addsalesreceiptModal .pint-pries-option-section").show();
    $('#myModal').modal('show');
});

$(document).on("click", "#addsalesreceiptModal .pint-pries-option-section .print-preview", function(event) {
    event.preventDefault();
    generate_pdf("print_sales_receipt");
});

$(document).on("click", "#addsalesreceiptModal .pint-pries-option-section .print-slip", function(event) {
    event.preventDefault();
    generate_pdf("print_packaging_slip");
});
$(document).on("click", "#sales_receipt_pdf_preview_modal form#send_sales_receipt button[type='submit']", function(event) {

    var send_type = $(this).attr("data-submit-type");
    var empty_flds = 0;
    var receive_payment_id = $("#sales_receipt_pdf_preview_modal form#send_sales_receipt input[name='receive_payment_id']").val();
    var sales_receipt_id = $("#sales_receipt_pdf_preview_modal form#send_sales_receipt input[name='sales_receipt_id']").val();
    var email = $("#sales_receipt_pdf_preview_modal form#send_sales_receipt input[name='email']").val();
    var body = $("#sales_receipt_pdf_preview_modal form#send_sales_receipt textarea[name='body']").val();
    var subject = $("#sales_receipt_pdf_preview_modal form#send_sales_receipt input[name='subject']").val();
    $("#sales_receipt_pdf_preview_modal form#send_sales_receipt .required").each(function() {
        if (!$.trim($(this).val())) {
            empty_flds++;
        }
    });
    if (empty_flds == 0) {

        $("#loader-modal").show();
        Swal.fire({
            title: "Send?",
            html: "Are you sure you want to send this?",
            showCancelButton: true,
            imageUrl: baseURL + "/assets/img/accounting/customers/message.png",
            cancelButtonColor: "#d33",
            confirmButtonColor: "#2ca01c",
            confirmButtonText: "Send now",
        }).then((result) => {
            if (result.value) {
                if (receive_payment_id != "") {
                    var sender = "receive_payment_send_email";
                } else {
                    var sender = "sales_receipt_send_email";
                }
                $.ajax({
                    url: baseURL + "/accounting/" + sender,
                    type: "POST",
                    dataType: "json",
                    data: {
                        receive_payment_id: receive_payment_id,
                        sales_receipt_id: sales_receipt_id,
                        email: email,
                        body: body,
                        subject: subject
                    },
                    success: function(data) {
                        if (data.status == "success") {
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: "Success",
                                html: "Messages sent!",
                                icon: "success",
                            });
                            if (send_type == "send-new") {
                                $('#sales_receipt_pdf_preview_modal').modal('hide');
                            } else {
                                $('#sales_receipt_pdf_preview_modal').modal('hide');
                                $('#addsalesreceiptModal').modal('hide');
                                $('#customer_receive_payment_modal').modal('hide');
                            }
                            if (receive_payment_id != "") {
                                $('#customer_receive_payment_modal form').trigger("reset");
                                get_customer_info_for_receive_payment_modal(0);
                            } else {
                                $('#addsalesreceiptModal form').trigger("reset");
                                $("#addsalesreceiptModal .modal-title .sales_receipt_number").html("");
                            }
                        } else {
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: "Error",
                                html: "Unable to send the reminder.<br>" + data.error,
                                icon: "error",
                            });
                        }

                        $("#loader-modal").hide();
                    },
                });
            }
        });
    }
});

$("#sales_receipt_pdf_preview_modal form#send_sales_receipt").submit(function(event) {
    event.preventDefault();
});


function generate_pdf(action = "") {
    var empty_flds = 0;
    $("#addsalesreceiptModal form .required").each(function() {
        if (!$.trim($(this).val())) {
            empty_flds++;
        }
    });
    if (empty_flds == 0) {

        $("#loader-modal").show();
        $("#addsalesreceiptModal .error-message-section").hide();
        $('#sales_receipt_pdf_preview_modal').modal('show');
        $.ajax({
            url: baseURL + "/accounting/addSalesReceipt",
            type: "POST",
            dataType: "json",
            data: $("#addsalesreceiptModal form").serialize(),
            success: function(data) {

                if ($("#addsalesreceiptModal form input[name='current_sales_recept_number']").val() == "") {
                    $("#saved-notification-modal-section").fadeIn();
                    $("#saved-notification-modal-section .body").slideDown("slow");
                    setTimeout(function() { $("#saved-notification-modal-section").fadeOut(); }, 2000);
                }
                $("#addsalesreceiptModal form input[name='current_sales_recept_number']").val(data.sales_receipt_id);
                $("#addsalesreceiptModal .modal-title .sales_receipt_number").html("#" + data.sales_receipt_id);

                $.ajax({
                    url: baseURL + "/accounting/view_print_sales_receipt",
                    type: "POST",
                    dataType: "json",
                    data: {
                        sales_number: $("#addsalesreceiptModal form input[name='current_sales_recept_number']").val(),
                        customer_id: $("#addsalesreceiptModal form select[name='customer_id']").val(),
                        action: action
                    },
                    success: function(data2) {

                        $("#loader-modal").hide();
                        $('#sales_receipt_pdf_preview_modal .send_sales_receipt_section').hide();
                        $("#sales_receipt_pdf_preview_modal .pdf-print-preview").html(
                            '<iframe src="' + data2.file_location + '"></iframe>');
                        $("#sales_receipt_pdf_preview_modal .pdf_preview_section .print-button").attr("href", data2.file_location);
                        $("#sales_receipt_pdf_preview_modal .pdf_preview_section .download-button").attr("href", baseURL + "accounting/download_sales_receipt/" + $("#addsalesreceiptModal form input[name='current_sales_recept_number']").val() + "/download_" + action);
                    },
                });
            },
        });
    } else {
        $("#addsalesreceiptModal .error-message-section").show();
    }
}

function setitemsr(obj, title, price, discount, itemid) {

    // alert('setitemCM');
    jQuery(obj).parent().parent().find(".getItemssr").val(title);
    jQuery(obj).parent().parent().parent().find(".pricesr").val(price);
    jQuery(obj).parent().parent().parent().find(".discountsr").val(discount);
    jQuery(obj).parent().parent().parent().find(".itemidSR").val(itemid);
    jQuery(obj).parent().parent().parent().find(".quantitysr").val(1);
    jQuery(obj).parent().parent().parent().find(".tax_change").val((price * 7.5) / 100);
    jQuery(obj).parent().parent().parent().find(".tax_hide").val(7.5);
    var withCommas = Number(price + ((price * 7.5) / 100)).toLocaleString('en');
    jQuery(obj).parent().parent().parent().find(".total_per_item").html(withCommas);
    jQuery(obj).parent().parent().parent().find(".total_per_input").val(price + ((price * 7.5) / 100));
    console.log(itemid);
    var counter = jQuery(obj)
        .parent()
        .parent()
        .parent()
        .find(".pricesr")
        .data("counter");
    jQuery(obj).parent().empty();
    calculationsr(counter);
}
$(document).on("change", "input.item-field-monitary", function(event) {
    var monitary_qty = parseFloat($(this).parent().parent().find(".quantitysr").val());
    var monitary_price = parseFloat($(this).parent().parent().find(".pricesr").val());
    var monitary_discount = parseFloat($(this).parent().parent().find(".discountsr").val());
    var monitary_tax = parseFloat($(this).parent().parent().find(".tax_change").val());
    var monitary_total = 0;
    if ($(this).data("itemfieldtype") == "tax") {
        $(this).parent().parent().find(".tax-hide").val(monitary_tax);
        var xx = ((monitary_qty * monitary_price) * monitary_tax) / 100;
        monitary_tax = xx;
    } else {
        monitary_tax = ((monitary_qty * monitary_price) * parseFloat($(this).parent().parent().find(".tax-hide").val())) / 100;
    }
    if ((monitary_qty * monitary_price) > 0) {
        monitary_total = ((monitary_qty * monitary_price) + monitary_tax) - monitary_discount;
    } else {
        $(this).parent().parent().find(".tax_change").val(0);
        monitary_total = 0;
    }
    $(this).parent().parent().find(".tax_change").val(monitary_tax);
    var withCommas = Number(monitary_total).toLocaleString('en');
    $(this).parent().parent().find(".total_per_item").html(withCommas);
    $(this).parent().parent().find(".total_per_input").val(monitary_total);
    var counter = $(this).parent().parent().find(".pricesr").data("counter");
    calculationsr(counter);
});


$(document).on("click", "#addsalesreceiptModal form .attachement-file-section button.attachment-btn", function(event) {
    // $(this).preventDefault();
    $("#addsalesreceiptModal form input[name='attachment-file']").trigger('click');
});
$(document).on("change", "div#addsalesreceiptModal form input[name='attachment-file']", function(event) {
    upload_attachment("#addsalesreceiptModal form");
});


$(document).on("click", ".remove34", function(e) {
    e.preventDefault();
    $(this).parent().parent().remove();
    var idd = this.id;
    var count = parseInt($("#count").val()) - 1;
    $("#count").val(count);
    // calculation(count);


    var in_id = idd;
    var price = $("#price_sr_" + in_id).val();
    var quantity = $("#quantity_" + in_id).val();
    var discount = $("#discount_sr_" + in_id).val();
    var tax = (parseFloat(price) * 7.5) / 100;
    var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(
        2
    );
    if (discount == '') {
        discount = 0;
    }

    var total = (
        (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
        parseFloat(discount)
    ).toFixed(2);

    // alert( 'yeah' + total);

    $("#span_total_sr_" + in_id).text(total);
    $("#sub_total_text" + in_id).val(total);
    $("#tax_1_" + in_id)
        .text(tax1);
    $("#tax1_sr_" + in_id).val(tax1);
    $("#discount_sr_" + in_id).val(discount);

    if ($('#tax_1_' + in_id).length) {
        $('#tax_1_' + in_id).val(tax1);
    }

    if ($('#item_total_sr_' + in_id).length) {
        $('#item_total_sr_' + in_id).val(total);
    }

    var eqpt_cost = 0;
    // var total_cost = 0;
    var cnt = $("#count").val();
    var total_discount = 0;
    for (var p = 0; p <= cnt; p++) {
        var prc = $("#price_sr_" + p).val();
        var quantity = $("#quantity_" + p).val();
        var discount = $("#discount_sr_" + p).val();
        // var discount= $('#discount_' + p).val();
        // eqpt_cost += parseFloat(prc) - parseFloat(discount);
        // total_cost += parseFloat(prc);
        eqpt_cost += parseFloat(prc) * parseFloat(quantity);
        total_discount += parseFloat(discount);
    }
    //   var subtotal = 0;
    // $( total ).each( function(){
    //   subtotal += parseFloat( $( this ).val() ) || 0;
    // });

    var total_cost = 0;
    // $("#span_total_0").each(function(){
    $('*[id^="price_sr_"]').each(function() {
        total_cost += parseFloat($(this).val());
    });

    var tax_tot = 0;
    $('*[id^="tax1_sr_"]').each(function() {
        tax_tot += parseFloat($(this).val());
    });

    over_tax = parseFloat(tax_tot).toFixed(2);
    // alert(over_tax);

    $("#sales_taxs").val(over_tax);
    $("#total_tax_input_sr").val(over_tax);
    $("#total_tax_sr_").text(over_tax);


    eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
    total_discount = parseFloat(total_discount).toFixed(
        2);
    stotal_cost = parseFloat(total_cost).toFixed(2);
    // var test = 5;

    var subtotal = 0;
    // $("#span_total_0").each(function(){
    $('*[id^="span_total_sr_"]').each(function() {
        subtotal += parseFloat($(this).text());
    });
    // $('#sum').text(subtotal);

    var subtotaltax = 0;
    // $("#span_total_0").each(function(){
    $('*[id^="tax_1_"]').each(function() {
        subtotaltax += parseFloat($(this).text());
    });

    // alert(subtotaltax);

    $("#eqpt_cost").val(eqpt_cost);
    $("#total_discount").val(total_discount);
    $("#span_sub_total_0").text(
        total_discount);
    $("#span_sub_total_invoice_sr").text(subtotal.toFixed(2));
    // $("#item_total").val(subtotal.toFixed(2));
    $("#item_total_sr").val(stotal_cost);

    var s_total = subtotal.toFixed(2);
    var adjustment = $("#adjustment_input_sr").val();
    var grand_total = s_total - parseFloat(adjustment);
    var markup = $("#markup_input_form").val();
    var grand_total_w = grand_total + parseFloat(markup);

    // $("#total_tax_").text(subtotaltax.toFixed(2));
    // $("#total_tax_").val(subtotaltax.toFixed(2));




    $("#grand_total_sr").text(grand_total_w.toFixed(2));
    $("#grand_total_input").val(grand_total_w.toFixed(
        2));
    $("#grand_total_sr_t").text(grand_total_w.toFixed(2));
    $("#grand_total_sr_g").val(grand_total_w
        .toFixed(2));
    $("#span_sub_total_sr").text(grand_total_w.toFixed(2));

    var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
    sls = parseFloat(sls).toFixed(2);
    $("#sales_tax")
        .val(sls);
    cal_total_due();
});


$(document).on("keyup", "#addsalesreceiptModal .items-section table input[name='items[]']", function(event) {
    var iteam_search = $(this).val();
    var suggestions = $(this).parent("td").children(".suggestions");
    get_search_items_sales_receipt(iteam_search, suggestions);
});

$(document).on("focus", "#addsalesreceiptModal .items-section table input[name='items[]']", function(event) {
    var iteam_search = $(this).val();
    var suggestions = $(this).parent("td").children(".suggestions");
    $(this).attr("autocomplete", "off");
    get_search_items_sales_receipt(iteam_search, suggestions);
});

function get_search_items_sales_receipt(iteam_search, suggestions) {
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
$(document).on("click", "#addsalesreceiptModal  .items-section table .suggestions li", function(event) {
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
    console.log($(this).parent("ul").parent("td").parent("tr").find("input[name='total[]']").val());
    $("#addsalesreceiptModal  .items-section table .suggestions").html("");
    compute_grand_total_sales_receipt();
});

$(document).on("change", "#addsalesreceiptModal  .items-section table td input", function(event) {
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
    console.log($(this).parent("td").parent("tr").find("input[name='total[]']").val());
    compute_grand_total_sales_receipt();

});


function compute_grand_total_sales_receipt() {
    var qty_array = $("#addsalesreceiptModal table tr td input[name='quantity[]']").map(function() { return $(this).val(); }).get();
    var price_array = $("#addsalesreceiptModal table tr td input[name='price[]']").map(function() { return $(this).val(); }).get();
    var discount_array = $("#addsalesreceiptModal table tr td input[name='discount[]']").map(function() { return $(this).val(); }).get();
    var tax_pecent_array = $("#addsalesreceiptModal table tr td input[name='tax_percent[]']").map(function() { return $(this).val(); }).get();
    var grand_total = 0;
    var total_taxes = 0;
    var subtotal = 0;
    for (var i = 0; i < qty_array.length; i++) {
        grand_total += ((qty_array[i] * price_array[i]) + ((qty_array[i] * price_array[i]) * (parseFloat(tax_pecent_array[i] / 100)))) - discount_array[i];
        total_taxes += ((qty_array[i] * price_array[i]) * (parseFloat(tax_pecent_array[i] / 100)));
        subtotal += (qty_array[i] * price_array[i]);
    }
    grand_total -= parseFloat($("#addsalesreceiptModal form .item-totals input[name='adjustment_value']").val().replace(/,/g, ''));
    $("#addsalesreceiptModal .item-totals .amount .subtotal").html("$" + Number(subtotal).toLocaleString('en'));
    $("#addsalesreceiptModal .item-totals .amount .taxes").html("$" + Number(total_taxes).toLocaleString('en'));
    $("#addsalesreceiptModal .item-totals .amount .grand-total").html("$" + Number(grand_total).toLocaleString('en'));
    $("#addsalesreceiptModal form input[name='grand_total']").val(grand_total);
    $("#addsalesreceiptModal form input[name='subtotal']").val(subtotal);
    $("#addsalesreceiptModal form input[name='taxes']").val(total_taxes);
    $("#addsalesreceiptModal form h2 span.grand_total_sr_t.bigdisplay").html("$" + Number(grand_total).toLocaleString('en'));
}
$(document).on("change", "#addsalesreceiptModal form .item-totals input[name='adjustment_value']", function(event) {
    if ($(this).val() == "") {
        $(this).val("0.00");
    } else {
        $(this).val(parseFloat($(this).val().replace(/,/g, '')));
        $(this).val(Number($(this).val()).toLocaleString('en'));
    }
    compute_grand_total_sales_receipt();
});
$(document).on("focus", "#addsalesreceiptModal .items-section table tr td", function(event) {

    if (!$(this).is(':last-child')) {
        if ($(this).parent("tr").is(':last-child')) {
            $("#addsalesreceiptModal .items-section table tbody").append("<tr>" + $(this).parent("tr").html() + "</tr>");
            $("#addsalesreceiptModal .items-section table tbody tr:last-child").find(".total_per_item").html("0.00");
        }
    }
});

$(document).on("click", "#addsalesreceiptModal .items-section table tr td a.delete-item", function(event) {
    if ($("#addsalesreceiptModal .items-section table tbody tr").length > 1) {
        $(this).parent("td").parent("tr").remove();
        compute_grand_total_sales_receipt();
    }
});

$(document).on("click", "#addsalesreceiptModal .item-buttons .add-lines", function(event) {
    $("#addsalesreceiptModal .items-section table tbody").append("<tr>" + $("#addsalesreceiptModal .items-section table tbody tr:last-child").html() + "</tr>");
    $("#addsalesreceiptModal .items-section table tbody tr:last-child").find(".total_per_item").html("0.00");
    $("#addsalesreceiptModal .items-section table tbody").append("<tr>" + $("#addsalesreceiptModal .items-section table tbody tr:last-child").html() + "</tr>");
    $("#addsalesreceiptModal .items-section table tbody tr:last-child").find(".total_per_item").html("0.00");
    $("#addsalesreceiptModal .items-section table tbody").append("<tr>" + $("#addsalesreceiptModal .items-section table tbody tr:last-child").html() + "</tr>");
    $("#addsalesreceiptModal .items-section table tbody tr:last-child").find(".total_per_item").html("0.00");
    $("#addsalesreceiptModal .items-section table tbody").append("<tr>" + $("#addsalesreceiptModal .items-section table tbody tr:last-child").html() + "</tr>");
    $("#addsalesreceiptModal .items-section table tbody tr:last-child").find(".total_per_item").html("0.00");
});

function clear_all_lines_sales_receipt() {
    var new_tr = "<tr>" + $("#addsalesreceiptModal .items-section table tbody tr:last-child").html() + "</tr>";
    $("#addsalesreceiptModal .items-section table tbody").html(new_tr);
    $("#addsalesreceiptModal .items-section table tbody tr:last-child").find(".total_per_item").html("0.00");
    compute_grand_total_sales_receipt();
}
$(document).on("click", "#addsalesreceiptModal .item-buttons .clear-all-lines", function(event) {
    clear_all_lines_sales_receipt();
});