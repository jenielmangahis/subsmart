<?php 
    include viewPath('v2/includes/header'); 
    add_css(array(
        'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
        'https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
        'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
        //'assets/frontend/css/workorder/main.css',
        // 'assets/css/beforeafter.css',
    ));
?>
<!-- add css for this page -->
<?php include viewPath('v2/pages/job/css/job_new'); ?>

<!-- Script for autosaving form -->
<!--<script src="<?=base_url("assets/js/jobs/autosave.js")?>"></script>-->


<style>
    .nsm-table {
        display: none;
    }
    .nsm-badge.primary-enhanced {
        background-color: #6a4a86;
    }
    div[wrapper__section] {
        padding: 60px 10px !important;
    }
    .card_plus_sign{
        float: right;
        padding-right: 40px;
        font-size: 20px;
        display: block;
        margin-top: -38px;
    }
    .box_footer_icon{
        font-size: 20px;
    }
    .box_right{
        border-color: #e0e0e0 !important;
        border: 1px solid;
    }
    .card{
        box-shadow: 0 0 13px 0 rgb(116 116 117 / 44%) !important;
    }
    .label-width .form-control {
        width: 80% !important;
    }

    /** css fix for data table missing search input **/
    label>input {
        visibility: visible !important;
        position: inherit !important;
    }

    #progress-bar-container li .step-inner {
        position: absolute;
        width: 100%;
        bottom: 0;
        font-size: 14px;
    }

    #progress-bar-container li.active,
    #progress-bar-container li:hover {
        color: #444;
    }

    #progress-bar-container li::after {
        content: " ";
        display: block;
        width: 6px;
        height: 6px;
        background-color: #777;
        margin: auto;
        border: 7px solid #fff;
        border-radius: 50%;
        margin-top: 40px;
        box-shadow: 0 2px 13px -1px rgba(0, 0, 0, 0.2);
        transition: all ease 0.25s;
    }
    #progress-bar-container li:hover::after {
        background: #555;
    }

    #progress-bar-container li.active::after {
        background: #207893;
    }

    #progress-bar-container #line {
        width: 100%;
        margin: auto;
        background-color: #eee;
        height: 6px;
        position: absolute;
        left: 8%;
        top: 50px;
        z-index: 1;
        border-radius: 50px;
        transition: all ease 0.75s;
    }

    #progress-bar-container #line-progress {
        content: " ";
        width: 8%;
        height: 100%;
        background-color: #207893;
        background: linear-gradient(to right #207893 0%, #2ea3b7 100%);
        position: absolute;
        z-index: 2;
        border-radius: 50px;
        transition: 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.25);
    }
    #progress-content-section {
        position: relative;
        top: 100px;
        width: 90%;
        margin: auto;
        background: #f3f3f3;
        border-radius: 4px;
    }

    #progress-content-section .section-content {
        padding: 30px 40px;
        text-align: center;
    }

    .section-content h2 {
        font-size: 17px;
        text-transform: uppercase;
        color: #333;
        letter-spacing: 1px;
    }

    .section-content p {
        font-size: 16px;
        line-height: 1.8rem;
        color: #777;
    }

    .section-content {
        display: none;
        animation: FadeinUp 0.7s ease 1 forwards;
        transform: translateY(15px);
        opacity: 0;
    }

    .section-content.active {
        display: block;
        opacity: 1;
    }

    .progress-wrapper {
        margin: auto;
        max-width: auto;
    }
    #progress-bar-container {
        position: relative;
        width: 90%;
        margin: auto;
        height: 100%;
        margin-top: 65px;
    }
    #progress-bar-container ul {
        padding-top: 15px;
        z-index: 999;
        position: absolute;
        width: 100%;
        margin-top: -40px;
    }
    #progress-bar-container li::before {
        content: " ";
        display: block;
        margin: auto;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: 2px solid #aaa;
        transition: all ease 0.3s;
    }

    #progress-bar-container li.active::before,
    #progress-bar-container li:hover::before {
        border: 2px solid #fff;
        background-color: #32243d;
    }

    #progress-bar-container li {
        list-style: none;
        float: left;
        width: 12.5%;
        text-align: center;
        color: #aaa;
        text-transform: uppercase;
        font-size: 11px;
        cursor: pointer;
        font-weight: 700;
        transition: all ease 0.2s;
        vertical-align: bottom;
        height: 60px;
        position: relative;
    }

    @keyframes FadeInUp {
    0% {
        transform: translateY(15px);
        opacity: 0;
    }
    100% {
        transform: translateY(0px);
        opacity: 1;
    }
    }
    .card_header{
        text-align: left;
    }

    .btn-circle {
        width: 40px;
        height: 40px;
        text-align: center;
        padding: 5px 7px 0 7px;
        font-size: 16px;
        line-height: 1.428571429;
        border-radius: 20px;
    }
    .calendar_button{
        color: #ffffff;
        font-size: 20px;
        padding-top: 3px;
    }

    .color-box-custom {
        padding: 20px 0px;
    }
    .color-box-custom ul {
        margin: 0px;
        padding: 0px;
        list-style: none;
    }
    .color-box-custom ul li {
        display: inline-block;
    }
    .color-box-custom ul li span {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #000;
        display: block;
    }
    .color-box-custom ul li span.bg-1 {
        background-color: #4baf51;
    }
    .color-box-custom ul li span.bg-2 {
        background-color: #d86566;
    }
    .color-box-custom ul li span.bg-3 {
        background-color: #e57399;
    }
    .color-box-custom ul li span.bg-4 {
        background-color: #b273b3;
    }
    .color-box-custom ul li span.bg-5 {
        background-color: #8b63d7;
    }
    .color-box-custom ul li span.bg-6 {
        background-color: #678cda;
    }
    .color-box-custom ul li span.bg-7 {
        background-color: #59bdb3;
    }
    .color-box-custom ul li span.bg-8 {
        background-color: #64ae89;
    }
    .color-box-custom ul li span.bg-9 {
        background-color: #f1a740;
    }
    .table-custom table th,
    .table-custom table td {
        border: none;
    }
    .table-custom table {
        border: none;
    }
    .table-custom table td a i {
        color: #45a73c;
        padding-left: 0px;
    }
    .table-custom table td.d-flex {
        padding-top: 23px;
    }
    .table-custom table td a {
        padding-left: 11px;
    }
    .table-hover tbody tr:hover, .table-striped tbody tr:nth-of-type(odd), .thead-default th {
        background-color: #fff;
    }
    .upload input[type=file]:before {
        width: 100%;
        height: 60px;
        font-size: 16px;
        line-height: 32px;
        content: 'Upload Existing Estimate';
        display: inline-block;
        background: #45a73c;
        padding: 5px 10px;
        text-align: center;
        color: #fff;
        border-radius: 0px;
    }
    .upload.workorder input[type=file]:before {
        content: 'Upload Workorder';
    }
    .upload.invoice input[type=file]:before {
        content: 'Upload Invoice';
    }
    .upload input[type=file] {
        cursor: pointer;
        width: 100%;
        height: 44px;
        overflow: hidden;
    }

    .modal{
        z-index: 999999 !important;
    }
    .items-8 li a{
        color: #bebebe !important;
        text-decoration: none !important;
    }
</style>

<?php if(isset($jobs_data)): ?>
    <input type="hidden" value="<?= $jobs_data->id ?>" id="esignJobId" />
