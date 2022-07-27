<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<form id="modal-form">
    <div id="printSetupModal" class="modal fade modal-fluid nsm-modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <span class="modal-title content-title">Print Checks</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row" style="min-height: 100%">
                        <div class="col">
                            <div class="card p-0 m-0" style="min-height: 100%">
                                <div class="card-body" style="padding-bottom: 1.25rem">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="nsm-progressbar my-4">
                                                <div class="progressbar">
                                                    <ul class="items-3">
                                                        <li class="active">PRINT SAMPLE</li>
                                                        <li>SET UP PDF READER</li>
                                                        <li>ADJUST ALIGNMENT</li>
                                                    </ul>
                                                </div>
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
                            <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-md-4 d-flex"></div>
                        <div class="col-md-4 text-end">
                            Are the fields lined up properly?
                            <button class="nsm-button success" id="preview-and-print">
                                No, continue setup
                            </button>
                            <button class="nsm-button success" id="preview-and-print">
                                Yes, I'm finished with setup
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