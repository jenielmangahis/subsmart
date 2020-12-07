<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/no_menu_header'); ?>
<style type="text/css">
.wrapper-onboarding {
  padding: 40px;
  max-width: 1340px;
  margin: 0 auto;
  width: 100%;
}
.profile-avatar-help-container span {
  color: #6b3a96;
}
.submit-onboard {
  width: 97.5%;
  float: right;
}
.validation-error-field {
  padding-top: 0px !important;
}
.margin-top-img {
  margin-top: 24px;
}
.text-right {
  text-align: right;
}
.card h3 {
  padding-bottom: 6px;
  border-bottom: 1px solid #e6e3e3;
  margin-bottom: 20px;
}
#form-business-details .card {
  padding: 20px 30px !important;
}
@media only screen and (max-width: 600px) {
  body #topnav {
    min-height: 0px;
  }
  .col-md-9, .col-md-3, .col-md-4, .col-md-6 {
      padding-left: 0px !important;
      padding-right: 0px !important;
  }
  .profile-avatar-container {
    margin-bottom: 15px;
  }
  .checkbox-sec label span {
    font-size: 13px !important;
  }
  #form-business-details .card {
    padding: 20px;
  }
  .wrapper-onboarding {
    padding: 20px 10px 60px 10px;
  }
  .card {
    width: 100% !important;
  }
  .col-md-6 {
    padding-top: 10px !important;
  }
  .checkbox.checkbox-sec label span {
      width: 100% !important;
      font-size: 11px !important;
  }
}
</style>
<div>
   <div class="wrapper-onboarding">
      <div class="col-md-24 col-lg-24 col-xl-18">
         <h3 style="background-color: #4A2268;color:#ffffff;padding:11px;">My Business Information</h3>
         <?php echo form_open_multipart('onboarding/save_business_info', [ 'id'=> 'form-business-details', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
           <!-- <input type="hidden" name="id" value="<?php echo $profiledata->id; ?>">
            <input type="hidden" name="user_id" value="<?php echo $profiledata->user_id; ?>"> -->
            <div class="card">
               <h3>Let's introduce your business to your customers.</h3>
               <h4>Basic Info</h4>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Business Name</label> <span class="form-required">*</span>
                        <input type="text" name="business_name" class="form-control" autocomplete="off" value="<?php echo ($profiledata) ? $profiledata->business_name : '' ?>" placeholder="e.g. Acme Inc" required="">
                        <span class="validation-error-field" data-formerrors-for-name="name" data-formerrors-message="true" style="display: none;"></span>
                        <br/>
                        <label>Business Street Address</label> <span class="form-required">*</span>
                        <div class="help help-sm help-block">Type in to search for your address</div>
                        <input type="text" name="address"  id="address" class="form-control" autocomplete="off" value="<?php echo ($profiledata) ? $profiledata->address : '' ?>" placeholder="e.g. 123 Old Oak Drive" required="">
                        <span class="validation-error-field" data-formerrors-for-name="address" data-formerrors-message="true" style="display: none;"></span>
                        <br/>
                        <label>Suite/Unit</label> <span class="help">(optional)</span>
                        <div class="help help-sm help-block">Suite #</div>
                        <input type="text" name="unit_nbr" class="form-control" autocomplete="off" value="<?php echo ($profiledata) ? $profiledata->unit_nbr : '' ?>" placeholder="e.g. Ap #12" required="">
                        <span class="validation-error-field" data-formerrors-for-name="unit_nbr" data-formerrors-message="true" style="display: none;"></span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="profile-avatar-container">
                        <div>
                           <label>Profile Picture</label>
                           <div>
                              <a class="profile-avatar-img" data-fileuploadmodal="open-modal" href="#">
                                <?php if ($profiledata) { ?>
                                  <img height="100" data-fileuploadmodal="image-parent" id="img_profile" src="<?php echo (businessProfileImage($profiledata->id)) ? businessProfileImage($profiledata->id) : $url->assets ?>">
                                <?php } else { ?>
                                  <img height="100" data-fileuploadmodal="image-parent" id="img_profile" src="<?php echo base_url();?>assets/img/onboarding/profile-avatar.png">
                                <?php } ?>
                              </a>
                           </div>
                           <div class="margin-top-img mb-2">
                            <input type="file" class="form-control" name="image" id="formClient-Image" placeholder="Upload Image" accept="image/*" onchange="readURL(this);">
                          </div>
                        </div>
                        <div class="profile-avatar-help-container">
                           <span class="validation-error-field text-left" data-formerrors-for-name="avatar" data-formerrors-message="true" ></span>
                           <span class="help help-sm profile-avatar-help">
                           Help your customers recognize your business by uploading a profile picture.<br>
                           Accepted files type: gif, jpg, png
                           </span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <div class="row">
                     <div class="col-md-4">
                        <label>City</label> <span class="form-required">*</span>
                        <input type="text" name="city"  class="form-control" id="city" value="<?php echo ($profiledata) ? $profiledata->city : '' ?>" autocomplete="off" placeholder="e.g. Phoenix" required="">
                        <span class="validation-error-field" data-formerrors-for-name="city" data-formerrors-message="true" style="display: none;"></span>
                     </div>
                     <div class="col-md-4">
                        <label>Zip/Postal Code</label> <span class="form-required">*</span>
                        <input type="text" name="zip"  class="form-control" id="zip" value="<?php echo ($profiledata) ? $profiledata->zip : '' ?>" autocomplete="off" placeholder="e.g. 86336" required="">
                        <span class="validation-error-field" data-formerrors-for-name="zip" data-formerrors-message="true" style="display: none;"></span>
                     </div>
                     <div class="col-md-4">
                        <label>State/Province</label> <span class="form-required">*</span>
                        <input type="text" name="state" value="<?php echo ($profiledata) ? $profiledata->state : '' ?>" class="form-control" id="state"/>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card">
               <h4>Contact Details</h4>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Business Phone</label> <span class="form-required">*</span>
                        <div class="help help-sm help-block">We'll send you text/sms notifications to this nr.</div>
                        <div>
                           <input type="text" name="business_phone" value="<?php echo ($profiledata) ? $profiledata->business_phone : '' ?>"  class="form-control" autocomplete="off" required="">
                           <span class="validation-error-field" data-formerrors-for-name="phone" data-formerrors-message="true" style="display: none;"></span>
                        </div>
                        <div>
                           <div class="checkbox checkbox-sec">
                              <?php 
                                $is_public_phone = '';
                                if( $profiledata ){
                                  if($profiledata->is_public_phone==1){
                                    $is_public_phone = 'checked="checked"';
                                  }
                                }
                              ?>
                              <input type="checkbox" name="is_public_phone" value="1" <?= $is_public_phone; ?> id="is_public_phone">
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
                              <input type="text" name="office_phone" value="<?php echo ($profiledata) ? $profiledata->office_phone : '' ?>"  class="form-control" autocomplete="off" placeholder="e.g 123 456 7890">
                           </div>
                           <div class="col-md-3">
                              <label>Ext</label> <span class="help">(optional)</span>
                              <div class="help help-block help-sm">Extension</div>
                              <input type="text" name="office_phone_extn" value="<?php echo ($profiledata) ? $profiledata->office_phone_extn : '' ?>" class="form-control" autocomplete="off" placeholder="e.g. 123">
                           </div>
                        </div>
                        <span class="validation-error-field" data-formerrors-for-name="office_phone" data-formerrors-message="true" style="display: none;"></span>
                        <span class="validation-error-field" data-formerrors-for-name="office_phone_extn" data-formerrors-message="true" style="display: none;"></span>
                        <div>
                           <div class="checkbox checkbox-sec">
                              <?php 
                                $is_public_office_phone = '';
                                if( $profiledata ){
                                  if($profiledata->is_public_office_phone==1){
                                    $is_public_office_phone = 'checked="checked"';
                                  }
                                }
                              ?>
                              <input type="checkbox" name="is_public_office_phone" value="1" <?= $is_public_office_phone; ?> id="is_public_office_phone">
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
                        <input type="text" name="business_email" value="<?php echo ($profiledata) ? $profiledata->business_email : '' ?>"  class="form-control" autocomplete="off" placeholder="Business Email" required="">
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
                            <?php 
                              $with_emergency_support = '';
                              $without_emergency_support = '';
                              if( $profiledata ){
                                if($profiledata->is_emergency_support==1){
                                  $with_emergency_support = 'checked="checked"';
                                }else{
                                  $without_emergency_support = 'checked="checked"';
                                }
                              }
                            ?>
                           <div class="checkbox checkbox-sec margin-right">
                              <input type="radio" name="is_emergency_support" value="1" <?= $with_emergency_support; ?> id="is_emergency_support_1">
                              <label for="is_emergency_support_1"><span>Yes</span></label>
                           </div>
                           <div class="checkbox checkbox-sec">
                              <input type="radio" name="is_emergency_support" value="0" <?= $without_emergency_support; ?> id="is_emergency_support_2">
                              <label for="is_emergency_support_2"><span>No</span></label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div data-toggle-for="is_emergency_support">
                           <label>24/7 Emergency Phone Number</label> <span class="form-required">*</span>
                           <input type="text" name="phone_emergency" value="<?php echo ($profiledata) ? $profiledata->phone_emergency : '' ?>"  class="form-control" autocomplete="off" placeholder="e.g 123 456 7890" required="">
                           <span class="validation-error-field" data-formerrors-for-name="phone_emergency" data-formerrors-message="true" style="display: none;"></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
               <div class="col-xs-16 text-right submit-onboard">
                  <button class="btn btn-primary btn-lg margin-left" name="action" value="business_info" type="submit">Next »</button>
               </div>
            </div>
            </div>            
    <?php echo form_close(); ?>
      </div>
   </div>
</div>
<?php include viewPath('includes/footer'); ?>
