<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
<style>
/* common */
.ribbon {
  width: 120px;
  height: 120px;
  overflow: hidden;
  position: absolute;
}
.ribbon::before,
.ribbon::after {
  position: absolute;
  z-index: -1;
  content: '';
  display: block;
  border: 5px solid #2980b9;
}
.ribbon span {
  position: absolute;
  display: block;
  width: 225px;
  padding: 15px 0;
  background-color: #3498db;
  box-shadow: 0 5px 10px rgba(0,0,0,.1);
  color: #fff;
  font: 700 18px/1 'Lato', sans-serif;
  text-shadow: 0 1px 1px rgba(0,0,0,.2);
  text-transform: uppercase;
  text-align: center;
}

/* top left*/
.ribbon-top-left {
  top: -10px;
  left: -2px;
}
.ribbon-top-left::before,
.ribbon-top-left::after {
  border-top-color: transparent;
  border-left-color: transparent;
}
.ribbon-top-left::before {
  top: 0;
  right: 0;
}
.ribbon-top-left::after {
  bottom: 0;
  left: 0;
}
.ribbon-top-left span {
  right: -40px;
  top: 20px;
  transform: rotate(-45deg);
}

/* top right*/
.ribbon-top-right {
  top: -10px;
  right: -10px;
}
.ribbon-top-right::before,
.ribbon-top-right::after {
  border-top-color: transparent;
  border-right-color: transparent;
}
.ribbon-top-right::before {
  top: 0;
  left: 0;
}
.ribbon-top-right::after {
  bottom: 0;
  right: 0;
}
.ribbon-top-right span {
  left: -25px;
  top: 30px;
  transform: rotate(45deg);
}

/* bottom left*/
.ribbon-bottom-left {
  bottom: -10px;
  left: -10px;
}
.ribbon-bottom-left::before,
.ribbon-bottom-left::after {
  border-bottom-color: transparent;
  border-left-color: transparent;
}
.ribbon-bottom-left::before {
  bottom: 0;
  right: 0;
}
.ribbon-bottom-left::after {
  top: 0;
  left: 0;
}
.ribbon-bottom-left span {
  right: -25px;
  bottom: 30px;
  transform: rotate(225deg);
}

/* bottom right*/
.ribbon-bottom-right {
  bottom: -10px;
  right: -10px;
}
.ribbon-bottom-right::before,
.ribbon-bottom-right::after {
  border-bottom-color: transparent;
  border-right-color: transparent;
}
.ribbon-bottom-right::before {
  bottom: 0;
  left: 0;
}
.ribbon-bottom-right::after {
  top: 0;
  right: 0;
}
.ribbon-bottom-right span {
  left: -25px;
  bottom: 30px;
  transform: rotate(-225deg);
}

#signature-pad {min-height:200px;}
#signature-pad canvas {background-color:white;left: 0;top: 0;width: 100%;min-height:250px;height: 100%}

#signature-pad2 {min-height:200px;}
#signature-pad2 canvas {background-color:white;left: 0;top: 0;width: 100%;min-height:250px;height: 100%}

#signature-pad3 {min-height:200px;}
#signature-pad3 canvas {background-color:white;left: 0;top: 0;width: 100%;min-height:250px;height: 100%}

#signature-padM {min-height:200px;}
#signature-padM canvas {background-color:white;left: 0;top: 0;width: 100%;min-height:250px;height: 100%}

#signature-pad2M {min-height:200px;}
#signature-pad2M canvas {background-color:white;left: 0;top: 0;width: 100%;min-height:250px;height: 100%}

#signature-pad3M {min-height:200px;}
#signature-pad3M canvas {background-color:white;left: 0;top: 0;width: 100%;min-height:250px;height: 100%}

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #10ab06;
}

