<style>
.job-label{
    background-color: #cccccc;
}
.job-description{
    font-size: 12px;
    margin-bottom: 2px;
}
.mobile-title-border{
    background-color: #cccccc;
    padding: 5px;
}
.row-total{
    padding-top: 1px !important;
    padding-bottom: 1px !important;
    font-weight: bold;
}
.btn-mobile{
    font-size: 12px;
    padding: 7px;
    width: 100%;
    text-align: left;
    margin: 2px !important;
}
</style>
<div class="container">
    <br class="clear"/>
    <div class="row">
        <div class="col-12">
            <div class="card">                
                <div class="card-body" style="padding:1.25rem 1.25rem 0 1.25rem !important;">
                    <div class="row mt-3">
                        <div class="col-12" style="padding-left: 2px;">
                            <?php if($company_info->business_image != "" ): ?>
                                <img style="width: 100px" id="attachment-image" alt="Attachment" src="<?= base_url('/uploads/users/business_profile/'.$company_info->id.'/'.$company_info->business_image); ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row mt-3 job-description">
                        <div class="col-5 job-label">Job Number</div>
                        <div class="col-7"><b><?= $jobs_data->job_number; ?></b></div>
                    </div>
                    <div class="row job-description">
                        <div class="col-5 job-label">Job Type</div>
                        <div class="col-7"><?= $jobs_data->job_type; ?></div>
                    </div>
                    <div class="row job-description">
                        <div class="col-5 job-label">Job Tags</div>
                        <div class="col-7"><?= $jobs_data->tags; ?></div>
                    </div>
                    <div class="row job-description">
                        <div class="col-5 job-label">Date</div>
                        <div class="col-7"><?= isset($jobs_data) ?  date('F d, Y', strtotime($jobs_data->start_date)) : '';  ?></div>
                    </div>
                    <div class="row job-description">
                        <div class="col-5 job-label">Priority</div>
                        <div class="col-7"><?= $jobs_data->priority; ?></div>
                    </div>
                    <div class="row job-description">
                        <div class="col-5 job-label">Status</div>
                        <div class="col-7"><?= $jobs_data->status; ?></div>                        
                    </div>
                    <div class="row mt-2">
                        <div class="col-12" style="padding-left: 0px;">
                            <h6 class="mobile-title-border">FROM :</h6>
                            <div class="row">
                                <div class="col-12">
                                    <b><?= $company_info->business_name; ?></b><br>
                                    <span><?= $company_info->street; ?></span><br>
                                    <span><?= $company_info->city.', '.$company_info->state.' '.$company_info->postal_code ; ?></span><br>
                                    <span> Phone: <?= formatPhoneNumber($company_info->business_phone); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-12" style="padding-left: 0px;">
                            <h6 class="mobile-title-border">TO :</h6>
                            <div class="row">
                                <div class="col-12">
                                    <b><?= $jobs_data->first_name.' '.$jobs_data->last_name; ?></b><br>
                                    <span><?= $jobs_data->mail_add; ?></span><br>
                                    <span><?= $jobs_data->cust_city.', '.$jobs_data->cust_state.' '.$jobs_data->cust_zip_code ; ?></span><br>
                                    <span>Email: <?= $jobs_data->cust_email ; ?></span> <a href="mailto:<?= $jobs_data->cust_email ; ?>"></a>
                                    <?php if($jobs_data->phone_h!="" || $jobs_data->phone_h!=NULL): ?>
                                        <br>
                                        <span>Phone:  </span>
                                        <?= formatPhoneNumber($jobs_data->phone_h);  ?>
                                    <?php endif; ?>
                                    <?php if($jobs_data->phone_m!="" || $jobs_data->phone_m!=NULL): ?>
                                        <br>
                                        <span>Mobile: </span>
                                        <?= formatPhoneNumber($jobs_data->phone_m);  ?>
                                    <?php //else : echo 'N/A';?>
                                    <?php endif; ?>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-12" style="padding-left: 0px;">                        
                            <h6 class="mobile-title-border">ITEMS :</h6>
                            <table class="table" style="font-size:10px;">
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
                                    $total = ($item->cost * $item->qty);
                                    ?>
                                    <tr>
                                        <td><?= $item->title; ?></td>
                                        <td><?= $item->qty; ?></td>
                                        <td>$<?= $item->cost; ?></td>
                                        <td>$<?= number_format((float)$total,2,'.',','); ?></td>
                                    </tr>
                                    <?php
                                    $subtotal = $subtotal + $total;
                                endforeach;
                                ?>
                                <tr>
                                    <td colspan="3" class="row-total">Sub Total</td>
                                    <td class="row-total">$<?= number_format((float)$subtotal,2,'.',','); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="row-total">Tax Amount</td>
                                    <td class="row-total">$<?= number_format((float)$jobs_data->tax_rate,2,'.',','); ?></td>
                                </tr>
                                <?php if( $estimate_deposit_amount > 0 ){ ?>
                                <tr>
                                    <td colspan="3" class="row-total">Deposit Amount Paid</td>
                                    <td class="row-total">$<?= number_format((float)$estimate_deposit_amount,2,'.',','); ?></td>
                                </tr>
                                <?php } ?>
                                <?php 
                                    if($jobs_data->tax == NULL){
                                        $jobs_data->tax = 0;
                                    }
                                ?>
                                <tr>
                                    <td colspan="3" class="row-total">Tax</td>
                                    <td class="row-total">$<?= number_format($jobs_data->tax,2,'.',','); ?></td>
                                </tr>
                                <?php 
                                    if($jobs_data->discount == NULL){
                                        $jobs_data->discount = 0;
                                    }
                                ?>
                                <tr>
                                    <td colspan="3" class="row-total">Discount</td>
                                    <td class="row-total">$<?= number_format($jobs_data->discount,2,'.',','); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="row-total"><b>Grand Total</b></td>
                                    <td class="row-total">$<?= number_format((float)$grand_total,2,'.',','); ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12" style="padding-left: 0px;">                        
                            <h6 class="mobile-title-border">NOTES :</h6>
                            <span><?=  $jobs_data->message; ?></span>
                        </div>
                    </div>                    
                    <div class="row mt-3">
                        <div class="col-md-12" style="padding:2px;">
                            <span style="font-weight: 700;font-size: 20px;color: darkred;">Total : $<?= number_format((float)$grand_total,2,'.',','); ?></span>                                    
                            <!-- <input type="hidden" id="total_amount" value="<?= $jobs_data->total_amount; ?>"> -->
                            <input type="hidden" id="total_amount" value="<?= $grand_total; ?>">                            
                            <?php if($jobs_data->status != 'Completed'){ ?>
                                <?php echo form_open_multipart(null, ['class' => 'form-validate', 'id' => 'payment-job-invoice', 'autocomplete' => 'off']); ?>
                                <input type="hidden" id="jobid" name="jobid" value="<?= $jobs_data->job_unique_id; ?>">
                                <div class="payment-msg"></div>
                                <div class="payment-api-container" <?= $jobs_data->total_amount <= 0 ? 'style="display:none;"' : ''; ?>>
                                  <?php if($onlinePaymentAccount){ ?>
                                    <a class="btn btn-mobile btn-primary btn-confirm-order btn-pay" href="javascript:void(0);">CONFIRM ORDER</a>

                                    <?php if($onlinePaymentAccount->converge_merchant_user_id != '' && $onlinePaymentAccount->converge_merchant_pin != ''){ ?>
                                      <input type="hidden" id="converge-token" name="converge_token" value="" />
                                      <a class="btn btn-mobile btn-primary btn-pay-converge btn-pay" href="javascript:void(0);" style="display:none;">PAY VIA CONVERGE</a>
                                      <?php if( isApple() ){ ?>
                                        <div id="applepay-button" class="apple-pay-button" style="display:none;"></div>
                                      <?php } ?>
                                    <?php } ?>

                                    <?php if($braintree_token != ''){ ?>
                                        <a class="btn btn-mobile btn-primary btn-pay-braintree btn-pay" href="javascript:void(0);" style="display:none;">PAY VIA BRAINTREE</a>
                                    <?php } ?>

                                    <?php if($onlinePaymentAccount->stripe_publish_key != '' && $onlinePaymentAccount->stripe_secret_key != ''){ ?>
                                        <a class="btn btn-mobile btn-primary btn-pay-stripe btn-pay" href="javascript:void(0);" style="display:none;">PAY VIA STRIPE</a>
                                    <?php } ?>

                                    <?php if($onlinePaymentAccount->paypal_client_id != '' && $onlinePaymentAccount->paypal_client_secret != ''){ ?>
                                      <div id="paypal-button-container" style="display: inline-block;height: 44px;"></div>
                                    <?php } ?>
                                  <?php } ?>

                                </div>
                                <?php if($braintree_token != ''){ ?>
                                <div class="braintree-form" style="display:none;">
                                        <input id="nonce" name="payment_method_nonce" type="hidden" />
                                        <div id="bt-dropin"></div>  
                                        <a class="cancel-braintree btn btn-primary" href="javascript:void(0);">Back</a>       
                                        <button type="submit" class="btn btn-primary" id="btn-billing-pay-now">Pay Now</button> 
                                </div>
                                <?php } ?>
                                <?php echo form_close(); ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>