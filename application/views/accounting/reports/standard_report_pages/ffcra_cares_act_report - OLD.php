<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath("v2/includes/accounting/reports/$modalsView"); ?>

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
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end p-3" style="width: max-content">
                                <div class="row grid-mb">
                                    <div class="col-12">
                                        <label for="filter-report-period">Report period</label>
                                        <select class="nsm-field form-select" name="filter_report_period" id="filter-report-period">
                                            <option value="last-pay-date" <?=empty($filter_date) || $filter_date === 'last-pay-date' ? 'selected' : ''?>>Last pay date</option>
                                            <option value="this-month" <?=$filter_date === 'this-month' ? 'selected' : ''?>>This Month</option>
                                            <option value="this-quarter" <?=$filter_date === 'this-quarter' ? 'selected' : ''?>>This Quarter</option>
                                            <option value="this-year" <?=$filter_date === 'this-year' ? 'selected' : ''?>>This Year</option>
                                            <option value="last-month" <?=$filter_date === 'last-month' ? 'selected' : ''?>>Last Month</option>
                                            <option value="last-quarter" <?=$filter_date === 'last-quarter' ? 'selected' : ''?>>Last Quarter</option>
                                            <option value="last-year" <?=$filter_date === 'last-year' ? 'selected' : ''?>>Last Year</option>
                                            <option value="first-quarter" <?=$filter_date === 'first-quarter' ? 'selected' : ''?>>First quarter</option>
                                            <option value="second-quarter" <?=$filter_date === 'second-quarter' ? 'selected' : ''?>>Second quarter</option>
                                            <option value="third-quarter" <?=$filter_date === 'third-quarter' ? 'selected' : ''?>>Third quarter</option>
                                            <option value="custom" <?=$filter_date === 'custom' ? 'selected' : ''?>>Custom</option>
                                        </select>
                                    </div>
                                </div>
                                <?php if(!empty($filter_date) && $filter_date === 'all-dates' || empty($filter_date)) : ?>
                                <div class="row grid-mb">
                                    <div class="col-12 col-md-6">
                                        <label for="filter-report-period-from">From</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control date" value="<?=$start_date?>" id="filter-report-period-from">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="filter-report-period-to">To</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control date" value="<?=$end_date?>" id="filter-report-period-to">
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="row grid-mb">
                                    <div class="col-12">
                                        <label for="filter-employee"><b>Employee</b></label>
                                        <select name="filter_employee" id="filter-employee" class="nsm-field form-control">
                                            <option value="active" <?=empty($filter_status) || $filter_status === 'active' ? 'selected' : ''?>>Active employees</option>
                                            <option value="inactive" <?=$filter_status === 'inactive' ? 'selected' : ''?>>Inactive employees</option>
                                            <option value="all" <?=$filter_status === 'all' ? 'selected' : ''?>>All employees</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-center">
                                        <button type="button" class="nsm-button primary" id="run-report">
                                            Run Report
                                        </button>
                                    </div>
                                </div>
                            </ul>
                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#settings-modal">
                                <i class='bx bx-fw bx-customize'></i> Customize
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row g-3 justify-content-center">
                    <div class="col-6">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header d-block">
                                <div class="row">
                                    <div class="col-12 col-md-6 grid-mb">
                                        
                                    </div>
                                    <div class="col-12 col-md-6 grid-mb text-end">
                                        <div class="nsm-page-buttons page-button-container">
                                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#print_report_modal">
                                                <i class='bx bx-fw bx-printer'></i>
                                            </button>
                                            <button type="button" class="nsm-button" data-bs-toggle="dropdown">
                                                <i class="bx bx-fw bx-export"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end export-dropdown">
                                                <li><a class="dropdown-item" href="javascript:void(0);" id="export-to-excel">Export to Excel</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0);" id="export-to-pdf">Export to PDF</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="row text-center">
                                    <div class="col-12 grid-mb">
                                        <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                                    </div>
                                    <div class="col-12 grid-mb">
                                        <p class="m-0 fw-bold"><?=$report_title?></p>
                                    </div>
                                    <div class="col-12 grid-mb">
                                        <p class="m-0"><?=$report_period?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="nsm-card-content h-auto grid-mb">
                                <table class="nsm-table grid-mb" id="reports-table">
                                    <thead>
                                        <tr>
                                            <td data-name=""></td>
                                            <td data-name="Total Amount">TOTAL AMOUNT</td>
                                            <td data-name="Credit Total">CREDIT TOTAL</td>
                                            <?php foreach($employees as $employee) : ?>
                                            <td data-name="<?=$employee['name']?>"><?=$employee['name']?></td>
                                            <?php endforeach; ?>
                                            <td data-name="Credit Amount">CREDIT AMOUNT</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><b>FFCRA & CARES ACT WAGES, TAXES & CREDITS</b></td>
                                            <td></td>
                                            <td></td>
                                            <?php foreach($employees as $employee) : ?>
                                            <td></td>
                                            <?php endforeach; ?>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FFCRA Wages</b></td>
                                            <td></td>
                                            <td></td>
                                            <?php foreach($employees as $employee) : ?>
                                            <td></td>
                                            <?php endforeach; ?>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td style="border-bottom: 1px solid black"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total FFCRA Sick Lv Wages</b></td>
                                            <td style="border-bottom: 1px solid black"></td>
                                            <td style="border-bottom: 1px solid black"></td>
                                            <?php foreach($employees as $employee) : ?>
                                            <td style="border-bottom: 1px solid black"></td>
                                            <?php endforeach; ?>
                                            <td style="border-bottom: 1px solid black"></td>
                                        </tr>
                                        <tr>
                                            <td style="border-bottom: 1px solid black"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total FFCRA Wages</b></td>
                                            <td style="border-bottom: 1px solid black"></td>
                                            <td style="border-bottom: 1px solid black"></td>
                                            <?php foreach($employees as $employee) : ?>
                                            <td style="border-bottom: 1px solid black"></td>
                                            <?php endforeach; ?>
                                            <td style="border-bottom: 1px solid black"></td>
                                        </tr>
                                        <tr>
                                            <td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FFCRA ER Health Premium</b></td>
                                            <td></td>
                                            <td></td>
                                            <?php foreach($employees as $employee) : ?>
                                            <td></td>
                                            <?php endforeach; ?>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td style="border-bottom: 1px solid black"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total FFCRA Health Premium</b></td>
                                            <td style="border-bottom: 1px solid black"></td>
                                            <td style="border-bottom: 1px solid black"></td>
                                            <?php foreach($employees as $employee) : ?>
                                            <td style="border-bottom: 1px solid black"></td>
                                            <?php endforeach; ?>
                                            <td style="border-bottom: 1px solid black"></td>
                                        </tr>
                                        <tr>
                                            <td style="border-bottom: 1px solid black"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total FFCRA Wages and ER Health Premium</b></td>
                                            <td style="border-bottom: 1px solid black"></td>
                                            <td style="border-bottom: 1px solid black"></td>
                                            <?php foreach($employees as $employee) : ?>
                                            <td style="border-bottom: 1px solid black"></td>
                                            <?php endforeach; ?>
                                            <td style="border-bottom: 1px solid black"></td>
                                        </tr>
                                        <tr>
                                            <td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CARES Act Wages</b></td>
                                            <td></td>
                                            <td></td>
                                            <?php foreach($employees as $employee) : ?>
                                            <td></td>
                                            <?php endforeach; ?>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td style="border-bottom: 1px solid black"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Reg and OT Emp Retn Credit Wages</b></td>
                                            <td style="border-bottom: 1px solid black"></td>
                                            <td style="border-bottom: 1px solid black"></td>
                                            <?php foreach($employees as $employee) : ?>
                                            <td style="border-bottom: 1px solid black"></td>
                                            <?php endforeach; ?>
                                            <td style="border-bottom: 1px solid black"></td>
                                        </tr>
                                        <tr>
                                            <td style="border-bottom: 1px solid black"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total CARES Act Credits</b></td>
                                            <td style="border-bottom: 1px solid black"></td>
                                            <td style="border-bottom: 1px solid black"></td>
                                            <?php foreach($employees as $employee) : ?>
                                            <td style="border-bottom: 1px solid black"></td>
                                            <?php endforeach; ?>
                                            <td style="border-bottom: 1px solid black"></td>
                                        </tr>
                                        <tr>
                                            <td style="border-bottom: 1px solid black"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total FFCRA & CARES Act Credits</b></td>
                                            <td style="border-bottom: 1px solid black"></td>
                                            <td style="border-bottom: 1px solid black"></td>
                                            <?php foreach($employees as $employee) : ?>
                                            <td style="border-bottom: 1px solid black"></td>
                                            <?php endforeach; ?>
                                            <td style="border-bottom: 1px solid black"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="nsm-card-footer text-center">
                                <p class="m-0"><?=date($prepared_timestamp)?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const companyName = "<?=$clients->business_name?>"
</script>
<?php include viewPath('v2/includes/footer'); ?>