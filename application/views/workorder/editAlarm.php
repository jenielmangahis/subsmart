<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
<?php include viewPath('includes/sidebars/workorder'); ?>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <style>
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
        margin-bottom:10px;
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

    .mobile_view
    {
        font-size:12px;
    }

    .sigWrapper
    {
        overflow: hidden; 
    }

    .mobile_view_table
    {
        min-width: 350px !important;
        margin-left: -20px !important;
    }

    .add_mobile
    {
        margin-left: -22px !important;
    }

    .mobile_qty
    {
        background: transparent !important;
        border: none !important;
        outline: none !important;
        padding: 0px 0px 0px 0px !important;
        text-align: center;
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
   </style>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40 add_mobile">
          <div class="card">
              <div class="page-title-box pt-1 pb-0">
                  <div class="row align-items-center">
                      <div class="col-sm-12">
                          </div>
                          <!-- <h3 class="page-title mt-0">New Lead</h3> -->
                          <h3 style="font-family: Sarabun, sans-serif">UPDATE ALARM SYSTEM WORKORDER AGREEMENT</h3>
                          <!-- <div class="pl-3 pr-3 mt-1 row">
                            <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">
                                    To create new lead go to Lead TAB and Select new. Enter all the Lead information as shown below.
                                    Enter Address information.  Enter Additional Information and Description
                                    and Finally click Save Button.  All required fields must have information.
                                </span>
                            </div>
                          </div> -->
                      </div>
                  </div>
              </div>
            <!-- end row -->
            <!-- <div class="row">
                <div class="col-md-12" style="background-color:#32243d;padding:1px;text-align:center;color:white;">
                    <h5>General Information</h5>
                </div>
            </div>
            <br> -->
            <?php echo form_open_multipart('workorder/UpdateWorkorderAlarm', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?> 


            <div class="row">
                <div class="col-md-12">
                    <!-- <div class="card"> -->
                        <!-- <div class="card-body"> -->
                        <div id="header_area">
                                <ol class="breadcrumb" style="margin-top:-30px;"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                            <li class="breadcrumb-item active">
                                                <label style="background-color:#E8E8E9;" id="headerContent"><?php echo $headers->content; ?></label>
                                                <input type="hidden" name="header" id="headerID" value="<?php echo $headers->content; ?>">
                                            </li>
                                        </ol>

                                        <input type="hidden" id="company_name" value="<?php echo $clients->business_name; ?>">
                                        <input type="hidden" name="wo_id_alarm" value="<?php echo $workorder->id; ?>">
                                        <input type="hidden" id="current_date" value="<?php echo @date('m-d-Y'); ?>">
                                        <input type="hidden" name="acs_id" value="<?php echo $workorder->customer_id; ?>">

                                <input type="hidden" id="content_input" class="form-control" name="header" value="<?php echo $headers->content; ?>">
                                <input type="hidden" name="wo_id" value="<?php 
                                foreach($ids as $id)
                                {
                                    $add = $id->id + 1;
                                    echo $add;
                                }
                                ?>">
                            </div>
                            <!-- ====== CUSTOMER ====== -->
							 <div class="row" id="group_area">
                             <div class="col-md-3 form-group">
                                    <label for="contact_name" class="label-element">Work Order #</label>
                                    <input type="text" class="form-control input-element" name="workorder_number" id="" value="<?php echo $workorder->work_order_number; ?>" readonly/>
                                </div>
								<div class="col-md-12">
									<div class="row">
										<div class="form-group col-md-12">
											<h5 class="box-title">Customer</h5>
										</div>
										<div class="col-md-4 form-group">
                                        <div class="select-wrap">
											<label for="">Customer Type</label><span class="form-required">*</span><br/>
											<select name="customer_type"
													class="form-control custom-select m_select"
													id="customer_type">
                                                    <option><?php echo $workorder->customer_type; ?></option>
												<?php foreach (get_config_item('customer_types') as $key => $customer_type) { ?>
													<option value="<?php echo $customer_type ?>" <?php echo (!empty($workorder->customer['customer_type']) && $workorder->customer['customer_type'] == $customer_type) ? "selected" : "" ?>>
														<?php echo $customer_type ?>
													</option>
												<?php } ?>
											</select>
										</div>
                                        </div>
                                        
                                        <?php if(empty($workorder->business_name)){ ?>
                                        <div class="col-md-4" style="display:none;" id="business_name_area">
											<label for="customer_install_type" class="label-element">Business Name</label><br/>
											<input type="text" class="form-control input-element" name="business_name" id="business_name" placeholder="Enter Name"/>
										</div>
                                        <?php }else{ ?>
                                        <div class="col-md-4" style="display:;" id="business_name_area">
											<label for="customer_install_type" class="label-element">Business Name</label><br/>
											<input type="text" class="form-control input-element" name="business_name" id="business_name" placeholder="Enter Name" value="<?php echo $workorder->business_name; ?>" />
										</div>
                                        <?php } ?>

										<div class="col-md-4 form-group">
                                        <div class="select-wrap">
											<label for="customer_install_type">Install Type</label><span class="form-required">*</span><br/>
											<select name="install_type"
													class="form-control custom-select m_select"
													id="customer_install_type">
                                                    <option><?php echo $workorder->install_type; ?></option>
												<?php foreach (get_config_item('install_types') as $key => $install_type) { ?>
													<option value="<?php echo $install_type ?>" <?php echo (!empty($workorder->customer['install_type']) && $workorder->customer['install_type'] == $install_type) ? "selected" : "" ?>>
														<?php echo $install_type ?>
													</option>
												<?php } ?>
											</select>
                                        </div>
										</div>
										<div class="col-md-4 form-group"
											 style="display: <?php echo (!empty($workorder->customer['install_type']) && $workorder->customer['install_type'] == 'Takeover') ? 'block' : 'none' ?>">
											<label for="customer_company_name" class="label-element">
												Company Name </label>
											<input type="text" class="form-control input-element" name="customer[company_name]"
												   id="customer_company_name"
												   value="<?php echo $workorder->business_name; ?>" />
										</div>
									</div>

									<div class="row">
										<div class="col-md-3 form-group">
											<label for="last_name" class="label-element">Last Name</label><span class="form-required">*</span>
											<input type="text" class="form-control input-element" name="last_name"
												   id="last_name"
												    placeholder="Enter Last Name"
												   value="<?php echo $workorder->acs_last_name; ?>"/>
										</div>
										<div class="col-md-3 form-group">
											<label for="first_name" class="label-element">First Name</label><span class="form-required">*</span>
											<input type="text" class="form-control input-element" name="first_name"
												   id="first_name" 
												   placeholder="Enter First Name" value="<?php echo $workorder->acs_first_name; ?>" />
										</div>
										<div class="col-md-2 form-group">
											<label for="contact_mobile" class="label-element">Mobile</label><span class="form-required">*</span>
											<input type="text" class="form-control input-element" name="mobile_number" value="<?php echo $workorder->phone_m; ?>"
												   id="contact_mobile" />

										</div>

										<div class="col-md-2 form-group">
											<label for="contact_dob" class="label-element">DOB</label><span class="form-required">*</span>
											<input type="text" class="form-control input-element" name="dob"
												   id="customer_contact_dob" 
                                                   value="<?php echo $workorder->date_of_birth; ?>"
												   placeholder="Enter DOB"/>
										</div>

										<div class="col-md-2 form-group">
											<label for="contact_ssn" class="label-element">SSN</label><span class="form-required">*</span>
											<input type="text" class="form-control input-element" name="security_number"
												   id="security_number"
												   value="<?php echo $workorder->ssn; ?>"
												   placeholder="Enter SSN"/>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<span class="help help-sm">Spouse</span>
										</div>
										<div class="col-md-3 form-group">
											<label for="spouse_last_name" class="label-element">Last Name</label>
											<input type="text" class="form-control input-element" name="s_last_name"
												   id="spouse_last_name" value="<?php echo $workorder->s_last_name; ?>"
												     placeholder="Enter Spouse Last Name" />
										</div>
										<div class="col-md-3 form-group">
											<label for="spouse_first_name" class="label-element">First Name</label>
											<input type="text" class="form-control input-element" name="s_first_name"
												   id="spouse_first_name"
												    placeholder="Enter Spouse First Name"
                                                    value="<?php echo $workorder->acs_first_name; ?>" />
										</div>
										<div class="col-md-2 form-group">
											<label for="spouse_contact_mobile" class="label-element">Mobile</label>
											<input type="text" class="form-control input-element" name="s_mobile"
												   id="phone_no"
												   value="<?php echo $workorder->s_mobile; ?>"
												   placeholder="Enter Mobile"/>

										</div>

										<div class="col-md-2 form-group">
											<label for="contact_dob" class="label-element">DOB</label>
											<input type="text" class="form-control input-element" name="s_dob"
												   id="customer_spouse_contact_dob"
												   value="<?php echo $workorder->s_dob; ?>"
												   placeholder="Enter DOB"/>
										</div>

										<div class="col-md-2 form-group">
											<label for="spouse_contact_ssn" class="label-element">SSN</label>
											<input type="text" class="form-control input-element" name="s_ssn"
												   id="security_number_spouse"
												   value="<?php echo $workorder->s_ssn; ?>"
												   placeholder="Enter SSN"/>
										</div>
									</div>

									<div class="row">
										<div class="col-md-3 form-group">
											<label for="monitored_location" class="label-element">Monitored Location</label><span class="form-required">*</span>
											<input type="text" class="form-control input-element" name="monitored_location"
												   id="ship-address"
												   value="<?php echo $workorder->mail_add; ?>" />
										</div>
										<div class="col-md-3 form-group">
											<label for="city" class="label-element">City</label> <span class="form-required">*</span>
                                                   <input type="text" class="form-control input-element" name="city" id="locality" placeholder="Enter City" value="<?php echo $workorder->city; ?>"/>
										</div>
										<div class="col-md-2 form-group">
											<label for="state" class="label-element">State</label><span class="form-required">*</span>
											<input type="text" class="form-control input-element" name="state"
												   id="state"  placeholder="Enter State" value="<?php echo $workorder->state; ?>"/>

										</div>

										<div class="col-md-2 form-group">
											<label for="zip" class="label-element">ZIP</label> <span class="form-required">*</span>
                                                   <input type="text" id="postcode" name="zip_code" class="form-control input-element"  value="<?php echo $workorder->zip_code; ?>"/>
										</div>

										<div class="col-md-2 form-group">
											<label for="cross_street" class="label-element">Cross Street</label>
											<input type="text" class="form-control input-element" name="cross_street"
												   id="cross_street"
												   value="<?php echo $workorder->cross_street; ?>"
												   
												   placeholder="Cross Street"/>
										</div>
									</div>

									<div class="row">
										<div class="col-md-3 form-group">
											<label for="email" class="label-element">Email</label><span class="form-required">*</span>
											<input type="email" class="form-control input-element" name="email"
												   id="email" 
												   value="<?php echo $workorder->email; 
                                                   //print_r($workorder); ?>"
												    placeholder="Enter Email"/>
										</div>
										<div class="col-md-2 form-group">
											<label for="password" class="label-element">Password</label><span class="form-required">*</span>
											<input type="text" class="form-control input-element" name="password" value="<?php echo $workorder->password; ?>"
												   id="password" >
										</div>
                                        
                                        <div class="col-md-3 form-group">
                                        <div class="select-wrap">
                                            <label for="">Notification Type</label><br/>
                                                <select name="notification_type" id="customer_notification_type_email" class="form-control custom-select m_select">
                                                    <option value="<?php echo $workorder->notification_type; ?>"><?php echo $workorder->notification_type; ?></option>
                                                    <option>Notification Type</option>
                                                    <option value="Text">Text</option>
                                                    <option value="Email">Email</option>
                                                    <option value="Text and Email">Text and Email</option>
                                                    <option value="None">None</option>
                                                </select>
                                        </div>
                                        </div>
										<!--
										<div class="col-auto form-group">
											<label for="">Notification Type</label><br/>
											<?php foreach (get_config_item('notification_types') as $key => $notification_type) { ?>
												<?php // echo array_search($notification_type, $workorder->customer['notification_type']); ?>
												<div class="checkbox checkbox-sec margin-right my-0 mr-3">
													<input type="checkbox" name="customer[notification_type][]"
														   value="<?php echo $notification_type ?>"
														<?php echo ((!empty($workorder->customer['notification_type'])) &&
															array_search($notification_type, $workorder->customer['notification_type']) !== false)
															? 'checked' : '' ?>
														   id="customer_notification_type_email_<?php echo $key ?>">
													<label for="customer_notification_type_email_<?php echo $key ?>"><span>
															<?php echo $notification_type ?>
														</span></label>
												</div>
											<?php } ?>
										</div>
										-->
										
									</div>

								</div>
                            </div>

                            

                            <!-- ====== EMERGENCY CALL LIST ====== -->
                            <div class="row" id="group_area">
                                <div class="form-group col-md-12">
                                    <h5 class="box-title">Emergency Call List</h5>
                                </div>
                                <?php 
                                $count = 0; 
                                foreach($contacts as $contact){ ?>
                                <div class="col-md-4 form-group">
                                    <!-- <div class=""> -->
                                        <label for="1st_call_verification_name" class="label-element"><?php echo $count + 1; ?>st Call Verification Name</label>
                                        <input type="text" class="form-control input-element"
                                               name="1st_verification_name[]"
                                               value="<?php echo $contact->name; ?>"
                                               id="1st_call_verification_name"
                                                placeholder="Enter 1st Call Verification Name"/>
                                    <!-- </div> -->
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contact_phone" class="mobile_view">Phone Number</label>
                                        <div class="input-group phone-input">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"><span
                                                            class="type-text"><?php echo $contact->phone_type; ?></span> <span
                                                            class="caret"></span></button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="mobile">Mobile</a></li>
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="home">Home</a></li>
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="work">Work</a></li>
                                                </ul>
                                            </span>
                                            <input type="hidden" name="1st_number_type[]"
                                                   class="type-input"
                                                   value="<?php echo $contact->phone_type; ?>"
                                                   value="mobile"/>
                                            <input type="text" name="1st_number[]"
                                                   class="form-control"
                                                   value="<?php echo $contact->phone; ?>"
                                                   placeholder="Enter Phone"/>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                        <label for="emergency_call_relation" class="label-element">Relation</label>
                                                <select name="1st_relation[]" id="1st_relation" class="form-control custom-select m_select">
                                                    <option value="<?php echo $contact->relation; ?>"><?php echo $contact->relation; ?></option>
                                                    <option value="Owner">Owner</option>
                                                    <option value="Relative">Relative</option>
                                                    <option value="Employee">Employee</option>
                                                    <option value="Friend">Friend</option>
                                                    <option value="Manager">Manager</option>
                                                    <option value="On-site">On-site</option>
                                                    <option value="Neighbor">Neighbor</option>
                                                    <option value="Resident">Resident</option>
                                                    <option value="Maintenance">Maintenance</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                </div>

                                <?php 
                                $count++;
                                    } 
                                    if($count == 1){
                                    ?>

                                <div class="col-md-4 form-group">
                                        <label for="" class="label-element">2nd Call Verification Name <small class="help help-sm">(optional)</small></label>
                                        <input type="text" class="form-control input-element"
                                               name="1st_verification_name[]"
                                               id="2nd_call_verification_name"
                                               value="<?php echo (!empty($workorder->emergency_call_list['2nd_call_verification_name'])) ? $workorder->emergency_call_list['2nd_call_verification_name'] : '' ?>"
                                                placeholder="Enter 2nd Call Verification Name"/>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contact_phone" class="mobile_view">Phone Number <small class="help help-sm">(optional)</small></label>
                                        <div class="input-group phone-input">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"><span
                                                            class="type-text"><?php echo (!empty($workorder->emergency_call_list['phone']['type'][1])) ? $workorder->emergency_call_list['phone']['type'][1] : '' ?></span> <span
                                                            class="caret"></span></button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="mobile">Mobile</a></li>
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="home">Home</a></li>
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="work">Work</a></li>
                                                </ul>
                                            </span>
                                            <input type="hidden" name="1st_number_type[]"
                                                   class="type-input"
                                                   value="<?php echo (!empty($workorder->emergency_call_list['phone']['type'][1])) ? $workorder->emergency_call_list['phone']['type'][1] : '' ?>"
                                                   value="mobile"/>
                                            <input type="text" name="1st_number[]"
                                                   class="form-control"
                                                   value="<?php echo (!empty($workorder->emergency_call_list['phone']['number'][1])) ? $workorder->emergency_call_list['phone']['number'][1] : '' ?>"
                                                   placeholder="Enter Phone"/>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                        <label for="emergency_call_relation" class="label-element">Relation <small class="help help-sm">(optional)</small></label>
                                                <select name="1st_relation[]" id="2nd_relation" class="form-control custom-select m_select">
                                                    <option value="">Choose Relation</option>
                                                    <option value="Owner">Owner</option>
                                                    <option value="Relative">Relative</option>
                                                    <option value="Employee">Employee</option>
                                                    <option value="Friend">Friend</option>
                                                    <option value="Manager">Manager</option>
                                                    <option value="On-site">On-site</option>
                                                    <option value="Neighbor">Neighbor</option>
                                                    <option value="Resident">Resident</option>
                                                    <option value="Maintenance">Maintenance</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                </div>

                                <div class="col-md-4 form-group">
                                        <label for="emergency_call_emergency_contact_1" class="label-element">3rd Call Verification Name <small class="help help-sm">(optional)</small></label>
                                        <input type="text" class="form-control input-element"
                                               name="1st_verification_name[]"
                                               id="emergency_call_emergency_contact_1"
                                               value="<?php echo (!empty($workorder->emergency_call_list['emergency_contact_1'])) ? $workorder->emergency_call_list['emergency_contact_1'] : '' ?>"
                                                placeholder="Enter Emergency Contact"/>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contact_phone" class="mobile_view">Phone Number <small class="help help-sm">(optional)</small></label>
                                        <div class="input-group phone-input">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"><span
                                                            class="type-text"><?php echo (!empty($workorder->emergency_call_list['phone']['type'][2])) ? $workorder->emergency_call_list['phone']['type'][2] : '' ?></span> <span
                                                            class="caret"></span></button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="mobile">Mobile</a></li>
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="home">Home</a></li>
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="work">Work</a></li>
                                                </ul>
                                            </span>
                                            <input type="hidden" name="1st_number_type[]"
                                                   class="type-input"
                                                   value="<?php echo (!empty($workorder->emergency_call_list['phone']['type'][2])) ? $workorder->emergency_call_list['phone']['type'][2] : '' ?>"
                                                   value="mobile"/>
                                            <input type="text" name="1st_number[]"
                                                   class="form-control"
                                                   value="<?php echo (!empty($workorder->emergency_call_list['phone']['number'][2])) ? $workorder->emergency_call_list['phone']['number'][2] : '' ?>"
                                                   placeholder="Enter Phone"/>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                        <label for="emergency_call_relation" class="label-element">Relation <small class="help help-sm">(optional)</small></label>
                                                <select name="1st_relation[]" id="3rd_relation" class="form-control custom-select m_select">
                                                    <option value="">Choose Relation</option>
                                                    <option value="Owner">Owner</option>
                                                    <option value="Relative">Relative</option>
                                                    <option value="Employee">Employee</option>
                                                    <option value="Friend">Friend</option>
                                                    <option value="Manager">Manager</option>
                                                    <option value="On-site">On-site</option>
                                                    <option value="Neighbor">Neighbor</option>
                                                    <option value="Resident">Resident</option>
                                                    <option value="Maintenance">Maintenance</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                </div>

                                <div class="col-md-4 form-group">
                                        <label for="emergency_call_emergency_contact_2" class="label-element">4th Call Verification Name <small class="help help-sm">(optional)</small></label>
                                        <input type="text" class="form-control input-element"
                                               name="1st_verification_name[]"
                                               id="emergency_call_emergency_contact_2"
                                               value="<?php echo (!empty($workorder->emergency_call_list['emergency_contact_2'])) ? $workorder->emergency_call_list['emergency_contact_2'] : '' ?>"
                                                placeholder="Enter Emergency Contact"/>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contact_phone" class="mobile_view">Phone Number <small class="help help-sm">(optional)</small></label>
                                        <div class="input-group phone-input">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"><span
                                                            class="type-text"><?php echo (!empty($workorder->emergency_call_list['phone']['type'][3])) ? $workorder->emergency_call_list['phone']['type'][3] : '' ?></span> <span
                                                            class="caret"></span></button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="mobile">Mobile</a></li>
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="home">Home</a></li>
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="work">Work</a></li>
                                                </ul>
                                            </span>
                                            <input type="hidden" name="1st_number_type[]"
                                                   class="type-input"
                                                   value="<?php echo (!empty($workorder->emergency_call_list['phone']['type'][3])) ? $workorder->emergency_call_list['phone']['type'][3] : '' ?>"
                                                   value="mobile"/>
                                            <input type="text" name="1st_number[]"
                                                   class="form-control"
                                                   value="<?php echo (!empty($workorder->emergency_call_list['phone']['number'][3])) ? $workorder->emergency_call_list['phone']['number'][3] : '' ?>"
                                                   placeholder="Enter Phone"/>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                        <label for="emergency_call_relation" class="label-element">Relation <small class="help help-sm">(optional)</small></label>
                                                <select name="1st_relation[]" id="4th_relation" class="form-control custom-select m_select">
                                                    <option value="">Choose Relation</option>
                                                    <option value="Owner">Owner</option>
                                                    <option value="Relative">Relative</option>
                                                    <option value="Employee">Employee</option>
                                                    <option value="Friend">Friend</option>
                                                    <option value="Manager">Manager</option>
                                                    <option value="On-site">On-site</option>
                                                    <option value="Neighbor">Neighbor</option>
                                                    <option value="Resident">Resident</option>
                                                    <option value="Maintenance">Maintenance</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                </div>

                                    <?php } elseif($count == 2){ ?>
                                <div class="col-md-4 form-group">
                                        <label for="emergency_call_emergency_contact_1" class="label-element">3rd Call Verification Name <small class="help help-sm">(optional)</small></label>
                                        <input type="text" class="form-control input-element"
                                               name="1st_verification_name[]"
                                               id="emergency_call_emergency_contact_1"
                                               value="<?php echo (!empty($workorder->emergency_call_list['emergency_contact_1'])) ? $workorder->emergency_call_list['emergency_contact_1'] : '' ?>"
                                                placeholder="Enter Emergency Contact"/>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contact_phone" class="mobile_view">Phone Number <small class="help help-sm">(optional)</small></label>
                                        <div class="input-group phone-input">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"><span
                                                            class="type-text"><?php echo (!empty($workorder->emergency_call_list['phone']['type'][2])) ? $workorder->emergency_call_list['phone']['type'][2] : '' ?></span> <span
                                                            class="caret"></span></button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="mobile">Mobile</a></li>
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="home">Home</a></li>
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="work">Work</a></li>
                                                </ul>
                                            </span>
                                            <input type="hidden" name="1st_number_type[]"
                                                   class="type-input"
                                                   value="<?php echo (!empty($workorder->emergency_call_list['phone']['type'][2])) ? $workorder->emergency_call_list['phone']['type'][2] : '' ?>"
                                                   value="mobile"/>
                                            <input type="text" name="1st_number[]"
                                                   class="form-control"
                                                   value="<?php echo (!empty($workorder->emergency_call_list['phone']['number'][2])) ? $workorder->emergency_call_list['phone']['number'][2] : '' ?>"
                                                   placeholder="Enter Phone"/>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                        <label for="emergency_call_relation" class="label-element">Relation <small class="help help-sm">(optional)</small></label>
                                                <select name="1st_relation[]" id="3rd_relation" class="form-control custom-select m_select">
                                                    <option value="">Choose Relation</option>
                                                    <option value="Owner">Owner</option>
                                                    <option value="Relative">Relative</option>
                                                    <option value="Employee">Employee</option>
                                                    <option value="Friend">Friend</option>
                                                    <option value="Manager">Manager</option>
                                                    <option value="On-site">On-site</option>
                                                    <option value="Neighbor">Neighbor</option>
                                                    <option value="Resident">Resident</option>
                                                    <option value="Maintenance">Maintenance</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                </div>

                                <div class="col-md-4 form-group">
                                        <label for="emergency_call_emergency_contact_2" class="label-element">4th Call Verification Name <small class="help help-sm">(optional)</small></label>
                                        <input type="text" class="form-control input-element"
                                               name="1st_verification_name[]"
                                               id="emergency_call_emergency_contact_2"
                                               value="<?php echo (!empty($workorder->emergency_call_list['emergency_contact_2'])) ? $workorder->emergency_call_list['emergency_contact_2'] : '' ?>"
                                                placeholder="Enter Emergency Contact"/>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contact_phone" class="mobile_view">Phone Number <small class="help help-sm">(optional)</small></label>
                                        <div class="input-group phone-input">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"><span
                                                            class="type-text"><?php echo (!empty($workorder->emergency_call_list['phone']['type'][3])) ? $workorder->emergency_call_list['phone']['type'][3] : '' ?></span> <span
                                                            class="caret"></span></button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="mobile">Mobile</a></li>
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="home">Home</a></li>
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="work">Work</a></li>
                                                </ul>
                                            </span>
                                            <input type="hidden" name="1st_number_type[]"
                                                   class="type-input"
                                                   value="<?php echo (!empty($workorder->emergency_call_list['phone']['type'][3])) ? $workorder->emergency_call_list['phone']['type'][3] : '' ?>"
                                                   value="mobile"/>
                                            <input type="text" name="1st_number[]"
                                                   class="form-control"
                                                   value="<?php echo (!empty($workorder->emergency_call_list['phone']['number'][3])) ? $workorder->emergency_call_list['phone']['number'][3] : '' ?>"
                                                   placeholder="Enter Phone"/>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                        <label for="emergency_call_relation" class="label-element">Relation <small class="help help-sm">(optional)</small></label>
                                                <select name="1st_relation[]" id="4th_relation" class="form-control custom-select m_select">
                                                    <option value="">Choose Relation</option>
                                                    <option value="Owner">Owner</option>
                                                    <option value="Relative">Relative</option>
                                                    <option value="Employee">Employee</option>
                                                    <option value="Friend">Friend</option>
                                                    <option value="Manager">Manager</option>
                                                    <option value="On-site">On-site</option>
                                                    <option value="Neighbor">Neighbor</option>
                                                    <option value="Resident">Resident</option>
                                                    <option value="Maintenance">Maintenance</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                </div>
                                        <?php } elseif($count == 3){ ?>

                                            
                                <div class="col-md-4 form-group">
                                        <label for="emergency_call_emergency_contact_2" class="label-element">4th Call Verification Name <small class="help help-sm">(optional)</small></label>
                                        <input type="text" class="form-control input-element"
                                               name="1st_verification_name[]"
                                               id="emergency_call_emergency_contact_2"
                                               value="<?php echo (!empty($workorder->emergency_call_list['emergency_contact_2'])) ? $workorder->emergency_call_list['emergency_contact_2'] : '' ?>"
                                                placeholder="Enter Emergency Contact"/>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contact_phone" class="mobile_view">Phone Number <small class="help help-sm">(optional)</small></label>
                                        <div class="input-group phone-input">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"><span
                                                            class="type-text"><?php echo (!empty($workorder->emergency_call_list['phone']['type'][3])) ? $workorder->emergency_call_list['phone']['type'][3] : '' ?></span> <span
                                                            class="caret"></span></button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="mobile">Mobile</a></li>
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="home">Home</a></li>
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="work">Work</a></li>
                                                </ul>
                                            </span>
                                            <input type="hidden" name="1st_number_type[]"
                                                   class="type-input"
                                                   value="<?php echo (!empty($workorder->emergency_call_list['phone']['type'][3])) ? $workorder->emergency_call_list['phone']['type'][3] : '' ?>"
                                                   value="mobile"/>
                                            <input type="text" name="1st_number[]"
                                                   class="form-control"
                                                   value="<?php echo (!empty($workorder->emergency_call_list['phone']['number'][3])) ? $workorder->emergency_call_list['phone']['number'][3] : '' ?>"
                                                   placeholder="Enter Phone"/>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                        <label for="emergency_call_relation" class="label-element">Relation <small class="help help-sm">(optional)</small></label>
                                                <select name="1st_relation[]" id="4th_relation" class="form-control custom-select m_select">
                                                    <option value="">Choose Relation</option>
                                                    <option value="Owner">Owner</option>
                                                    <option value="Relative">Relative</option>
                                                    <option value="Employee">Employee</option>
                                                    <option value="Friend">Friend</option>
                                                    <option value="Manager">Manager</option>
                                                    <option value="On-site">On-site</option>
                                                    <option value="Neighbor">Neighbor</option>
                                                    <option value="Resident">Resident</option>
                                                    <option value="Maintenance">Maintenance</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                </div>

                                            <?php }elseif($count == 0){ ?>
                                <div class="col-md-4 form-group">
                                        <label for="1st_call_verification_name" class="label-element">1st Call Verification Name <small class="help help-sm">(optional)</small></label>
                                        <input type="text" class="form-control input-element"
                                               name="1st_verification_name[]"
                                               value="<?php echo (!empty($workorder->emergency_call_list['1st_call_verification_name'])) ? $workorder->emergency_call_list['1st_call_verification_name'] : '' ?>"
                                               id="1st_call_verification_name"
                                                placeholder="Enter 1st Call Verification Name"/>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contact_phone" class="mobile_view">Phone Number <small class="help help-sm">(optional)</small></label>
                                        <div class="input-group phone-input">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"><span
                                                            class="type-text"><?php echo (!empty($workorder->emergency_call_list['phone']['type'][0])) ? $workorder->emergency_call_list['phone']['type'][0] : '' ?></span> <span
                                                            class="caret"></span></button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="mobile">Mobile</a></li>
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="home">Home</a></li>
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="work">Work</a></li>
                                                </ul>
                                            </span>
                                            <input type="hidden" name="1st_number_type[]"
                                                   class="type-input"
                                                   value="<?php echo (!empty($workorder->emergency_call_list['phone']['type'][0])) ? $workorder->emergency_call_list['phone']['type'][0] : '' ?>"
                                                   value="mobile"/>
                                            <input type="text" name="1st_number[]"
                                                   class="form-control"
                                                   value="<?php echo (!empty($workorder->emergency_call_list['phone']['number'][0])) ? $workorder->emergency_call_list['phone']['number'][0] : '' ?>"
                                                   placeholder="Enter Phone"/>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                        <label for="emergency_call_relation" class="label-element">Relation <small class="help help-sm">(optional)</small></label>
                                                <select name="1st_relation[]" id="1st_relation" class="form-control custom-select m_select">
                                                    <option value="">Choose Relation</option>
                                                    <option value="Owner">Owner</option>
                                                    <option value="Relative">Relative</option>
                                                    <option value="Employee">Employee</option>
                                                    <option value="Friend">Friend</option>
                                                    <option value="Manager">Manager</option>
                                                    <option value="On-site">On-site</option>
                                                    <option value="Neighbor">Neighbor</option>
                                                    <option value="Resident">Resident</option>
                                                    <option value="Maintenance">Maintenance</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                </div>

                                <div class="col-md-4 form-group">
                                        <label for="" class="label-element">2nd Call Verification Name <small class="help help-sm">(optional)</small></label>
                                        <input type="text" class="form-control input-element"
                                               name="1st_verification_name[]"
                                               id="2nd_call_verification_name"
                                               value="<?php echo (!empty($workorder->emergency_call_list['2nd_call_verification_name'])) ? $workorder->emergency_call_list['2nd_call_verification_name'] : '' ?>"
                                                placeholder="Enter 2nd Call Verification Name"/>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contact_phone" class="mobile_view">Phone Number <small class="help help-sm">(optional)</small></label>
                                        <div class="input-group phone-input">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"><span
                                                            class="type-text"><?php echo (!empty($workorder->emergency_call_list['phone']['type'][1])) ? $workorder->emergency_call_list['phone']['type'][1] : '' ?></span> <span
                                                            class="caret"></span></button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="mobile">Mobile</a></li>
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="home">Home</a></li>
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="work">Work</a></li>
                                                </ul>
                                            </span>
                                            <input type="hidden" name="1st_number_type[]"
                                                   class="type-input"
                                                   value="<?php echo (!empty($workorder->emergency_call_list['phone']['type'][1])) ? $workorder->emergency_call_list['phone']['type'][1] : '' ?>"
                                                   value="mobile"/>
                                            <input type="text" name="1st_number[]"
                                                   class="form-control"
                                                   value="<?php echo (!empty($workorder->emergency_call_list['phone']['number'][1])) ? $workorder->emergency_call_list['phone']['number'][1] : '' ?>"
                                                   placeholder="Enter Phone"/>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                        <label for="emergency_call_relation" class="label-element">Relation <small class="help help-sm">(optional)</small></label>
                                                <select name="1st_relation[]" id="2nd_relation" class="form-control custom-select m_select">
                                                    <option value="">Choose Relation</option>
                                                    <option value="Owner">Owner</option>
                                                    <option value="Relative">Relative</option>
                                                    <option value="Employee">Employee</option>
                                                    <option value="Friend">Friend</option>
                                                    <option value="Manager">Manager</option>
                                                    <option value="On-site">On-site</option>
                                                    <option value="Neighbor">Neighbor</option>
                                                    <option value="Resident">Resident</option>
                                                    <option value="Maintenance">Maintenance</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                </div>

                                <div class="col-md-4 form-group">
                                        <label for="emergency_call_emergency_contact_1" class="label-element">3rd Call Verification Name <small class="help help-sm">(optional)</small></label>
                                        <input type="text" class="form-control input-element"
                                               name="1st_verification_name[]"
                                               id="emergency_call_emergency_contact_1"
                                               value="<?php echo (!empty($workorder->emergency_call_list['emergency_contact_1'])) ? $workorder->emergency_call_list['emergency_contact_1'] : '' ?>"
                                                placeholder="Enter Emergency Contact"/>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contact_phone" class="mobile_view">Phone Number <small class="help help-sm">(optional)</small></label>
                                        <div class="input-group phone-input">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"><span
                                                            class="type-text"><?php echo (!empty($workorder->emergency_call_list['phone']['type'][2])) ? $workorder->emergency_call_list['phone']['type'][2] : '' ?></span> <span
                                                            class="caret"></span></button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="mobile">Mobile</a></li>
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="home">Home</a></li>
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="work">Work</a></li>
                                                </ul>
                                            </span>
                                            <input type="hidden" name="1st_number_type[]"
                                                   class="type-input"
                                                   value="<?php echo (!empty($workorder->emergency_call_list['phone']['type'][2])) ? $workorder->emergency_call_list['phone']['type'][2] : '' ?>"
                                                   value="mobile"/>
                                            <input type="text" name="1st_number[]"
                                                   class="form-control"
                                                   value="<?php echo (!empty($workorder->emergency_call_list['phone']['number'][2])) ? $workorder->emergency_call_list['phone']['number'][2] : '' ?>"
                                                   placeholder="Enter Phone"/>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                        <label for="emergency_call_relation" class="label-element">Relation <small class="help help-sm">(optional)</small></label>
                                                <select name="1st_relation[]" id="3rd_relation" class="form-control custom-select m_select">
                                                    <option value="">Choose Relation</option>
                                                    <option value="Owner">Owner</option>
                                                    <option value="Relative">Relative</option>
                                                    <option value="Employee">Employee</option>
                                                    <option value="Friend">Friend</option>
                                                    <option value="Manager">Manager</option>
                                                    <option value="On-site">On-site</option>
                                                    <option value="Neighbor">Neighbor</option>
                                                    <option value="Resident">Resident</option>
                                                    <option value="Maintenance">Maintenance</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                </div>

                                <div class="col-md-4 form-group">
                                        <label for="emergency_call_emergency_contact_2" class="label-element">4th Call Verification Name <small class="help help-sm">(optional)</small></label>
                                        <input type="text" class="form-control input-element"
                                               name="1st_verification_name[]"
                                               id="emergency_call_emergency_contact_2"
                                               value="<?php echo (!empty($workorder->emergency_call_list['emergency_contact_2'])) ? $workorder->emergency_call_list['emergency_contact_2'] : '' ?>"
                                                placeholder="Enter Emergency Contact"/>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contact_phone" class="mobile_view">Phone Number <small class="help help-sm">(optional)</small></label>
                                        <div class="input-group phone-input">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"><span
                                                            class="type-text"><?php echo (!empty($workorder->emergency_call_list['phone']['type'][3])) ? $workorder->emergency_call_list['phone']['type'][3] : '' ?></span> <span
                                                            class="caret"></span></button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="mobile">Mobile</a></li>
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="home">Home</a></li>
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="work">Work</a></li>
                                                </ul>
                                            </span>
                                            <input type="hidden" name="1st_number_type[]"
                                                   class="type-input"
                                                   value="<?php echo (!empty($workorder->emergency_call_list['phone']['type'][3])) ? $workorder->emergency_call_list['phone']['type'][3] : '' ?>"
                                                   value="mobile"/>
                                            <input type="text" name="1st_number[]"
                                                   class="form-control"
                                                   value="<?php echo (!empty($workorder->emergency_call_list['phone']['number'][3])) ? $workorder->emergency_call_list['phone']['number'][3] : '' ?>"
                                                   placeholder="Enter Phone"/>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                        <label for="emergency_call_relation" class="label-element">Relation <small class="help help-sm">(optional)</small></label>
                                                <select name="1st_relation[]" id="4th_relation" class="form-control custom-select m_select">
                                                    <option value="">Choose Relation</option>
                                                    <option value="Owner">Owner</option>
                                                    <option value="Relative">Relative</option>
                                                    <option value="Employee">Employee</option>
                                                    <option value="Friend">Friend</option>
                                                    <option value="Manager">Manager</option>
                                                    <option value="On-site">On-site</option>
                                                    <option value="Neighbor">Neighbor</option>
                                                    <option value="Resident">Resident</option>
                                                    <option value="Maintenance">Maintenance</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                </div>
                                                <?php } ?>

                                <!-- <div class="col-md-4 form-group">
                                        <label for="2nd_call_verification_name" class="label-element">2nd Call Verification Name</label>
                                        <input type="text" class="form-control input-element"
                                               name="2nd_verification_name"
                                               id="2nd_call_verification_name"
                                               value="<?php echo $workorder->second_verification_name; ?>"
                                               placeholder="Enter 2nd Call Verification Name"/>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contact_phone" class="mobile_view">Phone Number</label>
                                        <div class="input-group phone-input">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"><span
                                                            class="type-text"><?php echo (!empty($workorder->emergency_call_list['phone']['type'][1])) ? $workorder->emergency_call_list['phone']['type'][1] : '' ?></span> <span
                                                            class="caret"></span></button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="mobile">Mobile</a></li>
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="home">Home</a></li>
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="work">Work</a></li>
                                                </ul>
                                            </span>
                                            <input type="hidden" name="2nd_number_type"
                                                   class="type-input"
                                                   value="<?php echo $workorder->second_number_type; ?>"
                                                   value="mobile"/>
                                            <input type="text" name="2nd_number"
                                                   class="form-control"
                                                   value="<?php echo $workorder->second_number; ?>"
                                                   placeholder="Enter Phone"/>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                        <label for="emergency_call_relation" class="label-element">Relation</label>

                                                <select name="2nd_relation" id="2nd_relation" class="form-control custom-select m_select">
                                                    <option value="<?php echo $workorder->second_relation; ?>"><?php echo $workorder->second_relation; ?></option>
                                                    <option value="Owner">Owner</option>
                                                    <option value="Relative">Relative</option>
                                                    <option value="Employee">Employee</option>
                                                    <option value="Friend">Friend</option>
                                                    <option value="Manager">Manager</option>
                                                    <option value="On-site">On-site</option>
                                                    <option value="Neighbor">Neighbor</option>
                                                    <option value="Resident">Resident</option>
                                                    <option value="Maintenance">Maintenance</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                </div>

                                <div class="col-md-4 form-group">
                                        <label for="emergency_call_emergency_contact_1" class="label-element">3rd Call Verification Name</label>
                                        <input type="text" class="form-control input-element"
                                               name="3rd_verification_name"
                                               id="emergency_call_emergency_contact_1"
                                               value="<?php echo $workorder->third_verification_name; ?>"
                                                placeholder="Enter Emergency Contact"/>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contact_phone" class="mobile_view">Phone Number</label>
                                        <div class="input-group phone-input">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"><span
                                                            class="type-text"><?php echo (!empty($workorder->emergency_call_list['phone']['type'][2])) ? $workorder->emergency_call_list['phone']['type'][2] : '' ?></span> <span
                                                            class="caret"></span></button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="mobile">Mobile</a></li>
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="home">Home</a></li>
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="work">Work</a></li>
                                                </ul>
                                            </span>
                                            <input type="hidden" name="3rd_number_type"
                                                   class="type-input"
                                                   value="<?php echo $workorder->third_number_type; ?>"
                                                   value="mobile"/>
                                            <input type="text" name="3rd_number"
                                                   class="form-control"
                                                   value="<?php echo $workorder->third_number; ?>"
                                                   placeholder="Enter Phone"/>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                        <label for="emergency_call_relation" class="label-element">Relation</label>
                                                <select name="3rd_relation" id="3rd_relation" class="form-control custom-select m_select">
                                                    <option value="<?php echo $workorder->third_relation; ?>"><?php echo $workorder->third_relation; ?></option>
                                                    <option value="Owner">Owner</option>
                                                    <option value="Relative">Relative</option>
                                                    <option value="Employee">Employee</option>
                                                    <option value="Friend">Friend</option>
                                                    <option value="Manager">Manager</option>
                                                    <option value="On-site">On-site</option>
                                                    <option value="Neighbor">Neighbor</option>
                                                    <option value="Resident">Resident</option>
                                                    <option value="Maintenance">Maintenance</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                </div>

                                <div class="col-md-4 form-group">
                                        <label for="emergency_call_emergency_contact_2" class="label-element">4th Call Verification Name</label>
                                        <input type="text" class="form-control input-element"
                                               name="4th_verification_name"
                                               id="emergency_call_emergency_contact_2"
                                               value="<?php echo $workorder->fourth_verification_name; ?>"
                                                placeholder="Enter Emergency Contact"/>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contact_phone" class="mobile_view">Phone Number</label>
                                        <div class="input-group phone-input">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"><span
                                                            class="type-text"><?php echo (!empty($workorder->emergency_call_list['phone']['type'][3])) ? $workorder->emergency_call_list['phone']['type'][3] : '' ?></span> <span
                                                            class="caret"></span></button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="mobile">Mobile</a></li>
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="home">Home</a></li>
                                                    <li><a class="changePhoneType" href="javascript:;"
                                                           data-type-value="work">Work</a></li>
                                                </ul>
                                            </span>
                                            <input type="hidden" name="4th_number_type"
                                                   class="type-input"
                                                   value="<?php echo $workorder->fourth_number_type; ?>"
                                                   value="mobile"/>
                                            <input type="text" name="4th_number"
                                                   class="form-control"
                                                   value="<?php echo $workorder->fourth_number; ?>"
                                                   placeholder="Enter Phone"/>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                        <label for="emergency_call_relation" class="label-element">Relation</label>

                                                <select name="4th_relation" id="4th_relation" class="form-control custom-select m_select">
                                                    <option value="<?php echo $workorder->fourth_relation; ?>"><?php echo $workorder->fourth_relation; ?></option>
                                                    <option value="Owner">Owner</option>
                                                    <option value="Relative">Relative</option>
                                                    <option value="Employee">Employee</option>
                                                    <option value="Friend">Friend</option>
                                                    <option value="Manager">Manager</option>
                                                    <option value="On-site">On-site</option>
                                                    <option value="Neighbor">Neighbor</option>
                                                    <option value="Resident">Resident</option>
                                                    <option value="Maintenance">Maintenance</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                </div> -->
                            </div>

                            <!-- ====== CUSTOMER ACCOUNT INFORMATION ====== -->
                            <div class="row" id="group_area">
                                <div class="form-group col-md-12">
                                    <h5 class="box-title">Customer System Information</h5>
                                </div>
                                <div class="col-md-6 form-group">
                                <div class="select-wrap">
                                    <label for="street_address"> Plan Type:</label><span class="form-required">*</span>
                                        <!-- <select
                                                name="plan_type"
                                                id="plan_type"
                                                class="form-control">
                                            <option>Select Plan Type</option>
                                        </select> -->
                                        <select name="plan_type" id="plan_types" class="form-control custom-select m_select">
                                            <!-- <option value="<?php //echo $workorder->plan_type; ?>"><?php //echo $workorder->plan_type; ?></option> -->
                                            <option <?php if(isset($workorder)){ if($workorder->plan_type == 'DIGI'){echo "selected";} } ?> value="DIGI">Landline</option>
                                            <option <?php if(isset($workorder)){ if($workorder->plan_type == 'DW2W'){echo "selected";} } ?> value="DW2W">Landline W/ 2-Way</option>
                                            <option <?php if(isset($workorder)){ if($workorder->plan_type == 'DWCB'){echo "selected";} } ?> value="DWCB">Landline W/ Cell Backup</option>
                                            <option <?php if(isset($workorder)){ if($workorder->plan_type == 'D2CB'){echo "selected";} } ?> value="D2CB">Landline W/ 2-Way &amp; Cell Backup</option>
                                            <option <?php if(isset($workorder)){ if($workorder->plan_type == 'CPDB'){echo "selected";} } ?> value="CPDB">Cell Primary</option>
                                            <option <?php if(isset($workorder)){ if($workorder->plan_type == 'CP2W'){echo "selected";} } ?> value="CP2W">Cell Primary w/2Way</option>
                                            <option <?php if(isset($workorder)){ if($workorder->plan_type == 'WSF'){echo "selected";} } ?> value="WSF">Wireless Signal Forwarding</option>
                                            <option <?php if(isset($workorder)){ if($workorder->plan_type == 'C'){echo "selected";} } ?> value="C">Commercial</option>
                                            <option <?php if(isset($workorder)){ if($workorder->plan_type == 'CP'){echo "selected";} } ?> value="CP">Commercial Plus</option>
                                            <option <?php if(isset($workorder)){ if($workorder->plan_type == 'I'){echo "selected";} } ?> value="I">Interactive</option>
                                            <option <?php if(isset($workorder)){ if($workorder->plan_type == 'IG'){echo "selected";} } ?> value="IG">Interactive Gold</option>
                                            <option <?php if(isset($workorder)){ if($workorder->plan_type == 'IPA'){echo "selected";} } ?> value="IPA">Interactive Plus Automation</option>
                                            <option <?php if(isset($workorder)){ if($workorder->plan_type == 'IwDVR'){echo "selected";} } ?> value="IwDVR">Interactive w/DVR</option>
                                            <option <?php if(isset($workorder)){ if($workorder->plan_type == 'IwDB'){echo "selected";} } ?> value="IwDB">Interactive w/Dbell</option>
                                            <option <?php if(isset($workorder)){ if($workorder->plan_type == 'IwDBIP'){echo "selected";} } ?> value="IwDBIP">Interactive w/Dbell & IP Camera</option>
                                            <option <?php if(isset($workorder)){ if($workorder->plan_type == 'PERS'){echo "selected";} } ?> value="PERS">PERS</option>
                                            <option <?php if(isset($workorder)){ if($workorder->plan_type == 'WIFI'){echo "selected";} } ?> value="WIFI">WIFI</option>
                                            <option <?php if(isset($workorder)){ if($workorder->plan_type == 'CPwWIFI'){echo "selected";} } ?> value="CPwWIFI">Cell Primary w/WIFI</option>
                                            <option <?php if(isset($workorder)){ if($workorder->plan_type == 'CPwAC'){echo "selected";} } ?> value="CPwAC">Cell Primary w/Access Control</option>
                                            <option <?php if(isset($workorder)){ if($workorder->plan_type == 'IwAC'){echo "selected";} } ?> value="IwAC">Interactive w/Access Control</option>
                                            <option <?php if(isset($workorder)){ if($workorder->plan_type == 'IwACwA'){echo "selected";} } ?> value="IwACwA">Interactive w/Access Control w/Automn</option>
                                        </select>
                                </div>
                                </div>
                                <div class="form-group col-md-6">
                                <div class="select-wrap">
                                    <!-- <div class="col-md-12"> -->
                                        <label>Account Type</label><span class="form-required">*</span>
                                    <!-- </div> -->
                                    <!-- <div class="col-md-12"> -->
                                        <select name="account_type"
                                                class="form-control custom-select m_select"
                                                id="account_type" >
                                                <option value="<?php echo $workorder->account_type; ?>"><?php echo $workorder->account_type; ?></option>
                                            <?php foreach (get_config_item('account_types') as $key => $account_type) { ?>
                                                <option value="<?php echo $account_type ?>"
                                                    <?php echo (!empty($workorder->account_type['name'])
                                                        && $workorder->account_type['name'] == $account_type) ?
                                                        "selected" : "" ?>>
                                                    <?php echo $account_type ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    <!-- </div> -->

                                </div>
                                </div>

                                    <!-- ====== EQUIPMENT ====== -->
                                <!-- <div class="row"> -->
                                    <div class="col-md-4">
                                    <div class="select-wrap">
                                        <label>Panel Type</label><span class="form-required">*</span>
                                        <select name="panel_type" id="panel_type" class="form-control custom-select m_select" >
                                            <option value="<?php echo $workorder->panel_type; ?>"><?php echo $workorder->panel_type; ?></option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'AERIONICS'){echo "selected";} } ?> value="AERIONICS">AERIONICS</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'AlarmNet'){echo "selected";} } ?> value="AlarmNet">AlarmNet</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Alarm.com'){echo "selected";} } ?> value="Alarm.com">Alarm.com</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Alula'){echo "selected";} } ?> value="Alula">Alula</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Bosch'){echo "selected";} } ?> value="Bosch">Bosch</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'DSC'){echo "selected";} } ?> value="DSC">DSC</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'ELK'){echo "selected";} } ?> value="ELK">ELK</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'FBI'){echo "selected";} } ?> value="FBI">FBI</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'GRI'){echo "selected";} } ?> value="GRI">GRI</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'GE'){echo "selected";} } ?> value="GE">GE</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Honeywell'){echo "selected";} } ?> value="Honeywell">Honeywell</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Honeywell'){echo "selected";} } ?> value="Honeywell Touch">Honeywell Touch</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Honeywell'){echo "selected";} } ?> value="Honeywell 3000">Honeywell 3000</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Honeywell'){echo "selected";} } ?> value="Honeywell Vista">Honeywell Vista</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Honeywell'){echo "selected";} } ?> value="Honeywell Vista with Sem">Honeywell Vista with Sem</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Honeywell'){echo "selected";} } ?> value="Honeywell Lyric">Honeywell Lyric</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'IEI'){echo "selected";} } ?> value="IEI">IEI</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'MIER'){echo "selected";} } ?> value="MIER">MIER</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == '2 GIG'){echo "selected";} } ?> value="2 GIG">2 GIG</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == '2 GIG'){echo "selected";} } ?> value="2 GIG Go Panel 2">2 GIG Go Panel 2</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == '2 GIG'){echo "selected";} } ?> value="2 GIG Go Panel 3">2 GIG Go Panel 3</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Qolsys'){echo "selected";} } ?> value="Qolsyx">Qolsys</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Qolsys'){echo "selected";} } ?> value="Qolsyx">Qolsys IQ Panel 2</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'QIP2P'){echo "selected";} } ?> value="QIP2P">Qolsys IQ Panel 2 Plus</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Qolsys'){echo "selected";} } ?> value="">Qolsys IQ Panel 3</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Custom'){echo "selected";} } ?> value="Custom">Custom</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'DIGI'){echo "selected";} } ?> value="Other">Other</option>
                                        </select>

                                    </div>
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <!-- <div class="form-group"> -->
                                            <label for="panel_location" class="label-element"> Panel Location:</label>
                                            <input type="text" class="form-control input-element" name="panel_location"
                                                value="<?php echo $workorder->panel_location; ?>"
                                                id="panel_location" placeholder=""/>
                                        <!-- </div> -->
                                    </div>
                                    <div class="col-md-4 form-group">
                                    <div class="select-wrap">
                                        <!-- <div class="form-group"> -->
                                            <label for="panel_communication"> Panel Communication:</label>
                                            <select name="panel_communication"
                                                    class="form-control custom-select m_select"
                                                    id="panel_communication">
                                                    <option value="<?php echo $workorder->panel_communication; ?>"><?php echo $workorder->panel_communication; ?></option>
                                                <?php foreach (get_config_item('panel_communications') as $key => $panel_communication) { ?>
                                                    <option value="<?php echo $panel_communication ?>" <?php echo (!empty($workorder->panel_communication) && $workorder->panel_communication == $panel_communication) ? 'selected' : '' ?>>
                                                        <?php echo $panel_communication ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        <!-- </div> -->
                                    </div>

                                <!-- </div> -->

                                
                            </div>

                            

                            <!-- ====== JOB ====== -->
                            <div class="row" id="group_area">
                                <div class="form-group col-md-12">
                                    <h5 class="box-title">Job</h5>
                                </div>
                                <div class="col-md-4 form-group">
                                    <!-- <div class=""> -->
                                        <label for="date_w_issued" class="label-element"> Requested Date:</label>
                                        <!-- <div class='input-group date datepicker'> -->
                                            <input type="text"
                                                   name="date_issued"
                                                   class="form-control input-element"
                                                   value="<?php echo $workorder->date_issued; ?>"
                                                   id="datepicker_dateissued"/>
                                        <!-- </div> -->
                                    <!-- </div> -->
                                </div>

                                <div class="col-md-4 form-group">
                                <div class="select-wrap">
                                    <label for="job_name" class="label-element">Job Name</label>
                                    <input type="text" class="form-control input-element" name="job_name" id="job_name" />
                                </div>
                                </div>

                                <div class="col-md-4 form-group">
                                <div class="select-wrap">
                                        <label for="job_desc" class="label-element">Job Description</label>
                                        <textarea name="job_description" id="job_desc" cols="5" rows="2" class="form-control input-element"></textarea> 
                                </div>                                           
                                </div>

                                <div class="col-md-4 form-group">
                                <div class="select-wrap">
                                    <!-- <div class=""> -->
                                        <label for="job_type_id"> Job Type:</label>
                                        <select name="job_type" id="job_type" class="form-control custom-select m_select">
                                        <option value="<?php echo $workorder->job_type; ?>"><?php echo $workorder->job_type; ?></option>
                                    <?php foreach($job_types as $jt){ ?>
                                        <option value="<?php echo $jt->title ?>"><?php echo $jt->title ?></option>

                                    <?php } ?>
                                        <!-- <option value="Service">Service</option>
                                        <option value="Design">Design</option>
                                        <option value="Maintenance">Maintenance</option>
                                        <option value="Repair">Repair</option>
                                        <option value="Replace">Replace</option> -->
                                    </select>
                                    <!-- </div> -->
                                </div>
                                </div>
                                
                                <div class="col-md-4 form-group">
                                <div class="select-wrap">
                                    <!-- <div class="form-group"> -->
                                        <label for="job_type_id">Job Tag</label>
                                        <select name="job_tag" id="job_tag" class="form-control custom-select m_select">
                                        <option value="<?php echo $workorder->tags; ?>"><?php echo $workorder->tags; ?></option>
                                        <?php foreach($job_tags as $tags){ ?>
                                                <option value="<?php echo $tags->name; ?>"><?php echo $tags->name; ?></option>
                                            <?php } ?>
                                    </select>
                                    <!-- </div> -->
                                </div>
                                </div>
                                

                                <div class="col-md-4 form-group">
                                <div class="select-wrap">
                                    <!-- <div class=""> -->
                                        <label for="status_id"> Status:</label>
                                        <select name="status" id="workorder_status" class="form-control custom-select m_select">
                                        <option value="<?php echo $workorder->w_status; ?>"><?php echo $workorder->w_status; ?></option>
                                        <option value="New">New</option>
                                        <option value="Draft">Draft</option>
                                        <option value="Scheduled">Scheduled</option>
                                        <option value="Started">Started</option>
                                        <option value="Paused">Paused</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Invoiced">Invoiced</option>
                                        <option value="Withdrawn">Withdrawn</option>
                                        <option value="Closed">Closed</option>
                                    </select>
                                    <!-- </div> -->
                                </div>
                                </div>

                                <div class="col-md-4 form-group">
                                <div class="select-wrap">
                                    <!-- <div class=""> -->
                                        <label for="job_priority"> Priority:</label> 
                                        <select name="priority" id="workorder_priority" class="form-control custom-select m_select">
                                        <option value="<?php echo $workorder->priority; ?>"><?php echo $workorder->priority; ?></option>
                                        <option value="Standard">Standard</option>
                                        <option value="Emergency">Emergency</option>
                                        <option value="Low">Low</option>
                                        <option value="Urgent">Urgent</option>                
                                    </select>
                                    <!-- </div> -->
                                </div>
                                </div>
                                    <div class="form-group col-md-4">
                                    <div class="select-wrap">
                                        <label for="lead_source">Lead Source</label>
                                        <select id="lead_source" name="lead_source" class="form-control custom-select m_select">
                                            <option value="0">- none -</option>
                                            <?php foreach($lead_source as $lead){ ?>
                                            <option <?php if(isset($workorder)){ if($workorder->lead_source_id == $lead->ls_id){echo "selected";} } ?> value="<?php echo $lead->ls_id; ?>"><?php echo $lead->ls_name; ?></option>
                                        <?php } ?>
                                        </select>
                                    </div>    
                                    </div>    

                            </div>
                            
                            <!-- ====== ENHANCED SERVICES ====== -->
                            <div class="row" id="group_area" style="margin-left:10px;">
                                <div class="form-group col-md-12"><br>
                                    <h5 class="box-title">Enhanced Services</h5>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="panel-group">
                                        <div class="panels panel-default">
                                            <div class="panel-heading">
                                                <h6 class="panel-title">
                                                    <a data-toggle="collapse" href="#collapse1">Cameras <i
                                                                class="fa fa-angle-down mobile_view"
                                                                style="font-size: 31px;top: 4px;position: relative;font-weight: bolder;"></i></a>
                                                </h6>
                                            </div>
                                            <div id="collapse1" class="panel-collapse collapse">
                                                <table class="table" style="width:50%;">
                                                    <tr>
                                                        <th></th>
                                                        <th>WO</th>
                                                        <th>WI</th>
                                                        <th>Doorbell Cam</th>
                                                    </tr>
                                                    <tr>
                                                        <td>Honeywell</td>
                                                        <td style="min-width:10%;"><input type="text" class="form-control"
                                                                    name="honeywell_wo"
                                                                    value="<?php echo $cameras->honeywell_wo; ?>"
                                                                    placeholder=""/>
                                                        </td>
                                                        <td style="min-width:80px;"><input type="text" class="form-control"
                                                                    value="<?php echo $cameras->honeywell_wi; ?>"
                                                                    name="honeywell_wi" placeholder=""/>
                                                        </td>
                                                        <td style="min-width:80px;"><input type="text" class="form-control"
                                                                    value="<?php echo $cameras->honeywell_doorbellcam; ?>"
                                                                    name="honeywell_doorbellcam"
                                                                    placeholder=""/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Alarm.com</td>
                                                        <td style="min-width:80px;"><input type="text" class="form-control"
                                                                    value="<?php echo $cameras->alarm_wo; ?>"
                                                                    name="alarm_wo" placeholder=""/>
                                                        </td>
                                                        <td style="min-width:80px;"><input type="text" class="form-control"
                                                                    value="<?php echo $cameras->alarm_wi; ?>"
                                                                    name="alarm_wi" placeholder=""/>
                                                        </td>
                                                        <td style="min-width:80px;"><input type="text" class="form-control"
                                                                    value="<?php echo $cameras->alarm_doorbellcam; ?>"
                                                                    name="alarm_doorbellcam"
                                                                    placeholder=""/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Other</td>
                                                        <td style="min-width:80px;"><input type="text" class="form-control"
                                                                    value="<?php echo $cameras->other_wo; ?>"
                                                                    name="other_wo" placeholder=""/>
                                                        </td>
                                                        <td style="min-width:80px;"><input type="text" class="form-control"
                                                                    value="<?php echo $cameras->other_wi; ?>"
                                                                    name="other_wi" placeholder=""/>
                                                        </td>
                                                        <td style="min-width:80px;"><input type="text" class="form-control"
                                                                    value="<?php echo $cameras->other_doorbellcam; ?>"
                                                                    name="other_doorbellcam"
                                                                    placeholder=""/>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- </div> -->

                                <div class="col-sm-12 col-md-6">
                                    <div class="panel-group">
                                        <div class="panels panel-default">
                                            <div class="panel-heading">
                                                <h6 class="panel-title">
                                                    <a data-toggle="collapse" href="#collapse2">Doorlocks: <i
                                                                class="fa fa-angle-down mobile_view"
                                                                style="font-size: 31px;top: 4px;position: relative;font-weight: bolder;"></i></a>
                                                </h6>
                                            </div>
                                            <div id="collapse2" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <table class="table" style="width:50%;">
                                                        <tr>
                                                            <th></th>
                                                            <th>Brass</th>
                                                            <th>Nickel</th>
                                                            <th>Bronze</th>
                                                        </tr>
                                                        <tr>
                                                            <td>Deadbolt</td>
                                                            <td style="min-width:80px;"><input type="text" class="form-control"
                                                                       name="deadbolt_brass"
                                                                       value="<?php echo $doorlocks->deadbolt_brass; ?>"
                                                                       placeholder=""/>
                                                            </td>
                                                            <td style="min-width:80px;"><input type="text" class="form-control"
                                                                        value="<?php echo $doorlocks->deadbolt_nickel; ?>"
                                                                        name="deadbolt_nickel"
                                                                        placeholder=""/>
                                                            </td>
                                                            <td style="min-width:80px;"><input type="text" class="form-control"
                                                                        value="<?php echo $doorlocks->deadbolt_bronze; ?>"
                                                                        name="deadbolt_bronze"
                                                                        placeholder=""/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Handle</td>
                                                            <td style="min-width:80px;"><input type="text" class="form-control"
                                                                        value="<?php echo $doorlocks->handle_brass; ?>"
                                                                        name="handle_brass" placeholder=""/>
                                                            </td>
                                                            <td style="min-width:80px;"><input type="text" class="form-control"
                                                                        value="<?php echo $doorlocks->handle_nickel; ?>"
                                                                        name="handle_nickel" placeholder=""/>
                                                            </td>
                                                            <td style="min-width:80px;"><input type="text" class="form-control"
                                                                        value="<?php echo $doorlocks->handle_bonze; ?>"
                                                                        name="handle_bonze" placeholder=""/>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <div class="panel-group">
                                        <div class="panels panel-default">
                                            <div class="panel-heading">
                                                <h6 class="panel-title">
                                                    <a data-toggle="collapse" href="#collapse3">DVR <i
                                                                class="fa fa-angle-down mobile_view"
                                                                style="font-size: 31px;top: 4px;position: relative;font-weight: bolder;"></i></a>
                                                </h6>
                                            </div>
                                            <div id="collapse3" class="panel-collapse collapse">
                                                <table class="table" style="width:50%;">
                                                    <tr>
                                                        <th></th>
                                                        <th>4 Channel</th>
                                                        <th>8 Channel</th>
                                                        <th>16 Channel</th>
                                                    </tr>
                                                    <tr>
                                                        <td>Honeywell</td>
                                                        <td><input type="text" class="form-control"
                                                                    value="<?php echo $dvr->honeywell_4ch; ?>"
                                                                    name="honeywell_4ch" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                    value="<?php echo $dvr->honeywell_8ch; ?>"
                                                                   name="honeywell_8ch" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                    value="<?php echo $dvr->honeywell_16ch; ?>"
                                                                   name="honeywell_16ch"
                                                                   placeholder=""/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Alarm.com</td>
                                                        <td><input type="text" class="form-control"
                                                                    value="<?php echo $dvr->alarm_4ch; ?>"
                                                                   name="alarm_4ch" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                    value="<?php echo $dvr->alarm_8ch; ?>"
                                                                   name="alarm_8ch" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                    value="<?php echo $dvr->alarm_16ch; ?>"
                                                                   name="alarm_16ch" placeholder=""/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Other</td>
                                                        <td><input type="text" class="form-control"
                                                                    value="<?php echo $dvr->other_4ch; ?>"
                                                                   name="other_4ch" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                    value="<?php echo $dvr->other_8ch; ?>"
                                                                   name="other_8ch" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                    value="<?php echo $dvr->other_16ch; ?>"
                                                                   name="other_16ch" placeholder=""/>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <div class="panel-group">
                                        <div class="panels panel-default">
                                            <div class="panel-heading">
                                                <h6 class="panel-title">
                                                    <a data-toggle="collapse" href="#collapse4">AUTOMATION <i
                                                                class="fa fa-angle-down mobile_view"
                                                                style="font-size: 31px;top: 4px;position: relative;font-weight: bolder;"></i></a>
                                                </h6>
                                            </div>
                                            <div id="collapse4" class="panel-collapse collapse">
                                                <table class="table" style="width:30%;">
                                                    <tr>
                                                        <!-- <th></th> -->
                                                        <th>Thermostats</th>
                                                        <th>Lights & Bulbs</th>
                                                    </tr>
                                                    <?php foreach($automation as $auto){ ?>
                                                    <tr>
                                                        <!-- <td></td> -->
                                                        <td style="min-width:100px;"><input type="text" class="form-control"
                                                                    value="<?php echo $auto->thermostats; ?>"
                                                                   name="thermostats[]" placeholder=""/>
                                                        </td>
                                                        <td style="min-width:100px;"><input type="text" class="form-control"
                                                                    value="<?php echo $auto->lights_and_bulbs; ?>"
                                                                   name="lights_and_bulbs[]" placeholder=""/>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <div class="panel-group">
                                        <div class="panels panel-default">
                                            <div class="panel-heading">
                                                <h6 class="panel-title">
                                                    <a data-toggle="collapse" href="#collapse5">PERS <i
                                                                class="fa fa-angle-down mobile_view"
                                                                style="font-size: 31px;top: 4px;position: relative;font-weight: bolder;"></i></a>
                                                </h6>
                                            </div>
                                            <div id="collapse5" class="panel-collapse collapse">
                                                <table class="table" style="width:50%;">
                                                    <tr>
                                                        <th></th>
                                                        <th>Fall Detection</th>
                                                        <th>W/O Fall Protection</th>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td style="min-width:100px;"><input type="number" class="form-control"
                                                                    value="<?php echo $pers->fall_detection; ?>"
                                                                   name="fall_detection" placeholder=""/>
                                                        </td>
                                                        <td style="min-width:100px;"><input type="number" class="form-control"
                                                                    value="<?php echo $pers->w_o_fall_protection; ?>"
                                                                   name="w_o_fall_protection" placeholder=""/>
                                                        </td>
                                                    </tr>
                                                    <!-- <tr>
                                                        <td></td>
                                                        <td><input type="text" class="form-control"
                                                                   value="<?php echo (!empty($workorder->pers)) ? $workorder->pers['fall_detection'][1] : '' ?>"
                                                                   name="pers[fall_detection][]" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                   value="<?php echo (!empty($workorder->pers)) ? $workorder->pers['wo_fall_detection'][1] : '' ?>"
                                                                   name="pers[wo_fall_detection][]" placeholder=""/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td><input type="text" class="form-control"
                                                                   value="<?php echo (!empty($workorder->pers)) ? $workorder->pers['fall_detection'][2] : '' ?>"
                                                                   name="pers[fall_detection][]" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                   value="<?php echo (!empty($workorder->pers)) ? $workorder->pers['wo_fall_detection'][2] : '' ?>"
                                                                   name="pers[wo_fall_detection][]" placeholder=""/>
                                                        </td> -->
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>

                            <!-- ====== Additional Equipment/Services ====== -->
                            <div class="row" id="group_area">
                                <div class="form-group col-md-12"><br><br>
                                    <h5 class="box-title">Additional Equipment/Services</h5>
                                </div>
                                <div class=" col-md-12">
                                        <div class="row" id="plansItemDiv">

                                            <div class="col-md-12 table-responsive">
                                                <table class="table table-hover mobile_view_table" >
                                                    <input type="hidden" name="count" value="0" id="count">
                                                    <thead>
                                                    <tr>
                                                        <th>DESCRIPTION</th>
                                                        <th>GROUP</th>
                                                        <th width="100px">Quantity</th>
                                                        <!-- <th>LOCATION</th> -->
                                                        <th width="140px">COST</th>
                                                        <th class="hidden_mobile_view" width="100px">Discount</th>
                                                        <th class="hidden_mobile_view">Tax(%)</th>
                                                        <th class="hidden_mobile_view">Total</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="jobs_items_table_body">
                                                    <?php foreach($items_data as $data){ ?>
                                                        <tr>
                                                            <td width="30%">
                                                            <div class="hidden_mobile_view">
                                                                <input type="text" class="form-control getItems"
                                                                    onKeyup="getItems(this)" name="items[]" value="<?php echo $data->title; ?>">
                                                                <ul class="suggestions"></ul>
                                                                <input type="hidden" name="itemid[]" id="itemid" class="itemid" value="<?php echo $data->items_id; ?>">
                                                            </div>
                                                            <div class="show_mobile_view">
                                                            <?php echo $data->item; ?>
                                                            </div>
                                                            </td>
                                                            <td width="20%">
                                                            <div class="hidden_mobile_view">
                                                            <select name="item_type[]" class="form-control">
                                                                    <option value="product">Product</option>
                                                                    <option value="material">Material</option>
                                                                    <option value="service">Service</option>
                                                                    <option value="fee">Fee</option>
                                                                </select>
                                                            </div>
                                                            <div class="show_mobile_view">
                                                            <?php echo $data->item_type; ?>
                                                            </div>
                                                            </td>
                                                            <td width="10%"><input type="number" class="form-control qtyest2 hidden_mobile_view" name="quantity[]"
                                                                    data-counter="0" data-itemid="<?php echo $data->id; ?>" id="quantity_<?php echo $data->id; ?>" value="<?php echo $data->qty; ?>"><div class="show_mobile_view"><span><?php echo $data->qty; ?></span><input type="hidden" class="form-control quantity" name="quantity[]"
                                                                    data-counter="0" id="quantity_0" value="<?php echo $data->qty; ?>"></div></td>
                                                            <td width="10%"><input type="number" class="form-control price2 hidden_mobile_view" name="price[]"
                                                                    data-counter="0" data-itemid="<?php echo $data->id; ?>" id="price_<?php echo $data->id; ?>" min="0" value="<?php echo $data->iCost; ?>"><input type="hidden" class="priceqty" id="priceqty_<?php echo $data->id; ?>" value="<?php echo $aaa = $data->iCost * $data->qty; ?>"><div class="show_mobile_view"><?php echo $data->iCost; ?></div></td>
                                                            <td class="hidden_mobile_view" width="10%"><input type="number" class="form-control discount" name="discount[]"
                                                                    data-counter="0" id="discount_<?php echo $data->id; ?>" min="0" value="<?php echo $data->discount; ?>" readonly ></td>
                                                            <td class="hidden_mobile_view" width="10%"><input type="text" class="form-control tax_change" name="tax[]"
                                                                    data-counter="0" id="tax1_<?php echo $data->id; ?>" min="0" value="<?php echo $data->itax; ?>">
                                                                    <!-- <span id="span_tax_0">0.0</span> -->
                                                                    </td>
                                                            <td class="hidden_mobile_view" width="10%"><input type="hidden" class="form-control " name="total[]"
                                                                    data-counter="0" id="item_total_<?php echo $data->id; ?>" min="0" value="<?php echo $data->iTotal; ?>">
                                                                    $<span id="span_total_<?php echo $data->id; ?>"><?php echo $data->iTotal; ?></span></td>
                                                            <td><a href="#" class="remove btn btn-sm btn-success"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                                        </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                                <!-- <a href="#" class="btn btn-primary" id="add_another">Add Items</a> -->
                                                <a class="link-modal-open" href="#" id="add_another_itemss" data-toggle="modal" data-target="#item_list"><span class="fa fa-plus-square fa-margin-right"></span>Add Items</a>
                                            </div>
                                        </div>
                                </div>
                            </div>

                            <!-- ====== TOTAL / BILLING ====== -->
                            <div class="row" id="group_area">
                                <div class="col-sm-12 col-md-5">
                                    <div class="form-group col-md-12">
                                        <h5 class="box-title">Total</h5>
                                    </div>
                                    <div class="col-md-12">
                                        <table class="table table-bordered" style="width:80%;">
                                            <tr>
                                                <td>Equipment Cost</td>
                                                 <td class="d-flex align-items-center">$  <input type="text" name="subtotal" id="item_total" class="form-control" value="<?php echo $workorder->subtotal; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Sales Tax</td>
                                                <td class="d-flex align-items-center">$ <input type="text" 
                                                                                               name="taxes"
                                                                                               id="sales_taxs"
                                                                                               class="form-control" value="<?php echo $workorder->taxes; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <input type="hidden"
                                                       value="<?php echo !empty($workorder->total) ? $workorder->total['inst_cost'] : 0.00; ?>"
                                                       name="inst_cost"
                                                       id="inst_cost"
                                                       onfocusout="cal_total_due()"
                                                       class="form-control">
                                                <td>One Time Program and Setup</td>
                                                <td class="d-flex align-items-center">$ <input type="text"
                                                                                                value="<?php echo $workorder->otp_setup; ?>"
                                                                                               name="otp_setup"
                                                                                               id="one_time"
                                                                                               class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Monthly Monitoring</td>
                                                <td class="d-flex align-items-center">$ <input type="text"
                                                                                                value="<?php echo $workorder->monthly_monitoring; ?>"
                                                                                               name="monthly_monitoring"
                                                                                               id="m_monitoring"
                                                                                               class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Total Due</td>
                                                 <td class="d-flex align-items-center">$ 
                                                            <input type="hidden" name="adjustment_value" id="adjustment_input" value="0" class="form-control adjustment_input" style="width:100px; display:inline-block"><input type="hidden" name="markup_input_form" id="markup_input_form" class="markup_input" value="0"> 
                                                            <input type="text" name="grand_total" id="grand_total_inputs_a" class="form-control" value="<?php echo $workorder->grand_total; ?>">
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <!--                                    <button class="btn btn-block btn-lg btn-primary">Import</button>-->
                                </div>

                                <div class="col-sm-12 col-md-7">
                                    <div class="form-group col-md-12">
                                        <h5 class="box-title">Billing Information</h5>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                        <div class="select-wrap form-group">
                                            <label for="billing_date">Billing Date</label>
                                            <!-- <div class=""> -->
                                                <select name="billing_date" id="billing_date" class="form-control custom-select m_select">
                                                    <option value="<?php echo $workorder->billing_date; ?>"><?php echo $workorder->billing_date; ?></option>
                                                    <?php foreach (range(1, 31) as $date) { ?>
                                                        <option value="<?php echo $date ?>" <?php echo (!empty($workorder->billing_date) && $workorder->billing_date == $date) ? 'selected' : '' ?>>
                                                            <?php echo $date ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            <!-- </div> -->
                                        </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="select-wrap form-group">
                                            <!-- <div class="form-group"> -->
                                                <label for="payment_type"> Payment Type:</label> 
                                                <select name="payment_method" id="payment_method" class="form-control custom-select m_select">
                                                    <option value="<?php echo $workorder->payment_method; ?>"><?php echo $workorder->payment_method; ?></option>
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
                                                <!--                                                <input type="text" class="form-control" name="payment_type"-->
                                                <!--                                                       value="-->
                                                <?php //echo (!empty($workorder->payment_type)) ? $workorder->payment_type : '' ?><!--"-->
                                                <!--                                                       id="payment_type" placeholder=""/>-->
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="select-wrap form-group">
                                                <label for="billing_freq"> Billing Frequency:</label>
                                                <select name="billing_frequency"
                                                        class="form-control custom-select m_select"
                                                        id="billing_freq">
                                                    <option value="<?php echo $workorder->billing_frequency; ?>"><?php echo $workorder->billing_frequency; ?></option>
                                                    <?php foreach (get_config_item('billing_frequency') as $key => $billing_frequency) { ?>
                                                        <option value="<?php echo $billing_frequency ?>" <?php echo (!empty($workorder->billing_freq) && $workorder->billing_freq == $billing_frequency) ? 'selected' : '' ?>>
                                                            <?php echo $billing_frequency ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                                <!--                                                <input type="text" class="form-control" name="billing_freq"-->
                                                <!--                                                       value="-->
                                                <?php //echo (!empty($workorder->billing_freq)) ? $workorder->billing_freq : '' ?><!--"-->
                                                <!--                                                       id="billing_freq" placeholder=""/>-->
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="job_type">Amount<small class="help help-sm"> ( $ )</small></label>
                                                <input type="text" class="form-control" name="payment_amount" id="payment_amount" value="<?php echo $workorder->payment_amount; ?>" />
                                            </div>
                                            <div id="cash_area" style="display:none;margin-top:-20px;">
                                                <input type="checkbox" id="collected_checkbox"> <b style="font-size:14px;" id="collected_checkbox_label"> Cash collected already </b>          
                                            </div>     
                                        </div>
                                    </div>
                                    <!-- <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="job_type">Amount</label><small class="help help-sm"> ( $ )</small>
                                            <input type="text" class="form-control" name="payment_amount" id="payment_amount"  />
                                        </div>
                                        <div class="form-group col-md-4" id="cash_area" style="display:none;">
                                                        <br><br>
                                            <input type="checkbox" id="collected_checkbox"> <b style="font-size:14px;" id="collected_checkbox_label"> Cash collected already </b>          
                                        </div>     
                                    </div> -->
                                    <!-- <div class="row">

                                        <div class="col-md-12">
                                            Credit Card Type:<br>
                                            <div class="checkbox checkbox-sec margin-right mr-4">
                                                <input type="radio" name="card[radio_credit_card]" value="Visa"
                                                    <?php echo (!empty($workorder->card['radio_credit_card']) && $workorder->card['radio_credit_card'] == 'Visa') ? 'checked' : '' ?>
                                                       id="radio_credit_card">
                                                <label for="radio_credit_card"><span>Visa</span></label>
                                            </div>
                                            <div class="checkbox checkbox-sec margin-right mr-4">
                                                <input type="radio" name="card[radio_credit_card]" value="Amex"
                                                    <?php echo (!empty($workorder->card['radio_credit_card']) && $workorder->card['radio_credit_card'] == 'Amex') ? 'checked' : '' ?>
                                                       id="radio_credit_cardAmex">
                                                <label for="radio_credit_cardAmex"><span>Amex</span></label>
                                            </div>
                                            <div class="checkbox checkbox-sec margin-right mr-4">
                                                <input type="radio" name="card[radio_credit_card]" value="Mastercard"
                                                    <?php echo (!empty($workorder->card['radio_credit_card']) && $workorder->card['radio_credit_card'] == 'Mastercard') ? 'checked' : '' ?>
                                                       id="radio_credit_cardMastercard">
                                                <label for="radio_credit_cardMastercard"><span>Mastercard</span></label>
                                            </div>
                                            <div class="checkbox checkbox-sec margin-right mr-4">
                                                <input type="radio" name="card[radio_credit_card]" value="Discover"
                                                    <?php echo (!empty($workorder->card['radio_credit_card']) && $workorder->card['radio_credit_card'] == 'Discover') ? 'checked' : '' ?>
                                                       id="radio_credit_cardMasterDiscover">
                                                <label for="radio_credit_cardMasterDiscover"><span>Discover</span></label>
                                            </div>

                                        </div>
                                        <div class=" col-md-12 mt-5">
                                            <div class="row"
                                                 style="border:none; margin-bottom:20px; padding-bottom:0px;">
                                                <div class=" col-md-6">
                                                    <label for="card_no">Card Number</label>
                                                    <input type="text" class="form-control card-number required"
                                                           name="card[card_no]"
                                                           value="<?php echo (!empty($workorder->card_info['card_no'])) ? $workorder->card_info['card_no'] : '' ?>"
                                                           id="card_no" placeholder="" required/>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="datepicker_exp_date">Exp. Date</label>
                                                    <div class="form-group">
                                                        <div class='input-group date datepicker'>
                                                            <input type='text' name="card[exp_date]"
                                                                   class="form-control"
                                                                   value="<?php echo (!empty($workorder->card_info['exp_date'])) ? date('m/d/Y', strtotime($workorder->card_info['exp_date'])) : '' ?>"
                                                                   id="card_exp_date"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class=" col-md-2">
                                                    <label for="cvv">CVV#</label>
                                                    <input type="text" class="form-control card-cvc required"
                                                           name="card[cvv]"
                                                           value="<?php echo (!empty($workorder->card_info['cvv'])) ? $workorder->card_info['cvv'] : '' ?>"
                                                           id="cvv" placeholder="" required/>
                                                </div>
                                            </div>

                                            <div class="row" style="border:none; margin-bottom:20px; padding-bottom:0px;">
                                                <div class=" col-md-6">
                                                    <label for="card_no">Routing Number</label>
                                                    <input type="text" class="form-control card-number required"
                                                           name="Routing" />
                                                </div>
                                                <div class=" col-md-6">
                                                    <label for="cvv">Account Number</label>
                                                    <input type="text" class="form-control card-cvc required"
                                                           name="Account" />
                                                </div>
                                            </div>
                                        </div>

                                    </div> -->
                                    <!-- <div id="check_area" style="display:none;">
                                        <div class="row">                   
                                            <div class="form-group col-md-4">
                                                <label for="job_type" class="label-element">Check Number</label>
                                                <input type="text" class="form-control input-element" name="check_number" id="check_number"/>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="job_type" class="label-element">Routing Number</label>
                                                <input type="text" class="form-control input-element" name="routing_number" id="routing_number"/>
                                            </div> 
                                            <div class="form-group col-md-4">
                                                <label for="job_type" class="label-element">Account Number</label>
                                                <input type="text" class="form-control input-element" name="account_number" id="account_number"/>
                                            </div>                                       
                                        </div>
                                    </div>
                                    <div id="credit_card" style="display:none;">
                                        <div class="row">
                                                <div class="col-md-12">
                                                    Credit Card Type:<br>
                                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                                        <input type="radio" name="card[radio_credit_card]" value="Visa"
                                                            <?php echo (!empty($workorder->card['radio_credit_card']) && $workorder->card['radio_credit_card'] == 'Visa') ? 'checked' : '' ?>
                                                            id="radio_credit_card">
                                                        <label for="radio_credit_card"><span>Visa</span></label>
                                                    </div>
                                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                                        <input type="radio" name="card[radio_credit_card]" value="Amex"
                                                            <?php echo (!empty($workorder->card['radio_credit_card']) && $workorder->card['radio_credit_card'] == 'Amex') ? 'checked' : '' ?>
                                                            id="radio_credit_cardAmex">
                                                        <label for="radio_credit_cardAmex"><span>Amex</span></label>
                                                    </div>
                                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                                        <input type="radio" name="card[radio_credit_card]" value="Mastercard"
                                                            <?php echo (!empty($workorder->card['radio_credit_card']) && $workorder->card['radio_credit_card'] == 'Mastercard') ? 'checked' : '' ?>
                                                            id="radio_credit_cardMastercard">
                                                        <label for="radio_credit_cardMastercard"><span>Mastercard</span></label>
                                                    </div>
                                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                                        <input type="radio" name="card[radio_credit_card]" value="Discover"
                                                            <?php echo (!empty($workorder->card['radio_credit_card']) && $workorder->card['radio_credit_card'] == 'Discover') ? 'checked' : '' ?>
                                                            id="radio_credit_cardMasterDiscover">
                                                        <label for="radio_credit_cardMasterDiscover"><span>Discover</span></label>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="row">                                            
                                        </div>
                                        <br><br>
                                        <div class="row">                   
                                            <div class="form-group col-md-4">
                                                <label for="job_type" class="label-element">Credit Card Number</label>
                                                <input type="text" class="form-control input-element" name="credit_number" id="credit_number" placeholder="0000 0000 0000 000" />
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="job_type" class="label-element">Credit Card Expiration</label>
                                                <input type="text" class="form-control input-element" name="credit_expiry" id="credit_expiry" placeholder="MM/YYYY"/>
                                            </div>  
                                            <div class="form-group col-md-4">
                                                <label for="job_type" class="label-element">CVC</label>
                                                <input type="text" class="form-control input-element" name="credit_cvc" id="credit_cvc" placeholder="CVC"/>
                                            </div>                                             
                                        </div>
                                    </div> -->
                                    <div id="check_area" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Check Number</label>
                                        <input type="text" class="form-control" name="check_number" id="check_number" value="<?php echo $payment->check_number; ?>" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Routing Number</label>
                                        <input type="text" class="form-control" name="routing_number" id="routing_number" value="<?php echo $payment->routing_number; ?>" />
                                    </div>                                             
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Number</label>
                                        <input type="text" class="form-control" name="account_number" id="account_number" value="<?php echo $payment->account_number; ?>" />
                                    </div>                                       
                                </div>
                            </div>
                            <div id="credit_card" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Credit Card Number</label>
                                        <input type="text" class="form-control" name="credit_number" id="credit_number" placeholder="0000 0000 0000 000"  value="<?php echo $payment->credit_number; ?>" />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="job_type">Credit Card Expiration</label>
                                        <input type="text" class="form-control" name="credit_expiry" id="credit_expiry" placeholder="MM/YYYY" value="<?php echo $payment->credit_expiry; ?>" />
                                    </div>  
                                    <div class="form-group col-md-3">
                                        <label for="job_type">CVC</label>
                                        <input type="text" class="form-control" name="credit_cvc" id="credit_cvc" placeholder="CVC" value="<?php echo $payment->credit_cvc; ?>" />
                                    </div>                                             
                                </div>
                            </div>
                            <div id="debit_card" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Debit Card Number</label>
                                        <input type="text" class="form-control" name="debit_credit_number" id="credit_number" placeholder="0000 0000 0000 000"  value="<?php echo $payment->credit_number; ?>" />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="job_type">Credit Card Expiration</label>
                                        <input type="text" class="form-control" name="debit_credit_expiry" id="credit_expiry" placeholder="MM/YYYY" value="<?php echo $payment->credit_expiry; ?>" />
                                    </div>  
                                    <div class="form-group col-md-3">
                                        <label for="job_type">CVC</label>
                                        <input type="text" class="form-control" name="debit_credit_cvc" id="credit_cvc" placeholder="CVC" value="<?php echo $payment->credit_cvc; ?>" />
                                    </div>                                            
                                </div>
                            </div>
                            <div id="ach_area" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Routing Number</label>
                                        <input type="text" class="form-control" name="ach_routing_number" id="ach_routing_number" value="<?php echo $payment->routing_number; ?>"  />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="job_type">Account Number</label>
                                        <input type="text" class="form-control" name="ach_account_number" id="ach_account_number" value="<?php echo $payment->account_number; ?>"  />
                                    </div>  
                                </div>
                            </div>
                            <div id="venmo_area" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Credential</label>
                                        <input type="text" class="form-control" name="account_credentials" id="account_credentials" value="<?php echo $payment->account_credentials; ?>" />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="job_type">Account Note</label>
                                        <input type="text" class="form-control" name="account_note" id="account_note" value="<?php echo $payment->account_note; ?>" />
                                    </div>  
                                    <div class="form-group col-md-3">
                                        <label for="job_type">Confirmation</label>
                                        <input type="text" class="form-control" name="confirmation" id="confirmation" value="<?php echo $payment->confirmation; ?>" />
                                    </div>                                            
                                </div>
                            </div>
                            <div id="paypal_area" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Credential</label>
                                        <input type="text" class="form-control" name="paypal_account_credentials" id="paypal_account_credentials" value="<?php echo $payment->account_credentials; ?>" />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="job_type">Account Note</label>
                                        <input type="text" class="form-control" name="paypal_account_note" id="paypal_account_note" value="<?php echo $payment->account_note; ?>" />
                                    </div>  
                                    <div class="form-group col-md-3">
                                        <label for="job_type">Confirmation</label>
                                        <input type="text" class="form-control" name="paypal_confirmation" id="paypal_confirmation" value="<?php echo $payment->confirmation; ?>" />
                                    </div>                                            
                                </div>
                            </div>
                            <div id="square_area" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Credential</label>
                                        <input type="text" class="form-control" name="square_account_credentials" id="square_account_credentials" value="<?php echo $payment->account_credentials; ?>" />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="job_type">Account Note</label>
                                        <input type="text" class="form-control" name="square_account_note" id="square_account_note" value="<?php echo $payment->account_note; ?>" />
                                    </div>  
                                    <div class="form-group col-md-3">
                                        <label for="job_type">Confirmation</label>
                                        <input type="text" class="form-control" name="square_confirmation" id="square_confirmation" value="<?php echo $payment->confirmation; ?>" />
                                    </div>                                            
                                </div>
                            </div>
                            <div id="warranty_area" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Credential</label>
                                        <input type="text" class="form-control" name="warranty_account_credentials" id="warranty_account_credentials" value="<?php echo $payment->account_credentials; ?>" />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="job_type">Account Note</label>
                                        <input type="text" class="form-control" name="warranty_account_note" id="warranty_account_note" value="<?php echo $payment->account_note; ?>" />
                                    </div>                                         
                                </div>
                            </div>
                            <div id="home_area" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Credential</label>
                                        <input type="text" class="form-control" name="home_account_credentials" id="home_account_credentials" value="<?php echo $payment->account_credentials; ?>" />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="job_type">Account Note</label>
                                        <input type="text" class="form-control" name="home_account_note" id="home_account_note" value="<?php echo $payment->account_note; ?>" />
                                    </div>                                         
                                </div>
                            </div>
                            <div id="e_area" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Credential</label>
                                        <input type="text" class="form-control" name="e_account_credentials" id="e_account_credentials" value="<?php echo $payment->account_credentials; ?>" />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="job_type">Account Note</label>
                                        <input type="text" class="form-control" name="e_account_note" id="e_account_note" value="<?php echo $payment->account_note; ?>" />
                                    </div>                                         
                                </div>
                            </div>
                            <div id="other_credit_card" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Credit Card Number</label>
                                        <input type="text" class="form-control" name="other_credit_number" id="other_credit_number" placeholder="0000 0000 0000 000"  value="<?php echo $payment->credit_number; ?>" />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="job_type">Credit Card Expiration</label>
                                        <input type="text" class="form-control" name="other_credit_expiry" id="other_credit_expiry" placeholder="MM/YYYY" value="<?php echo $payment->credit_expiry; ?>" />
                                    </div>  
                                    <div class="form-group col-md-3">
                                        <label for="job_type">CVC</label>
                                        <input type="text" class="form-control" name="other_credit_cvc" id="other_credit_cvc" placeholder="CVC" value="<?php echo $payment->credit_cvc; ?>" />
                                    </div>                                             
                                </div>
                            </div>
                            <div id="other_payment_area" style="display:none;">
                                <div class="row">                   
                                    <div class="form-group col-md-4">
                                        <label for="job_type">Account Credential</label>
                                        <input type="text" class="form-control" name="other_payment_account_credentials" id="other_payment_account_credentials" value="<?php echo $payment->account_credentials; ?>" />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="job_type">Account Note</label>
                                        <input type="text" class="form-control" name="other_payment_account_note" id="other_payment_account_note" value="<?php echo $payment->account_note; ?>" />
                                    </div>                                         
                                </div>
                            </div>
                                </div>
                            </div>

                            <!-- ====== AGREEMENT ====== -->
                            <div class="row" id="group_area">
                                <div class=" col-md-12"><label style="float:right;color:green;"><a href="#" style="color:green;" data-toggle="modal" data-target="#terms_conditions_modal">Update Terms and Condition</a></label>
                                    <h6>Agreement</h6>
                                    <div style="height:400px; overflow:auto; background:#FFFFFF; padding-left:10px;" id="thisdiv2">
                                    <?php echo $workorder->terms_and_conditions; ?></p>
                                            <input type="hidden" id="company_id" value="<?php echo getLoggedCompanyID(); ?>">
                                            <input type="hidden" class="form-control" name="terms_conditions" id="terms_conditions" value="<?php echo $workorder->terms_and_conditions; ?>" />
                                    </div>
                                </div>
                            </div>

                            <!-- ====== SIGNATURE ====== -->
                            <div class="row" id="group_area">
                                <div class=" col-md-12">
                                    <div class="work_nore">
                                        <h6>Signature</h6>
                                        <p> By Signing below you verify that the above information is true and complete,
                                            and you authorize payment and confirmation with nSmarTrac. </p>
                                    </div>
                                </div>
                            </div> <br><br>
                            <div class="row">
                                <div class="col-md-4">
                                    <h6>Company Representative Approval &emsp; <a data-toggle="modal" data-target=".companySignature"><i class="fa fa-pencil" aria-hidden="true"></i></a> </h6>
                                    <img src="<?php echo base_url($workorder->company_representative_signature); ?>" class="img1">
                                    <div id="companyrep"></div>
                                    <br>

                                    <label for="comp_rep_approval">Printed Name</label>
                                    <!-- <input type="text6" class="form-control mb-3"
                                           name="company_representative_printed_name"
                                           id="comp_rep_approval" value="<?php //echo $workorder->company_representative_name; ?>" /> -->
                                        <select class="form-control mb-3" name="company_representative_printed_name">
                                            <option value="0">Select Name</option>
                                            <?php foreach($users_lists as $ulist){ ?>
                                                <option <?php if(isset($workorder)){ if($workorder->company_representative_name == $ulist->id){echo "selected";} } ?>  value="<?php echo $ulist->id ?>"><?php echo $ulist->FName .' '.$ulist->LName; ?></option>
                                            <?php } ?>
                                        </select>
                                           <input type="hidden" id="saveCompanySignatureDB1aM_web" name="company_representative_approval_signature1aM_web">

                                </div>
                                <div class="col-md-4">
                                    <h6>Primary Account Holder &emsp; <a data-toggle="modal" data-target=".primarySignature"><i class="fa fa-pencil" aria-hidden="true"></i></a></h6>
                                    <img src="<?php echo base_url($workorder->primary_account_holder_signature); ?>" class="img2">
                                    <div id="primaryrep"></div>
                                    <br>

                                    <label for="comp_rep_approval">Printed Name</label>
                                    <input type="text6" class="form-control mb-3" name="primary_account_holder_name"
                                           id="comp_rep_approval" placeholder="" value="<?php echo $workorder->primary_account_holder_name; ?>"/>
                                        <!-- <select class="form-control mb-3" name="primary_account_holder_name">
                                            <option value="0">Select Name</option>
                                            <?php //foreach($users_lists as $ulist){ ?>
                                                <option <?php //if(isset($workorder)){ if($workorder->primary_account_holder_name == $ulist->id){echo "selected";} } ?>  value="<?php //echo $ulist->id ?>"><?php echo $ulist->FName .' '.$ulist->LName; ?></option>
                                            <?php //} ?>
                                        </select> -->
                                           <input type="hidden" id="saveCompanySignatureDB1aM_web2" name="primary_representative_approval_signature1aM_web">

                                </div>
                                <div class="col-md-4">
                                    <h6>Secondary Account Holder &emsp; <a data-toggle="modal" data-target=".secondarySignature"><i class="fa fa-pencil" aria-hidden="true"></i></a></h6>
                                    <img src="<?php echo base_url($workorder->secondary_account_holder_signature); ?>" class="img3">
                                    <div id="secondaryrep"></div>
                                    <br>

                                    <label for="comp_rep_approval">Printed Name</label>
                                    <input type="text6" class="form-control mb-3" name="secondery_account_holder_name"
                                           id="comp_rep_approval" placeholder="" value="<?php echo $workorder->secondary_account_holder_name; ?>"/>
                                        <!-- <select class="form-control mb-3" name="secondery_account_holder_name">
                                            <option value="0">Select Name</option>
                                            <?php //foreach($users_lists as $ulist){ ?>
                                                <option <?php //if(isset($workorder)){ if($workorder->secondary_account_holder_name == $ulist->id){echo "selected";} } ?>  value="<?php //echo $ulist->id ?>"><?php echo $ulist->FName .' '.$ulist->LName; ?></option>
                                            <?php //} ?>
                                        </select> -->
                                           <input type="hidden" id="saveCompanySignatureDB1aM_web3" name="secondary_representative_approval_signature1aM_web">

                                </div>
                            </div>

                            
                            <br><br>
                                
                                <div class="row">        
                                    <div class="form-group col-md-6">
                                        <label for="instructions" class="label-element">Instructions</label>
                                        <textarea name="instructions" id="instructions" cols="5" rows="2" class="form-control input-element"></textarea>
                                    </div>                                           
                                </div>


                            <!-- <div class="signature_mobile">
                                    <br><br>
                                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#signature_mobile">Signature</a>
                                    <br><br>
                            </div>

                            <div class="signature_mobile signatureArea">
                            </div> -->

                            <!-- ====== TERMS OF USE ====== -->
                            <div class="row" id="group_area">
                            
                            <br><br>

                                <div class=" col-md-12"><label style="float:right;color:green;"><a href="#" style="color:green;" data-toggle="modal" data-target="#terms_use_modal">Update Terms of Use</a></label>
                                    <h6>Agreement</h6>
                                    <div style="height:200px; overflow:auto; background:#FFFFFF; padding-left:10px;" id="thisdiv3">
                                    <p><?php echo $workorder->terms_of_use; ?></p>
                                            <input type="hidden" id="company_id" value="<?php echo getLoggedCompanyID(); ?>">
                                            <input type="hidden" class="form-control" name="terms_of_use" id="terms_of_use" value="<?php echo $workorder->terms_of_use; ?>"/>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group"> 
                                        <br><br>
                                        <label for="initials">**INITIALS**</label>
                                        <input type="text" class="form-control"
                                               name="initials" value="<?php echo $workorder->initials; ?>"
                                               id="initials" placeholder=""/>
                                    </div>
                                </div>
                            </div>


                            <!-- ====== POST SERVICE SUMMARY ====== -->
                            <!-- <div class="row" id="group_area">
                                <div class="col-md-12">
                                    <div class="panel-group">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" href="#POST-SERVICEcollapse1">POST-SERVICE
                                                        SUMMARY
                                                        <i class="fa fa-angle-down"
                                                           style="font-size: 31px;top: 4px;position: relative;font-weight: bolder;"></i></a>
                                                </h4>
                                            </div>
                                            <div id="POST-SERVICEcollapse1" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class=" col-md-4 form-group">
                                                            <label for="post_service_uid">Lead Source</label>
                                                            <select name="post_service_summary[lead_source][name]"
                                                                    class="form-control"
                                                                    id="post_service_lead_source">
                                                                <option>--SELECT--</option>
                                                                <?php foreach (get_config_item('lead_source') as $key => $lead_source) { ?>
                                                                    <option value="<?php echo $lead_source ?>"
                                                                        <?php echo (!empty($workorder->post_service_summary['lead_source']['name']) && $workorder->post_service_summary['lead_source']['name'] == $lead_source) ? 'selected' : '' ?>>
                                                                        <?php echo $lead_source ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                            <div class="form-group mt-2"
                                                                 style="display: <?php echo (empty($workorder->post_service_summary['lead_source']['other'])) ? 'none' : 'block' ?>">
                                                                <input type="text"
                                                                       name="post_service_summary[lead_source][other]"
                                                                       class="form-control"
                                                                       value="<?php echo (!empty($workorder->post_service_summary['lead_source']['other'])) ? $workorder->post_service_summary['lead_source']['other'] : '' ?>"
                                                                       placeholder="Write it here..." required>
                                                            </div>
                                                        </div>
                                                        <div class=" col-md-4 form-group">
                                                            <label for="post_service_pwd">Sales Representative</label>
                                                            <input type="text" class="form-control"
                                                                   name="post_service_summary[sales_rep]"
                                                                   value="<?php echo (!empty($workorder->post_service_summary['sales_rep'])) ? $workorder->post_service_summary['sales_rep'] : '' ?>"
                                                                   id="post_service_pwd" placeholder=""/>
                                                        </div>
                                                        <div class=" col-md-4 form-group">
                                                            <label for="post_service_pre_install">If Takeover, name of
                                                                previous products:</label>
                                                            <input type="text" class="form-control"
                                                                   name="post_service_summary[previous_products]"
                                                                   value="<?php echo (!empty($workorder->post_service_summary['previous_products'])) ? $workorder->post_service_summary['previous_products'] : '' ?>"
                                                                   id="post_service_pre_install"
                                                                   placeholder=""/>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="notes_to_tech"> Notes to Admin:</label>
                                                            <textarea name="post_service_summary[notes_to_admin]"
                                                                      id="notes_to_admin" rows="3"
                                                                      class="form-control"><?php echo (!empty($workorder->post_service_summary['notes_to_admin'])) ? $workorder->post_service_summary['notes_to_admin'] : '' ?></textarea>
                                                        </div>
                                                        <div class="col-md-12 mt-5">
                                                            <div id="POST-SERVICEcollapse1">
                                                                <div class="panel-body">
                                                                    <div class="row">
                                                                        <div class=" col-md-4 form-group">
                                                                            <label for="post_service_uid">USERID</label>
                                                                            <input type="text" class="form-control"
                                                                                   name="post_service_summary[userid]"
                                                                                   value="<?php echo (!empty($workorder->post_service_summary['userid'])) ? $workorder->post_service_summary['userid'] : '' ?>"
                                                                                   id="post_service_uid"
                                                                                   placeholder=""/>
                                                                        </div>
                                                                        <div class=" col-md-4 form-group">
                                                                            <label for="post_service_pwd">PASSWORD</label>
                                                                            <input type="text" class="form-control"
                                                                                   name="post_service_summary[password]"
                                                                                   value="<?php echo (!empty($workorder->post_service_summary['password'])) ? $workorder->post_service_summary['password'] : '' ?>"
                                                                                   id="post_service_pwd"
                                                                                   placeholder=""/>
                                                                        </div>
                                                                        <div class=" col-md-4 form-group">
                                                                            <label for="post_service_pre_install">Pre-Install
                                                                                Conf.
                                                                                #</label>
                                                                            <input type="text" class="form-control"
                                                                                   name="post_service_summary[pre_install_conf]"
                                                                                   value="<?php echo (!empty($workorder->post_service_summary['pre_install_conf'])) ? $workorder->post_service_summary['pre_install_conf'] : '' ?>"
                                                                                   id="post_service_pre_install"
                                                                                   placeholder=""/>
                                                                        </div>
                                                                        <div class=" col-md-4 form-group">
                                                                            <label for="post_service_wifi_pwd">WiFi
                                                                                Password</label>
                                                                            <input type="text" class="form-control"
                                                                                   name="post_service_summary[wifi_password]"
                                                                                   value="<?php echo (!empty($workorder->post_service_summary['wifi_password'])) ? $workorder->post_service_summary['wifi_password'] : '' ?>"
                                                                                   id="post_service_wifi_pwd"
                                                                                   placeholder=""/>
                                                                        </div>
                                                                        <div class=" col-md-4 form-group">
                                                                            <label for="post_service_panel_location">Panel
                                                                                Location</label>
                                                                            <input type="text" class="form-control"
                                                                                   name="post_service_summary[panel_location]"
                                                                                   value="<?php echo (!empty($workorder->post_service_summary['panel_location'])) ? $workorder->post_service_summary['panel_location'] : '' ?>"
                                                                                   id="post_service_panel_location"
                                                                                   placeholder=""/>
                                                                        </div>
                                                                        <div class=" col-md-4 form-group">
                                                                            <label for="post_service_trans_location">Transformer
                                                                                Location</label>
                                                                            <input type="text" class="form-control"
                                                                                   name="post_service_summary[panel_location]"
                                                                                   value="<?php echo (!empty($workorder->post_service_summary['panel_location'])) ? $workorder->post_service_summary['panel_location'] : '' ?>"
                                                                                   id="post_service_trans_location"
                                                                                   placeholder=""/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div> -->

                            <!-- </div> -->
                            <div class="row">
                                <div class="col-md-4">
                                    <!-- <button type="button" onClick="validatecard();"
                                            class="btn btn-flat btn-primary">
                                        Submit
                                    </button> -->
                                    <input type="submit" value="Submit" name="action" class="btn btn-flat btn-primary">
                                    <button type="submit" name="action" class="btn btn-flat btn-success pdf_sheet" target="_blank" value="preview">Preview as PDF</button>
                                    <a href="<?php echo url('workorder') ?>" class="btn btn-danger">Cancel this</a>
                                </div>
                            </div>

                        <!-- </div> -->
                        <!-- end card -->
                    <!-- </div> -->
                </div>


                <div class="modal fade" id="checklistModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Select Checklists</h4>
                            </div>
                            <div class="modal-body">
                                <p></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Add Selected</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
                <!-- end row -->
            </div>
            <!-- end container-fluid -->
        </div>
        <!-- page wrapper end -->
    </div>

    <!-- first signature -->

    <div class="modal fade companySignature" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                            <div align="center">
                                <p style="padding:2%;background-color:#d2d2d2;width:380px;"> Company Representative Approval </p>
                            </div>
                                    <div class="box-wrap">
                                        
                                        <div id="box-one">
                                        <div class="row">
                                        <div class="col-md-12" style="padding:1%;">
                                        <center>
                                        <div id="signArea" >
                                            <canvas id="canvas" style="border: solid gray 1px;"></canvas>
                                            <input type="hidden" class="form-control mb-3" name="company_representative_printed_name" id="comp_rep_approval1" value="Company Representative"/>
                                            <input type="hidden" id="saveCompanySignatureDB1aM" name="company_representative_approval_signature1aM">
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
                                <p style="padding:2%;background-color:#d2d2d2;width:380px;"> Primary Account Holder </p>
                            </div>
                                    <div class="box-wrap">
                                        
                                        <div id="box-one">
                                        <div class="row">
                                        <div class="col-md-12" style="padding:1%;">
                                        <center>
                                        <div id="signArea2" >
                                            <canvas id="canvas2" style="border: solid gray 1px;"></canvas>
                                            <input type="hidden" class="form-control mb-3" name="primary_representative_printed_name" id="comp_rep_approval2" value="Primary Account Holder"/>
                                            <input type="hidden" id="savePrimaryAccountSignatureDB2aM" name="primary_account_holder_signature2aM">
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
                                <p style="padding:2%;background-color:#d2d2d2;width:380px;"> Secondary Account Holder </p>
                            </div>
                                    <div class="box-wrap">
                                        
                                        <div id="box-one">
                                        <div class="row">
                                        <div class="col-md-12" style="padding:1%;">
                                        <center>
                                        <div id="signArea3" >
                                            <canvas id="canvas3" style="border: solid gray 1px;"></canvas>
                                            <input type="hidden" class="form-control mb-3" name="secondary_representative_printed_name" id="comp_rep_approval3" value="Secondary Account Holder"/>
                                            <input type="hidden" id="saveSecondaryAccountSignatureDB3aM" name="secondary_account_holder_signature3aM">
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

    <!-- Modal -->
    <div class="modal fade" id="update_header_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Update Header</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <textarea class="form-control ckeditor" name="update_header_content" id="editor3" cols="40" rows="40">
                            <?php echo $headers->content; ?>
                            </textarea>
                            <input type="hidden" id="company_id_header" value="<?php echo getLoggedCompanyID(); ?>">
                            <input type="hidden" id="update_h_id" value="<?php echo $headers->id; ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary save_update_header">Save changes</button>
                    </div>
                    </div>
                </div>
            </div>

     <!-- Modal -->
     <div class="modal fade" id="item_list" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="newcustomerLabel">Item Lists</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="items_table_estimate" class="table table-hover" style="width: 100%;">
                                        <thead>
                                        <tr>
                                            <td> Name</td>
                                            <td> Rebatable</td>
                                            <td> Qty</td>
                                            <td> Price</td>
                                            <td> Action</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($items as $item){ // print_r($item); ?>
                                            <tr>
                                                <td><?php echo $item->title; ?></td>
                                                <td><?php if($item->rebate == 1){ ?>
                                                    <!-- <label class="switch">
                                                    <input type="checkbox" id="rebatable_toggle" checked>
                                                    <span class="slider round"></span> -->
                                                    <input type="checkbox" class="toggle_checkbox" id="rebatable_toggle" item-id="<?php echo $item->id; ?>"  value="1"  data-toggle="toggle" data-size="xs" checked >
                                                    </label>
                                                <?php }else{ ?>
                                                    <!-- <label class="switch">
                                                    <input type="checkbox">
                                                    <span class="slider round"></span>
                                                    </label> -->

                                                    <!-- <input type="checkbox" data-toggle="toggle" data-size="xs"> -->
                                                    <input type="checkbox" class="toggle_checkbox" id="rebatable_toggle" item-id="<?php echo $item->id; ?>" value="0" data-toggle="toggle" data-size="xs">

                                                <?php  } ?></td>
                                                <td></td>
                                                <td><?php echo $item->price; ?></td>
                                                <td><button id="<?= $item->id; ?>" data-quantity="<?= $item->units; ?>" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>" type="button" data-dismiss="modal" class="btn btn-sm btn-default select_item">
                                                <span class="fa fa-plus"></span>
                                            </button></td>
                                            </tr>
                                            
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer modal-footer-detail">
                            <div class="button-modal-list">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fa fa-remove"></span> Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             <!-- Modal -->
             <div class="modal fade" id="terms_conditions_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Update Terms and Conditions</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <textarea class="form-control ckeditor editor1_tc" name="editor1" id="editor1" cols="40" rows="40">
                            <?php echo $terms_conditions->content; ?>
                            </textarea>
                            <input type="hidden" id="company_id_modal" value="<?php echo getLoggedCompanyID(); ?>">
                            <input type="hidden" id="update_tc_id" value="<?php echo $terms_conditions->id; ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary save_terms_and_conditions">Save changes</button>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="signature_mobile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <!-- <div class="modal-header"> -->
                        <!-- <h5 class="modal-title" id="exampleModalLongTitle">Update Terms and Conditions</h5> -->
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div> -->
                    <div align="center"><p style="padding:2%;background-color:#d2d2d2;width:380px;"> By Signing below you verify that the above information is true and complete,
                                            and you authorize payment and confirmation with nSmarTrac. </p></div>
                    <div class="modal-body">
                            <div class="row signature_mobile">
                            
                            <div class="tabbed-area">

                                    <div class="box-wrap">
                                    
                                        <div id="box-one">
                                            <canvas id="canvas" height="250px" style=""></canvas>
                                            <input type="hidden" class="form-control mb-3" name="company_representative_printed_name" id="comp_rep_approval1" value="Company Representative"/>
                                            <input type="hidden" id="saveCompanySignatureDB1aM" name="company_representative_approval_signature1aM">
                                        </div>
                                        
                                        <div id="box-two">
                                            <canvas id="canvas2" height="250px" style=""></canvas>
                                            <input type="hidden" class="form-control mb-3" name="company_representative_printed_name" id="comp_rep_approval2" value="Primary Account Holder"/>
                                            <input type="hidden" id="savePrimaryAccountSignatureDB2aM" name="primary_account_holder_signature2aM">
                                        </div>
                                        
                                        <div id="box-three">
                                            <canvas id="canvas3" height="250px" style=""></canvas>
                                            <input type="hidden" class="form-control mb-3" name="company_representative_printed_name" id="comp_rep_approval3" value="Secondary Account Holder"/>
                                            <input type="hidden" id="saveSecondaryAccountSignatureDB3aM" name="secondary_account_holder_signature3aM">
                                        </div>
                                    
                                    </div>
                                    <br><br><br><br>
                                    <ul class="tabs group" style="width:100% !important;">
                                        <li class="active"><a href="#box-one" class="btn" style="width:100%;font-size:8px;">Company Representative</a></li>
                                        <li><a href="#box-two" class="btn" style="width:100%;font-size:8px;">Primary Account Holder</a></li>
                                        <li><a href="#box-three" class="btn" style="width:100%;font-size:8px;">Secondary Account Holder</a></li>
                                    </ul>

                                </div>
                        
                            </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                        <button type="button" onClick="submit()" class="btn btn-primary enter_signature" id="enter_signature">Save changes</button>
                        <!-- <input type="submit" value="save" id="btnSaveSign"> -->
                    </div>
                    <?php //echo form_close(); ?>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="terms_use_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Update Terms of Use</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <textarea class="form-control ckeditor" name="update_tu" id="editor2" cols="40" rows="40">
                            <?php echo $terms_uses->content; ?>
                            </textarea>
                            <input type="hidden" id="company_id_modal" value="<?php echo getLoggedCompanyID(); ?>">
                            <input type="hidden" id="update_tu_id" value="<?php echo $terms_uses->id; ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary save_terms_of_use">Save changes</button>
                    </div>
                    </div>
                </div>
            </div>

    <?php include viewPath('includes/footer'); ?>

<script>
  $( function() {
    $( "#datepicker" ).datepicker({
        format: 'yyyy-mm-dd'
    });
  } );
</script>

<script>
// $('.value').on('keydown keyup mousedown mouseup', function() {
//     	 var res = this.value, //grabs the value
//     		 len = res.length, //grabs the length
//     		 max = 9, //sets a max chars
//     		 stars = len>0?len>1?len>2?len>3?len>4?'XXX-XX-':'XXX-X':'XXX-':'XX':'X':'', //this provides the masking and formatting
//     		result = stars+res.substring(5); //this is the result
//     	 $(this).attr('maxlength', max); //setting the max length
//     	$(".number").val(result); //spits the value into the input
//     });

// $('#security_number').keyup(function() {
//     var val = this.value.replace(/\D/g, '');
//     var newVal = '';
//     var sizes = [3, 2, 4];

//     for (var i in sizes) {
//       if (val.length > sizes[i]) {
//         newVal += val.substr(0, sizes[i]) + '-';
//         val = val.substr(sizes[i]);
//       }
//       else
//         break;        
//     }

//     newVal += val;
//     this.value = newVal;
// });

$('#security_number').keyup(function() {
        var val = this.value.replace(/\D/g, '');
        val = val.replace(/^(\d{3})/, '$1-');
        val = val.replace(/-(\d{2})/, '-$1-');
        val = val.replace(/(\d)-(\d{4}).*/, '$1-$2');
        this.value = val;
    });

    $('#security_number_spouse').keyup(function() {
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

$('#contact_mobile').keyup(function() {
        var val = this.value.replace(/\D/g, '');
        val = val.replace(/^(\d{3})/, '$1-');
        val = val.replace(/-(\d{3})/, '-$1-');
        val = val.replace(/(\d)-(\d{4}).*/, '$1-$2');
        this.value = val;
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
// $('.enter_signature').click(function(){
//     // alert("nisulod");
//         if(signaturePad.isEmpty()){
//             console.log('it is empty');
//             return false;            
//         }
//     });

var signaturePad;
jQuery(document).ready(function () {
  var signaturePadCanvas = document.querySelector('#canvas');
//   var parentWidth = jQuery(signaturePadCanvas).parent().outerWidth();
//   signaturePadCanvas.setAttribute("width", parentWidth);
  signaturePad = new SignaturePad(signaturePadCanvas);

//   signaturePadCanvas.width  = 780;
  signaturePadCanvas.height = 300;
});

var signaturePad2;
jQuery(document).ready(function () {
  var signaturePadCanvas2 = document.querySelector('#canvas2');
//   var parentWidth = jQuery(signaturePadCanvas).parent().outerWidth();
//   signaturePadCanvas.setAttribute("width", parentWidth);
  signaturePad2 = new SignaturePad(signaturePadCanvas2);

//   signaturePadCanvas2.width  = 780;
  signaturePadCanvas2.height = 300;
});

var signaturePad3;
jQuery(document).ready(function () {
  var signaturePadCanvas3 = document.querySelector('#canvas3');
//   var parentWidth = jQuery(signaturePadCanvas).parent().outerWidth();
//   signaturePadCanvas.setAttribute("width", parentWidth);
  signaturePad3 = new SignaturePad(signaturePadCanvas3);

//   signaturePadCanvas3.width  = 780;
  signaturePadCanvas3.height = 300;
});


$(document).on('click touchstart','#sign',function(){
    // alert('test');
    var canvas_web = document.getElementById("sign");    
    var dataURL = canvas_web.toDataURL("image/png");
    $("#saveCompanySignatureDB1aM_web").val(dataURL);
});

$(document).on('click touchstart','#sign2',function(){
    // alert('test');
    var canvas_web2 = document.getElementById("sign2");    
    var dataURL = canvas_web2.toDataURL("image/png");
    $("#saveCompanySignatureDB1aM_web2").val(dataURL);
});

$(document).on('click touchstart','#sign3',function(){
    // alert('test');
    var canvas_web3 = document.getElementById("sign3");    
    var dataURL = canvas_web3.toDataURL("image/png");
    $("#saveCompanySignatureDB1aM_web3").val(dataURL);
});

// var btn = document.getElementById('enter_signature');
// btn.onclick = function () {
//     document.getElementById('smoothed1a_pencil').remove();
//     this.remove();
// };

function submit() {
    
    // document.getElementById('smoothed1a_pencil').remove();
    // this.remove();

    // $("#smoothed1a").remove();
    // $("#smoothed2a").remove();
    // $("#smoothed3a").remove();

    // $(".signature_web").remove();

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

        var input_conf = '<br><div style="border:solid gray 1px;padding:2%;"><img id="image1" src="'+dataURL+'"></img><input type="hidden" class="form-control" name="signature1" id="signature1" value="'+ dataURL +'"><br><input type="text" class="form-control" name="name1" id="name1" value="'+ input1 +'" readonly></div><br><div style="border:solid gray 1px;padding:2%;"><img id="image1" src="'+dataURL2+'"></img><input type="hidden" class="form-control" name="signature2" id="signature2" value="'+ dataURL2 +'"><br><input type="text" class="form-control" name="name2" id="name2" value="'+ input2 +'" readonly></div><br><div style="border:solid gray 1px;padding:2%;"><img id="image1" src="'+dataURL3+'"></img><input type="hidden" class="form-control" name="signature3" id="signature3" value="'+ dataURL3 +'"><br><input type="text" class="form-control" name="name3" id="name3" value="'+ input3 +'" readonly></div>';

        $('.signatureArea').html(input_conf);

        // $(".sigWrapper").remove();

        $("#saveCompanySignatureDB1aM_web").val(dataURL);
        $("#saveCompanySignatureDB1aM_web2").val(dataURL2);
        $("#saveCompanySignatureDB1aM_web3").val(dataURL3);

        $(".output1").val(dataURL);
        $(".output2").val(dataURL2);
        $(".output3").val(dataURL3);

        $("#company_representative_printed_name").val(input1);
        $("#primary_account_holder_name").val(input2);
        $("#secondery_account_holder_name").val(input3);

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
    // var canvas = document.getElementById("canvas");    
    // var dataURL = canvas.toDataURL("image/png");
    // $("#saveCompanySignatureDB1aM").val(dataURL);

    // var canvas2 = document.getElementById("canvas2");    
    // var dataURL2 = canvas2.toDataURL("image/png");
    // $("#savePrimaryAccountSignatureDB2aM").val(dataURL2);

    // var canvas3 = document.getElementById("canvas3");    
    // var dataURL3 = canvas3.toDataURL("image/png");
    // $("#saveSecondaryAccountSignatureDB3aM").val(dataURL3);

$(document).on('click touchstart','#canvas',function(){
    // alert('test');
    var canvas_web = document.getElementById("canvas");    
    var dataURL = canvas_web.toDataURL("image/png");
    $("#saveCompanySignatureDB1aM").val(dataURL);
});

$(document).on('click touchstart','#canvas2',function(){
    // alert('test');
    var canvas_web2 = document.getElementById("canvas2");    
    var dataURL = canvas_web2.toDataURL("image/png");
    $("#savePrimaryAccountSignatureDB2aM").val(dataURL);
});

$(document).on('click touchstart','#canvas3',function(){
    // alert('test');
    var canvas_web3 = document.getElementById("canvas3");    
    var dataURL = canvas_web3.toDataURL("image/png");
    $("#saveSecondaryAccountSignatureDB3aM").val(dataURL);
});



$(document).on('click touchstart','.edit_first_signature',function(){
    // alert('test');
    var first = $("#saveCompanySignatureDB1aM").val();
    // alert(first);
    $("#saveCompanySignatureDB1aM_web").val(first);

    $(".img1").hide();

    var input_conf = '<img src="'+first+'">'

    $('#companyrep').html(input_conf);
    
    $('.companySignature').modal('hide');
    
});

$(document).on('click touchstart','.edit_second_signature',function(){
    // alert('test');
    var first = $("#savePrimaryAccountSignatureDB2aM").val();
    // alert(first);
    $("#saveCompanySignatureDB1aM_web2").val(first);

    $(".img2").hide();

    var input_conf = '<img src="'+first+'">'

    $('#primaryrep').html(input_conf);

    $('.primarySignature').modal('hide');
    
});

$(document).on('click touchstart','.edit_third_signature',function(){
    // alert('test');
    var first = $("#saveSecondaryAccountSignatureDB3aM").val();
    // alert(first);
    $("#saveCompanySignatureDB1aM_web3").val(first);

    $(".img3").hide();

    var input_conf = '<img src="'+first+'">'

    $('#secondaryrep').html(input_conf);

    $('.secondarySignature').modal('hide');
    
});
</script>

<script>
$(document).ready(function(){
    if(window.matchMedia("(max-width: 600px)").matches){
        // alert("This is a mobile device.");
        $(document).on("click", ".testing", function () {
            $('.getItems').hide();
            $('#item_typeid').removeClass('form-control');
            $(".sigWrapper").remove();
            // $(".output2").remove();
            // $(".output3").remove();
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

<script>
    $(document).on("focusout", "#one_time", function () {
        // alert('test');
        var counter = $(this).val();
        var m_monitoring = $("#m_monitoring").val();
        var subtotal = 0;
        // $("#span_total_0").each(function(){
            $('*[id^="span_total_"]').each(function(){
            subtotal += parseFloat($(this).text());
        });

        grand_tot = parseFloat(counter) + parseFloat(subtotal) + parseFloat(m_monitoring);
        //  alert(grand_tot);
        var grand = $("#grand_total_inputs_a").val(grand_tot.toFixed(2));
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
        var grand = $("#grand_total_inputs_a").val(grand_tot.toFixed(2));
    });

    // $(document).on("checked", "#same_as", function () {
    //     alert('yeah');
    // });
    </script>

<script type="text/javascript">
    $(function()
    {
      $('[id="same_as"]').change(function()
      {
        if ($(this).is(':checked')) {
        //    alert('get the location');

          var ship_address = $("#ship-address").val();
          var locality = $("#locality").val();
          var state = $("#state").val();
          var postcode = $("#postcode").val();
          var cross_street = $("#cross_street").val();

          $("#mail-address").val(ship_address);
          $("#mail_locality").val(locality);
          $("#mail_state").val(state);
          $("#mail_postcode").val(postcode);
          $("#mail_cross_street").val(cross_street);

        }else{
            $("#mail-address").val('');
            $("#mail_locality").val('');
            $("#mail_state").val('');
            $("#mail_postcode").val('');
            $("#mail_cross_street").val('');
        }
      });
    });
  </script>

    <script>
      // This sample uses the Places Autocomplete widget to:
      // 1. Help the user select a place
      // 2. Retrieve the address components associated with that place
      // 3. Populate the form fields with those address components.
      // This sample requires the Places library, Maps JavaScript API.
      // Include the libraries=places parameter when you first load the API.
      // For example: <script
      // src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
      let autocomplete;
      let address1Field;
      let address2Field;
      let postalField;

      function initAutocomplete() {
        address1Field = document.querySelector("#ship-address");
        address2Field = document.querySelector("#address2");
        postalField = document.querySelector("#postcode");
        // Create the autocomplete object, restricting the search predictions to
        // addresses in the US and Canada.
        autocomplete = new google.maps.places.Autocomplete(address1Field, {
          componentRestrictions: { country: ["us", "ca"] },
          fields: ["address_components"],
          types: ["address"],
        });
        address1Field.focus();
        // When the user selects an address from the drop-down, populate the
        // address fields in the form.
        autocomplete.addListener("place_changed", fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        const place = autocomplete.getPlace();
        let address1 = "";
        let postcode = "";

        // Get each component of the address from the place details,
        // and then fill-in the corresponding field on the form.
        // place.address_components are google.maps.GeocoderAddressComponent objects
        // which are documented at http://goo.gle/3l5i5Mr
        for (const component of place.address_components) {
          const componentType = component.types[0];

          switch (componentType) {
            case "street_number": {
              address1 = `${component.long_name} ${address1}`;
              break;
            }

            case "route": {
              address1 += component.short_name;
              break;
            }

            case "postal_code": {
              postcode = `${component.long_name}${postcode}`;
              break;
            }

            // case "postal_code_suffix": {
            //   postcode = `${postcode}-${component.long_name}`;
            //   break;
            // }
            case "locality":
              document.querySelector("#locality").value = component.long_name;
              break;

            case "administrative_area_level_1": {
              document.querySelector("#state").value = component.short_name;
              break;
            }
            // case "country":
            //   document.querySelector("#country").value = component.long_name;
            //   break;
          }
        }
        address1Field.value = address1;
        postalField.value = postcode;
        // After filling the form with address components from the Autocomplete
        // prediction, set cursor focus on the second address line to encourage
        // entry of subpremise information such as apartment, unit, or floor number.
        address2Field.focus();
      }
    </script>
    <!-- <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlMWhWMHlxQzuolWb2RrfUeb0JyhhPO9c&callback=initAutocomplete&libraries=places&v=weekly"
      async
    ></script> -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?= google_credentials()['api_key'] ?>&callback=initialize&libraries=&v=weekly"></script>

    <script>
        // function validatecard() {
        //     var inputtxt = $('.card-number').val();

        //     if (inputtxt == 4242424242424242) {
        //         $('.require-validation').submit();
        //     } else {
        //         alert("Not a valid card number!");
        //         return false;
        //     }
        // }

        $(document).ready(function () {

            // phone type change, add the value to hiddend field and show the text
            $(document.body).on('click', '.changePhoneType', function () {
                $(this).closest('.phone-input').find('.type-text').text($(this).text());
                $(this).closest('.phone-input').find('.type-input').val($(this).data('type-value'));
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
$("#headerContent").html(function() { 

// Replace 'ok' with string you want to change, you can delete 'hello everyone' to remove the text
 var currentDate = $('#current_date').val();
      return $(this).html().replace("{curr_date}", currentDate);  

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
// $(document).on('onchange','#customer_type',function(){
//     //    alert('yeah');
// });

document.getElementById("customer_type").onchange = function() {
    if (this.value == 'Commercial') {
        // alert('in');
         $('#business_name_area').show();
    	}
    else if(this.value == 'Residential'){
        $('#business_name_area').hide();
        }
    else if(this.value == 'Advance'){
        $('#business_name_area').hide();
        }

	}

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
// $(document).on("click",".pdf_sheet", function(){
//     // window.open(url, '_blank');
//     // alert('yes!');
//     var subjectID = $("#workorder_number").val();
//     // $("#workorder_number").val();view_workorder_number
//     // var session = $("#SessionFrom").val()+"-"+$("#SessionTo").val();
//     // var courseID = $("#classesID").val();
//     // var yearsOrSemester = $("#yearSemesterID").val();
//     // var form = '';
//     // form += '<input type="hidden" name="subjectID" value="' + subjectID + '">';
//     // form += '<input type="hidden" name="session" value="' + session + '">';
//     // form += '<input type="hidden" name="courseID" value="' + courseID + '">';
//     // form += '<input type="hidden" name="yearsOrSemester" value="' + yearsOrSemester+ '">';
//     // form += '</form>';
//     // $('body').append(form);
//     // $('#static_form').submit();
//     $.ajax({
//         type : 'POST',
//         url : "<?php echo base_url(); ?>workorder/preview",
//         // data : {dataURL: dataURL},
//         success: function(result){
//         // $('#res').html('Signature Uploaded successfully');
//         alert('yes');
//         // console.log(dataURL)
//         // location.reload();
        
//         },
//     });


// });
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
$(document).ready(function(){
    var payment_method = $('#payment_method').val();
    
    if (payment_method == 'Cash') {
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
    else if(payment_method == 'Invoicing'){

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
	
    else if(payment_method == 'Check'){
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
    else if(payment_method == 'Credit Card'){
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
    else if(payment_method == 'Debit Card'){
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
    else if(payment_method == 'ACH'){
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
    else if(payment_method == 'Venmo'){
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
    else if(payment_method == 'Paypal'){
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
    else if(payment_method == 'Square'){
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
    else if(payment_method == 'Warranty Work'){
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
    else if(payment_method == 'Home Owner Financing'){
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
    else if(payment_method == 'e-Transfer'){
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
    else if(payment_method == 'Other Credit Card Professor'){
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
    else if(payment_method == 'Other Payment Type'){
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
});
</script>
<script>
$('#ssn').keyup(function() {
  var foo = $(this).val().split("-").join(""); // remove hyphens
  if (foo.length > 0) {
    foo = foo.match(new RegExp('.{1,4}', 'g')).join("-");
  }
  $(this).val(foo);
});
</script>
<script>
  $( function() {
    $( "#datepicker_dateissued" ).datepicker({
        format: 'mm/dd/yyyy'
    });
  } );
</script>