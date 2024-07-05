<?php include viewPath('v2/includes/accounting_header'); ?>

<div class="row page-content g-0">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <!-- <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search">
                        </div> -->
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button">
                                <i class='bx bx-fw bx-customize'></i> Customize
                            </button>
                            <button type="button" class="nsm-button primary">
                                <i class='bx bx-fw bx-save'></i> Save customization
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-12 col-md-6 offset-md-3">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header d-block">
                                <div class="row">
                                    <div class="col-12 col-md-6 grid-mb">
                                        <div class="nsm-page-buttons page-button-container">
                                            <button type="button" class="nsm-button" data-bs-toggle="dropdown">
                                                <span>Sort</span> <i class='bx bx-fw bx-chevron-down'></i>
                                            </button>
                                            <ul class="dropdown-menu p-3">
                                                <p class="m-0">Sort by</p>
                                                <select name="sort_by" id="sort-by" class="nsm-field form-select">
                                                    <option value="default" selected>Default</option>
                                                    <option value="create-date">Create Date</option>
                                                    <option value="created-by">Created By</option>
                                                    <option value="disc-percentage">Disc. %</option>
                                                    <option value="disc-days">Disc. Days</option>
                                                    <option value="disc-on-day-of-month">Disc. on Day of Month</option>
                                                    <option value="last-modified">Last Modified</option>
                                                    <option value="last-modified-by">Last Modified By</option>
                                                    <option value="min-days-to-pay">Minimum days to pay</option>
                                                    <option value="net-due-days">Net Due Days</option>
                                                    <option value="type">Type</option>
                                                    <option value="day-of-month-due">day of month due</option>
                                                </select>
                                                <p class="m-0">Sort in</p>
                                                <div class="form-check">
                                                    <input type="radio" id="sort-asc" name="sort_order" class="form-check-input" checked>
                                                    <label for="sort-asc" class="form-check-label">Ascending order</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" id="sort-desc" name="sort_order" class="form-check-input">
                                                    <label for="sort-desc" class="form-check-label">Descending order</label>
                                                </div>
                                            </ul>
                                            <button type="button" class="nsm-button">
                                                <span>Add notes</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row footerInfo">
                                <span class=""><?php echo date("l, F j, Y h:i A eP") ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-1"></div>
    </div>
</div>
<!-- START: MODALS -->
<!-- Modal for Report Settings -->
<div class="modal fade" id="reportSettings" role="dialog" data-bs-backdrop="static" data-bs-keyboard="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Report Settings</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <form id="reportSettingsForm" method="POST">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- FOR LATER UPDATES -->
                            <!-- <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="col-md-12">
                                        <label class="mb-1 fw-xnormal">User</label>
                                        <select class="form-select">
                                            <option value="all" selected>All</option>
                                            <?php 
                                                foreach ($customerByCompanyID as $customerByCompanyIDs) {
                                                    echo "<option value='$customerByCompanyIDs->prof_id'>$customerByCompanyIDs->first_name $customerByCompanyIDs->last_name</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-md-12">
                                        <label class="mb-1 fw-xnormal">Date Changed</label>
                                        <select class="form-select">
                                            <option value="Today">Today</option>
                                            <option value="Yesterday">Yesterday</option>
                                            <option value="This Week">This Week</option>
                                            <option value="This Month">This Month</option>
                                            <option value="This Quarter">This Quarter</option>
                                            <option value="This Year">This Year</option>
                                            <option value="Last Week">Last Week</option>
                                            <option value="Last Month">Last Month</option>
                                            <option value="Last Quarter">Last Quarter</option>
                                            <option value="Last Year">Last Year</option>
                                            <option value="Last Seven Years">Last Seven Years</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-md-12">
                                        <label class="mb-1 fw-xnormal">Event <small class="text-muted">(Module)</small></label>
                                        <select class="form-select">
                                            <option value="All">All</option>
                                            <option value="Workorder">Workorder</option>
                                            <option value="Invoice">Invoice</option>
                                            <option value="Taskhub">Taskhub</option>
                                            <option value="Customer">Customer</option>
                                            <option value="Estimate">Estimate</option>
                                            <option value="Event">Event</option>
                                            <option value="Appointment">Appointment</option>
                                            <option value="Jobs">Jobs</option>
                                        </select>
                                    </div>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-md-2 mb-3">
                                    <label class="mb-1 fw-xnormal">Logo</label>
                                    <select id="showHideLogo" name="showHideLogo" class="nsm-field form-select">
                                        <option value="1" selected>Show</option>
                                        <option value="0">Hide</option>
                                    </select>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label class="mb-1 fw-xnormal">Company Name</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><input class="form-check-input mt-0 enableDisableBusinessName" type="checkbox" checked></div>
                                        <input id="company_name" class="nsm-field form-control" type="text" name="company_name" value="<?php echo ($companyInfo) ? strtoupper($companyInfo->business_name) : "" ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label class="mb-1 fw-xnormal">Report Name</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><input class="form-check-input mt-0 enableDisableReportName" type="checkbox" checked></div>
                                        <input id="report_name" class="nsm-field form-control" type="text" name="report_name" value="<?php echo $page->title ?>" required>
                                    </div>
                                    <div class="col-12 col-md-6 grid-mb text-end">
                                        <div class="nsm-page-buttons page-button-container">
                                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#print_accounts_modal">
                                                <i class='bx bx-fw bx-envelope'></i>
                                            </button>
                                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#print_accounts_modal">
                                                <i class='bx bx-fw bx-printer'></i>
                                            </button>
                                            <button type="button" class="nsm-button" data-bs-toggle="dropdown">
                                                <i class="bx bx-fw bx-export"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end export-dropdown">
                                                <li><a class="dropdown-item" href="javascript:void(0);" id="export-to-excel">Export to Excel</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0);" id="export-to-pdf">Export to PDF</a></li>
                                            </ul>
                                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                                <i class="bx bx-fw bx-cog"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end p-3 w-25">
                                                <p class="m-0">Display density</p>
                                                <div class="form-check">
                                                    <input type="checkbox" checked id="compact-display" class="form-check-input">
                                                    <label for="compact-display" class="form-check-label">Compact</label>
                                                </div>
                                                <p class="m-0">Change columns</p>
                                                <div class="row">
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-terms" class="form-check-input" checked>
                                                            <label for="col-terms" class="form-check-label">Terms</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-create-date" class="form-check-input">
                                                            <label for="col-create-date" class="form-check-label">Create Date</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-created-by" class="form-check-input">
                                                            <label for="col-created-by" class="form-check-label">Created By</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-last-modified" class="form-check-input">
                                                            <label for="col-last-modified" class="form-check-label">Last Modified</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-last-modified-by" class="form-check-input">
                                                            <label for="col-last-modified-by" class="form-check-label">Last Modified By</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-type" class="form-check-input" checked>
                                                            <label for="col-type" class="form-check-label">Type</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-net-due-days" class="form-check-input" checked>
                                                            <label for="col-net-due-days" class="form-check-label">Net Due Days</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-day-of-month-due" class="form-check-input" checked>
                                                            <label for="col-day-of-month-due" class="form-check-label">day of month due</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-disc-percentage" class="form-check-input" checked>
                                                            <label for="col-disc-percentage" class="form-check-label">Disc. %</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-disc-days" class="form-check-input" checked>
                                                            <label for="col-disc-days" class="form-check-label">Disc. Days</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-disc-on-day-of-month" class="form-check-input" checked>
                                                            <label for="col-disc-on-day-of-month" class="form-check-label">Disc. on Day of Month</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-min-days-to-pay" class="form-check-input" checked>
                                                            <label for="col-min-days-to-pay" class="form-check-label">Minimum days to pay</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="m-0"><a href="#" style="text-decoration: none">Reorder columns</a></p>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

