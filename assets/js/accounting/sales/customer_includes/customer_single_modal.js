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
    $.ajax({
        url: baseURL + "/accounting/single_customer_get_transaction_lists",
        type: "POST",
        dataType: "json",
        data: {
            customer_id: customer_id,
            filter_type: $("#customer-single-modal .single-customer-info-section .body-section .filter-btn-section .filter-panel select[name='filter_type']").val(),
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


function copyToClipboard(elem) {
    // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);

    // copy the selection
    var succeed;
    try {
        succeed = document.execCommand("copy");
    } catch (e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }

    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
}