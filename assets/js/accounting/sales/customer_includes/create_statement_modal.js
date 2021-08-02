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
    $("#create_statement_modal form .by-batch-satement-ids-holder").html("");
    if ($(this).attr("data-statement-modal-type") == "by-batch") {
        $("#create_statement_modal form input[name='statement-modal-type']").val($(this).attr("data-statement-modal-type"));
        var ids_holder_html = "";
        $("#customers_table tbody tr td:first-child input[type='checkbox']:checked").each(function() {
            ids_holder_html += '<input type="text" name="by_batch_ids[]" value="' + $(this).attr("data-customer-id") + '" style="display: none;">';
        });
        $("#create_statement_modal form .by-batch-ids-holder").html(ids_holder_html);
    } else {
        $("#create_statement_modal form input[name='customer_id']").val($(this).attr("data-customer-id"));
        $("#create_statement_modal form .by-batch-ids-holder").html("");
        $("#create_statement_modal form input[name='statement-modal-type']").val("");
    }

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
    $("#create_statement_modal .error-notif-section").removeClass("error-found");
    error_found = 1;
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
                $("#create_statement_modal .recipient-list-section table.receipients-list-table tbody.unavaibale_tbody").html(data.unavaibale_tbody);
                $("#create_statement_modal .recipient-list-section table.receipients-list-table tbody.available_tbody").html(data.aviable_tbody);
                $("#create_statement_modal .statement-monitary-balance .amount").html("$" + data.display_balance);
                $("#create_statement_modal .statement-monitary-balance label span").html(data.customers_with_balance_ctr);
                customer_checkbox_changed();
                error_found = 0;
                $("#create_statement_modal .error-notif-section").hide();

                $("#create_statement_modal .recipient-list-section .btns button.missing-email-address span").html(data.missing_email_ctr);
                $("#create_statement_modal .recipient-list-section .btns button.statement-available span").html(data.statement_ctr);
                $("#create_statement_modal .recipient-list-section .btns button.statement-unavailable span").html(data.missing_statements_ctr);
                $("#create_statement_modal .recipient-list-section .btns button.missing-email-address").removeClass("initial");
                $("#create_statement_modal .recipient-list-section .btns button.statement-unavailable").removeClass("initial");
                if (data.missing_statements_ctr > 0) {
                    create_statement_modal_receipients_list_table_changed("statement-unavailable", "unavaibale_tbody");
                    $("#create_statement_modal .recipient-list-section .btns button.statement-unavailable").addClass("initial");
                    error_found = 1;
                    $("#create_statement_modal .error-notif-section").show();
                    $("#create_statement_modal .error-notif-section .title span").html("Can’t create all statements");
                    $("#create_statement_modal .error-notif-section .message").html(data.missing_statements_ctr + " of " + data.total_number_of_customer + " customers have no statements for this date. Adjust the date, or click Save to create statements for the other " + (data.total_number_of_customer - data.missing_statements_ctr) + ". To see customers for whom statements are not generated, update the filter above the grid.");
                } else {
                    $("#create_statement_modal .recipient-list-section .btns button.missing-email-address").addClass("initial");
                    create_statement_modal_receipients_list_table_changed("missing-email-address", "available_tbody");
                    create_statement_modal_receipients_list_table_changed("statement-available", "available_tbody");
                }
            }

        },
    });
});

