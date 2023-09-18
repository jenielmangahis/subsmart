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
    .CC_INPUTS,
    .DC_INPUTS,
    .CHECK_INPUTS,
    .ACH_INPUTS,
    .VENMO_INPUTS,
    .PP_INPUTS,
    .SQ_INPUTS,
    .WW_INPUTS,
    .HOF_INPUTS,
    .ET_INPUTS,
    .INV_INPUTS,
    .OCCP_INPUTS,
    .OPT_INPUTS {
        display: none;
    }
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
    .MAP_LOADER_CONTAINER{
        min-height: 350px;
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
                <input type="hidden" name="job_number" id="jobNumber" class="form-control" value="<?= isset($jobs_data->job_number) ? $jobs_data->job_number : ''; ?>">
                <input type="hidden" name="job_hash" id="johHash" class="form-control" value="<?= isset($jobs_data->hash_id) ? $jobs_data->hash_id : ''; ?>">
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
                                                    <li class="<?= !isset($jobs_data) || $jobs_data->status == '0' || $jobs_data->status == 'Scheduled'  ? 'active' : ''; ?>" id="1">
                                                <a href="">Draft</a></li>
                                                    <li class="<?= isset($jobs_data) && $jobs_data->status == 'Scheduled'  ? 'active' : ''; ?>" id="2">
                                                <a href="">Scheduled</a></li>
                                                    <li class="<?= isset($jobs_data) && $jobs_data->status == 'Arrival' ? 'active' : ''; ?>" id="3" <?php if(isset($jobs_data) && $jobs_data->status == 'Scheduled'): ?>data-bs-toggle="modal" data-bs-target="#omw_modal" data-backdrop="static" data-keyboard="false" <?php endif; ?>>
                                                        <a href="#"> Arrived </a>
                                                    </li>
                                                    <li class="<?= isset($jobs_data) && $jobs_data->status == 'Started'  ? 'active' : ''; ?>" id="4" <?php if(isset($jobs_data) && $jobs_data->status == 'Arrival'): ?>data-bs-toggle="modal" data-bs-target="#start_modal" data-backdrop="static" data-keyboard="false" <?php endif; ?>>
                                                        <a href="#"> Started </a>
                                                    </li>
                                                    <li class="<?= isset($jobs_data) && $jobs_data->status == 'Approved'  ? 'active' : ''; ?>" id="5" <?php if(isset($jobs_data) && $jobs_data->status == 'Started'): ?>data-bs-toggle="modal" data-bs-target="#approveThisJobModal" data-backdrop="static" data-keyboard="false" <?php endif; ?>>
                                                        <a href="#" id="approveThisJob" data-status="<?= isset($jobs_data) ? $jobs_data->status : "" ?>" > Approved </a>
                                                    </li>
                                                    <li id="6" class="<?= isset($jobs_data) && $jobs_data->status == 'Finish'  ? 'active' : ''; ?>" <?php if(isset($jobs_data) && $jobs_data->status == 'Approved'): ?>data-bs-toggle="modal"data-bs-target="#finish_modal"<?php endif; ?>>
                                                        <a href="#">Finished</a>
                                                    <li id="7" class="<?= isset($jobs_data) && $jobs_data->status == 'Invoiced'  ? 'active' : ''; ?>">
                                                        <a href="#">Invoiced</a>
                                                    </li>
                                                    <li id="8" class="<?= isset($jobs_data) && in_array($jobs_data->status, ['Completed', 'Finished'])  ? 'active' : ''; ?>">
                                                        <a href="#">Completed</a>
                                                    </li>
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
                                        <div class="nsm-card-title"><span><i class='bx bx-time'></i>&nbsp;Schedule Job</span></div>
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
                                                <input type="date" name="start_date" id="start_date" class="form-control" value="<?= isset($jobs_data) ?  $jobs_data->start_date : $default_start_date;  ?>" required>
                                              </div>
                                              <div class="col-sm-5">
                                                  <?php if( isset($jobs_data) ){ $default_start_time = strtolower($jobs_data->start_time); } ?>
                                                    <select id="start_time" name="start_time" class="nsm-field form-select" required>
                                                        <option value="">Start time</option>
                                                        <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                                            <option <?= $default_start_time == time_availability($x) ?  'selected' : '';  ?> value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                                                        <?php } ?>
                                                    </select>
                                              </div>
                                            </div>
                                            <div class="row g-3 align-items-center">
                                              <div class="col-sm-2">
                                                <label>To:</label>
                                              </div>
                                              <div class="col-sm-5">
                                                <input type="date" name="end_date" id="end_date" class="form-control mr-2" value="<?= isset($jobs_data) ?  $jobs_data->end_date : $default_start_date;  ?>" required>
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
                                        <!-- <div class="form-group">
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
                                        </div> -->
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
                                            <?php 
                                                if( isset($jobs_data) ){
                                                    $default_user = $jobs_data->employee_id;
                                                }
                                            ?>
                                            <select id="employee_id" name="employee_id" class="form-control " required>
                                                <option value="10001">Select All</option>
                                                <?php if(!empty($sales_rep)): ?>
                                                    <?php foreach ($sales_rep as $employee): ?>
                                                        <option <?= $default_user == $employee->id ? 'selected' : '';  ?> value="<?= $employee->id; ?>"><?= $employee->FName.','.$employee->LName; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select><br>
                                        <div class="color-box-custom">
                                            <h6>Job Color on Calendar</h6>
                                            <?php 
                                                $is_default_color_exists = 0;
                                                $default_color = '#2e9e39'; 
                                            ?>
                                            <ul>
                                                <?php if(isset($color_settings)): ?>
                                                    <?php foreach ($color_settings as $color): ?>
                                                        <?php 
                                                            if( strtolower($color->color_code) == $default_color){
                                                                $is_default_color_exists = 1;
                                                            }
                                                        ?>
                                                        <li>
                                                            <?php if( empty($jobs_data) && strtolower($color->color_code) == $default_color ){ ?>
                                                                <a style="background-color: <?= $color->color_code; ?>; border-radius: 0px;border: 1px solid black;margin-bottom: 4px;" id="<?= $color->id; ?>" type="button" class="btn btn-default color-scheme btn-circle bg-1" title="<?= $color->color_name; ?>">
                                                                <i class="bx bx-check calendar_button" aria-hidden="true"></i>
                                                                </a>
                                                            <?php }else{ ?>
                                                                <a style="background-color: <?= $color->color_code; ?>; border-radius: 0px;border: 1px solid black;margin-bottom: 4px;" id="<?= $color->id; ?>" type="button" class="btn btn-default color-scheme btn-circle bg-1" title="<?= $color->color_name; ?>">
                                                                    <?php if(isset($jobs_data) && $jobs_data->event_color == $color->id) {echo '<i class="bx bx-check calendar_button" aria-hidden="true"></i>'; } ?>
                                                                </a>
                                                            <?php } ?>                                                            
                                                        </li>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                                <?php if( $is_default_color_exists == 0 ){ ?>
                                                    <li>
                                                        <a data-color="<?= $default_color; ?>" style="background-color: <?= $default_color; ?>; border-radius: 0px;border: 1px solid black;margin-bottom: 4px;" id="default-event-color" type="button" class="btn btn-default color-scheme btn-circle bg-1" title="Default Event Color">
                                                        <?php 
                                                            if(isset($jobs_data) && $jobs_data->event_color == $default_color){
                                                                echo '<i class="bx bx-check calendar_button event-color-check" aria-hidden="true"></i>'; 
                                                            }

                                                            if( empty($jobs_data) ){
                                                                echo '<i class="bx bx-check calendar_button event-color-check" aria-hidden="true"></i>'; 
                                                            }
                                                        ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                            <input value="<?= (isset($jobs_data) && isset($jobs_data->event_color)) ? $jobs_data->event_color : ''; ?>" id="job_color_id" name="event_color" type="hidden" />
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
                                                <?php foreach (config_item('calendar_timezone') as $key => $zone) { ?>
                                                    <option value="<?php echo $key ?>" <?= $jobs_data && $jobs_data->timezone == $key ? 'selected="selected"' : ''; ?>>
                                                        <?php echo $zone ?>
                                                    </option>
                                                <?php } ?>
                                                <!-- <option value="utc5">Central Time (UTC -5)</option> -->
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
                                <div class="nsm-card primary table-custom" style="margin-top: 30px;">
                                    <div class="nsm-card-header d-block">
                                        <div class="nsm-card-title">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <?php 
                                                        if( !empty($job_created_by) ){
                                                            $created_by = $job_created_by->FName . ' ' . $job_created_by->LName;
                                                        }else{
                                                            $created_by = $logged_in_user->FName . ' ' . $logged_in_user->LName;
                                                        }
                                                    ?>
                                                    <strong>Created By:</strong>&nbsp;<strong style="font-size: 20px;"> <?= ' '.$created_by; ?></strong style="font-size: 17px;">
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
                                                <h6>Customer</h6>
                                                <select id="customer_id" name="customer_id" data-customer-source="dropdown" class="form-control searchable-dropdown" required>
                                                    <option value="">- Select Customer -</option>
                                                    <!-- <option value="4801" selected>Test</option> -->
                                                    <?php if( $default_customer_id > 0 ){ ?>
                                                        <option value="<?= $default_customer_id; ?>" selected><?= $default_customer_name; ?></option>
                                                    <?php } ?>                                        
                                                </select>
                                                <!-- <div class="alert alert-secondary show mt-2" role="alert" style="background: #f9f9f9;">
                                                    <div class="row">
                                                        <div class="col-md-12"><strong>Customer Information</strong></div>
                                                        <div class="col-md-12">- Account Number:&nbsp;&nbsp;<u id="customerAccountNumber"></u></div>
                                                        <div class="col-md-12">- Business Name:&nbsp;&nbsp;<u id="customerBusinessName"></u></div>
                                                        <div class="col-md-12">- Password:&nbsp;&nbsp;<u id="customerPassword"></u></div>
                                                        <div class="col-md-12">- Address:&nbsp;&nbsp;<u id="customerAddress"></u></div>
                                                        <div class="col-md-12">- Phone Number:&nbsp;&nbsp;<u id="customerPhoneNumber"></u></div>
                                                        <div class="col-md-12">- Email:&nbsp;&nbsp;<u id="customerEmail"></u></div>
                                                        <div class="col-md-12">- Equipment Amount:&nbsp;&nbsp;<u id="customerEquimentAmount"></u></div>
                                                        <div class="col-md-12">- Activation:&nbsp;&nbsp;<u id="customerActivationStatus"></u></div>
                                                        <div class="col-md-12">- First Month Monitoring:&nbsp;&nbsp;<u id="customerMMR"></u></div>  
                                                    </div>
                                                </div> -->
                                                
                                                <table id="customer_info" class="table">
                                                    <thead>
                                                    <tr>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <!-- <tr>
                                                        <td id="cust_fullname">xxxxx xxxxx</td>
                                                        <td><a target="_blank" href="#" id="customer_preview"><span class="fa fa-user customer_right_icon"></span></a></td>
                                                    </tr> -->
                                                    <tr>
                                                        <td id="cust_business"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
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
                                                   <!--  <tr>
                                                        <td id="cust_jobaccountnumber">JOB-0000077</td>
                                                    </tr> -->
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="col-md-12 MAP_LOADER_CONTAINER">
                                                    <!-- <div id="streetViewBody" class="col-md-6 float-left no-padding"></div> -->
                                                    <!-- <div id="map" class="col-md-6 float-left"></div> -->                                                    
                                                    <div class="text-center MAP_LOADER">
                                                        <iframe id="TEMPORARY_MAP_VIEW" src="http://maps.google.com/maps?output=embed" height="300" width="100%" style=""></iframe>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12">
                                                <div class="alert alert-secondary show mt-2" role="alert" style="background: #f9f9f9;">
                                                    <div class="row">
                                                        <div class="col-md-12"><strong>Banking Details</strong></div>
                                                        <div class="col-md-4">- Account Name:&nbsp;&nbsp;<u id="billingAccountName"></u></div>
                                                        <div class="col-md-4">- Account No:&nbsp;&nbsp;<u id="billingAccountNo"></u></div>
                                                        <div class="col-md-4">- Credit Card No:&nbsp;&nbsp;<u id="billingCreditCardNo"></u></div>
                                                        <div class="col-md-4">- Credit Card Expiration:&nbsp;&nbsp;<u id="billingCreditCardExpiration"></u></div>
                                                        <div class="col-md-8">- Card Address:&nbsp;&nbsp;<u id="billingCardAddress"></u></div>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <div class="col-md-12">
                                                <hr />
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
                                                    </tbody>
                                                </table>
                                                <div class="col-md-12">
                                                        <h6>Job Account Number</h6>
                                                        <input value="<?php echo ($jobs_data->job_account_number) ? $jobs_data->job_account_number : ""; ?>" type="text" class="form-control" name="JOB_ACCOUNT_NUMBER">
                                                    </div>
                                                <div class="col-md-12">
                                                    <hr>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <div class="d-flex justify-content-between">
                                                                <h6>Select Job Type</h6>
                                                                <a class="nsm-link d-flex align-items-center" target="_blank" href="<?= base_url('job/job_types'); ?>">
                                                                    <span class="bx bx-plus"></span>Manage Job Types
                                                                </a>
                                                            </div>
                                                            <select id="job_type_option" name="jobtypes" class="form-control " >
                                                                <option value="">Select Type</option>
                                                                <?php if(!empty($job_types)): ?>
                                                                    <?php foreach ($job_types as $type): ?>
                                                                        <option <?php if(isset($jobs_data) && $jobs_data->job_type == $type->title) {echo 'selected'; } ?> value="<?= $type->title; ?>" data-image="<?= $type->icon_marker; ?>"><?= $type->title; ?></option>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <div class="d-flex justify-content-between">
                                                                <h6>Select Job Tag</h6>
                                                                <a class="nsm-link d-flex align-items-center" target="_blank" href="<?= base_url('job/job_tags'); ?>" >
                                                                    <span class="bx bx-plus"></span>Manage Job Tags
                                                                </a>
                                                            </div>
                                                            <select id="job_tags" name="tags" class="form-control " >
                                                                <option value="">Select Tags</option>
                                                                <?php if(!empty($tags)): ?>
                                                                    <?php foreach ($tags as $tag): ?>
                                                                        <option <?php if(isset($jobs_data) && $jobs_data->tags == $tag->name) {echo 'selected'; } ?> value="<?= $tag->id; ?>" data-image="<?= $tag->marker_icon; ?>"><?= $tag->name; ?></option>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <h6>Description of Job</h6>
                                                        <textarea name="job_description" class="form-control" required=""><?= isset($jobs_data) ? $jobs_data->job_description : ''; ?></textarea>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <hr>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h6 class='card_header'>Job Items Listing</h6>
                                        <table class="table table-hover job_items_tbl">
                                            <tbody id="jobs_items">
                                            <?php if(isset($jobs_data)): ?>
                                                <?php
                                                    $subtotal = 0.00;
                                                    foreach ($jobs_data_items as $item):
                                                    $item_price = $item->cost / $item->qty;
                                                    $total = $item->cost;
                                                    $hideSelectedItems .= "#ITEMLIST_PRODUCT_$item->id {display: none;}"; 
                                                ?>
                                                   <tr id=ss>
                                                        <td width="35%"><small>Item name</small>
                                                            <input value="<?= $item->title; ?>" type="text" name="item_name[]" class="form-control" readonly>
                                                            <input type="hidden" value='<?= $item->id ?>' name="item_id[]">
                                                        </td>
                                                        <td><small>Qty</small>
                                                            <input data-itemid='<?= $item->id ?>'  id='<?= $item->id ?>' value='<?= $item->qty; ?>' type="number" name="item_qty[]" class="form-control qty item-qty-<?= $item->id; ?>">
                                                        </td>
                                                        <td class="d-none"><small>Original Price</small>
                                                            <input readonly id='cost<?= $item->id ?>' data-id="<?= $item->id; ?>" value='<?= $item->price; ?>'  type="number" name="item_original_price[]" class="form-control item-original-price" placeholder="Cost">
                                                        </td>
                                                        <td><small>Unit Price</small>
                                                            <input id='price<?= $item->id ?>' data-id="<?= $item->id; ?>" value='<?= $item->retail; ?>'  type="number" name="item_price[]" class="form-control item-price" placeholder="Unit Price">
                                                        </td>
                                                        <td class="d-none"><small>Commission</small>
                                                            <input readonly step="any" id='commission<?= $item->id ?>' data-id="<?= $item->id; ?>" value='<?= $item->commission; ?>'  type="number" name="item_commission[]" class="form-control item-commission" placeholder="Commission">
                                                        </td>
                                                        <td class="d-none"><small>Margin</small>
                                                            <input readonly step="any" id='margin<?= $item->id ?>' data-id="<?= $item->id; ?>" value='<?= $item->margin; ?>'  type="number" name="item_margin[]" class="form-control item-margin" placeholder="Margin">
                                                        </td>
                                                        <!--<td width="10%"><small>Unit Cost</small><input type="text" name="item_cost[]" class="form-control"></td>-->
                                                        <!--<td width="25%"><small>Inventory Location</small><input type="text" name="item_loc[]" class="form-control"></td>-->
                                                        <td><small>Item Type</small><input readonly type="text" class="form-control" value='<?= $item->type ?>'></td>
                                                        <td>
                                                            <small>Amount</small><br>
                                                            <b data-subtotal='<?= $total ?>' id='sub_total<?= $item->id ?>' class="total_per_item">$<?= number_format((float)$total,2,'.',',');?></b>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="nsm-button items_remove_btn remove_item_row mt-2" onclick="$('#ITEMLIST_PRODUCT_<?php echo "$item->id"; ?>').show();"><i class="bx bx-trash" aria-hidden="true"></i></button>
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
                                            <hr>
                                            <style type="text/css">
                                                <?php echo $hideSelectedItems; ?>
                                            </style>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="file-upload-drag">
                                                        <div class="drop">
                                                            <div class="cont">
                                                                <div class="tit">
                                                                    <?php 
                                                                        $THUMBNAIL_SRC = (isset($jobs_data)) ? base_url($jobs_data->attachment) : "";
                                                                        if(isset($jobs_data) && $jobs_data->attachment != "") {
                                                                            $IMG_HIDE_STATUS = "";
                                                                            $SPAN_HIDE_STATUS = "d-none";
                                                                        } else {
                                                                            $IMG_HIDE_STATUS = "d-none";
                                                                            $SPAN_HIDE_STATUS = "";
                                                                        }
                                                                    ?>
                                                                    <input id="attachment-file" name="filetoupload" type="file" accept="image/png, image/jpg, image/jpeg, image/bmp, image/ico"/>
                                                                    <img class="<?php echo $IMG_HIDE_STATUS; ?> w-100 IMG_PREVIEW" id="attachment-image" alt="Attachment" src="<?php echo $THUMBNAIL_SRC; ?>">
                                                                    <button class="btn btn-danger btn-sm REMOVE_THUMBNAIL <?php echo $IMG_HIDE_STATUS; ?>" type="button" style="position: absolute; left: 160px;top:45%;">Remove</button>
                                                                    <span class="<?php echo $SPAN_HIDE_STATUS; ?> THUMBNAIL_BOX">
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
                                                            <select id="tax_rate" name="tax_percentage" class="form-control" data-value="<?= $jobs_data->tax_rate; ?>">
                                                                <option value="0.0">None</option>
                                                                <?php 
                                                                    $SELECTED_TAX = (isset($jobs_data->tax_rate)) ? $jobs_data->tax_rate : '0.00';
                                                                    foreach ($tax_rates as $rate) {
                                                                        if ($jobs_data->tax_percentage == $rate->rate) {
                                                                            echo "<option selected value='$rate->rate'>$rate->name ($rate->rate%)</option>";
                                                                        } else {
                                                                            if( $default_tax_id > 0 && ($default_tax_id == $rate->id) ){
                                                                                echo "<option value='$rate->rate' selected='selected'>$rate->name ($rate->rate%)</option>";
                                                                            }else{
                                                                                echo "<option value='$rate->rate'>$rate->name ($rate->rate%)</option>";    
                                                                            }
                                                                            
                                                                        }
                                                                        // if ($SELECTED_TAX !== "0.00") {
                                                                        //     if ($subtotal * ($rate->rate / 100) == $jobs_data->tax_rate) {
                                                                        //         echo "<option selected value='$rate->rate'>$rate->name ($rate->rate%)</option>";
                                                                        //     } else {
                                                                        //         echo "<option value='$rate->rate'>$rate->name ($rate->rate%)</option>";
                                                                        //     }
                                                                        // } else {
                                                                        //     if ($rate->is_default == "1") {
                                                                        //         echo "<option selected value='$rate->rate'>$rate->name ($rate->rate%)</option>";
                                                                        //     } else {
                                                                        //     } 
                                                                        // } 
                                                                    } 
                                                                ?>
                                                            </select>
                                                            </div>                                                                                                                     
                                                        <div class="col-sm-6">
                                                            <label id="invoice_tax_total"><?= isset($jobs_data->tax_rate) ? number_format((float)$jobs_data->tax_rate, 2,'.',',') : '0.00'; ?></label>
                                                            <input type="hidden" name="tax" id="tax_total_form_input" value="<?= isset($jobs_data->tax_rate) ? number_format((float)$jobs_data->tax_rate, 2,'.',',') : '0.00'; ?>">
                                                        </div>
                                                    </div>
                                                    <?php if( in_array($cid, adi_company_ids()) ){ ?>
                                                        <div class="row mt-3">
                                                            <div class="col-sm-6">
                                                                <label>Installation Cost</label>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <input type="number" step="any" class="form-control" id="adjustment_ic" name="installation_cost" value="<?= isset($job_latest_payment) ? $job_latest_payment->installation_cost : '0.00'; ?>" required="" />
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col-sm-6">
                                                                <label>One time (Program and Setup)</label>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <input type="number" step="any" class="form-control" id="adjustment_otps" name="otps" value="<?= isset($job_latest_payment) ? $job_latest_payment->program_setup : '0.00'; ?>" required="" />
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2 mb-2">
                                                            <div class="col-sm-6">
                                                                <label>Monthly Monitoring</label>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <input type="number" step="any" class="form-control" id="adjustment_mm" name="monthly_monitoring" value="<?= isset($job_latest_payment) ? $job_latest_payment->monthly_monitoring : '0.00'; ?>" required="" />
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="row">
                                                        <hr>
                                                    </div>                                                    
                                                    <?php if( $estimate_dp_amount > 0 ){ ?>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label>Total</label>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label id="invoice_overall_total"></label>
                                                                <!-- <input step="any" type="hidden" name="total_amount" id="total2" value="<?= isset($jobs_data) ? number_format((float)$subtotal,2,'.',',') : '0'; ?>" hidden> -->
                                                                <input step="any" type="number" name="total_amount" id="total2" hidden>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label>Deposit Paid</label>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label id="invoice_requested_deposit" data-value="<?= $estimate_dp_amount; ?>">$<?= number_format((float) $estimate_dp_amount, 2, '.', ','); ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label><strong>Balance Owed</strong></label>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <strong><label id="invoice_overall_total_without_deposited_amount"></label></strong>
                                                            </div>
                                                        </div>                                                        
                                                    <?php }else{ ?>                                                                                            
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label><strong>Total</strong></label>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label id="invoice_overall_total"></label>
                                                                <!-- <input step="any" type="number" name="total_amount" id="total2" value="<?= isset($jobs_data) ? number_format((float)$subtotal,2,'.',',') : '0'; ?>" hidden> -->
                                                                <input step="any" type="number" name="total_amount" id="total2" hidden>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="row mt-3 d-none">
                                                            <div class="col-sm-6 d-none">
                                                                <label>Commission<br><small class="text-muted COMMISSION_TYPE"></small></label>
                                                            </div>
                                                            <div class="col-sm-6 d-none">
                                                                <label  id="invoice_overall_total">$0</label>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                Commission Type: <input type="number" name="commission_type" value="" readonly>
                                                                <br>
                                                                Percentage: <input step="any" type="number" name="commission_percentage" value="" readonly>
                                                                <br>
                                                                Total Commission: <input step="any" type="number" name="commission_amount" value="<?php echo $jobs_data->commission; ?>" readonly>
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
                                                        <!-- <input step="any" type="number" name="total_amount" id="total2" value="<?= isset($jobs_data) ? number_format((float)$subtotal,2,'.',',') : '0'; ?>" hidden> -->
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
                                                <div class="col-md-12">
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <h6>Billing Method</h6>
                                                        <select class="form-select" name="BILLING_METHOD">
                                                            <option value hidden>Select Billing Method</option>
                                                            <option value="CC">Credit Card</option>
                                                            <option value="DC">Debit Card</option>
                                                            <option value="CHECK">Check</option>
                                                            <option value="CASH">Cash</option>
                                                            <option value="ACH">ACH</option>
                                                            <option value="VENMO">Venmo</option>
                                                            <option value="PP">Paypal</option>
                                                            <option value="SQ">Square</option>
                                                            <option value="WW">Warranty Work</option>
                                                            <option value="HOF">Home Owner Financing</option>
                                                            <option value="ET">e-Transfer</option>
                                                            <option value="INV">Invoicing</option>
                                                            <option value="OCCP">Other Credit Card Processor</option>
                                                            <option value="OPT">Other Payment Type</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 mb-3 CC_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Credit Card Number</h6>
                                                        <input value="<?php echo ($jobs_data->CC_CREDITCARDNUMBER) ? $jobs_data->CC_CREDITCARDNUMBER : ""; ?>" type="text" class="form-control" placeholder="XXXX XXXX XXXX XXXX" name="CC_CREDITCARDNUMBER">
                                                    </div>
                                                    <div class="col-md-2 mb-3 CC_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Expiration</h6>
                                                        <input value="<?php echo ($jobs_data->CC_EXPIRATION) ? $jobs_data->CC_EXPIRATION : ""; ?>" type="text" class="form-control" placeholder="MM/YY" name="CC_EXPIRATION">
                                                    </div>
                                                    <div class="col-md-2 mb-3 CC_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>CVV</h6>
                                                        <input value="<?php echo ($jobs_data->CC_CVV) ? $jobs_data->CC_CVV : ""; ?>" type="text" class="form-control" placeholder="XXX" name="CC_CVV">
                                                    </div>
                                                    <!-- ======= -->
                                                    <div class="col-md-4 mb-3 DC_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Credit Card Number</h6>
                                                        <input value="<?php echo ($jobs_data->DC_CREDITCARDNUMBER) ? $jobs_data->DC_CREDITCARDNUMBER : ""; ?>" type="text" class="form-control" placeholder="XXXX XXXX XXXX XXXX" name="DC_CREDITCARDNUMBER">
                                                    </div>
                                                    <div class="col-md-2 mb-3 DC_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Expiration</h6>
                                                        <input value="<?php echo ($jobs_data->DC_EXPIRATION) ? $jobs_data->DC_EXPIRATION : ""; ?>" type="text" class="form-control" placeholder="MM/YY" name="DC_EXPIRATION">
                                                    </div>
                                                    <div class="col-md-2 mb-3 DC_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>CVV</h6>
                                                        <input value="<?php echo ($jobs_data->DC_CVV) ? $jobs_data->DC_CVV : ""; ?>" type="text" class="form-control" placeholder="XXX" name="DC_CVV">
                                                    </div>
                                                    <!-- ======= -->
                                                    <div class="col-md-4 mb-3 CHECK_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Check Number</h6>
                                                        <input value="<?php echo ($jobs_data->CHECK_CHECKNUMBER) ? $jobs_data->CHECK_CHECKNUMBER : ""; ?>" type="text" class="form-control" placeholder="XXXXXX" name="CHECK_CHECKNUMBER">
                                                    </div>
                                                    <div class="col-md-4 mb-3 CHECK_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Routing Number</h6>
                                                        <input value="<?php echo ($jobs_data->CHECK_ROUTINGNUMBER) ? $jobs_data->CHECK_ROUTINGNUMBER : ""; ?>" type="text" class="form-control" placeholder="XXXXXXXXX" name="CHECK_ROUTINGNUMBER">
                                                    </div>
                                                    <div class="col-md-12 mb-3 CHECK_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Account Number</h6>
                                                        <input value="<?php echo ($jobs_data->CHECK_ACCOUNTNUMBER) ? $jobs_data->CHECK_ACCOUNTNUMBER : ""; ?>" type="text" class="form-control" placeholder="XXXXXXXXXXXX" name="CHECK_ACCOUNTNUMBER">
                                                    </div>
                                                    <!-- ======= -->
                                                    <div class="col-md-4 mb-3 ACH_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Routing Number</h6>
                                                        <input value="<?php echo ($jobs_data->ACH_ROUTINGNUMBER) ? $jobs_data->ACH_ROUTINGNUMBER : ""; ?>" type="text" class="form-control" placeholder="XXXXXXXXX" name="ACH_ROUTINGNUMBER">
                                                    </div>
                                                    <div class="col-md-4 mb-3 ACH_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Account Number</h6>
                                                        <input value="<?php echo ($jobs_data->ACH_ACCOUNTNUMBER) ? $jobs_data->ACH_ACCOUNTNUMBER : ""; ?>" type="text" class="form-control" placeholder="XXXXXXXXXXXX" name="ACH_ACCOUNTNUMBER">
                                                    </div>
                                                    <!-- ======= -->
                                                    <div class="col-md-4 mb-3 VENMO_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Account Credential</h6>
                                                        <input value="<?php echo ($jobs_data->VENMO_ACCOUNTCREDENTIAL) ? $jobs_data->VENMO_ACCOUNTCREDENTIAL : ""; ?>" type="text" class="form-control" name="VENMO_ACCOUNTCREDENTIAL">
                                                    </div>
                                                    <div class="col-md-4 mb-3 VENMO_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Account Note</h6>
                                                        <input value="<?php echo ($jobs_data->VENMO_ACCOUNTNOTE) ? $jobs_data->VENMO_ACCOUNTNOTE : ""; ?>" type="text" class="form-control" name="VENMO_ACCOUNTNOTE">
                                                    </div>
                                                    <div class="col-md-12 mb-3 VENMO_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Confirmation</h6>
                                                        <input value="<?php echo ($jobs_data->VENMO_CONFIRMATION) ? $jobs_data->VENMO_CONFIRMATION : ""; ?>" type="text" class="form-control" name="VENMO_CONFIRMATION">
                                                    </div>
                                                    <!-- ======= -->
                                                    <div class="col-md-4 mb-3 PP_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Account Credential</h6>
                                                        <input value="<?php echo ($jobs_data->PP_ACCOUNTCREDENTIAL) ? $jobs_data->PP_ACCOUNTCREDENTIAL : ""; ?>" type="text" class="form-control" name="PP_ACCOUNTCREDENTIAL">
                                                    </div>
                                                    <div class="col-md-4 mb-3 PP_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Account Note</h6>
                                                        <input value="<?php echo ($jobs_data->PP_ACCOUNTNOTE) ? $jobs_data->PP_ACCOUNTNOTE : ""; ?>" type="text" class="form-control" name="PP_ACCOUNTNOTE">
                                                    </div>
                                                    <div class="col-md-12 mb-3 PP_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Confirmation</h6>
                                                        <input value="<?php echo ($jobs_data->PP_CONFIRMATION) ? $jobs_data->PP_CONFIRMATION : ""; ?>" type="text" class="form-control" name="PP_CONFIRMATION">
                                                    </div>
                                                    <!-- ======= -->
                                                    <div class="col-md-4 mb-3 SQ_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Account Credential</h6>
                                                        <input value="<?php echo ($jobs_data->SQ_ACCOUNTCREDENTIAL) ? $jobs_data->SQ_ACCOUNTCREDENTIAL : ""; ?>" type="text" class="form-control" name="SQ_ACCOUNTCREDENTIAL">
                                                    </div>
                                                    <div class="col-md-4 mb-3 SQ_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Account Note</h6>
                                                        <input value="<?php echo ($jobs_data->SQ_ACCOUNTNOTE) ? $jobs_data->SQ_ACCOUNTNOTE : ""; ?>" type="text" class="form-control" name="SQ_ACCOUNTNOTE">
                                                    </div>
                                                    <div class="col-md-12 mb-3 SQ_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Confirmation</h6>
                                                        <input value="<?php echo ($jobs_data->SQ_CONFIRMATION) ? $jobs_data->SQ_CONFIRMATION : ""; ?>" type="text" class="form-control" name="SQ_CONFIRMATION">
                                                    </div>
                                                    <!-- ======= -->
                                                    <div class="col-md-4 mb-3 WW_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Account Credential</h6>
                                                        <input value="<?php echo ($jobs_data->WW_ACCOUNTCREDENTIAL) ? $jobs_data->WW_ACCOUNTCREDENTIAL : ""; ?>" type="text" class="form-control" name="WW_ACCOUNTCREDENTIAL">
                                                    </div>
                                                    <div class="col-md-4 mb-3 WW_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Account Note</h6>
                                                        <input value="<?php echo ($jobs_data->WW_ACCOUNTNOTE) ? $jobs_data->WW_ACCOUNTNOTE : ""; ?>" type="text" class="form-control" name="WW_ACCOUNTNOTE">
                                                    </div>
                                                    <!-- ======= -->
                                                    <div class="col-md-4 mb-3 HOF_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Account Credential</h6>
                                                        <input value="<?php echo ($jobs_data->HOF_ACCOUNTCREDENTIAL) ? $jobs_data->HOF_ACCOUNTCREDENTIAL : ""; ?>" type="text" class="form-control" name="HOF_ACCOUNTCREDENTIAL">
                                                    </div>
                                                    <div class="col-md-4 mb-3 HOF_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Account Note</h6>
                                                        <input value="<?php echo ($jobs_data->HOF_ACCOUNTNOTE) ? $jobs_data->HOF_ACCOUNTNOTE : ""; ?>" type="text" class="form-control" name="HOF_ACCOUNTNOTE">
                                                    </div>
                                                    <!-- ======= -->
                                                    <div class="col-md-4 mb-3 ET_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Account Credential</h6>
                                                        <input value="<?php echo ($jobs_data->ET_ACCOUNTCREDENTIAL) ? $jobs_data->ET_ACCOUNTCREDENTIAL : ""; ?>" type="text" class="form-control" name="ET_ACCOUNTCREDENTIAL">
                                                    </div>
                                                    <div class="col-md-4 mb-3 ET_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Account Note</h6>
                                                        <input value="<?php echo ($jobs_data->ET_ACCOUNTNOTE) ? $jobs_data->ET_ACCOUNTNOTE : ""; ?>" type="text" class="form-control" name="ET_ACCOUNTNOTE">
                                                    </div>
                                                    <!-- ======= -->
                                                    <div class="col-md-4 mb-3 INV_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Term</h6>
                                                        <select class="form-select" name="INV_TERM">
                                                            <option <?php echo ($jobs_data->INV_TERM == "Due On Receipt") ? "selected" : ""; ?> value="Due On Receipt">Due On Receipt</option>
                                                            <option <?php echo ($jobs_data->INV_TERM == "Net 5") ? "selected" : ""; ?> value="Net 5">Net 5</option>
                                                            <option <?php echo ($jobs_data->INV_TERM == "Net 10") ? "selected" : ""; ?> value="Net 10">Net 10</option>
                                                            <option <?php echo ($jobs_data->INV_TERM == "Net 15") ? "selected" : ""; ?> value="Net 15">Net 15</option>
                                                            <option <?php echo ($jobs_data->INV_TERM == "Net 30") ? "selected" : ""; ?> value="Net 30">Net 30</option>
                                                            <option <?php echo ($jobs_data->INV_TERM == "Net 60") ? "selected" : ""; ?> value="Net 60">Net 60</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 mb-3 INV_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Invoice Date</h6>
                                                        <input value="<?php echo ($jobs_data->INV_INVOICEDATE) ? $jobs_data->INV_INVOICEDATE : ""; ?>" type="date" class="form-control" name="INV_INVOICEDATE">
                                                    </div>
                                                    <div class="col-md-2 mb-3 INV_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Due Date</h6>
                                                        <input value="<?php echo ($jobs_data->INV_DUEDATE) ? $jobs_data->INV_DUEDATE : ""; ?>" type="date" class="form-control" name="INV_DUEDATE">
                                                    </div>
                                                    <!-- ======= -->
                                                    <div class="col-md-4 mb-3 OCCP_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Credit Card Number</h6>
                                                        <input value="<?php echo ($jobs_data->OCCP_CREDITCARDNUMBER) ? $jobs_data->OCCP_CREDITCARDNUMBER : ""; ?>" type="text" class="form-control" placeholder="XXXX XXXX XXXX XXXX" name="OCCP_CREDITCARDNUMBER">
                                                    </div>
                                                    <div class="col-md-2 mb-3 OCCP_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Expiration</h6>
                                                        <input value="<?php echo ($jobs_data->OCCP_EXPIRATION) ? $jobs_data->OCCP_EXPIRATION : ""; ?>" type="text" class="form-control" placeholder="MM/YY" name="OCCP_EXPIRATION">
                                                    </div>
                                                    <div class="col-md-2 mb-3 OCCP_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>CVV</h6>
                                                        <input value="<?php echo ($jobs_data->OCCP_CVV) ? $jobs_data->OCCP_CVV : ""; ?>" type="text" class="form-control" placeholder="XXX" name="OCCP_CVV">
                                                    </div>
                                                    <!-- ======= -->
                                                    <div class="col-md-4 mb-3 OPT_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Account Credential</h6>
                                                        <input value="<?php echo ($jobs_data->OPT_ACCOUNTCREDENTIAL) ? $jobs_data->OPT_ACCOUNTCREDENTIAL : ""; ?>" type="text" class="form-control" name="OPT_ACCOUNTCREDENTIAL">
                                                    </div>
                                                    <div class="col-md-4 mb-3 OPT_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Account Note</h6>
                                                        <input value="<?php echo ($jobs_data->OPT_ACCOUNTNOTE) ? $jobs_data->OPT_ACCOUNTNOTE : ""; ?>" type="text" class="form-control" name="OPT_ACCOUNTNOTE">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <hr>
                                                    </div>
                                                <div class="col-sm-12 mb-4">
                                                    <div class="row">
                                                        <div class="col-sm-12 mb-2">
                                                            <h6>Notes</h6>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <?php 
                                                                if (isset($jobs_data)) { 
                                                                    $MESSAGE = "$jobs_data->message"; 
                                                                } else { 
                                                                    //$MESSAGE = "Thank you for your business, Please call $company_info->business_name at $company_info->business_phone for quality customer service";                                                                
                                                                    $MESSAGE = '';
                                                                } 
                                                            ?>
                                                            <div id="Message_Editor">
                                                                <?php echo $MESSAGE; ?>
                                                            </div>
                                                            <input class="d-none customer_message_input" name="message" value="<?php echo $MESSAGE; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-4 <?php echo (isset($jobs_data) && $jobs_data->link = NULL) ? '' : 'd-none' ?>">
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
                                                            <table id="device_audit" class="nsm-table table-sm table-bordered w-100 device_job_items_tbl">
                                                                <thead class="bg-light">
                                                                    <tr>
                                                                        <!-- <td style="width: 0% !important;"></td> -->
                                                                        <td><strong>Name</strong></td>
                                                                        <td><strong>Type</strong></td>
                                                                        <td><strong>Cost</strong></td>
                                                                        <td><strong>Price</strong></td>
                                                                        <td><strong>Qty</strong></td>
                                                                        <td><strong>Margin</strong></td>
                                                                        <td><strong>Location</strong></td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="device_audit_append">
                                                                    <?php 
                                                                        if (isset($jobs_data_items)) { 
                                                                            $subtotal = 0.00;
                                                                            foreach ($jobs_data_items as $item) {
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
                                                                        <td><?php echo $item->title; ?></td>
                                                                        <td><?php echo $item->type; ?></td>
                                                                        <td><?php echo number_format((float)$item->price,2,'.',','); ?></td>
                                                                        <td><?php echo number_format((float)$item->retail,2,'.',','); ?></td>
                                                                        <td><?php echo $item->qty; ?></td>
                                                                        <td><?php echo number_format((float)$item->margin,2,'.',','); ?></td>
                                                                        <?php if($jobs_data->status == "Scheduled") {?>
                                                                            <td>
                                                                                <input type="hidden" name="item_id1[]" value="<?= $item->id ?>">
                                                                                <input type="hidden" name="location_qty[]" value="<?= $item->qty ?>">
                                                                                <select id="location" name="location[]" class="form-select form-select-sm location" >
                                                                                    <?php
                                                                                        if ($item->location_name == "") {
                                                                                            echo "<option value hidden disable>Select Location</option>";
                                                                                            foreach ($getAllLocation as $getAllLocations) {
                                                                                                echo "<option value='$getAllLocations->loc_id'>$getAllLocations->location_name</option>";
                                                                                            }
                                                                                        } else {
                                                                                            echo "<option selected disabled hidden value='".getLocation($jobs_data->id, $item->location_id)->LOCATION_ID."'>".getLocation($jobs_data->id, $item->location_id)->LOCATION_NAME."</option>";
                                                                                            foreach ($getAllLocation as $getAllLocations) {
                                                                                                echo "<option value='$getAllLocations->loc_id'>$getAllLocations->location_name</option>";
                                                                                            }
                                                                                        }
                                                                                    ?>
                                                                                </select>
                                                                            </td>
                                                                        <?php } else { ?>
                                                                            <td><?php echo getLocation($jobs_data->id, $item->location_id)->LOCATION_NAME; ?></td>
                                                                        <?php }; ?>
                                                                    </tr>
                                                                    <?php } } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4">
                                                        <div class="col-sm-4 mb-3">
                                                            <strong>Rep:</strong>&nbsp;&nbsp;<span id="selectedRep">&mdash;</span>
                                                        </div>
                                                        <div class="col-sm-4 mb-2">
                                                            <strong>Rep Commission:</strong>&nbsp;&nbsp;<span id="totalRepCommissionProfit">$0</span>
                                                        </div>
                                                        <div class="col-sm-4 mb-2">
                                                            <strong>Fix Cost:</strong>&nbsp;&nbsp;<span id="totalFixCost"><input type="number" step="any" name="input_totalFixCost" value="<?php echo ($jobs_data) ? $jobs_data->fix_cost : "0.0"; ?>"></span>
                                                        </div>
                                                        <div class="col-sm-4 mb-2">
                                                            <strong>Equipment Margin:</strong>&nbsp;&nbsp;<span id="totalEquipmentMargin">$0</span>
                                                            <input class="d-none" type="number" step="any" name="input_totalEquipmentMargin" value="<?php echo ($jobs_data) ? $jobs_data->margin : "0.0"; ?>">
                                                        </div>
                                                        <div class="col-sm-4 mb-2">
                                                            <strong>Amount Collected:</strong>&nbsp;&nbsp;<span id="totalAmountCollected">$0</span>
                                                            <input class="d-none" type="number" step="any" name="input_totalAmountCollected" value="<?php echo ($jobs_data) ? $jobs_data->amount_collected : "0.0"; ?>">
                                                        </div>
                                                        <div class="col-sm-4 mb-2">
                                                            <strong>Job Gross Profit:</strong>&nbsp;&nbsp;<span id="totalJobGrossProfit">$0</span>
                                                            <input class="d-none" type="number" step="any" name="input_totalJobGrossProfit" value="<?php echo ($jobs_data) ? $jobs_data->gross_profit : "0.0"; ?>">
                                                        </div>
                                                        <div class="col-lg-12 d-none">
                                                            Customer Funded Amount/Purchase Price: <input id="CUSTOMER_FUNDED_AMOUNT" type="number" type="any" value="0"><br>
                                                            Customer Pass Through Cost: <input id="CUSTOMER_PASS_THROUGH" type="number" type="any" value="0"><br>
                                                            Sales Rep BS: <input id="SRBS_1" type="number" type="any" value="0"><br>
                                                            Tech Rep 1 BS: <input id="TRBS_1" type="number" type="any" value="0"><br>
                                                            Tech Rep 2 BS: <input id="TRBS_2" type="number" type="any" value="0"><br>
                                                            Tech Rep 3 BS: <input id="TRBS_3" type="number" type="any" value="0"><br>
                                                            Tech Rep 4 BS: <input id="TRBS_4" type="number" type="any" value="0"><br>
                                                            Tech Rep 5 BS: <input id="TRBS_5" type="number" type="any" value="0"><br>
                                                        </div>
                                                    </div>
                                                    <div class="row" style="margin-bottom: -20px;"><div class="col-lg-12"><hr></div></div>
                                                </div>
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
                                            <input id="attachment" type="hidden" name="attachment" value="<?php echo $THUMBNAIL_SRC; ?>">
                                            <input id="created_by" type="hidden" name="created_by" value="<?= isset($jobs_data) ? $jobs_data->created_by : ''; ?>">
                                            <input id="employee2_id" type="hidden" name="employee2_id" value="<?= isset($jobs_data) ? $jobs_data->employee2_id : ''; ?>">
                                            <input id="employee3_id" type="hidden" name="employee3_id" value="<?= isset($jobs_data) ? $jobs_data->employee3_id : ''; ?>">
                                            <input id="employee4_id" type="hidden" name="employee4_id" value="<?= isset($jobs_data) ? $jobs_data->employee4_id : ''; ?>">
                                            <input id="employee5_id" type="hidden" name="employee5_id" value="<?= isset($jobs_data) ? $jobs_data->employee5_id : ''; ?>">
                                            <input id="employee6_id" type="hidden" name="employee6_id" value="<?= isset($jobs_data) ? $jobs_data->employee6_id : ''; ?>">
                                            <div class="col-sm-12 text-end">
                                                <?php //if($jobs_data->status == 'Draft' || $jobs_data->status == '0' || $jobs_data->status == '') : ?>
                                                    <div class="form-check float-start">
                                                      <input class="form-check-input" id="SEND_EMAIL_ON_SCHEDULE" type="checkbox">
                                                      <label class="form-check-label" for="SEND_EMAIL_ON_SCHEDULE">
                                                        Send an email after scheduling this job.
                                                      </label>
                                                    </div>
                                                    <button type="submit" class="nsm-button primary"><i class='bx bx-fw bx-calendar-plus'></i>
                                                        <?= isset($jobs_data) ? 'Update' : 'Schedule'; ?>
                                                    </button>
                                                <?php //endif; ?>
                                                <?php if(isset($jobs_data)): ?>
                                                    <button type="button" onclick="location.href='<?= base_url('job/job_preview/'.$this->uri->segment(3)) ?>'" class="nsm-button primary"><i class='bx bx-bx bx-search-alt'></i> Preview</button>
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
                            <table id="items_table" class="table table-hover table-sm w-100">
                                <thead class="bg-light">
                                    <tr>
                                        <td style="width: 0% !important;"></td>
                                        <td><strong>Name</strong></td>
                                        <td><strong>On Hand</strong></td>
                                        <td><strong>Price</strong></td>
                                        <td><strong>Type</strong></td>
                                        <td class='d-none'><strong>Location</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if (!empty($items)) {
                                            foreach ($items as $item) {
                                               $item_qty = get_total_item_qty($item->id);
                                    ?>
                                    <tr id="<?php echo "ITEMLIST_PRODUCT_$item->id"; ?>">
                                        <td style="width: 0% !important;">
                                            <button type="button" data-bs-dismiss="modal" class='btn btn-sm btn-light border-1 select_item' id="<?= $item->id; ?>" data-item_type="<?= ucfirst($item->type); ?>" data-quantity="<?= $item_qty[0]->total_qty; ?>" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>" data-retail="<?= $item->retail; ?>" data-location_name="<?= $item->location_name; ?>" data-location_id="<?= $item->location_id; ?>"><i class='bx bx-plus-medical'></i></button>
                                        </td>
                                        <td><?php echo $item->title; ?></td>
                                        <td><?php foreach($itemsLocation as $itemLoc){
                                            if($itemLoc->item_id == $item->id){
                                                echo "<div class='data-block'>";
                                                echo $itemLoc->name. " = " .$itemLoc->qty;
                                                echo "</div>";
                                            } 
                                        }
                                        ?></td>
                                        <td>
                                            <?php 
                                                if( $item->retail > 0 ){
                                                    echo number_format($item->retail, 2);
                                                }else{
                                                    echo '0.00';
                                                }                                                
                                            ?>                                                
                                        </td>
                                        <td><?php echo $item->type; ?></td>
                                        <td class='d-none'><?php echo $item->location_name; ?></td>
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
                                    <?php if ($estimate->status === 'Accepted'): ?>
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
<?php 
    // echo json_encode($TEST_JOB_INFO);
    foreach ($invoices as $invoice) {
        if ($invoice->job_id == $jobs_data->id) {
            $INVOICE_ID_PREVIEW = $invoice->id;
        }
    }
?>
<div class="modal fade" id="finish_modal" data-bs-backdrop='static' role="dialog">
    <div class="modal-dialog FINISH_MODAL_SIZE">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title FINISH_MODAL_TITLE" style="font-size: 17px;">Finish Job</span>
                <i class="bx bx-fw bx-x m-0 text-muted exit_finish_modal" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body FINISH_MODAL_BODY">
                <form id="update_status_to_closed">
                    <div class="row">
                        <div class="col-sm-12 mt-1 mb-1">
                            <label>This will stop on job duration tracking and mark the job end time.</label>
                        </div>
                        <div class="col-sm-12">
                            <label class="mb-2">Finish job at:</label>
                            <div class="input-group">
                                <input type="date" name="job_start_date" id="job_start_date" class="form-control" value="<?php echo date('Y-m-d');?>" required>
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
                                <a href="#" class="nsm-button primary SEND_INVOICE" style="margin-bottom: 0;">
                                    <span class="bx bx-fw bx-send"></span> Send Invoice
                                </a>
                                <script type="text/javascript">
                                    $('.SEND_INVOICE').on('click', function(event) {
                                        event.preventDefault();
                                        $('.FINISH_MODAL_TITLE').text('Invoice Preview');
                                        $('.FINISH_MODAL_BODY').text('Loading Invoice...');
                                        $('.FINISH_MODAL_BODY').load('<?= base_url('invoice/genview/').$INVOICE_ID_PREVIEW; ?> .invoice-print', function(){
                                            if ($('.FINISH_MODAL_BODY').text().length <= 20) {
                                                $('.FINISH_MODAL_BODY').html(`Unable to Send and Preview an Invoice. This job doesn't have an invoice yet, <a id="CREATE_INVOICE_1" href="#">Create Initial Invoice.</a>`);
                                                $('#CREATE_INVOICE_1').click(function(event) {
                                                    event.preventDefault();
                                                    window.open('<?php echo base_url('job/createInvoice/').$jobs_data->id; ?>', '_blank','location=yes, height=650, width=1200, scrollbars=yes, status=yes');
                                                    $('.FINISH_MODAL_BODY').html(`After creating an Invoice, <a href="#" onclick="window.location.reload();">Refresh this page</a> to load invoice preview.`);
                                                    $('.exit_finish_modal').hide();
                                                });
                                            } else {
                                                $('.FINISH_MODAL_SIZE').addClass('modal-lg modal-dialog-scrollable');
                                                $.get("<?= base_url('job/send_customer_invoice_email/').$jobs_data->job_unique_id; ?>");
                                                $('#finish_modal').on('hide.bs.modal', function (e) {
                                                    window.location.reload();
                                                });
                                            }
                                        });
                                    });
                                </script>
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
                <span class="modal-title content-title" style="font-size: 17px;">Send Esign</span>
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
                        <span>Send eSign</span>
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
var employee_id = $("#employee_id").val();
function getUserInfo(employee_id, type){
    $.ajax({
        url: '<?php echo base_url('users/getUserInfo'); ?>',
        type: 'POST',
        data: {employee_id: employee_id},
        success: function (data) {
            let json = $.parseJSON(data);
            let commission_type = "";
            let commission_percentage = 0.0;
            if (json) {
            // ========================
            if (type == "sales_rep") {
                (json.base_salary) ? $("#SRBS_1").val(json.base_salary).change() : $("#SRBS_1").val(0).change();
                (json.commission_id == 0) ? commission_type = "Percentage (Gross, Net)" : "" ;
                (json.commission_id == 1) ? commission_type = "Net + Percentage" : "" ;
                (json.commission_percentage) ? commission_percentage = json.commission_percentage : commission_percentage = 0;

                $("input[name='commission_type']").val(json.commission_id).change();
                $("input[name='commission_percentage']").val(commission_percentage).change();
                $(".COMMISSION_TYPE").text(commission_type).change();
            }
            // ========================
            if (type == "tech_rep_1") {
                (json.base_salary) ? $("#TRBS_1").val(json.base_salary).change() : $("#TRBS_1").val(0).change()
            }
            // ========================
            if (type == "tech_rep_2") {
                (json.base_salary) ? $("#TRBS_2").val(json.base_salary).change() : $("#TRBS_2").val(0).change();
            }
            // ========================
            if (type == "tech_rep_3") {
               (json.base_salary) ? $("#TRBS_3").val(json.base_salary).change() : $("#TRBS_3").val(0).change();
            }
            // ========================
            if (type == "tech_rep_4") {
                (json.base_salary) ? $("#TRBS_4").val(json.base_salary).change() : $("#TRBS_4").val(0).change();
            }
            // ========================
            if (type == "tech_rep_5") {
                (json.base_salary) ? $("#TRBS_5").val(json.base_salary).change() : $("#TRBS_5").val(0).change();
            }
            // ========================
        }
        }
    });
}

$("#employee_id").on('change', function(event) { getUserInfo($(this).val(), "sales_rep"); });
$("#EMPLOYEE_SELECT_2").on('change', function(event) { getUserInfo($(this).val(), "tech_rep_1"); });
$("#EMPLOYEE_SELECT_3").on('change', function(event) { getUserInfo($(this).val(), "tech_rep_2"); });
$("#EMPLOYEE_SELECT_4").on('change', function(event) { getUserInfo($(this).val(), "tech_rep_3"); });
$("#EMPLOYEE_SELECT_5").on('change', function(event) { getUserInfo($(this).val(), "tech_rep_4"); });
$("#EMPLOYEE_SELECT_6").on('change', function(event) { getUserInfo($(this).val(), "tech_rep_5"); });


$('#adjustment_mm, #CUSTOMER_FUNDED_AMOUNT, #CUSTOMER_PASS_THROUGH, #SRBS_1, #TRBS_1, #TRBS_2, #TRBS_3, #TRBS_4, #TRBS_5, input[name="commission_type"], input[name="commission_percentage"], input[name="commission_amount"], input[name="input_totalFixCost"], input[name="input_totalEquipmentMargin"], input[name="input_totalAmountCollected"], input[name="input_totalJobGrossProfit"], select[name="tax_percentage"]').on('change', function(event) {
    let totalAmountCollected = $('input[name="total_amount"]').val();
    let funded_amount = parseFloat($("#CUSTOMER_FUNDED_AMOUNT").val());
    let net_margin = parseFloat($('input[name="input_totalEquipmentMargin"]').val());
    let rep_pay = parseFloat($("#SRBS_1").val());
    let tech_pay = parseFloat($("#TRBS_1").val()) + parseFloat($("#TRBS_2").val()) + parseFloat($("#TRBS_3").val()) + parseFloat($("#TRBS_4").val()) + parseFloat($("#TRBS_5").val());
    let fix_cost = parseFloat($('input[name="input_totalFixCost"]').val());
    let pass_through = parseFloat($("#CUSTOMER_PASS_THROUGH").val());
    let monitoring_cost = parseFloat($('input[name="monthly_monitoring"]').val());
    let JOB_GROSS_PROFIT = (funded_amount + net_margin) - (rep_pay + tech_pay + fix_cost + pass_through + monitoring_cost);

    console.clear();
    // console.log("==========");
    // console.log("funded_amount: "+funded_amount);
    // console.log("net_margin: "+net_margin);
    // console.log("rep_pay: "+rep_pay);
    // console.log("tech_pay: "+tech_pay);
    // console.log("fix_cost: "+fix_cost);
    // console.log("pass_through: "+pass_through);
    // console.log("monitoring_cost: "+monitoring_cost);
    // console.log("JOB GROSS PROFIT: "+JOB_GROSS_PROFIT);
    // console.log("==========");
    $("#totalJobGrossProfit").text(currencyFormatter(JOB_GROSS_PROFIT));
    $("input[name='input_totalJobGrossProfit']").val(JOB_GROSS_PROFIT);
    $("#totalAmountCollected").text(currencyFormatter(totalAmountCollected));
    $("input[name='input_totalAmountCollected']").val(totalAmountCollected);
});

function currencyFormatter(amount) {
  if (isNaN(amount)) {
    return "$0.00";
  } else {
    var numberFormatter = new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' });
    return numberFormatter.format(amount);
  }
}

$("#employee_id").on('change', function(event) {
    let salesRep = $("#employee_id option:selected").text();
    $("#selectedRep").text((salesRep !== "Select All") ? salesRep : "—");
});

function getTotalCommission(){
    let totalCommission = 0.0;
    let totalMargin = 0.0;
    let salesRep = $("#employee_id option:selected").text();
    let totalAmountCollected = $('input[name="total_amount"]').val(); 
    let totalTaxAmount = $("#tax_total_form_input").val();
    $('.job_items_tbl tr').each(function() {
      let commissionValue = $(this).find('td:eq(4) input').val();
      let marginValue = $(this).find('td:eq(5) input').val();
        totalCommission += parseFloat(commissionValue);
        totalMargin += parseFloat(marginValue);
    })
    $("input[name='commission_amount']").val(totalCommission.toFixed(2));
    $("#selectedRep").text((salesRep !== "Select All") ? salesRep : "—");
    $("#totalRepCommissionProfit").text(currencyFormatter(totalCommission));
    $("#totalEquipmentMargin").text(currencyFormatter(totalMargin));
    $("#totalAmountCollected").text(currencyFormatter(totalAmountCollected));
    // $("#totalJobGrossProfit").text(currencyFormatter(totalAmountCollected));

    $("input[name='input_totalEquipmentMargin']").val(totalMargin.toFixed(2)).change();
    $("input[name='input_totalAmountCollected']").val(totalAmountCollected).change();
}

const job_items_tbl = $('.job_items_tbl')[0];
const observer = new MutationObserver(() => getTotalCommission());
const config = { childList: true, subtree: true, characterData: true };
observer.observe(job_items_tbl, config);

$('input[name="CC_CREDITCARDNUMBER"], input[name="DC_CREDITCARDNUMBER"], input[name="OCCP_CREDITCARDNUMBER"]').on('keyup', function() {
  this.value = this.value.replace(/\D/g, '').replace(/(.{4})/g, '$1 ').trim().substr(0, 19);
});

$('input[name="CC_EXPIRATION"], input[name="DC_EXPIRATION"], input[name="OCCP_EXPIRATION"]').on('keyup', function() {
  this.value = this.value.replace(/\D/g, '').replace(/^(\d{2})(\d)/, '$1/$2').substr(0, 5);
});

$('input[name="CC_CVV"], input[name="DC_CVV"], input[name="OCCP_CVV"]').on('keyup', function() {
  this.value = this.value.replace(/\D/g, '').substr(0, 3);
});

$('input[name="CHECK_CHECKNUMBER"]').on('input', function() {
  this.value = this.value.replace(/\D/g, '').substr(0, 6);
});
$('input[name="CHECK_ROUTINGNUMBER"], input[name="ACH_ROUTINGNUMBER"]').on('input', function() {
  this.value = this.value.replace(/\D/g, '').substr(0, 9);
});
$('input[name="CHECK_ACCOUNTNUMBER"], input[name="ACH_ACCOUNTNUMBER"]').on('input', function() {
  this.value = this.value.replace(/\D/g, '').substr(0, 12);
});

$(document).ready(function() {
    if(employee_id) { getUserInfo(employee_id, "sales_rep"); }
    if($("#EMPLOYEE_SELECT_2").val()) { getUserInfo($("#EMPLOYEE_SELECT_2").val(), "tech_rep_1"); }
    if($("#EMPLOYEE_SELECT_3").val()) { getUserInfo($("#EMPLOYEE_SELECT_3").val(), "tech_rep_2"); }
    if($("#EMPLOYEE_SELECT_4").val()) { getUserInfo($("#EMPLOYEE_SELECT_4").val(), "tech_rep_3"); }
    if($("#EMPLOYEE_SELECT_5").val()) { getUserInfo($("#EMPLOYEE_SELECT_5").val(), "tech_rep_4"); }
    if($("#EMPLOYEE_SELECT_6").val()) { getUserInfo($("#EMPLOYEE_SELECT_6").val(), "tech_rep_5"); }
    $('select[name="BILLING_METHOD"]').val("<?php echo $jobs_data->BILLING_METHOD ?>").change();
    getTotalCommission();

    ($("#adjustment_ic").val() == 0) ? $("#adjustment_ic").val(0).change() : $("#adjustment_ic").change();
    ($("#adjustment_otps").val() == 0) ? $("#adjustment_otps").val(0).change() : $("#adjustment_otps").change();
    ($("#adjustment_mm").val() == 0) ? $("#adjustment_mm").val(0).change() : $("#adjustment_mm").change();
});

$('select[name="BILLING_METHOD"]').change(function(event) {
    let optionValue = $(this).val();
    if (optionValue == "CC") { $(".HIDE_ALL_INPUTS").hide(); $(".CC_INPUTS").fadeIn('fast'); }
    if (optionValue == "DC") { $(".HIDE_ALL_INPUTS").hide(); $(".DC_INPUTS").fadeIn('fast'); }
    if (optionValue == "CHECK") { $(".HIDE_ALL_INPUTS").hide(); $(".CHECK_INPUTS").fadeIn('fast'); }
    if (optionValue == "CASH") { $(".HIDE_ALL_INPUTS").hide(); $(".CASH_INPUTS").fadeIn('fast'); }
    if (optionValue == "ACH") { $(".HIDE_ALL_INPUTS").hide(); $(".ACH_INPUTS").fadeIn('fast'); }
    if (optionValue == "VENMO") { $(".HIDE_ALL_INPUTS").hide(); $(".VENMO_INPUTS").fadeIn('fast'); }
    if (optionValue == "PP") { $(".HIDE_ALL_INPUTS").hide(); $(".PP_INPUTS").fadeIn('fast'); }
    if (optionValue == "SQ") { $(".HIDE_ALL_INPUTS").hide(); $(".SQ_INPUTS").fadeIn('fast'); }
    if (optionValue == "WW") { $(".HIDE_ALL_INPUTS").hide(); $(".WW_INPUTS").fadeIn('fast'); }
    if (optionValue == "HOF") { $(".HIDE_ALL_INPUTS").hide(); $(".HOF_INPUTS").fadeIn('fast'); }
    if (optionValue == "ET") { $(".HIDE_ALL_INPUTS").hide(); $(".ET_INPUTS").fadeIn('fast'); }
    if (optionValue == "INV") { $(".HIDE_ALL_INPUTS").hide(); $(".INV_INPUTS").fadeIn('fast'); }
    if (optionValue == "OCCP") { $(".HIDE_ALL_INPUTS").hide(); $(".OCCP_INPUTS").fadeIn('fast'); }
    if (optionValue == "OPT") { $(".HIDE_ALL_INPUTS").hide(); $(".OPT_INPUTS").fadeIn('fast'); }
});

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
        $("#TRBS_"+TOTAL).val(0);
        if (TOTAL > 1 && TOTAL <= 5) {
            $(".ASSIGNED_TO_" + TOTAL + "> select").val('').change();
            $('.ASSIGNED_TO_' + TOTAL).hide();
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
            '<div>'+repo.first_name + ' ' + repo.last_name +'<br><small>'+repo.phone_m+' / '+repo.email+'</small></div>'
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

        $("#tax_rate").select2({
            placeholder: "Select Rate..."
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
<script>
    window.addEventListener('DOMContentLoaded', async (event) => {
        const params = new Proxy(new URLSearchParams(window.location.search), {
            get: (searchParams, prop) => searchParams.get(prop),
        });

        const jobStatus = "<?= $jobs_data ? $jobs_data->status : ''; ?>";
        const jobId = "<?= $jobs_data ? $jobs_data->id : ''; ?>";

        if (params.modal && params.modal === 'finish_job' && jobStatus === 'Approved') {
            const response = await Swal.fire({
                title: 'Job is finished',
                icon: 'success',
                text: 'Invoice is generated and ready to view',
                confirmButtonText: 'See details',
            })

            if (response.isConfirmed && jobId) {
                window.location.href = `/job/viewInvoice/${jobId}`;
            }
        }
    });
</script>

<script src="<?=base_url("assets/js/jobs/manage.js")?>"></script>