<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/employees_modals'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/payroll'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/subtabs/employees_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Here you will get a detailed summary of pay rate, payment method, pay schedule and the status of each of your employee. With this report, you will be able to forecast a better budget for future weeks.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <form action="<?php echo base_url('accounting/employees') ?>" method="get">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" name="search" id="search_field" placeholder="Find an employee" value="<?php echo (!empty($search)) ? $search : '' ?>">
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>
                                    More actions
                                </span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end batch-actions">
                                <li><a class="dropdown-item" href="javascript:void(0);" id="run-payroll">Run payroll</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="bonus-only">Bonus only</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="commission-only">Commission only</a></li>
                            </ul>
                        </div>

						<div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Active employees <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu" id="status-filter">
                                <li><a class="dropdown-item <?=empty($status) || $status === 'active' ? 'active' : '' ?>" href="javascript:void(0);" id="active-employees">Active employees</a></li>
                                <li><a class="dropdown-item <?=$status === 'inactive' ? 'active' : '' ?>" href="javascript:void(0);" id="inactive-employees">Inactive employees</a></li>
                                <li><a class="dropdown-item <?=$status === 'all' ? 'active' : '' ?>" href="javascript:void(0);" id="all-employees">All employees</a></li>
                            </ul>
                        </div>

                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#add_employee_modal">
                                <i class='bx bx-fw bx-list-plus'></i> Add an employee
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-cog"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
                                <p class="m-0">Show columns</p>
                                <div class="form-check">
                                    <input type="checkbox" checked id="chk-pay-rate" name="col_chk" class="form-check-input">
                                    <label for="chk-pay-rate" class="form-check-label">Pay rate</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked id="chk-pay-method" name="col_chk" class="form-check-input">
                                    <label for="chk-pay-method" class="form-check-label">Pay method</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked id="chk-pay-schedule" name="col_chk" class="form-check-input">
                                    <label for="chk-pay-schedule" class="form-check-label">Pay schedule</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked id="chk-status" name="col_chk" class="form-check-input">
                                    <label for="chk-status" class="form-check-label">Status</label>
                                </div>
								<div class="form-check">
                                    <input type="checkbox" checked id="chk-email-address" name="col_chk" class="form-check-input">
                                    <label for="chk-email-address" class="form-check-label">Email address</label>
                                </div>
								<div class="form-check">
                                    <input type="checkbox" checked id="chk-phone-num" name="col_chk" class="form-check-input">
                                    <label for="chk-phone-num" class="form-check-label">Phone number</label>
                                </div>
                                <div class="form-check form-switch nsm-switch">
                                    <label for="privacy" class="form-check-label">Privacy </label>
                                    <input type="checkbox" name="privacy" id="privacy" class="form-check-input">
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
                <table class="nsm-table" id="employees-table">
                    <thead>
                        <tr>
                            <td data-name="Name">NAME</td>
                            <td data-name="Pay rate">PAY RATE</td>
                            <td data-name="Pay method">PAY METHOD</td>
                            <td data-name="Pay schedule">PAY SCHEDULE</td>
                            <td data-name="Status">Status</td>
                            <td data-name="Email address">EMAIL ADDRESS</td>
                            <td data-name="Phone number">PHONE NUMBER</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($employees) > 0) : ?>
						<?php foreach($employees as $employee) : ?>
                        <tr>
                            <td class="fw-bold nsm-text-primary nsm-link default" onclick="location.href='<?php echo base_url('accounting/employees/view/' . $employee['id']) ?>'"><?=$employee['name']?></td>
                            <td class="pay-rate" data-pay_rate="<?=$employee['pay_rate']?>"><?=$employee['pay_rate']?></td>
                            <td><?=$employee['pay_method']?></td>
                            <td><?=$employee['pay_schedule']?></td>
                            <td><?=$employee['status']?></td>
                            <td><?=$employee['email_address']?></td>
                            <td><?=$employee['phone_number']?></td>
                        </tr>
                        <?php endforeach; ?>
						<?php else : ?>
						<tr>
							<td colspan="14">
								<div class="nsm-empty">
									<span>No results found.</span>
								</div>
							</td>
						</tr>
						<?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>