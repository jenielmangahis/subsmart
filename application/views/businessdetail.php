<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div role="wrapper">
   <?php include viewPath('includes/sidebars/business'); ?>
   <div wrapper__section>
      <div class="col-md-24 col-lg-24 col-xl-18">
         <?php echo form_open_multipart('users/savebusinessdetail', [ 'id'=> 'form-business-details', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
			<input type="hidden" name="id" value="<?php //echo $profiledata->id; ?>">
			<input type="hidden" name="user_id" value="<?php //echo $profiledata->user_id; ?>">
            <div class="card">
               <h3>Basic Info</h3>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Business Name</label> <span class="form-required">*</span>
                        <input type="text" name="b_name" class="form-control" autocomplete="off" value="<?php echo ($profiledata) ? $profiledata->b_name : '' ?>" placeholder="e.g. Acme Inc" required="">
                        <span class="validation-error-field" data-formerrors-for-name="name" data-formerrors-message="true" style="display: none;"></span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="profile-avatar-container">
                        <div>
                           <label>Profile Picture</label>
                           <div>
                              <!-- <a class="profile-avatar-img" data-fileuploadmodal="open-modal" href="#"><img height="100" data-fileuploadmodal="image-parent" src="<?php //echo (companyProfileImage($profiledata->id)) ? companyProfileImage($profiledata->id) : $url->assets ?>"></a> -->
                              <img id="img_profile">
                           </div>                           
						   <div class="margin-top margin-bottom ">
							<input type="file" class="form-control" name="image" id="formClient-Image" placeholder="Upload Image" accept="image/*" onchange="readURL(this);">
						  </div>
                        </div>
                        <div class="profile-avatar-help-container">
                           <span class="validation-error-field text-left" data-formerrors-for-name="avatar" data-formerrors-message="true" ></span>
                           <span class="help help-sm profile-avatar-help">
                           Help your customers recognize your business by uploading a profile picture.<br><br>
                           Accepted files type: gif, jpg, png
                           </span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Business Street Address</label> <span class="form-required">*</span>
                        <div class="help help-sm help-block">Type in to search for your address</div>
                        <input type="text" name="address"  id="address" class="form-control" autocomplete="off" value="<?php //echo $profiledata->address ?>" placeholder="e.g. 123 Old Oak Drive" required="">
                        <span class="validation-error-field" data-formerrors-for-name="address" data-formerrors-message="true" style="display: none;"></span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <label>Suite/Unit</label> <span class="help">(optional)</span>
                     <div class="help help-sm help-block">Suite #</div>
                     <input type="text" name="unit_nbr" class="form-control" autocomplete="off" value="<?php //echo $profiledata->unit_nbr ?>" placeholder="e.g. Ap #12" required="">
                     <span class="validation-error-field" data-formerrors-for-name="unit_nbr" data-formerrors-message="true" style="display: none;"></span>
                  </div>
               </div>
               <div class="form-group">
                  <div class="row">
                     <div class="col-md-4">
                        <label>City</label> <span class="form-required">*</span>
                        <input type="text" name="city"  class="form-control" id="city" value="<?php //echo $profiledata->city ?>" autocomplete="off" placeholder="e.g. Phoenix" required="">
                        <span class="validation-error-field" data-formerrors-for-name="city" data-formerrors-message="true" style="display: none;"></span>
                     </div>
                     <div class="col-md-4">
                        <label>Zip/Postal Code</label> <span class="form-required">*</span>
                        <input type="text" name="zip"  class="form-control" id="zip" value="<?php //echo $profiledata->zip ?>" autocomplete="off" placeholder="e.g. 86336" required="">
                        <span class="validation-error-field" data-formerrors-for-name="zip" data-formerrors-message="true" style="display: none;"></span>
                     </div>
                     <div class="col-md-4">
                        <label>State/Province</label> <span class="form-required">*</span>
                        <input type="text" name="state" value="<?php //echo $profiledata->zip ?>" class="form-control" id="state"/>
                     </div>
                  </div>
               </div>
            </div>
            <hr class="card-hr">
            <div class="card">
               <h3>Contact Details</h3>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Business Phone</label> <span class="form-required">*</span>
                        <div class="help help-sm help-block">We'll send you text/sms notifications to this nr.</div>
                        <div>
                           <input type="text" name="b_phone" value="<?php //echo $profiledata->b_phone ?>"  class="form-control" autocomplete="off" required="">
                           <span class="validation-error-field" data-formerrors-for-name="phone" data-formerrors-message="true" style="display: none;"></span>
                        </div>
                        <div>
                           <div class="checkbox checkbox-sec">
                              <input type="checkbox" name="is_public_phone" value="1" <?php //if($profiledata->is_public_phone==1){ ?> checked="checked" <?php //} ?> id="is_public_phone">
                              <label for="is_public_phone"><span>Show <i>business phone</i> on my public profile</span></label>
                           </div>
                           &nbsp; <a class="help-tooltip" data-toggle="tooltip" title="" data-original-title="Select this if you want to display this phone number on your public profile page."><span class="fa fa-question-circle"></span></a>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-9">
                              <label>Office Phone</label> <span class="help">(optional)</span>
                              <div class="help help-block help-sm">If you want to show the office phone on profile</div>
                              <input type="text" name="office_phone" value="<?php //echo $profiledata->office_phone ?>"  class="form-control" autocomplete="off" placeholder="e.g 123 456 7890">
                           </div>
                           <div class="col-md-3">
                              <label>Ext</label> <span class="help">(optional)</span>
                              <div class="help help-block help-sm">Extension</div>
                              <input type="text" name="office_phone_extn" value="1" <?php //echo $profiledata->office_phone_extn ?>  class="form-control" autocomplete="off" placeholder="e.g. 123">
                           </div>
                        </div>
                        <span class="validation-error-field" data-formerrors-for-name="office_phone" data-formerrors-message="true" style="display: none;"></span>
                        <span class="validation-error-field" data-formerrors-for-name="office_phone_extn" data-formerrors-message="true" style="display: none;"></span>
                        <div>
                           <div class="checkbox checkbox-sec">
                              <input type="checkbox" name="is_public_office_phone" value="1" <?php //if($profiledata->is_public_office_phone==1){ ?> checked="checked" <?php //} ?> id="is_public_office_phone">
                              <label for="is_public_office_phone"><span>Show <i>office phone</i> on my public profile
                              </span></label>
                           </div>
                           &nbsp; <a class="help-tooltip" data-toggle="tooltip" title="" data-original-title="Select this if you want to display this phone number on your public profile page."><span class="fa fa-question-circle"></span></a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Business Email</label> <span class="form-required">*</span>
                        <input type="text" name="b_email" value="<?php //echo $profiledata->b_email ?>"  class="form-control" autocomplete="off" placeholder="Business Email" required="">
                        <span class="validation-error-field" data-formerrors-for-name="email" data-formerrors-message="true" style="display: none;"></span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Business Website</label> <span class="help">(optional)</span>
                        <input type="text" name="website" value="<?php echo ($profiledata) ? $profiledata->website : '' ?>"  class="form-control" autocomplete="off" placeholder="Enter your business website, if any">
                        <span class="validation-error-field" data-formerrors-for-name="website" data-formerrors-message="true" style="display: none;"></span>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <div class="row">
                     <div class="col-md-6">
                        <label>Do you provide Emergency Service?</label> <span class="form-required">*</span>
                        <div>
                           <div class="checkbox checkbox-sec margin-right">
                              <input type="radio" name="is_emergency_support" value="1" <?php //if($profiledata->is_emergency_support==1){ ?> checked="checked" <?php //} ?> id="is_emergency_support_1">
                              <label for="is_emergency_support_1"><span>Yes</span></label>
                           </div>
                           <div class="checkbox checkbox-sec">
                              <input type="radio" name="is_emergency_support" value="0" <?php //if($profiledata->is_emergency_support==0){ ?> checked="checked" <?php //} ?> id="is_emergency_support_2">
                              <label for="is_emergency_support_2"><span>No</span></label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div data-toggle-for="is_emergency_support">
                           <label>24/7 Emergency Phone Number</label> <span class="form-required">*</span>
                           <input type="text" name="phone_emergency" value="<?php //echo $profiledata->phone_emergency ?>"  class="form-control" autocomplete="off" placeholder="e.g 123 456 7890" required="">
                           <span class="validation-error-field" data-formerrors-for-name="phone_emergency" data-formerrors-message="true" style="display: none;"></span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <hr class="card-hr">
            <div class="card">
               <h3>About</h3>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Year of Establishment</label> <span class="form-required">*</span>
                        <div class="help help-block help-sm">Enter the year of company establishment.</div>
                        <input type="text" class="form-control" value="<?php ($profiledata) ? $profiledata->year_est : '' ;?>" id="yrMybus">
                        <span class="validation-error-field" data-formerrors-for-name="year_est" data-formerrors-message="true" style="display: none;"></span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Number of Employees</label> <span class="form-required">*</span>
                        <div class="help help-block help-sm">Enter the number of people working for you.</div>
                        <input type="text" name="employee_count" value="<?php echo ($profiledata) ? $profiledata->employee_count : '' ?>"  class="form-control" autocomplete="off" placeholder="e.g. 5" required="">
                        <span class="validation-error-field" data-formerrors-for-name="employee_count" data-formerrors-message="true" style="display: none;"></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Do you work with other Business or Sub Contract?</label>
                        <div>
                           <div class="checkbox checkbox-sec margin-right">
                              <input type="radio" name="is_subcontract_allowed" value="1" <?php //if($profiledata->is_subcontract_allowed==1){ ?> checked="checked" <?php //} ?> id="is_subcontract_allowed_1">
                              <label for="is_subcontract_allowed_1"><span>Yes</span></label>
                           </div>
                           <div class="checkbox checkbox-sec">
                              <input type="radio" name="is_subcontract_allowed" value="0"  <?php //if($profiledata->is_subcontract_allowed==0){ ?> checked="checked" <?php //} ?> id="is_subcontract_allowed_2">
                              <label for="is_subcontract_allowed_2"><span>No</span></label>
                           </div>
                        </div>
                        <span class="validation-error-field" data-formerrors-for-name="is_subcontract_allowed" data-formerrors-message="true" style="display: none;"></span>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Business Number (EIN #)</label>
                        <div class="help help-block help-sm">If entered it will appear on invoices.</div>
                        <input type="text" name="business_number" value="<?php //echo $profiledata->business_number; ?>"  class="form-control" autocomplete="off">
                        <span class="validation-error-field" data-formerrors-for-name="employee_count" data-formerrors-message="true" style="display: none;"></span>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <label>Service Location</label>
                  <div class="help help-sm help-block">Enter the areas or neighborhoods where you provide your services.</div>
                  <div class="bootstrap-tagsinput"><input type="text" placeholder="Area or neighborhood"></div>
                  <input type="text" name="service_loc" value="<?php //echo $profiledata->service_loc ?>"  class="form-control" id="service_locations" autocomplete="off" placeholder="Area or neighborhood" style="display: none;">
                  <span class="validation-error-field" data-formerrors-for-name="service_locations" data-formerrors-message="true" style="display: none;"></span>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <div class="clearfix">
                           <label>Business Short Description</label><span class="help help-sm help-bold pull-right">characters left: <span data-char="counter" data-char-max="2000">1962</span></span>
                        </div>
                        <div class="help help-block help-sm">Give customers more details on what your business actually does. Describe your company's values and goals. Minimum 25 characters.</div>
                        <textarea name="business_desc" cols="40" rows="8" class="form-control" autocomplete="off"><?php echo ($profiledata) ? $profiledata->business_desc: ''; ?> </textarea>
                        <span class="validation-error-field" data-formerrors-for-name="about" data-formerrors-message="true" style="display: none;"></span>
                     </div>
                  </div>
               </div>
            </div>
            <hr class="card-hr">
            <div class="card">
               <div class="row">
                  <div class="col-xs-16 text-right">
                     <button class="btn btn-primary btn-lg margin-left" name="btn-continue" type="submit">Submit</button>
                  </div>
               </div>
            </div>
    <?php echo form_close(); ?>
         <div class="modal fileuploadmodal-modal" id="fileuploadmodal-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                     </button>
                     <h4 class="modal-title">Upload Profile Picture</h4>
                  </div>
                  <div class="modal-body">
                     <div class="clearfix">
                        <span class="btn btn-primary-flat fileinput-button vertical-top">Upload Image <input id="fileuploadmodal-file" name="fileavatar" type="file"></span>
                        <button class="btn btn-danger pull-right" id="fileuploadmodal-btn-delete" type="button" style="display: none;">Delete Image</button>
                     </div>
                     <div class="alert alert-danger" id="fileuploadmodal-error" role="alert" style="display: none;"></div>
                     <div class="" id="fileuploadmodal-progressbar" style="display: none;">
                        <div class="text">Uploading</div>
                        <div class="progress">
                           <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                        </div>
                     </div>
                     <div class="fileuploadmodal-crop-container" id="fileuploadmodal-crop-container" style="display: none;">
                        <hr>
                        <div class="help help-sm">To crop this image, move or resize the cropping area then click "Save Image"</div>
                        <div class="fileuploadmodal-crop-wrapper">
                           <img class="fileuploadmodal-crop-image" id="fileuploadmodal-image-preview" data-name="" src="">
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button class="btn btn-success pull-left" id="fileuploadmodal-crop-btn" type="button" data-label-on-submit="Saving ..." style="display: none;">Save Image</button>
                     <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal validation-modal" id="validation-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                     </button>
                     <h4 class="modal-title">Verify Phone</h4>
                  </div>
                  <div class="modal-body text-center">
                     <div class="validation-error text-center" id="validation-modal-error" style="display: none;"></div>
                     <p class="" id="validation-modal-loader" style="display: none;">loading ...</p>
                     <p class="hide" id="validation-modal-abp-failed">
                        We have to validate your phone number.<br>
                        Please enter the activation code posted below to continue.<br>
                        <span class="bold">%phone_key%</span>
                     </p>
                     <p class="hide" id="validation-modal-abp-sms">
                        We have to validate your phone number.<br>
                        We sent a Text/SMS with a Validation Code to phone number <b>#%phone_number%</b><br>
                        Please enter the Validation Code on the field below.
                     </p>
                     <p class="hide" id="validation-modal-abp-tts">
                        We noticed you entered a landline phone.<br>
                        In order to verify your account we left you a voice message <br>to number <b>#%phone_number%</b> with the activation code.<br>
                        Please enter the Validation Code on the field below.
                     </p>
                     <form class="" id="validation-modal-form" name="activation-form" style="display: none;">
                        <div class="validation-error text-center hide" id="validation-modal-form-error"></div>
                        <div class="form-group">
                           <div class="row margin-bottom">
                              <div class="col-md-8 col-md-offset-8">
                                 <label class="bold" for="phone_key">Enter Validation Code</label>
                                 <input class="form-control text-center" name="phone_key" type="text">
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <button class="btn btn-primary btn-lg" id="validation-modal-btn-submit" data-on-click-label="Validating...">Validate Now</button>
                        </div>
                     </form>
                  </div>
                  <div class="modal-footer">
                     <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
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

