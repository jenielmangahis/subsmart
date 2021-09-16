<!-- Modal for add account-->

<div class="modal  fade modal-fluid" tabindex="-1" role="dialog" id="statement_pdf_preview_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Print Statement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" id="send_statement">
                <input type="text" name="file_name_ids" class="" style="display: none;">
                <input type="text" name="statement_type" class="" style="display: none;">
                <input type="text" name="customer_id" class="" style="display: none;">
                <div class="modal-body">
                    <div class="row pdf_preview_section">
                        <div class="col-md-12">
                            <div class="pdf-print-preview"></div>
                        </div>
                    </div>
                    <div class="row send_statement_section" style="display: none;">
                        <div class="col-md-6">
                            <div class="send_statement_form_part">
                                <div class="form-group">
                                    <div class="label" for="subject">Email</div>
                                    <input type="email" name="email" class="required" value="pintonlou@gmail.com"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <div class="label" for="subject">Subject</div>
                                    <input type="type" name="subject" class="required"
                                        value="Reminder: Invoice [Invoice No.] from Alarm Direct, Inc" required>
                                </div>
                                <div class="form-group">
                                    <div class="label" for="subject">Body</div>
                                    <textarea name="body" class="required" rows="8" maxlength="4000" spellcheck="false"
                                        required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="send_sales_receipt-preview"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="pdf_preview_section">
                        <a type="button" class="cancel-button" data-dismiss="modal">Cancel</a>
                        <a type="button" class="print-button" target="_blank">Print</a>
                    </div>
                    <div class="send_statement_section">
                        <a type="button" class="cancel-button" data-dismiss="modal">Cancel</a>
                        <button type="submit" class="send-button" target="_blank">Send</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="full-screen-modal">
    <div id="create_statement_modal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">
                        Create Statements
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i
                            class="fa fa-times fa-lg"></i></button>
                </div>
                <form action="<?php echo site_url()?>" method="post">
                    <input type="text" name="statement-modal-type" style="display: none;">
                    <input type="text" name="customer_id" style="display: none;">
                    <input type="text" name="current_statement_id" style="display: none;">
                    <div class="by-batch-ids-holder" style="display: none;">
                        <input type="text" name="by_batch_ids[]" value="" style="display: none;">
                    </div>
                    <div class="by-batch-satement-ids-holder" style="display: none;">
                        <input type="text" name="by_batch_statement_ids[]" value="" style="display: none;">
                    </div>
                    <div class="modal-body" style="height:calc(100vh - 170px);padding-top:0;">
                        <div class="statement-type-section">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="statement-type-fields">
                                                <div class="form-group">
                                                    <div class="label">Statement Type</div>
                                                    <select class="form-control required" name="statement_type"
                                                        required="">
                                                        <option value="Balance Forward">Balance Forward</option>
                                                        <option value="Open Item">Open Item</option>
                                                        <option value="Transaction Statement" selected>Transaction
                                                            Statement
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="statement-monitary-balance text-right">
                                        <label for="">TOTAL BALANCE FOR <span>1</span> CUSTOMER</label>
                                        <div class="amount">$0.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="error-notif-section" style="display: none;">
                            <div class="title">
                                <i class="fa fa-exclamation-circle" aria-hidden="true"></i> <span>ERROR</span>
                            </div>
                            <div class="message">
                                No Statements to Save
                            </div>
                        </div>
                        <div class="statement-date-section">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="label">Statement Date</div>
                                                <input type="date" class=""
                                                    value="<?=date("Y-m-d")?>"
                                                    name="statement_date" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="start-end-date-section">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="label">Start Date</div>
                                                <input type="date" class=""
                                                    value="<?=date("Y-m-d")?>"
                                                    name="start_date" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="label">End Date</div>
                                                <input type="date"
                                                    value="<?=date("Y-m-d")?>"
                                                    class="" name="end_date" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="start-end-date-section button-section">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="apply-btn-part">
                                                <button type="button" class="apply-btn">Apply</button>
                                                <div class="information-panel">
                                                    <div class="panel-anchor">
                                                        <img src="<?=base_url("/assets/img/accounting/customers/blue-info-panel-anchor.png")?>"
                                                            alt="">
                                                    </div>
                                                    <div class="head">
                                                        <div class="title">Apply</div>
                                                        <div class="close-panel">x</div>
                                                    </div>
                                                    <div class="message">If you make changes to any of the statement
                                                        criteria, you need to click Apply to update the balance and
                                                        number of customers. This does not save the statements.</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="recipient-list-section">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="title">
                                        <i class="fa fa-caret-right" aria-hidden="true"></i> Recipients List
                                    </div>
                                    <div class="btns">
                                        <button type="button" class="missing-email-address">Missing email address
                                            (<span></span>)</button>
                                        <button type="button" class="statement-unavailable">Statement Unavailable
                                            (<span></span>)</button>
                                        <button type="button" class="statement-available">Statement Available
                                            (<span></span>)</button>
                                    </div>
                                    <div class="table-list">
                                        <table class="receipients-list-table">
                                            <thead>
                                                <tr>
                                                    <th class="column-check_box">
                                                        <div class="form-check">
                                                            <div class="checkbox checkbox-sec margin-right">
                                                                <input type="checkbox" name="customer_checkbox_all"
                                                                    id="customer_checkbox_all"
                                                                    class="customer_checkbox">
                                                                <label for="customer_checkbox_all"><span></span></label>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <th>RECIPIENTS</th>
                                                    <th class="column-email">EMAIL ADDRESS</th>
                                                    <th>BALANCE</th>
                                                </tr>
                                            </thead>
                                            <tbody class="unavaibale_tbody"></tbody>
                                            <tbody class="available_tbody"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer-check">
                        <div class="row">
                            <div class="col-md-4">
                                <button class="btn btn-dark cancel-button" type="button"
                                    data-dismiss="modal">Cancel</button>
                                <button class="btn btn-dark cancel-button" type="button"
                                    data-action="clear">Clear</button>

                            </div>
                            <div class="col-md-5" align="center">
                                <div class="middle-links">
                                    <button type="submit" class="print-preview-option" data-submit-type="print">Print or
                                        Preview</button>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dropdown" style="float: right">
                                    <button class="btn btn-dark cancel-button px-4" data-submit-type="save"
                                        type="submit">Save</button>
                                    <button type="submit" data-submit-type="save-send" class="btn btn-success"
                                        id="checkSaved" style="border-radius: 20px 0 0 20px">Save and send</button>
                                    <button class="btn btn-success" type="button" data-toggle="dropdown"
                                        style="border-radius: 0 20px 20px 0;margin-left: -5px;padding:8px;">
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right submit-submenu" role="menu">
                                        <li>
                                            <button type="submit" data-submit-type="save-close" id="checkSaved" style="background: none;border: none; height: auto;font-size: 13px;padding: 10px;
                                                ">Save and close</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="security-assurance-section">
                    <div class="texts">
                        <span><i class="fa fa-lock fa-lg" style="color: rgb(225,226,227);margin-right: 15px"></i> At
                            nSmartrac, the privacy and
                            security of your information are top priorities.</span>
                    </div>
                    <div class="privacy-link">
                        <a href="">Privacy</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</div>

<?php include viewPath('accounting/add_new_payment_method');
