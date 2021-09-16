$(document).on("click", function(event) {
    if ($(event.target).closest("#customer-single-modal .seaction-above-table .print-export-settings-btns .setting-btn-section").length === 0) {
        $("#customer-single-modal .seaction-above-table .print-export-settings-btns .setting-btn-section .settings-options").hide();
    }
    if ($(event.target).closest("#customer-single-modal .single-customer-info-section .body-section .filter-btn-section").length === 0) {
        $("#customer-single-modal .single-customer-info-section .body-section .filter-btn-section .filter-panel").hide();
    }
});

$(document).on("click", "#customer-single-modal .the-body .dropdown-menu li a.send-reminder-btn", function() {
    get_info_customer_reminder($(this).attr("data-customer-id"), $(this).attr("data-action-from"), $(this).attr("data-invoice-number"));
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
    get_load_customers_table();
    get_modal_new_customer();
});
$("#customer-single-modal .the-body .all-customer-section .top-section .search-section input[type='text']").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#customer-single-modal .the-body .customer-list-section ul li").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});



$(document).on("click", "#customer-single-modal .the-body .customer-list-section ul li", function(event) {
    $("#customer-single-modal .single-customer-info-section .body-section .filter-btn-section .filter-panel select[name='filter_type']").val("All transactions");
    $("#customer-single-modal .single-customer-info-section .body-section .filter-btn-section .filter-panel select[name='filter_date']").val("All dates");
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
$("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='notes'] textarea").on("keyup", function() {
    $("#customer-single-modal .single-customer-info-section .top-section .notes textarea").val($(this).val());
    $("#customer-single-modal .single-customer-info-section .top-section .notes textarea").show();
    $("#customer-single-modal .single-customer-info-section .top-section .notes .saved-indicato").hide();
    $("#customer-single-modal .single-customer-info-section .top-section .notes a.add-notes-btn").hide();
});
$("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='notes'] textarea").focusout(function() {
    single_customer_notes_text_area_changed();
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
    set_by_batch_menu_disabled();
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
$(document).on("click", "#customer-single-modal .single-customer-info-section .edit-button", function(event) {
    single_customer_get_customers_details($("#customer-single-modal input[name='customer_id']").val());
    $('#modal-container #new-customer-modal').modal('toggle');
    $('#modal-container #new-customer-modal form input[name="customer_id_edit_info"]').remove();
    $('#modal-container #new-customer-modal form').append('<input type="text" name="customer_id_edit_info" value="' + $("#customer-single-modal input[name='customer_id']").val() + '" style="display:none;">');
});

$(document).on("click", "#customer-single-modal .single-customer-info-section .body-section .filter-btn-section button.filter-btn", function(event) {
    $("#customer-single-modal .single-customer-info-section .body-section .filter-btn-section .filter-panel").show();
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
    set_by_batch_menu_disabled();

}

function set_by_batch_menu_disabled() {
    var invoice_selected = false;
    var not_invoice_selected = false;
    var no_selected = true;
    var no_status_open_overdue = true;
    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td input[type='checkbox']").each(function() {
        if ($(this).is(":checked")) {
            no_selected = false;
            if ($(this).attr("data-row-type") != "Invoice") {
                not_invoice_selected = true;
            } else {
                invoice_selected = true;
            }

            if ($(this).attr("data-row-status") == "Open" || $(this).attr("data-row-status") == "Overdue") {
                no_status_open_overdue = false;
            }
        }

    });
    $("#customer-single-modal .seaction-above-table ul.by-batch-btn li.print-transaction-btn").removeClass("disabled");
    $("#customer-single-modal .seaction-above-table ul.by-batch-btn li.print-packaging-slip-btn").removeClass("disabled");
    $("#customer-single-modal .seaction-above-table ul.by-batch-btn li.send-transaction-btn").removeClass("disabled");
    $("#customer-single-modal .seaction-above-table ul.by-batch-btn li.send-reminder-btn").removeClass("disabled");

    if (not_invoice_selected) {
        $("#customer-single-modal .seaction-above-table ul.by-batch-btn li.print-transaction-btn").addClass("disabled");
        $("#customer-single-modal .seaction-above-table ul.by-batch-btn li.send-transaction-btn").addClass("disabled");
        if (!invoice_selected) {
            $("#customer-single-modal .seaction-above-table ul.by-batch-btn li.print-transaction-btn").addClass("disabled");
            $("#customer-single-modal .seaction-above-table ul.by-batch-btn li.print-packaging-slip-btn").addClass("disabled");
        }
    }
    if (no_selected) {
        $("#customer-single-modal .seaction-above-table ul.by-batch-btn li.print-transaction-btn").addClass("disabled");
        $("#customer-single-modal .seaction-above-table ul.by-batch-btn li.print-packaging-slip-btn").addClass("disabled");
        $("#customer-single-modal .seaction-above-table ul.by-batch-btn li.send-transaction-btn").addClass("disabled");
        $("#customer-single-modal .seaction-above-table ul.by-batch-btn li.send-reminder-btn").addClass("disabled");
    }
    if (no_status_open_overdue) {
        $("#customer-single-modal .seaction-above-table ul.by-batch-btn li.send-reminder-btn").addClass("disabled");
    }
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
$(document).on("click", "#customer-single-modal .single-customer-info-section .body-section .filter-btn-section .filter-panel .btn-success.apply-btn", function(event) {
    single_customer_get_transaction_lists($("#customer-single-modal input[name='customer_id']").val());
});

function single_customer_get_transaction_lists(customer_id) {
    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table th input[name='customer_checkbox_all']").prop("checked", false);
    var filter_type = $("#customer-single-modal .single-customer-info-section .body-section .filter-btn-section .filter-panel select[name='filter_type']").val();
    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table tbody").html("<tr><td colspan='18' style='text-align:center;color: #C7C7C7;'><center><img src='" + baseURL + "assets/img/accounting/customers/loader.gif' style='width:50px;' /></center></td></tr>");
    $.ajax({
        url: baseURL + "/accounting/single_customer_get_transaction_lists",
        type: "POST",
        dataType: "json",
        data: {
            customer_id: customer_id,
            filter_type: filter_type,
            filter_date: $("#customer-single-modal .single-customer-info-section .body-section .filter-btn-section .filter-panel select[name='filter_date']").val(),
        },
        success: function(data) {
            if (data.tbody_html == "") {
                $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table tbody").html("<tr><td colspan='18' style='text-align:center;color: #C7C7C7;'>No transaction list found.</td></tr>");
            } else {
                $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table tbody").html(data.tbody_html);
            }
            single_customer_table_columns_changed();
            single_customer_sortTable();
            table_viewing_affected(filter_type);
            $("#loader-modal").hide();
        },
    });

}

function table_viewing_affected(filter_type) {

    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-start-date']").parent().parent().hide();
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-start-date']").prop("checked", true);
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-start-date']").trigger("click");
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-end-date']").parent().parent().hide();
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-end-date']").prop("checked", true);
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-end-date']").trigger("click");
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-statement-type']").parent().parent().hide();
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-statement-type']").prop("checked", true);
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-statement-type']").trigger("click");


    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-accepted-by']").parent().parent().hide();
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-accepted-by']").prop("checked", true);
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-accepted-by']").trigger("click");
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-accepted-date']").parent().parent().hide();
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-accepted-date']").prop("checked", true);
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-accepted-date']").trigger("click");
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-expiration-date']").parent().parent().hide();
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-expiration-date']").prop("checked", true);
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-expiration-date']").trigger("click");

    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-txn-type']").parent().parent().hide();
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-txn-type']").prop("checked", true);
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-txn-type']").trigger("click");
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-interval']").parent().parent().hide();
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-interval']").prop("checked", true);
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-interval']").trigger("click");
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-prev-date']").parent().parent().hide();
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-prev-date']").prop("checked", true);
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-prev-date']").trigger("click");
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-next-date']").parent().parent().hide();
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-next-date']").prop("checked", true);
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-next-date']").trigger("click");
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-amount']").parent().parent().hide();
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-amount']").prop("checked", true);
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-amount']").trigger("click");

    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-no']").parent().parent().show();
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-type']").parent().parent().show();
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-method']").parent().parent().show();
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-source']").parent().parent().show();
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-memo']").parent().parent().show();
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-duedate']").parent().parent().show();
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-aging']").parent().parent().show();
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-balance']").parent().parent().show();
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-last-delivered']").parent().parent().show();
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-email']").parent().parent().show();
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-attachment']").parent().parent().show();
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-status']").parent().parent().show();
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-ponumber']").parent().parent().show();
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-sales-rep']").parent().parent().show();
    $("#customer-single-modal .setting-btn-section .settings-options .show-more-less").show();

    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-no']").prop("checked", false);
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-no']").trigger("click");
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-type']").prop("checked", false);
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-type']").trigger("click");
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-method']").prop("checked", true);
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-method']").trigger("click");
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-source']").prop("checked", true);
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-source']").trigger("click");
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-memo']").prop("checked", true);
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-memo']").trigger("click");
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-duedate']").prop("checked", false); //
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-duedate']").trigger("click");
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-aging']").prop("checked", false); //
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-aging']").trigger("click");
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-balance']").prop("checked", false); //
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-balance']").trigger("click");
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-last-delivered']").prop("checked", false); //
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-last-delivered']").trigger("click");
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-email']").prop("checked", true);
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-email']").trigger("click");
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-attachment']").prop("checked", false); //
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-attachment']").trigger("click");
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-status']").prop("checked", false); // 
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-status']").trigger("click");
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-ponumber']").prop("checked", true);
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-ponumber']").trigger("click");
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-sales-rep']").prop("checked", false); //
    $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-sales-rep']").trigger("click");
    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table th[data-column='total']").show();
    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td[data-column='total']").show();
    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table th[data-column='date']").show();
    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td[data-column='date']").show();

    if (filter_type == "Statements") {
        //customer_id,  P.O number, Sales Rep, No., Start Date, End date, Stement type, Action
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-start-date']").parent().parent().show();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-start-date']").prop("checked", false);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-start-date']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-end-date']").parent().parent().show();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-end-date']").prop("checked", false);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-end-date']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-statement-type']").parent().parent().show();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-statement-type']").prop("checked", false);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-statement-type']").trigger("click");


        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-method']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-method']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-method']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-source']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-source']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-source']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-memo']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-memo']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-memo']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-duedate']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-duedate']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-duedate']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-aging']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-aging']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-aging']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-balance']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-balance']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-balance']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-last-delivered']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-last-delivered']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-last-delivered']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-email']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-email']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-email']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-attachment']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-attachment']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-attachment']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-status']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-status']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-status']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-ponumber']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-ponumber']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-ponumber']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-sales-rep']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-sales-rep']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-sales-rep']").trigger("click");
        $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table th[data-column='total']").hide();
        $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table tbody td[data-column='total']").hide();
        $("#customer-single-modal .setting-btn-section .settings-options .show-more-less").hide();
    } else if (filter_type == "All plus deposits") {
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-type']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-type']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-no']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-no']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-method']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-method']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-source']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-source']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-memo']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-memo']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-duedate']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-duedate']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-aging']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-aging']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-balance']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-balance']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-last-delivered']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-last-delivered']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-email']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-email']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-attachment']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-attachment']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-status']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-status']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-ponumber']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-ponumber']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-sales-rep']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-sales-rep']").trigger("click");
    } else if (filter_type == "All invoices" || filter_type == "Open invoices" || filter_type == "Overdue invoices") {
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-method']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-source']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-type']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-type']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-no']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-no']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-method']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-method']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-source']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-source']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-memo']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-memo']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-duedate']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-duedate']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-aging']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-aging']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-balance']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-balance']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-last-delivered']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-last-delivered']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-email']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-email']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-attachment']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-attachment']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-status']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-status']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-ponumber']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-ponumber']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-sales-rep']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-sales-rep']").trigger("click");
    } else if (filter_type == "Open estimates") {
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-accepted-by']").parent().parent().show();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-accepted-by']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-accepted-by']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-accepted-date']").parent().parent().show();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-accepted-date']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-accepted-date']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-expiration-date']").parent().parent().show();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-expiration-date']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-expiration-date']").trigger("click");


        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-method']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-source']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-duedate']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-aging']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-balance']").parent().parent().hide();

        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-type']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-type']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-no']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-no']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-method']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-method']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-source']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-source']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-memo']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-memo']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-duedate']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-duedate']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-aging']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-aging']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-balance']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-balance']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-last-delivered']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-last-delivered']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-email']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-email']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-attachment']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-attachment']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-status']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-status']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-ponumber']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-ponumber']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-sales-rep']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-sales-rep']").trigger("click");
    } else if (filter_type == "Credit memos") {
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-method']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-source']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-duedate']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-aging']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-balance']").parent().parent().hide();

        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-type']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-type']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-no']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-no']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-method']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-method']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-source']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-source']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-memo']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-memo']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-duedate']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-duedate']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-aging']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-aging']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-balance']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-balance']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-last-delivered']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-last-delivered']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-email']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-email']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-attachment']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-attachment']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-status']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-status']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-ponumber']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-ponumber']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-sales-rep']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-sales-rep']").trigger("click");
    } else if (filter_type == "Unbilled income") {
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-method']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-source']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-duedate']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-aging']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-balance']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-last-delivered']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-email']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-ponumber']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-sales-rep']").parent().parent().hide();

        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-type']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-type']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-no']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-no']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-method']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-method']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-source']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-source']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-memo']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-memo']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-duedate']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-duedate']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-aging']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-aging']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-balance']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-balance']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-last-delivered']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-last-delivered']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-email']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-email']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-attachment']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-attachment']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-status']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-status']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-ponumber']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-ponumber']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-sales-rep']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-sales-rep']").trigger("click");
    } else if (filter_type == "Money received") {
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-method']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-source']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-duedate']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-aging']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-balance']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-last-delivered']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-email']").parent().parent().hide();

        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-type']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-type']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-no']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-no']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-method']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-method']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-source']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-source']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-memo']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-memo']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-duedate']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-duedate']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-aging']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-aging']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-balance']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-balance']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-last-delivered']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-last-delivered']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-email']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-email']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-attachment']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-attachment']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-status']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-status']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-ponumber']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-ponumber']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-sales-rep']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-sales-rep']").trigger("click");
    } else if (filter_type == "Recurring templates") {
        $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table th[data-column='date']").hide();
        $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td[data-column='date']").hide();
        $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table th[data-column='total']").hide();
        $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td[data-column='total']").hide();

        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-txn-type']").parent().parent().show();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-txn-type']").prop("checked", false);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-txn-type']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-interval']").parent().parent().show();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-interval']").prop("checked", false);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-interval']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-prev-date']").parent().parent().show();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-prev-date']").prop("checked", false);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-prev-date']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-next-date']").parent().parent().show();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-next-date']").prop("checked", false);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-next-date']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-amount']").parent().parent().show();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-amount']").prop("checked", false);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-amount']").trigger("click");

        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-no']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-method']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-source']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-duedate']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-aging']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-balance']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-last-delivered']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-memo']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-email']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-attachment']").parent().parent().hide();
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-status']").parent().parent().hide();

        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-type']").prop("checked", false);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-type']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-no']").prop("checked", true); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-no']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-method']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-method']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-source']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-source']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-memo']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-memo']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-duedate']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-duedate']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-aging']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-aging']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-balance']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-balance']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-last-delivered']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-last-delivered']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-email']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-email']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-attachment']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-attachment']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-status']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-status']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-ponumber']").prop("checked", true);
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-ponumber']").trigger("click");
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-sales-rep']").prop("checked", false); //
        $("#customer-single-modal .setting-btn-section .settings-options input[name='tbl-colum-sales-rep']").trigger("click");
    }
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
    $('#modal-container #new-customer-modal form').trigger("reset");
    $.ajax({
        url: baseURL + "/accounting/single_customer_get_customers_details",
        type: "POST",
        dataType: "json",
        data: { customer_id: customer_id },
        success: function(data) {
            $("#customer-single-modal .seaction-above-table .print-export-settings-btns button.export-btn").attr("data-customer-name", data.customer_details[0]['first_name'] + " " + data.customer_details[0]['last_name']);
            $("#customer-single-modal .seaction-above-table .print-export-settings-btns button.print-btn").attr("data-customer-name", data.customer_details[0]['last_name'] + ", " + data.customer_details[0]['first_name']);
            $("#customer-single-modal .seaction-above-table .print-export-settings-btns button.print-btn").attr("data-company-name", data.company_details['business_name']);
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
            if (data.customer_details[0]['mail_add'] != null && data.customer_details[0]['mail_add'] != "") {
                billing_address += data.customer_details[0]['mail_add'];
                $('#modal-container #new-customer-modal textarea[name="street"]').val(data.customer_details[0]['mail_add']);
            }
            if (data.customer_details[0]['city'] != null && data.customer_details[0]['city'] != "") {
                billing_address += "<br>" + data.customer_details[0]['city'];
                $('#modal-container #new-customer-modal input[name="city"]').val(data.customer_details[0]['city']);
            }
            if (data.customer_details[0]['state'] != null && data.customer_details[0]['state'] != "") {
                billing_address += ", " + data.customer_details[0]['state'];
                $('#modal-container #new-customer-modal input[name="state"]').val(data.customer_details[0]['state']);
            }
            if (data.customer_details[0]['zip_code'] != null && data.customer_details[0]['zip_code'] != "") {
                billing_address += "<br>" + data.customer_details[0]['zip_code'];
                $('#modal-container #new-customer-modal input[name="zip"]').val(data.customer_details[0]['zip_code']);
            }
            if (data.customer_details[0]['country'] != null && data.customer_details[0]['country'] != "") {
                billing_address += " " + data.customer_details[0]['country'];
                $('#modal-container #new-customer-modal input[name="country"]').val(data.customer_details[0]['country']);
            }
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='customer-name']").html(data.customer_details[0]['last_name'] + ", " + data.customer_details[0]['first_name']);
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='email']").html(data.customer_details[0]['email']);
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='phone']").html(data.customer_details[0]['phone_m']);
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='mobile']").html(data.customer_details[0]['contact_phone1']);
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='notes'] textarea").html(data.customer_details[0]['notes']);
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='billing-address']").html(billing_address);
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='customer-type']").html(data.customer_details[0]['customer_type']);

            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='fax']").html("");
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='website']").html("");
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='other']").html("");
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='shipping-address']").html("");
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='terms']").html("");
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='payment-method']").html("");
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='deleviry-method']").html("");
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='customer-language']").html("");
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='tax-reg-no']").html("");
            if (data.customer_details[0]['prefix'] != null) {
                $('#modal-container #new-customer-modal input[name="title"]').val(data.customer_details[0]['prefix']);
            }
            if (data.customer_details[0]['business_name'] != null) {
                $('#modal-container #new-customer-modal input[name="company"]').val(data.customer_details[0]['business_name']);
            }
            if (data.customer_details[0]['first_name'] != null) {
                $('#modal-container #new-customer-modal input[name="f_name"]').val(data.customer_details[0]['first_name']);
            }
            if (data.customer_details[0]['middle_name'] != null) {
                $('#modal-container #new-customer-modal input[name="m_name"]').val(data.customer_details[0]['middle_name']);
            }
            if (data.customer_details[0]['last_name'] != null) {
                $('#modal-container #new-customer-modal input[name="l_name"]').val(data.customer_details[0]['last_name']);
            }
            if (data.customer_details[0]['suffix'] != null) {
                $('#modal-container #new-customer-modal input[name="suffix"]').val(data.customer_details[0]['suffix']);
            }
            if (data.customer_details[0]['email'] != null) {
                $('#modal-container #new-customer-modal input[name="email"]').val(data.customer_details[0]['email']);
            }
            if (data.customer_details[0]['phone_m'] != null) {
                $('#modal-container #new-customer-modal input[name="phone"]').val(data.customer_details[0]['phone_m']);
            }
            if (data.customer_details[0]['contact_phone1'] != null) {
                $('#modal-container #new-customer-modal input[name="mobile"]').val(data.customer_details[0]['contact_phone1']);
            }
            if (data.customer_details[0]['customer_type'] != null) {
                $('#modal-container #new-customer-modal select[name="customer_type"]').val(data.customer_details[0]['customer_type']);
            }
            if (data.customer_details[0]['notes'] != null) {
                $('#modal-container #new-customer-modal textarea[name="notes"]').val(data.customer_details[0]['notes']);
            }
            if (data.customer_accounting_details.length > 0) {
                var shipping_address = "";
                if (data.customer_accounting_details[0]['shipping_address'] != null && data.customer_accounting_details[0]['shipping_address'] != "") {
                    shipping_address = data.customer_accounting_details[0]['shipping_address'];
                    $('#modal-container #new-customer-modal textarea[name="shipping_address"]').val(data.customer_accounting_details[0]['shipping_address']);
                }
                if (data.customer_accounting_details[0]['shipping_city'] != null && data.customer_accounting_details[0]['shipping_city'] != "") {
                    shipping_address += "<br>" + data.customer_accounting_details[0]['shipping_city'];
                    $('#modal-container #new-customer-modal input[name="shipping_city"]').val(data.customer_accounting_details[0]['shipping_city']);
                }
                if (data.customer_accounting_details[0]['shipping_state'] != null && data.customer_accounting_details[0]['shipping_state'] != "") {
                    shipping_address += ", " + data.customer_accounting_details[0]['shipping_state'];
                    $('#modal-container #new-customer-modal input[name="shipping_state"]').val(data.customer_accounting_details[0]['shipping_state']);
                }
                if (data.customer_accounting_details[0]['shipping_zip'] != null && data.customer_accounting_details[0]['shipping_zip'] != "") {
                    shipping_address += "<br>" + data.customer_accounting_details[0]['shipping_zip'];
                    $('#modal-container #new-customer-modal input[name="shipping_zip"]').val(data.customer_accounting_details[0]['shipping_zip']);
                }
                if (data.customer_accounting_details[0]['shipping_country'] != null && data.customer_accounting_details[0]['shipping_country'] != "") {
                    shipping_address += " " + data.customer_accounting_details[0]['shipping_country'];
                    $('#modal-container #new-customer-modal input[name="shipping_country"]').val(data.customer_accounting_details[0]['shipping_country']);
                }
                $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='fax']").html(data.customer_accounting_details[0]['fax_no']);
                $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='website']").html(data.customer_accounting_details[0]['website']);
                $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='other']").html("");
                $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='shipping-address']").html(shipping_address);
                $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='terms']").html(data.customer_accounting_details[0]['payment_terms']);
                $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='payment-method']").html(data.customer_accounting_details[0]['payment_method']);
                $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='deleviry-method']").html(data.customer_accounting_details[0]['delivery_method']);
                $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='customer-language']").html("");
                $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section.customer-details .customer-details-section .customer-info .info-value[data-for='tax-reg-no']").html("");
                if (data.customer_accounting_details[0]['display_name'] != null) {
                    $('#modal-container #new-customer-modal input[name="display_name"]').val(data.customer_accounting_details[0]['display_name']);
                }
                if (data.customer_accounting_details[0]['use_display_name'] != null) {
                    $('#modal-container #new-customer-modal input[name="use_display_name"]').val(data.customer_accounting_details[0]['use_display_name']);
                }
                if (data.customer_accounting_details[0]['print_check_name'] != null) {
                    $('#modal-container #new-customer-modal input[name="print_on_check_name"]').val(data.customer_accounting_details[0]['print_check_name']);
                }
                if (data.customer_accounting_details[0]['fax_no'] != null) {
                    $('#modal-container #new-customer-modal input[name="fax"]').val(data.customer_accounting_details[0]['fax_no']);
                }
                if (data.customer_accounting_details[0]['website'] != null) {
                    $('#modal-container #new-customer-modal input[name="website"]').val(data.customer_accounting_details[0]['website']);
                }
                if (data.customer_accounting_details[0]['is_sub_customer'] != null) {
                    $('#modal-container #new-customer-modal input[name="sub_customer"]').val(data.customer_accounting_details[0]['is_sub_customer']);
                }
                if (data.customer_accounting_details[0]['parent_customer_id'] != null) {
                    $('#modal-container #new-customer-modal select[name="parent_customer"]').val(data.customer_accounting_details[0]['parent_customer_id']);
                }
                if (data.customer_accounting_details[0]['bill_with'] != null) {
                    $('#modal-container #new-customer-modal select[name="bill_with"]').val(data.customer_accounting_details[0]['bill_with']);
                }
                if (data.customer_accounting_details[0]['shipping_address'] != null) {
                    $('#modal-container #new-customer-modal textarea[name="shipping_address"]').val(data.customer_accounting_details[0]['shipping_address']);
                }
                if (data.customer_accounting_details[0]['shipping_city'] != null) {
                    $('#modal-container #new-customer-modal input[name="shipping_city"]').val(data.customer_accounting_details[0]['shipping_city']);
                }
                if (data.customer_accounting_details[0]['shipping_state'] != null) {
                    $('#modal-container #new-customer-modal input[name="shipping_state"]').val(data.customer_accounting_details[0]['shipping_state']);
                }
                if (data.customer_accounting_details[0]['shipping_zip'] != null) {
                    $('#modal-container #new-customer-modal input[name="shipping_zip"]').val(data.customer_accounting_details[0]['shipping_zip']);
                }
                if (data.customer_accounting_details[0]['shipping_country'] != null) {
                    $('#modal-container #new-customer-modal input[name="shipping_country"]').val(data.customer_accounting_details[0]['shipping_country']);
                }
                if (data.customer_accounting_details[0]['tax_exempted'] != null) {
                    $('#modal-container #new-customer-modal input[name="cust_tax_exempt"]').prop("checked", true);
                }
                if (data.customer_accounting_details[0]['tax_rate'] != null) {
                    $('#modal-container #new-customer-modal select[name="tax_rate"]').val(data.customer_accounting_details[0]['tax_rate']);
                }
                if (data.customer_accounting_details[0]['reason_for_exemption'] != null) {
                    $('#modal-container #new-customer-modal select[name="reason_for_exemption"]').val(data.customer_accounting_details[0]['reason_for_exemption']);
                }
                if (data.customer_accounting_details[0]['exemption_details'] != null) {
                    $('#modal-container #new-customer-modal input[name="exemption_details"]').val(data.customer_accounting_details[0]['exemption_details']);
                }
                if (data.customer_accounting_details[0]['payment_method'] != null) {
                    $('#modal-container #new-customer-modal select[name="cust_payment_method"]').val(data.customer_accounting_details[0]['payment_method']);
                }
                if (data.customer_accounting_details[0]['delivery_method'] != null) {
                    $('#modal-container #new-customer-modal select[name="delivery_method"]').val(data.customer_accounting_details[0]['delivery_method']);
                }
                if (data.customer_accounting_details[0]['payment_terms'] != null) {
                    $('#modal-container #new-customer-modal select[name="cust_payment_terms"]').val(data.customer_accounting_details[0]['payment_terms']);
                }
                if (data.customer_accounting_details[0]['opening_balance'] != null) {
                    $('#modal-container #new-customer-modal input[name="opening_balance"]').val(data.customer_accounting_details[0]['opening_balance']);
                }
            }
        },
    });
}




