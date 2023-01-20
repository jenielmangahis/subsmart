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

.multipleInput-container {
     border:1px #999 solid;
     padding:1px;
     padding-bottom:0;
     cursor:text;
     font-size:15px;
     width:100%;
	border-radius: 6px
}
 
.multipleInput-container input {
    font-size:15px;
    clear:both;
    height:60px;
    border:0;
    margin-bottom:1px;
}
 
.multipleInput-container ul {
    list-style-type:none;
}
 
li.multipleInput-email {
    float:left;
    padding:6px ;
    color: #fff;
	background: #FD9160;
	margin-top: 0;
	border-radius: 6px;
	margin: 6px 2px 6px 6px;
}
 
.multipleInput-close {
    width:16px;
    height:16px;
    display:block;
    float:right;
    margin: -2px 0px 0px 8px;
	color: #fff;
	font-size: 16px;
}
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

.SolarLogo
 {
	display : none;
 }
 
 .standardLogo
 {
	display : block !important;
 }
 
 .notIncluded
 {
	display : block !important;
 }

/* @media print {
 
 body
 {
	 font-size:9px;
	 margin:0px;
 }
 
 .SolarLogo
 {
	display : block;
 }

 .notIncluded
 {
	display : none !important;
 }
 .notIncluded span
 {
	display : none !important;
 }
 .standardLogo
 {
	display : none !important;
 }
 
 } */
 /* #chartdiv {
  width: 100%;
  height: 400px;
} */
input:focus {
    background-color: #ffa;
}
/* .table-responsive {
    display: table;
} */
table input[type=text],
    input[type=email],
    input[type=url],
    /* input[type=checkbox], */
    input[type=password] {
    width: 100%;
    font-size:14px;
}
/* 
table input[type=checkbox] {
    width: 100%;
} */

.itemTable{
    width:100%;
}

#eye {
  position:absolute;
  right:80%;
  top:6.5%;
}

table input.form-control {
   height:25px !important;
}

.input-group-text
{
    padding:3px !important;
}
.itemTable td:nth-of-type(1) {width:30%;}
.itemTable  td:nth-of-type(2) {width: 15%;}
.itemTable  td:nth-of-type(3) {width:15%;}
.itemTable  td:nth-of-type(4) {width:20%;}

.itemTable2 td:nth-of-type(1) {max-width:80px;}
.itemTable2  td:nth-of-type(2) {
    white-space:nowrap;
   /* border: 1px solid black; */
   max-width: 100px;
   overflow-y:hidden;
}
/* .itemTable2  td:nth-of-type(3) {width:25%;} */
.itemTable2  td:nth-of-type(4) {width:15%;}

@media screen and (max-width:500px){
    body{
        /* color:white; */
        font-size:10px !important;
    }  
    table thead
    {
        font-size:12px;
    }
    /* .summary_total
    {
        font-size: 10px !important;
    }
    .summary_total h4 input span
    {
        font-size: 10px !important;
    } */
    /* .equipment_cost
    {
        font-size: 14px !important;
    } */
    .itemTable span
    {
        font-size:10px;
    }
    .itemTable td
    {
        padding:0;
    }
    .itemTable input[type=text]
    {
        height:100% !important;
    }
}

@media screen and (max-width:1400px){
    table input[type=text],
    input[type=email],
    input[type=url],
    /* input[type=checkbox], */
    input[type=password] {
    width: 100%;
    font-size:10px;
    }
    /* table input[type=checkbox] {
        width: 80%;
    } */
    table thead
    {
        font-size:14px;
    }
    .withCheck
    {
        width:100% !important;
    }
}

.item {
  width: 100px;
  border: 1px solid #000;
  height: 20px;
  flex: 80px 1;
  text-align: center;
  color: #000;
}
::-webkit-scrollbar
{
  height: 6px;
  background-color: green;
  overflow-x: auto;
}

/* .summaryTanan table, td, th {
  border: 1px solid;
  padding:1%;
} */
.summaryTanan table {
  width:60%;
}

