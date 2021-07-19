var error_found = 0;
$(document).on("click", "#create_statement_modal .apply-btn-part .information-panel .close-panel", function(event) {
    $("#create_statement_modal .apply-btn-part .information-panel").hide();
});
$('#create_statement_modal').on('shown.bs.modal', function(e) {
    $("#create_statement_modal .recipient-list-section").hide();
    $("#create_statement_modal .apply-btn-part .information-panel").show();
    error_found = 1;
})

$(document).on("click", ".created-statement-btn", function(event) {
    $("#create_statement_modal form input[name='customer_id']").val($(this).attr("data-customer-id"));
});
$(document).on("change", "#create_statement_modal form input[name='customer_checkbox[]']", function(event) {
    customer_checkbox_changed();
});
$(document).on("change", "#create_statement_modal form input[name='customer_checkbox_all']", function(event) {
    customer_checkbox_all_changed();
});
$(document).on("change", "#create_statement_modal form input[name='start_date']", function(event) {
    date_range_changed();
});
$(document).on("change", "#create_statement_modal form input[name='end_date']", function(event) {
    date_range_changed();
});

$(document).on("change", "#create_statement_modal form select[name='statement_type']", function(event) {
    var statement_type = $("#create_statement_modal form select[name='statement_type']").val();
    $("#create_statement_modal .error-notif-section").hide();
    if (statement_type == "Open Item") {
        $("#create_statement_modal .start-end-date-section").hide();
        $("#create_statement_modal .start-end-date-section.button-section").show();
        $("#create_statement_modal .recipient-list-section").hide();
        $("#create_statement_modal .apply-btn-part .information-panel").hide();
    } else {
        $("#create_statement_modal .start-end-date-section").show();
        $("#create_statement_modal .start-end-date-section.button-section").show();
        $("#create_statement_modal .recipient-list-section").hide();
        $("#create_statement_modal .apply-btn-part .information-panel").show();
    }
});

$(document).on("click", "div#create_statement_modal .start-end-date-section .apply-btn-part .apply-btn", function(event) {
    var statement_type = $("#create_statement_modal form select[name='statement_type']").val();
    $.ajax({
        url: baseURL + "/accounting/create_statement_get_result_by_customer",
        type: "POST",
        dataType: "json",
        data: $("#create_statement_modal form").serialize(),
        success: function(data) {
            if (data.result) {
                $("#create_statement_modal .recipient-list-section").show();
                $("#create_statement_modal .apply-btn-part .information-panel").hide();
                $("#create_statement_modal .recipient-list-section table.receipients-list-table tbody").html(data.tbody);
                $("#create_statement_modal .statement-monitary-balance .amount").html("$" + data.display_balance);
                customer_checkbox_changed();
                if (statement_type == "Transaction Statement") {
                    if (data.transaction_count > 0) {
                        error_found = 0;
                        $("#create_statement_modal .error-notif-section").hide();
                    } else {
                        error_found = 1;
                        $("#create_statement_modal .error-notif-section").show();
                    }
                } else if (statement_type == "Open Item") {
                    if (data.balance > 0) {
                        error_found = 0;
                        $("#create_statement_modal .error-notif-section").hide();
                        $("#create_statement_modal .error-notif-section .message").html("No Statements to Save");
                    } else {
                        error_found = 1;
                        $("#create_statement_modal .error-notif-section").show();
                        $("#create_statement_modal .error-notif-section .message").html("No open item found.");
                    }
                }
            }

        },
    });
});

function customer_checkbox_all_changed() {
    if ($("#create_statement_modal form input[name='customer_checkbox_all']").is(":checked")) {
        $("#create_statement_modal form input[name='customer_checkbox[]']").prop("checked", true);
    } else {
        $("#create_statement_modal form input[name='customer_checkbox[]']").prop("checked", false);
    }
}

function customer_checkbox_changed() {
    // var customer_checkbox_values = $("#create_statement_modal form input[name='customer_checkbox[]']")
    //     .map(function() { return $(this).val(); }).get();
    var number_of_checked = $("#create_statement_modal form input[name='customer_checkbox[]']:checked").length;
    var number_of_customer = $("#create_statement_modal form input[name='customer_checkbox[]']").length;
    if (number_of_checked == number_of_customer) {
        $("#create_statement_modal form input[name='customer_checkbox_all']").prop("checked", true);
    } else {
        $("#create_statement_modal form input[name='customer_checkbox_all']").prop("checked", false);
    }
}

