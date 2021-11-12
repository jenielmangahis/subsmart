$(document).on("click", function(event) {
    if ($(event.target).closest("div#invoice-viewer-modal .the-modal-body.right-side-modal .the-modal-footer .button-dropdown-options").length === 0) {
        $("div#invoice-viewer-modal .the-modal-body.right-side-modal .the-modal-footer .button-dropdown-options .options").hide();
    } else {
        $("div#invoice-viewer-modal .the-modal-body.right-side-modal .the-modal-footer .button-dropdown-options .options").show();
    }

});
$(document).on('change', '.invoices-page-section table.invoices-table th input.select-all', function() {
    if ($(".invoices-page-section table.invoices-table th input.select-all").is(':checked')) {
        $(".invoices-page-section table.invoices-table tbody tr td input[type='checkbox']").prop("checked", true);
    } else {
        $(".invoices-page-section table.invoices-table tbody tr td input[type='checkbox']").prop("checked", false);
    }
    invoice_page_table_checkbox_changes();
    invoice_page_send_reminder_checker();
});
$(document).on('change', ".invoices-page-section table.invoices-table tbody tr td input[type='checkbox']", function() {
    if ($(".invoices-page-section table.invoices-table tbody tr td input[type='checkbox']:checked").length == $(".invoices-page-section table.invoices-table tbody tr td input[type='checkbox']").length) {
        $(".invoices-page-section table.invoices-table th input.select-all").prop("checked", true);
    } else {
        $(".invoices-page-section table.invoices-table th input.select-all").prop("checked", false);
    }
    invoice_page_table_checkbox_changes();
    invoice_page_send_reminder_checker();
});

function invoice_page_table_checkbox_changes() {
    if ($(".invoices-page-section table.invoices-table tbody tr td input[type='checkbox']:checked").length == 0) {
        $(".invoices-page-section .by-batch-btn button.btn-default").addClass("disabled");
        $(".invoices-page-section .by-batch-btn ul.by-batch-btn li").addClass("disabled");
    } else {
        $(".invoices-page-section .by-batch-btn ul.by-batch-btn li").removeClass("disabled");
        $(".invoices-page-section .by-batch-btn button.btn-default").removeClass("disabled");
    }
}
$(document).on('change', '.invoices-page-section .filtering select', function() {
    invoices_filter_changed();
});
invoices_filter_changed();

function invoices_filter_changed() {
    $(".invoices-page-section table tbody").html("<tr><td colspan='8' style='text-align:center;color: #C7C7C7;'><center><img src='" + baseURL + "assets/img/accounting/customers/loader.gif' style='width:50px;' /></center></td></tr>");
    $.ajax({
        url: baseURL + "/accounting/filter/invoices-page",
        type: "POST",
        dataType: "json",
        data: {
            status: $(".invoices-page-section .filtering select.status").val(),
            date_range: $(".invoices-page-section .filtering select.date_range").val(),
        },
        success: function(data) {
            $(".invoices-page-section table.invoices-table th input.select-all").prop("checked", false);
            if (data.the_html_tbody == "") {
                $(".invoices-page-section table tbody").html("<tr><td colspan='8' style='text-align:center;color: #C7C7C7;'><center>No data found.</center></td></tr>");
            } else {
                $(".invoices-page-section table tbody").html(data.the_html_tbody);
            }
        },
    });
}
$(document).on('click', '#invoice-reminder-modal .form-group label span.cc-bcc', function() {
    $("#invoice-reminder-modal form .cc-bcc-section").fadeIn();
    $("#invoice-reminder-modal .form-group label span.cc-bcc").addClass("show");
});
$(document).on('click', '#invoice-reminder-modal .form-group label span.cc-bcc.show', function() {
    $("#invoice-reminder-modal form .cc-bcc-section").fadeOut();
    $("#invoice-reminder-modal .form-group label span.cc-bcc").removeClass("show");
});

function invoice_page_send_reminder_checker() {
    if ($(".invoices-page-section table.invoices-table tbody tr td input[type='checkbox']:checked").length == 1) {
        var status = $(".invoices-page-section table.invoices-table tbody tr td input[type='checkbox']:checked").attr("data-status");
        if (status != "Paid" && status != "Draft" && status != "Submitted" && status != "Declined" && status != "Scheduled") {
            $(".invoices-page-section .by-batch-btn .dropdown-menu li.send-reminder-btn").removeClass("disabled");
        } else {
            $(".invoices-page-section .by-batch-btn .dropdown-menu li.send-reminder-btn").addClass("disabled");
        }
    } else {
        $(".invoices-page-section .by-batch-btn .dropdown-menu li.send-reminder-btn").addClass("disabled");
    }
}

