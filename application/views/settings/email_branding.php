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
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">       
                        
                    <div class="card">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>Email From Name</label>
                                        <div class="help help-sm help-block">Emails sent to customers will display this name.</div>
                                        <input type="text" name="email_from_name" value="ADI" class="form-control" autocomplete="off">
                                        <span class="validation-error-field hide" data-formerrors-for-name="email_from_name" data-formerrors-message="true"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>Email Footer Text</label>
                                        <div class="help help-sm help-block">Add a custom message to email footer. E.g. Call us on  (212) 123-4567</div>
                                        <input type="text" name="email_template_footer_text" value="Alarm Direct, Inc." class="form-control" autocomplete="off">
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
                                        <img class="img-responsive" data-fileupload="image-logo" src="<?php echo $url->assets ?>img/img_default.png">
                                    </div>
                                </div>
                                <div class="col-md-19 col-md-offset-1">
                                    <div>
                                        <span class="btn btn-default fileinput-button vertical-top"><span class="fa fa-camera"></span> Upload Logo <input data-fileupload="file-logo" name="filelogo" type="file"></span> <a class="a-default margin-left" href="#" data-fileupload="delete-logo"><span class="fa fa-trash"></span> Delete Logo</a>
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
                        <button style="width: 45%; float: left;" class="btn btn-primary" name="btn-submit" data-form="submit" type="button" data-on-click-label="Save Changes...">Save Changes</button>
                       
                    </div>                                                                     

                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>