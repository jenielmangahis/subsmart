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
<body style="font-family: Gill Sans, sans-serif; font-size: 11px;" >
    <div style="box-shadow:0 2px 8px 0 rgba(0,0,0,.2);background-color: #fff;border: 1px solid #d4d7dc;-webkit-transition: all .3s ease;position:relative;top:10px;width: 100%;margin: 0 auto; padding:;">
        <div style="text-align: justify; text-justify: inter-word;">
            This workorder agreement (the "agreement") is made as of 05-07-2021, by and between ADI Smart Home, (the "Company") and the ("Customer") as the address shown below (the "Premise/Service")
        </div>
        <!-- <div> -->
            <img src="<?= getCompanyBusinessProfileImage(); ?>" class="company-logo"  style="float: left;margin-top:50px;" />
        <!-- </div> -->
        <div class="" style="float: right;">
            <h3>WORK ORDER <br> # <?php echo $this->input->post('workorder_number'); ?></h3>
            <br>
            Job Tags: <?php echo $this->input->post('job_tag'); ?> <br>
            Date Issued: <?php echo $this->input->post('schedule_date_given'); ?> <br>
            Priority: <?php echo $this->input->post('priority'); ?> <br>
            Password: <?php echo $this->input->post('password'); ?> <br>
            Security Number: <?php echo $this->input->post('security_number'); ?> <br>
            <!-- Custom Field: <?php //echo $security_number; ?> <br> -->
            Source: <?php //echo $source_name; ?> <br>
        </div>


        <div style="padding: 5%;">
            <img src="<?php //echo" $company_representative_signature"; ?>">
        </div>

        <div style="margin-top:10%">

            <div>
                <b>FROM:</b><br>
                <!-- <hr style="width: 50% !important; align:left !important;"> -->
                <?php echo $this->input->post('company_name'); ?><br>
                License: <?php echo $this->input->post('business_address'); ?><br>
                <?php //echo $business_address; ?>
                Phone: <?php echo $this->input->post('acs_phone_number'); ?><br><br>
            </div>

            <div>
                <b>CUSTOMER:</b><br>
                <!-- <hr style="width: 50% !important; align:left !important;"> -->
                <?php echo $this->input->post('first_name').' '.$this->input->post('last_name'); ?><br>
                <?php //echo $job_location; ?>
                <?php echo $this->input->post('business_name').'<br>'; ?>
                <?php echo $this->input->post('job_location') .' '. $this->input->post('city') .' '. $this->input->post('state') .' '. $this->input->post('zip_code') .' '. $this->input->post('cross_street'); ?><br>
                Email: <?php echo $this->input->post('email'); ?><br>
                Phone: <?php echo $this->input->post('phone_number'); ?><br>
                Mobile: <?php echo $this->input->post('mobile_number'); ?><br><br>
            </div>

            <div>
                <b>ADDITIONAL:</b>
                <hr><br>
                <table class="pure-table" style="border-color:  white ;">
                    <tr>
                        <td><?php echo $this->input->post('1st_verification_name').' <br> '.$this->input->post('1st_number').' <br> '.$this->input->post('1st_relation'); ?> </td>
                    <!-- </tr>
                    <tr> -->
                        <td><?php echo $this->input->post('2nd_verification_name').' <br> '.$this->input->post('2nd_number').' <br> '.$this->input->post('2nd_relation'); ?>  </td>
                    <!-- </tr>
                    <tr> -->
                        <td><?php echo $this->input->post('3rd_verification_name').' <br> '.$this->input->post('3rd_number').' <br> '.$this->input->post('3rd_relation'); ?> </td>
                    <!-- </tr>
                    <tr> -->
                        <td><?php echo $this->input->post('4th_verification_name').' <br> '.$this->input->post('4th_number').' <br> '.$this->input->post('4th_relation'); ?> </td>
                    </tr>
                </table>
                <br><br>
            </div>

            <div style="text-align: justify; text-justify: inter-word;">
                <b>TERMS & CONDITIONS:</b>
                <hr>
                <?php echo $this->input->post('terms_conditions'); ?>
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
                        <?php
                         $a             = $this->input->post('itemid');
                         $itemS         = $this->input->post('items');
                         $item_type     = $this->input->post('item_type');
                         $quantity      = $this->input->post('quantity');
                         $discount      = $this->input->post('discount');
                         $price         = $this->input->post('price');
                         $h             = $this->input->post('tax');
                         $total         = $this->input->post('total');
         
                         $i = 0;
                         foreach($itemS as $row){ ?>

                        <tr>
                            <td data-column=""> <?php echo $itemS[$i]; ?> </td>
                            <td data-column=""> <?php echo $quantity[$i]; ?> </td>
                            <td data-column="">$  <?php echo $price[$i]; ?> </td>
                            <td data-column="">$  <?php echo $discount[$i]; ?> </td>
                            <td data-column="">$  <?php echo $h[$i]; ?> </td>
                            <td data-column="">$  <?php echo $total[$i]; ?> </td>
                        </tr>

                        <?php
                             $i++;
                         }
                        
                        ?>

                        <tr style="background-color: #F7F4FF !important;">
                            <td colspan="5" style="background-color: #F8F8F8 !important;">Subtotal</td>
                            <!-- <td data-column=""></td>
                            <td data-column=""></td>
                            <td data-column=""></td>
                            <td data-column=""></td> -->
                            <td style="background-color: #F8F8F8 !important;">$ <?php echo $this->input->post('subtotal'); ?></td>
                        </tr>
                        <tr style="background-color: #E9DDFF !important;">
                            <td colspan="5" style="background-color: #F8F8F8 !important;">Taxes</td>
                            <!-- <td data-column=""></td>
                            <td data-column=""></td>
                            <td data-column=""></td> 
                            <td data-column=""></td>-->
                            <td style="background-color: #F8F8F8 !important;">$ <?php echo $this->input->post('taxes'); ?></td>
                        </tr>
                        <tr style="background-color: #F3F3F3 !important;">
                            <td style="background-color: #F8F8F8 !important;" colspan="5">One Time Program and Setup</td>
                            <!-- <td data-column=""></td>
                            <td data-column=""></td> 
                            <td data-column=""></td>
                            <td data-column=""></td>-->
                            <td style="background-color: #F8F8F8 !important;">$ <?php echo $this->input->post('otp_setup'); ?></td>
                        </tr>
                        <tr style="background-color: #F3F3F3 !important;">
                            <td style="background-color: #F8F8F8 !important;" colspan="5">Monthly Monitoring</td>
                            <!-- <td data-column=""></td>
                            <td data-column=""></td> 
                            <td data-column=""></td>
                            <td data-column=""></td>-->
                            <td style="background-color: #F8F8F8 !important;">$ <?php echo $this->input->post('monthly_monitoring'); ?></td>
                        </tr>
                        <tr style="background-color: #F3F3F3 !important;">
                            <td style="background-color: #F8F8F8 !important;" colspan="5"><b>Grand Total</b></td>
                            <!-- <td data-column=""></td>
                            <td data-column=""></td>
                            <td data-column=""></td>
                            <td data-column=""></td> -->
                            <td style="background-color: #F8F8F8 !important;"><b>$ <?php echo $this->input->post('grand_total_text'); ?></b></td>
                        </tr>
                       
                    </tbody>
                </table>
            </div>

            <br><br>
            <div style="text-align: justify; text-justify: inter-word;">
                <b>TERMS OF USE:</b>
                <hr>
                <?php echo $this->input->post('terms_of_use'); ?><br><br>
            </div>

            <div style="text-align: justify; text-justify: inter-word;">
                <b>JOB DESCRIPTION:</b>
                <hr>
                <?php echo $this->input->post('job_description'); ?><br><br>
            </div>

            <div style="text-align: justify; text-justify: inter-word;">
                <b>INSTRUCTIONS:</b>
                <hr>
                <?php echo $this->input->post('instructions'); ?><br><br>
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
                <hr><br>
                   <?php if(!empty($this->input->post('company_representative_approval_signature1aM_web'))){ ?>
                    <img src="<?php echo $this->input->post('company_representative_approval_signature1aM_web') ?>" style="width:30%;height:80px;"> <br>
                        <?php echo $this->input->post('company_representative_printed_name'); ?>
                   <?php } ?>

                   <?php if(!empty($this->input->post('primary_representative_approval_signature1aM_web'))){ ?>
                    <img src="<?php echo $this->input->post('primary_representative_approval_signature1aM_web') ?>" style="width:30%;height:80px;"> <br>
                        <?php echo $this->input->post('primary_account_holder_name'); ?>
                   <?php } ?>

                   <?php if(!empty($this->input->post('secondary_representative_approval_signature1aM_web'))){ ?>
                    <img src="<?php echo $this->input->post('secondary_representative_approval_signature1aM_web') ?>" style="width:30%;height:80px;"> <br>
                        <?php echo $this->input->post('secondery_account_holder_name'); ?>
                   <?php } ?>
                <br>
            </div>

        </div>

    </div>
</body>
</html>
