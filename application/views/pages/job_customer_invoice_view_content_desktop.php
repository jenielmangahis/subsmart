<div class="container">
    <br class="clear"/>
    <div class="row">
        <div class="col-12">
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
                                    <td align="right" ><?= $jobs_data->tags;  ?></td>
                                </tr>
                                <tr>
                                    <td align="right"><?= isset($jobs_data) ?  date('F d, Y', strtotime($jobs_data->start_date)) : '';  ?></td>
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
                                <span> Phone: <?= formatPhoneNumber($company_info->business_phone); ?></span>
                            </div>
                            <div class="col-md-6">
                                <br>
                                <h6 class="title-border">TO :</h6>
                                <div class="row">
                                    <div class="col-md-12">
                                        <b><?= $jobs_data->first_name.' '.$jobs_data->last_name; ?></b><br>
                                        <span><?= $jobs_data->mail_add; ?></span><br>
                                        <span><?= $jobs_data->cust_city.', '.$jobs_data->cust_state.' '.$jobs_data->cust_zip_code ; ?></span><br>
                                        <span>Email: <?= $jobs_data->cust_email ; ?></span> <a href="mailto:<?= $jobs_data->cust_email ; ?>"></a>                                        
                                        <?php //if($jobs_data->phone_m!="" || $jobs_data->phone_m!=NULL): ?>
                                            <br>
                                            <span>Phone: </span>
                                            <?= formatPhoneNumber($jobs_data->phone_m);  ?>
                                        <?php //else : echo 'N/A';?>
                                        <?php //endif; ?>
                                        <br>
                                    </div>
                                </div>
                            </div>

                        <div class="col-md-12" style="margin-top:30px;">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <td colspan="5" style="background-color:#6a4a86;color:#ffffff;padding:7px;"><span style="font-size:16px;">JOB DETAILS</span></td>
                                </tr>
                                <tr>
                                    <td>Item</td>
                                    <td style="text-align:center;">Qty</td>
                                    <td style="text-align:center;">Price</td>
                                    <td style="text-align:center;">Tax</td>
                                    <td style="text-align:center;">Total</td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $subtotal = 0.00;
                                $total_tax = 0;
                                foreach ($jobs_data_items as $item):
                                    //$total = ($item->cost * $item->qty);
                                    $total = $item->cost;
                                    ?>
                                    <tr>
                                        <td><?= $item->job_item_name; ?></td>
                                        <td><?= $item->qty; ?></td>
                                        <td style="text-align:right;">$<?= $item->cost / $item->qty; ?></td>
                                        <td style="text-align:right;">$<?= number_format((float)$item->tax,2,'.',','); ?></td>
                                        <td style="text-align:right;">$<?= number_format((float)$total,2,'.',','); ?></td>
                                    </tr>
                                    <?php
                                    $subtotal = $subtotal + $total;
                                    $total_tax = $total_tax + (float)$item->tax;
                                endforeach;
                                ?>
                                </tbody>
                            </table>
                            <hr>
                            <b>Sub Total</b>
                            <b class="right-text">$<?= number_format((float)$subtotal,2,'.',','); ?></b>
                            <br />
                            <b>Tax Amount</b>
                            <b class="right-text">$<?= number_format((float)$total_tax,2,'.',','); ?></b>
                            <br />
                            <?php if( $estimate_deposit_amount > 0 ){ ?>
                            <b>Deposit Amount Paid</b>
                            <b class="right-text">$<?= number_format((float)$estimate_deposit_amount,2,'.',','); ?></b>
                            <?php } ?>
                            <br><hr>
                            <?php 
                                //$grand_total = ($subtotal + $jobs_data->tax_rate) - $estimate_deposit_amount;
                                $grand_total = ($subtotal + $total_tax) - $estimate_deposit_amount;
                            ?>

                            <?php if($jobs_data->tax != NULL): ?>
                                <!-- <b>Tax </b>
                                <i class="right-text">$0.00</i>
                                <br><hr> -->
                            <?php endif; ?>

                            <?php if($jobs_data->discount != NULL): ?>
                                <b>Discount </b>
                                <i class="right-text">$0.00</i>
                                <br><hr>
                            <?php endif; ?>

                            <b>Grand Total</b>
                            <b class="right-text">$<?= number_format((float)$grand_total,2,'.',','); ?></b>
                        </div>
                        <div class="col-md-4">
                            <br>
                            <h6 class="title-border">NOTES :</h6>
                            <span><?=  $jobs_data->message; ?></span>
                        </div>
                        <div class="col-md-12">
                            <h6 class="title-border"></h6>
                            <span style="font-weight: 700;font-size: 20px;color: darkred;" class="form-total-amount-label">Total : $<?= number_format((float)$grand_total,2,'.',','); ?></span>                                    
                            <!-- <input type="hidden" id="total_amount" value="<?= $jobs_data->total_amount; ?>"> -->
                            <input type="hidden" id="total_amount" value="<?= $grand_total; ?>">
                            <br /><br />
                            <?php if($jobs_data->status != 'Completed'){ ?>
                                <?php echo form_open_multipart(null, ['class' => 'form-validate', 'id' => 'payment-job-invoice', 'autocomplete' => 'off']); ?>
                                <input type="hidden" id="jobid" name="jobid" value="<?= $jobs_data->job_unique_id; ?>">
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

                                    <?php if($onlinePaymentAccount->square_access_token != '' && $onlinePaymentAccount->square_refresh_token != ''){ ?>
                                        <a class="btn btn-primary btn-pay-square btn-pay" href="javascript:void(0);" style="display:none;">PAY VIA SQUARE</a>
                                    <?php } ?>

                                    <?php if($braintree_token != ''){ ?>
                                        <a class="btn btn-primary btn-pay-braintree btn-pay" href="javascript:void(0);" style="display:none;">PAY VIA BRAINTREE</a>
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