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
<?php if(!isset($jobs_data)): ?>
    <!-- autosave only when creating -->
    <!-- disable autosave, because we want to handle form submit - send SMS to employeee -->
    <!-- <script src="<?=base_url("assets/js/jobs/autosave.js")?>"></script> -->
<?php endif; ?>
<style>
    /*.nsm-table {
        display: none;
    }*/

    .nsm-badge.primary-enhanced {
        background-color: #6a4a86;
    }

    div[wrapper__section] {
        padding: 60px 10px !important;
    }

    .card_plus_sign {
        float: right;
        padding-right: 40px;
        font-size: 20px;
        display: block;
        margin-top: -38px;
    }

    .box_footer_icon {
        font-size: 20px;
    }

    .box_right {
        border-color: #e0e0e0 !important;
        border: 1px solid;
    }

    .card {
        /*box-shadow: 0 0 13px 0 rgb(116 116 117 / 44%) !important;*/
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

    .card_header {
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

    .calendar_button {
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

    .table-hover tbody tr:hover,
    .table-striped tbody tr:nth-of-type(odd),
    .thead-default th {
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

    .modal {
        z-index: 999999 !important;
    }

    .a-bold {
        color: black !important;
    }

    .items-8 li a {
        color: #bebebe;
        text-decoration: none !important;
    }

    #emp2_id,
    #emp3_id,
    #emp4_id,
    #emp5_id,
    #emp6_id {
        background: none;
        border: 0;
        font-weight: bold;
    }

    .loader {
        padding: 136px 0;
/*        border: 1px solid lightgray; */
/*        border-radius: 10px;*/
    }

    .loader>div {
        width: 25px;
        height: 25px;
    }

    .loader>span {
        vertical-align: super;
        margin-left: 10px;                                                        
    }

    #TEMPORARY_MAP_VIEW {
        border: 1px solid lightgray; 
        border-radius: 10px;
    }
    table {
        width: 100% !important;
    }
    .dataTables_filter, .dataTables_length{
        display: none;
    }
    table.dataTable thead th, table.dataTable thead td {
    padding: 10px 18px;
    border-bottom: 1px solid lightgray;
    }
    table.dataTable.no-footer {
         border-bottom: 0px !important; 
         margin-bottom: 10px !important;
    }
    tbody, td, tfoot, th, thead, tr {
        border-color: inherit;
        border-style: solid;
        border-color: lightgray;
        border-width: 0;
    }
</style>
<?php if(isset($jobs_data)): ?>
    <input type="hidden" value="<?= $jobs_data->id ?>" id="esignJobId" />
    <input type="hidden" value="<?= $jobs_data->status ?>" id="esignJobStatus" />
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
                <input type="hidden" id="redirect-calendar" value="<?= $redirect_calendar; ?>">
                <input type="hidden" name="work_order_id" value="<?= isset($jobs_data) ? $jobs_data->id : "" ?>">
                <div class="row g-3 align-items-start">
                    <div class="col-12 ">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="nsm-card primary">
                                    <div class="nsm-card-header d-block">
                                        <div class="nsm-card-title"><span><i class='bx bx-time'></i>&nbsp;From Work Order to Job</span></div>
                                    </div>
                                    <hr>
                                    <div class="nsm-card-content">
                                        <!-- <h6 class="page-title "><span style="font-size: 20px;"  class="fa fa-calendar"></span>&nbsp; &nbsp;Schedule Job</h6> -->
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
                                            <div class="row g-3 align-items-center mb-3">
                                              <div class="col-sm-2">
                                                <label>From:</label>
                                              </div>
                                              <div class="col-sm-5">
                                                <input type="date" name="start_date" id="start_date" class="form-control" value="<?= isset($jobs_data) ?  $jobs_data->date_issued : ''; ?>" required>
                                              </div>
                                              <div class="col-sm-5">
                                                  <?php if( isset($jobs_data) ){ $default_start_time = strtolower($jobs_data->start_time); } ?>
                                                    <select id="start_time" name="start_time" class="nsm-field form-select" required>
                                                        <option value="">Start time</option>
                                                        <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                                            <option <?= isset($jobs_data) && strtolower($jobs_data->start_time) == time_availability($x) ?  'selected' : '';  ?> value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                                                        <?php } ?>
                                                    </select>
                                              </div>
                                            </div>
                                            <div class="row g-3 align-items-center">
                                              <div class="col-sm-2">
                                                <label>To:</label>
                                              </div>
                                              <div class="col-sm-5">
                                                <input type="date" name="end_date" id="end_date" class="form-control mr-2" value="<?= isset($jobs_data) ?  $jobs_data->date_issued : ''; ?>" required>
                                              </div>
                                              <div class="col-sm-5">
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
                                        <h6>Sales Rep</h6>
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
                                                            <a style="background-color: <?= $color->color_code; ?>; border-radius: 0px;border: 1px solid black;margin-bottom: 4px;" id="<?= $color->id; ?>" type="button" class="btn btn-default color-scheme btn-circle bg-1" title="<?= $color->color_name; ?>">
                                                                <?php if(isset($jobs_data) && $jobs_data->event_color == $color->id) {echo '<i class="bx bx-check calendar_button" aria-hidden="true"></i>'; } ?>
                                                            </a>
                                                        </li>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </ul>
                                            <input value="<?= (isset($jobs_data) && $jobs_data->event_color == $color->id) ? $jobs_data->event_color : ''; ?>" id="job_color_id" name="event_color" type="hidden" />
                                        </div>
                                        <div class="mb-3">
                                            <h6>Customer Reminder Notification</h6>
                                            <select id="customer_reminder" name="customer_reminder_notification" class="form-control ">
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
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <h6>Time Zone</h6>
                                            <select id="inputState" name="timezone" class="form-control ">
                                                <option value="utc5">Central Time (UTC -5)</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between">
                                                <h6>Select Job Type</h6>
                                                <a class="nsm-link d-flex align-items-center" target="_blank" href="<?= base_url('job/job_types'); ?>">
                                                    <span class="bx bx-plus"></span>Manage Job Types
                                                </a>
                                            </div>
                                            <select id="job_type_option" name="jobtypes" class="form-control " required>
                                                <option value="">Select Type</option>
                                                <?php if(!empty($job_types)): ?>
                                                    <?php foreach ($job_types as $type): ?>
                                                        <option <?php if(isset($jobs_data) && $jobs_data->job_type == $type->title) {echo 'selected'; } ?> value="<?= $type->title; ?>" data-image="<?= $type->icon_marker; ?>"><?= $type->title; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between">
                                                <h6>Select Job Tag</h6>
                                                <a class="nsm-link d-flex align-items-center" target="_blank" href="<?= base_url('job/job_tags'); ?>">
                                                    <span class="bx bx-plus"></span>Manage Job Tags
                                                </a>
                                            </div>
                                            <select id="job_tags" name="tags" class="form-control " required>
                                                <option value="">Select Tags</option>
                                                <?php if(!empty($tags)): ?>
                                                    <?php foreach ($tags as $tag): ?>
                                                        <option <?php if(isset($jobs_data) && $jobs_data->job_tags == $tag->id) {echo 'selected'; } ?> value="<?= $tag->id; ?>" data-image="<?= $tag->marker_icon; ?>"><?= $tag->name; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <div>
                                            <h6>Assigned To</h6>
                                            <div class="row">
                                                <div class="col-sm-12 mb-2 ASSIGNED_TO_1">
                                                    <input type="text" id="emp2_id" name="emp2_id" value= "<?php if(isset($jobs_data) && !empty($jobs_data->employee2_id)){ echo $jobs_data->employee2_id; } ?>" hidden>
                                                    <select id="EMPLOYEE_SELECT_2" name="employee2_" class="form-control">
                                                        <option value="">Select Employee</option>
                                                        <?php if(!empty($employees)): ?>
                                                            <?php foreach ($employees as $employee): ?>
                                                                <option <?php if(isset($jobs_data) && $jobs_data->employee2_id == $employee->id) {echo 'selected'; } ?> value="<?= $employee->id; ?>"><?= $employee->LName.','.$employee->FName; ?></option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-12 mb-2 ASSIGNED_TO_2">
                                                    <input type="text" id="emp3_id" name="emp3_id" value= "<?php if(isset($jobs_data) && !empty($jobs_data->employee3_id)){ echo $jobs_data->employee3_id; } ?>" hidden>
                                                    <select id="EMPLOYEE_SELECT_3" name="employee3_" class="form-control">
                                                        <option value="">Select Employee</option>
                                                        <?php if(!empty($employees)): ?>
                                                            <?php foreach ($employees as $employee): ?>
                                                                <option <?php if(isset($jobs_data) && $jobs_data->employee3_id == $employee->id) {echo 'selected'; } ?> value="<?= $employee->id; ?>"><?= $employee->LName.','.$employee->FName; ?></option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-12 mb-2 ASSIGNED_TO_3">
                                                    <input type="text" id="emp4_id" name="emp4_id" value= "<?php if(isset($jobs_data) && !empty($jobs_data->employee4_id)){ echo $jobs_data->employee4_id; } ?>" hidden>
                                                    <select id="EMPLOYEE_SELECT_4" name="employee4_" class="form-control">
                                                        <option value="">Select Employee</option>
                                                        <?php if(!empty($employees)): ?>
                                                            <?php foreach ($employees as $employee): ?>
                                                                <option <?php if(isset($jobs_data) && $jobs_data->employee4_id == $employee->id) {echo 'selected'; } ?> value="<?= $employee->id; ?>"><?= $employee->LName.','.$employee->FName; ?></option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-12 mb-2 ASSIGNED_TO_4">
                                                    <input type="text" id="emp5_id" name="emp5_id" value= "<?php if(isset($jobs_data) && !empty($jobs_data->employee5_id)){ echo $jobs_data->employee5_id; } ?>" hidden>
                                                    <select id="EMPLOYEE_SELECT_5" name="employee5_" class="form-control">
                                                        <option value="">Select Employee</option>
                                                        <?php if(!empty($employees)): ?>
                                                            <?php foreach ($employees as $employee): ?>
                                                                <option <?php if(isset($jobs_data) && $jobs_data->employee5_id == $employee->id) {echo 'selected'; } ?> value="<?= $employee->id; ?>"><?= $employee->LName.','.$employee->FName; ?></option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-12 mb-2 ASSIGNED_TO_5">
                                                    <input type="text" id="emp6_id" name="emp6_id" value= "<?php if(isset($jobs_data) && !empty($jobs_data->employee6_id)){ echo $jobs_data->employee6_id; } ?>" hidden>
                                                    <select id="EMPLOYEE_SELECT_6" name="employee6_" class="form-control">
                                                        <option value="">Select Employee</option>
                                                        <?php if(!empty($employees)): ?>
                                                            <?php foreach ($employees as $employee): ?>
                                                                <option <?php if(isset($jobs_data) && $jobs_data->employee6_id == $employee->id) {echo 'selected'; } ?> value="<?= $employee->id; ?>"><?= $employee->LName.','.$employee->FName; ?></option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="float-end">
                                            <div class="group">
                                                <button class="nsm-button small ADD_ASSIGN_EMPLOYEE" type="button"><i class='bx bx-user-plus'></i>&nbsp;Add</button>
                                                <button class="nsm-button small REMOVE_ASSIGN_EMPLOYEE" type="button"><i class='bx bx-user-minus'></i>&nbsp;Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="nsm-card primary table-custom">
                                    <div class="nsm-card-header d-block">
                                        <div class="nsm-card-title">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <strong>Created By:</strong>&nbsp;<strong style="font-size: 20px;"> <?= ' '.$logged_in_user->FName.' '.$logged_in_user->LName; ?></strong style="font-size: 17px;">
                                                </div>
                                                <div class="col-sm-6">
                                                     <button type="button" id="add_another_invoice" data-bs-toggle="modal" data-bs-target="#new_customer" class="nsm-button primary small text-end" style="float: right;"><i class='bx bx-fw bx-plus'></i><strong>Add New Customer</strong></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>     
                                    <div class="nsm-card-content">
                                        <div class="row">
                                            <hr>
                                            <div class="col-md-5">
                                                <h6>Customer Info</h6>
                                                <select id="customer_id" name="customer_id" data-customer-source="dropdown" class="form-control searchable-dropdown" required>
                                                    <option selected value hidden>- Select Customer -</option>
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
                                            <div class="col-md-7">
                                                <div class="col-md-12">
                                                    <!-- <div id="streetViewBody" class="col-md-6 float-left no-padding"></div> -->
                                                    <!-- <div id="map" class="col-md-6 float-left"></div> -->
                                                    <iframe id="TEMPORARY_MAP_VIEW" height="300" width="100%" style="display: none;"></iframe>
                                                    <div class="text-center MAP_LOADER">
                                                        <div class="loader">
                                                            <div class="spinner-border" role="status"></div>
                                                            <span style="">Loading Map...</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>     <div class="col-md-12">
                                                        <h6>Job Account Number</h6>
                                                        <input value="<?php echo ($jobs_data->job_account_number) ? $jobs_data->job_account_number : ""; ?>" type="text" class="form-control" name="JOB_ACCOUNT_NUMBER">
                                                    </div>                             
                                        <table class="table table-hover d-none">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <small>Job Type</small>
                                                        <input type="text" id="job_type" name="job_type" value="<?= isset($jobs_data) ? $jobs_data->job_type : ''; ?>" class="form-control" readonly>
                                                    </td>
                                                    <td>
                                                        <small>Job Tags</small>
                                                        <input type="text" name="job_tag" class="form-control" value="<?= isset($jobs_data) ? $jobs_data->tags : ''; ?>" id="job_tags_right" readonly>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <small>Description of Job</small>
                                                        <textarea name="job_description_" class="form-control"><?= isset($jobs_data) ? $jobs_data->job_description : ''; ?></textarea>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <hr>     
                                            <div class="col-md-12">
                                                <h6>Description of Job</h6>
                                                <textarea name="job_description" class="form-control" required=""><?= isset($jobs_data) ? $jobs_data->job_description : ''; ?></textarea>
                                            </div>            
                                        <hr />
                                        <h6 class='card_header'>Job Items Listing</h6>
                                        <table class="table table-hover">
                                            <tbody id="jobs_items">
                                            <?php if(isset($jobs_data)): ?>
                                                <?php
                                                    $subtotal = 0.00;
                                                    foreach ($jobs_data_items as $item):
                                                    if( in_array($cid, adi_company_ids()) ){
                                                        //$total = $item->price * $item->qty;
                                                        $total = $item->price;
                                                        $base_price = $item->price / $item->qty;
                                                    }else{
                                                        $total = $item->price * $item->qty;                                                        
                                                        $base_price = $item->price;
                                                    }

                                                ?>
                                                   <tr id=ss>
                                                        <td width="35%"><small>Item name</small>
                                                            <input value="<?= $item->title; ?>" type="text" name="item_name[]" class="form-control" readonly>
                                                            <input type="hidden" value='<?= $item->id ?>' name="item_id[]">
                                                        </td>
                                                        <td><small>Qty</small>
                                                            <input data-itemid='<?= $item->id ?>'  id='<?= $item->id ?>' value='<?= $item->qty; ?>' type="number" name="item_qty[]" class="form-control qty">
                                                        </td>
                                                        <td><small>Unit Price</small>
                                                            <input id='price<?= $item->id ?>' value='<?= $base_price; ?>'  type="number" name="item_price[]" class="form-control" placeholder="Unit Price" readonly>
                                                        </td>
                                                        <!--<td width="10%"><small>Unit Cost</small><input type="text" name="item_cost[]" class="form-control"></td>-->
                                                        <!--<td width="25%"><small>Inventory Location</small><input type="text" name="item_loc[]" class="form-control"></td>-->
                                                        <td><small>Item Type</small><input readonly type="text" class="form-control" value='<?= $item->type ?>'></td>
                                                        <td>
                                                            <small>Amount</small><br>
                                                            <b data-subtotal='<?= $total ?>' id='sub_total<?= $item->id ?>' class="total_per_item">$<?= number_format((float)$total,2,'.',',');?></b>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="nsm-button items_remove_btn remove_item_row mt-2"><i class="bx bx-trash" aria-hidden="true"></i></button>
                                                        </td>
                                                    </tr>
                                                <?php
                                                    $subtotal = $subtotal + $total;
                                                    endforeach;
                                                ?>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                            <button class="nsm-button primary small link-modal-open" type="button" id="add_another_items" data-bs-toggle="modal" data-bs-target="#item_list">
                                                <i class='bx bx-plus'></i>Add Items
                                            </button>
                                        <hr />
                                        <br>
                                        
                                        <div class="col-sm-12">
                                            <input type="text" name="job_number" id="jobNumber" class="form-control" value="<?= isset($jobs_data->job_number) ? $jobs_data->job_number : ''; ?>" hidden>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="file-upload-drag">
                                                        <div class="drop">
                                                            <div class="cont">
                                                                <div class="tit">
                                                                    <?php 
                                                                        $THUMBNAIL_SRC = (isset($jobs_data)) ? $jobs_data->attachment : "";
                                                                        if(isset($jobs_data) && $jobs_data->attachment != "") {
                                                                            $IMG_HIDE_STATUS = "";
                                                                            $SPAN_HIDE_STATUS = "d-none";
                                                                        } else {
                                                                            $IMG_HIDE_STATUS = "d-none";
                                                                            $SPAN_HIDE_STATUS = "";
                                                                        }
                                                                    ?>
                                                                    <input id="attachment-file" name="filetoupload" type="file" accept="image/png, image/jpg, image/jpeg, image/bmp, image/ico"/>
                                                                    <img class="<?= $IMG_HIDE_STATUS; ?> w-100 IMG_PREVIEW" id="attachment-image" alt="Attachment" src="<?= $THUMBNAIL_SRC; ?>">
                                                                    <button class="btn btn-danger btn-sm REMOVE_THUMBNAIL <?= $IMG_HIDE_STATUS; ?>" type="button" style="position: absolute; left: 160px;">Remove</button>
                                                                    <span class="<?= $SPAN_HIDE_STATUS; ?> THUMBNAIL_BOX">
                                                                        <p>Thumbnail</p>
                                                                       <!--  <p class="or-text">Or</p>
                                                                        <p>URL Link</p> -->
                                                                        <i style="color: #0b0b0b;">Upload on Photos/Attachments Box</i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <!-- <img id="dis_image" style="display:none;" src="#" alt="your image" /> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 row pr-0">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label>Subtotal</label>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label id="invoice_sub_total">$<?= isset($jobs_data) ? number_format((float)$subtotal,2,'.',',') : '0.00'; ?></label>
                                                        <input type="hidden" name="sub_total" id="sub_total_form_input" value='0'>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="d-flex justify-content-between">
                                                                <h6>Tax Rate</h6>
                                                                <a class="nsm-link d-flex align-items-center" target="_blank" href="<?= base_url('job/settings'); ?>">
                                                                    <span class="bx bx-plus"></span>Manage Tax Rates
                                                                </a>
                                                            </div>
                                                            <select id="tax_rate" name="tax_rate" class="form-control" data-value="<?= $jobs_data->tax_rate; ?>">
                                                                <option value="">None</option>
                                                                <?php 
                                                                    $SELECTED_TAX = (isset($jobs_data->tax_rate)) ? $jobs_data->tax_rate : '0.00';
                                                                    foreach ($tax_rates as $rate) {
                                                                        if ($SELECTED_TAX == number_format(($rate->percentage / 100) * $subtotal, 2,'.',',') && $SELECTED_TAX != "0.00") {
                                                                            echo "<option selected value='".($rate->percentage / 100)."'>".$rate->name."</option>";
                                                                        } else {
                                                                            echo "<option value='".($rate->percentage / 100)."'>".$rate->name."</option>";
                                                                        }
                                                                    } 
                                                                ?>
                                                            </select>
                                                        </div>                                                      
                                                        <div class="col-sm-6">
                                                            <label id="invoice_tax_total"><?= isset($jobs_data->tax_rate) ? number_format((float)$jobs_data->tax_rate, 2,'.',',') : '0.00'; ?></label>
                                                            <input type="hidden" name="tax" id="tax_total_form_input" value="<?= isset($jobs_data->tax_rate) ? number_format((float)$jobs_data->tax_rate, 2,'.',',') : '0.00'; ?>">
                                                        </div>
                                                    </div>

                                                    <?php if (isset($jobs_data) && $jobs_data->installation_cost): ?>
                                                        <?php $subtotal = $subtotal + $jobs_data->installation_cost; ?>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label>Installation Cost</label>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label>$<?= number_format((float) $jobs_data->installation_cost, 2) ?></label>
                                                                <input id="adjustment_ic" name="installation_cost" type="hidden" value="<?= $jobs_data->installation_cost; ?>">
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if (isset($jobs_data) && $jobs_data->otp_setup): ?>
                                                        <?php $subtotal = $subtotal + $jobs_data->otp_setup; ?>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label>One time (Program and Setup)</label>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label>$<?= number_format((float) $jobs_data->otp_setup, 2) ?></label>
                                                                <input id="adjustment_otps" name="otps" type="hidden" value="<?= $jobs_data->otp_setup; ?>">
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if (isset($jobs_data) && $jobs_data->monthly_monitoring): ?>
                                                        <?php $subtotal = $subtotal + $jobs_data->monthly_monitoring; ?>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label>Monthly Monitoring</label>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label>$<?= number_format((float) $jobs_data->monthly_monitoring, 2) ?></label>
                                                                <input id="adjustment_mm" name="monthly_monitoring" type="hidden" value="<?= $jobs_data->monthly_monitoring; ?>">
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>

                                                    <div class="row">
                                                        <hr>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label><strong>Total</strong></label>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label id="invoice_overall_total"><strong>$<?= isset($jobs_data) ? number_format((float)$subtotal,2,'.',',') : '0.00'; ?></strong></label>
                                                            <input type="hidden" name="total_amount" id="total2" value="<?= isset($jobs_data) ? number_format((float)$subtotal,2,'.',',') : '0'; ?>">
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-sm-6"> -->
                                                        <!-- <small>Tax Rate</small> -->
                                                        <!--<a href="<?= base_url('job/settings') ?>"><span class="fa fa-plus" style="margin-left:50px;"></span></a>-->
                                                    <!-- </div> -->
                                                    <!-- <div class="col-sm-6 text-right pr-3"> -->
                                                    <!-- </div> -->
                                                    <!-- <div class="col-sm-12"> -->
                                                        <!-- <hr> -->
                                                    <!-- </div> -->
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
                                                    <!-- <div class="col-sm-6"> -->
                                                        <!-- <label style="padding: 0 .75rem;">Total</label> -->
                                                    <!-- </div> -->
                                                    <!-- <div class="col-sm-6 text-right pr-3"> -->
                                                        <!-- <label id="invoice_overall_total">$<?= isset($jobs_data) ? number_format((float)$subtotal,2,'.',',') : '0.00'; ?></label> -->
                                                        <!-- <input step="any" type="number" name="total_amount" id="total2test" value="<?= isset($jobs_data) ? number_format((float)$subtotal,2,'.',',') : '0'; ?>" hidden> -->
                                                    <!-- </div> -->
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
                                                <div class="col-sm-12 mb-4">
                                                    <div class="row">
                                                        <div class="col-sm-12 mb-2">
                                                            <h5>Notes</h5>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <?php 
                                                                if (isset($jobs_data)) { 
                                                                    $MESSAGE = "$jobs_data->message"; 
                                                                } else { 
                                                                    $MESSAGE = "Thank you for your business, Please call $company_info->business_name at $company_info->business_phone for quality customer service";                                                                
                                                                } 
                                                            ?>
                                                            <div id="Message_Editor">
                                                                <?= $MESSAGE; ?>
                                                            </div>
                                                            <input class="d-none customer_message_input" name="message" value="<?= $MESSAGE; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-4 <?= (isset($jobs_data) && $jobs_data->link = NULL) ? '' : 'd-none' ?>">
                                                    <div class="row">
                                                        <div class="col-sm-12 mb-2">
                                                            <h5>Url Link</h5>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <?php if(isset($jobs_data) && $jobs_data->link = NULL) { ?>
                                                            <a  target="_blank" href="<?= $jobs_data->link; ?>"><p style="color: darkred;"><?= $jobs_data->link; ?></p></a>
                                                            <?php } else { ?>
                                                            <span class="help help-sm help-block">Enter url link or a pdf link </span> 
                                                            <?php } ?>
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
                                                <div class="col-sm-12"><hr></div>
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

                                                <?php if (isset($jobs_data) && $jobs_data->status != "Scheduled") { ?>
                                                    <style>
                                                        .table-bordered td, .table-bordered th {
                                                            border: 1px solid #dee2e6 !important;
                                                        }
                                                    </style>
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-12 mb-2">
                                                            <h5>Devices Audit</h5>
                                                            <label>Record all Items used on Jobs</label>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <table id="device_audit" class="nsm-table table-bordered w-100">
                                                                <thead class="bg-light">
                                                                    <tr>
                                                                        <!-- <td style="width: 0% !important;"></td> -->
                                                                        <td><strong>Name</strong></td>
                                                                        <td><strong>Type</strong></td>
                                                                        <td><strong>Points</strong></td>
                                                                        <td><strong>Qty</strong></td>
                                                                        <td><strong>Location</strong></td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="device_audit_append">
                                                                    <?php 
                                                                        if (isset($jobs_data_items)) { 
                                                                            $subtotal = 0.00;
                                                                            foreach ($jobs_data_items as $item) {
                                                                            
                                                                            // Service don't have inventory
                                                                            if (strtolower($item->type) === 'service') {
                                                                                continue;
                                                                            }

                                                                            $total = $item->price * $item->qty;
                                                                    ?>
                                                                    <tr>
                                                                        <!-- <td style="width: 0% !important;">
                                                                            <center>
                                                                                <div class="btn-group">
                                                                                    <button type="button" class="btn btn-light edit_item_list" data-name='<?= $item->title; ?>' data-price='<?= $item->price; ?>' data-quantity='<?= $item->qty; ?>' id="<?= $item->id; ?>"><i class='bx bxs-edit' ></i></button>
                                                                                    <button type="button" class="btn btn-light remove_audit_item_row"><i class='bx bxs-trash-alt' ></i></button>
                                                                                </div>
                                                                            </center>
                                                                        </td> -->
                                                                        <td><?= $item->title; ?></td>
                                                                        <td><?= $item->type; ?></td>
                                                                        <td><?= $item->points; ?></td>
                                                                        <td><?= $item->qty; ?></td>
                                                                        <td style="width: 200px">
                                                                            <input type="hidden" name="item_id1[]" value="<?= $item->id ?>">
                                                                            <input type="hidden" name="location_qty[]" value="<?= $item->qty ?>">
                                                                            <select id="location" name="location[]" class="form-control location" >
                                                                                <option value="">Select Type</option>
                                                                                    <?php foreach (getLocation($item->id, $item->qty) as $locationItem): ?>
                                                                                        <option value="<?= $locationItem->id ?>"><?= $locationItem->name  ?></option>
                                                                                    <?php endforeach; ?>
                                                                            </select>
                                                                        </td>
                                                                    </tr>
                                                                    <?php } } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                                <!-- <?php if(isset($jobs_data) && $jobs_data->status != 'Scheduled'): ?>
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
                                                <?php endif; ?> -->
                                            </div>
                                            <br>
                                        </div>
                                        <div class="row">
                                            <!-- <input id="total_amount" type="hidden" name="total_amount"> -->
                                            <input id="signature_link" type="hidden" name="signature_link">
                                            <input id="name" type="hidden" name="authorize_name">
                                            <input id="datetime_signed" type="hidden" name="datetime_signed">
                                            <input id="attachment" type="hidden" name="attachment" value="<?= $THUMBNAIL_SRC; ?>">
                                            <input id="created_by" type="hidden" name="created_by" value="<?= $logged_in_user->id; ?>">
                                            <input id="employee2_id" type="hidden" name="employee2_id" value="<?= isset($jobs_data) ? $jobs_data->employee2_id : ''; ?>">
                                            <input id="employee3_id" type="hidden" name="employee3_id" value="<?= isset($jobs_data) ? $jobs_data->employee3_id : ''; ?>">
                                            <input id="employee4_id" type="hidden" name="employee4_id" value="<?= isset($jobs_data) ? $jobs_data->employee4_id : ''; ?>">
                                            <input id="employee5_id" type="hidden" name="employee5_id" value="<?= isset($jobs_data) ? $jobs_data->employee5_id : ''; ?>">
                                            <input id="employee6_id" type="hidden" name="employee6_id" value="<?= isset($jobs_data) ? $jobs_data->employee6_id : ''; ?>">
                                            <div class="col-sm-12 text-end">
                                            <button type="submit" class="nsm-button primary"><i class='bx bx-fw bx-calendar-plus'></i> Schedule</button>
                                              <!--   <?php if(isset($jobs_data)): ?>
                                                    <button type="button" onclick="location.href='<?= base_url('job/job_preview/'.$this->uri->segment(3)) ?>'" class="nsm-button primary"><i class='bx bx-bx bx-search-alt'></i> Preview</button>
                                                <?php endif; ?> -->
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

<!-- Modal -->
<div class="modal fade" id="item_list" tabindex="-1"  aria-labelledby="newcustomerLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Items List</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 mb-2">
                            <input id="ITEM_CUSTOM_SEARCH" style="width: 200px;" class="form-control" type="text" placeholder="Search Item...">
                        </div>
                        <div class="col-sm-12">
                            <table id="items_table" class="table table-hover w-100">
                                <thead class="bg-light">
                                    <tr>
                                        <td style="width: 0% !important;"></td>
                                        <td><strong>Name</strong></td>
                                        <td><strong>Qty</strong></td>
                                        <td><strong>Price</strong></td>
                                        <td><strong>Type</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if (!empty($items)) {
                                            foreach ($items as $item) {
                                               $item_qty = get_total_item_qty($item->id);
                                    ?>
                                    <tr>
                                        <td style="width: 0% !important;">
                                            <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-light border-1 select_item" id="<?= $item->id; ?>" data-item_type="<?= ucfirst($item->type); ?>" data-quantity="<?= $item->units; ?>" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>"><i class='bx bx-plus-medical'></i></button>
                                        </td>
                                        <td><?= $item->title; ?></td>
                                        <td><?= $item_qty[0]->total_qty > 0 ? $item_qty[0]->total_qty : 0; ?></td>
                                        <td><?= $item->price; ?></td>
                                        <td><?= $item->type; ?></td>
                                    </tr>
                                    <?php } } ?>
                                </tbody>
                            </table>
                        </div>
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
<!-- <div class="modal fade nsm-modal" id="share_job_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Share Job To Other Employee</span>
                <button type="button" data-bs-dismiss="modal" aria-label="name-button" name="name-button"><i class="bx bx-fw bx-x m-0"></i></button>
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
                <button type="button" id="share_modal_submit" class="nsm-button primary" data-bs-dismiss="modal">
                <i class='bx bx-paper-plane'></i> Save
                </button>
                <button type="button" class="nsm-button" data-bs-dismiss="modal">
                Close
                </button>
            </div>
        </div>
    </div>
</div> -->


<!-- 
                                                <script type="text/javascript">
        $(".select_item").click(function () {
            var TR_ID = this.id;
            var ITEM_NAME = $(this).data('itemname');
            var ITEM_TYPE = $(this).data('item_type');
            var POINTS = "";
            var PRICE = $(this).data('price');
            var QUANTITY = $(this).data('quantity');
            var SUB_TOTAL = parseFloat(PRICE * QUANTITY).toFixed(2);
            var LOCATION = "";

            var id = this.id;
            var title = $(this).data('itemname');
            var price = $(this).data('price');
            var qty = $(this).data('quantity');
            var item_type = $(this).data('item_type');
            var total_ = price * qty;
            var total = parseFloat(total_).toFixed(2);
            var withCommas = Number(total).toLocaleString('en');
            // markup2 = "<tr id=\"sss\">" +
            //     "<td >"+title+"</td>\n" +
            //     "<td >0</td>\n" +
            //     "<td >"+price+"</td>\n" +
            //     "<td id='device_qty"+idd+"'>"+qty+"</td>\n" +
            //     "<td id='device_sub_total"+idd+"'>"+total+"</td>\n" +
            //     "<td ></td>\n" +
            //     "<td ><a href=\"#\" data-name='"+title+"' data-price='"+price+"' data-quantity='"+qty+"' id='"+idd+"' class=\"edit_item_list\"><span class=\"fa fa-edit\"></span></a> </td>\n" + // <a href="javascript:void(0)" class="remove_audit_item_row"><span class="fa fa-trash"></span></i></a>
            //     "</tr>";\
            markup2 = "<tr id='"+TR_ID+"'>" +
                      "<td>"+ITEM_NAME+"</td>" +
                      "<td>"+ITEM_TYPE+"</td>" +
                      "<td>"+POINTS+"</td>" +
                      "<td>"+PRICE+"</td>" +
                      "<td>"+QUANTITY+"</td>" +
                      "<td>"+SUB_TOTAL+"</td>" +
                      "<td>"+LOCATION+"</td>" +
                      "</tr>";
            tableBody2 = $("#device_audit_append");
            tableBody2.append(markup2);
            // calculate_subtotal();
        });
</script> -->


<!-- On My Way Modal -->
<?php include viewPath('v2/pages/job/modals/arrival_modal'); ?>
<!-- Start Job Modal -->
<?php include viewPath('v2/pages/job/modals/started_modal'); ?>
<!-- Approved Job Modal -->
<?php include viewPath('v2/pages/job/modals/approved_modal'); ?>
<!-- Finish Job Modal -->
<div class="modal fade" id="finish_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Finish Job</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <form id="update_status_to_closed">
                    <div class="row">
                        <div class="col-sm-12 mt-1 mb-1">
                            <label>This will stop on job duration tracking and mark the job end time.</label>
                        </div>
                        <div class="col-sm-12">
                            <label class="mb-2">Finish job at:</label>
                            <div class="input-group">
                                <input type="date" name="job_start_date" id="job_start_date" class="form-control" value="<?= date('Y-m-d');?>" required>
                                <select id="job_start_time" name="job_start_time" class="form-control" required>
                                    <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                        <option <?= isset($jobs_data) && strtolower($jobs_data->start_time) == time_availability($x) ?  'selected' : '';  ?> value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <input type="hidden" name="id" id="jobid" value="<?php if(isset($jobs_data)){echo $jobs_data->job_unique_id;} ?>"> <br>
                            <input type="hidden" name="status" id="status" value="Closed">
                            <div class="col-sm-12 mb-4">
                                <a href="<?= base_url('job/billing/').$jobs_data->job_unique_id; ?>" class="nsm-button primary" style="margin: 0;">
                                    <span class="bx bx-fw bx-money"></span> Pay Now
                                </a>

                                <a href="<?= base_url('job/send_customer_invoice_email/').$jobs_data->job_unique_id; ?>" class="nsm-button primary" style="margin-bottom: 0;">
                                    <span class="bx bx-fw bx-send"></span> Send Invoice
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="approveThisJobModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Approve Job</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <form id="update_status_to_omw" method="post">
                    <div class="row">
                        <div class="col-sm-12 mt-1 mb-1">
                            <label>Electronic signatures, or e-signatures, are transforming the ways companies do business. Not only do they eliminate the hassle of manually routing paper agreements, but they also dramatically speed up the signature and approval process.</label>
                        </div>
                        <div class="col-sm-12 mb-4">
                            <div class="nsm-loader" style="height: 100px; min-height: unset;">
                            <i class="bx bx-loader-alt bx-spin"></i>
                            </div>

                            <div class="nsm-empty d-none" style="height: auto; padding: 1rem 0;">
                                <i class="bx bx-meh-blank"></i>
                                <span>No eSign template found.</span>
                            </div>

                            <div class="esign-templates d-none mt-1">
                                <label class="mb-1">Select your template below:</label>
                                <div class="dropdown">
                                    <button class="nsm-button dropdown-toggle m-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Dropdown button
                                    </button>
                                    <ul class="dropdown-menu"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button disabled type="button" class="nsm-button primary approve-and-esign d-flex align-items-center" data-action="approve-and-esign">
                        <i class="bx bx-loader-alt bx-spin"></i>
                        <span>Approve and eSign</span>
                        </button>
                        <button type="button" class="nsm-button" data-action="approve">Approve</button>
                    </div>
                </form>
            </div>
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
<!-- s -->
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
CKEDITOR.replace( 'Message_Editor', {
    toolbarGroups: [
        { name: 'document',    groups: [ 'mode', 'document' ] },            // Displays document group with its two subgroups.
        { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },           // Group's name will be used to create voice label.
        '/',                                                                // Line break - next group will be placed in new line.
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
        { name: 'links' }
    ],
    height: '140px',
});
CKEDITOR.editorConfig = function( config ) {
    config.height = '200px';
};

$('#EMPLOYEE_SELECT_2').on('change', function(event) {
    $("#emp2_id, #employee2_id").val($("#EMPLOYEE_SELECT_2").val());
});
$('#EMPLOYEE_SELECT_3').on('change', function(event) {
    $("#emp3_id, #employee3_id").val($("#EMPLOYEE_SELECT_3").val());
});
$('#EMPLOYEE_SELECT_4').on('change', function(event) {
    $("#emp4_id, #employee4_id").val($("#EMPLOYEE_SELECT_4").val());
});
$('#EMPLOYEE_SELECT_5').on('change', function(event) {
    $("#emp5_id, #employee5_id").val($("#EMPLOYEE_SELECT_5").val());
});
$('#EMPLOYEE_SELECT_6').on('change', function(event) {
    $("#emp6_id, #employee6_id").val($("#EMPLOYEE_SELECT_6").val());
});

// START: ADD AND REMOVE BUTTON IN "ASSIGNED TO"
$(function() {
    // JUST A COUNTER VARIABLE
    var TOTAL = 1;
    
    // HIDDEN INPUTS
    var HIDDEN_1 = $('.ASSIGNED_TO_1 > select');
    var HIDDEN_2 = $('.ASSIGNED_TO_2 > select');
    var HIDDEN_3 = $('.ASSIGNED_TO_3 > select');
    var HIDDEN_4 = $('.ASSIGNED_TO_4 > select');
    var HIDDEN_5 = $('.ASSIGNED_TO_5 > select');

    // ACTUAL DROPDOWN ELEMENTS
    (HIDDEN_2.val() == '') ? $('.ASSIGNED_TO_2').hide(): TOTAL++;
    (HIDDEN_3.val() == '') ? $('.ASSIGNED_TO_3').hide(): TOTAL++;
    (HIDDEN_4.val() == '') ? $('.ASSIGNED_TO_4').hide(): TOTAL++;
    (HIDDEN_5.val() == '') ? $('.ASSIGNED_TO_5').hide(): TOTAL++;

    $(".ADD_ASSIGN_EMPLOYEE").click(function(event) {
        (TOTAL == 4) ? $(".ADD_ASSIGN_EMPLOYEE").attr('disabled', 'disabled'): '';
        if (TOTAL >= 1 && TOTAL < 5) {
            TOTAL++;
            $('.ASSIGNED_TO_' + TOTAL).show();
        }
        (TOTAL == 1) ? $(".REMOVE_ASSIGN_EMPLOYEE").attr('disabled', 'disabled'): '';
        (TOTAL == 2) ? $(".REMOVE_ASSIGN_EMPLOYEE").removeAttr('disabled'): '';
    });
    $(".REMOVE_ASSIGN_EMPLOYEE").click(function(event) {
        if (TOTAL > 1 && TOTAL <= 5) {
            $('.ASSIGNED_TO_' + TOTAL).hide();
            $(".ASSIGNED_TO_" + TOTAL + "> select").val('').change();
            TOTAL--;
        }
        (TOTAL <= 4) ? $(".ADD_ASSIGN_EMPLOYEE").removeAttr('disabled'): '';
        (TOTAL == 1) ? $(".REMOVE_ASSIGN_EMPLOYEE").attr('disabled', 'disabled'): '';
    });
    (TOTAL == 1) ? $(".REMOVE_ASSIGN_EMPLOYEE").attr('disabled', 'disabled'): '';
});
// END: ADD AND REMOVE BUTTON IN "ASSIGNED TO"

        var class_name = $('.active').attr('class');
        var class_name = $('.active').attr('class');
        var step = '';
        
        if($('#2').hasClass('active')){
            step = '2';
        }else if($('#3').hasClass('active')){
            step = '3';
        }else if($('#4').hasClass('active')){
            step = '4';
        }else if($('#5').hasClass('active')){
            step = '5';
        }else if($('#6').hasClass('active')){
            step = '6';
        }else if($('#7').hasClass('active')){
            step = '7';
        }else if($('#8').hasClass('active')){
            step = '8';
        }

        for(var x=0; x<step; x++){
            $('#'+x).addClass('active');
            $('#'+x).addClass('a-bold');
        }
    $(document).ready(function(){
        $('#share_modal_submit').click(function() {
            //employee 2
            var emp2 = $('#employee2').val();
            var empText = $('#employee2 :selected').text();
            $('#emp2_id').val($('#employee2').val());
            $('#emp2_txt').val($('#employee2 :selected').text());
            //employee 3 
            $('#emp3_id').val($('#employee3').val());
            $('#emp3_txt').val($('#employee3 :selected').text());
            //employee 4
            $('#emp4_id').val($('#employee4').val());
            $('#emp4_txt').val($('#employee4 :selected').text());
            //employee 5
            $('#emp5_id').val($('#employee5').val());
            $('#emp5_txt').val($('#employee5 :selected').text());
            //employee 5
            $('#emp6_id').val($('#employee6').val());
            $('#emp6_txt').val($('#employee6 :selected').text());
        })
    })
    $(function(){
        $('#customer_id').select2({
            ajax: {
                url: '<?= base_url('autocomplete/_company_customer') ?>',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                  return {
                    q: params.term, // search term
                    page: params.page
                  };
                },
                processResults: function (data, params) {
                  // parse the results into the format expected by Select2
                  // since we are using custom formatting functions we do not need to
                  // alter the remote JSON data, except to indicate that infinite
                  // scrolling can be used
                  params.page = params.page || 1;

                  return {
                    results: data
                    // pagination: {
                    //   more: (params.page * 30) < data.total_count
                    // }
                  };
                },
                cache: true
              },
              minimumInputLength: 0,
              templateResult: formatRepoCustomer,
              templateSelection: formatRepoCustomerSelection
    });

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
            '<div>'+repo.first_name + ' ' + repo.last_name +'<br /><small>'+repo.phone_m+' / '+repo.email+'</small></div>'
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
            placeholder: "Choose Priority..."
        });
        $(".location").select2({
            placeholder: "Choose Location"
        });

        $("#EMPLOYEE_SELECT_2, #EMPLOYEE_SELECT_3, #EMPLOYEE_SELECT_4, #EMPLOYEE_SELECT_5, #EMPLOYEE_SELECT_6").select2({
            placeholder: "Select Employee to Assign",
        });

        $("#customer_reminder").select2({
            placeholder: "Choose Reminder..."
        });

        $("#inputState").select2({
            placeholder: "Select Timezone..."
        });

        // $("#job_type_option").select2({
        //     placeholder: "Select Job Type..."
        // });

        // $("#job_tags").select2({
        //     placeholder: "Select Job Type..."
        // });

        <?php if( $default_customer_id > 0 ){ ?>
            $('#customer_id').click();
            load_customer_data('<?= $default_customer_id; ?>');
        <?php } ?>
    });

    var geocoder;
    function initMap(address=null) {
        // var location = "http://api.positionstack.com/v1/forward?access_key=a7ac4cf89ebdccfa51b23071899ae056&query="+encodeURIComponent(address);
        // $.getJSON(location, {})
        //   .done(function( data ) {
        //      console.log(data[0].latitude);
        //      console.log(data[0].longitude);
        //   }).fail(function( error ) {
        //      console.log("ERROR");
        //      console.log(error);
        //   });
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
        // codeAddress(geocoder, map,address);
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
                console.log('Geocode was not successful for the following reason: ' + status);
            }
        });
    }
    // $("#jobs_form").submit(function(e) {
    //         e.preventDefault(); // avoid to execute the actual submit of the form.
    //         if($('#job_color_id').val()=== ""){
    //             error('Sorry!','Event Color is required!','warning');
    //         }else{
    //             var form = $(this);
    //             const $overlay = document.getElementById('overlay');
 
    //             var url = form.attr('action');
    //             $.ajax({
    //                 type: "POST",
    //                 url: "<?= base_url() ?>/job/save_job",
    //                 data: form.serialize(), // serializes the form's elements.
    //                 success: function(data) {
    //                     if ($overlay) $overlay.style.display = "none";
    //                     sucess_add_job(data);
    //                 }, beforeSend: function() {
    //                     if ($overlay) $overlay.style.display = "flex";
    //                 }
    //             });
    //         }
    //     });
    $("body").delegate(".color-scheme", "click", function(){
            var id = this.id;
            $('[id="job_color_id"]').val(id);
            $( "#"+id ).append( "<i class=\"bx bx-check calendar_button\" aria-hidden=\"true\"></i>" );
            remove_others(id);
        });
        function remove_others (color_id){
            $('.color-scheme').each(function(index) {
                var idd = this.id;
                if(idd !== color_id){
                    $( "#"+idd ).empty();
                }
            });
        }
</script>
<script src="<?=base_url("assets/js/jobs/manage.js")?>"></script>