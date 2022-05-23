<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
<?php include viewPath('includes/sidebars/workorder'); ?>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<style>
    label>input {
      visibility: initial !important;
      position: initial !important; 
    }
   .but:hover {
    font-weight: 900;
    color:black;
    }
    .but-red:hover {
    font-weight: 900;
    color:red;
    }
    .required:after {
    content:" *";
    color: red;
    }
    .navbar-side.closed{
        padding-top:100px !important;
    }
    .pointer {cursor: pointer;}

    .highlight{
    background-color:#CAA1FC;
    color:red;
    padding:12px;
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

        .mobile_qty
    {
        background: transparent !important;
        border: none !important;
        outline: none !important;
        padding: 0px 0px 0px 0px !important;
        text-align: center;
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

    .tabs { list-style: none; }
.tabs li { display: inline; }
.tabs li a 
{ 
    color: black; 
    float: left; 
    display: block; 
    /* padding: 4px 10px;  */
    /* margin-left: -1px;  */
    position: relative; 
    /* left: 1px;  */
    background: #a2a5a3; 
    text-decoration: none; 
}
.tabs li a:hover 
{ 
    background: #ccc; 
}
.group:after 
{ 
    visibility: hidden; 
    display: block; 
    font-size: 0; 
    content: " "; 
    clear: both; 
    height: 0; 
}

.box-wrap 
{ 
    position: relative; 
    min-height: 250px; 
}
.tabbed-area div div 
{ 
    background: white; 
    padding: 20px; 
    min-height: 250px; 
    position: absolute; 
    top: -1px; 
    left: 0; 
    width: 100%; 
}

.tabbed-area div div, .tabs li a 
{ 
    border: 1px solid #ccc; 
}

#box-one:target, #box-two:target, #box-three:target {
  z-index: 1;
}

.group li.active a,
.group li a:hover,
.group li.active a:focus,
.group li.active a:hover{
  background-color: #52cc6e;
  color: black; 
}
}

.blockHead:after {
  color: #00bcd4;
  border-left: 20px solid;
  border-top: 20px solid transparent;
  border-bottom: 20px solid transparent;
  display: inline-block;
  content: '';
  position: absolute;
  right: -20px;
  top: 0;
}
.blockHead {
  background-color: #00bcd4;
  /*width: 150px; */
  height: 40px;
  line-height: 40px;
  display: inline-block;
  position: relative;
}
.blocktext {
  color: white;
  font-weight: bold;
  padding-left: 10px;
  font-family: Arial;
  font-size: 11;
}

.right-arrow {
	display: inline-block;
	position: relative;
	background: #00bcd4;
	padding: 15px;
    color: white;
}
.right-arrow:after {
	content: '';
	display: block;  
	position: absolute;
	left: 100%;
	top: 50%;
	margin-top: -10px;
	width: 0;
	height: 0;
	border-top: 10px solid transparent;
	border-right: 10px solid transparent;
	border-bottom: 10px solid transparent;
	border-left: 10px solid #00bcd4;
}

.down-arrow {
	display: inline-block;
	position: relative;
	background: darkcyan;
	padding: 7px 0;
	width: 150px;
	text-align: center;
}
.down-arrow:after {
	content: '';
	display: block;  
	position: absolute;
	left: 0;
	top: 100%;
	width: 0;
	height: 0;
	border-top: 10px solid darkcyan;
	border-right: 75px solid transparent;
	border-bottom: 0 solid transparent;
	border-left: 75px solid transparent;
}

.down-arrow2 {
	display: inline-block;
	position: relative;
	background: #81167B;
	padding: 7px 0;
	width: 150px;
	text-align: center;
}
.down-arrow2:after {
	content: '';
	display: block;  
	position: absolute;
	left: 0;
	top: 100%;
	width: 0;
	height: 0;
	border-top: 10px solid #81167B;
	border-right: 75px solid transparent;
	border-bottom: 0 solid transparent;
	border-left: 75px solid transparent;
}

.down-arrow3 {
	display: inline-block;
	position: relative;
	background: #F6B343;
	padding: 7px 0;
	width: 150px;
	text-align: center;
}
.down-arrow3:after {
	content: '';
	display: block;  
	position: absolute;
	left: 0;
	top: 100%;
	width: 0;
	height: 0;
	border-top: 10px solid #F6B343;
	border-right: 75px solid transparent;
	border-bottom: 0 solid transparent;
	border-left: 75px solid transparent;
}

.num{
	position:relative;
}

.number{
	position: absolute;
}

.value{
	position: absolute;
	top:0;
	color: transparent !important;
	background: transparent;
	border:none;
}

