<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<style>
.gray-color {
  color: #909090;
  float: right;
  position: relative;
  top: 4px;
}
.gray {
  color: #909090;
}
.bs-stepper {
  margin-bottom: 10px;
}
.black-placeholder {
  background: black;
}
.left {
  float:left;
}
.more-feed {
  width: max-content;
  margin: 0 auto;
  padding-top: 50px;
  padding-bottom: 10px;
}
button.more-btn:hover {
  background: green;
}
.right-icon {
  float: right;
  position: relative;
  top: 4px;
}
button.more-btn {
  box-shadow: none;
  border: 0px;
  background: #41a4ff;
  color: white;
  padding: 6px 20px;
  text-transform: uppercase;
  font-size: 15px;
}
span.invoice-txt {
  color: #45a6ff;
}
span.sc-price-icon{
  color: red;
  font-size: 16px;
}
span.scn {
  font-size: 15px;
  position: relative;
  top: 0px;
}
.round-container {
  background: #cecece;
  padding: 10px 20px;
  border-radius: 100px;
  display: inline-block;
}
.img-round {
  border-radius: 100px;
  width: 21px;
  height: 21px;
  object-fit: cover;
  margin-right: 10px;
}
.item-form {
  display: block;
  clear: both;
  padding-top: 10px;
}
span.sc-price {
  text-align: right;
  display: block;
  padding-right: 10px;
  font-size: 20px;
  position: relative;
  top: 9px;
  color: #828282;
}
.icon-pb {
  font-size: 22px !important;
  position: relative;
  top: 13px;
  margin-right: 19px !important;
  text-align: right;
}
.v-card {
  position: relative;
  display: flex;
  flex-direction: column;
  min-width: 0;
  word-wrap: break-word;
  background-color: #fff;
  background-clip: border-box;
  border: 1px solid rgba(0, 0, 0, 0.125);
  border-radius: 0.25rem;
  padding: 0px;
}
.t-right {
  text-align: right;
}
.color-white {
  color:white;
}
h3.gray-sc.pl-3 {
  font-weight: 400;
  color: darkgrey;
  font-size: 21px;
  margin-top: 20px;
}
.ts-box {
  width: 50px;
  float: left;
}
.sp-left {
  font-size: 20px !importantr;
  position: relative;
  top: 15px !important;
  display: block !important;
  right: 13px;
  text-align: left;
}
.sv-right {
  position: relative;
  right: 7px;
}
.border-top {
  border-top: 1px solid black !important;
  padding-top: 10px;
  width: 100%;
}
.pb-left {
  width: 75%;
  display: block;
  float: left;
}
.sc-form-add {
  width: 100%;
  text-align: right;
  padding-right: 65px;
}
span.sc-item {
  color: #2b91ef;
}
.pb-right {
  width: 20%;
  display: block !important;
  float: right;
  margin: 0px !important;
  text-align: right;
  padding-right: 10px;
}
.clear {
  clear: both;
}
.container-info {
  display: inline-block !important;
  height: max-content;
  width: 100%;
  margin-bottom: 11px !important;
}
.sv-fix {
  position: relative;
  left: 5px;
}
.cs-100 {
  width: 100%;
  min-height: 10px;
}
.cs-9 {
  width: 90%;
  min-height: 10px;
}
.cs-8 {
  width: 80%;
  min-height: 10px;
}
.cs-7 {
  width: 70%;
  min-height: 10px;
}
.cs-6 {
  width: 60%;
  min-height: 10px;
}
.cs-5 {
  width: 50%;
}
.cs-4 {
  width: 40%;
  min-height: 10px;
}
.cs-42 {
  width: 41%;
}
.cs-4 {
  width: 40%;
}
.cs-34 {
  width: 33.33%;
}
.cs-33 {
  width: 32.5%;
}
.cs-3 {
  width: 30%;
}
.cs-2 {
  width: 21%;
}
.cs-20 {
  width: 20%;
}
.cs-12 {
  width: 10%;
}
.cs-1 {
  width: 10%;
}
.pl-c6 {
  padding-left: 65px !important;
}
.tn-container {
  border-top: 1px solid #868686;
  margin-top: 30px;
  padding: 20px 0px;
}
.cost-container {
  border-top: 1px solid #868686;
  margin-top: 10px;
  padding: 20px;
}
.booking-container {
  border-top: 1px solid #868686;
  margin-top: 5px;
  padding: 20px;
}
.sum-container {
  border-top: 1px solid #868686;
  margin-top: 30px;
  padding: 20px;
}
.text-right {
  text-align: right;
  width: 100%;
  display: block;
  padding-right: 33px;
}
.gray-area {
  padding-bottom: 20px;
  display: block;
}
@media only screen and (max-width: 560px) {
  .cs-9 {
    width:83%;
  }
  .bs-stepper-header {
      overflow-y: scroll;
  }
  input.form-control {
      width: 92%;
      margin: 0 auto;
  }
  .booking-container {
    padding: 10px;
  }
  .sv-h5 {
    padding-left: 15px;
  }
  .activity-container {
    padding-left: 15px;
  }
  .tn-container {
    width: 100%;
    clear: both;
    display: block;
  }
  .subtotal {
    text-align: right;
    width: 100%;
    display: block;
    padding-right: 20px;
  }
  .card {
    padding: 10px 15px !important;
  }
  .sc-form-add {
    padding-right: 15px;
  }
  .pl-c6 {
    padding-left: 0px !important;
  }
  .cs-20 {
    width: 70%;
  }
  .cs-1 {
    position: relative;
    top: 5px;
  }
  .cs-12, .cs-2, .cs-3, .cs-4, .cs-5, .cs-6, .cs-7, .cs-8, .cs-42, .cs-33 {
    width: 100% !important;
    padding-bottom: 20px !important;
  }
  .ts-box.pl-0.ml-0.mr-0.pr-0.left {
    display: none;
  }
}
.badge-danger{
    background-color: #ec4561 !important;
  }


  .signature_mobile
{
    display: none;
}

