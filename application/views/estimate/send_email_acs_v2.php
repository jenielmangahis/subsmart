<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="x-apple-disable-message-reformatting" />
    <title>Work Order</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body style="font-family: Gill Sans, sans-serif; font-size: 16px;" >
<div style="width: 100%;margin: 0 auto;">    
    </style>
    <div style="padding: 10px;">
        <div style="margin-top:10px;margin-bottom: 35px;">
            <img src="<?= getCompanyBusinessProfileImage(); ?>"  style="width:102px;" />
        </div>
        <div style="margin-bottom:10px">
            <ul style="list-style: none;padding: 0px;">
                <li style="display:inline-block; width:70%;margin:0px;">Estimate Number : <b><?= $estimate_number; ?></b></li>
                <li style="display:inline-block; width:70%;margin:0px;">Estimate Date : <b><?= date("F d, Y",strtotime($estimate_date)); ?></b>
                <li style="display:inline-block; width:70%;margin:0px;">Expiry Date : <b><?= date("F d, Y",strtotime($expiry_date)); ?></b></li>
            </ul>
        </div>
        <div style="margin-bottom:5px; border-top: 1px solid;">
            <h3 style="font-size:15px;">FROM : <?= $company; ?></h3>
            <ul style="list-style: none;padding: 0px;">            
                <li style="display:inline-block; width:70%;margin:0px;"><?= $business_address; ?></li>            
                <li style="display:inline-block; width:70%;margin:0px;"><?= $email_address; ?></li>            
                <li style="display:inline-block; width:70%;margin:0px;"><?= $phone_number; ?></li>
            </ul>
        </div>
        <div style="margin-bottom:10px; border-top: 1px solid;">
            <h3 style="font-size:15px;">TO : <?= $acs_name; ?></h3>
            <ul style="list-style: none;padding: 0px;">            
                <li style="display:inline-block; width:70%;margin:0px;"><?= $acsaddress; ?></li>            
                <li style="display:inline-block; width:70%;margin:0px;"><?= $acsemail; ?></li>            
                <li style="display:inline-block; width:70%;margin:0px;"><?= $phone_m; ?></li>
            </ul>
        </div>
        <div style="margin-bottom: 10px;border-top: 1px solid;">
            <table style="width: 100%;">
                <tr>
                    <td style="text-align: center; padding: 5px;">#</td>
                    <td style="text-align: left; padding: 5px;">Items</td>
                    <td style="text-align: left; padding: 5px;">Item Type</td>
                    <td style="text-align: right; padding: 5px;">Price</td>
                    <td style="text-align: right; padding: 5px;">Qty</td>
                    <td style="text-align: right; padding: 5px;">Discount</td>
                    <td style="text-align: right; padding: 5px;">Total</td>
                </tr>
                <?php if($estimate_type == 'Option'){ ?>
                    <tr>
                        <td colspan="7" style="padding:15px;"><b>Option 1</b></td>
                    </tr>
                    <?php $row = 1; ?>
                    <?php foreach($items_dataOP1 as $itemData1){ ?>
                        <tr class="table-items__tr">
                        <td valign="top" style="width:20px; text-align:center;padding: 5px;">a<?= $row; ?></td>
                        <td valign="top" style="width:300px;padding: 5px;"><?= $itemData1->title; ?></td>
                        <td valign="top" style="width:200px;padding: 5px;"><?= $itemData1->type; ?></td>
                        <td valign="top" style="width:100px;padding: 5px;text-align: right;"><?= number_format((float) $itemData1->costing,2); ?></td>
                        <td valign="top" style="width:100px;padding: 5px;text-align: right;"><?= $itemData1->qty; ?></td>
                        <td valign="top" style="width:100px;padding: 5px;text-align: right;"><?= $itemData1->discount; ?></td>
                        <td valign="top" style="width:100px;padding: 5px;text-align: right;"><?= number_format((float) $itemData1->total,2); ?></td>
                        </tr>
                    <?php $row++;} ?>
                    <tr><td colspan="7"><hr/></td></tr>
                    <tr>
                    <td colspan="5" style="text-align: right;"><p>Subtotal</p></td>
                    <td colspan="2" style="text-align: right;"><p>$ <?= number_format((float) $sub_total, 2); ?></p></td>
                    </tr>
                    <tr>
                    <td colspan="5" style="text-align: right;"><p>Taxes</p></td>
                    <td colspan="2" style="text-align: right;"><p>$ <?= number_format((float) $tax1_total, 2); ?></p></td>
                    </tr>
                    <tr>
                    <td colspan="5" style="text-align: right;"><b>TOTAL AMOUNT</b></td>
                    <td colspan="2" style="text-align: right;"><b>$ <?= number_format((float) $option1_total, 2); ?></b></td>
                    <?php $grandTotal = (float) $option1_total; ?>
                    </tr>
                    <tr>
                        <td colspan="7" style="padding-top:15px;"><b>Option 1 Message</b></td>
                    </tr>
                    <tr>
                        <td colspan="7" style="padding-bottom:30px;"><?= $option_message; ?></td>
                    </tr>

                    <tr>
                        <td colspan="7" style="padding:15px;"><b>Option 2</b></td>
                    </tr>
                    <?php $row = 1; ?>
                    <?php foreach($items_dataOP2 as $itemData2){ ?>
                        <tr class="table-items__tr">
                        <td valign="top" style="width:20px; text-align:center;padding: 5px;">b<?= $row; ?></td>
                        <td valign="top" style="width:300px;padding: 5px;"><?= $itemData2->title; ?></td>
                        <td valign="top" style="width:200px;padding: 5px;"><?= $itemData2->type; ?></td>
                        <td valign="top" style="width:100px;padding: 5px;text-align: right;"><?= number_format((float) $itemData2->costing,2); ?></td>
                        <td valign="top" style="width:100px;padding: 5px;text-align: right;"><?= $itemData2->qty; ?></td>
                        <td valign="top" style="width:100px;padding: 5px;text-align: right;"><?= $itemData2->discount; ?></td>
                        <td valign="top" style="width:100px;padding: 5px;text-align: right;"><?= number_format((float) $itemData2->total,2); ?></td>
                        </tr>
                    <?php $row++;} ?>
                    
                    <tr><td colspan="7"><hr/></td></tr>
                    <tr>
                    <td colspan="5" style="text-align: right;"><p>Subtotal</p></td>
                    <td colspan="2" style="text-align: right;"><p>$ <?= number_format((float) $sub_total2, 2); ?></p></td>
                    </tr>
                    <tr>
                    <td colspan="5" style="text-align: right;"><p>Taxes</p></td>
                    <td colspan="2" style="text-align: right;"><p>$ <?= number_format((float) $tax2_total, 2); ?></p></td>
                    </tr>
                    <tr>
                    <td colspan="5" style="text-align: right;"><b>TOTAL AMOUNT</b></td>
                    <td colspan="2" style="text-align: right;"><b>$ <?= number_format((float) $option2_total, 2); ?></b></td>
                    <?php $grandTotal = (float) $option2_total; ?>
                    </tr>
                    <tr>
                        <td colspan="7" style="padding-top:15px;"><b>Option 2 Message</b></td>
                    </tr>
                    <tr>
                        <td colspan="7" style="padding-bottom:15px;"><?= $option2_message; ?></td>
                    </tr>

                <?php }elseif($estimate_type == 'Bundle'){ ?>
                    <tr>
                        <td colspan="7" style="padding:15px;"><b>Bundle 1</b></td>
                    </tr>
                    <?php $row = 1; ?>
                    <?php foreach($items_dataBD1 as $itemDatabd1){ ?>
                        <tr class="table-items__tr">
                        <td valign="top" style="width:20px;padding: 5px;text-align:center;">c<?= $row; ?></td>
                        <td valign="top" style="width:300px;padding: 5px;"><?= $itemDatabd1->title; ?></td>
                        <td valign="top" style="width:200px;padding: 5px;"><?= $itemDatabd1->type; ?></td>
                        <td valign="top" style="width:100px;padding: 5px;text-align: right;"><?= number_format((float) $itemDatabd1->costing,2); ?></td>
                        <td valign="top" style="width:100px;padding: 5px;text-align: right;"><?= $itemDatabd1->qty; ?></td>
                        <td valign="top" style="width:100px;padding: 5px;text-align: right;"><?= $itemDatabd1->discount; ?></td>
                        <td valign="top" style="width:100px;padding: 5px;text-align: right;"><?= number_format((float) $itemDatabd1->total,2); ?></td>
                        </tr>
                    <?php $row++;} ?>
                    
                    <tr><td colspan="7"><hr/></td></tr>
                    <tr>
                    <td colspan="5" style="text-align: right;"><p>Subtotal</p></td>
                    <td colspan="2" style="text-align: right;"><p>$ <?= number_format((float) $sub_total, 2); ?></p></td>
                    </tr>
                    <tr>
                    <td colspan="5" style="text-align: right;"><p>Taxes</p></td>
                    <td colspan="2" style="text-align: right;"><p>$ <?= number_format((float) $tax1_total, 2); ?></p></td>
                    </tr>
                    <tr>
                    <td colspan="5" style="text-align: right;"><b>TOTAL AMOUNT</b></td>
                    <td colspan="2" style="text-align: right;"><b>$ <?= number_format((float) $bundle1_total, 2); ?></b></td>
                    <?php $grandTotal = (float) $bundle1_total; ?>
                    </tr>
                    <tr>
                        <td colspan="7" style="padding-top:15px;"><b>Bundle 1 Message</b></td>
                    </tr>
                    <tr>
                        <td colspan="7" style="padding-bottom:30px;"><?= $bundle1_message; ?></td>
                    </tr>

                    <tr>
                        <td colspan="7" style="padding:15px;"><b>Bundle 2</b></td>
                    </tr>
                    <?php $row = 1; ?>
                    <?php foreach($items_dataBD2 as $itemDatabd2){ ?>
                        <tr class="table-items__tr">
                        <td valign="top" style="width:20px;padding: 5px;text-align:center;">d<?= $row; ?></td>
                        <td valign="top" style="width:300px;padding: 5px;"><?= $itemDatabd2->title; ?></td>
                        <td valign="top" style="width:200px;padding: 5px;"><?= $itemDatabd2->type; ?></td>
                        <td valign="top" style="width:100px;padding: 5px;text-align: right;"><?= number_format((float) $itemDatabd2->costing,2); ?></td>
                        <td valign="top" style="width:100px;padding: 5px;text-align: right;"><?= $itemDatabd2->qty; ?></td>
                        <td valign="top" style="width:100px;padding: 5px;text-align: right;"><?= $itemDatabd2->discount; ?></td>
                        <td valign="top" style="width:100px;padding: 5px;text-align: right;"><?= number_format((float) $itemDatabd2->total,2); ?></td>
                        </tr>
                    <?php $row++;} ?>
                    
                    <tr><td colspan="7"><hr/></td></tr>
                    <tr>
                    <td colspan="5" style="text-align: right;"><p>Subtotal</p></td>
                    <td colspan="2" style="text-align: right;"><p>$ <?= number_format((float) $sub_total2, 2); ?></p></td>
                    </tr>
                    <tr>
                    <td colspan="5" style="text-align: right;"><p>Taxes</p></td>
                    <td colspan="2" style="text-align: right;"><p>$ <?= number_format((float) $tax2_total, 2); ?></p></td>
                    </tr>
                    <tr>
                    <td colspan="5" style="text-align: right;"><b>TOTAL AMOUNT</b></td>
                    <td colspan="2" style="text-align: right;"><b>$ <?= number_format((float) $bundle2_total, 2); ?></b></td>
                    <?php $grandTotal = (float) $bundle2_total; ?>
                    </tr>
                    <tr>
                        <td colspan="7" style="padding-top:15px;"><b>Bundle 2 Message</b></td>
                    </tr>
                    <tr>
                        <td colspan="7" style="padding-bottom:15px;"><?= $bundle2_message; ?></td>
                    </tr>

                <?php }else{ ?>
                    <?php $row = 1; ?>
                    <?php foreach($items as $itemData){ ?>
                        <tr class="table-items__tr">
                        <td valign="top" style="width:20px;padding: 5px;text-align:center;"><?= $row; ?></td>
                        <td valign="top" style="width:300px;padding: 5px;"><?= $itemData->title; ?></td>
                        <td valign="top" style="width:200px;padding: 5px;"><?= $itemData->type; ?></td>
                        <td valign="top" style="width:100px;padding: 5px;text-align: right;"><?= number_format((float) $itemData->iCost,2); ?></td>
                        <td valign="top" style="width:100px;padding: 5px;text-align: right;"><?= $itemData->qty; ?></td>
                        <td valign="top" style="width:100px;padding: 5px;text-align: right;"><?= $itemData->discount; ?></td>
                        <td valign="top" style="width:100px;padding: 5px;text-align: right;"><?= number_format((float) $itemData->iTotal,2); ?></td>
                        </tr>
                    <?php $row++;} ?>
                    <?php
                        $depositAmount = 0;
                        $percentage = null;
                        $isPercentage = in_array(trim($deposit_request), ['2', '%']); // 1 = $, 2 = %

                        if ($isPercentage) {
                            $percentage = (float) $deposit_amount;
                            $depositAmount = ($percentage / 100) * $grand_total;
                        } else {
                            $depositAmount = (float) $deposit_amount;
                        }

                        $grand_total = $grand_total - $deposit_amount;
                    ?>
                    <tr><td colspan="7"><hr/></td></tr>
                    <tr>
                    <td colspan="5" style="text-align: right;"><p>Subtotal</p></td>
                    <td colspan="2" style="text-align: right;"><p>$ <?= number_format((float) $sub_total, 2); ?></p></td>
                    </tr>
                    <tr>
                    <td colspan="5" style="text-align: right;"><p>Taxes</p></td>
                    <td colspan="2" style="text-align: right;"><p>$ <?= number_format((float) $tax1_total, 2); ?></p></td>
                    </tr>
                    <tr>
                    <td colspan="5" style="text-align: right;"><p>Deposit Amount</p></td>
                    <td colspan="2" style="text-align: right;"><p>$ <?= number_format((float) $depositAmount, 2); ?></p></td>
                    </tr>
                    <tr>
                    <td colspan="5" style="text-align: right;"><b>TOTAL AMOUNT</b></td>
                    <td colspan="2" style="text-align: right;"><b>$ <?= number_format((float) $grand_total, 2); ?></b></td>
                    <?php $grandTotal = (float) $grand_total; ?>
                    </tr>
                <?php } ?>            
            </table> 
        </div>

        <div style="margin-bottom:10px;border-top: 1px solid;">
            <?php if (!empty($instructions)): ?>                
                <h3 style="font-size:15px;">INSTRUCTIONS</h3>
                <p><?= $instructions; ?></p>                
            <?php endif; ?>

            <?php if (!empty($customer_message)): ?>
                <h3 style="font-size:15px;margin-top: 5px;">MESSAGE</h3>
                <p><?= $customer_message; ?></p>
            <?php endif; ?>

            <?php if (!empty($terms_conditions)): ?>
                <h3 style="font-size:15px;margin-top: 5px;">TERMS</h3>
                <p><?= $terms_conditions; ?></p>
            <?php endif; ?>
        </div>

        <div style="margin-top: 10px;">
            <a href="<?php  echo $urlApprove; ?>" style="margin: 5px;display: inline-block;outline: none;cursor: pointer;font-weight: 600;border-radius: 3px;padding: 12px 24px;border: 0;color: #000021;background: #1de9b6;line-height: 1.15;font-size: 16px;text-decoration:none;">Accept Estimate</a> 
            <a href="<?php  echo $urlDecline; ?>" style="display: inline-block;outline: none;cursor: pointer;font-weight: 600;border-radius: 3px;padding: 12px 24px;border: 0;color: #fff;background: #ff5000;line-height: 1.15;font-size: 16px;text-decoration:none;">Decline Estimate</a>
        </div>
    </div>

    <img src="<?= base_url('tracker/estimate_image_tracker?id='.$eid); ?>">
    <!-- <br> &emsp; -->
    <br></br>
</div>
</body>
</html>
