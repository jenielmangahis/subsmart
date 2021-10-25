$(document).on('change', '.invoices-page-section table.invoices-table th input.select-all', function() {
    if ($(".invoices-page-section table.invoices-table th input.select-all").is(':checked')) {
        $(".invoices-page-section table.invoices-table tbody tr td input[type='checkbox']").prop("checked", true);
    } else {
        $(".invoices-page-section table.invoices-table tbody tr td input[type='checkbox']").prop("checked", false);
    }
    invoice_page_table_checkbox_changes();
});
$(".invoices-page-section table.invoices-table tbody tr td input[type='checkbox']").change(function() {
    if ($(".invoices-page-section table.invoices-table tbody tr td input[type='checkbox']:checked").length == $(".invoices-page-section table.invoices-table tbody tr td input[type='checkbox']").length) {
        $(".invoices-page-section table.invoices-table th input.select-all").prop("checked", true);
    } else {
        $(".invoices-page-section table.invoices-table th input.select-all").prop("checked", false);
    }
    invoice_page_table_checkbox_changes();
});

function invoice_page_table_checkbox_changes() {
    if ($(".invoices-page-section table.invoices-table tbody tr td input[type='checkbox']:checked").length == 0) {
        $(".invoices-page-section .by-batch-btn button.btn-default").addClass("disabled");
        $(".invoices-page-section .by-batch-btn ul.by-batch-btn li").addClass("disabled");
    } else {
        $(".invoices-page-section ul.by-batch-btn li").removeClass("disabled");
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
            if (data.the_html_tbody == "") {
                $(".invoices-page-section table tbody").html("<tr><td colspan='8' style='text-align:center;color: #C7C7C7;'><center>No data found.</center></td></tr>");
            } else {
                $(".invoices-page-section table tbody").html(data.the_html_tbody);
            }
        },
    });
}