<link href="<?php echo $url->assets ?>dashboard/css/bootstrap.min.css" rel="stylesheet" type="text/css">

<div style="padding:5% 20%;">
    <div class="row" id="plansItemDiv">
        <div class="col-md-12 table-responsive">
                <table class="table table-hover">
                                        <input type="hidden" name="count" value="0" id="count">
                                        <thead>
                                        <tr style="background-color:#E8E9E8;">
                                            <th><b>Item</b></th>
                                            <th width="" id="qty_type_value"><b>Quantity</b></th>
                                            <th width=""><b>Price</b></th>
                                            <th width=""><b>Discount</b></th>
                                            <th><b>Tax(%)</b></th>
                                            <th><b>Total</b></th>
                                        </tr>
                                        </thead>
                <tbody id="table_body">
                <?php $total_tax = 0; ?>
                <?php foreach ($items as $item ) { ?>
                                                        <tr class="table-items__tr">
                                                            <td valign="top">
                                                                <?php //echo $value['item'] 
                                                                echo $item->title; ?>
                                                            </td>
                                                            <td>
                                                                <?php //echo $value['quantity'] 
                                                                echo $item->qty;?>                    
                                                            </td>
                                                            <td>
                                                                $ <?php //echo number_format($value['price'], 2, '.', ',') 
                                                                echo number_format($item->costing, 2); ?>                    
                                                            </td>
                                                            <td>
                                                                <!-- $0.00                     -->
                                                                $ <?php echo number_format($item->discount, 2); ?>
                                                            </td>
                                                            <td>
                                                                <!-- $<?php //echo number_format($value['tax'], 2, '.', ',') ?> <br> (7.5%)  -->
                                                                <?php //$total_tax += floatval($value['tax']); ?>      
                                                                $<?php echo number_format($item->tax, 2); ?>             
                                                            </td>
                                                            <td>
                                                                $ <?php //echo number_format($value['total'], 2, '.', ',') ?>   
                                                                <?php echo number_format($item->total, 2); ?>                 
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                </tbody>
            </table>
            <!-- <div class="row">
                <a class="link-modal-open pt-1 pl-2" href="javascript:void(0)" id="add_another_invoice"><span
                            class="fa fa-plus-square fa-margin-right"></span>Add Items</a>
                <hr style="display:inline-block; width:91%">
            </div> -->
            <div class="row" style="background-color:white;font-size:16px;">
                                        <div class="col-md-7">
                                        </div>
                                        <div class="col-md-5">
                                            <table class="table table_mobile" style="text-align:left;">
                                                <tr>
                                                    <td>Subtotal</td>
                                                    <!-- <td></td> -->
                                                    <td colspan="2" align="right">$ <span id="span_sub_total_invoice"><?php echo $invoice->sub_total; ?></span>
                                                        <input type="hidden" name="subtotal" id="item_total" value="<?php echo $invoice->sub_total; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td>Taxes</td>
                                                    <!-- <td></td> -->
                                                    <td colspan="2" align="right">$ <span id="total_tax_"><?php echo $invoice->taxes; ?></span><input type="hidden" name="taxes" id="total_tax_input" value="<?php echo $invoice->taxes; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:;"><input type="text" name="adjustment_name" id="adjustment_name" value="<?php echo $invoice->adjustment_name; ?>" placeholder="Adjustment Name" class="form-control" style="width:; display:inline; border: 1px dashed #d1d1d1"></td>
                                                    <td align="center">
                                                    <input type="number" name="adjustment_value" id="adjustment_input" value="<?php echo $invoice->adjustment_value; ?>" class="form-control adjustment_input" style="width:50%;display:inline;">
                                                        <span class="fa fa-question-circle" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Optional it allows you to adjust the total amount Eg. +10 or -10." data-original-title="" title=""></span>
                                                    </td>
                                                    <td>$ <span id="adjustmentText"><?php echo $invoice->adjustment_value; ?></span></td>
                                                </tr>
                                                <!-- <tr>
                                                    <td>Markup $<span id="span_markup"></td> -->
                                                    <!-- <td><a href="#" data-toggle="modal" data-target="#modalSetMarkup" style="color:#02A32C;">set markup</a></td> -->
                                                    <input type="hidden" name="markup_input_form" id="markup_input_form" class="markup_input" value="0">
                                                <!-- </tr> -->
                                                <tr id="saved" style="color:green;font-weight:bold;display:none;">
                                                    <td>Amount Saved</td>
                                                    <td></td>
                                                    <td><span id="offer_cost">0.00</span><input type="hidden" name="voucher_value" id="offer_cost_input"></td>
                                                </tr>
                                                <tr style="color:blue;font-weight:bold;font-size:16px;">
                                                    <td><b>Grand Total ($)</b></td>
                                                    <td></td>
                                                    <td><b><span id="grand_total"><?php echo $invoice->grand_total; ?></span>
                                                        <input type="hidden" name="grand_total" id="grand_total_input" value="<?php echo $invoice->grand_total; ?>"></b></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
        </div>
    </div>

    <input type="hidden" id="jobid" name="jobid" value="<?= $invoice->id; ?>">
    <input type="hidden" id="total_amount" value="<?= $invoice->grand_total; ?>">
    <!-- <div class="row">
        <div class="col-md-12">
            <h5>Payment Options</h5>
            <span class="help help-sm help-block">Select type of payment you're comfortable.</span>
        </div>
        <div class="col-md-4 form-group">
            <select name="deposit_request" class="form-control">
                <option value="1" selected="selected">Stripe</option>
                <option value="2">Paypal</option>
            </select>
        </div>
        <div class="col-md-12">
            <label class="float-left mini-stat-img mr-4">Accept Credit Cards</label>
            <div class="float-left mini-stat-img mr-4"><img src="<?php echo $url->assets ?>frontend/images/credit_cards.png" alt=""></div>
        </div>
    </div> -->
    <br>
    <!-- <button type="submit" class="btn btn-primary">Pay Now</button> -->
    <div class="payment-api-container">
                                                                      <a class="btn btn-primary btn-confirm-order btn-pay" href="javascript:void(0);">CONFIRM ORDER</a>

                                                                          <input type="hidden" id="converge-token" name="converge_token" value="">
                                      <a class="btn btn-primary btn-pay-converge btn-pay" href="javascript:void(0);" style="display:none;">PAY VIA CONVERGE</a>
                                                                          
                                                                            <a class="btn btn-primary btn-pay-braintree btn-pay" href="javascript:void(0);" style="display:none;">PAY VIA BRAINTREE</a>
                                    
                                                                            <a class="btn btn-primary btn-pay-stripe btn-pay" href="javascript:void(0);" style="display:none;">PAY VIA STRIPE</a>
                                    
                                                                      
                                </div>
</div>

<?php if($onlinePaymentAccount->stripe_publish_key != '' && $onlinePaymentAccount->stripe_secret_key != ''){ ?>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://checkout.stripe.com/checkout.js"></script>    
<?php } ?>
<?php if($onlinePaymentAccount->paypal_client_id != '' && $onlinePaymentAccount->paypal_client_secret != ''){ ?>
<script src="https://www.paypal.com/sdk/js?client-id=<?= $onlinePaymentAccount->paypal_client_id; ?>&currency=USD"></script>
<?php } ?>
<?php if($braintree_token != ''){ ?>
<script src="https://js.braintreegateway.com/web/dropin/1.36.0/js/dropin.min.js"></script>
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
<?php 
function frontIsMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

// if( frontIsMobile() ){
//     // include_once('job_customer_invoice_view_content_mobile.php');
//     include viewPath('pages/job_customer_invoice_view_content_mobile'); 
// }else{
//     // include_once('job_customer_invoice_view_content_desktop.php');
//     include viewPath('pages/job_customer_invoice_view_content_desktop'); 
// }
?>

<?php include viewPath('includes/footer_pages'); ?>
<script>
$(function(){
  function updateJobToPaid(payment_method){
    var job_id = $("#jobid").val();
    var url = base_url + '_update_job_status_paid';
    $.ajax({
       type: "POST",
       url: url,
       dataType: "json",
       data: {job_id:job_id,payment_method:payment_method},
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

  $('.btn-pay-braintree').click(function(){
    $('.braintree-form').show();
    $('.payment-api-container').hide();
  });

  $('.cancel-braintree').click(function(){
    $('.braintree-form').hide();
    $('.payment-api-container').show();
  });

  $('.btn-confirm-order').click(function(){
    var job_id = $("#jobid").val();
    var total_amount = $("#total_amount").val();
    <?php if($onlinePaymentAccount->converge_merchant_user_id != '' && $onlinePaymentAccount->converge_merchant_pin != ''){ ?>
        // alert('if');
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

                        <?php if($braintree_token != ''){ ?>
                            $(".btn-pay-braintree").show();
                        <?php } ?>

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
                                        updateJobToPaid('converge');       
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
        // alert('else');
        $(".btn-confirm-order").hide();
        
        <?php if($onlinePaymentAccount->stripe_publish_key != '' && $onlinePaymentAccount->stripe_secret_key != ''){ ?>
            $(".btn-pay-stripe").show();
        <?php } ?>

        <?php if($braintree_token != ''){ ?>
            $(".btn-pay-braintree").show();
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
    /*Braintree Payment*/
    <?php if($braintree_token != ''){ ?>
        var form = document.querySelector('#payment-job-invoice');
        var client_token = "<?= $braintree_token; ?>";

        braintree.dropin.create({
          authorization: client_token,
          selector: '#bt-dropin',          
        }, function (createErr, instance) {
          if (createErr) {
            console.log('Create Error', createErr);
            return;
          }
          form.addEventListener('submit', function (event) {
            event.preventDefault();

            instance.requestPaymentMethod(function (err, payload) {
              if (err) {
                console.log('Request Payment Method Error', err);
                return;
              }

              // Add the nonce to the form and submit
              document.querySelector('#nonce').value = payload.nonce;

              //form.submit();

              //var url = form.attr('action');   
                var nonce = payload.nonce;           
                var jobid = $('#jobid').val();
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>_braintree_process_payment",
                    data: {jobid:jobid, nonce:nonce},
                    dataType: 'json',
                    success: function(o) {                    
                        if(o.is_success === 1){
                            $('.braintree-form').hide();
                            updateJobToPaid();
                        }else{
                            Swal.fire({
                                title: 'Error!',
                                text: o.msg,
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonColor: '#32243d',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                
                            });
                        }

                        $("#btn-billing-pay-now").html('Pay Now');
                    },beforeSend: function() {
                        $("#btn-billing-pay-now").html('<span class="spinner-border spinner-border-sm m-0"></span>');
                    }
                }); 
            });
          });
        });
    <?php } ?>        
    /*End Braintree Payment*/

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