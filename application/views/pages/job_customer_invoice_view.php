<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header_front'); ?>
<?php if($onlinePaymentAccount->stripe_publish_key != '' && $onlinePaymentAccount->stripe_secret_key != ''){ ?>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://checkout.stripe.com/checkout.js"></script>    
<?php } ?>
<?php if($onlinePaymentAccount->paypal_client_id != '' && $onlinePaymentAccount->paypal_client_secret != ''){ ?>
<script src="https://www.paypal.com/sdk/js?client-id=<?= $onlinePaymentAccount->paypal_client_id; ?>&currency=USD"></script>
<?php } ?>
<?php include viewPath('job/css/job_new'); ?>
<style>
    .card{
        box-shadow: 0 0 13px 0 rgb(116 116 117) !important;
    }
    .card-body {
        padding: 0 !important;
    }
    .right-text{
        position: relative;
        float:right;
        right: 0;
        bottom: 10px;
    }
    #map{
        height: 190px;
    }
    .title-border{
        border-bottom: 2px solid rgba(0,0,0,.1);
        padding-bottom: 5px;
    }
    .icon_preview{
        font-size: 16px;
        color : #45a73c;
    }
    /**
   * The CSS shown here will not be introduced in the Quickstart guide, but shows
   * how you can use CSS to style your Element's container.
   */
    .StripeElement {
      box-sizing: border-box;

      height: 40px;

      padding: 10px 12px;

      border: 1px solid transparent;
      border-radius: 4px;
      background-color: white;

      box-shadow: 0 1px 3px 0 #e6ebf1;
      -webkit-transition: box-shadow 150ms ease;
      transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
      box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
      border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
      background-color: #fefde5 !important;
    }
    .stripe-btn, .stripe-cancel-btn{
      border: none;
        border-radius: 4px;
        outline: none;
        text-decoration: none;
        color: #fff;
        background: #32325d;
        white-space: nowrap;
        display: inline-block;
        height: 40px;
        line-height: 40px;
        padding: 0 14px;
        box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08);
        border-radius: 4px;
        font-size: 15px;
        font-weight: 600;
        letter-spacing: 0.025em;
        text-decoration: none;
        -webkit-transition: all 150ms ease;
        transition: all 150ms ease;      
        margin-left: 12px;
        margin-top: 28px;
    }
    .paypal-buttons-context-iframe{
        top: 19px;
    }