$(document).on('click', '.invoices-page-section .by-batch-btn .dropdown-menu li.send-reminder-btn', function() {
    if (!$(this).hasClass("disabled")) {
        $("div#invoice-reminder-modal").fadeIn();
        var invoice_number = $(".invoices-page-section table.invoices-table tbody tr td input[type='checkbox']:checked").attr("data-invoice-number");
        $("#invoice-reminder-modal form").trigger("reset");
        var status = $(".invoices-page-section table.invoices-table tbody tr td input[type='checkbox']:checked").attr("data-status");
        var invoice_id = $(".invoices-page-section table.invoices-table tbody tr td input[type='checkbox']:checked").attr("data-invoice-id");
        $.ajax({
            url: baseURL + "invoice-page/get/send-invoice-reminder",
            type: "POST",
            dataType: "json",
            data: {
                customer_id: $(".invoices-page-section table.invoices-table tbody tr td input[type='checkbox']:checked").attr("data-customer-id"),
                company_id: $(".invoices-page-section table.invoices-table tbody tr td input[type='checkbox']:checked").attr("data-company-id"),
                invoice_id: invoice_id
            },
            success: function(data) {
                $("#invoice-reminder-modal .pdf-frame").html(`<iframe
                src="` + data.filelocation + `"
                class="the-file" frameborder="0"></iframe>`);
                $("#invoice-reminder-modal .form-group select[name='from']").html("<option selected value='" + data.business_email + "'>" + data.business_name + " (" + data.business_email + ")</option>");
                $("#invoice-reminder-modal .form-group input[name='to']").val(data.acs_email);
                $("#invoice-reminder-modal  input[name='invoice_id']").val(invoice_id);
                $("#invoice-reminder-modal .form-group input[name='subject']").val("Reminder: Your payment to " + data.business_name + " is " + status);
                $("#invoice-reminder-modal .form-group label[for='send_me_copy']").attr("data-user-email", data.user_email);
                $("#invoice-reminder-modal .the-title span").html(invoice_number);
                $("#invoice-reminder-modal .form-group textarea[name='email-body']").html(`Dear ` + data.firstname + " " + data.lastname + `,

We're sending a reminder to let you know that invoice [` + invoice_number + `] has not been paid. If you already paid this invoice or have any questions, let us know!
                
Have a great day!
` + data.business_name);
            },
        });
    }
});
$(document).on('click', '#invoice-reminder-modal .the-modal-body .the-close', function() {
    $("div#invoice-reminder-modal").fadeOut();
});

$(document).on('change', '#invoice-reminder-modal .form-group input[name="send_me_copy"]', function() {
    if ($(this).is(':checked')) {
        $("#invoice-reminder-modal .form-group input[name='bcc']").val($("#invoice-reminder-modal .form-group label[for='send_me_copy']").attr("data-user-email"));
    } else {
        $("#invoice-reminder-modal .form-group input[name='bcc']").val("");
    }

});