#header_area {
  width: 90%;
  position: relative;
}
#header_area:hover > .btn-edit-header {
  display: block;
}
.btn-edit-header {
  display: none;
  position: absolute;
  top: 5px;
  right: 5px;
}
.item-container{
    background-color: #02a499;
    padding: 5px;
    color: #ffffff;
    margin-right: 5px;
    margin-top: 4px;
}
.selected-checklists{
    width: 18%;
}
.selected-checklists li{
    padding: 10px;
}
.selected-checklists li a{
    float: right;
}
</style>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
          <div class="row" style="margin-top: 30px;">
            <div class="col">
                <h3 class="m-0">Add New Work Order Solar</h3>
            </div>
        </div>

        <div style="background-color:#fdeac3; width:100%;padding:.5%;margin-bottom:5px;margin-top:5px;margin-bottom:10px;">
          Create your workorder.
        </div>
          <div class="card">
            <!-- end row -->
            <!-- <div class="row">
                <div class="col-md-12" style="background-color:#32243d;padding:1px;text-align:center;color:white;">
                    <h5>General Information</h5>
                </div>
            </div>
            <br> -->
            <?php echo form_open_multipart('workorder/savenewWorkorder', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?> 
                    <div class="row">
                        <div class="col-md-12">
                            <div id="header_area">
                                <h4 class="mt-0 header-title mb-5">Header</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <ol class="breadcrumb" style="margin-top:-30px;"></i>
                                            <li class="breadcrumb-item active">
                                                <label style="background-color:#E8E8E9;" id="headerContent"><?php echo $headers->content; ?></label>
                                                <input type="hidden" id="headerID" name="header" value="<?php echo $headers->content; ?>">
                                            </li>
                                        </ol>                                        
                                    </div> 
                                </div>
                                <br>
                                <!-- <a class="btn btn-sm btn-primary btn-edit-header" href="javascript:void(0);">Edit</a> -->
                                <input type="hidden" id="company_name" value="<?php echo $clients->business_name; ?>">
                                <input type="hidden" id="current_date" value="<?php 
                                $dt = new DateTime();
                                $timestamp = time();
                                $dt->setTimezone(new DateTimeZone($getSettings->value));
                                $dt->setTimestamp($timestamp);
                                
                                echo $dt->format('m-d-Y'); ?>">

                                <input type="hidden" id="content_input" class="form-control" name="header2" value="<?php echo $headers->content; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">                   
                        <div class="col-md-3 form-group">
                            <label for="contact_name" class="label-element">Work Order #</label>
                                <input type="text" class="form-control input-element" name="workorder_number" id="workorder_number" value="<?php echo "WO-"; 
                                           foreach ($number as $num):
                                                $next = $num->work_order_number;
                                                $arr = explode("-", $next);
                                                $date_start = $arr[0];
                                                $nextNum = $arr[1];
                                            //    echo $number;
                                           endforeach;
                                           $val = $nextNum + 1;
                                           echo str_pad($val,7,"0",STR_PAD_LEFT);
                                           ?>" required />
                                <!-- <input type="text" class="form-control input-element" name="workorder_number" id="workorder-number" value="<?= $prefix . $val; ?>" required readonly/> -->
                        </div>
                        <div class="form-group col-md-4">
                            <div class="select-wrap">
                                <label for="lead_source">Lead Source</label>
                                    <select id="lead_source" name="lead_source" class="form-control custom-select m_select">
                                        <option value="0">- none -</option>
                                        <?php foreach($lead_source as $lead){ ?>
                                            <option value="<?php echo $lead->ls_id; ?>"><?php echo $lead->ls_name; ?></option>
                                        <?php } ?>
                                    </select>
                            </div>    
                        </div>   

                    </div>

                    <div class="row">                   
                        <div class="col-md-3 form-group">
                            <label for="firstname" class="label-element">First Name</label>
                            <input type="text" name="firstname" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="lastname" class="label-element">Last Name</label>
                            <input type="text" name="lastname" class="form-control">   
                        </div>   
                        <div class="form-group col-md-3">
                            <label for="lastname" class="label-element">Address</label>
                            <input type="text" name="lastname" class="form-control">   
                        </div>   
                        <div class="form-group col-md-3">
                            <label for="lastname" class="label-element">Contact no.</label>
                            <input type="text" name="lastname" class="form-control">   
                        </div> 
                    </div>

                    <div class="row">                   
                        <div class="col-md-3 form-group">
                            <div class="select-wrap">
                                <label for="lead_source">Type of roof</label>
                                    <select id="lead_source" name="lead_source" class="form-control custom-select m_select">
                                        <option value="0">Test</option>
                                    </select>
                            </div>   
                        </div>
                        <div class="form-group col-md-3">
                            <label for="lastname" class="label-element">Square footage of home</label>
                            <input type="text" name="lastname" class="form-control">   
                        </div>   
                        <div class="form-group col-md-3">
                            <div class="select-wrap">
                                <label for="lead_source">Age of roof (years)</label>
                                    <select id="lead_source" name="lead_source" class="form-control custom-select m_select">
                                        <option value="0"></option>
                                    </select>
                            </div>  
                        </div>   
                    </div>
                    <br>
                    <div class="row">                   
                        <div class="form-group col-md-3">
                            <label for="lastname" class="label-element">Home Owner Associations</label><br>
                            <input type="radio" name="hoa" class="form-"> Yes
                            <input type="radio" name="hoa" class="form-"> No
                        </div> 
                        <div class="form-group col-md-3">
                            <label for="lastname" class="label-element">Electric Bill is over $100</label><br>
                            <input type="radio" name="hoa" class="form-"> Yes
                            <input type="radio" name="hoa" class="form-"> No
                        </div> 
                    </div>
                    <br>
                    <div class="row">                   
                        <div class="col-md-3 form-group">
                            <label for="firstname" class="label-element">Electric Bill Account no.</label>
                            <input type="text" name="firstname" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="lastname" class="label-element">How to you get your invoice?</label>
                            <input type="text" name="lastname" class="form-control">   
                        </div>   
                        <div class="form-group col-md-3">
                            <label for="lastname" class="label-element">Instuctions</label>
                            <input type="text" name="lastname" class="form-control">   
                        </div>   
                        <!-- <div class="form-group col-md-3">
                            <label for="lastname" class="label-element">Contact no.</label>
                            <input type="text" name="lastname" class="form-control">   
                        </div>  -->
                    </div>

                    <div class="row">                   
                        <div class="form-group col-md-4">
                            <div class="select-wrap">
                                <label for="job_type">Payment Method</label>
                                    <select name="payment_method" id="payment_method" class="form-control custom-select m_select">
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
                                    </select>
                                </div> 
                            </div>     
                            <div class="form-group col-md-4">
                                <label for="job_type" class="label-element">Amount<small class="help help-sm"> ( $ )</small></label>
                                <input type="text" class="form-control input-element" name="payment_amount" id="payment_amount"  />
                            </div>
                    </div>


                    <br><br><br>
                             <!-- ====== SIGNATURE ====== -->
                             <div class="row">
                                <div class=" col-md-12">
                                    <div class="work_nore">
                                        <h6>Signature</h6>
                                        <p> By Signing below you verify that the above information is true and complete,
                                            and you authorize payment and confirmation with nSmarTrac. </p>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <div class="row signature_web">
                                <div class="col-md-4">
                                    <h6>Company Representative Approval</h6> <a data-toggle="modal" data-target=".companySignature" class="btn btn-success"><span class="fa fa-plus-square fa-margin-right"></span> Add Signature</a>
                                    <!-- <div class="sigPad" id="smoothed1a" style="width:100%;border:solid gray 1px;background-color:#00b300;">
                                        <ul class="sigNav" style="">
                                            <li class="drawIt"><a href="#draw-it">Draw It</a></li>
                                            <li class="clearButton"><a href="#clear">Clear</a></li>
                                        </ul>
                                        <ul class="edit">
                                            <li class="smoothed1a_pencil pointer"><a onclick="myFunction()" style="float:right;margin-right:10px;" class="smoothed1a_pencil"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                        </ul>
                                        <div class="sig sigWrapper" id="smoothed1a_pencil" style="height:auto;pointer-events: none;">
                                            <div class="typed"></div>
                                            <div id="signature-pad">
                                            <canvas style="border:1px solid #000" id="sign"></canvas>
                                            </div>
                                            <input type="hidden" name="output-2" class="output">
                                        </div>
                                    </div> -->
                                    <div id="companyrep"></div>

                                    <input type="hidden" id="saveCompanySignatureDB1a"
                                           name="company_representative_approval_signature1a">
                                    <br>

                                    <label for="comp_rep_approval">Printed Name</label>
                                    <!-- <input type="text6" class="form-control mb-3"
                                           name="company_representative_printed_name"
                                           id="company_representative_printed_name" placeholder=""/> -->
                                        <select class="form-control mb-3" name="company_representative_printed_name">
                                            <option value="0">Select Name</option>
                                            <?php foreach($users_lists as $ulist){ ?>
                                                <option <?php if($ulist->id == logged('id')){ echo "selected";} ?> value="<?php echo $ulist->id ?>"><?php echo $ulist->FName .' '.$ulist->LName; ?></option>
                                            <?php } ?>
                                        </select>
                                           <!-- <canvas id="canvas_web" style="border: 1px solid #ddd;"></canvas>
                                            <input type="text" class="form-control mb-3" name="company_representative_printed_name" id="comp_rep_approval1" placeholder="Printed Name"/> -->
                                            <input type="hidden" id="saveCompanySignatureDB1aM_web" name="company_representative_approval_signature1aM_web">

                                </div>
                                <div class="col-md-4">
                                    <h6>Primary Account Holder</h6><a data-toggle="modal" data-target=".primarySignature" class="btn btn-warning"><span class="fa fa-plus-square fa-margin-right"></span> Add Signature</a>
                                    <!-- <div class="sigPad" id="smoothed2a" style="width:100%;border:solid gray 1px;background-color:#f7b900;">
                                        <ul class="sigNav">
                                            <li class="drawIt"><a href="#draw-it">Draw It</a></li>
                                            <li class="clearButton"><a href="#clear">Clear</a></li>
                                        </ul>
                                        <ul class="edit">
                                            <li class="smoothed1a_pencil pointer"><a onclick="myFunctiontwo()" style="float:right;margin-right:10px;" class="smoothed1a_pencil"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                        </ul>
                                        <div class="sig sigWrapper" style="height:auto;pointer-events: none;">
                                            <div class="typed"></div>
                                            <div id="signature-pad2">
                                            <canvas style="border:1px solid #000" id="sign2"></canvas>
                                            </div>
                                            <input type="hidden" name="output-2" class="output">
                                        </div>
                                    </div> -->
                                    <div id="primaryrep"></div>
                                    <input type="hidden" id="savePrimaryAccountSignatureDB2a"
                                           name="primary_account_holder_signature2a">
                                    <br>

                                    <label for="comp_rep_approval">Printed Name</label>
                                    <input type="text6" class="form-control mb-3" name="primary_account_holder_name"
                                           id="primary_account_holder_name" placeholder=""/>
                                    <!-- <select class="form-control mb-3" name="primary_account_holder_name">
                                            <option value="0">Select Name</option>
                                            <?php //foreach($users_lists as $ulist){ ?>
                                                <option value="<?php //echo $ulist->id ?>"><?php //echo $ulist->FName .' '.$ulist->LName; ?></option>
                                            <?php //} ?>
                                    </select> -->
                                    
                                           <input type="hidden" id="saveCompanySignatureDB1aM_web2" name="primary_representative_approval_signature1aM_web">

                                </div>
                                <div class="col-md-4">
                                    <h6>Secondary Account Holder</h6><a data-toggle="modal" data-target=".secondarySignature" class="btn btn-danger"><span class="fa fa-plus-square fa-margin-right"></span> Add Signature</a>
                                    <!-- <div class="sigPad" id="smoothed3a" style="width:100%;border:solid gray 1px;background-color:#f75c1e;">
                                        <ul class="sigNav">
                                            <li class="drawIt"><a href="#draw-it">Draw It</a></li>
                                            <li class="clearButton"><a href="#clear">Clear</a></li>
                                        </ul>
                                        <ul class="edit">
                                            <li class="smoothed1a_pencil pointer"><a onclick="myFunctionthree()" style="float:right;margin-right:10px;" class="smoothed1a_pencil"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                        </ul>
                                        <div class="sig sigWrapper" style="height:auto;pointer-events: none;">
                                            <div class="typed"></div>
                                            <div id="signature-pad3">
                                            <canvas style="border:1px solid #000" id="sign3"></canvas>
                                            </div>
                                            <input type="hidden" name="output-2" class="output">
                                        </div>
                                    </div> -->
                                    <div id="secondaryrep"></div>
                                    <input type="hidden" id="saveSecondaryAccountSignatureDB3a"
                                           name="secondary_account_holder_signature3a">
                                    <br>

                                    <label for="comp_rep_approval">Printed Name</label>
                                    <input type="text6" class="form-control mb-3" name="secondery_account_holder_name"
                                           id="secondery_account_holder_name" placeholder=""/>
                                        <!-- <select class="form-control mb-3" name="secondery_account_holder_name">
                                            <option value="0">Select Name</option>
                                            <?php //foreach($users_lists as $ulist){ ?>
                                                <option value="<?php //echo $ulist->id ?>"><?php //echo $ulist->FName .' '.$ulist->LName; ?></option>
                                            <?php //} ?>
                                        </select> -->

                                           <input type="hidden" id="saveCompanySignatureDB1aM_web3" name="secondary_representative_approval_signature1aM_web">

                                </div>
                            </div>

                            <br><br><br><br><br>
                            <div>
                                <div class="form-group">
                                        <button type="submit" name="action" class="btn btn-flat btn-primary" value="submit">Submit</button>
                                        <!-- <button type="submit" name="action" class="btn btn-flat btn-success pdf_sheet" target="_blank" value="preview">Preview</button> -->
                                        <button type="submit" class="btn btn-flat btn-primary"><b>Save Template</b></button>
                                        <a href="<?php echo url('workorder') ?>" class="btn btn-primary">Cancel this</a>
                                </div>
                            </div>



        <?php echo form_close(); ?>
    </div>
    <!-- end container-fluid -->
</div>

<!-- first signature -->

<div class="modal fade companySignature" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                            <div align="center">
                                <p style="padding:2%;background-color:#d2d2d2;width:380px;"> <b>Company Representative Approval </b></p>
                                <div align="center"><i><p style="padding:2%;background-color:#d2d2d2;width:80%;"> By Signing below you verify that the above information is true and complete,
                                            and you authorize payment and confirmation with nSmarTrac. </p></i></div>
                            </div>
                                    <div class="box-wrap">
                                        
                                        <div id="box-one">
                                        <div class="row">
                                        <div class="col-md-12" style="padding:1%;">
                                        <center>
                                        <div id="signArea" >
                                            <canvas id="canvasb" style="border: solid gray 1px;"></canvas>
                                            <input type="hidden" class="form-control mb-3" name="company_representative_printed_name" id="comp_rep_approval1" value="Company Representative"/>
                                            <input type="hidden" id="saveCompanySignatureDB1aMb" name="company_representative_approval_signature1aM">
                                            </div>
                                            </div>
                                            <br>
                                        </div>
                                        </center>
                                        </div>
                                    
                                    </div>
                        
                        <div class="modal-footer">
                        
                            <button id="clear" class="btn btn-danger">Clear</button>
                            <button type="button" class="btn btn-success edit_first_signature" id="enter_signature">Update</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <!-- <input type="submit" value="save" id="btnSaveSign"> -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- second signature -->

            <div class="modal fade primarySignature" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                            <div align="center">
                                <p style="padding:2%;background-color:#d2d2d2;width:380px;"> <b>Primary Account Holder</b> </p>
                                <div align="center"><i><p style="padding:2%;background-color:#d2d2d2;width:80%;"> By Signing below you verify that the above information is true and complete,
                                            and you authorize payment and confirmation with nSmarTrac. </p></i></div>
                            </div>
                                    <div class="box-wrap">
                                        
                                        <div id="box-one">
                                        <div class="row">
                                        <div class="col-md-12" style="padding:1%;">
                                        <center>
                                        <div id="signArea2" >
                                            <canvas id="canvas2b" style="border: solid gray 1px;"></canvas>
                                            <input type="hidden" class="form-control mb-3" name="primary_representative_printed_name" id="comp_rep_approval2" value="Primary Account Holder"/>
                                            <input type="hidden" id="savePrimaryAccountSignatureDB2aMb" name="primary_account_holder_signature2aM">
                                            </div>
                                            </div>
                                            <br>
                                            </div>
                                        </center>
                                        </div>
                                    
                                    </div>
                        
                        <div class="modal-footer">
                            <button id="clear2" class="btn btn-danger">Clear</button>
                            <button type="button" class="btn btn-success edit_second_signature" id="enter_signature">Update</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <!-- <input type="submit" value="save" id="btnSaveSign"> -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- third signature -->

            <div class="modal fade secondarySignature" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                            <div align="center">
                                <p style="padding:2%;background-color:#d2d2d2;width:380px;"> <b>Secondary Account Holder</b> </p>
                                <div align="center"><i><p style="padding:2%;background-color:#d2d2d2;width:80%;"> By Signing below you verify that the above information is true and complete,
                                            and you authorize payment and confirmation with nSmarTrac. </p></i></div>
                            </div>
                                    <div class="box-wrap">
                                        
                                        <div id="box-one">
                                        <div class="row">
                                        <div class="col-md-12" style="padding:1%;">
                                        <center>
                                        <div id="signArea3" >
                                            <canvas id="canvas3b" style="border: solid gray 1px;"></canvas>
                                            <input type="hidden" class="form-control mb-3" name="secondary_representative_printed_name" id="comp_rep_approval3" value="Secondary Account Holder"/>
                                            <input type="hidden" id="saveSecondaryAccountSignatureDB3aMb" name="secondary_account_holder_signature3aM">
                                            </div>
                                            </div>
                                            <br>
                                        </div>
                                        </center>
                                        </div>
                                    
                                    </div>
                        
                        <div class="modal-footer">
                            <button id="clear3" class="btn btn-danger">Clear</button>
                            <button type="button" class="btn btn-success edit_third_signature" id="enter_signature">Update</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <!-- <input type="submit" value="save" id="btnSaveSign"> -->
                        </div>
                    </div>
                </div>
            </div>



<?php include viewPath('includes/footer'); ?>
<script src="<?php echo $url->assets;?>js/jquery-input-mask-phone-number.js"></script>

<script>
$('#security_number').keyup(function() {
        var val = this.value.replace(/\D/g, '');
        val = val.replace(/^(\d{3})/, '$1-');
        val = val.replace(/-(\d{2})/, '-$1-');
        val = val.replace(/(\d)-(\d{4}).*/, '$1-$2');
        this.value = val;
    });


// $('#phone_no').keyup(function () {
//     var foo = $(this).val().split("-").join(""); // remove hyphens
//     if (foo.length > 0) {
//         foo = foo.match(new RegExp('.{1,3}', 'g')).join("-");
//     }
//     $(this).val(foo);
// });

$('#phone_no').keyup(function() {
        var val = this.value.replace(/\D/g, '');
        val = val.replace(/^(\d{3})/, '$1-');
        val = val.replace(/-(\d{3})/, '-$1-');
        val = val.replace(/(\d)-(\d{4}).*/, '$1-$2');
        this.value = val;
    });

// $('#mobile_no').keyup(function () {
//     var foo = $(this).val().split("-").join(""); // remove hyphens
//     if (foo.length > 0) {
//         foo = foo.match(new RegExp('.{1,3}', 'g')).join("-");
//     }
//     $(this).val(foo);
// });

$('#mobile_no').keyup(function() {
        var val = this.value.replace(/\D/g, '');
        val = val.replace(/^(\d{3})/, '$1-');
        val = val.replace(/-(\d{3})/, '-$1-');
        val = val.replace(/(\d)-(\d{4}).*/, '$1-$2');
        this.value = val;
    });

</script>

<script>
// $('.enter_signature').click(function(){
//     // alert("nisulod");
//         if(signaturePad.isEmpty()){
//             console.log('it is empty');
//             return false;            
//         }
//     });

var signaturePad;
jQuery(document).ready(function () {
  var signaturePadCanvas = document.querySelector('#canvasb');
//   var parentWidth = jQuery(signaturePadCanvas).parent().outerWidth();
//   signaturePadCanvas.setAttribute("width", parentWidth);
  signaturePad = new SignaturePad(signaturePadCanvas);

  signaturePadCanvas.width  = 780;
  signaturePadCanvas.height = 300;
});

var signaturePad2;
jQuery(document).ready(function () {
  var signaturePadCanvas2 = document.querySelector('#canvas2b');
//   var parentWidth = jQuery(signaturePadCanvas).parent().outerWidth();
//   signaturePadCanvas.setAttribute("width", parentWidth);
  signaturePad2 = new SignaturePad(signaturePadCanvas2);

  signaturePadCanvas2.width  = 780;
  signaturePadCanvas2.height = 300;
});

var signaturePad3;
jQuery(document).ready(function () {
  var signaturePadCanvas3 = document.querySelector('#canvas3b');
//   var parentWidth = jQuery(signaturePadCanvas).parent().outerWidth();
//   signaturePadCanvas.setAttribute("width", parentWidth);
  signaturePad3 = new SignaturePad(signaturePadCanvas3);

  signaturePadCanvas3.width  = 780;
  signaturePadCanvas3.height = 300;
});


// $(document).on('click touchstart','#sign',function(){
//     // alert('test');
//     var canvas_web = document.getElementById("sign");    
//     var dataURL = canvas_web.toDataURL("image/png");
//     $("#saveCompanySignatureDB1aM_web").val(dataURL);
// });

// $(document).on('click touchstart','#sign2',function(){
//     // alert('test');
//     var canvas_web2 = document.getElementById("sign2");    
//     var dataURL = canvas_web2.toDataURL("image/png");
//     $("#saveCompanySignatureDB1aM_web2").val(dataURL);
// });

// $(document).on('click touchstart','#sign3',function(){
//     // alert('test');
//     var canvas_web3 = document.getElementById("sign3");    
//     var dataURL = canvas_web3.toDataURL("image/png");
//     $("#saveCompanySignatureDB1aM_web3").val(dataURL);
// });

$(document).on('click touchstart','#canvasb',function(){
    // alert('test');
    var canvas_web = document.getElementById("canvasb");    
    // alert(canvas_web);
    var dataURL = canvas_web.toDataURL("image/png");
    $("#saveCompanySignatureDB1aMb").val(dataURL);
});

$(document).on('click touchstart','#canvas2b',function(){
    // alert('test');
    var canvas_web2 = document.getElementById("canvas2b");    
    var dataURL = canvas_web2.toDataURL("image/png");
    $("#savePrimaryAccountSignatureDB2aMb").val(dataURL);
});

$(document).on('click touchstart','#canvas3b',function(){
    // alert('test');
    var canvas_web3 = document.getElementById("canvas3b");    
    var dataURL = canvas_web3.toDataURL("image/png");
    $("#saveSecondaryAccountSignatureDB3aMb").val(dataURL);
});


$(document).on('click touchstart','.edit_first_signature',function(){
    // alert('test');
    var first = $("#saveCompanySignatureDB1aMb").val();
    // alert(first);
    $("#saveCompanySignatureDB1aM_web").val(first);

    // $(".img1").hide();

    var input_conf = '<img src="'+first+'">'

    $('#companyrep').html(input_conf);
    
    $('.companySignature').modal('hide');
    
});

$(document).on('click touchstart','.edit_second_signature',function(){
    // alert('test');
    var first = $("#savePrimaryAccountSignatureDB2aMb").val();
    // alert(first);
    $("#saveCompanySignatureDB1aM_web2").val(first);

    // $(".img2").hide();

    var input_conf = '<img src="'+first+'">'

    $('#primaryrep').html(input_conf);

    $('.primarySignature').modal('hide');
    
});

$(document).on('click touchstart','.edit_third_signature',function(){
    // alert('test');
    var first = $("#saveSecondaryAccountSignatureDB3aMb").val();
    // alert(first);
    $("#saveCompanySignatureDB1aM_web3").val(first);

    // $(".img3").hide();

    var input_conf = '<img src="'+first+'">'

    $('#secondaryrep').html(input_conf);

    $('.secondarySignature').modal('hide');
    
});

$(document).on('click','.btn-edit-header',function(){
    //    alert('yeah');
    $('#update_header_modal').modal('show');
});
</script>

<script>
  $( function() {
    $( "#datepicker2" ).datepicker();
  } );
</script>

<script>
// $('.addCreatePackage').on('click', function(){
$(".addCreatePackage").click(function () {
// var item = $("#itemidPackage").val();
var item = $('input[name="itemidPackage[]"]').map(function () {
    return this.value; // $(this).val()
}).get();

var type = $('input[name="item_typePackage[]"]').map(function () {
    return this.value; // $(this).val()
}).get();

var quantity = $('input[name="quantityPackage[]"]').map(function () {
    return this.value; // $(this).val()
}).get();

var price = $('input[name="pricePackage[]"]').map(function () {
    return this.value; // $(this).val()
}).get();

var package_name =  $("#package_name").val();
var package_price =  $("#package_price").val();
var package_price_set =  $("#package_price_set").val();

// console.log('items '+item);
// console.log('type '+type);
// console.log('quantity '+quantity);
// console.log('price '+price);
    $.ajax({
        type : 'POST',
        url : "<?php echo base_url(); ?>workorder/createPackage",
        data : {item: item, type:type, quantity:quantity, price:price, package_price:package_price, package_name:package_name, package_price_set:package_price_set },
        dataType: 'json',
        success: function(response){

        // console.log(result);
        var Randnumber = 1 + Math.floor(Math.random() * 99999);

        console.log(response['pName']);

                    // var inputs1 = "";
                        $.each(response['pName'], function (a, b) {
                            // inputs1 += b.name;
                            var pName = b.name;
                            // var Rnumber = 3 + Math.floor(Math.random() * 9);
                            var Rnumber = Math.floor(Math.random()*(9999-10000+1)+100);

                        

                markup = "<tr id=\"ss\">" +
                        // "<td width=\"35%\"><input value='"+title+"' type=\"text\" name=\"items[]\" class=\"form-control getItems\" ><input type=\"hidden\" value='"+idd+"' name=\"item_id[]\"><div class=\"show_mobile_view\"><span class=\"getItems_hidden\">"+title+"</span></div><input type=\"hidden\" name=\"itemidPackage[]\" id=\"itemidPackage\" class=\"itemid\" value='"+idd+"'></td>\n" +
                        // "<td width=\"25%\"><div class=\"dropdown-wrapper\"><select name=\"item_typePackage[]\" class=\"form-control\"><option value=\"product\">Product</option><option value=\"material\">Material</option><option value=\"service\">Service</option><option value=\"fee\">Fee</option></select></div></td>\n" +
                        // "<td width=\"\"><input data-itemid='"+idd+"' id='quantity_package_"+idd+"' value='"+qty+"' type=\"number\" name=\"quantityPackage[]\" data-counter=\"0\"  min=\"0\" class=\"form-control quantityPackage2\"></td>\n" +
                        // "<td width=\"\"><input data-itemid='"+idd+"' id='price_package_"+idd+"' value='"+price+"'  type=\"number\" name=\"pricePackage[]\" class=\"form-control price_package2 hidden_mobile_view\" placeholder=\"Unit Price\"><input type=\"hidden\" class=\"priceqty\" id='priceqty_package_"+idd+"' value='"+total_+"'><div class=\"show_mobile_view\"><span class=\"price\">"+price+"</span></div></td>\n" +
                        // "<td>\n" +
                        // "<a href=\"#\" class=\"remove btn btn-sm btn-success\" id='"+idd+"'><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>\n" +
                        // "</td>\n" +
                        "<td colspan=\"6\" ><h6>"+ pName +"</h6><div><table class=\"table table-hover\" ><thead><th width=\"10%\" ></th><th>Item Name</th><th>Quantity</th><th>Price</th></thead> <tbody id='packageBody"+Randnumber+"'>" +
                        "<input type=\"hidden\" class=\"priceqty\" id='priceqty_"+Rnumber+"' value='"+b.amount_set+"'><input type=\"hidden\" name=\"itemid[]\" value=\"0\"><input type=\"hidden\" name=\"packageID[]\" value='"+b.id+"'><input type=\"hidden\" name=\"quantity[]\" value=\"1\"><input type=\"hidden\" name=\"price[]\" value='"+b.amount_set+"'><input type=\"hidden\" name=\"tax[]\" value=\"0\"><input type=\"hidden\" name=\"discount[]\" value=\"0\">"+

                        "</tbody></table></div></td>\n" +
                        "<td style=\"text-align: center\" class=\"hidden_mobile_view\" width=\"15%\">$ <span data-subtotal='"+b.amount_set+"' id='span_total_"+Rnumber+"' class=\"total_per_item\">"+b.amount_set+
                        "</span> <input type=\"hidden\" name=\"total[]\" id='sub_total_text"+Rnumber+"' value='"+b.amount_set+"'></td>" +
                    "</tr>";
                    tableBody = $("#jobs_items_table_body");
                    tableBody.append(markup);
                });
                    
                    var inputs = "";
                        $.each(response['details'], function (i, v) {
                            inputs += v.package_name ;
                            // "<tr>"+
                            // "<td>"+ v.item_id +"</td>"+
                            // "<td>"+ v.quantity +"</td>"+
                            // "<td>"+ v.price +"</td>"+
                            // "</tr>"+
                        // });

                    markup2 = "<tr width=\"10%\" id=\"sss\">" +
                        // "<tr>"+
                            "<td></td>"+
                            "<td>"+ v.title +"</td>"+
                            "<td>"+ v.quantity +"</td>"+
                            "<td>"+ v.price +"</td>"+
                        "</tr>";
                    tableBody2 = $("#packageBody"+Randnumber);
                    tableBody2.append(markup2);

                });


                var priceqty2 = 0;
                $('*[id^="priceqty_"]').each(function(){
                priceqty2 += parseFloat($(this).val());
                });
                $("#item_total").val(priceqty2.toFixed(2));
                $("#span_sub_total_invoice").text(priceqty2.toFixed(2));

                
                var subtotal = 0;
                // $("#span_total_0").each(function(){
                $('*[id^="span_total_"]').each(function(){
                subtotal += parseFloat($(this).text());
                });
                var s_total = subtotal.toFixed(2);
                var adjustment = $("#adjustment_input").val();
                var grand_total = s_total - parseFloat(adjustment);
                var markup = $("#markup_input_form").val();
                var grand_total_w = grand_total + parseFloat(markup);
                $("#grand_total_inputs").val(grand_total_w.toFixed(2));
                $("#grand_total").text(grand_total_w.toFixed(2));
                $("#grand_total_input").val(grand_total_w.toFixed(2));
                $("#payment_amount").val(grand_total_w.toFixed(2));

        },
    });

    

    $(".createPackage").modal("hide");
    // $('#divcreatePackage').load(window.location.href +  '#divcreatePackage');
    // $(document.body).on('hidden.bs.modal', function () {
    //     $('.createPackage').removeData('bs.modal')
    // });
    $("#divcreatePackage").load(" #divcreatePackage");

});
</script>

<script>
$(".addNewPackageToList").click(function () {
    var packId = $(this).attr('pack-id');

    $.ajax({
        type : 'POST',
        url : "<?php echo base_url(); ?>workorder/addNewPackageToList",
        data : {packId: packId },
        dataType: 'json',
        success: function(response){

        // console.log(result);
        var Randnumber = 1 + Math.floor(Math.random() * 99999);

        console.log(response['pName']);

                    // var inputs1 = "";
                        $.each(response['pName'], function (a, b) {
                            // inputs1 += b.name;
                            var pName = b.name;
                            // var Rnumber = 3 + Math.floor(Math.random() * 9);
                            var Rnumber = Math.floor(Math.random()*(9999-10000+1)+100);

                        

                markup = "<tr id=\"ss\">" +
                        // "<td width=\"35%\"><input value='"+title+"' type=\"text\" name=\"items[]\" class=\"form-control getItems\" ><input type=\"hidden\" value='"+idd+"' name=\"item_id[]\"><div class=\"show_mobile_view\"><span class=\"getItems_hidden\">"+title+"</span></div><input type=\"hidden\" name=\"itemidPackage[]\" id=\"itemidPackage\" class=\"itemid\" value='"+idd+"'></td>\n" +
                        // "<td width=\"25%\"><div class=\"dropdown-wrapper\"><select name=\"item_typePackage[]\" class=\"form-control\"><option value=\"product\">Product</option><option value=\"material\">Material</option><option value=\"service\">Service</option><option value=\"fee\">Fee</option></select></div></td>\n" +
                        // "<td width=\"\"><input data-itemid='"+idd+"' id='quantity_package_"+idd+"' value='"+qty+"' type=\"number\" name=\"quantityPackage[]\" data-counter=\"0\"  min=\"0\" class=\"form-control quantityPackage2\"></td>\n" +
                        // "<td width=\"\"><input data-itemid='"+idd+"' id='price_package_"+idd+"' value='"+price+"'  type=\"number\" name=\"pricePackage[]\" class=\"form-control price_package2 hidden_mobile_view\" placeholder=\"Unit Price\"><input type=\"hidden\" class=\"priceqty\" id='priceqty_package_"+idd+"' value='"+total_+"'><div class=\"show_mobile_view\"><span class=\"price\">"+price+"</span></div></td>\n" +
                        // "<td>\n" +
                        // "<a href=\"#\" class=\"remove btn btn-sm btn-success\" id='"+idd+"'><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>\n" +
                        // "</td>\n" +
                        "<td colspan=\"6\" ><h6>"+ pName +"</h6><div><table class=\"table table-hover\" ><thead><th width=\"10%\" ></th><th>Item Name</th><th>Quantity</th><th>Price</th></thead> <tbody id='packageBody"+Randnumber+"'>" +
                        "<input type=\"hidden\" class=\"priceqty\" id='priceqty_"+Rnumber+"' value='"+b.amount_set+"'><input type=\"hidden\" name=\"itemid[]\" value=\"0\"><input type=\"hidden\" name=\"packageID[]\" value='"+b.id+"'><input type=\"hidden\" name=\"quantity[]\" value=\"1\"><input type=\"hidden\" name=\"price[]\" value='"+b.amount_set+"'><input type=\"hidden\" name=\"tax[]\" value=\"0\"><input type=\"hidden\" name=\"discount[]\" value=\"0\">"+

                        "</tbody></table></div></td>\n" +
                        "<td style=\"text-align: center\" class=\"hidden_mobile_view\" width=\"15%\">$ <span data-subtotal='"+b.amount_set+"' id='span_total_"+Rnumber+"' class=\"total_per_item\">"+b.amount_set+
                        "</span> <input type=\"hidden\" name=\"total[]\" id='sub_total_text"+Rnumber+"' value='"+b.amount_set+"'></td>" +
                    "</tr>";
                    tableBody = $("#jobs_items_table_body");
                    tableBody.append(markup);
                });
                    
                    var inputs = "";
                        $.each(response['details'], function (i, v) {
                            inputs += v.package_name ;
                            // "<tr>"+
                            // "<td>"+ v.item_id +"</td>"+
                            // "<td>"+ v.quantity +"</td>"+
                            // "<td>"+ v.price +"</td>"+
                            // "</tr>"+
                        // });

                    markup2 = "<tr width=\"10%\" id=\"sss\">" +
                        // "<tr>"+
                            "<td></td>"+
                            "<td>"+ v.title +"</td>"+
                            "<td>"+ v.quantity +"</td>"+
                            "<td>"+ v.price +"</td>"+
                        "</tr>";
                    tableBody2 = $("#packageBody"+Randnumber);
                    tableBody2.append(markup2);

                });


                var priceqty2 = 0;
                $('*[id^="priceqty_"]').each(function(){
                priceqty2 += parseFloat($(this).val());
                });
                $("#item_total").val(priceqty2.toFixed(2));
                $("#span_sub_total_invoice").text(priceqty2.toFixed(2));

                
                var subtotal = 0;
                // $("#span_total_0").each(function(){
                $('*[id^="span_total_"]').each(function(){
                subtotal += parseFloat($(this).text());
                });
                var s_total = subtotal.toFixed(2);
                var adjustment = $("#adjustment_input").val();
                var grand_total = s_total - parseFloat(adjustment);
                var markup = $("#markup_input_form").val();
                var grand_total_w = grand_total + parseFloat(markup);
                $("#grand_total_inputs").val(grand_total_w.toFixed(2));
                $("#grand_total").text(grand_total_w.toFixed(2));
                $("#grand_total_input").val(grand_total_w.toFixed(2));
                $("#payment_amount").val(grand_total_w.toFixed(2));

        },
    });

    $(".createPackage").modal("hide");
    // $('#divcreatePackage').load(window.location.href +  '#divcreatePackage');
    // $(document.body).on('hidden.bs.modal', function () {
    //     $('.createPackage').removeData('bs.modal')
    // });
    // $("#divcreatePackage").load(" #divcreatePackage");

});
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
            url : "<?php echo base_url(); ?>workorder/getPackageItemsById",
            // data : {packId: packId },
            dataType: 'json',
            success: function(response){
                var inputs = "";
                $.each(response['pItems'], function (i, v) {
                    // inputs += v.package_name ;
                    markup2 = "<tr>" +
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
});
</script>

<script>
// $("#company_representative_approval_signature1aM").on("click touchstart",
//   function () {
//     alert('yeah');
//     var canvas = document.getElementById(
//       "signM"
//     );    
//     var dataURL = canvas.toDataURL("image/png");
//     $("#saveCompanySignatureDB1aM").val(dataURL);
//     // console.log(dataURL);
//   }
// );

// $(document).on('click','#signature-padM',function(){
//        alert('yeah');
//     // $('#item_group_type').val();
// });
// var canvas = document.getElementById('canvas');
// var dataURL = canvas.toDataURL("image/png");
// test = $("#saveCompanySignatureDB1aM").val(dataURL);
// // var dataURL = canvas.toDataURL();
// console.log(test);
// jQuery(document).ready(function($){
    
//     var canvas = document.getElementById("canvas");
//     var signaturePad = new SignaturePad(canvas);
//     var dataURL = canvas.toDataURL("image/png");
//     test = $("#saveCompanySignatureDB1aM").val(dataURL);

//     onsole.log(test);
    
//     // $('#clear-signature').on('click', function(){
//     //     signaturePad.clear();
//     // });
    
// });

            $(document).ready(function() {
				// $('#canvas').signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:90});
                var canvas = document.getElementById("canvas");    
                var signaturePad = new SignaturePad(canvas);

                var canvas2 = document.getElementById("canvas2");    
                var signaturePad2 = new SignaturePad(canvas2);

                var canvas3 = document.getElementById("canvas3");    
                var signaturePad3 = new SignaturePad(canvas3);

                var canvas_web = document.getElementById("canvas_web");    
                var signaturePad4 = new SignaturePad(canvas_web);

			});

// $("#canvas").on("click touchstart",
//   function () {
//     // alert('yeah');
//     var canvas = document.getElementById(
//       "canvas"
//     );    
//     var signaturePad = new SignaturePad(canvas);
//     var dataURL = canvas.toDataURL("image/png");
//     $("#saveCompanySignatureDB1aM").val(dataURL);
//     // console.log(dataURL);
//   }
// );

$("#btnSaveSign").click(function(e){
    var canvas = document.getElementById("canvas");    
    var dataURL = canvas.toDataURL("image/png");
    $("#saveCompanySignatureDB1aM").val(dataURL);
                        // console.log(dataURL);
						//ajax call to save image inside folder
						// $.ajax({
						// 	url: "<?php echo base_url(); ?>accounting/testSave",
						// 	data: { dataURL : dataURL },
						// 	type: 'post',
						// 	dataType: 'json',
						// 	success: function (response) {
						// 	   alert('success');
						// 	}
						// });

$.ajax({
    type : 'POST',
    url : "<?php echo base_url(); ?>accounting/testSave",
    data : {dataURL: dataURL},
    success: function(result){
    // $('#res').html('Signature Uploaded successfully');
    console.log(dataURL)
    // location.reload();
    
    },
    });
					
			});


</script>

<script>

function submit() {
//   if (signaturePad.isEmpty() || signaturePad2.isEmpty() || signaturePad3.isEmpty()) {
//     // console.log("Empty!");
//     alert('Please check, you must sign all tab.')
//   }
//   else{
    // sigpad= $("#output-2a").val();
    var canvas = document.getElementById("canvas");    
    var dataURL = canvas.toDataURL("image/png");
    $("#saveCompanySignatureDB1aM").val(dataURL);

    var canvas2 = document.getElementById("canvas2");    
    var dataURL2 = canvas2.toDataURL("image/png");
    $("#savePrimaryAccountSignatureDB2aM").val(dataURL2);

    var canvas3 = document.getElementById("canvas3");    
    var dataURL3 = canvas3.toDataURL("image/png");
    $("#saveSecondaryAccountSignatureDB3aM").val(dataURL3);

    var input1 = $("#comp_rep_approval1").val();
    var input2 = $("#comp_rep_approval2").val();
    var input3 = $("#comp_rep_approval3").val();
    
    $.ajax({
    type : 'POST',
    url : "<?php echo base_url(); ?>accounting/testSave",
    data : {dataURL: dataURL, dataURL2: dataURL2, dataURL3: dataURL3},
    success: function(result){
        // $('#res').html('Signature Uploaded successfully');
        alert('Signature Uploaded successfully');
        console.log(dataURL);
        console.log(dataURL2);
        console.log(dataURL3);

        // var image = new Image();
        // image.src = '"' + dataURL + '"';
        // document.body.appendChild(image);

        // var input_conf = '<br><div style="border:solid gray 1px;padding:2%;"><img id="image1" src="'+dataURL+'"></img><input type="hidden" class="form-control" name="signature1" id="signature1" value="'+ dataURL +'"><br><input type="text" class="form-control" name="name1" id="name1" value="'+ input1 +'" readonly></div><br><div style="border:solid gray 1px;padding:2%;"><img id="image1" src="'+dataURL2+'"></img><input type="hidden" class="form-control" name="signature2" id="signature2" value="'+ dataURL2 +'"><br><input type="text" class="form-control" name="name2" id="name2" value="'+ input2 +'" readonly></div><br><div style="border:solid gray 1px;padding:2%;"><img id="image1" src="'+dataURL3+'"></img><input type="hidden" class="form-control" name="signature3" id="signature3" value="'+ dataURL3 +'"><br><input type="text" class="form-control" name="name3" id="name3" value="'+ input3 +'" readonly></div>';

        var input_conf = '<br><div style="border:solid gray 1px;padding:2%;width:400px !important;"><img id="image1" src="'+dataURL+'"></img><input type="hidden" class="form-control" name="signature1" id="signature1" value="'+ dataURL +'"><br><input type="text" class="form-control" name="name1" id="name1" value="'+ input1 +'" readonly></div><br><div style="border:solid gray 1px;padding:2%;"><img id="image1" src="'+dataURL2+'"></img><input type="hidden" class="form-control" name="signature2" id="signature2" value="'+ dataURL2 +'"><br><input type="text" class="form-control" name="name2" id="name2" value="'+ input2 +'" readonly></div><br><div style="border:solid gray 1px;padding:2%;"><img id="image1" src="'+dataURL3+'"></img><input type="hidden" class="form-control" name="signature3" id="signature3" value="'+ dataURL3 +'"><br><input type="text" class="form-control" name="name3" id="name3" value="'+ input3 +'" readonly></div>';

        $("#saveCompanySignatureDB1aM_web").val(dataURL);
        $("#saveCompanySignatureDB1aM_web2").val(dataURL2);
        $("#saveCompanySignatureDB1aM_web3").val(dataURL3);

        $("#company_representative_printed_name").val(input1);
        $("#primary_account_holder_name").val(input2);
        $("#secondery_account_holder_name").val(input3);

        $('.signatureArea').html(input_conf);

        $('#signature_mobile').modal('toggle');
        // if (confirm('Some message')) {
        //     alert('Thanks for confirming');
        // } else {
        //     alert('Why did you press cancel? You should have confirmed');
        // }

        // location.reload();
    },
    });
//   }
}
</script>

<script>
$(document).ready(function(){
    if(window.matchMedia("(max-width: 600px)").matches){
        // alert("This is a mobile device.");
        $(document).on("click", ".testing", function () {
            $('.getItems').hide();
            $('#item_typeid').removeClass('form-control');
        });
        $(document).on("click", ".select_item", function () {
            $('.getItems').hide();
        });
    } 
    // else{
    //     $('.getItems_hidden').hide();
    // }
});
</script>

<script>
    $(document).on("focusout", "#one_time", function () {
        var counter = $(this).val();
        var m_monitoring = $("#m_monitoring").val();
        var subtotal = 0;
        // $("#span_total_0").each(function(){
            $('*[id^="span_total_"]').each(function(){
            subtotal += parseFloat($(this).text());
        });

        grand_tot = parseFloat(counter) + parseFloat(subtotal) + parseFloat(m_monitoring);
        //  alert(grand_tot);
        var grand = $("#grand_total_input").val(grand_tot.toFixed(2));

        $("#payment_amount").val(grand_tot.toFixed(2));
    });

    $(document).on("focusout", "#m_monitoring", function () {
        var counter = $(this).val();
        // var grand = $("#grand_total_input").val();
        var one_time = $("#one_time").val();
        var subtotal = 0;
        // $("#span_total_0").each(function(){
            $('*[id^="span_total_"]').each(function(){
            subtotal += parseFloat($(this).text());
        });

        grand_tot = parseFloat(counter) + parseFloat(subtotal) + parseFloat(one_time);
        //  alert(grand_tot);
        var grand = $("#grand_total_input").val(grand_tot.toFixed(2));
        $("#payment_amount").val(grand_tot.toFixed(2));
    });

    // $(document).on("checked", "#same_as", function () {
    //     alert('yeah');
    // });
    </script>

<script>
// $(document).on('click','.show_mobile_view',function(){
//     //    alert('yeah');
//     $('#update_group').modal('show');
// });
$(document).on('click','.groupChange',function(){
    //    alert('yeah');
    $('#item_group_type').val();
});
</script>

<script>
//   $(function() {
//     $("#rebatable_toggle").each(function(){
//     $(this).change(function() {
//     //   $('#console-event').html('Toggle: ' + $(this).prop('checked'))
//     alert('yeah');
//     })
//   })
$(document).ready(function () {

//iterate through all the divs - get their ids, hide them, then call the on click
$(".toggle").each(function () {
    var $context = $(this);
    var $button = $context.find("#rebatable_toggle");
    //            $currentId = $button.attr('id');
    // var $divOptions = $context.find('div').last();

    //$($divOptions).hide();
    $($button).on('change', function (event) {
        // alert('yeah');
        // $(this).click(function() {        
        var id = $($button).attr("item-id");
        var get_val = $($button).val();
        // alert(id);

        $.ajax({
            type: 'POST',
            url:"<?php echo base_url(); ?>accounting/changeRebate",
            data: {id : id, get_val : get_val },
            dataType: 'json',
            success: function(response){
                // alert('Successfully Change');
                sucess("Rebate Updated Successfully!");
                // $('.lamesa').load(window.location.href +  ' .lamesa');
                // location.reload();
                $('#item_list').modal('toggle');
                // $("#item_list .modal-body").load(target, function() { 
                // $("#item_list").modal("show"); 
                // });
                $('#item_list').on('hidden.bs.modal', function (e) {
                    location.reload();
                    });
            },
                error: function(response){
                alert('Error'+response);
       
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
                    window.location.href="<?= base_url(); ?>customer/preview/"+$id;
                }
            });
        }

    // });
    });
});
});
</script>


<script>
    $(function() {
        $("nav:first").addClass("closed");
    });
</script>

<script>
var wrapper = document.getElementById("signature-pad");
var canvas = wrapper.querySelector("canvas");

var sign = new SignaturePad(document.getElementById('sign'), {
  backgroundColor: 'rgba(255, 255, 255, 0)',
  penColor: 'rgb(0, 0, 0)'
});

function resizeCanvas() {
     var ratio =  Math.max(window.devicePixelRatio || 1, 1);

     canvas.width = canvas.offsetWidth * ratio;
     canvas.height = canvas.offsetHeight * ratio;
     canvas.getContext("2d").scale(ratio, ratio);
}

window.onresize = resizeCanvas;
resizeCanvas();
</script>

<script>
var wrapper = document.getElementById("signature-pad2");
var canvas = wrapper.querySelector("canvas");

var sign = new SignaturePad(document.getElementById('sign2'), {
  backgroundColor: 'rgba(255, 255, 255, 0)',
  penColor: 'rgb(0, 0, 0)'
});

function resizeCanvas() {
     var ratio =  Math.max(window.devicePixelRatio || 1, 1);

     canvas.width = canvas.offsetWidth * ratio;
     canvas.height = canvas.offsetHeight * ratio;
     canvas.getContext("2d").scale(ratio, ratio);
}

window.onresize = resizeCanvas;
resizeCanvas();
</script>

<script>
var wrapper = document.getElementById("signature-pad3");
var canvas = wrapper.querySelector("canvas");

var sign = new SignaturePad(document.getElementById('sign3'), {
  backgroundColor: 'rgba(255, 255, 255, 0)',
  penColor: 'rgb(0, 0, 0)'
});

function resizeCanvas() {
     var ratio =  Math.max(window.devicePixelRatio || 1, 1);

     canvas.width = canvas.offsetWidth * ratio;
     canvas.height = canvas.offsetHeight * ratio;
     canvas.getContext("2d").scale(ratio, ratio);
}

window.onresize = resizeCanvas;
resizeCanvas();
</script>



<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlMWhWMHlxQzuolWb2RrfUeb0JyhhPO9c&libraries=places"></script> -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?= google_credentials()['api_key'] ?>&callback=initialize&libraries=&v=weekly"></script>
<script>
function initialize() {
          var input = document.getElementById('job_location');
          var autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var place = autocomplete.getPlace();
                document.getElementById('city2').value = place.name;
                document.getElementById('cityLat').value = place.geometry.location.lat();
                document.getElementById('cityLng').value = place.geometry.location.lng();
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);
</script>

<script type="text/javascript">
// $(window).on('beforeunload', function(){
//     var c = confirm();
//     if(c){
//         return true;
//     }
//     else
//         return false;
// });
</script>

<script src="<?php echo $url->assets ?>js/add.js"></script>
<script>
jQuery(document).ready(function () {
    $(document).on('click','#Commercial',function(){
        $('#business_name_area').show();
    });
    $(document).on('click','#customer_type',function(){
        $('#business_name_area').hide();
    });
    $(document).on('click','#advance',function(){
        $('#business_name_area').hide();
    });
});
</script>

<script>

    document.getElementById('mobile_no_').addEventListener('input', function (e) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
        e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    });
    document.getElementById('phone_no_').addEventListener('input', function (e) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
        e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    });

    function validatecard() {
        var inputtxt = $('.card-number').val();

        if (inputtxt == 4242424242424242) {
            $('.require-validation').submit();
        } else {
            alert("Not a valid card number!");
            return false;
        }
    }
    