</style>
<?php if($onlinePaymentAccount->converge_merchant_id != '' && $onlinePaymentAccount->converge_merchant_user_id != ''){ ?>
    <!-- Remove demo in url for production -->    
    <script src="https://api.demo.convergepay.com/hosted-payments/Checkout.js"></script>
    <script src="https://demo.convergepay.com/hosted-payments/PayWithConverge.js"></script>
    <!-- <script src="https://api.convergepay.com/hosted-payments/PayWithConverge.js"></script> -->
<?php } ?>
<div>
    <!-- page wrapper start -->
    <div>
        <div class="container-fluid">
            <br class="clear"/>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="right-text">
                                <input type="hidden" id="job-number" value="<?=  $jobs_data->job_number;  ?>">
                                <p class="page-title " style="font-weight: 700;font-size: 16px;"><?=  $jobs_data->job_number;  ?> </p>
                            </div>
                            <hr>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <?php if($company_info->business_image != "" ): ?>
                                        <img style="width: 100px" id="attachment-image" alt="Attachment" src="<?= base_url('/uploads/users/business_profile/'.$company_info->id.'/'.$company_info->business_image); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-3">
                                    <table class="right-text">
                                        <tbody>
                                        <tr>
                                            <td align="right" width="45%">Job Type :</td>
                                        </tr>
                                        <tr>
                                            <td align="right" >Job Tags:</td>
                                        </tr>
                                        <tr>
                                            <td align="right" >Date :</td>
                                        </tr>
                                        <tr>
                                            <td align="right" >Priority :</td>
                                        </tr>
                                        <tr>
                                            <td align="right" >Status :</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-4">
                                    <table class="right-text">
                                        <tbody>
                                        <tr>
                                            <td align="right" width="65%"><?= $jobs_data->job_type;  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right" ><?= $jobs_data->name;  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><?= isset($jobs_data) ?  date('m/d/Y', strtotime($jobs_data->start_date)) : '';  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right" style="color: darkred;"><?=  $jobs_data->priority;  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right" style="font-weight: 600;"><?=  $jobs_data->status;  ?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                    <div class="col-md-6">
                                        <br>
                                        <h6 class="title-border">FROM :</h6>
                                        <b><?= $company_info->business_name; ?></b><br>
                                        <span><?= $company_info->street; ?></span><br>
                                        <span><?= $company_info->city.', '.$company_info->state.' '.$company_info->postal_code ; ?></span><br>
                                        <span> Phone: <?= $company_info->business_phone ; ?></span>
                                    </div>
                                    <div class="col-md-6">
                                        <br>
                                        <h6 class="title-border">TO :</h6>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <b><?= $jobs_data->first_name.' '.$jobs_data->last_name; ?></b><br>
                                                <span><?= $jobs_data->mail_add; ?></span><br>
                                                <span><?= $jobs_data->cust_city.' '.$jobs_data->cust_state.' '.$jobs_data->cust_zip_code ; ?></span> <span class="fa fa-copy icon_preview"></span><br>
                                                <span>Email: <?= $jobs_data->cust_email ; ?></span> <a href="mailto:<?= $jobs_data->cust_email ; ?>"><span class="fa fa-envelope icon_preview"></span></a><br>
                                                <span>Phone:  </span>
                                                <?php if($jobs_data->phone_h!="" || $jobs_data->phone_h!=NULL): ?>
                                                    <?= $jobs_data->phone_h;  ?>
                                                    <span class="fa fa-phone icon_preview"></span>
                                                    <span class="fa fa-envelope-open-text icon_preview"></span>
                                                <?php else : echo 'N/A';?>
                                                <?php endif; ?>
                                                <br>
                                                <span>Mobile: </span>
                                                <?php if($jobs_data->phone_m!="" || $jobs_data->phone_m!=NULL): ?>
                                                    <?= $jobs_data->phone_h;  ?>
                                                    <?= $jobs_data->phone_m;  ?>
                                                    <span class="fa fa-phone icon_preview"></span>
                                                    <span class="fa fa-envelope-open-text icon_preview"></span>
                                                <?php else : echo 'N/A';?>
                                                <?php endif; ?>
                                                <br>
                                            </div>
                                        </div>
                                    </div>

                                <div class="col-md-12">
                                    <h6 class="title-border">JOB DETAILS :</h6>
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <td>Items</td>
                                            <td>Qty</td>
                                            <td>Price</td>
                                            <td>Total</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $subtotal = 0.00;
                                        foreach ($jobs_data_items as $item):
                                            $total = ($item->price * $item->qty);
                                            ?>
                                            <tr>
                                                <td><?= $item->title; ?></td>
                                                <td><?= $item->qty; ?></td>
                                                <td>$<?= $item->price; ?></td>
                                                <td>$<?= number_format((float)$total,2,'.',','); ?></td>
                                            </tr>
                                            <?php
                                            $subtotal = $subtotal + $total;
                                        endforeach;
                                        ?>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <b>Sub Total</b>
                                    <b class="right-text">$<?= number_format((float)$subtotal,2,'.',','); ?></b>
                                    <br><hr>

                                    <?php if($jobs_data->tax != NULL): ?>
                                        <b>Tax </b>
                                        <i class="right-text">$0.00</i>
                                        <br><hr>
                                    <?php endif; ?>

                                    <?php if($jobs_data->discount != NULL): ?>
                                        <b>Discount </b>
                                        <i class="right-text">$0.00</i>
                                        <br><hr>
                                    <?php endif; ?>

                                    <b>Grand Total</b>
                                    <b class="right-text">$<?= number_format((float)$jobs_data->total_amount,2,'.',','); ?></b>
                                </div>
                                <div class="col-md-4">
                                    <br>
                                    <h6 class="title-border">NOTES :</h6>
                                    <span><?=  $jobs_data->message; ?></span>
                                </div>

                                <!-- <div class="col-md-4">
                                    <br>
                                    <h6 class="title-border">ASSIGNED TO :</h6>
                                    <?php
                                    $employee_date = get_employee_name($jobs_data->employee_id);
                                    $shared1 = get_employee_name($jobs_data->employee2_id);
                                    $shared2 = get_employee_name($jobs_data->employee3_id);
                                    $shared3 = get_employee_name($jobs_data->employee4_id);
                                    ?>
                                    <span><?= $employee_date->FName; ?></span> <span class="fa fa-envelope-open-text icon_preview"></span><br>
                                    <?php if(isset($shared1) && !empty($shared1) && $shared1!=NULL ): ?>
                                        <span><?= $shared1->FName; ?></span> <span class="fa fa-envelope-open-text icon_preview"></span><br>
                                    <?php endif; ?>
                                    <?php if(isset($shared2) && !empty($shared2) && $shared2!=NULL ): ?>
                                        <span><?= $shared2->FName; ?></span> <span class="fa fa-envelope-open-text icon_preview"></span><br>
                                    <?php endif; ?>
                                    <?php if(isset($shared3) && !empty($shared3) && $shared3!=NULL ): ?>
                                        <span><?= $shared3->FName; ?></span> <span class="fa fa-envelope-open-text icon_preview"></span><br>
                                    <?php endif; ?>
                                </div> -->

                                <!-- <div class="col-md-4">
                                    <br>
                                    <h6 class="title-border">URL LINK :</h6>
                                    <span><a style="color: darkred;" target="_blank" href="<?= $jobs_data->link; ?>"><?= $jobs_data->link; ?></a></span>
                                </div> -->

                                <div class="col-md-12">
                                    <h6 class="title-border"></h6>
                                    <span style="font-weight: 700;font-size: 20px;color: darkred;">Total : $<?= number_format((float)$jobs_data->total_amount,2,'.',','); ?></span>
                                    <input type="hidden" id="jobid" value="<?= $jobs_data->job_unique_id; ?>">
                                    <input type="hidden" id="total_amount" value="<?= $jobs_data->total_amount; ?>">
                                    <br /><br />
                                    <?php if($jobs_data->status != 'Completed'){ ?>
                                        <?php echo form_open_multipart(null, ['class' => 'form-validate', 'id' => 'payment-job-invoice', 'autocomplete' => 'off']); ?>
                                        <div class="payment-msg"></div>
                                        <div class="payment-api-container" <?= $jobs_data->total_amount <= 0 ? 'style="display:none;"' : ''; ?>>
                                          <?php if($onlinePaymentAccount){ ?>
                                            <a class="btn btn-primary btn-confirm-order btn-pay" href="javascript:void(0);">CONFIRM ORDER</a>

                                            <?php if($onlinePaymentAccount->converge_merchant_user_id != '' && $onlinePaymentAccount->converge_merchant_pin != ''){ ?>
                                              <input type="hidden" id="converge-token" name="converge_token" value="" />
                                              <a class="btn btn-primary btn-pay-converge btn-pay" href="javascript:void(0);" style="display:none;">PAY VIA CONVERGE</a>
                                              <?php if( isApple() ){ ?>
                                                <div id="applepay-button" class="apple-pay-button" style="display:none;"></div>
                                              <?php } ?>
                                            <?php } ?>

                                            <?php if($onlinePaymentAccount->stripe_publish_key != '' && $onlinePaymentAccount->stripe_secret_key != ''){ ?>
                                                <a class="btn btn-primary btn-pay-stripe btn-pay" href="javascript:void(0);" style="display:none;">PAY VIA STRIPE</a>
                                            <?php } ?>

                                            <?php if($onlinePaymentAccount->paypal_client_id != '' && $onlinePaymentAccount->paypal_client_secret != ''){ ?>
                                              <div id="paypal-button-container" style="display: inline-block;height: 44px;"></div>
                                            <?php } ?>
                                          <?php } ?>

                                        </div>
                                        <?php echo form_close(); ?>
                                    <?php } ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <?php //include viewPath('flash'); ?>
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
  function updateJobToPaid(){
    var job_id = $("#jobid").val();
    var url = base_url + '_update_job_status_paid';
    $.ajax({
       type: "POST",
       url: url,
       dataType: "json",
       data: {job_id:job_id},
       success: function(o)
       {
          $(".payment-api-container").hide();
          Swal.fire({
            icon: 'success',
            title: 'Payment Successful',
            text: 'Payment process completed.'
          });            
       }
    });
  }
  //Converge payment
  $(".btn-pay-converge").click(function(){
    //initiateLightbox();
    var token = $('#converge-token').val();
    openLightbox(token);
  });

  $('.btn-confirm-order').click(function(){
    var job_id = $("#jobid").val();
    var total_amount = $("#total_amount").val();
    <?php if($onlinePaymentAccount->converge_merchant_user_id != '' && $onlinePaymentAccount->converge_merchant_pin != ''){ ?>
        var url = base_url + '_converge_request_token';
        $(".btn-confirm-order").html('<span class="spinner-border spinner-border-sm m-0"></span>');
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               dataType: "json",
               data: {job_id:job_id, total_amount:total_amount},
               success: function(o)
               {
                    if( o.is_success ){
                        $('#converge-token').val(o.token);    
                        <?php if( isApple() ){ ?>
                        initiateApplePay(o.token);          
                        <?php } ?>

                        $(".btn-pay-converge").show();

                        <?php if($onlinePaymentAccount->stripe_publish_key != '' && $onlinePaymentAccount->stripe_secret_key != ''){ ?>
                            $(".btn-pay-stripe").show();
                        <?php } ?>

                        <?php if($onlinePaymentAccount->paypal_client_id != '' && $onlinePaymentAccount->paypal_client_secret != ''){ ?>
                            // Render the PayPal button into #paypal-button-container
                            paypal.Buttons({
                                style: {
                                    layout: 'horizontal',
                                    tagline: false,
                                    height:45,
                                    color:'blue'
                                },
                                // Set up the transaction
                                createOrder: function(data, actions) {
                                    return actions.order.create({                
                                        purchase_units: [{
                                            amount: {
                                                value: $("#total_amount").val()
                                            }
                                        }],
                                        application_context: {
                                            shipping_preference: 'NO_SHIPPING'
                                        }
                                    });
                                },
                                // Finalize the transaction
                                onApprove: function(data, actions) {
                                    return actions.order.capture().then(function(details) {
                                        // Show a success message to the buyer
                                        //console.log(details);
                                        updateJobToPaid();       
                                    });
                                }
                            }).render('#paypal-button-container');
                        <?php } ?>
                        $(".btn-confirm-order").hide();

                    }else{
                        Swal.fire({
                          icon: 'error',
                          title: 'Cannot Process Payment',
                          text: o.msg
                        });

                        $(".btn-confirm-order").html('CONFIRM ORDER');
                    }
               }
            });
        }, 1000);
    <?php }else{ ?>
        $(".btn-confirm-order").hide();
        
        <?php if($onlinePaymentAccount->stripe_publish_key != '' && $onlinePaymentAccount->stripe_secret_key != ''){ ?>
            $(".btn-pay-stripe").show();
        <?php } ?>

        <?php if($onlinePaymentAccount->paypal_client_id != '' && $onlinePaymentAccount->paypal_client_secret != ''){ ?>
            // Render the PayPal button into #paypal-button-container
            paypal.Buttons({
                style: {
                    layout: 'horizontal',
                    tagline: false,
                    height:45,
                    color:'blue'
                },
                // Set up the transaction
                createOrder: function(data, actions) {
                    return actions.order.create({                
                        purchase_units: [{
                            amount: {
                                value: $("#total_amount").val()
                            }
                        }],
                        application_context: {
                            shipping_preference: 'NO_SHIPPING'
                        }
                    });
                },
                // Finalize the transaction
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        // Show a success message to the buyer
                        //console.log(details);
                        updateJobToPaid();       
                    });
                }
            }).render('#paypal-button-container');
        <?php } ?>

    <?php } ?>
  });

    //Converge
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
                  //initiateApplePay(o.token);
                  openLightbox(o.token);                  
              }else{
                Swal.fire({
                  icon: 'error',
                  title: 'Cannot Process Payment',
                  text: o.msg
                });
              }

              $(".btn-pay-converge").html('PAY NOW');
           }
        });
      }, 1000);
    }

    function initiateApplePay(token){
        var paymentFields = {
            ssl_txn_auth_token: token
        };
        var callback = {
            onError: function (error) {
                //showResult("error", error);
                Swal.fire({
                  icon: 'error',
                  title: 'Declined',
                  text: 'Apple Pay not available'
                });
            },
            onCancelled: function () {
                //showResult("cancelled", "");
            },
            onDeclined: function (response) {
                //showResult("declined", JSON.stringify(response, null, '\t'));
            },
            onApproval: function (response) {
                //showResult("approval", JSON.stringify(response, null, '\t'));
            }
        };
        ConvergeEmbeddedPayment.initApplePay('applepay-button', paymentFields, callback);
        return false;
    }

    function openLightbox (token) {
      var paymentFields = {
              ssl_txn_auth_token: token
      };
      var callback = {
          onError: function (error) {
              //showResult("error", error);
              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error
              });
          },
          onCancelled: function () {
              //showResult("cancelled", "");
          },
          onDeclined: function (response) {
            Swal.fire({
              icon: 'error',
              title: 'Declined',
              text: 'Cannot process payment'
            });
            //showResult("declined", JSON.stringify(response, null, '\t'));
            //updateJobToPaid();
          },
          onApproval: function (response) {              
              updateJobToPaid();
              //showResult("approval", JSON.stringify(response, null, '\t'));
          }
      };
      PayWithConverge.open(paymentFields, callback);

      return false;
    }
    /*End Converge*/

    //Stripe Payment
    <?php if($onlinePaymentAccount->stripe_publish_key != '' && $onlinePaymentAccount->stripe_secret_key != ''){ ?>    
        var handler = StripeCheckout.configure({
            key: '<?= $onlinePaymentAccount->stripe_publish_key; ?>',
            image: '',
            token: function(token) {
              updateJobToPaid();                  
            }
        });

        $('.btn-pay-stripe').on('click', function(e) {
        var amountInCents = Math.floor($("#total_amount").val() * 100);
        var displayAmount = parseFloat(Math.floor($("#total_amount").val() * 100) / 100).toFixed(2);
        // Open Checkout with further options
        handler.open({
            image : '<?= base_url('/uploads/users/business_profile/'.$company_info->id.'/'.$company_info->business_image); ?>',
            name: $("#job-number").val(),
            description: 'Total amount ($' + displayAmount + ')',
            amount: amountInCents,
        });
        e.preventDefault();
        });

        // Close Checkout on page navigation
        $(window).on('popstate', function() {
        handler.close();
        });
    <?php } ?>
  /*End Stripe Payment*/

    //Paypal
    <?php if($onlinePaymentAccount->paypal_client_id != '' && $onlinePaymentAccount->paypal_client_secret != ''){ ?>
        
    <?php } ?>
    /*End paypal*/
});
</script>
