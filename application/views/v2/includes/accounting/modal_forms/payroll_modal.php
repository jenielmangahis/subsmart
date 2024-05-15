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
                                <h4>Select a payscale for this payroll</h4>
                            </div>
                            <div class="col-12 col-md-6 offset-md-1">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <?php $i = 0; ?>
                                        <?php if (isset($payscales) && is_array($payscales) && count($payscales) > 0) : ?>
                                            <?php foreach ($payscales as $payscale) : ?>
                                                <?php $payscaleEmps = $this->PayScale_model->get_company_employees_using_payscale($payscale->id); ?>
                                                <?php if ($payscaleEmps !== null && count($payscaleEmps) > 0) : ?>
                                                    <div class="form-check mb-3">
                                                        <input type="radio" name="payscale" id="<?= "payscale_$payscale->id" ?>" class="form-check-input" value="<?= $payscale->id ?>" <?= $i === 0 ? 'checked' : '' ?>>
                                                        <label for="<?= "payscale_$payscale->id" ?>" class="form-check-label"><span class="payscale_name"><?= $payscale->payscale_name ?></span> (<?= count($payscaleEmps) ?> <?= count($payscaleEmps) > 1 ? 'employees' : 'employee' ?>) </label>
                                                    </div>
                                                <?php $i++;
                                                endif; ?>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <p>No pay scales available.</p>
                                        <?php endif; ?>
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