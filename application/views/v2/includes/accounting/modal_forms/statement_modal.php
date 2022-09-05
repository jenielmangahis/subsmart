<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<form onsubmit="submitModalForm(event, this)" id="modal-form">
    <div id="statementModal" class="modal fade modal-fluid nsm-modal" role="dialog" data-bs-backdrop="false">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Create Statements</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-12 col-md-2">
                                    <label for="statementType">Statement Type</label>
                                    <select name="statement_type" id="statementType" class="form-control nsm-field">
                                        <option value="1">Balance Forward</option>
                                        <option value="2">Open Item (Last 365 days)</option>
                                        <option value="3">Transaction Statement</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-4 offset-md-6 text-end">
                                    <h6>TOTAL BALANCE FOR <span id="total-customers"><?php echo count($customers); ?></span> CUSTOMERS</h6>
                                    <h2><span id="total-amount">$<?php echo $total; ?></span></h2>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-2 grid-mb">
                                    <label for="statementDate">Statement Date</label>
                                    <div class="nsm-field-group calendar">
                                        <input type="text" class="form-control nsm-field date" name="statement_date" id="statementDate" value="<?php echo date('m/d/Y') ?>"/>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-2 grid-mb">
                                    <label for="customerBalanceStatus">Customer Balance Status</label>
                                    <select name="customer_balance_status" id="customerBalanceStatus" class="form-control nsm-field">
                                        <option value="all">All</option>
                                        <option value="open" selected>Open</option>
                                        <option value="overdue">Overdue</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-2 grid-mb">
                                    <label for="startDate">Start Date</label>
                                    <div class="nsm-field-group calendar">
                                        <input type="text" class="form-control nsm-field date" name="start_date" id="startDate" value="<?php echo date('m/d/Y', strtotime('-1 months')); ?>"/>                                        
                                    </div>
                                </div>
                                <div class="col-12 col-md-2 grid-mb">
                                    <label for="endDate">End Date</label>
                                    <div class="nsm-field-group calendar">
                                        <input type="text" class="form-control nsm-field date" name="end_date" id="endDate" value="<?php echo date('m/d/Y'); ?>"/>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h2>Recipients List</h2>
                                </div>

                                <div class="col-12">
                                    <ul class="nav nav-pills" id="recipients-tabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button type="button" id="missing-email-tab" data-bs-toggle="tab" data-bs-target="#missing-email" role="tab" aria-controls="missing-email" aria-selected="<?=count($withoutEmail) > 0 ? 'true' : 'false'?>" class="nav-link <?=count($withoutEmail) > 0 ? 'active' : ''?>">Missing email address (<span id="without-email-count"><?php echo count($withoutEmail); ?></span>)</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button type="button" id="statements-avail-tab" data-bs-toggle="tab" data-bs-target="#statements-avail" role="tab" aria-controls="statements-avail" aria-selected="<?=count($withoutEmail) < 1 ? 'true' : 'false'?>" class="nav-link <?=count($withoutEmail) < 1 ? 'active' : ''?>">Statements available (<span id="statements-count"><?php echo count($customers); ?></span>)</button>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="recipients-tab-content">
                                        <div class="tab-pane fade <?=count($withoutEmail) > 0 ? 'show active' : ''?>" id="missing-email" role="tabpanel" aria-labelledby="missing-email-tab">
                                            <table class="nsm-table" id="missing-email-table">
                                                <thead>
                                                    <tr>
                                                        <td class="table-icon text-center">
                                                            <input class="form-check-input select-all table-select" type="checkbox">
                                                        </td>
                                                        <td data-name="Recipients">RECIPIENTS</td>
                                                        <td data-name="Email Address">EMAIL ADDRESS</td>
                                                        <td data-name="Balance">BALANCE</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(count($withoutEmail) > 0) : ?>
                                                    <?php foreach($withoutEmail as $cust) : ?>
                                                    <tr>
                                                        <td>
                                                            <div class="table-row-icon table-checkbox">
                                                                <input class="form-check-input select-one table-select" type="checkbox" name="missing_email_customer[]" value="<?=$cust['id']?>">
                                                            </div>
                                                        </td>
                                                        <td><?=$cust['name']?></td>
                                                        <td><input type="email" name="no_email[]" class="form-control nsm-field" value="<?=$cust['email']?>"></td>
                                                        <td><?=str_replace('$-', '-$', '$'.number_format(floatval($cust['balance']), 2, '.', ','))?></td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                    <?php else : ?>
                                                    <tr>
                                                        <td colspan="4">
                                                            <div class="nsm-empty">
                                                                <span>No customers found for the applied filters.</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="tab-pane fade <?=count($withoutEmail) < 1 ? 'show active' : ''?>" id="statements-avail" role="tabpanel" aria-labelledby="statements-avail-tab">
                                            <table class="nsm-table" id="statements-table">
                                                <thead>
                                                    <tr>
                                                        <td class="table-icon text-center">
                                                            <input class="form-check-input select-all table-select" type="checkbox">
                                                        </td>
                                                        <td data-name="Recipients">RECIPIENTS</td>
                                                        <td data-name="Email Address">EMAIL ADDRESS</td>
                                                        <td data-name="Balance">BALANCE</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(count($customers) > 0) : ?>
                                                    <?php foreach($customers as $customer) : ?>
                                                    <tr>
                                                        <td>
                                                            <div class="table-row-icon table-checkbox">
                                                                <input class="form-check-input select-one table-select" type="checkbox" name="customer[]" value="<?=$customer['id']?>">
                                                            </div>
                                                        </td>
                                                        <td><?=$customer['name']?></td>
                                                        <td><input type="email" name="email[]" class="form-control nsm-field" value="<?=$customer['email']?>"></td>
                                                        <td><?=str_replace('$-', '-$', '$'.number_format(floatval($customer['balance']), 2, '.', ','))?></td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                    <?php else : ?>
                                                    <tr>
                                                        <td colspan="4">
                                                            <div class="nsm-empty">
                                                                <span>No customers found for the applied filters.</span>
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
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-md-4">
                            <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-md-4">
                            <div class="row h-100">
                                <div class="col-md-12 d-flex align-items-center justify-content-center">
                                    <span><a href="#" onclick="viewPrint(2, 'statement-summary')" class="text-dark text-decoration-none">Print or preview</a></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- Split dropup button -->
                            <div class="btn-group float-end" role="group">
                                <button type="button" class="nsm-button success" id="save-and-send">
                                    Save and send
                                </button>
                                <div class="btn-group" role="group">
                                    <button type="button" class="nsm-button success dropdown-toggle" style="margin-left: 0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-fw bx-chevron-up text-white"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" onclick="saveAndCloseForm(event)">Save and close</a>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="nsm-button float-end" id="save">Save</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</form>
</div>