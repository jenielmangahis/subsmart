$('#create_invoice_modal').on('hidden.bs.modal', function() {
    // do something…
    $("div#customer_receive_payment_modal .payment_method_information").html("");
    $("div#addsalesreceiptModal .payment_method_information").html("");
    $("div#create_invoice_modal .payment_method_information").html("");
})
$(document).on("change", "div#create_invoice_modal form select[name='payment_method']", function(event) {
    $("div#customer_receive_payment_modal .payment_method_information").html("");
    $("div#addsalesreceiptModal .payment_method_information").html("");
    $("div#create_invoice_modal .payment_method_information").html("");

    $("div#create_invoice_modal .payment_method_information").html(payment_method_information);
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
$("#create_invoice_modal form").submit(function(event) {
    event.preventDefault();
});
$(document).on("click", "#create_invoice_modal form button[type='submit']", function(event) {
    var submit_type = $(this).attr("data-submit-type");
    save_estimate_created(submit_type, this);
});
$(document).on("click", "#create_invoice_modal .modal-footer-check  #closeCheckModal", function() {
    $("#create_invoice_modal").modal('hide');
});



function save_estimate_created(submit_type, element) {
    var empty_flds = 0;
    $("#create_invoice_modal form .required").each(function() {
        if (!$.trim($(this).val())) {
            empty_flds++;
        }
    });
    if (empty_flds == 0) {

        $("#create_invoice_modal .error-message-section").hide();
        $("#create_invoice_modal form input[name='submit_type']").val(submit_type);
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
                    data: $("#create_invoice_modal form").serialize(),
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
                            $("#create_invoice_modal form input[name='current_sales_recept_number']").val(data.sales_receipt_id);
                            $("#create_invoice_modal .modal-title .sales_receipt_number").html("#" + data.sales_receipt_id);
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
                            $('#create_invoice_modal form').trigger("reset");
                            $("#create_invoice_modal .modal-title .sales_receipt_number").html("");
                        } else if (submit_type == "save-close") {
                            $("#create_invoice_modal").modal('hide');
                            $('#create_invoice_modal form').trigger("reset");
                            $("#create_invoice_modal .modal-title .sales_receipt_number").html("");
                        }
                        $("#loader-modal").hide();
                    },
                });
            }
        });
    } else {
        $("#create_invoice_modal .error-message-section").show();
    }
}
$(document).on("change", "#create_invoice_modal .recurring-form-part.below .date-part .input-field-2 select", function(event) {
    $("#create_invoice_modal .recurring-form-part.below .date-part .input-field-3 .by-end-date").hide();
    $("#create_invoice_modal .recurring-form-part.below .date-part .input-field-3 .after-occurrences").hide();
    if ($(this).val() == "By") {
        $("#create_invoice_modal .recurring-form-part.below .date-part .input-field-3 .by-end-date").show();
    } else if ($(this).val() == "After") {
        $("#create_invoice_modal .recurring-form-part.below .date-part .input-field-3 .after-occurrences").show();
    }
});

$(document).on("change", "#create_invoice_modal select[name='recurring-interval']", function(event) {
    $("#create_invoice_modal .recurring-form-part.below .interval-part .monthly").hide();
    $("#create_invoice_modal .recurring-form-part.below .interval-part .daily").hide();
    $("#create_invoice_modal .recurring-form-part.below .interval-part .weekly").hide();
    $("#create_invoice_modal .recurring-form-part.below .interval-part .yearly").hide();
    if ($(this).val() == "Daily") {
        $("#create_invoice_modal .recurring-form-part.below .interval-part .daily").show();
    } else if ($(this).val() == "Weekly") {
        $("#create_invoice_modal .recurring-form-part.below .interval-part .weekly").show();
    } else if ($(this).val() == "Monthly") {
        $("#create_invoice_modal .recurring-form-part.below .interval-part .monthly").show();
    } else if ($(this).val() == "Yearly") {
        $("#create_invoice_modal .recurring-form-part.below .interval-part .yearly").show();
    }
});

$(document).on("change", "#create_invoice_modal select[name='recurring-type']", function(event) {
    $("#create_invoice_modal .recurring-form-part .schedule-type").hide();
    $("#create_invoice_modal .recurring-form-part .reminder-type").hide();
    $("#create_invoice_modal .recurring-form-part .unschedule-type").hide();
    if ($(this).val() == "Schedule") {
        $("#create_invoice_modal .recurring-form-part .schedule-type").show();
        $("#create_invoice_modal .recurring-form-part.below ").show();
    } else if ($(this).val() == "Reminder") {
        $("#create_invoice_modal .recurring-form-part .reminder-type").show();
        $("#create_invoice_modal .recurring-form-part.below ").show();
    } else if ($(this).val() == "Unschedule") {
        $("#create_invoice_modal .recurring-form-part .unschedule-type").show();
        $("#create_invoice_modal .recurring-form-part.below ").hide();
    }
});

