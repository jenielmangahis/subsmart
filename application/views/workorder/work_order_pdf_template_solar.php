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

        /* input[type="radio"]:disabled {
            -webkit-appearance: none;
            display: inline-block;
            width: 10px;
            height: 10px;
            padding: 0px;
            background-clip: content-box;
            border: 2px solid #bbbbbb;
            background-color: white;
            border-radius: 50%;
        } */

        input[type="radio"]:checked {
            /* background-color: green; */
        }
        
#chartdiv {
  width: 80% !important;
  height: 300px;
}

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
<body style="font-family: Gill Sans, sans-serif; font-size: 10px;" >
    <div style="box-shadow:0 2px 8px 0 rgba(0,0,0,.2);background-color: #fff;border: 1px solid #d4d7dc;-webkit-transition: all .3s ease;position:relative;top:20px;width: 95%;margin: 0 auto; padding:1%;">
        <div class="col lawas" style="margin-top:20px;">
            <b style="font-size:12px;" class="m-0">Solar Stimulus Data Control / 2022 - 2024</b>
            <img src="<?php echo base_url('assets/img/solar_logo.png'); ?>" style="width:100px;height:100px;float:right;margin-right:20px;">
        </div>
        <div style="">
            <div style="font-size:12px;width:80%;"><?php echo $header; ?></div>
        </div>
        
        <!-- <div class="left" id="left" style="float: ;"> -->
                <!-- <center>
                    <div class="front" style="text-align:center;background-color:#4a5594;color:white;border-radius:20px;">
                        <h6>Items</h6>
                    </div>
                </center><br> -->
                <table style="border: 0px solid white;border-collapse: collapse;width:370px;font-size:10px;">
                    <tr>
                        <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($password)){ echo ''; }else{echo $password;} ?><hr style="margin-top:0px;margin-bottom:-1px;"><b>Lead Source:</b></td>
                        <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($security_number)){ echo ''; }else{echo $security_number;} ?><hr style="margin-top:0px;margin-bottom:-1px;"><b>System Type:</b></td>
                    </tr>
                </table>
                <br>
                <div class="table" style="font-size:10px;">
                    <center>
						<div class="front" style="text-align:center;background-color:#4a5594;color:white;width:369px;font-size:9px;padding:1px;">
							<b>Qualification Information for Solar</b>
						</div>
					</center>
                    <table style="width:370px;background-color:#ced4e4;font-size:10px;height:500px;">
                        <tr>
                            <td><div style="padding:6px;border-radius:5px;background-color:white;width:50%;">A</div><br><br><br></td>
                            <td><?php //echo $aItems->price ?>
                                <b>Type of Roof</b><br><br>
                                <input type="radio" name="tor" value="Asphalt Single" <?php if($tor == 'Asphalt Single'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Asphalt Single &emsp;
                                <input type="radio" name="tor" value="Flat" <?php if($tor == 'Flat'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Flat &emsp;
                                <input type="radio" name="tor" value="Concrete Tile" <?php if($tor == 'Concrete Tile'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Concrete Tile &emsp; <br>
                                <input type="radio" name="tor" value="Clay Tile" <?php if($tor == 'Clay Tile'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Clay Tile &emsp;
                                <input type="radio" name="tor" value="Steel Single" <?php if($tor == 'Steel Single'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Steel Single &emsp;
                                <input type="radio" name="tor" value="Metal" <?php if($tor == 'Metal'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Metal
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td><div style="padding:6px;border-radius:5px;background-color:white;width:50%;">B</div></td>
                            <td><b>Square Footage of Home</b><br><br><span style="font-size:10px;"><?php echo $sfoh; ?></span><br></td>
                        </tr>
                        <tr>
                            <td><div style="padding:6px;border-radius:5px;background-color:white;width:50%;">C</div></td>
                            <td><?php //echo $aItems->price ?>
								<b>Age of Roof (Years)</b><br><br>
                                <input type="radio" name="aor" value="0-5" <?php if($aor == '0-5'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> 0-5 &emsp;
                                <input type="radio" name="aor" value="5-10" <?php if($aor == '5-10'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> 5-10 &emsp;
                                <input type="radio" name="aor" value="10-15" <?php if($aor == '10-15'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> 10-15 &emsp;
                                <input type="radio" name="aor" value="15-20" <?php if($aor == '15-20'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> 15-20
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td><div style="padding:6px;border-radius:5px;background-color:white;width:50%;">D</div></td>
                            <td><?php //echo $aItems->price ?>
                                <b>Solar Panel Mounting Preference</b><br><br>
                                <input type="radio" name="spmp" value="Front Only" <?php if($spmp == 'Front Only'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Front Only &emsp;
                                <input type="radio" name="spmp" value="Back Only" <?php if($spmp == 'Back Only'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Back Only &emsp;
                                <input type="radio" name="spmp" value="Side Only" <?php if($spmp == 'Side Only'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Side Only  <br>
                                <input type="radio" name="spmp" value="No Preference" <?php if($spmp == 'No Preference'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> No Preference &emsp;
                                <input type="radio" name="spmp" value="Other" <?php if($spmp == 'Other'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Other
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td><div style="padding:6px;border-radius:5px;background-color:white;width:50%;">E</div></td>
                            <td><?php //echo $aItems->price ?>
                                <b>Home Owner Associations</b><br><br>
                                <input type="radio" name="hoa" value="Yes" <?php if($hoa == 'Yes'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Yes &emsp;
                                <input type="radio" name="hoa" value="No" <?php if($hoa == 'No'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> No &emsp;
                                <br>
								<b>If Yes: Contact Name/Number</b><br>
								<span style="font-size:10px;"><?php echo $hoa_text; ?></span>
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td><div style="padding:6px;border-radius:5px;background-color:white;width:50%;">F</div></td>
                            <td><?php //echo $aItems->price ?>
                                <div style="margin-left:140px;">
										<center>
                                            <span class="">$ </span> <?php echo number_format($solars->estimated_bill); ?><br>
                                            Estimated Bill
                                        </center>
								</div>
                                <div style="margin-top:-14px;">
                                <b>Electric Bill is over $100</b> <br>
                                <input type="radio" name="ebis" value="Yes" <?php if($ebis == 'Yes'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Yes &emsp;
                                <input type="radio" name="ebis" value="No" <?php if($ebis == 'No'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> No &emsp;
                                <br>
								<b>How do you get your Invoice</b><br>
                                <input type="radio" name="hdygi" value="Paper" <?php if($hdygi == 'Paper'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Paper &emsp;
                                <input type="radio" name="hdygi" value="Paperless" <?php if($hdygi == 'Paperless'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Paperless &emsp;
                                <br>
								<b>Electric Bill Account #</b><br>
							    <span style="font-size:10px;"><?php echo $eba_text; ?></span>
                                <br><br>
                                <b>Uploaded Files:</b><br>
                                    <?php foreach($solar_files as $fsolar){ ?>
                                        - <?php echo $fsolar->solar_image; ?><br>
                                        - <?php echo $fsolar->solar_image1; ?><br>
                                        - <?php echo $fsolar->solar_image2; ?><br>
                                        - <?php echo $fsolar->solar_image3; ?><br>
                                        - <?php echo $fsolar->solar_image4; ?><br>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><div style="padding:6px;border-radius:5px;background-color:white;width:50%;">G</div></td>
                            <td><?php //echo $aItems->price ?>
                                <b>Employment Status</b><br><br>
                                <input type="radio" name="es" value="Employed" <?php if($es == 'Employed'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Employed &emsp;
                                <input type="radio" name="es" value="Unemployed" <?php if($es == 'Unemployed'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Unemployed <br>
                                <input type="radio" name="es" value="Retired" <?php if($es == 'Retired'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Retired &emsp;
                                <input type="radio" name="es" value="Retired with Income" <?php if($es == 'Retired with Income"'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Retired with Income
                                <br>
                            </td>
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
                <div class="table2" style="width:350px;margin-top:-600px;margin-left:380px;font-size:10px;">
                    <center>
                        <div style="padding:3%;border:solid black 1px;font-weight:bold;margin-top:-50px;">
							Please fill in the form completely, and return it to a solar specialist or email to support@adtsolarpro.com for consideration.
						</div>
						<div class="front" style="text-align:center;background-color:#4a5594;color:white;width:350px;padding:1px;">
							<b>Please Fill in the Details:</b>
							</div>
					</center><br>
                    <table style="border: 0px solid white;border-collapse: collapse;width:330px;">
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($firstname)){ echo '<br>'; }else{echo $firstname;} ?><hr style="margin-top:0px;margin-bottom:-1px;"><b>First name:</b></td>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($lastname)){ echo '<br>'; }else{echo $lastname;} ?><hr style="margin-top:0px;margin-bottom:-1px;"><b>Last name:</b></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="border: 0px solid white;border-collapse: collapse;"><hr style="margin-top:;margin-bottom:-1px;background-color:white;"></td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;" colspan="2"><?php if(empty($address)){ echo '<br>'; }else{echo $address;} ?><hr style="margin-top:0px;margin-bottom:-1px;"><b>Address:</b></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="border: 0px solid white;border-collapse: collapse;"><hr style="margin-top:;margin-bottom:-1px;background-color:white;"></td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($city)){ echo '<br>'; }else{echo $city;} ?><hr style="margin-top:0px;margin-bottom:-1px;"><b>City:</b></td>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($state)){ echo '<br>'; }else{echo $state;} ?><hr style="margin-top:0px;margin-bottom:-1px;"><b>State:</b></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="border: 0px solid white;border-collapse: collapse;"><hr style="margin-top:;margin-bottom:-1px;background-color:white;"></td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($postcode)){ echo '<br>'; }else{echo $postcode;} ?><hr style="margin-top:0px;margin-bottom:-1px;"><b>Postcode:</b></td>
                            <td style="border: 0px solid white;border-collapse: collapse;"><?php if(empty($county)){ echo '<br>'; }else{echo $county;} ?><hr style="margin-top:0px;margin-bottom:-1px;"><b>County:</b></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="border: 0px solid white;border-collapse: collapse;"><hr style="margin-top:;margin-bottom:-1px;background-color:white;"></td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;" colspan="2"><?php if(empty($phone_number)){ echo '<br>'; }else{echo $phone_number;} ?><hr style="margin-top:0px;margin-bottom:-1px;"><b>Phone:</b></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="border: 0px solid white;border-collapse: collapse;"><hr style="margin-top:;margin-bottom:-1px;background-color:white;"></td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;" colspan="2"><?php if(empty($mobile_number)){ echo '<br>'; }else{echo $mobile_number;} ?><hr style="margin-top:0px;margin-bottom:-1px;"><b>Mobile:</b></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="border: 0px solid white;border-collapse: collapse;"><hr style="margin-top:;margin-bottom:-1px;background-color:white;"></td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;" colspan="2"><?php if(empty($email)){ echo '<br>'; }else{echo $email;} ?><hr style="margin-top:0px;margin-bottom:-1px;"><b>Email:</b></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="border: 0px solid white;border-collapse: collapse;"><hr style="margin-top:;margin-bottom:-1px;background-color:white;"></td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;" colspan="2"><?php if(empty($comments)){ echo '<br>'; }else{echo $comments;} ?><hr style="margin-top:0px;margin-bottom:-1px;"><b>Comments:</b></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="border: 0px solid white;border-collapse: collapse;"><hr style="margin-top:;margin-bottom:-1px;background-color:white;"></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="border: 0px solid white;border-collapse: collapse;">
                                <div class="" style="border: solid gray 1px;border-top-left-radius: 25px;border-top-right-radius: 25px;">
									<center><b>ENERGY USAGE HISTORY SAMPLE</b></center>
                                    <img src="<?php echo base_url().'assets/img/graphSolar.png' ?>"  style="width: 100%;height: 180px;" class="" /> 
								</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid white;border-collapse: collapse;" colspan="2"><b>Options:</b><br><?php if(empty($options)){ echo '<br>'; }else{echo $options;} ?></td>
                        </tr>
                    </table>
                    
                </div> 
                <b style="font-size:8px;">Use of Personal Information Collected</b>
                <div style="font-size:8px;"><p>We use the information we collect to provide you with our products and services and to respond to your questions. We also use the information for editorial and feedback purposes, for marketing and promotional purposes, to inform advertisers as to how many visitors have seen or clicked on their advertisements and to customize the content and layout of ClearCaptions' website. We also use the information we collect for statistical analysis of users' behavior, for product development, for content improvement, to ensure our product and services remain functioning and secure and to investigate and protect against any illegal activities or violations of our Terms of Service.</p></div>
        
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