</script>

<script>
// var value = $("#headerContent").text();
// if(value.indexOf("agreement") != -1)
// //   alert("true");
// return $(this).text().replace("agreement", "yeahhhhh"); 
// else
//   alert("false");
// $(".headerContent").text(function () {
//     return $(this).text().replace("agreement", "yeahhhhh"); 
// });​​​​​

jQuery(function($){

// Replace 'td' with your html tag
$("#headerContent").html(function() { 

// Replace 'ok' with string you want to change, you can delete 'hello everyone' to remove the text
 var currentDate = $('#current_date').val();
      return $(this).html().replace("{curr_date}", currentDate);  

});
});

jQuery(function($){

// Replace 'td' with your html tag
$("#headerID").val(function() { 

// Replace 'ok' with string you want to change, you can delete 'hello everyone' to remove the text
 var currentDate = $('#current_date').val();
      return $(this).val().replace("{curr_date}", currentDate);  

});
});

jQuery(function($){

// Replace 'td' with your html tag
$("#headerID").val(function() { 

    var companyName = $('#company_name').val();
// Replace 'ok' with string you want to change, you can delete 'hello everyone' to remove the text
      return $(this).val().replace("{comp_name}", companyName);  

});
});

jQuery(function($){

// Replace 'td' with your html tag
$("#headerContent").html(function() { 

    var companyName = $('#company_name').val();
// Replace 'ok' with string you want to change, you can delete 'hello everyone' to remove the text
      return $(this).html().replace("{comp_name}", companyName);  

});
});

