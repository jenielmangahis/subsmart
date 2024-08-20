<div class="modal fade nsm-modal" id="add-worksite-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="<?php echo base_url() ?>accounting/worksites/add-work-location" method="post" id="add-worksite-form" class="form-validate">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Add Work Location</span>
                    <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i
                            class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="name">Name</label>
                            <input type="text" class="form-control nsm-field" id="name" name="name" required>
                        </div>
                        <div class="col-12 mt-2">
                            <label for="street">Street</label>
                            <input type="text" class="form-control nsm-field" id="street" name="street" required>
                        </div>
                        <div class="col-12 col-md-6 mt-2">
                            <label for="city">City</label>
                            <input type="text" class="form-control nsm-field" id="city" name="city" required>
                        </div>
                        <div class="col-12 col-md-3 mt-2">
                            <label for="state">State</label>
                            <input type="text" class="form-control nsm-field" id="state" name="state" required>
                        </div>
                        <div class="col-12 col-md-3 mt-2">
                            <label for="zip-code">ZIP code</label>
                            <input type="text" class="form-control nsm-field" id="zip-code" name="zip_code" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" name="btn_modal_close" class="nsm-button"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btn_modal_save" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal edit-worksite-modal" id="edit-worksite-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="" method="post" id="update-worksite-form" class="form-validate">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Edit Work Location</span>
                    <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i
                            class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="name">Name</label>
                            <input type="text" class="form-control nsm-field" id="name" name="name" required>
                        </div>
                        <div class="col-12 mt-2">
                            <label for="street">Street</label>
                            <input type="text" class="form-control nsm-field" id="street" name="street" required>
                        </div>
                        <div class="col-12 col-md-6 mt-2">
                            <label for="city">City</label>
                            <input type="text" class="form-control nsm-field" id="city" name="city" required>
                        </div>
                        <div class="col-12 col-md-3 mt-2">
                            <label for="state">State</label>
                            <input type="text" class="form-control nsm-field" id="state" name="state" required>
                        </div>
                        <div class="col-12 col-md-3 mt-2">
                            <label for="zip-code">ZIP code</label>
                            <input type="text" class="form-control nsm-field" id="zip-code" name="zip_code" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" name="btn_modal_close" class="nsm-button"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btn_modal_save" class="nsm-button primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>