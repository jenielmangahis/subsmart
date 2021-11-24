$(document).on("click", function(event) {
    if ($(event.target).closest(".all-sales-section .filter-btn-section").length === 0) {
        $(".all-sales-section .filter-btn-section .filter-panel").hide();
    }
});
$("document").ready(function() {
    all_sales_apply_filter();
});


$(document).on('change', '.all-sales-section table.all_sales_table th input.select-all', function() {
    if ($(".all-sales-section table.all_sales_table th input.select-all").is(':checked')) {
        $(".all-sales-section table.all_sales_table tbody tr td input[type='checkbox']").prop("checked", true);
    } else {
        $(".all-sales-section table.all_sales_table tbody tr td input[type='checkbox']").prop("checked", false);
    }
    all_sales_table_checkbox_changes();
});
$(document).on('change', ".all-sales-section table.all_sales_table tbody tr td input[type='checkbox']", function() {
    if ($(".all-sales-section table.all_sales_table tbody tr td input[type='checkbox']:checked").length == $(".all-sales-section table.all_sales_table tbody tr td input[type='checkbox']").length) {
        $(".all-sales-section table.all_sales_table th input.select-all").prop("checked", true);
    } else {
        $(".all-sales-section table.all_sales_table th input.select-all").prop("checked", false);
    }
    all_sales_table_checkbox_changes();
});

function all_sales_table_checkbox_changes() {
    if ($(".all-sales-section table.all_sales_table tbody tr td input[type='checkbox']:checked").length == 0) {
        $(".all-sales-section .by-batch-btn button.btn-default").addClass("disabled");
        $(".all-sales-section .by-batch-btn ul.by-batch-btn li").addClass("disabled");
    } else {
        $(".all-sales-section .by-batch-btn ul.by-batch-btn li").removeClass("disabled");
        $(".all-sales-section .by-batch-btn button.btn-default").removeClass("disabled");
    }
    all_sales_send_reminder_checker();
}

function all_sales_send_reminder_checker() {
    // if ($(".all-sales-section table.all_sales_table tbody tr td input[type='checkbox']:checked").length == 1) {
    //     var status = $(".all-sales-section table.all_sales_table tbody tr td input[type='checkbox']:checked").attr("data-row-status");
    //     console.log(status);
    //     if (status != "Paid" && status != "Draft" && status != "Submitted" && status != "Declined" && status != "Scheduled") {
    //         $(".all-sales-section .by-batch-btn .dropdown-menu li.send-reminder-btn").removeClass("disabled");
    //     } else {
    //         $(".all-sales-section .by-batch-btn .dropdown-menu li.send-reminder-btn").addClass("disabled");
    //     }
    // } else {
    //     $(".all-sales-section .by-batch-btn .dropdown-menu li.send-reminder-btn").addClass("disabled");
    // }
    all_sales_set_by_batch_menu_disabled();
}

function all_sales_set_by_batch_menu_disabled() {
    var invoice_selected = false;
    var not_invoice_selected = false;
    var no_selected = true;
    var no_status_open_overdue = true;
    $(".all-sales-section table.all_sales_table tbody tr td input[type='checkbox']").each(function() {
        if ($(this).is(":checked")) {
            no_selected = false;
            if ($(this).attr("data-row-type") != "Invoice") {
                not_invoice_selected = true;
            } else {
                invoice_selected = true;
            }
            var status = $(this).attr("data-row-status");
            if (status != "Paid" && status != "Draft" && status != "Submitted" && status != "Declined" && status != "Scheduled" && status != undefined) {
                no_status_open_overdue = false;
            } else {
                // no_status_open_overdue = false;
                // console.log(status);
            }
        }
    });
    $(".all-sales-section ul.by-batch-btn li.print-transaction-btn").removeClass("disabled");
    $(".all-sales-section ul.by-batch-btn li.print-packaging-slip-btn").removeClass("disabled");
    $(".all-sales-section ul.by-batch-btn li.send-transaction-btn").removeClass("disabled");
    $(".all-sales-section ul.by-batch-btn li.send-reminder-btn").removeClass("disabled");

    if (not_invoice_selected) {
        $(".all-sales-section ul.by-batch-btn li.print-transaction-btn").addClass("disabled");
        $(".all-sales-section ul.by-batch-btn li.send-transaction-btn").addClass("disabled");
        if (!invoice_selected) {
            $(".all-sales-section ul.by-batch-btn li.print-transaction-btn").addClass("disabled");
            $(".all-sales-section ul.by-batch-btn li.print-packaging-slip-btn").addClass("disabled");
        }
    }
    if (no_selected) {
        $(".all-sales-section ul.by-batch-btn li.print-transaction-btn").addClass("disabled");
        $(".all-sales-section ul.by-batch-btn li.print-packaging-slip-btn").addClass("disabled");
        $(".all-sales-section ul.by-batch-btn li.send-transaction-btn").addClass("disabled");
        $(".all-sales-section ul.by-batch-btn li.send-reminder-btn").addClass("disabled");
    }
    if (no_status_open_overdue) {
        $(".all-sales-section ul.by-batch-btn li.send-reminder-btn").addClass("disabled");
    }
}

