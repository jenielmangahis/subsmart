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

$(document).on("click", "#customer-single-modal .single-customer-info-section .top-section .notes a.add-notes-btn", function(event) {
    $("#customer-single-modal .single-customer-info-section .top-section .notes textarea").show();
    $(this).hide();
    $("#customer-single-modal .single-customer-info-section .top-section .notes textarea").focus();
    $("#customer-single-modal .single-customer-info-section .top-section .notes .saved-indicato").hide();
});
$("#customer-single-modal .single-customer-info-section .top-section .notes textarea").focus(function() {
    $("#customer-single-modal .single-customer-info-section .top-section .notes textarea").removeClass("notes-added");
    $("#customer-single-modal .single-customer-info-section .top-section .notes .saved-indicator").hide();

});

$("#customer-single-modal .single-customer-info-section .top-section .notes textarea").focusout(function() {
    single_customer_notes_text_area_changed();
});
$(document).on("click", "#customer-single-modal .seaction-above-table .print-export-settings-btns .setting-btn-section button.settings-btn", function(event) {
    $("#customer-single-modal .seaction-above-table .print-export-settings-btns .setting-btn-section .settings-options").show();
});
$(document).on("change", "#customer-single-modal .seaction-above-table .print-export-settings-btns .setting-btn-section .settings-options input[type='checkbox']", function(event) {
    if ($(this).is(":checked")) {
        $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table th[data-column='" + $(this).attr("data-column") + "']").show();
        $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td[data-column='" + $(this).attr("data-column") + "']").show();
    } else {
        $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table th[data-column='" + $(this).attr("data-column") + "']").hide();
        $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td[data-column='" + $(this).attr("data-column") + "']").hide();
    }
});

$(document).on("change", "#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table th input[name='customer_checkbox_all']", function(event) {
    if ($(this).is(":checked")) {
        $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td input[type='checkbox']").prop("checked", true);
    } else {
        $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td input[type='checkbox']").prop("checked", false);
    }
});
$(document).on("change", "#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td input[type='checkbox']", function(event) {
    single_customer_transaction_table_checkbox_changed();
});

$(document).on("click", "#customer-single-modal .single-customer-info-section .body-section ul.body-tabs li", function(event) {
    $("#customer-single-modal .single-customer-info-section .body-section ul.body-tabs li").removeClass("active");
    $(this).addClass("active");
    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section").hide();
    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section." + $(this).attr("data-target")).fadeIn();
});

function single_customer_notes_text_area_changed() {
    if (!$.trim($("#customer-single-modal .single-customer-info-section .top-section .notes textarea").val())) {
        $("#customer-single-modal .single-customer-info-section .top-section .notes a.add-notes-btn").show();
        $("#customer-single-modal .single-customer-info-section .top-section .notes textarea").hide();
        $("#customer-single-modal .single-customer-info-section .top-section .notes textarea").val("");
        $("#customer-single-modal .single-customer-info-section .top-section .notes .saved-indicator").hide();
        single_customer_update_customer_notes();
    } else {
        $("#customer-single-modal .single-customer-info-section .top-section .notes a.add-notes-btn").hide();
        $("#customer-single-modal .single-customer-info-section .top-section .notes textarea").show();
        $("#customer-single-modal .single-customer-info-section .top-section .notes textarea").addClass("notes-added");
        $("#customer-single-modal .single-customer-info-section .top-section .notes .saved-indicator").show();
        single_customer_update_customer_notes();
    }
}

function single_customer_transaction_table_checkbox_changed() {

    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table th input[name='customer_checkbox_all']").prop("checked", true);

    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td input[type='checkbox']").each(function() {
        if (!$(this).is(":checked")) {
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table th input[name='customer_checkbox_all']").prop("checked", false);
        }
    });
}


single_customer_table_columns_changed();

function single_customer_update_customer_notes() {
    $.ajax({
        url: baseURL + "/accounting/update_customer_notes",
        type: "POST",
        dataType: "json",
        data: {
            customer_id: $("#customer-single-modal input[name='customer_id']").val(),
            notes: $("#customer-single-modal .single-customer-info-section .top-section .notes textarea").val(),
        },
        success: function(data) {
            if (data.result == "success") {
                $("#customer-single-modal .single-customer-info-section .top-section .notes .saved-indicator").html("Saved!");
            } else {
                $("#customer-single-modal .single-customer-info-section .top-section .notes .saved-indicator").html("Not saved!");
            }
        },
    });
}

