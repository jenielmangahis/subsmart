<div id="add-payee-modal" class="modal fade modal-fluid" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <form id="new-payee-form">
        <div class="modal-content" style="height: 100%;">
            <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                <h4 class="modal-title">New Name</h4>
                <button type="button" class="close cancel-add-payee">&times;</button>
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
                                            <input type="text" name="payee_name" id="payee_name" class="form-control">
                                        </div>
                                        <?php if($type !== 'vendor' && $type !== 'customer') : ?>
                                        <div class="form-group">
                                            <label for="name">Type</label>
                                            <select name="payee_type" id="payee_type" class="form-control">
                                                <option value="vendor">Vendor</option>
                                                <option value="customer">Customer</option>
                                            </select>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-link text-info" id="add-payee-details">&plus; Details</button>
                <button type="submit" class="btn btn-transparent btn-rounded float-right">Save</button>
            </div>
        </div>
        </form>
    </div>
</div>