function date_range_changed() {
    $("#create_statement_modal .apply-btn-part .information-panel").show();
    $("#create_statement_modal .recipient-list-section table.receipients-list-table tbody").html("");
    $("#create_statement_modal .statement-monitary-balance .amount").html("$0.00");
    $("#create_statement_modal .recipient-list-section").hide();
    customer_checkbox_changed();
}

$("#create_statement_modal form").submit(function(event) {
    event.preventDefault();
});
$(document).on("click", "#create_statement_modal form button[type='submit']", function(event) {
    var submit_type = $(this).attr("data-submit-type");
    if (error_found == 0) {
        $("#loader-modal").show();
        $.ajax({
            url: baseURL + "/accounting/save_created_statement",
            type: "POST",
            dataType: "json",
            data: $("#create_statement_modal form").serialize(),
            success: function(data) {
                if (data.result) {
                    $("#loader-modal").hide();
                    $("#create_statement_modal form input[name='customer_id']").val(data.customer_id);
                    $("#create_statement_modal form input[name='current_statement_id']").val(data.statement_id);
                    if (submit_type == "print") {
                        $("#statement_pdf_preview_modal").modal("show");
                        $("#statement_pdf_preview_modal h5.modal-title").html("Print Statement");
                        $("#statement_pdf_preview_modal .send_statement_section").hide();
                        $("#statement_pdf_preview_modal .pdf_preview_section").show();
                        $("#statement_pdf_preview_modal .pdf_preview_section .pdf-print-preview").html('<iframe src="' + data.file_location + '"></iframe>');
                        $("#statement_pdf_preview_modal .pdf_preview_section .print-button").attr("href", data.file_location);
                    } else if (submit_type == "save-send") {
                        $("#statement_pdf_preview_modal").modal("show");
                        $("#statement_pdf_preview_modal h5.modal-title").html("Send Statement");
                        $("#statement_pdf_preview_modal .send_statement_section").show();
                        $("#statement_pdf_preview_modal .pdf_preview_section").hide();
                        $("#statement_pdf_preview_modal .send_statement_section .send_sales_receipt-preview").html('<iframe src="' + data.file_location + '"></iframe>');
                        $("#statement_pdf_preview_modal .send_statement_section .send-button").attr("href", data.file_location);
                        $("#statement_pdf_preview_modal form input[name='subject']").val("Statement from " + data.business_name);
                        $("#statement_pdf_preview_modal form input[name='statement_id']").val(data.statement_id);
                        $("#statement_pdf_preview_modal form input[name='statement_type']").val(data.statement_type);
                        $("#statement_pdf_preview_modal form input[name='customer_id']").val(data.customer_id);
                        $("#statement_pdf_preview_modal form textarea[name='body']").html('Dear ' + data.customer_full_name + `,

Your statement is in link below. Please remit payment at your earliest convenience. 

Thank you for your business - we appreciate it very much.

Have a great day,
` + data.business_name);
                    } else if (submit_type == "save") {
                        Swal.fire({
                            showConfirmButton: false,
                            timer: 2000,
                            title: "Saved",
                            html: "Statement has been saved",
                            icon: "success",
                        });
                    }
                }

            },
        });
    }
});
$("#statement_pdf_preview_modal form#send_statement").submit(function(event) {
    event.preventDefault();
});

$(document).on("click", "#statement_pdf_preview_modal form#send_statement button[type='submit']", function(event) {

    var send_type = $(this).attr(" ");
    var empty_flds = 0;
    $("#statement_pdf_preview_modal form#send_statement .required").each(function() {
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
                $.ajax({
                    url: baseURL + "/accounting/send_email_statement",
                    type: "POST",
                    dataType: "json",
                    data: $("#statement_pdf_preview_modal form#send_statement").serialize(),
                    success: function(data) {
                        if (data.status == "success") {
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: "Success",
                                html: "Messages sent!",
                                icon: "success",
                            });
                            $('#statement_pdf_preview_modal').modal('hide');
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