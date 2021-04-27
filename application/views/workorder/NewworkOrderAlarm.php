<?php include viewPath('includes/header'); ?>

<style>
  .custom-signaturepad {
    padding-left: 0;
    padding-right: 0;
  }
  .custom-signaturepad .sigWrapper canvas {
      width: 100%;
  }
  .custom-signaturepad .sigPad  {
    width: 100% !important;
  }
  #group_area{
    background-color:#F9F9F9;
  }
  #group_area:hover{
    background-color:#EBFFE2;
  }
/* 
  #company_representative_approval_signature1a{
  border: solid 1px blue;  
  width: 100%;
} */

#signature-pad {min-height:200px;}
#signature-pad canvas {background-color:white;left: 0;top: 0;width: 100%;min-height:250px;height: 100%}

#signature-pad2 {min-height:200px;}
#signature-pad2 canvas {background-color:white;left: 0;top: 0;width: 100%;min-height:250px;height: 100%}

#signature-pad3 {min-height:200px;}
#signature-pad3 canvas {background-color:white;left: 0;top: 0;width: 100%;min-height:250px;height: 100%}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/workorder'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Workorder</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">ALARM SYSTEM WORKORDER AGREEMENT</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <?php //if (hasPermissions('WORKORDER_MASTER')) : ?>
                                    <a href="<?php echo url('workorder') ?>" class="btn btn-primary"
                                       aria-expanded="false">
                                        <i class="mdi mdi-settings mr-2"></i> Go Back to Workorder
                                    </a>
                                <?php //endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <?php echo form_open_multipart('workorder/savenewWorkorderAlarm', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?> 


            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                        <div id="header_area">
                                <ol class="breadcrumb" style="margin-top:-30px;"> <i class="fa fa-pencil" aria-hidden="true"></i>
                                            <li class="breadcrumb-item active">
                                                <label style="background-color:#E8E8E9;" id="headerContent"><?php echo $headers->content; ?></label>
                                                <input type="hidden" name="header" value="<?php echo $headers->content; ?>">
                                            </li>
                                        </ol>

                                        <input type="hidden" id="company_name" value="<?php echo $clients->business_name; ?>">
                                <input type="hidden" id="current_date" value="<?php echo @date('m-d-Y'); ?>">

                                <input type="hidden" id="content_input" class="form-control" name="header" value="<?php echo $headers->content; ?>">
                            </div>
                            <!-- ====== CUSTOMER ====== -->
							 <div class="row" id="group_area">
								<div class="col-md-12">
									<div class="row">
										<div class="form-group col-md-12">
											<h5 class="box-title">Customer</h5>
										</div>
										<div class="col-md-4 form-group">
											<label for="">Customer Type</label><br/>
											<select name="customer_type"
													class="form-control"
													id="customer_type">
												<?php foreach (get_config_item('customer_types') as $key => $customer_type) { ?>
													<option value="<?php echo $customer_type ?>" <?php echo (!empty($workorder->customer['customer_type']) && $workorder->customer['customer_type'] == $customer_type) ? "selected" : "" ?>>
														<?php echo $customer_type ?>
													</option>
												<?php } ?>
											</select>
										</div>

                                        <div class="col-md-4 form-group" style="display:none;" id="business_name_area">
											<label for="customer_install_type">Business Name</label><br/>
											<input type="text" class="form-control" name="business_name" id="business_name" placeholder="Enter Name" />
										</div>

										<div class="col-md-4 form-group">
											<label for="customer_install_type">Install Type</label><br/>
											<select name="install_type"
													class="form-control"
													id="customer_install_type">
												<?php foreach (get_config_item('install_types') as $key => $install_type) { ?>
													<option value="<?php echo $install_type ?>" <?php echo (!empty($workorder->customer['install_type']) && $workorder->customer['install_type'] == $install_type) ? "selected" : "" ?>>
														<?php echo $install_type ?>
													</option>
												<?php } ?>
											</select>
										</div>
										<div class="col-md-4 form-group"
											 style="display: <?php echo (!empty($workorder->customer['install_type']) && $workorder->customer['install_type'] == 'Takeover') ? 'block' : 'none' ?>">
											<label for="customer_company_name">
												Company Name </label>
											<input type="text" class="form-control" name="customer[company_name]"
												   id="customer_company_name"
												   value="<?php echo (!empty($workorder->customer['company_name'])) ? $workorder->customer['company_name'] : '' ?>" 
												   placeholder="Enter Company Name" <?php echo (!empty($workorder->customer['install_type']) && $workorder->customer['install_type'] == 'Takeover') ? "" : 'disabled' ?> />
										</div>
									</div>

									<div class="row">
										<div class="col-md-3 form-group">
											<label for="last_name">Last Name</label>
											<input type="text" class="form-control" name="last_name"
												   id="last_name"
												   required placeholder="Enter Last Name"
												   value="<?php echo (!empty($workorder->customer['last_name'])) ? $workorder->customer['last_name'] : '' ?>"/>
										</div>
										<div class="col-md-3 form-group">
											<label for="first_name">First Name</label>
											<input type="text" class="form-control" name="first_name"
												   id="first_name" required
												   required placeholder="Enter First Name" />
										</div>
										<div class="col-md-2 form-group">
											<label for="contact_mobile">Mobile</label>
											<input type="text" class="form-control" name="mobile_number" required
												   id="contact_mobile" />

										</div>

										<div class="col-md-2 form-group">
											<label for="contact_dob">DOB</label>
											<input type="text" class="form-control" name="dob"
												   id="customer_contact_dob" required
												   value="<?php echo (!empty($workorder->customer['contact_dob'])) ? date('m/d/Y', strtotime($workorder->customer['contact_dob'])) : '' ?>"
												   placeholder="Enter DOB"/>
										</div>

										<div class="col-md-2 form-group">
											<label for="contact_ssn">SSN</label>
											<input type="text" class="form-control" name="security_number"
												   id="contact_ssn"
												   value="<?php echo (!empty($workorder->customer['contact_ssn'])) ? $workorder->customer['contact_ssn'] : '' ?>"
												   required
												   placeholder="Enter SSN"/>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<span class="help help-sm">Spouse</span>
										</div>
										<div class="col-md-3 form-group">
											<label for="spouse_last_name">Last Name</label>
											<input type="text" class="form-control" name="s_last_name"
												   id="spouse_last_name"
												     placeholder="Enter Last Name" />
										</div>
										<div class="col-md-3 form-group">
											<label for="spouse_first_name">First Name</label>
											<input type="text" class="form-control" name="s_first_name"
												   id="spouse_first_name"
												     placeholder="Enter First Name"
												   value="<?php echo (!empty($workorder->customer['spouse_first_name'])) ? $workorder->customer['spouse_first_name'] : '' ?>"/>
										</div>
										<div class="col-md-2 form-group">
											<label for="spouse_contact_mobile">Mobile</label>
											<input type="text" class="form-control" name="s_mobile"
												   id="spouse_contact_mobile"
												   value="<?php echo (!empty($workorder->customer['spouse_contact_mobile'])) ? $workorder->customer['spouse_contact_mobile'] : '' ?>"
												   placeholder="Enter Mobile"/>

										</div>

										<div class="col-md-2 form-group">
											<label for="contact_dob">DOB</label>
											<input type="text" class="form-control" name="s_dob"
												   id="customer_spouse_contact_dob"
												   value="<?php echo (!empty($workorder->customer['spouse_contact_dob'])) ? date('m/d/Y', strtotime($workorder->customer['spouse_contact_dob'])) : '' ?>"
												   placeholder="Enter DOB"/>
										</div>

										<div class="col-md-2 form-group">
											<label for="spouse_contact_ssn">SSN</label>
											<input type="text" class="form-control" name="s_ssn"
												   id="spouse_contact_ssn"
												   value="<?php echo (!empty($workorder->customer['spouse_contact_ssn'])) ? $workorder->customer['spouse_contact_ssn'] : '' ?>"
												   placeholder="Enter SSN"/>
										</div>
									</div>

									<div class="row">
										<div class="col-md-3 form-group">
											<label for="monitored_location">Monitored Location</label>
											<input type="text" class="form-control" name="monitored_location"
												   id="ship-address"
												   value="<?php echo (!empty($workorder->customer['monitored_location'])) ? $workorder->customer['monitored_location'] : '' ?>"
												   required placeholder="Monitored Location"/>
										</div>
										<div class="col-md-3 form-group">
											<label for="city">City</label> 
                                                   <input type="text" class="form-control" name="city" id="locality" placeholder="Enter Name" />
										</div>
										<div class="col-md-2 form-group">
											<label for="state">State</label>
											<input type="text" class="form-control" name="state"
												   id="state" />

										</div>

										<div class="col-md-2 form-group">
											<label for="zip">ZIP</label> 
                                                   <input type="text" id="postcode" name="zip_code" class="form-control"  placeholder="Enter Zip"/>
										</div>

										<div class="col-md-2 form-group">
											<label for="cross_street">Cross Street</label>
											<input type="text" class="form-control" name="cross_street"
												   id="cross_street"
												   value="<?php echo (!empty($workorder->customer['cross_street'])) ? $workorder->customer['cross_street'] : '' ?>"
												   required
												   placeholder="Cross Street"/>
										</div>
									</div>

									<div class="row">
										<div class="col-md-3 form-group">
											<label for="email">Email</label>
											<input type="text" class="form-control" name="email"
												   id="email" 
												   value="<?php echo (!empty($workorder->customer['email'])) ? $workorder->customer['email'] : '' ?>"
												   required placeholder="Enter Email"/>
										</div>
										<div class="col-md-2 form-group">
											<label for="password">Password</label>
											<input type="text" class="form-control" name="password" required
												   id="password" >
										</div>
                                        
                                        <div class="col-md-3 form-group">
                                            <label for="">Notification Type</label><br/>
                                                <select name="notification_type" id="customer_notification_type_email" class="form-control" required>
                                                    <option>Notification Type</option>
                                                    <option value="Text">Text</option>
                                                    <option value="Email">Email</option>
                                                    <option value="Text and Email">Text and Email</option>
                                                    <option value="None">None</option>
                                                </select>
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="1st_call_verification_name">1st Call Verification Name</label>
                                        <input type="text" class="form-control"
                                               name="1st_verification_name"
                                               value="<?php echo (!empty($workorder->emergency_call_list['1st_call_verification_name'])) ? $workorder->emergency_call_list['1st_call_verification_name'] : '' ?>"
                                               id="1st_call_verification_name"
                                               required placeholder="Enter 1st Call Verification Name"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contact_phone">Phone Number</label>
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
                                            <input type="hidden" name="1st_number_type"
                                                   class="type-input"
                                                   value="<?php echo (!empty($workorder->emergency_call_list['phone']['type'][0])) ? $workorder->emergency_call_list['phone']['type'][0] : '' ?>"
                                                   value="mobile"/>
                                            <input type="text" name="1st_number"
                                                   class="form-control"
                                                   value="<?php echo (!empty($workorder->emergency_call_list['phone']['number'][0])) ? $workorder->emergency_call_list['phone']['number'][0] : '' ?>"
                                                   placeholder="Enter Phone"/>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="emergency_call_relation">Relation</label>
                                        <input type="text" class="form-control" name="1st_relation"
                                               id="emergency_call_relation"
                                               value="<?php echo (!empty($workorder->emergency_call_list['relation'][0])) ? $workorder->emergency_call_list['relation'][0] : '' ?>"
                                               required placeholder="Enter Relation"/>
                                    </div>
                                </div>
                                <!-- <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="emergency_carrier_name">Carrier Name</label>
                                        <input type="text" class="form-control"
                                               name="emergency_call_list[carrier_name][]"
                                               id="emergency_carrier_name"
                                               value="<?php echo (!empty($workorder->emergency_call_list['carrier_name'][0])) ? $workorder->emergency_call_list['carrier_name'][0] : '' ?>"
                                               required placeholder="Enter Carrier Name"/>
                                    </div>
                                </div> -->

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="2nd_call_verification_name">2nd Call Verification Name</label>
                                        <input type="text" class="form-control"
                                               name="2nd_verification_name"
                                               id="2nd_call_verification_name"
                                               value="<?php echo (!empty($workorder->emergency_call_list['2nd_call_verification_name'])) ? $workorder->emergency_call_list['2nd_call_verification_name'] : '' ?>"
                                               required placeholder="Enter 2nd Call Verification Name"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contact_phone">Phone Number</label>
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
                                                   value="<?php echo (!empty($workorder->emergency_call_list['phone']['type'][1])) ? $workorder->emergency_call_list['phone']['type'][1] : '' ?>"
                                                   value="mobile"/>
                                            <input type="text" name="2nd_number"
                                                   class="form-control"
                                                   value="<?php echo (!empty($workorder->emergency_call_list['phone']['number'][1])) ? $workorder->emergency_call_list['phone']['number'][1] : '' ?>"
                                                   placeholder="Enter Phone"/>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="emergency_call_relation">Relation</label>
                                        <input type="text" class="form-control" name="2nd_relation"
                                               id="emergency_call_relation"
                                               value="<?php echo (!empty($workorder->emergency_call_list['relation'][1])) ? $workorder->emergency_call_list['relation'][1] : '' ?>"
                                               required placeholder="Enter Relation"/>
                                    </div>
                                </div>
                                <!-- <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="emergency_carrier_name">Carrier Name</label>
                                        <input type="text" class="form-control"
                                               name="emergency_call_list[carrier_name][]"
                                               id="emergency_carrier_name"
                                               value="<?php echo (!empty($workorder->emergency_call_list['carrier_name'][1])) ? $workorder->emergency_call_list['carrier_name'][1] : '' ?>"
                                               required placeholder="Enter Carrier Name"/>
                                    </div>
                                </div> -->

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="emergency_call_emergency_contact_1">3rd Call Verification Name</label>
                                        <input type="text" class="form-control"
                                               name="3rd_verification_name"
                                               id="emergency_call_emergency_contact_1"
                                               value="<?php echo (!empty($workorder->emergency_call_list['emergency_contact_1'])) ? $workorder->emergency_call_list['emergency_contact_1'] : '' ?>"
                                               required placeholder="Enter Emergency Contact"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contact_phone">Phone Number</label>
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
                                                   value="<?php echo (!empty($workorder->emergency_call_list['phone']['type'][2])) ? $workorder->emergency_call_list['phone']['type'][2] : '' ?>"
                                                   value="mobile"/>
                                            <input type="text" name="3rd_number"
                                                   class="form-control"
                                                   value="<?php echo (!empty($workorder->emergency_call_list['phone']['number'][2])) ? $workorder->emergency_call_list['phone']['number'][2] : '' ?>"
                                                   placeholder="Enter Phone"/>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="emergency_call_relation">Relation</label>
                                        <input type="text" class="form-control" name="3rd_relation"
                                               id="emergency_call_relation"
                                               value="<?php echo (!empty($workorder->emergency_call_list['relation'][2])) ? $workorder->emergency_call_list['relation'][2] : '' ?>"
                                               required placeholder="Enter Relation"/>
                                    </div>
                                </div>

                                <!-- <div class="col-md-3">
								</div> -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="emergency_call_emergency_contact_2">4th Call Verification Name</label>
                                        <input type="text" class="form-control"
                                               name="4th_verification_name"
                                               id="emergency_call_emergency_contact_2"
                                               value="<?php echo (!empty($workorder->emergency_call_list['emergency_contact_2'])) ? $workorder->emergency_call_list['emergency_contact_2'] : '' ?>"
                                               required placeholder="Enter Emergency Contact"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contact_phone">Phone Number</label>
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
                                                   value="<?php echo (!empty($workorder->emergency_call_list['phone']['type'][3])) ? $workorder->emergency_call_list['phone']['type'][3] : '' ?>"
                                                   value="mobile"/>
                                            <input type="text" name="4th_number"
                                                   class="form-control"
                                                   value="<?php echo (!empty($workorder->emergency_call_list['phone']['number'][3])) ? $workorder->emergency_call_list['phone']['number'][3] : '' ?>"
                                                   placeholder="Enter Phone"/>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="emergency_call_relation">Relation</label>
                                        <input type="text" class="form-control" name="4th_relation"
                                               id="emergency_call_relation"
                                               value="<?php echo (!empty($workorder->emergency_call_list['relation'][3])) ? $workorder->emergency_call_list['relation'][3] : '' ?>"
                                               required placeholder="Enter Relation"/>
                                    </div>
                                </div>
                            </div>

                            <!-- ====== CUSTOMER ACCOUNT INFORMATION ====== -->
                            <div class="row" id="group_area">
                                <div class="form-group col-md-12">
                                    <h5 class="box-title">Customer System Information</h5>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="street_address"> Plan Type:</label>
                                        <!-- <select
                                                name="plan_type"
                                                id="plan_type"
                                                class="form-control">
                                            <option>Select Plan Type</option>
                                        </select> -->
                                        <select name="plan_type" id="plan_types" class="form-control" required>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == ''){echo "selected";} } ?> value=""></option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'DIGI'){echo "selected";} } ?> value="DIGI">Landline</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'DW2W'){echo "selected";} } ?> value="DW2W">Landline W/ 2-Way</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'DWCB'){echo "selected";} } ?> value="DWCB">Landline W/ Cell Backup</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'D2CB'){echo "selected";} } ?> value="D2CB">Landline W/ 2-Way &amp; Cell Backup</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'CPDB'){echo "selected";} } ?> value="CPDB">Cell Primary</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'CP2W'){echo "selected";} } ?> value="CP2W">Cell Primary w/2Way</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'WSF'){echo "selected";} } ?> value="WSF">Wireless Signal Forwarding</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'C'){echo "selected";} } ?> value="C">Commercial</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'CP'){echo "selected";} } ?> value="CP">Commercial Plus</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'I'){echo "selected";} } ?> value="I">Interactive</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'IG'){echo "selected";} } ?> value="IG">Interactive Gold</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'IPA'){echo "selected";} } ?> value="IPA">Interactive Plus Automation</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'IwDVR'){echo "selected";} } ?> value="IwDVR">Interactive w/DVR</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'IwDB'){echo "selected";} } ?> value="IwDB">Interactive w/Dbell</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'IwDBIP'){echo "selected";} } ?> value="IwDBIP">Interactive w/Dbell & IP Camera</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'PERS'){echo "selected";} } ?> value="PERS">PERS</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'WIFI'){echo "selected";} } ?> value="WIFI">WIFI</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'CPwWIFI'){echo "selected";} } ?> value="CPwWIFI">Cell Primary w/WIFI</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'CPwAC'){echo "selected";} } ?> value="CPwAC">Cell Primary w/Access Control</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'IwAC'){echo "selected";} } ?> value="IwAC">Interactive w/Access Control</option>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->system_type == 'IwACwA'){echo "selected";} } ?> value="IwACwA">Interactive w/Access Control w/Automn</option>
                                        </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="col-md-12">
                                        <label>Account Type</label>
                                    </div>
                                    <div class="col-md-12">
                                        <select name="account_type"
                                                class="form-control"
                                                id="account_type" required>
                                            <option>--SELECT--</option>
                                            <?php foreach (get_config_item('account_types') as $key => $account_type) { ?>
                                                <option value="<?php echo $account_type ?>"
                                                    <?php echo (!empty($workorder->account_type['name'])
                                                        && $workorder->account_type['name'] == $account_type) ?
                                                        "selected" : "" ?>>
                                                    <?php echo $account_type ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        <div class="form-group mt-2"
                                             style="display: <?php echo (empty($workorder->account_type['other'])) ? 'none' : '' ?>">
                                            <input name="account_type[other]"
                                                   type="text" class="form-control"
                                                   value="<?php echo (!empty($workorder->account_type['other'])) ?
                                                       $workorder->account_type['other'] : '' ?>"
                                                   placeholder="Write it here..." required>
                                        </div>
                                    </div>

                                </div>

                                    <!-- ====== EQUIPMENT ====== -->
                                <!-- <div class="row"> -->
                                    <div class="col-md-4">
                                        <label>Panel Type</label>
                                        <select name="panel_type" id="panel_type" class="form-control" required>
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == ''){echo "selected";} } ?> value=""></option>
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
                                            <option <?php if(isset($alarm_info)){ if($alarm_info->panel_type == 'Honeywell'){echo "selected";} } ?> value="Honeywell Vista with Sim">Honeywell Vista with Sim</option>
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

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="panel_location"> Panel Location:</label>
                                            <input type="text" class="form-control" name="panel_location"
                                                value="<?php echo (!empty($workorder->panel_location)) ? $workorder->panel_location : '' ?>"
                                                id="panel_location" placeholder=""/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="panel_communication"> Panel Communication:</label>
                                            <select name="panel_communication"
                                                    class="form-control"
                                                    id="panel_communication">
                                                <option>--SELECT--</option>
                                                <?php foreach (get_config_item('panel_communications') as $key => $panel_communication) { ?>
                                                    <option value="<?php echo $panel_communication ?>" <?php echo (!empty($workorder->panel_communication) && $workorder->panel_communication == $panel_communication) ? 'selected' : '' ?>>
                                                        <?php echo $panel_communication ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                <!-- </div> -->

                                
                            </div>

                            

                            <!-- ====== JOB ====== -->
                            <div class="row" id="group_area">
                                <div class="form-group col-md-12">
                                    <h5 class="box-title">Job</h5>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="date_w_issued"> Requested Date:</label>
                                        <div class='input-group date datepicker'>
                                            <input type='text'
                                                   value="<?php echo (!empty($workorder->date_issued)) ?
                                                       date('m/d/Y', strtotime($workorder->date_issued)) : '' ?>"
                                                   name="date_issued"
                                                   class="form-control"
                                                   id="date_w_issued"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="job_type_id"> Job Type:</label>
                                        <select name="job_type" id="job_type" class="form-control custom-select">
                                    <?php foreach($job_types as $jt){ ?>
                                        <option value="<?php echo $jt->title ?>"><?php echo $jt->title ?></option>

                                    <?php } ?>
                                        <!-- <option value="Service">Service</option>
                                        <option value="Design">Design</option>
                                        <option value="Maintenance">Maintenance</option>
                                        <option value="Repair">Repair</option>
                                        <option value="Replace">Replace</option> -->
                                    </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="job_type_id">Job Tag</label>
                                        <select name="job_tag" id="job_tag" class="form-control custom-select">
                                        <?php foreach($job_tags as $tags){ ?>
                                                <option value="<?php echo $tags->name; ?>"><?php echo $tags->name; ?><option>
                                            <?php } ?>
                                    </select>
                                    </div>
                                </div>
                                

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status_id"> Status:</label>
                                        <select name="status" id="workorder_status" class="form-control custom-select">
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
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="job_priority"> Priority:</label> 
                                        <select name="priority" id="workorder_priority" class="form-control custom-select">
                                        <option value="Standard">Standard</option>
                                        <option value="Emergency">Emergency</option>
                                        <option value="Low">Low</option>
                                        <option value="Urgent">Urgent</option>                
                                    </select>
                                    </div>
                                </div>

                            </div>

                            <!-- ====== ENHANCED SERVICES ====== -->
                            <div class="row" id="group_area">
                                <div class="form-group col-md-12">
                                    <h5 class="box-title">Enhanced Services</h5>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="panel-group">
                                        <div class="panels panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" href="#collapse1">Cameras <i
                                                                class="fa fa-angle-down"
                                                                style="font-size: 31px;top: 4px;position: relative;font-weight: bolder;"></i></a>
                                                </h4>
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
                                                                   name="ip_cameras[honeywell][wo]"
                                                                   value="<?php echo (!empty($workorder->ip_cameras)) ? $workorder->ip_cameras['honeywell']['wo'] : '' ?>"
                                                                   placeholder=""/>
                                                        </td>
                                                        <td style="min-width:80px;"><input type="text" class="form-control"
                                                                   value="<?php echo (!empty($workorder->ip_cameras)) ? $workorder->ip_cameras['honeywell']['wi'] : '' ?>"
                                                                   name="ip_cameras[honeywell][wi]" placeholder=""/>
                                                        </td>
                                                        <td style="min-width:80px;"><input type="text" class="form-control"
                                                                   value="<?php echo (!empty($workorder->ip_cameras)) ? $workorder->ip_cameras['honeywell']['doorbell_cam'] : '' ?>"
                                                                   name="ip_cameras[honeywell][doorbell_cam]"
                                                                   placeholder=""/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Alarm.com</td>
                                                        <td style="min-width:80px;"><input type="text" class="form-control"
                                                                   value="<?php echo (!empty($workorder->ip_cameras)) ? $workorder->ip_cameras['avycon']['wo'] : '' ?>"
                                                                   name="ip_cameras[avycon][wo]" placeholder=""/>
                                                        </td>
                                                        <td style="min-width:80px;"><input type="text" class="form-control"
                                                                   value="<?php echo (!empty($workorder->ip_cameras)) ? $workorder->ip_cameras['avycon']['wi'] : '' ?>"
                                                                   name="ip_cameras[avycon][wi]" placeholder=""/>
                                                        </td>
                                                        <td style="min-width:80px;"><input type="text" class="form-control"
                                                                   value="<?php echo (!empty($workorder->ip_cameras)) ? $workorder->ip_cameras['avycon']['doorbell_cam'] : '' ?>"
                                                                   name="ip_cameras[avycon][doorbell_cam]"
                                                                   placeholder=""/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Other</td>
                                                        <td style="min-width:80px;"><input type="text" class="form-control"
                                                                   value="<?php echo (!empty($workorder->ip_cameras)) ? $workorder->ip_cameras['other']['wo'] : '' ?>"
                                                                   name="ip_cameras[other][wo]" placeholder=""/>
                                                        </td>
                                                        <td style="min-width:80px;"><input type="text" class="form-control"
                                                                   value="<?php echo (!empty($workorder->ip_cameras)) ? $workorder->ip_cameras['other']['wi'] : '' ?>"
                                                                   name="ip_cameras[other][wi]" placeholder=""/>
                                                        </td>
                                                        <td style="min-width:80px;"><input type="text" class="form-control"
                                                                   value="<?php echo (!empty($workorder->ip_cameras)) ? $workorder->ip_cameras['other']['doorbell_cam'] : '' ?>"
                                                                   name="ip_cameras[other][doorbell_cam]"
                                                                   placeholder=""/>
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
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" href="#collapse2">Doorlocks: <i
                                                                class="fa fa-angle-down"
                                                                style="font-size: 31px;top: 4px;position: relative;font-weight: bolder;"></i></a>
                                                </h4>
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
                                                                       name="doorlocks[deadbolt][brass]"
                                                                       value="<?php echo (!empty($workorder->doorlocks)) ? $workorder->doorlocks['deadbolt']['brass'] : '' ?>"
                                                                       placeholder=""/>
                                                            </td>
                                                            <td style="min-width:80px;"><input type="text" class="form-control"
                                                                       value="<?php echo (!empty($workorder->doorlocks)) ? $workorder->doorlocks['deadbolt']['nickal'] : '' ?>"
                                                                       name="doorlocks[deadbolt][nickal]"
                                                                       placeholder=""/>
                                                            </td>
                                                            <td style="min-width:80px;"><input type="text" class="form-control"
                                                                       value="<?php echo (!empty($workorder->doorlocks)) ? $workorder->doorlocks['deadbolt']['bronze'] : '' ?>"
                                                                       name="doorlocks[deadbolt][bronze]"
                                                                       placeholder=""/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Handle</td>
                                                            <td style="min-width:80px;"><input type="text" class="form-control"
                                                                       value="<?php echo (!empty($workorder->doorlocks)) ? $workorder->doorlocks['handle']['brass'] : '' ?>"
                                                                       name="doorlocks[handle][brass]" placeholder=""/>
                                                            </td>
                                                            <td style="min-width:80px;"><input type="text" class="form-control"
                                                                       value="<?php echo (!empty($workorder->doorlocks)) ? $workorder->doorlocks['handle']['nickal'] : '' ?>"
                                                                       name="doorlocks[handle][nickal]" placeholder=""/>
                                                            </td>
                                                            <td style="min-width:80px;"><input type="text" class="form-control"
                                                                       value="<?php echo (!empty($workorder->doorlocks)) ? $workorder->doorlocks['handle']['bronze'] : '' ?>"
                                                                       name="doorlocks[handle][bronze]" placeholder=""/>
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
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" href="#collapse3">DVR <i
                                                                class="fa fa-angle-down"
                                                                style="font-size: 31px;top: 4px;position: relative;font-weight: bolder;"></i></a>
                                                </h4>
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
                                                                   value="<?php echo (!empty($workorder->dvr_nvr)) ? $workorder->dvr_nvr['honeywell']['4_channel'] : '' ?>"
                                                                   name="dvr_nvr[honeywell][4_channel]" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                   value="<?php echo (!empty($workorder->dvr_nvr)) ? $workorder->dvr_nvr['honeywell']['8_channel'] : '' ?>"
                                                                   name="dvr_nvr[honeywell][8_channel]" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                   value="<?php echo (!empty($workorder->dvr_nvr)) ? $workorder->dvr_nvr['honeywell']['16_channel'] : '' ?>"
                                                                   name="dvr_nvr[honeywell][16_channel]"
                                                                   placeholder=""/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Alarm.com</td>
                                                        <td><input type="text" class="form-control"
                                                                   value="<?php echo (!empty($workorder->dvr_nvr)) ? $workorder->dvr_nvr['avycon']['4_channel'] : '' ?>"
                                                                   name="dvr_nvr[avycon][4_channel]" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                   value="<?php echo (!empty($workorder->dvr_nvr)) ? $workorder->dvr_nvr['avycon']['8_channel'] : '' ?>"
                                                                   name="dvr_nvr[avycon][8_channel]" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                   value="<?php echo (!empty($workorder->dvr_nvr)) ? $workorder->dvr_nvr['avycon']['16_channel'] : '' ?>"
                                                                   name="dvr_nvr[avycon][16_channel]" placeholder=""/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Other</td>
                                                        <td><input type="text" class="form-control"
                                                                   value="<?php echo (!empty($workorder->dvr_nvr)) ? $workorder->dvr_nvr['other']['4_channel'] : '' ?>"
                                                                   name="dvr_nvr[other][4_channel]" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                   value="<?php echo (!empty($workorder->dvr_nvr)) ? $workorder->dvr_nvr['other']['8_channel'] : '' ?>"
                                                                   name="dvr_nvr[other][8_channel]" placeholder=""/>
                                                        </td>
                                                        <td><input type="text" class="form-control"
                                                                   value="<?php echo (!empty($workorder->dvr_nvr)) ? $workorder->dvr_nvr['other']['16_channel'] : '' ?>"
                                                                   name="dvr_nvr[other][16_channel]" placeholder=""/>
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
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" href="#collapse4">AUTOMATION <i
                                                                class="fa fa-angle-down"
                                                                style="font-size: 31px;top: 4px;position: relative;font-weight: bolder;"></i></a>
                                                </h4>
                                            </div>
                                            <div id="collapse4" class="panel-collapse collapse">
                                                <table class="table" style="width:30%;">
                                                    <tr>
                                                        <!-- <th></th> -->
                                                        <th>Thermostats</th>
                                                        <th>Lights & Bulbs</th>
                                                    </tr>
                                                    <tr>
                                                        <!-- <td></td> -->
                                                        <td style="min-width:100px;"><input type="text" class="form-control"
                                                                   value="<?php echo (!empty($workorder->automation)) ? $workorder->automation['thermostats'][0] : '' ?>"
                                                                   name="automation[thermostats][]" placeholder=""/>
                                                        </td>
                                                        <td style="min-width:100px;"><input type="text" class="form-control"
                                                                   value="<?php echo (!empty($workorder->automation)) ? $workorder->automation['light_bulbs'][0] : '' ?>"
                                                                   name="automation[light_bulbs][]" placeholder=""/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <!-- <td></td> -->
                                                        <td style="min-width:100px;"><input type="text" class="form-control"
                                                                   value="<?php echo (!empty($workorder->automation)) ? $workorder->automation['thermostats'][1] : '' ?>"
                                                                   name="automation[thermostats][]" placeholder=""/>
                                                        </td>
                                                        <td style="min-width:100px;"><input type="text" class="form-control"
                                                                   value="<?php echo (!empty($workorder->automation)) ? $workorder->automation['light_bulbs'][1] : '' ?>"
                                                                   name="automation[light_bulbs][]" placeholder=""/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <!-- <td></td> -->
                                                        <td style="min-width:100px;"><input type="text" class="form-control"
                                                                   value="<?php echo (!empty($workorder->automation)) ? $workorder->automation['thermostats'][2] : '' ?>"
                                                                   name="automation[thermostats][]" placeholder=""/>
                                                        </td>
                                                        <td style="min-width:100px;"><input type="text" class="form-control"
                                                                   value="<?php echo (!empty($workorder->automation)) ? $workorder->automation['light_bulbs'][2] : '' ?>"
                                                                   name="automation[light_bulbs][]" placeholder=""/>
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
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" href="#collapse5">PERS <i
                                                                class="fa fa-angle-down"
                                                                style="font-size: 31px;top: 4px;position: relative;font-weight: bolder;"></i></a>
                                                </h4>
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
                                                                   value="<?php echo (!empty($workorder->pers)) ? $workorder->pers['fall_detection'][0] : '' ?>"
                                                                   name="pers[fall_detection][]" placeholder=""/>
                                                        </td>
                                                        <td style="min-width:100px;"><input type="number" class="form-control"
                                                                   value="<?php echo (!empty($workorder->pers)) ? $workorder->pers['wo_fall_detection'][0] : '' ?>"
                                                                   name="pers[wo_fall_detection][]" placeholder=""/>
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

                            <!-- ====== Additional Equipment/Services ====== -->
                            <div class="row" id="group_area">
                                <div class="form-group col-md-12">
                                    <h5 class="box-title">Additional Equipment/Services</h5>
                                </div>
                                <div class=" col-md-12">
                                    <?php if (!empty($workorder->additional_services)) { ?>

                                        <div class="row" id="plansItemDiv">

                                            <div class="col-md-12 table-responsive">
                                                <table class="table table-hover">
                                                    <input type="hidden" name="count" value="0" id="count">
                                                    <thead>
                                                    <tr>
                                                        <th>DESCRIPTION</th>
                                                        <th>Type</th>
                                                        <th width="100px">Quantity</th>
                                                        <th>LOCATION</th>
                                                        <th width="140px">COST</th>
                                                        <th width="100px">Discount</th>
                                                        <th>Tax(%)</th>
                                                        <th>Total</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="jobs_items_table_body">
                                                    <?php if (count($workorder->additional_services) > 0) { ?>
                                                        <input type="hidden" name="count"
                                                               value="<?php echo count($workorder->additional_services) > 0 ? count($workorder->additional_services) - 1 : 0; ?>"
                                                               id="count">
                                                        <?php $i = 0;
                                                        foreach ($workorder->additional_services as $row) { ?>

                                                            <tr>
                                                                <td>
                                                                    <input type="text" class="form-control getItems"
                                                                           onKeyup="getItems(this)" name="item[]"
                                                                           value="<?php echo $row['item']; ?>">
                                                                    <ul class="suggestions"></ul>
                                                                </td>
                                                                <td><select name="item_type[]" class="form-control">

                                                                        <option value="Product" <?php if ($row['item_type'] == 'Product') echo 'selected'; ?>>
                                                                        Product
                                                                        </option>
                                                                        <option value="Service" <?php if ($row['item_type'] == 'Service') echo 'selected'; ?>>
                                                                        Service
                                                                        </option>
                                                                        <option value="QSP" <?php if ($row['item_type'] == 'QSP') echo 'selected'; ?>>
                                                                        QSP
                                                                        </option>
                                                                    </select></td>
                                                                <td>
                                                                    <input type="text" class="form-control quantity"
                                                                           name="quantity[]"
                                                                           data-counter="<?php echo $i; ?>"
                                                                           id="quantity_<?php echo $i; ?>"
                                                                           value="<?php echo $row['quantity'] ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control"
                                                                           name="location[]"
                                                                           value="<?php echo $row['location'] ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="number" class="form-control price"
                                                                           name="price[]"
                                                                           data-counter="<?php echo $i; ?>"
                                                                           id="price_<?php echo $i; ?>" min="0"
                                                                           value="<?php echo $row['price'] ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="number"
                                                                           value="<?php echo $row['discount'] ?>"
                                                                           class="form-control discount"
                                                                           name="discount[]"
                                                                           data-counter="<?php echo $i; ?>"
                                                                           id="discount_<?php echo $i; ?>" min="0"
                                                                           value="0"
                                                                           readonly>
                                                                </td>
                                                                <td style="width:85px;">
															<span id="span_tax_<?php echo $i; ?>"><?php $tax = ($row['price'] * 7.5 / 100) * $row['quantity'];
                                                                echo number_format($tax, 2) ?></span>
                                                                </td>
                                                                <td>
															<span id="span_total_<?php echo $i; ?>"><?php $price = ($row['price'] + $tax) * $row['quantity'];
                                                                echo number_format($price, 2); ?></span>
                                                                </td>
                                                                <td>
                                                                    <a href="#" class="remove">X</a>
                                                                </td>
                                                            </tr>
                                                            <?php $i++;
                                                        } ?>

                                                    <?php } else { ?>
                                                        <input type="hidden" name="count" value="0" id="count">
                                                        <tr>
                                                            <td><input type="text" class="form-control getItems"
                                                                       onKeyup="getItems(this)" name="item[]">
                                                                <ul class="suggestions"></ul>
                                                            </td>
                                                            <td><select name="item_type[]" class="form-control">
                                                                    <option value="Product">Product</option>
                                                                    <option value="Service">Service</option>
                                                                    <option value="QSP">QSP</option>
                                                                </select></td>
                                                            <td><input type="text" class="form-control quantity"
                                                                       name="quantity[]" data-counter="0"
                                                                       id="quantity_0"
                                                                       value="1"></td>
                                                            <td><input type="text" class="form-control"
                                                                       name="location[]"></td>
                                                            <td><input type="number" class="form-control price"
                                                                       name="price[]"
                                                                       data-counter="0" id="price_0" min="0" value="0">
                                                            </td>
                                                            <td><input type="number" class="form-control discount"
                                                                       name="discount[]" data-counter="0"
                                                                       id="discount_0"
                                                                       min="0" value="0" readonly></td>
                                                            <td style="width:85px;"><span id="span_tax_0">0.00 (7.5%)</span></td>
                                                            <td><span id="span_total_0">0.00</span></td>
                                                        </tr>

                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                                <!-- <a href="#" class="btn btn-primary" id="add_another">Add Items</a> -->
                                                <a class="link-modal-open" href="#" id="add_another_itemss" data-toggle="modal" data-target="#item_list"><span class="fa fa-plus-square fa-margin-right"></span>Add Items</a>
                                            </div>
                                        </div><br/>


                                    <?php } else { ?>

                                        <div class="row" id="plansItemDiv">

                                            <div class="col-md-12 table-responsive">
                                                <table class="table table-hover">
                                                    <input type="hidden" name="count" value="0" id="count">
                                                    <thead>
                                                    <tr>
                                                        <th>DESCRIPTION</th>
                                                        <th>Type</th>
                                                        <th width="100px">Quantity</th>
                                                        <!-- <th>LOCATION</th> -->
                                                        <th width="140px">COST</th>
                                                        <th width="100px">Discount</th>
                                                        <th>Tax(%)</th>
                                                        <th>Total</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="jobs_items_table_body">
                                                    <tr>
                                                        <td><input type="text" class="form-control getItems"
                                                                   onKeyup="getItems(this)" name="item[]">
                                                            <ul class="suggestions"></ul>
                                                        </td>
                                                        <td><select name="item_type[]" class="form-control">
                                                                <option value="Product">Product</option>
                                                                <option value="Service">Service</option>
                                                                <option value="QSP">QSP</option>
                                                            </select></td>
                                                        <td><input type="text" class="form-control quantity"
                                                                   name="quantity[]"
                                                                   data-counter="0" id="quantity_0" value="1"></td>
                                                        <!-- <td><input type="text" class="form-control" name="location[]"> </td> -->
                                                        <td><input type="number" class="form-control price"
                                                                   name="price[]"
                                                                   data-counter="0" id="price_0" min="0" value="0"></td>
                                                        <td><input type="number" class="form-control discount"
                                                                   name="discount[]"
                                                                   data-counter="0" id="discount_0" min="0" value="0"
                                                                   readonly>
                                                        </td>
                                                        <!-- <td><span id="span_tax_0">0.00 (7.5%)</span></td> -->
                                                        <td style="width:85px;"><input type="text" class="form-control tax_change" name="tax[]"
                                                       data-counter="0" id="tax1_0" min="0" value="0">
                                                       <!-- <span id="span_tax_0">0.0</span> -->
                                                       </td>
                                                        <td><span id="span_total_0">0.00</span></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <!-- <a href="#" class="btn btn-primary" id="add_another">Add Items</a> -->
                                                <a class="link-modal-open" href="#" id="add_another_itemss" data-toggle="modal" data-target="#item_list"><span class="fa fa-plus-square fa-margin-right"></span>Add Items</a>
                                            </div>
                                        </div><br/>

                                    <?php } ?>
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
                                                 <td class="d-flex align-items-center">$  <input type="text" name="subtotal" id="item_total" name="eqpt_cost" class="form-control" >
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Sales Tax</td>
                                                <td class="d-flex align-items-center">$ <input type="text" 
                                                                                               name="taxes"
                                                                                               id="sales_taxs"
                                                                                               class="form-control">
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
                                                                                               value="<?php echo !empty($workorder->total) ? $workorder->total['one_time'] : 0.00; ?>"
                                                                                               name="otp_setup"
                                                                                               id="one_time"
                                                                                               class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Monthly Monitoring</td>
                                                <td class="d-flex align-items-center">$ <input type="text"
                                                                                               value="<?php echo !empty($workorder->total) ? $workorder->total['m_monitoring'] : 0.00; ?>"
                                                                                               name="monthly_monitoring"
                                                                                               id="m_monitoring"
                                                                                               class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Total Due</td>
                                                 <td class="d-flex align-items-center">$ 
                                                            <input type="hidden" name="adjustment_value" id="adjustment_input" value="0" class="form-control adjustment_input" style="width:100px; display:inline-block"><input type="hidden" name="markup_input_form" id="markup_input_form" class="markup_input" value="0"> 
                                                            <input type="text" name="grand_total_text" id="grand_total_input" class="form-control" placeholder="0">
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
                                            <label for="billing_date">Billing Date</label>
                                            <div class="form-group">
                                                <select name="billing_date" id="billing_date" class="form-control">
                                                    <option>--SELECT--</option>
                                                    <?php foreach (range(1, 31) as $date) { ?>
                                                        <option value="<?php echo $date ?>" <?php echo (!empty($workorder->billing_date) && $workorder->billing_date == $date) ? 'selected' : '' ?>>
                                                            <?php echo $date ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="payment_type"> Payment Type:</label> 
                                                <select name="payment_method" id="payment_method" class="form-control custom-select">
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
                                                <!--                                                <input type="text" class="form-control" name="payment_type"-->
                                                <!--                                                       value="-->
                                                <?php //echo (!empty($workorder->payment_type)) ? $workorder->payment_type : '' ?><!--"-->
                                                <!--                                                       id="payment_type" placeholder=""/>-->
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="billing_freq"> Billing Frequency:</label>
                                                <select name="billing_freq"
                                                        class="form-control"
                                                        id="billing_freq">
                                                    <option>--SELECT--</option>
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
                                                <label for="job_type">Amount</label><small class="help help-sm"> ( $ )</small>
                                                <input type="text" class="form-control" name="payment_amount" id="payment_amount"  />
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
                                    <div id="check_area" style="display:none;">
                                        <div class="row">                   
                                            <div class="form-group col-md-4">
                                                <label for="job_type">Check Number</label>
                                                <input type="text" class="form-control" name="check_number" id="check_number"/>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="job_type">Routing Number</label>
                                                <input type="text" class="form-control" name="routing_number" id="routing_number"/>
                                            </div>                                             
                                        <!-- </div>
                                        <div class="row"> -->
                                            <div class="form-group col-md-4">
                                                <label for="job_type">Account Number</label>
                                                <input type="text" class="form-control" name="account_number" id="account_number"/>
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
                                                <label for="job_type">Credit Card Number</label>
                                                <input type="text" class="form-control" name="credit_number" id="credit_number" placeholder="0000 0000 0000 000" />
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="job_type">Credit Card Expiration</label>
                                                <input type="text" class="form-control" name="credit_expiry" id="credit_expiry" placeholder="MM/YYYY"/>
                                            </div>  
                                            <div class="form-group col-md-4">
                                                <label for="job_type">CVC</label>
                                                <input type="text" class="form-control" name="credit_cvc" id="credit_cvc" placeholder="CVC"/>
                                            </div>                                             
                                        </div>
                                    </div>
                                    <div id="invoicing" style="display:none;">
                                        
                                        <input type="checkbox" id="same_as"> <b>Same as above in Monitoring Address</b> <br><br>
                                        <div class="row">                   
                                            <div class="col-md-4 form-group">
                                                <label for="monitored_location">Mail Address</label>
                                                <input type="text" class="form-control" name="mail-address"
                                                    id="mail-address" placeholder="Monitored Location"/>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label for="city">City</label>
                                                    <input type="text" class="form-control" name="mail_locality" id="mail_locality" placeholder="Enter Name" />
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label for="state">State</label>
                                                <input type="text" class="form-control" name="mail_state"
                                                    id="mail_state" 
                                                    placeholder="Enter State"/>
                                            </div>
                                        </div>
                                        <div class="row">  
                                            <div class="col-md-4 form-group">
                                                <label for="zip">ZIP</label> 
                                                    <input type="text" id="mail_postcode" name="mail_postcode" class="form-control"  placeholder="Enter Zip"/>
                                            </div>

                                            <div class="col-md-4 form-group">
                                                <label for="cross_street">Cross Street</label>
                                                <input type="text" class="form-control" name="mail_cross_street"
                                                    id="mail_cross_street" 
                                                    placeholder="Cross Street"/>
                                            </div>                                        
                                        </div>
                                    </div>
                                    <div id="debit_card" style="display:none;">
                                        <div class="row">                   
                                            <div class="form-group col-md-4">
                                                <label for="job_type">Credit Card Number</label>
                                                <input type="text" class="form-control" name="debit_credit_number" id="credit_number" placeholder="0000 0000 0000 000" />
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="job_type">Credit Card Expiration</label>
                                                <input type="text" class="form-control" name="debit_credit_expiry" id="credit_expiry" placeholder="MM/YYYY"/>
                                            </div>  
                                            <div class="form-group col-md-4">
                                                <label for="job_type">CVC</label>
                                                <input type="text" class="form-control" name="debit_credit_cvc" id="credit_cvc" placeholder="CVC"/>
                                            </div>                                            
                                        </div>
                                    </div>
                                    <div id="ach_area" style="display:none;">
                                        <div class="row">                   
                                            <div class="form-group col-md-4">
                                                <label for="job_type">Routing Number</label>
                                                <input type="text" class="form-control" name="ach_routing_number" id="ach_routing_number" />
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="job_type">Account Number</label>
                                                <input type="text" class="form-control" name="ach_account_number" id="ach_account_number" />
                                            </div>  
                                        </div>
                                    </div>
                                    <div id="venmo_area" style="display:none;">
                                        <div class="row">                   
                                            <div class="form-group col-md-4">
                                                <label for="job_type">Account Credential</label>
                                                <input type="text" class="form-control" name="account_credentials" id="account_credentials"/>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="job_type">Account Note</label>
                                                <input type="text" class="form-control" name="account_note" id="account_note"/>
                                            </div>  
                                            <div class="form-group col-md-4">
                                                <label for="job_type">Confirmation</label>
                                                <input type="text" class="form-control" name="confirmation" id="confirmation"/>
                                            </div>                                            
                                        </div>
                                    </div>
                                    <div id="paypal_area" style="display:none;">
                                        <div class="row">                   
                                            <div class="form-group col-md-4">
                                                <label for="job_type">Account Credential</label>
                                                <input type="text" class="form-control" name="paypal_account_credentials" id="paypal_account_credentials"/>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="job_type">Account Note</label>
                                                <input type="text" class="form-control" name="paypal_account_note" id="paypal_account_note"/>
                                            </div>  
                                            <div class="form-group col-md-4">
                                                <label for="job_type">Confirmation</label>
                                                <input type="text" class="form-control" name="paypal_confirmation" id="paypal_confirmation"/>
                                            </div>                                            
                                        </div>
                                    </div>
                                    <div id="square_area" style="display:none;">
                                        <div class="row">                   
                                            <div class="form-group col-md-4">
                                                <label for="job_type">Account Credential</label>
                                                <input type="text" class="form-control" name="square_account_credentials" id="square_account_credentials"/>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="job_type">Account Note</label>
                                                <input type="text" class="form-control" name="square_account_note" id="square_account_note"/>
                                            </div>  
                                            <div class="form-group col-md-4">
                                                <label for="job_type">Confirmation</label>
                                                <input type="text" class="form-control" name="square_confirmation" id="square_confirmation"/>
                                            </div>                                            
                                        </div>
                                    </div>
                                    <div id="warranty_area" style="display:none;">
                                        <div class="row">                   
                                            <div class="form-group col-md-4">
                                                <label for="job_type">Account Credential</label>
                                                <input type="text" class="form-control" name="warranty_account_credentials" id="warranty_account_credentials"/>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="job_type">Account Note</label>
                                                <input type="text" class="form-control" name="warranty_account_note" id="warranty_account_note"/>
                                            </div>                                         
                                        </div>
                                    </div>
                                    <div id="home_area" style="display:none;">
                                        <div class="row">                   
                                            <div class="form-group col-md-4">
                                                <label for="job_type">Account Credential</label>
                                                <input type="text" class="form-control" name="home_account_credentials" id="home_account_credentials"/>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="job_type">Account Note</label>
                                                <input type="text" class="form-control" name="home_account_note" id="home_account_note"/>
                                            </div>                                         
                                        </div>
                                    </div>
                                    <div id="e_area" style="display:none;">
                                        <div class="row">                   
                                            <div class="form-group col-md-4">
                                                <label for="job_type">Account Credential</label>
                                                <input type="text" class="form-control" name="e_account_credentials" id="e_account_credentials"/>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="job_type">Account Note</label>
                                                <input type="text" class="form-control" name="e_account_note" id="e_account_note"/>
                                            </div>                                         
                                        </div>
                                    </div>
                                    <div id="other_credit_card" style="display:none;">
                                        <div class="row">                   
                                            <div class="form-group col-md-4">
                                                <label for="job_type">Credit Card Number</label>
                                                <input type="text" class="form-control" name="other_credit_number" id="other_credit_number" placeholder="0000 0000 0000 000" />
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="job_type">Credit Card Expiration</label>
                                                <input type="text" class="form-control" name="other_credit_expiry" id="other_credit_expiry" placeholder="MM/YYYY"/>
                                            </div>  
                                            <div class="form-group col-md-4">
                                                <label for="job_type">CVC</label>
                                                <input type="text" class="form-control" name="other_credit_cvc" id="other_credit_cvc" placeholder="CVC"/>
                                            </div>                                             
                                        </div>
                                    </div>
                                    <div id="other_payment_area" style="display:none;">
                                        <div class="row">                   
                                            <div class="form-group col-md-4">
                                                <label for="job_type">Account Credential</label>
                                                <input type="text" class="form-control" name="other_payment_account_credentials" id="other_payment_account_credentials"/>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="job_type">Account Note</label>
                                                <input type="text" class="form-control" name="other_payment_account_note" id="other_payment_account_note"/>
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
                                    <?php echo $terms_conditions->content; ?></p>
                                            <input type="hidden" id="company_id" value="<?php echo getLoggedCompanyID(); ?>">
                                            <input type="hidden" class="form-control" name="terms_conditions" id="terms_conditions" value="<?php echo $terms_conditions->content; ?>" />
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
                            </div>
                            <div class="row" id="group_area">
                                <div class="col-md-4">
                                    <h6>Company Representative Approval</h6>
                                    <div class="sigPad" id="smoothed1a" style="width:100%;border:solid gray 1px;background-color:#00b300;">
                                    <!-- <a href="#" style="float:right;margin-right:10px;" class="smoothed1a_pencil" id="smoothed1a_pencil"><i class="fa fa-pencil" aria-hidden="true"></i></a> -->
                                        <ul class="sigNav" style="">
                                            <li class="drawIt"><a href="#draw-it">Draw It</a></li>
                                            <li class="clearButton"><a href="#clear">Clear</a></li>
                                        </ul>
                                        <ul class="edit">
                                            <li class="smoothed1a_pencil pointer"><a onclick="myFunction()" style="float:right;margin-right:10px;" class="smoothed1a_pencil"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                        </ul>
                                        <div class="sig sigWrapper" id="smoothed1a_pencil" style="height:auto;pointer-events: none;">
                                            <div class="typed"></div>
                                            <!-- <canvas class="pad" id="company_representative_approval_signature1a"  style="width:100%;"></canvas> -->
                                            <div id="signature-pad">
                                            <canvas style="border:1px solid #000" id="sign"></canvas>
                                            </div>
                                            <input type="hidden" name="output-2" class="output">
                                        </div>
                                    </div>
                                    <input type="hidden" id="saveCompanySignatureDB1a"
                                           name="company_representative_approval_signature1a">
                                    <br>

                                    <label for="comp_rep_approval">Printed Name</label>
                                    <input type="text6" class="form-control mb-3"
                                           name="company_representative_printed_name"
                                           id="comp_rep_approval" placeholder=""/>

                                </div>
                                <div class="col-md-4">
                                    <h6>Primary Account Holder</h6>
                                    <div class="sigPad" id="smoothed2a" style="width:100%;border:solid gray 1px;background-color:#f7b900;">
                                    <!-- <p style="float:right;margin-right:10px;"><i class="fa fa-pencil" aria-hidden="true"></i></p> -->
                                        <ul class="sigNav">
                                            <li class="drawIt"><a href="#draw-it">Draw It</a></li>
                                            <li class="clearButton"><a href="#clear">Clear</a></li>
                                        </ul>
                                        <ul class="edit">
                                            <li class="smoothed1a_pencil pointer"><a onclick="myFunctiontwo()" style="float:right;margin-right:10px;" class="smoothed1a_pencil"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                        </ul>
                                        <div class="sig sigWrapper" style="height:auto;pointer-events: none;">
                                            <div class="typed"></div>
                                            <!-- <canvas class="pad" id="primary_account_holder_signature2a" style="width:100%;"></canvas> -->
                                            <div id="signature-pad2">
                                            <canvas style="border:1px solid #000" id="sign2"></canvas>
                                            </div>
                                            <input type="hidden" name="output-2" class="output">
                                        </div>
                                    </div>
                                    <input type="hidden" id="savePrimaryAccountSignatureDB2a"
                                           name="primary_account_holder_signature2a">
                                    <br>

                                    <label for="comp_rep_approval">Printed Name</label>
                                    <input type="text6" class="form-control mb-3" name="primary_account_holder_name"
                                           id="comp_rep_approval" placeholder=""/>

                                </div>
                                <div class="col-md-4">
                                    <h6>Secondary Account Holder</h6>
                                    <div class="sigPad" id="smoothed3a" style="width:100%;border:solid gray 1px;background-color:#f75c1e;">
                                    <!-- <p style="float:right;margin-right:10px;"><i class="fa fa-pencil" aria-hidden="true"></i></p> -->
                                        <ul class="sigNav">
                                            <li class="drawIt"><a href="#draw-it">Draw It</a></li>
                                            <li class="clearButton"><a href="#clear">Clear</a></li>
                                        </ul>
                                        <ul class="edit">
                                            <li class="smoothed1a_pencil pointer"><a onclick="myFunctionthree()" style="float:right;margin-right:10px;" class="smoothed1a_pencil"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                        </ul>
                                        <div class="sig sigWrapper" style="height:auto;pointer-events: none;">
                                            <div class="typed"></div>
                                            <!-- <canvas class="pad" id="secondary_account_holder_signature3a" style="width:100%;"></canvas> -->
                                            <div id="signature-pad3">
                                            <canvas style="border:1px solid #000" id="sign3"></canvas>
                                            </div>
                                            <input type="hidden" name="output-2" class="output">
                                        </div>
                                    </div>
                                    <input type="hidden" id="saveSecondaryAccountSignatureDB3a"
                                           name="secondary_account_holder_signature3a">
                                    <br>

                                    <label for="comp_rep_approval">Printed Name</label>
                                    <input type="text6" class="form-control mb-3" name="secondery_account_holder_name"
                                           id="comp_rep_approval" placeholder=""/>

                                </div>
                            </div>

                            <!-- ====== TERMS OF USE ====== -->
                            <div class="row" id="group_area">
                                <div class=" col-md-12"><label style="float:right;color:green;"><a href="#" style="color:green;" data-toggle="modal" data-target="#terms_use_modal">Update Terms of Use</a></label>
                                    <h6>Agreement</h6>
                                    <div style="height:200px; overflow:auto; background:#FFFFFF; padding-left:10px;" id="thisdiv3">
                                    <p><?php echo $terms_uses->content; ?></p>
                                            <input type="hidden" id="company_id" value="<?php echo getLoggedCompanyID(); ?>">
                                            <input type="hidden" class="form-control" name="terms_of_use" id="terms_of_use"  value="<?php echo $terms_uses->content; ?>"/>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="initials">**INITIALS**</label>
                                        <input type="text" class="form-control"
                                               name="initials"
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


                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <!-- <button type="button" onClick="validatecard();"
                                            class="btn btn-flat btn-primary">
                                        Submit
                                    </button> -->
                                    <input type="submit" value="Submit" class="btn btn-flat btn-primary">
                                    <a href="<?php echo url('workorder') ?>" class="btn btn-danger">Cancel this</a>
                                </div>
                            </div>

                        </div>
                        <!-- end card -->
                    </div>
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
                <div class="modal-dialog modal-lg" role="document" style="width:800px;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
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
                                                <td><?php echo $item->rebate; ?></td>
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
        var counter = $(this).val();
        var m_monitoring = $("#m_monitoring").val();
        var subtotal = 0;
        // $("#span_total_0").each(function(){
            $('*[id^="span_total_"]').each(function(){
            subtotal += parseFloat($(this).text());
        });

        grand_tot = parseFloat(counter) + parseFloat(subtotal) + parseFloat(m_monitoring);
        //  alert(grand_tot);
        var grand = $("#grand_total_input").val(grand_tot);
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
        var grand = $("#grand_total_input").val(grand_tot);
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
          fields: ["address_components", "geometry"],
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

            case "postal_code_suffix": {
              postcode = `${postcode}-${component.long_name}`;
              break;
            }
            case "locality":
              document.querySelector("#locality").value = component.long_name;
              break;

            case "administrative_area_level_1": {
              document.querySelector("#state").value = component.short_name;
              break;
            }
            case "country":
              document.querySelector("#country").value = component.long_name;
              break;
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
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlMWhWMHlxQzuolWb2RrfUeb0JyhhPO9c&callback=initAutocomplete&libraries=places&v=weekly"
      async
    ></script>

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