jQuery(function($){

// Replace 'td' with your html tag
$("#thisdiv3").html(function() { 

    // var companyName = $('#company_name').val();
    // var now = new Date();
    // now.setDate(now.getDate()+3);
    // var n=3; //number of days to add. 
    // var t = new Date();
    // t.setDate(t.getDate() + n); 
    // var month = "0"+(t.getMonth()+1);
    // var date = "0"+t.getDate();
    // month = month.slice(-2);
    // date = date.slice(-2);
    // var date = " "+ month +"-"+date +"-"+t.getFullYear();


    // var startDate = "16-APR-2021";
    var startDate = new Date();
    // var daaa = new Date();
    
    // var date = d.getDate();
    // var month = d.getMonth() + 1; // Since getMonth() returns month from 0-11 not 1-12
    // var year = d.getFullYear();
        
    // var startDate = date + "-" + month + "-" + year;

    // startDate = new Date(startDate.replace(/-/g, "/"));
    var endDate = "", noOfDaysToAdd = 3, count = 0;
    while(count < noOfDaysToAdd){
        endDate = new Date(startDate.setDate(startDate.getDate() + 1));
        if(endDate.getDay() != 0 && endDate.getDay() != 6){
        count++;
        }
    }
    //alert(endDate);
    var month = "0"+(endDate.getMonth()+1);
    var date = "0"+endDate.getDate();
    month = month.slice(-2);
    date = date.slice(-2);
    var date = " "+ month +"-"+date +"-"+endDate.getFullYear();

// alert(now);  
      return $(this).html().replace("{current_date_3}", date);  

});
});

