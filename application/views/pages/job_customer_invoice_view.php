<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header_front'); ?>
<script src="https://demo.convergepay.com/hosted-payments/PayWithConverge.js"></script>
<div>
    <!-- page wrapper start -->
    <div>
        <div class="container-fluid">
            <br class="clear"/>
            <div class="row">                
                <div class="col-xl-12">
                  <?php include viewPath('flash'); ?>
                    <div class="card">
                      <?php if($job){ ?>

                        <div class="col-xl-5 left" style="margin-bottom: 33px;">
                          <h5><span class="fa fa-user-o fa-margin-right"></span> From <span class="invoice-txt"> <?= $client->business_name; ?></span></h5>
                          <div class="col-xl-5 ml-0 pl-0">
                            <span class=""><?= $client->business_address; ?></span><br />
                            <span class="">EMAIL: <?= $client->email_address; ?></span><br />
                            <span class="">PHONE: <?= $client->phone_number; ?></span>
                          </div>
                        </div>

                        <div class="col-xl-5 left">
                          <h5><span class="fa fa-user-o fa-margin-right"></span> To <span class="invoice-txt"> <?= $customer->first_name . ' ' . $customer->last_name; ?></span></h5> 
                          <div class="col-xl-5 ml-0 pl-0">
                            <span class=""><?= $customer->mail_add . " " . $customer->city ?></span><br /><br />
                            <span class="">EMAIL: <span class=""><?= $customer->email; ?></span></span><br />
                            <span class="">PHONE: <span class=""><?= $customer->phone_w; ?></span></span><br />
                          </div>
                        </div>

                         <div class="col-xl-5 left" style="margin-bottom: 33px;">
                          <div class="col-xl-5 ml-0 pl-0">
                            <span class="">JOB NUMBER: <?= $job->job_number; ?></span><br />                            
                          </div>
                        </div>
                      
                      <?php }else{ ?>
                        <div class="alert alert-danger" role="alert">
                          Invalid job number
                        </div>
                      <?php } ?>

                      <div>
                        <span>Total : $400</span> 
                        <input type="hidden" id="jobid" value="<?= $eid; ?>">               
                        <input type="hidden" id="total_amount" value="400">            
                        <br /><br />   
                        <a class="btn btn-info btn-pay-converge" href="javascript:void(0);">PAY</a>
                      </div>
                  </div>
                </div>
          </div>

      </div>
    </div>
        <!-- end container-fluid -->
  </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer_pages'); ?>
<script>
$(function(){
  $(".btn-pay-converge").click(function(){
    initiateLightbox();
  });

  function initiateLightbox () {
      var job_id = $("#jobid").val();
      var total_amount = $("#total_amount").val();

      var url = base_url + '_converge_request_token';
      $(".btn-pay-converge").html('<span class="spinner-border spinner-border-sm m-0"></span>');
      setTimeout(function () {
        $.ajax({
           type: "POST",
           url: url,
           dataType: "json",
           data: {job_id:job_id, total_amount:total_amount},
           success: function(o)
           {
              if( o.is_success ){
                  openLightbox(o.token)
              }else{
                Swal.fire({
                  icon: 'error',
                  title: 'Cannot Process Payment',
                  text: o.msg
                });
                $(".btn-pay-converge").html('Pay');
              }
           }
        });
      }, 1000);
  }

  function openLightbox (token) {
      var paymentFields = {
              ssl_txn_auth_token: token
      };
      var callback = {
          onError: function (error) {
              showResult("error", error);
          },
          onCancelled: function () {
                  showResult("cancelled", "");
          },
          onDeclined: function (response) {
              showResult("declined", JSON.stringify(response, null, '\t'));
          },
          onApproval: function (response) {
              showResult("approval", JSON.stringify(response, null, '\t'));
          }
      };
      PayWithConverge.open(paymentFields, callback);
      return false;
  }
});
</script>
