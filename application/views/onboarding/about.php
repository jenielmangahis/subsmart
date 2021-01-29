<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
error_reporting(0);
?>
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
img.banner-reg-a {
  background: black;
  object-fit: cover;
  height: 250px;
  width: 100%;
  margin-bottom: 8px;
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
         <h3 style="background-color: #4A2268;color:#ffffff;padding:11px;">Tell us more about your business</h3>
         <img class="banner-reg-a" src="<?php echo base_url('assets/img/business-registration/fp-a.jpg') ?>" alt="">
         <?php echo form_open_multipart('onboarding/save_business_info', [ 'id'=> 'form-business-details', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
            <input type="hidden" name="id" value="<?php echo $profiledata->id; ?>">
            <input type="hidden" name="user_id" value="<?php echo $profiledata->user_id; ?>">
            <div class="card">
               <h3>Let your customers know how big your business is.</h3>
               <h4>About</h4>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Year of Establishment</label> <span class="form-required">*</span>
                        <div class="help help-block help-sm">Enter the year of company establishment.</div>
                        <input type="number" name="year_est" class="form-control" value="<?php echo ($profiledata) ? $profiledata->year_est : '' ;?>" id="">
                        <span class="validation-error-field" data-formerrors-for-name="year_est" data-formerrors-message="true" style="display: none;"></span>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Number of Employees</label> <span class="form-required">*</span>
                        <div class="help help-block help-sm">Enter the number of people working for you.</div>
                        <select class="form-control" id="number_of_employee" name="employee_count" required="">
                            <option <?= $num_emp == '1' ? 'selected="selected"' : ''; ?> value="1">1 (Just Me)</option>
                            <option <?= $num_emp == '2-3' ? 'selected="selected"' : ''; ?> value="2-3">2-3</option>
                            <option <?= $num_emp == '4-10' ? 'selected="selected"' : ''; ?> value="4-10">4-10</option>
                            <option <?= $num_emp == '11-15' ? 'selected="selected"' : ''; ?> value="11-15">11-15</option>
                            <option <?= $num_emp == '16-20' ? 'selected="selected"' : ''; ?> value="16-20">16-20</option>
                            <option <?= $num_emp == '20+' ? 'selected="selected"' : ''; ?> value="20+">20+</option>
                        </select>
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
                              <input type="radio" name="is_subcontract_allowed" value="1" <?php if($profiledata->is_subcontract_allowed==1){ ?> checked="checked" <?php } ?> id="is_subcontract_allowed_1">
                              <label for="is_subcontract_allowed_1"><span>Yes</span></label>
                           </div>
                           <div class="checkbox checkbox-sec">
                              <input type="radio" name="is_subcontract_allowed" value="0"  <?php if($profiledata->is_subcontract_allowed==0){ ?> checked="checked" <?php } ?> id="is_subcontract_allowed_2">
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
                        <input type="text" name="business_number" value="<?php echo $profiledata->business_number; ?>"  class="form-control" autocomplete="off">
                        <span class="validation-error-field" data-formerrors-for-name="employee_count" data-formerrors-message="true" style="display: none;"></span>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <label>Service Location</label>
                  <div class="help help-sm help-block">Enter the areas or neighborhoods where you provide your services.</div>
                  <input type="text" name="service_location" value="<?php echo $profiledata->service_location ?>"  class="form-control" id="" autocomplete="off" placeholder="Area or neighborhood">
                  <span class="validation-error-field" data-formerrors-for-name="service_locations" data-formerrors-message="true" style="display: none;"></span>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <div class="clearfix">
                           <label>Business Short Description</label><span class="help help-sm help-bold pull-right">characters left: <span class="char-counter-left">1800</span></span>
                        </div>
                        <div class="help help-block help-sm">Give customers more details on what your business actually does. Describe your company's values and goals. Minimum 25 characters.</div>
                        <textarea name="business_desc" id="business-desc" minlength="25" cols="40" rows="8" class="form-control" autocomplete="off"><?php echo ($profiledata) ? $profiledata->business_desc: ''; ?> </textarea>
                        <span class="validation-error-field" data-formerrors-for-name="about" data-formerrors-message="true" style="display: none;"></span>
                     </div>
                  </div>
               </div>
               <div class="row">
               <div class="col-xs-16 text-right submit-onboard">
                  <a class="btn btn-default btn-lg margin-right" href="<?php echo base_url("/dashboard");?>">Skip</a>
                  <a class="btn btn-default btn-lg" href="<?php echo base_url("/onboarding/business_info");?>">« Back</a>
                  <button class="btn btn-primary btn-lg margin-left" name="action" value="about" type="submit">Next »</button>
               </div>
            </div>
            </div>
    <?php echo form_close(); ?>
  </div>
</div>
</div>
<script src="<?php echo $url->assets ?>dashboard/js/jquery.min.js"></script>
<?php include viewPath('includes/footer'); ?>
<script>
$(function(){
  function bussinessDescriptionCharCounter(){
      var chars_max   = 1800;
      var chars_total = $("#business-desc").val().length;
      var chars_left  = chars_max - chars_total;

      $(".char-counter-left").html(chars_left);

      return chars_left;
  }

  $("#business-desc").keydown(function(e){
      var chars_left = bussinessDescriptionCharCounter();
      if( chars_left <= 0 ){
          if (e.keyCode != 46 && e.keyCode != 8 ) return false;
      }else{
          return true;
      }
  });

  bussinessDescriptionCharCounter();
});
</script>