$(document).on("click", "div#create_statement_modal .modal-footer-check button[data-action='clear']", function(event) {
    date_range_changed();
});
$('div#create_statement_modal').on('hidden.bs.modal', function() {
    date_range_changed();
    $("#create_statement_modal form .by-batch-satement-ids-holder").html("");
    $("#create_statement_modal form .by-batch-ids-holder").html("");
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
    $("#create_statement_modal .error-notif-section").hide();
    $("#create_statement_modal .error-notif-section").removeClass("error-found");
    error_found = 1;
    customer_checkbox_changed();
}

$("#create_statement_modal form").submit(function(event) {
    event.preventDefault();
});
$(document).on("click", "#create_statement_modal form button[type='submit']", function(event) {
    $("#create_statement_modal .error-notif-section").removeClass("error-found");
    var submit_type = $(this).attr("data-submit-type");
    var missing_email_ctr = 0;
    var total_number_of_customer = 0;

    $("#create_statement_modal form .receipients-list-table tbody.available_tbody input[name='emails[]']").map(function() {
        total_number_of_customer++;
        if ($(this).val() == "" && $(this).closest("tr").find("input[name='customer_checkbox[]']").is(":checked")) {
            missing_email_ctr++;
        }
    }).get();
    if (missing_email_ctr > 0) {
        $("#create_statement_modal .error-notif-section").show();
        $("#create_statement_modal .error-notif-section").addClass("error-found");
        $("#create_statement_modal .error-notif-section .title span").html("Missing email addresses");
        $("#create_statement_modal .error-notif-section .message").html("Some statements are missing email addresses. Uncheck recipients to save statements without sending or enter email addresses.");
    }
    if ($("#create_statement_modal form input[name='customer_checkbox[]']:checked").length == 0) {
        $("#create_statement_modal .error-notif-section").show();
        $("#create_statement_modal .error-notif-section").addClass("error-found");
        $("#create_statement_modal .error-notif-section .title span").html("Error");
        $("#create_statement_modal .error-notif-section .message").html("Select at least one recipient before attempting to save.");
    }
    if ($("#create_statement_modal .recipient-list-section .btns button.statement-unavailable span").html() != "0") {
        $("#create_statement_modal .error-notif-section").removeClass("error-found");
        $("#create_statement_modal .error-notif-section .title span").html("Can’t create all statements");
        $("#create_statement_modal .error-notif-section .message").html("Adjust the date, or click Save to create statements for the other 1. To see customers for whom statements are not generated, update the filter above the grid.");
    }
    if (error_found == 0 && missing_email_ctr == 0 && $("#create_statement_modal form input[name='customer_checkbox[]']:checked").length > 0) {
        $("#create_statement_modal .error-notif-section").hide();
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
                    $("#create_statement_modal form .by-batch-satement-ids-holder").html(data.statement_ids_holder_html);
                    if (submit_type == "print") {
                        $("#statement_pdf_preview_modal").modal("show");
                        $("#statement_pdf_preview_modal h5.modal-title").html("Print Statement");
                        $("#statement_pdf_preview_modal .send_statement_section").hide();
                        $("#statement_pdf_preview_modal .pdf_preview_section").show();
                        $("#statement_pdf_preview_modal .pdf_preview_section .pdf-print-preview").html('<iframe src="' + data.file_location + '"></iframe>');
                        $("#statement_pdf_preview_modal .pdf_preview_section .print-button").attr("href", data.file_location);
                    } else if (submit_type == "save-send") {

                        var emails = "";
                        $("#create_statement_modal form .receipients-list-table tbody.available_tbody input[name='emails[]']").map(function() {
                            if ($(this).closest("tr").find("input[name='customer_checkbox[]']").is(":checked")) {
                                emails += $(this).val() + ";";
                            }
                        }).get();
                        $("#statement_pdf_preview_modal form input[name='email']").val(emails);
                        $("#statement_pdf_preview_modal").modal("show");
                        $("#statement_pdf_preview_modal h5.modal-title").html("Send Statement");
                        $("#statement_pdf_preview_modal .send_statement_section").show();
                        $("#statement_pdf_preview_modal .pdf_preview_section").hide();
                        $("#statement_pdf_preview_modal .send_statement_section .send_sales_receipt-preview").html('<iframe src="' + data.file_location + '"></iframe>');
                        $("#statement_pdf_preview_modal .send_statement_section .send-button").attr("href", data.file_location);
                        $("#statement_pdf_preview_modal form input[name='subject']").val("Statement from " + data.business_name);
                        $("#statement_pdf_preview_modal form input[name='file_name_ids']").val(data.file_name_ids);
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


$(document).on("click", "#create_statement_modal .recipient-list-section .btns button.missing-email-address", function(event) {
    create_statement_modal_receipients_list_table_changed("missing-email-address", "missing_email_tbody");
});
$(document).on("click", "#create_statement_modal .recipient-list-section .btns button.statement-unavailable", function(event) {
    create_statement_modal_receipients_list_table_changed("statement-unavailable", "unavaibale_tbody");
});
$(document).on("click", "#create_statement_modal .recipient-list-section .btns button.statement-available", function(event) {
    create_statement_modal_receipients_list_table_changed("statement-available", "available_tbody");
});

function create_statement_modal_receipients_list_table_changed(button_class, tbody_class) {
    $("#create_statement_modal .recipient-list-section table.receipients-list-table tbody.available_tbody").hide();
    $("#create_statement_modal .recipient-list-section table.receipients-list-table tbody.unavaibale_tbody").hide();
    $("#create_statement_modal .recipient-list-section .btns button.missing-email-address").removeClass("active");
    $("#create_statement_modal .recipient-list-section .btns button.statement-unavailable").removeClass("active");
    $("#create_statement_modal .recipient-list-section .btns button.statement-available").removeClass("active");

    $("#create_statement_modal .recipient-list-section table.receipients-list-table tbody." + tbody_class).show();
    $("#create_statement_modal .recipient-list-section .btns button." + button_class).addClass("active");
    if (tbody_class == "unavaibale_tbody") {
        $("#create_statement_modal .recipient-list-section table.receipients-list-table .column-email").hide();
        $("#create_statement_modal .recipient-list-section table.receipients-list-table .column-check_box").hide();
    } else {
        $("#create_statement_modal .recipient-list-section table.receipients-list-table .column-email").show();
        $("#create_statement_modal .recipient-list-section table.receipients-list-table .column-check_box").show();
    }
    if (button_class == "missing-email-address") {
        $("#create_statement_modal form .receipients-list-table tbody.available_tbody tr").hide();
        $("#create_statement_modal form .receipients-list-table tbody.available_tbody tr.missing-email").show();
        $("#create_statement_modal .recipient-list-section table.receipients-list-table tbody.available_tbody").show();
    } else {
        $("#create_statement_modal form .receipients-list-table tbody.available_tbody tr").show();
    }
}