$(document).on("click", ".all-sales-section .filter-btn-section button.filter-btn", function(event) {
    $(".all-sales-section .filter-btn-section .filter-panel").show();
});
$(document).on("click", ".all-sales-section .filter-btn-section .filter-panel button.reset", function(event) {
    $('.all-sales-section .filter-btn-section .filter-panel form.filter_all_sales_table').trigger("reset");
    all_sales_filter_date_changed();
});
$(document).on("change", ".all-sales-section .filter-btn-section .filter-panel form.filter_all_sales_table select[name='filter_date']", function(event) {
    all_sales_filter_date_changed();
});

$(document).on("change", ".all-sales-section .filter-btn-section .filter-panel form.filter_all_sales_table input[name='filter_date_from']", function(event) {
    $(".all-sales-section .filter-btn-section .filter-panel form.filter_all_sales_table select[name='filter_date']").val("Custom");
});
$(document).on("change", ".all-sales-section .filter-btn-section .filter-panel form.filter_all_sales_table input[name='filter_date_to']", function(event) {
    $(".all-sales-section .filter-btn-section .filter-panel form.filter_all_sales_table select[name='filter_date']").val("Custom");
});

all_sales_filter_date_changed();

function all_sales_filter_date_changed() {

    var selected = $(".all-sales-section .filter-btn-section .filter-panel form.filter_all_sales_table select[name='filter_date']").val();
    if (selected == "All dates") {
        $(".all-sales-section .filter-btn-section .filter-panel form.filter_all_sales_table input[name='filter_date_from']").val("");
        $(".all-sales-section .filter-btn-section .filter-panel form.filter_all_sales_table input[name='filter_date_to']").val("");
    } else if (selected == "Today") {
        $(".all-sales-section .filter-btn-section .filter-panel form.filter_all_sales_table input[name='filter_date_from']").val(formatDate(new Date()));
        $(".all-sales-section .filter-btn-section .filter-panel form.filter_all_sales_table input[name='filter_date_to']").val(formatDate(new Date()));
    } else if (selected == "Yesterday") {
        var today = new Date();
        var yesterday = new Date(today.setDate(today.getDate() - 1));
        $(".all-sales-section .filter-btn-section .filter-panel form.filter_all_sales_table input[name='filter_date_from']").val(formatDate(yesterday));
        $(".all-sales-section .filter-btn-section .filter-panel form.filter_all_sales_table input[name='filter_date_to']").val(formatDate(yesterday));
    } else if (selected == "This week") {
        var curr = new Date; // get current date
        var first = curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week
        var last = first + 6; // last day is the first day + 6

        var firstday = new Date(curr.setDate(first)).toUTCString();
        var lastday = new Date(curr.setDate(last)).toUTCString();
        $(".all-sales-section .filter-btn-section .filter-panel form.filter_all_sales_table input[name='filter_date_from']").val(formatDate(firstday));
        $(".all-sales-section .filter-btn-section .filter-panel form.filter_all_sales_table input[name='filter_date_to']").val(formatDate(lastday));
    } else if (selected == "This month") {
        var date = new Date(),
            y = date.getFullYear(),
            m = date.getMonth();
        var firstday = new Date(y, m, 1);
        var lastday = new Date(y, m + 1, 0);
        $(".all-sales-section .filter-btn-section .filter-panel form.filter_all_sales_table input[name='filter_date_from']").val(formatDate(firstday));
        $(".all-sales-section .filter-btn-section .filter-panel form.filter_all_sales_table input[name='filter_date_to']").val(formatDate(lastday));
    } else if (selected == "This quarter") {
        var now = new Date();
        var quarter = Math.floor((now.getMonth() / 3));
        var firstday = new Date(now.getFullYear(), quarter * 3, 1);
        var lastday = new Date(firstday.getFullYear(), firstday.getMonth() + 3, 0);
        $(".all-sales-section .filter-btn-section .filter-panel form.filter_all_sales_table input[name='filter_date_from']").val(formatDate(firstday));
        $(".all-sales-section .filter-btn-section .filter-panel form.filter_all_sales_table input[name='filter_date_to']").val(formatDate(lastday));
    } else if (selected == "This year") {
        var now = new Date();
        var firstday = new Date(now.getFullYear(), 0, 1);
        var lastday = new Date(firstday.getFullYear(), 12, 0);
        $(".all-sales-section .filter-btn-section .filter-panel form.filter_all_sales_table input[name='filter_date_from']").val(formatDate(firstday));
        $(".all-sales-section .filter-btn-section .filter-panel form.filter_all_sales_table input[name='filter_date_to']").val(formatDate(lastday));
    } else if (selected == "Last week") {
        var curr = new Date; // get current date
        var first = (curr.getDate() - curr.getDay()) - 7; // First day is the day of the month - the day of the week
        var last = first + 6; // last day is the first day + 6

        var firstday = new Date(curr.setDate(first)).toUTCString();
        var lastday = new Date(curr.setDate(last)).toUTCString();
        $(".all-sales-section .filter-btn-section .filter-panel form.filter_all_sales_table input[name='filter_date_from']").val(formatDate(firstday));
        $(".all-sales-section .filter-btn-section .filter-panel form.filter_all_sales_table input[name='filter_date_to']").val(formatDate(lastday));
    } else if (selected == "Last month") {
        var date = new Date(),
            y = date.getFullYear(),
            m = date.getMonth() - 1;
        var firstday = new Date(y, m, 1);
        var lastday = new Date(y, m + 1, 0);
        $(".all-sales-section .filter-btn-section .filter-panel form.filter_all_sales_table input[name='filter_date_from']").val(formatDate(firstday));
        $(".all-sales-section .filter-btn-section .filter-panel form.filter_all_sales_table input[name='filter_date_to']").val(formatDate(lastday));
    } else if (selected == "Last quarter") {
        var now = new Date();
        var quarter = Math.floor((now.getMonth() / 3)) - 1;
        var year = now.getFullYear();
        if (quarter < 1) {
            quarter += 4;
            year = now.getFullYear() - 1;
        }
        var firstday = new Date(year, quarter * 3, 1);
        var lastday = new Date(firstday.getFullYear(), firstday.getMonth() + 3, 0);
        $(".all-sales-section .filter-btn-section .filter-panel form.filter_all_sales_table input[name='filter_date_from']").val(formatDate(firstday));
        $(".all-sales-section .filter-btn-section .filter-panel form.filter_all_sales_table input[name='filter_date_to']").val(formatDate(lastday));
    } else if (selected == "Last year") {
        var now = new Date();
        var firstday = new Date(now.getFullYear() - 1, 0, 1);
        var lastday = new Date(firstday.getFullYear(), 12, 0);
        $(".all-sales-section .filter-btn-section .filter-panel form.filter_all_sales_table input[name='filter_date_from']").val(formatDate(firstday));
        $(".all-sales-section .filter-btn-section .filter-panel form.filter_all_sales_table input[name='filter_date_to']").val(formatDate(lastday));
    } else if (selected == "Last 365 days") {
        var today = new Date();
        var last_364 = new Date(today.setDate(today.getDate() - 365));
        $(".all-sales-section .filter-btn-section .filter-panel form.filter_all_sales_table input[name='filter_date_from']").val(formatDate(last_364));
        $(".all-sales-section .filter-btn-section .filter-panel form.filter_all_sales_table input[name='filter_date_to']").val("");
    }
}

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}

