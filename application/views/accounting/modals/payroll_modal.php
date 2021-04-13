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
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card p-0 m-0">
                                <div class="card-body" style="padding-bottom: 1.25rem">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Select a pay schedule for this payroll</h5>
                                        </div>
                                        <?php $i = 0; ?>
                                        <?php foreach($pay_schedules as $pay_sched) : ?>
                                            <?php $payDetails = $this->users_model->getPayDetailsByPaySched($pay_sched->id); ?>
                                            <?php if($payDetails !== null && count($payDetails) > 0) : ?>
                                            <div class="form-check form-group ml-5">
                                                <input type="radio" name="pay_schedule" id="<?="pay_sched_$pay_sched->id"?>" class="form-check-input" value="<?=$pay_sched->id?>" <?=$i === 0 ? 'checked' : ''?>>
                                                <label for="<?="pay_sched_$pay_sched->id"?>"><span class="pay_sched_name"><?=$pay_sched->name?></span> (<?=count($payDetails)?> <?=count($payDetails) > 1 ? 'employees' : 'employee' ?>) </label>
                                            </div>
                                            <?php $i++; endif; ?>
                                        <?php endforeach; ?>
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
                            <button class="btn btn-success float-right" type="button" id="continue-payroll">
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