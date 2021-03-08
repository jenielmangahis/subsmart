<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/customer'); ?>
    <style>
    .checkboxcontainer input {
  display: none;
}

.checkboxcontainer {
  display: inline-block;
  padding-left: 30px;
  position: relative;
  cursor: pointer;
  user-select: none;
}

.checkboxcontainer .checkmark {
  display: inline-block;
  width: 20px;
  height: 20px;
  background: white;
  position: absolute;
  left: 0;
  top: 0;
  border: 1px solid black;
}

.checkboxcontainer input:checked + .checkmark {
  background-color: #1390e5;
  border: 1px solid #1390e5;
}

.checkboxcontainer input:indeterminate + .checkmark {
  background-color: #1390e5;
  border: 1px solid #1390e5;
}

.checkboxcontainer input:checked + .checkmark:after {
  content: "";
  position: absolute;
  height: 6px;
  width: 11px;
  border-left: 2px solid white;
  border-bottom: 2px solid white;
  top: 45%;
  left: 50%;
  transform: translate(-50%, -50%) rotate(-45deg);
}

.checkboxcontainer input:checked:disabled + .checkmark {
    border: 1px solid grey;
    background-color: grey;
}

.checkboxcontainer input:disabled + .checkmark {
    border: 1px solid grey;
}