$(document).on("click", ".all-sales-section .filter-btn-section .filter-panel button.apply-btn", function(event) {
    all_sales_apply_filter();
});

function all_sales_apply_filter() {
    $(".loader_below_table").html("<div style='text-align:center;color: #C7C7C7;position:absolute;'><center><img src='" + baseURL + "assets/img/accounting/customers/loader.gif' style='width:50px;' /></center></div>");
    $.ajax({
        url: baseURL + "/accounting/filter/all-sales",
        type: "POST",
        dataType: "json",
        data: $(".all-sales-section .filter-btn-section .filter-panel form.filter_all_sales_table").serialize(),
        success: function(data) {
            $(".loader_below_table").html("");
            var table = $('#all_sales_table').DataTable();
            table.destroy();
            $('#all_sales_table tbody').html(data.the_html_tbody);
            table = $('#all_sales_table').DataTable({
                "order": [
                    [1, "desc"]
                ]
            });
            table.draw();
        },
    });
}

$(document).on("click", ".all-sales-section ul.by-batch-btn li.print-packaging-slip-btn", function(event) {
    event.preventDefault();
    if (!$(this).hasClass("disabled")) {
        alls_sales_print_by_batch("packaging_slip");
    }
});

$(document).on("click", ".all-sales-section ul.by-batch-btn li.print-transaction-btn", function(event) {
    event.preventDefault();
    if (!$(this).hasClass("disabled")) {
        alls_sales_print_by_batch("transactions");
    }
});

