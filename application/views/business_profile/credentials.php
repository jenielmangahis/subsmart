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
        <h2>Credentials</h2>
        <h5>Showcase Your Business Credentials</h5>

        <p>
            Pick from the sections below if your business is Licensed/Bonded/Insured/BBB.<br> Adding your professional Credentials will help you attract more customers.
        </p>
        <hr>

        <div class="checkbox checkbox-sec checkbox-selector">
            <input type="checkbox" name="is_licensed" value="1" checked="checked" id="checkbox1">
            <label for="checkbox1"><span class="checkbox-header">Licensed</span></label>
        </div>
        <div class="section-body" data-off-for="checkbox1" style="display: none;">
            <span class="text-ter">Not licensed. Select to activate.</span>
        </div>
        <div class="section-body" data-on-for="checkbox1" style="display: block;">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label>License Number</label>
                        <input type="text" name="license_number" value="EF, AL, MS" class="form-control">
                        <span class="validation-error-field" data-formerrors-for-name="license_number" data-formerrors-message="true" style="display: none;"></span>
                    </div>
                    <div class="col-md-4">
                        <label>License Class</label>
                        <input type="text" name="license_class" value="Electrical" class="form-control">
                        <span class="validation-error-field" data-formerrors-for-name="license_class" data-formerrors-message="true" style="display: none;"></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label>License State</label>
                        <select name="license_state" class="form-control">
                        <option value="">- Select State -</option>
                        <option value="AK">Alaska</option>
                        <option value="AL">Alabama</option>
                        <option value="AR">Arkansas</option>
                        <option value="AZ">Arizona</option>
                        <option value="CA">California</option>
                        <option value="CO">Colorado</option>
                        <option value="CT">Connecticut</option>
                        <option value="DC">District of Columbia</option>
                        <option value="DE">Delaware</option>
                        <option value="FL" selected="selected">Florida</option>
                        <option value="GA">Georgia</option>
                        <option value="HI">Hawaii</option>
                        <option value="IA">Iowa</option>
                        <option value="ID">Idaho</option>
                        <option value="IL">Illinois</option>
                        <option value="IN">Indiana</option>
                        <option value="KS">Kansas</option>
                        <option value="KY">Kentucky</option>
                        <option value="LA">Louisiana</option>
                        <option value="MA">Massachusetts</option>
                        <option value="MD">Maryland</option>
                        <option value="ME">Maine</option>
                        <option value="MI">Michigan</option>
                        <option value="MN">Minnesota</option>
                        <option value="MO">Missouri</option>
                        <option value="MS">Mississippi</option>
                        <option value="MT">Montana</option>
                        <option value="NC">North Carolina</option>
                        <option value="ND">North Dakota</option>
                        <option value="NE">Nebraska</option>
                        <option value="NH">New Hampshire</option>
                        <option value="NJ">New Jersey</option>
                        <option value="NM">New Mexico</option>
                        <option value="NV">Nevada</option>
                        <option value="NY">New York</option>
                        <option value="OH">Ohio</option>
                        <option value="OK">Oklahoma</option>
                        <option value="OR">Oregon</option>
                        <option value="PA">Pennsylvania</option>
                        <option value="RI">Rhode Island</option>
                        <option value="SC">South Carolina</option>
                        <option value="SD">South Dakota</option>
                        <option value="TN">Tennessee</option>
                        <option value="TX">Texas</option>
                        <option value="UT">Utah</option>
                        <option value="VA">Virginia</option>
                        <option value="VT">Vermont</option>
                        <option value="WA">Washington</option>
                        <option value="WI">Wisconsin</option>
                        <option value="WV">West Virginia</option>
                        <option value="WY">Wyoming</option>
                        </select>
                        <span class="validation-error-field" data-formerrors-for-name="license_state" data-formerrors-message="true" style="display: none;"></span>
                    </div>
                    <div class="col-md-4">
                        <label>License Expiration Date</label>
                        <div class="input-group">
                            <input type="text" name="license_exp_date" value="2020-12-31" class="form-control hasDatepicker" id="license_exp_date">
                            <div class="input-group-addon calendar-button" data-for="license_exp_date">
                                <span class="fa fa-calendar"></span>
                            </div>
                        </div>
                        <span class="validation-error-field" data-formerrors-for-name="license_exp_date" data-formerrors-message="true" style="display: none;"></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Upload License</label>
                <div class="help help-sm">Optional. Upload a scanned copy of your license. Only image file types (JPG, PNG, GIF) are allowed.</div>
                <div class="row margin-top-sec">
    <div class="col-sm-4 col-lg-3">
        <label class="credential-file" for="fileimage1"><img data-fileupload="image1" src="https://www.markate.com/assets/images/app/business/credential/no_file.png"></label>
    </div>
    <div class="col-sm-4 col-lg-4">
        <span class="btn btn-default fileinput-button vertical-top"><span class="fa fa-camera"></span> Upload File <input data-fileupload="file1" name="fileimage1" id="fileimage1" type="file"></span>
        <a class="a-default margin-left" data-fileupload="delete1" href="#"><span class="fa fa-trash"></span> Delete File</a>

        <div class="" data-fileupload="progressbar1" style="display: none;">
            <div class="text">Uploading</div>
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
            </div>
        </div>
        <div class="alert alert-danger" data-fileupload="error1" role="alert" style="display: none;"></div>
    </div>
