<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
.input-group-addon:first-child {
    border-right: 0;
}
.input-group-addon:last-child {
    border-left: 0;
}
.input-group-addon {
    padding: 14px 12px;
    font-size: 14px;
    font-weight: 400;
    line-height: 1;
    color: #555;
    text-align: center;
    background-color: #eee;
    border: 1px solid #ccc;
    border-radius: 4px;
}
.input-group-addon, .input-group-btn {
    /* width: 1%; */
    white-space: nowrap;
    vertical-align: middle;
}
.page-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.p-40 {
  padding-top: 40px !important;
}
@media only screen and (max-width: 600px) {
  .p-40 {
    padding-top: 0px !important;
  }
  .pr-b10 {
    position: relative;
    bottom: 0px;
  }
}
.list-icon{
  list-style: none;
  height: 400px;
  overflow: auto;
  padding: 6px;
}
.list-icon li{
  display: inline-block;
  /*width: 30%;*/
  height:100px;
  margin: 3px;
}
.mtc-18 {
  margin-top: 32px;
}
.mt-18 {
  margin-top: 10px;
}
</style>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div role="wrapper">
   <?php include viewPath('includes/sidebars/business'); ?>
   <div wrapper__section>
      <div class="col-md-12">
        <?php echo form_open_multipart('users/update_social_media', [ 'id'=> 'form-business-details', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
    <div class="validation-error" style="display: none;"></div>

    <div class="card mtc-18 pl-4">
       <h3 class="page-title mb-0 mt-18">Social Media</h3>
       <hr/>
        <p>Add your social media links that will appear on your Public Profile page.</p>
        <p class="margin-bottom text-ter">Note: All URLs have to start with http:// or https://</p>
        <div class="row">
            <div class="col-sm-3 col-lg-4">
                <div class="form-group">
                    <label>Facebook</label>
                    <div class="input-group">
                        <div class="input-group-addon socal_media" style="background: #345191;"><span class="fa fa-facebook"></span></div>
                        <input type="url" name="sm_facebook" value="<?= isset($profiledata) ? $profiledata->sm_facebook : '';  ?>" class="form-control" autocomplete="off">
                    </div>
                    <span class="validation-error-field" data-formerrors-for-name="sm_facebook" data-formerrors-message="true" style="display: none;"></span>
                </div>
                <div class="form-group">
                    <label>Twitter</label>
                    <div class="input-group">
                        <div class="input-group-addon socal_media" style="background: #2797d7;"><span class="fa fa-twitter"></span></div>
                        <input type="url" name="sm_twitter" value="<?= isset($profiledata) ? $profiledata->sm_twitter : '';  ?>" class="form-control" autocomplete="off">
                    </div>
                    <span class="validation-error-field" data-formerrors-for-name="sm_twitter" data-formerrors-message="true" style="display: none;"></span>
                </div>
                <div class="form-group">
                    <label>Google Review Page</label>
                    <div class="input-group">
                        <div class="input-group-addon socal_media" style="background: #f13126;"><span class="fa fa-google"></span></div>
                        <input type="url" name="sm_google" value="<?= isset($profiledata) ? $profiledata->sm_google : '';  ?>" class="form-control" autocomplete="off">
                    </div>
                    <span class="validation-error-field" data-formerrors-for-name="sm_google" data-formerrors-message="true" style="display: none;"></span>
                </div>
                <div class="form-group">
                    <label>Youtube</label>
                    <div class="input-group">
                        <div class="input-group-addon socal_media" style="background: #ff0000;"><span class="fa fa-youtube"></span></div>
                        <input type="url" name="sm_youtube" value="<?= isset($profiledata) ? $profiledata->sm_youtube : '';  ?>" class="form-control" autocomplete="off">
                    </div>
                    <span class="validation-error-field" data-formerrors-for-name="sm_youtube" data-formerrors-message="true" style="display: none;"></span>
                </div>
                <div class="form-group">
                    <label>Instagram</label>
                    <div class="input-group">
                        <div class="input-group-addon socal_media" style="background: #bf249e;"><span class="fa fa-instagram"></span></div>
                        <input type="url" name="sm_instagram" value="<?= isset($profiledata) ? $profiledata->sm_instagram : '';  ?>" class="form-control" autocomplete="off">
                    </div>
                    <span class="validation-error-field" data-formerrors-for-name="sm_instagram" data-formerrors-message="true" style="display: none;"></span>
                </div>
                <div class="form-group">
                    <label>Pinterest</label>
                    <div class="input-group">
                        <div class="input-group-addon socal_media" style="background: #c71f26;"><span class="fa fa-pinterest"></span></div>
                        <input type="url" name="sm_pinterest" value="<?= isset($profiledata) ? $profiledata->sm_pinterest : '';  ?>" class="form-control" autocomplete="off">
                    </div>
                    <span class="validation-error-field" data-formerrors-for-name="sm_pinterest" data-formerrors-message="true" style="display: none;"></span>
                </div>
                <div>
                    <label>LinkedIn</label>
                    <div class="input-group">
                        <div class="input-group-addon socal_media" style="background: #0070ad;"><span class="fa fa-linkedin"></span></div>
                        <input type="url" name="sm_linkedin" value="<?= isset($profiledata) ? $profiledata->sm_linkedin : '';  ?>" class="form-control" autocomplete="off">
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
            <button class="btn btn-primary btn-lg" type="submit">Save</button>
          </div>        	
        </div>
    </div>
</form>
</div>
<?php include viewPath('includes/footer'); ?>
