<div class="modal fade" id="modal_furnishers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Add Furnisher</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_creditor">
                <div class="modal-body">
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Furnisher / Creditor</label><span class="required"> *</span>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="furn_name" id="furn_name" required/>
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
                                <input type="text" class="form-control" name="furn_address" id="furn_address" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">City </label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="furn_city" id="furn_city" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">State </label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="furn_state" id="furn_state" />
                            </div>
                        </div>
                    </div>
                        <div class="col-md-12 form-line">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Zip </label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="furn_zip" id="furn_zip" />
                                </div>
                            </div>
                        </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Phone Number </label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="furn_phone_number" id="furn_phone_number" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Extension </label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="furn_acct_number" id="furn_acct_number" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Account Type </label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="furn_acct_number" id="furn_acct_number" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Notes: </label>
                            </div>
                            <div class="col-md-8">
                                <textarea type="text" class="form-controls" name="furn_notes" id="furn_notes" cols="35" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>