<div id="management_reports_email_modal">
    <div class="body">
        <form action="" id="management_report_email_form">
            <input type="text" name="management_report_id" style="display: none;">
            <div class="header">
                <h3 class="modal-title">Email Management Report</h3>
                <div class="btn-close-modal">x</div>
            </div>
            <div class="content">
                <div class="form-group">
                    <div class="label">
                        To
                    </div>
                    <input type="email" class="form-control required" name="to" required>
                </div>
                <div class="form-group">
                    <div class="label">
                        Cc
                    </div>
                    <input type="email" class="form-control required" name="cc" value="<?= $users->email ?>" required>
                </div>
                <div class="form-group">
                    <div class="label">
                        Subject
                    </div>
                    <input type="text" class="form-control required" name="subject" value="Financial Statements" required>
                </div>
                <div class="form-group">
                    <div class="label">
                        Body
                    </div>
                    <textarea name="body" id="" cols="30" rows="10" class="required" required>Hello,

Attached is a management report package I prepared about <?= $company_details->business_name ?>. It contains financial reports and other helpful information.

Please get in touch if you have any questions.

Regards
<?= $users->FName ?> <?= $users->LName ?></textarea>
                </div>
                <div class="form-group">
                    <div class="label">
                        Filename
                    </div>
                    <div class="row">
                        <div class="col-md-8" style="padding-right: 0;"><input type="text" class="form-control required" name="filename" required></div>
                        <div class="col-md-4" style="padding-left: 5px;">
                            <div style="padding: 10px 0;">.pdf</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="pdf_preview_section">
                    <a type="button" class="cancel-button" data-dismiss="modal">Cancel</a>
                    <button type="submit" class="save-button">Send email</button>
                </div>
            </div>
        </form>
    </div>
</div>