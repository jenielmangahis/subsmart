<!-- Modal for bank deposit-->
<div class="full-screen-modal">
    <div id="viewPrintChecksModal" class="modal fade modal-fluid d-flex nsm-modal" role="dialog">
        <div class="modal-dialog" style="width: 90%; height: 90%; margin: auto">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Print Preview</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row" style="min-height: 100%">
                        <div class="col">
                            <div class="row">
                                <div class="col-12">
                                    <div class="nsm-card primary">
                                        <div class="nsm-card-header d-block">
                                            <div class="nsm-card-title">
                                                <span>To print, right-click the preview and select Print. Or, click the Print icon if you see one below.</span>
                                            </div>
                                        </div>
                                        <div class="nsm-card-content">
                                            <div class="h-100">
                                                <iframe src="data:application/pdf;base64,<?=$pdf?>" type="application/pdf" frameborder="0" class="w-100" height="870px"></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-12 col-md-6">
                            <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-12 col-md-6 text-end">
                            <button class="nsm-button success" id="preview-and-print" type="button">
                                Print
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</div>