<?php endif; ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('job/new_job1') ?>'">
        <i class='bx bx-briefcase'></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/sales_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/job_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            With a few clicks, you will be on your way to storing all information about the job performed for an account. 
                            Stores incident details, resource, expenses, tasks, item audits, communications, billing and more. 
                            Try our quick import form buttons to seamlessly schedule a job.
                        </div>
                    </div>
                </div>
                <form method="post" name="myform" id="jobs_form">
                <div class="row g-3 align-items-start">

                    <div class="col-12 ">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="nsm-card primary">
                                    <div class="nsm-card-header d-block">
                                        <div class="nsm-card-title">
                                            <span>Job Configuration Status</span>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <div class="nsm-progressbar my-4">
                                            <div class="progressbar">
                                                <ul class="items-8">
                                                    <li class="<?= !isset($jobs_data) || $jobs_data->status == '0'  ? 'active' : ''; ?> step01">Draft</li>
                                                    <li class="<?= isset($jobs_data) && $jobs_data->status == 'Scheduled'  ? 'active' : ''; ?> step02">Schedule</li>
                                                    <li class="<?= isset($jobs_data) && $jobs_data->status == 'Arrival'  ? 'active' : ''; ?> step03" style="display: ;">
                                                        <a href="#" <?php if(isset($jobs_data) && $jobs_data->status == 'Scheduled'): ?>data-bs-toggle="modal" data-bs-target="#omw_modal" data-backdrop="static" data-keyboard="false" <?php endif; ?> style="text-decoration: none"> Arrival </a>
                                                    </li>
                                                    <li class="<?= isset($jobs_data) && $jobs_data->status == 'Started'  ? 'active' : ''; ?> step04" >
                                                        <a href="#" <?php if(isset($jobs_data) && $jobs_data->status == 'Arrival'): ?>data-bs-toggle="modal" data-bs-target="#start_modal" data-backdrop="static" data-keyboard="false" <?php endif; ?>> Start </a>
                                                    </li>
                                                    <li class="<?= isset($jobs_data) && $jobs_data->status == 'Approved'  ? 'active' : ''; ?> step05">
                                                        <a href="#" <?php if(isset($jobs_data) && $jobs_data->status == 'Started'): ?>data-bs-toggle="modal" data-bs-target="#fill_esign" data-backdrop="static" data-keyboard="false" <?php endif; ?>> Approved </a>
                                                    </li>
                                                    <li class="<?= isset($jobs_data) && $jobs_data->status == 'Finish'  ? 'active' : ''; ?>">Finish</li>
                                                    <li class="<?= isset($jobs_data) && $jobs_data->status == 'Invoice'  ? 'active' : ''; ?>">Invoice</li>
                                                    <li class="<?= isset($jobs_data) && $jobs_data->status == 'Finish'  ? 'active' : ''; ?>">Completed</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="nsm-card primary" style="margin-top: 30px;">
                                    <div class="nsm-card-header d-block">
                                        <div class="nsm-card-title">
                                            <span>Schedule Job</span>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <h6 class="page-title "><span style="font-size: 20px;"  class="fa fa-calendar"></span>&nbsp; &nbsp;Schedule Job</h6>
                                        <hr>
                                        <?php if(!isset($jobs_data)): ?>
                                        <p>Import Data from Wordorder/Invoice/Estimates</p>
                                        <div id="import_buttons">
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#estimates_import" class="nsm-button primary">
                                                <span class="fa fa-upload"></span> Estimates
                                            </button> &nbsp;&nbsp;
                                            <button href="#" data-bs-toggle="modal" data-bs-target="#workorder_import" type="button" class="nsm-button primary">
                                                <span class="fa fa-upload"></span> Work Order
                                            </button> &nbsp;&nbsp;
                                            <button href="#" data-bs-toggle="modal" data-bs-target="#invoice_import" type="button" class="nsm-button primary">
                                                <span class="fa fa-upload"></span> Invoice
                                            </button>
                                        </div>
                                        <hr>
                                        <?php endif; ?>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-1">
                                                    <label>From</label>
                                                </div>
                                                <div class="col-lg-5">
                                                    <input type="date" name="start_date" id="start_date" class="form-control" value="<?= isset($jobs_data) ?  $jobs_data->start_date : '';  ?>" required>&nbsp;&nbsp;
                                                </div>
                                                <div class="col-lg-5">
                                                    <select id="start_time" name="start_time" class="nsm-field form-select" required>
                                                        <option value="">Start time</option>
                                                        <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                                            <option <?= isset($jobs_data) && strtolower($jobs_data->start_time) == time_availability($x) ?  'selected' : '';  ?> value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-1">
                                                    <label>To</label>
                                                </div>
                                                <div class="col-lg-5">
                                                    <input type="date" name="end_date" id="end_date" class="form-control mr-2" value="<?= isset($jobs_data) ?  $jobs_data->end_date : '';  ?>" required>
                                                </div>
                                                <div class="col-lg-5">
                                                    <select id="end_time" name="end_time" class="nsm-field form-select " required>
                                                        <option value="">End time</option>
                                                        <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                                            <option <?= isset($jobs_data) && strtolower($jobs_data->end_time) == time_availability($x) ?  'selected' : '';  ?> value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <h6>Select Priority</h6>
                                            <select id="priority" name="priority" class="form-control">
                                                <option value="Standard">Standard</option>
                                                <option value="Low">Low</option>
                                                <option value="Emergency">Emergency</option>
                                                <option value="Urgent">Urgent</option>
                                            </select>
                                        </div><br>
                                        <h6>Select Employee</h6>
                                            <select id="employee_id" name="employee_id" class="form-control " required>
                                                <option value="10001">Select All</option>
                                                <?php if(!empty($employees)): ?>
                                                    <?php foreach ($employees as $employee): ?>
                                                        <option <?= isset($jobs_data) && $jobs_data->employee_id == $employee->id ? 'selected' : '';  ?> value="<?= $employee->id; ?>"><?= $employee->FName.','.$employee->LName; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select><br>
                                        <div class="color-box-custom">
                                            <h6>Event Color on Calendar</h6>
                                            <ul>
                                                <?php if(isset($color_settings)): ?>
                                                    <?php foreach ($color_settings as $color): ?>
                                                        <li>
                                                            <a style="background-color: <?= $color->color_code; ?>;" id="<?= $color->id; ?>" type="button" class="btn btn-default color-scheme btn-circle bg-1" title="<?= $color->color_name; ?>">
                                                                <?php if(isset($jobs_data) && $jobs_data->event_color == $color->id) {echo '<i class="bx bxs-calendar calendar_button" aria-hidden="true"></i>'; } ?>
                                                            </a>
                                                        </li>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </ul>
                                            <input value="<?= (isset($jobs_data) && $jobs_data->event_color == $color->id) ? $jobs_data->event_color : ''; ?>" id="job_color_id" name="event_color" type="hidden" />
                                        </div>
                                        <h6>Customer Reminder Notification</h6>
                                        <select name="customer_reminder_notification" class="form-control ">
                                            <option value="0">None</option>
                                            <option <?= (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT5M') ? 'selected' : ''; ?> value="PT5M">5 minutes before</option>
                                            <option <?= (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT15M') ? 'selected' : ''; ?> value="PT15M">15 minutes before</option>
                                            <option <?= (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT30M') ? 'selected' : ''; ?> value="PT30M">30 minutes before</option>
                                            <option <?= (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT1H') ? 'selected' : ''; ?> value="PT1H">1 hour before</option>
                                            <option <?= (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT2H') ? 'selected' : ''; ?> value="PT2H">2 hours before</option>
                                            <option <?= (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT4H') ? 'selected' : ''; ?> value="PT4H">4 hours before</option>
                                            <option <?= (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT6H') ? 'selected' : ''; ?> value="PT6H">6 hours before</option>
                                            <option <?= (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT8H') ? 'selected' : ''; ?> value="PT8H">8 hours before</option>
                                            <option <?= (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT12H') ? 'selected' : ''; ?> value="PT12H">12 hours before</option>
                                            <option <?= (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT16H') ? 'selected' : ''; ?> value="PT16H">16 hours before</option>
                                            <option <?= (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'P1D') ? 'selected' : ''; ?> value="P1D" selected="selected">1 day before</option>
                                            <option <?= (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'P2D') ? 'selected' : ''; ?> value="P2D">2 days before</option>
                                            <option <?= (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT0M') ? 'selected' : ''; ?> value="PT0M">On date of event</option>
                                        </select><br>
                                        <h6>Time Zone</h6>
                                        <select id="inputState" name="timezone" class="form-control ">
                                            <option value="utc5">Central Time (UTC -5)</option>
                                        </select><br>
                                        <h6>Select Job Type</h6>
                                        <select id="job_type_option" name="jobtypes" class="form-control " required>
                                            <option value="">Select Type</option>
                                            <?php if(!empty($job_types)): ?>
                                                <?php foreach ($job_types as $type): ?>
                                                    <option <?php if(isset($jobs_data) && $jobs_data->job_type == $type->title) {echo 'selected'; } ?> value="<?= $type->title; ?>"><?= $type->title; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select><br>
                                        <h6>Select Job Tag</h6>
                                        <select id="job_tags" name="tags" class="form-control " required>
                                            <option value="">Select Tags</option>
                                            <?php if(!empty($tags)): ?>
                                                <?php foreach ($tags as $tag): ?>
                                                    <option <?php if(isset($jobs_data) && $jobs_data->tags == $tag->id) {echo 'selected'; } ?> value="<?= $tag->id; ?>"><?= $tag->name; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select><br>
                                        <h6>Assigned To</h6>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input type="text" placeholder="Employee 1" id="emp2_id" name="emp2_id"  class="form-control" readonly>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" placeholder="Employee 2" id="emp3_id" name="emp3_id"  class="form-control" readonly>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" placeholder="Employee 3" id="emp4_id" name="emp4_id"  class="form-control" readonly>
                                            </div>
                                        </div>
                                        <br>
                                        <center>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#share_job_modal" data-backdrop="static" data-keyboard="false" class="btn btn-primary">
                                            <span class="fa fa-plus"></span> Assign Job
                                        </a>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="nsm-card primary table-custom" style="margin-top: 30px;">
                                    <div class="nsm-card-header d-block">
                                        <div class="nsm-card-title">
                                            <b>Created By: </b>&nbsp;&nbsp; <span> <?= ' '.$logged_in_user->FName.' '.$logged_in_user->LName; ?></span>
                                            <button type="submit" id="add_another_invoice" data-bs-toggle="modal" data-bs-target="#new_customer" class="nsm-button primary text-end" style="position: absolute;right: 40px;">
                                                    <i class='bx bx-fw bx-plus'></i> Add New Customer
                                            </button>
                                        </div>
                                    </div>     
                                    <div class="nsm-card-content">
                                        <div class="row">
                                            
                                            <hr>
                                            <div class="col-md-4">
                                                <h6>Customer Info</h6>
                                                <select id="customer_id" name="customer_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select"  required>
                                                    <?php if( $default_customer_id > 0 ){ ?>
                                                        <option value="<?= $default_customer_id; ?>"><?= $default_customer_name; ?></option>
                                                    <?php } ?>                                        
                                                </select>
                                                <table id="customer_info" class="table">
                                                    <thead>
                                                    <tr>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td id="cust_fullname">xxxxx xxxxx</td>
                                                        <td><a target="_blank" href="#" id="customer_preview"><span class="fa fa-user customer_right_icon"></span></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td >
                                                            <div id="cust_address">-------------</div>
                                                            <div id="cust_address2">-------------</div>
                                                        </td>
                                                        <td><a href=""><span class="fa fa-map-marker customer_right_icon"></span></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td id="cust_number">(xxx) xxx-xxxx</td>
                                                        <td><a href=""><span class="fa fa-phone customer_right_icon"></span></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td id="cust_email">xxxxx@xxxxx.xxx</td>
                                                        <td><a id="mail_to" href="#"><span class="fa fa-envelope-o customer_right_icon"></span></a></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="col-md-12">
                                                    <div id="streetViewBody" class="col-md-6 float-left no-padding"></div>
                                                    <div id="map" class="col-md-6 float-left"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <h6 class='card_header'>Job Items Listing</h6>
                                        <table class="table table-striped">
                                            <tbody >
                                                <tr>
                                                    <td>
                                                        <small>Job Type</small>
                                                        <input type="text" id="job_type" name="job_type" value="<?= isset($jobs_data) ? $jobs_data->job_type : ''; ?>" class="form-control" readonly>
                                                    </td>
                                                    <td>
                                                        <small>Job Tags</small>
                                                        <input type="text" name="job_tag" class="form-control" value="<?= isset($jobs_data) ? $jobs_data->name : ''; ?>" id="job_tags_right" readonly>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-striped">
                                            <tbody id="jobs_items">
                                            <?php if(isset($jobs_data)): ?>
                                                <?php
                                                    $subtotal = 0.00;
                                                    foreach ($jobs_data_items as $item):
                                                    $total = $item->price * $item->qty;
                                                ?>
                                                    <tr id=ss>
                                                        <td width="35%"><small>Item name</small>
                                                            <input value="<?= $item->title; ?>" type="text" name="item_name[]" class="form-control" >
                                                            <input type="hidden" value='"+idd+"' name="item_id[]">
                                                        </td>
                                                        <td width="20%"><small>Qty</small>
                                                            <input data-itemid='"+idd+"'  id='"+idd+"' value='<?= $item->qty; ?>' type="number" name="item_qty[]" class="form-control qty">
                                                        </td>
                                                        <td width="20%"><small>Unit Price</small>
                                                            <input id='price"+idd+"' value='<?= $item->price; ?>'  type="number" name="item_price[]" class="form-control" placeholder="Unit Price">
                                                        </td>
                                                        <!--<td width="10%"><small>Unit Cost</small><input type="text" name="item_cost[]" class="form-control"></td>-->
                                                        <!--<td width="25%"><small>Inventory Location</small><input type="text" name="item_loc[]" class="form-control"></td>-->
                                                        <td style="text-align: center" class="d-flex" width="15%">
                                                            <b data-subtotal='"+total_+"' id='sub_total"+idd+"' class="total_per_item"><?= number_format((float)$total,2,'.',',');?></b>
                                                            <a href="javascript:void(0)" class="remove_item_row"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                    $subtotal = $subtotal + $total;
                                                    endforeach;
                                                ?>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                        <div class="col-sm-12">
                                            <a class="link-modal-open" href="#" id="add_another_items" data-bs-toggle="modal" data-bs-target="#item_list">
                                                <span class="fa fa-plus-square fa-margin-right"></span>Add Items
                                            </a>
                                        </div>
                                        <br>
                                        <div class="col-sm-12">
                                            <p>Description of Job</p>
                                            <textarea name="job_description" class="form-control" required=""><?= isset($jobs_data) ? $jobs_data->job_description : ''; ?></textarea>
                                            <hr/>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    &nbsp;<div class="file-upload-drag">
                                                        <div class="drop">
                                                            <div class="cont">
                                                                <div class="tit">
                                                                    <?php if(isset($jobs_data) && $jobs_data->attachment != ""): ?>
                                                                        <img style="width: 100%" id="attachment-image" alt="Attachment" src="<?= isset($jobs_data) ? $jobs_data->attachment : "/uploads/jobs/attachment/placeholder.jpg"; ?> ">
                                                                    <?php else: ?>
                                                                        <p>Thumbnail</p>
                                                                        <p class="or-text">Or</p>
                                                                        <p>URL Link</p>
                                                                        <i style="color: #0b0b0b;">Upload on Photos/Attachments Box</i>
                                                                    <?php endif; ?>
                                                                    <!-- <p class="or-text">Or</p>
                                                                    <label>Choose File</label> -->
                                                                </div>
                                                            </div>
                                                            <input id="filetoupload" name="filetoupload" type="file" />
                                                            <!-- <img id="dis_image" style="display:none;" src="#" alt="your image" /> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 row pr-0">
                                                    <div class="col-sm-6">
                                                        <label style="padding: 0 .75rem;">Subtotal</label>
                                                    </div>
                                                    <div class="col-sm-6 text-right pr-3">
                                                        <label id="invoice_sub_total">$<?= isset($jobs_data) ? number_format((float)$subtotal,2,'.',',') : '0.00'; ?></label>
                                                        <input type="hidden" name="sub_total" id="sub_total_form_input" value='0'>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <hr>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <small>Tax Rate</small>
                                                        <!--<a href="<?= base_url('job/settings') ?>"><span class="fa fa-plus" style="margin-left:50px;"></span></a>-->
                                                        <select id="tax_rate" name="tax_rate" class="form-control">
                                                            <option value="">None</option>
                                                            <?php foreach ($tax_rates as $rate) : ?>
                                                                <option value="<?= $rate->percentage / 100; ?>"><?= $rate->name; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6 text-right pr-3">
                                                        <label id="invoice_tax_total">$0.00</label>
                                                        <input type="hidden" name="sub_total" id="sub_total_form_input" value='0'>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <hr>
                                                    </div>
                                                    <!--<div class="col-sm-6 text-right pr-3">
                                                        <a class="link-modal-open pt-1 pl-2" href="javascript:void(0)" id="add_another_invoice">
                                                            <span class="fa fa-plus-square fa-margin-right"></span>Discount
                                                        </a>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <hr>
                                                    </div>
                                                    <div class="col-sm-6">
                                                    </div>
                                                    <div class="col-sm-6 text-right pr-3">
                                                        <a class="link-modal-open pt-1 pl-2" href="javascript:void(0)" id="add_another_invoice">
                                                            <span class="fa fa-plus-square fa-margin-right"></span>Deposit
                                                        </a>
                                                    </div>-->
                                                    <div class="col-sm-6">
                                                        <label style="padding: 0 .75rem;">Total</label>
                                                    </div>
                                                    <div class="col-sm-6 text-right pr-3">
                                                        <label id="invoice_overall_total">$<?= isset($jobs_data) ? number_format((float)$subtotal,2,'.',',') : '0.00'; ?></label>
                                                        <input type="hidden" name="sub_total" id="sub_total_form_input" value='0'>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <hr>
                                                </div>
                                                <div class="col-sm-12" id="approval_card_right" style="display: <?= isset($jobs_data) ? 'block' : 'none' ;?>;">
                                                    <div style="float: right;">
                                                        <?php if(isset($jobs_data) && $jobs_data->signature_link != '') : ?>
                                                        <a href="javascript:void(0);" id="approval_btn_right"><span class="fa fa-columns" style="float: right;padding-right: 20px;"></span></a>

                                                        <center>
                                                            <img width="150" id="customer_signature_right" alt="Customer Signature" src="<?= isset($jobs_data) ? $jobs_data->signature_link : ''; ?>">
                                                        </center>

                                                        <center><span id="appoval_name_right"><?= isset($jobs_data->authorize_name) ? $jobs_data->authorize_name : 'Xxxxx Xxxxxx'; ?></span></center><br>
                                                        <span>-----------------------------</span><br>
                                                        <center><small>Approved By</small></center><br>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="col-sm-12">
                                                    <div class="card box_right" id="notes_right_card" style="display: <?= isset($jobs_data) ? 'block' : 'none' ;?>;">
                                                        <div class="row">
                                                            <div class="col-md-12 ">
                                                                <div class="card-header">
                                                                    <a href="javascript:void(0);" id="notes_right"><span class="fa fa-columns" style="float: right;padding-right: 20px;"></span></a>
                                                                    <h5 style="padding-left: 20px;" class="mb-0">Notes</h5>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div id="notes_edit_btn_right" class="pencil" style="width:100%; height:100px;cursor: pointer;">
                                                                        <?= isset($jobs_data) ? $jobs_data->message : ''; ?>
                                                                    </div>
                                                                    <div id="notes_input_div_right" style="display:none;">
                                                                        <div style=" height:70px;margin-bottom: 10px;">
                                                                            <textarea name="message" cols="40" style="width: 100%;" rows="3" id="note_txt_right" class="input"><?= isset($jobs_data) ? $jobs_data->message : ''; ?></textarea>
                                                                            <button type="button" class="btn btn-primary btn-sm" id="save_memo_right" style="color: #ffffff;"><span class="fa fa-save"></span> Save</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-footers">
                                                                    <div style="float: right;margin-bottom: 10px;">
                                                                        <a href="javascript:void(0);" id="edit_note_right" class="fa fa-pencil box_footer_icon"></a> &nbsp;
                                                                        <?php if(isset($jobs_data)) : ?>
                                                                        <a href="#"  class="fa fa-history box_footer_icon"></a> &nbsp;
                                                                        <a href="#"  class="fa fa-trash box_footer_icon"></a> &nbsp;
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="card box_right" id="url_right_card" style="display: <?= isset($jobs_data) ? 'block' : 'none' ;?>;">
                                                        <div class="row">
                                                            <div class="col-md-12 ">
                                                                <div class="card-header">
                                                                    <a id="url_right_btn_column" href="javascript:void(0);"><span class="fa fa-columns" style="float: right;padding-right: 20px;"></span></a>
                                                                    <h5 style="padding-left: 20px;">Url Link</h5>
                                                                </div>
                                                                <div class="card-body">

                                                                    <?php
                                                                    if(isset($jobs_data) && $jobs_data->link != NULL) {
                                                                        ?>
                                                                        <a  target="_blank" href="<?= $jobs_data->link; ?>"><p style="color: darkred;"><?= $jobs_data->link; ?></p></a>
                                                                        <?php
                                                                    }else{
                                                                        ?>
                                                                        <span class="help help-sm help-block">Enter url link or a pdf link </span>
                                                                        <?php
                                                                    } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--<div class="col-sm-12">
                                                    <div class="card box_right" id="attach_right_card" style="border-color: #e0e0e0;border: 1px solid;display: none;">
                                                        <div class="row">
                                                            <div class="col-md-12 ">
                                                                <div class="card-header">
                                                                    <a href="javascript:void(0);" id="attach_right_btn_column"><span class="fa fa-columns" style="float: right;padding-right: 20px;"></span></a>
                                                                    <h5 style="padding-left: 20px;">Photos/Attachments</h5>

                                                                </div>
                                                                <div class="card-body">
                                                                    <span class="help help-sm help-block">download pdf,jpg,png</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>-->
                                                <div class="col-sm-12">
                                                    <input class="form-control" value="Thank you for your business, Please call <?= $company_info->business_name; ?> at (<?= $company_info->business_phone; ?>) for quality customer service.">
                                                </div>
                                                <div class="col-sm-12">
                                                    <hr>
                                                </div>
                                                <?php if(isset($jobs_data) && $jobs_data->status == 'Invoiced'): ?>
                                                <div class="col-sm-12">
                                                    <div class="card box_right" id="pd_right_card" style="display: <?= isset($jobs_data) ? 'block' : 'none' ;?>;">
                                                        <div class="row">
                                                            <div class="col-md-12 ">
                                                                <div class="card-header">
                                                                    <a href="javascript:void(0);" id="pd_right"><span class="fa fa-columns" style="float: right;padding-right: 20px;"></span></a>
                                                                    <h5 style="padding-left: 20px;" class="mb-0">Payment Details</h5>
                                                                </div>
                                                                <div class="card-body">
                                                                    <table class="table table-bordered">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <b>Method</b><br>
                                                                                <span class="help help-sm help-block" id="pay_method_right">
                                                                                    <?= isset($jobs_data) ? $jobs_data->method : ''; ?>
                                                                                </span>
                                                                            </td>
                                                                            <td>
                                                                                <b>Amount</b><br>
                                                                                <span class="help help-sm help-block" id="pay_amount_right">
                                                                                    <?=  isset($jobs_data) && $jobs_data->amount != NULL ? '$'.$jobs_data->amount : '$0.00'; ?>
                                                                                </span>
                                                                            </td>
                                                                            <td>
                                                                                <b>Account Name</b><br>
                                                                                <span class="help help-sm help-block">
                                                                                <?= isset($jobs_data) && $jobs_data->account_name != NULL ? $jobs_data->account_name : 'n/a'; ?>
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php endif; ?>

                                                <?php if(isset($jobs_data) && $jobs_data->status != 'Scheduled'): ?>
                                                <div class="col-sm-12">
                                                    <div class="card box_right">
                                                        <div class="row">
                                                            <div class="col-md-12 ">
                                                                <div class="card-header">
                                                                    <h5 style="padding-left: 20px;" class="mb-0">Devices Audit</h5>
                                                                </div>
                                                                <div class="card-body">
                                                                    <span class="help help-sm help-block">Record all items used on jobs</span>
                                                                    <a href="#" id="" data-bs-toggle="modal" data-bs-target="#new_inventory" type="button" class="btn btn-sm btn-primary"><span class="fa fa-plus"></span> Add New Item</a>
                                                                    <br>
                                                                    <table style="width: 100%;" id="device_audit" class="table table-hover table-bordered table-striped">
                                                                        <thead>
                                                                            <tr>
                                                                                <td>Name</td>
                                                                                <td>Points</td>
                                                                                <td>Price</td>
                                                                                <td>Qty</td>
                                                                                <td>Subtotal</td>
                                                                                <td>Location</td>
                                                                                <td>Action</td>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="device_audit_datas">
                                                                        <?php if(isset($jobs_data_items)): ?>
                                                                            <?php
                                                                                $subtotal = 0.00;
                                                                                foreach ($jobs_data_items as $item):
                                                                                $total = $item->price * $item->qty;
                                                                            ?>
                                                                                <tr>
                                                                                    <td ><?= $item->title; ?></td>
                                                                                    <td ><?= $item->points; ?></td>
                                                                                    <td ><?= number_format((float)$item->price,2,'.',',');?></td>
                                                                                    <td id="device_qty<?= $item->id; ?>"><?= $item->qty; ?></td>
                                                                                    <td ><?= number_format((float)$total,2,'.',',');?></td>
                                                                                    <td ><?= $item->location; ?></td>
                                                                                    <td ><a href="#" data-name='<?= $item->title; ?>' data-price='<?= $item->price; ?>' data-quantity='<?= $item->qty; ?>' id="<?= $item->id; ?>" class="edit_item_list">
                                                                                            <span class="fa fa-edit"></span>
                                                                                        </a>
                                                                                        <!--<a href="javascript:void(0)" class="remove_audit_item_row">
                                                                                            <span class="fa fa-trash"></span></i>
                                                                                        </a>-->
                                                                                    </td>
                                                                                </tr>
                                                                            <?php $subtotal = $subtotal + $total; endforeach; ?>
                                                                        <?php endif; ?>
                                                                        </tbody>
                                                                    </table>
                                                                    <br>
                                                                    <style>
                                                                        .table-bordered td, .table-bordered th {
                                                                            border: 1px solid #dee2e6 !important;
                                                                        }
                                                                    </style>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                            <br>
                                        </div>
                                        <div class="row">
                                            <input id="total_amount" type="hidden" name="total_amount">
                                            <input id="signature_link" type="hidden" name="signature_link">
                                            <input id="name" type="hidden" name="authorize_name">
                                            <input id="datetime_signed" type="hidden" name="datetime_signed">
                                            <input id="attachment" type="hidden" name="attachment">
                                            <input id="created_by" type="hidden" name="created_by" value="<?= $logged_in_user->id; ?>">
                                            <input id="employee2_id" type="hidden" name="employee2_id" value="<?= isset($jobs_data) ? $jobs_data->employee2_id : ''; ?>">
                                            <input id="employee3_id" type="hidden" name="employee3_id" value="<?= isset($jobs_data) ? $jobs_data->employee3_id : ''; ?>">
                                            <input id="employee4_id" type="hidden" name="employee4_id" value="<?= isset($jobs_data) ? $jobs_data->employee4_id : ''; ?>">
                                            <div class="col-sm-12 text-end">
                                                <?php if(!isset($jobs_data) || $jobs_data->status == 'Scheduled') : ?>
                                                    <button type="submit" class="nsm-button primary"><i class='bx bx-fw bx-calendar-plus'></i> Schedule</button>
                                                <?php endif; ?>
                                                <?php if(isset($jobs_data)): ?>
                                                    <a href="<?= base_url('job/job_preview/'.$this->uri->segment(3)) ?>">
                                                        <button type="submit" class="nsm-button primary"><i class='bx bx-bx fa-search-plus'></i> Preview</button>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                          
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modals -->
<?php include viewPath('v2/pages/job/modals/new_customer'); ?>
<?php include viewPath('v2/pages/job/modals/inventory_location'); ?>
<?php include viewPath('v2/pages/job/modals/new_inventory'); ?>
<?php include viewPath('v2/pages/job/modals/esign'); ?>

<!-- Signature Modal -->
<div class="modal fade" id="updateSignature" role="dialog">
    <div class="close-modal" data-bs-dismiss="modal">&times;</div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Approval</h4>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/pages/job/modals/fill_esign'); ?>

<!-- Modal -->
<div class="modal fade nsm-modal" id="item_list" tabindex="-1"  aria-labelledby="newcustomerLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newcustomerLabel">Item Lists</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="items_table" class="table table-hover" style="width: 100%;">
                            <thead>
                            <tr>
                                <td> Name</td>
                                <td> Qty</td>
                                <td> Price</td>
                                <td> Type</td>
                                <td> Action</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($items)): ?>
                                <?php foreach ($items as $item): ?>
                                    <?php $item_qty = get_total_item_qty($item->id); ?>
                                    <?php if($item_qty[0]->total_qty > 0): ?>
                                    <tr>
                                        <td><?= $item->title; ?></td>
                                        <td><?= $item_qty[0]->total_qty > 0 ? $item_qty[0]->total_qty : 0; ?></td>
                                        <td><?= $item->price; ?></td>
                                        <td><?=ucfirst($item->type); ?></td>
                                        <td>
                                            <button id="<?= $item->id; ?>" data-item_type="<?= ucfirst($item->type); ?>" data-quantity="<?= $item->units; ?>" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>" type="button" data-bs-dismiss="modal" class="nsm-button primary select_item">
                                            <i class='bx bx-plus'></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-detail">
                <div class="button-modal-list">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><span class="fa fa-remove"></span> Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade nsm-modal" id="estimates_import" tabindex="-1" aria-labelledby="newcustomerLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newcustomerLabel">Select Estimate To Make a Job</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="estimates_table" class="table table-hover" style="width: 100%;">
                            <thead>
                            <tr>
                                <td> Estimate #</td>
                                <td> Job & Customer</td>
                                <td> Date</td>
                                <td> </td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($estimates)): ?>
                                <?php foreach ($estimates as $estimate): ?>
                                    <tr>
                                        <td><?= $estimate->estimate_number; ?></td>
                                        <td><?= $estimate->job_name; ?></td>
                                        <td><?= date('M d, Y', strtotime($estimate->estimate_date)); ?></td>
                                        <td>
                                            <a href="<?= base_url('job/estimate_job/'. $estimate->id) ?>" id="<?= $estimate->id; ?>" type="button" class="btn btn-sm btn-default">
                                                <span class="fa fa-briefcase"></span> Convert To Job
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-detail">
                <div class="button-modal-list">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><span class="fa fa-remove"></span> Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Work Order Modal -->
<?php include viewPath('v2/pages/job/modals/wordorder_import'); ?>

<!-- Invoice Modal -->
<?php include viewPath('v2/pages/job/modals/invoice_import'); ?>

<!-- Signature Modal -->
<div class="modal fade" id="share_job_modal" role="dialog">
    <div class="close-modal" data-bs-dismiss="modal">&times;</div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Share Job To Other Employee</h4>
            </div>
            <div class="modal-body">
                <label>Employee 1</label>
                <select id="employee2" name="employee2_" class="form-control">
                    <option value="">Select Employee</option>
                    <?php if(!empty($employees)): ?>
                        <?php foreach ($employees as $employee): ?>
                            <option <?php if(isset($jobs_data) && $jobs_data->employee2_id == $employee->id) {echo 'selected'; } ?> value="<?= $employee->id; ?>"><?= $employee->LName.','.$employee->FName; ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>

                <label>Employee 2</label>
                <select id="employee3" name="employee3_" class="form-control">
                    <option value="">Select Employee</option>
                    <?php if(!empty($employees)): ?>
                        <?php foreach ($employees as $employee): ?>
                            <option <?php if(isset($jobs_data) && $jobs_data->employee3_id == $employee->id) {echo 'selected'; } ?> value="<?= $employee->id; ?>"><?= $employee->LName.','.$employee->FName; ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>

                <label>Employee 3</label>
                <select id="employee4" name="employee4_" class="form-control">
                    <option value="">Select Employee</option>
                    <?php if(!empty($employees)): ?>
                        <?php foreach ($employees as $employee): ?>
                            <option <?php if(isset($jobs_data) && $jobs_data->employee4_id == $employee->id) {echo 'selected'; } ?> value="<?= $employee->id; ?>"><?= $employee->LName.','.$employee->FName; ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" id="" class="btn btn-primary" data-bs-dismiss="modal">
                    <span class="fa fa-paper-plane-o"></span> Save / Close
                </button>
            </div>
        </div>
    </div>
</div>

<!-- On My Way Modal -->
<?php include viewPath('v2/pages/job/modals/arrival_modal'); ?>
<!-- Start Job Modal -->
<?php include viewPath('v2/pages/job/modals/started_modal'); ?>
<!-- Finish Job Modal -->
<div class="modal fade" id="finish_modal" role="dialog">
    <div class="close-modal" data-bs-dismiss="modal">&times;</div>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Finish Job</h4>
            </div>
            <form id="update_status_to_closed">
                <div class="modal-body">
                    <p>This will stop on job duration tracking and mark the job end time.</p>
                    <p>Finish job at:</p>
                    <input type="date" name="job_start_date" id="job_start_date" class="form-control" required>
                    <input type="hidden" name="id" id="jobid" value="<?php if(isset($jobs_data)){echo $jobs_data->job_unique_id;} ?>"> <br>
                    <input type="hidden" name="status" id="status" value="Closed">
                    <select id="job_start_time" name="job_start_time" class="form-control" required>
                        <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                            <option <?= isset($jobs_data) && strtolower($jobs_data->start_time) == time_availability($x) ?  'selected' : '';  ?> value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-12">
                    <div class="col-md-12">
                        <a href="<?= base_url('job/billing/').$jobs_data->job_unique_id; ?>">
                            <button type="button" class="btn btn-primary">
                                <span class="fa fa-money"></span> Pay Now
                            </button>
                        </a>

                        <a href="<?= base_url('job/send_customer_invoice_email/').$jobs_data->job_unique_id; ?>" class="btn btn-primary">
                            <span class="fa fa-paper-plane-o"></span> Send Invoice
                        </a>
                    </div>
                </div>
                <br>
                <div class="modal-footer">
                    <button type="button" id="" class="btn btn-default" data-bs-dismiss="modal">
                        <span class="fa fa-remove"></span> Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .dataTables_empty{
        display: none;
    }

</style>
<?php
// JS to add only Job module
add_footer_js(array(
    'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
    'https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js',
    'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
    'https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js',
    'assets/textEditor/summernote-bs4.js',
    'assets/js/esign/docusign/workorder.js',
    'assets/js/esign/jobs/esign.js',
));
?>
<?php include viewPath('v2/includes/footer'); ?>
<link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?= google_credentials()['api_key'] ?>&callback=initialize&libraries=&v=weekly"></script>
<script src="https://momentjs.com/downloads/moment-with-locales.js"></script>

<?php include viewPath('v2/pages/job/js/job_new_js'); ?>
<!-- Modals -->


<script>
    $( window ).on( "load", function() {
    var cust_id = <?php echo $customer  ?>;
      fetch('<?= base_url() ?>/job/get_customers', {
                method: 'GET',
            }) .then(response => response.json() ).then(response => {
              var { message, data } = response;
              if(message){
                // for(var x=0; x<data.length;x++){
                //   $('#customer_id').append(
                //         '<option value="'+data[x].first_name+'">'+data[x].first_name+' '+data[x].last_name+'</option>'
                //     );
                // }
                var toAppend = '';
                $.each(data,function(i,o){
                    var selected = '';
                    if(o.prof_id == cust_id){
                        selected = "selected";
                    }
                    //console.log(cust_id);
                    toAppend += '<option '+selected+' value='+o.prof_id+'>'+o.first_name + ' ' + o.last_name +'</option>';
                });
                $('#customer_id').append(toAppend);
              }
            })
    });
  
    $(function(){
        // $('#customer_id').select2({
        //     ajax: {
        //         url: '<?= base_url('autocomplete/_company_customer') ?>',
        //         dataType: 'json',
        //         delay: 250,
        //         data: function (params) {
        //           return {
        //             q: params.term, // search term
        //             page: params.page
        //           };
        //         },
        //         processResults: function (data, params) {
        //           // parse the results into the format expected by Select2
        //           // since we are using custom formatting functions we do not need to
        //           // alter the remote JSON data, except to indicate that infinite
        //           // scrolling can be used
        //           params.page = params.page || 1;

        //           return {
        //             results: data
        //             // pagination: {
        //             //   more: (params.page * 30) < data.total_count
        //             // }
        //           };
        //         },
        //         cache: true
        //       },
        //       placeholder: 'Select Customer',
        //       minimumInputLength: 0,
        //       templateResult: formatRepoCustomer,
        //       templateSelection: formatRepoCustomerSelection
        // });

        function formatRepoCustomerSelection(repo) {
            if( repo.first_name != null ){
                return repo.first_name + ' ' + repo.last_name;      
            }else{
                return repo.text;
            }
          
        }

        function formatRepoCustomer(repo) {
          if (repo.loading) {
            return repo.text;
          }

          var $container = $(
            '<div>'+repo.first_name + ' ' + repo.last_name +'<br /><small>'+repo.phone_h+' / '+repo.email+'</small></div>'
          );

          return $container;
        }

        $("#employee_id").select2({
            placeholder: "Select Employee"
        });
        $("#sales_rep").select2({
            placeholder: "Sales Rep"
        });
        $("#priority").select2({
            placeholder: ""
        });

        <?php if( $default_customer_id > 0 ){ ?>
            $('#customer_id').click();
            load_customer_data('<?= $default_customer_id; ?>');
        <?php } ?>
    });

    var geocoder;
    function initMap(address=null) {
        if(address == null){
            address = '6866 Pine Forest Rd Pensacola FL 32526';
        }
        const myLatLng = { lat: -25.363, lng: 131.044 };
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 12,
            height:220,
            center: myLatLng,
        });
        new google.maps.Marker({
            position: myLatLng,
            map,
            title: "Hello World!",
        });
        geocoder = new google.maps.Geocoder();
        codeAddress(geocoder, map,address);
    }

    function codeAddress(geocoder, map,address) {
        geocoder.geocode({'address': address}, function(results, status) {
            if (status === 'OK') {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });
            } else {
                console.log(status);
                console.log('Geocode was not successful for the following reason: ' + status);
            }
        });
    }
    $("#jobs_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            if($('#job_color_id').val()=== ""){
                error('Sorry!','Event Color is required!','warning');
            }else{
                var form = $(this);
                const $overlay = document.getElementById('overlay');
 
                var url = form.attr('action');
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>/job/save_job",
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data) {
                        if ($overlay) $overlay.style.display = "none";
                        sucess_add_job(data);
                    }, beforeSend: function() {
                        if ($overlay) $overlay.style.display = "flex";
                    }
                });
            }
        });
    $(document).ready(function() {
        
        function sucess_add_job(){
            Swal.fire({
                title: 'Nice!',
                text: 'Job has been added!',
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#32243d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value) {
                    window.location.href='<?= base_url(); ?>job/';
                }
            });
        }
        function error(title,text,icon){
            Swal.fire({
                title: title,
                text: text,
                icon: icon,
                showCancelButton: false,
                confirmButtonColor: '#32243d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
            }).then((result) => {

            });
        }
        $("#fill_esign_btn").click(function () {
            $.ajax({
                type: "GET",
                url: "<?= base_url() ?>/job/get_esign_template",
                success: function(data)
                {
                    var template_data = JSON.parse(data);
                    var toAppend = '';
                    $.each(template_data,function(i,o){
                        toAppend += '<option value='+o.esignLibraryTemplateId+'>'+o.title+'</option>';
                    });
                    $('#library_template').append(toAppend);
                    //console.log(template_data);
                }
            });
        });

        $(".estimate_select").click(function () {
            var idd = this.id;
            $('#customer_id').empty().append('<option value="">Select Existing Customer</option>');
            get_customers(idd);
        });

        $(".workorder_select").click(function () {
            window.location.href='<?= base_url(); ?>job/work_order_job/'+this.id;
            //$('#customer_id').empty().append('<option value="">Select Existing Customer</option>');
            //get_customers(idd);
        });

        $(".invoice_select").click(function () {
            var idd = this.id;
            $('#customer_id').empty().append('<option value="">Select Existing Customer</option>');
            get_customers(idd);
        });

        $(".select_item").click(function () {
            var idd = this.id;
            console.log(idd);
            console.log($(this).data('itemname'));
            var title = $(this).data('itemname');
            var price = $(this).data('price');
            var qty = $(this).data('quantity');
            var item_type = $(this).data('item_type');

            var total_ = price * qty;
            var total = parseFloat(total_).toFixed(2);
            var withCommas = Number(total).toLocaleString('en');
            console.log(total);
            markup = "<tr id=\"ss\">" +
                "<td width=\"35%\"><small>Item name</small><input readonly value='"+title+"' type=\"text\" name=\"item_name[]\" class=\"form-control\" ><input type=\"hidden\" value='"+idd+"' name=\"item_id[]\"></td>\n" +
                "<td width=\"10%\"><small>Qty</small><input min=\"1\" data-itemid='"+idd+"' id='"+idd+"' value='"+qty+"' type=\"number\" name=\"item_qty[]\" class=\"form-control qty\" maxlength=\"1\"></td>\n" +
                "<td width=\"20%\"><small>Unit Price</small><input readonly id='price"+idd+"' value='"+price+"'  type=\"number\" name=\"item_price[]\" class=\"form-control\" placeholder=\"Unit Price\"></td>\n" +
                "<td width=\"20%\"><small>Item Type</small><input readonly type=\"text\" class=\"form-control\" value='"+item_type+"'></td>\n" +
                //"<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
                "<td  style=\"text-align: center;margin-top: 20px;\" class=\"d-flex\" width=\"15%\"><b style=\"font-size: 16px;\" data-subtotal='"+total_+"' id='sub_total"+idd+"' class=\"total_per_item\">"+total+"</b></td>" +
                "<td width=\"20%\"><button style=\"margin-top: 20px;\" type=\"button\" class=\"btn btn-primary btn-sm items_remove_btn remove_item_row\"><span class=\"fa fa-trash-o\"></span></button></td>\n" +
                "</tr>";
            tableBody = $("#jobs_items");
            tableBody.append(markup);
            markup2 = "<tr id=\"sss\">" +
                "<td >"+title+"</td>\n" +
                "<td >0</td>\n" +
                "<td >"+price+"</td>\n" +
                "<td id='device_qty"+idd+"'>"+qty+"</td>\n" +
                "<td id='device_sub_total"+idd+"'>"+total+"</td>\n" +
                "<td ></td>\n" +
                "<td ><a href=\"#\" data-name='"+title+"' data-price='"+price+"' data-quantity='"+qty+"' id='"+idd+"' class=\"edit_item_list\"><span class=\"fa fa-edit\"></span></a> </td>\n" + // <a href="javascript:void(0)" class="remove_audit_item_row"><span class="fa fa-trash"></span></i></a>
                "</tr>";
            tableBody2 = $("#device_audit_datas");
            tableBody2.append(markup2);
            calculate_subtotal();
        });

        function calculate_subtotal(tax=0){
            var subtotal = 0 ;
            $('.total_per_item').each(function(index) {
                var idd = $(this).data('subtotal');
                // var idd = this.id;
                subtotal = Number(subtotal) + Number(idd);
            });
            var total = parseFloat(subtotal).toFixed(2);
            var tax_total=0;
            if(tax !== 0 || tax !== ''){
                tax_total = Number(total) *  Number(tax);
                total = Number(total) - Number(tax_total);
                total = parseFloat(total).toFixed(2);
                tax_total =  parseFloat(tax_total).toFixed(2);
                var tax_with_comma = Number(tax_total).toLocaleString('en');
                $('#invoice_tax_total').html('$' + tax_with_comma);
            }
            var withCommas = Number(total).toLocaleString('en');
            if(tax_total < 1){
                $('#invoice_sub_total').html('$' + formatNumber(parseFloat(total).toFixed(2)));
            }
            $('#invoice_overall_total').html('$' + formatNumber(parseFloat(total).toFixed(2)));
            $('#pay_amount').val(withCommas);
            $('#total_amount').val(total);
        }
        //$(".color-scheme").on( 'click', function () {});
        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        }
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
        }
        // get the changed quantity of each item on item list and multiply it to the cost and put in subtotal
        $("body").delegate(".qty", "keyup", function(){
            //console.log( "Handler for .keyup() called." );
            var id = this.id;
            var qty=this.value;
            var cost = $('#price'+id).val();
            var new_sub_total = Number(qty) * Number(cost);
            $('#sub_total'+id).data('subtotal',new_sub_total);
            $('#sub_total'+id).text('$' + formatNumber(parseFloat(new_sub_total).toFixed(2)));
            $('#device_sub_total'+id).text('$' + formatNumber(parseFloat(new_sub_total).toFixed(2)));
            $('#device_qty'+id).text(qty);
            calculate_subtotal();
        });

        $("body").delegate(".qty", "change", function(){
            //console.log( "Handler for .keyup() called." );
            var id = this.id;
            var qty=this.value;
            var cost = $('#price'+id).val();
            var new_sub_total = Number(qty) * Number(cost);
            $('#sub_total'+id).data('subtotal',new_sub_total);
            $('#sub_total'+id).text('$' + formatNumber(parseFloat(new_sub_total).toFixed(2)));
            $('#device_sub_total'+id).text('$' + formatNumber(parseFloat(new_sub_total).toFixed(2)));
            $('#device_qty'+id).text(qty);
            calculate_subtotal();
        });

        $("body").delegate(".remove_item_row", "click", function(){
            $(this).parent().parent().remove();
            calculate_subtotal();
        });

        $("body").delegate(".remove_audit_item_row", "click", function(){
            $(this).parent().parent().remove();
            calculate_subtotal();
        });

        $("body").delegate(".color-scheme", "click", function(){
            var id = this.id;
            $('[id="job_color_id"]').val(id);
            console.log(id);
            $( "#"+id ).append( "<i class=\"bx bxs-calendar calendar_button\" aria-hidden=\"true\"></i>" );
            remove_others(id);
        });

        $("body").delegate(".edit_item_list", "click", function(){
            var id = this.id;
            var node = document.getElementById('device_qty'+id);
            var qty = node.textContent;
            $('#new_items').modal('show');
            $('#item_details_name').val($(this).data('name'));
            $('#item_details_qty').val(qty);
            $('#item_details_cost').val($(this).data('price'));
            $('#item_details_title').html('Edit Points and Location');
            load_item_location(id);
            load_item(id);

        });

        function load_item(id){
            $.ajax({
                type: "POST",
                data: {id : id},
                url: "<?= base_url() ?>/job/get_selected_item",
                success: function(data){
                    var template_data = JSON.parse(data);
                    $('#description').val(template_data.description);
                    $('#brand').val(template_data.brand);
                    console.log(template_data);
                }
            });
        }

        function load_item_location(id){
            $.ajax({
                type: "POST",
                data: {id : id},
                url: "<?= base_url() ?>/job/get_item_storage_location",
                success: function(data){
                    var template_data = JSON.parse(data);
                    var toAppend = '';
                    $.each(template_data,function(i,o){
                        toAppend += '<option value='+o.name+'>'+o.name + ' - ' + o.qty +'</option>';
                    });
                    $('#item_location').append(toAppend);
                }
            });
        }

        // get the tax value and deduct it to subtotal then display over all total
        $("#tax_rate").on( 'change', function () {
            var tax = this.value;
            calculate_subtotal(tax);
        });

        // get the tax value and deduct it to subtotal then display over all total

        function remove_others (color_id){
            $('.color-scheme').each(function(index) {
                var idd = this.id;
                if(idd !== color_id){
                    $( "#"+idd ).empty();
                }
            });
        }

        $("#library_template").on( 'change', function () {
            var lib_id = this.value;
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>/job/get_esign_selected",
                data: {id : lib_id}, // serializes the form's elements.
                success: function(data)
                {
                    var template_data = JSON.parse(data);
                    $('#summernote').summernote('code', template_data.content);
                    //console.log(data);
                }
            });
        });


        $("#job_tags").on( 'change', function () {
            var tag_id = this.value;
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>/job/get_tag_selected",
                data: {id : tag_id}, // serializes the form's elements.
                success: function(data)
                {
                    var template_data = JSON.parse(data);
                    $('#job_tags_right').val(template_data.name);
                    //console.log(data);
                }
            });
        });

        $("#start_time").on( 'change', function () {
            var tag_id = this.value;
            console.log(tag_id);
            var end_time = moment.utc(tag_id,'hh:mm a').add(<?= $settings['job_time_setting']; ?>,'hour').format('h:mm a');

            if(end_time === 'Invalid date') {
                $('#end_time').val("");
            }else{
               $('#end_time').val(end_time);
            }
            console.log(end_time);
        });

        $("#job_type_option").on( 'change', function () {
            var type = this.value;
            $('#job_type').val(type);
        });

        //$('#summernote').summernote('code', '');
        $('#summernote').summernote({
            placeholder: 'Type Here ... ',
            tabsize: 2,
            height: 250,
        });
        var signaturePad = new SignaturePad(document.getElementById('signature-pad'));
        $('#click').click(function(e){
            e.preventDefault();
            var data = signaturePad.toDataURL('image/png');
            $('#output').val(data);
            var url = '<?= base_url() ?>/job/save_esign';
            $.ajax({
                url: url,
                type: "POST",
                data:{base64: data}
            }).done(function(e){
                //$('#updateSignature').modal('hide');
                var name = $('#authorizer_name').val();
                $('#authorizer').html(name);
                $('#appoval_name_right').html(name);
                $('#date_signed').html(e);
                $('#datetime_signed').val(e);
                $('#name').val(name);
                $('#signature_link').val(data);
                $("#customer-signature").attr("src",data);
                $("#customer_signature_right").attr("src",data);
                //location.reload();
            });
        });

        $('#clear-signature').click(function(e){
            signaturePad.clear();
        });

        <?php if(isset($jobs_data) && $jobs_data->status == 'Started') : ?>
            document.getElementById('check_form').style.display = "none";
            document.getElementById('cash_form').style.display = "none";
            document.getElementById('ach_form').style.display = "none";
            document.getElementById('others_warranty_form').style.display = "none";
            document.getElementById('svp_form').style.display = "none";
        <?php endif; ?>

        $("#pay_method").on( 'change', function () {
            var method = this.value;
            if(method === 'CHECK'){
                document.getElementById('check_form').style.display = "block";
                document.getElementById('credit_card_form').style.display = "none";
                document.getElementById('cash_form').style.display = "none";
                document.getElementById('ach_form').style.display = "none";
                document.getElementById('others_warranty_form').style.display = "none";
                document.getElementById('svp_form').style.display = "none";
            }else if(method === 'CC'|| method === 'OCCP'){
                document.getElementById('check_form').style.display = "none";
                document.getElementById('credit_card_form').style.display = "block";
                document.getElementById('cash_form').style.display = "none";
                document.getElementById('ach_form').style.display = "none";
                document.getElementById('others_warranty_form').style.display = "none";
                document.getElementById('svp_form').style.display = "none";
            }else if(method === 'CASH'){
                document.getElementById('check_form').style.display = "none";
                document.getElementById('credit_card_form').style.display = "none";
                document.getElementById('cash_form').style.display = "block";
                document.getElementById('ach_form').style.display = "none";
                document.getElementById('others_warranty_form').style.display = "none";
                document.getElementById('svp_form').style.display = "none";
            }else if(method === 'ACH'){
                document.getElementById('check_form').style.display = "none";
                document.getElementById('credit_card_form').style.display = "none";
                document.getElementById('cash_form').style.display = "none";
                document.getElementById('ach_form').style.display = "block";
                document.getElementById('others_warranty_form').style.display = "none";
                document.getElementById('svp_form').style.display = "none";
            }else if(method === 'OPT' || method === 'WW'){
                document.getElementById('check_form').style.display = "none";
                document.getElementById('credit_card_form').style.display = "none";
                document.getElementById('cash_form').style.display = "none";
                document.getElementById('ach_form').style.display = "none";
                document.getElementById('others_warranty_form').style.display = "block";
                document.getElementById('svp_form').style.display = "none";
            }
            else if(method === 'SQ' || method === 'PP' || method === 'VENMO'){
                document.getElementById('check_form').style.display = "none";
                document.getElementById('credit_card_form').style.display = "none";
                document.getElementById('cash_form').style.display = "none";
                document.getElementById('ach_form').style.display = "none";
                document.getElementById('others_warranty_form').style.display = "none";
                document.getElementById('svp_form').style.display = "block";
            }
        });

        $("#save_payment").on( "click", function( event ) {
            $('#pay_method_right').html($('#pay_method').val());
            $('#pay_amount_right').html($('#pay_amount').val());
        });
        $("#approval_btn_left").on( "click", function( event ) {
            document.getElementById('approval_card_right').style.display = "block";
            document.getElementById('approval_card_left').style.display = "none";
        });

        $("#approval_btn_right").on( "click", function( event ) {
            document.getElementById('approval_card_left').style.display = "block";
            document.getElementById('approval_card_right').style.display = "none";
        });

        $("#pd_left").on( "click", function( event ) {
            document.getElementById('pd_right_card').style.display = "block";
            document.getElementById('pd_left_card').style.display = "none";
        });

        $("#pd_right").on( "click", function( event ) {
            document.getElementById('pd_left_card').style.display = "block";
            document.getElementById('pd_right_card').style.display = "none";
        });

        $("#notes_edit_btn_right").on( "click", function( event ) {
            document.getElementById('notes_input_div_right').style.display = "block";
            document.getElementById('notes_edit_btn_right').style.display = "none";
        });

        $("#notes_edit_btn").on( "click", function( event ) {
            document.getElementById('notes_input_div').style.display = "block";
            document.getElementById('notes_edit_btn').style.display = "none";
        });

        $("#edit_note").on( "click", function( event ) {
            document.getElementById('notes_edit_btn').style.display = "none";
            document.getElementById('notes_input_div').style.display = "block";
        });

        $("#edit_note_right").on( "click", function( event ) {
            document.getElementById('notes_edit_btn_right').style.display = "none";
            document.getElementById('notes_input_div_right').style.display = "block";
        });

        $("#notes_left").on( "click", function( event ) {
            document.getElementById('notes_left_card').style.display = "none";
            document.getElementById('notes_right_card').style.display = "block";
        });

        $("#notes_right").on( "click", function( event ) {
            document.getElementById('notes_right_card').style.display = "none";
            document.getElementById('notes_left_card').style.display = "block";
        });

        $("#url_left_btn_column").on( "click", function( event ) {
            document.getElementById('url_left_card').style.display = "none";
            document.getElementById('url_right_card').style.display = "block";
        });

        $("#url_right_btn_column").on( "click", function( event ) {
            document.getElementById('url_right_card').style.display = "none";
            document.getElementById('url_left_card').style.display = "block";
        });

        $("#attach_right_btn_column").on( "click", function( event ) {
            document.getElementById('attach_right_card').style.display = "none";
            document.getElementById('attach_left_card').style.display = "block";
        });

        $("#attach_left_btn_column").on( "click", function( event ) {
            document.getElementById('attach_left_card').style.display = "none";
            document.getElementById('attach_right_card').style.display = "block";
        });

        $("#attachment-file").change(function(){
            console.log("A file has been selected.");
            // var form = $('form')[0]; // You need to use standard javascript object here
            // var formData = new FormData(form);
            // var form = $('#upload_library_form').serialize();
            // var formData = new FormData($(form)[0]);
            var input = document.getElementById('attachment-file');
            //  console.log(formData);
            // console.log(input.files);
            // for (var i = 0; i < input.files.length; i++) {
            //     console.log(input.files[i]);
            // }
            // The Javascript
            var fileInput = document.getElementById('attachment-file');
            var file = fileInput.files[0];
            var formDatas = new FormData();
            formDatas.append('file', file);
            //console.log(formDatas);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "<?= base_url() ?>/job/add_job_attachments",
                data: formDatas,
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function() {

                },
                success: function (data) {
                    $('#attachment').val('/'+data);
                    $("#attachment-image").attr("src",'/'+data);
                },
                error: function (e) {
                    //$("#result").text(e.responseText);
                    console.log("ERROR : ", e);
                    // $("#btnSubmit").prop("disabled", false);
                }
            });
        });

        $("#save_memo").on( "click", function( event ) {
            var note = $('#note_txt').val();
            $('#notes_edit_btn').text(note);
            $('#note_txt').text(note);

            // update right box note
            $('#note_txt_right').text(note);
            $('#notes_edit_btn_right').text(note);

            document.getElementById('notes_input_div').style.display = "none";
            document.getElementById('notes_edit_btn').style.display = "block";
        });

        $("#save_memo_right").on( "click", function( event ) {
            var note = $('#note_txt_right').val();
            $('#notes_edit_btn_right').text(note);
            $('#notes_right_display_right').text(note);
            $('#note_txt_right').text(note);

            // update left box note
            $('#notes_edit_btn').text(note);
            $('#note_txt').text(note);

            document.getElementById('notes_input_div_right').style.display = "none";
            document.getElementById('notes_edit_btn_right').style.display = "block";
        });

        $("#fillAndSignNext").on( "click", function( event ) {
            return; // moved implementation to script.js@onClickNext

            console.log('fsdfd');
            var formData = {
                'status': $(this).data('status'),
                'id': $(this).data('id'),
            };
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>/job/update_jobs_status",
                data: formData, // serializes the form's elements.
                //dataType : 'json',
                //encode : true,
                success: function(data)
                {
                    console.log(data);
                    if(data === "Success"){
                        sucess_add('Job is now Approved!',1);
                    }else {
                        warning('There is an error adding Customer. Contact Administrator!');
                        console.log(data);
                    }
                },
                error : function(data) {
                    console.log(data);
                }
            });
        });

        $("#new_customer_form").submit(function(e) {
            //alert("asf");
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "/customer/add_new_customer_from_jobs",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data === "Success"){
                        sucess_add('Customer Added Successfully!',1);
                    }else {
                        warning('There is an error adding Customer. Contact Administrator!');
                        console.log(data);
                    }
                }
            });
        });

        $("#update_status_to_omw").submit(function(e) {
            //alert("asf");
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var omw_date = $('#omw_date').val();
            var omw_time = $('#omw_time').val();
            let status = $('#status').val();
            var id = $('#jobid').val();

            const fd = new FormData();
            fd.append('id', id);
            fd.append('omw_date', omw_date);
            fd.append('omw_time', omw_time);
            fd.append('status', status);

            fetch('<?= base_url('job/update_jobs_status') ?>',{
                method: 'post',
                body: fd
            }).then(response => response.json()).then(response => {
                console.log(response);
            }).catch((error) => {
                console.log(error);
            })
        });

        $("#update_status_to_started").submit(function(e) {
            //alert("asf");
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            var job_start_date = $('#job_start_date').val();
            var job_start_time = $('#job_start_time').val();
            var status = $('#start_status').val();
            var id = $('#jobid').val();
            console.log(status);
            const fd = new FormData();
            fd.append('id', id);
            fd.append('job_start_date', job_start_date);
            fd.append('job_start_time', job_start_time);
            fd.append('status', status);

            fetch('<?= base_url('job/update_jobs_status') ?>',{
                method: 'post',
                body: fd
            }).then(response => response.json()).then(response => {
                console.log(response);
            }).catch((error) => {
                console.log(error);
            })
            //var url = form.attr('action');
        });

        function sucess_add(information,is_reload){
            Swal.fire({
                title: 'Good job!',
                text: information,
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#32243d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if(is_reload === 1){
                    if (result.value) {
                        window.location.reload();
                    }
                }
            });
        }

        function warning(information){
            Swal.fire({
                title: 'Warning!',
                text: information,
                icon: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#32243d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
            }).then((result) => {

            });
        }

        $("#customer_id").on( 'change', function () {
            var customer_selected = this.value;
            //console.log(customer_selected);
            if(customer_selected !== ""){
                load_customer_data(customer_selected);
            }else{
                $('#cust_fullname').text('xxxxx xxxxx');
                $('#cust_address').text('-------------');
                $('#cust_number').text('(xxx) xxx-xxxx');
                $('#cust_email').text('xxxxx@xxxxx.xxx');
                initMap();
            }
        });

        function get_employee_name($this){
            //console.log($this.value);
            $.ajax({
                type: "POST",
                data: {id : $this.value},
                url: "<?= base_url() ?>/events/get_employee_selected",
                success: function(data){
                    var emp_data = JSON.parse(data);
                    if($this.id === 'employee2' ){
                        $('#emp2_id').val(emp_data.FName);
                    }else if($this.id === 'employee3' ){
                        $('#emp3_id').val(emp_data.FName);
                    }else if($this.id === 'employee4' ){
                        $('#emp4_id').val(emp_data.FName);
                    }
                    console.log(emp_data);
                }
            });
        }

        $(".step02").click(function () {
            $("#line-progress").css("width", "12.5%");
        });

        $(".step03").click(function () {
            $("#line-progress").css("width", "25%");
        });
        $(".step04").click(function () {
            $("#line-progress").css("width", "37.5%");
        });
        $(".step05").click(function () {
            $("#line-progress").css("width", "50%");
        });
        $("#employee2").on( 'change', function () {
            $('#employee2_id').val(this.value);
            console.log(get_employee_name(this));
        });
        $("#employee3").on( 'change', function () {
            $('#employee3_id').val(this.value);
            console.log(get_employee_name(this));
        });
        $("#employee4").on( 'change', function () {
            $('#employee4_id').val(this.value);
            console.log(get_employee_name(this));
        });

        $("#start_date").on("change", function(){
            $('#end_date').val(this.value);
        });

        $('#items_table').DataTable({
            "lengthChange": false,
            "searching" : true,
            "pageLength": 5,
            "order": [],
        });

        $('#device_audit').DataTable({
            "lengthChange": false,
            "searching" : false,
            "pageLength": 5,
            "paging" : false,
            "order": [],
        });

        $('#estimates_table').DataTable({
            "lengthChange": false,
            "searching" : true,
            "pageLength": 10,
            "order": [],
        });

        $('#workorder_table').DataTable({
            "lengthChange": false,
            "searching" : true,
            "pageLength": 10,
            "order": [],
        });

        $('#invoices_table').DataTable({
            "lengthChange": false,
            "searching" : true,
            "pageLength": 10,
            "order": [],
        });

    });
</script>