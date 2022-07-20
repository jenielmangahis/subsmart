<?php include viewPath('v2/includes/accounting_header'); ?>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('events/new_event') ?>'">
        <i class='bx bx-user-plus'></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/subtabs/reports_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            CRM reporting helps businesses in a few key ways: It can helps you distill what is happening in your business, a key advantage of deploying a CRM. Your data will help provides different ways to make strategic business decisions. Your management team can track performance and make tactical changes where necessary.
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <!-- <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Filter by name">
                        </div> -->
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button">
                                <i class='bx bx-fw bx-list-plus'></i> Add Role
                            </button>
                        </div>
                    </div>
                </div>

                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Employee">EMPLOYEE</td>
                            <td data-name="Created By">ROLE</td>
                            <td data-name="Last Modified">START DATE</td>
                            <td data-name="Report Period">LOCATION</td>
                            <td data-name="Report Period">SALARY</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employees as $employee): ?>
                        <tr>
                            <td><?=$employee->FName .' '. $employee->LName; ?></td>
                            <td><?=$employee->title; ?></td>
                            <td><?=$employee->date_hired; ?></td>
                            <td><?=$employee->address; ?></td>
                            <td>$0.00</td>
                            <td>
                                <div class="dropdown table-management">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="<?=url('/accounting/employee_payscale/'.$employee->uid)?>">Manage</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>