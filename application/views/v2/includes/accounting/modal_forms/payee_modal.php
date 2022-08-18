<div id="payee-modal" class="modal fade modal-fluid nsm-modal" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <!-- Modal content-->
        <form id="new-payee-form" class="w-50 m-auto">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">New Name</span>
                <button type="button" class="cancel-add-payee" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
            </div>
            <div class="modal-body">
                <div class="row" style="min-height: 100%">
                    <div class="col">
                        <label for="name"><span class="text-danger">*</span> Name</label>
                        <input type="text" name="payee_name" id="payee_name" class="nsm-field form-control mb-2">

                        <?php if($type !== 'vendor' && $type !== 'customer') : ?>
                        <label for="name">Type</label>
                        <select name="payee_type" id="payee_type" class="nsm-field form-control">
                            <option value="vendor">Vendor</option>
                            <option value="customer">Customer</option>
                        </select>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="nsm-button" id="add-payee-details"><i class="bx bx-fw bx-plus"></i> Details</button>
                <button type="submit" class="nsm-button success float-end">Save</button>
            </div>
        </div>
        </form>
    </div>
</div>