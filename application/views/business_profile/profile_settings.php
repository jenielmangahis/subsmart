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
#company-cover-photo{
  background-size: cover;
  background-position: center;
  height: 50vh;
  width: 100%;
}
.bootstrap-tagsinput .tag {    
    background-color: #aaa;
    padding: 5px;
}
.bootstrap-tagsinput {
  padding: 11px 6px !important;
}
</style>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<?php echo form_open_multipart('users/update_profile_setting', [ 'id'=> '', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
<div role="wrapper">
   <?php include viewPath('includes/sidebars/business'); ?>
   <div wrapper__section>
      <div class="col-md-24 col-lg-24 col-xl-18">        
        <div class="row">
            <div class="col-md-12">
                <div class="card">
<div class="row">
    <div class="col-md-12 col-lg-12 col-xl-12">
    <div class="validation-error" style="display: none;"></div>
    <div class="row">
      <div class="col-sm-6 left">
        <h3 class="page-title">Profile Settings</h3>
      </div>
    </div>
    <div class="alert alert-warning mt-2 mb-4" role="alert">
        <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">
          Your settings let you control how the business profile is shown to customers. Take a quick look and make sure all of your settings are correct.
        </span>
    </div>
    <div class="card mtc-18 pl-4">
        <div class="form-group">
            <div class="row">
                <div class="col-sm-12">
                    <label>Your Business Profile URL</label> <span class="form-required">*</span>
                    <div class="help help-block help-sm">Customize your profile URL so it can be easy to remember.</div>
                    <div class="profile-url">
                        <?php 
                          $slug = '';
                          if( isset($profiledata) && $profiledata->profile_slug != ''){
                            $slug = createSlug($profiledata->profile_slug,'-');
                          }
                        ?>
                        <span class="profile-url-prefix">nsmartrac.com/business/<?= $slug; ?></span>
                        <div class="profile-url-input">
                            <input type="text" name="profile_slug"  value="<?= isset($profiledata) ? $profiledata->profile_slug : '';  ?>" class="form-control" autocomplete="off" data-profile-url="input">
                        </div>
                    </div>
                    <span class="validation-error-field" data-formerrors-for-name="profile_slug" data-formerrors-message="true" style="display: none;"></span>
                </div>
                <!-- <div class="col-sm-12">
                    <label>Preview</label>
                    <div class="help help-block help-sm">Click to preview your profile or copy the URL</div>
                    <div class="form-control-text">
                        <a data-profile-url="preview" href="https://www.nsmatrac.com/users/businessprofile" target="_blank">nsmatrac.com/business/<span data-profile-url="slug"><?= isset($profile_data) ? $profile_data->profile_slug : '';  ?></span></a>
                        <div class="text-ter hide" data-profile-url="change">...click Save below to update</div>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="form-group">
            <label>Business Tags</label>
            <div class="help help-sm help-block">Enter tags/keywords and get better visibility. This helps customers find you on search. Example: cleaner, plumber</div>
            <div class="tagsinput">
              <input type="text" data-role="tagsinput" value="<?= isset($profiledata) ? $profiledata->business_tags : ''; ?>" name="company_tags" />
            </div>            
        </div>
        <div class="form-group">
            <label>Cover Picture</label>
            <div class="help help-sm help-block margin-bottom-ter">
                Add a cover photo to showcase your Business Profile page's personality.&nbsp;Your cover picture is the large photo featured at the top of your public profile.
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="margin-bottom">                    
                    <div class="img-responsive" id="company-cover-photo" style="background-image: url('<?= getCompanyCoverPhoto(); ?>');"></div>
</div>
<div>
    <input type='file' id='coverphoto_image' name="cover_photo" style="display: none;" />
    <span class="fileinput-button vertical-top">
        <a class="profile-cover-upload-link" href="javascript:void(0);">
            <span class="fa fa-camera"></span>
            Upload Cover Picture
        </a>
	</span>
</div>


    <hr class="card-hr">
<div class="card">
    <div class="row">
    	<div class="col-md-8">
    		<button class="btn btn-default btn-lg" name="btn-save" type="submit">Save</button>
    	</div>    	
    </div>
</div>

    </div>
</div>
    </div>
            </div>
         </div>
      </div>
   </div>
</div>
</form>
<?php include viewPath('includes/footer'); ?>
<script>
$(function(){
  //$('#coverphoto_image').hide();
  $('.profile-cover-upload-link').on('click', function () {
        $('#coverphoto_image').click();
  });
  $('#coverphoto_image').change(function () {
      var file = this.files[0];
      var reader = new FileReader();
      reader.onloadend = function () {
         $('#company-cover-photo').css('background-image', 'url("' + reader.result + '")');
      }
      if (file) {
          reader.readAsDataURL(file);
      } else {
      }
  });
});
</script>
