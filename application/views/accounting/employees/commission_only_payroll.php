<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<form onsubmit="submitModalForm(event, this)" id="commission-only-form">
    <div id="commission-payroll-modal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title">Run Payroll: Commission Only</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card p-0 m-0">
                                <div class="card-body" style="padding-bottom: 1.25rem">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="payFrom">Pay from</label>
                                                <select name="pay_from" id="payFrom" class="form-control">
                                                    <?php foreach($accounts as $account) : ?>
                                                        <option value="<?=$account->id?>"><?=$account->name?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-center">
                                            <?php 
                                                if(strpos($accounts[array_key_first($accounts)]->balance, '-') !== false) {
                                                    $selectedBalance = str_replace('-', '-$', $accounts[array_key_first($accounts)]->balance);
                                                } else {
                                                    $selectedBalance = '$'.$accounts[array_key_first($accounts)]->balance;
                                                }
                                            ?>
                                            <h6>Balance <?=$selectedBalance?></h6>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="payDate">Pay date</label>
                                                <input type="text" class="form-control date" name="pay_date" id="payDate" value="<?php echo date('m/d/Y') ?>"/>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            
                                        </div>
                                        <div class="col text-right">
                                            <p class="mb-1">TOTAL PAY</p>
                                            <h2 class="total-pay">$0.00</h2>
                                        </div>
                                    </div>

                                    <div class="row">
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
                                                            <th>COMMISSION</th>
                                                            <th>MEMO</th>
                                                            <th>TOTAL PAY</th>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach($payDetails as $payDetail) : ?>
                                                                <?php $employee = $this->users_model->getUser($payDetail->user_id);?>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group d-flex" style="margin-bottom: 0 !important">
                                                                            <input class="m-auto" type="checkbox" name="select[]" value="<?php echo $employee->id; ?>" checked>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <a href="#" class="text-info"><?php echo $employee->LName . ', ' . $employee->FName?></a>
                                                                    </td>
                                                                    <td><?=$payDetail->pay_method === 'direct-deposit' ? 'Direct deposit' : 'Paper check'?></td>
                                                                    <td>
                                                                        <input type="number" name="commission[]" step="0.01" class="form-control w-75 float-right text-right">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" name="memo[]" class="form-control">
                                                                    </td>
                                                                    <td><p class="text-right m-0">$<span class="total-pay">0.00</span></p></td>
                                                                </tr>
                                                            <?php endforeach;?>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr class="text-right">
                                                                <td></td>
                                                                <td></td>
                                                                <td>TOTAL</td>
                                                                <td>$0.00</td>
                                                                <td></td>
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
                            </div>
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