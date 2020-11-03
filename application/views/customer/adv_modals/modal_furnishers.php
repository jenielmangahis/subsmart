<div class="modal fade" id="modal_furnishers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Add Furnisher</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_creditor_furnisher">
                <div class="modal-body">
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Furnisher / Creditor</label><span class="required"> *</span>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="subject" id="subject" required/>
                            </div>
                        </div>
                    </div>
                    <a id="more_detail_furnisher" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"  data-toggle="collapse" style="color:#1E5DA9;">+More detail</a>(Optional)
                    <div class="collapse" id="collapseExample">
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Address </label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="subject" id="subject" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">City </label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="subject" id="subject" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">State </label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="subject" id="subject" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Phone Number </label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="subject" id="subject" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Extension </label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="subject" id="subject" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Account Type </label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="subject" id="subject" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Notes: </label>
                            </div>
                            <div class="col-md-8">
                                <textarea type="text" class="form-controls" name="notes" id="notes" cols="35" rows="3"> </textarea>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <input type="hidden" class="form-control" name="fk_prof_id" id="fk_prof_id" value="<?= isset($profile_info) ? $profile_info->prof_id : '' ?>" />
                <input type="hidden" class="form-control" name="task_id" id="task_id" />
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>