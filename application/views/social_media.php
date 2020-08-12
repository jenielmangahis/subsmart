<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div role="wrapper">
   <?php include viewPath('includes/sidebars/business'); ?>
   <div wrapper__section>
      <div class="col-md-12">
        <?php echo form_open_multipart('users/savebusinessdetail', [ 'id'=> 'form-business-details', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
        <form class="form-business-sm" id="form-business-sm" method="post" action="#">
    <div class="validation-error" style="display: none;"></div>

    <div class="card">
        <h2>Social Media</h2>
        <p>Add your social media links that will appear on your Public Profile page.</p>
        <p class="margin-bottom text-ter">Note: All URLs have to start with http:// or https://</p>
        <div class="row">
            <div class="col-sm-3 col-lg-4">
                <div class="form-group">
                    <label>Facebook</label>
                    <div class="input-group">
                        <div class="input-group-addon socal_media" style="background: #345191;"><span class="fa fa-facebook"></span></div>
                        <input type="text" name="sm_facebook" value="" class="form-control" autocomplete="off">
                    </div>
                    <span class="validation-error-field" data-formerrors-for-name="sm_facebook" data-formerrors-message="true" style="display: none;"></span>
                </div>
                <div class="form-group">
                    <label>Twitter</label>
                    <div class="input-group">
                        <div class="input-group-addon socal_media" style="background: #2797d7;"><span class="fa fa-twitter"></span></div>
                        <input type="text" name="sm_twitter" value="" class="form-control" autocomplete="off">
                    </div>
                    <span class="validation-error-field" data-formerrors-for-name="sm_twitter" data-formerrors-message="true" style="display: none;"></span>
                </div>
                <div class="form-group">
                    <label>Google Review Page</label>
                    <div class="input-group">
                        <div class="input-group-addon socal_media" style="background: #f13126;"><span class="fa fa-google"></span></div>
                        <input type="text" name="sm_google" value="" class="form-control" autocomplete="off">
                    </div>
                    <span class="validation-error-field" data-formerrors-for-name="sm_google" data-formerrors-message="true" style="display: none;"></span>
                </div>
                <div class="form-group">
                    <label>Youtube</label>
                    <div class="input-group">
                        <div class="input-group-addon socal_media" style="background: #ff0000;"><span class="fa fa-youtube"></span></div>
                        <input type="text" name="sm_youtube" value="" class="form-control" autocomplete="off">
                    </div>
                    <span class="validation-error-field" data-formerrors-for-name="sm_youtube" data-formerrors-message="true" style="display: none;"></span>
                </div>
                <div class="form-group">
                    <label>Instagram</label>
                    <div class="input-group">
                        <div class="input-group-addon socal_media" style="background: #bf249e;"><span class="fa fa-instagram"></span></div>
                        <input type="text" name="sm_instagram" value="" class="form-control" autocomplete="off">
                    </div>
                    <span class="validation-error-field" data-formerrors-for-name="sm_instagram" data-formerrors-message="true" style="display: none;"></span>
                </div>
                <div class="form-group">
                    <label>Pinterest</label>
                    <div class="input-group">
                        <div class="input-group-addon socal_media" style="background: #c71f26;"><span class="fa fa-pinterest"></span></div>
                        <input type="text" name="sm_pinterest" value="" class="form-control" autocomplete="off">
                    </div>
                    <span class="validation-error-field" data-formerrors-for-name="sm_pinterest" data-formerrors-message="true" style="display: none;"></span>
                </div>
                <div>
                    <label>LinkedIn</label>
                    <div class="input-group">
                        <div class="input-group-addon socal_media" style="background: #0070ad;"><span class="fa fa-linkedin"></span></div>
                        <input type="text" name="sm_linkedin" value="" class="form-control" autocomplete="off">
                    </div>
                    <span class="validation-error-field" data-formerrors-for-name="sm_linkedin" data-formerrors-message="true" style="display: none;"></span>
                </div>
            </div>
        </div>
    </div>

    <hr class="card-hr">
<div class="card">
    <div class="row">
    	<div class="col-md-8">
                <button class="btn btn-default btn-lg" name="btn-save" type="button">Save</button> <span class="alert-inline-text margin-left hide" style="display:none;">Saved</span>
            </div>
    	<div class="col-xs-16 text-right">
            <a class="btn btn-default btn-lg" href="business/profile">« Back</a>
    	</div>
    </div>
</div>
</form>
</div>
<?php include viewPath('includes/footer'); ?>

