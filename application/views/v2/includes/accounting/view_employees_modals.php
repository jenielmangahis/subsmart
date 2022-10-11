<div class="modal fade nsm-modal" id="edit-employment-details-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" id="edit-employment-details-form">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Employment details</span>
                <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <h3>Let's get down to <?=$employee->FName?>'s job specifics</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-12 col-md-8">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-select nsm-field">
                                    <option value="1" <?=$employee->status === '1' ? 'selected' : ''?>>Active</option>
                                    <option value="2" <?=$employee->status === '2' ? 'selected' : ''?>>Paid leave of absence</option>
                                    <option value="3" <?=$employee->status === '3' ? 'selected' : ''?>>Unpaid leave of absence</option>
                                    <option value="0" <?=$employee->status === '0' ? 'selected' : ''?>>Terminated</option>
                                    <option value="4" <?=$employee->status === '4' ? 'selected' : ''?>>Not on payroll</option>
                                    <option value="5" <?=$employee->status === '5' ? 'selected' : ''?>>Deceased</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-8">
                                <label for="hire-date">Hire date</label>
                                <div class="nsm-field-group calendar">
                                    <input type="text" class="form-control nsm-field date" id="hire-date" name="hire_date" value="<?=date("m/d/Y", strtotime($employee->date_hired))?>">
                                </div>
                            </div>
                            <div class="col-12 col-md-8">
                                <label for="pay-schedule">Pay schedule</label>
                                <select name="pay_schedule" id="pay-schedule" class="form-select nsm-field">
                                    <option value="add">&plus; Add new</option>
                                    <?php foreach($pay_schedules as $pay_schedule) : ?>
                                        <option value="<?=$pay_schedule->id?>" <?=$pay_details->pay_schedule_id === $pay_schedule->id ? 'selected' : ''?>><?=$pay_schedule->name?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-12 col-md-8">
                                <label for="employee-id">Employee ID</label>
                                <input type="text" class="form-control nsm-field" name="employee_id" id="employee-id">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" name="btn_modal_close" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="btn_modal_save" class="nsm-button primary">Save</button>
            </div>
        </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal" id="edit-payment-method-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" id="edit-payment-method-form">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Select payment method</span>
                <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <h3>How would you like to pay <?=$employee->FName?>?</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="payment-method">Payment method</label>
                        <select name="payment_method" id="payment-method" class="form-select nsm-field">
                            <option value="" <?=$pay_details->pay_method === 'paper-check' ? 'selected' : ''?>>Paper check</option>
                            <option value="" <?=$pay_details->pay_method === 'direct-deposit' ? 'selected' : ''?>>Direct deposit</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" name="btn_modal_close" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="btn_modal_save" class="nsm-button primary">Save</button>
            </div>
        </div>
        </form>
    </div>
</div>