jQuery(function($){

// Replace 'td' with your html tag
$("#terms_of_use").val(function() { 

    // var companyName = $('#company_name').val();
    // var now = new Date();
    // now.setDate(now.getDate()+3);
    // var n=3; //number of days to add. 
    // var t = new Date();
    // t.setDate(t.getDate() + n); 
    // var month = "0"+(t.getMonth()+1);
    // var date = "0"+t.getDate();
    // month = month.slice(-2);
    // date = date.slice(-2);
    // var date = " "+ month +"-"+date +"-"+t.getFullYear();


    // var startDate = "16-APR-2021";
    var startDate = new Date();
    // var daaa = new Date();
    
    // var date = d.getDate();
    // var month = d.getMonth() + 1; // Since getMonth() returns month from 0-11 not 1-12
    // var year = d.getFullYear();
        
    // var startDate = date + "-" + month + "-" + year;

    // startDate = new Date(startDate.replace(/-/g, "/"));
    var endDate = "", noOfDaysToAdd = 3, count = 0;
    while(count < noOfDaysToAdd){
        endDate = new Date(startDate.setDate(startDate.getDate() + 1));
        if(endDate.getDay() != 0 && endDate.getDay() != 6){
        count++;
        }
    }
    //alert(endDate);
    var month = "0"+(endDate.getMonth()+1);
    var date = "0"+endDate.getDate();
    month = month.slice(-2);
    date = date.slice(-2);
    var date = " "+ month +"-"+date +"-"+endDate.getFullYear();

// alert(now);  
      return $(this).val().replace("{current_date_3}", date);  

});
});
</script>

