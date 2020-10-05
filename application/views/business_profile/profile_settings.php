<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

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

<h1>Profile Settings</h1>

<div class="row">
    <div class="col-md-24 col-lg-24 col-xl-18">
<form id="form-business-profile" method="post" action="#">
    <div class="validation-error" style="display: none;"></div>

    <div class="card">
        <p class="margin-bottom">
           Your settings let you control how the business profile is shown to customers. Take a quick look and make sure all of your settings are correct.
        </p>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-12">
                    <label>Your Business Profile URL</label> <span class="form-required">*</span>
                    <div class="help help-block help-sm">Customize your profile URL so it can be easy to remember.</div>
                    <div class="profile-url">
                        <span class="profile-url-prefix">Markate.com/business/</span>
                        <div class="profile-url-input">
                            <input type="text" name="profile_slug" value="adi-0" class="form-control" autocomplete="off" data-profile-url="input">
                        </div>
                    </div>
                    <span class="validation-error-field" data-formerrors-for-name="profile_slug" data-formerrors-message="true" style="display: none;"></span>
                </div>
                <div class="col-sm-12">
                    <label>Preview</label>
                    <div class="help help-block help-sm">Click to preview your profile or copy the URL</div>
                    <div class="form-control-text">
                        <a data-profile-url="preview" href="https://www.markate.com/business/adi-0" target="_blank">Markate.com/business/<span data-profile-url="slug">adi-0</span></a>
                        <div class="text-ter hide" data-profile-url="change">...click Save below to update</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Business Tags</label>
            <div class="help help-sm help-block">Enter tags/keywords and get better visibility. This helps customers find you on search. Example: cleaner, plumber</div>
            <div class="bootstrap-tagsinput"><span class="tag label label-default">Honeywell Security<span data-role="remove"></span></span> <input type="text" placeholder="add tag"></div><input type="text" name="profile_tags" value="Honeywell Security" class="form-control" autocomplete="off" placeholder="add tag" required="" style="display: none;">
            <span class="validation-error-field" data-formerrors-for-name="profile_tags" data-formerrors-message="true" style="display: none;"></span>
        </div>
        <div class="form-group">
            <label>Cover Picture</label>
            <div class="help help-sm help-block margin-bottom-ter">
                Add a cover photo to showcase your Business Profile page's personality.&nbsp;Your cover picture is the large photo featured at the top of your public profile.
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="margin-bottom">
    <img class="img-responsive" data-coveruploadmodal="image-parent" src="https://www.markate.com/assets/images/app/public/pros/wallpaper_0.jpg">
</div>
<div>
    <span class="fileinput-button vertical-top">
        <a class="profile-cover-upload-link" data-coveruploadmodal="open-modal" href="#">
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
    	<div class="col-md-4 text-right">
    		    		<a class="btn btn-default btn-lg" href="workpictures">« Back</a>
    		    		    		<a href="socialMedia" class="btn btn-primary btn-lg margin-left" name="btn-continue">Next »</a>
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
<div class="mdc-top-app-bar-fixed-adjust demo-container demo-container-1 d-flex d-lg-none">
   <div class="mdc-bottom-navigation">
      <nav class="mdc-bottom-navigation__list">
         <span class="mdc-bottom-navigation__list-item mdc-ripple-surface mdc-ripple-surface--primary" data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
         <span class="material-icons mdc-bottom-navigation__list-item__icon">history</span>
         <span class="mdc-bottom-navigation__list-item__text">Recents</span>
         </span>
         <span class="mdc-bottom-navigation__list-item mdc-bottom-navigation__list-item--activated mdc-ripple-surface mdc-ripple-surface--primary" data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
         <span class="material-icons mdc-bottom-navigation__list-item__icon">favorite</span>
         <span class="mdc-bottom-navigation__list-item__text">Favourites</span>
         </span>
         <span class="mdc-bottom-navigation__list-item mdc-ripple-surface mdc-ripple-surface--primary" data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
            <span class="material-icons mdc-bottom-navigation__list-item__icon">
               <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                  <path d="M12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,12.5A1.5,1.5 0 0,1 10.5,11A1.5,1.5 0 0,1 12,9.5A1.5,1.5 0 0,1 13.5,11A1.5,1.5 0 0,1 12,12.5M12,7.2C9.9,7.2 8.2,8.9 8.2,11C8.2,14 12,17.5 12,17.5C12,17.5 15.8,14 15.8,11C15.8,8.9 14.1,7.2 12,7.2Z"></path>
               </svg>
            </span>
            <span class="mdc-bottom-navigation__list-item__text">Nearby</span>
         </span>
      </nav>
   </div>
</div>
<?php include viewPath('includes/footer'); ?>

