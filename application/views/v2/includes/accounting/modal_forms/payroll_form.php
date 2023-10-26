<div class="row">
    <div class="col-12 col-md-2">
        <label for="payFrom">Pay from</label>
        <select name="pay_from_account" id="bank-account" class="form-control nsm-field" required>
            <option value="<?=$accounts[array_key_first($accounts)]->id?>" selected><?=$accounts[array_key_first($accounts)]->name?></option>
        </select>
    </div>
    <div class="col-12 col-md-2 d-flex align-items-center">
        <h6>Balance <?=str_replace('$-', '-$', '$'.number_format(floatval($accounts[array_key_first($accounts)]->balance), 2, '.', ','))?></h6>
    </div>
    <?php if(!in_array($payscale->pay_type, ['Weekly', 'Monthly', 'Yearly'])) : ?>
    <div class="col-12 col-md-2">
        <label for="pay-period-start">Pay period start</label>
        <div class="nsm-field-group calendar">
            <input type="text" class="form-control nsm-field date" name="pay_period_start" id="pay-period-start" value="<?=$payPeriodStart?>"/>
        </div>
    </div>
    <div class="col-12 col-md-2">
        <label for="pay-period-end">Pay period end</label>
        <div class="nsm-field-group calendar">
            <input type="text" class="form-control nsm-field date" name="pay_period_end" id="pay-period-end" value="<?=$payPeriodEnd?>"/>
        </div>
    </div>
    <?php else : ?>
    <div class="col-12 col-md-2">
        <label for="payPeriod">Pay period</label>
        <select name="pay_period" id="payPeriod" class="form-control nsm-field">
            <?php foreach($payPeriods as $period) : ?>
                <option value="<?=$period['first_day'] . '-' . $period['last_day']?>" data-pay_date="<?=$period['pay_date']?>" <?=$period['selected'] === true ? 'selected' : ''?>><?=$period['text']?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <?php endif; ?>
    <div class="col-12 col-md-2">
        <label for="payDate">Pay date</label>
        <div class="nsm-field-group calendar">
            <input type="text" class="form-control nsm-field date" name="pay_date" id="payDate" value="<?=$payDate?>"/>
        </div>
    </div>
    <div class="col text-end">
        <h6>TOTAL PAY</h6>
        <h2 class="total-pay">$0.00</h2>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <table class="nsm-table" id="payroll-table">
            <thead>
                <tr>
                    <td class="table-icon text-center">
                        <input class="form-check-input select-all table-select" type="checkbox" checked>
                    </td>
                    <td data-name="Employee">EMPLOYEE</td>
                    <td data-name="Pay Method">PAY METHOD</td>
                    <td data-name="Regular Pay Hours" class="text-end">REGULAR PAY HOURS</td>
                    <td data-name="Commission" class="text-end">COMMISSION</td>
                    <td data-name="Memo">MEMO</td>
                    <td data-name="Total Hours" class="text-end">TOTAL HOURS</td>
                    <td data-name="Per Hour Pay" class="text-end">PER HOUR PAY</td>
                    <td data-name="Total Hours Pay" class="text-end">TOTAL HOURS PAY</td>
                    <td data-name="Total Pay" class="text-end">TOTAL PAY</td>
                </tr>
            </thead>
            <tbody>
                <?php if(count($employees)) : ?>
                <?php foreach($employees as $employee) : $commissionTotal += floatval(str_replace(',', '', $employee->commission));?>
                <tr>
                    <td>
                        <div class="table-row-icon table-checkbox">
                            <input class="form-check-input select-one table-select" type="checkbox" value="<?=$employee->id?>" checked>
                        </div>
                    </td>
                    <td>
                        <a href="#" class="text-decoration-none"><?=$employee->LName.', '.$employee->FName?></a>
                        <p class="m-0"><?=$employee->pay_rate?></p>
                    </td>
                    <td><?=$employee->pay_details->pay_method === 'direct-deposit' ? 'Direct deposit' : 'Paper check'?></td>
                    <td class="text-end"><?=number_format(floatval(str_replace(',', '', $employee->total_hrs)), 2)?></td>
                    <td class="text-end">$<?=number_format(floatval(str_replace(',', '', $employee->commission)), 2)?></td>
                    <td>
                        <input type="text" name="memo[]" class="form-control nsm-field">
                    </td>
                    <td><p class="m-0 text-end"><?=number_format(floatval(str_replace(',', '', $employee->total_hrs)), 2)?></p></td>
                    <td><p class="m-0 text-end">$<?=number_format(floatval(str_replace(',', '', $employee->per_hour_pay)), 2)?></p></td>
                    <td><p class="m-0 text-end">$<?=number_format(floatval(str_replace(',', '', $employee->regular_hrs_pay_total)), 2)?></p></td>
                    <td><p class="m-0 text-end"><span class="total-pay">$<?=number_format(floatval(str_replace(',', '', $employee->total_pay)), 2)?></span></p></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr class="text-end">
                    <td></td>
                    <td></td>
                    <td>TOTAL</td>
                    <td>0.00</td>
                    <td>$0.00</td>
                    <td></td>
                    <td>0.00</td>
                    <td>$0.00</td>
                    <td>$0.00</td>
                    <td>$0.00</td>
                </tr>
                <tr>
                    <td colspan="8">
                        <div class="nsm-page-buttons page-buttons-container">
                            <button type="button" class="nsm-button" id="add-employee-button">
                                Add an employee
                            </button>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>