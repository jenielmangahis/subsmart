<div id="send-reminder-by-batch-modal">
    <div class="monal-body">
        <div class="modal-title">
            <h2>Send Reminders</h2>
            <p class="normal">You are sending reminders for <span class="invoice-count"></span> invoices to the
                original
                recipients. </p>
            <div class="error-found">
                <div class="error-title">
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i> Email addresses missing
                </div>
                <div class="error-description">
                    There are missing valid email addresses and will not be
                    sent.
                </div>
            </div>
            <div class="close-btn">
                <img src="<?=base_url('assets/img/accounting/customers/close.png')?>"
                    alt="">
            </div>
        </div>
        <form id="send-reminder-by-batch-form">
            <input type="text" name="table-id" style="display: none;">
            <div class="send-reminder-modal-content">
                <div class="form-group">
                    <div class="label" for="receint-email">To</div>
                    <input type="text" name="to" readonly value="Lou Pinton;" />
                </div>
                <div class="form-group">
                    <div class="label" for="subject">Subject</div>
                    <input type="type" name="subject" readonly
                        value="Reminder: Invoice {invoice_number} from Alarm Direct, Inc" />
                </div>
                <div class="form-group">
                    <div class="label" for="message">Message</div>
                    <textarea name="message" rows="8" readonly maxlength="4000">Dear {customer_name},

Just a reminder that we have not received a payment for this invoice yet. Let us know if you have questions.
                                    
Thanks for your business!
nSMART, LLC</textarea>
                </div>
            </div>
            <div class="send-reminder-modal-footer">
                <button class="btn btn-default float-left cancel-btn" type="button">
                    Cancel
                </button>
                <button class="btn btn-success float-right" type="submit">
                    Send
                </button>
            </div>

        </form>
    </div>
</div>