</div>
            </div>
        </div>


        <hr>

        <div class="checkbox checkbox-sec checkbox-selector">
        <input type="checkbox" name="is_bonded" value="1" checked="checked" id="checkbox2">
        <label for="checkbox1"><span class="checkbox-header">Bonded</span></label>
        </div>
        <div class="section-body" data-off-for="checkbox2" style="display: none;">
            <span class="text-ter">Not bonded. Select to activate.</span>
        </div>
        <div class="section-body" data-on-for="checkbox2" style="display: block;">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label>Bond Amount</label>
                        <div class="input-group">
                            <div class="input-group-addon">$</div>
                                <input type="text" name="bonded_amount" value="2000000" class="form-control">
                            </div>
                        <span class="validation-error-field" data-formerrors-for-name="bonded_amount" data-formerrors-message="true" style="display: none;"></span>
                    </div>
                    <div class="col-md-4">
                        <label>Bond Expiration Date</label>
                        <div class="input-group">
                            <input type="text" name="bonded_exp_date" value="2020-10-31" class="form-control hasDatepicker" id="bonded_exp_date">
                            <div class="input-group-addon calendar-button" data-for="bonded_exp_date">
                                <span class="fa fa-calendar"></span>
                            </div>
                        </div>
                        <span class="validation-error-field" data-formerrors-for-name="bonded_exp_date" data-formerrors-message="true" style="display: none;"></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-24">
                        <label>Upload Bond</label>
                        <div class="help help-sm">Optional. Upload a scanned copy of your bond. Only image file types (JPG, PNG, GIF) are allowed.</div>
                    <div class="row margin-top-sec">
    <div class="col-sm-8 col-lg-6">
        <label class="credential-file" for="fileimage2"><img data-fileupload="image2" src="https://www.markate.com/assets/images/app/business/credential/no_file.png"></label>
    </div>
    <div class="col-sm-16 col-lg-18">
        <span class="btn btn-default fileinput-button vertical-top"><span class="fa fa-camera"></span> Upload File <input data-fileupload="file2" name="fileimage2" id="fileimage2" type="file"></span>
        <a class="a-default margin-left" data-fileupload="delete2" href="#"><span class="fa fa-trash"></span> Delete File</a>

        <div class="" data-fileupload="progressbar2" style="display: none;">
            <div class="text">Uploading</div>
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
            </div>
        </div>
        <div class="alert alert-danger" data-fileupload="error2" role="alert" style="display: none;"></div>
    </div>
</div>
                </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="checkbox checkbox-sec checkbox-selector">
        <input type="checkbox" name="is_insured" value="1" checked="checked" id="checkbox3">
        <label for="checkbox2"><span class="checkbox-header">Insured</span></label>
        </div>
        <div class="section-body" data-off-for="checkbox3" style="display: none;">
            <span class="text-ter">Not insured. Select to activate.</span>
        </div>
        <div class="section-body" data-on-for="checkbox3" style="display: block;">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label>Insured Amount</label>
                        <div class="input-group">
                            <div class="input-group-addon">$</div>
                                <input type="text" name="insured_amount" value="4000000" class="form-control">
                            </div>
                        <span class="validation-error-field" data-formerrors-for-name="insured_amount" data-formerrors-message="true" style="display: none;"></span>
                    </div>
                    <div class="col-md-4">
                        <label>Insurance Expiration Date</label>
                        <div class="input-group">
                            <input type="text" name="insured_exp_date" value="2020-10-31" class="form-control hasDatepicker" id="insured_exp_date">
                            <div class="input-group-addon calendar-button" data-for="insured_exp_date">
                                <span class="fa fa-calendar"></span>
                            </div>
                        </div>
                        <span class="validation-error-field" data-formerrors-for-name="insured_exp_date" data-formerrors-message="true" style="display: none;"></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-24">
                        <label>Upload Insurance</label>
                        <div class="help help-sm">Optional. Upload a scanned copy of your insurance. Only image file types (JPG, PNG, GIF) are allowed.</div>
                    <div class="row margin-top-sec">
    <div class="col-sm-8 col-lg-6">
        <label class="credential-file" for="fileimage3"><img data-fileupload="image3" src="https://www.markate.com/assets/images/app/business/credential/no_file.png"></label>
    </div>
    <div class="col-sm-16 col-lg-18">
        <span class="btn btn-default fileinput-button vertical-top"><span class="fa fa-camera"></span> Upload File <input data-fileupload="file3" name="fileimage3" id="fileimage3" type="file"></span>
        <a class="a-default margin-left" data-fileupload="delete3" href="#"><span class="fa fa-trash"></span> Delete File</a>

        <div class="" data-fileupload="progressbar3" style="display: none;">
            <div class="text">Uploading</div>
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
            </div>
        </div>
        <div class="alert alert-danger" data-fileupload="error3" role="alert" style="display: none;"></div>
    </div>
</div>
                </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="checkbox checkbox-sec checkbox-selector">
        <input type="checkbox" name="is_bbb" value="1" id="checkbox4">
        <label for="checkbox3"><span class="checkbox-header">BBB Accredited</span></label>
        </div>
        <div class="section-body" data-off-for="checkbox4" style="display: block;">
            <span class="text-ter">Not BBB accredited. Select to activate.</span>
        </div>
        <div class="section-body" data-on-for="checkbox4" style="display: none;">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-16">
                        <label>Please provide your business BBB Link</label>
                    <input type="text" name="bbb_url" value="" class="form-control">
                    <span class="validation-error-field" data-formerrors-for-name="bbb_url" data-formerrors-message="true" style="display: none;"></span>
                    </div>
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
    	<div class="col-md-4 text-right">
    		    		<a class="btn btn-default btn-lg" href="services">« Back</a>
    		    		    		<a href="availability" class="btn btn-primary btn-lg margin-left" name="btn-continue">Next »</a>
    		    	</div>
    </div>
</div>
</form>    </div>
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

