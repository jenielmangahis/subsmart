<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link href="<?php echo base_url() ?>assets/dashboard/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<style>
.box-left-mini{
    /* float:left; */
    background-image:url(website-content/hotcampaign.png);
    /* width:292px; */
    /* height:141px; */
}

.box-left-mini .front {
    display: block;
    z-index: 5;
    position: relative;
}
.box-left-mini .front span {
    background: #fff
}

.box-left-mini .behind_container {
    background-color: #ff0;
    position: relative;
    top: -18px;
}
.box-left-mini .behind {
    display: block;
    z-index: 3;
}
img.company-logo2 {
    width: 170px;
    /* height: 70px; */
    object-fit: contain;
    margin: 0 auto;
    margin-top: 8px;
}

.dwn:hover {
  background-color: #76D3DB;
  text-decoration: underline;
}

#chartdiv {
  width: 100%;
  height: 400px;
}

@media print {
 
 body
 {
	 font-size:12px;
	 margin:0px;
     margin-left:0px;
     margin-right:0px;
 }

#chartdiv {
  width: 80% !important;
  height: 300px;
}

.notIncluded
{
    display:none;
}
 
 }
 input[type="radio"]:disabled {
    -webkit-appearance: none;
    display: inline-block;
    width: 16px;
    height: 16px;
    padding: 0px;
    background-clip: content-box;
    border: 2px solid #bbbbbb;
    background-color: white;
    border-radius: 50%;
}

