<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<form onsubmit="submitModalForm(event, this)" id="modal-form">
    <div id="statementModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title">Create Statements</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card p-0 m-0">
                                <div class="card-body" style="padding-bottom: 1.25rem">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="statementType">Statement Type</label>
                                                <select name="statement_type" id="statementType" class="form-control">
                                                    <option value="1">Balance Forward</option>
                                                    <option value="2">Open Item (Last 365 days)</option>
                                                    <option value="3">Transaction Statement</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 offset-md-6 text-right">
                                            <p class="m-0">TOTAL BALANCE FOR <span id="total-customers"><?php echo count($customers); ?></span> CUSTOMERS</p>
                                            <h2 class="m-0"><span id="total-amount">$<?php echo $total; ?></span></h2>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="statementDate">Statement Date</label>
                                                <input type="text" class="form-control date" name="statement_date" id="statementDate" value="<?php echo date('m/d/Y') ?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="customerBalanceStatus">Customer Balance Status</label>
                                                <select name="customer_balance_status" id="customerBalanceStatus" class="form-control">
                                                    <option value="all">All</option>
                                                    <option value="open" selected>Open</option>
                                                    <option value="overdue">Overdue</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="startDate">Start Date</label>
                                                <input onchange="showApplyButton()" type="text" class="form-control date" name="start_date" id="startDate" value="<?php echo date('m/d/Y', strtotime('-1 months')); ?>"/>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="endDate">End Date</label>
                                                <input onchange="showApplyButton()" type="text" class="form-control date" name="end_date" id="endDate" value="<?php echo date('m/d/Y'); ?>"/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-rounded apply-button hide">Apply</button>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <h2>Recipients List</h2>
                                        </div>

                                        <div class="col-md-12">
                                            <ul class="nav nav-tabs" id="recipientsTab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link" id="missing-email-tab" data-toggle="tab" href="#missing-email" role="tab" aria-controls="missing-email" aria-selected="true">Missing email address (<span id="without-email-count"><?php echo count($withoutEmail); ?></span>)</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="statements-avail-tab" data-toggle="tab" href="#statements-avail" role="tab" aria-controls="statements-avail" aria-selected="true">Statements available (<span id="statements-count"><?php echo count($customers); ?></span>)</a>
                                                </li>
                                            </ul>

                                            <div class="tab-content mt-3" id="myTabContent">
                                                <div class="tab-pane fade" id="missing-email" role="tabpanel" aria-labelledby="missing-email-tab">
                                                    <table class="table table-bordered table-hover" id="missing-email-table">
                                                        <thead>
                                                            <th>
                                                                <div class="form-group d-flex" style="margin-bottom: 0 !important">
                                                                    <input class="m-auto" type="checkbox" name="select_all_missing" value="1" checked>
                                                                </div>
                                                            </th>
                                                            <th>RECIPIENTS</th>
                                                            <th>EMAIL ADDRESS</th>
                                                            <th class="text-right">BALANCE</th>
                                                        </thead>
                                                        <tbody>
                                                            <?php if(count($withoutEmail) > 0) :
                                                            foreach($withoutEmail as $cust) : ?>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group d-flex" style="margin-bottom: 0 !important">
                                                                            <input class="m-auto select-customer" type="checkbox" name="missing_email_customer[]" value="<?php echo $cust['id']; ?>" checked>
                                                                        </div>
                                                                    </td>
                                                                    <td><?php echo $cust['name']; ?></td>
                                                                    <td><input type="email" name="no_email[<?php echo $cust["id"]; ?>]" class="form-control customer-email" value="<?php echo $cust['email']; ?>"></td>
                                                                    <td class="text-right">$<?php echo $cust['balance']; ?></td>
                                                                </tr>
                                                            <?php endforeach;
                                                            endif; ?>
                                                        </tbody>
                                                    </table>
                                                    
                                                    <?php if(count($withoutEmail) === 0) : ?>
                                                    <div class="no-results text-center p-4">
                                                        No customers found for the applied filters.
                                                    </div>
                                                    <?php endif?>
                                                </div>
                                                <div class="tab-pane fade show active" id="statements-avail" role="tabpanel" aria-labelledby="statements-avail-tab">
                                                    <table class="table table-bordered table-hover" id="statements-table">
                                                        <thead>
                                                            <th>
                                                                <div class="form-group d-flex" style="margin-bottom: 0 !important">
                                                                    <input class="m-auto" type="checkbox" name="select_all" value="1" checked>
                                                                </div>
                                                            </th>
                                                            <th>RECIPIENTS</th>
                                                            <th>EMAIL ADDRESS</th>
                                                            <th class="text-right">BALANCE</th>
                                                        </thead>
                                                        <tbody>
                                                            <?php if(count($customers) > 0) :
                                                            foreach($customers as $customer) : ?>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group d-flex" style="margin-bottom: 0 !important">
                                                                            <input class="m-auto select-customer" type="checkbox" name="customer[]" value="<?php echo $customer['id']; ?>" checked>
                                                                        </div>
                                                                    </td>
                                                                    <td><?php echo $customer['name']; ?></td>
                                                                    <td><input type="email" name="email[<?php echo $customer["id"]; ?>]" class="form-control customer-email" value="<?php echo $customer['email']; ?>"></td>
                                                                    <td class="text-right">$<?php echo $customer['balance']; ?></td>
                                                                </tr>
                                                            <?php endforeach;
                                                            endif; ?>
                                                        </tbody>
                                                    </table>

                                                    <?php if(count($customers) === 0) : ?>
                                                    <div class="no-results text-center p-4">
                                                        No customers found for the applied filters.
                                                    </div>
                                                    <?php endif?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-secondary">
                    <div class="row w-100">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-secondary btn-rounded border" data-dismiss="modal">Close</button>
                        </div>
                        <div class="col-md-4">
                            <div class="row h-100">
                                <div class="col-md-12 d-flex align-items-center justify-content-center">
                                    <span><a href="#" onclick="viewPrint(2, 'statement-summary')" class="text-white">Print or preview</a></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- Split dropup button -->
                            <div class="btn-group dropup float-right ml-2">
                                <button type="button" class="btn btn-success" id="save-and-send">
                                    Save and send
                                </button>
                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Save and close</a>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-secondary btn-rounded border float-right">Save</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</form>
<div id="showPdfModal" class="modal fade modal-fluid" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" style="height: 100%;">
            <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                <h4 class="modal-title">Print</h4>
                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
            </div>
            <div class="modal-body">
                <div class="row h-100">
                    <div class="col-xl-12">
                        <div class="card p-0 m-0 h-100">
                            <div class="card-body" style="padding-bottom: 1.25rem">
                                <div class="row h-100">
                                    <div class="col-12">
                                        <iframe id="showPdf" src="/accounting/show-pdf" frameborder="0" style="width: 100%; height: 100%;"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-secondary">
                <div class="row w-100">
                    <div class="col-md-4">
                        <button type="button" class="btn btn-secondary btn-rounded border" data-dismiss="modal">Close</button>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-success btn-rounded float-right" id="print-deposit-pdf">Print</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>