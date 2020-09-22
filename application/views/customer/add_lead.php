<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>

<style>
    .module_ac {
        background: #f2f2f2;
        border-radius: 1px;
        padding-right: 15px;
        padding-left: 15px;
        padding-bottom: 10px;
        border: 1px solid #32243d !important;
        margin-bottom: 20px;
        flex-flow: wrap;
        flex: 0 0 100%;
        max-width: 100%;
    }
    .module_header{
        /** background-color: #5f0a87;
      background-image: linear-gradient(326deg, #862987 0%, #5f0a87 74%); */
        background-color: #32243d;
        color : #fff;
        text-align: center;
        font-size: 11px;
        max-height: 20px;
        max-width: 100%;
        margin-bottom: 3px;
    }
    .module_title{
        padding-top: 1px;
    }

    .form-control {
        font-size: 12px;
        height: 35px !important;
        line-height: 150%;
    }
    label{
        font-size: 12px !important;
        margin-bottom: 1px !important;
    }
    hr{
        border: 2px solid #32243d !important;
        width: 100%;
    }
    .form-group {
        margin-bottom: 3px !important;
    }
    .banking-tab-container {
        border-bottom: 1px solid grey;
        padding-left: 0;
    }
    .add_data{
        color : #55b94c;
    }
    .btn {
        font-size: 12px !important;
        background-repeat: no-repeat;
        padding: 6px 12px;
    }
    .input_select{
        color: #363636;
        border: 2px solid #e0e0e0;
        box-shadow: none;
        display: inline-block !important;
        width: 100%;
        background-color: #fff;
        background-clip: padding-box;
        font-size: 11px !important;
    }
    .form-control  {
        font-size: 11px !important;
        height: 20px !important;
        line-height: 5%;
    }
    .form-line {
        padding-bottom: 1px;
    }
    .required_field{
        color : red;
    }

</style>

