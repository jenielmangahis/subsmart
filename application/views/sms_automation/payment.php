<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.page-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
}
.cell-inactive{
    background-color: #d9534f;
}
.left {
  float: left;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.p-40 {
  padding-top: 40px !important;
}
.tabs-menu {
    margin-bottom: 20px;
    padding: 0;
    margin-top: 20px;
}
.tabs-menu ul {
    list-style: none;
    margin: 0;
    padding: 0;
}
.md-right {
  float: right;
  width: max-content;
  display: block;
  padding-right: 0px;
}
.tabs-menu .active, .tabs-menu .active a {
    color: #2ab363;
}
.tabs-menu li {
    float: left;
    margin: 0;
    padding: 0px 83px 0px 0px;
    font-weight: 600;
    font-size: 17px;
}
.payment-list{
  padding: 0px 25px;
}
.payment-list li{
  list-style-type: disc !important;
}
.terms-condition{
  margin-top: 20px;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/marketing'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <?php echo form_open_multipart('', ['class' => 'form-validate', 'id' => 'activate-automation', 'autocomplete' => 'off']); ?>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mt-0">

                        <div class="row">
                          <div class="col-sm-6 left">
                            <h3 class="page-title">SMS Automation</h3>
                          </div>
                          <div class="col-sm-6 right dashboard-container-1">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                        <a href="<?php echo url('sms_automation') ?>" class="btn btn-primary" aria-expanded="false">
                                            <i class="mdi mdi-settings mr-2"></i> Go Back to SMS Automation list
                                        </a>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="alert alert-warning mt-2 mb-0" role="alert">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">The final step is to activate payments for automation.
                            </span>
                        </div>

                        <div class="card-body">
                            <div class="form-msg" style="display: none;"></div>
                            <div class="tabs-menu">
                                <ul class="clearfix">
                                  <li>1. Edit Rules</li>
                                  <li>2. Build SMS</li>
                                  <li>3. Preview</li>
                                  <li class="active">4. Payment</li>
                                </ul>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <p style="font-size:18px;"><b>SMS Automation Payment</b></p>
                                    <ul class="payment-list" style="">
                                      <li st>Your card will be billed monthly on your subscription day.</li>
                                      <li>The amount is calculated based on the total number of text messages sent for that month.</li>
                                      <li>You will be charged $0.10 for one text.</li>
                                      <li>You can see a log with number of texts sent for each automation.</li>
                                      <li>You can pause or delete an automation at any time.</li>
                                    </ul>
                                    <br />
                                    <div class="checkbox checkbox-sm">
                                        <input class="checkbox-select chk-terms" type="checkbox" name="accept_terms" value="1" id="chk-terms">
                                        <label for="chk-terms">I agree to bill my card</label>
                                    </div>
                                    <br />
                                    <div class="terms-condition">
                                      <p>By clicking Activate button you agree to <a href="<?= base_url("terms-and-condition"); ?>" style="color:#259e57;" target="_new">NSmarTrac's Terms & Conditions</a>, <a href="<?= base_url("privacy-policy"); ?>" style="color:#259e57;" target="_new">Privacy Policy</a> and <a href="<?= base_url("anti-spam-policy"); ?>" style="color:#259e57;" style="color:#259e57;" target="_new">Anti-Spam Policy</a></p>
                                    </div>  
                                </div>
                            </div>
                            <hr />
                            <div>
                                <div class="col-md-4 form-group md-right">
                                    <a class="btn btn-default margin-right" href="<?php echo url('sms_automation/preview_sms_message'); ?>">&laquo; Back</a>
                                    <button type="submit" class="btn btn-flat btn-primary margin-right btn-automation-activate" style="margin-right: 0px;">Activate Automation</button>
                                </div>
                            </div>
                        </div>
                      </div>

                    </div>
                    <!-- end card -->
                </div>
            </div>
            <?php echo form_close(); ?>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
<script>
$(function(){
    $("#activate-automation").submit(function(e){
        e.preventDefault();

        if( $("#chk-terms").is(":checked") ){
          var url = base_url + 'sms_automation/activate_automation';
          $(".btn-automation-activate").html('<span class="spinner-border spinner-border-sm m-0"></span>  Saving');
          setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               dataType: "json",
               data: $("#activate-automation").serialize(),
               success: function(o)
               {
                  if( o.is_success ){
                      $('.form-msg').hide().html("<p class='alert alert-info'>"+o.msg+"</p>").fadeIn(500);
                      $(".btn-automation-activate").html('<span class="spinner-border spinner-border-sm m-0"></span>  Redirecting to list');
                      setTimeout(function() {
                          location.href = base_url + "sms_automation";
                      }, 2500);
                  }else{
                      $(".btn-automation-activate").html('Activate Automation');

                      Swal.fire({
                        icon: 'error',
                        title: 'Cannot activate automation.',
                        text: 'Please try again later'
                      });
                  }
               }
            });
          }, 1000);
        }else{
          Swal.fire({
            icon: 'error',
            title: 'Cannot proceed.',
            text: 'Please check form inputs'
          });
        }

        
    });
});
</script>