.show_mobile_view
{
    display: none;
}

@media only screen and (max-device-width: 600px) {
    .label-element{
        position:absolute;
        top:-8px;
        left:25px;
        font-size:12px;
        color:#666;
        }
    .input-element{
        padding:30px 5px 10px 8px;
        width:100%;
        height:55px;
        /* border:1px solid #CCC; */
        font-weight: bold;
        margin-top: -15px;
        }

    .select-wrap 
    {
    border: 2px solid #e0e0e0;
    /* border-radius: 4px; */
    margin-top: -10px;
    /* margin-bottom: 10px; */
    padding: 0 5px 5px;
    width:100%;
    /* background-color:#ebebeb; */
    }

    .select-wrap label
    {
    font-size:10px;
    text-transform: uppercase;
    color: #777;
    padding: 2px 8px 0;
    }

    .m_select
    {
    /* background-color: #ebebeb;
    border:0px; */
    border-color: white !important;
    border:0px !important;
    outline:0px !important;
    }
    .select2 .select2-container .select2-container--default{
        /* background-color: #ebebeb;
    border:0px; */
    border-color: white !important;
    border:0px !important;
    outline:0px !important;
    }

    .select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #fff !important;
    border-radius: 4px;
    }

    .sub_label{
        font-size:12px !important;
    }

    .signature_web
    {
        display: none;
    }

    .signature_mobile
    {
        display: block;
        margin-bottom:10px;
    }

    .hidden_mobile_view{
        display: none;
    }

    .show_mobile_view
    {
        display: block;
    }

    .table_mobile
    {
        font-size:14px;
    }

    div.dropdown-wrapper select { 
    width:115% /* This hides the arrow icon */; 
    background-color:transparent /* This hides the background */; 
    background-image:none; 
    -webkit-appearance: none /* Webkit Fix */; 
    border:none; 
    box-shadow:none; 
    padding:0.3em 0.5em; 
    font-size:13px;
    }
    .signature-pad-canvas-wrapper {
    margin: 15px 0 0;
    border: 1px solid #cbcbcb;
    border-radius: 3px;
    overflow: hidden;
    position: relative;
}

    .signature-pad-canvas-wrapper::after {
        content: 'Name';
        border-top: 1px solid #cbcbcb;
        color: #cbcbcb;
        width: 100%;
        margin: 0 15px;
        display: inline-flex;
        position: absolute;
        bottom: 10px;
        font-size: 13px;
        z-index: -1;
    }

    .mobile_view
    {
        font-size:12px;
    }

    .sigWrapper
    {
        overflow: hidden; 
    }

    .mobile_view_table
    {
        min-width: 350px !important;
        margin-left: -20px !important;
    }

    .add_mobile
    {
        margin-left: -22px !important;
    }

    .mobile_qty
    {
        background: transparent !important;
        border: none !important;
        outline: none !important;
        padding: 0px 0px 0px 0px !important;
        text-align: center;
    }


