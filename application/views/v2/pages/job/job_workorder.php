<?php 
    include viewPath('v2/includes/header'); 
    add_css(array(
        'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
    ));
?>
<!-- add css for this page -->
<?php include viewPath('v2/pages/job/css/job_new'); ?>

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
    .align-right{
        text-align:right;
    }
    .total-summary{
        font-size:15px;
        font-weight:bold;
        margin-right:5px;
    }
</style>
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
                <?php echo form_open_multipart(null, ['class' => 'form-validate', 'id' => 'workorder_job_form', 'autocomplete' => 'off']); ?>
                <input type="hidden" name="wid" id="wid" value="<?= $workorder->id; ?>" />
                <div class="row g-3 align-items-start">
                    <div class="col-12 ">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="nsm-card primary" style="margin-top: 30px;">
                                    <div class="nsm-card-header d-block">
                                        <div class="nsm-card-title"><span><i class='bx bx-time'></i>&nbsp;Work Order to Job</span></div>
                                    </div>
                                    <hr>
                                    <div class="nsm-card-content">
                                        <div class="form-group">
                                            <div class="row g-3 align-items-center mb-3">
                                              <div class="col-sm-2">
                                                <label>From:</label>                                                
                                              </div>
                                              <div class="col-sm-5">
                                                <input type="date" name="start_date" id="start_date" class="form-control" value="<?= isset($workorder) ?  $workorder->date_issued : ''; ?>" required>
                                              </div>
                                              <div class="col-sm-5">
                                                  <?php if( isset($workorder) ){ $default_start_time = strtolower($workorder->start_time); } ?>
                                                    <select id="start_time" name="start_time" class="nsm-field form-select" required>
                                                        <option value="">Start time</option>
                                                        <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                                            <option value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                                                        <?php } ?>
                                                    </select>
                                              </div>
                                            </div>
                                            <div class="row g-3 align-items-center">
                                              <div class="col-sm-2">
                                                <label>To:</label>
                                              </div>
                                              <div class="col-sm-5">
                                                <input type="date" name="end_date" id="end_date" class="form-control mr-2" value="<?= isset($workorder) ?  $workorder->date_issued : ''; ?>" required>
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
                                                <option <?= $workorder->priority == 'Standard' ? 'selected="selected"' : ''; ?> value="Standard">Standard</option>
                                                <option <?= $workorder->priority == 'Low' ? 'selected="selected"' : ''; ?> value="Low">Low</option>
                                                <option <?= $workorder->priority == 'Emergency' ? 'selected="selected"' : ''; ?> value="Emergency">Emergency</option>
                                                <option <?= $workorder->priority == 'Urgent' ? 'selected="selected"' : ''; ?> value="Urgent">Urgent</option>
                                            </select>
                                        </div><br>
                                        <h6>Sales Rep</h6>
                                            <?php 
                                                if( isset($workorder) ){
                                                    $default_user = $workorder->employee_id;
                                                }
                                            ?>
                                            <select id="employee_id" name="employee_id" class="form-control " required>
                                                <option value="10001">Select All</option>
                                                <?php if(!empty($sales_rep)): ?>
                                                    <?php foreach ($sales_rep as $employee): ?>
                                                        <option <?= $workorder->employee_id == $employee->id ? 'selected' : '';  ?> value="<?= $employee->id; ?>"><?= $employee->FName.','.$employee->LName; ?></option>
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
                                                            <?php if( strtolower($color->color_code) == $default_color ){ ?>
                                                                <a style="background-color: <?= $color->color_code; ?>; border-radius: 0px;border: 1px solid black;margin-bottom: 4px;" id="<?= $color->id; ?>" type="button" class="btn btn-default color-scheme btn-circle bg-1" title="<?= $color->color_name; ?>">
                                                                    <i class="bx bx-check calendar_button" aria-hidden="true"></i>
                                                                </a>
                                                            <?php }else{ ?>
                                                                <a style="background-color: <?= $color->color_code; ?>; border-radius: 0px;border: 1px solid black;margin-bottom: 4px;" id="<?= $color->id; ?>" type="button" class="btn btn-default color-scheme btn-circle bg-1" title="<?= $color->color_name; ?>">
                                                                </a>
                                                            <?php } ?>                                                            
                                                        </li>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                                <?php if( $is_default_color_exists == 0 ){ ?>
                                                    <li>
                                                        <a data-color="<?= $default_color; ?>" style="background-color: <?= $default_color; ?>; border-radius: 0px;border: 1px solid black;margin-bottom: 4px;" id="0" type="button" class="btn btn-default color-scheme btn-circle bg-1" title="Default Event Color"><i class="bx bx-check calendar_button event-color-check" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                            <input value="0" id="job_color_id" name="event_color" type="hidden" />
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
                                                    <option value="<?php echo $key ?>">
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
                                                    <input type="text" id="emp2_id" name="emp2_id" value= "<?php if(isset($workorder) && !empty($workorder->employee2_id)){ echo $workorder->employee2_id; } ?>" hidden>
                                                    <select id="EMPLOYEE_SELECT_2" name="employee2_" class="form-control">
                                                        <option value="">Select Employee</option>
                                                        <?php if(!empty($employees)): ?>
                                                            <?php foreach ($employees as $employee): ?>
                                                                <option <?php if(isset($workorder) && $workorder->employee2_id == $employee->id) {echo 'selected'; } ?> value="<?= $employee->id; ?>"><?= $employee->LName.','.$employee->FName; ?></option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-12 mb-2 ASSIGNED_TO_2">
                                                    <input type="text" id="emp3_id" name="emp3_id" value= "<?php if(isset($workorder) && !empty($workorder->employee3_id)){ echo $workorder->employee3_id; } ?>" hidden>
                                                    <select id="EMPLOYEE_SELECT_3" name="employee3_" class="form-control">
                                                        <option value="">Select Employee</option>
                                                        <?php if(!empty($employees)): ?>
                                                            <?php foreach ($employees as $employee): ?>
                                                                <option <?php if(isset($workorder) && $workorder->employee3_id == $employee->id) {echo 'selected'; } ?> value="<?= $employee->id; ?>"><?= $employee->LName.','.$employee->FName; ?></option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-12 mb-2 ASSIGNED_TO_3">
                                                    <input type="text" id="emp4_id" name="emp4_id" value= "<?php if(isset($workorder) && !empty($workorder->employee4_id)){ echo $workorder->employee4_id; } ?>" hidden>
                                                    <select id="EMPLOYEE_SELECT_4" name="employee4_" class="form-control">
                                                        <option value="">Select Employee</option>
                                                        <?php if(!empty($employees)): ?>
                                                            <?php foreach ($employees as $employee): ?>
                                                                <option <?php if(isset($workorder) && $workorder->employee4_id == $employee->id) {echo 'selected'; } ?> value="<?= $employee->id; ?>"><?= $employee->LName.','.$employee->FName; ?></option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-12 mb-2 ASSIGNED_TO_4">
                                                    <input type="text" id="emp5_id" name="emp5_id" value= "<?php if(isset($workorder) && !empty($workorder->employee5_id)){ echo $workorder->employee5_id; } ?>" hidden>
                                                    <select id="EMPLOYEE_SELECT_5" name="employee5_" class="form-control">
                                                        <option value="">Select Employee</option>
                                                        <?php if(!empty($employees)): ?>
                                                            <?php foreach ($employees as $employee): ?>
                                                                <option <?php if(isset($workorder) && $workorder->employee5_id == $employee->id) {echo 'selected'; } ?> value="<?= $employee->id; ?>"><?= $employee->LName.','.$employee->FName; ?></option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-12 mb-2 ASSIGNED_TO_5">
                                                    <input type="text" id="emp6_id" name="emp6_id" value= "<?php if(isset($workorder) && !empty($workorder->employee6_id)){ echo $workorder->employee6_id; } ?>" hidden>
                                                    <select id="EMPLOYEE_SELECT_6" name="employee6_" class="form-control">
                                                        <option value="">Select Employee</option>
                                                        <?php if(!empty($employees)): ?>
                                                            <?php foreach ($employees as $employee): ?>
                                                                <option <?php if(isset($workorder) && $workorder->employee6_id == $employee->id) {echo 'selected'; } ?> value="<?= $employee->id; ?>"><?= $employee->LName.','.$employee->FName; ?></option>
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
                                                    <option value="<?= $customer->prof_id ?>" selected=""><?= $customer->first_name . ' ' . $customer->last_name; ?></option>                               
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
                                                <div class="col-md-12">
                                                        <h6>Job Account Number</h6>
                                                        <input value="<?php echo ($workorder->job_account_number) ? $workorder->job_account_number : ""; ?>" type="text" class="form-control" name="JOB_ACCOUNT_NUMBER">
                                                    </div>
                                                <div class="col-md-12">
                                                    <hr>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <div class="d-flex justify-content-between">
                                                                <h6>Job Type</h6>
                                                                <a class="nsm-link d-flex align-items-center btn-quick-add-job-type" href="javascript:void(0);">
                                                                    <span class="bx bx-plus"></span>Create Job Type
                                                                </a>
                                                            </div>
                                                            <select id="job_type" name="job_type" class="form-control " >
                                                                <option value="">Select Type</option>
                                                                <?php if(!empty($job_types)): ?>
                                                                    <?php foreach ($job_types as $type): ?>
                                                                        <option <?php if(isset($workorder) && $workorder->job_type == $type->title) {echo 'selected'; } ?> value="<?= $type->title; ?>" data-image="<?= $type->icon_marker; ?>"><?= $type->title; ?></option>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <div class="d-flex justify-content-between">
                                                                <h6>Job Tag</h6>
                                                                <a class="nsm-link d-flex align-items-center btn-quick-add-job-tag" href="javascript:void(0);">
                                                                    <span class="bx bx-plus"></span>Create Job Tag
                                                                </a>
                                                            </div>  
                                                            <select id="job_tag" name="job_tag" class="form-control " >
                                                                <option value="">Select Tags</option>
                                                                <?php if(!empty($tags)): ?>
                                                                    <?php foreach ($tags as $tag): ?>
                                                                        <option <?php if(isset($workorder) && $workorder->tags == $tag->name) {echo 'selected'; } ?> value="<?= $tag->id; ?>" data-image="<?= $tag->marker_icon; ?>"><?= $tag->name; ?></option>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <h6>Description of Job</h6>
                                                        <textarea name="job_description" class="form-control" required=""><?= isset($workorder) ? $workorder->job_description : ''; ?></textarea>
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
                                            <?php if(isset($workorder)): ?>
                                                <?php
                                                    $subtotal = 0.00;
                                                    foreach ($workorder_items as $item):
                                                    $item_price = $item->price / $item->qty;
                                                    //$total = $item->price;
                                                    $total = $item->total - $item->tax;
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
                                                            <input readonly id='cost<?= $item->id ?>' data-id="<?= $item->id; ?>" value='<?= $item->cost; ?>'  type="number" name="item_original_price[]" class="form-control item-original-price" placeholder="Cost">
                                                        </td>
                                                        <td><small>Unit Price</small>
                                                            <input id='price<?= $item->id ?>' data-id="<?= $item->id; ?>" value='<?= $item->cost; ?>'  type="number" name="item_price[]" class="form-control item-price" placeholder="Unit Price">
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
                                                            <b data-subtotal='<?= $total ?>' id='sub_total<?= $item->id ?>' class="total_per_item">$<?= number_format((float)$total,2,'.','');?></b>
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
                                                                        $THUMBNAIL_SRC = (isset($workorder)) ? base_url($workorder->attachment) : "";
                                                                        if(isset($workorder) && $workorder->attachment != "") {
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
                                                        <div class="col-sm-6 align-right">
                                                            <label class="total-summary" id="invoice_sub_total">$<?= isset($workorder) ? number_format((float)$subtotal,2,'.',',') : '0.00'; ?></label>
                                                        <input type="hidden" name="sub_total" id="sub_total_form_input" value='<?= $subtotal; ?>'>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-sm-6 align-right">
                                                            <div class="d-flex justify-content-between">
                                                                <h6>Tax Rate</h6>
                                                                <a class="nsm-link d-flex align-items-center btn-quick-add-tax-rate" ref="javscript:void(0);">
                                                                    <span class="bx bx-plus"></span>Add New Tax Rate
                                                                </a>
                                                            </div>
                                                            <select id="tax_rate" name="tax_percentage" class="form-control" data-value="<?= $workorder->tax_rate; ?>">
                                                                <option value="0.0">None</option>
                                                                <?php foreach ($tax_rates as $rate) { ?>
                                                                    <option value="<?= $rate->rate; ?>"><?= $rate->name; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            </div>                                                                                                                     
                                                        <div class="col-sm-6 align-right">
                                                            <label class="total-summary" id="invoice_tax_total"><?= isset($workorder->tax_rate) ? number_format((float)$workorder->tax_rate, 2,'.',',') : '0.00'; ?></label>
                                                            <input type="hidden" name="tax" id="tax_total_form_input" value="<?= isset($workorder->tax_rate) ? number_format((float)$workorder->tax_rate, 2,'.',',') : '0.00'; ?>">
                                                        </div>
                                                    </div>
                                                    <?php if( in_array($cid, adi_company_ids()) ){ ?>
                                                        <div class="row mt-3">
                                                            <div class="col-sm-6">
                                                                <label>Installation Cost</label>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="input-group mb-2" style="width:50%;float:right;">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">$</div>
                                                                    </div>
                                                                    <input type="number" step="any" class="form-control" id="adjustment_ic" name="installation_cost" value="<?= $workorder->installation_cost > 0 ? $workorder->installation_cost : 0; ?>" required="" style="text-align:right;"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col-sm-6">
                                                                <label>One time (Program and Setup)</label>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="input-group mb-2" style="width:50%;float:right;">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">$</div>
                                                                    </div>
                                                                    <input type="number" step="any" class="form-control" id="adjustment_otps" name="otps" value="<?= $workorder->otp_setup > 0 ? $workorder->otp_setup : 0; ?>" required="" style="text-align:right;" />
                                                                </div>                                                                
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2 mb-2">
                                                            <div class="col-sm-6">
                                                                <label>Monthly Monitoring</label>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="input-group mb-2" style="width:50%;float:right;">
                                                                    <div class="input-group-prepend">
                                                                        <div class="input-group-text">$</div>
                                                                    </div>
                                                                    <input type="number" step="any" class="form-control" id="adjustment_mm" name="monthly_monitoring" value="<?= $workorder->monthly_monitoring > 0 ? $workorder->monthly_monitoring : 0; ?>" required="" style="text-align:right;" />
                                                                </div>  
                                                            </div>
                                                        </div>
                                                    <?php }else{ ?>
                                                        <input type="hidden" class="form-control" id="adjustment_ic" name="installation_cost" value="0" />
                                                        <input type="hidden" class="form-control" id="adjustment_otps" name="otps" value="0" />
                                                        <input type="hidden" class="form-control" id="adjustment_mm" name="monthly_monitoring" value="0" />
                                                    <?php } ?>
                                                    <div class="row">
                                                        <hr>
                                                    </div>                                                    
                                                    <?php if( $estimate_dp_amount > 0 ){ ?>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label>Total</label>
                                                            </div>
                                                            <div class="col-sm-6 align-right">
                                                                <label class="total-summary" id="invoice_overall_total"></label>                                                                
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
                                                            <div class="col-sm-6 align-right">
                                                                <label class="total-summary" id="invoice_overall_total"></label>                                                                
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
                                                                Total Commission: <input step="any" type="number" name="commission_amount" value="<?php echo $workorder->commission; ?>" readonly>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <hr>
                                                </div>
                                                <div class="col-sm-12" id="approval_card_right" style="display: <?= isset($workorder) ? 'block' : 'none' ;?>;">
                                                    <div style="float: right;">
                                                        <?php if(isset($workorder) && $workorder->signature_link != '') : ?>
                                                        <a href="javascript:void(0);" id="approval_btn_right"><span class="fa fa-columns" style="float: right;padding-right: 20px;"></span></a>

                                                        <center>
                                                            <img width="150" id="customer_signature_right" alt="Customer Signature" src="<?= isset($workorder) ? $workorder->signature_link : ''; ?>">
                                                        </center>

                                                        <center><span id="appoval_name_right"><?= isset($workorder->authorize_name) ? $workorder->authorize_name : 'Xxxxx Xxxxxx'; ?></span></center><br>
                                                        <span>-----------------------------</span><br>
                                                        <center><small>Approved By</small></center><br>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <h6>Billing Method</h6>
                                                        <select class="form-select" name="BILLING_METHOD" required>
                                                            <option value="">Select Billing Method</option>
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
                                                        <input value="" type="text" class="form-control" placeholder="XXXX XXXX XXXX XXXX" name="CC_CREDITCARDNUMBER">
                                                    </div>
                                                    <div class="col-md-2 mb-3 CC_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Expiration</h6>
                                                        <input value="" type="text" class="form-control" placeholder="MM/YY" name="CC_EXPIRATION">
                                                    </div>
                                                    <div class="col-md-2 mb-3 CC_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>CVV</h6>
                                                        <input value="" type="text" class="form-control" placeholder="XXX" name="CC_CVV">
                                                    </div>
                                                    <!-- ======= -->
                                                    <div class="col-md-4 mb-3 DC_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Credit Card Number</h6>
                                                        <input value="" type="text" class="form-control" placeholder="XXXX XXXX XXXX XXXX" name="DC_CREDITCARDNUMBER">
                                                    </div>
                                                    <div class="col-md-2 mb-3 DC_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Expiration</h6>
                                                        <input value="" type="text" class="form-control" placeholder="MM/YY" name="DC_EXPIRATION">
                                                    </div>
                                                    <div class="col-md-2 mb-3 DC_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>CVV</h6>
                                                        <input value="" type="text" class="form-control" placeholder="XXX" name="DC_CVV">
                                                    </div>
                                                    <!-- ======= -->
                                                    <div class="col-md-4 mb-3 CHECK_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Check Number</h6>
                                                        <input value="" type="text" class="form-control" placeholder="XXXXXX" name="CHECK_CHECKNUMBER">
                                                    </div>
                                                    <div class="col-md-4 mb-3 CHECK_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Routing Number</h6>
                                                        <input value="" type="text" class="form-control" placeholder="XXXXXXXXX" name="CHECK_ROUTINGNUMBER">
                                                    </div>
                                                    <div class="col-md-12 mb-3 CHECK_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Account Number</h6>
                                                        <input value="" type="text" class="form-control" placeholder="XXXXXXXXXXXX" name="CHECK_ACCOUNTNUMBER">
                                                    </div>
                                                    <!-- ======= -->
                                                    <div class="col-md-4 mb-3 ACH_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Routing Number</h6>
                                                        <input value="" type="text" class="form-control" placeholder="XXXXXXXXX" name="ACH_ROUTINGNUMBER">
                                                    </div>
                                                    <div class="col-md-4 mb-3 ACH_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Account Number</h6>
                                                        <input value="" type="text" class="form-control" placeholder="XXXXXXXXXXXX" name="ACH_ACCOUNTNUMBER">
                                                    </div>
                                                    <!-- ======= -->
                                                    <div class="col-md-4 mb-3 VENMO_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Account Credential</h6>
                                                        <input value="" type="text" class="form-control" name="VENMO_ACCOUNTCREDENTIAL">
                                                    </div>
                                                    <div class="col-md-4 mb-3 VENMO_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Account Note</h6>
                                                        <input value="" type="text" class="form-control" name="VENMO_ACCOUNTNOTE">
                                                    </div>
                                                    <div class="col-md-12 mb-3 VENMO_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Confirmation</h6>
                                                        <input value="" type="text" class="form-control" name="VENMO_CONFIRMATION">
                                                    </div>
                                                    <!-- ======= -->
                                                    <div class="col-md-4 mb-3 PP_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Account Credential</h6>
                                                        <input value="" type="text" class="form-control" name="PP_ACCOUNTCREDENTIAL">
                                                    </div>
                                                    <div class="col-md-4 mb-3 PP_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Account Note</h6>
                                                        <input value="" type="text" class="form-control" name="PP_ACCOUNTNOTE">
                                                    </div>
                                                    <div class="col-md-12 mb-3 PP_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Confirmation</h6>
                                                        <input value="" type="text" class="form-control" name="PP_CONFIRMATION">
                                                    </div>
                                                    <!-- ======= -->
                                                    <div class="col-md-4 mb-3 SQ_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Account Credential</h6>
                                                        <input value="" type="text" class="form-control" name="SQ_ACCOUNTCREDENTIAL">
                                                    </div>
                                                    <div class="col-md-4 mb-3 SQ_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Account Note</h6>
                                                        <input value="" type="text" class="form-control" name="SQ_ACCOUNTNOTE">
                                                    </div>
                                                    <div class="col-md-12 mb-3 SQ_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Confirmation</h6>
                                                        <input value="" type="text" class="form-control" name="SQ_CONFIRMATION">
                                                    </div>
                                                    <!-- ======= -->
                                                    <div class="col-md-4 mb-3 WW_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Account Credential</h6>
                                                        <input value="" type="text" class="form-control" name="WW_ACCOUNTCREDENTIAL">
                                                    </div>
                                                    <div class="col-md-4 mb-3 WW_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Account Note</h6>
                                                        <input value="" type="text" class="form-control" name="WW_ACCOUNTNOTE">
                                                    </div>
                                                    <!-- ======= -->
                                                    <div class="col-md-4 mb-3 HOF_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Account Credential</h6>
                                                        <input value="" type="text" class="form-control" name="HOF_ACCOUNTCREDENTIAL">
                                                    </div>
                                                    <div class="col-md-4 mb-3 HOF_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Account Note</h6>
                                                        <input value="" type="text" class="form-control" name="HOF_ACCOUNTNOTE">
                                                    </div>
                                                    <!-- ======= -->
                                                    <div class="col-md-4 mb-3 ET_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Account Credential</h6>
                                                        <input value="" type="text" class="form-control" name="ET_ACCOUNTCREDENTIAL">
                                                    </div>
                                                    <div class="col-md-4 mb-3 ET_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Account Note</h6>
                                                        <input value="" type="text" class="form-control" name="ET_ACCOUNTNOTE">
                                                    </div>
                                                    <!-- ======= -->
                                                    <div class="col-md-4 mb-3 INV_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Term</h6>
                                                        <select class="form-select" name="INV_TERM">
                                                            <option value="Due On Receipt">Due On Receipt</option>
                                                            <option value="Net 5">Net 5</option>
                                                            <option value="Net 10">Net 10</option>
                                                            <option value="Net 15">Net 15</option>
                                                            <option value="Net 30">Net 30</option>
                                                            <option value="Net 60">Net 60</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 mb-3 INV_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Invoice Date</h6>
                                                        <input value="" type="date" class="form-control" name="INV_INVOICEDATE">
                                                    </div>
                                                    <div class="col-md-2 mb-3 INV_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Due Date</h6>
                                                        <input value="" type="date" class="form-control" name="INV_DUEDATE">
                                                    </div>
                                                    <!-- ======= -->
                                                    <div class="col-md-4 mb-3 OCCP_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Credit Card Number</h6>
                                                        <input value="" type="text" class="form-control" placeholder="XXXX XXXX XXXX XXXX" name="OCCP_CREDITCARDNUMBER">
                                                    </div>
                                                    <div class="col-md-2 mb-3 OCCP_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Expiration</h6>
                                                        <input value="" type="text" class="form-control" placeholder="MM/YY" name="OCCP_EXPIRATION">
                                                    </div>
                                                    <div class="col-md-2 mb-3 OCCP_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>CVV</h6>
                                                        <input value="" type="text" class="form-control" placeholder="XXX" name="OCCP_CVV">
                                                    </div>
                                                    <!-- ======= -->
                                                    <div class="col-md-4 mb-3 OPT_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Account Credential</h6>
                                                        <input value="" type="text" class="form-control" name="OPT_ACCOUNTCREDENTIAL">
                                                    </div>
                                                    <div class="col-md-4 mb-3 OPT_INPUTS HIDE_ALL_INPUTS">
                                                        <h6>Account Note</h6>
                                                        <input value="" type="text" class="form-control" name="OPT_ACCOUNTNOTE">
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
                                                                if (isset($workorder)) { 
                                                                    $MESSAGE = "$workorder->message"; 
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
                                                <div class="col-sm-12 mb-4 <?php echo (isset($workorder) && $workorder->link = NULL) ? '' : 'd-none' ?>">
                                                    <div class="row">
                                                        <div class="col-sm-12 mb-2">
                                                            <h5>Url Link</h5>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <?php if(isset($workorder) && $workorder->link = NULL) { ?>
                                                            <a  target="_blank" href="<?= $workorder->link; ?>"><p style="color: darkred;"><?= $workorder->link; ?></p></a>
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
                                                <?php if(isset($workorder) && $workorder->status == 'Invoiced'): ?>
                                                <div class="col-sm-12">
                                                    <div class="card box_right" id="pd_right_card" style="display: <?= isset($workorder) ? 'block' : 'none' ;?>;">
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
                                                                                    <?= isset($workorder) ? $workorder->method : ''; ?>
                                                                                </span>
                                                                            </td>
                                                                            <td>
                                                                                <b>Amount</b><br>
                                                                                <span class="help help-sm help-block" id="pay_amount_right">
                                                                                    <?=  isset($workorder) && $workorder->amount != NULL ? '$'.$workorder->amount : '$0.00'; ?>
                                                                                </span>
                                                                            </td>
                                                                            <td>
                                                                                <b>Account Name</b><br>
                                                                                <span class="help help-sm help-block">
                                                                                <?= isset($workorder) && $workorder->account_name != NULL ? $workorder->account_name : 'n/a'; ?>
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
                                            </div>
                                            <br>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 text-end">
                                                <div class="form-check float-start">
                                                    <input class="form-check-input" id="SEND_EMAIL_ON_SCHEDULE" type="checkbox">
                                                    <label class="form-check-label" for="SEND_EMAIL_ON_SCHEDULE">
                                                    Send email to customer after scheduling this job.
                                                    </label>
                                                </div>
                                                <button type="submit" class="nsm-button primary"><i class='bx bx-fw bx-calendar-plus'></i>
                                                    Convert to Job
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                          
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<!-- Modals -->
<?php include viewPath('v2/pages/job/modals/new_customer'); ?>
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
                                            <button type="button" data-bs-dismiss="modal" class='nsm-button primary small select_item' id="<?= $item->id; ?>" data-item_type="<?= ucfirst($item->type); ?>" data-quantity="<?= $item_qty[0]->total_qty; ?>" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>" data-retail="<?= $item->retail; ?>" data-location_name="<?= $item->location_name; ?>" data-location_id="<?= $item->location_id; ?>"><i class='bx bx-plus-medical'></i></button>
                                        </td>
                                        <td><?php echo $item->title; ?></td>
                                        <td>
                                            <?php 
                                                $total_onhand = 0;
                                                foreach($itemsLocation as $itemLoc){
                                                    if($itemLoc->item_id == $item->id){
                                                        //echo "<div class='data-block'>";
                                                        //echo $itemLoc->name. " = " .$itemLoc->qty;
                                                        //echo "</div>";
                                                        if( $itemLoc->qty > 0 ){
                                                            $total_onhand += $itemLoc->qty;
                                                        }
                                                    } 
                                                }                                                
                                            ?>
                                            <div class='data-block'><?= $total_onhand; ?></div>
                                        </td>
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

<style>
    .dataTables_empty{
        display: none;
    }

</style>
<?php
// JS to add only Job module
add_footer_js(array(
    'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',    
    'assets/textEditor/summernote-bs4.js',
));
?>
<?php include viewPath('v2/includes/job/quick_add'); ?>
<?php include viewPath('v2/includes/footer'); ?>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?= google_credentials()['api_key'] ?>&callback=initialize&libraries=&v=weekly"></script>
<script src="https://momentjs.com/downloads/moment-with-locales.js"></script>
<?php include viewPath('v2/pages/job/js/work_order_job_js'); ?>
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
    $('select[name="BILLING_METHOD"]').val("<?php echo $workorder->BILLING_METHOD ?>").change();
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
    $("#job_type").select2({
        placeholder: "Select Job Type",
        templateResult: templateResult('icon_marker'),
        templateSelection: templateResult('icon_marker'),
        ajax: {
        url: "<?= base_url("job/apiGetJobTypes"); ?>",
        dataType: "json",
        data: (params) => {
            return { search: params.term };
        },
        processResults: (response) => {
            return {
            results: response.data.map((item) => ({
                ...item,
                id: item.id,
                text: item.title,
            })),
            };
        },
        },
    });
    
    $('#job_tag').select2({
        placeholder: "Select Job Tag",
        templateResult: templateResult('icon_marker'),
        templateSelection: templateResult('icon_marker'),
        ajax: {
        url: "<?= base_url("job/apiGetJobTags"); ?>",
        dataType: "json",
        data: (params) => {
            return { search: params.term };
        },
        processResults: (response) => {
            const results = response.data.map((item) => ({
            ...item,
            id: item.id,
            text: item.name,
            }));

            window.__jobTags = results;
            return {
            results,
            };
        },
        },
    });

    function templateResult(iconKey) {
        return function (item) {
            if (typeof item.id !== "string" || !item.id.length) {
            return item.text;
            }

            let icon = item[iconKey] || undefined;

            if (!icon && iconKey === "marker_icon" && Array.isArray(window.__jobTags)) {
            // Fix about weird issue where icon not showing on value
            const match = window.__jobTags.find((tag) => tag.id === item.id);
            if (match.marker_icon) {
                icon = match.marker_icon;
            }
            }

            if (!icon && item.element && item.element.dataset.image) {
            icon = item.element.dataset.image;
            }

            if (typeof icon === "string" && icon.length) {
            icon = base_url + `/uploads/icons/${icon}`;
            } else {
            icon = base_url + "/uploads/job_tags/default_no_image.jpg";
            }

            return $(
            `
                <span style="display: grid; grid-template-columns: 20px 1fr; grid-gap: 10px; align-items: center;">
                    <img src="${icon}" style="width: 100%;"/>
                    <span>${item.text}</span>
                </span>
                `
            );
        };
    }

    //Quick Add
    $('.btn-quick-add-job-type').on('click', function(){
        $('#quick_add_job_type').modal('show');
    });
    $('.btn-quick-add-job-tag').on('click', function(){
        $('#quick_add_job_tag').modal('show');
    });
    $('.btn-quick-add-lead-source').on('click', function(){
        $('#quick_add_lead_source').modal('show');
    });
    $('.btn-quick-add-tax-rate').on('click', function(){
        $('#quick_add_tax_rate').modal('show');
    });

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

        const jobStatus = "<?= $workorder ? $workorder->status : ''; ?>";
        const jobId = "<?= $workorder ? $workorder->id : ''; ?>";

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