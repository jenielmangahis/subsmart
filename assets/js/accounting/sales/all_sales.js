$(document).on("click", function(event) {
    if ($(event.target).closest(".all-sales-section .filter-btn-section").length === 0) {
        $(".all-sales-section .filter-btn-section .filter-panel").hide();
    }
});
$("document").ready(function() {
    all_sales_apply_filter();
});
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
    $.ajax({
        url: baseURL + "/accounting/filter/all-sales",
        type: "POST",
        dataType: "json",
        data: $(".all-sales-section .filter-btn-section .filter-panel form.filter_all_sales_table").serialize(),
        success: function(data) {
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