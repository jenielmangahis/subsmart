<div id="send-reminder-modal">
    <div class="monal-body">
        <div class="modal-title">
            <h2>Send Reminders</h2>
            <p class="normal">You are sending reminders for <span class="invoice-count">1</span> invoices to the
                original
                recipients. Please compose your
                message below.</p>
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
        <form id="send-reminder-form">
            <div class="send-reminder-modal-content">
                <div class="form-group">
                    <div class="label" for="receint-email">Email</div>
                    <input type="email" name="receint-email" readonly value="pintonlou@gmail.com" />
                </div>
                <div class="form-group">
                    <div class="label" for="subject">Subject</div>
                    <input type="type" name="subject" value="Reminder: Invoice [Invoice No.] from Alarm Direct, Inc" />
                </div>
                <div class="form-group">
                    <div class="label" for="message">Message</div>
                    <textarea name="message" rows="8" maxlength="4000"></textarea>
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