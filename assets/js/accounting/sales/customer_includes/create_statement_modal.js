var error_found = 0;
$(document).on("click", "#create_statement_modal .apply-btn-part .information-panel .close-panel", function(event) {
    $("#create_statement_modal .apply-btn-part .information-panel").hide();
});
$('#create_statement_modal').on('shown.bs.modal', function(e) {
    $("#create_statement_modal .recipient-list-section").hide();
    $("#create_statement_modal .apply-btn-part .information-panel").show();
})

$(document).on("click", ".created-statement-btn", function(event) {
    $("#create_statement_modal form input[name='customer_id']").val($(this).attr("data-customer-id"));
});
$(document).on("change", "#create_statement_modal form input[name='customer_checkbox[]']", function(event) {
    customer_checkbox_changed();
});
$(document).on("change", "#create_statement_modal form input[name='customer_checkbox_all']", function(event) {
    customer_checkbox_all_changed();
});
$(document).on("change", "#create_statement_modal form input[name='start_date']", function(event) {
    date_range_changed();
});
$(document).on("change", "#create_statement_modal form input[name='end_date']", function(event) {
    date_range_changed();
});

$(document).on("click", "div#create_statement_modal .start-end-date-section .apply-btn-part .apply-btn", function(event) {
    var statement_type = $("#create_statement_modal form select[name='statement_type']").val();
    $.ajax({
        url: baseURL + "/accounting/create_statement_get_result_by_customer",
        type: "POST",
        dataType: "json",
        data: $("#create_statement_modal form").serialize(),
        success: function(data) {
            if (data.result) {
                $("#create_statement_modal .recipient-list-section").show();
                if (statement_type == "Transaction Statement") {
                    $("#create_statement_modal .apply-btn-part .information-panel").hide();
                    $("#create_statement_modal .recipient-list-section table.receipients-list-table tbody").html(data.tbody);
                    $("#create_statement_modal .statement-monitary-balance .amount").html("$" + data.display_balance);
                    customer_checkbox_changed();
                    if (data.transaction_count > 0) {
                        error_found = 0;
                        $("#create_statement_modal .error-notif-section").hide();
                    } else {
                        error_found = 1;
                        $("#create_statement_modal .error-notif-section").show();
                    }
                }
            }

        },
    });
});

function customer_checkbox_all_changed() {
    if ($("#create_statement_modal form input[name='customer_checkbox_all']").is(":checked")) {
        $("#create_statement_modal form input[name='customer_checkbox[]']").prop("checked", true);
    } else {
        $("#create_statement_modal form input[name='customer_checkbox[]']").prop("checked", false);
    }
}

function customer_checkbox_changed() {
    // var customer_checkbox_values = $("#create_statement_modal form input[name='customer_checkbox[]']")
    //     .map(function() { return $(this).val(); }).get();
    var number_of_checked = $("#create_statement_modal form input[name='customer_checkbox[]']:checked").length;
    var number_of_customer = $("#create_statement_modal form input[name='customer_checkbox[]']").length;
    if (number_of_checked == number_of_customer) {
        $("#create_statement_modal form input[name='customer_checkbox_all']").prop("checked", true);
    } else {
        $("#create_statement_modal form input[name='customer_checkbox_all']").prop("checked", false);
    }
}

function date_range_changed() {
    $("#create_statement_modal .apply-btn-part .information-panel").show();
    $("#create_statement_modal .recipient-list-section table.receipients-list-table tbody").html("");
    $("#create_statement_modal .statement-monitary-balance .amount").html("$0.00");
    $("#create_statement_modal .recipient-list-section").hide();
    customer_checkbox_changed();
}

$("#create_statement_modal form").submit(function(event) {
    event.preventDefault();
});
$(document).on("click", "#create_statement_modal form button[type='submit']", function(event) {
    var submit_type = $(this).attr("data-submit-type");
    if (error_found == 0) {
        $.ajax({
            url: baseURL + "/accounting/save_created_statement",
            type: "POST",
            dataType: "json",
            data: $("#create_statement_modal form").serialize(),
            success: function(data) {
                if (data.result) {

                }

            },
        });
    }
});