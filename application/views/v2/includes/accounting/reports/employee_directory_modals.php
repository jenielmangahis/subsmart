<div class="modal fade nsm-modal" id="print_report_modal" tabindex="-1" aria-labelledby="print_report_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xxl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_report_modal_label">Print Employee Details List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td colspan="6" class="text-center">
                                <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-center">
                                <p class="m-0 fw-bold"><?=$report_title?></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-center">
                                <p class="m-0"><?=$report_period?></p>
                            </td>
                        </tr>
                        <tr>
                            <td data-name="Name">NAME</td>
                            <td data-name="Birth Date" <?=isset($columns) && !in_array('Birth Date', $columns) ? 'style="display: none"' : ''?>>BIRTH DATE</td>
                            <td data-name="Email" <?=isset($columns) && !in_array('Email', $columns) ? 'style="display: none"' : ''?>>EMAIL</td>
                            <td data-name="Phone" <?=isset($columns) && !in_array('Phone', $columns) && !in_array('Mobile', $columns) ? 'style="display: none"' : ''?>>PHONE</td>
                            <td data-name="Home Address" <?=isset($columns) && !in_array('Home Address', $columns) ? 'style="display: none"' : ''?>>HOME ADDRESS</td>
                            <td data-name="Hire Date" <?=isset($columns) && !in_array('Hire Date', $columns) ? 'style="display: none"' : ''?>>HIRE DATE</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($employees) > 0) : ?>
                        <?php foreach($employees as $index => $employee) : ?>
                        <tr>
                            <td><?=$employee['name']?></td>
                            <td <?=isset($columns) && !in_array('Birth Date', $columns) ? 'style="display: none"' : ''?>><?=$employee['birth_date']?></td>
                            <td <?=isset($columns) && !in_array('Email', $columns) ? 'style="display: none"' : ''?>><?=$employee['email']?></td>
                            <td <?=isset($columns) && !in_array('Phone', $columns) && !in_array('Mobile', $columns) ? 'style="display: none"' : ''?>>
                                <?php if(isset($columns) && in_array('Phone', $columns) && !empty($employee['phone']) || !isset($columns) && !empty($employee['phone'])) : ?> <p>Phone: <?=$employee['phone']?></p> <?php endif; ?>
                                <?php if(isset($columns) && in_array('Mobile', $columns) && !empty($employee['mobile']) || !isset($columns) && !empty($employee['mobile'])) : ?> <p>Mobile: <?=$employee['mobile']?></p> <?php endif; ?>
                            </td>
                            <td <?=isset($columns) && !in_array('Home Address', $columns) ? 'style="display: none"' : ''?>><?=$employee['home_address']?></td>
                            <td <?=isset($columns) && !in_array('Hire Date', $columns) ? 'style="display: none"' : ''?>><?=$employee['hire_date']?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="6">
                                <div class="nsm-empty">
                                    <span>No results found.</span>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6" class="text-center">
                                <?=date($prepared_timestamp)?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="nsm-button primary" id="btn_print_report">Print</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="print_preview_report_modal" tabindex="-1" aria-labelledby="print_preview_report_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xxl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_preview_report_modal_label">Print Employee Details List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="w-100" id="report_table_print">
                    <thead>
                        <tr>
                            <td colspan="6" class="text-center">
                                <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-center">
                                <p class="m-0 fw-bold"><?=$report_title?></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-center">
                                <p class="m-0"><?=$report_period?></p>
                            </td>
                        </tr>
                        <tr>
                            <td data-name="Name">NAME</td>
                            <td data-name="Birth Date" <?=isset($columns) && !in_array('Birth Date', $columns) ? 'style="display: none"' : ''?>>BIRTH DATE</td>
                            <td data-name="Email" <?=isset($columns) && !in_array('Email', $columns) ? 'style="display: none"' : ''?>>EMAIL</td>
                            <td data-name="Phone" <?=isset($columns) && !in_array('Phone', $columns) && !in_array('Mobile', $columns) ? 'style="display: none"' : ''?>>PHONE</td>
                            <td data-name="Home Address" <?=isset($columns) && !in_array('Home Address', $columns) ? 'style="display: none"' : ''?>>HOME ADDRESS</td>
                            <td data-name="Hire Date" <?=isset($columns) && !in_array('Hire Date', $columns) ? 'style="display: none"' : ''?>>HIRE DATE</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($employees) > 0) : ?>
                        <?php foreach($employees as $index => $employee) : ?>
                        <tr>
                            <td><?=$employee['name']?></td>
                            <td <?=isset($columns) && !in_array('Birth Date', $columns) ? 'style="display: none"' : ''?>><?=$employee['birth_date']?></td>
                            <td <?=isset($columns) && !in_array('Email', $columns) ? 'style="display: none"' : ''?>><?=$employee['email']?></td>
                            <td <?=isset($columns) && !in_array('Phone', $columns) && !in_array('Mobile', $columns) ? 'style="display: none"' : ''?>>
                                <?php if(isset($columns) && in_array('Phone', $columns) && !empty($employee['phone']) || !isset($columns) && !empty($employee['phone'])) : ?> <p>Phone: <?=$employee['phone']?></p> <?php endif; ?>
                                <?php if(isset($columns) && in_array('Mobile', $columns) && !empty($employee['mobile']) || !isset($columns) && !empty($employee['mobile'])) : ?> <p>Mobile: <?=$employee['mobile']?></p> <?php endif; ?>
                            </td>
                            <td <?=isset($columns) && !in_array('Home Address', $columns) ? 'style="display: none"' : ''?>><?=$employee['home_address']?></td>
                            <td <?=isset($columns) && !in_array('Hire Date', $columns) ? 'style="display: none"' : ''?>><?=$employee['hire_date']?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="6">
                                <div class="nsm-empty">
                                    <span>No results found.</span>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6" class="text-center">
                                <?=date($prepared_timestamp)?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="settings-modal" tabindex="-1" aria-labelledby="settings_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="settings_modal_label">Customize report</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row g-3 grid-mb">
                    <div class="col-12">
                        <div class="accordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button content-title" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-who-to-include" aria-expanded="true" aria-controls="collapse-who-to-include">
                                        Who to include
                                    </button>
                                </h2>
                                <div id="collapse-who-to-include" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="row g-3 grid-mb">
                                            <div class="col-12 col-md-4">
                                                <label for="filter-employee"><b>Employee</b></label>
                                                <select name="filter_employee" id="filter-employee" class="nsm-field form-control">
                                                    <option value="active" <?=$filter_status === 'active' ? 'selected' : ''?>>Active employees</option>
                                                    <option value="inactive" <?=$filter_status === 'inactive' ? 'selected' : ''?>>Inactive employees</option>
                                                    <option value="all" <?=empty($filter_status) || $filter_status === 'all' ? 'selected' : ''?>>All employees</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3 grid-mb">
                    <div class="col-12">
                        <div class="accordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button content-title" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-what-to-include" aria-expanded="true" aria-controls="collapse-what-to-include">
                                        What to include
                                    </button>
                                </h2>
                                <div id="collapse-what-to-include" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="row g-3 grid-mb">
                                            <div class="col-12">
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <a href="#" class="text-decoration-none" id="<?=!isset($columns) ? 'unselect-all-columns' : 'select-all-columns'?>"><?=!isset($columns) ? 'Unselect' : 'Select'?> all</a>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-birth-date" <?=isset($columns) && in_array('Birth Date', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-birth-date">
                                                                Birth Date
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-email" <?=isset($columns) && in_array('Email', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-email">
                                                                Email
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-phone" <?=isset($columns) && in_array('Phone', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-phone">
                                                                Phone
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-mobile" <?=isset($columns) && in_array('Mobile', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-mobile">
                                                                Mobile
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-home-address" <?=isset($columns) && in_array('Home Address', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-home-address">
                                                                Home Address
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="select_columns" value="1" id="select-hire-date" <?=isset($columns) && in_array('Hire Date', $columns) || !isset($columns) ? 'checked' : ''?>>
                                                            <label class="form-check-label" for="select-hire-date">
                                                                Hire Date
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button primary" id="run-report-button">Run report</button>
            </div>
        </div>
    </div>
</div>