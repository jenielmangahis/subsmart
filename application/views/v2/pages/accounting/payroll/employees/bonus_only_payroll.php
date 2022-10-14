<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<form onsubmit="submitModalForm(event, this)" id="bonus-only-form">
    <div id="bonus-payroll-modal" class="modal fade modal-fluid nsm-modal" role="dialog" data-bs-backdrop="false">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Run Payroll: Bonus Only</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row gy-3">
                        <div class="col-12">
                            <div class="form-group">
                                <h5>How would you like to enter your bonus amounts?</h5>
                            </div>
                        </div>
                        <div class="col-12 ps-5">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="net-pay" id="bonus_as_net_pay" name="bonus_as">
                                <label class="form-check-label" for="bonus_as_net_pay">
                                    As net pay
                                    <span class="content-subtitle d-block fst-italic">Great! We'll figure out the total pay for you.</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-12 ps-5">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="gross-pay" id="bonus_as_gross_pay" name="bonus_as" checked>
                                <label class="form-check-label" for="bonus_as_gross_pay">
                                    As gross pay
                                    <span class="content-subtitle d-block fst-italic">Got it! We'll figure out the net pay for you.</span>
                                </label>
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
                            <button class="nsm-button success float-end" type="button" id="continue-bonus-payroll">
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