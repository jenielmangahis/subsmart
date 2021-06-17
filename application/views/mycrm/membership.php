<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.input-group-prepend {
    height: 48px !important;
}
.form_line{
    margin-bottom: 10px;
}
.hide {
    display:none;
}
.plan{
    padding: 0px;
}
.card-type.visa {
    background-position: 0 0;
}
.card-type {
    display: inline-block;
    width: 30px;
    height: 20px;
    background: url(<?= base_url("/assets/img/credit_cards.png"); ?>) no-repeat 0 0;
    background-size: cover;
    vertical-align: middle;
    margin-right: 10px;
}
.card-type.americanexpress {
    background-position: -83px 0;
}
.expired-text{
    color: #fff;
    background-color: #dc3545;
    font-size: 12px;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/mycrm'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
    <div class="container-page">
    <div class="container-fluid">
<div class="row">
    <div class="col-md-12 col-lg-12">

<div class="row align-items-center" style="margin-top: 30px;">
  <div class="col-sm-12">
      <h3 class="page-title">Monthly Membership</h3>
  </div>
</div>
<div class="pl-3 pr-3 mt-1 row">
    <div class="col mb-4 left alert alert-warning mt-0 mb-2">
        <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Company plan subscription</span>
    </div>
</div>

<div class="card">
    <div class="row">
        <div class="col-md-6">
            <div class="plan">
                <strong>
                    <?= $client->is_trial == 1 ? 'Trial' : 'Paid'; ?> Membership
                    <?= $client->is_plan_active == 0 ? '<span class="expired-text badge badge-danger">(Expired)</span>' : ''; ?>
                </strong>
                <p class="margin-bottom">These are your current account options</p>

                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <div class="plan-option-box">
                            <span class="plan-option-box-header">Total Monthly</span>
                            <div class="plan-option-box-cnt">
                                <span class="plan-option-box-value">$<?= number_format($total_monthly,2); ?></span>
                                <span class="plan-option-box-name">For 1 month</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="plan-option-box">
                            <span class="plan-option-box-header" style="background: #909da7;">Membership</span>
                            <div class="plan-option-box-cnt">
                                <span class="plan-option-box-value">$<?= number_format($plan->price,2); ?></span>
                                <span class="plan-option-box-name">For 1 month</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="plan-option-box">
                            <span class="plan-option-box-header" style="background: #909da7;">Add-ons</span>
                            <div class="plan-option-box-cnt">
                                <span class="plan-option-box-value">$<?= number_format($total_addon_price, 2); ?></span>
                                <span class="plan-option-box-name">For 1 month</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <div class="plan-option-box" style="text-align: center;">   
                            <?php if($client->is_plan_active == 1){ ?>                         
                            <a class="btn btn-primary btn-upgrade-plan" href="javascript:void(0);" style="margin-bottom: 10px;">Upgrade Plan</a>                            
                            <?php } ?>
                            <a class="btn btn-primary btn-pay-subscription" href="javascript:void(0);" style="margin-bottom: 10px;">
                                <?php if($client->is_plan_active == 1){ ?>
                                    Pay Subscription
                                <?php }else{ ?>
                                    Renew Subscription
                                <?php } ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<hr class="card-hr">

<div class="card" id="plan-details">

    <div class="row">
        <div class="col-sm-6">

            <div class="row margin-bottom-sec">
                <div class="col-md-4">
                    <strong>Current Plan</strong>
                </div>
                <div class="col-md-5">
                    <?php if($client->is_trial == 1){ ?>
                        (Trial) <?= $plan->plan_name; ?> ($<?= number_format($plan->price,2); ?>)
                    <?php }else{ ?>
                        <?= $plan->plan_name; ?> ($<?= number_format($plan->price,2); ?>)
                    <?php } ?>                    
                </div>
            </div>
            <?php if($client->payment_method == 'offer code'){ ?>
                <div class="row margin-bottom-sec">
                    <div class="col-md-4">
                        <strong>Offer Code Used</strong>
                    </div>
                    <div class="col-md-5"><?= $offerCode->offer_code; ?></div>
                </div>
            <?php } ?>
            <div class="row margin-bottom-sec">
                <div class="col-md-4">
                    <strong>Billing Cycle</strong>
                </div>
                <div class="col-md-5">1 month</div>
            </div>
            <div class="row margin-bottom-sec">
                <div class="col-md-4">
                    <strong>Current Billing Period</strong>
                </div>
                <div class="col-md-5">
                    <?= $start_billing_period; ?> <span class="text-ter">&nbsp;to&nbsp;</span> <?= $end_billing_period; ?>
                </div>
            </div>
            <div class="row margin-bottom-sec">
                <div class="col-md-4">
                    <?php if($client->is_trial == 1){ ?>
                        <strong>Trial Ends</strong>
                    <?php }else{ ?>
                        <strong>Next Bill Date</strong>
                    <?php } ?>
                </div>
                <div class="col-md-5"><?= date("d-M-Y",strtotime($client->next_billing_date)); ?></div>
            </div>

            <div class="row margin-bottom-sec">
                <div class="col-md-4"><strong>Recurring Payments</strong></div>
                <div class="col-md-5">
                    <?php if($client->is_auto_renew == 1){ ?>
                        <span style="margin-right: 10px;">Active</span><a class="btn-deactivate-auto-renewal btn btn-sm btn-primary" href="javascript:void(0);">Deactivate</a>
                    <?php }else{ ?>
                        <span style="margin-right: 10px;">Inactive</span><a class="btn-activate-auto-renewal btn btn-sm btn-primary" href="javascript:void(0);">Activate</a>
                    <?php } ?>
                    <br><span class="text-ter">Auto renew your subscription and charge your card at the end of the billing cycle.</span>
                </div>
            </div>
            
        </div>
        <div class="col-sm-6">
            <div class="row margin-bottom-sec">
                <div class="col-md-4">
                    <strong>First Payment</strong>
                </div>
                <div class="col-md-5">
                    <?php 
                        if($client->is_trial == 1){ 
                            echo "---";
                        }else{
                            echo date("d-M-Y", strtotime($firstPayment->payment_date));    
                        }
                    ?>                    
                </div>
            </div>
            <div class="row margin-bottom-sec">
                <div class="col-md-4">
                    <strong>Last Payment</strong>
                </div>
                <div class="col-md-5">
                    <?php if($client->is_trial == 1){ ?>
                        ---
                    <?php }else{ ?>
                        $<?= number_format($lastPayment->total_amount,2); ?>
                        <span class="text-ter">on <?= date("d-M-Y", strtotime($lastPayment->payment_date)); ?></span> 
                        <a href="<?= url('mycrm/view_payment/' . $lastPayment->id); ?>">view</a>
                    <?php } ?>
                    
                </div>
            </div>
            <div class="row margin-bottom-sec">
                <div class="col-md-4">
                    <strong>Primary Card</strong>
                </div>

                <div class="col-md-7">
                    <?php if($primaryCard){ ?>
                        <?php 
                            $card_type = strtolower($primaryCard->cc_type); 
                            $card_type = str_replace(" ", "", $card_type);
                          ?>
                          <span class="card-type <?= $card_type; ?>"></span>                                       
                          <?php 
                            $card_number = maskCreditCardNumber($primaryCard->card_number);
                            echo $card_number;
                          ?>   
                          <?php
                            $today = date("y-m-d");  
                            $day   = date("d");                                 
                            $expires = date("y-m-d",strtotime($primaryCard->expiration_year . "-" . $primaryCard->expiration_month . "-" . $day));
                            $expired = 'expires';
                            if( strtotime($expires) < strtotime($today) ){
                              $expired = 'expired';
                            }
                            
                          ?>
                          <span class="<?= $expired; ?>"> (<?= $expired; ?> <?= $primaryCard->expiration_month . "/" . $primaryCard->expiration_year; ?>)</span>
                    <?php }else{ ?>
                        ---
                    <?php } ?>
                    <a href="<?= base_url("cards_file/list"); ?>" class="btn btn-sm btn-primary">manage card</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <h4>Availed Add-ons <a class="btn btn-sm btn-primary" href="<?= base_url("more/upgrades"); ?>">add more addons</a></h4>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Details</th>
                <th>Type</th>
                <th class="text-right">Price</th>
                <th style="width: 10%;"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($addons as $a){ ?>
                <tr>
                    <td>
                        <?php 
                            if( $a->with_request_removal == 1 ){
                                echo $a->name . " " . "<span style='color:#fc0303;'>(Request Removal)</span>";
                            }else{
                                echo $a->name;
                            }
                        ?>        
                    </td>
                    <td>monthly <span class="text-ter">(<?= $start_billing_period; ?> <span class="text-ter">&nbsp;to&nbsp;</span> <?= $end_billing_period; ?>)</span></td>
                    <td align="right"><?= number_format($a->service_fee, 2); ?></td>
                    <td>                        
                        <?php if( $a->with_request_removal == 1 ){ ?>
                            <a style="width: 130px;" class="btn-cancel-remove-addon btn btn-sm btn-primary" data-id="<?= $a->id; ?>" data-name="<?= $a->name; ?>" href="javascript:void(0);">Cancel Request</a>
                        <?php }else{ ?>
                            <a style="width: 130px;" class="btn-remove-addon btn btn-sm btn-primary" data-id="<?= $a->id; ?>" data-name="<?= $a->name; ?>" href="javascript:void(0);">Request Remove</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="modal-auto-recurring" tabindex="-1" role="dialog" aria-labelledby="modalLoadingMsgTitle" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="">Recurring</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="is_active" value="0">
            <div class="off-recurring-renewal-txt" style="display: none;">
                <p>
                    You are about to turn-off your plan auto-renewal.
                </p>
                <p>
                    Doing this, to continue using the app you'll have to manually pay for a new subscription when the current plan will expire.
                </p>
            </div>
            <div class="on-recurring-renewal-txt" style="display: none;">
                <p>
                    You are about to turn-on your plan auto-renewal.
                </p>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
            <button class="btn btn-primary btn-modal-auto-recurring" type="button">Confirm</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="modal-remove-addon" tabindex="-1" role="dialog" aria-labelledby="modalLoadingMsgTitle" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="">Remove Addon</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="remove_addon_id" value="0">
            <p>Removing addon will take affect on the next billing.</p>
            <p>Would you like to proceed removing addon <span class="remove-addon-name" style="font-weight: bold;"></span> ?</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-default" type="button" data-dismiss="modal">No</button>
            <button class="btn btn-primary btn-modal-remove-addon" type="button">Yes</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="modal-cancel-remove-addon" tabindex="-1" role="dialog" aria-labelledby="modalLoadingMsgTitle" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="">Cancel Remove Addon</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="cancel_remove_addon_id" value="0">
            <p>Would you like to cancel removing addon <span class="cancel-remove-addon-name" style="font-weight: bold;"></span> ?</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-default" type="button" data-dismiss="modal">No</button>
            <button class="btn btn-primary btn-modal-cancel-remove-addon" type="button">Yes</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="modal-upgrade-plan" tabindex="-1" role="dialog" aria-labelledby="modalLoadingMsgTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="">Upgrade Plan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="frm-upgrade-subscription" method="post">
        <div class="modal-body">
            <?php if( $client->num_months_discounted > 0 ){ ?>
            <p style="font-size: 18px;">Cannot upgrade plan while on discounted period</p>
            <?php }else{ ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body">                            
                        <div id="credit_card">
                            <div class="row form_line">
                                <div class="col-md-4">
                                    Subscription Plan
                                </div>
                                <div class="col-md-5">
                                    <select name="plan_id" class="input_select subscription_plans" required>
                                        <option value="" selected=""></option>
                                        <?php foreach($nsPlans as $ns){ ?>
                                            <option value="<?= $ns->nsmart_plans_id; ?>" data-price="<?= $ns->price; ?>"><?= $ns->plan_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <a class="btn btn-primary btn-sm" style="margin-top: 10px;" href="<?= base_url("/pricing"); ?>" target="_new">Plan list</a>
                                </div>
                            </div>
                            <div class="row form_line">
                                <div class="col-md-4">
                                    Card Number
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="card_number" id="" value="" required/>
                                </div>
                            </div>
                            <div class="row form_line">
                                <div class="col-md-4">
                                    <label for="">Expiration 
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <select id="exp_month" name="exp_month" class="input_select exp_month" required>
                                                <option  value=""></option>
                                                <option  value="01">01</option>
                                                <option  value="02">02</option>
                                                <option  value="03">03</option>
                                                <option  value="04">04</option>
                                                <option  value="05">05</option>
                                                <option  value="06">06</option>
                                                <option  value="07">07</option>
                                                <option  value="08">08</option>
                                                <option  value="09">09</option>
                                                <option  value="10">10</option>
                                                <option  value="11">11</option>
                                                <option  value="12">12</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select id="exp_year" name="exp_year" class="input_select exp_year" required>
                                                <option  value=""></option>
                                                <option  value="2021">2021</option>
                                                <option  value="2022">2022</option>
                                                <option  value="2023">2023</option>
                                                <option  value="2024">2024</option>
                                                <option  value="2025">2025</option>
                                                <option  value="2026">2026</option>
                                                <option  value="2027">2027</option>
                                                <option  value="2028">2028</option>
                                                <option  value="2029">2029</option>
                                                <option  value="2030">2030</option>
                                                <option  value="2031">2031</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" maxlength="3" class="form-control" name="cvc" id="cvc" value="" placeholder="CVC" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row form_line">
                                <div class="col-md-4">
                                    Total Amount
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">$</span>
                                        </div>
                                        <input type="number" class="form-control" name="plan_amount" id="upgrade_plan_amount" value="0.00" disabled="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="modal-footer">
            <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
            <?php if( $client->num_months_discounted <= 0 ){ ?>
            <button class="btn btn-primary btn-modal-upgrade-plan" type="submit">Upgrade</button>
            <?php } ?>
        </div>
        </form>
      </div>
    </div>
</div>

<div class="modal fade" id="modal-pay-subscription" tabindex="-1" role="dialog" aria-labelledby="modalLoadingMsgTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="">
            <?php if($client->is_plan_active == 1){ ?>
                Pay Subscription Plan
            <?php }else{ ?>
                Renew Subscription
            <?php } ?>
            
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="frm-pay-subscription" method="post">
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body">                            
                        <div id="credit_card">
                            <div class="row form_line">
                                <div class="col-md-4">
                                    Subscription Plan
                                </div>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" value="<?= $plan->plan_name; ?>" readonly="">
                                </div>
                            </div>
                            <div class="row form_line">
                                <div class="col-md-4">
                                    Card Number
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="card_number" id="" value="" required/>
                                </div>
                            </div>
                            <div class="row form_line">
                                <div class="col-md-4">
                                    <label for="">Expiration 
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <select id="exp_month" name="exp_month" class="input_select exp_month" required>
                                                <option  value=""></option>
                                                <option  value="01">01</option>
                                                <option  value="02">02</option>
                                                <option  value="03">03</option>
                                                <option  value="04">04</option>
                                                <option  value="05">05</option>
                                                <option  value="06">06</option>
                                                <option  value="07">07</option>
                                                <option  value="08">08</option>
                                                <option  value="09">09</option>
                                                <option  value="10">10</option>
                                                <option  value="11">11</option>
                                                <option  value="12">12</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select id="exp_year" name="exp_year" class="input_select exp_year" required>
                                                <option  value=""></option>
                                                <option  value="2021">2021</option>
                                                <option  value="2022">2022</option>
                                                <option  value="2023">2023</option>
                                                <option  value="2024">2024</option>
                                                <option  value="2025">2025</option>
                                                <option  value="2026">2026</option>
                                                <option  value="2027">2027</option>
                                                <option  value="2028">2028</option>
                                                <option  value="2029">2029</option>
                                                <option  value="2030">2030</option>
                                                <option  value="2031">2031</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" maxlength="3" class="form-control" name="cvc" id="cvc" value="" placeholder="CVC" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row form_line">
                                <div class="col-md-4">
                                    Plan Amount
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">$</span>
                                        </div>
                                        <input type="number" class="form-control" name="plan_amount" id="" value="<?= number_format($plan->price,2); ?>" disabled="">
                                    </div>
                                </div>
                            </div>
                            <div class="row form_line">
                                <div class="col-md-4">
                                    Addon Amount
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">$</span>
                                        </div>
                                        <input type="number" class="form-control" name="plan_amount" id="" value="<?= number_format($total_addon_price,2); ?>" disabled="">
                                    </div>
                                </div>
                            </div>
                            <div class="row form_line">
                                <div class="col-md-4">
                                    Total Amount
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">$</span>
                                        </div>
                                        <input type="number" class="form-control" name="plan_amount" id="" value="<?= number_format($total_monthly,2); ?>" disabled="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
            <button class="btn btn-primary btn-modal-pay-subscription" type="submit">Pay</button>
        </div>
        </form>
      </div>
    </div>
</div>


    </div>
</div>    </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
<script>
$(function(){
    $(".exp_month").select2({
        placeholder: "Select Month"
    });
    $(".subscription_plans").select2({
        placeholder: "Select Plan"
    });
    $(".exp_year").select2({
        placeholder: "Select Year"
    });

    /*$('.subscription_plans').on('select2:selecting', function(e) {
        console.log('Selecting: ' , e.params.args.data);
        console.log(e);
    });*/
    $(".subscription_plans").change(function(){
        var plan_price = $(this).select2().find(":selected").data("price"); 
        $("#upgrade_plan_amount").val(plan_price);
    });
    $(".btn-pay-subscription").click(function(){
        $("#modal-pay-subscription").modal('show');
    });
    $(".btn-upgrade-plan").click(function(){
        $("#modal-upgrade-plan").modal('show');
    });
    $(".btn-activate-auto-renewal").click(function(){
        $("#is_active").val(1);
        $(".off-recurring-renewal-txt").hide();
        $(".on-recurring-renewal-txt").show();
        $("#modal-auto-recurring").modal('show');
    });

    $(".btn-remove-addon").click(function(){
        var addon_id = $(this).attr('data-id');
        var addon_name = $(this).attr('data-name');

        $("#remove_addon_id").val(addon_id);
        $(".remove-addon-name").html(addon_name)
        $("#modal-remove-addon").modal('show');
    });

    $(".btn-cancel-remove-addon").click(function(){
        var addon_id = $(this).attr('data-id');
        var addon_name = $(this).attr('data-name');

        $("#cancel_remove_addon_id").val(addon_id);
        $(".cancel-remove-addon-name").html(addon_name)
        $("#modal-cancel-remove-addon").modal('show');
    });

    $(".btn-deactivate-auto-renewal").click(function(){
        $("#is_active").val(0);
        $(".on-recurring-renewal-txt").hide();
        $(".off-recurring-renewal-txt").show();
        $("#modal-auto-recurring").modal('show'); 
    });

    $(".btn-modal-auto-recurring").click(function(){
        var is_active = $("#is_active").val();
        recurring_auto_renewal(is_active);
    });

    $(".btn-modal-remove-addon").click(function(){
        var addon_id = $("#remove_addon_id").val();
        var url = base_url + 'mycrm/_request_remove_addon';
        $(".btn-modal-remove-addon").html('<span class="spinner-border spinner-border-sm m-0"></span>');

        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               dataType: "json",
               data: {addon_id:addon_id},
               success: function(o)
               {
                    $("#modal-remove-addon").modal('hide'); 
                    if( o.is_success == 1 ){
                      
                      Swal.fire({
                          title: 'Update Successful!',
                          text: "Your request for removal of addon was successfully sent",
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonColor: '#32243d',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'Ok'
                      }).then((result) => {
                          if (result.value) {
                              location.reload();
                          }
                      });
                    }else{
                      Swal.fire({
                        icon: 'error',
                        title: 'Cannot find data',
                        text: o.message
                      });
                    }

                    $(".btn-modal-remove-addon").html('Yes');
                }
            });
        }, 1000);
    });

    $(".btn-modal-cancel-remove-addon").click(function(){
        var addon_id = $("#cancel_remove_addon_id").val();
        var url = base_url + 'mycrm/_cancel_remove_addon';
        $(".btn-modal-cancel-remove-addon").html('<span class="spinner-border spinner-border-sm m-0"></span>');

        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               dataType: "json",
               data: {addon_id:addon_id},
               success: function(o)
               {
                    $("#modal-cancel-remove-addon").modal('hide'); 
                    if( o.is_success == 1 ){
                      
                      Swal.fire({
                          title: 'Update Successful!',
                          text: "Your request for remove addon was successfully cancelled",
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonColor: '#32243d',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'Ok'
                      }).then((result) => {
                          if (result.value) {
                              location.reload();
                          }
                      });
                    }else{
                      Swal.fire({
                        icon: 'error',
                        title: 'Cannot find data',
                        text: o.message
                      });
                    }

                    $(".btn-modal-cancel-remove-addon").html('Yes');
                }
            });
        }, 1000);
    });

    $("#frm-upgrade-subscription").submit(function(e){
        e.preventDefault();
        var url = base_url + 'mycrm/_upgrade_subscription';
        $(".btn-modal-upgrade-plan").html('<span class="spinner-border spinner-border-sm m-0"></span>');

        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               dataType: "json",
               data: $("#frm-upgrade-subscription").serialize(),
               success: function(o)
               {
                    $("#modal-upgrade-plan").modal('hide'); 
                    if( o.is_success == 1 ){
                      
                      Swal.fire({
                          title: 'Update Successful!',
                          text: "Your plan was successfully upgraded",
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonColor: '#32243d',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'Ok'
                      }).then((result) => {
                          if (result.value) {
                              location.reload();
                          }
                      });
                    }else{
                      Swal.fire({
                        icon: 'error',
                        title: 'Cannot upgrade plan',
                        text: o.message
                      });
                    }

                    $(".btn-modal-upgrade-plan").html('Upgrade');
                }
            });
        }, 1000);
    });

    $("#frm-pay-subscription").submit(function(e){
        e.preventDefault();
        var url = base_url + 'mycrm/_pay_subscription';
        $(".btn-modal-pay-subscription").html('<span class="spinner-border spinner-border-sm m-0"></span>');

        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               dataType: "json",
               data: $("#frm-pay-subscription").serialize(),
               success: function(o)
               {
                    $("#modal-upgrade-plan").modal('hide'); 
                    if( o.is_success == 1 ){
                      
                      Swal.fire({
                          title: 'Payment Successful!',
                          text: "Your plan was successfully updated",
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonColor: '#32243d',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'Ok'
                      }).then((result) => {
                          if (result.value) {
                              location.reload();
                          }
                      });
                    }else{
                      Swal.fire({
                        icon: 'error',
                        title: 'Cannot process payment',
                        text: o.message
                      });
                    }

                    $(".btn-modal-pay-subscription").html('Pay');
                }
            });
            }, 1000);
    });

    function recurring_auto_renewal(is_active){
        var url = base_url + 'mycrm/_update_auto_recurring';
        $(".btn-modal-auto-recurring").html('<span class="spinner-border spinner-border-sm m-0"></span>');
        setTimeout(function () {
        $.ajax({
           type: "POST",
           url: url,
           dataType: "json",
           data: {is_active:is_active},
           success: function(o)
           {
                $("#modal-auto-recurring").modal('hide'); 
                if( o.is_success ){
                  if( is_active == 1 ){
                    var msg = 'Auto recurring was successfully activated';
                  }else{
                    var msg = 'Auto recurring was successfully deactivated';
                  }
                  Swal.fire({
                      title: 'Update Successful!',
                      text: msg,
                      icon: 'success',
                      showCancelButton: false,
                      confirmButtonColor: '#32243d',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Ok'
                  }).then((result) => {
                      if (result.value) {
                          location.reload();
                      }
                  });
                }else{
                  Swal.fire({
                    icon: 'error',
                    title: 'Cannot update setting',
                    text: o.msg
                  });
                }

                $(".btn-modal-auto-recurring").html('Confirm');
            }
        });
        }, 1000);
    }
});
</script>