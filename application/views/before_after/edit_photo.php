<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/filevault'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                        <?php echo form_open_multipart('before-after/update-before-after', ['class' => 'form-validate require-validation', 'id' => 'item_categories_form', 'autocomplete' => 'off']); ?>
                        <input type="hidden" name="id" value="<?= $beforeAfter->id; ?>">
                            <h2 class="page-title text-left">Edit Photo</h2>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div style="padding-top: 8px;">
                                        <p>Upload your photos.</p>
                                    </div>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <div class="btn-group" role="group" aria-label="...">
                                        <button class="btn btn-primary" data-to-customer="send" data-on-click-label="Sending..."><span class="fa fa-envelope-o fa-margin-right"></span> Send to Customer</button>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-12 col-lg-12 col-xl-9">
                                <div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Customer</label> <span class="help">(optional, assign this session to a customer)</span>
                                                <select id="sel-customer" name="customer_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select">
                                                    <option></option>
                                                    <?php foreach($customers as $c){ ?>
                                                        <option <?= $beforeAfter->customer_id == $c->prof_id ? 'selected="selected"' : ''; ?> value="<?= $c->prof_id; ?>"><?= $c->first_name . ' ' . $c->last_name; ?></option>
                                                    <?php } ?>
                                                </select>                                                
                                                <input type="hidden" id="job_customer_id" name=""">
                                                <input type="hidden" id="group_number" name="group_number" value="<?php echo $group_number;?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <div style="padding-top: 40px">
                                                    <a href="<?php echo base_url() . 'customer/add_advance' ?>"><span class="fa fa-plus"></span> New Customer</a>
                                                </div>
                                            </div>
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
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="set clearfix set--h">
                                                    <div class="set__box__separator"></div>
                                                    <div class="set__box">
                                                        <div class="set__box__title --off">Before</div>
                                                        <a class="set__box__delete" data-fileupload-delete="0,0" data-id="0" href=""><span class="fa fa-remove"></span></a>
                                                        <div class="set__box__icon " data-fileupload="upload" data-position="0,0"><span class="fa fa-camera"></span></div>
                                                        <img data-fileupload-image="0,0" id="b1_img" src="<?php echo base_url() . "uploads/" . $beforeAfter->before_image?>">
                                                        <div class="set__box__date"></div>
                                                    </div>
                                                    <div class="set__box">
                                                        <div class="set__box__title --off">After</div>
                                                        <a class="set__box__delete" data-fileupload-delete="0,1" data-id="0" href=""><span class="fa fa-remove"></span></a>
                                                        <div class="set__box__icon " data-fileupload="upload" data-position="0,1"><span class="fa fa-camera"></span></div>
                                                        <img data-fileupload-image="0,0" id="a1_img" src="<?php echo base_url() . "uploads/" . $beforeAfter->after_image?>">
                                                        <div class="set__box__date"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <span class="btn btn-default btn-block fileinput-button vertical-top pl-0 pr-0">Upload Before<input data-fileupload="file" data-position="0,0" data-orientation="h" onchange="readURL(this, 'b1_img');" name="b1_img" type="file"></span>
                                                <span class="btn btn-default btn-block fileinput-button vertical-top">Upload After <input data-fileupload="file" data-position="0,1" data-orientation="h" onchange="readURL(this, 'a1_img');" name="a1_img" type="file"></span>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="notes">
                                                    <label>Comments</label>
                                                    <input type="text" name="note" value="<?= $beforeAfter->note; ?>" class="form-control" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="card-hr">
                                    <button type="submit" class="btn btn-primary margin-right" id="saveBtnAddPhotos">Save</button>
                                    <a class="a-ter" href="<?php echo base_url() . "vault/beforeafter"; ?>">cancel this</a>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                    <!-- end card -->
                </div>
            </div>
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
<script>
$(function(){
    $("#sel-customer").select2({
        placeholder: "Select Customer"
    });
});
</script>