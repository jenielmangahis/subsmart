<div id="company_overview_modal">
    <div class="the-modal-body">
        <div class="the-header">
            <div class="row">
                <div class="col-md-6">
                    <div class="title">
                        <h1>Management Report</h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="icons">
                        <div><i class="fa fa-question-circle" aria-hidden="true"></i></div>
                        <div class="close-modal"><i class="fa fa-times" aria-hidden="true"></i></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="label">
                            Template name
                        </div>
                        <input type="text" class="form-control " name="shared_invoice_link">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group report-period">
                        <div class="label">
                            Report period
                        </div>
                        <select class="form-control" name="filter_type">
                            <option>All Dates</option>
                            <option>Custom</option>
                            <option>Today </option>
                            <option>This Week </option>
                            <option>This Week-to-date </option>
                            <option>This Month </option>
                            <option>This Month-to-date </option>
                            <option>This Quarter </option>
                            <option>This Quarter-to-date </option>
                            <option>This Year </option>
                            <option>This Year-to-date </option>
                            <option>This Year-to-last-month </option>
                            <option>Yesterday </option>
                            <option>Recent </option>
                            <option>Last Week </option>
                            <option>Last Week-to-date </option>
                            <option>Last Month </option>
                            <option>Last Month-to-date </option>
                            <option>Last Quarter </option>
                            <option>Last Quarter-to-date </option>
                            <option>Last Year </option>
                            <option>Last Year-to-date </option>
                            <option>Since 30 Days Ago </option>
                            <option>Since 60 Days Ago </option>
                            <option>Since 90 Days Ago </option>
                            <option>Since 365 Days Ago </option>
                            <option>Next Week </option>
                            <option>Next 4 Weeks </option>
                            <option>Next Month </option>
                            <option>Next Quarter </option>
                            <option>Next Year </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="the-content">
            <div class="row" style="height: 100%;">
                <div class="col-md-2" style="height: 100%;">
                    <div class="report-pages">
                        <ul>
                            <li class="active">
                                <center>
                                    <div class="mr_icon icon1" style="background-image: url('<?=base_url("assets/img/accounting/reports/management_reports_img.png")?>')"></div>
                                    <label for="img">Cover page</label>
                                </center>
                            </li>
                            <li>
                                <center>
                                    <div class="mr_icon icon2" style="background-image: url('<?=base_url("assets/img/accounting/reports/management_reports_img.png")?>')"></div>
                                    <label for="img">Table of contents</label>
                                </center>
                            </li>
                            <li>
                                <center>
                                    <div class="mr_icon icon3" style="background-image: url('<?=base_url("assets/img/accounting/reports/management_reports_img.png")?>')"></div>
                                    <label for="img">Preliminary pages</label>
                                </center>
                            </li>
                            <li>
                                <center>
                                    <div class="mr_icon icon4" style="background-image: url('<?=base_url("assets/img/accounting/reports/management_reports_img.png")?>')"></div>
                                    <label for="img">Reports</label>
                                </center>
                            </li>
                            <li>
                                <center>
                                    <div class="mr_icon icon5" style="background-image: url('<?=base_url("assets/img/accounting/reports/management_reports_img.png")?>')"></div>
                                    <label for="img">End notes</label>
                                </center>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9"></div>
            </div>
        </div>
        <div class="the-footer">
            <div class="modal-footer-check">
                <div class="row">
                    <div class="col-md-4">
                        <button class="btn btn-dark cancel-button" id="closeCheckModal" type="button">Cancel</button>
                    </div>
                    <div class="col-md-5" align="center">
                        <div class="middle-links">
                            <a href="" class="print-preview-option">Print or Preview</a>
                        </div>
                        <div class="middle-links end">
                            <a href="">Advance</a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dropdown" style="float: right">
                            <button class="btn btn-dark cancel-button px-4" data-submit-type="save"
                                type="submit">Save</button>
                            <button type="submit" data-submit-type="save-send" class="btn btn-success" id="checkSaved"
                                style="border-radius: 20px 0 0 20px">Save and close</button>
                            <button class="btn btn-success" type="button" data-toggle="dropdown"
                                style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                <span class="fa fa-caret-down"></span>&nbsp;</button>
                            <ul class="dropdown-menu dropdown-menu-right submit-submenu" role="menu">
                                <li>
                                    <button type="submit" data-submit-type="save-close" id="checkSaved" style="background: none;border: none; height: auto;font-size: 13px;padding: 10px;
                                                ">Save as</button>
                                </li>
                                <li>
                                    <button type="submit" data-submit-type="save-new" id="checkSaved" style="background: none;border: none; height: auto;font-size: 13px;padding: 10px;
                                                ">Export as DOCX</button>
                                </li>
                                <li>
                                    <button type="submit" data-submit-type="save-new" id="checkSaved" style="background: none;border: none; height: auto;font-size: 13px;padding: 10px;
                                                ">Export as PDF</button>
                                </li>
                                <li>
                                    <button type="submit" data-submit-type="save-new" id="checkSaved" style="background: none;border: none; height: auto;font-size: 13px;padding: 10px;
                                                ">Send</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>