<script>
// var value = $("#headerContent").text();
// if(value.indexOf("agreement") != -1)
// //   alert("true");
// return $(this).text().replace("agreement", "yeahhhhh"); 
// else
//   alert("false");
// $(".headerContent").text(function () {
//     return $(this).text().replace("agreement", "yeahhhhh"); 
// });​​​​​

jQuery(function($){

// Replace 'td' with your html tag
$("#content_input").val(function() { 

// Replace 'ok' with string you want to change, you can delete 'hello everyone' to remove the text
 var currentDate = $('#current_date').val();
      return $(this).val().replace("day", currentDate);  

});
});

jQuery(function($){

// Replace 'td' with your html tag
$("#content_input").val(function() { 

    var companyName = $('#company_name').val();
// Replace 'ok' with string you want to change, you can delete 'hello everyone' to remove the text
      return $(this).val().replace("ADI", companyName);  

});
});
</script>

<script>
$(document).on('click','#headerContent',function(){
    //    alert('yeah');
    $('#update_header_modal').modal('show');
});

$(document).on('click','.save_update_header',function(){
    //    alert('yeah');
    var id = $('#update_h_id').val();
    // var content = $('.editor1_tc').val();
    var content = CKEDITOR.instances['editor3'].getData();
    // alert(content);
      $.ajax({
            url:"<?php echo base_url(); ?>workorder/save_update_header",
            type: "POST",
            data: {id : id, content : content },
            success: function(dataResult){
                // $('#table').html(dataResult); 
                // alert('success')
                console.log(dataResult);
                $("#update_header_modal").modal('hide')
                $('#header_area').load(window.location.href +  ' #header_area');
            },
                error: function(response){
                alert('Error'+response);
       
                }
	    });
});

</script>

<script>
$(document).on('click','.save_terms_and_conditions',function(){
    //    alert('yeah');
    var id = $('#update_tc_id').val();
    // var content = $('.editor1_tc').val();
    var content = CKEDITOR.instances['editor1'].getData();
    // alert(content);
      $.ajax({
            url:"<?php echo base_url(); ?>workorder/save_update_tc",
            type: "POST",
            data: {id : id, content : content },
            success: function(dataResult){
                // $('#table').html(dataResult); 
                // alert('success')
                console.log(dataResult);
                $("#terms_conditions_modal").modal('hide')
                $('#thisdiv2').load(window.location.href +  ' #thisdiv2');
            },
                error: function(response){
                alert('Error'+response);
       
                }
	    });
        
    });

</script>

<script>
$(document).on('click','.save_terms_of_use',function(){
    //    alert('yeah');
    var id = $('#update_tu_id').val();
    // var content = $('.editor1_tc').val();
    var content = CKEDITOR.instances['editor2'].getData();
    // alert(content);
      $.ajax({
            url:"<?php echo base_url(); ?>workorder/save_update_tu",
            type: "POST",
            data: {id : id, content : content },
            success: function(dataResult){
                // $('#table').html(dataResult); 
                // alert('success')
                console.log(dataResult);
                $("#terms_use_modal").modal('hide')
                $('#thisdiv3').load(window.location.href +  ' #thisdiv3');
            },
                error: function(response){
                alert('Error'+response);
       
                }
	    });
        
    });

</script>

<script>
    function validatecard() {
        var inputtxt = $('.card-number').val();

        if (inputtxt == 4242424242424242) {
            $('.require-validation').submit();
        } else {
            alert("Not a valid card number!");
            return false;
        }
    }


    $(document).ready(function () {
        $('#sel-customer').select2();
        var customer_id = "<?php echo isset($_GET['customer_id']) ? $_GET['customer_id'] : '' ?>";

        /*$('#customers')
            .empty() //empty select
            .append($("<option/>") //add option tag in select
                .val(customer_id) //set value for option to post it
                .text("<?php echo get_customer_by_id($_GET['customer_id'])->contact_name ?>")) //set a text for show in select
            .val(customer_id) //select option of select2
            .trigger("change"); //apply to select2*/
    });
</script>

<script>

$(document).ready(function(){
 
    $('#sel-customer').change(function(){
    var id  = $(this).val();
    // alert(id);

        $.ajax({
            type: 'POST',
            url:"<?php echo base_url(); ?>accounting/addLocationajax",
            data: {id : id },
            dataType: 'json',
            success: function(response){
                // alert('success');
                // console.log(response['customer']);
            // $("#job_location").val(response['customer'].mail_add + ' ' + response['customer'].cross_street + ' ' + response['customer'].city + ' ' + response['customer'].state + ' ' + response['customer'].country);

            // var phone = response['customer'].phone_h;
            // var new_phone = phone.value.replace(/(\d{3})\-?/g,'$1-');
            var phone = response['customer'].phone_h;
                // phone = normalize(phone);
            
            var mobile = response['customer'].phone_m;
                // mobile = normalize(mobile);

            var test_p = phone.replace(/(\d{3})(\d{3})(\d{3})/, "$1-$2-$3")
            var test_m = mobile.replace(/(\d{3})(\d{3})(\d{3})/, "$1-$2-$3")
            
            $("#job_location").val(response['customer'].mail_add);
            $("#email").val(response['customer'].email);
            $("#date_of_birth").val(response['customer'].date_of_birth);
            $("#phone_no").val(test_p);
            $("#mobile_no").val(test_m);
            $("#city").val(response['customer'].city);
            $("#state").val(response['customer'].state);
            $("#zip").val(response['customer'].zip_code);
            $("#cross_street").val(response['customer'].cross_street);
            $("#acs_fullname").val(response['customer'].first_name +' '+ response['customer'].last_name);

            $("#job_name").val(response['customer'].first_name + ' ' + response['customer'].last_name);

            $("#primary_account_holder_name").val(response['customer'].first_name + ' ' + response['customer'].last_name);
        
            },
                error: function(response){
                //alert('Error'+response);
       
                }
        });

        function normalize(phone) {
            //normalize string and remove all unnecessary characters
            phone = phone.replace(/[^\d]/g, "");

            //check if number length equals to 10
            if (phone.length == 10) {
                //reformat and return phone number
                return phone.replace(/(\d{3})(\d{3})(\d{4})/, "($1) $2-$3");
            }

            return null;
        }

    });


    $(document).on('click','.setmarkup',function(){
       // alert('yeah');
        var markup_amount = $('#markup_input').val();

        $("#markup_input_form").val(markup_amount);
        $("#span_markup_input_form").text(markup_amount);
        $("#span_markup").text(markup_amount);

        $('#modalSetMarkup').modal('toggle');
    });
});

</script>

<script>
    $(document).on('click', '.remove-checklist', function(){
        var checklist_row_id = $(this).attr('data-row');
        $("#s-checklist-"+checklist_row_id).remove();
    });

    $(document).ready(function(){

        $('.add_checklist_items').click(function(){
            // alert('test');
            $('input[id="checkist_checkbox"]:checked').each(function() {
            // alert(this.value);
            var id = this.value;
            // $("#checklist_added").html(this.value);
            // $("#checklist_modal").modal('hide')

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>workorder/getchecklistdetailsajax",
                dataType:"json",
                data : { id : id },
                success: function(response){

                  //console.log('yeahhhhhhhhhhhhhhh'+response['checklists'][0].checklist_name); 
                  //console.log(response); 

                  $("#checklist_modal").modal('hide')
                //   $("#checklist_added").html(response['checklists'].checklist_name);
                //   $(".business_name").html(response['client'].business_name);
                // var objJSON = JSON.parse(response['checklists'].checklist_name);
                // var inputs = "";
                // $.each(objJSON, function (i, v) {
                //     inputs += response['checklists'].checklist_name;
                // });

                //New Code
                var current_row  = $('.selected-checklists li').length + 1;
                var input_hidden = '<input type="hidden" name="checklists[]" value="'+response['checklists'][0].id+'" />';
                var check = '<li id="s-checklist-'+current_row+'" id="view_details" c_id="'+ response['checklists'][0].id +'">'+response['checklists'][0].checklist_name+' <a class="remove-checklist" data-row="'+current_row+'" href="javascript:void(0);"><i class="fa fa-trash-o icon"></i></a>'+input_hidden+'</li>';
                $(".selected-checklists").append(check);

                //Old code
                //var check = '<ul> <li id="view_details" ><h6>'+ response['checklists'][0].checklist_name +'</h6> </li> </ul>';
                //$("#checklist_added").append(check);

                
                var cID = response['checklists'][0].id;
                // alert(cID);

                
                // initialize tooltip
                $('#view_details').each(function(e){
                // $("#view_details").mouseover(function(){
                // track:true,
                // open: function( event, ui ) {
                    $(this).on('mouseover', function(){
                    var id = this.id;
                    var userid = $(this).attr('c_id');
                    // alert(userid);
                    
                        // $.ajax({
                        //     url:'fetch_details.php',
                        //     type:'post',
                        //     data:{userid:userid},
                        //     success: function(response){
                        //         alert(userid);
                        
                        //     // Setting content option
                        //     //$("#"+id).tooltip('option','content',response);
                        
                        //     }
                        });

                });

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>workorder/getchecklistitemsajax",
                    dataType:"json",
                    data : { cID : cID },
                    success: function(result){
                        // console.log('aaaaa'+result['citems'][0].item_name); 
                        // $("#citems").append(result['citems'][0].item_name);
                    },
                        error: function(result){
                        alert('Error'+result);
        
                    }

                });

                // $.each(response, function () {
                //     $("#checklist_added").html( this.checklist_name);
                //     // $("#pics_Id").append("<div>" + this.id + "</div>");
                // });


                },
                    error: function(response){
                    alert('Error'+response);
       
                }

              });
            });
        });


    });
