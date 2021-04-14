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
            <input type="text" class="form-control date" name="pay_date" id="payDate" value="<?=$payDate?>"/>
        </div>
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
                        <th width="15%">REGULAR PAY HRS</th>
                        <th width="15%">COMMISSION</th>
                        <th>MEMO</th>
                        <th>TOTAL HOURS</th>
                        <th>TOTAL PAY</th>
                    </thead>
                    <tbody>
                        <?php if(count($payDetails) > 0) : ?>
                            <?php foreach($payDetails as $payDetail) : ?>
                            <?php $employee = $this->users_model->getUserByID($payDetail->user_id); ?>
                                <tr>
                                    <td>
                                        <div class="form-group d-flex" style="margin-bottom: 0 !important">
                                            <input class="m-auto" type="checkbox" name="select[]" value="<?=$payDetail->id?>" checked>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="text-info"><?=$employee->LName.', '.$employee->FName?></a>
                                        <?php 
                                            if($payDetail->pay_type === 'hourly') {
                                                $payRate = '$<span class="pay-rate">'.number_format(floatval($payDetail->pay_rate), 2, '.', ',').'</span>/hour';
                                            } else if($payDetail->pay_type === 'salary') {
                                                $payRate = '$<span class="pay-rate">'.number_format(floatval($payDetail->pay_rate), 2, '.', ',').'</span>/'.$payDetail->salary_frequency;
                                            } else {
                                                $payRate = 'Commission only';
                                            }
                                        ?>
                                        <p class="m-0"><?=$payRate?></p>
                                    </td>
                                    <td><?=$payDetail->pay_method === 'direct-deposit' ? 'Direct deposit' : 'Paper check'?></td>
                                    <td>
                                        <?php if($payDetail->pay_type !== 'commission') : ?>
                                        <?php if($paySchedule->pay_frequency === 'every-week' && $payDetail->pay_type === 'hourly') {
                                            $regPayHours = 40.00;
                                        } ?>
                                        <input type="number" name="reg_pay_hours[]" step="0.01" class="form-control w-75 float-right text-right regular-pay-hours" value="<?=number_format($regPayHours, 2, '.', ',')?>">
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($payDetail->pay_type === 'commission') : ?>
                                        <input type="number" name="commission[]" step="0.01" class="form-control w-75 float-right text-right employee-commission">
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <input type="text" name="memo[]" class="form-control">
                                    </td>
                                    <td><p class="text-right m-0">0.00</p></td>
                                    <td><p class="text-right m-0">$<span class="total-pay">0.00</span></p></td>
                                </tr>
                            <?php endforeach;?>
                        <?php endif; ?>
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