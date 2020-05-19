<?php
defined('BASEPATH') or exit('No direct script access allowed');
$states = array(
    'AK' => 'Alaska',
    'AL' => 'Alabama',
    'AR' => 'Arkansas',
    'AZ' => 'Arizona',
    'CA' => 'California',
    'CO' => 'Colorado',
    'CT' => 'Connecticut',
    'DC' => 'District of Columbia',
    'DE' => 'Delaware',
    'FL' => 'Florida',
    'GA' => 'Georgia',
    'HI' => 'Hawaii',
    'IA' => 'Iowa',
    'ID' => 'Idaho',
    'IL' => 'Illinois',
    'IN' => 'Indiana',
    'KS' => 'Kansas',
    'KY' => 'Kentucky',
    'LA' => 'Louisiana',
    'MA' => 'Massachusetts',
    'MD' => 'Maryland',
    'ME' => 'Maine',
    'MI' => 'Michigan',
    'MN' => 'Minnesota',
    'MO' => 'Missouri',
    'MS' => 'Mississippi',
    'MT' => 'Montana',
    'NC' => 'North Carolina',
    'ND' => 'North Dakota',
    'NE' => 'Nebraska',
    'NH' => 'New Hampshire',
    'NJ' => 'New Jersey',
    'NM' => 'New Mexico',
    'NV' => 'Nevada',
    'NY' => 'New York',
    'OH' => 'Ohio',
    'OK' => 'Oklahoma',
    'OR' => 'Oregon',
    'PA' => 'Pennsylvania',
    'RI' => 'Rhode Island',
    'SC' => 'South Carolina',
    'SD' => 'South Dakota',
    'TN' => 'Tennessee',
    'TX' => 'Texas',
    'UT' => 'Utah',
    'VA' => 'Virginia',
    'VT' => 'Vermont',
    'WA' => 'Washington',
    'WI' => 'Wisconsin',
    'WV' => 'West Virginia',
    'WY' => 'Wyoming'
);
?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="page-title">Workorder Details</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Edit workorder details</li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <div class="float-right d-none d-md-block">
                        <div class="dropdown">
                            <?php if (hasPermissions('WORKORDER_MASTER')) : ?>
                                <a href="<?php echo url('workorder') ?>" class="btn btn-primary" aria-expanded="false">
                                    <i class="mdi mdi-settings mr-2"></i> Go Back to Workorders
                                </a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
        <?php echo form_open_multipart('workcalender/update/' . $workorder->id, ['class' => 'form-validate', 'id' => 'workcalender_form', 'autocomplete' => 'off']); ?>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title mb-5">ALARM SYSTEM WORKORDER AGREEMENT</h4>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <p>1. This Alarm System Work Order Agreement (the “Agreement”) is made as of the <b><?php echo date('M-d-Y', strtotime($workorder->created_at)); ?></b> , by and between
                                    ADI, (the “Company”) and the (“Customer”) as the address shown below (the “Premises / Monitored location”)
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="contact_name">WorkOrder Number</label>
                                <input type="text" class="form-control" name="" id="contact_name" required placeholder="Enter Name" value="W0-00<?php echo ($workorder->contact_name) ? $workorder->id : ''; ?>" readonly />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="contact_name">Contact Name</label>
                                <input type="text" class="form-control" name="contact_name" id="contact_name" required placeholder="Enter Name" autofocus value="<?php echo ($workorder->contact_name) ? $workorder->contact_name : ''; ?>" />
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="contact_pwd">Password</label>
                                <input type="text" class="form-control" name="contact_pwd" id="contact_pwd" placeholder="Enter (4 to 10 Letters password)" required value="<?php echo ($workorder->contact_pwd) ? $workorder->contact_pwd : ''; ?>" />
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="contact_ssn">SSN</label>
                                <input type="text" class="form-control" name="contact_ssn" id="contact_ssn" required placeholder="Enter SSN" value="<?php echo ($workorder->contact_ssn) ? $workorder->contact_ssn : ''; ?>" />
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="contact_dob">DOB</label>
                                <input type="text" class="form-control" name="contact_dob" id="contact_dob" placeholder="Enter DOB" value="<?php echo ($workorder->contact_dob) ? date('m/d/Y', strtotime($workorder->contact_dob)) : ''; ?>" />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="contact_mobile">Mobile</label>
                                <input type="text" class="form-control" name="contact_mobile" id="contact_mobile" placeholder="Enter Mobile" required value="<?php echo ($workorder->contact_mobile) ? $workorder->contact_mobile : ''; ?>" />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="contact_phone">Phone</label>
                                <input type="text" class="form-control" name="contact_phone" id="contact_phone" placeholder="Enter Phone" value="<?php echo ($workorder->contact_phone) ? $workorder->contact_phone : ''; ?>" />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="contact_email">Contact Email</label>
                                <input type="email" class="form-control" name="contact_email" id="contact_email" placeholder="Enter Email" required value="<?php echo ($workorder->contact_email) ? $workorder->contact_email : ''; ?>" />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="workorder_date">Workorder Date</label>
                                <input type="text" class="form-control" name="workorder_date" id="workorder_date" value="<?php echo ($workorder->workorder_date) ? date('m/d/Y', strtotime($workorder->workorder_date)) : ''; ?>" required />
                            </div>
                            <div class="form-group col-md-12">
                                <label for="workorder_status">Status</label>
                            </div>
                            <div class="form-group col-md-12">
                                <?php if (count($workstatus) > 0) { ?>
                                    <?php foreach ($workstatus as $ws) { ?>
                                        <div class="checkbox checkbox-sec margin-right my-0 mr-3">
                                            <input type="radio" name="workorder_status" value="<?= $ws->id; ?>" id="ws<?= $ws->id; ?>" <?php echo ($workorder->workorder_status == $ws->id) ? 'checked' : ''; ?>>
                                            <label for="ws<?= $ws->id; ?>">
                                                <div style="width:25px;height:25px;background:<?php echo $ws->color ?>"></div><span><?= $ws->title; ?></span>
                                            </label>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="">Customer Type</label><br />
                                <label class="radio-inline">
                                    <input type="radio" name="customer_type" value="Residential" <?php echo ($workorder->customer_type == 'Residential') ? 'checked' : ''; ?>>Residential
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="customer_type" value="Commercial" <?php echo ($workorder->customer_type == 'Commercial') ? 'checked' : ''; ?>>Commercial
                                </label>
                            </div>
                        </div>
                        <?php if ($workorder->plan_type != '') {

                            $plan_type = explode(',', $workorder->plan_type);
                        } else {

                            $plan_type = [];
                        } ?>
                        <div class="row">
                            <div class="col-md-1 form-group">
                                <label for="street_address"> Plan Type:</label>
                            </div>
                            <div class="col-md-11 form-group">
                                <?php if (is_array($plans) && count($plans) > 0) { ?>
                                    <?php foreach ($plans as $pn) { ?>
                                        <div class="checkbox checkbox-sec margin-right mr-4">
                                            <input <?php echo in_array('Phone Line', $plan_type) ? 'checked' : ''; ?> type="radio" name="plan_type" value="<?= $pn->id; ?>" id="radio_credit_card<?= $pn->id; ?>">
                                            <label for="radio_credit_card<?= $pn->id; ?>"><span><?= $pn->plan_name; ?></span></label>
                                        </div>
                                    <?php } ?>
                                <?php } ?>

                            </div>
                        </div>

                        <?php if ($workorder->notify_by != '') {

                            $notify_by = explode(',', $workorder->notify_by);
                        } else {

                            $notify_by = [];
                        } ?>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="notify_by[]" value="Email" <?php echo in_array('Email', $notify_by) ? 'checked' : ''; ?>>Notify By Email
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="notify_by[]" value="SMS" <?php echo in_array('SMS', $notify_by) ? 'checked' : ''; ?>>Notify By SMS/Text
                                </label>
                            </div>
                        </div>

                        <?php if ($workorder->assign_to != '') {

                            $assign_to = explode(',', $workorder->assign_to);
                        } else {

                            $assign_to = [];
                        } ?>

                        <?php if (count($users) > 0) { ?>
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Assign To (optional)</h3>
                                </div>
                                <div class="box-body">
                                    <?php foreach ($users as $row) { ?>

                                        <label class="checkbox-inline">
                                            <input type="checkbox" value="<?php echo $row->id; ?>" name="assign_to[]" value="<?php echo $row->id; ?>" <?php echo (in_array($row->id, $assign_to)) ? 'checked' : ''; ?>><?php echo ucfirst($row->name); ?>
                                        </label>
                                    <?php } ?>

                                </div>
                            </div>
                        <?php } ?>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="street_address">Monitored Location</label>
                                <input type="text" class="form-control" name="street_address" id="street_address" placeholder="Enter Address" value="<?php echo ($workorder->street_address) ? $workorder->street_address : ''; ?>" />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="suit">Cross street</label>
                                <input type="text" class="form-control" name="suit" id="suit" placeholder="Enter Suit/Unit" value="<?php echo ($workorder->suit) ? $workorder->suit : ''; ?>" />
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" name="city" id="city" placeholder="Enter City" value="<?php echo ($workorder->city) ? $workorder->city : ''; ?>" />
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="zip">Zip/Postal Code</label>
                                <input type="text" class="form-control" name="zip" id="zip" placeholder="Enter Zip/Postal Code" value="<?php echo ($workorder->zip) ? $workorder->zip : ''; ?>" />
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="state">State/Province</label>
                                <select name="state" id="state" class="form-control">
                                    <option value="">Select</option>
                                    <?php foreach ($states as $key => $val) { ?>
                                        <option value="<?php echo $key ?>" <?php echo ($workorder->state == $key) ? 'selected' : ''; ?>><?php echo $val; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <?php if ($workorder->premises_chk != '') {

                            $premises_chk = explode(',', $workorder->premises_chk);
                        } else {

                            $premises_chk = [];
                        } ?>
                        <div class="row">
                            <h4 style="width:100%">Call List:-</h4>
                            <div class="col-md-3 form-group">
                                <label for="premises">Premises</label>
                                <input type="text" class="form-control" name="premises" id="premises" placeholder="" value="<?php echo ($workorder->premises) ? $workorder->premises : ''; ?>" />
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="premises_chk[]" value="Cell" <?php echo in_array('Cell', $premises_chk) ? 'checked' : ''; ?>>Cell
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="premises_chk[]" value="Landline" <?php echo in_array('Landline', $premises_chk) ? 'checked' : ''; ?>>Landline
                                </label>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="company_phone">Premises Verification Name</label>
                                <input type="text" class="form-control" name="company_phone" id="company_phone" value="<?php echo ($workorder->company_phone) ? $workorder->company_phone : ''; ?>" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="verification_name">2nd Call Verification Name</label>
                                <input type="text" class="form-control" name="verification_name" id="verification_name" placeholder="" value="<?php echo ($workorder->verification_name) ? $workorder->verification_name : ''; ?>" />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="verification_phone">Phone</label>
                                <input type="text" class="form-control" name="verification_phone" id="verification_phone" placeholder="" value="<?php echo ($workorder->verification_phone) ? $workorder->verification_phone : ''; ?>" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="emrg_contact_1">Emergency Contact Name</label>
                                <input type="text" class="form-control" name="emrg_contact_1" id="emrg_contact_1" placeholder="" value="<?php echo ($workorder->emrg_contact_1) ? $workorder->emrg_contact_1 : ''; ?>" />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="emrg_contact_phone_1">Phone</label>
                                <input type="text" class="form-control" name="emrg_contact_phone_1" id="emrg_contact_phone_1" placeholder="" value="<?php echo ($workorder->emrg_contact_phone_1) ? $workorder->emrg_contact_phone_1 : ''; ?>" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="emrg_contact_2">Emergency Contact Name:</label>
                                <input type="text" class="form-control" name="emrg_contact_2" id="emrg_contact_2" placeholder="" value="<?php echo ($workorder->emrg_contact_2) ? $workorder->emrg_contact_2 : ''; ?>" />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="emrg_contact_phone_2">Phone</label>
                                <input type="text" class="form-control" name="emrg_contact_phone_2" id="emrg_contact_phone_2" placeholder="" value="<?php echo ($workorder->emrg_contact_phone_2) ? $workorder->emrg_contact_phone_2 : ''; ?>" />
                            </div>
                        </div>

                        <?php if ($workorder->chk_emerg_email != '') {

                            $chk_emerg_email = explode(',', $workorder->chk_emerg_email);
                        } else {

                            $chk_emerg_email = [];
                        } ?>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="emrg_contact_email"> Email Address:</label>
                                <input type="text" class="form-control" name="emrg_contact_email" id="emrg_contact_email" placeholder="" value="<?php echo ($workorder->emrg_contact_email) ? $workorder->emrg_contact_email : ''; ?>" />
                            </div>
                            <div class="col-md-9 form-group">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_emerg_email[]" value="No Email" <?php echo in_array('No Email', $chk_emerg_email) ? 'checked' : ''; ?>>No Email Renew
                                </label>
                                <label class="checkbox-inline">LEAD SOURCE: </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_emerg_email[]" value="OFC" <?php echo in_array('OFC', $chk_emerg_email) ? 'checked' : ''; ?>>OFC
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_emerg_email[]" value="SELF" <?php echo in_array('SELF', $chk_emerg_email) ? 'checked' : ''; ?>>SELF
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_emerg_email[]" value="DISCONNECT" <?php echo in_array('DISCONNECT', $chk_emerg_email) ? 'checked' : ''; ?>>DISCONNECT
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_emerg_email[]" value="RENEWAL" <?php echo in_array('RENEWAL', $chk_emerg_email) ? 'checked' : ''; ?>>RENEWAL
                                </label>
                            </div>
                        </div>
                        <?php if ($workorder->chk_emerg_location != '') {

                            $chk_emerg_location = explode(',', $workorder->chk_emerg_location);
                        } else {

                            $chk_emerg_location = [];
                        } ?>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="emerg_contact_location"> Panel Location:</label>
                                <input type="text" class="form-control" name="emerg_contact_location" id="emerg_contact_location" placeholder="" value="<?php echo ($workorder->emerg_contact_location) ? $workorder->emerg_contact_location : ''; ?>" />
                            </div>
                            <div class="col-md-9 form-group">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_emerg_location[]" value="L3000" <?php echo in_array('L3000', $chk_emerg_location) ? 'checked' : ''; ?>>L3000
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_emerg_location[]" value="L5100" <?php echo in_array('L5100', $chk_emerg_location) ? 'checked' : ''; ?>>L5100
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_emerg_location[]" value="LTOUCH" <?php echo in_array('LTOUCH', $chk_emerg_location) ? 'checked' : ''; ?>>LTOUCH
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_emerg_location[]" value="GO Panel v2" <?php echo in_array('GO Panel v2', $chk_emerg_location) ? 'checked' : ''; ?>>GO Panel v2
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_emerg_location[]" value="GO Panel v3" <?php echo in_array('GO Panel v3', $chk_emerg_location) ? 'checked' : ''; ?>>GO Panel v3
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_emerg_location[]" value="Vista/SEM" <?php echo in_array('Vista/SEM', $chk_emerg_location) ? 'checked' : ''; ?>>Vista/SEM
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_emerg_location[]" value="Vista/GSMX" <?php echo in_array('Vista/GSMX', $chk_emerg_location) ? 'checked' : ''; ?>>Vista/GSMX
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_emerg_location[]" value="Other" <?php echo in_array('Other', $chk_emerg_location) ? 'checked' : ''; ?>>Other
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_emerg_location[]" value="DSC" <?php echo in_array('DSC', $chk_emerg_location) ? 'checked' : ''; ?>>DSC
                                </label>
                            </div>
                        </div>



                        <?php if ($workorder->ip_cam != '') {

                            $ip_cam = explode(',', $workorder->ip_cam);
                        } else {

                            $ip_cam = [];
                        }

                        if ($workorder->chk_dvr != '') {

                            $chk_dvr = explode(',', $workorder->chk_dvr);
                        } else {

                            $chk_dvr = [];
                        }

                        if ($workorder->thermostat != '') {

                            $thermostat = explode(',', $workorder->thermostat);
                        } else {

                            $thermostat = [];
                        }

                        if ($workorder->doorbell_cam != '') {

                            $doorbell_cam = explode(',', $workorder->doorbell_cam);
                        } else {

                            $doorbell_cam = [];
                        }
                        ?>
                        <div class="row">
                            <div class="col-md-2 form-group">
                                <label for=""> IP CAM:</label>
                                <br /><input type="checkbox" name="ip_cam[]" value="Honeywell" <?php echo in_array('Honeywell', $ip_cam) ? 'checked' : ''; ?>>Honeywell WO WI
                                <br /><input type="checkbox" name="ip_cam[]" value="Alarm.com" <?php echo in_array('Alarm.com', $ip_cam) ? 'checked' : ''; ?>>Alarm.com WO WI
                            </div>
                            <div class="col-md-2 form-group">
                                <label for=""> DVR:</label>
                                <br /><input type="checkbox" name="chk_dvr[]" value="Honeywell/AVYCON" <?php echo in_array('Honeywell/AVYCON', $chk_dvr) ? 'checked' : ''; ?>>Honeywell/AVYCON
                                <br /><input type="checkbox" name="chk_dvr[]" value="Other" <?php echo in_array('Other', $chk_dvr) ? 'checked' : ''; ?>>Other
                            </div>
                            <div class="col-md-4 form-group">
                                <label for=""> Doorlocks:</label><br />
                                <table>
                                    <tr>
                                        <th></th>
                                        <th>Brass</th>
                                        <th>Nickal</th>
                                        <th>Bronze</th>
                                    </tr>
                                    <tr>
                                        <td>Deadbolt</td>

                                        <td><input type="text" class="form-control" name="deadbolt[]" placeholder="" /></td>
                                        <td><input type="text" class="form-control" name="deadbolt[]" placeholder="" /></td>
                                        <td><input type="text" class="form-control" name="deadbolt[]" placeholder="" /></td>

                                    </tr>
                                    <tr>
                                        <td>Handle</td>
                                        <td><input type="text" class="form-control" name="handle[]" placeholder="" /></td>
                                        <td><input type="text" class="form-control" name="handle[]" placeholder="" /></td>
                                        <td><input type="text" class="form-control" name="handle[]" placeholder="" /></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-2 form-group">
                                <label for=""> Thermostat:</label>
                                <br /><input type="checkbox" name="thermostat[]" value="Honeywell" <?php echo in_array('Honeywell', $thermostat) ? 'checked' : ''; ?>>Honeywell
                                <br /><input type="checkbox" name="thermostat[]" value="Alarm.com" <?php echo in_array('Alarm.com', $thermostat) ? 'checked' : ''; ?>>Alarm.com
                            </div>
                            <div class="col-md-2 form-group">
                                <label for=""> Doorbell CAM:</label>
                                <br /><input type="checkbox" name="doorbell_cam[]" value="Honeywell" <?php echo in_array('Honeywell', $doorbell_cam) ? 'checked' : ''; ?>>Honeywell
                                <br /><input type="checkbox" name="doorbell_cam[]" value="Alarm.com" <?php echo in_array('Alarm.com', $doorbell_cam) ? 'checked' : ''; ?>>Alarm.com
                            </div>
                        </div>
                        <?php
                        if ($workorder->inst_time != '') {

                            $inst_time = explode(',', $workorder->inst_time);
                        } else {

                            $inst_time = [];
                        }
                        ?>
                        <div class="row">
                            <div class=" col-md-4">
                                <label for="inst_date"> Installation Date:</label>
                                <input type="text" class="form-control" name="inst_date" id="inst_date" placeholder="" value="<?php echo ($workorder->inst_date) ? date('m/d/Y', strtotime($workorder->inst_date)) : ''; ?>" />
                                <br />
                                Install Time: <input type="checkbox" name="inst_time[]" value="8-10" <?php echo in_array('8-10', $inst_time) ? 'checked' : ''; ?>>8-10
                                <input type="checkbox" name="inst_time[]" value="10-12" <?php echo in_array('10-12', $inst_time) ? 'checked' : ''; ?>>10-12
                                <input type="checkbox" name="inst_time[]" value="12-2" <?php echo in_array('12-2', $inst_time) ? 'checked' : ''; ?>>12-2
                                <input type="checkbox" name="inst_time[]" value="2-4" <?php echo in_array('2-4', $inst_time) ? 'checked' : ''; ?>>2-4
                                <input type="checkbox" name="inst_time[]" value="4-6" <?php echo in_array('4-6', $inst_time) ? 'checked' : ''; ?>>4-6
                                <input type="checkbox" name="inst_time[]" value="Firm" <?php echo in_array('Firm', $inst_time) ? 'checked' : ''; ?>>Firm
                            </div>
                            <div class="col-md-6">
                                <label for="notes_to_tech"> Notes to Tech:</label>
                                <textarea name="notes_to_tech" id="notes_to_tech" rows="3" class="form-control"><?php echo ($workorder->notes_to_tech) ? $workorder->notes_to_tech : ''; ?></textarea>
                            </div>
                        </div>

                        <?php if ($workorder->workorder_items != '') {

                            $workorder_items = unserialize($workorder->workorder_items);
                        } else {

                            $workorder_items = [];
                        } ?>
                        <div class="row">
                            <div class=" col-md-9">
                                <div class="work_nore">
                                    <h6>Work Order Items</h6>
                                    <p> You can set up the products or services for this work order. </p>
                                    <p><strong class="red">Note: prices will not be shown to the assigned employees but only to you. </strong></p>
                                    <!-- <a href="" class="add_itemms_button">Add Items</a> -->
                                </div>
                            </div>
                            <!-- <div class="col-md-3">
                        <label>Show qty as:</label>
                        <select class="custom-select form-control">
                           <option>Quanity</option>
                        </select>
                     </div> -->
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-hover">

                                    <thead>
                                        <tr>
                                            <th>DESCRIPTION</th>
                                            <th>Type</th>
                                            <th width="100px">Quantity</th>
                                            <th>LOCATION</th>
                                            <th width="100px">COST</th>
                                            <th width="100px">Discount</th>
                                            <th>Tax(%)</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_body">

                                        <?php if (count($workorder_items) > 0) { ?>
                                            <input type="hidden" name="count" value="<?php echo count($workorder_items) > 0 ? count($workorder_items) - 1 : 0; ?>" id="count">
                                            <?php $i = 0;
                                            foreach ($workorder_items as $row) { ?>

                                                <tr>
                                                    <td>
                                                        <input type="text" class="form-control getItems" onKeyup="getItems(this)" name="item[]" value="<?php echo $row['item']; ?>">
                                                        <ul class="suggestions"></ul>
                                                    </td>
                                                    <td><select name="item_type[]" class="form-control">

                                                            <option value="material" <?php if ($row['item_type'] == 'material') echo 'selected'; ?>>Material</option>
                                                            <option value="product" <?php if ($row['item_type'] == 'product') echo 'selected'; ?>>Product</option>
                                                            <option value="service" <?php if ($row['item_type'] == 'service') echo 'selected'; ?>>Service</option>
                                                        </select></td>
                                                    <td>
                                                        <input type="text" class="form-control quantity" name="quantity[]" data-counter="<?php echo $i; ?>" id="quantity_<?php echo $i; ?>" value="<?php echo $row['quantity'] ?>">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="location[]" value="<?php echo $row['location'] ?>">
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control price" name="price[]" data-counter="<?php echo $i; ?>" id="price_<?php echo $i; ?>" min="0" value="<?php echo $row['price'] ?>">
                                                    </td>
                                                    <td>
                                                        <input type="number" value="<?php echo $row['discount'] ?>" class="form-control discount" name="discount[]" data-counter="<?php echo $i; ?>" id="discount_<?php echo $i; ?>" min="0" value="0" readonly>
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
                                                <td><input type="text" class="form-control getItems" onKeyup="getItems(this)" name="item[]">
                                                    <ul class="suggestions"></ul>
                                                </td>
                                                <td><select name="item_type[]" class="form-control">
                                                        <option value="service">Service</option>
                                                        <option value="material">Material</option>
                                                        <option value="product">Product</option>
                                                    </select></td>
                                                <td><input type="text" class="form-control quantity" name="quantity[]" data-counter="0" id="quantity_0" value="1"></td>
                                                <td><input type="text" class="form-control" name="location[]"></td>
                                                <td><input type="number" class="form-control price" name="price[]" data-counter="0" id="price_0" min="0" value="0"></td>
                                                <td><input type="number" class="form-control discount" name="discount[]" data-counter="0" id="discount_0" min="0" value="0" readonly></td>
                                                <td><span id="span_tax_0">0.00 (7.5%)</span></td>
                                                <td><span id="span_total_0">0.00</span></td>
                                            </tr>

                                        <?php  } ?>

                                    </tbody>
                                </table>
                                <a href="#" class="btn btn-primary" id="add_another">Add Items</a>
                            </div>
                        </div><br />

                        <?php
                        if ($workorder->workorder_eqpt_cost != '') {

                            $workorder_eqpt_cost = unserialize($workorder->workorder_eqpt_cost);
                        } else {

                            $workorder_eqpt_cost = [];
                        }
                        ?>
                        <div class="row">
                            <div class="col-md-4">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Equipment Cost</td>
                                        <td>$ <input type="text" value="<?php echo !empty($workorder_eqpt_cost) ? $workorder_eqpt_cost['eqpt_cost'] : 0.00; ?>" name="eqpt_cost" id="eqpt_cost" onfocusout="cal_total_due()"></td>
                                    </tr>
                                    <tr>
                                        <td>Sales Tax</td>
                                        <td>$ <input type="text" value="<?php echo !empty($workorder_eqpt_cost) ? $workorder_eqpt_cost['sales_tax'] : 0.00; ?>" name="sales_tax" id="sales_tax" onfocusout="cal_total_due()"></td>
                                    </tr>
                                    <tr>
                                        <td>Installation Cost</td>
                                        <td>$ <input type="text" value="<?php echo !empty($workorder_eqpt_cost) ? $workorder_eqpt_cost['inst_cost'] : 0.00; ?>" name="inst_cost" id="inst_cost" onfocusout="cal_total_due()"></td>
                                    </tr>
                                    <tr>
                                        <td>One time P/Dated <br />Program and Setup</td>
                                        <td>$ <input type="text" value="<?php echo !empty($workorder_eqpt_cost) ? $workorder_eqpt_cost['one_time'] : 0.00; ?>" name="one_time" id="one_time" onfocusout="cal_total_due()"></td>
                                    </tr>
                                    <tr>
                                        <td>Monthly Monitoring</td>
                                        <td>$ <input type="text" value="<?php echo !empty($workorder_eqpt_cost) ? $workorder_eqpt_cost['m_monitoring'] : 0.00; ?>" name="m_monitoring" id="m_monitoring" onfocusout="cal_total_due()"></td>
                                    </tr>
                                    <tr>
                                        <td>Total Due</td>
                                        <td>$ <span id="total_due"><?php echo !empty($workorder_eqpt_cost) ?  number_format($workorder_eqpt_cost['eqpt_cost'] + $workorder_eqpt_cost['sales_tax'] + $workorder_eqpt_cost['inst_cost'] + $workorder_eqpt_cost['one_time'] + $workorder_eqpt_cost['m_monitoring'], 2) : '0.00'; ?></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <?php
                        if ($workorder->chk_enhance_dvr != '') {

                            $chk_enhance_dvr = explode(',', $workorder->chk_enhance_dvr);
                        } else {

                            $chk_enhance_dvr = [];
                        }
                        ?>



                        <!-- ZONE INFORMATION START -->


                        <div class="row">
                            <div class="col-md-12">
                                <h2>Zone Informations</h2>
                                <table class="table table-hover">

                                    <thead>
                                        <tr>
                                            <th>EXISTING</th>
                                            <th>ZONE NUMBER</th>
                                            <th>REPEAT ISSUE</th>
                                            <th>LOCATION</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_body_zone">

                                        <?php if (!empty($workorder->zones) && count($workorder->zones) > 0) { ?>
                                            <!-- <input type="hidden" name="count" value="<?php echo count($workorder_items) > 0 ? count($workorder_items) - 1 : 0; ?>" id="count"> -->
                                            <?php $i = 0;
                                            foreach ($workorder->zones as $zone) { ?>

                                                <!-- <tr>
                                                    <td>
                                                        <input type="text" class="form-control getItems" onKeyup="getItems(this)" name="item[]" value="<?php echo $row['item']; ?>">
                                                        <ul class="suggestions"></ul>
                                                    </td>
                                                    <td><select name="item_type[]" class="form-control">

                                                            <option value="material" <?php if ($row['item_type'] == 'material') echo 'selected'; ?>>Material</option>
                                                            <option value="product" <?php if ($row['item_type'] == 'product') echo 'selected'; ?>>Product</option>
                                                            <option value="service" <?php if ($row['item_type'] == 'service') echo 'selected'; ?>>Service</option>
                                                        </select></td>
                                                    <td>
                                                        <input type="text" class="form-control quantity" name="quantity[]" data-counter="<?php echo $i; ?>" id="quantity_<?php echo $i; ?>" value="<?php echo $row['quantity'] ?>">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="location[]" value="<?php echo $row['location'] ?>">
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control price" name="price[]" data-counter="<?php echo $i; ?>" id="price_<?php echo $i; ?>" min="0" value="<?php echo $row['price'] ?>">
                                                    </td>
                                                    <td>
                                                        <input type="number" value="<?php echo $row['discount'] ?>" class="form-control discount" name="discount[]" data-counter="<?php echo $i; ?>" id="discount_<?php echo $i; ?>" min="0" value="0" readonly>
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
                                                </tr> -->

                                                <tr>
                                                    <td>
                                                        <select name="zone[existing][]" class="form-control">
                                                            <option value="0" <?php echo ($zone->existing == 0) ? 'selected' : '' ?>>No</option>
                                                            <option value="1" <?php echo ($zone->existing == 1) ? 'selected' : '' ?>>Yes</option>
                                                        </select>
                                                    </td>
                                                    <td><input type="text" class="form-control quantity" name="zone[zone_number][]" data-counter="0" id="zone_number" value="<?php echo $zone->zone_number ?>"></td>
                                                    <td>
                                                        <select name="zone[repeat_issue][]" class="form-control">
                                                            <option value="0" <?php echo ($zone->repeat_issue == 0) ? 'selected' : '' ?>>No</option>
                                                            <option value="1" <?php echo ($zone->repeat_issue == 1) ? 'selected' : '' ?>>Yes</option>
                                                        </select>
                                                    </td>
                                                    <td><input type="text" class="form-control" name="zone[location][]" value="<?php echo $zone->location ?>"></td>
                                                </tr>

                                            <?php $i++;
                                            } ?>

                                        <?php } else { ?>
                                            <input type="hidden" name="count" value="0" id="count">
                                            <tr>
                                                <td>
                                                    <select name="zone[existing][]" class="form-control">
                                                        <option value="0">No</option>
                                                        <option value="1">Yes</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" class="form-control quantity" name="zone[zone_number][]" data-counter="0" id="zone_number" value="1"></td>
                                                <td>
                                                    <select name="zone[repeat_issue][]" class="form-control">
                                                        <option value="0">No</option>
                                                        <option value="1">Yes</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" class="form-control" name="zone[location][]"></td>
                                            </tr>

                                        <?php  } ?>

                                    </tbody>
                                </table>
                                <button class="btn btn-primary" id="add_another_zone">Add Items</button>
                            </div>
                        </div><br />

                        <!-- ZONE INFORMATIOn END -->


                        <div class="row">
                            <div class="col-md-12 form-group">
                                <b>ENHANCED SERVICES:</b><br />
                                <b>DVR</b>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_enhance_dvr[]" value="2" <?php echo in_array('2', $chk_enhance_dvr) ? 'checked' : ''; ?>>2
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_enhance_dvr[]" value="3" <?php echo in_array('3', $chk_enhance_dvr) ? 'checked' : ''; ?>>3
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_enhance_dvr[]" value="4" <?php echo in_array('4', $chk_enhance_dvr) ? 'checked' : ''; ?>>4
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_enhance_dvr[]" value="5" <?php echo in_array('5', $chk_enhance_dvr) ? 'checked' : ''; ?>>5
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_enhance_dvr[]" value="6" <?php echo in_array('6', $chk_enhance_dvr) ? 'checked' : ''; ?>>6
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_enhance_dvr[]" value="7" <?php echo in_array('7', $chk_enhance_dvr) ? 'checked' : ''; ?>>7
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_enhance_dvr[]" value="8" <?php echo in_array('8', $chk_enhance_dvr) ? 'checked' : ''; ?>>8
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_enhance_dvr[]" value="9" <?php echo in_array('9', $chk_enhance_dvr) ? 'checked' : ''; ?>>9
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_enhance_dvr[]" value="10" <?php echo in_array('10', $chk_enhance_dvr) ? 'checked' : ''; ?>>10
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_enhance_dvr[]" value="11" <?php echo in_array('11', $chk_enhance_dvr) ? 'checked' : ''; ?>>11
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_enhance_dvr[]" value="12" <?php echo in_array('12', $chk_enhance_dvr) ? 'checked' : ''; ?>>12
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_enhance_dvr[]" value="13" <?php echo in_array('13', $chk_enhance_dvr) ? 'checked' : ''; ?>>13
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_enhance_dvr[]" value="14" <?php echo in_array('14', $chk_enhance_dvr) ? 'checked' : ''; ?>>14
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_enhance_dvr[]" value="15" <?php echo in_array('15', $chk_enhance_dvr) ? 'checked' : ''; ?>>15
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_enhance_dvr[]" value="16" <?php echo in_array('16', $chk_enhance_dvr) ? 'checked' : ''; ?>>16
                                </label>
                            </div>
                        </div>

                        <?php
                        if ($workorder->chk_enhance_pers != '') {

                            $chk_enhance_pers = explode(',', $workorder->chk_enhance_pers);
                        } else {

                            $chk_enhance_pers = [];
                        }
                        ?>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_enhance_pers[]" value="PERS" <?php echo in_array('PERS', $chk_enhance_pers) ? 'checked' : ''; ?>>PERS
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_enhance_pers[]" value="PERS w/Fall Detec" <?php echo in_array('PERS w/Fall Detec', $chk_enhance_pers) ? 'checked' : ''; ?>>PERS w/Fall Detec
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p>2. Install of the system. Company agrees to schedule and install an alarm system and/or
                                    devices in connection with a Monitoring Agreement which customer will receive
                                    at the time of installation. Customer hereby agrees to buy the system/devices described
                                    below and incorporated herein for all purposes by this reference (the “System /Services”),
                                    in accordance with the terms and conditions set forth. IF CUSTOMER FAIL TO FULLFILL
                                    THE MONITORING AGREEMENT, Customer agrees to pay the consultation fee, the
                                    cost of the system and recovering fees.
                                </p>
                                <p>3. Customer agrees to have system maintained for an initial term of 60
                                    months at the above monthly rate in exchange for a reduced cost of the system.
                                    Upon the execution of this agreement shall automatically start the billing process.
                                    Customer understands that the monthly payments must be paid through “Direct
                                    Billing” through their banking institution or credit card. Customers acknowledge that they
                                    authorize Company to obtain a Security System. Residential Clients: CUSTOMER HAS
                                    THE RIGHT TO CANCEL THIS TRANSACTION at any time prior to midnight on the 3rd
                                    business day after the above date of this work order in writing. Customer agrees that no
                                    verbal method is valid, and must be submitted only in writing. The date on this agreement
                                    is the agreed upon date for both the Company and the Customer
                                </p>
                                <p> 4. Client verifies that they are owners of the property listed above. In the event the
                                    system has to be removed, Client agrees and understands that there will be an
                                    additional $299.00 restocking/removal fee and early termination fees will apply.
                                </p>
                                <p> 5. Client understands that this is a new Monitoring Agreement through our central
                                    station. Alarm.com or .net is not affiliated nor has any bearing on the current
                                    monitoring services currently or previously initiated by Client with other alarm
                                    companies. By signing this work order, Client agrees and understands that they
                                    have read the above requirements and would like to take advantage of our
                                    services. Client understand that is a binding agreement for both party.
                                </p>
                                <p> 6. Customer agrees that the system is preprogramed for each specific location.
                                    accordance with the terms and conditions set forth. IF CUSTOMER FAIL TO FULLFILL
                                    THE MONITORING AGREEMENT, Customer agrees to pay the consultation fee, the
                                    cost of the system and recovering fees.
                                    Customer agrees that this is a customized order. By signing this workorder, customer
                                    agrees that customized order can not be cancelled after three day of this signed document.
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class=" col-md-12">
                                <div class="work_nore">
                                    <h6>Credit Card Information:-</h6>
                                </div>
                            </div>
                            <div class=" col-md-12">
                                Credit Card Type: <input type="radio" name="radio_credit_card" value="Visa" <?php echo ($workorder->radio_credit_card == 'Visa') ? 'checked' : ''; ?>>Visa
                                <input type="radio" name="radio_credit_card" value="Amex" <?php echo ($workorder->radio_credit_card == 'Amex') ? 'checked' : ''; ?>>Amex
                                <input type="radio" name="radio_credit_card" value="Mastercard" <?php echo ($workorder->radio_credit_card == 'Mastercard') ? 'checked' : ''; ?>>Mastercard
                                <input type="radio" name="radio_credit_card" value="Discover" <?php echo ($workorder->radio_credit_card == 'Discover') ? 'checked' : ''; ?>>Discover
                            </div>
                            <?php if ($workorder->card_details != '') {

                                $card_details = unserialize($workorder->card_details);
                            } else { ?>

                                $card_details = [];
                            <?php } ?>
                            <div class=" col-md-6">
                                <div class="row">
                                    <div class=" col-md-6">
                                        <label for="card_no">Card Number</label>
                                        <input type="text" class="form-control" name="card_no" id="card_no" placeholder="" value="<?php echo (!empty($card_details)) ? $card_details['card_no'] : ''; ?>" />
                                    </div>
                                    <div class=" col-md-3">
                                        <label for="exp_date">Exp. Date</label>
                                        <input type="text" class="form-control" name="exp_date" id="exp_date" placeholder="" value="<?php echo (!empty($card_details)) ? $card_details['exp_date'] : ''; ?>" />
                                    </div>
                                    <div class=" col-md-3">
                                        <label for="cvv">CVV#</label>
                                        <input type="text" class="form-control" name="cvv" id="cvv" placeholder="" value="<?php echo (!empty($card_details)) ? $card_details['cvv'] : ''; ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <b>Billing Dates:</b>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_billing_dates[]" value="5th" checked>5th
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_billing_dates[]" value="7th">7th
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_billing_dates[]" value="8th">8th
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_billing_dates[]" value="10th">10th
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_billing_dates[]" value="14th">14th
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_billing_dates[]" value="15th">15th
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_billing_dates[]" value="18th">18th
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_billing_dates[]" value="21th">21th
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_billing_dates[]" value="22th">22th
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_billing_dates[]" value="26th">26th
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="chk_billing_dates[]" value="28th">28th
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class=" col-md-9">
                                <div class="work_nore">
                                    <h6>Other Information:-</h6>
                                </div>
                            </div>
                            <div class=" col-md-6">
                                <div class="row">
                                    <div class=" col-md-12">
                                        <label for="checking_account">Checking account #</label>
                                        <input type="text" class="form-control" name="checking_account" id="checking_account" placeholder="" value="<?php echo ($workorder->checking_account) ? $workorder->checking_account : ''; ?>" />
                                    </div>
                                    <div class=" col-md-12">
                                        <label for="routing">Routing #</label>
                                        <input type="text" class="form-control" name="routing" id="routing" placeholder="" value="<?php echo ($workorder->routing) ? $workorder->routing : ''; ?>" />
                                    </div>
                                    <div class=" col-md-6">
                                        <label for="sales_rep_name">Sales Rep’s Name</label>
                                        <input type="text" class="form-control" name="sales_rep_name" id="sales_rep_name" placeholder="" value="<?php echo ($workorder->sales_rep_name) ? $workorder->sales_rep_name : ''; ?>" />
                                    </div>
                                    <div class=" col-md-6">
                                        <label for="cell_phone">Cell Phone</label>
                                        <input type="text" class="form-control" name="cell_phone" id="cell_phone" placeholder="" value="<?php echo ($workorder->cell_phone) ? $workorder->cell_phone : ''; ?>" />
                                    </div>
                                    <div class=" col-md-12">
                                        <label for="notes_to_lauren">Notes to Lauren:</label>
                                        <input type="text" class="form-control" name="notes_to_lauren" id="notes_to_lauren" placeholder="" value="<?php echo ($workorder->notes_to_lauren) ? $workorder->notes_to_lauren : ''; ?>" />
                                    </div>
                                    <div class=" col-md-6">
                                        <label for="prev_prod_name">If takeover, name of previous products:</label>
                                        <input type="text" class="form-control" name="prev_prod_name" id="prev_prod_name" placeholder="" value="<?php echo ($workorder->prev_prod_name) ? $workorder->prev_prod_name : ''; ?>" />
                                    </div>
                                    <div class=" col-md-6">
                                        <label for="chk_inactive">
                                            <input type="checkbox" name="chk_inactive" value="INACTIVE" <?php echo ($workorder->chk_inactive == 'INACTIVE') ? 'checked' : ''; ?>>INACTIVE
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class=" col-md-12">
                                <div class="work_nore">
                                    <h6>Signature</h6>
                                    <p> By Signing below you verify that the above information is true and complete, and youauthorize payment and confirmation with credit reporting agencies or a third party. </p>
                                </div>
                            </div>
                            <div class=" col-md-4">
                                <input type="text" class="form-control" name="comp_rep_approval" id="comp_rep_approval" placeholder="" value="<?php echo ($workorder->comp_rep_approval) ? $workorder->comp_rep_approval : ''; ?>" />
                                <label for="comp_rep_approval">COMPANY REPRESENTATIVE APPROVAL </label>
                            </div>
                            <div class=" col-md-4">

                                <?php if ($workorder->customer_sign != '') {

                                    $img = str_replace('[removed]', '', $workorder->customer_sign); ?>
                                    <img src="<?php echo 'data:image/png;base64,' . $img; ?>" alt="" style="width: 300px;">
                                <?php  } else { ?>
                                    <input type="text" class="form-control" name="customer_sign" id="customer_sign" placeholder="" />

                                <?php } ?>
                                <label for="customer_sign">CUSTOMER SIGNATURE </label>

                            </div>

                            <!-- <div class=" col-md-4">
                        <input type="text" class="form-control" name="" id="" placeholder=""/>
                        <label for="city">CUSTOMER SIGNATURE </label>
                        </div> -->
                        </div>
                        <div class="row">
                            <div class=" col-md-12">
                                <div class="work_nore">
                                    <h6>POST-SERVICE SUMMARY</h6>
                                </div>
                            </div>
                            <div class=" col-md-4">
                                <label for="post_service_uid">USERID</label>
                                <input type="text" class="form-control" name="post_service_uid" id="post_service_uid" placeholder="" value="<?php echo ($workorder->post_service_uid) ? $workorder->post_service_uid : ''; ?>" />
                            </div>
                            <div class=" col-md-4">
                                <label for="post_service_pwd">PASSWORD</label>
                                <input type="text" class="form-control" name="post_service_pwd" id="post_service_pwd" placeholder="" value="<?php echo ($workorder->post_service_pwd) ? $workorder->post_service_pwd : ''; ?>" />
                            </div>
                            <div class=" col-md-4">
                                <label for="post_service_pre_install">Pre-Install Conf. #</label>
                                <input type="text" class="form-control" name="post_service_pre_install" id="post_service_pre_install" placeholder="" value="<?php echo ($workorder->post_service_pre_install) ? $workorder->post_service_pre_install : ''; ?>" />
                            </div>
                            <div class=" col-md-4">
                                <label for="post_service_wifi_pwd">WiFi Password</label>
                                <input type="text" class="form-control" name="post_service_wifi_pwd" id="post_service_wifi_pwd" placeholder="" value="<?php echo ($workorder->post_service_wifi_pwd) ? $workorder->post_service_wifi_pwd : ''; ?>" />
                            </div>
                            <div class=" col-md-4">
                                <label for="post_service_panel_location">Panel Location</label>
                                <input type="text" class="form-control" name="post_service_panel_location" id="post_service_panel_location" placeholder="" value="<?php echo ($workorder->post_service_panel_location) ? $workorder->post_service_panel_location : ''; ?>" />
                            </div>
                            <div class=" col-md-4">
                                <label for="post_service_trans_location">Transformer Location</label>
                                <input type="text" class="form-control" name="post_service_trans_location" id="post_service_trans_location" placeholder="" value="<?php echo ($workorder->post_service_trans_location) ? $workorder->post_service_trans_location : ''; ?>" />
                            </div>
                        </div>
                        <div class="row">
                            <div class=" col-md-6">
                                <label for="note_to_admin">Note to Admin</label>
                                <textarea name="note_to_admin" id="note_to_admin" class="form-control" col="2" row="1"><?php echo ($workorder->note_to_admin) ? $workorder->note_to_admin : ''; ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class=" col-md-9">
                                <div class="work_nore">
                                    <h6>NOTICE OF CANCELLATION of Authorized Dealer Workorder Agreement</h6>
                                    <label for="date_of_trans">Date of Transaction</label>
                                    <input type="text" class="form-control" name="date_of_trans" id="date_of_trans" placeholder="" />
                                    <p>You may CANCEL this transaction, within THREE BUSINESS DAYS from the above date. If You cancel, You must make You may, if You wish, comply with Our instructions regarding the return shipment of the goods at Your expense and risk. WITHIN TEN BUSINESS DAY of cancellation request. </p>
                                    <p>If You cancel, you authorize a draft of $299 for processing for deactivation and restocking of devices.If you fail to make the goods available to Us, or if You agree to return the goods to Us and fail to do so, then You remain liable for performance of all obligations under the contract.</p>
                                    <p>To cancel this transaction, mail or deliver a signed and postmarket, dated copy of this Notice of Cancellation or any otherother written notice, or send a telegram, to Alarm Direct, Inc., 8826 North Davis Highway, Suite #1, Pensacola,</p>
                                    <label for="date_later_midnight">NOT LATER THAN MIDNIGHT OF</label>
                                    <input type="text" class="form-control" name="date_later_midnight" id="date_later_midnight" placeholder="" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class=" col-md-4">
                                <h6>I HEREBY CANCEL THIS TRANSACTION:</h6>
                            </div>
                            <div class=" col-md-4">
                                <input type="text" class="form-control" name="cancel_custome_sign" id="cancel_custome_sign" placeholder="" value="<?php echo ($workorder->cancel_custome_sign) ? $workorder->cancel_custome_sign : ''; ?>" />
                                <label for="">COSTOMER SIGNATURE </label>
                            </div>
                            <div class=" col-md-4">
                                <input type="text" class="form-control" name="cancel_trans_date" id="cancel_trans_date" placeholder="" value="<?php echo ($workorder->cancel_trans_date) ? date('m/d/Y', strtotime($workorder->cancel_trans_date)) : ''; ?>" />
                                <label for="">DATE </label>
                            </div>
                            <div class=" col-md-4">
                                <input type="text" class="form-control" name="cancel_customer_name" id="cancel_customer_name" placeholder="" value="<?php echo ($workorder->cancel_customer_name) ? $workorder->cancel_customer_name : ''; ?>" />
                                <label for="">CUSTOMER’S NAME </label>
                            </div>
                            <div class=" col-md-4">
                                <input type="text" class="form-control" name="cancel_customer_address" id="cancel_customer_address" placeholder="" value="<?php echo ($workorder->cancel_customer_address) ? $workorder->cancel_customer_address : ''; ?>" />
                                <label for="">CUSTOMER’S ADDRESS</label>
                            </div>
                            <div class=" col-md-4">
                                <input type="text" class="form-control" name="cancel_customer_phone" id="cancel_customer_phone" placeholder="" value="<?php echo ($workorder->cancel_customer_phone) ? $workorder->cancel_customer_phone : ''; ?>" />
                                <label for="">CUSTOMER’S PHONE NUMBER </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <button type="submit" class="btn btn-flat btn-primary">Submit</button>
                                <a href="<?php echo url('workorder') ?>" class="btn btn-danger">Cancel this</a>
                            </div>
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
<?php include viewPath('includes/footer'); ?>
<script>
    $(document).ready(function() {
        $('.form-validate').validate();

        //Initialize Select2 Elements
        $('.select2').select2()

    })

    function previewImage(input, previewDom) {

        if (input.files && input.files[0]) {

            $(previewDom).show();

            var reader = new FileReader();

            reader.onload = function(e) {
                $(previewDom).find('img').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            $(previewDom).hide();
        }

    }

    function createUsername(name) {
        return name.toLowerCase()
            .replace(/ /g, '_')
            .replace(/[^\w-]+/g, '');;
    }
    /* 
    $(document).on('focusout', '.price', function(){
    
        var counter = $(this).data('counter');
        calculation(counter);    
    });
    
    $(document).on('focusout', '.quantity', function(){
    
        var counter = $(this).data('counter');
        calculation(counter);    
    });
    
    function calculation(counter) {
    
        var price = $('#price_'+counter).val();
        var quantity = $('#quantity_'+counter).val();
        var tax = (parseFloat(price)*7.5/100);
        var tax1 = ((parseFloat(price)*7.5/100) * parseFloat(quantity)).toFixed(2);
        var total = ((parseFloat(price)+parseFloat(tax))*parseFloat(quantity)).toFixed(2);
    
        $('#span_total_'+counter).text(total);
        $('#span_tax_'+counter).text(tax1);
    }
    
    $(document).on('click', '#add_another', function(e){
    
      e.preventDefault();
      var count = parseInt($('#count').val())+1;
      $('#count').val(count);
    
      var html = '<tr>\n'+
                  '<td>\n'+
                    '<input type="text" class="form-control" name="item[]">\n'+
                  '</td>\n'+                
                  '<td>\n'+
                    '<input type="text" class="form-control quantity" name="quantity[]" data-counter="'+count+'" id="quantity_'+count+'" value="1">\n'+
                  '</td>\n'+
                  '<td>\n'+
                    '<input type="text" class="form-control" name="type[]">\n'+
                  '</td>\n'+
                  '<td>\n'+
                    '<input type="number" class="form-control price" name="price[]" data-counter="'+count+'" id="price_'+count+'" min="0" value="0">\n'+
                  '</td>\n'+
                  '<td>\n'+
                    '<span id="span_discount_'+count+'">0.00 (0.00%)</span>\n'+
                  '</td>\n'+
                  '<td>\n'+
                    '<span id="span_tax_'+count+'">0.00 (7.5%)</span>\n'+
                  '</td>\n'+
                  '<td>\n'+
                    '<span id="span_total_'+count+'">0.00</span>\n'+
                  '</td>\n'+
                  '<td>\n'+
                    '<a href="#" class="remove">X</a>\n'+
                  '</td>\n'+
                '</tr> ';
    
          $('#table_body').append(html);
    });
    
    $(document).on('click', '.remove', function(e){
    
      e.preventDefault();
      $(this).parent().parent().remove();
      //var count = parseInt($('#count').val())-1;
     // $('#count').val(count);
    });

    function cal_total_due() {

       var eqpt_cost = parseFloat($('#eqpt_cost').val());
       var sales_tax = parseFloat($('#sales_tax').val());
       var inst_cost = parseFloat($('#inst_cost').val());
       var one_time = parseFloat($('#one_time').val());
       var m_monitoring = parseFloat($('#m_monitoring').val());

       var total_due = parseFloat(eqpt_cost+sales_tax+inst_cost+one_time+m_monitoring).toFixed(2);     
       $('#total_due').text(total_due);
    }
    
    $( function() {
      $( "#date_issued" ).datepicker();
      $( "#date_of_trans" ).datepicker();
      $( "#date_later_midnight" ).datepicker();
      $( "#workorder_date" ).datepicker();
      $( "#contact_dob" ).datepicker();
      $( "#cancel_trans_date" ).datepicker();
      $( "#start_date" ).datepicker();
      $('#end_time').timepicker({});
      $('#start_time').timepicker({});
      $('#end_date').datepicker();
      $('#inst_date').datepicker();
    } );
     */
</script>