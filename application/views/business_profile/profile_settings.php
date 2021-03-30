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
<div role="wrapper">
   <?php include viewPath('includes/sidebars/business'); ?>
   <div wrapper__section>
      <div class="col-md-24 col-lg-24 col-xl-18">
        <?php echo form_open_multipart('users/savebusinessdetail', [ 'id'=> 'form-business-details', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
        <div class="row">
            <div class="col-md-12">
                <form id="form-business-credentials" method="post" action="#">
                <div class="validation-error" style="display: none;"></div>
                <div class="card">
<div class="row">
    <div class="col-md-24 col-lg-24 col-xl-18">
<form id="form-business-profile" method="post" action="#">
    <div class="validation-error" style="display: none;"></div>

    <div class="card mtc-18 pl-4">
       <h3 class="page-title mb-0 mt-18">Profile Settings</h3>
       <hr/>
        <p class="margin-bottom">
           Your settings let you control how the business profile is shown to customers. Take a quick look and make sure all of your settings are correct.
        </p>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-12">
                    <label>Your Business Profile URL</label> <span class="form-required">*</span>
                    <div class="help help-block help-sm">Customize your profile URL so it can be easy to remember.</div>
                    <div class="profile-url">
                        <span class="profile-url-prefix">nsmartrac.com/business/</span>
                        <div class="profile-url-input">
                            <input type="text" name="profile_slug"  value="<?= isset($profile_data) ? $profile_data->profile_slug : '';  ?>" class="form-control" autocomplete="off" data-profile-url="input">
                        </div>
                    </div>
                    <span class="validation-error-field" data-formerrors-for-name="profile_slug" data-formerrors-message="true" style="display: none;"></span>
                </div>
                <div class="col-sm-12">
                    <label>Preview</label>
                    <div class="help help-block help-sm">Click to preview your profile or copy the URL</div>
                    <div class="form-control-text">
                        <a data-profile-url="preview" href="https://www.nsmatrac.com/users/businessprofile" target="_blank">nsmatrac.com/business/<span data-profile-url="slug"><?= isset($profile_data) ? $profile_data->profile_slug : '';  ?></span></a>
                        <div class="text-ter hide" data-profile-url="change">...click Save below to update</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Business Tags</label>
            <div class="help help-sm help-block">Enter tags/keywords and get better visibility. This helps customers find you on search. Example: cleaner, plumber</div>
            <div class="tagsinput">
              <input type="text" value="Security" data-role="tagsinput" />
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
                    <div class="img-responsive" id="company-cover-photo" style="background-image: url('https://www.markate.com/assets/images/app/public/pros/wallpaper_0.jpg');"></div>
</div>
<div>
    <input type='file' id='coverphoto_image' style="display: none;" />
    <span class="fileinput-button vertical-top">
        <a class="profile-cover-upload-link" href="javascript:void(0);">
            <span class="fa fa-camera"></span>
            Upload Cover Picture
        </a>
	</span>
</div>
<div class="modal coveruploadmodal-modal" id="coveruploadmodal-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Upload Cover Picture</h4>
            </div>
            <div class="modal-body">

                <div class="clearfix">
                    <span class="btn btn-primary-flat fileinput-button vertical-top">Upload Image <input id="coveruploadmodal-file" name="filewallpaper" type="file"></span>
                    <button class="btn btn-danger pull-right" id="coveruploadmodal-btn-delete" type="button" style="display: none;">Delete Image</button>
                </div>

                <div class="alert alert-danger" id="coveruploadmodal-error" role="alert" style="display: none;"></div>

                <div class="" id="coveruploadmodal-progressbar" style="display: none;">
                    <div class="text">Uploading</div>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                    </div>
                </div>

                <div class="coveruploadmodal-crop-container" id="coveruploadmodal-crop-container" style="display: none;">
                    <hr>
                    <div class="help help-sm">To crop this image, move or resize the cropping area then click "Save Image"</div>
                    <div class="coveruploadmodal-crop-wrapper">
                        <img class="coveruploadmodal-crop-image" id="coveruploadmodal-image-preview" data-name="" src="">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-success pull-left" id="coveruploadmodal-crop-btn" type="button" data-label-on-submit="Saving ..." style="display: none;">Save Image</button>
                <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div><div class="hide" data-fileupload="progressbar-wallpaper">
    <div class="text">Uploading</div>
    <div class="progress">
        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
    </div>
</div>
<div class="alert alert-danger hide" data-fileupload="error-wallpaper" role="alert"></div>                </div>
            </div>
        </div>

    </div>

    <hr class="card-hr">
<div class="card">
    <div class="row">
    	<div class="col-md-8">
    		<button class="btn btn-default btn-lg" name="btn-save" type="button">Save</button> <span class="alert-inline-text margin-left hide">Saved</span>
    	</div>    	
    </div>
</div></form>

    </div>
</div>
    </div>
            </div>
         </div>
      </div>
   </div>
</div>
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
