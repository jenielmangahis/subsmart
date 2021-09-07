<div id="item-category-modal" class="modal fade modal-fluid d-flex" role="dialog">
    <div class="modal-dialog w-25 m-auto" style="height: 30%">
        <!-- Modal content-->
        <form id="new-item-category-form" class="h-100">
        <div class="modal-content h-100">
            <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                <h4 class="modal-title">New Category</h4>
            </div>
            <div class="modal-body">
                <div class="row" style="min-height: 100%">
                    <div class="col">
                        <div class="card p-0 m-0" style="min-height: 100%">
                            <div class="card-body" style="padding-bottom: 1.25rem">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="name"><span class="text-danger">*</span> Name</label>
                                            <input type="text" name="name" id="name" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-transparent btn-rounded" id="cancel-add-category">Cancel</button>
                <button type="submit" class="btn btn-success btn-rounded float-right">Save</button>
            </div>
        </div>
        </form>
    </div>
</div>