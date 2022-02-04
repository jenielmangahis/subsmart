$(document).on("click", "ul.customer-dropdown-menu li a.send-reminder", function() {
    get_info_customer_reminder($(this).attr("data-customer-id"));

});
$(document).on("click", "#send-reminder-modal .close-btn", function() {
    $("#send-reminder-modal").removeClass("show");
});
$(document).on("click", "#send-reminder-modal .send-reminder-modal-footer button.cancel-btn", function() {
    $("#send-reminder-modal").removeClass("show");
});

function get_info_customer_reminder(customer_id, data_action_from = "", data_invoice_number = "") {

    $.ajax({
        url: baseURL + "/accounting/get_info_customer_reminder",
        type: "POST",
        dataType: "json",
        data: {
            customer_id: customer_id
        },
        success: function(data) {
            $("#send-reminder-modal").addClass("show");
            if (data.cutsomer_email == null || data.cutsomer_email == "") {
                $("#send-reminder-modal .error-found").show();
                $("#send-reminder-modal .modal-title p.normal").hide();
                $("#send-reminder-modal #send-reminder-form button[type='submit']").attr("disabled", "true");
                $("#send-reminder-modal .form-group input[name='receint-email']").hide();
                $("#send-reminder-modal .error-found .error-description span.invoice-count").html(data.invoice_count);
            } else {
                $("#send-reminder-modal .error-found").hide();
                $("#send-reminder-modal .modal-title p.normal").show();
                $("#send-reminder-modal #send-reminder-form button[type='submit']").removeAttr("disabled");
                $("#send-reminder-modal .form-group input[name='receint-email']").show();
            }
            $("#send-reminder-modal .form-group input[name='receint-email']").val(data.cutsomer_email);
            $invoice_number = "Invoice No.";
            if (data_action_from == "single-customer-view-modal") {
                $invoice_number = data_invoice_number;
            }
            $("#send-reminder-modal .form-group input[name='subject']").val(`Reminder: Invoice [` + $invoice_number + `] from ` + data.business_name);
            $("#send-reminder-modal .monal-body .modal-title p .invoice-count").html(1);
            var message = `Dear ` + data.name + `,

Just a reminder that we have not received a payment for this invoice yet. Let us know if you have questions.
                                    
Thanks for your business!
` + data.business_name;

            $("#send-reminder-modal .form-group textarea").html(message);

        },
    });
}
$("#send-reminder-form").submit(function(event) {

    event.preventDefault();
    var customer_email = $("#send-reminder-form input[name='receint-email']").val();
    var subject = $("#send-reminder-form input[name='subject']").val();
    var message = $("#send-reminder-form textarea[name='message']").html();
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
                url: baseURL + "/accounting/send_customer_reminder",
                type: "POST",
                dataType: "json",
                data: {
                    subject: subject,
                    customer_name: "",
                    message: message,
                    customer_email: customer_email,
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
            });
        }
    });
});