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
                <div class="modal-body pb-0">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group w-25">
                                <label for="statementType">Statement Type</label>
                                <select name="statement_type" id="statementType" class="form-control" onchange="showApplyButton()">
                                    <option value="1">Balance Forward</option>
                                    <option value="2">Open Item (Last 365 days)</option>
                                    <option value="3">Transaction Statement</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 text-right">
                            <p class="m-0">TOTAL BALANCE FOR 2 CUSTOMERS</p>
                            <h2 class="m-0">$4.00</h2>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="statementDate">Statement Date</label>
                                <input type="date" name="statement_date" id="statementDate" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="customerBalanceStatus">Customer Balance Status</label>
                                <select name="customer_balance_status" id="customerBalanceStatus" class="form-control" onchange="showApplyButton()">
                                    <option value="all">All</option>
                                    <option value="open" selected>Open</option>
                                    <option value="overdue">Overdue</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="startDate">Start Date</label>
                                <input onchange="showApplyButton()" type="date" name="start_date" id="startDate" class="form-control" value="<?php echo date('Y-m-d', strtotime('-1 months')); ?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="endDate">End Date</label>
                                <input onchange="showApplyButton()" type="date" name="end_date" id="endDate" class="form-control" value="<?php echo date('Y-m-d'); ?>">
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
                                    <a class="nav-link" id="missing-email-tab" data-toggle="tab" href="#missing-email" role="tab" aria-controls="missing-email" aria-selected="true">Missing email address (0)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" id="statements-avail-tab" data-toggle="tab" href="#statements-avail" role="tab" aria-controls="statements-avail" aria-selected="true">Statements available (0)</a>
                                </li>
                            </ul>

                            <div class="tab-content mt-3" id="myTabContent">
                                <div class="tab-pane fade" id="missing-email" role="tabpanel" aria-labelledby="missing-email-tab">
                                    <table class="table table-bordered table-hover" id="missing-email-table">
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

                                        </tbody>
                                    </table>
                                    
                                    <div class="no-results text-center p-4">
                                        No customers found for the applied filters.
                                    </div>
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
                                            
                                        </tbody>
                                    </table>

                                    <div class="no-results text-center p-4">
                                        No customers found for the applied filters.
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
                        <div class="col-md-4 d-flex">

                        </div>
                        <div class="col-md-4">
                            <!-- Split dropup button -->
                            <div class="btn-group dropup float-right">
                                <button type="button" class="btn btn-success">
                                    Save and new
                                </button>
                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Save and close</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</form>
</div>