.checkboxcontainer input:indeterminate + .checkmark:after {
  content: "";
  position: absolute;
  height: 0px;
  width: 11px;
  border-left: 2px solid white;
  border-bottom: 2px solid white;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%) rotate(180deg);
}
.clear {
  clear: both;
}
@media only screen and (max-width: 990px) {
  .page-title-box.pt-1.pb-0 div div h3 {
    position:relative;
    top:3px;
  }
  a.btn.btn-primary.btn-share-merchant-info {
      margin-bottom: 20px;
  }
}
@media only screen and (max-width: 580px) {
  .mobile-brm {
    margin-bottom: 10px !important;
  }
  .col-md-2, .col-md-5, .col-md-6, .col-md-7, .col-md-4, .col-md-3 {
    padding-left: 0px !important;
  }
  .card {
      box-shadow: none !important;
  }
  .page-title-box.pt-1.pb-0 div div h3 {
      text-align: center;
      position:relative;
      top:0px;
  }
  .gray-mobile {
    padding: 10px 20px !important;
    text-align: center;
  }
  .mobile-no-padding {
    padding-left: 0px !important;
  }
  a.btn.btn-primary.btn-share-merchant-info {
      float: none !important;
      margin: 0 auto;
      display: flow-root;
      width: 150px;
      height: 50px;
      margin-bottom: 20px;
      margin-top: 20px;
  }
}
</style>
<?php echo form_open_multipart('customer/send_merchant_details', ['id' => 'frm-merchant', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
          <div class="card">
              <div class="page-title-box pt-1 pb-0">
                  <div class="row align-items-center">
                      <div class="col-sm-12">
                          <h3 style="font-family: Sarabun, sans-serif;float: left;">MERCHANT ACCOUNT APPLICATION</h3>
                          <a class="btn btn-primary btn-share-merchant-info" href="javascript:void(0);" style="float: right;"><i class="fa fa-envelope" style="margin-right: 8px;"></i> SHARE</a>
                      </div>
                  </div>
              </div>
            <!-- end row -->
            <div class="row">
                <div class="col-md-12" style="background-color:#32243d;padding:1px;text-align:center;color:white;">
                    <h6>COMPANY INFORMATION</h6>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>LEGAL BUSINESS NAME</b></label>
                        <input type="text" class="form-control" name="legal_business_name" value="<?= $merchant ? $merchant->legal_business_name : $company->legal_business_name; ?>" id="legal_business_name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>DBA NAME</b><span class="required_field">*</span></label>
                        <input type="text" required="" class="form-control" name="dba_name" required="" value="<?= $merchant ? $merchant->dba_name : $company->business_name; ?>" id="dba_name">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>CONTANCT NAME</b><span class="required_field">*</span></label>
                        <input type="text" required="" class="form-control" required="" value="<?= $merchant ? $merchant->contact_name : $company->first_name . ' ' . $company->last_name; ?>" name="contact_name" id="contact_name">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>DBA ADDRESS TYPE</b><span class="required_field">*</span></label>
                        <input type="text" required="" class="form-control" required="" value="<?= $merchant ? $merchant->dba_address_type : ''; ?>" name="dba_address_type" id="dba_address_type">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>DBA ADDRESS 1</b> <i>(NO PO BOX)</i></label>
                        <input type="text" class="form-control" value="<?= $merchant ? $merchant->dba_address_1 : $company->business_address; ?>" name="dba_address_1" id="dba_address_1">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>DBA ADDRESS 2</b></label>
                        <input type="text" class="form-control" value="<?= $merchant ? $merchant->dba_address_2 : ''; ?>" name="dba_address_2" id="dba_address_2">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>CITY</b><span class="required_field">*</span></label>
                        <input type="text" required="" value="<?= $merchant ? $merchant->city : $user->city; ?>" class="form-control" name="city" id="city">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>STATE</b><span class="required_field">*</span></label>
                        <input type="text" required="" value="<?= $merchant ? $merchant->state : $user->state; ?>" class="form-control" name="state" id="state">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>ZIP CODE</b><span class="required_field">*</span></label>
                        <input type="text" required="" value="<?= $merchant ? $merchant->zip_code : $user->postal_code; ?>" class="form-control" name="zip_code" id="zip_code">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>DBA PHONE NO.</b><span class="required_field">*</span></label>
                        <input type="text" required="" value="<?= $merchant ? $merchant->dba_phone_no : $company->phone_number; ?>" class="form-control" name="dba_phone_no" id="dba_phone_no">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>EMAIL ADDRESS</b><span class="required_field">*</span></label>
                        <input type="text" required="" value="<?= $merchant ? $merchant->email_address : $company->email_address; ?>" class="form-control" name="email_address" id="email_address">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>MOBILE PHONE NO.</b><span class="required_field">*</span></label>
                        <input type="text" required="" value="<?= $merchant ? $merchant->mobile_phone_no : $user->mobile; ?>" class="form-control" name="mobile_phone_no" id="mobile_phone_no">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>YEAR ESTABLISHED</b><span class="required_field">*</span></label>
                        <input type="text" required="" value="<?= $merchant ? $merchant->years_established : ''; ?>" class="form-control" name="years_established" id="years_established">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>LENGTH OF CURRENT OWNERSHIP</b><span class="required_field">*</span></label>
                        <input type="text" required="" value="<?= $merchant ? $merchant->length_ownership : ''; ?>" class="form-control" name="length_ownership" id="length_ownership">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>YEARS</b><span class="required_field">*</span></label>
                        <input type="text" value="<?= $merchant ? $merchant->ownership_years : ''; ?>" class="form-control" name="ownership_years" id="ownership_years">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>MONTHS</b><span class="required_field">*</span></label>
                        <input type="text" value="<?= $merchant ? $merchant->ownership_months : ''; ?>" class="form-control" name="ownership_months" id="ownership_months">
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12 mobile-brm" style="background-color:#32243d;padding:1px;text-align:center;color:white;">
                    <h6>OTHER ADDRESS <i> (IF DIFFERENT FROM ABOVE)</i></h6>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group" id="customer_type_group">
                        <!-- <input type="checkbox">
                        <label for=""><b>MAILING</b></label> -->
                        <?php
                            $is_checked = '';
                            if( $merchant ){
                                if( $merchant->is_mailing == 1 ){
                                    $is_checked = 'checked="checked"';
                                }
                            }
                        ?>
                        <label class="checkboxcontainer"> MAILING
                        <input type="checkbox" <?= $is_checked ?> name="is_mailing" value="1">
                        <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group" id="customer_type_group">
                        <!-- <input type="checkbox">
                        <label for=""><b>SHIPPING</b></label> -->
                        <?php
                            $is_checked = '';
                            if( $merchant ){
                                if( $merchant->is_shipping == 1 ){
                                    $is_checked = 'checked="checked"';
                                }
                            }
                        ?>
                        <label class="checkboxcontainer"> SHIPPING
                        <input type="checkbox" <?= $is_checked ?> name="is_shipping" value="1">
                        <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" id="customer_type_group">
                        <!-- <input type="checkbox">
                        <label for=""><b>SEE ALSO SPECIAL INSTRUCTIONS</b> <i>(MORE THAN ONE OPTION MAY BE SELECTED)</i></label> -->
                        <?php
                            $is_checked = '';
                            if( $merchant ){
                                if( $merchant->is_see_special_instructions == 1 ){
                                    $is_checked = 'checked="checked"';
                                }
                            }
                        ?>
                        <label class="checkboxcontainer"> <b>SEE ALSO SPECIAL INSTRUCTIONS</b> <i>(MORE THAN ONE OPTION MAY BE SELECTED)</i>
                        <input type="checkbox" <?= $is_checked ?> name="is_see_special_instructions" value="1">
                        <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>LOCATION NAME</b></label>
                        <input type="text" value="<?= $merchant ? $merchant->other_address_location_name : ''; ?>" class="form-control" name="other_address_location_name" id="other_address_location_name">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>PHONE NO.</b></label>
                        <input type="text" value="<?= $merchant ? $merchant->other_address_phone_no : ''; ?>" class="form-control" name="other_address_phone_no" id="other_address_phone_no">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>CONTACT NO.</b></label>
                        <input type="text" value="<?= $merchant ? $merchant->other_address_contact_no : ''; ?>" class="form-control" name="other_address_contact_no" id="other_address_contact_no">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>BEST CONTACT NO.</b></label>
                        <input type="text" value="<?= $merchant ? $merchant->other_address_best_contact_no : ''; ?>" class="form-control" name="other_address_best_contact_no" id="other_address_best_contact_no">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>BEST TIME TO CALL</b></label>
                        <!-- <input type="text" class="form-control" name="name" id="name"> -->
                        <div class="row">
                            <div class="col-md-5">
                                <input type="text" value="<?= $merchant ? $merchant->other_address_best_time_call_from : ''; ?>" class="form-control" name="other_address_best_time_call_from" id="other_address_best_time_call_from" placeholder="From">
                            </div>
                            <div class="col-md-1" style="margin-top:10px;">
                                <i class="fa fa-arrows-h" aria-hidden="true"></i>
                            </div>
                            <div class="col-md-5">
                                <input type="text" value="<?= $merchant ? $merchant->other_address_best_time_call_to : ''; ?>" class="form-control" name="other_address_best_time_call_to" id="other_address_best_time_call_to" placeholder="To">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>FAX NO.</b></label>
                        <input type="text" value="<?= $merchant ? $merchant->other_address_fax_no : ''; ?>" class="form-control" name="other_address_fax_no" id="other_address_fax_no">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>ADDRESS</b></label>
                        <input type="text" value="<?= $merchant ? $merchant->other_address_address : ''; ?>" class="form-control" name="other_address_address" id="other_address_address">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>CITY</b></label>
                        <input type="text" value="<?= $merchant ? $merchant->other_address_city : ''; ?>" class="form-control" name="other_address_city" id="other_address_city">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>STATE</b></label>
                        <input type="text" value="<?= $merchant ? $merchant->other_address_state : ''; ?>" class="form-control" name="other_address_state" id="other_address_state">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>ZIP CODE</b></label>
                        <input type="text" value="<?= $merchant ? $merchant->other_address_zipcode : ''; ?>" class="form-control" name="other_address_zipcode" id="other_address_zipcode">
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12 mobile-brm" style="background-color:#32243d;padding:1px;text-align:center;color:white;">
                    <h6>PRINCIPAL 1 INFORMATION <i> (Include all additional owners with 25% or greater ownership (Individual or Intermediary Business) on the Addl ownership ownership form)</i></h6>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="customer_type_group">
                        <!-- <input type="checkbox">
                        <label for=""><b>BENEFICIAL OWNER: PERCENTAGE OF OWNERSHIP</b></label> -->
                        <?php
                            $is_checked = '';
                            if( $merchant ){
                                if( $merchant->is_beneficial_owner == 1 ){
                                    $is_checked = 'checked="checked"';
                                }
                            }
                        ?>
                        <label class="checkboxcontainer"> <b>BENEFICIAL OWNER: PERCENTAGE OF OWNERSHIP</b>
                        <input type="checkbox" <?= $is_checked; ?> name="is_beneficial_owner" id="is_beneficial_owner" value="1">
                        <span class="checkmark"></span>
                        </label>
                        <input type="text" value="<?= $merchant ? $merchant->percentage_ownership : ''; ?>" name="percentage_ownership" id="percentage_ownership" style="padding: 12px 20px;
                                                                        margin: 8px 0;
                                                                        box-sizing: border-box;
                                                                        border-radius: 4px;"> <label for=""><b> %</b></label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" id="customer_type_group">
                    <br>
                        <!-- <input type="checkbox">
                        <label for=""><b>AUTHORIZED SIGNER</b></label> -->
                        <?php
                            $is_checked = '';
                            if( $merchant ){
                                if( $merchant->is_authorized_signer == 1 ){
                                    $is_checked = 'checked="checked"';
                                }
                            }
                        ?>
                        <label class="checkboxcontainer"> <b>AUTHORIZED SIGNER</b>
                        <input type="checkbox" <?= $is_checked; ?> name="is_authorized_signer" id="is_authorized_signer" value="1">
                        <span class="checkmark"></span>
                    </div>
                </div>                
            </div>
            <div class="row">
                <div class="col-md-12 mobile-brm" style="background-color:#32243d;padding:1px;text-align:center;color:white;">
                    <h6>BUSINESS STRUCTURES</h6>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group" id="principal_llc">
                    <br>
                        <!-- <input type="checkbox">
                        <label for=""><b>SOLE PROPRIETOR</b></label> -->
                        <?php
                            $is_checked = '';
                            if( $merchant ){
                                if( $merchant->principal_llc == 1 ){
                                    $is_checked = 'checked="checked"';
                                }
                            }
                        ?>
                        <label class="checkboxcontainer"> <b>LLC</b>
                        <input type="checkbox" <?= $is_checked; ?> name="principal_llc" id="principal_llc" value="1">
                        <span class="checkmark"></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" id="principal_corporation">
                    <br>
                        <!-- <input type="checkbox">
                        <label for=""><b>SOLE PROPRIETOR</b></label> -->
                        <?php
                            $is_checked = '';
                            if( $merchant ){
                                if( $merchant->principal_corporation == 1 ){
                                    $is_checked = 'checked="checked"';
                                }
                            }
                        ?>
                        <label class="checkboxcontainer"> <b>CORPORATION</b>
                        <input type="checkbox" <?= $is_checked; ?> name="principal_corporation" id="principal_corporation" value="1">
                        <span class="checkmark"></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" id="customer_type_group">
                    <br>
                        <!-- <input type="checkbox">
                        <label for=""><b>SOLE PROPRIETOR</b></label> -->
                        <?php
                            $is_checked = '';
                            if( $merchant ){
                                if( $merchant->is_sole_proprietor == 1 ){
                                    $is_checked = 'checked="checked"';
                                }
                            }
                        ?>
                        <label class="checkboxcontainer"> <b>SOLE PROPRIETORSHIP</b>
                        <input type="checkbox" <?= $is_checked; ?> name="is_sole_proprietor" id="is_sole_proprietor" value="1">
                        <span class="checkmark"></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" id="principal_others">
                    <br>
                        <!-- <input type="checkbox">
                        <label for=""><b>SOLE PROPRIETOR</b></label> -->
                        <?php
                            $is_checked = '';
                            if( $merchant ){
                                if( $merchant->principal_others == 1 ){
                                    $is_checked = 'checked="checked"';
                                }
                            }
                        ?>
                        <label class="checkboxcontainer"> <b>OTHER</b>
                        <input type="checkbox" <?= $is_checked; ?> name="principal_others" id="principal_others" value="1">
                        <span class="checkmark"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>FIRST NAME</b></label>
                        <input type="text" value="<?= $merchant ? $merchant->principal_firstname : $company->first_name; ?>" class="form-control" name="principal_firstname" id="principal_firstname">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>MIDDLE NAME</b></label>
                        <input type="text" value="<?= $merchant ? $merchant->principal_middlename : ''; ?>" class="form-control" name="principal_middlename" id="principal_middlename">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>LAST NAME</b></label>
                        <input type="text" value="<?= $merchant ? $merchant->principal_lastname : $company->last_name; ?>" class="form-control" name="principal_lastname" id="principal_lastname">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>ADDRESS</b></label> <i>(NO PO BOX)</i>
                        <input type="text" value="<?= $merchant ? $merchant->principal_address : $company->business_address; ?>" class="form-control" name="principal_address" id="principal_address">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>PHONE NO</b></label>
                        <input type="text" value="<?= $merchant ? $merchant->principal_phone_no : $company->phone_number; ?>"  class="form-control" name="principal_phone_no" id="principal_phone_no">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>CITY</b></label>
                        <input type="text" value="<?= $merchant ? $merchant->principal_city : $user->city; ?>" class="form-control" name="principal_city" id="principal_city">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>STATE/PROVINCE</b></label>
                        <input type="text" value="<?= $merchant ? $merchant->principal_state_province : $user->state; ?>" class="form-control" name="principal_state_province" id="principal_state_province">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>ZIP/POSTAL CODE</b></label>
                        <input type="text" value="<?= $merchant ? $merchant->principal_zip_postal_code : $user->postal_code; ?>" class="form-control" name="principal_zip_postal_code" id="principal_zip_postal_code">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mobile-no-padding">
                    <div class="form-group gray-mobile" id="customer_type_group" style="background-color:#E8E8E9;padding:2px;">
                        <label for=""> <i><b> PREVIOUS ADDRESS IF CURRENT ADDRESS IS LESS THAN 2 YEARS </b></i></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>HOME ADDRESS</b></label>
                        <input type="text" value="<?= $merchant ? $merchant->principal_home_address : $user->address1; ?>" class="form-control" name="principal_home_address" id="principal_home_address">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>CITY</b></label>
                        <input type="text" value="<?= $merchant ? $merchant->principal_city_1 : $user->city; ?>" class="form-control" name="principal_city_1" id="principal_city_1">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>STATE</b></label>
                        <input type="text" value="<?= $merchant ? $merchant->principal_state_1 : $user->state; ?>" class="form-control" name="principal_state_1" id="principal_state_1">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>ZIP CODE</b></label>
                        <input type="text" value="<?= $merchant ? $merchant->principal_zip_code_1 : $user->postal_code; ?>" class="form-control" name="principal_zip_code_1" id="principal_zip_code_1">
                    </div>
                </div>
            </div>

            <br><br>
                            <div class="row">
                                <div class=" col-md-12">
                                <label style="font-weight:bold;font-size:14px;">TERMS AND CONDITIONS</label>
                                    <div style="height:200px; overflow:auto; background:#FFFFFF;"
                                         id="showuploadagreement">
                                        This application will be sent to an Elavon account manager:
                                        <br>Joyce Reynolds
                                        <br>Account Manager, Customer Account Team
                                        <br>P. 678.731.5796 &emsp; F. 678-731-3173 <u style="text-decoration:underline;">joyce.reynolds@elavon.com</u>
                                        <br>
                                        <br>Elavon l North America Revenue
                                        <br>Elavon Atlanta Concourse
                                        <br>Two Concourse Parkway NE l Suite 600 l Atlanta, GA 30328 l <u style="text-decoration:underline;">www.elavon.com </u>
                                        <br>
                                        <br>An Elavon agent will be contacting you for more specific information to further your request for a merchant account.  Any link  you make to or from the 3rd Party Website will be at your own risk.   Any use of the 3rd Party Website will be subject to and any information you provide will be governed by the terms of the 3rd Party Website, including those relating to confidentiality, data privacy and security.
                                        <br>
                                        <br>Unless otherwise expressly agreed in writing, nSmarTrac and its affiliates are not in any way associated with the owner or operator of the 3rd Party Website or responsible or liable for the goods and services offered by them or for anything in connection with such 3rd Party Website. nSmarTrac does not endorse or approve and makes no warranties, representations or undertakings relating to the content of the 3rd Party Website.
                                        <br>
                                        <br>In addition to the terms stated in nSmarTrac Important Legal Notices, nSmarTrac disclaims liability for any loss, damage and any other consequence resulting directly or indirectly from or relating to your access to the 3rd Party Website or any information that you may provide or any transaction conducted on or via the 3rd Party Web site or the failure of any information, goods or services posted or offered at the 3rd Party Website or any error, omission or misrepresentation on the 3rd Party Website or any computer virus arising from or system failure associated with the 3rd Party Website.
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <div class="row">
                                <div class=" col-md-12">
                                    <a href="javascript:void(0);" class="btn btn-primary btn-submit">Proceed</a> <i>By clicking "Proceed", you will be confirming that you have read and agreed to the terms herein and in the Important Legal Notices.</i>
                                </div>
                            </div>
            <!-- end card -->

            <div class="modal fade" id="sendMerchantDataModal" tabindex="-1" role="dialog" aria-labelledby="sendMerchantDataModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Send Merchant Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body send-merchant-data-message">
                            <p>Are all entries correct? Data will be sent to Elavon account manager.</p>
                        </div>
                        <div class="modal-footer send-merchant-data-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary btn-send-merchant-data" >Send</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>

    <div class="modal fade" id="noticeModal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Error</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">Please fill up form entries</div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="shareMerchantDataModal" tabindex="-1" role="dialog" aria-labelledby="shareMerchantDataModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Share Merchant Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="frm-share-merchant">
                    <div class="modal-body">
                        <div class="share-modal-form">
                            <input type="email" class="form-control" placeholder="Enter Email" name="share_email" id="share_email" required="">
                        </div>
                        <div class="share-modal-message"></div>
                    </div>
                    <div class="modal-footer share-merchant-data-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" >Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- end container-fluid -->
</div>

<?php include viewPath('includes/footer'); ?>
<script>
    /*$("#date_of_birth").datetimepicker({
        format: "L",
        //minDate: new Date(),
    });*/

    /*$(".btn-submit").click(function(){
        $("#frm-merchant").submit();
    });*/
    $(".btn-share-merchant-info").click(function(){
        $("#shareMerchantDataModal").modal("show");
        $(".share-modal-form").show();
        $(".share-modal-message").hide();
        $(".share-modal-message").html('');
        $(".share-merchant-data-footer").show();
        $("#share_email").val("");
    });

    $("#frm-share-merchant").submit(function(e){
        e.preventDefault();
        var message = '<div class="alert alert-info" role="alert"><img style="display:inline-block;" src="'+base_url+'/assets/img/spinner.gif" /> Sending...</div>';
        $(".share-modal-form").hide();
        $(".share-modal-message").show();
        $(".share-modal-message").html(message);
        $(".share-merchant-data-footer").hide();

        $.ajax({
            type: "POST",
            dataType: 'json',
            url: base_url + "/customer/share_merchant_data",
            data: $("#frm-share-merchant").serialize(),
            success: function(data)
            {
                if( data.is_success == 1 ){
                    $(".share-modal-message").html('<div class="alert alert-success" role="alert">Email was successfully sent</div>');
                }else{
                    $(".share-modal-message").html('<div class="alert alert-danger" role="alert">Cannot send data</div>');
                }
            }
        });
    });


    $(".btn-send-merchant-data").click(function(){
        var message = '<div class="alert alert-info" role="alert"><img style="display:inline-block;" src="'+base_url+'/assets/img/spinner.gif" /> Sending...</div>';
        $(".send-merchant-data-message").html(message);
        $(".send-merchant-data-footer").hide();
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: base_url + "/customer/send_merchant_details",
            data: $("#frm-merchant").serialize(),
            success: function(data)
            {
                if( data.is_success == 1 ){
                    $(".send-merchant-data-message").html('<div class="alert alert-success" role="alert">Merchant data was succesfully sent</div>');
                    //$(".send-merchant-data-footer").show();
                }else{
                    $(".send-merchant-data-message").html('<div class="alert alert-danger" role="alert">Cannot send data</div>');
                }
            }
        });
    });
    $(".btn-submit").on( "click", function( event ) {
        if ($("#frm-merchant")[0].checkValidity()){            
            $("#sendMerchantDataModal").modal("show");
            $(".send-merchant-data-footer").show();
            $(".send-merchant-data-message").html('<p>Are all entries correct? Data will be sent to Elavon account manager.</p>');
        }else{  
            $("#noticeModal").modal('show');
        }        
    });

    $(function () {
        $('#sss_num').keydown(function (e) {
            var key = e.charCode || e.keyCode || 0;
            $text = $(this);
            if (key !== 8 && key !== 9) {
                if ($text.val().length === 3) {
                    $text.val($text.val() + '-');
                }
                if ($text.val().length === 6) {
                    $text.val($text.val() + '-');
                }
            }
            return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
        });

        $('.phone_number').keydown(function (e) {
            var key = e.charCode || e.keyCode || 0;
            $text = $(this);
            if (key !== 8 && key !== 9) {
                if ($text.val().length === 3) {
                    $text.val($text.val() + '-');
                }
                if ($text.val().length === 7) {
                    $text.val($text.val() + '-');
                }
            }
            return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
        });
    });
</script>

<style>
    .btn-primary.disabled, .btn-primary:disabled {
        color: #000 !important;
        background-color: #ccc !important;
        border-color: #ccc !important;
    }
</style>
