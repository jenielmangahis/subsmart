$("#addsalesreceiptModal form").submit(function(event) {
    event.preventDefault();
});
$(document).on("click", "#addsalesreceiptModal form button[type='submit']", function(event) {
    var submit_type = $(this).attr("data-submit-type");
    save_sales_receipt(submit_type, this);
});
$(document).on("click", "#addsalesreceiptModal .modal-footer-check  #closeCheckModal", function() {
    $("#addsalesreceiptModal").modal('hide');
});

function save_sales_receipt(submit_type, element) {
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
                        if (submit_type == "save-send" && data.email_sending_status ==
                            "success") {
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: "Success",
                                html: "Sales receipt has been saved and sent.",
                                icon: "success",
                            });
                        } else {
                            $("#saved-notification-modal-section").fadeIn();
                            $("#saved-notification-modal-section .body").slideDown("slow");
                            setTimeout(function() { $("#saved-notification-modal-section").fadeOut(); }, 2000);
                        }
                        $("#addsalesreceiptModal form input[name='current_sales_recept_number']").val(data.sales_receipt_id);
                        $("#addsalesreceiptModal .modal-title .sales_receipt_number").html("#" + data.sales_receipt_id);
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
                        $('#addsalesreceiptModal form').trigger("reset");
                    } else if (submit_type == "save-close") {
                        $("#addsalesreceiptModal").modal('hide');
                    }
                    $("#loader-modal").hide();
                },
            });
        }
    });
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
    $("#addsalesreceiptModal form input[name='recurring-template-name']").val($("#addsalesreceiptModal form #sel-customer2 option:selected").text());
    $("#addsalesreceiptModal #grand_total_sr_t").addClass("hidden");
    $("#addsalesreceiptModal .label-grand_total_sr_t").addClass("hidden");
});
$(document).on("click", "#addsalesreceiptModal .modal-footer-check #clearsalereceipt", function(event) {
    event.preventDefault();
    var recurring_selected = $("#addsalesreceiptModal form input[name='recurring_selected']").val();
    $('#addsalesreceiptModal form').trigger("reset");
    $("#addsalesreceiptModal form textarea").html("");
    $("#addsalesreceiptModal form input[name='recurring_selected']").val(recurring_selected);
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
    $("#addsalesreceiptModal .modal-footer-check #cancel_recurring").hide();
    $("#addsalesreceiptModal .recurring-form-part").hide();
    $("#addsalesreceiptModal .modal-footer-check .middle-links").show();
    $("#addsalesreceiptModal .modal-footer-check #closeCheckModal").show();
    $("#addsalesreceiptModal form input[name='recurring_selected']").val("");
    $("#addsalesreceiptModal .customer-info").removeClass("recurring-customer-info");
    $('#addsalesreceiptModal form').trigger("reset");
    $("#addsalesreceiptModal #grand_total_sr_t").removeClass("hidden");
    $("#addsalesreceiptModal .label-grand_total_sr_t").removeClass("hidden");
})


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


function generate_pdf(action = "") {

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
                    $("#sales_receipt_pdf_preview_modal .pdf-print-preview").html(
                        '<iframe src="' + data2.file_location + '"></iframe>');
                    $("#sales_receipt_pdf_preview_modal .print-button").attr("href", data2.file_location);
                    $("#sales_receipt_pdf_preview_modal .download-button").attr("href", baseURL + "accounting/download_sales_receipt/" + $("#addsalesreceiptModal form input[name='current_sales_recept_number']").val() + "/download_" + action);
                },
            });
        },
    });
}