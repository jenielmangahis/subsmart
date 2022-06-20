<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Work Order</title>
    <!-- <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.1/build/pure-min.css"> -->
    <!-- <link href="<?php echo base_url() ?>assets/dashboard/css/bootstrap.min.css" rel="stylesheet" type="text/css"> -->
    <style>
        body
        {
            font-size:9px;
        }
        table, th, td {
            border: 1px solid gray;
            border-collapse: collapse;
        }
        /* .table2 table, th, td {
            border: 0px solid white;
            border-collapse: collapse;
        } */
        hr {
            border: none;
            height: 1px;
            /* Set the hr color */
            color: #333; /* old IE */
            background-color: #333; /* Modern Browsers */
        }
        @page{margin:2px}
/* table {
 border-collapse: collapse;
}

.left,
.right {
  display: inline-block;
  background: red;
} */
    </style>
<style>
</style>
</head>
<body style="font-family: Gill Sans, sans-serif; font-size: 11px;" >
    <div style="box-shadow:0 2px 8px 0 rgba(0,0,0,.2);background-color: #fff;border: 1px solid #d4d7dc;-webkit-transition: all .3s ease;position:relative;top:20px;width: 95%;margin: 0 auto; padding:1%;">

        <div class="" style="float: right;">
            <h6>WORK ORDER <br> # <?php echo $workorder; ?></h6>
        </div>


        <div style="">
            <img src="<?php echo base_url('assets/img/alarm_logo.jpeg'); ?>" style="width:50px;height:50px;">
        </div>

        <!-- <div class="agreement" id="container">     -->         
        <div style="font-size:9px;"><?php echo $header; ?></div>
        <!-- </div> -->
        <hr>
        
        <!-- <div class="left" id="left" style="float: ;"> -->
                <!-- <center>
                    <div class="front" style="text-align:center;background-color:#4a5594;color:white;border-radius:20px;">
                        <h6>Items</h6>
                    </div>
                </center><br> -->
                <div class="table" style="font-size:11px;">
                    <center>
						<div class="front" style="text-align:center;background-color:#4a5594;color:white;width:350px;font-size:9px;">
							<b>Items</b>
						</div>
					</center>
                    <table style="width:350px;background-color:#ced4e4;font-size:9px;">
                        <tr align="center">
                            <th>Items</th>
                            <th>Quantity</th>
                            <th>Location</th>
                            <th>Price</th>
                        </tr>
                            <?php foreach($items as $aItems) { ?>
                            <tr>
                                <td style="font-size:9px;"><?php echo $aItems->item; if($aItems->check_data == NULL){ echo ''; }else{ echo ' ('. $aItems->check_data .') ';} ?></td>
                                <td style="font-size:9px;"><?php echo $aItems->qty ?></td>
                                <td style="font-size:9px;"><?php echo $aItems->location ?></td>
                                <td style="font-size:9px;"><?php echo $aItems->price ?></td>
                            </tr>
                            <?php }?>
                    </table>
                    <br>
                    <table style="border: 0px solid white;border-collapse: collapse;font-size:9px;">
                        <tr>
                            <td colspan="2" style="border: 0px solid white;border-collapse: collapse;font-size:9px;"><?php echo $installation_date; ?><hr><b>Installation Date:</b></td>
                            <td style="border: 0px solid white;border-collapse: collapse;font-size:9px;"><?php echo $intall_time; ?><hr><b>Install Time Date:</b></td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;font-size:9px;"><?php echo $payment_method; ?><hr><b>Payment Method:</b></td>
                            <td style="border: 0px solid white;border-collapse: collapse;font-size:9px;"><?php echo $amount; ?><hr><b>Amount ( $ )</b></td>
                            <td style="border: 0px solid white;border-collapse: collapse;font-size:9px;"><?php echo $billing_date; ?><hr><b>Billing Date</b></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="border: 0px solid white;border-collapse: collapse;font-size:9px;"><?php echo $comments; ?><hr><b>Notes:</b></td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;font-size:9px;"><?php echo $sales_re_name; ?><hr><b>Sales Rep's Name:</b></td>
                            <td style="border: 0px solid white;border-collapse: collapse;font-size:9px;"><?php echo $sale_rep_phone; ?><hr><b>Cell Phone:</b></td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;font-size:9px;" colspan="3"><?php echo $team_leader; ?><hr><b>Team Leader:</b></td>
                        </tr>
                    </table>
                </div>
            <!-- </div>
            <div class="right" id="right" style="float: ;"> -->
                <!-- <center>
                    <div class="front" style="text-align:center;background-color:#4a5594;color:white;border-radius:20px;">
                        <h6>Details:</h6>
                     </div>
                </center> -->
                <div class="table2" style="width:450px;margin-top:-900px;margin-left:380px;font-size:9px;">
                    <center>
						<div class="front" style="text-align:center;background-color:#4a5594;color:white;width:350px;">
							<b>Details:</b>
							</div>
					</center>
                    <table style="border: 0px solid white;border-collapse: collapse;width:350px;">
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($firstname)){ echo '<br>'; }else{echo $firstname;} ?><hr><b>First name:</b></td>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($firstname)){ echo '<br>'; }else{echo $lastname;} ?><hr><b>Last name:</b></td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($firstname)){ echo '<br>'; }else{echo $firstname_spouse;} ?><hr><b>First name (Spouse):</b></td>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($firstname)){ echo '<br>'; }else{echo $lastname_spouse;} ?><hr><b>Last name (Spouse):</b></td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;" colspan="2"><?php if(empty($firstname)){ echo '<br>'; }else{echo $address;} ?><hr><b>Address:</b></td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($firstname)){ echo '<br>'; }else{echo $city;} ?><hr><b>City:</b></td>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($firstname)){ echo '<br>'; }else{echo $state;} ?><hr><b>State:</b></td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($firstname)){ echo '<br>'; }else{echo $postcode;} ?><hr><b>Postcode:</b></td>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($firstname)){ echo '<br>'; }else{echo $county;} ?><hr><b>County:</b></td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;" colspan="2"><?php if(empty($firstname)){ echo '<br>'; }else{echo $phone_number;} ?><hr><b>Phone:</b></td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;" colspan="2"><?php if(empty($firstname)){ echo '<br>'; }else{echo $mobile_number;} ?><hr><b>Mobile:</b></td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;" colspan="2"><?php if(empty($firstname)){ echo '<br>'; }else{echo $email;} ?><hr><b>Email:</b></td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($firstname)){ echo '<br>'; }else{echo $first_ecn;} ?><hr><b>1st Emergency Contact Name:</b></td>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($firstname)){ echo '<br>'; }else{echo $first_ecn_no;} ?><hr><b>Phone:</b></td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($firstname)){ echo '<br>'; }else{echo $second_ecn;} ?><hr><b>2nd Emergency Contact Name:</b></td>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($firstname)){ echo '<br>'; }else{echo $second_ecn_no;} ?><hr><b>Phone:</b></td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($firstname)){ echo '<br>'; }else{echo $third_ecn;} ?><hr><b>3rd Emergency Contact Name:</b></td>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($firstname)){ echo '<br>'; }else{echo $third_ecn_no;} ?><hr><b>Phone:</b></td>
                        </tr>
                    </table>
                    <br>
                    <table>
                        <tr>
                            <td style="margin:;padding:6px;"><b>Equipment Cost</b></td>
                            <td style="margin:;padding:6px;"><?php echo $subtotal; ?></td>
                        </tr>
                        <tr>
                            <td style="margin:;padding:6px;"><b>Sales Tax</b></td>
                            <td style="margin:;padding:6px;"><?php echo $taxes; ?></td>
                        </tr>
                        <tr>
                            <td style="margin:;padding:6px;"><b>Installation Cost</b></td>
                            <td style="margin:;padding:6px;"><?php echo $installation_cost; ?></td>
                        </tr>
                        <tr>
                            <td style="margin:;padding:6px;"><b>One time (Program and Setup)</b></td>
                            <td style="margin:;padding:6px;"><?php echo $otp_setup; ?></td>
                        </tr>
                        <tr>
                            <td style="margin:;padding:6px;"><b>Monthly Monitoring</b></td>
                            <td style="margin:;padding:6px;"><?php echo $monthly_monitoring; ?></td>
                        </tr>
                        <tr>
                            <td style="margin:;padding:6px;"><b>Total Due</b></td>
                            <td style="margin:;padding:6px;"><?php echo $total; ?></td>
                        </tr>
                    </table>
                </div> 
                <br>
                <b style="font-size:8px;">Agreement</b>
                <br>
                <div style="font-size:8px;"><?php echo $terms_and_conditions; ?></div>
        
                <b style="font-size:9px;">ASSIGNED TO:</b>
                <hr>
                <table style="border: 0px solid white;border-collapse: collapse;">
                    <tr>
                        <td style="border: 0px solid white;border-collapse: collapse;" align="center">
                            <?php if(empty($company_representative_signature)){ } else{ ?>
                            <img src="<?php echo base_url($company_representative_signature); ?>" style="width:30%;height:50px;"><br>
                            <?php echo $company_representative_name; ?>
                            <?php } ?>
                        </td>
                        
                        <td style="border: 0px solid white;border-collapse: collapse;" align="center">
                            <?php if(empty($primary_account_holder_signature)){ } else{ ?>
                            <img src="<?php echo base_url($primary_account_holder_signature); ?>" style="width:30%;height:50px;"><br>
                            <?php echo $primary_account_holder_name; ?>
                            <?php } ?>
                        </td>
                        
                        <td style="border: 0px solid white;border-collapse: collapse;" align="center">
                            <?php if(empty($secondary_account_holder_signature)){ } else{ ?>
                            <img src="<?php echo base_url($secondary_account_holder_signature); ?>" style="width:30%;height:50px;"><br>
                            <?php echo $secondary_account_holder_name; ?>
                            <?php } ?>
                        </td>
                    </tr>
                </table>

    </div>
</body>
</html>