function single_customer_table_columns_changed() {
    $("#customer-single-modal .seaction-above-table .print-export-settings-btns .setting-btn-section .settings-options input[type='checkbox']")
        .map(function() {
            if ($(this).is(":checked")) {
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

function single_customer_get_transaction_lists(customer_id) {
    $.ajax({
        url: baseURL + "/accounting/single_customer_get_transaction_lists",
        type: "POST",
        dataType: "json",
        data: { customer_id: customer_id },
        success: function(data) {
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table tbody").html(data.tbody_html);
            single_customer_table_columns_changed();
            single_customer_sortTable();
            $("#loader-modal").hide();
        },
    });
}

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
    $("#customer-single-modal input[name='customer_id']").val(customer_id);
    $('#customer-single-modal .the-body .customer-list-section ul li').removeClass("active");
    $('#customer-single-modal .the-body .customer-list-section ul li[data-customer-id="' + customer_id + '"]').addClass("active");
    $("#customer-single-modal .top-section .btns-section .new-transactions .customer_craete_invoice_btn").attr("data-customer-id", customer_id);
    $("#customer-single-modal .top-section .btns-section .new-transactions .customer_receive_payment_btn").attr("data-customer-id", customer_id);
    $("#customer-single-modal .top-section .btns-section .new-transactions .customer_receive_payment_btn").attr("data-customer-id", customer_id);
    $("#customer-single-modal .top-section .btns-section .new-transactions .create-estimate-btn").attr("data-customer-id", customer_id);
    $("#customer-single-modal .top-section .btns-section .new-transactions .created-sales-receipt").attr("data-customer-id", customer_id);
    $("#customer-single-modal .top-section .btns-section .new-transactions .create-charge-btn").attr("data-customer-id", customer_id);
    $("#customer-single-modal .top-section .btns-section .new-transactions .time-activity-btn").attr("data-customer-id", customer_id);
    $("#customer-single-modal .top-section .btns-section .new-transactions .created-statement-btn").attr("data-customer-id", customer_id);
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
            $("#customer-single-modal .single-customer-info-section .top-section .notes textarea").val(data.customer_details[0]['notes']);
            $("#customer-single-modal .top-section .btns-section .new-transactions .create-estimate-btn").attr("data-email-add", data.customer_details[0]['email']);
            single_customer_notes_text_area_changed();
            $("#customer-single-modal .single-customer-info-section .top-section .notes .saved-indicator").hide();
            single_customer_get_transaction_lists(customer_id);
            console.log(data);
            // $("#loader-modal").hide();

            //seeting customer-deatials-values
            var billing_address = "";
            if (data.customer_details[0]['billing_address'] != null && data.customer_details[0]['billing_address'] != "") {
                billing_address = data.customer_details[0]['billing_address'];
            }
            if (data.customer_details[0]['billing_city'] != null && data.customer_details[0]['billing_city'] != "") {
                billing_address += "<br>" + data.customer_details[0]['billing_city'];
            }
            if (data.customer_details[0]['billing_state'] != null && data.customer_details[0]['billing_state'] != "") {
                billing_address += ", " + data.customer_details[0]['billing_state'];
            }
            if (data.customer_details[0]['billing_postal'] != null && data.customer_details[0]['billing_postal'] != "") {
                billing_address += "<br>" + data.customer_details[0]['billing_postal'];
            }
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='customer']").html(data.customer_details[0]['last_name'] + ", " + data.customer_details[0]['fisrt_name']);
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='email']").html(data.customer_details[0]['email']);
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='phone']").html(data.customer_details[0]['phone_h']);
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='mobile']").html(data.customer_details[0]['phone_m']);
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='fax']").html(data.customer_details[0]['fax']);
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='other']").html("");
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='website']").html("");
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='notes'] textarea").html(data.customer_details[0]['notes']);
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='billing-address']").html(billing_address);
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='shipping-address']").html(billing_address);
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='terms']").html("");
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='payment-method']").html("");
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='delivery-method']").html("");
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='customer-type']").html(data.customer_details[0]['customer_type']);
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='customer-language']").html("");
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='tax-reg-no']").html("");
        },
    });
}


function single_customer_sortTable() {
    var table, rows, switching, i, x, y, shouldSwitch;
    table = document.getElementById("single_customer_table");
    switching = true;
    while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[1];
            y = rows[i + 1].getElementsByTagName("TD")[1];
            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                shouldSwitch = true;
                break;
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    }
}