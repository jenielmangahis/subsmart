<?php include viewPath('v2/pages/job/css/job_new'); ?>
<style>
    .custom-job-header{
        background-color: #6a4a86;
        color: #ffffff;
        font-size: 15px;
        padding: 10px;
    }

    .custom-ticket-header {
        background-color: #6a4a86;
        color: #ffffff;
        font-size: 15px !important;
        padding: 10px;
        display: block;
    }

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
        color: #6a4a86 !important;
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
    /*.dataTables_filter, .dataTables_length{
        display: none;
    }*/
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
    #invoice_sub_total{
        font-weight: bold;
    }

    #quick-add-job-form-container .nsm-table thead td{
        background-color:#6a4a86;
        color:#ffffff;
    }
    #quick-add-job-form-container #modal_items_list td:nth-child(8){
        text-align:right !important;
    }
    .cc-expiry-month, .cc-expiry-year{
        display:inline-block;
        width:44% !important;
        flex:none !important;
    }
    .cc-separator{
        display: inline-block;
        padding: 6px;
        font-size: 16px;
    }
    .block-label{
        display:block;
        height:30px;
    }
    .block-label a{
        float:right;
    }
    .block-label b{
        position:relative;
        top:10px;
    }
    .btn-use-different-address{
        padding:0px !important;
    }
