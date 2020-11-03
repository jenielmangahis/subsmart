<div class="modal fade" id="modal_import_credit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Enter & Confirm Credit Monitoring Access Details</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="audit_import_form">
                <div class="modal-body">
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Select Affiliate</label><span class="required"> *</span>
                            </div>
                            <div class="col-md-8">
                                <select id="affiliate" name="affiliate" data-customer-source="dropdown" class="form-control" required>
                                    <?php if (isset($affiliates)): ?>
                                        <?php foreach ($affiliates as $affiliate): ?>
                                            <option <?= isset($audit_info)  ? $affiliate->company == $audit_info->affiliate ?  'selected' : '' : '';   ?> value="<?= $affiliate->company; ?>"><?= $affiliate->company; ?></option>
                                        <?php endforeach ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Username</label><span class="required"> *</span>
                            </div>
                            <div class="col-md-8">
                                <input type="text" value="<?= isset($audit_info) ? $audit_info->username : ''; ?>" class="form-control" name="username" id="username" required/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Password</label><span class="required"> *</span>
                            </div>
                            <div class="col-md-8">
                                <input type="text" value="<?= isset($audit_info) ? $audit_info->password : ''; ?>" class="form-control" name="password" id="password" required/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Phone number</label><span class="required"> *</span>
                            </div>
                            <div class="col-md-8">
                                <input type="text" value="<?= isset($audit_info) ? $audit_info->phone_number : ''; ?>" class="form-control" name="phone_number" id="phone_number" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Last four digits of SSN <span class="required"> *</span></label>
                            </div>
                            <div class="col-md-8">
                                <input type="number" alue="<?= isset($audit_info) ? $audit_info->ssn_last : ''; ?>" maxlength="4" class="form-control" name="ssn_last" id="ssn_last" required/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Notes: </label>
                            </div>
                            <div class="col-md-8">
                                <textarea type="text" class="form-controls" name="notes" id="notes" cols="35" rows="3"><?= isset($audit_info) ? $audit_info->notes : ''; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" class="form-control" name="fk_prof_id" id="fk_prof_id" value="<?= isset($profile_info) ? $profile_info->prof_id : '' ?>" />
                <input type="hidden" class="form-control" value="<?= isset($audit_info) ? $audit_info->ai_id : '' ?>" name="ai_id" id="ai_id" />
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>