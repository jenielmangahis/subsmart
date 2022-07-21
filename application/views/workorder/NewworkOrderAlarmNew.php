<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
<?php include viewPath('includes/sidebars/workorder'); ?>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<style>
    .form-field
    {

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
}
</style>

    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40 add_mobile">
            <div class="row" style="margin-top: 30px;">
                <div class="col">
                    <center><h3 class="m-0">ALARM SYSTEM WORK ORDER AGREEMENT</h3></center>
                </div>
            </div>

            <!-- <div style="background-color:#fdeac3; width:100%;padding:.5%;margin-bottom:5px;margin-top:5px;margin-bottom:10px;">
                Create new workorder.
            </div> -->
          <div class="card">              
            <!-- end row -->
            <!-- <div class="row">
                <div class="col-md-12" style="background-color:#32243d;padding:1px;text-align:center;color:white;">
                    <h5>General Information</h5>
                </div>
            </div>
            <br> -->
            <?php echo form_open_multipart('workorder/savenewWorkorderAlarm', [ 'class' => 'form-validate', 'autocomplete' => 'off']); ?> 
            <div class="row">
                <div class="col-md-12">
                    <center><div id="header_area">
                        <!-- <h4 class="mt-0 header-title mb-5">Header</h4> -->
                        <br>
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
                        <input type="hidden" id="current_date" value="<?php echo @date('m-d-Y'); ?>">

                        <input type="hidden" id="content_input" class="form-control" name="header_" value="<?php echo $headers->content; ?>">
                        <input type="hidden" name="wo_id" value="<?php 
                        foreach($ids as $id)
                        {
                            $add = $id->id + 1;
                            echo $add;
                        }
                        ?>">
                    </div>
                    </center>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <!-- <div class="card"> -->
                        <!-- <div class="card-body">-->
                            <!-- ====== CUSTOMER ====== -->
							<div class="row" id="group_area">
                                <div class="col-md-3 form-group">
                                    <label for="contact_name" class="label-element">Work Order #</label>
                                            <!-- <input type="text" class="form-control input-element" name="workorder_number" id="contact_name" value="<?php echo "WO-"; 
                                            foreach ($number as $num):
                                                    $next = $num->work_order_number;
                                                    $arr = explode("-", $next);
                                                    $date_start = $arr[0];
                                                    $nextNum = $arr[1];
                                                //    echo $number;
                                            endforeach;
                                            $val = $nextNum + 1;
                                            echo str_pad($val,7,"0",STR_PAD_LEFT);
                                            ?>" required readonly/> -->

                                        <input type="text" class="form-control input-element" name="workorder_number" id="workorder-number" value="<?= $prefix . $next_num; ?>" required readonly/>
                                </div>
                            </div>
                        <!-- </div>	 -->
                    <!-- </div> -->
                </div>
                <!-- end row -->
            </div>
            
            <!-- ====== CUSTOMER ====== -->
            <div class="row">
                <div class="col-md-12">
                    <h6>CUSTOMER</h6>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
					<div class="row" id="group_area" align="center">
                        <div class="col-md-3">
                            <input type="text" class="form-control border-top-0 border-right-0 border-left-0">
                            LAST NAME
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control border-top-0 border-right-0 border-left-0">
                            FIRST NAME
                        </div>
                        <div class="col-md-1">
                            <input type="text" class="form-control border-top-0 border-right-0 border-left-0">
                            MI
                        </div>
                        <div class="col-md-1">
                            <input type="text" class="form-control border-top-0 border-right-0 border-left-0">
                            DOB
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control border-top-0 border-right-0 border-left-0">
                            SSN
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control border-top-0 border-right-0 border-left-0">
                            CELL PHONE #
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <br>
            <div class="row">
                <div class="col-md-12">
                    <h6>SPOUSE</h6>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
					<div class="row" id="group_area" align="center">
                        <div class="col-md-3">
                            <input type="text" class="form-control border-top-0 border-right-0 border-left-0">
                            LAST NAME
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control border-top-0 border-right-0 border-left-0">
                            FIRST NAME
                        </div>
                        <div class="col-md-1">
                            <input type="text" class="form-control border-top-0 border-right-0 border-left-0">
                            MI
                        </div>
                        <div class="col-md-1">
                            <input type="text" class="form-control border-top-0 border-right-0 border-left-0">
                            DOB
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control border-top-0 border-right-0 border-left-0">
                            SSN
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control border-top-0 border-right-0 border-left-0">
                            CELL PHONE #
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <br>
            <div class="row">
                <div class="col-md-12">
                    <h6>ADDRESS</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
					<div class="row" id="group_area" align="center">
                        <div class="col-md-3">
                            <input type="text" class="form-control border-top-0 border-right-0 border-left-0">
                            MONITORED LOCATION
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control border-top-0 border-right-0 border-left-0">
                            CITY
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control border-top-0 border-right-0 border-left-0">
                            STATE
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control border-top-0 border-right-0 border-left-0">
                            ZIP
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control border-top-0 border-right-0 border-left-0">
                            CROSS STREET
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <br><br>
            <div class="row">
                <div class="col-md-12">
					<div class="row" id="group_area" align="center">
                        <div class="col-md-3">
                            <input type="text" class="form-control border-top-0 border-right-0 border-left-0">
                            EMAIL
                        </div>
                        <div class="col-md-3">
							<select name="customer_type" required class="form-control custom-select m_select border-top-0 border-right-0 border-left-0" id="customer_type">
								<?php foreach (get_config_item('customer_types') as $key => $customer_type) { ?>
									<option value="<?php echo $customer_type ?>" <?php echo (!empty($workorder->customer['customer_type']) && $workorder->customer['customer_type'] == $customer_type) ? "selected" : "" ?>>
										<?php echo $customer_type ?>
									</option>
								<?php } ?>
							</select>
                            CUSTOMER TYPE
                        </div>
                        <div class="col-md-2">
                            <select name="install_type"  class="form-control custom-select m_select border-top-0 border-right-0 border-left-0" id="customer_install_type">
								<?php foreach (get_config_item('install_types') as $key => $install_type) { ?>
									<option value="<?php echo $install_type ?>" <?php echo (!empty($workorder->customer['install_type']) && $workorder->customer['install_type'] == $install_type) ? "selected" : "" ?>>
										<?php echo $install_type ?>
									</option>
								<?php } ?>
							</select>
                            INSTALL TYPE
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control border-top-0 border-right-0 border-left-0">
                            PASSWORD
                        </div>
                        <div class="col-md-2">
                            <select name="notification_type" id="customer_notification_type_email" class="form-control custom-select m_select border-top-0 border-right-0 border-left-0">
                                <option>Notification Type</option>
                                <option value="Text">Text</option>
                                <option value="Email">Email</option>
                                <option value="Text and Email">Text and Email</option>
                                <option value="None">None</option>
                            </select>
                            NOTIFICATION TYPE
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <br><br>
            <div style="border: solid gray 0.5px;padding:1.5%;">
                <div class="row">
                    <div class="form-group col-md-12">
                        <h5 class="box-title">EMERGENCY CALL LIST</h5>
                    </div>
                </div>
                <!-- ====== EMERGENCY CALL LIST ====== -->
                            <div class="row" id="group_area" align="center">
                                <div class="col-md-4 form-group">
                                    <!-- <div class=""> -->
                                        <!-- <label for="1st_call_verification_name" class="label-element">1st Call Verification Name <small class="help help-sm">(optional)</small></label> -->
                                        <input type="text" class="form-control input-element border-top-0 border-right-0 border-left-0"
                                               name="1st_verification_name[]"
                                               value="<?php echo (!empty($workorder->emergency_call_list['1st_call_verification_name'])) ? $workorder->emergency_call_list['1st_call_verification_name'] : '' ?>"
                                               id="1st_call_verification_name"
                                                placeholder="Enter 1st Call Verification Name"/>
                                        1ST VERIFICATION NAME <small class="help help-sm">(optional)</small>
                                    <!-- </div> -->
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <!-- <label for="contact_phone" class="mobile_view">Phone Number <small class="help help-sm">(optional)</small></label> -->
                                        <div class="input-group phone-input">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default dropdown-toggle border-top-0 border-right-0 border-left-0"
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
                                                   class="form-control border-top-0 border-right-0 border-left-0"
                                                   value="<?php echo (!empty($workorder->emergency_call_list['phone']['number'][0])) ? $workorder->emergency_call_list['phone']['number'][0] : '' ?>"
                                                   placeholder="Enter Phone"/>
                                        </div>
                                        PHONE NUMBER <small class="help help-sm">(optional)</small>

                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                                <select name="1st_relation[]" id="1st_relation" class="form-control custom-select m_select border-top-0 border-right-0 border-left-0">
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
                                                RELATION  <small class="help help-sm">(optional)</small>
                                </div>

                                <div class="col-md-4 form-group">
                                        <!-- <label for="" class="label-element">2nd Call Verification Name <small class="help help-sm">(optional)</small></label> -->
                                        <input type="text" class="form-control input-element border-top-0 border-right-0 border-left-0"
                                               name="1st_verification_name[]"
                                               id="2nd_call_verification_name"
                                               value="<?php echo (!empty($workorder->emergency_call_list['2nd_call_verification_name'])) ? $workorder->emergency_call_list['2nd_call_verification_name'] : '' ?>"
                                                placeholder="Enter 2nd Call Verification Name"/>
                                                2ND VERIFICATION NAME <small class="help help-sm">(optional)</small> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <!-- <label for="contact_phone" class="mobile_view">Phone Number <small class="help help-sm">(optional)</small></label> -->
                                        <div class="input-group phone-input">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default dropdown-toggle input-element border-top-0 border-right-0 border-left-0"
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
                                                   class="form-control input-element border-top-0 border-right-0 border-left-0"
                                                   value="<?php echo (!empty($workorder->emergency_call_list['phone']['number'][1])) ? $workorder->emergency_call_list['phone']['number'][1] : '' ?>"
                                                   placeholder="Enter Phone"/>
                                        </div>
                                        PHONE NUMBER <small class="help help-sm">(optional)</small>

                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <!-- <div class="form-group"> -->
                                        <!-- <label for="emergency_call_relation" class="label-element">Relation <small class="help help-sm">(optional)</small></label> -->
                                                <select name="1st_relation[]" id="2nd_relation" class="form-control custom-select m_select border-top-0 border-right-0 border-left-0">
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
                                                RELATION  <small class="help help-sm">(optional)</small>
                                    <!-- </div> -->
                                </div>

                                <div class="col-md-4 form-group">
                                    <!-- <div class=""> -->
                                        <!-- <label for="emergency_call_emergency_contact_1" class="label-element">3rd Call Verification Name <small class="help help-sm">(optional)</small></label> -->
                                        <input type="text" class="form-control input-element border-top-0 border-right-0 border-left-0"
                                               name="1st_verification_name[]"
                                               id="emergency_call_emergency_contact_1"
                                               value="<?php echo (!empty($workorder->emergency_call_list['emergency_contact_1'])) ? $workorder->emergency_call_list['emergency_contact_1'] : '' ?>"
                                                placeholder="Enter Emergency Contact"/>
                                                3RD VERIFICATION NAME <small class="help help-sm">(optional)</small> 
                                    <!-- </div> -->
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <!-- <label for="contact_phone" class="mobile_view">Phone Number <small class="help help-sm">(optional)</small></label> -->
                                        <div class="input-group phone-input">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default dropdown-toggle border-top-0 border-right-0 border-left-0"
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
                                                   class="form-control border-top-0 border-right-0 border-left-0"
                                                   value="<?php echo (!empty($workorder->emergency_call_list['phone']['number'][2])) ? $workorder->emergency_call_list['phone']['number'][2] : '' ?>"
                                                   placeholder="Enter Phone"/>
                                        </div>
                                        PHONE NUMBER <small class="help help-sm">(optional)</small>

                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <!-- <div class="form-group"> -->
                                        <!-- <label for="emergency_call_relation" class="label-element">Relation <small class="help help-sm">(optional)</small></label> -->
                                                <select name="1st_relation[]" id="3rd_relation" class="form-control custom-select m_select border-top-0 border-right-0 border-left-0">
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
                                                RELATION  <small class="help help-sm">(optional)</small>
                                    <!-- </div> -->
                                </div>

                                <!-- <div class="col-md-3">
								</div> -->
                                <div class="col-md-4 form-group">
                                    <!-- <div class=""> -->
                                        <!-- <label for="emergency_call_emergency_contact_2" class="label-element">4th Call Verification Name <small class="help help-sm">(optional)</small></label> -->
                                        <input type="text" class="form-control input-element border-top-0 border-right-0 border-left-0"
                                               name="1st_verification_name[]"
                                               id="emergency_call_emergency_contact_2"
                                               value="<?php echo (!empty($workorder->emergency_call_list['emergency_contact_2'])) ? $workorder->emergency_call_list['emergency_contact_2'] : '' ?>"
                                                placeholder="Enter Emergency Contact"/>
                                                4TH VERIFICATION NAME <small class="help help-sm">(optional)</small> 
                                    <!-- </div> -->
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <!-- <label for="contact_phone" class="mobile_view">Phone Number <small class="help help-sm">(optional)</small></label> -->
                                        <div class="input-group phone-input">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default dropdown-toggle border-top-0 border-right-0 border-left-0"
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
                                                   class="form-control border-top-0 border-right-0 border-left-0"
                                                   value="<?php echo (!empty($workorder->emergency_call_list['phone']['number'][3])) ? $workorder->emergency_call_list['phone']['number'][3] : '' ?>"
                                                   placeholder="Enter Phone"/>
                                        </div>
                                        PHONE NUMBER <small class="help help-sm">(optional)</small>

                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <!-- <div class=""> -->
                                        <!-- <label for="emergency_call_relation" class="label-element">Relation <small class="help help-sm">(optional)</small></label> -->
                                                <select name="1st_relation[]" id="4th_relation" class="form-control custom-select m_select border-top-0 border-right-0 border-left-0">
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
                                                RELATION  <small class="help help-sm">(optional)</small>
                                    <!-- </div> -->
                                </div>
                            </div>

            </div>
            <br><br>
            <div class="row">
                <div class="col-md-7">
					<div class="row" id="group_area">
                        <?php if (!empty($workorder->additional_services)) { ?>

                        <div class="row" id="plansItemDiv">

                            <div class="col-md-12">
                            <table class="table table-hover">
                        <input type="hidden" name="count" value="0" id="count">
                        <thead style="background-color:#E9E8EA;">
                        <tr>
                            <th>Name</th>
                            <th>Group</th>
                            <!-- <th>Description</th> -->
                            <th width="150px">Quantity</th>
                            <!-- <th>Location</th> -->
                            <th width="150px">Price</th>
                            <th class="hidden_mobile_view" width="150px">Discount</th>
                            <th class="hidden_mobile_view" width="150px">Tax (Change in %)</th>
                            <th class="hidden_mobile_view">Total</th>
                        </tr>
                        </thead>
                        <tbody id="jobs_items_table_body">
                        <tr>
                            <td width="30%">
                                <input type="text" class="form-control getItems"
                                    onKeyup="getItems(this)" name="items[]">
                                <ul class="suggestions"></ul>
                                <div class="show_mobile_view"><span class="getItems_hidden"></span></div>
                                <input type="hidden" name="itemid[]" id="itemid" class="itemid" value="0">
                                <input type="hidden" name="packageID[]" value="0">
                            </td>
                            <td width="20%">
                            <div class="dropdown-wrapper">
                                <select name="item_type[]" id="item_typeid" class="form-control">
                                    <option value="product">Product</option>
                                    <option value="material">Material</option>
                                    <option value="service">Service</option>
                                    <option value="fee">Fee</option>
                                </select>
                            </div>

                            <!-- <div class="show_mobile_view" style="color:green;"><span>Product</span></div> -->
                                </td>
                            <td width="10%"><input type="number" class="form-control quantity_w mobile_qty" name="quantity[]"
                                    data-counter="0" id="quantity_0" value="1"></td>
                            <td width="10%"><input type="number" class="form-control price_w price hidden_mobile_view" name="price[]"
                                    data-counter="0" id="price_0" min="0" value="0"> <input type="hidden" class="priceqty" value="0" id="priceqty_0"> 
                                    <div class="show_mobile_view"><span class="price">0</span>
                                    <!-- <input type="hidden" class="form-control price" name="price[]" data-counter="0" id="priceM_0" min="0" value="0"> -->
                                    </div><input id="priceM_qty0" value="0"  type="hidden" name="price_qty[]" class="form-control hidden_mobile_view price_qty"></td>
                            <td width="10%" class="hidden_mobile_view"><input type="number" class="form-control discount" name="discount[]"
                                    data-counter="0" id="discount_0" min="0" value="0" ></td>
                            <td width="10%" class="hidden_mobile_view"><input type="text" class="form-control tax_change" name="tax[]"
                                    data-counter="0" id="tax1_0" min="0" value="0">
                                    <!-- <span id="span_tax_0">0.0</span> -->
                                    </td>
                            <td width="10%" class="hidden_mobile_view"><input type="hidden" class="form-control " name="total[]"
                                    data-counter="0" id="item_total_0" min="0" value="0">
                                    $<span id="span_total_0">0.00</span></td>
                            <td><a href="#" class="remove btn btn-sm btn-success" id="0"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                        </tr>
                        </tbody>
                        </table>
                                <!-- <a href="#" class="btn btn-primary" id="add_another">Add Items</a> -->
                                <a class="link-modal-open" href="#" id="add_another_itemss" data-toggle="modal" data-target="#item_list"><span class="fa fa-plus-square fa-margin-right"></span>Add Items</a>
                                &emsp;
                                <a class="link-modal-open" href="#" id="add_package" data-toggle="modal" data-target=".bd-example-modal-lg"><span class="fa fa-plus-square fa-margin-right"></span>Add By Group</a> &emsp;
                                <a class="link-modal-open" href="#" id="create_package" data-toggle="modal" data-target=".createPackage"><span class="fa fa-plus-square fa-margin-right"></span>Add/Create Package</a>
                            </div>
                        </div><br/>


                        <?php } else { ?>

                        <div class="row" id="plansItemDiv">

                            <div class="col-md-12">
                            <table class="table table-hover">
                        <input type="hidden" name="count" value="0" id="count">
                        <thead style="background-color:#E9E8EA;">
                        <tr>
                            <th>Name</th>
                            <!-- <th>Group</th> -->
                            <!-- <th>Description</th> -->
                            <th width="150px">Quantity</th>
                            <!-- <th>Location</th> -->
                            <th width="150px">Price</th>
                            <th class="hidden_mobile_view" width="150px">Discount</th>
                            <th class="hidden_mobile_view" width="150px">Tax (Change in %)</th>
                            <th class="hidden_mobile_view">Total</th>
                        </tr>
                        </thead>
                        <tbody id="jobs_items_table_body">
                            <tr style="display:none;">
                                <td width="30%">
                                    <input type="text" class="form-control getItems"
                                        onKeyup="getItems(this)" name="items[]">
                                    <ul class="suggestions"></ul>
                                    <div class="show_mobile_view"><span class="getItems_hidden"></span></div>
                                    <input type="hidden" name="itemid[]" id="itemid" class="itemid" value="0">
                                    <input type="hidden" name="packageID[]" value="0">
                                </td>
                                <!-- <td width="20%">
                                <div class="dropdown-wrapper">
                                    <select name="item_type[]" id="item_typeid" class="form-control">
                                        <option value="product">Product</option>
                                        <option value="material">Material</option>
                                        <option value="service">Service</option>
                                        <option value="fee">Fee</option>
                                    </select>
                                </div> -->

                                <!-- <div class="show_mobile_view" style="color:green;"><span>Product</span></div> -->
                                    <!-- </td> -->
                                <td width="10%"><input type="number" class="form-control quantity mobile_qty" name="quantity[]"
                                        data-counter="0" id="quantity_0" value="1"></td>
                                <td width="10%"><input type="number" class="form-control price_ price hidden_mobile_view" name="price[]"
                                        data-counter="0" id="price_0" min="0" value="0"> <input type="hidden" class="priceqty" value="0" id="priceqty_0"> 
                                        <div class="show_mobile_view"><span class="price">0</span>
                                        <!-- <input type="hidden" class="form-control price" name="price[]" data-counter="0" id="priceM_0" min="0" value="0"> -->
                                        </div><input id="priceM_qty0" value="0"  type="hidden" name="price_qty[]" class="form-control hidden_mobile_view price_qty"></td>
                                <td width="10%" class="hidden_mobile_view"><input type="number" class="form-control discount" name="discount[]"
                                        data-counter="0" id="discount_0" min="0" value="0"></td>
                                <td width="10%" class="hidden_mobile_view"><input type="text" class="form-control tax_change" name="tax[]"
                                        data-counter="0" id="tax1_0" min="0" value="0" disabled="">
                                        <!-- <span id="span_tax_0">0.0</span> -->
                                        </td>
                                <td width="10%" class="hidden_mobile_view"><input type="hidden" class="form-control " name="total[]"
                                        data-counter="0" id="item_total_0" min="0" value="0">
                                        $<span id="span_total_0">0.00</span></td>
                                <td><a href="#" class="remove btn btn-sm btn-success" id="0"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                            </tr>
                            </tbody>
                        </table>
                                <!-- <a href="#" class="btn btn-primary" id="add_another">Add Items</a> -->
                                <a class="link-modal-open" href="#" id="add_another_itemss" data-toggle="modal" data-target="#item_list"><span class="fa fa-plus-square fa-margin-right"></span>Add Items</a>
                                &emsp;
                                <a class="link-modal-open" href="#" id="add_package" data-toggle="modal" data-target=".bd-example-modal-lg"><span class="fa fa-plus-square fa-margin-right"></span>Add By Group</a> &emsp;
                                <a class="link-modal-open" href="#" id="create_package" data-toggle="modal" data-target=".createPackage"><span class="fa fa-plus-square fa-margin-right"></span>Add/Create Package</a>
                            </div>
                        </div><br/>

                        <?php } ?>
                    </div>
                    <br><br>
                    <div class="row" align="center">
                        <div class="col-md-8 form-group">
							<input type="text" class="form-control input-element border-top-0 border-right-0 border-left-0" name="password" required id="password" >
							<label for="password" class="label-element">Password <span class="form-required">*</span></label>
						</div>
                        <div class="col-md-8 form-group">
							<input type="text" class="form-control input-element border-top-0 border-right-0 border-left-0" name="password" required id="password" >
							<label for="password" class="label-element">Checking Number <span class="form-required">*</span></label>
						</div>
                        <div class="col-md-8 form-group">
							<input type="text" class="form-control input-element border-top-0 border-right-0 border-left-0" name="password" required id="password" >
							<label for="password" class="label-element">Routing <span class="form-required">*</span></label>
						</div>
                        <div class="col-md-8 form-group">
							<input type="text" class="form-control input-element border-top-0 border-right-0 border-left-0" name="password" required id="password" >
							<label for="password" class="label-element">Sales Rep's Name <span class="form-required">*</span></label>
						</div>
                        <div class="col-md-4 form-group">
							<input type="text" class="form-control input-element border-top-0 border-right-0 border-left-0" name="password" required id="password" >
							<label for="password" class="label-element">Cell Phone <span class="form-required">*</span></label>
						</div>
                        <div class="col-md-8 form-group">
							<input type="text" class="form-control input-element border-top-0 border-right-0 border-left-0" name="password" required id="password" >
							<label for="password" class="label-element">Team Leader <span class="form-required">*</span></label>
						</div>
                    </div>
                </div>

                <div class="col-md-5">
                <h6>Agreement</h6>
                                    <div style="height:; overflow:auto; background:#FFFFFF; padding-left:10px;" id="thisdiv2">
                                    <?php echo $terms_conditions->content; ?></p>
                                            <input type="hidden" id="company_id" value="<?php echo getLoggedCompanyID(); ?>">
                                            <input type="hidden" class="form-control" name="terms_conditions" id="terms_conditions" value="<?php echo $terms_conditions->content; ?>" />
                                    </div>
                </div>
            </div>
            <!-- end row -->

            <?php echo form_close(); ?>
        </div>
        <!-- page wrapper end -->
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
                                                <td><button id="<?= $item->id; ?>" data-quantity="<?= $item->units; ?>" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>" type="button" data-dismiss="modal" class="btn btn-sm btn-default select_itemnew">
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

    <?php include viewPath('includes/footer'); ?>

    <script>
    $("#first_name").keyup(function () {
      var value = $(this).val();
      var value2 = $("#last_name").val();
      $("#primary_account_holder_name").val(value + ' ' + value2);
    }).keyup();

    $("#last_name").keyup(function () {
      var value2 = $(this).val();
      var value = $("#first_name").val();
      $("#primary_account_holder_name").val(value + ' ' + value2);
    }).keyup();

    $("#spouse_first_name").keyup(function () {
      var value = $(this).val();
      var value2 = $("#spouse_last_name").val();
      $("#secondery_account_holder_name").val(value + ' ' + value2);
    }).keyup();

    $("#spouse_last_name").keyup(function () {
      var value2 = $(this).val();
      var value = $("#spouse_first_name").val();
      $("#secondery_account_holder_name").val(value + ' ' + value2);
    }).keyup();
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

