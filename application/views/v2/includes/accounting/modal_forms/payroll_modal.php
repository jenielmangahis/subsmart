<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<form onsubmit="submitModalForm(event, this)" id="modal-form">
    <div id="payrollModal" class="modal fade modal-fluid nsm-modal" role="dialog" data-bs-backdrop="false">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Run Payroll</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 grid-mb">
                            <h4>Select a pay schedule for this payroll</h4>
                        </div>
                        <div class="col-12 col-md-6 offset-md-1">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <?php $i = 0; ?>
                                    <?php foreach($pay_schedules as $pay_sched) : ?>
                                        <?php $payDetails = $this->users_model->getPayDetailsByPaySched($pay_sched->id); ?>
                                        <?php if($payDetails !== null && count($payDetails) > 0) : ?>
                                        <div class="form-check">
                                            <input type="radio" name="pay_schedule" id="<?="pay_sched_$pay_sched->id"?>" class="form-check-input" value="<?=$pay_sched->id?>" <?=$i === 0 ? 'checked' : ''?>>
                                            <label for="<?="pay_sched_$pay_sched->id"?>" class="form-check-label"><span class="pay_sched_name"><?=$pay_sched->name?></span> (<?=count($payDetails)?> <?=count($payDetails) > 1 ? 'employees' : 'employee' ?>) </label>
                                        </div>
                                        <?php $i++; endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-md-4">
                            <button type="button" class="nsm-button primary" data-bs-dismiss="modal" id="close-payroll-modal">Cancel</button>
                        </div>
                        <div class="col-md-4">
                            
                        </div>
                        <div class="col-md-4">
                            <button class="nsm-button success float-end" type="button" id="continue-payroll">
                                Continue
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</form>
</div>