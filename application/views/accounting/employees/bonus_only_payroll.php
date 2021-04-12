<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<form onsubmit="submitModalForm(event, this)" id="bonus-only-form">
    <div id="bonus-payroll-modal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title">Run Payroll: Bonus Only</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card p-0 m-0">
                                <div class="card-body" style="padding-bottom: 1.25rem">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>How would you like to enter your bonus amounts?</h5>
                                            </div>
                                            <div class="form-check form-group ml-5">
                                                <input type="radio" name="bonus_as" id="bonus_as_net_pay" class="form-check-input" value="net-pay">
                                                <label for="bonus_as_net_pay">As net pay</label>
                                                <p class="m-0 hide">Great! We'll figure out the total pay for you.</p>
                                            </div>
                                            <div class="form-check form-group ml-5">
                                                <input type="radio" name="bonus_as" id="bonus_as_gross_pay" class="form-check-input" value="gross-pay" checked>
                                                <label for="bonus_as_gross_pay">As gross pay</label>
                                                <p class="m-0">Got it! We'll figure out the net pay for you.</p>
                                            </div>
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
                            <button type="button" class="btn btn-secondary btn-rounded border" data-dismiss="modal" id="close-payroll-modal">Cancel</button>
                        </div>
                        <div class="col-md-4">
                            
                        </div>
                        <div class="col-md-4">
                            <!-- Split dropup button -->
                            <button class="btn btn-success float-right" type="button" id="continue-bonus-payroll">
                                Continue
                            </button>
                            <!-- <div class="btn-group dropup float-right">
                                <button type="button" class="btn btn-success" id="preview-payroll">
                                    Preview payroll
                                </button>
                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Save for later</a>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</form>
</div>