$(document).on("click", function(event) {
    if ($(event.target).closest("#customer-single-modal .seaction-above-table .print-export-settings-btns .setting-btn-section").length === 0) {
        $("#customer-single-modal .seaction-above-table .print-export-settings-btns .setting-btn-section .settings-options").hide();
    }
});

$(document).on("click", ".customer-full-page-btn", function(event) {
    $(".page-notification-section").hide();
    $("#customer-single-modal").fadeIn();
    $(".section-above-table .search-holder ul.dropdown-menu").removeClass("show");
    $("#customers_table").hide();
    single_customer_page_get_all_customers($(this).attr('data-customer-id'));
});
$(document).on("click", "#customer-single-modal .the-body .all-customer-section .top-section .back a", function(event) {
    $(".page-notification-section").fadeIn();
    $("#customer-single-modal").fadeOut();
    $("#customers_table").show();
    single_customer_sort_all_customers_ul("name");
});
$("#customer-single-modal .the-body .all-customer-section .top-section .search-section input[type='text']").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#customer-single-modal .the-body .customer-list-section ul li").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});

$(document).on("click", "#customer-single-modal .the-body .customer-list-section ul li", function(event) {
    single_customer_get_customers_details($(this).attr("data-customer-id"));
});
$(document).on("click", "#customer-single-modal .seaction-above-table .print-export-settings-btns .setting-btn-section .settings-options a.show-more-less", function(event) {
    if ($(this).attr("data-current-show") == "less") {
        $("#customer-single-modal .seaction-above-table .print-export-settings-btns .setting-btn-section .settings-options div.extra-group").show();
        $(this).attr("data-current-show", "more");
        $(this).html('<i class="fa fa-chevron-up" aria-hidden="true"></i> Show Less');
    } else {
        $("#customer-single-modal .seaction-above-table .print-export-settings-btns .setting-btn-section .settings-options div.extra-group").hide();
        $(this).attr("data-current-show", "less");
        $(this).html('<i class="fa fa-chevron-down" aria-hidden="true"></i> Show More');
    }
});

$(document).on("click", "#customer-single-modal .seaction-above-table .print-export-settings-btns .setting-btn-section button.settings-btn", function(event) {
    $("#customer-single-modal .seaction-above-table .print-export-settings-btns .setting-btn-section .settings-options").show();
});
$(document).on("change", "#customer-single-modal .seaction-above-table .print-export-settings-btns .setting-btn-section .settings-options input[type='checkbox']", function(event) {
    if ($(this).is(":checked")) {
        console.log("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table th[data-column='" + $(this).attr("data-column") + "']");
        $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table th[data-column='" + $(this).attr("data-column") + "']").show();
        $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td[data-column='" + $(this).attr("data-column") + "']").show();
    } else {
        $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table th[data-column='" + $(this).attr("data-column") + "']").hide();
        $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td[data-column='" + $(this).attr("data-column") + "']").hide();
    }
});
single_customer_table_columns_changed();

function single_customer_table_columns_changed() {
    $("#customer-single-modal .seaction-above-table .print-export-settings-btns .setting-btn-section .settings-options input[type='checkbox']")
        .map(function() {
            if ($(this).is(":checked")) {
                console.log("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table th[data-column='" + $(this).attr("data-column") + "']");
                $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table th[data-column='" + $(this).attr("data-column") + "']").show();
                $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td[data-column='" + $(this).attr("data-column") + "']").show();
            } else {
                $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table th[data-column='" + $(this).attr("data-column") + "']").hide();
                $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td[data-column='" + $(this).attr("data-column") + "']").hide();
            }
        }).get();
}


function single_customer_page_get_all_customers(view_id = "") {
    $.ajax({
        url: baseURL + "/accounting/single_customer_page_get_all_customers",
        type: "POST",
        dataType: "json",
        data: {},
        success: function(data) {
            $("#customer-single-modal .the-body .customer-list-section ul").html(data.html);
            $('html, body').animate({
                scrollTop: $('#customer-single-modal .the-body .customer-list-section ul li[data-customer-id="' + view_id + '"]').offset().top
            }, 2000);
            $('#customer-single-modal .the-body .customer-list-section ul li[data-customer-id="' + view_id + '"]').addClass("active");
            single_customer_get_customers_details(view_id);
        },
    });
}
$(document).on("click", "#customer-single-modal .all-customer-section .sort-btn ul li", function(event) {
    single_customer_sort_all_customers_ul($(this).attr("data-sort-by"));
});

function single_customer_sort_all_customers_ul(sort_by) {

    $("#customer-single-modal .all-customer-section .sort-btn button .sort-display").html("Sort by " + sort_by);
    if (sort_by == "name") {
        var result = $('#customer-single-modal .the-body .customer-list-section ul li').sort(function(a, b) {
            var contentA = ($(a).data('name'));
            var contentB = ($(b).data('name'));
            return (contentA < contentB) ? -1 : (contentA > contentB) ? 1 : 0;
        });
        $('#customer-single-modal .the-body .customer-list-section ul').html(result);
    } else {
        var result = $('#customer-single-modal .the-body .customer-list-section ul li').sort(function(a, b) {
            var contentA = parseInt($(a).data('open-balance'));
            var contentB = parseInt($(b).data('open-balance'));
            return (contentA > contentB) ? -1 : (contentA < contentB) ? 1 : 0;
        });
        $('#customer-single-modal .the-body .customer-list-section ul').html(result);
    }

}

function single_customer_get_customers_details(customer_id) {

    $('#customer-single-modal .the-body .customer-list-section ul li').removeClass("active");
    $('#customer-single-modal .the-body .customer-list-section ul li[data-customer-id="' + customer_id + '"]').addClass("active");
    $("#loader-modal").show();
    $.ajax({
        url: baseURL + "/accounting/single_customer_get_customers_details",
        type: "POST",
        dataType: "json",
        data: { customer_id: customer_id },
        success: function(data) {
            $("#customer-single-modal .single-customer-info-section .top-section .monetary-section .monetary-open .amount").html("$" + data.open_balance);
            $("#customer-single-modal .single-customer-info-section .top-section .monetary-section .monetary-overdue .amount").html("$" + data.overdue);
            $("#customer-single-modal .single-customer-info-section .top-section .customer-name h2 span.text").html(data.customer_details[0]['first_name'] + " " + data.customer_details[0]['last_name']);
            $("#customer-single-modal .single-customer-info-section .top-section .customer-address label").html(data.customer_details[0]['mail_add'] + ", " + data.customer_details[0]['city'] + ", " + data.customer_details[0]['state'] + " " + data.customer_details[0]['zip_code']);
            single_customer_get_transaction_lists(customer_id);
            // $("#loader-modal").hide();
        },
    });
}

function single_customer_get_transaction_lists(customer_id) {
    $.ajax({
        url: baseURL + "/accounting/single_customer_get_transaction_lists",
        type: "POST",
        dataType: "json",
        data: { customer_id: customer_id },
        success: function(data) {
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table tbody").html(data.tbody_html);
            single_customer_table_columns_changed();
            $("#loader-modal").hide();
        },
    });
}