$('#customer-single-modal .seaction-above-table .print-export-settings-btns button.export-btn').click(function() {
    let options = {
        "separator": ",",
        "newline": "\n",
        "quoteFields": true,
        "excludeColumns": "",
        "excludeRows": "",
        "trimContent": true,
        "filename": "Transaction List - " + $(this).attr("data-customer-name") + ".csv",
        "appendTo": "#output"
    }
    var attachment_th = $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table th[data-column='attachment']").html();
    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table th[data-column='attachment']").html("Attachment");
    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table th:last-child").hide();
    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td:last-child").hide();
    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table th:first-child").hide();
    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td:first-child").hide();
    $('#customer-single-modal .transaction-list-table #single_customer_table').table2csv('download', options);
    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table th:last-child").show();
    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td:last-child").show();
    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table th:first-child").show();
    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td:first-child").show();
    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table th[data-column='attachment']").html(attachment_th);
});
$('#customer-single-modal .seaction-above-table .print-export-settings-btns button.print-btn').click(function() {

    var attachment_th = $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table th[data-column='attachment']").html();
    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table th[data-column='attachment']").html("Attachment");
    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table th:last-child").hide();
    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td:last-child").hide();
    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table th:first-child").hide();
    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td:first-child").hide();

    var filter_type = $("#customer-single-modal .single-customer-info-section .body-section .filter-btn-section .filter-panel select[name='filter_type']").val();
    var filter_date = $("#customer-single-modal .single-customer-info-section .body-section .filter-btn-section .filter-panel select[name='filter_date']").val();
    var w = window.open();
    var html = `<!DOCTYPE html>
    <html lang="en">
    <title>Transaction List</title>
    <style>
        h1{
            text-align: center;
        }h3{
            text-align: center;
        }table {
            width: 100%;
            border-collapse: collapse;
        }thead tr {
            border-bottom: solid 2px #BFBFBF;
        }tbody tr {
            border-bottom: dotted 1px #BFBFBF;
        }th, td {
            padding: 10px;
            text-align: left;
            padding: 10px;
        }
    </style>
    <body>
        <h1>` + $(this).attr("data-company-name") + `</h1>
        <h3>Type: ` + filter_type + ` · Status: All statuses · Delivery method: Any · Name: ` + $(this).attr("data-customer-name") + ` · Date: ` + filter_date + `</h3>
        <table>` + $('#customer-single-modal .transaction-list-table #single_customer_table').html() + `</table>
    </body>
    <script>window.print();</script>
    </html>`;

    $(w.document.body).html(html);

    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table th:last-child").show();
    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td:last-child").show();
    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table th:first-child").show();
    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td:first-child").show();
    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table th[data-column='attachment']").html(attachment_th);
});
$(document).on("click", "#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td ul li.share-invoice-link-btn", function(event) {
    $.ajax({
        url: baseURL + "/accounting/generate_share_invoice_link",
        type: "POST",
        dataType: "json",
        data: {
            invoice_id: $(this).attr("data-invoice-id")
        },
        success: function(data) {
            $("div#share-link-modal").fadeIn();
            $('div#share-link-modal .the-modal-body .form-group input[name="shared_invoice_link"]').val(data.shared_link);
        },
    });
});
$(document).on("click", "div#share-link-modal .the-modal-body .btns button.cancel-btn", function(event) {
    $("div#share-link-modal").fadeOut();
});

