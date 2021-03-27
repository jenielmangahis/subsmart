<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
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
  margin-top: 36px;
}
.mt-18 {
  margin-top: 10px;
}
</style>
<!-- page wrapper start -->
<div role="wrapper">
   <?php include viewPath('includes/sidebars/business'); ?>
   <div wrapper__section>
      <div class="col-md-24 col-lg-24 col-xl-18">
        <?php echo form_open_multipart('users/savebusinessdetail', [ 'id'=> 'form-business-details', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
        <input type="hidden" value="<?= $profiledata->id; ?>" name="id" />
        <div class="row">
    <div class="col-md-12">
    <div class="validation-error" style="display: none;"></div>

    <div class="card mtc-18">
       <h3 class="page-title mb-0 mt-18">Credentials</h3>
        <h5>Showcase Your Business Credentials</h5>

        <p>
            Pick from the sections below if your business is Licensed/Bonded/Insured/BBB.<br> Adding your professional Credentials will help you attract more customers.
        </p>
        <hr>
        <?php
            $licensed_checked = "";
            if( $profiledata->is_licensed == 1 ){
                $licensed_checked = "checked='checked'";
            }
        ?>
        <div class="checkbox checkbox-sec checkbox-selector">
            <input type="checkbox" name="is_licensed" <?= $licensed_checked; ?> id="chk-licensed">
            <label for="chk-licensed"><span class="checkbox-header">Licensed</span></label>
        </div>
        <div class="section-body licensed-group1" <?= $profiledata->is_licensed == 1 ? 'style="display:none;"' : ''; ?>>
            <span class="text-ter">Not licensed. Select to activate.</span>
        </div>
        <div class="section-body licensed-group2" <?= $profiledata->is_licensed == 1 ? '' : 'style="display:none;"'; ?>>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label>License Number</label>
                        <input type="text" name="license_number" value="<?= $profiledata->license_number; ?>" class="form-control">
                        <span class="validation-error-field" style="display: none;"></span>
                    </div>
                    <div class="col-md-4">
                        <label>License Class</label>
                        <input type="text" name="license_class" value="<?= $profiledata->license_class; ?>" class="form-control">
                        <span class="validation-error-field" style="display: none;"></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label>License State</label>
                        <select name="license_state" class="form-control">
                        <option value="">- Select State -</option>
                        <?php foreach( $states as $key => $value ){ ?>
                            <option <?= $profiledata->license_state == $key ? 'selected="selected"' : ''; ?> value="<?= $key; ?>"><?= $value; ?></option>
                        <?php } ?>
                        </select>
                        <span class="validation-error-field" style="display: none;"></span>
                    </div>
                    <div class="col-md-4">
                        <label>License Expiration Date</label>
                        <div class="input-group">
                            <input type="text" name="license_exp_date" value="<?= $profiledata->license_expiry_date != '0000-00-00' ? date("Y-m-d",strtotime($profiledata->license_expiry_date)) : ''; ?>" class="form-control default-datepicker" id="license_exp_date">
                            <div class="input-group-addon calendar-button" data-for="license_exp_date">
                                <span class="fa fa-calendar"></span>
                            </div>
                        </div>
                        <span class="validation-error-field" style="display: none;"></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Upload License</label>
                <div class="help help-sm">Optional. Upload a scanned copy of your license. Only image file types (JPG, PNG, GIF) are allowed.</div>
                <div class="row margin-top-sec">
                    <div class="col-md-2" style="max-width: 10.666667%;">
                        <img height="100" style="margin:0 auto;" id="license-image" src="<?php echo (licenseImage($profiledata->id)) ? licenseImage($profiledata->id) : $url->assets ?>">
                    </div>
                    <div class="col-md-6">
                        <input type="file" class="form-control" name="license_image" id="" placeholder="Upload Image" accept="image/*" onchange="readImageURL(this,'license-image');">
                    </div>
                </div>
            </div>
        </div>


        <hr>
        <?php
            $bonded_checked = "";
            if( $profiledata->is_bonded == 1 ){
                $bonded_checked = "checked='checked'";
            }
        ?>
        <div class="checkbox checkbox-sec checkbox-selector">
        <input type="checkbox" name="is_bonded" <?= $bonded_checked; ?> id="chk-bonded">
        <label for="chk-bonded"><span class="checkbox-header">Bonded</span></label>
        </div>
        <div class="section-body bonded-group1" <?= $profiledata->is_bonded == 1 ? 'style="display:none;"' : ''; ?>>
            <span class="text-ter">Not bonded. Select to activate.</span>
        </div>
        <div class="section-body bonded-group2" <?= $profiledata->is_bonded == 1 ? '' : 'style="display:none;"'; ?>>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label>Bond Amount</label>
                        <div class="input-group">
                            <div class="input-group-addon">$</div>
                                <input type="text" name="bonded_amount" value="<?= $profiledata->bond_amount; ?>" class="form-control">
                            </div>
                        <span class="validation-error-field" style="display: none;"></span>
                    </div>
                    <div class="col-md-4">
                        <label>Bond Expiration Date</label>
                        <div class="input-group">
                            <input type="text" name="bonded_exp_date" value="<?= $profiledata->bond_expiry_date != '0000-00-00' ? date("Y-m-d",strtotime($profiledata->bond_expiry_date)) : ''; ?>" class="form-control default-datepicker" id="bonded_exp_date">
                            <div class="input-group-addon calendar-button" data-for="bonded_exp_date">
                                <span class="fa fa-calendar"></span>
                            </div>
                        </div>
                        <span class="validation-error-field" style="display: none;"></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Upload Bond</label>
                <div class="help help-sm">Optional. Upload a scanned copy of your bond. Only image file types (JPG, PNG, GIF) are allowed.</div>
                <div class="row margin-top-sec">
                    <div class="col-md-2" style="max-width: 10.666667%;">
                        <img height="100" style="margin:0 auto;" id="bond-image" src="<?php echo (bondImage($profiledata->id)) ? bondImage($profiledata->id) : $url->assets ?>">
                    </div>
                    <div class="col-md-6">
                        <input type="file" class="form-control" name="bond_image" id="" placeholder="Upload Image" accept="image/*" onchange="readImageURL(this,'bond-image');">
                    </div>

                </div>
            </div>
        </div>

        <hr>
        <?php
            $insured_checked = "";
            if( $profiledata->is_business_insured == 1 ){
                $insured_checked = "checked='checked'";
            }
        ?>
        <div class="checkbox checkbox-sec checkbox-selector">
            <input type="checkbox" name="is_insured" <?= $insured_checked; ?> id="chk-insured">
            <label for="chk-insured"><span class="checkbox-header">Insured</span></label>
        </div>
        <div class="section-body insured-group1" <?= $profiledata->is_business_insured == 1 ? 'style="display:none;"' : ''; ?>>
            <span class="text-ter">Not insured. Select to activate.</span>
        </div>
        <div class="section-body insured-group2" <?= $profiledata->is_business_insured == 1 ? '' : 'style="display:none;"'; ?>>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label>Insured Amount</label>
                        <div class="input-group">
                            <div class="input-group-addon">$</div>
                                <input type="text" name="insured_amount" value="<?= $profiledata->insured_amount; ?>" class="form-control">
                            </div>
                        <span class="validation-error-field" style="display: none;"></span>
                    </div>
                    <div class="col-md-4">
                        <label>Insurance Expiration Date</label>
                        <div class="input-group">
                            <input type="text" name="insured_exp_date" value="<?= $profiledata->insurance_expiry_date != '0000-00-00' ? date("Y-m-d",strtotime($profiledata->insurance_expiry_date)) : ''; ?>" class="form-control default-datepicker" id="insured_exp_date">
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
        <label class="credential-file" for="fileimage3"><img data-fileupload="image3" src="<?= $url->assets . "img/no_file.png"; ?>"></label>
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
        <?php
            $bbb_acredited_checked = "";
            if( $profiledata->is_bbb_acredited == 1 ){
                $bbb_acredited_checked = "checked='checked'";
            }
        ?>
        <div class="checkbox checkbox-sec checkbox-selector">
            <input type="checkbox" name="is_bbb" <?= $bbb_acredited_checked; ?> id="chk-acredited">
            <label for="chk-acredited"><span class="checkbox-header">BBB Accredited</span></label>
        </div>
        <div class="section-body acredited-group1" <?= $profiledata->is_bbb_acredited == 1 ? 'style="display:none;"' : ''; ?>>
            <span class="text-ter">Not BBB accredited. Select to activate.</span>
        </div>
        <div class="section-body acredited-group2" <?= $profiledata->is_bbb_acredited == 1 ? '' : 'style="display:none;"'; ?>>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-16">
                        <label>Please provide your business BBB Link</label>
                    <input type="text" name="bbb_url" value="<?= $profiledata->bbb_link; ?>" class="form-control">
                    <span class="validation-error-field" style="display: none;"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr class="card-hr">
<div class="card">
    <div class="row">
    	<div class="col-md-8">
    		    		<button class="btn btn-default btn-lg" name="btn-continue" type="submit" value="credentials">Save</button> <span class="alert-inline-text margin-left hide" style="display:none;">Saved</span>
    		    	</div>
    	<!-- <div class="col-md-4 text-right">
    		    		<a class="btn btn-default btn-lg" href="services">« Back</a>
    		    		    		<a href="availability" class="btn btn-primary btn-lg margin-left" name="btn-continue">Next »</a>
    		    	</div> -->
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
<script>
$(function(){
    $('.default-datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });

    $("#chk-licensed").change(function(){
        if($(this).is(':checked')) {
            $(".licensed-group1").hide();
            $(".licensed-group2").show();
        }else{
            $(".licensed-group1").show();
            $(".licensed-group2").hide();
        }
    });

    $("#chk-bonded").change(function(){
        if($(this).is(':checked')) {
            $(".bonded-group1").hide();
            $(".bonded-group2").show();
        }else{
            $(".bonded-group1").show();
            $(".bonded-group2").hide();
        }
    });

    $("#chk-insured").change(function(){
        if($(this).is(':checked')) {
            $(".insured-group1").hide();
            $(".insured-group2").show();
        }else{
            $(".insured-group1").show();
            $(".insured-group2").hide();
        }
    });

    $("#chk-acredited").change(function(){
        if($(this).is(':checked')) {
            $(".acredited-group1").hide();
            $(".acredited-group2").show();
        }else{
            $(".acredited-group1").show();
            $(".acredited-group2").hide();
        }
    });
});
</script>
