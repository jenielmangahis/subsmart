<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_setting'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/setting'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Email Branding</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active"></li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <?php echo form_open_multipart('settings/update_email_branding_setting', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
            <div class="row">
                <div class="col-xl-12">
                    <?php include viewPath('flash'); ?>
                    <div class="card" style="min-height: 400px !important;">       
                        
                    <div class="card">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>Email From Name</label>
                                        <div class="help help-sm help-block">Emails sent to customers will display this name.</div>
                                        <input type="text" name="email_from_name" value="<?= $setting_data['email_from_name']; ?>" placeholder="ADI" class="form-control" autocomplete="off">
                                        <span class="validation-error-field hide" data-formerrors-for-name="email_from_name" data-formerrors-message="true"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>Email Footer Text</label>
                                        <div class="help help-sm help-block">Add a custom message to email footer. E.g. Call us on  (212) 123-4567</div>
                                        <input type="text" name="email_template_footer_text" value="<?= $setting_data['email_template_footer_text']; ?>" placeholder="Alarm Direct, Inc." class="form-control" autocomplete="off">
                                        <span class="validation-error-field hide" data-formerrors-for-name="email_template_footer_text" data-formerrors-message="true"></span>
                                    </div>
                                </div>
                            </div>
                    </div>     

                    <div class="card">
                        <div class="form-group">
                            <label>Logo</label>
                            <div class="help help-sm help-block margin-bottom">Customize your invoice, estimate or email to better match your branding. Your logo will appear on the top left corner.</div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="margin-bottom-sec">
                                        <?php 
                                          $logo_file     = $setting_data['logo'];
                                          if(file_exists('uploads/email_branding/' . $setting_data['uid'] . '/' . $logo_file) == FALSE || $logo_file == null) {
                                              $branding_logo = base_url('/assets/img/img_default.png');
                                          } else {
                                              $branding_logo = base_url('uploads/email_branding/' . $setting_data['uid'] . '/' .$logo_file);
                                          }
                                        ?>
                                        <img class="img-responsive" data-fileupload="image-logo" id="preview-img-container" src="<?php echo $branding_logo ?>">
                                    </div>
                                </div>
                                <div class="col-md-19 col-md-offset-1">
                                    <div>
                                        <span class="btn btn-default fileinput-button vertical-top"><span class="fa fa-camera"></span> Upload Logo <input data-fileupload="file-logo" name="file-logo" id="file-logo" type="file" onchange="loadPreviewImg(event)"></span> 
                                        
                                    </div>
                                    <div class="" data-fileupload="progressbar-logo" style="display: none;">
                                        <div class="text">Uploading</div>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                        </div>
                                    </div>
                                    <div class="alert alert-danger" data-fileupload="error-logo" role="alert" style="display: none;"></div>
                                </div>
                            </div>
                        </div>

                    </div>      

                    <div class="">
                        <button style="width: 45%; float: left;" class="btn btn-primary" name="btn-submit" type="submit">Save Changes</button>
                       
                    </div>                                                                     

                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
            <?php echo form_close(); ?>
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
<script>
var loadPreviewImg=function(event){
    $('#preview-img-container').attr('src', URL.createObjectURL(event.target.files[0]));
};
    
</script>