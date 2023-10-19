<?php include viewPath('v2/includes/header'); ?>
<style>
.braintree-hosted-field {
  height: 32px !important;
}
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('job/add_new_job_tag'); ?>'"> <i class='bx bx-tag'></i> </div>
</div>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/sales_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/job_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class="bx bx-x"></i></button> Make it easy for your customers by offering additional ways to pay. The payments landscape is ever-changing. Simply select the payment method and hit the button to Save the payment. Each transaction will be saved in each customer history. 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form id="payment_info" method="post">
    <input type="hidden" name="jobs_id" id="job-id" value="<?= $jobs_data->id; ?>">
    <input type="hidden" id="total_amount" name="job_total_amount" value="<?= $job_total_amount; ?>">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="nsm-card primary">
                                <div class="nsm-card-header">
                                    <div class="right-text"><span class="page-title " style="font-weight: bold;font-size: 16px;"><i class='bx bxs-user'></i>&nbsp;Customer Information</span></div>
                                </div>
                                <hr>
                                <div class="nsm-card-body">
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <label>Firstname</label>
                                            <input type="text" class="form-control" name="first_name" id="first_name" value="<?= $profile_info->first_name; ?>" 
                                            <input type="text" class="form-control" name="first_name" id="first_name" value="readonly/> 
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <label>Lastname</label>
                                            <input type="text" class="form-control" name="last_name" id="last_name" value="<?=$profile_info->last_name; ?>" readonly/> 
                                        </div>
                                        <div class="col-sm-12">
                                            <hr>
                                        </div>
                                        <div class="col-sm-12 mb-2">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="mail_add" id="mail_add" value="<?=$profile_info->mail_add;?>" readonly/> 
                                        </div>
                                        <div class="col-sm-4 mb-2">
                                            <label>City</label>
                                            <input type="text" class="form-control" name="city" id="city" value="<?=$profile_info->city;?>" readonly/> 
                                        </div>
                                        <div class="col-sm-4 mb-2">
                                            <label>State</label>
                                            <input type="text" class="form-control" name="state" id="state" value="<?=$profile_info->state;?>" readonly/> 
                                        </div>
                                        <div class="col-sm-4 mb-2">
                                            <label>Zip</label>
                                            <input type="text" class="form-control" name="zip" id="zip" value="<?= $profile_info->zip_code;?>" readonly/> 
                                        </div>
                                        <div class="col-sm-12">
                                            <hr>
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" id="email" value="<?=$profile_info->email; ?>" readonly/> 
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <label>Phone</label>
                                            <input type="email" class="form-control" name="email" id="email" value="<?= $profile_info->phone_m; ?>" readonly/> 
                                        </div>
                                        <div class="col-sm-12">
                                            <hr>
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <label>Job Number</label>
                                            <input type="text" class="form-control" name="first_name" id="first_name" value="<?= $jobs_data->job_number; ?>" readonly/> 
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <label>Job Type</label>
                                            <input type="text" class="form-control" name="first_name" id="first_name" value="<?= $jobs_data->job_type; ?>" readonly/> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="nsm-card primary">
                                <div class="nsm-card-header">
                                    <div class="right-text"> <span class="page-title " style="font-weight: bold;font-size: 16px;"><i class='bx bxs-credit-card-front'></i>&nbsp;Payment Information</span></div>
                                </div>
                                <hr>
                                <div class="nsm-card-body">
                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <label>Mode of Payment</label>
                                            <select id="MODE_OF_PAYMENT" class="form-control" name="pay_method">
                                                <option selected value="CREDIT_CARD">Credit Card</option>
                                                <option value="CASH">Cash</option>
                                                <option value="CHECK">Check</option>
                                                <option value="ACH">ACH</option>
                                                <option value="VENMO">Venmo</option>
                                                <option value="PAYPAL">Paypal</option>
                                                <option value="STRIPE">Stripe</option>
                                                <option value="BRAINTREE">Braintree</option>
                                                <option value="SQUARE">Square</option>
                                                <option value="INVOICING">Invoicing</option>
                                                <option value="WARRANTY_WORK">Warranty Work</option>
                                                <option value="HOME_OWNER_FINANCING">Home Owner Financing</option>
                                                <!-- <option value="CREDIT_CARD">Other Credit Card Processor</option>
                                                <option value="OTHERS">Others</option> -->
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Amount to Pay</label>
                                            <div class="input-group mb-3"> <span class="input-group-text"><strong>$</strong></span>
                                                <input readonly type="text" class="form-control input_select" name="amount" value="<?= number_format((float)$job_total_amount,2,'.',','); ?>"> 
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <hr>
                                        </div>
                                        <div class="col-sm-12 mb-3 CASH">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="is_collected" value="1">
                                                <label class="form-check-label" for="flexCheckDefault">Payment has been collected.</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 mb-3 CHECK_NUMBER">
                                            <div class="form-check">
                                                <label>Check Number</label>
                                                <input type="text" class="form-control" name="chk_check_number" id="chk_check_number" value="" />
                                            </div>
                                        </div>
                                        <div class="col-sm-4 mb-3 CHECK_NUMBER">
                                            <div class="form-check">
                                                <label>Routing Number</label>
                                                <input type="text" class="form-control" name="chk_routing_number" id="chk_routing_number" value="" />
                                            </div>
                                        </div>
                                        <div class="col-sm-4 mb-3 CHECK_NUMBER">
                                            <div class="form-check">
                                                <label>Account Number</label>
                                                <input type="text" class="form-control" name="chk_account_number" id="chk_account_number" value="" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-3 CREDIT_CARD">
                                            <label>Account Holder Name</label>
                                            <input type="text" class="form-control" name="account_name" id="account_name" value="" /> 
                                        </div>
                                        <div class="col-sm-6 mb-3 CREDIT_CARD">
                                            <label>Card Number</label>
                                            <input type="text" class="form-control" name="card_number" id="card_number" value="" /> 
                                        </div>
                                        <div class="col-sm-12 mb-3 BRAINTREE">
                                            <?php if($braintree_token != ''){ ?>    
                                                <input id="nonce" name="payment_method_nonce" type="hidden" />
                                                <div id="bt-dropin"></div>                                     
                                            <?php }else{ ?>
                                                <div class="alert alert-danger" role="alert">
                                                  Your company doesn't have a valid braintree account. To setup your braintree account go to <a href="<?= base_url('tools/api_connectors') ?>">API Tools</a> and click Braintree
                                                </div>
                                            <?php } ?>

                                            <input id="nonce" name="payment_method_nonce" type="hidden" />
                                            <div id="bt-dropin"></div>
                                        </div>
                                        <div class="col-sm-12 mb-3 CREDIT_CARD">
                                            <label>Expiration</label>
                                            <div class="input-group">
                                                <select id="exp_month" name="card_mmyy" data-customer-source="dropdown" class="form-control input_select">
                                                    <option value selected hidden>- Select Month -</option>
                                                    <option value="01">01</option>
                                                    <option value="02">02</option>
                                                    <option value="03">03</option>
                                                    <option value="04">04</option>
                                                    <option value="05">05</option>
                                                    <option value="06">06</option>
                                                    <option value="07">07</option>
                                                    <option value="08">08</option>
                                                    <option value="09">09</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                </select>
                                                <select id="exp_year" name="exp_year" data-customer-source="dropdown" class="form-control input_select">
                                                    <option value selected hidden>- Select Year -</option>
                                                    <?php  
                                                        $start_year = date('Y'); 
                                                        $num_years  = 20;
                                                    ?>
                                                    <?php for($start = 0; $start <= $num_years; $start++){ ?>
                                                        <?= $year_value = date("Y", strtotime("+".$start." years")); ?>
                                                        <option value="<?= $year_value; ?>"><?= $year_value; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <input type="text" class="form-control" name="card_cvc" id="card_cvc" value="" placeholder="CVC" /> 
                                            </div>
                                        </div>
                                        <!-- <div class="col-sm-12 mb-3 CREDIT_CARD">
                                            <div class="form-check">
                                                <input type="checkbox" name="is_save_file" class="form-check-input" value="1" data-customize="open" id="onoff-customize">
                                                <label class="form-check-label" for="onoff-customize">Save card to File.</label>
                                            </div>
                                        </div> -->
                                        <div class="col-sm-6 mb-3 ACH">
                                            <label>Routing Number</label>
                                            <input type="text" class="form-control" name="routing_number" id="routing_number" value="" />
                                        </div>
                                        <div class="col-sm-6 mb-3 ACH">
                                            <label>Account Number</label>
                                            <input type="text" class="form-control" name="account_number" id="account_numbe" value="" />
                                        </div>
                                        <div class="col-sm-12 mb-3 ACH">
                                            <label>Day of Month</label>
                                            <select id="day_of_month_ach" name="day_of_month" class="form-control">
                                               <option value selected hidden>- Select Day -</option>
                                                <?php for($x=1;$x<=31;$x++){ ?>
                                                    <option value="<?= $x; ?>"><?= $x; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6 mb-3 VENMO">
                                            <label>Account Credential</label>
                                            <input type="text" class="form-control" name="account_credential" id="account_credential" value="" />
                                        </div>
                                        <div class="col-sm-6 mb-3 VENMO">
                                            <label>Account Note</label>
                                            <input type="text" class="form-control" name="account_note" id="account_note" value="" />
                                        </div>
                                        <div class="col-sm-12 mb-3 VENMO VENMO_CONFIRMATION">
                                            <label>Confirmation</label>
                                            <input type="number" class="form-control" name="confirmation" id="confirmation" value="" />
                                        </div>
                                        <div class="col-sm-12 mb-3 SQUARE">
                                            <div class="square-form">
                                                <div id="payment-form">                                                    
                                                    <div id="payment-status-container"></div>                        
                                                    <div id="card-container"></div>                                                        
                                                </div>
                                            </div>    
                                        </div>
                                        <div class="col-sm-12 mb-3 STRIPE">
                                            <?php if($companyOnlinePaymentAccount->stripe_publish_key != '' && $companyOnlinePaymentAccount->stripe_secret_key != ''){ ?>    
                                                <a class="nsm-button primary btn-pay-stripe btn-pay" href="javascript:void(0);">PAY VIA STRIPE</a>                                     
                                            <?php }else{ ?>
                                                <div class="alert alert-danger" role="alert">
                                                  Your company doesn't have a valid paypal account. To setup your paypal account go to <a href="<?= base_url('tools/api_connectors') ?>">API Tools</a> and click Paypal
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-sm-12 mb-3 PAYPAL">
                                            <?php if( $companyOnlinePaymentAccount->paypal_client_id != '' ){ ?>
                                                <div id="paypal-button-container"></div>
                                            <?php }else{ ?>
                                                <div class="alert alert-danger" role="alert">
                                                  Your company doesn't have a valid paypal account. To setup your paypal account go to <a href="<?= base_url('tools/api_connectors') ?>">API Tools</a> and click Paypal
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-sm-12 mb-3 INVOICING_FIELD">
                                            <label>Term</label>
                                            <select id="invoice_term" name="invoice_term" data-customer-source="dropdown" class="form-control" >
                                                <option  value="Due On Receipt">Due On Receipt</option>
                                                <option  value="Net 5">Net 5</option>
                                                <option  value="Net 10">Net 10</option>
                                                <option  value="Net 15">Net 15</option>
                                                <option  value="Net 30">Net 30</option>
                                                <option  value="Net 60">Net 60</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6 mb-3 INVOICING_FIELD">
                                            <label>Invoice Date</label>
                                            <input type="date" class="form-control" name="invoice_date" id="invoice_date" />
                                        </div>
                                        <div class="col-sm-6 mb-3 INVOICING_FIELD">
                                            <label>Due Date</label>
                                            <input type="date" class="form-control" name="invoice_due_date" id="invoice_due_date" />
                                        </div>
                                        <div class="col-sm-12 mb-3 DOCUMENT_SIGNED">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="is_document_signed" value="1" id="is_document_signed">
                                                <label class="form-check-label" for="is_document_signed">Document Signed.</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 mt-1 PAYMENT_BUTTON">
                                            <div class="float-end">
                                                <button class="nsm-button" onclick="window.location.replace('/job')">Cancel</button>
                                                <button id="square-card-button" class="nsm-button primary" type="button" style="display:none;">Pay Now</button>                                          
                                                <button id="btn-billing-pay-now" class="nsm-button primary" type="submit">Pay Now</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="nsm-card primary">
                                <div class="nsm-card-header">
                                    <div class="right-text"> <span class="page-title " style="font-weight: bold;font-size: 16px;"><i class='bx bxs-book-content'></i>&nbsp;Payment History</span></div>
                                </div>
                                <hr>
                                <div class="nsm-card-body">
                                    <div class="row">
                                        <div class="col-sm-12 mb-2">
                                            <div id="payment-history-container"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
</div>
<link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/javascript.util/0.12.12/javascript.util.min.js" type="text/javascript"></script>
<script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?= google_credentials()['api_key'] ?>&callback=initMap&libraries=&v=weekly"></script>
<?php if( $companyOnlinePaymentAccount->paypal_client_id != '' ){ ?>
    <script src="https://www.paypal.com/sdk/js?client-id=<?= $companyOnlinePaymentAccount->paypal_client_id; ?>&currency=USD"></script>
    <!-- <script src="https://www.paypal.com/sdk/js?client-id=AR9qwimIa4-1uYwa5ySNmzFnfZOJ-RQ2LaGdnUsfqdLQDV-ldcniSVG9uNnlVqDSj_ckrKSDmMIIuL-M&currency=USD"></script> -->
<?php } ?>
<?php if($companyOnlinePaymentAccount->square_access_token != '' && $companyOnlinePaymentAccount->square_refresh_token != ''){ ?>
    <link rel="stylesheet" href="/reference/sdks/web/static/styles/code-preview.css" preload>
    <script src="https://sandbox.web.squarecdn.com/v1/square.js"></script>
<?php } ?>
<?php if($companyOnlinePaymentAccount->stripe_publish_key != '' && $companyOnlinePaymentAccount->stripe_secret_key != ''){ ?>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://checkout.stripe.com/checkout.js"></script>    
<?php } ?>
<?php if($braintree_token != ''){ ?>
<script src="https://js.braintreegateway.com/web/dropin/1.36.0/js/dropin.min.js"></script>
<?php } ?>

<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
<?php include viewPath('job/js/job_billing_js'); ?>
<script>
    var company_name = '<?= $company_info->business_name; ?>';

    $(function() {
        $("#MODE_OF_PAYMENT").select2({
            placeholder: "Select Payment type..."
        });

        //load_job_payment_history();

        function load_job_payment_history(){
            var jobid = $('#job-id').val();
            var url   = base_url + 'job/_load_job_payments';

            $.ajax({
                type: 'POST',
                url: url,
                data: {jobid:jobid},
                success: function(result) {
                    $('#payment-history-container').html(result);
                },
            });
        }
    });

    //Paypal Payment
    <?php if( $companyOnlinePaymentAccount->paypal_client_id != '' ){ ?>
    paypal.Buttons({
        style: {
            //layout: 'horizontal',
            //tagline: false,
            //height:25,
            color: 'blue'
        },
        createOrder: function(data, actions) {
            return actions.order.create({
                payer: {
                    name: {
                        given_name: '<?= $profile_info->first_name; ?>',
                        surname : '<?= $profile_info->last_name; ?>'                        
                    },
                    email_address : '<?= $profile_info->email; ?>',
                    postal_codestring : '<?= $profile_info->zip_code; ?>'
                },
                purchase_units: [{
                    amount: {
                        value: '<?= $job_total_amount; ?>'
                    }
                }],
                application_context: {
                    shipping_preference: 'NO_SHIPPING'
                }
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                // Show a success message to the buyer
                //console.log(details);
                createJobPayment();
                /*var tokenRequest = {
                    id: "<?= $this->uri->segment(3) ?>",
                    stat: 'Completed'
                };                
                $.post("<?= base_url() ?>job/on_update_status", tokenRequest, function(data) {                    
                    paid('Nice!', 'Thank you for your payment!', 'success')
                });*/
                
            });
        }
    }).render('#paypal-button-container');
    <?php } ?>
    /*End Paypal Payment*/

    //Stripe Payment
    <?php if($companyOnlinePaymentAccount->stripe_publish_key != '' && $companyOnlinePaymentAccount->stripe_secret_key != ''){ ?>    
        var handler = StripeCheckout.configure({
            key: '<?= $companyOnlinePaymentAccount->stripe_publish_key; ?>',
            image: '',
            token: function(token) {
              createJobPayment();                  
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

    /*Braintree Payment*/
    <?php if($braintree_token != ''){ ?>
        var form = document.querySelector('#payment_info');
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
                var paymentForm = $('#payment_info');
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>job/update_payment_details",
                    data: paymentForm.serialize(), // serializes the form's elements.
                    dataType: 'json',
                    success: function(o) {                    
                        if(o.is_success === 1){
                            sucess();
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

    function createJobPayment(){
        var jobid = $('#job-id').val();
        var payment_method = $('#MODE_OF_PAYMENT').val();
        var url   = base_url + 'job/_create_job_payment';

        $.ajax({
            type: 'POST',
            url: url,
            data: {jobid:jobid,payment_method:payment_method},
            dataType:'json',
            success: function(result) {
                if( result.is_success == 1 ){
                    sucess();
                }else{
                    error();
                }
            },
        });
    }

    // This function displays Smart Payment Buttons on your web page.
    function paid($title, information, $icon) {
        Swal.fire({
            title: $title,
            text: information,
            icon: $icon,
            showCancelButton: false,
            confirmButtonColor: '#32243d',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if(result.value) {
                window.location.href = "<?= base_url() ?>job/new_job1/<?= $this->uri->segment(3) ?>";
            }
        });
    }
</script>
<?php if($companyOnlinePaymentAccount->square_access_token != '' && $companyOnlinePaymentAccount->square_refresh_token != ''){ ?>
<!-- Square Payment -->
<script type="module">
    const jobid = document.getElementById('job-id').value;
    const payments = Square.payments('<?= $square_client_id; ?>', '<?= $companyOnlinePaymentAccount->square_location_id; ?>');
    const card = await payments.card();
    await card.attach('#card-container');

    //Credit Card
    const cardButton = document.getElementById('square-card-button');
    cardButton.addEventListener('click', async () => {
      $('#square-card-button').html('<span class="spinner-border spinner-border-sm m-0"></span>');
      const statusContainer = document.getElementById('payment-status-container');      
      const source_type = 'CARD';
      try {
        const result = await card.tokenize();
        if (result.status === 'OK') {
            //console.log(`Payment token is ${result.token}`);
            const square_response = await fetch(base_url + `_square_process_payment`, {
                method: "POST",
                body: JSON.stringify({ token: result.token, jobid:jobid, source_type:source_type }),
                headers: {    
                    accepts: "application/json",                
                    "content-type": "application/json",
                },
            });    
            const data = await square_response.json();  
            if( data.is_success == 1 ){   
                $('#square-card-button').html('Pay Now');             
                $('.square-form').hide();
                Swal.fire({
                    title: 'Payment Successful',
                    text: 'Payment process completed.',
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#32243d',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    //if(result.value) {
                        window.location.href = "<?= base_url() ?>job/new_job1/<?= $this->uri->segment(3) ?>";
                    //}
                });     
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Cannot Process Payment',
                    text: data.msg
                });
            }   
        } else {
          let errorMessage = `Tokenization failed with status: ${result.status}`;
          if (result.errors) {
            errorMessage += ` and errors: ${JSON.stringify(
              result.errors
            )}`;
          }

          throw new Error(errorMessage);
        }
      } catch (e) {
        console.error(e);
        statusContainer.innerHTML = "Payment Failed";
      }
    });
  </script>
  <!-- End Square Payment -->
<?php } ?>
<?php include viewPath('v2/includes/footer'); ?>