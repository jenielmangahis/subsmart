function get_info_customer_reminder_by_batch(customer_ids, invoice_ids, tos, table_locator, business_name) {

    $("#send-reminder-by-batch-modal .form-group input[name='to']").val(tos);
    $("#send-reminder-by-batch-modal .form-group input[name='subject']").val(`Reminder: Invoice {invoice_number} from Alarm Direct, Inc`);
    $("#send-reminder-by-batch-modal .monal-body .modal-title p .invoice-count").html(customer_ids.length);
    var message = `Dear {vustomer_name},

Just a reminder that we have not received a payment for this invoice yet. Let us know if you have questions.
                                    
Thanks for your business!
` + business_name;

    $("#send-reminder-by-batch-modal .form-group textarea").html(message);
    $("#send-reminder-by-batch-modal").fadeIn();
}
$(document).on("click", "ul.customer-dropdown-menu li a.send-reminder", function() {
    // get_info_customer_reminder($(this).attr("data-customer-id"));
});
$(document).on("click", "#send-reminder-by-batch-modal .close-btn", function() {
    $("#send-reminder-by-batch-by-batch-modal").fadeOut();
});
$(document).on("click", "#send-reminder-by-batch-modal .send-reminder-modal-footer button.cancel-btn", function() {
    $("#send-reminder-by-batch-modal").fadeOut();
});