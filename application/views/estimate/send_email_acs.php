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
        @media (max-width: 550px) {
            a{
                min-width: 80% !important;
            }
        }
        body
        {
            color: black;
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

        /* table { 
            width: 750px; 
            border-collapse: collapse; 
            margin:50px auto;
            }

        tr:nth-of-type(odd) { 
            background: #eee; 
            }

        th { 
            background: #3498db; 
            color: white; 
            font-weight: bold; 
            }

        td, th { 
            padding: 10px; 
            border: 1px solid #ccc; 
            text-align: left; 
            font-size: 18px;
            } */

        /* 
        Max width before this PARTICULAR table gets nasty
        This query will take effect for any screen smaller than 760px
        and also iPads specifically.
        */
        @media 
        only screen and (max-width: 760px),
        (min-device-width: 768px) and (max-device-width: 1024px)  {

            table { 
                width: 100%; 
            }

            /* Force table to not be like tables anymore */
            table, thead, tbody, th, td, tr { 
                display: block; 
            }
            
            /* Hide table headers (but not display: none;, for accessibility) */
            thead tr { 
                position: absolute;
                top: -9999px;
                left: -9999px;
            }
            
            tr { border: 1px solid #ccc; }
            
            td { 
                /* Behave  like a "row" */
                border: none;
                border-bottom: 1px solid #eee; 
                position: relative;
                padding-left: 50%; 
            }

            td:before { 
                /* Now like a table header */
                position: absolute;
                /* Top/left values mimic padding */
                top: 6px;
                left: 6px;
                width: 45%; 
                padding-right: 10px; 
                white-space: nowrap;
                /* Label the data */
                content: attr(data-column);

                color: #000;
                font-weight: bold;
            }

        }

        span.invoice-txt {
            color: #45a6ff;
            }
    </style>
</head>
<body style="font-family: Gill Sans, sans-serif; font-size: 16px;" >
<div style="box-shadow:0 2px 8px 0 rgba(0,0,0,.2);background-color: #fff;border: 1px solid #d4d7dc;-webkit-transition: all .3s ease;position:relative;top:20px;width: 95%;margin: 0 auto;">
    <div>
        <div>
            <div>
                <div style="padding: 20px;">
                    <div style="padding: 10px;">
                        <div>
                            <h2>ESTIMATES</h2>
                        </div>
                        <div class="">
                            <div id="printableArea" style="">
                            <div style="margin-bottom: 20px;margin-left: 0px !important;margin-top:100px;">
                                <!-- <img class="presenter-print-logo" style="max-width: 230px; max-height: 200px;" src="http://nsmartrac.com/assets/dashboard/images/logo.png"> -->
                                <img src="<?= getCompanyBusinessProfileImage(); ?>"  style="max-width: 230px; max-height: 200px;" />
                            </div>
                            
                                <div class="col-xl-5 right" style="float: right">
                                    <div style="text-align: right;">
                                    <h5 style="font-size:30px;margin:0px;">ESTIMATE</h5>
                                    <small style="font-size: 14px;">#<?= $estimate_number; ?></small>
                                    </div>
                                    <div class="" style="float: right;margin-top: 20px;">
                                    <table style="text-align: right;">
                                        <tr>
                                        <td style="text-align: right;">Estimate Date: &emsp;</td>
                                        <td><?= date("F d, Y",strtotime($estimate_date)); ?></td>
                                        </tr>
                                        <tr>
                                        <td style="text-align: right;">Expiry Date: &emsp;</td>
                                        <td><?= date("F d, Y",strtotime($expiry_date)); ?></td>
                                        </tr>
                                    </table>
                                    </div>
                                </div>

                                <div class="col-xl-5 left" style="margin-bottom: 33px;">
                                <h5><span class="fa fa-user-o fa-margin-right"></span> From <br> <span class="invoice-txt"> <?= $company; ?></span></h5>
                                <div class="col-xl-5 ml-0 pl-0">
                                    <span class=""><?= $business_address; ?></span><br />
                                    <span class="">EMAIL: <?= $email_address; ?></span><br />
                                    <span class="">PHONE: <?= $phone_number; ?></span>
                                </div>
                                </div>
                                <div class="clear"></div>
                                <div class="col-xl-5 left">
                                <h5><span class="fa fa-user-o fa-margin-right"></span> To <br> <span class="invoice-txt"> <?= $acs_name; ?></span></h5> 
                                <div class="col-xl-5 ml-0 pl-0">
                                    <span class=""><?= $acsaddress ?></span><br />
                                    <span class="">EMAIL: <span class=""><?= $acsemail; ?></span><br />
                                    <span class="">PHONE: <span class=""><?= $phone_m; ?></span><br />
                                </div>
                                </div>
                                <br class="clear"/>    
                                <table class="table-print table-items" style="width: 100%; border-collapse: collapse;margin-top: 55px;">
                                <thead>
                                    <tr>
                                        <th style="background: #f4f4f4; text-align: center; padding: 5px 0;">#</th>
                                        <th style="background: #f4f4f4; text-align: left; padding: 5px 0;">Items</th>
                                        <th style="background: #f4f4f4; text-align: left; padding: 5px 0;">Item Type</th>
                                        <th style="background: #f4f4f4; text-align: right; padding: 5px 0;">Price</th>
                                        <th style="background: #f4f4f4; text-align: right; padding: 5px 0;">Qty</th>
                                        <th style="background: #f4f4f4; text-align: right; padding: 5px 0;">Discount</th>
                                        <th style="background: #f4f4f4; text-align: right; padding: 5px 8px 5px 0;" class="text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tbody>
                                    <?php if($estimate_type == 'Option'){ ?>
                                        <tr>
                                            <td colspan="7" style="padding:15px;"><b>Option 1</b></td>
                                        </tr>
                                    <?php foreach($items_dataOP1 as $itemData1){ ?>
                                            <tr class="table-items__tr">
                                            <td valign="top" style="width:30px; text-align:center;"></td>
                                            <td valign="top" style="width:45%;"><?= $itemData1->title; ?></td>
                                            <td valign="top" style="width:20%;"><?= $itemData1->type; ?></td>
                                            <td valign="top" style="width: 80px; text-align: right;"><?= number_format($itemData1->costing,2); ?></td>
                                            <td valign="top" style="width: 50px; text-align: right;"><?= $itemData1->qty; ?></td>
                                            <td valign="top" style="width: 50px; text-align: right;"><?= $itemData1->discount; ?></td>
                                            <td valign="top" style="width: 80px; text-align: right;"><?= number_format($itemData1->total,2); ?></td>
                                            </tr>
                                        <?php } ?>
                                        
                                        <tr><td colspan="7"><hr/></td></tr>
                                        <tr>
                                        <td colspan="5" style="text-align: right;"><p>Subtotal</p></td>
                                        <td colspan="2" style="text-align: right;"><p>$ <?= number_format($sub_total, 2); ?></p></td>
                                        </tr>
                                        <tr>
                                        <td colspan="5" style="text-align: right;"><p>Taxes</p></td>
                                        <td colspan="2" style="text-align: right;"><p>$ <?= number_format($tax1_total, 2); ?></p></td>
                                        </tr>
                                        <tr>
                                        <td colspan="5" style="text-align: right;"><b>TOTAL AMOUNT</b></td>
                                        <td colspan="2" style="text-align: right;"><b>$ <?= number_format($option1_total, 2); ?></b></td>
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
                                    <?php foreach($items_dataOP2 as $itemData2){ ?>
                                            <tr class="table-items__tr">
                                            <td valign="top" style="width:30px; text-align:center;"></td>
                                            <td valign="top" style="width:45%;"><?= $itemData2->title; ?></td>
                                            <td valign="top" style="width:20%;"><?= $itemData2->type; ?></td>
                                            <td valign="top" style="width: 80px; text-align: right;"><?= number_format($itemData2->costing,2); ?></td>
                                            <td valign="top" style="width: 50px; text-align: right;"><?= $itemData2->qty; ?></td>
                                            <td valign="top" style="width: 50px; text-align: right;"><?= $itemData2->discount; ?></td>
                                            <td valign="top" style="width: 80px; text-align: right;"><?= number_format($itemData2->total,2); ?></td>
                                            </tr>
                                        <?php } ?>
                                        
                                        <tr><td colspan="7"><hr/></td></tr>
                                        <tr>
                                        <td colspan="5" style="text-align: right;"><p>Subtotal</p></td>
                                        <td colspan="2" style="text-align: right;"><p>$ <?= number_format($sub_total2, 2); ?></p></td>
                                        </tr>
                                        <tr>
                                        <td colspan="5" style="text-align: right;"><p>Taxes</p></td>
                                        <td colspan="2" style="text-align: right;"><p>$ <?= number_format($tax2_total, 2); ?></p></td>
                                        </tr>
                                        <tr>
                                        <td colspan="5" style="text-align: right;"><b>TOTAL AMOUNT</b></td>
                                        <td colspan="2" style="text-align: right;"><b>$ <?= number_format($option2_total, 2); ?></b></td>
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
                                    <?php foreach($items_dataBD1 as $itemDatabd1){ ?>
                                            <tr class="table-items__tr">
                                            <td valign="top" style="width:30px; text-align:center;"></td>
                                            <td valign="top" style="width:45%;"><?= $itemDatabd1->title; ?></td>
                                            <td valign="top" style="width:20%;"><?= $itemDatabd1->type; ?></td>
                                            <td valign="top" style="width: 80px; text-align: right;"><?= number_format($itemDatabd1->costing,2); ?></td>
                                            <td valign="top" style="width: 50px; text-align: right;"><?= $itemDatabd1->qty; ?></td>
                                            <td valign="top" style="width: 50px; text-align: right;"><?= $itemDatabd1->discount; ?></td>
                                            <td valign="top" style="width: 80px; text-align: right;"><?= number_format($itemDatabd1->total,2); ?></td>
                                            </tr>
                                        <?php } ?>
                                        
                                        <tr><td colspan="7"><hr/></td></tr>
                                        <tr>
                                        <td colspan="5" style="text-align: right;"><p>Subtotal</p></td>
                                        <td colspan="2" style="text-align: right;"><p>$ <?= number_format($sub_total, 2); ?></p></td>
                                        </tr>
                                        <tr>
                                        <td colspan="5" style="text-align: right;"><p>Taxes</p></td>
                                        <td colspan="2" style="text-align: right;"><p>$ <?= number_format($tax1_total, 2); ?></p></td>
                                        </tr>
                                        <tr>
                                        <td colspan="5" style="text-align: right;"><b>TOTAL AMOUNT</b></td>
                                        <td colspan="2" style="text-align: right;"><b>$ <?= number_format($bundle1_total, 2); ?></b></td>
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
                                    <?php foreach($items_dataBD2 as $itemDatabd2){ ?>
                                            <tr class="table-items__tr">
                                            <td valign="top" style="width:30px; text-align:center;"></td>
                                            <td valign="top" style="width:45%;"><?= $itemDatabd2->title; ?></td>
                                            <td valign="top" style="width:20%;"><?= $itemDatabd2->type; ?></td>
                                            <td valign="top" style="width: 80px; text-align: right;"><?= number_format($itemDatabd2->costing,2); ?></td>
                                            <td valign="top" style="width: 50px; text-align: right;"><?= $itemDatabd2->qty; ?></td>
                                            <td valign="top" style="width: 50px; text-align: right;"><?= $itemDatabd2->discount; ?></td>
                                            <td valign="top" style="width: 80px; text-align: right;"><?= number_format($itemDatabd2->total,2); ?></td>
                                            </tr>
                                        <?php } ?>
                                        
                                        <tr><td colspan="7"><hr/></td></tr>
                                        <tr>
                                        <td colspan="5" style="text-align: right;"><p>Subtotal</p></td>
                                        <td colspan="2" style="text-align: right;"><p>$ <?= number_format($sub_total2, 2); ?></p></td>
                                        </tr>
                                        <tr>
                                        <td colspan="5" style="text-align: right;"><p>Taxes</p></td>
                                        <td colspan="2" style="text-align: right;"><p>$ <?= number_format($tax2_total, 2); ?></p></td>
                                        </tr>
                                        <tr>
                                        <td colspan="5" style="text-align: right;"><b>TOTAL AMOUNT</b></td>
                                        <td colspan="2" style="text-align: right;"><b>$ <?= number_format($bundle2_total, 2); ?></b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="7" style="padding-top:15px;"><b>Bundle 2 Message</b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="7" style="padding-bottom:15px;"><?= $bundle2_message; ?></td>
                                        </tr>

                                    <?php }else{ ?>
                                        <?php foreach($items as $itemData){ ?>
                                            <tr class="table-items__tr">
                                            <td valign="top" style="width:30px; text-align:center;"></td>
                                            <td valign="top" style="width:45%;"><?= $itemData->title; ?></td>
                                            <td valign="top" style="width:20%;"><?= $itemData->type; ?></td>
                                            <td valign="top" style="width: 80px; text-align: right;"><?= number_format($itemData->iCost,2); ?></td>
                                            <td valign="top" style="width: 50px; text-align: right;"><?= $itemData->qty; ?></td>
                                            <td valign="top" style="width: 50px; text-align: right;"><?= $itemData->discount; ?></td>
                                            <td valign="top" style="width: 80px; text-align: right;"><?= number_format($itemData->iTotal,2); ?></td>
                                            </tr>
                                        <?php } ?>
                                        
                                        <tr><td colspan="7"><hr/></td></tr>
                                        <tr>
                                        <td colspan="5" style="text-align: right;"><p>Subtotal</p></td>
                                        <td colspan="2" style="text-align: right;"><p>$ <?= number_format($sub_total, 2); ?></p></td>
                                        </tr>
                                        <tr>
                                        <td colspan="5" style="text-align: right;"><p>Taxes</p></td>
                                        <td colspan="2" style="text-align: right;"><p>$ <?= number_format($tax1_total, 2); ?></p></td>
                                        </tr>
                                        <tr>
                                        <td colspan="5" style="text-align: right;"><b>TOTAL AMOUNT</b></td>
                                        <td colspan="2" style="text-align: right;"><b>$ <?= number_format($grand_total, 2); ?></b></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                </table> 
                                <!-- </div> -->

                                <hr />
                                <p><b>Instructions</b><br /><br /><?= $instructions; ?></p>
                                <p><b>Message</b><br /><br /><?= $customer_message; ?></p>
                                <p><b>Terms</b><br /><Br /><?= $terms_conditions; ?></p>
                        
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <img src="<?= base_url('tracker/estimate_image_tracker?id='.$eid); ?>">
</div>
</body>
</html>
