<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<form onsubmit="submitModalForm(event, this)" id="modal-form">
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
                                    <option value="1">Corporate Account(XXXXXX 5850)</option>
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
                                    <?php foreach($payPeriods as $period) : ?>
                                        <option value="<?php echo $period['first_day'] . '-' . $period['last_day']; ?>" <?php echo $period['selected'] === true ? 'selected' : ''; ?>><?php echo $period['first_day'] . ' to ' . $period['last_day']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="payDate">Pay date</label>
                                <input type="text" class="form-control date" name="pay_date" id="payDate" value="<?php echo date('m/d/Y') ?>"/>
                            </div>
                        </div>
                        <div class="col text-right">
                            <p class="mb-1">TOTAL PAY</p>
                            <h2 class="total-pay">$0.00</h2>
                        </div>
                    </div>

                    <div class="row bg-white" style="margin: 0 -30px; padding: 30px">
                        <div class="col-md-12">
                            <div class="employees-table-container">
                                <div class="employees-table">
                                    <table class="table table-bordered table-hover" id="payroll-table">
                                        <thead>
                                            <th>
                                                <div class="form-group d-flex" style="margin-bottom: 0 !important">
                                                    <input class="m-auto" type="checkbox" name="select_all" value="1" checked>
                                                </div>
                                            </th>
                                            <th>EMPLOYEE</th>
                                            <th>PAY METHOD</th>
                                            <th width="15%">REGULAR PAY HRS</th>
                                            <th width="15%">COMMISSION</th>
                                            <th>MEMO</th>
                                            <th>TOTAL HOURS</th>
                                            <th>TOTAL PAY</th>
                                        </thead>
                                        <tbody>
                                            <?php if(count($employees) > 0) : 
                                                foreach($employees as $employee) : ?>
                                                <tr>
                                                    <td>
                                                        <div class="form-group d-flex" style="margin-bottom: 0 !important">
                                                            <input class="m-auto" type="checkbox" name="select[]" value="<?php echo $employee->id; ?>" checked>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="text-info"><?php echo $employee->LName . ', ' . $employee->FName?></a>
                                                        <p class="m-0">$<span class="pay-rate"><?php echo $employee->pay_rate; ?></span> / hour</p>
                                                    </td>
                                                    <td><a href="#" class="text-info">Paper check</a></td>
                                                    <td>
                                                        <input type="number" name="reg_pay_hours[]" step="0.01" class="form-control w-75 float-right text-right regular-pay-hours">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="commission[]" step="0.01" class="form-control w-75 float-right text-right employee-commission">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="memo[]" class="form-control">
                                                    </td>
                                                    <td><p class="text-right m-0">0.00</p></td>
                                                    <td><p class="text-right m-0">$<span class="total-pay">0.00</span></p></td>
                                                </tr>
                                            <?php endforeach; 
                                                endif; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr class="text-right">
                                                <td></td>
                                                <td></td>
                                                <td>TOTAL</td>
                                                <td>0.00</td>
                                                <td>$0.00</td>
                                                <td></td>
                                                <td>0.00</td>
                                                <td><p class="text-right m-0">$0.00</p></td>
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
                            <button type="button" class="btn btn-secondary btn-rounded border" data-dismiss="modal" id="close-payroll-modal">Close</button>
                        </div>
                        <div class="col-md-4">
                            
                        </div>
                        <div class="col-md-4">
                            <!-- Split dropup button -->
                            <div class="btn-group dropup float-right">
                                <button type="button" class="btn btn-success" id="preview-payroll">
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
</form>
</div>