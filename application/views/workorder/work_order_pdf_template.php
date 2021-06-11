<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Work Order</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.1/build/pure-min.css">
    <style>
        /* body
        {
            margin:5px;
        } */
table {
 border-collapse: collapse;
}
    </style>
</head>
<body style="font-family: Gill Sans, sans-serif; font-size: 16px;" >
    <div style="box-shadow:0 2px 8px 0 rgba(0,0,0,.2);background-color: #fff;border: 1px solid #d4d7dc;-webkit-transition: all .3s ease;position:relative;top:20px;width: 95%;margin: 0 auto; padding:5%;">
        <div style="text-align: justify; text-justify: inter-word;">
            This workorder agreement (the "agreement") is made as of 05-07-2021, by and between ADI Smart Home, (the "Company") and the ("Customer") as the address shown below (the "Premise/Service")
        </div>

        <div class="" style="float: right;">
            <h3>WORK ORDER <br> # <?php echo $workorder; ?></h3>
            <br>
            Job Tags: <?php echo $tags; ?> <br>
            Date Issued: <?php echo $wDate = $date_issued; ?> <br>
            Priority: <?php echo $priority; ?> <br>
            Password: <?php echo $password; ?> <br>
            Security Number: <?php echo $security_number; ?> <br>
            <!-- Custom Field: <?php //echo $security_number; ?> <br> -->
            Source: <?php echo $source_name; ?> <br>
            Contacts: <br>
				&emsp;  <?php echo $first_verification_name ?> <br> 
                &emsp;  <?php echo $first_number ?> <br>
                &emsp;  <?php echo $first_relation ?><br><br>

				&emsp;  <?php echo $second_verification_name ?> <br> 
                &emsp;  <?php echo $second_number ?> <br> 
                &emsp;  <?php echo $second_relation ?><br><br>

				&emsp;  <?php echo $third_verification_name ?> <br> 
                &emsp;  <?php echo $third_number ?> <br> 
                &emsp;  <?php echo $third_relation ?>
        </div>


        <div style="padding: 10%;">
            <img src="<?php //echo" $company_representative_signature"; ?>">
        </div>

        <div style="margin-top:10%">

            <div>
                <b>FROM:</b><br>
                <!-- <hr style="width: 50% !important; align:left !important;"> -->
                <?php echo $company; ?><br>
                License: <?php echo $business_address; ?><br>
                <?php echo $business_address; ?><br>
                Phone: <?php echo $phone_number; ?><br><br>
            </div>

            <div>
                <b>CUSTOMER:</b><br>
                <!-- <hr style="width: 50% !important; align:left !important;"> -->
                <?php echo $acs_name; ?><br>
                <?php echo $job_location; ?><br>
                <?php echo $job_location2; ?><br>
                Email: <?php echo $email; ?><br>
                Phone: <?php echo $phone; ?><br>
                Mobile: <?php echo $mobile; ?><br><br>
            </div>

            <div>
                <b>ADDITIONAL:</b>
                <hr><br>
                <?php foreach($customs as $c){ ?>
                    <?php if(empty($c->value)){ }else{ ?>
                        <?php echo $c->name; ?>: <?php echo $c->value; ?><br>
                    <?php } ?>
                <?php } ?>
                <br><br>
            </div>

            <div style="text-align: justify; text-justify: inter-word;">
                <b>TERMS & CONDITIONS:</b>
                <hr>
                <?php echo $terms_and_conditions; ?>
            </div>


            <div class=""><br>
                <b>JOB DETAILS:</b>
                <hr>
                <table class="pure-table" style="border-collapse: collapse !important;">
                    <tr style="background-color: #E9DDFF !important;">
                        <th>Items</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Tax</th>
                        <th>Total</th>
                    </tr>
                    <tbody>
                        <tr>
                            <td data-column=""> </td>
                            <td data-column=""> </td>
                            <td data-column=""> </td>
                            <td data-column=""> </td>
                            <td data-column=""> </td>
                            <td data-column=""> </td>
                        </tr>
                        <?php foreach($items as $item){ ?>
                        <tr>
                            <td data-column=""><?php echo $item->title; ?></td>
                            <td data-column=""><?php echo $item->qty; ?></td>
                            <td data-column=""><?php echo $item->costing; ?></td>
                            <td data-column=""><?php //echo $item->discount; ?>0</td>
                            <td data-column=""><?php echo $item->tax; ?> </td>
                            <td data-column=""><?php //echo $item->total; 
                             $a = $item->qty * $item->costing; $b = $a + $item->tax; echo $b; ?></td>
                        </tr>
                        <?php } ?>
                        <tr style="background-color: #F7F4FF !important;">
                            <td colspan="5" style="background-color: #F8F8F8 !important;">Subtotal</td>
                            <!-- <td data-column=""></td>
                            <td data-column=""></td>
                            <td data-column=""></td>
                            <td data-column=""></td> -->
                            <td style="background-color: #F8F8F8 !important;"><?php echo $subtotal; ?></td>
                        </tr>
                        <tr style="background-color: #E9DDFF !important;">
                            <td colspan="5" style="background-color: #F8F8F8 !important;">Taxes</td>
                            <!-- <td data-column=""></td>
                            <td data-column=""></td>
                            <td data-column=""></td> 
                            <td data-column=""></td>-->
                            <td style="background-color: #F8F8F8 !important;"><?php echo $taxes; ?></td>
                        </tr>
                        <?php if(empty($adjustment_value)){  } else{ ?>
                        <tr style="background-color: #F3F3F3 !important;">
                            <td style="background-color: #F8F8F8 !important;" colspan="5"><?php echo $adjustment_name; ?></td>
                            <!-- <td data-column=""></td>
                            <td data-column=""></td>
                            <td data-column=""></td> -->
                            <td style="background-color: #F8F8F8 !important;"><?php echo $adjustment_value; ?></td>
                        </tr>
                        <?php } ?>
                        <?php if(empty($voucher_value)){  } else{ ?>
                        <tr style="background-color: #F3F3F3 !important;">
                            <td style="background-color: #F8F8F8 !important;" colspan="5">Voucher</td>
                            <!-- <td data-column=""></td>
                            <td data-column=""></td>
                            <td data-column=""></td>
                            <td data-column=""></td> -->
                            <td style="background-color: #F8F8F8 !important;"><?php echo $voucher_value; ?></td>
                        </tr>
                        <?php } ?>
                        <?php if(empty($otp_setup)){ } else{ ?>
                        <tr style="background-color: #F3F3F3 !important;">
                            <td style="background-color: #F8F8F8 !important;" colspan="5">One Time Program and Setup</td>
                            <!-- <td data-column=""></td>
                            <td data-column=""></td> 
                            <td data-column=""></td>
                            <td data-column=""></td>-->
                            <td style="background-color: #F8F8F8 !important;"><?php echo $otp_setup; ?></td>
                        </tr>
                        <?php } ?>
                        <?php if(empty($monthly_monitoring)){ } else{ ?>
                        <tr style="background-color: #F3F3F3 !important;">
                            <td style="background-color: #F8F8F8 !important;" colspan="5">Monthly Monitoring</td>
                            <!-- <td data-column=""></td>
                            <td data-column=""></td> 
                            <td data-column=""></td>
                            <td data-column=""></td>-->
                            <td style="background-color: #F8F8F8 !important;"><?php echo $monthly_monitoring; ?></td>
                        </tr>
                        <?php } ?>
                        <tr style="background-color: #F3F3F3 !important;">
                            <td style="background-color: #F8F8F8 !important;" colspan="5"><b>Grand Total</b></td>
                            <!-- <td data-column=""></td>
                            <td data-column=""></td>
                            <td data-column=""></td>
                            <td data-column=""></td> -->
                            <td style="background-color: #F8F8F8 !important;"><b><?php echo $total; ?></b></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <br><br>
            <div style="text-align: justify; text-justify: inter-word;">
                <b>TERMS OF USE:</b>
                <hr>
                <?php echo $terms_of_use; ?><br><br>
            </div>

            <div style="text-align: justify; text-justify: inter-word;">
                <b>JOB DESCRIPTION:</b>
                <hr>
                <?php echo $job_description; ?><br><br>
            </div>

            <div style="text-align: justify; text-justify: inter-word;">
                <b>INSTRUCTIONS:</b>
                <hr>
                <?php echo $instructions; ?><br><br>
            </div>

            <div style="text-align: justify; text-justify: inter-word;">
                <b>ACCEPTED PAYMENT METHODS:</b>
                <hr>
                <br>
            </div>

            <div style="text-align: justify; text-justify: inter-word;">
                <b>PAYMENT DETAILS:</b>
                <hr>
                <br>
            </div>

            <div style="text-align: justify; text-justify: inter-word;">
                <b>ASSIGNED TO:</b>
                <hr>
                    <?php if(empty($company_representative_signature) || empty($company_representative_name)){ } else{ ?>
                    <img src="<?php echo " $company_representative_signature"; ?>" style="width: 50%;"><br>
                    <?php echo $company_representative_name; ?><br><br>
                    <?php } ?>

                    <?php if(empty($primary_account_holder_signature) || empty($primary_account_holder_name)){ } else{ ?>
                    <img src="<?php echo " $primary_account_holder_signature"; ?>" style="width: 50%;"><br>
                    <?php echo $primary_account_holder_name; ?><br><br>
                    <?php } ?>

                    <?php if(empty($secondary_account_holder_signature) || empty($secondary_account_holder_name)){ } else{ ?>
                    <img src="<?php echo " $secondary_account_holder_signature"; ?>" style="width: 50%;"><br>
                    <?php echo $secondary_account_holder_name; ?><br><br>
                    <?php } ?>
                <br>
            </div>

        </div>

    </div>
</body>
</html>
