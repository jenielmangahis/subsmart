function get_info_customer_reminder_by_batch(customer_ids, invoice_ids, tos, table_locator, business_name) {
    g_customer_ids = customer_ids;
    g_invoice_ids = invoice_ids
    $("#send-reminder-by-batch-modal .form-group input[name='to']").val(tos);
    $("#send-reminder-by-batch-modal .form-group input[name='subject']").val(`Reminder: Invoice {invoice_number} from Alarm Direct, Inc`);
    $("#send-reminder-by-batch-modal .monal-body .modal-title p .invoice-count").html(customer_ids.length);
    var message = `Dear {customer_name},

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
    $("#send-reminder-by-batch-modal").fadeOut();
});
$(document).on("click", "#send-reminder-by-batch-modal .send-reminder-modal-footer button.cancel-btn", function() {
    $("#send-reminder-by-batch-modal").fadeOut();
});

var g_customer_ids;
var g_invoice_ids;

$("#send-reminder-by-batch-form").submit(function(event) {
    event.preventDefault();
    console.log(g_invoice_ids);
    var subject = $("#send-reminder-by-batch-form input[name='subject']").val();
    var message = $("#send-reminder-by-batch-form textarea[name='message']").html();
    Swal.fire({
        title: "Send?",
        html: "Are you sure you want to send this reminder?",
        showCancelButton: true,
        imageUrl: baseURL + "/assets/img/accounting/customers/message.png",
        cancelButtonColor: "#d33",
        confirmButtonColor: "#2ca01c",
        confirmButtonText: "Send now",
    }).then((result) => {
        if (result.value) {
            $("#loader-modal").show();
            $.ajax({
                url: baseURL + "accounting/customer-reminder/send/by-batch",
                type: "POST",
                dataType: "json",
                data: {
                    subject: subject,
                    message: message,
                    customer_ids: g_customer_ids,
                    invoice_ids: g_invoice_ids,
                },
                success: function(data) {
                    $("#loader-modal").hide();
                    if (data.status == "success") {
                        Swal.fire({
                            showConfirmButton: false,
                            timer: 2000,
                            title: "Success",
                            html: "Customer reminder has been sent",
                            icon: "success",
                        });
                    } else {
                        Swal.fire({
                            showConfirmButton: false,
                            timer: 2000,
                            title: "Error",
                            html: "Unable to send the reminder.<br>" + data.error,
                            icon: "error",
                        });
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    $("#loader-modal").hide();
                    $("body").css({ 'cursor': 'default' });
                    Swal.fire({
                        showConfirmButton: false,
                        timer: 2000,
                        title: "Unsent",
                        html: "Please try again later.",
                        icon: "error",
                    });
                },
            });
        }
    });
});