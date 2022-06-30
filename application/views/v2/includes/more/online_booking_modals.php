<div class="modal fade nsm-modal fade" id="add_category_modal" tabindex="-1" aria-labelledby="add_category_modal_label" aria-hidden="true">
    <?php echo form_open_multipart('booking/create_category', ['class' => 'form-validate', 'autocomplete' => 'off']); ?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Add Category</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="content-subtitle fw-bold d-block mb-2">Category Name</label>
                        <input type="text" placeholder="Name" name="category_name" id="category_name" class="nsm-field form-control" required />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary">Add</button>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>

<div class="modal fade nsm-modal fade" id="edit_category_modal" tabindex="-1" aria-labelledby="edit_category_modal_label" aria-hidden="true">
    <?php echo form_open_multipart('booking/update_category', ['class' => 'form-validate', 'autocomplete' => 'off']); ?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Edit Category</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" id="edit_category_container">
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary">Update</button>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>

<div class="modal fade nsm-modal fade" id="add_service_item_modal" tabindex="-1" aria-labelledby="add_service_item_modal_label" aria-hidden="true">
    <?php echo form_open_multipart('booking/create_service_item', ['class' => 'form-validate', 'autocomplete' => 'off']); ?>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Add Service/Item</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12 col-md-7">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="content-subtitle fw-bold d-block mb-2">Category</label>
                                <select class="nsm-field form-control" id="category_id" name="category_id" required>
                                    <option value="" disabled selected>Select Category</option>
                                    <?php foreach ($category as $cat) { ?>
                                        <option value="<?= $cat->id; ?>"><?= $cat->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="content-subtitle fw-bold d-block mb-2">Name</label>
                                <input type="text" placeholder="Name" name="name" id="name" class="nsm-field form-control" required />
                            </div>
                            <div class="col-12">
                                <label class="content-subtitle fw-bold d-block mb-2">Description</label>
                                <textarea class="nsm-field form-control" cols="40" rows="5" name="description" id="description" placeholder="Description"></textarea>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="content-subtitle fw-bold d-block mb-2">Price ($)</label>
                                <input type="text" name="price" id="price" value="0" class="nsm-field form-control" required />
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="content-subtitle fw-bold d-block mb-2">Price Unit</label>
                                <select class="nsm-field form-control" id="price_unit" name="price_unit" required>
                                    <option value="" disabled selected>Select Price Unit</option>
                                    <option value="each">each</option>
                                    <option value="sq. ft.">sq. ft.</option>
                                    <option value="sq. yd.">sq. yd.</option>
                                    <option value="linear ft.">linear ft.</option>
                                    <option value="item">item</option>
                                    <option value="room">room</option>
                                    <option value="hour">hour</option>
                                    <option value="day">day</option>
                                    <option value="lb">lb</option>
                                    <option value="total">total</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                            <label class="content-subtitle fw-bold d-block mb-2">Image</label>
                        <div class="nsm-img-upload">
                            <span class="nsm-upload-label disable-select">Drop or click image to upload</span>
                            <input type="file" name="product-image" class="nsm-upload" accept="image/*" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary">Add</button>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>

<div class="modal fade nsm-modal fade" id="edit_service_item_modal" tabindex="-1" aria-labelledby="edit_service_item_modal_label" aria-hidden="true">
    <?php echo form_open_multipart('booking/update_service_item', ['class' => 'form-validate', 'autocomplete' => 'off']); ?>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Edit Service/Item</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" id="edit_service_container">
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary">Update</button>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>