input[type="radio"]:checked {
    background-color: black;
}
/* input[type=radio] {
  outline: 1px solid green;
  opacity: 1; 
}*/
</style>
    <!-- page wrapper start -->
    <input type="hidden" value="<?= $workorder->id; ?>" id="workorderId"/>
	<div class="" role="wrapper">
                <div class="">
					<div class="row">
						<div class="col-md-4">
						</div>
						<div class="col-md-8">
								<div class="order-right text-right">
									<div class="user-menu mobile_btn">
										<a href="<?php echo base_url('workorder/work_order_pdf_solar/' . $workorder->id) ?>" class="btn btn-sec download_work_order_pdfsss" acs-id="<?php echo $workorder->customer_id; ?>" workorder-id="<?php echo $workorder->id; ?>"><span class="fa fa-file-pdf-o"></span> PDF</a>
          								<a class="btn btn-sec" data-print-modal="open" href="#" onclick="printDiv('printableArea')" value="Print Work Order"><span class="fa fa-print"></span> Print</a>
									
									
								</div>
						</div>
					</div>
				</div>

                <div class="row" id="printableArea" style="margin:5%;">
                    <div class="col lawas" style="margin-top:20px;">
                        <h4 class="m-0">Solar Stimulus Data Control / 2022 - 2024</h4>
                    </div>
                    <br>
                    <div class="col-md-12">
                        <div class="mobile_header" style="width:80%;"><?php echo $workorder->header; ?></div>
                        <img src="<?= getCompanyBusinessProfileImage(); ?>"  style="max-width: 180px; max-height: 160px;float:right;margin-top:-220px;" class="SolarLogo"/>
                    </div>
										<div class="row box-left-mini" style="margin-top:16px;">
											<div class="col-md-6">
												<center>
												<div class="front" style="text-align:center;background-color:#4a5594;color:white;padding:0.5%;border-radius:20px;width:95%;">
													<h6>Qualification Information for Solar</h6>
												</div>
												</center><br>
												<div class="behind_container" style="background-color:#ced4e4;margin-top:-20px;padding:20px;">
													<div class="row"> 
														<div class="col-md-2">
														<br><br>        
															<div style="padding:20px;border-radius:5px;background-color:white;width:50%;">A</div>
														</div>
														<div class="col-md-10">
														<br> <h6>Type of Roof</h6>
                                                        <input type="radio" name="tor" value="Asphalt Single" <?php if($solars->tor == 'Asphalt Single'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-" style="background-color:green;"> Asphalt Single &emsp;
                                                        <input type="radio" name="tor" value="Flat" <?php if($solars->tor == 'Flat'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Flat &emsp;
                                                        <input type="radio" name="tor" value="Concrete Tile" <?php if($solars->tor == 'Concrete Tile'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Concrete Tile &emsp; <br>
                                                        <input type="radio" name="tor" value="Clay Tile" <?php if($solars->tor == 'Clay Tile'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Clay Tile &emsp;
                                                        <input type="radio" name="tor" value="Steel Single" <?php if($solars->tor == 'Steel Single'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Steel Single &emsp;
                                                        <input type="radio" name="tor" value="Metal" <?php if($solars->tor == 'Metal'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Metal
														<!-- <span style="font-size:16px;"><?php //echo $solars->tor; ?></span> -->
														<br><br><hr>
														</div>
													</div>
													<div class="row"> 
														<div class="col-md-2">
															<div style="padding:20px;border-radius:5px;background-color:white;width:50%;">B</div>
														</div>
														<div class="col-md-10">
														<h6>Square Footage of Home</h6>
														<span style="font-size:16px;"><?php echo $solars->sfoh; ?></span>
														<br><hr>
														</div>
													</div>
													<div class="row"> 
														<div class="col-md-2">
															<div style="padding:20px;border-radius:5px;background-color:white;width:50%;">C</div>
														</div>
														<div class="col-md-10">
														<h6>Age of Roof (Years)</h6>
                                                            <input type="radio" name="aor" value="0-5" <?php if($solars->aor == '0-5'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> 0-5 &emsp;
                                                            <input type="radio" name="aor" value="5-10" <?php if($solars->aor == '5-10'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> 5-10 &emsp;
                                                            <input type="radio" name="aor" value="10-15" <?php if($solars->aor == '10-15'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> 10-15 &emsp;
                                                            <input type="radio" name="aor" value="15-20" <?php if($solars->aor == '15-20'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> 15-20
														<!-- <span style="font-size:16px;"><?php //echo $solars->aor; ?></span> -->
														<br><br><hr>
														</div>
													</div>
													<div class="row"> 
														<div class="col-md-2">
															<div style="padding:20px;border-radius:5px;background-color:white;width:50%;">D</div>
														</div>
														<div class="col-md-10">
														<h6>Solar Panel Mounting Preference</h6>
                                                            <input type="radio" name="spmp" value="Front Only" <?php if($solars->spmp == 'Front Only'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Front Only &emsp;
                                                            <input type="radio" name="spmp" value="Back Only" <?php if($solars->spmp == 'Back Only'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Back Only &emsp;
                                                            <input type="radio" name="spmp" value="Side Only" <?php if($solars->spmp == 'Side Only'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Side Only  <br>
                                                            <input type="radio" name="spmp" value="No Preference" <?php if($solars->spmp == 'No Preference'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> No Preference &emsp;
                                                            <input type="radio" name="spmp" value="Other" <?php if($solars->spmp == 'Other'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Other
														<!-- <span style="font-size:16px;"><?php //echo $solars->spmp; ?></span> -->
														<br><hr>
														</div>
													</div>
													<div class="row"> 
														<div class="col-md-2">
															<div style="padding:20px;border-radius:5px;background-color:white;width:50%;">E</div>
														</div>
														<div class="col-md-10">
														<h6>Home Owner Associations</h6>
                                                            <input type="radio" name="hoa" value="Yes" <?php if($solars->hoa == 'Yes'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Yes &emsp;
                                                            <input type="radio" name="hoa" value="No" <?php if($solars->hoa == 'No'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> No &emsp;
														<!-- <span style="font-size:16px;"><?php //echo $solars->hoa; ?></span> -->
														<br>
														<b>If Yes: Contact Name/Number</b><br>
														<span style="font-size:16px;"><?php echo $solars->hoa_text; ?></span>
														<br><hr>
														</div>
													</div><br>
													<div class="row"> 
														<div class="col-md-2">
															<div style="padding:20px;border-radius:5px;background-color:white;width:50%;">F</div>
														</div>
														<div class="col-md-10">
															<div style="float:right;width:50%;">
																<!-- <center>$<input type="text" name="ebis_text" class="form-control" style="width:70%;"><br>
																Estimated Bill</center> -->
																<div class="row">
																	<div class="col-md-6" style="margin-top:-30px;">
                                                                        <div class="notIncluded">
																		<h6>Files Uploaded</h6>
																		<?php foreach($solar_files as $sfiles){ ?>
																			<p><a href="<?php echo base_url().'uploads/workorders/solar/'.$sfiles->solar_image; ?>" class="dwn" target="_blank"><?php echo $sfiles->solar_image; ?></a></p>
																			<p><a href="<?php echo base_url().'uploads/workorders/solar/'.$sfiles->solar_image1; ?>" class="dwn" target="_blank"><?php echo $sfiles->solar_image1; ?></a></p>
																			<p><a href="<?php echo base_url().'uploads/workorders/solar/'.$sfiles->solar_image2; ?>" class="dwn" target="_blank"><?php echo $sfiles->solar_image2; ?></a></p>
																			<p><a href="<?php echo base_url().'uploads/workorders/solar/'.$sfiles->solar_image3; ?>" class="dwn" target="_blank"><?php echo $sfiles->solar_image3; ?></a></p>
																			<p><a href="<?php echo base_url().'uploads/workorders/solar/'.$sfiles->solar_image4; ?>" class="dwn" target="_blank"><?php echo $sfiles->solar_image4; ?></a></p>
																		<?php } ?>
                                                                        </div>
																	</div>
																	<div class="col-md-6">
																		<center>
																		<!-- <div class="input-group"> -->
                                                                            <span class="">$ </span> <?php echo number_format($solars->estimated_bill); ?>
																			<!-- <div class="input-group-append">
																				<span class="input-group-text">.00</span>
																			</div> -->
																		<!-- </div> --><br>
                                                                        Estimated Bill</center>
																	</div>
																</div>
																
															</div>
															<h6>Electric Bill is over $100</h6> 
                                                                <input type="radio" name="ebis" value="Yes" <?php if($solars->ebis == 'Yes'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Yes &emsp;
                                                                <input type="radio" name="ebis" value="No" <?php if($solars->ebis == 'No'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> No &emsp;
															<!-- <span style="font-size:16px;"><?php //echo $solars->ebis; ?></span> -->
															<br>
															<h6>How do you get your Invoice</h6>
                                                                <input type="radio" name="hdygi" value="Paper" <?php if($solars->hdygi == 'Paper'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Paper &emsp;
                                                                <input type="radio" name="hdygi" value="Paperless" <?php if($solars->hdygi == 'Paperless'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Paperless &emsp;
															<!-- <span style="font-size:16px;"><?php //echo $solars->hdygi; ?></span> -->
															<br>
															<h6>Electric Bill Account #</h6>
															<span style="font-size:16px;"><?php echo $solars->eba_text; ?></span>
															<hr>
														</div>
													</div>
													<div class="row" style="margin-bottom:50px;"> 
														<div class="col-md-2">
															<div style="padding:20px;border-radius:5px;background-color:white;width:50%;">G</div>
														</div>
														<div class="col-md-10">
														<h6>Employment Status</h6>
                                                            <input type="radio" name="es" value="Employed" <?php if($solars->es == 'Employed'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Employed &emsp;
                                                            <input type="radio" name="es" value="Unemployed" <?php if($solars->es == 'Unemployed'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Unemployed &emsp;
                                                            <input type="radio" name="es" value="Retired" <?php if($solars->es == 'Retired'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Retired <br>
                                                            <input type="radio" name="es" value="Retired with Income" <?php if($solars->es == 'Retired with Income"'){ echo 'checked';}else{ echo ''; } ?> disabled class="form-"> Retired with Income
														<!-- <span style="font-size:16px;"><?php //echo $solars->es; ?></span> -->
														<!-- <hr> -->
														</div>
													</div>
												</div>
											</div>
											
												
											<div class="col-md-6">
													<div style="padding:3%;border:solid black 1px;font-weight:bold;margin-top:-50px;">
														Please fill in the form completely, and return it to a solar specialist or email to support@adtsolarpro.com for consideration.
													</div>
													<br>
													<center>
													<div class="front" style="text-align:center;background-color:#4a5594;color:white;padding:0.5%;border-radius:20px;width:100%;">
														<h6>Please Fill in the Details:</h6>
													</div>
													</center>
													<br>
														<div class="row"> 
															<div class="col-md-6">
																<input type="text" name="firstname" id="firstname" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $customer->first_name; ?>" readonly style="background-color: #fff;">
																<b>First name:</b>
															</div>
															<div class="col-md-6">
																<input type="text" name="lastname" id="lastname" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $customer->last_name; ?>" readonly style="background-color: #fff;">
																<b>Last name:</b>
															</div>
														</div>
														<div class="row"> 
															<div class="col-md-12">
																<input type="text" name="address" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $customer->mail_add; ?>" readonly style="background-color: #fff;">
																<b>Address:</b>
															</div>
														</div>
														<div class="row"> 
															<div class="col-md-5">
																<input type="text" name="city" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $customer->city; ?>" readonly style="background-color: #fff;">
																<b>City:</b>
															</div>
															<div class="col-md-7">
																<input type="text" name="country" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $customer->country; ?>" readonly style="background-color: #fff;">
																<b>County:</b>
															</div>
														</div>
														<div class="row"> 
															<div class="col-md-12">
																<input type="text" name="postcode" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $customer->postcode; ?>" readonly style="background-color: #fff;">
																<b>Postcode:</b>
															</div>
														</div>
														<div class="row"> 
															<div class="col-md-12">
																<input type="text" name="phone" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $customer->phone_h; ?>" readonly style="background-color: #fff;">
																<b>Phone:</b>
															</div>
														</div>
														<div class="row"> 
															<div class="col-md-12">
																<input type="text" name="mobile" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $customer->phone_m; ?>" readonly style="background-color: #fff;">
																<b>Mobile:</b>
															</div>
														</div>
														<div class="row"> 
															<div class="col-md-12">
																<input type="text" name="email" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $customer->email; ?>" readonly style="background-color: #fff;">
																<b>Email:</b>
															</div>
														</div>
														<div class="row"> 
															<div class="col-md-12">
																<p><?php echo $workorder->comments; ?></p>
                                                                <hr>
																<b>Comments:</b>
															</div>
														</div>
														<br>
														<div class="row"> 
															<div class="col-md-12" style="border: solid gray 1px;border-top-left-radius: 25px;border-top-right-radius: 25px;">
															<center><h4>ENERGY USAGE HISTORY SAMPLE</h4></center>
																<!-- <div id="chartdiv"></div> -->
                                                                <img src="<?php echo base_url().'assets/img/graphSolar.png' ?>"  style="width: 100%;height: 250px;" class="" /> 
															</div>
														</div>
														<div class="row"> 
															<div class="col-md-12" style="border: solid gray 1px;border-bottom-left-radius: 25px;border-bottom-right-radius: 25px;padding:2%;">
																<b style="font-size:16px;">Options:</b><br>
																<p class="text-uppercase"><?php echo $solars->options; ?></p>
															</div>
														</div>
													
												</div>
										</div>

											<div class="ul-info">
			         						    <b class="ul-head">Use of Personal Information Collected</b><br>
												<div style="">
												    <p>We use the information we collect to provide you with our products and services and to respond to your questions. We also use the information for editorial and feedback purposes, for marketing and promotional purposes, to inform advertisers as to how many visitors have seen or clicked on their advertisements and to customize the content and layout of ClearCaptions' website. We also use the information we collect for statistical analysis of users' behavior, for product development, for content improvement, to ensure our product and services remain functioning and secure and to investigate and protect against any illegal activities or violations of our Terms of Service.</p>
												</div>
		         							 </div>
										
                                        <!-- </div> -->
                                                        <div class="ul-">
			         							   			<b class="ul-head">ASSIGNED TO</b><br><br>
																<div class="row">
																    <?php if(!empty($workorder->company_representative_signature)){ ?>
																	<div class="col-md-4">
																		<img src="<?php echo base_url($workorder->company_representative_signature); ?>" style="height: 100px;">
																		<hr>
																		<center><?php echo $first->FName.' '.$first->LName; ?></center>
																	</div>
																	<?php } ?>
																	<?php if(!empty($workorder->primary_account_holder_signature)){ ?>
																	<div class="col-md-4">
																		<img src="<?php echo base_url($workorder->primary_account_holder_signature); ?>" style="height: 100px;">
																		<hr>
																		<center><?php echo $workorder->primary_account_holder_name; ?></center>
																	</div>
																	<?php } ?>
																	<?php if(!empty($workorder->secondary_account_holder_signature)){ ?>
																	<div class="col-md-4">
																		<img src="<?php echo base_url($workorder->secondary_account_holder_signature); ?>" style="height: 100px;">
																		<hr>
																		<center><?php echo $workorder->secondary_account_holder_name; ?></center>
																	</div>
																	<?php } ?>
																</div>
		         							   			</div>
                </div>

	</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<!-- Resources -->
<script src="//cdn.amcharts.com/lib/4/core.js"></script>
<script src="//cdn.amcharts.com/lib/4/charts.js"></script>
<script src="//cdn.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>

function primaryName(){
     // $('.invAetf').keyup(function(e){
      // alert('kk');
      var one = $('#firstname').val();
      var two = $('#lastname').val();
      $('#primary_account_holder_name').val(one +' '+ two);
  }
/**
 * ---------------------------------------
 * This demo was created using amCharts 4.
 *
 * For more information visit:
 * https://www.amcharts.com/
 *
 * Documentation is available at:
 * https://www.amcharts.com/docs/v4/
 * ---------------------------------------
 */


am4core.useTheme(am4themes_animated);

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.XYChart);
chart.paddingTop = 40;
// Add data
chart.data = [{
  "category": "J",
  "value": 1240
}, {
  "category": "F",
  "value": 1000
}, {
  "category": "M",
  "value": 450
}, {
  "category": "A",
  "value": 700
}, {
  "category": "M",
  "value": 800
}, {
  "category": "J",
  "value": 800
}, {
  "category": "J",
  "value": 780
}, {
  "category": "A",
  "value": 500
}, {
  "category": "S",
  "value": 100
}, {
  "category": "O",
  "value": 1000
}, {
  "category": "N",
  "value": 900
}, {
  "category": "D",
  "value": 620
}
];

// Create axes
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "category";
categoryAxis.renderer.grid.template.location = 0;

function createValueAxis(title, showgrid) {
  
  // Create axis
  var axis = chart.yAxes.push(new am4charts.ValueAxis());
  axis.renderer.grid.template.disabled = !showgrid;
    
  // Set up axis title
  axis.title.text = title;
  
  return axis;
}

function createSeries(key, title, axis) {
  var series = chart.series.push(new am4charts.ColumnSeries());
  series.dataFields.valueY = key;
  series.dataFields.categoryX = "category";
  series.yAxis = axis;
  return series;
}

createSeries(
  "value",
  "Series #1",
  createValueAxis("KWH", true)
);

// createSeries(
//   "value2",
//   "Series #2",
//   createValueAxis("Funding", false)
// );
</script>

<script>
// $("#packageID").click(function () {
//     $(window).load(function()
// {
    function printDiv(divName) {
        // var divName = 'printableArea';
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
// });
</script>