</script>


<script>
$(document).ready(function(){

// $('.mytxtc').each(function(){
//     alert($(this).attr('label-id'););
    
// });
// $(".mytxtc").each(function () {

// var label = $(this).text(); // It will get current label text
// alert($(this).text());
// // roomOcc.push(label);

// });
$(function () {
    $('#collected_checkbox').click(function() {
        // alert('yes');
        var actualTime = "";
        $('#collected_checkbox_label').toggleClass("highlight");
    });
});

$('#modal_items_list').DataTable({
    "autoWidth" : false,
    "columnDefs": [
    { width: 540, targets: 0 },
    { width: 100, targets: 0 },
    { width: 100, targets: 0 }
    ],
    "ordering": false,
});

$('.mytxtc').each(function(e){
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
        // e.preventDefault();
        $(this).on('click', function(){
            var id = $(this).attr('label-id');
            var name = $(this).attr('label-name');
            $('#update_custom_id').val(id);
            $('#update_custom_name').val(name);
            // alert(id);
            // $(document).on("click", "label.mytxt", function () {
                // var txt = $(this).text();
                // $(this).replaceWith("<input class='mytxt'/>");
                // $(this).val(txt);
                // $('.custom_'+id).val(id);
            // });

            
        });

        // $(this).on("click", function () {
        //         var txt = $(this).val();
        //         $(this).replaceWith("<label class='mytxt'></label>");
        //         $(this).text(txt);
        //         $('.custom_'+id).val(txt);
        //     });
    });

$('.saveUpdateCustomField').on('click', function(){
    //   alert('yeah');
      var id = $('#update_custom_id').val();
      var name = $('#update_custom_name').val();

      $.ajax({
            url:"<?php echo base_url(); ?>workorder/save_update_custom_name",
            type: "POST",
            data: {id : id, name : name },
            success: function(dataResult){
                // $('#table').html(dataResult); 
                // alert('success')
                $("#modalupdateCustom").modal('hide')
                $('#thisdiv').load(window.location.href +  ' #thisdiv');
            }
	    });
  });


});
</script>

<script>

