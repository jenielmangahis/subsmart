<!-- eSgin Modal -->
<div class="modal fade" id="fill_esign" role="dialog">
    <div class="close-modal" data-bs-dismiss="modal">&times;</div>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="banking-tab-container">
                    <div class="rb-01">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" id="esign-tab" data-bs-toggle="tab" role="tab" aria-controls="recent" href="#fill_esign_tab">
                                    Fill & eSign
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="approval-tab" data-bs-toggle="tab" role="tab" href="#approval_tab" aria-selected="false">
                                    Approval
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-body pt-3">
                <div class="tab-content" >
                    <div class="tab-pane active" id="fill_esign_tab" role="tabpanel" aria-labelledby="esign-tab">
                        <div class="d-none">
                            <a href="<?= base_url('esign/createTemplate'); ?>" style="float: right;" class="btn btn-sm btn-primary"><span class="fa fa-plus"></span> Add New</a>
                            <select name="library_template" id="library_template" class="select2LibrarySelection dropdown form-control">
                                <option>Select Library Template</option>
                                <?php if(isset($esign_templates)) : ?>
                                    <?php foreach($esign_templates as $esign_template){ ?>
                                        <option value="<?= $esign_template->esignLibraryTemplateId; ?>"><?= $esign_template->title; ?></option>
                                    <?php } ?>
                                <?php endif; ?>
                            </select>
                            <br>
                            <small>Template</small>
                            <hr>
                            <textarea id="summernote" name="template"></textarea>
                        </div>

                        <div class="fillAndSign fillAndSign--job">
                            <?php include viewPath('job/fillandesign/step1'); ?>
                            <?php include viewPath('job/fillandesign/step2'); ?>
                        </div>
                        <div class="modal-footer d-none">
                            <button type="button" class="btn btn-default" data-bs-dismiss="modal"><span class="fa fa-close"></span> Close</button>
                            <button type="button" id="click" class="btn btn-primary save-signature"><span class="fa fa-paper-plane-o"></span> Save</button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">
                                <span class="fa fa-close"></span> Close
                            </button>
                            <button type="button" data-status="Approved" data-id="<?php if(isset($jobs_data)){echo $jobs_data->job_unique_id;} ?>" class="btn btn-primary save-signature" id="fillAndSignNext">
                                <i class="fa fa-arrow-right"></i> Next
                            </button>
                            <button type="button" class="btn btn-primary save-signature" id="fillAndSignSave">
                                <i class="fa fa-save"></i> Save
                            </button>
                        </div>
                    </div>
                    <div class="tab-pane" id="approval_tab" role="tabpanel" aria-labelledby="approval-tab">
                        <?php include viewPath('job/fillandesign/step2'); ?>
                        <label>Authorizer Name</label>
                        <input type="text" name="authorizer_name" id="authorizer_name" class="form-control" >
                        <input type="hidden" value="<?php if(isset($jobs_data)){echo $jobs_data->job_unique_id;} ?>" name="jobs_id" id="jobs_id"  >
                        <br>
                        <label>Signature Below</label>
                        <hr>
                        <div id="signature" style='border:none;'>
                            <canvas id="signature-pad" class="signature-pad" width="700px" height="230px"></canvas>
                        </div>
                        <textarea style="display: none;" name="data[output]" id='output'></textarea>

                        <div class="modal-footer">
                            <button type="button" id="click" class="btn btn-primary save-signature" data-bs-dismiss="modal">
                                <span class="fa fa-paper-plane-o"></span> Save
                            </button>
                            <button type="button" id="cancel-signature" class="btn btn-default" data-bs-dismiss="modal">
                                <span class="fa fa-close"></span> Cancel
                            </button>
                            <button type="button" id="clear-signature" class="btn btn-default">
                                <span class="fa fa-close"></span> Clear
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
