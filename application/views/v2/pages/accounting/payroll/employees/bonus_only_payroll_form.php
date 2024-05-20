<div class="modal-header">
    <span class="modal-title content-title">Run Payroll: Bonus Only</span>
    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-12 col-md-2">
            <label for="payFrom">Pay from</label>
            <select name="pay_from_account" id="bank-account" class="form-select nsm-field" required>
                <option value="<?= $accounts[array_key_first($accounts)]->id ?>" selected><?= $accounts[array_key_first($accounts)]->name ?></option>
            </select>
        </div>
        <div class="col-12 col-md-2 d-flex align-items-center">
            <h6>Balance <?= str_replace('$-', '-$', '$' . number_format(floatval($accounts[array_key_first($accounts)]->balance), 2, '.', ',')) ?></h6>
        </div>
        <div class="col-12 col-md-2">
            <label for="payDate">Pay date</label>
            <div class="nsm-field-group calendar">
                <input type="text" class="form-control nsm-field date" name="pay_date" id="payDate" value="<?php echo date('m/d/Y') ?>" />
            </div>
        </div>
        <!-- <div class="col-12 col-md-2">
            <label for="payDate">Pay date</label>
            <input type="date" class="form-control nsm-field date" name="pay_date" id="payDate" />
        </div> -->
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
                        <td>EMPLOYEE</td>
                        <td>PAY METHOD</td>
                        <td>BONUS</td>
                        <td>MEMO</td>
                        <td class="text-end"><?= $bonusPayType === 'gross-pay' ? 'TOTAL PAY' : 'GROSS PAY' ?></td>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($payDetails) > 0) : ?>
                        <?php foreach ($payDetails as $payDetail) : ?>
                            <?php $employee = $this->users_model->getUser($payDetail->user_id); ?>
                            <tr data-method="<?= $payDetail->pay_method === 'direct-deposit' ? 'Direct deposit' : 'Paper check' ?>">
                                <td>
                                    <div class="table-row-icon table-checkbox">
                                        <input class="form-check-input select-one table-select" type="checkbox" value="<?= $employee->id ?>" checked>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-decoration-none"><?= $employee->LName . ', ' . $employee->FName ?></span>
                                </td>
                                <td><?= $payDetail->pay_method === 'direct-deposit' ? 'Direct deposit' : 'Paper check' ?></td>
                                <td>
                                    <input type="number" name="bonus[]" step="0.01" class="form-control nsm-field text-end">
                                </td>
                                <td>
                                    <input type="text" name="memo[]" class="form-control nsm-field">
                                </td>
                                <td>
                                    <p class="m-0 text-end"><span class="total-pay">$0.00</span></p>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr class="text-end">
                        <td></td>
                        <td></td>
                        <td>TOTAL</td>
                        <td style="display: none;">$0.00</td>
                        <td></td>
                        <td></td>
                        <td>$0.00</td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <div class="nsm-page-buttons page-buttons-container">
                                <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#add_employee_modal">
                                    Add an employee
                                </button>
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<div class="modal-footer">
    <div class="row w-100">
        <div class="col-md-4">
            <button type="button" class="nsm-button primary" id="bonus-pay-select">Back</button>
        </div>
        <div class="col-md-4">

        </div>
        <div class="col-md-4">
            <div class="btn-group float-end" role="group">
                <button type="button" class="nsm-button success" id="preview-payroll">
                    Preview Payroll
                </button>
                <div class="btn-group" role="group">
                    <button type="button" class="nsm-button success dropdown-toggle" style="margin-left: 0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-fw bx-chevron-up text-white"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Save for later</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script>
    $(document).ready(function() {
        var today = new Date().toISOString().slice(0, 10);
        $('#payDate').val(today);
    });
</script> -->