function alls_sales_print_by_batch(action = "") {
    var php_function = "";
    if (action == "packaging_slip") {
        php_function = "generate_customer_invoice_packaging_slip_by_batch";
    } else if (action == "transactions") {
        php_function = "print_transactions_by_batch";
    }
    var invoice_ids = new Array();
    var customer_ids = new Array();
    $(".all-sales-section table.all_sales_table tbody tr td input[type='checkbox']").each(function() {
        if ($(this).is(":checked")) {
            if ($(this).attr("data-row-type") == "Invoice") {
                invoice_ids.push($(this).attr("data-invoice-id"));
                customer_ids.push($(this).attr("data-customer-id"));
            }
        }
    });

    $("#loader-modal").show();
    $.ajax({
        url: baseURL + "accounting/" + php_function,
        type: "POST",
        dataType: "json",
        data: {
            customer_ids: customer_ids,
            invoice_ids: invoice_ids,
        },
        success: function(data) {
            var win = window.open(data.pdf_link, '_blank');
            if (win) {
                win.focus();
            } else {
                alert('Please allow popups for this website');
            }
            $("#loader-modal").hide();
        },
    });
}

$(document).on("click", ".all-sales-section ul.by-batch-btn li.send-reminder-btn", function() {

    if (!$(this).hasClass("disabled")) {
        var invoice_ids = new Array();
        var customer_ids = new Array();
        var tos = "";
        var business_name = "";
        $(".all-sales-section table.all_sales_table tbody tr td input[data-row-type='Invoice']:checked").each(function() {
            no_selected = true;
            var status = $(this).attr("data-row-status");
            if (status != "Paid" && status != "Draft" && status != "Submitted" && status != "Declined" && status != "Scheduled" && status != undefined) {
                invoice_ids.push($(this).attr("data-invoice-id"));
                customer_ids.push($(this).attr("data-customer-id"));
                tos += $(this).attr("data-customer-name") + "; ";
                business_name = $(this).attr("data-business-name");
            }
        });
        console.log(invoice_ids);
        get_info_customer_reminder_by_batch(customer_ids, invoice_ids, tos, ".all-sales-section table.all_sales_table", business_name);
    }
});

$(document).on("click", ".all-sales-section ul.by-batch-btn li.send-transaction-btn", function(event) {
    if (!$(this).hasClass("disabled")) {
        event.preventDefault();
        $("body").css({ 'cursor': 'wait' });
        var invoice_ids = new Array();
        $(".all-sales-section table.all_sales_table tbody tr td input[data-row-type='Invoice']:checked").each(function() {
            if ($(this).is(":checked")) {
                if ($(this).attr("data-row-type") == "Invoice") {
                    invoice_ids.push($(this).attr("data-invoice-id"));
                }
            }
        });
        Swal.fire({
            title: "Send transaction?",
            html: "Are you sure you want to send this transaction?",
            showCancelButton: true,
            imageUrl: baseURL + "/assets/img/accounting/customers/message.png",
            cancelButtonColor: "#d33",
            confirmButtonColor: "#2ca01c",
            confirmButtonText: "Send now",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: baseURL + "accounting/transaction/send/by-batch",
                    type: "POST",
                    dataType: "json",
                    data: {
                        invoice_ids: invoice_ids,
                    },
                    success: function(data) {
                        $("body").css({ 'cursor': 'default' });
                        if (data.status == "success") {
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: "Success",
                                html: "Transactions has been sent!",
                                icon: "success",
                            });
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {

                        $("body").css({ 'cursor': 'default' });
                        Swal.fire({
                            showConfirmButton: false,
                            timer: 2000,
                            title: "Error",
                            html: "Something went wrong.",
                            icon: "error",
                        });
                    }
                });
            }
        });
    }
});