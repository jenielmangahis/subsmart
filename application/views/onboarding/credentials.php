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
</style>
<div>
   <div class="wrapper-onboarding">
      <div class="col-md-24 col-lg-24 col-xl-18">
         <h3 style="background-color: #4A2268;color:#ffffff;padding:11px;">My Business Credentials</h3>
         <?php echo form_open_multipart('onboarding/save_business_info', [ 'id'=> 'form-business-details', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
            <input type="hidden" value="<?= $profiledata->id; ?>" name="id" />
        <div class="row">
    <div class="col-md-12">
    <div class="validation-error" style="display: none;"></div>

    <div class="card">
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
                        <img height="80" style="margin:0 auto;" id="license-image" src="<?php echo (licenseImage($profiledata->id)) ? licenseImage($profiledata->id) : $url->assets ?>">
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
                        <img height="80" style="margin:0 auto;" id="bond-image" src="<?php echo (bondImage($profiledata->id)) ? bondImage($profiledata->id) : $url->assets ?>">
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
                <label>Upload Insurance</label>
                <div class="help help-sm">Optional. Upload a scanned copy of your insurance. Only image file types (JPG, PNG, GIF) are allowed.</div>
                <div class="row margin-top-sec">
                    <div class="col-md-2" style="max-width: 10.666667%;">
                        <img height="80" style="margin:0 auto;" id="insurance-image" src="<?php echo (insuranceImage($profiledata->id)) ? insuranceImage($profiledata->id) : $url->assets ?>">
                    </div>
                    <div class="col-md-6">
                        <input type="file" class="form-control" name="insurance_image" id="" placeholder="Upload Image" accept="image/*" onchange="readImageURL(this,'insurance-image');">
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
        <div class="row">
               <div class="col-xs-16 text-right submit-onboard">
                  <a class="btn btn-default btn-lg" href="<?php echo base_url("/onboarding/availability");?>">« Back</a>
                  <button class="btn btn-primary btn-lg margin-left" name="action" value="credentials" type="submit">Next »</button>
               </div>
            </div>
    </div>
            
    <?php echo form_close(); ?>
  </div>
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