$(document).on("click", "#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td .delete-invoice-btn", function(event) {
    Swal.fire({
        title: "Delete Invoice?",
        html: "Are you sure you want to delete this invoice? This invoice is linked to other transactions",
        imageUrl: baseURL + "assets/img/accounting/customers/delete.png",
        showCancelButton: true,
        confirmButtonColor: "#2ca01c",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, I want to delete this invoice!",
    }).then((result) => {
        if (result.value) {
            $("body").css({ 'cursor': 'wait' });
            $(this).css({ 'cursor': 'wait' });
            $.ajax({
                type: 'POST',
                url: baseURL + "invoice/deleteInvoiceBtnNew",
                data: { id: $(this).attr("data-invoice-id") },
                success: function(result) {
                    $("body").css({ 'cursor': 'default' });
                    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td .delete-invoice-btn").css({ 'cursor': 'default' });
                    if (result) {
                        Swal.fire({
                            showConfirmButton: false,
                            timer: 2000,
                            title: "Success",
                            html: "Invoice has been deleted.",
                            icon: "success",
                        });
                    }
                },
            });
            single_customer_page_get_all_customers($("#customer-single-modal input[name='customer_id']").val());
        }
    });
});
$(document).on("click", "div#share-link-modal .the-modal-body .btns button.copy-btn", function(event) {
    $('div#share-link-modal .the-modal-body .form-group input[name="shared_invoice_link"]').select();
    document.execCommand("copy");
    $("div#share-link-modal").fadeOut();
    $("body").append(`
    <div id="lou-customer-pop-up-alert">
        <div class="lou-pop-up-body">Copied to clipboard</div>
    </div>`);
    $("#lou-customer-pop-up-alert").fadeIn();
    setTimeout(function() {
        $("#lou-customer-pop-up-alert").fadeOut();
        setTimeout(function() { $("#lou-customer-pop-up-alert").remove(); }, 1000);
    }, 3000);
});

