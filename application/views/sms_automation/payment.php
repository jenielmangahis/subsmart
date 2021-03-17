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
                                      <p>By clicking Activate button you agree to <a class="view-modal-info" data-id="terms-condition" href="javascript:void(0);" style="color:#259e57;">NSmarTrac's Terms & Conditions</a>, <a class="view-modal-info" data-id="refund-policy" href="javascript:void(0);" style="color:#259e57;">Refund Policy</a> and <a class="view-modal-info" data-id="anti-spam" href="javascript:void(0);" style="color:#259e57;">Anti-Spam Policy</a></p>
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

                        <div class="modal fade" id="modalPaymentInfo" tabindex="-1" role="dialog" aria-labelledby="modalTermsConditionTitle" aria-hidden="true">
                          <div class="modal-dialog modal-md" role="document" style="margin-top:5%;">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="modalPaymentInfoTitle">NSmarTrac's Terms & Conditions</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body" style="padding: 20px 30px;">
                                  <div id="terms-condition">
                                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Mattis ullamcorper velit sed ullamcorper morbi tincidunt ornare. Morbi tincidunt ornare massa eget egestas purus viverra accumsan. Integer malesuada nunc vel risus commodo viverra maecenas. Lorem mollis aliquam ut porttitor leo. Turpis egestas sed tempus urna et pharetra pharetra massa. Nunc scelerisque viverra mauris in. Congue quisque egestas diam in arcu cursus euismod quis viverra. Tortor consequat id porta nibh venenatis cras sed. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed velit. Eget duis at tellus at urna. In pellentesque massa placerat duis. Justo donec enim diam vulputate ut. Duis at consectetur lorem donec. Et tortor consequat id porta nibh venenatis cras sed felis.
                                  </div>

                                  <div id="refund-policy">
                                  Amet justo donec enim diam vulputate ut. Viverra accumsan in nisl nisi scelerisque eu. Ut consequat semper viverra nam libero justo laoreet. Nec dui nunc mattis enim. Arcu non sodales neque sodales. A scelerisque purus semper eget duis at tellus. Sed felis eget velit aliquet sagittis. Leo vel orci porta non pulvinar neque. Luctus venenatis lectus magna fringilla urna porttitor rhoncus dolor. Purus ut faucibus pulvinar elementum. Orci dapibus ultrices in iaculis nunc sed augue lacus. Ultricies mi eget mauris pharetra et ultrices neque ornare aenean. Pellentesque sit amet porttitor eget dolor morbi non arcu. Iaculis at erat pellentesque adipiscing commodo elit. Quis risus sed vulputate odio ut enim. Nisi est sit amet facilisis magna etiam. Amet nisl purus in mollis nunc sed id semper risus. Senectus et netus et malesuada fames ac.
                                  </div>

                                  <div id="anti-spam">
                                  Rhoncus est pellentesque elit ullamcorper dignissim cras tincidunt lobortis feugiat. Quam nulla porttitor massa id neque aliquam. Leo urna molestie at elementum. Sed risus ultricies tristique nulla aliquet. Ut faucibus pulvinar elementum integer enim neque. Tincidunt arcu non sodales neque sodales. Dictum sit amet justo donec enim diam vulputate ut. Vitae auctor eu augue ut lectus. Arcu vitae elementum curabitur vitae nunc. Lectus quam id leo in. Morbi quis commodo odio aenean. Sem viverra aliquet eget sit amet tellus cras. Luctus accumsan tortor posuere ac ut consequat semper viverra. Id volutpat lacus laoreet non.
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    $(".view-modal-info").click(function(){
      var type = $(this).attr('data-id');
      if( type == 'terms-condition' ){
        $("#modalPaymentInfoTitle").html("NSmarTrac's Terms & Conditions");
        $("#terms-condition").show();
        $("#refund-policy").hide();
        $("#anti-spam").hide();
      }else if( type == 'refund-policy' ){
        $("#modalPaymentInfoTitle").html("Refund Policy");
        $("#terms-condition").hide();
        $("#refund-policy").show();
        $("#anti-spam").hide();
      }else{
        $("#modalPaymentInfoTitle").html("Anti-Spam Policy");
        $("#terms-condition").hide();
        $("#refund-policy").hide();
        $("#anti-spam").show();
      }
      $("#modalPaymentInfo").modal('show');
    });

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
