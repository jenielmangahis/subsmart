<div class="modal fade nsm-modal fade" id="edit_basic_info_modal" tabindex="-1" aria-labelledby="edit_basic_info_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <?php echo form_open_multipart('users/saveBusinessNameImage', ['id' => 'form-business-details', 'class' => 'form-validate', 'autocomplete' => 'off']); ?>
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Basic Info</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" value="<?php echo $profiledata->id; ?>">
                <div class="row gy-3">
                    <div class="col-12">
                        <div class="nsm-img-upload circle m-auto">
                            <span class="nsm-upload-label disable-select">Drop or click image to upload</span>
                            <input type="file" name="image" class="nsm-upload" accept="image/*">
                        </div>
                        <label class="content-subtitle text-muted w-100 text-center mt-4">Help your customers recognize your business by uploading a profile picture. Accepted files type: gif, jpg, png.</label>
                    </div>
                    <div class="col-12">
                        <label class="content-subtitle fw-bold d-block mb-2">Business Name <span class="nsm-text-error">*</span></label>
                        <input type="text" placeholder="e.g. Acme Inc" name="business_name" class="nsm-field form-control" autocomplete="off" value="<?php echo ($profiledata) ? $profiledata->business_name : '' ?>" required />
                    </div>
                    <div class="col-12">
                        <label class="content-subtitle fw-bold d-block mb-2">Business Short Description</label>
                        <label class="content-subtitle d-block mb-2">Give customers more details on what your business actually does. Describe your company's values and goals. Minimum 25 characters.</label>
                        <textarea class="nsm-field form-control" cols="40" rows="8" name="business_desc" placeholder="Description"><?php echo ($profiledata) ? $profiledata->business_desc : ''; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="nsm-button primary">Save</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="edit_image_caption_modal" tabindex="-1" aria-labelledby="edit_image_caption_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <?php echo form_open_multipart('', ['class' => 'form-validate', 'id' => 'form-edit-image-caption', 'autocomplete' => 'off']); ?>
        <?php echo form_input(array('name' => 'image_key', 'type' => 'hidden', 'value' => '', 'id' => 'caption_image_key')); ?>
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Edit Caption</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="content-subtitle fw-bold d-block mb-2">Caption</label>
                        <input type="text" name="image_caption" id="image_caption" class="nsm-field form-control" required />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="nsm-button primary">Save</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="add_image_modal" tabindex="-1" aria-labelledby="add_image_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="add_work_picture_form">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Add Work Pictures</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="nsm-img-upload">
                            <span class="nsm-upload-label disable-select">Drop or click image to upload</span>
                            <input type="file" name="work_picture" class="nsm-upload" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Done</button>
                <button type="submit" class="nsm-button primary">Add</button>
            </div>
        </div>
        </form>
    </div>
</div>