<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<form id="modal-form">
    <div id="printSetupModal" class="modal fade modal-fluid nsm-modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Print checks setup</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row" style="min-height: 100%">
                        <div class="col">
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

                            <div class="row" id="step-1">
                                <div class="col-12">
                                    <div class="nsm-card primary">
                                        <div class="nsm-card-header d-block">
                                            <div class="nsm-card-title">
                                                <span>Select a check type and print a sample</span>
                                            </div>
                                        </div>

                                        <div class="nsm-card-content">
                                            <div class="row">
                                                <div class="col-12 col-md-4">
                                                    <ul class="list-unstyled">
                                                        <li>
                                                            <div class="row">
                                                                <div class="col-12 col-md-1"><h1>a</h1></div>
                                                                <div class="col-12 col-md-11 d-flex align-items-end">
                                                                    <p class="w-100">Select the type of checks you use:</p>
                                                                </div>
                                                                <div class="col-12 col-md-1"></div>
                                                                <div class="col-12 col-md-10">
                                                                    <div class="row">
                                                                        <div class="col-12 col-md-6">
                                                                            <div class="form-check">
                                                                                <input type="radio" id="voucher-type" name="check_type" value="1" class="form-check-input" <?=isset($settings) && $settings->check_type === '1' || !isset($settings) ? 'checked' : ''?>>
                                                                                <label for="voucher-type" class="form-check-label">Voucher</label>
                                                                                <div class="check-type-preview selected" id="voucher-type-preview"></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 col-md-6">
                                                                            <div class="form-check">
                                                                                <input type="radio" id="standard-type" name="check_type" value="2" class="form-check-input" <?=isset($settings) && $settings->check_type === '2' ? 'checked' : ''?>>
                                                                                <label for="standard-type" class="form-check-label">Standard</label>
                                                                                <div class="check-type-preview" id="standard-type-preview"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="row">
                                                                <div class="col-12 col-md-1"><h1>b</h1></div>
                                                                <div class="col d-flex align-items-end">
                                                                    <p>Load blank paper in your printer.</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="row">
                                                                <div class="col-12 col-md-1"><h1>c</h1></div>
                                                                <div class="col d-flex align-items-end">
                                                                    <button type="button" class="nsm-button preview-print-sample">View preview and print sample</button>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="row">
                                                                <div class="col-12 col-md-1"><h1>d</h1></div>
                                                                <div class="col d-flex align-items-end">
                                                                    <p>Place the sample on top of a blank check page. Hold them both up to the light.</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="step-2" style="display: none">
                                <div class="col-12">
                                    <div class="nsm-card primary">
                                        <div class="nsm-card-header d-block">
                                            <div class="nsm-card-title">
                                                <span>Set up Adobe Reader</span>
                                            </div>
                                        </div>

                                        <div class="nsm-card-content">
                                            <div class="row">
                                                <div class="col-12 col-md-4">
                                                    <ul class="list-unstyled">
                                                        <li>
                                                            <div class="row">
                                                                <div class="col-12 col-md-1"><h1>a</h1></div>
                                                                <div class="col-12 col-md-11">
                                                                    <p>Download the <a href="http://get.adobe.com/reader/" target="_blank">latest version of the Reader</a>. It's free.</p>
                                                                    <p>Already using Reader? Make sure you're using the latest version.</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="row">
                                                                <div class="col-12 col-md-1"><h1>b</h1></div>
                                                                <div class="col d-flex align-items-end">
                                                                    <p>Set Reader as the default viewer for PDFs for your browser. <a href="http://helpx.adobe.com/acrobat/using/display-pdf-browser-acrobat-xi.html" target="_blank">How?</a></p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="row">
                                                                <div class="col-12 col-md-1"><h1>c</h1></div>
                                                                <div class="col d-flex align-items-end">
                                                                    <button type="button" class="nsm-button preview-print-sample">View preview and print sample</button>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="row">
                                                                <div class="col-12 col-md-1"><h1>d</h1></div>
                                                                <div class="col d-flex align-items-end">
                                                                    <p>Place the sample on top of a blank check page. Hold them both up to the light.</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="step-3" style="display: none">
                                <div class="col-12">
                                    <div class="nsm-card primary">
                                        <div class="nsm-card-header d-block">
                                            <div class="nsm-card-title">
                                                <span>Fine-tune alignment</span>
                                            </div>
                                        </div>

                                        <div class="nsm-card-content">
                                            <div class="row">
                                                <div class="col-12 col-md-4">
                                                    <ul class="list-unstyled">
                                                        <li>
                                                            <div class="row">
                                                                <div class="col-12 col-md-1"><h1>a</h1></div>
                                                                <div class="col-12 col-md-11">
                                                                    <p><b>Drag the grid</b> inside the large square to the place where it appears on your printout. This lets nSmarTrac figure out how to adjust the alignment.</p>
                                                                    <div class="printsetup-container">
                                                                        <div class="printsetup-amountbox"></div>
                                                                        <div class="printsetup-amountgrid"></div>
                                                                    </div>
                                                                    <div class="offset-fields">
                                                                        <div class="row">
                                                                            <div class="col-12 col-md-6">
                                                                                <div class="form-group row">
                                                                                    <label for="horizontal-offset" class="col-12 col-md-3 col-form-label">Horizontal</label>
                                                                                    <div class="col-12 col-md-3">
                                                                                        <input type="number" name="horizontal_offset" class="nsm-field form-control" id="horizontal-offset" value="<?=isset($settings) ? $settings->horizontal : '0'?>">
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <div class="btn-group">
                                                                                            <button class="nsm-button" type="button" id="minus-h-offset">-</button>
                                                                                            <button class="nsm-button" type="button" id="plus-h-offset">+</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-12 col-md-6">
                                                                                <div class="form-group row">
                                                                                    <label for="vertical-offset" class="col-12 col-md-3 col-form-label">Vertical</label>
                                                                                    <div class="col-12 col-md-3">
                                                                                        <input type="number" name="vertical_offset" class="nsm-field form-control" id="vertical-offset" value="<?=isset($settings) ? $settings->vertical : '0'?>">
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <div class="btn-group">
                                                                                            <button class="nsm-button" type="button" id="minus-v-offset">-</button>
                                                                                            <button class="nsm-button" type="button" id="plus-v-offset">+</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="row">
                                                                <div class="col-12 col-md-1"><h1>b</h1></div>
                                                                <div class="col d-flex align-items-end">
                                                                    <button type="button" class="nsm-button preview-print-sample">View preview and print sample</button>
                                                                </div>
                                                            </div>
                                                        </li>
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

                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-md-6">
                            <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-md-6 text-end">
                            Are the fields lined up properly?
                            <button class="nsm-button success" id="continue-setup" type="button">
                                No, continue setup
                            </button>
                            <button class="nsm-button success" id="finish-setup" type="button">
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

<script src="<?php echo $url->assets ?>plugins/jqueryUI/jquery-ui.min.js"></script>