$(document).on("click", "#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td .print-invoice-btn", function(event) {
    $("body").css({ 'cursor': 'wait' });
    $(this).css({ 'cursor': 'wait' });
    $.ajax({
        url: baseURL + "accounting/customer_print_invoice_pdf",
        type: "POST",
        dataType: "json",
        data: {
            invoice_id: $(this).attr("data-invoice-id"),
            invoice_no: $(this).attr("data-invoice-no")
        },
        success: function(data) {
            var win = window.open(data.pdf_link, '_blank');
            if (win) {
                win.focus();
            } else {
                console.log('Please allow popups for this website');
            }
            $("body").css({ 'cursor': 'default' });
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td .print-invoice-btn").css({ 'cursor': 'default' });
        },
    });
});

$(document).on("click", "#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td .print-invoice-packaging-slip-btn", function(event) {
    $("body").css({ 'cursor': 'wait' });
    $(this).css({ 'cursor': 'wait' });
    $.ajax({
        url: baseURL + "accounting/print_invoice_packaging_slip",
        type: "POST",
        dataType: "json",
        data: {
            invoice_id: $(this).attr("data-invoice-id"),
            invoice_no: $(this).attr("data-invoice-no")
        },
        success: function(data) {
            var win = window.open(data.pdf_link, '_blank');
            if (win) {
                win.focus();
            } else {
                console.log('Please allow popups for this website');
            }
            $("body").css({ 'cursor': 'default' });
            $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td .print-invoice-packaging-slip-btn").css({ 'cursor': 'default' });
        },
    });
});

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
$(document).on("click", "#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td .copy-invoice-btn", function(event) {
    $("#create_invoice_modal").modal('toggle');
    $("#loader-modal").show();
    $.ajax({
        type: 'POST',
        dataType: "json",
        url: baseURL + "accounting/ajax_get_invoice_info",
        data: { invoice_id: $(this).attr("data-invoice-id") },
        success: function(data) {
            var items_html = "<tr>" + $("#create_invoice_modal .items-section table tbody tr:first-child").html() + "</tr>";
            console.log(data.invoice_items.length);
            for (var i = 0; i < data.invoice_items.length - 1; i++) {
                items_html += "<tr>" + $("#create_invoice_modal .items-section table tbody tr:first-child").html() + "</tr>";
            }
            $("#create_invoice_modal .items-section table tbody").html(items_html);
            for (var i = 0; i < data.invoice_items.length; i++) {
                $("#create_invoice_modal .items-section table tbody input[name='items[]']").eq(i).val(data.invoice_items[i]["title"]);
                $("#create_invoice_modal .items-section table tbody input[name='itemid[]']").eq(i).val(data.invoice_items[i]["items_id"]);
                $("#create_invoice_modal .items-section table tbody input[name='item_type[]']").eq(i).val(data.invoice_items[i]["item_type"]);
                $("#create_invoice_modal .items-section table tbody input[name='quantity[]']").eq(i).val(data.invoice_items[i]["qty"]);
                var cost = 0;
                if (data.invoice_items[i]["iCost"] != null) {
                    cost = data.invoice_items[i]["iCost"];
                }
                $("#create_invoice_modal .items-section table tbody input[name='price[]']").eq(i).val(cost);
                $("#create_invoice_modal .items-section table tbody input[name='tax[]']").eq(i).val(data.invoice_items[i]["tax"]);
                $("#create_invoice_modal .items-section table tbody input[name='discount[]']").eq(i).val("0.00");
                $("#create_invoice_modal .items-section table tbody input[name='tax_percent[]']").eq(i).val(data.invoice_items[i]["tax"] / (data.invoice_items[i]["qty"] * data.invoice_items[i]["iCost"]));
                $("#create_invoice_modal form .item-totals input[name='adjustment_name']").val(data.invoice_details["adjustment_name"]);
                $("#create_invoice_modal form .item-totals input[name='adjustment_value']").val(data.invoice_details["adjustment_value"]);
                $("#create_invoice_modal form input[name='invoice_job_location']").val(data.invoice_details["job_location"]);
                $("#create_invoice_modal form input[name='job_name']").val(data.invoice_details["job_name"]);
                $("#create_invoice_modal form select[name='terms']").val(data.invoice_details["terms"]);
                $("#create_invoice_modal form input[name='customer_email']").val(data.customer_info["acs_email"]);
                $("#create_invoice_modal form select[name='customer_id']").val(data.customer_info["prof_id"]);
                $("#create_invoice_modal form input[name='location_scale']").val(data.invoice_details["location_scale"]);
                $("#create_invoice_modal form input[name='tags']").val(data.invoice_details["tags"]);
                $("#create_invoice_modal form input[name='work_order_number']").val(data.invoice_details["work_order_number"]);
                $("#create_invoice_modal form input[name='purchase_order']").val(data.invoice_details["purchase_order"]);
                $("#create_invoice_modal form input[name='invoice_number']").val(data.invoice_details["invoice_number"]);
                $("#create_invoice_modal form input[name='date_issued']").val(data.invoice_details["date_issued"]);
                $("#create_invoice_modal form input[name='online_payments']").val(data.invoice_details["online_payments"]);
                $("#create_invoice_modal form textarea[name='billing_address']").html(data.invoice_details["billing_address"]);
                $("#create_invoice_modal form textarea[name='shipping_to_address']").html(data.invoice_details["shipping_to_address"]);
                $("#create_invoice_modal form input[name='ship_via']").val(data.invoice_details["ship_via"]);
                $("#create_invoice_modal form input[name='shipping_date']").val(data.invoice_details["shipping_date"]);
                $("#create_invoice_modal form input[name='tracking_number']").val(data.invoice_details["tracking_number"]);
                $("#create_invoice_modal form input[name='due_date']").val(data.invoice_details["due_date"]);
                $("#create_invoice_modal form textarea[name='message_to_customer']").html(data.invoice_details["message_to_customer"]);
                $("#create_invoice_modal form textarea[name='terms_and_conditions']").html(data.invoice_details["terms_and_conditions"]);
                $("#create_invoice_modal form input[name='status']").val(data.invoice_details["status"]);
                $("#create_invoice_modal form input[name='deposit_request_type']").val(data.invoice_details["deposit_request_type"]);
                $("#create_invoice_modal form input[name='deposit_amount']").val(data.invoice_details["deposit_request"]);
            }
            table_items_input_changed_auto();
            $("#loader-modal").hide();
        },
    });

});