$(document).on("click", "#create_invoice_modal .modal-footer-check .middle-links.end a", function(event) {
    event.preventDefault();
    $("#create_invoice_modal .recurring-form-part").show();
    $("#create_invoice_modal .modal-footer-check .middle-links").hide();
    $("#create_invoice_modal .modal-footer-check #cancel_recurring").show();
    $("#create_invoice_modal .modal-footer-check #closeCheckModal").hide();
    $("#create_invoice_modal form input[name='recurring_selected']").val(1);
    $("#create_invoice_modal .customer-info").addClass("recurring-customer-info");
    $("#create_invoice_modal form input[name='recurring-template-name']").val($("#create_invoice_modal form #sel-customer2 option:selected").attr("data-text"));
    $("#create_invoice_modal #grand_total_sr_t").addClass("hidden");
    $("#create_invoice_modal .label-grand_total_sr_t").addClass("hidden");
    $("#create_invoice_modal .error-message-section").hide();
});
$(document).on("click", "#create_invoice_modal .modal-footer-check #clearsalereceipt", function(event) {
    event.preventDefault();
    var recurring_selected = $("#create_invoice_modal form input[name='recurring_selected']").val();
    $('#create_invoice_modal form').trigger("reset");
    $("#create_invoice_modal form textarea").html("");
    $("#create_invoice_modal form input[name='recurring_selected']").val(recurring_selected);
});

$(document).on("click", "#create_invoice_modal .modal-footer-check #cancel_recurring", function(event) {
    event.preventDefault();
    $("#create_invoice_modal .modal-footer-check #cancel_recurring").hide();
    $("#create_invoice_modal .recurring-form-part").hide();
    $("#create_invoice_modal .modal-footer-check .middle-links").show();
    $("#create_invoice_modal .modal-footer-check #closeCheckModal").show();
    $("#create_invoice_modal form input[name='recurring_selected']").val("");
    $("#create_invoice_modal .customer-info").removeClass("recurring-customer-info");
    $("#create_invoice_modal #grand_total_sr_t").removeClass("hidden");
    $("#create_invoice_modal .label-grand_total_sr_t").removeClass("hidden");
});
$('#create_invoice_modal').on('hidden.bs.modal', function() {
    $("#create_invoice_modal .modal-footer-check #cancel_recurring").hide();
    $("#create_invoice_modal .recurring-form-part").hide();
    $("#create_invoice_modal .modal-footer-check .middle-links").show();
    $("#create_invoice_modal .modal-footer-check #closeCheckModal").show();
    $("#create_invoice_modal form input[name='recurring_selected']").val("");
    $("#create_invoice_modal .customer-info").removeClass("recurring-customer-info");
    $('#create_invoice_modal form').trigger("reset");
    $("#create_invoice_modal #grand_total_sr_t").removeClass("hidden");
    $("#create_invoice_modal .label-grand_total_sr_t").removeClass("hidden");
    $("#create_invoice_modal .modal-title .sales_receipt_number").html("");
});
$('#sales_receipt_pdf_preview_modal').on('hidden.bs.modal', function() {
    $('#sales_receipt_pdf_preview_modal .pdf_preview_section').show();
    $('#sales_receipt_pdf_preview_modal .modal-title').html("Print preview");
    $('#sales_receipt_pdf_preview_modal .send_sales_receipt_section').hide();
    $('#sales_receipt_pdf_preview_modal form').trigger("reset");
});


$(document).on("click", function(event) {
    if ($(event.target).closest("#create_invoice_modal .modal-footer-check .middle-links .print-preview-option").length === 0) {
        $("#create_invoice_modal .pint-preview-option-section").hide();
    }
});

$(document).on("click", "#create_invoice_modal .modal-footer-check .middle-links .print-preview-option", function(event) {
    event.preventDefault();
    $("#create_invoice_modal .pint-preview-option-section").show();
    $('#myModal').modal('show');
});

$(document).on("click", "#create_invoice_modal .pint-preview-option-section .print-preview", function(event) {
    event.preventDefault();

});

$(document).on("click", "#create_invoice_modal .pint-preview-option-section .print-slip", function(event) {
    event.preventDefault();

});


$(document).on("click", "#create_invoice_modal form .ship-to-btn", function(event) {
    event.preventDefault();
    $(this).hide();
    $("#create_invoice_modal form .ship-to-section").show();
    $("#create_invoice_modal form .remove-padding-not-ship").removeClass("padding-top-70");
});
$(document).on("click", ".first-option.customer_craete_invoice_btn", function(event) {
    event.preventDefault();
    $('#create_invoice_modal').modal('toggle');
});