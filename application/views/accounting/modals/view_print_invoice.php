<!-- Modal for bank deposit-->
<div class="full-screen-modal">
    <div id="viewPrintInvoiceModal" class="modal fade modal-fluid d-flex" role="dialog">
        <div class="modal-dialog" style="width: 90%; height: 90%; margin: auto">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title">Print Preview</h4>                    
                    <!-- <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button> -->
                </div>
                <div class="modal-body">
                    <div class="row" style="min-height: 100%">
                        <div class="col">
                            <div class="card p-0 m-0" style="min-height: 100%">
                                <div class="card-body" style="padding-bottom: 1.25rem">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>To print, select the Print button, or right-click the PDF and select Print.</p>
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
                        <div class="col-md-4">
                            <button type="button" class="nsm-button primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                        </div>
                        <div class="col-md-4 d-flex"></div>
                        <div class="col-md-4">
                            <a href="javascript:void(0);" class="nsm-button primary float-right mr-1" id="preview-and-print">Print</a>
                            <a href="/accounting/download-invoice-pdf/<?=$invoice->id?>" class="nsm-button primary float-right mr-1" id="download-pdf">Download</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</div>