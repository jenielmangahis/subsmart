<!-- Modal for bank deposit-->
<div class="full-screen-modal">
    <div id="payrollModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title">Run Payroll</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body pb-0">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="payFrom">Pay from</label>
                                <select name="pay_from" id="payFrom" class="form-control">
                                    <option value="">Corporate Account(XXXXXX 5850)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 d-flex align-items-center">
                            <h6>Balance -$84,717.24</h6>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="payPeriod">Pay period</label>
                                <select name="pay_period" id="payPeriod" class="form-control">
                                    <option value="">01/05/2021 to 01/11/2021</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="payDate">Pay date</label>
                                <input type="date" name="pay_date" id="payDate" class="form-control">
                            </div>
                        </div>
                        <div class="col text-right">
                            <p class="mb-1">TOTAL PAY</p>
                            <h2>$0.00</h2>
                        </div>
                    </div>

                    <div class="row bg-white" style="margin: 0 -30px; padding: 30px">
                        <div class="col-md-12">
                            <div class="employees-table-container">
                                <div class="employees-table">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <th></th>
                                            <th>EMPLOYEE</th>
                                            <th>PAYMENT METHOD</th>
                                            <th>REGULAR PAY HRS</th>
                                            <th>COMMISSION</th>
                                            <th>MEMO</th>
                                            <th>TOTAL PAY</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <a href="#" class="text-info">Pemberton, Joshua S</a>
                                                    <p class="m-0"><span>Commission</span></p>
                                                </td>
                                                <td><a href="#" class="text-info">Paper check</a></td>
                                                <td>
                                                    <input type="number" name="" id="" class="form-control w-50 float-right text-right">
                                                </td>
                                                <td>
                                                    <div class="row m-0">
                                                        <label for="commission" class="col-sm-6 col-form-label text-right">$</label>
                                                        <div class="col-sm-6">
                                                            <input type="number" class="form-control" id="commission" name="commission">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" name="memo" id="memo" class="form-control">
                                                </td>
                                                <td>$0.00</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr class="text-right">
                                                <td></td>
                                                <td></td>
                                                <td>TOTAL</td>
                                                <td>0.00</td>
                                                <td>$0.00</td>
                                                <td></td>
                                                <td>$0.00</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <a href="#" class="text-info">Add an employee</a>
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
                            <!-- Split dropup button -->
                            <div class="btn-group dropup float-right">
                                <button type="button" class="btn btn-success">
                                    Preview payroll
                                </button>
                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Save for later</a>
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