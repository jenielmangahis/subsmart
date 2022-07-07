<?php include viewPath('v2/includes/accounting_header'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('events/new_event') ?>'">
        <i class='bx bx-user-plus'></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/payroll'); ?>
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
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Find an employee">
                        </div>
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
                            </ul>
                        </div>

						<div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Active employees <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" style="width: max-content">
                                <li><a class="dropdown-item active" href="javascript:void(0);" id="active-employees">Active employees</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="inactive-employees">Inactive employees</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="all-employees">All employees</a></li>
                            </ul>
                        </div>

                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button">
                                <i class="bx bx-fw bx-file"></i> Paycheck list
                            </button>
                            <button type="button" class="nsm-button">
                                <i class='bx bx-fw bx-list-plus'></i> Add an employee
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-cog"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
                                <p class="m-0">Show columns</p>
                                <div class="form-check">
                                    <input type="checkbox" checked onchange="showCol(this)" id="chk-pay-rate" class="form-check-input">
                                    <label for="chk-pay-rate" class="form-check-label">Pay rate</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked onchange="showCol(this)" id="chk-pay-method" class="form-check-input">
                                    <label for="chk-pay-method" class="form-check-label">Pay method</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked onchange="showCol(this)" id="chk-pay-schedule" class="form-check-input">
                                    <label for="chk-pay-schedule" class="form-check-label">Pay schedule</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked onchange="showCol(this)" id="chk-status" class="form-check-input">
                                    <label for="chk-status" class="form-check-label">Status</label>
                                </div>
								<div class="form-check">
                                    <input type="checkbox" checked onchange="showCol(this)" id="chk-email-address" class="form-check-input">
                                    <label for="chk-email-address" class="form-check-label">Email Address</label>
                                </div>
								<div class="form-check">
                                    <input type="checkbox" checked onchange="showCol(this)" id="chk-phone-num" class="form-check-input">
                                    <label for="chk-phone-num" class="form-check-label">Phone Number</label>
                                </div>
                                <div class="form-check p-0">
                                    <label for="privacy">Privacy </label>
                                    <input type="checkbox" name="privacy" id="privacy">
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <!-- <td class="table-icon text-center">
                                <input class="form-check-input select-all table-select" type="checkbox">
                            </td> -->
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
                        <?php
                            $empPayDetails = $this->users_model->getEmployeePayDetails($employee->id);
                            $paySchedule = !in_array($empPayDetails->pay_schedule_id, ['', '0', null]) ? $this->users_model->getPaySchedule($empPayDetails->pay_schedule_id)->name : null;
                            if($empPayDetails) {
                                $payMethod = $empPayDetails->pay_method === 'direct-deposit' ? 'Direct deposit' : 'Check';
            
                                if($empPayDetails->pay_type === 'hourly') {
                                    $payRate = '$'.number_format(floatval($empPayDetails->pay_rate), 2, '.', ',').'/hour';
                                } else if($empPayDetails->pay_type === 'salary') {
                                    $payRate = '$'.number_format(floatval($empPayDetails->pay_rate), 2, '.', ',').'/'.$empPayDetails->salary_frequency;
                                } else {
                                    $payRate = 'Commission only';
                                }
                            } else {
                                $payMethod = 'Missing';
                                $payRate = 'Missing';
                            }

                            switch ($employee->status) {
                                case '0' :
                                    $empStatus = "Terminated";
                                break;
                                case '2' : 
                                    $empStatus = "Paid leave of absence";
                                break;
                                case '3' : 
                                    $empStatus = "Unpaid leave of absence";
                                break;
                                case '4' : 
                                    $empStatus = "Not on payroll";
                                break;
                                case '5' : 
                                    $empStatus = "Deceased";
                                break;
                                default : 
                                    $empStatus = "Active";
                                break;
                            }
                        ?>
                        <tr>
                            <td class="fw-bold nsm-text-primary nsm-link default"><?="$employee->LName, $employee->FName"?></td>
                            <td><?=$payRate?></td>
                            <td><?=$payMethod?></td>
                            <td><?=$paySchedule?></td>
                            <td><?=$empStatus?></td>
                            <td><?=$employee->email?></td>
                            <td><?=$employee->phone?></td>
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