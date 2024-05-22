<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Work Order</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
    
 
    body {
        color: black;
        font-size: 10px;
    }

    table {
        font-size: 10px;

    }
    .message-td{
        display: flex;
        width: 100%;
    }
    .client_details{
            text-align: right;
        }
 
 
    .message-term-column{
        max-width: 400px;
        margin-right: 300px;
    }
    .message-term-column-bottom{
        display: none;
     
    }
    .container {
        width: 100%;
    }

    .flex {
        display: flex;
    }

    .sameRow {
        /* border: 2px solid black; */
        height: 40px;
        width: 100%;
    }

    .normal {
        height: 40px;
        border: 2px solid red;
    }
    .estimate_container{
    text-align: right;
    }
    .estimate_date{
        float: right;
    }
    .title-head{
        display: flex;
        justify-content:space-between;
        align-items: start;
    }
    .mobile_view_items p{
        margin-bottom: 0;
    }
   
    .item_type_data{
        display: none;
    }
    .total_column{
        text-align: start;
    }
  .grand_total_column{
    text-align: start;
  }
  .message-option{
    max-width: 400px;
    margin-right: 300px;
  }

    @media only screen and (max-width: 760px){

        table {
            width: 100%;
      
        }
        .message-td{
         flex-direction: column;
     
    }
    .message-term-column{
        display: none;
    }
    .message-term-column-bottom{
        display: block;
    }
    .total_column{
        text-align: end;
    }
    .grand_total_column{
    text-align: end;
  }
      
  .message-option{
    max-width: none;
    margin-right: 0;
  }
    }
    @media (max-width: 550px) {
        a {
            min-width: 80% !important;
        }
        .transaction_details{
            flex-direction: column;
        }
        .client_details{
            text-align: left;
        }
        .title-head{
            flex-direction: column;
            justify-content:center;
            align-items: center;
        }
        .title-head img{
            margin-bottom: 10px;
        }
        .estimate_container{
            text-align: center;
            width: 100%;
        }
        .estimate_date{
            float: none;
            text-align: center;
          
        }
        .estimate_date table{
            max-width: 200px;
            margin: auto;
        }
        .item_type_data{
            display: block;
        }
        .item_title_data{
       margin: 0;
        }
        .item_type{
            display: none;
        }
        .item_type_default{
            display: none;
        }
  
    }

    span.invoice-txt {
        color: #45a6ff;
    }
    </style>
</head>