function table_items_input_changed_auto() {
    $("#create_invoice_modal .items-section table tbody input[name='items[]']").map(function() {
        var qty = $(this).parent("td").parent("tr").find("input[name='quantity[]']").val();
        var price = $(this).parent("td").parent("tr").find("input[name='price[]']").val();
        var discount = $(this).parent("td").parent("tr").find("input[name='discount[]']").val();

        var tax = $(this).parent("td").parent("tr").find("input.tax-hide").val();
        var total = ((qty * price) + ((qty * price) * (tax / 100))) - discount;
        $(this).parent("td").parent("tr").find("input[name='tax[]']").val(Number((qty * price) * (tax / 100)).toLocaleString('en'));
        $(this).parent("td").parent("tr").find(".total_per_item").html(Number(total).toLocaleString('en'));
    });
    create_invoice_modal_compute_grand_total();
}

function print_by_batch(action = "") {
    var php_function = "";
    if (action == "packaging_slip") {
        php_function = "generate_customer_invoice_packaging_slip_by_batch";
    } else if (action == "transactions") {
        php_function = "print_transactions_by_batch";
    }
    var invoice_ids = new Array();
    var customer_id = $("#customer-single-modal input[name='customer_id']").val();
    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td input[type='checkbox']").each(function() {
        if ($(this).is(":checked")) {
            if ($(this).attr("data-row-type") == "Invoice") {
                invoice_ids.push($(this).attr("data-invoice-id"));
            }
        }
    });

    $("#loader-modal").show();
    $.ajax({
        url: baseURL + "accounting/" + php_function,
        type: "POST",
        dataType: "json",
        data: {
            customer_id: customer_id,
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
$(document).on("click", "#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td .void-invoice-btn", function(event) {
    Swal.fire({
        title: "Void Invoice?",
        html: "Are you sure you want to void this invoice? This invoice is linked to other transactions",
        imageUrl: baseURL + "assets/img/accounting/customers/cancellation.png",
        showCancelButton: true,
        confirmButtonColor: "#2ca01c",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, I want to voide this invoice!",
    }).then((result) => {
        if (result.value) {
            $("body").css({ 'cursor': 'wait' });
            $(this).css({ 'cursor': 'wait' });
            $.ajax({
                type: 'POST',
                url: baseURL + "invoice/void_invoice",
                data: { id: $(this).attr("data-invoice-id") },
                success: function(result) {
                    $("body").css({ 'cursor': 'default' });
                    $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td .void-invoice-btn").css({ 'cursor': 'default' });
                    if (result) {
                        Swal.fire({
                            showConfirmButton: false,
                            timer: 2000,
                            title: "Success",
                            html: "Invoice has been voided.",
                            icon: "success",
                        });
                        single_customer_page_get_all_customers($("#customer-single-modal input[name='customer_id']").val());
                    }
                },
            });
        }
    });
});

$(document).on("click", "#customer-single-modal .seaction-above-table ul.by-batch-btn li.print-packaging-slip-btn", function(event) {
    if (!$(this).hasClass("disabled")) {
        print_by_batch("packaging_slip");
    }
});
$(document).on("click", "#customer-single-modal .seaction-above-table ul.by-batch-btn li.print-transaction-btn", function(event) {
    if (!$(this).hasClass("disabled")) {
        print_by_batch("transactions");
    }
});


$(document).on("click", "#customer-single-modal .seaction-above-table ul.by-batch-btn li.send-transaction-btn", function(event) {
    if (!$(this).hasClass("disabled")) {
        event.preventDefault();
        $("body").css({ 'cursor': 'wait' });
        var invoice_ids = new Array();
        var customer_id = $("#customer-single-modal input[name='customer_id']").val();
        $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td input[type='checkbox']").each(function() {
            if ($(this).is(":checked")) {
                if ($(this).attr("data-row-type") == "Invoice") {
                    invoice_ids.push($(this).attr("data-invoice-id"));
                }
            }
        });

        $.ajax({
            url: baseURL + "accounting/send_transaction_by_batch",
            type: "POST",
            dataType: "json",
            data: {
                customer_id: customer_id,
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
$(document).on("click", "#customer-single-modal .seaction-above-table ul.by-batch-btn li.send-reminder-btn", function(event) {
    if (!$(this).hasClass("disabled")) {
        var invoice_numbers = "";
        var customer_id = $("#customer-single-modal input[name='customer_id']").val();
        $("#customer-single-modal .single-customer-info-section .body-section .tab-body-content-section .transaction-list-table table td input[type='checkbox']").each(function() {
            if ($(this).is(":checked")) {
                if ($(this).attr("data-row-status") == "Overdue" || $(this).attr("data-row-status") == "Open") {
                    invoice_numbers += ($(this).attr("data-invoice-number")) + ", ";
                }
            }
        });

        $("body").css({ 'cursor': 'wait' });
        $.ajax({
            url: baseURL + "accounting/get_customer_info",
            type: "POST",
            dataType: "json",
            data: {
                customer_id: customer_id,
            },
            success: function(data) {
                $("body").css({ 'cursor': 'default' });
                $("#send-reminder-modal .form-group input[name='subject']").val(`Reminder: Invoices from ` + data.business_name);

                var message = `Dear ` + data.customer_name + `,

Just a reminder that we have not received a payment for the following invoices. 

` + invoice_numbers + `

Let us know if you have questions.
                                    
Thanks for your business!
` + data.business_name;

                $("#send-reminder-modal .form-group textarea").html(message);
                $("#send-reminder-modal").addClass("show");
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
$(document).on("click", "#customer-single-modal #single_customer_table .print-statement-btn ", function(event) {
    window.open(baseURL + "assets/pdf/" + $(this).attr("type") + "_" + $(this).attr("data-statement-id") + ".pdf");
});