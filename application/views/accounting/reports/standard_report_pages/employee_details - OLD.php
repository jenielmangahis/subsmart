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
                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#settings-modal">
                                <i class='bx bx-fw bx-customize'></i> Customize
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row g-3 justify-content-center">
                    <div class="col-12 col-md-6">
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
                                            <td data-name="Personal Info">PERSONAL INFO</td>
                                            <td data-name="Hire Date" <?=isset($columns) && !in_array('Hire Date', $columns) ? 'style="display: none"' : ''?>>HIRE DATE</td>
                                            <td data-name="Pay Info" <?=isset($columns) && !in_array('Pay Info', $columns) ? 'style="display: none"' : ''?>>PAY INFO</td>
                                            <td data-name="Notes" <?=isset($columns) && !in_array('Notes', $columns) ? 'style="display: none"' : ''?>>NOTES</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(count($employees) > 0) : ?>
                                        <?php foreach($employees as $index => $employee) : ?>
                                        <tr>
                                            <td>
                                                <h5><?=$employee['name']?></h5>
                                                <?php if(!isset($columns) || isset($columns) && in_array('Home Address', $columns)) : ?><p><?=!empty($employee['address']) ? $employee['address'] : '-'?></p><?php endif; ?>
                                                <?php if(!isset($columns) || isset($columns) && in_array('Birth Date', $columns)) : ?><p>DOB: <?=$employee['birth_date']?></p><?php endif; ?>
                                            </td>
                                            <td <?=isset($columns) && !in_array('Hire Date', $columns) ? 'style="display: none"' : ''?>><?=$employee['hire_date']?></td>
                                            <td <?=isset($columns) && !in_array('Pay Info', $columns) ? 'style="display: none"' : ''?>>
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <h5>Pay type</h5>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <p><?=$employee['pay_type']?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td <?=isset($columns) && !in_array('Notes', $columns) ? 'style="display: none"' : ''?>><?=$employee['notes']?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php else : ?>
                                        <tr>
                                            <td colspan="4">
                                                <div class="nsm-empty">
                                                    <span>No results found.</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endif; ?>
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