<!-- START: PRINT/SAVE MODAL -->
<div class="modal fade" id="printPreviewModal" role="dialog" data-bs-backdrop="static" data-bs-keyboard="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Print or save as PDF</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3 mt-1 mb-3">
                        <h6>Report print settings</h6>
                        <hr>
                        <div class="form-group mb-2">
                            <label>Orientation</label>
                            <select id="pageOrientation" name="pageOrientation" class="form-select">
                                <option value="P" selected>Portrait</option>
                                <option value="L">Landscape</option>
                            </select>
                        </div>
                        <div class="form-check">
                            <input id="pageHeaderRepeat" name="pageHeaderRepeat" class="form-check-input" type="checkbox">
                            <label class="form-check-label" for="pageHeaderRepeat">Repeat Page Header</label>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <iframe id="pdfPreview" class="border-0" width="100%" height="450px"></iframe>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="float-start">
                            <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                        </div>
                        <div class="float-end">
                            <button type="button" class="nsm-button primary savePDF">Save as PDF</button>
                            <!-- <button type="button" class="nsm-button primary printPDF">Print</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: PRINT/SAVE MODAL -->
<!-- START: EMAIL REPORT MODAL -->
<div class="modal fade" id="emailReportModal" role="dialog" data-bs-backdrop="static" data-bs-keyboard="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Email Report</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <form id="sendEmailForm">
                    <div class="row">
                        <div class="col-sm-12 mt-1">
                            <div class="form-group">
                                <h6>To</h6>
                                <input id="emailTo" class="form-control" type="email" placeholder="Send to" required>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <h6>CC</h6>
                                <input id="emailCC" class="form-control" type="email" placeholder="Carbon Copy" required>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <h6>Subject</h6>
                                <input id="emailSubject" class="form-control" type="text" value="<?php echo $page->title ?>" required>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <h6>Body</h6>
                                <div id="emailBody">Hello,<br><br>Attached here is the <?php echo $page->title ?> from <?php echo ($companyInfo) ? strtoupper($companyInfo->business_name) : "" ?>.<br><br>Regards,<br><?php echo "$users->FName $users->LName"; ?></div>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <h6>Attachment</h6>
                                <div class="row">
                                    <div class="col-12 grid-mb">
                                        <h4 class="text-center fw-bold"><span class="company-name"><?=$clients->business_name?></span></h4>
                                    </div>
                                    <div class="col-12 grid-mb text-center">
                                        <p class="fw-bold">Terms List</p>
                                    </div>
                                </div>
                            </div>
                            <div class="nsm-card-content h-auto grid-mb">
                                <table class="nsm-table">
                                    <thead>
                                        <tr>
                                            <td data-name="Terms">TERMS</td>
                                            <td data-name="Type">TYPE</td>
                                            <td data-name="Net Due Days">NET DUE DAYS</td>
                                            <td data-name="Day of Month Due">DAY OF MONTH DUE</td>
                                            <td data-name="Disc. %">DISC. %</td>
                                            <td data-name="Disc. Days">DISC. DAYS</td>
                                            <td data-name="Disc. on Day of Month">DISC. ON DAY OF MONTH</td>
                                            <td data-name="Minimum Days to Pay">MINIMUM DAYS TO PAY</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Due on receipt</td>
                                            <td>Date-Driven</td>
                                            <td></td>
                                            <td>1</td>
                                            <td>0.00%</td>
                                            <td></td>
                                            <td>1</td>
                                            <td>0</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="nsm-card-footer text-center">
                                <p class="m-0"><?=date("l, F j, Y h:i A eP")?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>