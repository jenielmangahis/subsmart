<!-- Modal for bank deposit-->
<div class="full-screen-modal">
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
                                <select name="statement_type" id="statementType" class="form-control">
                                    <option value="">Balance Forward</option>
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
                                <input type="date" name="statement_date" id="statementDate" class="form-control">
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
                                <input type="date" name="start_date" id="startDate" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="endDate">End Date</label>
                                <input type="date" name="end_date" id="endDate" class="form-control">
                            </div>
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
                                    <a class="nav-link active" id="statements-avail-tab" data-toggle="tab" href="#statements-avail" role="tab" aria-controls="statements-avail" aria-selected="true">Statements available (2)</a>
                                </li>
                            </ul>

                            <div class="tab-content mt-3" id="myTabContent">
                                <div class="tab-pane fade" id="missing-email" role="tabpanel" aria-labelledby="missing-email-tab">
                                    <table class="table table-bordered table-hover" id="missing-email-table">
                                        <thead>
                                            <th><input type="checkbox" tabindex="-1" aria-checked="false"></th>
                                            <th>RECIPIENTS</th>
                                            <th>EMAIL ADDRESS</th>
                                            <th>BALANCE</th>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                    
                                    <div class="no-results text-center p-4">
                                        No customers found for the applied filters.
                                    </div>
                                </div>
                                <div class="tab-pane fade show active" id="statements-avail" role="tabpanel" aria-labelledby="statements-avail-tab">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <th><input type="checkbox" tabindex="-1" aria-checked="false"></th>
                                            <th>RECIPIENTS</th>
                                            <th>EMAIL ADDRESS</th>
                                            <th class="text-right">BALANCE</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="checkbox" tabindex="-1" aria-checked="true" checked></td>
                                                <td>Betty Fuller</td>
                                                <td><input type="text" placeholder="betty.fuller@gmail.com" class="form-control"></td>
                                                <td class="text-right">$3.00</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" tabindex="-1" aria-checked="true" checked></td>
                                                <td>Ken Curry</td>
                                                <td><input type="text" placeholder="ken.curry@gmail.com" class="form-control"></td>
                                                <td class="text-right">$1.00</td>
                                            </tr>
                                        </tbody>
                                    </table>
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
                            <a href="#" class="text-white m-auto">Print or Preview</a>
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
</div>