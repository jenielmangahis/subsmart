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
                                            <option value="all-dates" <?=$filter_date === 'all-dates' ? 'selected' : ''?>>All Dates</option>
                                            <option value="custom" <?=$filter_date === 'custom' ? 'selected' : ''?>>Custom</option>
                                            <option value="today" <?=$filter_date === 'today' ? 'selected' : ''?>>Today</option>
                                            <option value="this-week" <?=$filter_date === 'this-week' ? 'selected' : ''?>>This Week</option>
                                            <option value="this-week-to-date" <?=$filter_date === 'this-week-to-date' ? 'selected' : ''?>>This Week-to-date</option>
                                            <option value="this-month" <?=$filter_date === 'this-month' ? 'selected' : ''?>>This Month</option>
                                            <option value="this-month-to-date" <?=empty($filter_date) || $filter_date === 'this-month-to-date' ? 'selected' : ''?>>This Month-to-date</option>
                                            <option value="this-quarter" <?=$filter_date === 'this-quarter' ? 'selected' : ''?>>This Quarter</option>
                                            <option value="this-quarter-to-date" <?=$filter_date === 'this-quarter-to-date' ? 'selected' : ''?>>This Quarter-to-date</option>
                                            <option value="this-year" <?=$filter_date === 'this-year' ? 'selected' : ''?>>This Year</option>
                                            <option value="this-year-to-date" <?=$filter_date === 'this-year-to-date' ? 'selected' : ''?>>This Year-to-date</option>
                                            <option value="this-year-to-last-month" <?=$filter_date === 'this-year-to-last-month' ? 'selected' : ''?>>This Year-to-last-month</option>
                                            <option value="yesterday" <?=$filter_date === 'yesterday' ? 'selected' : ''?>>Yesterday</option>
                                            <option value="recent" <?=$filter_date === 'recent' ? 'selected' : ''?>>Recent</option>
                                            <option value="last-week" <?=$filter_date === 'last-week' ? 'selected' : ''?>>Last Week</option>
                                            <option value="last-week-to-date" <?=$filter_date === 'last-week-to-date' ? 'selected' : ''?>>Last Week-to-date</option>
                                            <option value="last-month" <?=$filter_date === 'last-month' ? 'selected' : ''?>>Last Month</option>
                                            <option value="last-month-to-date" <?=$filter_date === 'last-month-to-date' ? 'selected' : ''?>>Last Month-to-date</option>
                                            <option value="last-quarter" <?=$filter_date === 'last-quarter' ? 'selected' : ''?>>Last Quarter</option>
                                            <option value="last-quarter-to-date" <?=$filter_date === 'last-quarter-to-date' ? 'selected' : ''?>>Last Quarter-to-date</option>
                                            <option value="last-year" <?=$filter_date === 'last-year' ? 'selected' : ''?>>Last Year</option>
                                            <option value="last-year-to-date" <?=$filter_date === 'last-year-to-date' ? 'selected' : ''?>>Last Year-to-date</option>
                                            <option value="since-30-days-ago" <?=$filter_date === 'since-30-days-ago' ? 'selected' : ''?>>Since 30 Days Ago</option>
                                            <option value="since-60-days-ago" <?=$filter_date === 'since-60-days-ago' ? 'selected' : ''?>>Since 60 Days Ago</option>
                                            <option value="since-90-days-ago" <?=$filter_date === 'since-90-days-ago' ? 'selected' : ''?>>Since 90 Days Ago</option>
                                            <option value="since-365-days-ago" <?=$filter_date === 'since-365-days-ago' ? 'selected' : ''?>>Since 365 Days Ago</option>
                                            <option value="next-week" <?=$filter_date === 'next-week' ? 'selected' : ''?>>Next Week</option>
                                            <option value="next-4-weeks" <?=$filter_date === 'next-4-weeks' ? 'selected' : ''?>>Next 4 Weeks</option>
                                            <option value="next-month" <?=$filter_date === 'next-month' ? 'selected' : ''?>>Next Month</option>
                                            <option value="next-quarter" <?=$filter_date === 'next-quarter' ? 'selected' : ''?>>Next Quarter</option>
                                            <option value="next-year" <?=$filter_date === 'next-year' ? 'selected' : ''?>>Next Year</option>
                                        </select>
                                    </div>
                                </div>
                                <?php if(!empty($filter_date) && $filter_date !== 'all-dates' || empty($filter_date)) : ?>
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
                                    <div class="col-12 col-md-6">
                                        <label for="display-columns-by">Display columns by</label>
                                        <select name="display_columns_by" id="display-columns-by" class="nsm-field form-control">
                                            <option value="total-only" <?=empty($display_columns_by) || $display_columns_by === 'total-only' ? 'selected' : ''?>>Total only</option>
                                            <option value="months" <?=$display_columns_by === 'months' ? 'selected' : ''?>>Months</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="show-non-zero-or-active-only">Show non-zero or active only</label>
                                        <button type="button" class="nsm-button w-100" data-bs-toggle="dropdown">
                                            <?=$showed_rows?> Rows/<?=$showed_columns?> Columns <i class='bx bx-fw bx-caret-down'></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end p-3">
                                            <p class="m-0">Show rows</p>
                                            <div class="form-check">
                                                <input type="radio" id="row-active" class="form-check-input" name="show_rows" value="active" <?=empty($show_rows) ? 'checked' : ''?>>
                                                <label for="row-active">Active</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="row-all" class="form-check-input" name="show_rows" value="all" <?=$show_rows === 'all' ? 'checked' : ''?>>
                                                <label for="row-all">All</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="row-non-zero" class="form-check-input" name="show_rows" value="non-zero" <?=$show_rows === 'non-zero' ? 'checked' : ''?>>
                                                <label for="row-non-zero">Non-zero</label>
                                            </div>
                                            <p class="m-0">Show columns</p>
                                            <div class="form-check">
                                                <input type="radio" id="column-active" class="form-check-input" name="show_columns" value="active" <?=empty($show_columns) ? 'checked' : ''?>>
                                                <label for="column-active">Active</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="column-all" class="form-check-input" name="show_columns" value="all" <?=$show_columns === 'all' ? 'checked' : ''?>>
                                                <label for="column-all">All</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="column-non-zero" class="form-check-input" name="show_columns" value="non-zero" <?=$show_columns === 'non-zero' ? 'checked' : ''?>>
                                                <label for="column-non-zero">Non-zero</label>
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row grid-mb">
                                    <div class="col-12">
                                        <label for="" class="w-100">Accounting method</label>
                                        <div class="form-check d-inline-block">
                                            <input type="radio" id="cash-method" class="form-check-input" name="accounting_method" value="cash" <?=isset($accounting_method) && $accounting_method === 'cash' ? 'checked' : ''?>>
                                            <label for="cash-method" class="form-check-label">Cash</label>
                                        </div>
                                        <div class="form-check d-inline-block">
                                            <input type="radio" id="accrual-method" class="form-check-input" name="accounting_method" value="accrual" <?=!isset($accounting_method) ? 'checked' : ''?>>
                                            <label for="accrual-method" class="form-check-label">Accrual</label>
                                        </div>
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
                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                <i class='bx bx-fw bx-save'></i> Save customization
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end p-3" style="width: 20%">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="custom-report-name">Custom report name</label>
                                        <input type="text" name="custom_report_name" id="custom-report-name" class="nsm-field form-control" value="Trial Balance">
                                    </div>
                                    <div class="col-12">
                                        <label for="custom-report-group">Add this report to a group</label>
                                        <select name="custom_report_group" id="custom-report-group" class="nsm-field form-control"></select>
                                        <a href="#" class="text-decoration-none" id="add-new-custom-report-group">Add new group</a>
                                    </div>
                                    <div class="col-12 d-none">
                                        <form id="new-custom-report-group">
                                            <div class="row">
                                                <div class="col-8">
                                                    <label for="custom-group-name">New group name</label>
                                                    <input type="text" class="nsm-field form-control" name="new_custom_group_name" id="custom-group-name">
                                                </div>
                                                <div class="col-4 d-flex align-items-end">
                                                    <button type="submit" class="nsm-button success">Add</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-12">
                                        <label for="share-with">Share with</label>
                                        <select name="share_with" id="share-with" class="nsm-field form-control">
                                            <option value="all">All</option>
                                            <option value="none" selected>None</option>
                                        </select>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center">
                                        <button type="button" class="nsm-button primary" id="save-custom-report">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row g-3 justify-content-center">
                    <div class="col-12 col-md-4">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header d-block">
                                <div class="row">
                                    <div class="col-12 col-md-6 grid-mb">
                                        <div class="nsm-page-buttons page-button-container">
                                            <button type="button" class="nsm-button" id="<?=is_null($reportNote) ? 'add-notes' : 'edit-notes'?>">
                                                <?php if(is_null($reportNote) || empty($reportNote->notes)) : ?>
                                                <span>Add notes</span>
                                                <?php else : ?>
                                                <span>Edit notes</span>
                                                <?php endif; ?>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 grid-mb text-end">
                                        <div class="nsm-page-buttons page-button-container">
                                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#email_report_modal">
                                                <i class='bx bx-fw bx-envelope'></i>
                                            </button>
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
                                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                                <i class="bx bx-fw bx-cog"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end p-3 w-25">
                                                <p class="m-0">Display density</p>
                                                <div class="form-check">
                                                    <input type="checkbox" checked id="compact-display" class="form-check-input">
                                                    <label for="compact-display" class="form-check-label">Compact</label>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="row <?=!isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment?>">
                                    <?php if(isset($show_logo)) : ?>
                                    <!-- <div class="position-absolute">
                                        <img src="<?= getCompanyBusinessProfileImage(); ?>"  style="max-width: 150px"/>
                                    </div> -->
                                    <?php endif; ?>
                                    <?php if(!isset($show_company_name)) : ?>
                                    <div class="col-12 grid-mb">
                                        <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                                    </div>
                                    <?php endif; ?>
                                    <?php if(!isset($show_report_title)) : ?>
                                    <div class="col-12 grid-mb">
                                        <p class="m-0 fw-bold"><?=$report_title?></p>
                                    </div>
                                    <?php endif; ?>
                                    <?php if(!isset($show_report_period)) : ?>
                                    <div class="col-12 grid-mb">
                                        <p class="m-0"><?=$report_period?></p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="nsm-card-content h-auto grid-mb">
                                <table class="nsm-table grid-mb" id="reports-table">
                                    <thead>
                                        <?php if($display_columns_by === 'months') : ?>
                                        <tr>
                                            <td data-name="Name" rowspan="2"></td>
                                            <?php foreach($columns as $column) : ?>
                                            <td colspan="2" style="text-align: center;"><?=$column?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <tr>
                                            <?php foreach($columns as $column) : ?>
                                            <td data-name="Debit">DEBIT</td>
                                            <td data-name="Credit">CREDIT</td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <?php else : ?>
                                        <tr>
                                            <td data-name="Name"></td>
                                            <td data-name="Debit">DEBIT</td>
                                            <td data-name="Credit">CREDIT</td>
                                        </tr>
                                        <?php endif; ?>
                                    </thead>
                                    <tbody>
                                        <?php if(count($accounts) > 0) : ?>
                                        <?php foreach($accounts as $index => $account) : ?>
                                        <?php if($display_columns_by === 'months') : ?>
                                        <tr>
                                            <td><?=$account['name']?></td>
                                            <?php foreach($columns as $column) : ?>
                                            <td><?=$account[$column]['debit']?></td>
                                            <td><?=$account[$column]['credit']?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <?php else : ?>
                                        <tr>
                                            <td><?=$account['name']?></td>
                                            <td><?=$account['debit']?></td>
                                            <td><?=$account['credit']?></td>
                                        </tr>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                        <?php else : ?>
                                        <tr>
                                            <td colspan="<?=$display_columns_by === 'months' ? (count($columns) * 2) + 1 : '3'?>">
                                                <div class="nsm-empty">
                                                    <span>No results found.</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>

                                <div class="row">
                                    <div class="col-12 d-none" id="report-note-form">
                                        <textarea name="report_note" id="report-note" maxlength="4000" class="nsm-field form-control mb-3" placeholder="Add notes or include additional info with your report"><?=!is_null($reportNote) ? str_replace("<br />", "", $reportNote->notes) : ''?></textarea>
                                        <label for="report-note">4000 characters max</label>
                                        <button class="nsm-button primary float-end" id="save-note">Save</button>
                                        <button class="nsm-button float-end" id="cancel-note-update">Cancel</button>
                                    </div>
                                    <div class="col-12 <?=is_null($reportNote) ? 'd-none' : ''?>" id="report-note-cont">
                                        <?php if(!is_null($reportNote)) : ?>
                                        <?=str_replace("\n", "<br />", $reportNote->notes)?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="nsm-card-footer <?=!isset($footer_alignment) ? 'text-center' : 'text-'.$footer_alignment?>">
                                <p class="m-0"><?php if($show_report_basis === null) : ?><?=!isset($accounting_method) ? 'Accrual basis' : 'Cash basis' ?><?php endif; ?> <?=date($prepared_timestamp)?></p>
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