//   signaturePadCanvas.width  = 780;
  signaturePadCanvas.height = 300;
});

var signaturePad2;
jQuery(document).ready(function () {
  var signaturePadCanvas2 = document.querySelector('#canvas2b');
//   var parentWidth = jQuery(signaturePadCanvas).parent().outerWidth();
//   signaturePadCanvas.setAttribute("width", parentWidth);
  signaturePad2 = new SignaturePad(signaturePadCanvas2);

//   signaturePadCanvas2.width  = 780;
  signaturePadCanvas2.height = 300;
});

var signaturePad3;
jQuery(document).ready(function () {
  var signaturePadCanvas3 = document.querySelector('#canvas3b');
//   var parentWidth = jQuery(signaturePadCanvas).parent().outerWidth();
//   signaturePadCanvas.setAttribute("width", parentWidth);
  signaturePad3 = new SignaturePad(signaturePadCanvas3);

//   signaturePadCanvas3.width  = 780;
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
</script>

<script>
  $( function() {
    $( "#datepicker" ).datepicker();
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
        // var Randnumber = Math.floor(Math.random()*(999999-1000000+1)+100);

        console.log(response['pName']);

                    // var inputs1 = "";
                        $.each(response['pName'], function (a, b) {
                            // inputs1 += b.name;
                            var pName = b.name;
                            // var Rnumber = 3 + Math.floor(Math.random() * 9);
                            // var Rnumber = Math.floor(Math.random()*(9999-100000+1)+100);
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
        // var Randnumber = Math.floor(Math.random()*(999999-1000000+1)+100);

        console.log(response['pName']);

                    // var inputs1 = "";
                        $.each(response['pName'], function (a, b) {
                            // inputs1 += b.name;
                            var pName = b.name;
                            // var Rnumber = 1 + Math.floor(Math.random() * 9);
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

//   signaturePadCanvas3.width  = 780;
//   signaturePadCanvas3.height = 300;
});

var signaturePad2;
jQuery(document).ready(function () {
  var signaturePadCanvas2 = document.querySelector('#canvas2');
//   var parentWidth = jQuery(signaturePadCanvas).parent().outerWidth();
//   signaturePadCanvas.setAttribute("width", parentWidth);
  signaturePad2 = new SignaturePad(signaturePadCanvas2);

//   signaturePadCanvas3.width  = 780;
//   signaturePadCanvas3.height = 300;
});

var signaturePad3;
jQuery(document).ready(function () {
  var signaturePadCanvas3 = document.querySelector('#canvas3');
//   var parentWidth = jQuery(signaturePadCanvas).parent().outerWidth();
//   signaturePadCanvas.setAttribute("width", parentWidth);
  signaturePad3 = new SignaturePad(signaturePadCanvas3);

//   signaturePadCanvas3.width  = 780;
//   signaturePadCanvas3.height = 300;
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

        var input_conf = '<br><div style="border:solid gray 1px;padding:2%;width:400px !important;"><img id="image1" src="'+dataURL+'"></img><input type="hidden" class="form-control" name="signature1" id="signature1" value="'+ dataURL +'"><br><input type="text" class="form-control" name="name1" id="name1" value="'+ input1 +'" readonly></div><br><div style="border:solid gray 1px;padding:2%;"><img id="image1" src="'+dataURL2+'"></img><input type="hidden" class="form-control" name="signature2" id="signature2" value="'+ dataURL2 +'"><br><input type="text" class="form-control" name="name2" id="name2" value="'+ input2 +'" readonly></div><br><div style="border:solid gray 1px;padding:2%;"><img id="image1" src="'+dataURL3+'"></img><input type="hidden" class="form-control" name="signature3" id="signature3" value="'+ dataURL3 +'"><br><input type="text" class="form-control" name="name3" id="name3" value="'+ input3 +'" readonly></div>';

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
        var grand = $("#grand_total_inputs").val(grand_tot.toFixed(2));
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
        var grand = $("#grand_total_inputs").val(grand_tot.toFixed(2));
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

$(document).on('click','.btn-edit-header',function(){
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
$('#modal_items_list').DataTable({
    "autoWidth" : false,
    "columnDefs": [
    { width: 540, targets: 0 },
    { width: 100, targets: 0 },
    { width: 100, targets: 0 }
    ],
    "ordering": false,
});
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
                        "<a href=\"#\" class=\"remove btn btn-sm btn-success\" id='"+v.id+"'><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>\n" +
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

                var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
                sls = parseFloat(sls).toFixed(2);
                $("#sales_tax").val(sls);
                cal_total_due();


    },
        error: function(response){
        alert('Error'+response);

        }
});



//   if(!$(this).data('quantity')){
//     // alert($(this).data('quantity'));
//     var qty = 0;
//   }else{
//     // alert('0');
//     var qty = $(this).data('quantity');
//   }

//   var count = parseInt($("#count").val()) + 1;
//   $("#count").val(count);
//   var total_ = price * qty;
//   var tax_ =(parseFloat(total_).toFixed(2) * 7.5) / 100;
//   var taxes_t = parseFloat(tax_).toFixed(2);
//   var total = parseFloat(total_).toFixed(2);
//   var withCommas = Number(total).toLocaleString('en');
//   total = '$' + withCommas + '.00';
//   // console.log(total);
//   // alert(total);
//   markup = "<tr id=\"ss\">" +
//       "<td width=\"35%\"><input value='"+title+"' type=\"text\" name=\"items[]\" class=\"form-control getItems\" ><input type=\"hidden\" value='"+idd+"' name=\"item_id[]\"><div class=\"show_mobile_view\"><span class=\"getItems_hidden\">"+title+"</span></div></td>\n" +
//       "<td width=\"20%\"><div class=\"dropdown-wrapper\"><select name=\"item_type[]\" class=\"form-control\"><option value=\"product\">Product</option><option value=\"material\">Material</option><option value=\"service\">Service</option><option value=\"fee\">Fee</option></select></div></td>\n" +
//       "<td width=\"10%\"><input data-itemid='"+idd+"' id='quantity_"+idd+"' value='"+qty+"' type=\"number\" name=\"quantity[]\" data-counter=\"0\"  min=\"0\" class=\"form-control qtyest2 mobile_qty \"></td>\n" +
//       // "<td>\n" + '<input type="number" class="form-control qtyest" name="quantity[]" data-counter="' + count + '" id="quantity_' + count + '" min="1" value="1">\n' + "</td>\n" +
//       "<td width=\"10%\"><input id='price_"+idd+"' value='"+price+"'  type=\"number\" name=\"price[]\" class=\"form-control hidden_mobile_view \" placeholder=\"Unit Price\"><input type=\"hidden\" class=\"priceqty\" id='priceqty_"+idd+"'><div class=\"show_mobile_view\"><span class=\"price\">"+price+"</span><input type=\"hidden\" class=\"form-control price\" name=\"price[]\" data-counter=\"0\" id=\"priceM_0\" min=\"0\" value='"+price+"'></div></td>\n" +
//       // "<td width=\"10%\"><input type=\"number\" class=\"form-control discount\" name=\"discount[]\" data-counter="0" id=\"discount_0\" min="0" value="0" ></td>\n" +
//       // "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control\"></td>\n" +
//       "<td width=\"10%\" class=\"hidden_mobile_view\"><input type=\"number\" name=\"discount[]\" class=\"form-control discount\" id='discount_"+idd+"'></td>\n" +
//       // "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
//       "<td width=\"20%\" class=\"hidden_mobile_view\"><input type=\"text\" data-itemid='"+idd+"' class=\"form-control tax_change2\" name=\"tax[]\" data-counter=\"0\" id='tax1_"+idd+"' min=\"0\" value='"+taxes_t+"'></td>\n" +
//       "<td style=\"text-align: center\" class=\"hidden_mobile_view\" width=\"15%\"><span data-subtotal='"+total_+"' id='span_total_"+idd+"' class=\"total_per_item\">"+total+
//       // "</span><a href=\"javascript:void(0)\" class=\"remove_item_row\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></a>"+
//       "</span> <input type=\"hidden\" name=\"total[]\" id='sub_total_text"+idd+"' value='"+total+"'></td>" +
//       "</tr>";
//   tableBody = $("#jobs_items_table_body");
//   tableBody.append(markup);
//   markup2 = "<tr id=\"sss\">" +
//       "<td >"+title+"</td>\n" +
//       "<td ></td>\n" +
//       "<td ></td>\n" +
//       "<td >"+price+"</td>\n" +
//       "<td ></td>\n" +
//       "<td >"+qty+"</td>\n" +
//       "<td ></td>\n" +
//       "<td ></td>\n" +
//       "<td >0</td>\n" +
//       "<td ></td>\n" +
//       "<td ><a href=\"#\" data-name='"+title+"' data-price='"+price+"' data-quantity='"+qty+"' id='"+idd+"' class=\"edit_item_list\"><span class=\"fa fa-edit\"></span></i></a> <a href=\"javascript:void(0)\" class=\"remove_audit_item_row\"><span class=\"fa fa-trash\"></span></i></a></td>\n" +
//       "</tr>";
//   tableBody2 = $("#device_audit_datas");
//   tableBody2.append(markup2);
//   // calculate_subtotal();
//   // var counter = $(this).data("counter");
//   // calculation(idd);

// var in_id = idd;
// var price = $("#price_" + in_id).val();
// var quantity = $("#quantity_" + in_id).val();
// var discount = $("#discount_" + in_id).val();
// var tax = (parseFloat(price) * 7.5) / 100;
// var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(
// 2
// );
// if( discount == '' ){
// discount = 0;
// }

// var total = (
// (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
// parseFloat(discount)
// ).toFixed(2);

// var total_wo_tax = price * quantity;

// // alert( 'yeah' + total);


// $("#priceqty_" + in_id).val(total_wo_tax);
// $("#span_total_" + in_id).text(total);
// $("#sub_total_text" + in_id).val(total);
// $("#tax_1_" + in_id).text(tax1);
// $("#tax1_" + in_id).val(tax1);
// $("#discount_" + in_id).val(discount);

// if( $('#tax_1_'+ in_id).length ){
// $('#tax_1_'+in_id).val(tax1);
// }

// if( $('#item_total_'+ in_id).length ){
// $('#item_total_'+in_id).val(total);
// }

// var eqpt_cost = 0;
// var total_costs = 0;
// var cnt = $("#count").val();
// var total_discount = 0;
// var pquantity = 0;
// for (var p = 0; p <= cnt; p++) {
// var prc = $("#price_" + p).val();
// var quantity = $("#quantity_" + p).val();
// var discount = $("#discount_" + p).val();
// var pqty = $("#priceqty_" + p).val();
// // var discount= $('#discount_' + p).val();
// // eqpt_cost += parseFloat(prc) - parseFloat(discount);
// pquantity += parseFloat(pqty);
// total_costs += parseFloat(prc);
// eqpt_cost += parseFloat(prc) * parseFloat(quantity);
// total_discount += parseFloat(discount);
// }
// //   var subtotal = 0;
// // $( total ).each( function(){
// //   subtotal += parseFloat( $( this ).val() ) || 0;
// // });

// var total_cost = 0;
// // $("#span_total_0").each(function(){
// $('*[id^="price_"]').each(function(){
// total_cost += parseFloat($(this).val());
// });

// // var totalcosting = 0;
// // $('*[id^="span_total_"]').each(function(){
// //   totalcosting += parseFloat($(this).val());
// // });


// // alert(total_cost);

// var tax_tot = 0;
// $('*[id^="tax1_"]').each(function(){
// tax_tot += parseFloat($(this).val());
// });

// over_tax = parseFloat(tax_tot).toFixed(2);
// // alert(over_tax);

// $("#sales_taxs").val(over_tax);
// $("#total_tax_input").val(over_tax);
// $("#total_tax_").text(over_tax);


// eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
// total_discount = parseFloat(total_discount).toFixed(2);
// stotal_cost = parseFloat(total_cost).toFixed(2);
// priceqty = parseFloat(pquantity).toFixed(2);
// // var test = 5;

// var subtotal = 0;
// // $("#span_total_0").each(function(){
// $('*[id^="span_total_"]').each(function(){
// subtotal += parseFloat($(this).text());
// });
// // $('#sum').text(subtotal);

// var subtotaltax = 0;
// // $("#span_total_0").each(function(){
// $('*[id^="tax_1_"]').each(function(){
// subtotaltax += parseFloat($(this).text());
// });


// var priceqty2 = 0;
// $('*[id^="priceqty_"]').each(function(){
// priceqty2 += parseFloat($(this).val());
// });

// $("#span_sub_total_invoice").text(priceqty2.toFixed(2));
// // $("#span_sub_total_invoice").text(priceqty);

// $("#eqpt_cost").val(eqpt_cost);
// $("#total_discount").val(total_discount);
// $("#span_sub_total_0").text(total_discount);
// // $("#span_sub_total_invoice").text(stotal_cost);
// // $("#item_total").val(subtotal.toFixed(2));
// $("#item_total").val(priceqty2.toFixed(2));

// var s_total = subtotal.toFixed(2);
// var adjustment = $("#adjustment_input").val();
// var grand_total = s_total - parseFloat(adjustment);
// var markup = $("#markup_input_form").val();
// var grand_total_w = grand_total + parseFloat(markup);

// // $("#total_tax_").text(subtotaltax.toFixed(2));
// // $("#total_tax_").val(subtotaltax.toFixed(2));




// $("#grand_total").text(grand_total_w.toFixed(2));
// $("#grand_total_input").val(grand_total_w.toFixed(2));
// $("#grand_total_inputs").val(grand_total_w.toFixed(2));

// var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
// sls = parseFloat(sls).toFixed(2);
// $("#sales_tax").val(sls);
// cal_total_due();
});
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
  $( function() {
    $( "#datepicker_dateissued" ).datepicker({
        format: 'mm/dd/yyyy'
    });
  } );
</script>
<script>
$('#ssn').keyup(function() {
  var foo = $(this).val().split("-").join(""); // remove hyphens
  if (foo.length > 0) {
    foo = foo.match(new RegExp('.{1,4}', 'g')).join("-");
  }
  $(this).val(foo);
});

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
$('#spouse_contact_ssn').keyup(function() {
  var foo = $(this).val().split("-").join(""); // remove hyphens
  if (foo.length > 0) {
    foo = foo.match(new RegExp('.{1,4}', 'g')).join("-");
  }
  $(this).val(foo);
});
</script>