.summaryTanan table {
  width: 100%;
  border-collapse: collapse;
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
										<?php if($workorder->work_order_type_id == '4'){ ?>
											<a class="btn btn-success" href="#" data-toggle="modal" data-target="#sharePreviewAgree"><span class="fa fa-edit"></span> Share</a>
											<?php  }elseif($workorder->work_order_type_id == '3'){ ?>
												<a class="btn btn-success" href="#" data-toggle="modal" data-target="#sharePreviewSolar"><span class="fa fa-edit"></span> Share</a>
											<?php } else{ ?>
											<a class="btn btn-success" href="#" data-toggle="modal" data-target="#sharePreview"><span class="fa fa-edit"></span> Share</a>
                                        <?php } ?>
										<?php if($workorder->work_order_type_id == '2'){ ?>
											<a class="btn btn-sec" href="<?php echo base_url('workorder/editAlarm/' . $workorder->id) ?>"><span class="fa fa-edit"></span> Edit</a>
											<?php }elseif($workorder->work_order_type_id == '3')
                                                    { ?>
                                                    <a role="menuitem" class="btn btn-sec" tabindex="-1" href="<?php echo base_url('workorder/editSolar/' . $workorder->id) ?>"><span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                    <?php  }elseif($workorder->work_order_type_id == '4'){ ?>
                                                    <a role="menuitem" class="btn btn-sec" tabindex="-1" href="<?php echo base_url('workorder/editInstallation/' . $workorder->id) ?>"><span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                    <?php } else{ ?>
                                        	<a class="btn btn-sec" href="<?php echo base_url('workorder/edit/' . $workorder->id) ?>"><span class="fa fa-edit"></span> Edit</a>
                                        <?php } ?>

									<?php if($workorder->work_order_type_id == 1){ ?>
                       					<a href="<?php echo base_url('share_Link/work_order_pdf/' . $workorder->id) ?>" class="btn btn-sec download_work_order_pdfsss" acs-id="<?php echo $workorder->customer_id; ?>" workorder-id="<?php echo $workorder->id; ?>"><span class="fa fa-file-pdf-o"></span> PDF</a>
										   <?php }else if($workorder->work_order_type_id == 4){ ?>
										<a href="<?php echo base_url('share_Link/work_order_pdf_agreement/' . $workorder->id) ?>" class="btn btn-sec download_work_order_pdfsss" acs-id="<?php echo $workorder->customer_id; ?>" workorder-id="<?php echo $workorder->id; ?>"><span class="fa fa-file-pdf-o"></span> PDF</a>
										<?php } else{ ?>
										<a href="<?php echo base_url('share_Link/work_order_pdf_alarm/' . $workorder->id) ?>" class="btn btn-sec download_work_order_pdfsss" acs-id="<?php echo $workorder->customer_id; ?>" workorder-id="<?php echo $workorder->id; ?>"><span class="fa fa-file-pdf-o"></span> PDF</a>
									<?php } ?>


									<?php if($workorder->work_order_type_id == 1){ ?>
                       					<a class="btn btn-sec" data-print-modal="open" href="#" onclick="printDiv('printableArea')" value="Print Work Order"><span class="fa fa-print"></span> Print</a>
									<?php }else if($workorder->work_order_type_id == 3){ ?>
										<a class="btn btn-sec" data-print-modal="open" href="<?php echo base_url('workorder/printSolar/' . $workorder->id) ?>" value="Print Work Order"><span class="fa fa-print"></span> Print</a>
									<?php } else{ ?>
										<a class="btn btn-sec" data-print-modal="open" href="#" onclick="printDiv('printableArea')" value="Print Work Order"><span class="fa fa-print"></span> Print</a>
									<?php } ?>

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
					<div class="mobile_header" style="width:;"><?php echo $workorder->header; ?></div>
					<?php if($workorder->work_order_type_id == '3'){ ?>
					<div>
						<!-- <img src="<?= getCompanyBusinessProfileImage(); ?>"  style="max-width: 230px; max-height: 200px;float:right;margin-top:-260px;" class="SolarLogo"/> -->
					</div>
					<?php } ?>
					<!-- <hr> -->
						<div class="workorder-inner">
							<div align="right" class="notIncluded">
								<span class="presenter-title mobile_size"><b>WORK ORDER</b></span> <br> <span style="font-size:16px;"># <?php echo $workorder->work_order_number ?></span><br>
							</div>
							<hr style="border: 2px solid gray;">
								<div clas="row">
										<div class="col-sm-12 col-sm-push-12 text-right-sm">
										<div class="row">
											<div class="col-md-3">
												<div class="" style="margin-bottom: 20px;margin-left: 0px !important;">
													<!-- <img class="presenter-print-logo" style="max-width: 230px; max-height: 200px;" src="http://nsmartrac.com/assets/dashboard/images/logo.png"> -->
													<?php if($workorder->work_order_type_id == '4'){ ?> 
														<img src="<?php echo base_url().'assets/img/alarm_logo.jpeg' ?>"  style="max-width: 230px; max-height: 200px;" class="" /> 
														<?php }else{ ?>
															<img src="<?= getCompanyBusinessProfileImage(); ?>"  style="max-width: 230px; max-height: 200px;" class=""/> 
														<?php } ?>
												</div>
											</div>
											<div class="col-md-9">
											<div class="workorder-text" style="margin-top: 10px; margin-bottom: 20px;">											    
												<!-- </div>	-->
												<div align="right" class="mobile_size notIncluded"> 
													<table>
														<tbody>
														<tr>
															<!-- <td colspan="2"><span># <?php// echo $workorder->work_order_number ?></span></td> -->
														</tr>
														<tr>
															<td align="left"><div style=""><b>Date:</b> </div></td>
															<td align="right"><?php $wDate = $workorder->date_created; echo date("m-d-Y", strtotime($wDate) ); ?></td>
														</tr>
														<?php if($workorder->work_order_type_id == '2'){ ?> 
														<tr>
															<td align="left"><div style=""><b>Type:</b> </div></td>
															<td align="right"><?php echo $workorder->job_type ?></td>
														</tr>
														<?php } ?>
														<tr>
															<td align="left"><div style=""><b>Priority:</b> </div></td>
															<td align="right"><?php echo $workorder->priority ?></td>
														</tr>
														<?php if($workorder->work_order_type_id == '3'){ ?> 
														</tr>
															<td align="left"><div style=""><b>System  Type:</b> </div></td>
															<td align="right"> <span id=""><?php echo $workorder->panel_communication ?></span></td>
														</tr>
														<?php }else{ ?>
														</tr>
															<td align="left"><div style=""><b>Password:</b> </div></td>
															<td align="right"><?php echo $workorder->password ?></td>
														</tr>
														</tr>
															<td align="left"><div style=""><b>Security Number:</b> </div></td>
															<td align="right"> <span id="view_ssn"><?php echo $workorder->security_number ?></span><input type="hidden" id="view_ssn_input" value="<?php echo $workorder->security_number ?>"></td>
														</tr>
														<?php } ?>
														<?php if($workorder->work_order_type_id == '4'){ ?>
														</tr>
															<td align="left"><div style=""><b>Account Type:</b> </div></td>
															<td align="right"> <span id=""><?php echo $workorder->account_type ?></span></td>
														</tr>
														</tr>
															<td align="left"><div style=""><b>Communication  Type:</b> </div></td>
															<td align="right"> <span id=""><?php echo $workorder->panel_communication ?></span></td>
														</tr>
														</tr>
															<td align="left"><div style=""><b>Panel Type:</b> </div></td>
															<td align="right"> <span id=""><?php echo $workorder->panel_type ?></span></td>
														</tr>
														<?php }?>
														</tr>
															<td align="left"><div style=""><b>Source:</b> </div></td>
															<td align="right"><?php echo $lead->ls_name ?></td>
														</tr>
														<!-- </tr>
															<td align="left"><div style=""><b>Agent:</b> </div></td>
															<td align="right"><?php //echo $first->FName.' '.$first->LName; ?></td>
														</tr> -->
														
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
		         							   				<li><span class="ul-head"> FROM:</span></li>
															<!-- <hr style="border: 1px solid gray;"> -->
		         							   				<li><span class="ul-head line"><?php echo $company->business_name ?></span></li>
		         							   				<!-- <li><span class="ul-text">License: <?php //echo $company->license_state ?></span></li> -->
		         							   				<li><span class="ul-text"><?php echo $company->street; ?></span></li>
		         							   				<li><span class="ul-text"><?php echo $company->city .', '.$company->state.' '. $company->postal_code; ?></span></li>
		         							   				<li><span class="ul-text">Email: <?php echo $company->email_address ?></span></li>
		         							   				<li><span class="ul-text">Phone: <span class="phoneFormat"> <?php echo $company->office_phone ?> </span></span></li>			   			
		         							   			</ul>
		         							   		</div><br>
		         							   		<div class="ul-info">
		         							   			<ul>
		         							   				<li><span class="ul-head">TO:</span></li>
															<!-- <hr style="border: 1px solid gray;"> -->
		         							   				<li><span class="ul-head line"><?php echo $customer->contact_name .''. $customer->first_name .' '. $customer->middle_name .' '. $customer->last_name ?></span>
																<!-- <a href="" class="line ul-btns-text" style="color:green;">view</a> -->
																</li>
															<li><span class="ul-text"><?php echo $customer->mail_add .'<br>'. $customer->city .', '. $customer->state .' '. $customer->zip_code;  ?></span></li>
															<li><span class="ul-text">Email: <?php echo $customer->email ?></span></li>
															<li><span class="ul-text">Phone: <span class="phoneFormat2"> <?php echo $customer->phone_h ?></span></span></li>
		         							   			
		         							   			</ul>
		         							   		</div><br>

													<?php if($workorder->work_order_type_id == '3'){ }elseif($workorder->work_order_type_id == '4'){ }
													else{ ?>
		         							   		<div class="ul-info">
		         							   			<ul>
		         							   				<li><span class="ul-head">JOB:</span></li>
		         							   				<li>Job Name: <?php echo $workorder->job_name ?></li>
		         							   				<!-- <li><a href="" class="ul-text">Estimate #EST-000010 </a></li>	 -->
		         							   			<br>
		         							   			</ul>
		         							   		</div>
													<?php } ?>

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
																<?php foreach($contacts as $cont){ ?>
																<li style = "text-transform:capitalize;"><p><a href="#" class="ul-text"><?php echo $cont->name ?> <br> <?php echo $cont->phone ?> <br> <?php echo $cont->relation ?></a></p></li>
																<?php } ?>
																
															
															</ul>
														</div>
														<br><br>
													<?php }else{ } ?>
														

		         							   		<!-- <div class="ul-info">
		         							   			<ul>
		         							   				<li><a href="" class="ul-head">Appointment:</a></li>
		         							   		
		         							   				<li><a href="" class="ul-text">Not set </a></li>	
		         							   			
		         							   			</ul>
		         							   		</div> -->
		         							   			<div class="ul-info">
			         							   			<ul>
			         							   				<li><span class="ul-head">Job Location </span></li>
																<li class="show_mobile_view"><hr></li>
																<li><?php echo $workorder->job_location .'<br>'. $workorder->city .', '. $workorder->state .' '. $workorder->zip_code;  ?> &emsp; 
																<!-- <a href="#" style="color:green;">Show Map</a> -->
																</li>	
			         							   				<!-- <li></li>	 -->
			         							   			
			         							   			</ul>
		         							   			</div>
														<?php if($workorder->work_order_type_id == '3'){ } elseif($workorder->work_order_type_id == '4'){ } else{ ?>
														<hr>
														<div class="ul-info">
			         							   			<b class="ul-head">Terms and Conditions </b><br><br>
															<div style="height:; overflow:auto; background:#FFFFFF; padding-left:10px;">
																<?php echo $workorder->terms_and_conditions; ?>
															</div>
		         							   			</div>
														<?php } ?>


		         							   </div><br><br>
		         							   <!--  user info end-->
											
											<?php if($workorder->work_order_type_id == '3'){ } elseif($workorder->work_order_type_id == '4'){ } else{ ?>
		         							   <div class="table-inner">
		         							   		<table class=" table table-print table-items" style="width: 100%; border-collapse: collapse;">
											            <thead>
											                <tr>
											                    <th style="background: #f4f4f4; text-align: center; padding: 5px 0;font-weight:bold;">#</th>
											                    <th style="background: #f4f4f4; text-align: left; padding: 5px 0;font-weight:bold;">Description</th>
											                    <th style="background: #f4f4f4; text-align: right; padding: 5px 0;font-weight:bold;">Qty</th>
											                    <th style="background: #f4f4f4; text-align: right; padding: 5px 0;font-weight:bold;">Price</th>
											                    <th class="hidden_mobile_view" style="background: #f4f4f4; text-align: right; padding: 5px 0;font-weight:bold;">Discount</th>
											                    <th class="hidden_mobile_view" style="background: #f4f4f4; text-align: right; padding: 5px 0;font-weight:bold;">Tax (%)</th>
											                    <th style="background: #f4f4f4; text-align: right; padding: 5px 8px 5px 0;font-weight:bold;" class="text-right">Total</th>
											                </tr>
											            </thead>
													            <tbody>
																<?php foreach($workorder_items as $item){ ?>
																	<?php if($item->items_id != 0){ ?>
																		<tr class="table-items__tr">
																			<td style="width: 30px; text-align: center;" valign="top">  # </td>
																			<td valign="top"> <?php echo $item->title; ?>   </td>
																			<td style="width: 50px; text-align: right;" valign="top"> <?php echo $item->qty ?>  </td>
																			<td style="width: 80px; text-align: right;" valign="top">$<?php echo number_format($item->costing,2) ?></td>
																			<td class="hidden_mobile_view" style="width: 80px; text-align: right;" valign="top">
																				$ 0<?php //echo $item->discount ?>
																				</td>
																			<td class="hidden_mobile_view" style="width: 80px; text-align: right;" valign="top">
																				$<?php echo number_format($item->tax,2) ?>
																				</td>
																			<td style="width: 90px; text-align: right;" valign="top">$<?php $a = $item->qty * $item->costing; $b = $a + $item->tax; echo number_format($b,2); ?></td>
																		</tr>
																	<?php }else{ ?>
																		<tr class="table-items__tr">
																			<td style="width: 30px; text-align: center;" valign="top">  # </td>
																			<td valign="top" colspan="5"> <div id="PaName_<?php echo $item->package_id; ?>"></div> <br>
																			<div id="packageItemsTitle<?php echo  $item->package_id; ?>" style="padding-left:5%;">
																			<div id="packageItems<?php echo  $item->package_id; ?>" style="padding-left:5%;"></div>
																			</td>
																			<td style="width: 90px; text-align: right;" valign="top">$<?php $a = $item->qty * $item->costing; $b = $a + $item->tax; echo number_format($b,2); ?></td>
																		</tr>
																	<?php } ?>
																	<?php } ?>
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
													                                <td style="padding: 8px 8px 8px 0; text-align: right; border-bottom: 1px solid #eaeaea;" class="text-right">$<?php echo number_format((Float)$workorder->subtotal,2) ?></td>
													                            </tr>
																				<tr>
																					<td colspan="5"></td>
													                                <td style="padding: 8px 0; text-align: right; border-bottom: 1px solid #eaeaea;" class="">Taxes</td>
													                                <td style="padding: 8px 8px 8px 0; text-align: right; border-bottom: 1px solid #eaeaea;" class="text-right">$<?php echo number_format((Float)$workorder->taxes,2) ?></td>
													                            </tr>
																				<?php if($workorder->work_order_type_id == 1){ ?>
																				<tr>
																					<td colspan="5"></td>
													                                <td style="padding: 8px 0; text-align: right; border-bottom: 1px solid #eaeaea;" class=""><?php echo $workorder->adjustment_name ?></td>
													                                <td style="padding: 8px 8px 8px 0; text-align: right; border-bottom: 1px solid #eaeaea;" class="text-right">$<?php echo number_format((Float)$workorder->adjustment_value,2) ?></td>
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
													                                <td style="width: 90px; padding: 8px 8px 8px 0; text-align: right; background: #f4f4f4;" class="text-right"><b>$<?php echo number_format((Float)$workorder->grand_total,2) ?></b></td>
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

									<?php } ?>	
									<?php if($workorder->work_order_type_id == '3'){ ?>
										<div class="row box-left-mini">
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
														<span style="font-size:16px;"><?php echo $solars->tor; ?></span>
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
														<span style="font-size:16px;"><?php echo $solars->aor; ?></span>
														<br><br><hr>
														</div>
													</div>
													<div class="row"> 
														<div class="col-md-2">
															<div style="padding:20px;border-radius:5px;background-color:white;width:50%;">D</div>
														</div>
														<div class="col-md-10">
														<h6>Solar Panel Mounting Preference</h6>
														<span style="font-size:16px;"><?php echo $solars->spmp; ?></span>
														<br><br><hr>
														</div>
													</div>
													<div class="row"> 
														<div class="col-md-2">
															<div style="padding:20px;border-radius:5px;background-color:white;width:50%;">E</div>
														</div>
														<div class="col-md-10">
														<h6>Home Owner Associations</h6>
														<span style="font-size:16px;"><?php echo $solars->hoa; ?></span>
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
																		<h6>Files Uploaded</h6>
																		<?php foreach($solar_files as $sfiles){ ?>
																			<p><a href="<?php echo base_url().'uploads/workorders/solar/'.$sfiles->solar_image; ?>" class="dwn" target="_blank"><?php echo $sfiles->solar_image; ?></a></p>
																			<p><a href="<?php echo base_url().'uploads/workorders/solar/'.$sfiles->solar_image1; ?>" class="dwn" target="_blank"><?php echo $sfiles->solar_image1; ?></a></p>
																			<p><a href="<?php echo base_url().'uploads/workorders/solar/'.$sfiles->solar_image2; ?>" class="dwn" target="_blank"><?php echo $sfiles->solar_image2; ?></a></p>
																			<p><a href="<?php echo base_url().'uploads/workorders/solar/'.$sfiles->solar_image3; ?>" class="dwn" target="_blank"><?php echo $sfiles->solar_image3; ?></a></p>
																			<p><a href="<?php echo base_url().'uploads/workorders/solar/'.$sfiles->solar_image4; ?>" class="dwn" target="_blank"><?php echo $sfiles->solar_image4; ?></a></p>
																		<?php } ?>
																	</div>
																	<div class="col-md-6">
																		<div class="input-group">
																			<div class="input-group-prepend">
																				<span class="input-group-text">$</span>
																			</div>
																			<input type="text" name="estimated_bill" class="form-control" value="<?php echo number_format($solars->estimated_bill); ?>" aria-label="Amount" readonly>
																			<!-- <div class="input-group-append">
																				<span class="input-group-text">.00</span>
																			</div> -->
																		</div>
																		<center>Estimated Bill</center>
																	</div>
																</div>
																
															</div>
															<h6>Electric Bill is over $100</h6> 
															<span style="font-size:16px;"><?php echo $solars->ebis; ?></span>
															<br>
															<h6>How do you get your Invoice</h6>
															<span style="font-size:16px;"><?php echo $solars->hdygi; ?></span>
															<br>
															<h6>Electric Bill Account #</h6>
															<span style="font-size:16px;"><?php echo $solars->eba_text; ?></span>
															<br><br><br><hr>
														</div>
													</div>
													<div class="row" style="margin-bottom:70px;"> 
														<div class="col-md-2">
															<div style="padding:20px;border-radius:5px;background-color:white;width:50%;">G</div>
														</div>
														<div class="col-md-10">
														<h6>Employment Status</h6>
														<span style="font-size:16px;"><?php echo $solars->es; ?></span>
														<!-- <hr> -->
														</div>
													</div>
												</div>
											</div>
											
												
											<div class="col-md-6">
													<div style="padding:3%;border:solid black 1px;font-weight:bold;margin-top:-130px;">
														Please fill in the form completely, and return it to a solar specialist or email to support@adtsolarpro.com for consideration.
													</div>
													<br><br>
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
																<b>Comments:</b>
															</div>
														</div>
														<br>
														<div class="row"> 
															<div class="col-md-12" style="border: solid gray 1px;border-top-left-radius: 25px;border-top-right-radius: 25px;">
															<center><h4>ENERGY USAGE HISTORY SAMPLE</h4></center>
																<div id="chartdiv"></div>
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
										<!-- <hr>
											<div class="ul-info">
			         						<b class="ul-head">Options</b><br><br>
												<div style="height:80px; overflow:auto; background:#FFFFFF; padding-left:10px;">
													<p class="text-uppercase"><?php echo $solars->options; ?></p>
												</div>
		         							 </div>
										<hr>
											<div class="ul-info">
			         						<b class="ul-head">Comments</b><br><br>
												<div style="height:120px; overflow:auto; background:#FFFFFF; padding-left:10px;">
													<?php echo $workorder->comments; ?>
												</div>
		         							 </div>
										<hr> -->

										<hr>
											<div class="ul-info">
			         						<b class="ul-head">Use of Personal Information Collected</b><br><br>
												<div style="">
												<p>We use the information we collect to provide you with our products and services and to respond to your questions. We also use the information for editorial and feedback purposes, for marketing and promotional purposes, to inform advertisers as to how many visitors have seen or clicked on their advertisements and to customize the content and layout of ClearCaptions' website. We also use the information we collect for statistical analysis of users' behavior, for product development, for content improvement, to ensure our product and services remain functioning and secure and to investigate and protect against any illegal activities or violations of our Terms of Service.</p>
												</div>
		         							 </div>
										<br><br>


									<?php }elseif($workorder->work_order_type_id == '4'){ ?>

										<div class="row">
											<div class="form-group col-md-2">
												<div class="select-wrap">
													<label for="lead_source">Lead Source</label>
													<select id="lead_source" name="lead_source" class="form-control custom-select m_select" disabled>
														<?php foreach($lead_source as $leads){ ?>
														<option value="<?php echo $leads->ls_id; ?>" <?php if($workorder->lead_source_id == $leads->ls_id){ echo 'selected'; }else{ echo ''; } ?> ><?php echo $leads->ls_name; ?></option>
														<?php } ?>
													</select>
												</div>    
											</div> 
											<div class="form-group col-md-2">
												<div class="select-wrap">
													<label for="lead_source">Account Type</label>
													<select id="account_type" name="account_type" class="form-control custom-select m_select" disabled>
														<option value="<?php echo $workorder->account_type; ?>"><?php echo $workorder->account_type; ?></option>
														<!-- <option value="Residential">Residential</option>
														<option value="Commercial">Commercial</option>
														<option value="Rental">Rental</option>
														<option value="Inhouse">Inhouse</option> -->
													</select>
													<input type="hidden" value="<?php echo $workorder->account_type; ?>" class="account_typeClass">
												</div>    
											</div> 
											<div class="form-group col-md-2">
												<div class="select-wrap">
													<label for="lead_source">Communication Type</label>
													<select id="communication_type" name="communication_type" class="form-control custom-select m_select" disabled>
														<?php //oreach($system_package_type as $lead){ ?>
														<option value=""><?php echo $workorder->panel_communication; ?></option>
														<?php //} ?>
													</select>
												</div>    
											</div> 
											<div class="form-group col-md-2">
												<div class="select-wrap">
													<label for="lead_source">Panel Type</label>
													<select name="panel_type" id="panel_type" class="form-control m_select" data-value="<?= isset($workorder) ? $workorder->panel_type : "" ?>" disabled>
														<option <?php if(isset($workorder)){ if($workorder->panel_type == ''){echo "selected";} } ?>  value="0">- none -</option>
														<option <?php if(isset($workorder)){ if($workorder->panel_type == 'AERIONICS'){echo "selected";} } ?> value="AERIONICS">AERIONICS</option>
														<option <?php if(isset($workorder)){ if($workorder->panel_type == 'AlarmNet'){echo "selected";} } ?> value="AlarmNet">AlarmNet</option>
														<option <?php if(isset($workorder)){ if($workorder->panel_type == 'Alarm.com'){echo "selected";} } ?> value="Alarm.com">Alarm.com</option>
														<option <?php if(isset($workorder)){ if($workorder->panel_type == 'Alula'){echo "selected";} } ?> value="Alula">Alula</option>
														<option <?php if(isset($workorder)){ if($workorder->panel_type == 'Bosch'){echo "selected";} } ?> value="Bosch">Bosch</option>
														<option <?php if(isset($workorder)){ if($workorder->panel_type == 'DSC'){echo "selected";} } ?> value="DSC">DSC</option>
														<option <?php if(isset($workorder)){ if($workorder->panel_type == 'ELK'){echo "selected";} } ?> value="ELK">ELK</option>
														<option <?php if(isset($workorder)){ if($workorder->panel_type == 'FBI'){echo "selected";} } ?> value="FBI">FBI</option>
														<option <?php if(isset($workorder)){ if($workorder->panel_type == 'GRI'){echo "selected";} } ?> value="GRI">GRI</option>
														<option <?php if(isset($workorder)){ if($workorder->panel_type == 'GE'){echo "selected";} } ?> value="GE">GE</option>
														<option <?php if(isset($workorder)){ if($workorder->panel_type == 'Honeywell'){echo "selected";} } ?> value="Honeywell">Honeywell</option>
														<option <?php if(isset($workorder)){ if($workorder->panel_type == 'Honeywell Touch'){echo "selected";} } ?> value="Honeywell Touch">Honeywell Touch</option>
														<option <?php if(isset($workorder)){ if($workorder->panel_type == 'Honeywell 3000'){echo "selected";} } ?> value="Honeywell 3000">Honeywell 3000</option>
														<option <?php if(isset($workorder)){ if($workorder->panel_type == 'Honeywell'){echo "selected";} } ?> value="Honeywell Vista">Honeywell Vista</option>
														<option <?php if(isset($workorder)){ if($workorder->panel_type == 'Honeywell Vista with Sem'){echo "selected";} } ?> value="Honeywell Vista with Sem">Honeywell Vista with Sem</option>
														<option <?php if(isset($workorder)){ if($workorder->panel_type == 'Honeywell Lyric'){echo "selected";} } ?> value="Honeywell Lyric">Honeywell Lyric</option>
														<option <?php if(isset($workorder)){ if($workorder->panel_type == 'IEI'){echo "selected";} } ?> value="IEI">IEI</option>
														<option <?php if(isset($workorder)){ if($workorder->panel_type == 'MIER'){echo "selected";} } ?> value="MIER">MIER</option>
														<option <?php if(isset($workorder)){ if($workorder->panel_type == '2 GIG'){echo "selected";} } ?> value="2 GIG">2 GIG</option>
														<option <?php if(isset($workorder)){ if($workorder->panel_type == '2 GIG Go Panel 2'){echo "selected";} } ?> value="2 GIG Go Panel 2">2 GIG Go Panel 2</option>
														<option <?php if(isset($workorder)){ if($workorder->panel_type == '2 GIG Go Panel 3'){echo "selected";} } ?> value="2 GIG Go Panel 3">2 GIG Go Panel 3</option>
														<option <?php if(isset($workorder)){ if($workorder->panel_type == 'Qolsys'){echo "selected";} } ?> value="Qolsyx">Qolsys</option>
														<option <?php if(isset($workorder)){ if($workorder->panel_type == 'Qolsys IQ Panel 2'){echo "selected";} } ?> value="Qolsys IQ Panel 2">Qolsys IQ Panel 2</option>
														<option <?php if(isset($workorder)){ if($workorder->panel_type == 'Qolsys IQ Panel 2 Plus'){echo "selected";} } ?> value="Qolsys IQ Panel 2 Plus">Qolsys IQ Panel 2 Plus</option>
														<option <?php if(isset($workorder)){ if($workorder->panel_type == 'Qolsys IQ Panel 3'){echo "selected";} } ?> value="Qolsys IQ Panel 3">Qolsys IQ Panel 3</option>
														<option <?php if(isset($workorder)){ if($workorder->panel_type == 'Custom'){echo "selected";} } ?> value="Custom">Custom</option>
														<option <?php if(isset($workorder)){ if($alarm_info->panel_type == 'Other'){echo "selected";} } ?> value="Other">Other</option>
													</select>
												</div> 
											</div>   
											<div class="form-group col-md-2">
												<div class="select-wrap">
													<label for="lead_source">Jobs Tags</label>
													<select id="job_tags" name="job_tags" class="form-control custom-select m_select" disabled>
														<?php foreach($job_tags as $jb){ ?>
														<option value="<?php echo $jb->name; ?>" <?php if($workorder->job_tags == $jb->id){ echo 'selected'; }else{ echo ''; } ?> ><?php echo $jb->name; ?></option>
														<?php } ?>
													</select>
												</div>    
											</div> 
										</div>
										
										<div class="row" style="font-size:;">                   
											<div class=" col-md-6 box-left-mini">
												<center>
												<div class="front" style="text-align:center;background-color:#4a5594;color:white;padding:1%;border-radius:20px;width:95%;">
													<h6>Items</h6>
												</div>
												</center><br>
												<div class="behind_container" style="background-color:#ced4e4;margin-top:-20px;padding:20px;">
													<table  class="table-bordered">
														<thead align="center">
															<th>Items</th>
															<th>Quantity</th>
															<th>Location</th>
															<th>Price</th>
														</thead>
														<tbody>
															<?php foreach($agree_items as $aItems) { ?>
															<tr>
																<td><input type="text" style="background-color:#ced4e4;" class="form- border-top-0 border-right-0 border-left-0 border-bottom-0 items" name="item[]" value="<?php echo $aItems->item; if($aItems->check_data == NULL){ echo ''; }else{ echo ' ('. $aItems->check_data .') ';} ?>" readonly></td>
																<td><input type="text" style="background-color:#ced4e4;" class="form- border-top-0 border-right-0 border-left-0 border-bottom-0" name="qty[]" value="<?php echo $aItems->qty ?>" readonly></td>
																<td><input type="text" style="background-color:#ced4e4;" class="form- border-top-0 border-right-0 border-left-0 border-bottom-0" name="location[]" value="<?php echo $aItems->location ?>" readonly></td>
																<td><input type="text" style="background-color:#ced4e4;" class="form- border-top-0 border-right-0 border-left-0 border-bottom-0 allprices" name="price[]"  value="<?php echo $aItems->price ?>" readonly></td>
															</tr>
															<?php } ?>
														</tbody>
													</table>
												</div>
												<br>
												<div class="row"> 
													<div class="col-md-6">
														<input type="text" name="installation_date" class="form-control border-top-0 border-right-0 border-left-0" value="<?php 
														$originalDate = $workorder->install_date;
														$newDate = date("m-d-Y", strtotime($originalDate)); echo $newDate ?>" readonly style="background-color: #fff;">
														<b>Installation Date:</b>
													</div>
													<div class="col-md-6">
														<input type="text" name="installation_date" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $workorder->install_time; ?>" readonly style="background-color: #fff;">
														<b>Install Time Date:</b>
													</div>
												</div>
												<br><br>
												<div class="row">                   
													<div class="form-group col-md-4">
														<div class="select-wrap">
														<input type="text" name="installation_date" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $workorder->payment_method; ?>" readonly style="background-color: #fff;">
															<b>Payment Method</b>
																<!-- <select name="payment_method" id="payment_method" class="form-control custom-select m_select">
																	<option value="">Choose method</option>
																	<option value="Cash">Cash</option>
																	<option value="Check">Check</option>
																	<option value="Credit Card">Credit Card</option>
																	<option value="Debit Card">Debit Card</option>
																	<option value="ACH">ACH</option>
																	<option value="Venmo">Venmo</option>
																	<option value="Paypal">Paypal</option>
																	<option value="Square">Square</option>
																	<option value="Invoicing">Invoicing</option>
																	<option value="Warranty Work">Warranty Work</option>
																	<option value="Home Owner Financing">Home Owner Financing</option>
																	<option value="e-Transfer">e-Transfer</option>
																	<option value="Other Credit Card Professor">Other Credit Card Professor</option>
																	<option value="Other Payment Type">Other Payment Type</option>
																</select> -->
															</div> 
														</div>     
														<div class="form-group col-md-4">
															<input type="text" class="form-control input-element border-top-0 border-right-0 border-left-0" name="payment_amount" id="payment_amount"  value="<?php echo number_format((float)$workorder->payment_amount,2); ?>" readonly  style="background-color: #fff;"/>
															<b>Amount<small class="help help-sm"> ( $ )</small></b>
														</div>
														<div class="form-group col-md-4">
															<input type="text" class="form-control input-element border-top-0 border-right-0 border-left-0" value="<?php echo $agreements->billing_date; ?>" readonly  style="background-color: #fff;"  />
															<b>Billing Date</b>
														</div>
												</div>
												<div class="row">                   
													<div class="col-md-12">
														<div style="text-align: justify; text-justify: inter-word;font-size:8px;">
															<!-- <b>PAYMENT DETAILS:</b>
															<hr> -->
																<?php //echo 'Amount: '.$amount; ?>
																<?php 
																if($payment_method ==  'Cash'){
																	echo 'Payment Method: Cash';
																}
																elseif($payment_method ==  'Check')
																{
																	// echo 'Payment Method: Check';
																	echo '<br> Check Number: '. $check_number;
																	echo '<br> Rounting Number: '. $routing_number;
																	echo '<br> Account Number: '. $account_number;
																}
																elseif($payment_method ==  'Credit Card')
																{
																	// echo 'Payment Method: Credit Card';
																	echo '<br> Credit Number: '. $credit_number;
																	echo '<br> Credit Expiry: '. $credit_expiry;
																	echo '<br> CVC: '. $credit_cvc;
																}
																elseif($payment_method ==  'Debit Card')
																{
																	// echo 'Payment Method: Debit Card';
																	echo '<br> Credit Number: '. $credit_number;
																	echo '<br> Credit Expiry: '. $credit_expiry;
																	echo '<br> CVC: '. $credit_cvc;
																}
																elseif($payment_method ==  'ACH')
																{
																	// echo 'Payment Method: Debit Card';
																	echo '<br> Routing Number: '. $routing_number;
																	echo '<br> Account Number: '. $account_number;
																}
																elseif($payment_method ==  'Venmo')
																{
																	// echo 'Payment Method: Venmo';
																	echo '<br> Account Credential: '. $account_credentials;
																	echo '<br> Account Note: '. $account_note;
																	echo '<br> Confirmation: '. $confirmation;
																}
																elseif($payment_method ==  'Paypal')
																{
																	// echo 'Payment Method: Paypal';
																	echo '<br> Account Credential: '. $account_credentials;
																	echo '<br> Account Note: '. $account_note;
																	echo '<br> Confirmation: '. $confirmation;
																}
																elseif($payment_method ==  'Square')
																{
																	// echo 'Payment Method: Square';
																	echo '<br> Account Credential: '. $account_credentials;
																	echo '<br> Account Note: '. $account_note;
																	echo '<br> Confirmation: '. $confirmation;
																}
																elseif($payment_method ==  'Invoicing')
																{
																	// echo 'Payment Method: Invoicing';
																	echo '<br> Address: '. $mail_address.' '. $mail_locality.' '. $mail_state.' '. $mail_postcode.' '. $mail_cross_street;
																}
																elseif($payment_method ==  'Warranty Work')
																{
																	// echo 'Payment Method: Warranty Work';
																	echo '<br> Account Credential: '. $account_credentials;
																	echo '<br> Account Note: '. $account_note;
																}
																elseif($payment_method ==  'Home Owner Financing')
																{
																	// echo 'Payment Method: Home Owner Financing';
																	echo '<br> Account Credential: '. $account_credentials;
																	echo '<br> Account Note: '. $account_note;
																}
																elseif($payment_method ==  'e-Transfer')
																{
																	// echo 'Payment Method: e-Transfer';
																	echo '<br> Account Credential: '. $account_credentials;
																	echo '<br> Account Note: '. $account_note;
																}
																elseif($payment_method ==  'Other Credit Card Professor')
																{
																	// echo 'Payment Method: Other Credit Card Professor';
																	echo '<br> Credit Number: '. $credit_number;
																	echo '<br> Credit Expiry: '. $credit_expiry;
																	echo '<br> CVC: '. $credit_cvc;
																}
																elseif($payment_method ==  'Other Payment Type')
																{
																	// echo 'Payment Method: Other Payment Type';
																	echo '<br> Account Credential: '. $account_credentials;
																	echo '<br> Account Note: '. $account_note;
																}
																?>
															<!-- <br><br><br> -->
														</div>
													</div>
												</div>
												<div class="row">                   
													<div class="form-group col-md-12">
														<b>Notes</b>
														<!-- <textarea class="form-control" style="width:100%;"></textarea> -->
														<div class="form-group">
															<?php echo $workorder->comments; ?>
														</div>
													</div>                                        
												</div>
												<div class="row" style="margin-top:-46px;">
													<!-- <div class="form-group col-md-12"> -->
														<div class="col-md-6">
															<input type="text" name="sales_re_name" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $agreements->sales_re_name; ?>" readonly style="background-color: #fff;">
															<b>Sales Rep's Name</b>
														</div>
														<div class="col-md-6">
															<input type="text" name="sale_rep_phone" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $agreements->sale_rep_phone; ?>" readonly style="background-color: #fff;">
															<b>Cell Phone</b>
														</div>     
													<!-- </div> -->
												</div>   
										 		<br>
												<div class="row">                   
													<div class="form-group col-md-12">
														<input type="text" name="team_leader" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $agreements->team_leader; ?>" readonly style="background-color: #fff;">
														<b>Team Leader</b>
													</div>                                        
												</div>
											</div>
											<div class=" col-md-6">
												<!-- <div style="padding:1%;border:solid black 1px;font-weight:bold;">
													<div class="row" align="center">
														<div class="col-md-6">
															<input type="text" class="form-control input-element border-top-0 border-right-0 border-left-0" name="password" placeholder="Enter Password" required
																	id="password" >
															<b>Password</b> <span class="form-required">*</span>
														</div>
														<div class="col-md-6">
															<input type="text" class="form-control input-element border-top-0 border-right-0 border-left-0" name="ssn"
																	id="ssn"
																	placeholder="Enter SSN"/>
															<b>SSN</b> <small class="help help-sm">(optional)</small>
														</div>
													</div>
												</div>
												<br> -->
												<center>
												<div class="front" style="text-align:center;background-color:#4a5594;color:white;padding:0.5%;border-radius:20px;width:100%;">
													<h6>Details:</h6>
												</div>
												</center>
												<br>
													<div class="row"> 
														<div class="col-md-6">
															<input type="text" name="firstname" id="firstname" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $agreements->firstname; ?>" readonly style="background-color: #fff;">
															<b>First name:</b>
														</div>
														<div class="col-md-6">
															<input type="text" name="lastname" id="lastname" class="form-control border-top-0 border-right-0 border-left-0"  value="<?php echo $agreements->lastname; ?>" readonly style="background-color: #fff;">
															<b>Last name:</b>
														</div>
													</div>
													<div class="row commercialDet" style="display:none;"> 
														<div class="col-md-12">
															<input type="text" name="businessname" id="businessname" class="form-control border-top-0 border-right-0 border-left-0"  value="<?php echo $agreements->businessname; ?>">
															<b>Business Name:</b>
														</div>
													</div>
													<div class="row"> 
														<div class="col-md-6">
															<input type="text" name="firstname_spouse" id="firstname" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $agreements->firstname_spouse; ?>" readonly style="background-color: #fff;">
															<b>First name (Spouse):</b>
														</div>
														<div class="col-md-6">
															<input type="text" name="lastname_spouse" id="lastname" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $agreements->lastname_spouse; ?>" readonly style="background-color: #fff;">
															<b>Last name (Spouse):</b>
														</div>
													</div>
													<div class="row"> 
														<div class="col-md-12">
															<input type="text" name="address" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $agreements->address; ?>" readonly style="background-color: #fff;">
															<b>Address:</b>
														</div>
													</div>
													<div class="row"> 
														<div class="col-md-5">
															<input type="text" name="city" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $agreements->city; ?>" readonly style="background-color: #fff;">
															<b>City:</b>
														</div>
														<div class="col-md-7">
															<input type="text" name="state" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $agreements->state; ?>" readonly style="background-color: #fff;">
															<b>State:</b>
														</div>
													</div>
													<div class="row"> 
														<div class="col-md-5">
															<input type="text" name="postcode" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $agreements->postcode; ?>" readonly style="background-color: #fff;">
															<b>Postcode:</b>
														</div>
														<div class="col-md-7">
															<input type="text" name="county" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $agreements->county; ?>" readonly style="background-color: #fff;">
															<b>County:</b>
														</div>
													</div>
													<div class="row"> 
														<div class="col-md-12">
															<input type="text" name="phone" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $workorder->phone_number; ?>" readonly style="background-color: #fff;">
															<b>Phone:</b>
														</div>
													</div>
													<div class="row"> 
														<div class="col-md-12">
															<input type="text" name="mobile" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $workorder->mobile_number; ?>" readonly style="background-color: #fff;">
															<b>Mobile:</b>
														</div>
													</div>
													<div class="row"> 
														<div class="col-md-12">
															<input type="text" name="email" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $workorder->email; ?>" readonly style="background-color: #fff;">
															<b>Email:</b>
														</div>
													</div>
													<div class="row"> 
														<div class="col-md-5">
															<input type="text" name="first_ecn" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $agreements->first_ecn; ?>" readonly style="background-color: #fff;">
															<b>1st Emergency Contact Name:</b>
														</div>
														<div class="col-md-7">
															<input type="text" name="first_ecn_no" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $agreements->first_ecn_no; ?>" readonly style="background-color: #fff;">
															<b>Phone:</b>
														</div>
													</div>
													<div class="row"> 
														<div class="col-md-5">
															<input type="text" name="second_ecn" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $agreements->second_ecn; ?>" readonly style="background-color: #fff;">
															<b>2nd Emergency Contact Name:</b>
														</div>
														<div class="col-md-7">
															<input type="text" name="second_ecn_no" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $agreements->second_ecn_no; ?>" readonly style="background-color: #fff;">
															<b>Phone:</b>
														</div>
													</div>
													<div class="row"> 
														<div class="col-md-5">
															<input type="text" name="third_ecn" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $agreements->third_ecn; ?>" readonly style="background-color: #fff;">
															<b>3rd Emergency Contact Name:</b>
														</div>
														<div class="col-md-7">
															<input type="text" name="third_ecn_no" class="form-control border-top-0 border-right-0 border-left-0" value="<?php echo $agreements->third_ecn_no; ?>" readonly style="background-color: #fff;">
															<b>Phone:</b>
														</div>
													</div>
													<br>
													<div class="row"> 
														<div class="col-md-12">
															<table class="table table-bordered table-sm" style="width:80%;">
																<tr>
																	<td>Equipment Cost</td>
																	<td><h5>$ <?php echo number_format((Float)$workorder->subtotal,2); ?></h5> </td>
																</tr>
																<tr>
																	<td>Sales Tax</td>
																	<td><h5>$ <?php echo number_format((Float)$workorder->taxes,2); ?></h5> </td>
																</tr>
																<tr>
																	<td>Installation Cost</td>
																	<td><h5>$ <?php echo number_format((Float)$workorder->installation_cost,2); ?></h5> </td>
																</tr>
																<tr>
																	<td>One time (Program and Setup)</td>
																	<td><h5>$ <?php echo number_format((Float)$workorder->otp_setup,2); ?></h5> </td>
																</tr>
																<tr>
																	<td>Monthly Monitoring</td>
																	<td><h5>$ <?php echo number_format((Float)$workorder->monthly_monitoring,2); ?></h5></td>
																</tr>
																<tr>
																	<td>Total Due</td>
																	<td><h5>$ <?php echo number_format((Float)$workorder->grand_total,2); ?></h5></td>
																</tr>
															</table>
														</div>
													</div>
												
											</div>
										</div>
										<div class="ul-info">
			         						<b class="ul-head">Agreement </b><br><br>
											<div style="height:; overflow:auto; background:#FFFFFF; padding-left:10px;">
												<?php echo $workorder->terms_and_conditions; ?>
											</div>
		         						</div>
										 <br>

									<?php }
									
									else{ } ?>			
														<div class="ul-info">
			         							   			<b class="ul-head">ASSIGNED TO</b><br><br>
																<div class="row">
																<?php if(!empty($workorder->company_representative_signature)){ ?>
																	<div class="col-md-4">
																		<img src="<?php echo base_url($workorder->company_representative_signature); ?>" style="height: 100px;">
																		<hr>
																		<?php if(is_numeric($workorder->company_representative_name)){  ?>
																		<center><?php echo $first->FName.' '.$first->LName;  ?></center>
																		<?php }else{ echo '<center>'.$workorder->company_representative_name.'</center>'; } ?>
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
        <div class="modal-dialog modal-lg" role="document">
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
                            <input type="text" class="form-control" value="<?php echo base_url('share_Link/public_view/'.$workorder->id) ?>" id="myInput" readonly>
							<br>
							<a href="#" class="btn btn-success" onclick="myCopyFunction()">Copy link to Clipboard</a>
							<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#shareLinkToEmail">Email Share Link</a>
                        </p>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="sharePreviewAgree" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
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
                            <input type="text" class="form-control" value="<?php echo base_url('share_Link/public_view_agreement/'.$workorder->id) ?>" id="myInput" readonly>
							<br>
							<a href="#" class="btn btn-success" onclick="myCopyFunction()">Copy link to Clipboard</a>
							<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#shareLinkToEmail">Email Share Link</a>
                        </p>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

	<div class="modal fade" id="sharePreviewSolar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
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
                            <input type="text" class="form-control" value="<?php echo base_url('share_Link/public_view_solar/'.$workorder->id) ?>" id="myInput" readonly>
							<br>
							<a href="#" class="btn btn-success" onclick="myCopyFunction()">Copy link to Clipboard</a>
							<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#shareLinkToEmail">Email Share Link</a>
                        </p>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

	
	
	<div class="modal fade" id="shareLinkToEmail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Share link to email</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
					<?php echo form_open_multipart('workorder/sendLinkToEmail', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?> 
                        <div class="validation-error" style="display: none;"></div>
                        <p>
							<b>To</b><br>
                            <input type="email" class="form-control" name="emails_list" id="my_input" >
							<input type="hidden" class="form-control" name="" id="my_input_hidden" value="<?php echo $workorder->email ?>" >
							<inpupt type="hidden" name="email_list[]" class="email_list" value="<?php echo $workorder->email ?>"><br><br>
							
							<b>Content</b>
							<textarea name="email_content" id="email_content_share" style="height:1000px;">

							<p dir="rtl" style="text-align:center">
								<!-- <span style="color:#ffffff"><span style="font-size:30px"><span style="background-color:#9b59b6">&nbsp; <?php //echo $company->business_name ?> &nbsp;&nbsp;</span></span></span> -->
								<img src="<?= getCompanyBusinessProfileImage(); ?>"  style="width:100px;height:100px;" />
							</p>
							
							
							<p>W O R K O R D E R # &nbsp;<?php echo $workorder->work_order_number ?>&nbsp; F R O M &nbsp; <?php echo $company->business_name ?></p>
							<br />

							<p>DEAR <?php echo $customer->contact_name .''. $customer->first_name ?>,<br /><br />
							THANK YOU FOR CHOOSING <?php echo $company->business_name ?>! <br />
							YOUR WORKORDER# <?php echo $workorder->work_order_number ?> IS ATTACHED. &nbsp; THE WORK ORDER CAN BE FOUND IN THE ATTACHED PDF FILE.<br /><br />

							CLICK THE LINK TO VIEW THE WORK ORDER ONLINE. <br>
							<a href="<?php echo base_url('share_Link/public_view_solar/'.$workorder->id) ?>"><?php echo base_url('share_Link/public_view/'.$workorder->id) ?></a><br /><br />

							REGARDS,<br /><br />
							<?php echo $company->business_name ?><br /><br /><br /><br />

							<p style="text-align:center">Powered by nSmarTrac</p>

							</textarea>

							<div id="testArea"></div>
							<br>
							<center><input type="submit" value="Send Email" class="btn btn-success"></center>
                        </p>
					<?php echo form_close(); ?>
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
    CKEDITOR.replace('email_content_share');
</script>

<script>
function myCopyFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
//   alert("Copied the text: " + copyText.value);
}
</script>

<script>
	$(function() {
		
	var acctType  = $(".account_typeClass").val();

		if (acctType == 'Commercial')
		{
			$('.commercialDet').show();
		}else
		{
			$('.commercialDet').hide();
		}
	});
</script>
<script>
(function( $ ){
 
 $.fn.multipleInput = function() {

	  return this.each(function() {

		   // create html elements

		   // list of email addresses as unordered list
		   $list = $('#testArea');
		   var valueEmail = $('#my_input_hidden').val();

		   // input
		   var $input = $('<input type="text" value="'+ valueEmail +'"/>').keyup(function(event) {

				if(event.which == 32 || event.which == 188) {
					 // key press is space or comma
					var val = $(this).val().slice(0, -1); // remove space/comma from value

					 // append to list of emails with remove button
					 $list.append($('<li class="multipleInput-email"><span> ' + val + '</span><inpupt type="text" name="email_list[]" class="email_list" value="'+ val +'"></li>')
						  .append($('<a href="#" class="multipleInput-close" title="Remove">x</a>')
							   .click(function(e) {
									$(this).parent().remove();
									e.preventDefault();
							   })
						  )
					 );
					 $(this).attr('placeholder', '');
					 // empty input
					 $(this).val('');
				}

		   });

		   // container div
		   var $container = $('<div class="multipleInput-container" />').click(function() {
				$input.focus();
		   });

		   // insert elements into DOM
		   $container.append($list).append($input).insertAfter($(this));

		   // add onsubmit handler to parent form to copy emails into original input as csv before submitting
		   var $orig = $(this);
		   $(this).closest('form').submit(function(e) {

				var emails = new Array();
				$('.multipleInput-email span').each(function() {
					 emails.push($(this).html());
				});
				emails.push($input.val());

				$orig.val(emails.join());

		   });

		   return $(this).hide();

	  });

 };
})( jQuery );

$('#my_input').multipleInput();
</script>

<script>
// $(document).on('click','.testAlert',function(){
// 	var test = $('.email_list').val();
// 	// alert('test'  +  test);
// 	var email_list = $('input[name="email_list[]"]').map(function(){ 
//                     return this.value; 
//                 }).get();

// 	// var users = $(this).find('.email_list').map(function(i, el) {
// 	// 	return el.value;
// 	// });
// 	var users = $("input[name='email_list[]']").map(function(){return $(this).val();}).get();
		
// 		console.log(test);

//                 // $.ajax({
//                 //     type: 'POST',
//                 //     url: 'users.php',
//                 //     data: {
//                 //         'email_list[]': email_list,
//                 //         // other data
//                 //     },
//                 //     success: function() {

//                 //     }
//                 // });

// });
</script>

<script>
// $("#packageID").click(function () {
$(document).ready(function()
{
	
	$(".phoneFormat").text(function(i, text) {
        text = text.replace(/(\d{3})(\d{3})(\d{4})/, "$1.$2.$3");
        return text;
    });
	
	$(".phoneFormat2").text(function(i, text) {
        text = text.replace(/(\d{3})(\d{3})(\d{4})/, "$1.$2.$3");
        return text;
    });

    // $( "#packageID" ).each(function(i) {
    //     $(this).on("click", function(){
    //     var packId = $(this).attr('pack-id');
    //     alert(packId);
        $.ajax({
            type : 'POST',
            url : "<?php echo base_url(); ?>workorder/getPackageItemsById",
            // data : {packId: packId },
            dataType: 'json',
            success: function(response){
                var inputs = "";
						markup = "<tr>" +
                                "<td></td>"+
								"<td></td>"+
                                "<td>Item Name</td>"+
                                "<td>Quantity</td>"+
                                "<td>Price</td>"+
                            "</tr>";
                        tableBody = $("#packageItemsTitle");
                        tableBody.append(markup);

                $.each(response['pItems'], function (i, v) {
                    // inputs += v.package_name ;
                    markup2 = "<tr>" +
                                "<td></td>"+
								"<td></td>"+
                                "<td>"+ v.title +"</td>"+
                                "<td>"+ v.quantity +"</td>"+
                                "<td>"+ v.price +"</td>"+
                            "</tr>";
                        tableBody2 = $("#packageItems"+v.package_id);
                        tableBody2.append(markup2);
                });
            },
        // });
        // });
    });

	
	// var changed = $("#view_ssn").text();
});
</script>

<script>
var ssn = $("#view_ssn").html();
// var ssn = "123-45-6789";
//     vis = mainStr.slice(-4),
//     countNum = '';

// for(var i = (mainStr.length)-4; i>0; i--){
//     countNum += 'X';
// }
var output = ssn.replace(/\d(?=.{5,})/g, "X");
$("#view_ssn").text(output);
</script>

<script>
// $("#packageID").click(function () {
$(document).ready(function()
{
    // $( "#packageID" ).each(function(i) {
    //     $(this).on("click", function(){
    //     var packId = $(this).attr('pack-id');
    //     alert(packId);
        $.ajax({
            type : 'POST',
            url : "<?php echo base_url(); ?>workorder/getPackageById",
            // data : {packId: packId },
            dataType: 'json',
            success: function(response){
                var inputs = "";
                $.each(response['pName'], function (i, v) {
                    // inputs += v.package_name ;
                    markup2 = "<b>"+ v.pname +
                            "</b>";
                        tableBody2 = $("#PaName_"+v.id);
                        tableBody2.append(markup2);
                });
            },
        // });
        // });
    });
});
</script>

<script>


// $(document).ready(function()
// {
// 	var changed = $("#view_ssn").text();
// 	// alert(ssn);
// 	changed.value = new Array(account.value.length-3).join('x') + account.value.substr(account.value.length-4, 4);
// });

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