$(document).ready(function(){
 
    $('.validate_offer').click(function(){
    var offer_code  = $("#offer_code").val();
    // alert(offer_code);

        $.ajax({
            type: 'POST',
            url:"<?php echo base_url(); ?>accounting/findoffercode",
            data: {offer_code : offer_code },
            dataType: 'json',
            success: function(response){
                // data = response.trim();
                // alert('success');
            // alert(response['offer'].cost);
            if (response != null){   
                var cost = response['offer'].cost;
                $("#offer_cost").text( '- $' + response['offer'].cost);
                $("#offer_cost").val(response['offer'].cost);

                var grand = $("#grand_total_input").val();
                var new_grand = grand - parseFloat(cost);

                $("#grand_total").text(new_grand.toFixed(2));
                $("#grand_total_input").val(new_grand.toFixed(2));
                $("#payment_amount").val(new_grand.toFixed(2));
                // alert('computed');
                $('#saved').show();
                $('.invalid_code').hide();
            }
            else{   
                
                alert('invalid');
            }
        
            },
                error: function(response){
                // alert('Error'+response);
                $('.invalid_code').show();
                $("#offer_cost").text('0');
                $("#offer_cost").val('0');

                var total1 = $("#span_sub_total_invoice").text();
                var total2 = $("#adjustment_input").val();

                var total3  = parseFloat(total1) - parseFloat(total2);
                $("#grand_total").text(total3.toFixed(2));
                $("#grand_total_input").val(total3.toFixed(2));
                $("#payment_amount").val(total3.toFixed(2));
                // var counter = $(this).data("counter");
                // calculation(counter);
       
                }
        });
    });

    function calculation(counter) {
  var price = $("#price_" + counter).val();
  var quantity = $("#quantity_" + counter).val();
  var discount = $("#discount_" + counter).val()
    ? $("#discount_" + counter).val()
    : 0;
  var tax = (parseFloat(price) * 7.5) / 100;
  var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(
    2
  );
  var total = (
    (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
    parseFloat(discount)
  ).toFixed(2);

  $("#span_total_" + counter).text(total);
  $("#total_" + counter).val(total);
  $("#span_tax_" + counter).text(tax1);
  $("#tax1_" + counter).val(tax1);
  // $("#tax1_" + counter).val(tax1);
  // $("#tax_" + counter).val(tax1);
  // alert(tax1);

  if( $('#tax_'+ counter).length ){
    $('#tax_'+counter).val(tax1);
  }

  if( $('#item_total_'+ counter).length ){
    $('#item_total_'+counter).val(total);
  }

  var eqpt_cost = 0;
  var subtotal = 0;
  var adjustment_amount = 0;
  var cnt = $("#count").val();

  if (
    $("#adjustment_input").val() &&
    $("#adjustment_input").val().toString().length > 1
  ) {
    adjustment_amount = $("#adjustment_input").val().substr(1);
  }
  for (var p = 0; p <= cnt; p++) {
    var prc = $("#price_" + p).val();
    var quantity = $("#quantity_" + p).val();
    // var discount= $('#discount_' + p).val();
    // eqpt_cost += parseFloat(prc) - parseFloat(discount);
    subtotal += parseFloat($("#span_total_" + p).text());
    eqpt_cost += parseFloat(prc) * parseFloat(quantity);
  }

  $("#adjustment_amount").text(parseFloat(adjustment_amount));
  $("#adjustment_amount_form_input").val(parseFloat(adjustment_amount));
  $("#invoice_sub_total").text(subtotal.toFixed(2));
  $("#sub_total_form_input").val(subtotal.toFixed(2));

  $("#span_sub_total_0").text(subtotal.toFixed(2));

  var grandTotal = eval(
    $("#invoice_sub_total").text() + $("#adjustment_input").val()
  );
  $("#invoice_grand_total").text(parseFloat(grandTotal).toFixed(2));
  $("#grand_total_form_input").val(parseFloat(grandTotal).toFixed(2));

  eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
  $("#eqpt_cost").val(eqpt_cost);

  // alert('dri');

  if($("#grand_total").length && $("#grand_total").val().length)
  {
    // console.log('none');
    // alert('none');
  }else{
    $("#grand_total").text(grand_total_w.toFixed(2));
    $("#grand_total_input").val(grand_total_w.toFixed(2));
    $("#payment_amount").val(grand_total_w.toFixed(2));

    var bundle1_total = $("#grand_total").text();
    var bundle2_total = $("#grand_total2").text();
    var super_grand = parseFloat(bundle1_total) + parseFloat(bundle2_total);
    $("#supergrandtotal").text(super_grand.toFixed(2));
    $("#supergrandtotal_input").val(super_grand.toFixed(2));
  }

  var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
  sls = parseFloat(sls).toFixed(2);
  $("#sales_tax").val(sls);
  cal_total_due();
}


});

</script>


<script>
$(document).on("click", "label.mytxt", function () {
        var txt = $(".mytxt").text();
        $(".mytxt").replaceWith("<input class='mytxt'/>");
        $(".mytxt").val(txt);
        $(".custom1").val(txt);
    });

    $(document).on("blur", "input.mytxt", function () {
        var txt = $(this).val();
        $(this).replaceWith("<label class='mytxt'></label>");
        $(".mytxt").text(txt);
        $(".custom1").val(txt);
});
$(document).on("click", "label.mytxt2", function () {
        var txt = $(".mytxt2").text();
        $(".mytxt2").replaceWith("<input class='mytxt2'/>");
        $(".mytxt2").val(txt);
        $(".custom2").val(txt);
    });

    $(document).on("blur", "input.mytxt2", function () {
        var txt = $(this).val();
        $(this).replaceWith("<label class='mytxt2'></label>");
        $(".mytxt2").text(txt);
        $(".custom2").val(txt);
});

$(document).on("click", "label.mytxt3", function () {
        var txt = $(".mytxt3").text();
        $(".mytxt3").replaceWith("<input class='mytxt3'/>");
        $(".mytxt3").val(txt);
        $(".custom3").val(txt);
    });

    $(document).on("blur", "input.mytxt3", function () {
        var txt = $(this).val();
        $(this).replaceWith("<label class='mytxt3'></label>");
        $(".mytxt3").text(txt);
        $(".custom3").val(txt);
});

$(document).on("click", "label.mytxt4", function () {
        var txt = $(".mytxt4").text();
        $(".mytxt4").replaceWith("<input class='mytxt4'/>");
        $(".mytxt4").val(txt);
        $(".custom4").val(txt);
    });

    $(document).on("blur", "input.mytxt4", function () {
        var txt = $(this).val();
        $(this).replaceWith("<label class='mytxt4'></label>");
        $(".mytxt4").text(txt);
        $(".custom4").val(txt);
});

$(document).on("click", "label.mytxt5", function () {
        var txt = $(".mytxt5").text();
        $(".mytxt5").replaceWith("<input class='mytxt5'/>");
        $(".mytxt5").val(txt);
        $(".custom5").val(txt);
    });

    $(document).on("blur", "input.mytxt5", function () {
        var txt = $(this).val();
        $(this).replaceWith("<label class='mytxt5'></label>");
        $(".mytxt5").text(txt);
        $(".custom5").val(txt);
});

$(document).on("click", "label.mytxt6", function () {
        var txt = $(".mytxt6").text();
        $(".mytxt6").replaceWith("<input class='form-control mytxt6' />");
        $(".mytxt6").val(txt);
        $(".custom6").val(txt);
    });

    $(document).on("blur", "input.mytxt6", function () {
        var txt = $(this).val();
        $(this).replaceWith("<label class='form-control mytxt6'></label>");
        $(".mytxt6").text(txt);
        $(".custom6").val(txt);
});

document.getElementById("payment_method").onchange = function() {
    if (this.value == 'Cash') {
        // alert('cash');
		// $('#exampleModal').modal('toggle');
        $('#cash_area').show();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#invoicing').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    	}
    else if(this.value == 'Invoicing'){

        $('#cash_area').hide();
        $('#check_area').hide();
        $('#invoicing').show();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    }
	
    else if(this.value == 'Check'){
        // alert('Check');
        $('#cash_area').hide();
        $('#check_area').show();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#invoicing').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    }
    else if(this.value == 'Credit Card'){
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').show();
        $('#debit_card').hide();
        $('#invoicing').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    }
    else if(this.value == 'Debit Card'){
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').show();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#invoicing').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    }
    else if(this.value == 'ACH'){
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#invoicing').hide();
        $('#ach_area').show();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    }
    else if(this.value == 'Venmo'){
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#ach_area').hide();
        $('#invoicing').hide();
        $('#venmo_area').show();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    }
    else if(this.value == 'Paypal'){
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#invoicing').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').show();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    }
    else if(this.value == 'Square'){
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#invoicing').hide();
        $('#debit_card').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').show();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    }
    else if(this.value == 'Warranty Work'){
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#invoicing').hide();
        $('#debit_card').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').show();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    }
    else if(this.value == 'Home Owner Financing'){
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#invoicing').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').show();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    }
    else if(this.value == 'e-Transfer'){
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#invoicing').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').show();
        $('#other_credit_card').hide();
        $('#other_payment_area').hide();
    }
    else if(this.value == 'Other Credit Card Professor'){
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#invoicing').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').show();
        $('#other_payment_area').hide();
    }
    else if(this.value == 'Other Payment Type'){
        // alert('Credit card');
        $('#cash_area').hide();
        $('#check_area').hide();
        $('#credit_card').hide();
        $('#debit_card').hide();
        $('#invoicing').hide();
        $('#ach_area').hide();
        $('#venmo_area').hide();
        $('#paypal_area').hide();
        $('#square_area').hide();
        $('#warranty_area').hide();
        $('#home_area').hide();
        $('#e_area').hide();
        $('#other_credit_card').hide();
        $('#other_payment_area').show();
    }
}
</script>

<script>
$(".select_package").click(function () {
  var idd = this.id;
  console.log(idd);
  console.log($(this).data('itemname'));
  var title = $(this).data('itemname');
  var price = $(this).data('price');

    if(!$(this).data('quantity')){
    // alert($(this).data('quantity'));
    var qty = 0;
  }else{
    // alert('0');
    var qty = $(this).data('quantity');
  }
  

$.ajax({
    type: 'POST',
    url:"<?php echo base_url(); ?>workorder/select_package",
    data: {idd : idd },
    dataType: 'json',
    success: function(response){
        // alert('Successfully Change');
        console.log(response['items']);

        // var objJSON = JSON.parse(response['items'][0].title);
                var inputs = "";
                $.each(response['items'], function (i, v) {
                    inputs += v.title ;
                    var total_pu = v.price * v.units;
                    var total_tax = (v.price * v.units) * 7.5 / 100;
                    var total_temp = total_pu + total_tax;
                    var total = total_temp.toFixed(2);

                    
                  markup = "<tr id=\"ss\">" +
                      "<td width=\"35%\"><input value='"+v.title+"' type=\"text\" name=\"items[]\" class=\"form-control getItems\" ><input type=\"hidden\" value='"+v.id+"' name=\"itemid[]\" id=\"itemid\"><div class=\"show_mobile_view\"><span class=\"getItems_hidden\">"+v.title+"</span></div></td>\n" +
                      "<td width=\"20%\"><div class=\"dropdown-wrapper\"><select name=\"item_type[]\" class=\"form-control\"><option value=\"product\">Product</option><option value=\"material\">Material</option><option value=\"service\">Service</option><option value=\"fee\">Fee</option></select></div></td>\n" +
                      "<td width=\"10%\"><input data-itemid='"+v.id+"' id='quantity_"+v.id+"' value='"+v.units+"' type=\"number\" name=\"quantity[]\" data-counter=\"0\"  min=\"0\" class=\"form-control qtyest2 mobile_qty \"></td>\n" +
                      "<td width=\"10%\"><input id='price_"+v.id+"' value='"+v.price+"'  type=\"number\" name=\"price[]\" class=\"form-control hidden_mobile_view \" placeholder=\"Unit Price\"><input type=\"hidden\" class=\"priceqty\" id='priceqty_"+v.id+"' value='"+total_pu+"'><div class=\"show_mobile_view\"><span class=\"price\">"+v.price+"</span><input type=\"hidden\" class=\"form-control price\" name=\"price_[]\" data-counter=\"0\" id=\"priceM_0\" min=\"0\" value='"+v.price+"'></div></td>\n" +
                    //   "<td width=\"10%\"><input type=\"number\" class=\"form-control discount\" name=\"discount[]\" data-counter=\"0\" id=\"discount_0\" value=\"0\" ></td>\n" +
                    // //  "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control\"></td>\n" +
                      "<td width=\"10%\" class=\"hidden_mobile_view\"><input type=\"number\" name=\"discount[]\" class=\"form-control discount\" id='discount_"+v.id+"' value=\"0\"></td>\n" +
                    // "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
                      "<td width=\"20%\" class=\"hidden_mobile_view\"><input type=\"text\" data-itemid='"+v.id+"' class=\"form-control tax_change2\" name=\"tax[]\" data-counter=\"0\" id='tax1_"+v.id+"' min=\"0\" value='"+total_tax+"'></td>\n" +
                      "<td style=\"text-align: center\" class=\"hidden_mobile_view\" width=\"15%\"><span data-subtotal='"+total+"' id='span_total_"+v.id+"' class=\"total_per_item\">"+total+
                    // "</span><a href=\"javascript:void(0)\" class=\"remove_item_row\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></a>"+
                      "</span> <input type=\"hidden\" name=\"total[]\" id='sub_total_text"+v.id+"' value='"+total+"'></td>" +
                      "<td>\n" +
                        '<a href="#" class="remove btn btn-sm btn-success"><i class="fa fa-trash" aria-hidden="true"></i></a>\n' +
                        "</td>\n" +
                      "</tr>";
                    tableBody = $("#jobs_items_table_body");
                    tableBody.append(markup);
                    markup2 = "<tr id=\"sss\">" +
                      "<td >"+v.title+"</td>\n" +
                      "<td ></td>\n" +
                    "<td ></td>\n" +
                    "<td >"+v.price+"</td>\n" +
                    "<td ></td>\n" +
                    "<td >"+v.units+"</td>\n" +
                    "<td ></td>\n" +
                    "<td ></td>\n" +
                    "<td >0</td>\n" +
                    "<td ></td>\n" +
                      "<td ></td>\n" +
                      "</tr>";

                });
                // $("#input_container").html(inputs);
                
                tableBody2 = $("#device_audit_datas");
                tableBody2.append(markup2);
                // alert(inputs);

                var in_id = idd;
                var price = $("#price_" + in_id).val();
                var quantity = $("#quantity_" + in_id).val();
                var discount = $("#discount_" + in_id).val();
                var tax = (parseFloat(price) * 7.5) / 100;
                var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(
                2
                );
                if( discount == '' ){
                discount = 0;
                }

                var total = (
                (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
                parseFloat(discount)
                ).toFixed(2);

                var total_wo_tax = price * quantity;

                // alert( 'yeah' + total);


                $("#priceqty_" + in_id).val(total_wo_tax);
                $("#span_total_" + in_id).text(total);
                $("#sub_total_text" + in_id).val(total);
                $("#tax_1_" + in_id).text(tax1);
                $("#tax1_" + in_id).val(tax1);
                $("#discount_" + in_id).val(discount);

                if( $('#tax_1_'+ in_id).length ){
                $('#tax_1_'+in_id).val(tax1);
                }

                if( $('#item_total_'+ in_id).length ){
                $('#item_total_'+in_id).val(total);
                }

                var eqpt_cost = 0;
                var total_costs = 0;
                var cnt = $("#count").val();
                var total_discount = 0;
                var pquantity = 0;
                for (var p = 0; p <= cnt; p++) {
                var prc = $("#price_" + p).val();
                var quantity = $("#quantity_" + p).val();
                var discount = $("#discount_" + p).val();
                var pqty = $("#priceqty_" + p).val();
                // var discount= $('#discount_' + p).val();
                // eqpt_cost += parseFloat(prc) - parseFloat(discount);
                pquantity += parseFloat(pqty);
                total_costs += parseFloat(prc);
                eqpt_cost += parseFloat(prc) * parseFloat(quantity);
                total_discount += parseFloat(discount);
                }
                //   var subtotal = 0;
                // $( total ).each( function(){
                //   subtotal += parseFloat( $( this ).val() ) || 0;
                // });

                var total_cost = 0;
                // $("#span_total_0").each(function(){
                $('*[id^="price_"]').each(function(){
                total_cost += parseFloat($(this).val());
                });

                // var totalcosting = 0;
                // $('*[id^="span_total_"]').each(function(){
                //   totalcosting += parseFloat($(this).val());
                // });


                // alert(total_cost);

                var tax_tot = 0;
                $('*[id^="tax1_"]').each(function(){
                tax_tot += parseFloat($(this).val());
                });

                over_tax = parseFloat(tax_tot).toFixed(2);
                // alert(over_tax);

                $("#sales_taxs").val(over_tax);
                $("#total_tax_input").val(over_tax);
                $("#total_tax_").text(over_tax);


                eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
                total_discount = parseFloat(total_discount).toFixed(2);
                stotal_cost = parseFloat(total_cost).toFixed(2);
                priceqty = parseFloat(pquantity).toFixed(2);
                // var test = 5;

                var subtotal = 0;
                // $("#span_total_0").each(function(){
                $('*[id^="span_total_"]').each(function(){
                subtotal += parseFloat($(this).text());
                });
                // $('#sum').text(subtotal);

                var subtotaltax = 0;
                // $("#span_total_0").each(function(){
                $('*[id^="tax_1_"]').each(function(){
                subtotaltax += parseFloat($(this).text());
                });


                var priceqty2 = 0;
                $('*[id^="priceqty_"]').each(function(){
                priceqty2 += parseFloat($(this).val());
                });

                $("#span_sub_total_invoice").text(priceqty2.toFixed(2));
                // $("#span_sub_total_invoice").text(priceqty);

                $("#eqpt_cost").val(eqpt_cost);
                $("#total_discount").val(total_discount);
                $("#span_sub_total_0").text(total_discount);
                // $("#span_sub_total_invoice").text(stotal_cost);
                // $("#item_total").val(subtotal.toFixed(2));
                $("#item_total").val(priceqty2.toFixed(2));

                var s_total = subtotal.toFixed(2);
                var adjustment = $("#adjustment_input").val();
                var grand_total = s_total - parseFloat(adjustment);
                var markup = $("#markup_input_form").val();
                var grand_total_w = grand_total + parseFloat(markup);

                // $("#total_tax_").text(subtotaltax.toFixed(2));
                // $("#total_tax_").val(subtotaltax.toFixed(2));




                $("#grand_total").text(grand_total_w.toFixed(2));
                $("#grand_total_input").val(grand_total_w.toFixed(2));
                $("#grand_total_inputs").val(grand_total_w.toFixed(2));
                $("#payment_amount").val(grand_total_w.toFixed(2));

                var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
                sls = parseFloat(sls).toFixed(2);
                $("#sales_tax").val(sls);
                cal_total_due();


    },
        error: function(response){
        alert('Error'+response);

        }
});

$('#clear').click(function() {
  $('#signArea').signaturePad().clearCanvas();
});

$('#clear2').click(function() {
  $('#signArea2').signaturePad().clearCanvas();
});

$('#clear3').click(function() {
  $('#signArea3').signaturePad().clearCanvas();
});
</script>
<script>
  $( function() {
    $( "#datepicker_dateissued" ).datepicker({
        format: 'mm/dd/yyyy'
    });
  } );

  $('#credit_number').keyup(function() {
  var foo = $(this).val().split("-").join(""); // remove hyphens
  if (foo.length > 0) {
    foo = foo.match(new RegExp('.{1,4}', 'g')).join("-");
  }
  $(this).val(foo);
});

$('#credit_number2').keyup(function() {
  var foo = $(this).val().split("-").join(""); // remove hyphens
  if (foo.length > 0) {
    foo = foo.match(new RegExp('.{1,4}', 'g')).join("-");
  }
  $(this).val(foo);
});

$('#other_credit_number').keyup(function() {
  var foo = $(this).val().split("-").join(""); // remove hyphens
  if (foo.length > 0) {
    foo = foo.match(new RegExp('.{1,4}', 'g')).join("-");
  }
  $(this).val(foo);
});
</script>

