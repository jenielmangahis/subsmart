<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/before_after'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                        <?php if (empty($job_data)) : ?>
                            <?php echo form_open('job/saveJob', ['class' => 'form-validate require-validation', 'id' => 'item_categories_form', 'autocomplete' => 'off']); ?>
                        <?php else :?>
                            <?php echo form_open('job/updateJob', ['class' => 'form-validate require-validation', 'id' => 'item_categories_form', 'autocomplete' => 'off']); ?>
                        <?php endif;?>
                            <h2 class="page-title text-left">Add Photos</h2>
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
                                <form data-ba="form" method="post" action="#">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Customer</label> <span class="help">(optional, assign this session to a customer)</span>
                                                <input id="job_customer" class="form-control" type="text" placeholder="Customer">
                                                <input type="hidden" id="job_customer_id" name="job_customer_id">
                                                <input type="hidden" id="customer_id" name="customer_id" value="">
                                            </div>
                                            <div class="col-sm-6">
                                                <div style="padding-top: 40px">
                                                    <a href="<?php echo base_url() . 'customer/add' ?>"><span class="fa fa-plus"></span> New Customer</a>
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
                                                        <img data-fileupload-image="0,0" id="b1_img" src="<?php echo base_url() . "assets/frontend/images/nopic.png";?>">
                                                        <div class="set__box__date"></div>
                                                    </div>
                                                    <div class="set__box">
                                                        <div class="set__box__title --off">After</div>
                                                        <a class="set__box__delete" data-fileupload-delete="0,1" data-id="0" href=""><span class="fa fa-remove"></span></a>
                                                        <div class="set__box__icon " data-fileupload="upload" data-position="0,1"><span class="fa fa-camera"></span></div>
                                                        <img data-fileupload-image="0,1" id="a1_img" src="<?php echo base_url() . "assets/frontend/images/nopic.png";?>">
                                                        <div class="set__box__date"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <span class="btn btn-default btn-block fileinput-button vertical-top pl-0 pr-0">Upload Before<input data-fileupload="file" data-position="0,0" data-orientation="h" onchange="readURL(this, 'b1_img');" name="userfile" type="file"></span>
                                                <span class="btn btn-default btn-block fileinput-button vertical-top">Upload After <input data-fileupload="file" data-position="0,1" data-orientation="h" onchange="readURL(this, 'a1_img');" name="fileimage" type="file"></span>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="notes">
                                                    <label>Comments</label>
                                                    <input type="text" name="note[0]" value="" class="form-control" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="set clearfix set--h">
                                                    <div class="set__box__separator"></div>
                                                    <div class="set__box">
                                                        <div class="set__box__title --off">Before</div>
                                                        <a class="set__box__delete" data-fileupload-delete="1,0" data-id="0" href=""><span class="fa fa-remove"></span></a>
                                                        <div class="set__box__icon " data-fileupload="upload" data-position="1,0"><span class="fa fa-camera"></span></div>
                                                        <img data-fileupload-image="1,0" id="b2_img" src="<?php echo base_url() . "assets/frontend/images/nopic.png";?>">
                                                        <div class="set__box__date"></div>
                                                    </div>
                                                    <div class="set__box">
                                                        <div class="set__box__title --off">After</div>
                                                        <a class="set__box__delete" data-fileupload-delete="1,1" data-id="0" href=""><span class="fa fa-remove"></span></a>
                                                        <div class="set__box__icon " data-fileupload="upload" data-position="1,1"><span class="fa fa-camera"></span></div>
                                                        <img data-fileupload-image="1,1" id="a2_img" src="<?php echo base_url() . "assets/frontend/images/nopic.png";?>">
                                                        <div class="set__box__date"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <span class="btn btn-default btn-block fileinput-button vertical-top pl-0 pr-0">Upload Before<input data-fileupload="file" data-position="1,0" data-orientation="h" onchange="readURL(this, 'b2_img');" name="fileimage" type="file"></span>
                                                <span class="btn btn-default btn-block fileinput-button vertical-top">Upload After <input data-fileupload="file" data-position="1,1" data-orientation="h" onchange="readURL(this, 'a2_img');" name="fileimage" type="file"></span>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="notes">
                                                    <label>Comments</label>
                                                    <input type="text" name="note[1]" value="" class="form-control" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="set clearfix set--h">
                                                    <div class="set__box__separator"></div>
                                                    <div class="set__box">
                                                        <div class="set__box__title --off">Before</div>
                                                        <a class="set__box__delete" data-fileupload-delete="2,0" data-id="0" href=""><span class="fa fa-remove"></span></a>
                                                        <div class="set__box__icon " data-fileupload="upload" data-position="2,0"><span class="fa fa-camera"></span></div>
                                                        <img data-fileupload-image="2,0" id="b3_img" src="<?php echo base_url() . "assets/frontend/images/nopic.png";?>">
                                                        <div class="set__box__date"></div>
                                                    </div>
                                                    <div class="set__box">
                                                        <div class="set__box__title --off">After</div>
                                                        <a class="set__box__delete" data-fileupload-delete="2,1" data-id="0" href=""><span class="fa fa-remove"></span></a>
                                                        <div class="set__box__icon " data-fileupload="upload" data-position="2,1"><span class="fa fa-camera"></span></div>
                                                        <img data-fileupload-image="2,1" id="a3_img" src="<?php echo base_url() . "assets/frontend/images/nopic.png";?>">
                                                        <div class="set__box__date"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <span class="btn btn-default btn-block fileinput-button vertical-top pl-0 pr-0">Upload Before<input data-fileupload="file" data-position="2,0" data-orientation="h" onchange="readURL(this, 'b3_img');" name="fileimage" type="file"></span>
                                                <span class="btn btn-default btn-block fileinput-button vertical-top">Upload After <input data-fileupload="file" data-position="2,1" data-orientation="h" onchange="readURL(this, 'a3_img');" name="fileimage" type="file"></span>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="notes">
                                                    <label>Comments</label>
                                                    <input type="text" name="note[2]" value="" class="form-control" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="set clearfix set--h">
                                                    <div class="set__box__separator"></div>
                                                    <div class="set__box">
                                                        <div class="set__box__title --off">Before</div>
                                                        <a class="set__box__delete" data-fileupload-delete="3,0" data-id="0" href=""><span class="fa fa-remove"></span></a>
                                                        <div class="set__box__icon " data-fileupload="upload" data-position="3,0"><span class="fa fa-camera"></span></div>
                                                        <img class="beforeImgPhoto" id="b4_img" src="<?php echo base_url() . "assets/frontend/images/nopic.png";?>">
                                                        <div class="set__box__date"></div>
                                                    </div>
                                                    <div class="set__box">
                                                        <div class="set__box__title --off">After</div>
                                                        <a class="set__box__delete" data-fileupload-delete="3,1" data-id="0" href=""><span class="fa fa-remove"></span></a>
                                                        <div class="set__box__icon " data-fileupload="upload" data-position="3,1"><span class="fa fa-camera"></span></div>
                                                        <img data-fileupload-image="3,1" id="a4_img" src="<?php echo base_url() . "assets/frontend/images/nopic.png";?>">
                                                        <div class="set__box__date"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <span class="btn btn-default btn-block fileinput-button vertical-top pl-0 pr-0">Upload Before<input data-fileupload="file" data-position="3,0" data-orientation="h" name="fileimage" onchange="readURL(this, 'b4_img');" id="fileimage" type="file"></span>
                                                <span class="btn btn-default btn-block fileinput-button vertical-top">Upload After <input data-fileupload="file" data-position="3,1" data-orientation="h" onchange="readURL(this, 'a4_img');" name="fileimage" type="file"></span>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="notes">
                                                    <label>Comments</label>
                                                    <input type="text" name="note[3]" value="" class="form-control" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="set clearfix set--h">
                                                    <div class="set__box__separator"></div>
                                                    <div class="set__box">
                                                        <div class="set__box__title --off">Before</div>
                                                        <a class="set__box__delete" data-fileupload-delete="4,0" data-id="0" href=""><span class="fa fa-remove"></span></a>
                                                        <div class="set__box__icon" data-fileupload="upload" data-position="4,0"><span class="fa fa-camera"></span></div>
                                                        <img data-fileupload-image="4,0" id="b5_img" src="<?php echo base_url() . "assets/frontend/images/nopic.png";?>">
                                                        <div class="set__box__date"></div>
                                                    </div>
                                                    <div class="set__box">
                                                        <div class="set__box__title --off">After</div>
                                                        <a class="set__box__delete" data-fileupload-delete="4,1" data-id="0" href=""><span class="fa fa-remove"></span></a>
                                                        <div class="set__box__icon " data-fileupload="upload" data-position="4,1"><span class="fa fa-camera"></span></div>
                                                        <img data-fileupload-image="4,1" id="a5_img" src="<?php echo base_url() . "assets/frontend/images/nopic.png";?>">
                                                        <div class="set__box__date"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <span class="btn btn-default btn-block fileinput-button vertical-top pl-0 pr-0">Upload Before<input data-fileupload="file" data-position="4,0" data-orientation="h"  onchange="readURL(this, 'b5_img');" name="fileimage" type="file"></span>
                                                <span class="btn btn-default btn-block fileinput-button vertical-top">Upload After <input data-fileupload="file" data-position="4,1" data-orientation="h" onchange="readURL(this, 'a5_img');" name="fileimage" type="file"></span>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="notes">
                                                    <label>Comments</label>
                                                    <input type="text" name="note[4]" value="" class="form-control" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <hr class="card-hr">
                                    <button class="btn btn-primary margin-right" data-ba="submit" data-on-click-label="Saving...">Save</button>
                                    <a class="a-ter" href="<?php echo base_url() . "vault/beforeafter"; ?>">cancel this</a>
                                </form>

                                <div class="modal customer-modal" data-customer="add_modal" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <h4 class="modal-title">New Customer</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="validation-error hide"></div>
                                                <p class="validation-loader" style="display: none;">loading ...</p>
                                                <div class="modal-body-content">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
                                                <button class="btn btn-primary" type="button" data-customer="submit" data-on-click-label="Saving...">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                    <!-- end card -->
                </div>
            </div>>
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>