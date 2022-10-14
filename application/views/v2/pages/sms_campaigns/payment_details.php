<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('v2/includes/header'); ?>

<style>
    div[wrapper__section] {
        padding: 60px 10px !important;
    }
    .card{
        box-shadow: 0 0 13px 0 rgb(116 116 117 / 44%) !important;
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
    .card-help {
        padding-left: 45px;
        padding-top: 10px;
    }
    .text-ter {
        color: #888888;
    }
    .card-type.visa {
        background-position: 0 0;
    }
    .card-type {
        margin-left: 25px;
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
    .expired{
      color:red;
    }
    .card-type.discover {
        background-position: -125px 0;
    }
    input[type="radio"], input[type="checkbox"] {
        margin: 4px 5px 0 0 !important;
    }
    input[type=checkbox], input[type=radio] {
        margin: 4px 0 0;
        margin-top: 1px\9;
        line-height: normal;
    }
    input[type=checkbox], input[type=radio] {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        padding: 0;
    }
    label {
        display: inline-block;
        max-width: 100%;
        margin-bottom: 5px;
    }
    label>input {
      visibility: visible;
    }
    .cc-list{
        list-style: none;
        padding: 0px;
        margin: 0px;
    }
    .cc-list li{
      margin: 25px;
      margin-left: 0px;
    }
</style>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/marketing_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            <div>Payment was successful, thank you for your order</div>
                        </div>
                    </div>
                </div>                
                    <div class="row mt-5">
                        <div class="col-md-12">                                    
                            <div class="payment-options">                                                              
                                <table class="table table-no-border table-payment-details">
                                  <tr>
                                    <td colspan="2"><h4>Order # <?= $smsBlast->order_number; ?></h4></td>
                                  </tr>
                                  <tr>
                                    <td style="width:200px;">Date:</td>
                                    <td><b><?= date("d-M-Y H:i", strtotime($smsBlast->date_paid)); ?></b></td>
                                  </tr>
                                  <tr>
                                    <td style="width:200px;">Status:</td>
                                    <td><b><?= $orderPayments->status; ?></b></td>
                                  </tr>
                                  <tr>
                                    <td style="width:200px;">Payment Method:</td>
                                    <td><b><?= $orderPayments->payment_method; ?></b></td>
                                  </tr>
                                  <tr>
                                    <td style="width:200px;">Customer:</td>
                                    <td><b><?= $company->business_name; ?></b></td>
                                  </tr>
                                </table>
                                <hr />
                                <table class="table table-payment-details">
                                  <tr>
                                    <td style="width:100px;font-weight: bold;">Item</td>
                                    <td style="width:50px;font-weight: bold;">Qty</td>
                                    <td style="width:300px;font-weight: bold;">Details</td>
                                    <td style="width:50px;font-weight: bold;text-align: right;">Subtotal</td>
                                  </tr>
                                  <tr>
                                    <td>SMS Campaign</td>
                                    <td>1</td>
                                    <td>
                                      <span>Campaign : <?= $smsBlast->campaign_name; ?></span><br />
                                      <span>Send Date : <?= date("d-M-Y",strtotime($smsBlast->send_date)); ?></span><br />
                                    </td>
                                    <td style="text-align: right;">
                                      $<?= number_format($smsBlast->total_price, 2); ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td colspan="3" style="text-align: right;"><b>TOTAL</b></td>
                                    <td colspan="3" style="text-align: right;"><b>$<?= number_format($smsBlast->total_price, 2); ?></b></td>
                                  </tr>
                                </table>   
                            </div>                                                        
                        </div>                        
                    </div>
                    <div class="row mt-5">   
                        <div class="col-12 mt-3 text-end">
                            <a class="nsm-button primary" href="<?php echo url('sms_campaigns/invoice_pdf/' . $smsBlast->id) ?>" target="_new" style="margin-right: 10px;">
                                          Download Invoice #<?= $dealsSteals->order_number; ?> as PDF
                            </a>
                            <button type="button" name="btn_back" class="nsm-button" onclick="location.href='<?php echo url('sms_campaigns') ?>'">Go Back to SMS Campaigns List</button>                            
                        </div>                                             
                    </div> 
            </div>
        </div>
    </div>
</div>
<?php include viewPath('v2/includes/footer'); ?>