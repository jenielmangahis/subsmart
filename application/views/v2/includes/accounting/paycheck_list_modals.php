<div class="full-screen-modal">
    <div id="print-save-pdf-modal" class="modal fade nsm-modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Print or save as PDF</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row h-100">
                        <div class="col-12 col-md-2">
                            <h3 class="mb-3">Print settings</h3>
                            <h5 class="mb-3">Orientation</h5>
                            <div class="form-check mb-2">
                                <input type="radio" name="pdf_orientation" id="portrait-orientation" class="form-check-input" value="portrait" <?=!empty($orientation) && $orientation === 'portrait' ? 'checked' : '' ?>>
                                <label for="portrait-orientation" class="form-check-label">Portrait</label>
                            </div>
                            <div class="form-check mb-2">
                                <input type="radio" name="pdf_orientation" id="landscape-orientation" class="form-check-input" value="landscape" <?=empty($orientation) ? 'checked' : '' ?>>
                                <label for="landscape-orientation" class="form-check-label">Landscape</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-10">
                            <iframe id="paychecks-pdf" src="<?=$pdfBlob?>" frameborder="0" style="width: 100%; height: 100%;"></iframe>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-12 col-md-6">
                            <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-12 col-md-6">
                            <button type="button" class="nsm-button success float-end" id="print-pdf">Print</button>
                            <button type="button" class="nsm-button float-end" id="save-as-pdf">Save as PDF</button>
                            <!-- <a class="nsm-button float-end cursor-pointer" id="download-pdf" target="_blank" href="/accounting/download-pdf?filename=<?=$filename?>">Download</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>