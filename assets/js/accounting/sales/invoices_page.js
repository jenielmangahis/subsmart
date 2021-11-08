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