<?php
defined('BASEPATH') or exit('No direct script access allowed');
echo put_header_assets();
include viewPath('v2/includes/header');
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    .select2-container,
    .set__box__icon,
    .set--h .set__box__separator{
        z-index: unset !important;
    }

    .set {
        border: 0;
        background-color: unset;
        background: unset;
        display: flex;
        gap: 1rem;
    }
    .set--h .set__box {
        --size: 100%;
        width: var(--size);
        height: var(--size);
        background-color: #f2f2f2;
    }
    .set__box img {
        width: inherit;
        height: 300px;
        object-fit: cover;
    }

    .fileinput-button {
        position: relative;
        overflow: hidden;
        display: block;
        text-align: center;
    }
    .fileinput-button input {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .upload-group {
        margin-bottom: 5rem;
    }
    .upload-group:last-child {
        margin-bottom: 1rem;
    }
</style>

<div class="row page-content g-0">
    <div class="nsm-page-nav mb-3">
        <ul>
            <li>
                <a class="nsm-page-link" href="<?php echo base_url('vault_v2/mylibrary') ?>">
                    <span>My Library</span>
                </a>
            </li>
            <li>
                <a class="nsm-page-link" href="<?php echo base_url('vault_v2/vault') ?>">

                    <span>Shared Library</span>
                </a>
            </li>
            <li>
                <a class="nsm-page-link" href="<?php echo base_url('vault_v2/businessformtemplates') ?>">

                    <span>Business Form Templates</span>
                </a>
            </li>
            <li  class="active">
                <a class="nsm-page-link" href="<?php echo base_url('vault_v2/beforeafter') ?>">

                    <span>Photos Gallery</span>
                </a>
            </li>

            <!-- Do not remove the last li -->
            <li><label></label></li>
        </ul>
    </div>

    <?php include viewPath('includes/notifications');?>
    <div>
        <div class="nsm-callout primary">
            <button><i class="bx bx-x"></i></button>
            Upload your before and after photos.
        </div>
    </div>

    <?php if (empty($photos)): ?>
        <?php echo form_open_multipart('Before_after_v2/saveBeforeAfter', ['class' => 'form-validate require-validation', 'id' => 'item_categories_form', 'autocomplete' => 'off']); ?>
    <?php else: ?>
        <?php echo form_open('before-after/update-before-after', ['class' => 'form-validate require-validation', 'id' => 'item_categories_form', 'autocomplete' => 'off']); ?>
    <?php endif;?>
        <div class="form-group mb-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <label>Customer</label> <span class="help">(optional, assign this session to a customer)</span>
                    <select id="sel-customer" name="customer_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                        <option></option>
                        <?php foreach ($customers as $c) {?>
                            <option value="<?=$c->prof_id;?>"><?=$c->first_name . ' ' . $c->last_name;?></option>
                        <?php }?>
                    </select>
                    <input type="hidden" id="job_customer_id" name=""">
                    <input type="hidden" id="group_number" name="group_number" value="<?php echo $group_number; ?>">
                </div>

                <a href="<?php echo base_url() . 'customer/add_advance' ?>"><span class="fa fa-plus"></span> New Customer</a>
            </div>
        </div>
        <div class="card" data-fileupload="list" style="border:1px solid white;">
            <div class="validation-error" data-fileupload="error" role="alert" style="display: none;"></div>
            <div class="" data-fileupload="progressbar" style="display: none;">
                <div class="text">Uploading</div>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                </div>
            </div>

            <div class="row upload-group">
                <div class="col-sm-4">
                    <div class="set clearfix set--h">
                        <div class="set__box">
                            <div class="set__box__title --off">Before</div>
                            <a class="set__box__delete" data-fileupload-delete="0,0" data-id="0" href=""><span class="fa fa-remove"></span></a>
                            <div class="set__box__icon " data-fileupload="upload" data-position="0,0"><span class="fa fa-camera"></span></div>
                            <?php if (empty($photos[0])): ?>
                                <img data-fileupload-image="0,0" id="b1_img" src="<?php echo base_url() . "assets/frontend/images/nopic.png"; ?>">
                            <?php else: ?>
                                <img data-fileupload-image="0,0" id="b1_img" src="<?php echo base_url() . "uploads/" . $photos[0]->before_image ?>">
                            <?php endif;?>
                            <div class="set__box__date"></div>
                        </div>
                        <div class="set__box">
                            <div class="set__box__title --off">After</div>
                            <a class="set__box__delete" data-fileupload-delete="0,1" data-id="0" href=""><span class="fa fa-remove"></span></a>
                            <div class="set__box__icon " data-fileupload="upload" data-position="0,1"><span class="fa fa-camera"></span></div>
                            <?php if (empty($photos[0]->after_image)): ?>
                                <img data-fileupload-image="0,0" id="a1_img" src="<?php echo base_url() . "assets/frontend/images/nopic.png"; ?>">
                            <?php else: ?>
                                <img data-fileupload-image="0,0" id="a1_img" src="<?php echo base_url() . "uploads/" . $photos[0]->after_image ?>">
                            <?php endif;?>
                            <div class="set__box__date"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <span class="nsm-button fileinput-button">Upload Before<input data-fileupload="file" data-position="0,0" data-orientation="h" onchange="readURL(this, 'b1_img');" name="b1_img" type="file" accept="image/*"></span>
                    <span class="nsm-button fileinput-button">Upload After <input data-fileupload="file" data-position="0,1" data-orientation="h" onchange="readURL(this, 'a1_img');" name="a1_img" type="file" accept="image/*"></span>
                </div>
                <div class="col-sm-6">
                    <div class="notes">
                        <label>Comments</label>
                        <textarea type="text" name="note[0]" value="" class="form-control" autocomplete="off"></textarea>
                    </div>
                </div>
            </div>

            <div class="row upload-group">
                <div class="col-sm-4">
                    <div class="set clearfix set--h">
                        <div class="set__box">
                            <div class="set__box__title --off">Before</div>
                            <a class="set__box__delete" data-fileupload-delete="1,0" data-id="0" href=""><span class="fa fa-remove"></span></a>
                            <div class="set__box__icon " data-fileupload="upload" data-position="1,0"><span class="fa fa-camera"></span></div>
                            <?php if (empty($photos[1])): ?>
                                <img data-fileupload-image="0,0" id="b2_img" src="<?php echo base_url() . "assets/frontend/images/nopic.png"; ?>">
                            <?php else: ?>
                                <img data-fileupload-image="0,0" id="b2_img" src="<?php echo base_url() . "uploads/" . $photos[1]->before_image ?>">
                            <?php endif;?>
                            <div class="set__box__date"></div>
                        </div>
                        <div class="set__box">
                            <div class="set__box__title --off">After</div>
                            <a class="set__box__delete" data-fileupload-delete="1,1" data-id="0" href=""><span class="fa fa-remove"></span></a>
                            <div class="set__box__icon " data-fileupload="upload" data-position="1,1"><span class="fa fa-camera"></span></div>
                            <?php if (empty($photos[1]->after_image)): ?>
                                <img data-fileupload-image="0,0" id="a2_img" src="<?php echo base_url() . "assets/frontend/images/nopic.png"; ?>">
                            <?php else: ?>
                                <img data-fileupload-image="0,0" id="a2_img" src="<?php echo base_url() . "uploads/" . $photos[1]->after_image ?>">
                            <?php endif;?>
                            <div class="set__box__date"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <span class="nsm-button fileinput-button">Upload Before<input data-fileupload="file" data-position="1,0" data-orientation="h" onchange="readURL(this, 'b2_img');" name="b2_img" type="file" accept="image/*"></span>
                    <span class="nsm-button fileinput-button">Upload After <input data-fileupload="file" data-position="1,1" data-orientation="h" onchange="readURL(this, 'a2_img');" name="a2_img" type="file" accept="image/*"></span>
                </div>
                <div class="col-sm-6">
                    <div class="notes">
                        <label>Comments</label>
                        <textarea type="text" name="note[1]" value="" class="form-control" autocomplete="off"></textarea>
                    </div>
                </div>
            </div>

            <div class="row upload-group">
                <div class="col-sm-4">
                    <div class="set clearfix set--h">
                        <div class="set__box">
                            <div class="set__box__title --off">Before</div>
                            <a class="set__box__delete" data-fileupload-delete="2,0" data-id="0" href=""><span class="fa fa-remove"></span></a>
                            <div class="set__box__icon " data-fileupload="upload" data-position="2,0"><span class="fa fa-camera"></span></div>
                            <?php if (empty($photos[2])): ?>
                                <img data-fileupload-image="0,0" id="b3_img" src="<?php echo base_url() . "assets/frontend/images/nopic.png"; ?>">
                            <?php else: ?>
                                <img data-fileupload-image="0,0" id="b3_img" src="<?php echo base_url() . "uploads/" . $photos[2]->before_image ?>">
                            <?php endif;?>
                            <div class="set__box__date"></div>
                        </div>
                        <div class="set__box">
                            <div class="set__box__title --off">After</div>
                            <a class="set__box__delete" data-fileupload-delete="2,1" data-id="0" href=""><span class="fa fa-remove"></span></a>
                            <div class="set__box__icon " data-fileupload="upload" data-position="2,1"><span class="fa fa-camera"></span></div>
                            <?php if (empty($photos[2]->after_image)): ?>
                                <img data-fileupload-image="0,0" id="a3_img" src="<?php echo base_url() . "assets/frontend/images/nopic.png"; ?>">
                            <?php else: ?>
                                <img data-fileupload-image="0,0" id="a3_img" src="<?php echo base_url() . "uploads/" . $photos[2]->after_image ?>">
                            <?php endif;?>
                            <div class="set__box__date"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <span class="nsm-button fileinput-button">Upload Before<input data-fileupload="file" data-position="2,0" data-orientation="h" onchange="readURL(this, 'b3_img');" name="b3_img" type="file" accept="image/*"></span>
                    <span class="nsm-button fileinput-button">Upload After <input data-fileupload="file" data-position="2,1" data-orientation="h" onchange="readURL(this, 'a3_img');" name="a3_img" type="file" accept="image/*"></span>
                </div>
                <div class="col-sm-6">
                    <div class="notes">
                        <label>Comments</label>
                        <textarea type="text" name="note[2]" value="" class="form-control" autocomplete="off"></textarea>
                    </div>
                </div>
            </div>

            <div class="row upload-group">
                <div class="col-sm-4">
                    <div class="set clearfix set--h">
                        <div class="set__box">
                            <div class="set__box__title --off">Before</div>
                            <a class="set__box__delete" data-fileupload-delete="3,0" data-id="0" href=""><span class="fa fa-remove"></span></a>
                            <div class="set__box__icon " data-fileupload="upload" data-position="3,0"><span class="fa fa-camera"></span></div>
                            <?php if (empty($photos[3])): ?>
                                <img data-fileupload-image="0,0" id="b4_img" src="<?php echo base_url() . "assets/frontend/images/nopic.png"; ?>">
                            <?php else: ?>
                                <img data-fileupload-image="0,0" id="b4_img" src="<?php echo base_url() . "uploads/" . $photos[3]->before_image ?>">
                            <?php endif;?>
                            <div class="set__box__date"></div>
                        </div>
                        <div class="set__box">
                            <div class="set__box__title --off">After</div>
                            <a class="set__box__delete" data-fileupload-delete="3,1" data-id="0" href=""><span class="fa fa-remove"></span></a>
                            <div class="set__box__icon " data-fileupload="upload" data-position="3,1"><span class="fa fa-camera"></span></div>
                            <?php if (empty($photos[3]->after_image)): ?>
                                <img data-fileupload-image="0,0" id="a4_img" src="<?php echo base_url() . "assets/frontend/images/nopic.png"; ?>">
                            <?php else: ?>
                                <img data-fileupload-image="0,0" id="a4_img" src="<?php echo base_url() . "uploads/" . $photos[3]->after_image ?>">
                            <?php endif;?>
                            <div class="set__box__date"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <span class="nsm-button fileinput-button">Upload Before<input data-fileupload="file" data-position="3,0" data-orientation="h" name="fileimage" onchange="readURL(this, 'b4_img');" id="b4_img" type="file" accept="image/*"></span>
                    <span class="nsm-button fileinput-button">Upload After <input data-fileupload="file" data-position="3,1" data-orientation="h" onchange="readURL(this, 'a4_img');" name="a4_img" type="file" accept="image/*"></span>
                </div>
                <div class="col-sm-6">
                    <div class="notes">
                        <label>Comments</label>
                        <textarea type="text" name="note[3]" value="" class="form-control" autocomplete="off"></textarea>
                    </div>
                </div>
            </div>

            <div class="row upload-group">
                <div class="col-sm-4">
                    <div class="set clearfix set--h">
                        <div class="set__box">
                            <div class="set__box__title --off">Before</div>
                            <a class="set__box__delete" data-fileupload-delete="4,0" data-id="0" href=""><span class="fa fa-remove"></span></a>
                            <div class="set__box__icon" data-fileupload="upload" data-position="4,0"><span class="fa fa-camera"></span></div>
                            <?php if (empty($photos[5])): ?>
                                <img data-fileupload-image="0,0" id="b5_img" src="<?php echo base_url() . "assets/frontend/images/nopic.png"; ?>">
                            <?php else: ?>
                                <img data-fileupload-image="0,0" id="b5_img" src="<?php echo base_url() . "uploads/" . $photos[4]->before_image ?>">
                            <?php endif;?>
                            <div class="set__box__date"></div>
                        </div>
                        <div class="set__box">
                            <div class="set__box__title --off">After</div>
                            <a class="set__box__delete" data-fileupload-delete="4,1" data-id="0" href=""><span class="fa fa-remove"></span></a>
                            <div class="set__box__icon " data-fileupload="upload" data-position="4,1"><span class="fa fa-camera"></span></div>
                            <?php if (empty($photos[4]->after_image)): ?>
                                <img data-fileupload-image="0,0" id="a5_img" src="<?php echo base_url() . "assets/frontend/images/nopic.png"; ?>">
                            <?php else: ?>
                                <img data-fileupload-image="0,0" id="a5_img" src="<?php echo base_url() . "uploads/" . $photos[4]->after_image ?>">
                            <?php endif;?>
                            <div class="set__box__date"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <span class="nsm-button fileinput-button">Upload Before<input data-fileupload="file" data-position="4,0" data-orientation="h"  onchange="readURL(this, 'b5_img');" name="b5_img" type="file" accept="image/*"></span>
                    <span class="nsm-button fileinput-button">Upload After <input data-fileupload="file" data-position="4,1" data-orientation="h" onchange="readURL(this, 'a5_img');" name="a5_img" type="file" accept="image/*"></span>
                </div>
                <div class="col-sm-6">
                    <div class="notes">
                        <label>Comments</label>
                        <textarea type="text" name="note[4]" value="" class="form-control" autocomplete="off"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <a class="nsm-button" href="<?=base_url() . "vault_v2/beforeafter";?>">Cancel</a>
        <button type="submit" class="nsm-button primary mb-0" id="saveBtnAddPhotos" style="border:0; height:34px;">Save images</button>
    <?php echo form_close(); ?>
</div>
<?php include viewPath('v2/includes/footer');?>
<script>
$(function(){
    $("#sel-customer").select2({
        placeholder: "Select Customer"
    });
});
</script>