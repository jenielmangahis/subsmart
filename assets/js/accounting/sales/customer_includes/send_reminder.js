$(document).on("click", "ul.customer-dropdown-menu li a.send-reminder", function() {
    $("#send-reminder-modal").addClass("show");
    get_info_customer_reminder($(this).attr("data-customer-id"));

});
$(document).on("click", "#send-reminder-modal .close-btn", function() {
    $("#send-reminder-modal").removeClass("show");
});
$(document).on("click", "#send-reminder-modal .send-reminder-modal-footer button.cancel-btn", function() {
    $("#send-reminder-modal").removeClass("show");
});

function get_info_customer_reminder(customer_id) {
    $.ajax({
        url: baseURL + "/accounting/get_info_customer_reminder",
        type: "POST",
        dataType: "json",
        data: {
            customer_id: customer_id
        },
        success: function(data) {
            $("#send-reminder-modal .form-group input[name='receint-email']").val(data.cutsomer_email);
            $("#send-reminder-modal .monal-body .modal-title p .invoice-count").html(data.invoice_count);
            var message = `Dear ` + data.name + `,

Just a reminder that we have not received a payment for this invoice yet. Let us know if you have questions.
                                    
Thanks for your business!
Alarm Direct, Inc`;

            $("#send-reminder-modal .form-group textarea").html(message);

        },
    });
}