input:focus + .slider {
  box-shadow: 0 0 1px #10ab06;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

.tr_qty{
    width:150px;
}


nav > .nav.nav-tabs{

border: none;
  color:#fff;
  background:#272e38;
  border-radius:0;

}
nav > div a.nav-item.nav-link,
nav > div a.nav-item.nav-link.active
{
border: none;
  padding: 18px 25px;
  color:#fff;
  background:#272e38;
  border-radius:0;
}

/* nav > div a.nav-item.nav-link.active:after
{
content: "";
position: relative;
bottom: -60px;
left: -10%;
border: 15px solid transparent;
border-top-color: #e74c3c ;
} */
.tab-content{
background: #fdfdfd;
  line-height: 25px;
  border: 1px solid #ddd;
  border-top:5px solid #e74c3c;
  border-bottom:5px solid #e74c3c;
  padding:30px 25px;
}

nav > div a.nav-item.nav-link:hover,
nav > div a.nav-item.nav-link:focus
{
border: none;
  background: #e74c3c;
  color:#fff;
  border-radius:0;
  transition:background 0.20s linear;
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

	.mobile_size
	{
		font-size:14px !important;
		margin-left:50% !important;
	}

	.mobile_div
	{
		margin-left:0px !important;
	}

	.map_area_mobile
	{
		width:400px !important;
	}

	/* .mobile_btn a
	{
		width:100px !important;
		height:20px !important;
	} */

	.user-menu
	{
		margin-right:0px !important;
	}

	.mobile_header
	{
		margin:5% !important;
	}
}
</style>
    <!-- page wrapper start -->
    <input type="hidden" value="<?= $workorder->id; ?>" id="workorderId"/>
	<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/workorder'); ?>
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
				<!-- <div class="order-heading">
					<h3>Work Order # <?php //echo $workorder->work_order_number ?></h3>
				</div> -->

				<div class="order-menu">
					<div class="row">
						<div class="col-md-4">
										<div class="user-return">
											<a href="<?php echo base_url('workorder'); ?>"><i class="fa fa-angle-left" aria-hidden="true"></i> Return to Work Orders</a>
										</div>
						</div>
						<div class="col-md-8">
								<div class="order-right text-right">
									<div class="user-menu">
										<a class="btn sand-btn margin-right-sec" href="<?php echo base_url('job/work_order_job/'. $workorder->id) ?>"><span class="fa fa-money fa-margin-right"></span> Create Job</a>
									</div> 
									
									<div class="user-menu mobile_btn"><br>
										<a class="btn btn-success" href="#" data-toggle="modal" data-target="#sharePreview"><span class="fa fa-edit"></span> Share</a>
										<?php if($workorder->work_order_type_id == '2'){ ?>
											<a class="btn btn-sec" href="<?php echo base_url('workorder/editAlarm/' . $workorder->id) ?>"><span class="fa fa-edit"></span> Edit</a>
										<?php }else{ ?>
                                        	<a class="btn btn-sec" href="<?php echo base_url('workorder/edit/' . $workorder->id) ?>"><span class="fa fa-edit"></span> Edit</a>
                                        <?php } ?>
									<?php if($workorder->work_order_type_id == 1){ ?>
                       					<a href="<?php echo base_url('workorder/work_order_pdf/' . $workorder->id) ?>" class="btn btn-sec download_work_order_pdfsss" acs-id="<?php echo $workorder->customer_id; ?>" workorder-id="<?php echo $workorder->id; ?>"><span class="fa fa-file-pdf-o"></span> PDF</a>
									<?php } else{ ?>
										<a href="<?php echo base_url('workorder/work_order_pdf_alarm/' . $workorder->id) ?>" class="btn btn-sec download_work_order_pdfsss" acs-id="<?php echo $workorder->customer_id; ?>" workorder-id="<?php echo $workorder->id; ?>"><span class="fa fa-file-pdf-o"></span> PDF</a>
									<?php } ?>

          								<a class="btn btn-sec" data-print-modal="open" href="#" onclick="printDiv('printableArea')" value="Print Work Order"><span class="fa fa-print"></span> Print</a>
										  <div class="user-menu">
									<div class="dropdown dropdown-btn dropdown-inline margin-left-sec"><br>
											<button class="btn btn-sec btn-regular dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="false">
												<span class="btn-label">More</span><span class="caret-holder"><span class="caret"></span></span>
											</button>
											<ul class="dropdown-menu dropdown-menu-right usermenu-dropdown" role="menu" aria-labelledby="dropdown-edit">
												<li ><a  href="#" ><span class="fa fa-flag-o icon"></span> Change Status</a></li>
												<li class="divider"></li>
												<!-- <li ><a  href="#" ><span class="fa fa-files-o icon"></span> Clone Work Order</a></li> -->
												<li role="presentation"><a role="menuitem"
                                                                               tabindex="-1"
                                                                               href="#"
                                                                               data-toggle="modal"
                                                                               data-target="#modalCloneWorkorder"
                                                                               data-id="<?php echo $workorder->id ?>"
                                                                               data-wo_num="<?php echo $workorder->work_order_number ?>" class="clone-workorder"><span
                                                                    class="fa fa-files-o icon clone-workorder">

                                                        </span> Clone Work Order</a>
												<li ><a href="<?php echo base_url('job/work_order_job/'. $workorder->id) ?>" ><span class="fa fa-file-text-o icon"></span> Convert to Job</a></li>
												<li ><a href="" acs-id="<?php echo $workorder->customer_id; ?>" workorder-id="<?php echo $workorder->id; ?>" class="send_to_customer"><span class="fa fa-envelope-o icon"></span> Send to Customer</a></li>
												<li ><a href="" acs-id="<?php echo $workorder->customer_id; ?>" workorder-id="<?php echo $workorder->id; ?>" class="send_to_company"><span class="fa fa-envelope-o icon"></span> Send to Company</a></li>
												<li class="divider"></li>
												<!-- <li ><a   href="#" ><span class="fa fa-trash-o icon"></span> Delete Work Order</a></li> -->
												<li role="presentation">
                                                        <a href="#" work-id="<?php echo $workorder->id; ?>" id="delete_workorder"><span class="fa fa-trash-o icon"></span> Delete Work Order </a></li>
												<li ><a   href="#" id="esignButton"><span class="fa fa-envelope-o icon"></span> eSign</a></li>
											</ul>
										</div>
									</div>
								</div>
						</div>
					</div>
				</div>
			</div>


			<div class="row" style="padding:1%;margin-top:-30px;">
				<div class="col-md-12" id="printableArea">
					<div role="white__holder" style="background-color:;padding:5%;border:solid #F4F2F6 3px;box-shadow: 10px 5px 5px #DEDEDE;">
					<div class="ribbon ribbon-top-left"><span><?php echo $workorder->status ?></span></div>
					<div class="mobile_header"><?php echo $workorder->header; ?></div>
					<!-- <hr> -->
							<div class="workorder-inner">
							<div align="right">
								<span class="presenter-title mobile_size"><b>WORK ORDER</b></span> <br> <span style="font-size:16px;"># <?php echo $workorder->work_order_number ?></span><br>
							</div>
							<hr style="border: 2px solid gray;">
								<div clas="row">
										<div class="col-sm-12 col-sm-push-12 text-right-sm ">
										<div class="row">
											<div class="col-md-3">
												<div style="margin-bottom: 20px;">
													<!-- <img class="presenter-print-logo" style="max-width: 230px; max-height: 200px;" src="http://nsmartrac.com/assets/dashboard/images/logo.png"> -->
													<img src="<?= getCompanyBusinessProfileImage(); ?>" class="company-logo"/>
												</div>
											</div>
											<div class="col-md-9">
											<div class="workorder-text" style="margin-top: 10px; margin-bottom: 20px;">											    
												<!-- </div>	-->
												<div align="right" class="mobile_size"> 
													<table>
														<tbody>
														<tr>
															<!-- <td colspan="2"><span># <?php// echo $workorder->work_order_number ?></span></td> -->
														</tr>
														<tr>
															<td align="left"><div style="">Date: </div></td>
															<td align="right"><?php $wDate = $workorder->date_created; echo date("m-d-Y", strtotime($wDate) ); ?></td>
														</tr>
														<tr>
															<td align="left"><div style="">Type: </div></td>
															<td align="right"><?php echo $workorder->job_type ?></td>
														</tr>
															<td align="left"><div style="">Priority: </div></td>
															<td align="right"><?php echo $workorder->priority ?></td>
														</tr>
														</tr>
															<td align="left"><div style="">Password: </div></td>
															<td align="right"><?php echo $workorder->password ?></td>
														</tr>
														</tr>
															<td align="left"><div style="">Security Number: </div></td>
															<td align="right"><?php echo $workorder->security_number ?></td>
														</tr>
														</tr>
															<td align="left"><div style="">Source: </div></td>
															<td align="right"><?php echo $workorder->lead_source_id ?></td>
														</tr>
														
														</tbody>
													</table>
												</div>
											</div>
											</div>

											
										</div>
											
										</div>
									<!-- <div class="row">
										<div class="col-md-6">
											<div style="margin-bottom: 20px;">
												<img class="presenter-print-logo" style="max-width: 230px; max-height: 200px;" src="http://nsmartrac.com/assets/dashboard/images/logo.png">
											</div>
										</div>
										<div class="col-md-6">
											
										</div>
									</div> -->
									<div class="col-sm-12 col-sm-pull-12">

		         							   <div class="user-info">
		         							   		<div class="ul-info">
		         							   			<ul>
		         							   				<li><a href="" class="ul-head"> FROM:</a></li>
															<hr style="border: 1px solid gray;">
		         							   				<li><a href="" class="ul-head"><?php echo $company->business_name ?></a></li>
		         							   				<li><a href="" class="ul-text">License: EF, AL, MS</a></li>
		         							   				<li><a href="" class="ul-text"><?php echo $company->business_address ?></a></li>
		         							   				<!-- <li><a href="" class="ul-text">Pensacola, FL, 32526</a></li> -->
		         							   				<li><a href="" class="ul-text">Email: <?php echo $company->email_address ?></a></li>
		         							   				<li><a href="" class="ul-text">Phone: <?php echo $company->phone_number ?> </a></li>			   			
		         							   			</ul>
		         							   		</div><br>
		         							   		<div class="ul-info">
		         							   			<ul>
		         							   				<li><a href="" class="ul-head">TO:</a></li>
															<hr style="border: 1px solid gray;">
		         							   				<li><span class="ul-head line"><?php echo $customer->contact_name .''. $customer->first_name .' '. $customer->middle_name .' '. $customer->last_name ?></span>
																<!-- <a href="" class="line ul-btns-text" style="color:green;">view</a> -->
																</li>
															<li><a href="" class="ul-text"><?php echo $customer->mail_add .' '. $customer->city .' '. $customer->state .', '. $customer->country .', '. $customer->zip_code ?></a></li>
															<li><a href="" class="ul-text">Phone: <?php echo $customer->phone_h ?></a></li>
		         							   			
		         							   			</ul>
		         							   		</div><br>

		         							   		<div class="ul-info">
		         							   			<ul>
		         							   				<li><a href="" class="ul-head">JOB:</a></li>
		         							   				<li><a href="" class="ul-text">Job for Estimate #EST-000010</a></li>
		         							   				<li><a href="" class="ul-text">Estimate #EST-000010 </a></li>	
		         							   			
		         							   			</ul>
		         							   		</div>

														<br>

													<?php if($workorder->work_order_type_id == 1){ ?>
														<div class="ul-info">
															<ul>
																<li><b>CUSTOM FIELDS</b></li>
																	<li class="show_mobile_view"><hr></li>
																<?php foreach($custom_fields as $custom){ ?>
																	<?php if(empty($custom->value)){ }else{ ?>
																		<li><a href="" class="ul-text"><?php echo $custom->name; ?>&emsp; <?php echo $custom->value; ?></a></li>
																	<?php } ?>
																<?php } ?>
															
															</ul>
															<br>
														</div>
														<br>
													<?php }else{ } ?>

													<?php if($workorder->work_order_type_id == 2){ ?>
														<div class="ul-info">
															<ul>
																<li><b>Contacts</b></li>
																<li class="show_mobile_view"><hr></li>
																<?php if(!empty($customer->first_verification_name)){ ?>
																<li><a href="" class="ul-text"><?php echo $customer->first_verification_name ?> <br> <?php echo $customer->first_number ?> <br> <?php echo $customer->first_relation ?></a></li>
																<?php } ?>
																<?php if(!empty($customer->second_verification_name)){ ?>
																<li><a href="" class="ul-text"><?php echo $customer->second_verification_name ?> <br> <?php echo $customer->second_number ?> <br> <?php echo $customer->second_relation ?></a></li>
																<?php } ?>
																<?php if(!empty($customer->third_verification_name)){ ?>
																<li><a href="" class="ul-text"> <?php echo $customer->third_verification_name ?> <br> <?php echo $customer->third_number ?> <br> <?php echo $customer->third_relation ?></a></li>
																<?php } ?>
																
															
															</ul>
														</div>
														<br>
													<?php }else{ } ?>
														

		         							   		<!-- <div class="ul-info">
		         							   			<ul>
		         							   				<li><a href="" class="ul-head">Appointment:</a></li>
		         							   		
		         							   				<li><a href="" class="ul-text">Not set </a></li>	
		         							   			
		         							   			</ul>
		         							   		</div> -->
		         							   			<div class="ul-info">
			         							   			<ul>
			         							   				<li><a href="#" class="ul-head">Location </a></li>
																<li class="show_mobile_view"><hr></li>
																<li><?php echo $workorder->job_location .' '. $workorder->city .' '. $workorder->state .', '. $workorder->zip_code .', '. $workorder->cross_street  ?> &emsp; 
																<!-- <a href="#" style="color:green;">Show Map</a> -->
																</li>	
			         							   				<!-- <li></li>	 -->
			         							   			
			         							   			</ul>
		         							   			</div>

														<hr>
														<div class="ul-info">
			         							   			<b class="ul-head">Terms and Conditions </b><br><br>
															<div style="height:; overflow:auto; background:#FFFFFF; padding-left:10px;">
																<?php echo $workorder->terms_and_conditions; ?>
															</div>
		         							   			</div>


		         							   </div><br><br>
		         							   <!--  user info end-->

		         							   <div class="table-inner">
		         							   		<table class="table-print table-items" style="width: 100%; border-collapse: collapse;">
											            <thead>
											                <tr>
											                    <th style="background: #f4f4f4; text-align: center; padding: 5px 0;font-weight:bold;">#</th>
											                    <th style="background: #f4f4f4; text-align: left; padding: 5px 0;font-weight:bold;">Services</th>
											                    <th style="background: #f4f4f4; text-align: right; padding: 5px 0;font-weight:bold;">Qty</th>
											                    <th style="background: #f4f4f4; text-align: right; padding: 5px 0;font-weight:bold;">Price</th>
											                    <th class="hidden_mobile_view" style="background: #f4f4f4; text-align: right; padding: 5px 0;font-weight:bold;">Discount</th>
											                    <th class="hidden_mobile_view" style="background: #f4f4f4; text-align: right; padding: 5px 0;font-weight:bold;">Tax (%)</th>
											                    <th style="background: #f4f4f4; text-align: right; padding: 5px 8px 5px 0;font-weight:bold;" class="text-right">Total</th>
											                </tr>
											            </thead>
													            <tbody>
																<?php foreach($workorder_items as $item){ ?>
													                <tr class="table-items__tr">
													                    <td style="width: 30px; text-align: center;" valign="top">  # </td>
													                    <td valign="top"> <?php echo $item->title; ?>   </td>
													                    <td style="width: 50px; text-align: right;" valign="top"> <?php echo $item->qty ?>  </td>
													                    <td style="width: 80px; text-align: right;" valign="top">$<?php echo $item->costing ?></td>
													                    <td class="hidden_mobile_view" style="width: 80px; text-align: right;" valign="top">
																			$ 0<?php //echo $item->discount ?>
																			</td>
													                    <td class="hidden_mobile_view" style="width: 80px; text-align: right;" valign="top">
																			$<?php echo $item->tax ?>
																			</td>
													                    <td style="width: 90px; text-align: right;" valign="top">$<?php $a = $item->qty * $item->costing; $b = $a + $item->tax; echo $b; ?></td>
													                </tr>
																	<?php } ?>
																<?php // if($workorder->work_order_type_id == 1){ ?>
																<?php //foreach($items as $item){ ?>
													                <!-- <tr class="table-items__tr">
													                    <td style="width: 30px; text-align: center;" valign="top">  # </td>
													                    <td valign="top"> <?php //echo $item->item ?>   </td>
													                    <td style="width: 50px; text-align: right;" valign="top"> <?php //echo $item->qty ?>  </td>
													                    <td style="width: 80px; text-align: right;" valign="top">$<?php //echo $item->cost ?></td>
													                    <td class="hidden_mobile_view" style="width: 80px; text-align: right;" valign="top">
																			$<?php //echo $item->discount ?>
																			</td>
													                    <td class="hidden_mobile_view" style="width: 80px; text-align: right;" valign="top">
																			$<?php //echo $item->tax ?>
																			</td>
													                    <td style="width: 90px; text-align: right;" valign="top">$<?php //echo $item->total ?></td>
													                </tr> -->
																	<?php //} ?>
																<?php // }else{ ?>
																	<?php //foreach($itemsA as $itemA){ ?>
													                <!-- <tr class="table-items__tr">
													                    <td style="width: 30px; text-align: center;" valign="top">  # </td>
													                    <td valign="top"> <?php //echo $itemA->item ?>   </td>
													                    <td style="width: 50px; text-align: right;" valign="top"> <?php //echo $itemA->qty ?>  </td>
													                    <td style="width: 80px; text-align: right;" valign="top">$<?php //echo $itemA->cost ?></td>
													                    <td class="hidden_mobile_view" style="width: 80px; text-align: right;" valign="top">
																			$<?php //echo $itemA->discount ?>
																			</td>
													                    <td class="hidden_mobile_view" style="width: 80px; text-align: right;" valign="top">
																			$<?php //echo $itemA->tax ?>
																			</td>
													                    <td style="width: 90px; text-align: right;" valign="top">$<?php //echo $itemA->total ?></td>
													                </tr> -->
																	<?php //} ?>
																<?php // } ?>
													                <tr class="table-items__tr-last">
													                    <td></td>
													                    <td colspan="6"></td>
													                </tr>
													              </tbody>
     													   </table>

		         							   </div>

		         							   <!--  table container end  -->

		         							     <!--  table print start -->

		         							     <div class="table-inner">
		         							     	<table class="table-print" style="width: 100%; margin-top: 10px;">
													        <!-- <tbody>
													            <tr>
													                <td style="width: 50%; text-align: right;"></td>
													                <td>
													                    <table style="width: 100%; border-collapse: collapse;"> -->
													                        <tbody>
													                            <tr>
																					<td colspan="5"></td>
													                                <td style="padding: 8px 0; text-align: right; border-bottom: 1px solid #eaeaea;" class="">Subtotal</td>
													                                <td style="padding: 8px 8px 8px 0; text-align: right; border-bottom: 1px solid #eaeaea;" class="text-right">$<?php echo $workorder->subtotal ?></td>
													                            </tr>
																				<tr>
																					<td colspan="5"></td>
													                                <td style="padding: 8px 0; text-align: right; border-bottom: 1px solid #eaeaea;" class="">Taxes</td>
													                                <td style="padding: 8px 8px 8px 0; text-align: right; border-bottom: 1px solid #eaeaea;" class="text-right">$<?php echo $workorder->taxes ?></td>
													                            </tr>
																				<?php if($workorder->work_order_type_id == 1){ ?>
																				<tr>
																					<td colspan="5"></td>
													                                <td style="padding: 8px 0; text-align: right; border-bottom: 1px solid #eaeaea;" class=""><?php echo $workorder->adjustment_name ?></td>
													                                <td style="padding: 8px 8px 8px 0; text-align: right; border-bottom: 1px solid #eaeaea;" class="text-right">$<?php echo $workorder->adjustment_value ?></td>
													                            </tr>
																				<tr>
																					<td colspan="5"></td>
													                                <td style="padding: 8px 0; text-align: right; border-bottom: 1px solid #eaeaea;" class="">Voucher</td>
													                                <td style="padding: 8px 8px 8px 0; text-align: right; border-bottom: 1px solid #eaeaea;" class="text-right">$<?php echo $workorder->voucher_value ?></td>
													                            </tr>
																				<?php }else{ ?>
																				<tr>
																					<td colspan="5"></td>
													                                <td style="padding: 8px 0; text-align: right; border-bottom: 1px solid #eaeaea;" class="">One Time Program and Setup</td>
													                                <td style="padding: 8px 8px 8px 0; text-align: right; border-bottom: 1px solid #eaeaea;" class="text-right">$<?php echo $workorder->otp_setup ?></td>
													                            </tr>
																				<tr>
																					<td colspan="5"></td>
													                                <td style="padding: 8px 0; text-align: right; border-bottom: 1px solid #eaeaea;" class="">Monthly Monitoring</td>
													                                <td style="padding: 8px 8px 8px 0; text-align: right; border-bottom: 1px solid #eaeaea;" class="text-right">$<?php echo $workorder->monthly_monitoring ?></td>
													                            </tr>
																				<?php } ?>
													                            <tr>
																					<td colspan="5"></td>
													                                <td style="padding: 8px 0; text-align: right; background: #f4f4f4;" class="mobile_size"><b>Grand Total ($)</b></td>
													                                <td style="width: 90px; padding: 8px 8px 8px 0; text-align: right; background: #f4f4f4;" class="text-right"><b>$<?php echo $workorder->grand_total ?></b></td>
													                            </tr>
													                          </tbody>
													                    <!-- </table>
													                </td>
													            </tr>
													        </tbody> -->
													    </table>

		         							     </div>
		         							        <!--  table print end -->

												
													<hr>
														<div class="ul-info">
			         							   			<b class="ul-head">Terms of Use </b><br><br>
															<div style="height:; overflow:auto; background:#FFFFFF; padding-left:10px;">
																<?php echo $workorder->terms_of_use; ?>
															</div>
		         							   			</div>
													<hr>
														<div class="ul-info">
			         							   			<b class="ul-head">Job Description</b><br><br>
															<div style="height:120px; overflow:auto; background:#FFFFFF; padding-left:10px;">
																<?php echo $workorder->job_description; ?>
															</div>
		         							   			</div>
													<hr>
														<div class="ul-info">
			         							   			<b class="ul-head">Instructions</b><br><br>
															<div style="height:120px; overflow:auto; background:#FFFFFF; padding-left:10px;">
																<?php echo $workorder->instructions; ?>
															</div>
		         							   			</div>
													<hr>
														<div class="ul-info">
			         							   			<b class="ul-head">ASSIGNED TO</b><br><br>
																<div class="row">
																	<div class="col-md-4">
																		<img src="<?php echo $workorder->company_representative_signature; ?>">
																		<hr>
																		<?php echo $workorder->company_representative_name; ?>
																	</div>
																	<div class="col-md-4">
																		<img src="<?php echo $workorder->primary_account_holder_signature; ?>">
																		<hr>
																		<?php echo $workorder->primary_account_holder_name; ?>
																	</div>
																	<div class="col-md-4">
																		<img src="<?php echo $workorder->secondary_account_holder_signature; ?>">
																		<hr>
																		<?php echo $workorder->secondary_account_holder_name; ?>
																	</div>
																</div>
		         							   			</div>


									</div>


								



								</div>
							</div>
					</div>
				</div>
				<!-- <div class="col-md-4">
					<div class="user-order-box">
						<div class="several-box">
							<div class="sand-heading margin-bottom-sec">Schedule Work Order</div>
							<div class="row">
              						  <div class="col-sm-4  col-md-12 col-lg-4"><span>Appointment</span></div>
                						<div class="col-sm-8 col-md-12 col-lg-8">
                                            <span>Not set</span>
                                   				 </div>
          					 </div>
          					 <div class="row margin-bottom-sec">
               							 <div class="col-sm-4 col-md-12 col-lg-4"><span>Assigned To</span></div>
                						<div class="col-sm-8 col-md-12 col-lg-8">
                                       		<p class="margin-bottom-sec"><span>No employees assigned.</span></p>
                                    	</div>
          					  </div>
		           				 <div class="row">
		             				   <div class="col-xl-12">
		                 		   <a class="btn sand-btn margin-right margin-bottom-sec" href="">Schedule &amp; Assign</a>
		             		   </div>
		                		<div class="col-xl-12">
		                    		<div class="margin-bottom-sec" style="padding-top: 9px;">
		                        <a href=""><span class="fa fa-calendar fa-margin-right"></span> View Schedule</a>
		                 		   </div>
		              		  </div>
		           		 </div>
						</div>


						<div class="several-box">
							<div class="sand-heading margin-bottom-sec">Time Log</div>
							<div class="row">
              						  		<div class="col-sm-4  col-md-12 col-lg-4"><span>Time In - Out</span></div>
               						 		<div class="col-sm-4  col-md-12 col-lg-4"><span>Hours:Mins</span></div>
               								 <div class="col-sm-4  col-md-12 col-lg-4"><span>Employee</span></div>
            				</div>
									<div class="several-text text-ter">No records</div>
									<div class="margin-top-sec margin-bottom-sec">
	               						 <div class="row">
	                  						  <div class="col-sm-4 col-md-12 col-lg-4"><span>Estimated</span><p>00:00</p></div>
	                  						  <div class="col-sm-4 col-md-12 col-lg-4"><span>Logged</span><p>00:00</p></div>
	                 						   <div class="col-sm-4 col-md-12 col-lg-4"><span>Lag</span><p>00:00</p></div>
	               						 </div>
	             						 
          							  </div>
						</div>

						<div class="several-box">
							<div class="sand-heading margin-bottom-sec">Expences</div>
				
									<div class="margin-top-sec margin-bottom-sec">
	               						 <div class="row">
	                  						  <div class="col-sm-3 col-md-12 col-lg-3"><span>All Total</span><p>$0.00 (0)</p></div>
	                  						  <div class="col-sm-3 col-md-12 col-lg-3"><span>Logged</span><p>$0.00 (0)</p></div>
	                  						  		  <div class="col-sm-3 col-md-12 col-lg-3"><span>Mileage</span><p>$0.00(0)</p></div>
	                 						   <div class="col-sm-3 col-md-12 col-lg-3"><span>Lag</span><p class="terx-ts">$63.44 (0)</p><p class="terx-ts"> (100%)</p></div>
	               						 </div>
	             						 
          							  </div>
          							  <div class="">

	            						    <a href="" class="sand-expence">View all</a> <span class="text-ter">&nbsp; | &nbsp;</span>
	               						 <a href="" class="sand-expence">Record Expense</a> <span class="text-ter">&nbsp; | &nbsp;</span>
	              								  <a href="" class="sand-expence">Record Mileage</a>
	            
          							  </div>
						</div>

									<div class="several-box">
						
							<div class="row">
              						  <div class="col-sm-4  col-md-12 col-lg-4"><span>Added</span></div>
                						<div class="col-sm-8  col-md-12 col-lg-8">
                                            <span>12 Mar, 2020 21:45</span>
                                   				 </div>
          					 </div>
          					 <div class="row margin-bottom-sec">
               							 <div class="col-sm-4  col-md-12 col-lg-4"><span>Status</span></div>
                						<div class="col-sm-8 col-md-12 col-lg-8">
                                       		<p class="margin-bottom-sec"><span>New</span></p>
                                    	</div>
          					  </div>
		           				 <div class="row">
		             				   <div class="col-xl-12">
		                 		   <a class="btn sand-btn margin-right margin-bottom-sec" href="">Change Status</a>

		                 		   <hr>
		                 		   <div class="weight-medium margin-bottom-sec">Log</div>
		                 		        		<p ><span>New Records</span></p>
		             		   </div>
		                
		           		 </div>
						</div>
					</div>
					
					
				</div> -->
			</div>

			<!-- <div class="row" style="padding:1%;">
				<div class="col-md-6">
					<h6>Location on Map</h6>
					<hr>
					<div class="mapouter"><div class="gmap_canvas map_area_mobile"><iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=2880%20Broadway,%20New%20York&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://123movies-to.org"></a><br><style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}</style><a href="https://www.embedgooglemap.net"></a><style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}</style></div></div>
				</div>
			</div> -->
			<br>
			<div class="row">
				<div class="col-md-4">
					<div class="user-return">
						<a href="<?php echo base_url('workorder'); ?>"><i class="fa fa-angle-left" aria-hidden="true"></i> Return to Work Orders</a>
				</div>
			</div>
		</div>
	</div>
	 

 
<!-- <div class="mdc-top-app-bar-fixed-adjust demo-container demo-container-1 d-flex d-lg-none">
  <div class="mdc-bottom-navigation">
      <nav class="mdc-bottom-navigation__list">
        <span class="mdc-bottom-navigation__list-item mdc-ripple-surface mdc-ripple-surface--primary" data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
          <span class="material-icons mdc-bottom-navigation__list-item__icon">history</span>
          <span class="mdc-bottom-navigation__list-item__text">Recents</span>
        </span>
        <span class="mdc-bottom-navigation__list-item mdc-bottom-navigation__list-item--activated mdc-ripple-surface mdc-ripple-surface--primary" data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
          <span class="material-icons mdc-bottom-navigation__list-item__icon">favorite</span>
          <span class="mdc-bottom-navigation__list-item__text">Favourites</span>
        </span>
        <span class="mdc-bottom-navigation__list-item mdc-ripple-surface mdc-ripple-surface--primary" data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
          <span class="material-icons mdc-bottom-navigation__list-item__icon">
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
              <path d="M12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,12.5A1.5,1.5 0 0,1 10.5,11A1.5,1.5 0 0,1 12,9.5A1.5,1.5 0 0,1 13.5,11A1.5,1.5 0 0,1 12,12.5M12,7.2C9.9,7.2 8.2,8.9 8.2,11C8.2,14 12,17.5 12,17.5C12,17.5 15.8,14 15.8,11C15.8,8.9 14.1,7.2 12,7.2Z"></path>
            </svg>
          </span>
          <span class="mdc-bottom-navigation__list-item__text">Nearby</span>
        </span>
      </nav>
    </div> 
</div> -->

<!-- MODAL CLONE WORKORDER -->
<div class="modal fade" id="modalCloneWorkorder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Clone Work Order</h4>
                </div>
                <div class="modal-body">
                    <form name="clone-modal-form">
                        <div class="validation-error" style="display: none;"></div>
                        <p>
                            You are going create a new work order based on <b>Work Order #<span
                                        class="work_order_no"></span> <input type="hidden" id="wo_id" name="wo_id"> </b>.<br>
                            Afterwards you can edit the newly created work order.
                        </p>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                    <button id="clone_workorder" class="btn btn-primary" type="button" data-clone-modal="submit">Clone
                        Work Order
                    </button>
                </div>
            </div>
        </div>
    </div>
	
	<div class="modal fade" id="sharePreview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Share This Link</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="clone-modal-form">
                        <div class="validation-error" style="display: none;"></div>
                        <p>
                            <input type="text" class="form-control" value="<?php echo base_url('workorder/preview/'.$workorder->id) ?>">
                        </p>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="docusignTemplateModal" tabindex="-1" role="dialog" aria-labelledby="docusignTemplateModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="docusignTemplateModalLabel">Select Template</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<table id="templatesTable" class="table" style="width: 100%;">
				<thead>
					<tr>
						<th>Name</th>
						<th>Created Date</th>
						<th>Action</th>
					</tr>
				</thead>
			</table>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
		</div>
		</div>
	</div>
</div>
<?php include viewPath('includes/footer'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&callback=initialize"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg27wLl6BoSPmchyTRgvWuGHQhUUHE5AU&callback=initialize&libraries=&v=weekly"></script> -->
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg27wLl6BoSPmchyTRgvWuGHQhUUHE5AU&libraries=places"></script> -->
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg27wLl6BoSPmchyTRgvWuGHQhUUHE5AU&callback=myMap"></script> -->
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg27wLl6BoSPmchyTRgvWuGHQhUUHE5AU&callback=initMap&libraries=&v=weekly"
      async
    ></script>
<script>
let map;

function initMap() {
  map = new google.maps.Map(document.getElementById("googleMap"), {
	center: { lat: -34.397, lng: 150.644 },
	zoom: 8,
  });
}
</script>

<script>
$(document).on('click touchstart','.send_to_customer',function(){

var id = $(this).attr('acs-id');
var wo_id = $(this).attr('workorder-id');
// alert(wo_id);

var r = confirm("Send this to customer?");

if (r == true) {
	$.ajax({
	type : 'POST',
	url : "<?php echo base_url(); ?>workorder/sendWorkorderToAcs",
	data : {id: id, wo_id: wo_id},
	success: function(result){
		//sucess("Email Successfully!");
		// alert('Email Successfully!');
	},
	error: function () {
      alert("An error has occurred");
    },

	});

	} 
// else 
// {
// 	alert('no');
// }

});
</script>
<script>
$(document).on('click touchstart','.send_to_company',function(){

var id = $(this).attr('acs-id');
var wo_id = $(this).attr('workorder-id');
// alert(wo_id);

var r = confirm("Send this to Company?");

if (r == true) {
	$.ajax({
	type : 'POST',
	url : "<?php echo base_url(); ?>workorder/sendWorkorderToCompany",
	data : {id: id, wo_id: wo_id},
	success: function(result){
		//sucess("Email Successfully!");
		// alert('Email Successfully!');
	},
	error: function () {
      alert("An error has occurred");
    },

	});

	} 
// else 
// {
// 	alert('no');
// }

});
</script>

<script>
$(document).on('click touchstart','.send_to_customer_alarm',function(){

var id = $(this).attr('acs-id');
var wo_id = $(this).attr('workorder-id');
// alert(wo_id);

var r = confirm("Send this to Customer?");

if (r == true) {
	$.ajax({
	type : 'POST',
	url : "<?php echo base_url(); ?>workorder/sendWorkorderToAcsAlarm",
	data : {id: id, wo_id: wo_id},
	success: function(result){
		//sucess("Email Successfully!");
		// alert('Email Successfully!');
	},
	error: function () {
      alert("An error has occurred");
    },

	});

	} 
else 
{
	alert('no');
}

});
</script>

<script>
$(document).on('click touchstart','.download_work_order_pdf',function(){

var id = $(this).attr('acs-id');
var wo_id = $(this).attr('workorder-id');
// alert(wo_id);

var r = confirm("Send this to Customer?");

if (r == true) {
	$.ajax({
	type : 'POST',
	url : "<?php echo base_url(); ?>workorder/work_order_pdf",
	data : {id: id, wo_id: wo_id},
	success: function(result){
		//sucess("Email Successfully!");
		// alert('Email Successfully!');
	},
	error: function () {
      alert("An error has occurred");
    },

	});

	} 
else 
{
	alert('no');
}

});
</script>

<script>
$(document).on('click touchstart','.clone-workorder',function(){

var num = $(this).attr('data-wo_num');
var id = $(this).attr('data-id');
// alert(id);
$('.work_order_no').text(num)
$('#wo_id').val(id)


});

$(document).on('click touchstart','#clone_workorder',function(){

// var num = $(this).attr('data-wo_num');
// var wo_num = $('.work_order_no').text();
var wo_num = $('#wo_id').val();
// alert(id);
// $('.work_order_no').text(num);
$.ajax({
    type : 'POST',
    url : "<?php echo base_url(); ?>workorder/duplicate_workorder",
    data : {wo_num: wo_num},
    success: function(result){
        sucess("Data Cloned Successfully!");
    },
    });


});

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
</script>

<script>
// $(document).on('click','#delete_workorder',function(){
//     // alert('test');
    
// });

// function myFunction() {
// $('#delete_workorder').on('click', function(){
$(document).on('click touchstart','#delete_workorder',function(){

    var id = $(this).attr('work-id');
    // alert(id);
  
  var r = confirm("Are you sure you want to delete this Work Order?");

  if (r == true) {
    $.ajax({
    type : 'POST',
    url : "<?php echo base_url(); ?>workorder/delete_workorder",
    data : {id: id},
    success: function(result){
        // $('#res').html('Signature Uploaded successfully');
        // if (confirm('Some message')) {
        //     alert('Thanks for confirming');
        // } else {
        //     alert('Why did you press cancel? You should have confirmed');
        // }

        // location.reload();
        sucess("Data Deleted Successfully!");
		var url = "<?php echo base_url(); ?>workorder";
		window.location = url; 
    },
    });
  } 
  else 
  {
    alert('no');
  }

});

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