$(document).on("click", "#invoice-reminder-modal form button[type='submit']", function(event) {
    var empty_flds = 0;
    $("#invoice-reminder-modal form .required").each(function() {
        if (!$.trim($(this).val())) {
            empty_flds++;
        }
    });
    if (empty_flds == 0) {
        event.preventDefault();
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
                    url: baseURL + "invoice-page/send/send-invoice-reminder",
                    type: "POST",
                    dataType: "json",
                    data: $("#invoice-reminder-modal form").serialize(),
                    success: function(data) {
                        $("#loader-modal").hide();
                        if (data.status == "success") {
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: "Success",
                                html: "Customer reminder has been sent",
                                icon: "success",
                            });
                        } else {
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: "Error",
                                html: "Unable to send the reminder.<br>" + data.error,
                                icon: "error",
                            });
                        }
                    },
                });

            }
        });
    }
});
$(document).on('click', '.invoices-page-section .by-batch-btn .dropdown-menu li.print-btn', function() {
    if ($(".invoices-page-section table.invoices-table tbody tr td input[type='checkbox']:checked").length > 0) {
        $("#loader-modal").show();
        $.ajax({
            url: baseURL + "invoice-page/print-batch",
            type: "POST",
            dataType: "json",
            data: $("form.invoice-table-form").serialize(),
            success: function(data) {
                $("#batch-print-iframe-section").html('<iframe id="the-batch-iframe" src="' + baseURL + data.filelocation + '"class="the-file" frameborder="0"></iframe>');
                var PDF = document.getElementById('the-batch-iframe');
                PDF.focus();
                PDF.contentWindow.print();
                $("#loader-modal").hide();
            },
        });
    }
});
$(document).on('click', '.invoices-page-section .by-batch-btn .dropdown-menu li.delete-btn', function() {
    if ($(".invoices-page-section table.invoices-table tbody tr td input[type='checkbox']:checked").length > 0) {
        Swal.fire({
            title: "Delete?",
            html: "Are you sure you want to delete all selcted invoices?",
            showCancelButton: true,
            imageUrl: baseURL + "/assets/img/accounting/customers/delete.png",
            cancelButtonColor: "#d33",
            confirmButtonColor: "#2ca01c",
            confirmButtonText: "Delete now",
        }).then((result) => {
            if (result.value) {
                $("#loader-modal").show();
                $.ajax({
                    url: baseURL + "invoice-page/delete-batch",
                    type: "POST",
                    dataType: "json",
                    data: $("form.invoice-table-form").serialize(),
                    success: function(data) {
                        if (data.status == "success") {
                            invoices_filter_changed();
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: "Success",
                                html: "Invoice has been deleted",
                                icon: "success",
                            });
                        } else {
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: "Error",
                                html: "Unable to delete invoices.",
                                icon: "error",
                            });
                        }
                        $("#loader-modal").hide();
                    },
                });
            } else {
                $("#loader-modal").hide();
            }
        });
    }
});

$(document).on('click', '.invoices-page-section .by-batch-btn .dropdown-menu li.delete-btn', function() {
    if ($(".invoices-page-section table.invoices-table tbody tr td input[type='checkbox']:checked").length > 0) {
        Swal.fire({
            title: "Send?",
            html: "Are you sure you want to send all selected invoices?",
            showCancelButton: true,
            imageUrl: baseURL + "/assets/img/accounting/customers/message.png",
            cancelButtonColor: "#d33",
            confirmButtonColor: "#2ca01c",
            confirmButtonText: "Send now",
        }).then((result) => {
            if (result.value) {
                $("#loader-modal").show();
                $.ajax({
                    url: baseURL + "invoice-page/send-batch",
                    type: "POST",
                    dataType: "json",
                    data: $("form.invoice-table-form").serialize(),
                    success: function(data) {
                        if (data.status == "success") {
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: "Success",
                                html: "Invoices are sent.",
                                icon: "success",
                            });
                        } else {
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: "Error",
                                html: "Unable to send invoices.",
                                icon: "error",
                            });
                        }

                        $("#loader-modal").hide();
                    },
                });
            } else {
                $("#loader-modal").hide();
            }
        });
    }
});

$(document).on('click', '.invoices-page-section table.invoices-table tbody>tr>td', function() {
    if (!$(this).is(':last-child')) {
        $("div#invoice-viewer-modal").fadeIn();
        $("div#invoice-viewer-modal .the-modal-body.right-side-modal>.the-title .invoice-number").html($(this).parent("tr").attr("data-invoice-number"));
        $("div#invoice-viewer-modal .the-modal-body.right-side-modal .total-amount-section .amount").html($(this).parent("tr").attr("data-grand-total"));
        $("div#invoice-viewer-modal .the-modal-body.right-side-modal .invoice-info.invoice-date .date").html($(this).parent("tr").attr("data-date"));
        $("div#invoice-viewer-modal .the-modal-body.right-side-modal .invoice-info.due-date .date").html($(this).parent("tr").attr("data-due-date"));
        $("div#invoice-viewer-modal .the-modal-body.right-side-modal .status-text").html($(this).parent("tr").attr("data-status"));
        if ($(this).parent("tr").attr("data-status") == "Paid") {
            $("div#invoice-viewer-modal .the-modal-body.right-side-modal .status-icon").removeClass("pending");
            $("div#invoice-viewer-modal .the-modal-body.right-side-modal .status-icon").addClass("success");
            $("div#invoice-viewer-modal .the-modal-body.right-side-modal .status-icon i").attr("class", "fa fa-check-circle");
        } else {
            $("div#invoice-viewer-modal .the-modal-body.right-side-modal .status-icon").removeClass("success");
            $("div#invoice-viewer-modal .the-modal-body.right-side-modal .status-icon").addClass("pending");
            $("div#invoice-viewer-modal .the-modal-body.right-side-modal .status-icon i").attr("class", "fa fa-pause-circle");
        }
        invoice_viewer_changed($(this).parent("tr").attr("data-id"), $(this).parent("tr").attr("data-customer-id"));
    }
});
$(document).on('click', 'div#invoice-viewer-modal .the-close', function() {
    $("div#invoice-viewer-modal").fadeOut();
});
$(document).on('click', 'div#invoice-viewer-modal .the-modal-body.right-side-modal .section .title', function(event) {
    if ($(this).parent(".section").hasClass("shown")) {
        $(this).parent(".section").attr("class", "section hidden");
        $(this).children(".icon").children("i").attr("class", "fa fa-angle-right");
    } else {
        $(this).parent(".section").attr("class", "section shown");
        $(this).children(".icon").children("i").attr("class", "fa fa-angle-down");
    }
});
$(document).on('click', 'div#invoice-viewer-modal .the-modal-body.right-side-modal .more-description-section a.show-more', function(event) {
    event.preventDefault();
    $("div#invoice-viewer-modal .the-modal-body.right-side-modal .more-description-section .more-description-info").show();
    $(this).attr("class", "show-less");
});
$(document).on('click', 'div#invoice-viewer-modal .the-modal-body.right-side-modal .more-description-section a.show-less', function(event) {
    event.preventDefault();
    $("div#invoice-viewer-modal .the-modal-body.right-side-modal .more-description-section .more-description-info").hide();
    $(this).attr("class", "show-more");
});