.tabs { list-style: none; }
.tabs li { display: inline; }
.tabs li a 
{ 
    color: black; 
    float: left; 
    display: block; 
    /* padding: 4px 10px;  */
    /* margin-left: -1px;  */
    position: relative; 
    /* left: 1px;  */
    background: #a2a5a3; 
    text-decoration: none; 
}
.tabs li a:hover 
{ 
    background: #ccc; 
}
.group:after 
{ 
    visibility: hidden; 
    display: block; 
    font-size: 0; 
    content: " "; 
    clear: both; 
    height: 0; 
}

.box-wrap 
{ 
    position: relative; 
    min-height: 250px; 
}
.tabbed-area div div 
{ 
    background: white; 
    padding: 20px; 
    min-height: 250px; 
    position: absolute; 
    top: -1px; 
    left: 0; 
    width: 100%; 
}

.tabbed-area div div, .tabs li a 
{ 
    border: 1px solid #ccc; 
}

#box-one:target, #box-two:target, #box-three:target {
  z-index: 1;
}

.group li.active a,
.group li a:hover,
.group li.active a:focus,
.group li.active a:hover{
  background-color: #52cc6e;
  color: black; 
}

}
</style>
<?php include viewPath('v2/includes/header'); ?>
<div class="wrapper" role="wrapper">
  <?php include viewPath('includes/notifications'); ?>
  <?php //include viewPath('includes/sidebars/estimate'); ?>
    <!-- page wrapper start -->
    <?php 
    $total_amount = 0;
    ?>
    <div wrapper__section>
      
        <div class="row page-content g-0">
          
        <div class="col-12 mb-3">
            <?php include viewPath('v2/includes/page_navigations/sales_tabs'); ?>
        </div>
        <div class="col-12 mb-3">
            <?php include viewPath('v2/includes/page_navigations/estimate_subtabs'); ?>
        </div>
            <br class="clear"/>
            <div class="row" style="padding-right:10%;padding-left:10%;">                
                <div class="col-xl-12">
                  <?php include viewPath('flash'); ?>
                    <div class="">
                      <?php if($estimate){ ?>
                      <div class="d-block">
                        <div class="col-md-12" style="text-align: right;margin-bottom: 60px;">
                          <a class="btn btn-success send_to_customer" acs-id="<?php echo $estimate->customer_id; ?>" est-id="<?php echo $estimate->id; ?>"><span class="fa fa-envelope-open-o icon"></span> SEND TO CUSTOMER</a>
                          <!-- <a class="btn btn-info" href="<?php //echo base_url('estimate/edit/' . $estimate->id) ?>"><span class="fa fa-pencil icon"></span> EDIT</a> -->
                                                    <?php if($estimate->estimate_type == 'Standard'){ ?>
                                                    <a class="btn btn-info" role="menuitem" tabindex="-1"
                                                                               href="<?php echo base_url('estimate/edit/' . $estimate->id) ?>"><span
                                                                    class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                    
                                                    <?php }elseif($estimate->estimate_type == 'Option'){ ?>
                                                    <a class="btn btn-info" role="menuitem" tabindex="-1"
                                                                               href="<?php echo base_url('estimate/editOption/' . $estimate->id) ?>"><span
                                                                    class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                   
                                                    <?php }else{ ?>
                                                    <a class="btn btn-info" role="menuitem" tabindex="-1"
                                                                               href="<?php echo base_url('estimate/editBundle/' . $estimate->id) ?>"><span
                                                                    class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                    
                                                    <?php } ?>
                          <a class="btn btn-info" target="_new" href="<?php echo base_url('estimate/view_pdf/' . $estimate->id) ?>"><span class="fa fa-file-pdf-o icon"></span> PDF</a>
                          <a class="btn btn-info" data-print-modal="open" href="#" onclick="printDiv('printableArea')" value="Print Work Order"><span class="fa fa-print"></span> Print</a>
                          <a class="btn btn-success approveEstimate" target="_new" estimateID="<?php echo $estimate->id; ?>"><span class="fa fa-file-pdf-o icon"></span> APPROVE</a>
                          <a class="btn btn-info" href="<?php echo base_url('estimate/') ?>">BACK TO ESTIMATE LIST</a>
                          <input type="hidden" value="<?php echo getCompanyBusinessProfileImage(); ?>" id="urlLogo">
                        </div>
                      </div>

                      <div id="printableArea" style="">
                          <div class="row">
                            <div class="col-md-2">
                                <!-- <img class="presenter-print-logo" style="max-width: 230px; max-height: 200px;" src="http://nsmartrac.com/assets/dashboard/images/logo.png"> -->
                                <img src="<?= getCompanyBusinessProfileImage(); ?>"  style="max-width: 130px; max-height: 130px;" />
                            </div>
                            <div class="col-md-7">

                            </div>
                            <div class="col-md-3">
                                    <table class="table table-borderless">
                                      <tr>
                                        <td colspan="2" style="text-align:center;"><h2>ESTIMATE</h2></td>
                                      </tr>
                                      <tr>
                                        <td style="text-align: ;">Estimate No:</td>
                                        <td style="text-align: right;"><?= $estimate->estimate_number; ?></td>
                                      </tr>
                                      <tr>
                                        <td style="text-align: ;">Estimate Date:</td>
                                        <td style="text-align: right;"><?= date("F d, Y",strtotime($estimate->estimate_date)); ?></td>
                                      </tr>
                                      <tr>
                                        <td style="text-align: ;">Expiry Date:</td>
                                        <td style="text-align: right;"><?= date("F d, Y",strtotime($estimate->expiry_date)); ?></td>
                                      </tr>
                                    </table>
                              </div>
                            </div>
                          <!-- </div> -->
                          <br><br><br>
                          <div class="row">
                            <div class="col-md-6" style="margin-bottom: ;font-size:16px;">
                              <h4>From</h4>
                                <span class="invoice-txt"><h4><?= $client->business_name; ?></h4></span></h5>
                                <div class="col-xl-5 ml-0 pl-0">
                                  <span class="ul-text"><?php echo $client->street .' <br>'.$client->city .', '.$client->state .' '.$client->postal_code; ?></span><br>
                                  <span class=""><?= $client->business_email; ?></span><br />
                                  <span class=""><?= $client->office_phone; ?></span>
                                </div>
                            </div>
                            <div class="col-md-6" style="text-align:right;font-size:16px;">
                                <h4>To</h4>
                                <span class="invoice-txt text-capitalize"> <h4><?= $customer->first_name . ' ' . $customer->last_name; ?></h4></span></h5> 
                                <div class="">
                                  <span class=""><?= $customer->mail_add . " " . $customer->city.', '. $customer->state .' '. $customer->zip_code;  ?></span><br />
                                  <span class=""><span class=""><?= $customer->email; ?></span><br />
                                  <span class=""><span class=""><?= $customer->phone_w; ?></span><br />
                                </div>
                            </div>
                          </div>

                            <table class="table table-print table-items table-bordered" style="width: 100%; margin-top: 45px;">
                            <thead>
                                <tr style="background-color:#1D88F3; color:white;">
                                    <!-- <th>#</th> -->
                                    <th style="text-align: center;">Items</th>
                                    <th style="text-align: center;">Item Type</th>
                                    <th style="text-align: center;">Price</th>
                                    <th style="text-align: center;">Qty</th>
                                    <th style="text-align: center;">Discount</th>
                                    <th style="text-align: center;">Tax</th>
                                    <th style="text-align: center;">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if($estimate->estimate_type == 'Option'){ $ia = 1; $ib = 1; ?>
                                <tr>
                                    <td colspan="7" style="padding:15px;"><b>Option 1</b></td>
                                </tr>
                              <?php foreach($items_dataOP1 as $itemData1){ ?>
                                    <tr class="table-items__tr">
                                      <!-- <td valign="top" style="width:30px; text-align:center;"><?php //echo $ia; ?></td> -->
                                      <td valign="top" style="width:45%;"><?= $itemData1->title; ?></td>
                                      <td valign="top" style="width:20%;"><?= $itemData1->type; ?></td>
                                      <td valign="top" style="width: 80px; text-align: right;">$<?= number_format((float)$itemData1->costing,2); ?></td>
                                      <td valign="top" style="width: 50px; text-align: right;"><?= $itemData1->qty; ?></td>
                                      <td valign="top" style="width: 50px; text-align: right;">$<?= number_format($itemData1->discount,2); ?></td>
                                      <td valign="top" style="width: 50px; text-align: right;">$<?= number_format($itemData1->tax,2); ?></td>
                                      <td valign="top" style="width: 80px; text-align: right;">$<?= number_format((float)$itemData1->total,2); ?></td>
                                    </tr>
                                  <?php $ia++; } ?>
                                
                                <tr>
                                  <td colspan="4" style="border-left: 1px solid Transparent!important;"></td>
                                  <td colspan="2" style="text-align: ;"><p>Subtotal</p></td>
                                  <td colspan="1" style="text-align: right;"><p>$ <?= number_format((float)$estimate->sub_total, 2); ?></p></td>
                                </tr>
                                <tr>
                                  <td colspan="4" style="border-left: 1px solid Transparent!important;border-top: 1px solid Transparent!important;"></td>
                                  <td colspan="2" style="text-align: ;"><p>Taxes</p></td>
                                  <td colspan="1" style="text-align: right;"><p>$ <?= number_format((float)$estimate->tax1_total, 2); ?></p></td>
                                </tr>
                                <tr>
                                  <td colspan="4" style="border-left: 1px solid Transparent!important;border-bottom: 1px solid Transparent!important;border-top: 1px solid Transparent!important;"></td>
                                  <td colspan="2" style="text-align: ;"><b>TOTAL AMOUNT</b></td>
                                  <td colspan="1" style="text-align: right;"><b>$ <?= number_format((float)$estimate->option1_total, 2); ?></b></td>
                                </tr>
                                <tr>
                                    <td colspan="7" style="padding-top:15px;"><b>Option 1 Message</b></td>
                                </tr>
                                <tr>
                                    <td colspan="7" style="padding-bottom:30px;"><?= $estimate->option_message; ?></td>
                                </tr>

                                <tr>
                                    <td colspan="7" style="padding:15px;"><b>Option 2</b></td>
                                </tr>
                            <?php foreach($items_dataOP2 as $itemData2){ ?>
                                    <tr class="table-items__tr">
                                      <!-- <td valign="top" style="width:30px; text-align:center;"><?php //echo $ib; ?></td> -->
                                      <td valign="top" style="width:45%;"><?= $itemData2->title; ?></td>
                                      <td valign="top" style="width:20%;"><?= $itemData2->type; ?></td>
                                      <td valign="top" style="width: 80px; text-align: right;">$<?= number_format($itemData2->costing,2); ?></td>
                                      <td valign="top" style="width: 50px; text-align: right;"><?= $itemData2->qty; ?></td>
                                      <td valign="top" style="width: 50px; text-align: right;">$<?= number_format($itemData2->discount,2); ?></td>
                                      <td valign="top" style="width: 50px; text-align: right;">$<?= number_format($itemData2->tax,2); ?></td>
                                      <td valign="top" style="width: 80px; text-align: right;">$<?= number_format($itemData2->total,2); ?></td>
                                    </tr>
                                  <?php $ib++; } ?>
                                
                                <tr>
                                  <td colspan="4" style="border-left: 1px solid Transparent!important;"></td>
                                  <td colspan="2" style="text-align: ;"><p>Subtotal</p></td>
                                  <td colspan="1" style="text-align: right;"><p>$<?= number_format((float)$estimate->sub_total2, 2); ?></p></td>
                                </tr>
                                <tr>
                                  <td colspan="4" style="border-left: 1px solid Transparent!important;border-top: 1px solid Transparent!important;"></td>
                                  <td colspan="2" style="text-align: ;"><p>Taxes</p></td>
                                  <td colspan="1" style="text-align: right;"><p>$<?= number_format((float)$estimate->tax2_total, 2); ?></p></td>
                                </tr>
                                <tr>
                                  <td colspan="4" style="border-left: 1px solid Transparent!important;border-bottom: 1px solid Transparent!important;border-top: 1px solid Transparent!important;"></td>
                                  <td colspan="2" style="text-align: ;"><b>TOTAL AMOUNT</b></td>
                                  <td colspan="1" style="text-align: right;"><b>$<?= number_format((float)$estimate->option2_total, 2); ?></b></td>
                                </tr>
                                <tr>
                                    <td colspan="7" style="padding-top:15px;"><b>Option 2 Message</b></td>
                                </tr>
                                <tr>
                                    <td colspan="7" style="padding-bottom:15px;"><?= $estimate->option2_message; ?></td>
                                </tr>

                            <?php }elseif($estimate->estimate_type == 'Bundle'){ $ix =1;  $iy =1; ?>

                              <tr>
                                    <td colspan="7" style="padding:15px;"><b>Bundle 1</b></td>
                                </tr>
                              <?php foreach($items_dataBD1 as $itemDatabd1){ ?>
                                    <tr class="table-items__tr">
                                      <!-- <td valign="top" style="width:30px; text-align:center;"><?php //echo $ix; ?></td> -->
                                      <td valign="top" style="width:45%;"><?= $itemDatabd1->title; ?></td>
                                      <td valign="top" style="width:20%;"><?= $itemDatabd1->type; ?></td>
                                      <td valign="top" style="width: 80px; text-align: right;">$<?= number_format($itemDatabd1->costing,2); ?></td>
                                      <td valign="top" style="width: 50px; text-align: right;"><?= $itemDatabd1->qty; ?></td>
                                      <td valign="top" style="width: 50px; text-align: right;">$<?= number_format($itemDatabd1->discount,2); ?></td>
                                      <td valign="top" style="width: 50px; text-align: right;">$<?= number_format($itemDatabd1->tax,2); ?></td>
                                      <td valign="top" style="width: 80px; text-align: right;">$<?= number_format($itemDatabd1->total,2); ?></td>
                                    </tr>
                                  <?php $ix++; } ?>
                                
                                <tr>
                                  <td colspan="4" style="border-left: 1px solid Transparent!important;"></td>
                                  <td colspan="2" style="text-align: ;"><p>Subtotal</p></td>
                                  <td colspan="1" style="text-align: right;"><p>$<?= number_format($estimate->sub_total, 2); ?></p></td>
                                </tr>
                                <tr>
                                  <td colspan="4" style="border-left: 1px solid Transparent!important;border-top: 1px solid Transparent!important;"></td>
                                  <td colspan="2" style="text-align: ;"><p>Taxes</p></td>
                                  <td colspan="1" style="text-align: right;"><p>$<?= number_format($estimate->tax1_total, 2); ?></p></td>
                                </tr>
                                <tr>
                                  <td colspan="4" style="border-left: 1px solid Transparent!important;border-bottom: 1px solid Transparent!important;border-top: 1px solid Transparent!important;"></td>
                                  <td colspan="2" style="text-align: ;"><b>TOTAL AMOUNT</b></td>
                                  <td colspan="1" style="text-align: right;"><b>$<?= number_format($estimate->bundle1_total, 2); ?></b></td>
                                </tr>
                                <tr>
                                    <td colspan="7" style="padding-top:15px;"><b>Bundle 1 Message</b></td>
                                </tr>
                                <tr>
                                    <td colspan="7" style="padding-bottom:30px;"><?= $estimate->bundle1_message; ?></td>
                                </tr>

                                <tr>
                                    <td colspan="7" style="padding:15px;"><b>Bundle 2</b></td>
                                </tr>
                            <?php foreach($items_dataBD2 as $itemDatabd2){ ?>
                                    <tr class="table-items__tr">
                                      <!-- <td valign="top" style="width:30px; text-align:center;"><?php //echo $iy; ?></td> -->
                                      <td valign="top" style="width:45%;"><?= $itemDatabd2->title; ?></td>
                                      <td valign="top" style="width:20%;"><?= $itemDatabd2->type; ?></td>
                                      <td valign="top" style="width: 80px; text-align: right;">$<?= number_format($itemDatabd2->costing,2); ?></td>
                                      <td valign="top" style="width: 50px; text-align: right;"><?= $itemDatabd2->qty; ?></td>
                                      <td valign="top" style="width: 50px; text-align: right;">$<?= number_format($itemDatabd2->discount,2); ?></td>
                                      <td valign="top" style="width: 50px; text-align: right;">$<?= number_format($itemDatabd2->tax,2); ?></td>
                                      <td valign="top" style="width: 80px; text-align: right;">$<?= number_format($itemDatabd2->total,2); ?></td>
                                    </tr>
                                  <?php $iy++; } ?>
                                
                                <tr>
                                  <td colspan="4" style="border-left: 1px solid Transparent!important;"></td>
                                  <td colspan="2" style="text-align: ;"><p>Subtotal</p></td>
                                  <td colspan="1" style="text-align: right;"><p>$<?= number_format($estimate->sub_total2, 2); ?></p></td>
                                </tr>
                                <tr>
                                  <td colspan="4" style="border-left: 1px solid Transparent!important;border-top: 1px solid Transparent!important;"></td>
                                  <td colspan="2" style="text-align: ;"><p>Taxes</p></td>
                                  <td colspan="1" style="text-align: right;"><p>$<?= number_format($estimate->tax2_total, 2); ?></p></td>
                                </tr>
                                <tr>
                                  <td colspan="4" style="border-left: 1px solid Transparent!important;border-bottom: 1px solid Transparent!important;border-top: 1px solid Transparent!important;"></td>
                                  <td colspan="2" style="text-align: ;"><b>TOTAL AMOUNT</b></td>
                                  <td colspan="1" style="text-align: right;"><b>$<?= number_format($estimate->bundle2_total, 2); ?></b></td>
                                </tr>
                                <tr>
                                    <td colspan="7" style="padding-top:15px;"><b>Bundle 2 Message</b></td>
                                </tr>
                                <tr>
                                    <td colspan="7" style="padding-bottom:15px;"><?= $estimate->bundle2_message; ?></td>
                                </tr>

                            <?php }else{ $i = 1; ?>
                              
                                <?php foreach($items_data as $itemData){ ?>
                                    <tr class="table-items__tr">
                                      <!-- <td valign="top" style="width:30px; text-align:center;"><?php //echo $i; ?></td> -->
                                      <td valign="top" style="width:45%;"><?= $itemData->title; ?></td>
                                      <td valign="top" style="width:20%;"><?= $itemData->type; ?></td>
                                      <td valign="top" style="width: 80px; text-align: right;">$<?= number_format($itemData->iCost,2); ?></td>
                                      <td valign="top" style="width: 50px; text-align: right;"><?= $itemData->qty; ?></td>
                                      <td valign="top" style="width: 50px; text-align: right;">$<?= number_format($itemData->discount,2); ?></td>
                                      <td valign="top" style="width: 50px; text-align: right;">$<?= number_format($itemData->tax,2); ?></td>
                                      <td valign="top" style="width: 80px; text-align: right;">$<?= number_format($itemData->iTotal,2); ?></td>
                                    </tr>
                                  <?php $i++; } ?>
                                
                                <tr>
                                  <td colspan="4" style="border-left: 1px solid Transparent!important;"></td>
                                  <td colspan="2" style="text-align: ;"><p>Subtotal</p></td>
                                  <td colspan="1" style="text-align: right;"><p>$<?= number_format((int)$estimate->sub_total,2); ?></p></td>
                                </tr>
                                <tr>
                                  <td colspan="4" style="border-left: 1px solid Transparent!important;border-top: 1px solid Transparent!important;"></td>
                                  <td colspan="2" style="text-align: ;"><p>Taxes</p></td>
                                  <td colspan="1" style="text-align: right;">
                                    <p>$<?= number_format((float)$estimate->tax1_total, 2); ?></p></td>
                                </tr>
                                <tr>
                                  <td colspan="4" style="border-left: 1px solid Transparent!important;border-bottom: 1px solid Transparent!important;border-top: 1px solid Transparent!important;"></td>
                                  <td colspan="2" style="text-align: ;"><b>TOTAL AMOUNT</b></td>
                                  <td colspan="1" style="text-align: right;"><b>$<?= number_format((float)$estimate->grand_total, 2); ?></b></td>
                                </tr>
                            <?php } ?>

                            </tbody>
                            </table>
                            <!-- </div> -->
                                <?php //print_r($estimate); ?>
                            <br />
                            <?php if($estimate->instructions){ ?>
                            <b>Instructions</b><br>
                            <?php echo $estimate->instructions; }?>

                            <?php if($estimate->estimate_type == 'Standard'){ ?>
                              <?php if($estimate->customer_message){ ?>
                            <br><br><b>Message</b><br><?= $estimate->customer_message; ?>
                            <?php } }?>

                            <?php if($estimate->terms_conditions){ ?>
                              <br><br><b>Terms</b><br><?= $estimate->terms_conditions; }?>
                      
                            <?php }else{ ?>
                              <div class="alert alert-primary" role="alert">
                                Invalid record
                              </div>
                            <?php } ?>
                      </div>

                      <div class="row" style="margin-top: 100px;">
                          <div class="col-md-4 form-group">
                              <a href="<?php echo base_url('estimate') ?>" class="btn btn-primary" aria-expanded="false">
                                <i class="mdi mdi-settings mr-2"></i> Go Back to Estimate List
                              </a>
                          </div>
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
<?php include viewPath('v2/includes/footer'); ?>
<script>
$(function(){
  $(".btn-approve-estimate").click(function(){
    $("#modalApproveConfirmation").modal('show');
  });
  $(".btn-disapprove-estimate").click(function(){
    $("#modalDisapproveConfirmation").modal('show');
  });
});
</script>
<script>
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>


