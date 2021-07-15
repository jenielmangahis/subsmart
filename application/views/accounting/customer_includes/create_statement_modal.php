<!-- Modal for add account-->
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
                    <div class="modal-body" style="height:calc(100vh - 180px);padding-top:0;">
                        <div class="statement-type-section">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="statement-type-fields">
                                                <div class="form-group">
                                                    <div class="label">Customer</div>
                                                    <select class="form-control required" name="customer_id"
                                                        required="">
                                                        <option value="Balance Forward">Balance Forward</option>
                                                        <option value="Open Item">Open Item</option>
                                                        <option value="Open Item" selected>Transaction Statement
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
                        <div class="statement-date-section">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="label">Statement Date</div>
                                                <input type="text" class=""
                                                    value="<?=date("m/d/Y")?>"
                                                    name="statement-date" required>
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
                                                <input type="text" class=""
                                                    value="<?=date("m/d/Y")?>"
                                                    name="start-date" required>
                                            </div>
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
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="label">End Date</div>
                                                <input type="text" class=""
                                                    value="<?=date("m/d/Y")?>"
                                                    name="end-date" required>
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
                                            (0)</button>
                                        <button type="button" class="statement-available">Statement Available
                                            (1)</button>
                                    </div>
                                    <div class="table-list">
                                        <table class="receipients-list-table">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>RECIPIENTS</th>
                                                    <th>EMAIL ADDRESS</th>
                                                    <th>BALANCE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td>World Class Water, Inc
                                                        <input type="email" value="123" required name="customer_id[]"
                                                            style="display: none;">
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="email" value="pintonlou@gmail.com" required
                                                                name="email[]">
                                                        </div>
                                                    </td>
                                                    <td>$0.00</td>
                                                </tr>
                                            </tbody>
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
                                <button class="btn btn-dark cancel-button" type="button">Clear</button>

                            </div>
                            <div class="col-md-5" align="center">
                                <div class="middle-links">
                                    <a href="" class="print-preview-option">Print or Preview</a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dropdown" style="float: right">
                                    <button class="btn btn-dark cancel-button px-4" data-submit-type="save"
                                        type="submit">Save</button>
                                    <button type="submit" data-submit-type="save-send" class="btn btn-success"
                                        id="checkSaved" style="border-radius: 20px 0 0 20px">Save and send</button>
                                    <button class="btn btn-success" type="button" data-toggle="dropdown"
                                        style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right submit-submenu" role="menu">
                                        <li>
                                            <button type="submit" data-submit-type="save-close" id="checkSaved" style="background: none;border: none; height: auto;font-size: 13px;padding: 10px;
                                                ">Save and close</button>
                                        </li>
                                        <li>
                                            <button type="submit" data-submit-type="save-new" id="checkSaved" style="background: none;border: none; height: auto;font-size: 13px;padding: 10px;
                                                ">Save and new</button>
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
