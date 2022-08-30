<div class="full-screen-modal">
    <div id="showPdfModal" class="modal fade modal-fluid d-flex nsm-modal" role="dialog">
        <div class="modal-dialog" style="width: 90%; height: 90%; margin: auto">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Print Preview</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row h-100">
                        <div class="col">
                            <iframe id="showPdf" src="/accounting/show-pdf?pdf=<?=$filename?>" frameborder="0" style="width: 100%; height: 100%;"></iframe>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-md-4">
                            <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Close</button>
                        </div>
                        <div class="col-md-4">
                            
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="nsm-button success float-end" id="print-deposit-pdf">Print</button>
                            <a class="nsm-button float-end cursor-pointer" id="download-pdf" target="_blank" href="/accounting/download-pdf?filename=<?=$filename?>">Download</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>