<body style="font-family: helvetica; font-size: 10px">
    <div
        style="box-shadow:0 2px 8px 0 rgba(0,0,0,.2);background-color: #fff;border: 1px solid #d4d7dc;-webkit-transition: all .3s ease;position:relative;top:20px;width: 95%;margin: 0 auto;">
        <div>
            <div>
                <div>
                    <div style="padding: 20px;">
                        <div style="padding: 10px;">
                            <div class="">
                                <div id="printableArea">
                                    <div  class="title-head">
                                        <div>
                                            <!-- <img class="presenter-print-logo" style="max-width: 230px; max-height: 200px;" src="http://nsmartrac.com/assets/dashboard/images/logo.png"> -->
                                            <img src="<?php echo getCompanyBusinessProfileImage(); ?>"
                                                style="height: 100px;" />
                                        </div>

                                        <div class="estimate_container">
                                            <div  class="estimate_title">
                                                <h5 style="font-weight:bold;color:#6a4a86 ;font-size:20px;margin:0px;">
                                                    ESTIMATE</h5>
                                                <small
                                                    style="color:#6a4a86;font-size: 10px; font-weight:bold">#<?php echo $estimate_number; ?></small>
                                            </div>
                                            <div class="estimate_date" style="margin-top: 20px;">
                                                <table style=" font-size: 12px">
                                                    <tr>
                                                        <td>Estimate Date: &emsp;</td>
                                                        <td><?php echo date('F d, Y', strtotime($estimate_date)); ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Expiry Date: &emsp;</td>
                                                        <td><?php echo date('F d, Y', strtotime($expiry_date)); ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                      class="transaction_details"   style="display: flex ;align-items:start;justify-content: space-between; margin-top: 50px">
                                        <div class="col-xl-5 left" style="margin-bottom: 33px;">
                                            <span class="fa fa-user-o fa-margin-right"
                                                style="font-weight:400;font-size: 10px"></span> From <br>
                                            <p style="font-size:14px;font-weight: 700; margin: 0">
                                                <?php echo $company; ?></p>
                                            <!-- <div class="col-xl-5 ml-0 pl-0"> -->
                                            <span class=""><?php echo $business_address; ?></span><br />
                                            <span class="">EMAIL: <?php echo $email_address; ?></span><br />
                                            <span class="">PHONE: <?php echo $phone_number; ?></span>
                                            <!-- </div> -->
                                        </div>
                                        <div class="col-xl-5 left client_details">
                                            <span class="fa fa-user-o fa-margin-right"
                                                style="font-weight:400;font-size: 10px"></span> To <br>
                                            <p style="font-size:14px;font-weight: 700; margin: 0">
                                                <?php echo $acs_name; ?></p>
                                            <!-- <div class="col-xl-5 ml-0 pl-0"> -->
                                            <span class=""><?php echo $acsaddress; ?></span><br />
                                            <span class="">EMAIL: <span class=""><?php echo $acsemail; ?></span><br />
                                                <span class="">PHONE: <span
                                                        class=""><?php echo $phone_m; ?></span><br />
                                        </div>
                                    </div>
                                    <br class="clear" />
                                    <?php $grandTotal = 0; ?>
                                    <?php
                                                $showDiscountColumn = false;        
                                            foreach ($items_dataOP1 as $itemData1) {
                                                if (!empty($itemData1->discount) && $itemData1->discount != 0) {
                                                    $showDiscountColumn = true;
                                                    break;
                                                }

                                           
                                            }

                                            foreach  ($items as $itemData){
                                                if (!empty($itemData->discount) && $itemData->discount != 0) {
                                                    $showDiscountColumn = true;
                                                    break;
                                                } 
                                            }
                                            ?>
                                    <table class="table-print table-items"
                                        style="width: 100%; border-collapse: collapse;margin-top: 20px;">
                                        <thead>
                                            <tr>
                                                <th
                                                    style="background: #6a4a86;color: #fff; text-align: start;  padding: 5px 0; width:5%">
                                                    &nbsp; # 
                                                </th>
                                                <th
                                                    style="background: #6a4a86;color: #fff; text-align: start; padding: 5px 0; width:35%;">
                                                    Items
                                                </th>
                                                <th
                                                   class="item_type"  style="background: #6a4a86;color: #fff; text-align: start;  padding: 5px 0;width:12%">
                                                    Item
                                                    Type</th>
                                                <th
                                                    style="background: #6a4a86;color: #fff; text-align: start;  padding: 5px 0;width:12%">
                                                    Price</th>
                                                <th
                                                    style="background: #6a4a86;color: #fff; text-align: start;  padding: 5px 0;width:12%">
                                                    Qty
                                                </th>
                                                <?php if ($showDiscountColumn) { ?>
                                                <th
                                                    style="background: #6a4a86;color: #fff; text-align: start;  padding: 5px 0;width:12%">
                                                    Discount</th>
                                                <?php } ?>
                                                <th style="background: #6a4a86;color: #fff; text-align: start;  padding: 5px 8px 5px 0;width:12%"
                                                    class="text-right">Total</th>
                                            </tr>
                                        </thead>
                                
                                        <tbody>
                                            <?php if ($estimate_type == 'Option') { ?>
                                            <tr>
                                                <td colspan="6" style="padding:15px;">
                                                    <b>Option 1</b>
                                                </td>
                                            </tr>
                                            <?php 
                                             $count = 1;
                                            foreach ($items_dataOP1 as $itemData1) { 
                                           
                                                ?>

                                            <tr>
                                                <td valign="top" style="width:5%; text-align:start;"> <?php echo $count++; ?></td>
                                                <td valign="top" style="width:35%;">
                                                <p class="item_title_data">  <?php echo $itemData1->title; ?></p>
                                                  <p class="item_type_data">Item Type :  <?php echo $itemData1->type; ?></p>
                                                </td>
                                                <td valign="top" style="width:12%;" class="item_type_default"><?php echo $itemData1->type; ?></td>
                                                <td valign="top" style="width: 12%; text-align: start;">
                                                    <?php echo '$ '.number_format((float) $itemData1->costing, 2); ?>
                                                </td>

                                                <?php if ($showDiscountColumn) { ?>
                                                <td valign="top" style="width: 12%; text-align: start;">
                                                    <?php echo $itemData1->qty; ?></td>
                                                <td valign="top" style="width: 12%; text-align: start;">
                                                    <?php echo '$ '.$itemData1->discount; ?></td>
                                                <?php } else {?>
                                                <td valign="top" style="width: 24%; text-align: start;">
                                                    <?php echo $itemData1->qty; ?></td>
                                                <?php }  ?>
                                                <td valign="top" style="width: 12%; " class="total_column">
                                                    <?php echo '$ '.number_format((float) $itemData1->total, 2); ?></td>
                                            </tr>
                                            <?php } ?>

                                            <tr>
                                                <td colspan="6">
                                                    <hr />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" >
                                                <div class="message-td">
                                                <div class="message-term-column">
                                                 <h5 style="font-size: 16px"><b>Option 1 Message</b></h5>
                                                    <p><?php echo $option_message; ?></p>
                                                 </div>
                                           
                                                    <table style="width: 100%">
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                <p>Subtotal</p>
                                                            </td>
                                                            <td class="grand_total_column">
                                                                <p>$ <?php echo number_format((float) $sub_total, 2); ?>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                <p>Taxes</p>
                                                            </td>
                                                            <td class="grand_total_column">
                                                                <p>$ <?php echo number_format((float) $tax1_total, 2); ?>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                <p>Discount</p>
                                                            </td>
                                                            <td class="grand_total_column">
                                                                <p>$ <?php echo number_format((float) $adjustment_value, 2); ?>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4"
                                                                style="text-align: start; background-color: #dad1e0;">
                                                                <b>Grand Total</b>
                                                            </td>
                                                            <td  class="grand_total_column" style=" background-color: #dad1e0;">
                                                                <b>$
                                                                    <?php echo number_format((float) $option1_total, 2); ?></b>
                                                            </td>
                                                            <?php $grandTotal = (float) $option1_total; ?>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                Deposit Amount Requested
                                                            </td>
                                                            <td class="grand_total_column">
                                                                <?php
                                                                                                        $depositAmount = 0;
                                                $percentage = null;
                                                $isPercentage = in_array(trim($deposit_request), ['2', '%']); // 1 = $, 2 = %

                                                if ($isPercentage) {
                                                    $percentage = (float) $deposit_amount;
                                                    $depositAmount = ($percentage / 100) * $grandTotal;
                                                } else {
                                                    $depositAmount = (float) $deposit_amount;
                                                }
                                                ?>
                                                                $
                                                                <?php echo number_format((float) $depositAmount, 2); ?>
                                                                <?php if ($isPercentage) { ?>
                                                                (<?php echo $percentage; ?>%)
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <div class="message-term-column-bottom">
                                                 <h5 style="font-size: 16px"><b>Option 1 Message</b></h5>
                                                    <p><?php echo $option_message; ?></p>
                                                 </div>
                                                 </div>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td colspan="6" style="padding:15px;">
                                                    <div style="margin-top:20px"></div><b>Option 2</b>
                                                </td>
                                            </tr>
                                            <?php 
                                            $count=1;
                                            foreach ($items_dataOP2 as $itemData2) { 
                                           
                                                ?>
                                            <tr class="table-items__tr">
                                                <td valign="top" style="width:5%; text-align:start;"><?php  echo $count++; ?></td>
                                                <td valign="top" style="width:35%;;">
                                                <p class="item_title_data">  <?php echo $itemData2->title; ?></p>
                                                  <p class="item_type_data">Item Type :  <?php echo $itemData2->type; ?></p>
                                                </td>
                                                <td valign="top" style="width:12%;" class="item_type_default"><?php echo $itemData2->type; ?></td>
                                                <td valign="top" style="width: 12%; text-align: start;">
                                                    <?php echo number_format((float) $itemData2->costing, 2); ?></td>

                                                <?php if ($showDiscountColumn) { ?>
                                                <td valign="top" style="width: 12%; text-align: start;">
                                                    <?php echo $itemData2->qty; ?></td>
                                                <td valign="top" style="width: 12%; text-align: start;">
                                                    <?php echo '$ '.$itemData2->discount; ?></td>
                                                <?php }else {?>
                                                <td valign="top" style="width: 24%; text-align: start;">
                                                    <?php echo $itemData2->qty; ?></td>
                                                <?php }   ?>

                                                <td valign="top" style="width: 12%; " class="total_column">
                                                    <?php echo number_format((float) $itemData2->total, 2); ?></td>
                                            </tr>
                                            <?php } ?>
                                            

                                            <tr>
                                                <td colspan="6">
                                                    <hr />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="6">
                                                <div class="message-td">
                                                <div class="message-term-column">
                                              <h5 style="font-size: 16px"><b>Option 2 Message</b></h5>
                                                    <p><?php echo $option2_message; ?></p>
                                              </div>
                                                    <table style="width: 100%">
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                <p>Subtotal</p>
                                                            </td>
                                                            <td colspan="2" class="grand_total_column">
                                                                <p>$ <?php echo number_format((float) $sub_total2, 2); ?>
                                                                </p>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                <p>Discount</p>
                                                            </td>
                                                            <td class="grand_total_column">
                                                                <p>$ <?php echo number_format((float) $adjustment_value, 2); ?>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                <p>Taxes</p>
                                                            </td>
                                                            <td class="grand_total_column">
                                                                <p>$ <?php echo number_format((float) $tax2_total, 2); ?>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                <p>Discount</p>
                                                            </td>
                                                            <td class="grand_total_column">
                                                                <p>$ <?php echo number_format((float) $adjustment_value, 2); ?>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4"
                                                                style="text-align: start; background-color: #dad1e0;">
                                                                <b>Grand Total</b>
                                                            </td>
                                                            <td class="grand_total_column" style=" background-color: #dad1e0;">
                                                                <b>$
                                                                    <?php echo number_format((float) $option2_total, 2); ?></b>
                                                            </td>
                                                            <?php $grandTotal = (float) $option2_total; ?>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                Deposit Amount Requested
                                                            </td>
                                                            <td class="grand_total_column">
                                                                <?php
                                                            $depositAmount = 0;
                                                $percentage = null;
                                                $isPercentage = in_array(trim($deposit_request), ['2', '%']); // 1 = $, 2 = %

                                                if ($isPercentage) {
                                                    $percentage = (float) $deposit_amount;
                                                    $depositAmount = ($percentage / 100) * $grandTotal;
                                                } else {
                                                    $depositAmount = (float) $deposit_amount;
                                                }
                                                ?>
                                                                $
                                                                <?php echo number_format((float) $depositAmount, 2); ?>
                                                                <?php if ($isPercentage) { ?>
                                                                (<?php echo $percentage; ?>%)
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <div class="message-term-column-bottom">
                                              <h5 style="font-size: 16px"><b>Option 2 Message</b></h5>
                                                    <p><?php echo $option2_message; ?></p>
                                              </div>
                                               </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5">
                                                <div class="message-td">
                                                <div class="message-option" style="margin-top: 20px" >
                                                <div>
                                                        <h5 style="font-size: 16px"><b>Message</b></h5>
                                                        <p><?php if (!empty($customer_message)) {
                                                            echo $customer_message;
                                                        } else {
                                                            $output = 'If you have any questions or need more information, feel free to contact us at <b style="font-size: 10px; color:#6a4a86">'.formatPhoneNumber($business->phone_number).'';
                                                            echo $output;
                                                        } ?></p>
                                                    </div>
                                                    <div style="margin-top: 20px">
                                                        <h5 style="font-size: 16px"><b>Terms</b></h5>
                                                        <p><?php if (!empty($terms_conditions)) {
                                                            echo $terms_conditions;
                                                        } else {
                                                            $output = 'This document is strictly <span style="color:#6a4a86">private, confidential </span> and <span style="color:#6a4a86">personal</span> to its recipients and should not be copied, distributed, or reproduced in whole or in part, nor passed to any third party.  This estimate is based on available information at the time of estimation and is subject to change based on unforeseen circumstances or additional requirements.';
                                                            echo $output;
                                                        } ?></p>
                                                    </div>
                                                  </div>
                                                    <table style="width:100%">
                                                        <tr style="text-align:center">
                                                            <td colspan='5'>
                                                                <div style="margin-top: 60px">
                                                                    <p style="text-align:center">Powered By:</p>
                                                                    <img src="<?php echo base_url('assets/images/v2/logo.png'); ?>"
                                                                        style="width: 33%">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    </div>
                                                    </td>
                                            </tr>
                                            <tr>
                                                <td colspan="6">
                                                    <div style="margin-top: 40px;text-align: center">
                                                        <h5 style="font-size: 16px"><b>Instructions</b></h5>
                                                        <p style="font-size: 14px;">
                                                            <?php if (!empty($instructions)) { ?>
                                                            <?php echo $instructions; ?>
                                                            <?php } else {
                                                                $output = 'The following estimate request is being submitted for your approval.  Keep in mind, materials costs are subject to change and cannot be guaranteed until approval is received and your order is processed.';
                                                                echo $output;
                                                            } ?></p>
                                                    </div>
                                                    <div style="margin-top: 20px;text-align: start">
                                                        <h5 style="font-size:12px; font-weight: 700">Would you like to
                                                            proceed with accepting the estimate? </h5>
                                                        <div style="margin-top:20px;text-align: center">
                                                            <a href="<?php echo $urlDecline; ?>"
                                                                style="margin-bottom:15px;display: inline-block;outline: none;cursor: pointer;font-weight: 600;border-radius: 3px;padding: 12px 35px;border: 0;color: #fff;background: #d9534f;line-height: 1.15;font-size: 16px;text-decoration:none;">Reject</a>
                                                            <a href="<?php echo $urlApprove; ?>"
                                                                style="margin-bottom:15px; display: inline-block;outline: none;cursor: pointer;font-weight: 600;border-radius: 3px;padding: 12px 35px;border: 0;color: #fff;background: #5cb85c;line-height: 1.15;font-size: 16px;text-decoration:none;">Accept
                                                            </a>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>



                                            <?php } elseif ($estimate_type == 'Bundle') { ?>

                                            <tr>
                                                <td colspan="7" style="padding:15px;"><b>Bundle 1</b></td>
                                            </tr>
                                            <?php
                                            $count = 1;
                                            foreach ($items_dataBD1 as $itemDatabd1) {
                                          
                                                ?>
                                            <tr class="table-items__tr">
                                                <td valign="top" style="width:5%; text-align:start;"><?php echo $count++; ?></td>
                                                <td valign="top" style="width:35%;">
                                                  <p class="item_title_data">  <?php echo $itemDatabd1->title; ?></p>
                                                  <p class="item_type_data">Item Type :  <?php echo $itemDatabd1->type; ?></p>
                                                </td>
                                                <td valign="top" style="width:12%;" class="item_type_default"><?php echo $itemDatabd1->type; ?>
                                                </td>
                                                <td valign="top" style="width: 12%; text-align: start;">
                                                    <?php echo '$ '.number_format((float) $itemDatabd1->costing, 2); ?>
                                                </td>

                                                <?php if ($showDiscountColumn) { ?>
                                                <td valign="top" style="width: 12%; text-align: start;">
                                                    <?php echo $itemDatabd1->qty; ?></td>
                                                <td valign="top" style="width: 12%; text-align: start;">
                                                    <?php echo '$ '.$itemDatabd1->discount; ?></td>
                                                <?php } else {?>
                                                <td valign="top" style="width: 24%; text-align: start;">
                                                    <?php echo $itemDatabd1->qty; ?></td>
                                                <?php } ?>

                                                <td valign="top" style="width: 12%; " class="total_column">
                                                    <?php echo '$ '.number_format((float) $itemDatabd1->total, 2); ?>
                                                </td>
                                            </tr>
                                            <?php } ?>

                                            <tr>
                                                <td colspan="7">
                                                    <hr />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="8"  class="grandtotal-td">
                                                <div class="message-td">
                                                <div class="message-term-column">
                                                 <h5 style="font-size: 16px"><b>Bundle 1 Message</b></h5>
                                                <p><?php echo $bundle1_message; ?></p>
                                                 </div>
                                          
                                                  <table style="width: 100%">
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                <p>Subtotal</p>
                                                            </td>
                                                            <td colspan="2"  class="grand_total_column">
                                                                <p>$ <?php echo number_format((float) $sub_total, 2); ?>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                <p>Taxes</p>
                                                            </td>
                                                            <td  class="grand_total_column">
                                                                <p>$ <?php echo number_format((float) $tax1_total, 2); ?>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                <p>Discount</p>
                                                            </td>
                                                            <td  class="grand_total_column">
                                                                <p>$ <?php echo number_format((float) $adjustment_value, 2); ?>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4"
                                                                style="text-align: start; background-color: #dad1e0;">
                                                                <b>Grand Total</b>
                                                            </td>
                                                            <td   class="grand_total_column" style=" background-color: #dad1e0;">
                                                                <b>$
                                                                    <?php echo number_format((float) $bundle1_total, 2); ?></b>
                                                            </td>
                                                            <?php $grandTotal = (float) $bundle1_total; ?>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                Deposit Amount Requested
                                                            </td>
                                                            <td  class="grand_total_column">
                                                                <?php
                                                            $depositAmount = 0;
                                                $percentage = null;
                                                $isPercentage = in_array(trim($deposit_request), ['2', '%']); // 1 = $, 2 = %

                                                if ($isPercentage) {
                                                    $percentage = (float) $deposit_amount;
                                                    $depositAmount = ($percentage / 100) * $grandTotal;
                                                } else {
                                                    $depositAmount = (float) $deposit_amount;
                                                }
                                                ?>
                                                                $
                                                                <?php echo number_format((float) $depositAmount, 2); ?>
                                                                <?php if ($isPercentage) { ?>
                                                                (<?php echo $percentage; ?>%)
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <div class="message-term-column-bottom">
                                                 <h5 style="font-size: 16px"><b>Bundle 1 Message</b></h5>
                                                <p><?php echo $bundle1_message; ?></p>
                                                 </div>
                                                </div>
                                           
                                                </td>
                                            
                                                

                                            </tr>



                                            <tr>

                                                <td colspan="7" style="padding:15px;">
                                                    <div style="margin-top:20px"></div><b>Bundle 2</b>
                                                </td>
                                            </tr>
                                            <?php
                                            $count= 1;
                                            foreach ($items_dataBD2 as $itemDatabd2) { 
                                             
                                                ?>
                                            <tr class="table-items__tr">
                                                <td valign="top" style="width:5%; text-align:start;"><?php echo  $count++; ?></td>
                                                <td valign="top" style="width:35%;">
                                                <p class="item_title_data">  <?php echo $itemDatabd2->title; ?></p>
                                                  <p class="item_type_data">Item Type :  <?php echo $itemDatabd2->type; ?></p>
                                                </td>
                                                <td valign="top" style="width:12%;" class="item_type_default"><?php echo $itemDatabd2->type; ?>
                                                </td>
                                                <td valign="top" style="width: 12%; text-align: start;">
                                                    <?php echo '$ '.number_format((float) $itemDatabd2->costing, 2); ?>
                                                </td>

                                                <?php if ($showDiscountColumn) { ?>
                                                <td valign="top" style="width: 12%; text-align: start;">
                                                    <?php echo $itemDatabd2->qty; ?></td>
                                                <td valign="top" style="width: 12%; text-align: start;">
                                                    <?php echo '$ '.$itemDatabd2->discount; ?></td>
                                                <?php }else {?>
                                                <td valign="top" style="width: 24%; text-align: start;">
                                                    <?php echo $itemDatabd2->qty; ?></td>
                                                <?php }  ?>

                                                <td valign="top" style="width: 12%; " class="total_column">
                                                    <?php echo '$ '.number_format((float) $itemDatabd2->total, 2); ?>
                                                </td>
                                            </tr>
                                            <?php } ?>

                                            <tr>
                                                <td colspan="7">
                                                    <hr />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="8" class="grandtotal-td">
                                                <div class="message-td">
                                                <div class="message-term-column">
                                                 <h5 style="font-size: 16px"> <b>Bundle 2 Message</b></h5>
                                                    <p><?php echo $bundle2_message; ?></p>
                                                 </div>
                                                       
                                                 <table style="width: 100%">
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                <p>Subtotal</p>
                                                            </td>
                                                            <td  class="grand_total_column">
                                                                <p>$ <?php echo number_format((float) $sub_total2, 2); ?>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                <p>Taxes</p>
                                                            </td>
                                                            <td  class="grand_total_column">
                                                                <p>$ <?php echo number_format((float) $tax2_total, 2); ?>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                <p>Discount</p>
                                                            </td>
                                                            <td  class="grand_total_column" >
                                                                <p>$ <?php echo number_format((float) $adjustment_value, 2); ?>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4"
                                                                style="text-align: start; background-color: #dad1e0;">
                                                                <b>Grand Total</b>
                                                            </td>
                                                            <td  class="grand_total_column" style="background-color: #dad1e0;">
                                                                <b>$
                                                                    <?php echo number_format((float) $bundle2_total, 2); ?></b>
                                                            </td>
                                                            <?php $grandTotal = (float) $bundle2_total; ?>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                Deposit Amount Requested
                                                            </td>
                                                            <td  class="grand_total_column">
                                                                <?php
                                                            $depositAmount = 0;
                                                $percentage = null;
                                                $isPercentage = in_array(trim($deposit_request), ['2', '%']); // 1 = $, 2 = %

                                                if ($isPercentage) {
                                                    $percentage = (float) $deposit_amount;
                                                    $depositAmount = ($percentage / 100) * $grandTotal;
                                                } else {
                                                    $depositAmount = (float) $deposit_amount;
                                                }
                                                ?>
                                                                $
                                                                <?php echo number_format((float) $depositAmount, 2); ?>
                                                                <?php if ($isPercentage) { ?>
                                                                (<?php echo $percentage; ?>%)
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <div class="message-term-column-bottom">
                                                 <h5 style="font-size: 16px"><b>Bundle 1 Message</b></h5>
                                                <p><?php echo $bundle2_message; ?></p>
                                                 </div>
                                                </div>
                                               </div>
                                                </td>
                                              
                                            </tr>
                                            <tr>
                                                <td colspan='8'>
                                                  <div class="message-td">
                                                  <div style="margin-top: 20px" class="message-term-column">
                                                  <div>
                                                        <h5 style="font-size: 16px"><b>Message</b></h5>
                                                        <p><?php if (!empty($customer_message)) {
                                                            echo $customer_message;
                                                        } else {
                                                            $output = 'If you have any questions or need more information, feel free to contact us at <b style="font-size: 10px; color:#6a4a86">'.formatPhoneNumber($business->phone_number).'';
                                                            echo $output;
                                                        } ?></p>
                                                    </div>
                                                    <div style="margin-top: 20px">
                                                        <h5 style="font-size: 16px"><b>Terms</b></h5>
                                                        <p><?php if (!empty($terms_conditions)) {
                                                            echo $terms_conditions;
                                                        } else {
                                                            $output = 'This document is strictly <span style="color:#6a4a86">private, confidential </span> and <span style="color:#6a4a86">personal</span> to its recipients and should not be copied, distributed, or reproduced in whole or in part, nor passed to any third party.  This estimate is based on available information at the time of estimation and is subject to change based on unforeseen circumstances or additional requirements.';
                                                            echo $output;
                                                        } ?></p>
                                                    </div>
                                                  </div>
                                                  <table style="width:100%">
                                                        <tr style="text-align:center">
                                                            <td colspan='5'>
                                                                <div style="margin-top: 60px">
                                                                    <p style="text-align:center">Powered By:</p>
                                                                    <img src="<?php echo base_url('assets/images/v2/logo.png'); ?>"
                                                                        style="width: 33%">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>

                                                </td>
                                             
                                            </tr>
                                            <tr>
                                                <td colspan="8">
                                                    <div style="margin-top: 40px;text-align: center">
                                                        <h5 style="font-size: 16px"><b>Instructions</b></h5>
                                                        <p style="font-size:14px"><?php if (!empty($instructions)) { ?>
                                                            <?php echo $instructions; ?>
                                                            <?php } else {
                                                                $output = 'The following estimate request is being submitted for your approval.  Keep in mind, materials costs are subject to change and cannot be guaranteed until approval is received and your order is processed.';
                                                                echo $output;
                                                            } ?></p>
                                                    </div>
                                                    <div style="margin-top: 20px;text-align: start">
                                                        <h5 style="font-size:12px; font-weight: 700">Would you like to
                                                            proceed with accepting the estimate? </h5>
                                                        <div style="margin-top:20px;text-align: center">
                                                            <a href="<?php echo $urlDecline; ?>"
                                                                style=" margin-bottom: 15px; display: inline-block;outline: none;cursor: pointer;font-weight: 600;border-radius: 3px;padding: 12px 35px;border: 0;color: #fff;background: #d9534f;line-height: 1.15;font-size: 16px;text-decoration:none;">Reject</a>
                                                            <a href="<?php echo $urlApprove; ?>"
                                                                style="display: inline-block;outline: none;cursor: pointer;font-weight: 600;border-radius: 3px;padding: 12px 35px;border: 0;color: #fff;background: #5cb85c;line-height: 1.15;font-size: 16px;text-decoration:none;">Accept
                                                            </a>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>



                                            <?php } else { ?>
                                            <?php  $count= 1; foreach ($items as $itemData) { ?>
                                            <tr class="table-items__tr">
                                                <td valign="top" style="width:5%; text-align:start;">&nbsp;&nbsp;<?php echo $count++; ?></td>
                                                <td valign="top" style="width:35%;"><p class="item_title_data"><?php echo $itemData->title; ?></p>
                                            <p class="item_type_data"><span>Item Type : </span><?php echo $itemData->type; ?></p></td>
                                                <td valign="top" style="width:12%;" class="item_type_default"><?php echo $itemData->type; ?></td>
                                                <td valign="top" style="width: 12%; text-align: start;">
                                                    <?php echo number_format((float) $itemData->iCost, 2); ?></td>

                                                <?php if ($showDiscountColumn) { ?>
                                                <td valign="top" style="width: 12%; text-align: start;">
                                                    <?php echo $itemData->qty; ?></td>
                                                <td valign="top" style="width: 12%; text-align: start;">
                                                    <?php echo '$ '.$itemData->discount; ?></td>
                                                <?php } else {?>
                                                <td valign="top" style="width: 24%; text-align: start;">
                                                    <?php echo $itemData->qty; ?></td>
                                                <?php } ?>

                                                <td valign="top" style="width: 12%;" class="total_column">
                                                    <?php echo number_format((float) $itemData->iTotal, 2); ?></td>
                                            </tr>
                                      
                                            <?php } ?>
                                    

                                            <tr>
                                                <td colspan="7">
                                                    <hr />
                                                </td>
                                            </tr>
                                            <tr>

                                                <td colspan="8" >
                                                <div class="message-td">
                                                <div class="message-term-column">
                                                  <div>
                                                        <h5 style="font-size: 16px"><b>Message</b></h5>
                                                        <p><?php if (!empty($customer_message)) {
                                                            echo $customer_message;
                                                        } else {
                                                            $output = 'If you have any questions or need more information, feel free to contact us at <b style="font-size: 10px; color:#6a4a86">'.formatPhoneNumber($business->phone_number).'';
                                                            echo $output;
                                                        } ?></p>
                                                    </div>
                                                    <div style="margin-top: 20px">
                                                        <h5 style="font-size: 16px"><b>Terms</b></h5>
                                                        <p><?php if (!empty($terms_conditions)) {
                                                            echo $terms_conditions;
                                                        } else {
                                                            $output = 'This document is strictly <span style="color:#6a4a86">private, confidential </span> and <span style="color:#6a4a86">personal</span> to its recipients and should not be copied, distributed, or reproduced in whole or in part, nor passed to any third party.  This estimate is based on available information at the time of estimation and is subject to change based on unforeseen circumstances or additional requirements.';
                                                            echo $output;
                                                        } ?></p>
                                                    </div>
                                                  </div>

                                              

                                   
                                                    <table style="width: 100%">
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                <p>Subtotal</p>
                                                            </td>
                                                            <td  class="grand_total_column">
                                                                <p>$ <?php echo number_format((float) $sub_total, 2); ?>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                <p>Taxes</p>
                                                            </td>
                                                            <td colspan="2"  class="grand_total_column">
                                                                <p>$ <?php echo number_format((float) $tax1_total, 2); ?>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                <p>Discount</p>
                                                            </td>
                                                            <td colspan="2"  class="grand_total_column">
                                                                <p>$ <?php echo number_format((float) $adjustment_value, 2); ?>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4"
                                                                style="text-align: start; background-color: #dad1e0;">
                                                                <p><b>Grand Total</b></p>
                                                            </td>
                                                            <td colspan="2" class="grand_total_column"
                                                                style="background-color: #dad1e0;">
                                                                <p><b>$
                                                                        <?php echo number_format((float) $grand_total, 2); ?></b>
                                                                </p>
                                                            </td>
                                                            <?php $grandTotal = (float) $grand_total; ?>
                                                        </tr>

                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                <p>Deposit Amount Requested</p>
                                                            </td>
                                                            <td colspan="2" class="grand_total_column">
                                                                <?php
                                                                        $depositAmount = 0;
                                                $percentage = null;
                                                $isPercentage = in_array(trim($deposit_request), ['2', '%']); // 1 = $, 2 = %

                                                if ($isPercentage) {
                                                    $percentage = (float) $deposit_amount;
                                                    $depositAmount = ($percentage / 100) * $grandTotal;
                                                } else {
                                                    $depositAmount = (float) $deposit_amount;
                                                }
                                                ?>
                                                                $
                                                                <?php echo number_format((float) $depositAmount, 2); ?>
                                                                <?php if ($isPercentage) { ?>
                                                                (<?php echo $percentage; ?>%)
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                        <tr style="text-align:center">
                                                            <td colspan='5'>
                                                                <div style="margin-top: 60px">
                                                                    <p style="text-align:center">Powered By:</p>
                                                                    <img src="<?php echo base_url('assets/images/v2/logo.png'); ?>"
                                                                        style="width: 33%">
                                                                </div>
                                                            </td>
                                                        </tr>

                                                    </table>

                                                    <div class="message-term-column-bottom">
                                                  <div>
                                                        <h5 style="font-size: 16px"><b>Message</b></h5>
                                                        <p><?php if (!empty($customer_message)) {
                                                            echo $customer_message;
                                                        } else {
                                                            $output = 'If you have any questions or need more information, feel free to contact us at <b style="font-size: 10px; color:#6a4a86">'.formatPhoneNumber($business->phone_number).'';
                                                            echo $output;
                                                        } ?></p>
                                                    </div>
                                                    <div style="margin-top: 20px">
                                                        <h5 style="font-size: 16px"><b>Terms</b></h5>
                                                        <p><?php if (!empty($terms_conditions)) {
                                                            echo $terms_conditions;
                                                        } else {
                                                            $output = 'This document is strictly <span style="color:#6a4a86">private, confidential </span> and <span style="color:#6a4a86">personal</span> to its recipients and should not be copied, distributed, or reproduced in whole or in part, nor passed to any third party.  This estimate is based on available information at the time of estimation and is subject to change based on unforeseen circumstances or additional requirements.';
                                                            echo $output;
                                                        } ?></p>
                                                    </div>
                                                  </div>
                                                </div>

                                           

                                            </tr>
                                            <tr>
                                                <td colspan="8">
                                                    <div style="margin-top: 20px;text-align: center">
                                                        <h5 style="font-size: 16px"><b>Instructions</b></h5>
                                                        <p style="font-size: 14px">
                                                            <?php if (!empty($instructions)) { ?>
                                                            <?php echo $instructions; ?>
                                                            <?php } else {
                                                                $output = 'The following estimate request is being submitted for your approval.  Keep in mind, materials costs are subject to change and cannot be guaranteed until approval is received and your order is processed.';
                                                                echo $output;
                                                            } ?></p>
                                                    </div>
                                                    <div style="margin-top: 20px;text-align: start">
                                                        <h5 style="font-size:12px; font-weight: 700">Would you like to
                                                            proceed with accepting the estimate? </h5>
                                                        <div style="margin-top:20px;text-align: center; ">
                                                            <a href="<?php echo $urlDecline; ?>"
                                                                style="margin-bottom:15px; display: inline-block;outline: none;cursor: pointer;font-weight: 600;border-radius: 3px;padding: 12px 35px;border: 0;color: #fff;background: #d9534f;line-height: 1.15;font-size: 16px;text-decoration:none;">Reject</a>
                                                            <a href="<?php echo $urlApprove; ?>"
                                                                style="display: inline-block;outline: none;cursor: pointer;font-weight: 600;border-radius: 3px;padding: 12px 35px;border: 0;color: #fff;background: #5cb85c;line-height: 1.15;font-size: 16px;text-decoration:none;">Accept
                                                            </a>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                    <br />




                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <img src="<?php echo base_url('tracker/estimate_image_tracker?id='.$eid); ?>"> -->
        <!-- <br> &emsp; -->
        <br></br>
    </div>
</body>

</html>