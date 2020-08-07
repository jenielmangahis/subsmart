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
</style>
<style>

.my-div-container .card { 
    padding:3px !important;
    border:0px ;
}

.my-div-container .card .card-body { 
    padding:0px !important;
}

.my-div-container .card .card-body .row { 
    padding:0px !important;
}

.my-div-container .card .card-body .row .form-group {  padding-left:5px; padding-right:5px; margin-bottom:0px !important; }

body { background: white !important; }
.my-div-container .card .card-body .row .form-group .box-title { margin:0px; }
.float-left { float:left !important; }
.remove-padding { padding:0px !important; }
.one-row-label { line-height: 46px;margin-bottom: 0px !important; }
#table_body tr td { padding: 3px 7px !important; }

label { margin-bottom:0px !important; }
</style>
<div class="wrapper " role="wrapper">
    <?php include viewPath('includes/sidebars/workorder'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid my-div-container">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Workorder</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active"><h5>ALARM SYSTEM WORKORDER AGREEMENT</h5></li>
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
            <?php echo form_open_multipart('workorder/save', ['class' => 'form-validate require-validation', 'id' => 'workorder_form', 'autocomplete' => 'off']); ?>

            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <p>This Alarm System Work Order Agreement (the "Agreement") is made as of
                                <?php echo date('m/d/Y') ?>, by and between ADI, (the "Company") and the
                                ("Customer") as the address shown below (the "Premise/Monitored Location") </p>

                            <!-- ====== CUSTOMER ====== -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <h5 class="box-title">Customer</h5>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label class="col-md-6 float-left one-row-label pl-0">Customer Type</label>
                                            <select name="customer[customer_type]"
                                                    class="form-control float-left col-md-6"
                                                    id="customer_type">
                                                <?php foreach (get_config_item('customer_types') as $key => $customer_type) { ?>
                                                    <option value="<?php echo $customer_type ?>">
                                                        <?php echo $customer_type ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label for="customer_install_type" class="col-md-5 float-left one-row-label">Install Type </label>
                                            <select name="customer[install_type]"
                                                    class="form-control float-left col-md-7"
                                                    id="customer_install_type">
                                                <?php foreach (get_config_item('install_types') as $key => $install_type) { ?>
                                                    <option value="<?php echo $install_type ?>">
                                                        <?php echo $install_type ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4 form-group" style="display: none">
                                            <label for="customer_company_name" >
                                                Company Name </label>
                                            <input type="text" class="form-control" name="customer[company_name]"
                                                   id="customer_company_name"
                                                   required placeholder="Enter Company Name"/>
                                        </div>
                                        <div class="col-md-1 form-group"></div>
                                        <div class="col-md-5 form-group">
                                            <label for="customer_company_name" class="col-md-7 float-left one-row-label">
                                                If Takeover Company Name </label>
                                            <input type="text" class="form-control float-left col-md-5" name="customer[company_name]"
                                                   id="customer_company_name"
                                                   required placeholder="Enter Company Name"/>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3 form-group">
                                            <input type="text" class="form-control" name="customer[last_name]" id="last_name" required placeholder="Enter Last Name"/>
                                            <label for="last_name">Last Name</label>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <input type="text" class="form-control" name="customer[first_name]" id="first_name" required placeholder="Enter First Name" autofocus onChange="jQuery('#customer_name').text(jQuery(this)
                                            .val());"/><label for="first_name">First Name</label>
                                        </div>
                                        <div class="col-md-1 form-group">
                                            <input type="text" class="form-control" name="customer[contact_mobile]" id="contact_mobile"  placeholder="Enter Mobile"/>
                                            <label for="contact_mobile">Mi</label>

                                        </div>

                                        <div class="col-md-2 form-group">
                                            <input type="text" class="form-control" name="customer[contact_dob]"  id="customer_contact_dob" placeholder="Enter DOB"/>
                                            <label for="contact_dob">DOB</label>
                                        </div>

                                        <div class="col-md-3 form-group">
                                            <input type="text" class="form-control" name="customer[contact_ssn]" id="contact_ssn" required placeholder="Enter SSN"/>
                                            <label for="contact_ssn">SSN</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        
                                        <div class="col-md-3 form-group">
                                            <input type="text" class="form-control" name="customer[spouse_last_name]" id="spouse_last_name" required placeholder="Enter Last Name"  autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());"/>
                                            <label for="spouse_last_name">Last Name - Spouse</label>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <input type="text" class="form-control" name="customer[spouse_first_name]" id="spouse_first_name" required placeholder="Enter First Name" autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());"/>
                                            <label for="spouse_first_name">First Name</label>
                                        </div>
                                        <div class="col-md-1 form-group">
                                            <input type="text" class="form-control" name="customer[spouse_contact_mobile]" id="spouse_contact_mobile" placeholder="Enter Mobile"/>
                                            <label for="spouse_contact_mobile">Mi</label>
                                        </div>

                                        <div class="col-md-2 form-group">
                                            <input type="text" class="form-control" name="customer[spouse_contact_dob]" id="customer_spouse_contact_dob" placeholder="Enter DOB"/>
                                            <label for="contact_dob">DOB</label>
                                        </div>

                                        <div class="col-md-3 form-group">
                                            <input type="text" class="form-control" name="customer[spouse_contact_ssn]" id="spouse_contact_ssn" required placeholder="Enter SSN"/>
                                            <label for="spouse_contact_ssn">SSN</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3 form-group">
                                            <input type="text" class="form-control" name="customer[monitored_location]" id="monitored_location" required placeholder="Enter Monitored Location"/>
                                            <label for="monitored_location">Monitored Location</label>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <input type="text" class="form-control" name="customer[city]" id="city" required placeholder="Enter City"/>
                                            <label for="city">City</label>
                                        </div>
                                        <div class="col-md-1 form-group">
                                            <input type="text" class="form-control" name="customer[state]" id="state" placeholder="Enter State"/>
                                            <label for="state">State</label>
                                        </div>

                                        <div class="col-md-2 form-group">
                                            <input type="text" class="form-control" name="customer[zip]" id="zip" placeholder="Enter ZIP"/>
                                            <label for="zip">ZIP</label>
                                        </div>

                                        <div class="col-md-3 form-group">
                                            <input type="text" class="form-control" name="customer[cross_street]" id="cross_street" required placeholder="Enter Cross Street"/>
                                            <label for="cross_street">Cross Street</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3 form-group">
                                            <div class="input-group phone-input mb-0">
                                                <input type="hidden" name="customer[contact_phone][type]" class="type-input" value="mobile"/>
                                                <input type="text" name="customer[contact_phone][number]" class="form-control" placeholder="Enter Phone"/>
                                            </div>
                                            <label for="contact_phone">Phone Number</label>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <input type="text" class="form-control" name="customer[email]" id="email" required placeholder="Enter Email"/>
                                            <label for="email">Email</label>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <input type="password" class="form-control" name="customer[password]" id="password" placeholder="Enter Password"/>
                                            <label for="password">Password</label>
                                        </div>
                                        <div class="col-md-3 form-group"></div>
                                        <div class="col-md-3 form-group">
                                            <label for="" class="col-md-6 pl-0 float-left one-row-label">Notification Type</label>
                                            <select name="customer[notification_type][]"
                                                    id="customer_notification_type_email" class="form-control float-left col-md-6">
                                                <option>Select Notification Type</option>
                                                <?php foreach (get_config_item('notification_types') as $key => $notification_type) { ?>
                                                    <option value="<?= $notification_type; ?>"><?php echo $notification_type ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- ====== EMERGENCY CALL LIST ====== -->
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <h5 class="box-title">Emergency Call List</h5>
                                </div>
                                <div class="col-md-3 form-group">
                                    <input type="text" class="form-control" name="emergency_call_list[1st_call_verification_name]" id="1st_call_verification_name" required placeholder="Enter 1st Call Verification Name"/>
                                    <label for="1st_call_verification_name">1st Call Verification Name</label>
                                </div>
                                <div class="col-md-3 form-group">
                                    <div class="input-group phone-input mb-0">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style><span class="type-text">Type</span> <span class="caret"></span></button>
                                            <ul class="dropdown-menu" role="menu"> <li><a class="changePhoneType" href="javascript:;" data-type-value="mobile">Mobile</a></li> <li><a class="changePhoneType" href="javascript:;" data-type-value="home">Home</a></li> <li><a class="changePhoneType" href="javascript:;" data-type-value="work">Work</a></li> </ul>
                                        </span>
                                        <input type="hidden" name="emergency_call_list[phone][type][]"
                                                class="type-input"
                                                value="mobile"/>
                                        <input type="text" name="emergency_call_list[phone][number][]"
                                                class="form-control"
                                                placeholder="Enter Phone"/>
                                    </div>
                                    <div>
                                        <label style="float:left;">Phone Number</label>
                                        <label style="float:right;">Type</label>
                                    </div>
                                </div>
                                <div class="col-md-3 form-group">
                                    <input type="text" class="form-control" name="emergency_call_list[relation][]" id="emergency_call_relation" required placeholder="Enter Relation"/>
                                    <label for="emergency_call_relation">Relation</label>
                                </div>
                                <div class="col-md-3 form-group">
                                    <input type="text" class="form-control" name="emergency_call_list[carrier_name][]" id="emergency_carrier_name" required placeholder="Enter Carrier Name"/>
                                    <label for="emergency_carrier_name">Carrier Name</label>
                                </div>

                                <div class="col-md-3 form-group">
                                    <input type="text" class="form-control" name="emergency_call_list[2nd_call_verification_name]" id="2nd_call_verification_name" required placeholder="Enter 2nd Call Verification Name"/>
                                    <label for="2nd_call_verification_name">2nd Call Verification Name</label>
                                </div>
                                <div class="col-md-3 form-group">                                        
                                    <div class="input-group phone-input mb-0">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false"><span
                                                        class="type-text">Type</span> <span
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
                                        <input type="hidden" name="emergency_call_list[phone][type][]"
                                                class="type-input"
                                                value="mobile"/>
                                        <input type="text" name="emergency_call_list[phone][number][]"
                                                class="form-control"
                                                placeholder="Enter Phone"/>
                                    </div>
                                    <div>
                                        <label style="float:left;">Phone Number</label>
                                        <label style="float:right;">Type</label>
                                    </div>
                                </div>
                                <div class="col-md-3 form-group">
                                    <input type="text" class="form-control" name="emergency_call_list[relation][]"
                                            id="emergency_call_relation"
                                            required placeholder="Enter Relation"/>
                                    <label for="emergency_call_relation">Relation</label>
                                </div>
                                <div class="col-md-3 form-group">
                                    <input type="text" class="form-control"
                                            name="emergency_call_list[carrier_name][]"
                                            id="emergency_carrier_name"
                                            required placeholder="Enter Carrier Name"/>
                                    <label for="emergency_carrier_name">Carrier Name</label>
                                </div>

                                <div class="col-md-3 form-group">
                                    <input type="text" class="form-control"
                                            name="emergency_call_list[emergency_contact_1]"
                                            id="emergency_call_emergency_contact_1"
                                            required placeholder="Enter Emergency Contact"/>
                                    <label for="emergency_call_emergency_contact_1">Emergency Contact</label>
                                </div>
                                <div class="col-md-3 form-group">
                                    <div class="input-group phone-input mb-0">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false"><span
                                                        class="type-text">Type</span> <span
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
                                        <input type="hidden" name="emergency_call_list[phone][type][]"
                                                class="type-input"
                                                value="mobile"/>
                                        <input type="text" name="emergency_call_list[phone][number][]"
                                                class="form-control"
                                                placeholder="Enter Phone"/>
                                    </div>
                                    <div>
                                        <label style="float:left;">Phone Number</label>
                                        <label style="float:right;">Type</label>
                                    </div>
                                </div>
                                <div class="col-md-3 form-group">
                                    <input type="text" class="form-control" name="emergency_call_list[relation][]"
                                            id="emergency_call_relation"
                                            required placeholder="Enter Relation"/>
                                    <label for="emergency_call_relation">Relation</label>
                                </div>
                                <div class="col-md-3">
                                </div>

                                <div class="col-md-3 form-group">
                                    <input type="text" class="form-control"
                                            name="emergency_call_list[emergency_contact_2]"
                                            id="emergency_call_emergency_contact_2"
                                            required placeholder="Enter Emergency Contact"/>
                                    <label for="emergency_call_emergency_contact_2">Emergency Contact</label>
                                </div>

                                <div class="col-md-3 form-group">                                        
                                    <div class="input-group phone-input mb-0">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false"><span
                                                        class="type-text">Type</span> <span
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
                                        <input type="hidden" name="emergency_call_list[phone][type][]"
                                                class="type-input"
                                                value="mobile"/>
                                        <input type="text" name="emergency_call_list[phone][number][]"
                                                class="form-control"
                                                placeholder="Enter Phone"/>
                                    </div>
                                    <div>
                                        <label style="float:left;">Phone Number</label>
                                        <label style="float:right;">Type</label>
                                    </div>
                                </div>
                                <div class="col-md-3 form-group">
                                    <input type="text" class="form-control" name="emergency_call_list[relation][]" id="emergency_call_relation" required placeholder="Enter Relation"/>
                                    <label for="emergency_call_relation">Relation</label>
                                </div>
                            </div>

                            <!-- ====== CUSTOMER ACCOUNT INFORMATION ====== -->
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <h5 class="box-title">Customer Account Information</h5>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="street_address" class="col-md-5 float-left one-row-label pl-0"> Plan Type:</label>
                                    <select name="plan_type" id="plan_type" class="form-control float-left col-md-7">
                                        <option>Select Plan Type</option>
                                        <?php if (count($plans) > 0) { ?>    
                                            <?php foreach ($plans as $pn) { ?>
                                                <option value="<?= $pn->id; ?>">
                                                    <?php echo $pn->plan_name ?>
                                                </option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="customer_company_name" class="col-md-5 float-left one-row-label"> If Landline Company Name </label>
                                    <input type="text" class="form-control float-left col-md-7" name="customer[company_name]" id="customer_company_name" required placeholder="Enter Company Name"/>
                                </div>
                                <div class="form-group col-md-3"></div>
                                <div class="form-group col-md-3">

                                    <label class="col-md-5 float-left one-row-label pl-0">Account Type</label>
                                    <select name="account_type"
                                            class="form-control float-left col-md-7"
                                            id="account_type[name]">
                                        <option>--SELECT--</option>
                                        <?php foreach (get_config_item('account_types') as $key => $account_type) { ?>
                                            <option value="<?php echo $account_type ?>">
                                                <?php echo $account_type ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <div class="form-group mt-2" style="display: none">
                                        <input name="account_type[other]"
                                                type="text" class="form-control"
                                                placeholder="Write it here..." required>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="customer_company_name" class="col-md-5 float-left one-row-label"> If Other Write out </label>
                                    <input type="text" class="form-control float-left col-md-7" name="customer[company_name]" id="customer_company_name" required placeholder="Enter Company Name"/>
                                </div>
                                <div class="form-group col-md-3"></div>
                                <div class="form-group col-md-12">
                                    <h5 class="box-title">Equipment</h5>
                                </div>

                                <div class="form-group  col-md-3">
                                    <label class="col-md-5 float-left one-row-label pl-0">Panel Type</label>
                                    <select class="form-control float-left col-md-7" name="panel_type[]" id="panel_type">
                                        <option>--SELECT--</option>
                                        <?php foreach (get_config_item('panel_types') as $key => $panel_type) { ?>
                                            <option value="<?php echo $panel_type ?>">
                                                <?php echo $panel_type ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="panel_location" class="col-md-5 float-left one-row-label "> Panel Location:</label>
                                    <input type="text" class="form-control float-left col-md-7" name="panel_location"
                                            id="panel_location" placeholder=""/>
                                </div>
                                <!-- <div class="col-md-4"></div> -->
                                <div class="col-md-6 form-group">
                                    <label for="panel_communication" class="col-md-5 float-left one-row-label pl-0"> Panel Communication:</label>
                                    <select name="panel_communication" class="form-control float-left col-md-4" id="customer_type">
                                        <option>--SELECT--</option>
                                        <?php foreach (get_config_item('panel_communications') as $key => $panel_communication) { ?>
                                            <option value="<?php echo $panel_communication ?>">
                                                <?php echo $panel_communication ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <!-- ====== EQUIPMENT ====== -->
                            <?php /* ?>
                            <div class="row">
                                
                                <div class="form-group col-md-12">
                                    <h5 class="box-title">Additional Equipment/Services</h5>
                                </div>
                                
                                <div class="col-md-3 form-group">
                                    <div class="col-md-6 pl-0" style="float:left;">
                                        <label for="last_name">Type</label>
                                        <select name="panel_communication" class="form-control" id="customer_type">
                                            <option>--SELECT--</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 pr-0 pl-0" style="float:left;">
                                        <label for="last_name">Description</label>
                                        <select name="panel_communication" class="form-control" id="customer_type">
                                            <option>--SELECT--</option>
                                        </select>
                                    </div>
                                </div>
                            
                                <div class="col-md-9 form-group">

                                    <div class="col-md-1 form-group" style="float:left;">
                                        <label for="last_name">Qty</label>
                                        <input type="text" class="form-control" name="customer[company_name]" id="customer_company_name" required value="1"/>
                                    </div>

                                    <div class="col-md-4 form-group" style="float:left;">
                                        <label for="last_name">Location</label>
                                        <input type="text" class="form-control" name="customer[company_name]" id="customer_company_name" required />
                                    </div>
                                    
                                    <div class="col-md-1 form-group" style="float:left;">
                                        <label for="last_name">Cost</label>
                                        <input type="text" class="form-control" name="customer[company_name]" id="customer_company_name" required />
                                    </div>

                                    <div class="col-md-2 form-group" style="float:left;">
                                        <label for="last_name">Discount</label>
                                        <input type="text" class="form-control" name="customer[company_name]" id="customer_company_name" required />
                                    </div>

                                    <div class="col-md-2 form-group" style="float:left;">
                                        <label for="last_name">Tax</label>
                                        <input type="text" class="form-control" name="customer[company_name]" id="customer_company_name" required />
                                    </div>

                                    <div class="col-md-2 form-group" style="float:left;">
                                        <label for="last_name">Total</label>
                                        <input type="text" class="form-control" name="customer[company_name]" id="customer_company_name" required />
                                    </div>
                                </div>
                                
                                <div class="col-md-2 form-group">
                                    <button class="btn btn-xs btn-primary">Add Items</button>
                                </div>
                            </div>
                            <?php */ ?>



                            <!-- ====== Additional Equipment/Services ====== -->
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <h5 class="box-title">Additional Equipment/Services</h5>
                                </div>
                                <div class=" col-md-12">
                                    <?php if (!empty($estimate)) { ?>

                                        <div class="row" id="plansItemDiv">
                                            <?php if ($estimate->estimate_items != '') {

                                                $estimate_items = unserialize($estimate->estimate_items);
                                            } else {

                                                $estimate_items = [];
                                            } ?>
                                            <div class="col-md-12 table-responsive pl-0 pr-0 mb-0">
                                                <table class="table table-hover">
                                                    <input type="hidden" name="count" value="0" id="count">
                                                    <thead>
                                                    <tr>
                                                        <th>Type</th>
                                                        <th>DESCRIPTION</th>                                                
                                                        <th width="100px">Quantity</th>
                                                        <th>LOCATION</th>
                                                        <th width="100px">COST</th>
                                                        <th width="100px">Discount</th>
                                                        <th>Tax(%)</th>
                                                        <th>Total</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="table_body">
                                                    <?php if (count($estimate_items) > 0) { ?>
                                                        <input type="hidden" name="count"
                                                               value="<?php echo count($estimate_items) > 0 ? count($estimate_items) - 1 : 0; ?>"
                                                               id="count">
                                                        <?php $i = 0;
                                                        foreach ($estimate_items as $row) { ?>

                                                            <tr>
                                                            <td><select name="item_type[]" class="form-control">

                                                                    <option value="material" <?php if ($row['item_type'] == 'material') echo 'selected'; ?>>
                                                                        Material
                                                                    </option>
                                                                    <option value="product" <?php if ($row['item_type'] == 'product') echo 'selected'; ?>>
                                                                        Product
                                                                    </option>
                                                                    <option value="service" <?php if ($row['item_type'] == 'service') echo 'selected'; ?>>
                                                                        Service
                                                                    </option>
                                                                    </select></td><td>
                                                                    <input type="text" class="form-control getItems"
                                                                           onKeyup="getItems(this)" name="item[]"
                                                                           value="<?php echo $row['item']; ?>">
                                                                    <ul class="suggestions"></ul>
                                                                </td>
                                                                
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
                                                                <td>
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
                                                                    <option value="service">Service</option>
                                                                    <option value="material">Material</option>
                                                                    <option value="product">Product</option>
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
                                                            <td><span id="span_tax_0">0.00 (7.5%)</span></td>
                                                            <td><span id="span_total_0">0.00</span></td>
                                                        </tr>

                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                               &nbsp; <a href="#" class="btn btn-primary" id="add_another">Add Items</a>
                                            </div>
                                        </div><br/>

                                        <?php
                                        if ($estimate->estimate_eqpt_cost != '') {

                                            $estimate_eqpt_cost = unserialize($estimate->estimate_eqpt_cost);
                                        } else {

                                            $estimate_eqpt_cost = [];
                                        }
                                        ?>
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>Equipment Cost</td>
                                                <td class="d-flex align-items-center">$ <input type="text"
                                                                                               value="<?php echo !empty($estimate_eqpt_cost) ? $estimate_eqpt_cost['eqpt_cost'] : 0.00; ?>"
                                                                                               name="eqpt_cost"
                                                                                               id="eqpt_cost"
                                                                                               onfocusout="cal_total_due()"
                                                                                               class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Sales Tax</td>
                                                <td class="d-flex align-items-center">$ <input type="text"
                                                                                               value="<?php echo !empty($estimate_eqpt_cost) ? $estimate_eqpt_cost['sales_tax'] : 0.00; ?>"
                                                                                               name="sales_tax"
                                                                                               id="sales_tax"
                                                                                               onfocusout="cal_total_due()"
                                                                                               class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <input type="hidden"
                                                       value="<?php echo !empty($estimate_eqpt_cost) ? $estimate_eqpt_cost['inst_cost'] : 0.00; ?>"
                                                       name="inst_cost"
                                                       id="inst_cost"
                                                       onfocusout="cal_total_due()"
                                                       class="form-control">
                                                <td>One Time Program and Setup</td>
                                                <td class="d-flex align-items-center">$ <input type="text"
                                                                                               value="<?php echo !empty($estimate_eqpt_cost) ? $estimate_eqpt_cost['one_time'] : 0.00; ?>"
                                                                                               name="one_time"
                                                                                               id="one_time"
                                                                                               onfocusout="cal_total_due()"
                                                                                               class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Monthly Monitoring</td>
                                                <td class="d-flex align-items-center">$ <input type="text"
                                                                                               value="<?php echo !empty($estimate_eqpt_cost) ? $estimate_eqpt_cost['m_monitoring'] : 0.00; ?>"
                                                                                               name="m_monitoring"
                                                                                               id="m_monitoring"
                                                                                               onfocusout="cal_total_due()"
                                                                                               class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Total Due</td>
                                                <td class="d-flex align-items-center">$ <span
                                                            id="total_due"><?php echo !empty($estimate_eqpt_cost) ? number_format($estimate_eqpt_cost['eqpt_cost'] + $estimate_eqpt_cost['sales_tax'] + $estimate_eqpt_cost['inst_cost'] + $estimate_eqpt_cost['one_time'] + $estimate_eqpt_cost['m_monitoring'], 2) : '0.00'; ?></span>
                                                </td>
                                            </tr>
                                        </table>


                                    <?php } else { ?>

                                        <div class="row" id="plansItemDiv">

                                            <div class="col-md-12 table-responsive pl-0 pr-0 mb-0">
                                                <table class="table table-hover mb-0">
                                                    <input type="hidden" name="count" value="0" id="count">
                                                    <thead>
                                                    <tr>
                                                        <th>Type</th>
                                                        <th>DESCRIPTION</th>
                                                        <th width="100px">Quantity</th>
                                                        <th>LOCATION</th>
                                                        <th width="100px">COST</th>
                                                        <th width="100px">Discount</th>
                                                        <th>Tax(%)</th>
                                                        <th>Total</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="table_body">
                                                    <tr>
                                                        <td><select name="item_type[]" class="form-control">
                                                            <option value="product">Product</option>
                                                            <option value="material">Material</option>
                                                            <option value="service">Service</option>
                                                        </select></td>
                                                        <td><input type="text" class="form-control getItems"
                                                                   onKeyup="getItems(this)" name="item[]">
                                                            <ul class="suggestions"></ul>
                                                        </td>
                                                        
                                                        <td><input type="text" class="form-control quantity"
                                                                   name="quantity[]"
                                                                   data-counter="0" id="quantity_0" value="1"></td>
                                                        <td><input type="text" class="form-control" name="location[]">
                                                        </td>
                                                        <td><input type="number" class="form-control price"
                                                                   name="price[]"
                                                                   data-counter="0" id="price_0" min="0" value="0"></td>
                                                        <td><input type="number" class="form-control discount"
                                                                   name="discount[]"
                                                                   data-counter="0" id="discount_0" min="0" value="0"
                                                                   readonly>
                                                        </td>
                                                        <td><span id="span_tax_0">0.00 (7.5%)</span></td>
                                                        <td><span id="span_total_0">0.00</span></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <a href="#" class="btn btn-primary" style="margin-left:5px;" id="add_another">Add Items</a>
                                            </div>
                                        </div><br/>

                                    <?php } ?>
                                </div>
                            </div>

                            <!-- ====== TOTAL / BILLING ====== -->
                            <div class="row">
                                <div class="col-sm-12 col-md-5 pl-0">
                                    <div class="form-group col-md-12">
                                        <h5 class="box-title">Total</h5>
                                    </div>
                                    <div class="col-md-12 pl-0">

                                        <table class="table">
                                            <tr>
                                                <td>Equipment Cost</td>
                                                <td class="d-flex align-items-center remove-padding">$ <input type="text"
                                                                                               value="<?php echo !empty($estimate_eqpt_cost) ? $estimate_eqpt_cost['eqpt_cost'] : 0.00; ?>"
                                                                                               name="eqpt_cost"
                                                                                               id="eqpt_cost"
                                                                                               onfocusout="cal_total_due()"
                                                                                               class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Sales Tax</td>
                                                <td class="d-flex align-items-center remove-padding">$ <input type="text"
                                                                                               value="<?php echo !empty($estimate_eqpt_cost) ? $estimate_eqpt_cost['sales_tax'] : 0.00; ?>"
                                                                                               name="sales_tax"
                                                                                               id="sales_tax"
                                                                                               onfocusout="cal_total_due()"
                                                                                               class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <input type="hidden"
                                                       value="<?php echo !empty($estimate_eqpt_cost) ? $estimate_eqpt_cost['inst_cost'] : 0.00; ?>"
                                                       name="inst_cost"
                                                       id="inst_cost"
                                                       onfocusout="cal_total_due()"
                                                       class="form-control">
                                                <td>One Time Program and Setup</td>
                                                <td class="d-flex align-items-center remove-padding">$ <input type="text"
                                                                                               value="<?php echo !empty($estimate_eqpt_cost) ? $estimate_eqpt_cost['one_time'] : 0.00; ?>"
                                                                                               name="one_time"
                                                                                               id="one_time"
                                                                                               onfocusout="cal_total_due()"
                                                                                               class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Monthly Monitoring</td>
                                                <td class="d-flex align-items-center remove-padding">$ <input type="text"
                                                                                               value="<?php echo !empty($estimate_eqpt_cost) ? $estimate_eqpt_cost['m_monitoring'] : 0.00; ?>"
                                                                                               name="m_monitoring"
                                                                                               id="m_monitoring"
                                                                                               onfocusout="cal_total_due()"
                                                                                               class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Total Due</td>
                                                <td class="d-flex align-items-center">$ <span
                                                            id="total_due"><?php echo !empty($estimate_eqpt_cost) ? number_format($estimate_eqpt_cost['eqpt_cost'] + $estimate_eqpt_cost['sales_tax'] + $estimate_eqpt_cost['inst_cost'] + $estimate_eqpt_cost['one_time'] + $estimate_eqpt_cost['m_monitoring'], 2) : '0.00'; ?></span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <!-- <button class="btn btn-block btn-lg btn-primary">Import</button>-->
                                </div>

                                <div class="col-sm-12 col-md-7">
                                    <div class="form-group col-md-12">
                                        <h5 class="box-title">Billing Information</h5>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 ">
                                            <label for="billing_date" style="width:fit-content;" class="col-md-6 float-left one-row-label pl-0 pr-0">Billing Date</label>
                                            <select name="billing_date" id="billing_date" class="form-control float-left col-md-6">
                                                <option>--SELECT--</option>
                                                <?php foreach (range(1, 31) as $date) { ?>
                                                    <option value="<?php echo $date ?>"><?php echo $date ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="col-md-4 pl-0 form-group">
                                                <label class="col-md-8 float-left one-row-label pl-0 pr-0"> Payment Type:</label>
                                                <select name="payment_type"
                                                class="form-control float-left col-md-4 pl-0 pr-0" 
                                                        id="payment_type">
                                                    <option>--SELECT--</option>
                                                    <?php foreach (get_config_item('payment_types') as $key => $payment_type) { ?>
                                                        <option value="<?php echo $payment_type ?>">
                                                            <?php echo $payment_type ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                                <!--                                                <input type="text" class="form-control" name="payment_type"-->
                                                <!--                                                       id="payment_type" placeholder=""/>-->
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label for="billing_freq" style="font-size: 15px;" class="col-md-8 float-left one-row-label pl-0 pr-0"> Billing Frequency:</label>
                                            <select name="billing_freq"
                                                    class="form-control float-left col-md-4 pl-0 pr-0"
                                                    id="billing_freq">
                                                <option>--SELECT--</option>
                                                <?php foreach (get_config_item('billing_frequency') as $key => $billing_frequency) { ?>
                                                    <option value="<?php echo $billing_frequency ?>">
                                                        <?php echo $billing_frequency ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                            <!--                                                <input type="text" class="form-control" name="billing_freq"-->
                                            <!--                                                       id="billing_freq" placeholder=""/>-->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            Credit Card Type:
                                            <div class="checkbox checkbox-sec margin-right mr-4">
                                                <input type="radio" name="card[radio_credit_card]" value="Visa"
                                                       checked="checked"
                                                       id="radio_credit_card">
                                                <label for="radio_credit_card"><span>Visa</span></label>
                                            </div>
                                            <div class="checkbox checkbox-sec margin-right mr-4">
                                                <input type="radio" name="card[radio_credit_card]" value="Amex"
                                                       id="radio_credit_cardAmex">
                                                <label for="radio_credit_cardAmex"><span>Amex</span></label>
                                            </div>
                                            <div class="checkbox checkbox-sec margin-right mr-4">
                                                <input type="radio" name="card[radio_credit_card]" value="Mastercard"
                                                       id="radio_credit_cardMastercard">
                                                <label for="radio_credit_cardMastercard"><span>Mastercard</span></label>
                                            </div>
                                            <div class="checkbox checkbox-sec margin-right mr-4">
                                                <input type="radio" name="card[radio_credit_card]" value="Discover"
                                                       id="radio_credit_cardMasterDiscover">
                                                <label for="radio_credit_cardMasterDiscover"><span>Discover</span></label>
                                            </div>
                                        </div>
                                        <div class=" col-md-12">
                                            <div class="row"
                                                 style="border:none; margin-bottom:20px; padding-bottom:0px;">
                                                <div class=" col-md-6">
                                                    <label for="card_no">Card Number</label>
                                                    <input type="text" class="form-control card-number required" name="card[card_no]" id="card_no" placeholder="" required/>
                                                </div>
                                                <div class="col-md-4 pl-0">
                                                    <label for="datepicker_exp_date">Exp. Date</label>
                                                    <div class="form-group">
                                                        <div class='input-group date datepicker p-0'>
                                                            <input type='text' name="card[exp_date]" class="form-control" id="card_exp_date"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class=" col-md-2 pl-0">
                                                    <label for="cvv">CVV#</label>
                                                    <input type="text" class="form-control card-cvc required" name="card[cvv]" id="cvv" placeholder="" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ====== AGREEMENT ====== -->
                            <div class="row">
                                <div class=" col-md-12">
                                    <h6>Agreement</h6>
                                    <div style="height:400px; overflow:auto; background:#FFFFFF; padding-left:10px;"
                                         id="showuploadagreement">
                                        <p>2. Install of the system. Company agrees to schedule and install an alarm
                                            system and/or devices in connection with a Monitoring Agreement which
                                            customer will receive at the time of installation. Customer hereby agrees to
                                            buy the system/devices described below and incorporated herein for all
                                            purposes by this reference (the “System /Services”), in accordance with the
                                            terms and conditions set forth. IF CUSTOMER FAIL TO FULLFILL THE MONITORING
                                            AGREEMENT, Customer agrees to pay the consultation fee, the cost of the
                                            system and recovering fees.</p>
                                        <p>3. Customer agrees to have system maintained for an initial term of 60 months
                                            at the above monthly rate in exchange for a reduced cost of the system. Upon
                                            the execution of this agreement shall automatically start the billing
                                            process. Customer understands that the monthly payments must be paid through
                                            “Direct Billing” through their banking institution or credit card. Customers
                                            acknowledge that they authorize Company to obtain a Security System.
                                            Residential Clients: CUSTOMER HAS THE RIGHT TO CANCEL THIS TRANSACTION at
                                            any time prior to midnight on the 3rd business day after the above date of
                                            this work order in writing. Customer agrees that no verbal method is valid,
                                            and must be submitted only in writing. The date on this agreement is the
                                            agreed upon date for both the Company and the Customer</p>
                                        <p>4. Client verifies that they are owners of the property listed above. In the
                                            event the system has to be removed, Client agrees and understands that there
                                            will be an additional $299.00 restocking/removal fee and early termination
                                            fees will apply.</p>
                                        <p>5. Client understands that this is a new Monitoring Agreement through our
                                            central station. Alarm.com or .net is not affiliated nor has any bearing on
                                            the current monitoring services currently or previously initiated by Client
                                            with other alarm companies. By signing this work order, Client agrees and
                                            understands that they have read the above requirements and would like to
                                            take advantage of our services. Client understand that is a binding
                                            agreement for both party.</p>
                                        <p>6. Customer agrees that the system is preprogramed for each specific
                                            location. accordance with the terms and conditions set forth. IF CUSTOMER
                                            FAIL TO FULLFILL THE MONITORING AGREEMENT, Customer agrees to pay the
                                            consultation fee, the cost of the system and recovering fees. Customer
                                            agrees that this is a customized order. By signing this workorder, customer
                                            agrees that customized order can not be cancelled after three day of this
                                            signed document.</p>
                                    </div>
                                </div>
                                <div class=" col-md-12 mt-3">
                                  <div class="row">
                                      <div class="col-md-4">
                                          <label for="billing_date">Upload user agreement</label>
                                          <input type="file" name="user_agreementupload" id="user_agreementupload"
                                                 class="form-control"/>
                                      </div>
                                      <div class="col-md-1">
                                        <label for="or_separator"></label>
                                        <h5 name="or_separator" id="or_separator" class="text-center"> OR </h5>
                                      </div>
                                      <div class="col-md-7">
                                        <label for="title">File<small> Select document from file vault</small></label>
                                        <div class="input-group">
                                          <input type="text" class="form-control" name="fs_selected_file_text" id="fs_selected_file_text" placeholder="Selected File" disabled>
                                          <input type="number" class="form-control" name="fs_selected_file" id="fs_selected_file" hidden>
                                          <div class="input-group-btn">
                                            <button class="btn btn-default" type="button" id="btn-fileVault-SelectFile">
                                              <i class="fa fa-folder-open-o"></i>
                                            </button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ====== SIGNATURE ====== -->
                            <div class="row">
                                <div class=" col-md-12">
                                    <div class="work_nore">
                                        <h6>Signature</h6>
                                        <p> By Signing below you verify that the above information is true and complete,
                                            and you authorize payment and confirmation with nSmarTrac. </p>
                                    </div>
                                </div>


                                <div class="col-md-12 float-left custom-signaturepad">
                                   
                                    <div class="col-md-4 float-left">
                                          <h6>Company Representative Approval</h6>
                                          <div class="sigPad" id="smoothed" > <!-- style="width:404px;" -->
                                              <ul class="sigNav">
                                                  <li class="drawIt"><a href="#draw-it">Draw It</a></li>
                                                  <li class="clearButton"><a href="#clear">Clear</a></li>
                                              </ul>
                                              <div class="sig sigWrapper" style="height:auto;">
                                                  <div class="typed"></div>
                                                  <canvas class="pad" id="company_representative_approval_signature"></canvas>  <!--  width="400" height="250" -->
                                                  <input type="hidden" name="output-2" class="output">
                                              </div>
                                          </div>
                                          <input type="hidden" id="saveCompanySignatureDB" name="company_representative_approval_signature">
                                          <!-- <br> -->
                                          <label for="comp_rep_approval">Printed Name</label>
                                          <input type="text6" class="form-control mb-3" name="company_representative_printed_name" id="comp_rep_approval" placeholder=""/>
                                    </div>

                                    <div class=" col-md-4 float-left">
                                          <h6>Primary Account Holder</h6>
                                          <div class="sigPad" id="smoothed2" > <!-- style="width:404px;" -->
                                              <ul class="sigNav">
                                                  <li class="drawIt"><a href="#draw-it">Draw It</a></li>
                                                  <li class="clearButton"><a href="#clear">Clear</a></li>
                                              </ul>
                                              <div class="sig sigWrapper" style="height:auto;">
                                                  <div class="typed"></div>
                                                  <canvas class="pad" id="primary_account_holder_signature"></canvas>  <!--  width="400" height="250" -->
                                                  <input type="hidden" name="output-2" class="output">
                                              </div>
                                          </div>
                                          <input type="hidden" id="savePrimaryAccountSignatureDB" name="primary_account_holder_signature">
                                          <!-- <br>-->
                                          <label for="comp_rep_approval">Printed Name</label>
                                          <input type="text6" class="form-control mb-3" name="primary_account_holder_name" id="comp_rep_approval" placeholder=""/> 

                                    </div>


                                    <div class=" col-md-4 float-left">
                                          <h6>Secondary Account Holder</h6>
                                          <div class="sigPad" id="smoothed3" > <!-- style="width:404px;" -->
                                              <ul class="sigNav">
                                                  <li class="drawIt"><a href="#draw-it">Draw It</a></li>
                                                  <li class="clearButton"><a href="#clear">Clear</a></li>
                                              </ul>
                                              <div class="sig sigWrapper" style="height:auto;">
                                                  <div class="typed"></div>
                                                  <canvas class="pad" id="secondary_account_holder_signature"></canvas>  <!--  width="400" height="250" -->
                                                  <input type="hidden" name="output-2" class="output">
                                              </div>
                                          </div>
                                          <input type="hidden" id="saveSecondaryAccountSignatureDB" name="secondery_account_holder_signature">
                                          <!-- <br> -->
                                          <label for="comp_rep_approval">Printed Name</label>
                                          <input type="text6" class="form-control mb-3" name="secondery_account_holder_name" id="comp_rep_approval" placeholder=""/> 

                                    </div>
                                </div>


                                <div class=" col-md-6">
                                    <h5>Company Representative Approval</h5>
                                    <div class="sigPad" id="smoothed" style="width:404px;">
                                        <ul class="sigNav">
                                            <li class="drawIt"><a href="#draw-it">Draw It</a></li>
                                            <li class="clearButton"><a href="#clear">Clear</a></li>
                                        </ul>
                                        <div class="sig sigWrapper" style="height:auto;">
                                            <div class="typed"></div>
                                            <canvas class="pad" id="company_representative_approval_signature"
                                                    width="400" height="250"></canvas>
                                            <input type="hidden" name="output-2" class="output">
                                        </div>
                                    </div>
                                    <input type="hidden" id="saveCompanySignatureDB"
                                           name="company_representative_approval_signature">
                                    <br>

                                    <label for="comp_rep_approval">Printed Name</label>
                                    <input type="text6" class="form-control mb-3"
                                           name="company_representative_printed_name"
                                           id="comp_rep_approval" placeholder=""/>

                                </div>
                                <div class=" col-md-6">
                                    <h5>Primary Account Holder</h5>
                                    <div class="sigPad" id="smoothed2" style="width:404px;">
                                        <ul class="sigNav">
                                            <li class="drawIt"><a href="#draw-it">Draw It</a></li>
                                            <li class="clearButton"><a href="#clear">Clear</a></li>
                                        </ul>
                                        <div class="sig sigWrapper" style="height:auto;">
                                            <div class="typed"></div>
                                            <canvas class="pad" id="primary_account_holder_signature" width="400"
                                                    height="250"></canvas>
                                            <input type="hidden" name="output-2" class="output">
                                        </div>
                                    </div>
                                    <input type="hidden" id="savePrimaryAccountSignatureDB"
                                           name="primary_account_holder_signature">
                                    <br>

                                    <label for="comp_rep_approval">Printed Name</label>
                                    <input type="text6" class="form-control mb-3" name="primary_account_holder_name"
                                           id="comp_rep_approval" placeholder=""/>

                                </div>
                                <div class=" col-md-6">
                                    <h5>Secondary Account Holder</h5>
                                    <div class="sigPad" id="smoothed3" style="width:404px;">
                                        <ul class="sigNav">
                                            <li class="drawIt"><a href="#draw-it">Draw It</a></li>
                                            <li class="clearButton"><a href="#clear">Clear</a></li>
                                        </ul>
                                        <div class="sig sigWrapper" style="height:auto;">
                                            <div class="typed"></div>
                                            <canvas class="pad" id="secondary_account_holder_signature" width="400"
                                                    height="250"></canvas>
                                            <input type="hidden" name="output-2" class="output">
                                        </div>
                                    </div>
                                    <input type="hidden" id="saveSecondaryAccountSignatureDB"
                                           name="secondery_account_holder_signature">
                                    <br>

                                    <label for="comp_rep_approval">Printed Name</label>
                                    <input type="text6" class="form-control mb-3" name="secondery_account_holder_name"
                                           id="comp_rep_approval" placeholder=""/>

                                </div>
                            </div>

                            <!-- ====== TERMS OF USE ====== -->
                            <div class="row">
                                <div class=" col-md-12">
                                    <h6>Agreement</h6>
                                    <div style="height:200px; overflow:auto; background:#FFFFFF; padding-left:10px;">
                                        <strong>**This isn't everything... just a summary**</strong> You may CANCEL this
                                        transaction, within THREE BUSINESS DAYS from the above date. If You cancel, You
                                        must make available to US in substantially as good condition as when received,
                                        any goods delivered to You under this contract or sale, You may, if You wish,
                                        comply with Our instructions regarding the return shipment of the goods at Your
                                        expense and risk. To cancel this transaction, mail deliver a signed and
                                        postmarket, dated copy of this Notice of Cancellation or any other written
                                        notice to ALarm Direct, Inc., 6866 Pine Forest ROad, Suite B, Pensacola, FL
                                        32526. NOT LATER THAN MIDNIGHT OF {Date plus 3 business days}
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
                            <div class="row">
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
                                                            <label for="post_service_lead_source">Lead Source</label>
                                                            <select name="post_service_summary[lead_source][name]"
                                                                    class="form-control"
                                                                    id="post_service_lead_source">
                                                                <option>--SELECT--</option>
                                                                <?php foreach (get_config_item('lead_source') as $key => $lead_source) { ?>
                                                                    <option value="<?php echo $lead_source ?>">
                                                                        <?php echo $lead_source ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                            <div class="form-group mt-2" style="display: none">
                                                                <input type="text"
                                                                       name="post_service_summary[lead_source][other]"
                                                                       class="form-control"
                                                                       placeholder="Write it here..." required>
                                                            </div>
                                                        </div>
                                                        <div class=" col-md-4 form-group">
                                                            <label for="post_service_pwd">Sales Representative</label>
                                                            <input type="text" class="form-control"
                                                                   name="post_service_summary[sales_rep]"
                                                                   id="post_service_pwd" placeholder=""/>
                                                        </div>
                                                        <div class=" col-md-4 form-group">
                                                            <label for="post_service_pre_install">If Takeover, name of
                                                                previous products:</label>
                                                            <input type="text" class="form-control"
                                                                   name="post_service_summary[previous_products]"
                                                                   id="post_service_pre_install"
                                                                   placeholder=""/>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="notes_to_tech"> Notes to Admin:</label>
                                                            <textarea name="post_service_summary[notes_to_admin]"
                                                                      id="notes_to_admin" rows="3"
                                                                      class="form-control"></textarea>
                                                        </div>
                                                        <div class="col-md-12 mt-5">
                                                            <div id="POST-SERVICEcollapse1">
                                                                <div class="panel-body">
                                                                    <div class="row">
                                                                        <div class=" col-md-4 form-group">
                                                                            <label for="post_service_uid">USERID</label>
                                                                            <input type="text" class="form-control"
                                                                                   name="post_service_summary[userid]"
                                                                                   id="post_service_uid"
                                                                                   placeholder=""/>
                                                                        </div>
                                                                        <div class=" col-md-4 form-group">
                                                                            <label for="post_service_pwd">PASSWORD</label>
                                                                            <input type="text" class="form-control"
                                                                                   name="post_service_summary[password]"
                                                                                   id="post_service_pwd"
                                                                                   placeholder=""/>
                                                                        </div>
                                                                        <div class=" col-md-4 form-group">
                                                                            <label for="post_service_pre_install">Pre-Install
                                                                                Conf.
                                                                                #</label>
                                                                            <input type="text" class="form-control"
                                                                                   name="post_service_summary[pre_install_conf]"
                                                                                   id="post_service_pre_install"
                                                                                   placeholder=""/>
                                                                        </div>
                                                                        <div class=" col-md-4 form-group">
                                                                            <label for="post_service_wifi_pwd">WiFi
                                                                                Password</label>
                                                                            <input type="text" class="form-control"
                                                                                   name="post_service_summary[wifi_password]"
                                                                                   id="post_service_wifi_pwd"
                                                                                   placeholder=""/>
                                                                        </div>
                                                                        <div class=" col-md-4 form-group">
                                                                            <label for="post_service_panel_location">Panel
                                                                                Location</label>
                                                                            <input type="text" class="form-control"
                                                                                   name="post_service_summary[panel_location]"
                                                                                   id="post_service_panel_location"
                                                                                   placeholder=""/>
                                                                        </div>
                                                                        <div class=" col-md-4 form-group">
                                                                            <label for="post_service_trans_location">Transformer
                                                                                Location</label>
                                                                            <input type="text" class="form-control"
                                                                                   name="post_service_summary[transformer_location]"
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
                            </div>


                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <button type="button" onClick="validatecard();"
                                            class="btn btn-flat btn-primary">
                                        Submit
                                    </button>
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
</div>

<?php echo $file_selection; ?>
<?php include viewPath('includes/footer'); ?>

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

        // phone type change, add the value to hiddend field and show the text
        $(document.body).on('click', '.changePhoneType', function () {
            $(this).closest('.phone-input').find('.type-text').text($(this).text());
            $(this).closest('.phone-input').find('.type-input').val($(this).data('type-value'));
        });


        $('#user_agreementupload').change(function (e) {

            var file = this.files[0];
            var form = new FormData();
            form.append('upload', file);
            $.ajax({
                url: '/docread.php',
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: form,
                success: function (response) {
                    /* alert(response); */
                    $('#showuploadagreement').empty().html(response);
                }
            });
        });

    });
</script>