function invoice_viewer_changed(invoice_id, customer_id) {
    $("div#invoice-viewer-modal .section-loader").show();
    $("div#invoice-viewer-modal .section").hide();
    $.ajax({
        url: baseURL + "invoice-viewer",
        type: "POST",
        dataType: "json",
        data: {
            invoice_id: invoice_id,
            customer_id: customer_id
        },
        success: function(data) {
            $("div#invoice-viewer-modal .the-modal-body.right-side-modal .section .section-content .items").html(data.html_items_and_price);
            $("div#invoice-viewer-modal .the-modal-body.right-side-modal .more-description-section .more-description-info").html(data.html_items_description);
            $("div#invoice-viewer-modal .the-modal-body.right-side-modal .section .title span.customer-name").html(data.customer_name);
            $("div#invoice-viewer-modal .the-modal-body.right-side-modal .section .section-content .email").html(data.customer_email);
            $("div#invoice-viewer-modal .the-modal-body.right-side-modal ul.status-tracker").html(data.status_steps);
            $("div#invoice-viewer-modal .section-loader").hide();
            $("div#invoice-viewer-modal .the-modal-body.right-side-modal .the-modal-footer button.edit-invoice-btn.success").attr("onclick", "window.location.href = '" + baseURL + "accounting/invoice_edit/" + invoice_id + "'");
            $("div#invoice-viewer-modal .the-modal-body.right-side-modal .the-modal-footer .button-dropdown-options .options li.print").attr("onclick", "window.open('" + baseURL + "invoice/preview/" + invoice_id + "?format=print')");
            $("div#invoice-viewer-modal .the-modal-body.right-side-modal .the-modal-footer .button-dropdown-options .options li.openCloneInvoice").attr("data-invoice-number", $("div#invoice-viewer-modal .the-modal-body.right-side-modal>.the-title .invoice-number").html());
            $("div#invoice-viewer-modal .the-modal-body.right-side-modal .the-modal-footer .button-dropdown-options .options li.openCloneInvoice").attr("data-id", invoice_id);

            $("div#invoice-viewer-modal .section").show();
        },
    });
}

$(document).on('click', 'div#invoice-viewer-modal .the-modal-body.right-side-modal .section .section-content .status-tracker .status-event-info .view-payment-button', function(event) {
    event.preventDefault();
    $("#customer_receive_payment_modal").fadeIn();
    var customer_id = $(this).attr("data-customer-id");
    var receive_payment_id = $(this).attr("data-receive-payment-id");
    var invoice_id = $(this).attr("data-invoice-id");
    $("#customer_receive_payment_modal #receive_payment_form select[name='customer_id']").val(customer_id);
    $('#new-popup').modal('hide');
    $("#loader-modal").show();
    get_receive_payment(customer_id, receive_payment_id, invoice_id);
});
$(document).on('click', 'div#invoice-viewer-modal', function(event) {
    if ($(event.target).closest("div#invoice-viewer-modal .the-modal-body.right-side-modal ").length === 0) {
        $("div#invoice-viewer-modal").fadeOut();
    }
});