'[]
''
'
'<?php include viewPath('v2/includes/header'); ?>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('job/add_new_job_tag'); ?>'"> <i class='bx bx-tag'></i> </div>
</div>.
0.

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
    <input type="hidden" name="jobs_id" value="<?= $jobs_data->id; ?>">
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
                                            <input type="text" class="form-control" name="first_name" id="first_name" value="<?= $profile_info->first_name; ?>" readonly/> 
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
                                                <input readonly type="text" class="form-control input_select" name="amount" value="<?= number_format((float)$jobs_data->total_amount,2,'.',','); ?>"> 
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
                                            <input type="text" class="form-control" name="account_name" id="account_name" value="<?= isset($jobs_data ) ?  $jobs_data->first_name .' '. $jobs_data->last_name : '' ?>" /> 
                                        </div>
                                        <div class="col-sm-6 mb-3 CREDIT_CARD">
                                            <label>Card Number</label>
                                            <input type="text" class="form-control" name="card_number" id="card_number" value="<?php if(isset($billing_info ) && $billing_info->credit_card_num != 0){ echo $billing_info->credit_card_num; } ?>" /> 
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
                                            <input type="text" class="form-control" name="routing_number" id="routing_number" value="<?php if(isset($billing_info ) && $billing_info->credit_card_num != 0){ echo $billing_info->credit_card_num; } ?>" />
                                        </div>
                                        <div class="col-sm-6 mb-3 ACH">
                                            <label>Account Number</label>
                                            <input type="text" class="form-control" name="account_number" id="account_numbe" value="<?php if(isset($billing_info ) && $billing_info->credit_card_num != 0){ echo $billing_info->credit_card_num; } ?>" />
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
                                            <input type="text" class="form-control" name="account_credential" id="account_credential" value="<?= isset($billing_info) ? $billing_info->account_credential : ''; ?>" />
                                        </div>
                                        <div class="col-sm-6 mb-3 VENMO">
                                            <label>Account Note</label>
                                            <input type="text" class="form-control" name="account_note" id="account_note" value="<?= isset($billing_info) ? $billing_info->account_note : ''; ?>"/>
                                        </div>
                                        <div class="col-sm-12 mb-3 VENMO VENMO_CONFIRMATION">
                                            <label>Confirmation</label>
                                            <input type="number" class="form-control" name="confirmation" id="confirmation" value="<?= isset($billing_info) ? $billing_info->confirmation : ''; ?>"/>
                                        </div>
                                        <div class="col-sm-12 mb-3 PAYPAL">
                                            <div id="paypal-button-container"></div>
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
                                                <button type="submit" class="nsm-button primary" id="btn-billing-pay-now">Pay Now</button>
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
                                        <div class="col-sm-12 mb-2"></div>
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
<script src="https://www.paypal.com/sdk/js?client-id=AR9qwimIa4-1uYwa5ySNmzFnfZOJ-RQ2LaGdnUsfqdLQDV-ldcniSVG9uNnlVqDSj_ckrKSDmMIIuL-M&currency=USD"></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
<?php include viewPath('job/js/job_billing_js'); ?>
<script>
    $(function() {
        $("#MODE_OF_PAYMENT").select2({
            placeholder: "Select Payment type..."
        });
    });
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
                        given_name: 'Testing Paypal'
                    },
                },
                purchase_units: [{
                    amount: {
                        value: '0.01'
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
                console.log(details);
                var tokenRequest = {
                    id: "<?= $this->uri->segment(3) ?>",
                    stat: 'Completed'
                };
                //$("#payment-method").val('paypal');
                $.post("<?= base_url() ?>job/on_update_status", tokenRequest, function(data) {
                    paid('Nice!', 'Thank you for your payment!', 'success')
                });
                //$("#payment-method-status").val(details.status);
                //activate_registration();
            });
        }
    }).render('#paypal-button-container');
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
<?php include viewPath('v2/includes/footer'); ?>