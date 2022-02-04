<div id="management_reports_modal">
    <form action="#" id="management_report_form">
        <input type="text" name="management_report_id" style="display: none;">
        <input type="text" name="cover_style" style="display: none;">
        <input type="text" name="deleted_reports_pages" style="display: none;">
        <input type="text" name="deleted_preliminary_pages" style="display: none;">
        <input type="text" name="action" style="display: none;">
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
                            <input type="text" class="form-control " name="template_name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group report-period">
                            <div class="label">
                                Report period
                            </div>
                            <select class="form-control" name="template_report_period">
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
                <div class="row" style="height: 100%; padding-bottom:61px;">
                    <div class="col-md-2" style="height: 100%;">
                        <div class="report-pages">
                            <ul>
                                <li class="active" data-target="cover-page-section">
                                    <center>
                                        <div class="mr_icon icon1" style="background-image: url('<?= base_url("assets/img/accounting/reports/management_reports_img.png") ?>')">
                                        </div>
                                        <label for="img">Cover page</label>
                                    </center>
                                </li>
                                <li data-target="table-of-contents">
                                    <center>
                                        <div class="mr_icon icon2" style="background-image: url('<?= base_url("assets/img/accounting/reports/management_reports_img.png") ?>')">
                                        </div>
                                        <label for="img">Table of contents</label>
                                    </center>
                                </li>
                                <li data-target="preliminary-page">
                                    <center>
                                        <div class="mr_icon icon3" style="background-image: url('<?= base_url("assets/img/accounting/reports/management_reports_img.png") ?>')">
                                        </div>
                                        <label for="img">Preliminary pages</label>
                                    </center>
                                </li>
                                <li data-target="reports">
                                    <center>
                                        <div class="mr_icon icon4" style="background-image: url('<?= base_url("assets/img/accounting/reports/management_reports_img.png") ?>')">
                                        </div>
                                        <label for="img">Reports</label>
                                    </center>
                                </li>
                                <li data-target="end-notes">
                                    <center>
                                        <div class="mr_icon icon5" style="background-image: url('<?= base_url("assets/img/accounting/reports/management_reports_img.png") ?>')">
                                        </div>
                                        <label for="img">End notes</label>
                                    </center>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="right-content">
                            <div id="cover-page-section">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="page-styles-img">
                                            <div class="cover-style">
                                                <div class="style-icon" style="background-image: url('<?= base_url("assets/img/accounting/reports/management_reports_img.png") ?>')">
                                                </div>
                                                <div class="dropdown-icon">
                                                    <i class="fa fa-sort-desc" aria-hidden="true"></i>
                                                </div>
                                                <div class="styles-option-section">
                                                    <div class="section-row">

                                                        <div class="style-option option-1" data-count="1" style="background-image: url('<?= base_url("assets/img/accounting/reports/management_reports_img.png") ?>')">
                                                        </div>

                                                        <div class="style-option option-2" data-count="2" style="background-image: url('<?= base_url("assets/img/accounting/reports/management_reports_img.png") ?>')">
                                                        </div>
                                                    </div>
                                                    <div class="section-row">

                                                        <div class="style-option option-3" data-count="3" style="background-image: url('<?= base_url("assets/img/accounting/reports/management_reports_img.png") ?>')">
                                                        </div>

                                                        <div class="style-option option-4" data-count="4" style="background-image: url('<?= base_url("assets/img/accounting/reports/management_reports_img.png") ?>')">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="logo-style">
                                                <div class="style-icon" style="background-image: url('<?= base_url("/uploads/users/business_profile/" . $company_details->logo_folder_id . "/" . $company_details->business_image) ?>')">
                                                </div>
                                                <div class="dropdown-icon">
                                                    <i class="fa fa-sort-desc" aria-hidden="true"></i>
                                                </div>
                                                <div class="styles-option-section">
                                                    <div class="form-check" style="padding: 0 12px;">
                                                        <div class="checkbox checkbox-sec margin-right">
                                                            <input type="checkbox" name="show-logo" id="show-logo" class="show-logo">
                                                            <label for="show-logo">Show logo</label>
                                                        </div>
                                                    </div>
                                                    <div class="section-row">
                                                        <div class="style-option">
                                                            <img src="<?= base_url("/uploads/users/business_profile/" . $company_details->logo_folder_id . "/" . $company_details->business_image) ?>" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cover-page-fields">
                                            <div class="form-group">
                                                <div class="label">
                                                    Cover title
                                                </div>
                                                <input type="text" class="form-control " name="cover_page_cover_title">
                                                <label class="info">100 characters max</label>
                                            </div>
                                            <div class="form-group">
                                                <div class="label">
                                                    Subtitle
                                                </div>
                                                <input type="text" class="form-control " name="cover_page_subtitle">
                                            </div>
                                            <div class="form-group">
                                                <div class="label">
                                                    Report period
                                                </div>
                                                <input type="text" class="form-control " name="cover_page_report_period">
                                            </div>
                                            <div class="form-group">
                                                <div class="label">
                                                    Prepared by
                                                </div>
                                                <input type="text" class="form-control " name="cover_page_prepared_by">
                                            </div>
                                            <div class="form-group">
                                                <div class="label">
                                                    Prepared date
                                                </div>
                                                <input type="text" class="form-control " name="cover_page_prepared_date">
                                            </div>
                                            <div class="form-group">
                                                <div class="label">
                                                    Disclaimer
                                                </div>
                                                <input type="text" class="form-control " name="cover_page_disclaimer">
                                                <label class="info">90 characters max</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="cover_page_template_view">
                                            <iframe src="" title="Cover page template view"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="table-of-contents" style="display: none;">
                                <div class="form-check" style="padding: 0 12px;">
                                    <div class="checkbox checkbox-sec margin-right">
                                        <input type="checkbox" name="include_table_of_contents" id="include-table-of-contents">
                                        <label for="include-table-of-contents">Include Table of Contents</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="label">
                                        Page title
                                    </div>
                                    <input type="text" class="form-control " name="table_of_contents_page_title" value="Table of Contents">
                                </div>
                                <div class="page-content">
                                    <div class="form-group">
                                        <div class="label">
                                            Page content
                                        </div>
                                    </div>
                                    <div class="page-content-preview">
                                        <div class="content-title">Table of Contents</div>
                                        <div class="divider"></div>
                                        <div class="norms">
                                            <div class="norm">Profit and Loss</div>
                                            <div class="norm">Balance Sheet</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="preliminary-page" style="display: none;">
                                <div class="pages">

                                </div>
                                <a href="#" class="add-new-page">Add new page</a>
                            </div>
                            <div id="reports" style="display: none;">
                                <div class="sections">
                                </div>
                                <a href="#" class="add-report-btn">Add new report</a>
                            </div>
                            <div id="end-notes" style="display: none;">
                                <div class="page">
                                    <div class="form-check" style="padding: 0 12px;">
                                        <div class="checkbox checkbox-sec margin-right">
                                            <input type="checkbox" name="end_notes_include_this_page" id="end_notes_include_this_page">
                                            <label for="end_notes_include_this_page">Include this page</label>
                                        </div>
                                    </div>
                                    <div class="form-check" style="padding: 0 12px;">
                                        <div class="checkbox checkbox-sec margin-right">
                                            <input type="checkbox" name="end_notes_include_breakdown_of_sub_accounts" id="end_notes_include_breakdown_of_sub_accounts">
                                            <label for="end_notes_include_breakdown_of_sub_accounts">Include breakdown of
                                                sub-accounts</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="label">
                                            Page title
                                        </div>
                                        <input type="text" class="form-control " name="end_notes_page_title" placeholder="e.g. Notes to the Financial Statements">
                                    </div>
                                    <div class="page-content">
                                        <div class="form-group">
                                            <div class="label">
                                                Page content
                                            </div>
                                        </div>
                                        <div class="page-content-field">
                                            <textarea class="form-control ckeditor" name="end_notes_page_content" id="end_notes_page_content" cols="40" rows="20"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                <button class="btn btn-dark cancel-button px-4" data-submit-type="save" type="submit">Save</button>
                                <button type="submit" data-submit-type="save-send" class="btn btn-success" id="checkSaved" style="border-radius: 20px 0 0 20px">Save and close</button>
                                <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
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

        <div id="advance_field_modal">
            <div class="body">
                <div class="close-btn">x</div>
                <h6>Fields</h6>
                <div class="top-section">
                    <div class="fieds">
                        <div class="option">1. {Report end date}</div>
                        <div class="coresponding">December 31, 2022</div>
                    </div>
                    <div class="fieds">
                        <div class="option">2. {Company name}</div>
                        <div class="coresponding">
                            <div class="form-group">
                                <input type="text" class="form-control " name="af_company_name" placeholder="Company name">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="middle-section">
                    <div class="form-group">
                        <div class="label">
                            Header
                        </div>
                        <input type="text" class="form-control " name="af_header" placeholder="Page Header">
                        <div class="options-section">
                            <div class="label">{..}</div>
                            <div class="options">
                                <div class="option">{Report end date}</div>
                                <div class="option">{Company name}</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            Footer
                        </div>
                        <input type="text" class="form-control " name="af_footer" placeholder="Page Header">
                        <div class="options-section">
                            <div class="label">{..}</div>
                            <div class="options">
                                <div class="option">{Report end date}</div>
                                <div class="option">{Company name}</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-check" style="padding: 0 12px;">
                        <div class="checkbox checkbox-sec margin-right">
                            <input type="checkbox" name="af_only_zero" id="af_only_zero">
                            <label for="af_only_zero">Show only non-zero rows and columns</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="pdf_preview_section">
                        <a type="button" class="cancel-button" data-dismiss="modal">Cancel</a>
                        <a type="button" class="print-button" target="_blank" >Save</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>