<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/customer'); ?>


    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="float-right">
                            <div class="dropdown">
                                <a href="<?php echo base_url('customer/leads') ?>" class="btn btn-primary"
                                   aria-expanded="false">
                                    <i class="mdi mdi-settings mr-2"></i> Lead Lists
                                </a>
                            </div>
                        </div>
                        <h3 >New Lead</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Add new lead.</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <?php //echo form_open_multipart('customer/save', ['class' => 'form-validate require-validation', 'id' => 'customer_form', 'autocomplete' => 'off']); ?>
            <div class="row custom__border">
                <div class="col-md-12">
                        <form method="post">
                                <div class="col-md-12">
                                    <div class="row">
                                        <table cellpadding="0" cellspacing="0" width="500" style="border-collapse: collapse;">
                                            <tbody>
                                                <tr>
                                                    <td align="" valign="top">
                                                        <table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:-21px !important;padding-right:-41px !important;">
                                                            <div class="module_ac">
                                                                <div class="row">
                                                                    <div class="col-md-12 module_header">
                                                                        <p class="module_title">General Information</p>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group" id="customer_type_group">
                                                                            <label for="">Lead Type <span class="required_field">*</span></label>
                                                                            <a href="<?php echo url('customer/index/tab1') ?>" class=""><span class="fa fa-plus"></span></a><br/>
                                                                            <select id="fk_lead_id" name="fk_lead_id"  class="input_select" required>
                                                                                <?php foreach ($lead_types as $lt): ?>
                                                                                    <option <?php if(isset($leads_data)){ if($leads_data->fk_lead_id == $lt->lead_id){ echo 'selected'; } } ?> value="<?= $lt->lead_id; ?>"><?= $lt->lead_name; ?></option>
                                                                                <?php endforeach ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group" id="customer_type_group">
                                                                            <label for="">Sales Area <span class="required_field">*</span></label><br/>
                                                                            <select id="fk_sa_id" name="fk_sa_id"  class="input_select" required>
                                                                                <option value="">Select</option>
                                                                                <?php foreach ($sales_area as $sa): ?>
                                                                                    <option <?php if(isset($leads_data)){ if($leads_data->fk_sa_id == $sa->sa_id){ echo 'selected'; } } ?> value="<?= $sa->sa_id; ?>"><?= $sa->sa_name; ?></option>
                                                                                <?php endforeach ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group" id="customer_type_group">
                                                                            <label for="">Sales Rep <span class="required_field">*</span></label><br/>
                                                                            <select id="fk_sr_id" name="fk_sr_id"  class="input_select" required>
                                                                                <option value="">Select</option>
                                                                                <?php foreach ($users as $user): ?>
                                                                                    <option <?php if(isset($leads_data)){ if($leads_data->fk_sr_id == $sa->sa_id){ echo 'selected'; } } ?> value="<?= $sa->sa_id; ?>" value="<?= $user->id; ?>"><?= $user->FName.' '.$user->LName; ?></option>
                                                                                <?php endforeach ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                        </table>


                                                        <table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:-21px !important;padding-right:-41px !important;">
                                                            <div class=" module_ac">
                                                                <div class="row">
                                                                    <div class="col-md-12 module_header">
                                                                        <p class="module_title">Contact Information</p>
                                                                    </div>
                                                                    <br><br>
                                                                    <div class="col-md-12 form-line">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <label for="">First Name <span class="required_field">*</span></label>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <input type="text" class="form-control" name="firstname" id="firstname" value="<?php if(isset($leads_data)){ echo $leads_data->firstname; } ?>"  required/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 form-line">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <label for="">Middle Initial <span class="required_field">*</span></label>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <input type="text" class="form-control" maxlength="1" name="middle_initial" id="middle_initial" value="<?php if(isset($leads_data)){ echo $leads_data->middle_initial; } ?>" required/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 form-line">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <label for="">Last Name <span class="required_field">*</span></label>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <input type="text" class="form-control" name="lastname" id="lastname" value="<?php if(isset($leads_data)){ echo $leads_data->lastname; } ?>"  required/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 form-line">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <label for="">Name Suffix</label>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <select id="suffix" name="suffix"  class="input_select">
                                                                                    <?php
                                                                                    for ($suffix=0;$suffix<14;$suffix++){
                                                                                        ?>
                                                                                        <option <?php if(isset($leads_data)){ if($leads_data->suffix == suffix_name($suffix)){ echo 'selected'; } } ?> value="<?= suffix_name($suffix); ?>"><?= suffix_name($suffix); ?></option>
                                                                                        <?php
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 form-line">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <label for="">Street Number</label>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <input type="text" class="form-control" name="st_number" id="st_number" value="<?php if(isset($leads_data)){ echo $leads_data->st_number; } ?>"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 form-line">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <label for="">Street Direction</label>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <select id="st_direction" name="st_direction" class="input_select">
                                                                                    <option <?php if(isset($leads_data)){ if($leads_data->st_direction == ''){ echo 'selected'; }} ?> value="">Select</option>
                                                                                    <option <?php if(isset($leads_data)){ if($leads_data->st_direction == 'North'){ echo 'selected'; }} ?> value="North">North</option>
                                                                                    <option <?php if(isset($leads_data)){ if($leads_data->st_direction == 'East'){ echo 'selected'; }} ?> value="East">East</option>
                                                                                    <option <?php if(isset($leads_data)){ if($leads_data->st_direction == 'South'){ echo 'selected'; }} ?> value="South">South</option>
                                                                                    <option <?php if(isset($leads_data)){ if($leads_data->st_direction == 'West'){ echo 'selected'; }} ?> value="West">West</option>
                                                                                    <option <?php if(isset($leads_data)){ if($leads_data->st_direction == 'North East'){ echo 'selected'; }} ?> value="North East">North East</option>
                                                                                    <option <?php if(isset($leads_data)){ if($leads_data->st_direction == 'South East'){ echo 'selected'; }} ?> value="South East">South East</option>
                                                                                    <option <?php if(isset($leads_data)){ if($leads_data->st_direction == 'North West'){ echo 'selected'; }} ?> value="North West">North West</option>
                                                                                    <option <?php if(isset($leads_data)){ if($leads_data->st_direction == 'South West'){ echo 'selected'; }} ?> value="South West">South West</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 form-line">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <label for="">Street Name</label>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <input type="text" class="form-control" name="st_name" id="st_name" value="<?php if(isset($leads_data)){ echo $leads_data->st_name; } ?>"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 form-line">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <label for="">Street Type</label>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <select id="st_type" name="st_type" data-customer-source="dropdown" class="input_select">
                                                                                    <option value="">Select</option>
                                                                                    <option value="ALLEY">ALLEY</option>
                                                                                    <option value="ARCH">ARCH</option>
                                                                                    <option value="BOULEVARD">BOULEVARD</option>
                                                                                    <option value="BUILDING">BUILDING</option>
                                                                                    <option value="CENTER">CENTER</option>
                                                                                    <option value="CIRCLE">CIRCLE</option>
                                                                                    <option value="CLOSE">CLOSE</option>
                                                                                    <option value="COURT">COURT</option>
                                                                                    <option value="COVE">COVE</option>
                                                                                    <option value="CRESCENT">CRESCENT</option>
                                                                                    <option value="DALE">DALE</option>
                                                                                    <option value="DRIVE">DRIVE</option>
                                                                                    <option value="DRIVE">DRIVE</option>
                                                                                    <option value="EXPRESSWAY">EXPRESSWAY</option>
                                                                                    <option value="FREEWAY">FREEWAY</option>
                                                                                    <option value="GARDEN">GARDEN</option>
                                                                                    <option value="GROVE">GROVE</option>
                                                                                    <option value="HEIGHTS">HEIGHTS</option>
                                                                                    <option value="HIGHWAY">HIGHWAY</option>
                                                                                    <option value="HILL">HILL</option>
                                                                                    <option value="KNOLL">KNOLL</option>
                                                                                    <option value="LANE">LANE</option>
                                                                                    <option value="LOOP">LOOP</option>
                                                                                    <option value="MALL">MALL</option>
                                                                                    <option value="OVAL">OVAL</option>
                                                                                    <option value="PARK">PARK</option>
                                                                                    <option value="PARKWAY">PARKWAY</option>
                                                                                    <option value="PATH">PATH</option>
                                                                                    <option value="PIKE">PIKE</option>
                                                                                    <option value="PLACE">PLACE</option>
                                                                                    <option value="PLAZA">PLAZA</option>
                                                                                    <option value="POINT">POINT</option>
                                                                                    <option value="RISE">RISE</option>
                                                                                    <option value="ROAD">ROAD</option>
                                                                                    <option value="ROUTE">ROUTE</option>
                                                                                    <option value="ROW">ROW</option>
                                                                                    <option value="RUN">RUN</option>
                                                                                    <option value="RURAL ROUTE">RURAL ROUTE</option>
                                                                                    <option value="SQUARE">SQUARE</option>
                                                                                    <option value="STREET">STREET</option>
                                                                                    <option value="TERRACE">TERRACE</option>
                                                                                    <option value="THRUWAY">THRUWAY</option>
                                                                                    <option value="TRAIL">TRAIL</option>
                                                                                    <option value="TURNPIKE">TURNPIKE</option>
                                                                                    <option value="VIADUCT">VIADUCT</option>
                                                                                    <option value="VIEW">VIEW</option>
                                                                                    <option value="WALK">WALK</option>
                                                                                    <option value="WAY">WAY</option>
                                                                                    <option value="WYND">WYND</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 form-line">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <label for="">Apt/Ste/Space#</label>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <input type="text" class="form-control" name="apt_ste_space" id="apt_ste_space" value="<?php if(isset($leads_data)){ echo $leads_data->apt_ste_space; } ?>"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 form-line">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <label for="">Condo Name</label>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <input type="text" class="form-control" name="condo_name" id="condo_name" value="<?php if(isset($leads_data)){ echo $leads_data->condo_name; } ?>"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 form-line">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <label for="">ZIP State City</label>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <div class="row">
                                                                                    <div class="col-md-3">
                                                                                        <input type="text" class="form-control" name="zip" id="zip" value="<?php if(isset($leads_data)){ echo $leads_data->zip; } ?>" />
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <input type="text" class="form-control" name="state" id="state" value="<?php if(isset($leads_data)){ echo $leads_data->state; } ?>" />
                                                                                    </div>
                                                                                    <div class="col-md-5">
                                                                                        <input type="text" class="form-control" name="city" id="city" value="<?php if(isset($leads_data)){ echo $leads_data->city; } ?>" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 form-line">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <label for="">County</label>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <input type="text" class="form-control" name="county" id="county" value="<?php if(isset($leads_data)){ echo $leads_data->county; } ?>"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 form-line">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <label for="">Country</label>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <select id="country" name="country" class="input_select">
                                                                                    <option <?php if(isset($leads_data)){ if($leads_data->country == 'USA'){ echo 'selected'; }} ?> value="USA">USA</option>
                                                                                    <option <?php if(isset($leads_data)){ if($leads_data->country == 'CANADA'){ echo 'selected'; }} ?> value="CANADA">CANADA</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 form-line">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <label for="">Home/Panel Phone</label>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <div class="row">
                                                                                    <?php
                                                                                        if(isset($leads_data)){
                                                                                            $phone = explode("-", $leads_data->phone_home);
                                                                                        }
                                                                                    ?>
                                                                                    <div class="col-md-4">
                                                                                        <input type="tel" class="form-control" name="phone_home[]" id="phone_home" value="<?php if(isset($phone) && count($phone)>0){ echo $phone[0]; } ?>"/>
                                                                                    </div>-
                                                                                    <div class="col-md-3">
                                                                                        <input type="tel" class="form-control" name="phone_home[]" id="phone_home" value="<?php if(isset($phone) && count($phone)>1){ echo $phone[1]; } ?>"/>
                                                                                    </div>-
                                                                                    <div class="col-md-4">
                                                                                        <input type="tel" class="form-control" name="phone_home[]" id="phone_home" value="<?php if(isset($phone) && count($phone)>2){ echo $phone[2]; } ?>"/>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 form-line">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <label for="">Cell Phone</label>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <div class="row">
                                                                                    <?php
                                                                                    if(isset($leads_data)){
                                                                                        $cell = explode("-", $leads_data->phone_cell);
                                                                                    }
                                                                                    ?>
                                                                                    <div class="col-md-4">
                                                                                        <input type="tel" class="form-control" name="phone_cell[]" id="phone_home" value="<?php if(isset($cell) && count($cell)>0){ echo $cell[0]; } ?>"/>
                                                                                    </div>-
                                                                                    <div class="col-md-3">
                                                                                        <input type="tel" class="form-control" name="phone_cell[]" id="phone_home" value="<?php if(isset($cell) && count($cell)>1){ echo $cell[1]; } ?>"/>
                                                                                    </div>-
                                                                                    <div class="col-md-4">
                                                                                        <input type="tel" class="form-control" name="phone_cell[]" id="phone_home" value="<?php if(isset($cell) && count($cell)>2){ echo $cell[2]; } ?>"/>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 form-line">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <label for="">Email Address</label>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <input type="email" class="form-control" name="email_add" id="email_add" value="<?php if(isset($leads_data)){ echo $leads_data->email_add; } ?>" required/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 form-line">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <label for="">Social Security Number</label>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <div class="row">
                                                                                    <?php
                                                                                    if(isset($leads_data)){
                                                                                        $ssn = explode("-", $leads_data->phone_cell);
                                                                                    }
                                                                                    ?>
                                                                                    <div class="col-md-4">
                                                                                        <input type="tel" maxlength="3" class="form-control" name="sss_num[]" id="sss_num" value="<?php if(isset($ssn) && count($ssn)>0){ echo $ssn[0]; } ?>"/>
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <input type="tel" maxlength="2" class="form-control" name="sss_num[]" id="sss_num" value="<?php if(isset($ssn) && count($ssn)>1){ echo $ssn[1]; } ?>"/>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <input type="tel" maxlength="3"  class="form-control" name="sss_num[]" id="sss_num" value="<?php if(isset($ssn) && count($ssn)>2){ echo $ssn[2]; } ?>"/>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 form-line">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <label for="">Date of Birth</label>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <input type="text" class="form-control" name="date_of_birth" id="date_of_birth" value="<?php if(isset($leads_data)){ echo $leads_data->date_of_birth; } ?>"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </table>

                                                        <table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:-21px !important;padding-right:-41px !important;">
                                                            <div class="module_ac">
                                                                <div class="row">
                                                                    <div class="col-md-12 module_header">
                                                                        <p class="module_title">New Credit Report</p>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group" id="customer_type_group">
                                                                                    <label for=""></label><br/>
                                                                                    <select id="credit_report" name="credit_report"  class="input_select" >
                                                                                        <option value="TrunsUnion">TrunsUnion</option>
                                                                                        <option value="Experian">Experian </option>
                                                                                        <option value="Equifax ">Equifax  </option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12"><br>
                                                                                <div class="form-group" id="customer_type_group">
                                                                                    <label for=""></label>
                                                                                    <button type="submit" class="btn btn-flat btn-primary"><span class="fa fa-play"></span> Run Credit</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </table>

                                                        <table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:-21px !important;padding-right:-41px !important;">
                                                            <div class="module_ac">
                                                                <div class="row">
                                                                    <div class="col-md-12 module_header">
                                                                        <p class="module_title">Report History</p>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group" id="customer_type_group">
                                                                                    <label for=""></label><br/>
                                                                                    <input value="No History" type="text" class="form-control" name="report_history" disabled id="report_history"/>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12"><br>
                                                                                <div class="form-group" id="customer_type_group">
                                                                                    <label for=""></label>
                                                                                    <button type="submit" name="convert_customer" class="btn btn-primary" <?php if(!isset($leads_data)){ echo 'disabled'; } ?>><span class="fa fa-exchange"></span>  Convert to Customer </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <br>
                                        <?php
                                            if(isset($leads_data)){
                                                ?>
                                                    <input value="<?=  $leads_data->leads_id; ?>" type="hidden" class="form-control" name="leads_id" />
                                                <?php

                                            }
                                            ?>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-flat btn-primary"><span class="fa fa-paper-plane-o"></span> Save</button>
                                            <a href="<?php echo base_url('customer/leads'); ?>"><button type="button" class="btn btn-flat btn-primary"><span class="fa fa-remove"></span> Cancel</button></a>
                                        </div>
                                </div>
                            </form>

                </div>
                <!-- end card -->
            </div>
        </div>

        <style>

        </style>
        <?php echo form_close(); ?>
    </div>
    <!-- end container-fluid -->
</div>

<?php include viewPath('includes/footer'); ?>
<script>
    $("#date_of_birth").datetimepicker({
        format: "L",
        //minDate: new Date(),
    });
</script>

<style>
    .btn-primary.disabled, .btn-primary:disabled {
        color: #000 !important;
        background-color: #ccc !important;
        border-color: #ccc !important;
    }
</style>