<script>
  $('body').on('click', '.approveEstimate', function () {
      var estId = $(this).attr("estimateID");

      if(confirm("Are you sure you want to Approve this Estimate?")){
        $.ajax({
              type: "POST",
              dataType: 'json',
              data:{'estId':estId },
              url : "<?php echo base_url(); ?>estimate/approveEstimate",
              success: function (data) {
                // alert('success');
                // location.reload();
                sucess("Success");
              },
              error: function (data) {
                  console.log('Error:', data);
              }
          });
        }
      else{
        return false;
      }

      
    function sucess(information,$id){
            Swal.fire({
                title: 'Good job!',
                text: information,
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
        }

    });
</script>
<script>
$(document).on('click touchstart','.send_to_customer',function(){

var id = $(this).attr('acs-id');
var est_id = $(this).attr('est-id');
var urlLogo = $('#urlLogo').val();
// alert(wo_id);

var r = confirm("Send this to customer?");

if (r == true) {
	$.ajax({
	type : 'POST',
	url : "<?php echo base_url(); ?>estimate/sendEstimateToAcs",
	data : {id: id, est_id: est_id, urlLogo: urlLogo},
	success: function(result){
		//sucess("Email Successfully!");
		// alert('Email Successfully!');
        sucess("Successfully sent to Customer!");
	},
	error: function () {
      alert("An error has occurred");
    },

	});

	} 

    function sucess(information,$id){
            Swal.fire({
                title: 'Good job!',
                text: information,
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
        }
// else 
// {
// 	alert('no');
// }

});
</script>


