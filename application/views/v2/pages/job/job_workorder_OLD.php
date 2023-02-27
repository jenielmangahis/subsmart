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
</style>

<?php if(isset($jobs_data)): ?>
    <input type="hidden" value="<?php echo $jobs_data->id ?>" id="esignJobId" />
<?php endif; ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo base_url('job/new_job1') ?>'">
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
                            <div class="col-md-4">
                                <div class="nsm-card primary" style="margin-top: 30px;">
                                    <div class="nsm-card-header d-block">
                                        <div class="nsm-card-title">
                                            <span>From Work Order to Job</span>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
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
                                                    <input type="date" name="start_date" id="start_date" class="form-control" value="<?php echo isset($jobs_data) ?  $jobs_data->date_issued : '';  ?>" required>&nbsp;&nbsp;
                                                </div>
                                                <div class="col-lg-5">
                                                    <select id="start_time" name="start_time" class="nsm-field form-select" required>
                                                        <option value="">Start time</option>
                                                        <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                                            <option <?php echo isset($jobs_data) && strtolower($jobs_data->start_time) == time_availability($x) ?  'selected' : '';  ?> value="<?php echo time_availability($x); ?>"><?php echo time_availability($x); ?></option>
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
                                                    <input type="date" name="end_date" id="end_date" class="form-control mr-2" value="<?php echo isset($jobs_data) ?  $jobs_data->date_issued : '';  ?>" required>
                                                </div>
                                                <div class="col-lg-5">
                                                    <select id="end_time" name="end_time" class="nsm-field form-select " required>
                                                        <option value="">End time</option>
                                                        <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                                            <option <?php echo isset($jobs_data) && strtolower($jobs_data->end_time) == time_availability($x) ?  'selected' : '';  ?> value="<?php echo time_availability($x); ?>"><?php echo time_availability($x); ?></option>
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
                                                        <option <?php echo isset($jobs_data) && $jobs_data->employee_id == $employee->id ? 'selected' : '';  ?> value="<?php echo $employee->id; ?>"><?php echo $employee->FName.','.$employee->LName; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select><br>
                                        <div class="color-box-custom">
                                            <h6>Event Color on Calendar</h6>
                                            <ul>
                                                <?php if(isset($color_settings)): ?>
                                                    <?php foreach ($color_settings as $color): ?>
                                                        <li>
                                                            <a style="background-color: <?php echo $color->color_code; ?>;" id="<?php echo $color->id; ?>" type="button" class="btn btn-default color-scheme btn-circle bg-1" title="<?php echo $color->color_name; ?>">
                                                                <?php if(isset($jobs_data) && $jobs_data->event_color == $color->id) {echo '<i class="bx bx-check"></i>'; } ?>
                                                            </a>
                                                        </li>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </ul>
                                            <input value="<?php echo (isset($jobs_data) && $jobs_data->event_color == $color->id) ? $jobs_data->event_color : ''; ?>" id="job_color_id" name="event_color" type="hidden" />
                                        </div>
                                        <h6>Customer Reminder Notification</h6>
                                        <select name="customer_reminder_notification" class="form-control ">
                                            <option value="0">None</option>
                                            <option <?php echo (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT5M') ? 'selected' : ''; ?> value="PT5M">5 minutes before</option>
                                            <option <?php echo (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT15M') ? 'selected' : ''; ?> value="PT15M">15 minutes before</option>
                                            <option <?php echo (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT30M') ? 'selected' : ''; ?> value="PT30M">30 minutes before</option>
                                            <option <?php echo (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT1H') ? 'selected' : ''; ?> value="PT1H">1 hour before</option>
                                            <option <?php echo (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT2H') ? 'selected' : ''; ?> value="PT2H">2 hours before</option>
                                            <option <?php echo (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT4H') ? 'selected' : ''; ?> value="PT4H">4 hours before</option>
                                            <option <?php echo (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT6H') ? 'selected' : ''; ?> value="PT6H">6 hours before</option>
                                            <option <?php echo (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT8H') ? 'selected' : ''; ?> value="PT8H">8 hours before</option>
                                            <option <?php echo (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT12H') ? 'selected' : ''; ?> value="PT12H">12 hours before</option>
                                            <option <?php echo (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT16H') ? 'selected' : ''; ?> value="PT16H">16 hours before</option>
                                            <option <?php echo (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'P1D') ? 'selected' : ''; ?> value="P1D" selected="selected">1 day before</option>
                                            <option <?php echo (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'P2D') ? 'selected' : ''; ?> value="P2D">2 days before</option>
                                            <option <?php echo (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT0M') ? 'selected' : ''; ?> value="PT0M">On date of event</option>
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
                                                    <option <?php if(isset($jobs_data) && $jobs_data->job_type == $type->title) {echo 'selected'; } ?> value="<?php echo $type->title; ?>"><?php echo $type->title; ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select><br>
                                        <h6>Select Job Tag</h6>
                                        <select id="job_tags" name="tags" class="form-control " required>
                                            <option value="">Select Tags</option>
                                            <?php if(!empty($tags)): ?>
                                                <?php foreach ($tags as $tag): ?>
                                                    <option <?php if(isset($jobs_data) && $jobs_data->tags == $tag->name) {echo 'selected'; } ?> value="<?php echo $tag->id; ?>"><?php echo $tag->name; ?></option>
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
                                            <b>Created By: </b>&nbsp;&nbsp; <span> <?php echo ' '.$logged_in_user->FName.' '.$logged_in_user->LName; ?></span>
                                            
                                        </div>
                                    </div>     
                                    <div class="nsm-card-content">
                                        <div class="row">
                                            
                                            <hr>
                                            <div class="col-md-4">
                                                <h6>Customer Info</h6>
                                                <select id="customer_id" name="customer_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select"  required>
                                                    <?php if( $default_customer_id > 0 ){ ?>
                                                        <option value="<?php echo $default_customer_id; ?>"><?php echo $default_customer_name; ?></option>
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
                                                        <input type="text" id="job_type" name="job_type" value="<?php echo isset($jobs_data) ? $jobs_data->job_type : ''; ?>" class="form-control" readonly>
                                                    </td>
                                                    <td>
                                                        <small>Job Tags</small>
                                                        <input type="text" name="job_tag" class="form-control" value="<?php echo isset($jobs_data) ? $jobs_data->tags : ''; ?>" id="job_tags_right" readonly>
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
                                                            <input value="<?php echo $item->title; ?>" type="text" name="item_name[]" class="form-control" >
                                                            <input type="hidden" value='<?php echo $item->id ?>' name="item_id[]">
                                                        </td>
                                                        <td width="20%"><small>Qty</small>
                                                            <input data-itemid='<?php echo $item->id ?>'  id='<?php echo $item->id ?>' value='<?php echo $item->qty; ?>' type="number" name="item_qty[]" class="form-control qty">
                                                        </td>
                                                        <td width="20%"><small>Unit Price</small>
                                                            <input id='price<?php echo $item->id ?>' value='<?php echo $item->price; ?>'  type="number" name="item_price[]" class="form-control" placeholder="Unit Price">
                                                        </td>
                                                        <!--<td width="10%"><small>Unit Cost</small><input type="text" name="item_cost[]" class="form-control"></td>-->
                                                        <!--<td width="25%"><small>Inventory Location</small><input type="text" name="item_loc[]" class="form-control"></td>-->
                                                        <td width="20%"><small>Item Type</small><input readonly type="text" class="form-control" value='<?php echo $item->type ?>'></td>
                                                        <td style="text-align: center" class="d-flex" width="15%">
                                                            <b data-subtotal='<?php echo $total ?>' id='sub_total<?php echo $item->id ?>' class="total_per_item"><?php echo number_format((float)$total,2,'.',',');?></b>
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
                                            <textarea name="job_description" class="form-control" required=""><?php echo isset($jobs_data) ? $jobs_data->job_description : ''; ?></textarea>
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
                                                                        <img style="width: 100%" id="attachment-image" alt="Attachment" src="<?php echo isset($jobs_data) ? $jobs_data->attachment : "/uploads/jobs/attachment/placeholder.jpg"; ?> ">
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
                                                        <label id="invoice_sub_total">$<?php echo isset($jobs_data) ? number_format((float)$subtotal,2,'.',',') : '0.00'; ?></label>
                                                        <input type="hidden" name="sub_total" id="sub_total_form_input" value='0'>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <hr>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <small>Tax Rate</small>
                                                        <!--<a href="<?php echo base_url('job/settings') ?>"><span class="fa fa-plus" style="margin-left:50px;"></span></a>-->
                                                        <select id="tax_rate" name="tax_rate" class="form-control">
                                                            <option value="0">None</option>
                                                            <?php foreach ($tax_rates as $rate) : ?>
                                                                <option value="<?php echo $rate->percentage / 100; ?>"><?php echo $rate->name; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6 text-right pr-3">
                                                        <label id="invoice_tax_total"><?php echo $jobs_data->taxes != null ? $jobs_data->taxes : '0.00' ?></label>
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
                                                        <label id="invoice_overall_total">$<?php echo isset($jobs_data) ? number_format((float)$subtotal,2,'.',',') : '0.00'; ?></label>
                                                        <input type="hidden" name="sub_total" id="sub_total_form_input" value='0'>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <hr>
                                                </div>
                                                <div class="col-sm-12" id="approval_card_right" style="display: <?php echo isset($jobs_data) ? 'block' : 'none' ;?>;">
                                                    <div style="float: right;">
                                                        <?php if(isset($jobs_data) && $jobs_data->signature_link != '') : ?>
                                                        <a href="javascript:void(0);" id="approval_btn_right"><span class="fa fa-columns" style="float: right;padding-right: 20px;"></span></a>

                                                        <center>
                                                            <img width="150" id="customer_signature_right" alt="Customer Signature" src="<?php echo isset($jobs_data) ? $jobs_data->signature_link : ''; ?>">
                                                        </center>

                                                        <center><span id="appoval_name_right"><?php echo isset($jobs_data->authorize_name) ? $jobs_data->authorize_name : 'Xxxxx Xxxxxx'; ?></span></center><br>
                                                        <span>-----------------------------</span><br>
                                                        <center><small>Approved By</small></center><br>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="col-sm-12">
                                                    <div class="card box_right" id="notes_right_card" style="display: <?php echo isset($jobs_data) ? 'block' : 'none' ;?>;">
                                                        <div class="row">
                                                            <div class="col-md-12 ">
                                                                <div class="card-header">
                                                                    <a href="javascript:void(0);" id="notes_right"><span class="fa fa-columns" style="float: right;padding-right: 20px;"></span></a>
                                                                    <h5 style="padding-left: 20px;" class="mb-0">Notes</h5>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div id="notes_edit_btn_right" class="pencil" style="width:100%; height:100px;cursor: pointer;">
                                                                        <?php echo isset($jobs_data) ? $jobs_data->message : ''; ?>
                                                                    </div>
                                                                    <div id="notes_input_div_right" style="display:none;">
                                                                        <div style=" height:70px;margin-bottom: 10px;">
                                                                            <textarea name="message" cols="40" style="width: 100%;" rows="3" id="note_txt_right" class="input"><?php echo isset($jobs_data) ? $jobs_data->message : ''; ?></textarea>
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
                                                    <div class="card box_right" id="url_right_card" style="display: <?php echo isset($jobs_data) ? 'block' : 'none' ;?>;">
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
                                                                        <a  target="_blank" href="<?php echo $jobs_data->link; ?>"><p style="color: darkred;"><?php echo $jobs_data->link; ?></p></a>
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
                                                    <input class="form-control" value="Thank you for your business, Please call <?php echo $company_info->business_name; ?> at (<?php echo $company_info->business_phone; ?>) for quality customer service.">
                                                </div>
                                                <div class="col-sm-12">
                                                    <hr>
                                                </div>
                                                <?php if(isset($jobs_data) && $jobs_data->status == 'Invoiced'): ?>
                                                <div class="col-sm-12">
                                                    <div class="card box_right" id="pd_right_card" style="display: <?php echo isset($jobs_data) ? 'block' : 'none' ;?>;">
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
                                                                                    <?php echo isset($jobs_data) ? $jobs_data->method : ''; ?>
                                                                                </span>
                                                                            </td>
                                                                            <td>
                                                                                <b>Amount</b><br>
                                                                                <span class="help help-sm help-block" id="pay_amount_right">
                                                                                    <?php echo  isset($jobs_data) && $jobs_data->amount != NULL ? '$'.$jobs_data->amount : '$0.00'; ?>
                                                                                </span>
                                                                            </td>
                                                                            <td>
                                                                                <b>Account Name</b><br>
                                                                                <span class="help help-sm help-block">
                                                                                <?php echo isset($jobs_data) && $jobs_data->account_name != NULL ? $jobs_data->account_name : 'n/a'; ?>
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
                                                                    <a href="#" id="" data-bs-toggle="modal" data-bs-target="#new_inventory" type="button" class="nsm-button primary float-sm-end"><span class="fa fa-plus" ></span> Add New Item</a>
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
                                                                                    <td ><?php echo $item->title; ?></td>
                                                                                    <td ><?php echo $item->points; ?></td>
                                                                                    <td ><?php echo number_format((float)$item->price,2,'.',',');?></td>
                                                                                    <td id="device_qty<?php echo $item->id; ?>"><?php echo $item->qty; ?></td>
                                                                                    <td ><?php echo number_format((float)$total,2,'.',',');?></td>
                                                                                    <td ><?php echo $item->location; ?></td>
                                                                                    <td ><a href="#" data-name='<?php echo $item->title; ?>' data-price='<?php echo $item->price; ?>' data-quantity='<?php echo $item->qty; ?>' id="<?php echo $item->id; ?>" class="edit_item_list">
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
                                            <input id="created_by" type="hidden" name="created_by" value="<?php echo $logged_in_user->id; ?>">
                                            <input id="employee2_id" type="hidden" name="employee2_id" value="<?php echo isset($jobs_data) ? $jobs_data->employee2_id : ''; ?>">
                                            <input id="employee3_id" type="hidden" name="employee3_id" value="<?php echo isset($jobs_data) ? $jobs_data->employee3_id : ''; ?>">
                                            <input id="employee4_id" type="hidden" name="employee4_id" value="<?php echo isset($jobs_data) ? $jobs_data->employee4_id : ''; ?>">
                                            <div class="col-sm-12 text-end">
                                                
                                                <button type="submit" class="nsm-button primary"><i class='bx bx-fw bx-calendar-plus'></i> Schedule</button>
                                                <a href="<?php echo base_url('job/job_preview/'.$this->uri->segment(3)) ?>" class="nsm-button primary">Preview</a>
                                                <!-- <?php //if(!isset($jobs_data) || $jobs_data->status == 'Scheduled') : ?>
                                                    <button type="submit" class="nsm-button primary"><i class='bx bx-fw bx-calendar-plus'></i> Schedule</button>
                                                    <?php //endif; ?> -->
                                                <!-- <?php //if(isset($jobs_data)): ?>
                                                    <a href="<?// base_url('job/job_preview/'.$this->uri->segment(3)) ?>" class="nsm-button primary">
                                                        <i class='bx bx-bx fa-search-plus'></i> Preview
                                                    </a>
                                                <?php //endif; ?> -->
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
                                    <tr>
                                        <td><?php echo $item->title; ?></td>
                                        <td><?php echo $item_qty[0]->total_qty > 0 ? $item_qty[0]->total_qty : 0; ?></td>
                                        <td><?php echo $item->price; ?></td>
                                        <td><?php echo ucfirst($item->type); ?></td>
                                        <td>
                                            <button id="<?php echo $item->id; ?>" data-item_type="<?php echo ucfirst($item->type); ?>" data-quantity="<?php echo $item->units; ?>" data-itemname="<?php echo $item->title; ?>" data-price="<?php echo $item->price; ?>" type="button" data-bs-dismiss="modal" class="nsm-button primary select_item">
                                            <i class='bx bx-plus'></i>
                                            </button>
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
                                        <td><?php echo $estimate->estimate_number; ?></td>
                                        <td><?php echo $estimate->job_name; ?></td>
                                        <td><?php echo date('M d, Y', strtotime($estimate->estimate_date)); ?></td>
                                        <td>
                                            <a href="<?php echo base_url('job/estimate_job/'. $estimate->id) ?>" id="<?php echo $estimate->id; ?>" type="button" class="btn btn-sm btn-default">
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
                            <option <?php if(isset($jobs_data) && $jobs_data->employee2_id == $employee->id) {echo 'selected'; } ?> value="<?php echo $employee->id; ?>"><?php echo $employee->LName.','.$employee->FName; ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>

                <label>Employee 2</label>
                <select id="employee3" name="employee3_" class="form-control">
                    <option value="">Select Employee</option>
                    <?php if(!empty($employees)): ?>
                        <?php foreach ($employees as $employee): ?>
                            <option <?php if(isset($jobs_data) && $jobs_data->employee3_id == $employee->id) {echo 'selected'; } ?> value="<?php echo $employee->id; ?>"><?php echo $employee->LName.','.$employee->FName; ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>

                <label>Employee 3</label>
                <select id="employee4" name="employee4_" class="form-control">
                    <option value="">Select Employee</option>
                    <?php if(!empty($employees)): ?>
                        <?php foreach ($employees as $employee): ?>
                            <option <?php if(isset($jobs_data) && $jobs_data->employee4_id == $employee->id) {echo 'selected'; } ?> value="<?php echo $employee->id; ?>"><?php echo $employee->LName.','.$employee->FName; ?></option>
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
<div class="modal fade" id="omw_modal" role="dialog">
    <div class="close-modal" data-bs-dismiss="modal">&times;</div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Arrival</h4>
            </div>
            <form id="update_status_to_omw">
            <div class="modal-body">
                <p>This will start travel duration tracking.</p>
                <p>Arrive at:</p>
                <input type="date" name="omw_date" id="omw_date" class="form-control" required>
                <input type="hidden" name="id" id="jobid" value="<?php if(isset($jobs_data)){echo $jobs_data->job_unique_id;} ?>">
                <input type="hidden" name="status" id="status" value="Arrival">
                <select id="omw_time" name="omw_time" class="form-control" required>
                    <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                        <option <?php echo isset($jobs_data) && strtolower($jobs_data->start_time) == time_availability($x) ?  'selected' : '';  ?> value="<?php echo time_availability($x); ?>"><?php echo time_availability($x); ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">
                    <span class="fa fa-paper-plane-o"></span> Save
                </button>
                <button type="button" id="" class="btn btn-default" data-bs-dismiss="modal">
                    <span class="fa fa-remove"></span> Close
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Start Job Modal -->
<div class="modal fade" id="start_modal" role="dialog">
    <div class="close-modal" data-bs-dismiss="modal">&times;</div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Start Job</h4>
            </div>
            <form id="update_status_to_started">
                <div class="modal-body">
                    <p>This will stop travel duration tracking and start on job duration tracking.</p>
                    <p>Start job at:</p>
                    <input type="date" name="job_start_date" id="job_start_date" class="form-control" required>
                    <input type="hidden" name="id" id="jobid" value="<?php if(isset($jobs_data)){echo $jobs_data->job_unique_id;} ?>">
                    <input type="hidden" name="status" id="status" value="Started">
                    <select id="job_start_time" name="job_start_time" class="form-control" required>
                        <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                            <option <?php echo isset($jobs_data) && strtolower($jobs_data->start_time) == time_availability($x) ?  'selected' : '';  ?> value="<?php echo time_availability($x); ?>"><?php echo time_availability($x); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <span class="fa fa-paper-plane-o"></span> Save
                    </button>
                    <button type="button" id="" class="btn btn-default" data-bs-dismiss="modal">
                        <span class="fa fa-remove"></span> Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

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
                            <option <?php echo isset($jobs_data) && strtolower($jobs_data->start_time) == time_availability($x) ?  'selected' : '';  ?> value="<?php echo time_availability($x); ?>"><?php echo time_availability($x); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-12">
                    <div class="col-md-12">
                        <a href="<?php echo base_url('job/billing/').$jobs_data->job_unique_id; ?>">
                            <button type="button" class="btn btn-primary">
                                <span class="fa fa-money"></span> Pay Now
                            </button>
                        </a>

                        <a href="<?php echo base_url('job/send_customer_invoice_email/').$jobs_data->job_unique_id; ?>" class="btn btn-primary">
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
    //'https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js',
    //'assets/textEditor/summernote-bs4.js',
    'assets/js/esign/docusign/workorder.js',
    'assets/js/esign/jobs/esign.js',
));
?>
<?php include viewPath('v2/includes/footer'); ?>

<link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo google_credentials()['api_key'] ?>&callback=initialize&libraries=&v=weekly"></script>
<script src="https://momentjs.com/downloads/moment-with-locales.js"></script>

<?php include viewPath('v2/pages/job/js/job_new_js'); ?>
<script>
    $(function(){
        $("#customer_id").select2({
            placeholder: "Select Customer"
        });
        $("#employee_id").select2({
            placeholder: "Select Employee"
        });
        $("#sales_rep").select2({
            placeholder: "Sales Rep"
        });
        $("#priority").select2({
            placeholder: ""
        });
    });
</script>
<script>
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
                console.log('Geocode was not successful for the following reason: ' + status);
            }
        });
    }
    $("body").delegate(".color-scheme", "click", function(){
            var id = this.id;
            $('[id="job_color_id"]').val(id);
            $( "#"+id ).append( "<i class=\"bx bx-check calendar_button\" style=\"color:#ffffff\" aria-hidden=\"true\"></i>" );
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