</style>
<input type="hidden" name="job_location" id="job-location" value="" />
<input type="hidden" name="job_address" id="job-address" value="" />
<input type="hidden" name="job_city" id="job-city" value="" />
<input type="hidden" name="job_state" id="job-state" value="" />
<input type="hidden" name="job_zip" id="job-zip" value="" />
<div class="row page-content g-0">    
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">                             
                
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="nsm-card primary">     
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span class="custom-ticket-header"><i class='bx bx-wrench'></i> Job Information</span>
                                </div>
                            </div>                               
                            <div class="nsm-card-content">                                       
                                <div class="form-group">
                                    <div class="row g-3 align-items-center mb-3">
                                        <div class="col-sm-2">
                                        <label>From:</label>
                                        </div>
                                        <div class="col-sm-5">
                                        <input type="date" name="start_date" id="start_date" class="form-control" value="<?= $default_start_date; ?>" required>
                                        </div>
                                        <div class="col-sm-5">                                                 
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
                                        <input type="date" name="end_date" id="end_date" class="form-control mr-2" value="<?= $default_start_date;  ?>" required>
                                        </div>
                                        <div class="col-sm-5">
                                            <select id="end_time" name="end_time" class="nsm-field form-select " required>
                                                <option value="">End time</option>
                                                <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                                    <option value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
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
                                        <?php if(!empty($sales_rep)): ?>
                                            <?php foreach ($sales_rep as $employee): ?>
                                                <option value="<?= $employee->id; ?>"><?= $employee->FName.','.$employee->LName; ?></option>
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
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </ul>
                                    <input value="" id="job_color_id" name="event_color" type="hidden" />
                                </div>
                                <div class="mb-3">
                                    <h6>Customer Reminder Notification</h6>
                                    <select id="customer_reminder" name="customer_reminder_notification" class="form-control ">
                                        <option value="0">None</option>
                                        <option value="PT5M">5 minutes before</option>
                                        <option value="PT15M">15 minutes before</option>
                                        <option value="PT30M">30 minutes before</option>
                                        <option value="PT1H">1 hour before</option>
                                        <option value="PT2H">2 hours before</option>
                                        <option value="PT4H">4 hours before</option>
                                        <option value="PT6H">6 hours before</option>
                                        <option value="PT8H">8 hours before</option>
                                        <option value="PT12H">12 hours before</option>
                                        <option value="PT16H">16 hours before</option>
                                        <option value="P1D" selected="selected">1 day before</option>
                                        <option value="P2D">2 days before</option>
                                        <option value="PT0M">On date of event</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <h6>Time Zone</h6>
                                    <select id="inputState" name="timezone" class="form-control ">
                                        <?php foreach (config_item('calendar_timezone') as $key => $zone) { ?>
                                            <option value="<?php echo $key ?>" <?= $settings && $settings->timezone == $key ? 'selected="selected"' : ''; ?>>
                                                <?php echo $zone ?>
                                            </option>
                                        <?php } ?>
                                        <!-- <option value="utc5">Central Time (UTC -5)</option> -->
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <h6 style="line-height:22px;">Job Type</h6>
                                        <a class="btn-small nsm-button nsm-link d-flex align-items-center" id="btn-quick-add-job-type" href="javascript:void(0);">
                                            Add New
                                        </a>
                                    </div> 
                                    <select id="job_type_option" name="job_type" class="form-control " required>
                                        <option value="">Select Type</option>
                                        <?php if(!empty($job_types)): ?>
                                            <?php foreach ($job_types as $type): ?>
                                                <option value="<?= $type->title; ?>" data-image="<?= $type->icon_marker; ?>"><?= $type->title; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <h6 style="line-height:22px;">Job Tag</h6>
                                        <a class="btn-small nsm-button nsm-link d-flex align-items-center" id="btn-quick-add-job-tag" href="javascript:void(0);">
                                            Add New
                                        </a>
                                    </div>
                                    <select id="job_tags" name="tags" class="form-control " required>
                                        <option value="">Select Tags</option>
                                        <?php if(!empty($tags)): ?>
                                            <?php foreach ($tags as $tag): ?>
                                                <option value="<?= $tag->name; ?>" data-image="<?= $tag->marker_icon; ?>"><?= $tag->name; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div>
                                    <h6>Assigned To</h6>
                                    <div class="row">
                                        <div class="col-sm-12 mb-2 ASSIGNED_TO_1">
                                            <input type="text" id="emp2_id" name="emp2_id" value= "" hidden>
                                            <select id="EMPLOYEE_SELECT_2" name="employee2_" class="form-control">
                                                <option value="">Select Employee</option>
                                                <?php if(!empty($employees)): ?>
                                                    <?php foreach ($employees as $employee): ?>
                                                        <option value="<?= $employee->id; ?>"><?= $employee->LName.','.$employee->FName; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-12 mb-2 ASSIGNED_TO_2">
                                            <input type="text" id="emp3_id" name="emp3_id" value= "" hidden>
                                            <select id="EMPLOYEE_SELECT_3" name="employee3_" class="form-control">
                                                <option value="">Select Employee</option>
                                                <?php if(!empty($employees)): ?>
                                                    <?php foreach ($employees as $employee): ?>
                                                        <option value="<?= $employee->id; ?>"><?= $employee->LName.','.$employee->FName; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-12 mb-2 ASSIGNED_TO_3">
                                            <input type="text" id="emp4_id" name="emp4_id" value= "" hidden>
                                            <select id="EMPLOYEE_SELECT_4" name="employee4_" class="form-control">
                                                <option value="">Select Employee</option>
                                                <?php if(!empty($employees)): ?>
                                                    <?php foreach ($employees as $employee): ?>
                                                        <option value="<?= $employee->id; ?>"><?= $employee->LName.','.$employee->FName; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-12 mb-2 ASSIGNED_TO_4">
                                            <input type="text" id="emp5_id" name="emp5_id" value= "" hidden>
                                            <select id="EMPLOYEE_SELECT_5" name="employee5_" class="form-control">
                                                <option value="">Select Employee</option>
                                                <?php if(!empty($employees)): ?>
                                                    <?php foreach ($employees as $employee): ?>
                                                        <option value="<?= $employee->id; ?>"><?= $employee->LName.','.$employee->FName; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-12 mb-2 ASSIGNED_TO_5">
                                            <input type="text" id="emp6_id" name="emp6_id" value= "" hidden>
                                            <select id="EMPLOYEE_SELECT_6" name="employee6_" class="form-control">
                                                <option value="">Select Employee</option>
                                                <?php if(!empty($employees)): ?>
                                                    <?php foreach ($employees as $employee): ?>
                                                        <option value="<?= $employee->id; ?>"><?= $employee->LName.','.$employee->FName; ?></option>
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
                        <div class="nsm-card primary table-custom" style="height:auto !important;margin-bottom:10px;">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span class="custom-ticket-header"><i class='bx bx-user-circle'></i> Customer Information</span>
                                </div>
                            </div>         
                            <div class="nsm-card-content">
                                <div class="row">                                                                                        
                                    <div class="col-md-5">                                                
                                        <a class="link-modal-open nsm-button btn-small" id="btn-add-new-customer" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#quick-add-customer" style="float:right;"> Add New</a>
                                        <select style="display:inline;" id="customer_id" name="customer_id" data-customer-source="dropdown" class="form-control searchable-dropdown" required>
                                            <option selected value="">- Select Customer -</option>
                                        </select>                                        
                                        <table id="customer_info" class="table">
                                            <thead>
                                            <tr>
                                                <td></td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td><div id="cust_fullname">xxxxx xxxxx</div></td>
                                                <td style="vertical-align:top;"><a target="_blank" style="display:block;" href="#" id="customer_preview"><span class="customer_right_icon"><i class='bx bxs-user-rectangle'></i></span></a></td>
                                            </tr>
                                            <tr>
                                                <td >
                                                    <!-- <div id="cust_address">-------------</div> -->
                                                    <div id="cust_address2">-------------</div>
                                                </td>
                                                <td style="vertical-align:top;"><span class="customer_right_icon" style="color:#6a4a86 !important;"><i class='bx bx-map' ></i></span></td>
                                            </tr>
                                            <tr>
                                                <td><div id="cust_number">(xxx) xxx-xxxx</div></td>
                                                <td style="vertical-align:top;"><span class="customer_right_icon" style="color:#6a4a86 !important;"><i class='bx bxs-phone' ></i></span></td>
                                            </tr>
                                            <tr>
                                                <td id="cust_email">xxxxx@xxxxx.xxx</td>
                                                <td style="vertical-align:top;"><a id="mail_to" href="#" style="display:block;"><span class="customer_right_icon"><i class='bx bx-envelope' ></i></span></a></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="col-md-12">
                                            <iframe id="TEMPORARY_MAP_VIEW" src="http://maps.google.com/maps?output=embed" height="300" width="100%" style=""></iframe>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <p>Job Description</p>
                                        <textarea name="job_description" class="form-control" required=""></textarea>
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox" name="is_with_esign" id="is-with-esign-job" value="1">
                                            <label class="form-check-label" for="is-with-esign-job">eSign Required</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <p>Notes</p>
                                        <?php 
                                            //$message = "Thank you for your business, Please call ".$company_info->business_name." at ".$company_info->business_phone." for quality customer service";
                                            $message = '';
                                        ?>
                                        <textarea name="job_notes" class="form-control" required=""><?= $message; ?></textarea>
                                    </div>
                                </div>      
                            </div>                                   
                        </div>

                        <div class="row mt-2" id="with-esign-inputs-container" style="display:none;">
                            <div class="col-12">
                                <div class="nsm-card primary">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title">
                                            <span class="custom-ticket-header"><i class='bx bxs-pen'></i> eSign Information</span>
                                        </div>
                                    </div>
                                    <div class="row mt-4" style="background-color:white;">
                                        <div class="col-md-6 form-group mt-2" id="job-esign-template">                            
                                            <label for="esign-template-list"><b>eSign Templates</b></label>
                                            <select class="form-control nsm-field form-select" name="esign_template" id="esign-templates">
                                                <?php foreach($esignTemplates as $e){ ?>
                                                    <?php 
                                                        $template_name = $e->name;
                                                        if( $e->is_default == 1 ){
                                                            $template_name = $e->name .'(default)';
                                                        }    
                                                    ?>
                                                    <option <?= $e->is_default == 1 ? 'selected="selected"' : ''; ?> value="<?= $e->id; ?>"><?= $template_name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <?php if( $industrySpecificFields && array_key_exists('monthly_monitoring_rate', $industrySpecificFields) ){ ?>
                                            <?php if( !in_array('monthly_monitoring_rate', $disabled_industry_specific_fields) ){ ?>
                                            <div class="col-md-12 form-group">
                                                <div class="row">
                                                    <div class="col-md-6 form-group mt-2">
                                                        <label for="service-ticket-monthly-monitoring-rate"><b>Change Monthly Monitoring Rate</b></label>
                                                        <select style="display:inline-block;" class="form-control nsm-field form-select" name="monthly_monitoring_rate" id="service-ticket-monthly-monitoring-rate">
                                                            <option value="0.00">Select Plan Rate</option>
                                                            <?php foreach( $ratePlans as $rp ){ ?>
                                                                <option value="<?= $rp->amount; ?>"><?= $rp->plan_name; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group mt-2">
                                                        <label for=""><b>Monthly Monitoring Rate</b></label>
                                                        <input style="display:inline-block;" type="number" step="any" id="plan-value" name="monthly_monitoring_rate_value" value="0.00" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>   
                                            <?php } ?>  
                                        <?php } ?>                                   
                                        <div class="col-md-12 form-group mt-2">
                                            <div class="row">
                                                <?php if( $industrySpecificFields && array_key_exists('installation_cost', $industrySpecificFields) ){ ?>
                                                    <?php if( !in_array('installation_cost', $disabled_industry_specific_fields) ){ ?>
                                                    <div class="col-md-6 form-group mt-2">
                                                        <label for="service-ticket-installation-cost"><b>Installation Cost</b></label>
                                                        <input type="number" step="any" class="form-control" value="0.00" name="installation_cost" id="service-ticket-installation-cost">
                                                    </div>
                                                    <?php } ?>
                                                <?php } ?>

                                                <?php if( $industrySpecificFields && array_key_exists('otps', $industrySpecificFields) ){ ?>
                                                    <?php if( !in_array('otps', $disabled_industry_specific_fields) ){ ?>
                                                    <div class="col-md-6 form-group mt-2">
                                                        <label for="service-ticket-otp"><b>One Time (Program and Setup)</b></label>
                                                        <input type="number" step="any" class="form-control" value="0.00" name="otp" id="service-ticket-otp">
                                                    </div>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                        </div>                        
                                    </div>
                                    <div class="row" style="background-color:white;">                        
                                        <div class="col-md-6 form-group mt-2">
                                            <label for="bill_method"><b>Billing Method</b></label>
                                            <div class="input-group">
                                                <select id="bill_method" name="bill_method" class="form-select">
                                                    <option value="CC">Credit Card</option>
                                                    <option value="CHECK">Check</option>
                                                    <option value="ACH">ACH</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 form-group mt-2">
                                            <label for="customer_monitoring_id"><b>Monitoring ID</b></label>
                                            <input type="text" class="form-control" name="customer_monitoring_id" id="customer_monitoring_id"/>
                                        </div>
                                        
                                        <div class="grp-billing-cc">                      
                                            <div class="col-md-12 form-group mt-2 group-cc">
                                                <div class="row">                                
                                                    <div class="col-md-6 form-group mt-2">
                                                        <label for="customer_cc_num"><b>Credit Card Number</b></label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="customer_cc_num" id="customer_cc_num"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 form-group mt-2">
                                                        <label for="customer_cc_expiry_date_month"><b>Expiry Date</b></label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control cc-expiry-month" style="width:60px !important;" maxlength="2" size="2" name="customer_cc_expiry_date_month" id="customer_cc_expiry_date_month" placeholder="MM"/>
                                                            <span class="cc-separator">/</span>
                                                            <input type="text" class="form-control cc-expiry-year" style="width:65px !important;" maxlength="4" size="4" name="customer_cc_expiry_date_year" id="customer_cc_expiry_date_year" placeholder="YYYY"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 form-group mt-2">
                                                        <label for="customer_cc_cvc"><b>CVC</b></label>
                                                        <div class="input-group" style="width:51%;">
                                                            <input type="text" class="form-control cc-cvc" maxlength="4" size="4" name="customer_cc_cvc" id="customer_cc_cvc"/>
                                                        </div>
                                                    </div>
                                                </div>                                
                                            </div>
                                        </div>
                                        <div class="grp-billing-check" style="display:none;">                      
                                            <div class="col-md-12 form-group mt-2 group-cc">
                                                <div class="row">                                
                                                    <div class="col-md-6 form-group mt-2">
                                                        <label for="customer_check_number"><b>Check Number</b></label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="customer_check_number" id="customer_check_number"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 form-group mt-2">
                                                        <label for="customer_check_routing_number"><b>Routing Number</b></label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="customer_check_routing_number" id="customer_check_routing_number"/>
                                                        </div>
                                                    </div>                                    
                                                </div>    
                                                <div class="row">
                                                    <div class="col-md-6 form-group mt-2">
                                                        <label for="customer_check_bank_name"><b>Bank Name</b></label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="customer_check_bank_name" id="customer_check_bank_name"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 form-group mt-2">
                                                        <label for="customer_check_account_number"><b>Account Number</b></label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="customer_check_account_number" id="customer_check_account_number"/>
                                                        </div>
                                                    </div>
                                                </div>                            
                                            </div>
                                        </div>
                                        <div class="grp-billing-ach" style="display:none;">                      
                                            <div class="col-md-12 form-group mt-2 group-cc">
                                                <div class="row">                                
                                                    <div class="col-md-6 form-group mt-2">
                                                        <label for="customer_ach_account_number"><b>Account Number</b></label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="customer_ach_account_number" id="customer_ach_account_number"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 form-group mt-2">
                                                        <label for="customer_ach_routing_number"><b>Routing Number</b></label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="customer_ach_routing_number" id="customer_ach_routing_number"/>
                                                        </div>
                                                    </div>
                                                </div>                                
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row mt-2" id="with-esign-emergency-contacts-container" style="display:none;">
                            <div class="col-12">
                                <div class="nsm-card primary">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title">
                                            <span class="custom-ticket-header"><i class="bx bx-fw bx-user"></i> Emergency Contacts</span>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <div class="row">
                                            <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-4 ">Contact Name 1</div>
                                                        <div class="col-md-8">
                                                            <div class="row">
                                                                <div class="col-6" style="padding-right:2px !important;">
                                                                    <input type="text" class="form-control" placeholder="First Name" name="contact_first_name1" id="contact_first_name1" value="" style="margin-bottom: 5px;"/>
                                                                </div>
                                                                <div class="col-6" style="padding-left:2px !important;">
                                                                    <input type="text" class="form-control" placeholder="Last Name" name="contact_last_name1" id="contact_last_name1" value="" style="margin-bottom: 5px;" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2">
                                                        <div class="col-md-4 ">Relationship</div>
                                                        <div class="col-md-8">
                                                            <select data-type="emergency_contact_relationship" class="form-control" name="contact_relationship1" id="contact_relationship1">
                                                                <?php foreach($contactRelationshipOptions as $value){ ?>
                                                                    <option value="<?= $value; ?>"><?= $value; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-4">Phone Number</div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="contact_phone1" id="contact_phone1" value=""/>
                                                        </div>
                                                    </div>

                                                    <div class="row mt-3">
                                                        <div class="col-md-4">Contact Name 2</div>
                                                        <div class="col-md-8">
                                                            <div class="row">
                                                                <div class="col-6" style="padding-right:2px !important;">
                                                                    <input type="text" class="form-control" placeholder="First Name" name="contact_first_name2" id="contact_first_name2" value="" style="margin-bottom: 5px;"/>
                                                                </div>
                                                                <div class="col-6" style="padding-left:2px !important;">
                                                                    <input type="text" class="form-control" placeholder="Last Name" name="contact_last_name2" id="contact_last_name2" value="" style="margin-bottom: 5px;" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-4 ">Relationship</div>
                                                        <div class="col-md-8">
                                                            <select data-type="emergency_contact_relationship" class="form-control" name="contact_relationship2" id="contact_relationship2">
                                                                <?php foreach($contactRelationshipOptions as $value){ ?>
                                                                    <option value="<?= $value; ?>"><?= $value; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-4">Phone Number</div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="contact_phone2" id="contact_phone2" value=""/>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="col-md-6">
                                                    
                                                <div class="row mt-2">
                                                    <div class="col-md-4">
                                                        Contact Name 3
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="row">
                                                            <div class="col-6" style="padding-right:2px !important;">
                                                                <input type="text" class="form-control" placeholder="First Name" name="contact_first_name3" id="contact_first_name3" value="" style="margin-bottom: 5px;"/>
                                                            </div>
                                                            <div class="col-6" style="padding-left:2px !important;">
                                                                <input type="text" class="form-control" placeholder="Last Name" name="contact_last_name3" id="contact_last_name3" value="" style="margin-bottom: 5px;" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-md-4 ">
                                                        Relationship
                                                    </div>
                                                    <div class="col-md-8">
                                                        <select data-type="emergency_contact_relationship" class="form-control" name="contact_relationship3" id="contact_relationship3">
                                                            <?php foreach($contactRelationshipOptions as $value){ ?>
                                                                <option value="<?= $value; ?>"><?= $value; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-md-4">
                                                        Phone Number
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control phone_number" maxlength="12" placeholder="xxx-xxx-xxxx" name="contact_phone3" id="contact_phone3" value=""/>
                                                    </div>
                                                </div>

                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="nsm-card primary table-custom" style="height:auto !important;">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span class="custom-ticket-header"><i class='bx bx-list-ul'></i> Job Items</span>
                                </div>
                            </div>
                            <div class="nsm-card-content">                                        
                                <div class="row mb-3 mt-3">
                                    <div class="col-12">
                                        <button class="nsm-button primary small link-modal-open" type="button" id="add_another_items" data-bs-toggle="modal" data-bs-target="#item_list" style="float: right;">
                                            <i class='bx bx-plus'></i>Add Items
                                        </button>
                                    </div>
                                </div>                                                                              
                                <table class="table table-hover" id="quick-add-job-table-items" style="display: block;max-height:200px; overflow:auto;">
                                    <tbody id="jobs_items"></tbody>
                                </table>
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <td colspan="4" style="width: 85%; background-color: #d9d9d9;"><b>Total</b></td>
                                            <td colspan="2" style="background-color: #d9d9d9;">
                                                <label id="invoice_sub_total">$00.00</label>
                                                <input type="hidden" name="sub_total" id="sub_total_form_input" value='0'>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>                                                                                    
                                <div class="row">
                                    <input id="name" type="hidden" name="authorize_name">
                                    <input id="datetime_signed" type="hidden" name="datetime_signed">
                                    <input id="created_by" type="hidden" name="created_by" value="<?= $logged_in_user->id; ?>">
                                    <input id="employee2_id" type="hidden" name="employee2_id" value="">
                                    <input id="employee3_id" type="hidden" name="employee3_id" value="">
                                    <input id="employee4_id" type="hidden" name="employee4_id" value="">
                                    <input id="employee5_id" type="hidden" name="employee5_id" value="">
                                    <input id="employee6_id" type="hidden" name="employee6_id" value="">                                            
                                </div>
                            </div>
                        </div>

                    </div>                            
                </div>
            
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="item_list" tabindex="-1"  aria-labelledby="newcustomerLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" style="margin-top:8%;">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Items List</span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
            </div>
            <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-md-12 grid-mb">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" for="modal_items_list" placeholder="Search List">
                            </div>
                        </div>
                    </div>
                    <div class="row">                        
                        <div class="col-sm-12">
                            <table id="modal_items_list" class="nsm-table" style="width: 100%;">
                                <thead>
                                <tr>
                                    <td data-name="Add" style="width: 5% !important;"></td>
                                    <td data-name="Name"><strong>Name</strong></td>
                                    <td data-name="Type"><strong>Type</strong></td>
                                    <td data-name="Qty"><strong>Stock</strong></td>
                                    <td data-name="Price" style="text-align:right;"><strong>Price</strong></td>                                    
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($items as $item){ ?>
                                    <?php $item_qty = get_total_item_qty($item->id); ?>
                                    <?php //if ($item_qty[0]->total_qty > 0) { ?>
                                        <tr id="<?php echo "ITEMLIST_PRODUCT_$item->id"; ?>">
                                            <td class="nsm-text-primary">
                                                <button type="button" data-bs-dismiss="modal" class="nsm nsm-button default select_item" id="<?= $item->id; ?>" data-item_type="<?= ucfirst($item->type); ?>" data-quantity="1" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>"><i class='bx bx-plus-medical'></i></button>
                                            </td>
                                            <td class="nsm-text-primary"><?php echo $item->title; ?></td>
                                            <td class="nsm-text-primary"><?php echo $item->type; ?></td>
                                            <td><?php echo $item_qty[0]->total_qty > 0 ? $item_qty[0]->total_qty : "0"; ?></td>
                                            <td style="text-align:right;"><?php echo $item->price; ?></td>                                            
                                        </tr>
                                    <?php //} ?>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('v2/pages/job/js/job_quick_add_js'); ?>

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

    $('#btn-add-new-customer').on('click', function(){
        $('#target-id-dropdown').val('customer_id');
        $('#origin-modal-id').val('modal-quick-add-job');
    });
    
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

    $('#bill_method').on('change', function(){
        var selected = $(this).val();

        if( selected == 'CC' ){
            $('.grp-billing-cc').show();
            $('.grp-billing-check').hide();
            $('.grp-billing-ach').hide();
        }else if( selected == 'ACH' ){
            $('.grp-billing-cc').hide();
            $('.grp-billing-check').hide();
            $('.grp-billing-ach').show();
        }else{
            $('.grp-billing-cc').hide();
            $('.grp-billing-check').show();
            $('.grp-billing-ach').hide();
        }
    });

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

    $(function(){

        // $('#quick-add-jobs-items').DataTable({
        //     "autoWidth" : false,
        //     "columnDefs": [
        //     { width: 50, targets: 0 },
        //     { width: 540, targets: 0 },
        //     { width: 100, targets: 0 },
        //     { width: 100, targets: 0 },
        //     { width: 100, targets: 0 }
        //     ],
        //     "ordering": false,
        // });

        $('#is-with-esign-job').on('change', function(){
            if( $(this).is(':checked') ){
                is_with_esign = 1;
                $('#with-esign-inputs-container').fadeIn();
                $('#with-esign-emergency-contacts-container').fadeIn();
            }else{
                is_with_esign = 0;
                $('#with-esign-inputs-container').fadeOut();
                $('#with-esign-emergency-contacts-container').fadeOut();
            }

            //computeGrandTotal();
        });

        $("#modal_items_list").nsmPagination({itemsPerPage:10});
        $("#search_field").on("input", debounce(function() {
            tableSearch($(this));        
        }, 1000));

        $('#esign-templates').select2({
            dropdownParent: $("#modal-quick-add-job #job-esign-template"),
            placeholder: "Select Template"
        });

        $('#customer_id').select2({
            dropdownParent: $("#modal-quick-add-job"),
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
            //'<div>'+repo.first_name + ' ' + repo.last_name +'<br><small>'+repo.phone_m+' / '+repo.email+'</small></div>'
            '<div>'+repo.first_name + ' ' + repo.last_name + '</div>'
          );

          return $container;
        }

        $("#employee_id").select2({
            dropdownParent: $("#modal-quick-add-job"),
            placeholder: "Select Employee"
        });
        $("#sales_rep").select2({
            dropdownParent: $("#modal-quick-add-job"),
            placeholder: "Sales Rep"
        });
        $("#priority").select2({
            dropdownParent: $("#modal-quick-add-job"),
            placeholder: "Choose Priority..."
        });

        $("#EMPLOYEE_SELECT_2, #EMPLOYEE_SELECT_3, #EMPLOYEE_SELECT_4, #EMPLOYEE_SELECT_5, #EMPLOYEE_SELECT_6").select2({
            dropdownParent: $("#modal-quick-add-job"),
            placeholder: "Select Employee to Assign",
        });

        $("#customer_reminder").select2({
            dropdownParent: $("#modal-quick-add-job"),
            placeholder: "Choose Reminder..."
        });

        $("#inputState").select2({
            dropdownParent: $("#modal-quick-add-job"),
            placeholder: "Select Timezone..."
        });

        $(document).on('click', '.btn-use-other-address', function(){
            let prof_id = $(this).attr('data-id');
            let other_address = $(this).attr('data-address');
            let mail_add = $(this).attr('data-mailadd');
            let city = $(this).attr('data-city');
            let state = $(this).attr('data-state');
            let zip = $(this).attr('data-zip');
            let link_customer_address = `<a class="btn-use-different-address nsm-link" data-id="${prof_id}" href="javascript:void(0);">${other_address}</a>`;

            $('#other-address-customer').modal('hide');
            $('#cust_address2').html(link_customer_address);
            $('#job-location').val(other_address);
            $('#job-address').val(mail_add);
            $('#job-city').val(city);
            $('#job-state').val(state);
            $('#job-zip').val(zip);

            let map_source = 'http://maps.google.com/maps?q='+other_address+'&output=embed';
            $("#TEMPORARY_MAP_VIEW").attr('src', 'http://maps.google.com/maps?q='+other_address+'&output=embed');

            $('.btn-use-different-address').popover({
                placement: 'top',
                html : true, 
                trigger: "hover focus",
                content: function() {
                    return 'User other address';
                } 
            }); 
        });
    });

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