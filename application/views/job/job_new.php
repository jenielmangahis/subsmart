<?php
defined('BASEPATH') or exit('No direct script access allowed');
add_css(array(
    'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
    'https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
    'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
    //'assets/frontend/css/workorder/main.css',
    // 'assets/css/beforeafter.css',
));


?>
<?php include viewPath('includes/header'); ?>

<!-- add css for this page -->
<?php include viewPath('job/css/job_new'); ?>

<style>
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
</style>
<?php if (isset($jobs_data)) : ?>
    <input type="hidden" value="<?= $jobs_data->id ?>" id="esignJobId" />
<?php endif; ?>

<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/job'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <form method="post" name="myform" id="jobs_form">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h1 style="font-size: 1.75rem;">Job Configuration Status</h1>
                            </div>
                            <div class="card-body">
                                <div class="stepwizard">
                                    <div class="stepwizard-row setup-panel">
                                        <div class="stepwizard-step col-xs-3">
                                            <a href="#" type="button" class="btn btn-circle <?= !isset($jobs_data) || $jobs_data->status == 'New'  ? 'btn-success' : 'btn-default'; ?>"><i style="font-size: 24px;" class="fa fa-pencil"></i></a>
                                            <p class=""><small>Draft</small></p>
                                        </div>
                                        <div class="stepwizard-step col-xs-3">
                                            <a href="#" type="button" class="btn btn-circle <?= isset($jobs_data) && $jobs_data->status == 'Scheduled'  ? 'btn-success' : 'btn-default'; ?>" disabled><span style="font-size: 24px;" class="fa fa-calendar-check-o"></span></a>
                                            <p class=""><small>Scheduled</small></p>
                                        </div>
                                        <div class="stepwizard-step col-xs-3">
                                            <a href="#" <?php if (isset($jobs_data) && $jobs_data->status == 'Scheduled') : ?>data-toggle="modal" data-target="#omw_modal" data-backdrop="static" data-keyboard="false" <?php endif; ?> type="button" class="btn btn-circle <?= isset($jobs_data) && $jobs_data->status == 'Arrival'  ? 'btn-success' : 'btn-default'; ?>">
                                                <span style="font-size: 24px;" class="fa fa-ship"></span></a>
                                            <p><small>Arrival</small></p>
                                        </div> &nbsp;&nbsp;
                                        <div class="stepwizard-step col-xs-3">
                                            <a href="#" <?php if (isset($jobs_data) && $jobs_data->status == 'Arrival') : ?>data-toggle="modal" data-target="#start_modal" data-backdrop="static" data-keyboard="false" <?php endif; ?> type="button" class="btn btn-circle <?= isset($jobs_data) && $jobs_data->status == 'Started'  ? 'btn-success' : 'btn-default'; ?>" disabled="disabled">
                                                <span style="font-size: 24px;" class="fa fa-hourglass-start"></span></a>
                                            <p><small>Start</small></p>
                                        </div>
                                        <div class="stepwizard-step col-xs-3">
                                            <a href="#" type="button" <?php if (isset($jobs_data) && $jobs_data->status == 'Started') : ?> data-toggle="modal" data-target="#fill_esign" data-backdrop="static" data-keyboard="false" <?php endif; ?> class="btn btn-circle  <?= isset($jobs_data) && $jobs_data->status == 'Approved'  ? 'btn-success' : 'btn-default'; ?>" disabled="disabled">
                                                <span style="font-size: 24px;" class="fa fa-check-circle-o"></span>
                                            </a>
                                            <p><small>Approved</small></p>
                                        </div>
                                        <div class="stepwizard-step col-xs-3">
                                            <a href="#" id="confirmEsignModalTrigger" data-job-status="<?= isset($jobs_data) ? $jobs_data->status : ''  ?>" <?php if (isset($jobs_data) && $jobs_data->status == 'Finish') : ?> data-toggle="modal" data-target="#finish_modal" data-backdrop="static" data-keyboard="false" <?php endif; ?> type="button" class="btn btn-circle <?= isset($jobs_data) && $jobs_data->status == 'Closed'  ? 'btn-success' : 'btn-default'; ?>" disabled="disabled">
                                                <span style="font-size: 24px;" class="fa fa-stop"></span>
                                            </a>
                                            <p><small>Finish</small></p>
                                        </div>
                                        <div class="stepwizard-step col-xs-3">
                                            <a href="#" type="button" class="btn btn-circle <?= isset($jobs_data) && $jobs_data->status == 'Invoiced'  ? 'btn-success' : 'btn-default'; ?>" disabled="disabled">
                                                <span style="font-size: 24px;" class="fa fa-paper-plane"></span>
                                            </a>
                                            <p><small>Invoice</small></p>
                                        </div>
                                        <div class="stepwizard-step col-xs-3">
                                            <a href="#" type="button" class="btn btn-circle <?= isset($jobs_data) && $jobs_data->status == 'Completed'  ? 'btn-success' : 'btn-default'; ?>" disabled="disabled">
                                                <span style="font-size: 24px;" class="fa  fa-check"></span>
                                            </a>
                                            <p><small>Completed</small></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="alert alert-warning" role="alert" style="color:black;display: flex;position: relative;margin-right: 15px;" <p> With a few clicks, you will be on your way to storing all information about the job performed for an account.
                                    Stores incident details, resource, expenses, tasks, item audits, communications, billing and more.
                                    Try our quick import form buttons to seamlessly schedule a job.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="page-title">
                                    <span style="font-size: 20px;" class="fa fa-calendar"></span>&nbsp; &nbsp;Schedule Job
                                </h6>
                                <hr>
                                <?php if (!isset($jobs_data)) : ?>
                                    <p>Import Data from Wordorder/Invoice/Estimates</p>
                                    <div id="import_buttons">
                                        <a href="#" data-toggle="modal" data-target="#estimates_import" data-backdrop="static" data-keyboard="false" class="btn btn-sm btn-primary"><span class="fa fa-upload"></span> Estimates</a> &nbsp;&nbsp;
                                        <a href="#" data-toggle="modal" data-target="#workorder_import" data-backdrop="static" data-keyboard="false" type="button" class="btn btn-sm btn-primary"><span class="fa fa-upload"></span> Work Order</a> &nbsp;&nbsp;
                                        <a href="#" data-toggle="modal" data-target="#invoice_import" data-backdrop="static" data-keyboard="false" type="button" class="btn btn-sm btn-primary"><span class="fa fa-upload"></span> Invoice</a>
                                    </div>
                                    <hr>
                                <?php endif; ?>
                                <div class="form-group label-width d-flex align-items-center">
                                    <label>From</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control" value="<?= isset($jobs_data) ?  $jobs_data->start_date : '';  ?>" required>&nbsp;&nbsp;
                                    <select id="start_time" name="start_time" class="form-control" required>
                                        <option value="">Start time</option>
                                        <?php for ($x = 0; $x < time_availability(0, TRUE); $x++) { ?>
                                            <option <?= isset($jobs_data) && strtolower($jobs_data->start_time) == time_availability($x) ?  'selected' : '';  ?> value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group label-width d-flex align-items-center">
                                    <label>To</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control mr-2" value="<?= isset($jobs_data) ?  $jobs_data->end_date : '';  ?>" required>
                                    <select id="end_time" name="end_time" class="form-control" required>
                                        <option value="">End time</option>
                                        <?php for ($x = 0; $x < time_availability(0, TRUE); $x++) { ?>
                                            <option <?= isset($jobs_data) && strtolower($jobs_data->end_time) == time_availability($x) ?  'selected' : '';  ?> value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <h6>Select Priority</h6>
                                <select id="priority" name="priority" class="form-control">
                                    <option value="Standard">Standard</option>
                                    <option value="Low">Low</option>
                                    <option value="Emergency">Emergency</option>
                                    <option value="Urgent">Urgent</option>
                                </select>

                                <h6>Select Employee</h6>
                                <select id="employee_id" name="employee_id" class="form-control" required>
                                    <option value="10001">Select All</option>
                                    <?php if (!empty($employees)) : ?>
                                        <?php foreach ($employees as $employee) : ?>
                                            <option <?= isset($jobs_data) && $jobs_data->employee_id == $employee->id ? 'selected' : '';  ?> value="<?= $employee->id; ?>"><?= $employee->FName . ',' . $employee->LName; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <div class="color-box-custom">
                                    <h6>Event Color on Calendar</h6>
                                    <ul>
                                        <?php if (isset($color_settings)) : ?>
                                            <?php foreach ($color_settings as $color) : ?>
                                                <li>
                                                    <a style="background-color: <?= $color->color_code; ?>;" id="<?= $color->id; ?>" type="button" class="btn btn-default color-scheme btn-circle bg-1" title="<?= $color->color_name; ?>">
                                                        <?php if (isset($jobs_data) && $jobs_data->event_color == $color->id) {
                                                            echo '<i class="fa fa-check calendar_button" aria-hidden="true"></i>';
                                                        } ?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </ul>
                                    <input value="<?= (isset($jobs_data) && $jobs_data->event_color == $color->id) ? $jobs_data->event_color : ''; ?>" id="job_color_id" name="event_color" type="hidden" />
                                </div>
                                <h6>Customer Reminder Notification</h6>
                                <select name="customer_reminder_notification" class="form-control">
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
                                <h6>Time Zone</h6>
                                <select id="inputState" name="timezone" class="form-control">
                                    <option value="utc5">Central Time (UTC -5)</option>
                                </select>
                                <h6>Select Job Type</h6>
                                <select id="job_type_option" name="jobtypes" class="form-control" required>
                                    <option value="">Select Type</option>
                                    <?php if (!empty($job_types)) : ?>
                                        <?php foreach ($job_types as $type) : ?>
                                            <option <?php if (isset($jobs_data) && $jobs_data->job_type == $type->title) {
                                                        echo 'selected';
                                                    } ?> value="<?= $type->title; ?>"><?= $type->title; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <h6>Select Job Tag</h6>
                                <select id="job_tags" name="tags" class="form-control" required>
                                    <option value="">Select Tags</option>
                                    <?php if (!empty($tags)) : ?>
                                        <?php foreach ($tags as $tag) : ?>
                                            <option <?php if (isset($jobs_data) && $jobs_data->tags == $tag->id) {
                                                        echo 'selected';
                                                    } ?> value="<?= $tag->id; ?>"><?= $tag->name; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <h6>Assigned To</h6>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" placeholder="Employee 1" id="emp2_id" name="emp2_id" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" placeholder="Employee 2" id="emp3_id" name="emp3_id" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" placeholder="Employee 3" id="emp4_id" name="emp4_id" class="form-control" readonly>
                                    </div>
                                </div>
                                <br>
                                <center>
                                    <a href="#" data-toggle="modal" data-target="#share_job_modal" data-backdrop="static" data-keyboard="false" class="btn btn-primary">
                                        <span class="fa fa-plus"></span> Assign Job
                                    </a>
                                </center>
                            </div>
                            <br>
                        </div>
                        <div class="card" id="notes_left_card" style="display: <?= isset($jobs_data) ? 'none' : 'block'; ?>;">
                            <div class="card-header">
                                <button style="display: flex;" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <h6 class="page-title"> <span class="fa fa-book box_footer_icon"></span> &nbsp; Private Notes </h6>
                                </button>
                                <a href="javascript:void(0);" title="Transfer to the right column." id="notes_left"><span class="fa fa-columns" style="float: right;padding-right: 40px;font-size: 20px;display: block;margin-top: -38px;"></span></a>
                            </div>
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#collapseOne">
                                <div class="card-body">
                                    <div class="row">
                                        <!--<div style="background-color: #32243d; width: 32px; height: 32px;">
                                <img alt="Vance Wayne" src="https://housecall-attachments-production.s3.amazonaws.com/service_pros/avatars/000/137/270/original/avatar_1565038188.jpeg?1565038188" class="MuiAvatar-img">
                                 </div>
                                <p>&nbsp; 01/27/2021, 5:36pm</p>-->
                                        <div id="notes_edit_btn" class="pencil" style="width:100%; height:100px;cursor: pointer;">
                                            <?= isset($jobs_data) ? $jobs_data->message : ''; ?>
                                        </div>
                                        <div id="notes_input_div" style="display:none;">
                                            <div style=" height:70px;margin-bottom: 10px;">
                                                <textarea name="message" cols="40" style="width: 100%;" rows="3" id="note_txt" class="input"><?= isset($jobs_data) ? $jobs_data->message : ''; ?></textarea>
                                                <button type="button" class="btn btn-primary btn-sm" id="save_memo" style="color: #ffffff;"><span class="fa fa-save"></span> Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footers">
                                    <div style="float: right;margin-bottom: 10px;">
                                        <a href="javascript:void(0);" id="edit_note" class="fa fa-pencil box_footer_icon"></a> &nbsp;
                                        <?php if (isset($jobs_data)) : ?>
                                            <a href="#" class="fa fa-history box_footer_icon"></a> &nbsp;
                                            <a href="#" class="fa fa-trash box_footer_icon"></a> &nbsp;
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                        <div class="card" id="attach_left_card" style="display: <?= isset($jobs_data) ? 'none' : 'block'; ?>;">
                            <div class="card-header">
                                <button style="display: flex;" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#photos_attachment" aria-expanded="true" aria-controls="photos_attachment">
                                    <h6 class="page-title"><span style="font-size: 20px;" class="fa fa-image"></span>&nbsp; &nbsp;Photos / Attachments</h6>
                                </button>
                                <!--<a href="javascript:void(0);" id="attach_left_btn_column">
                                <span class="fa fa-columns card_plus_sign"></span>
                            </a>-->
                            </div>
                            <div class="card-body">
                                <div id="photos_attachment" class="collapse" aria-labelledby="headingTwo" data-parent="#photos_attachment">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div class="form-group col-md-12">
                                                <img style="width: 100%" id="attachment-image" alt="Attachment" src="<?= isset($jobs_data) ? $jobs_data->attachment : "/uploads/jobs/placeholder.jpg"; ?> ">
                                                <small>Optionally attach files to this Job. Allowed type: pdf, doc, docx, png, jpg, gif.</small>
                                                <input type="file" class="form-control" name="attachment-file" id="attachment-file">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                        <div class="card" id="url_left_card" style="display: <?= isset($jobs_data) ? 'none' : 'block'; ?>;">
                            <div class="card-header" id="headingThree">
                                <button style="display: flex;" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#url_link_form" aria-expanded="true" aria-controls="url_link_form">
                                    <h6 class="page-title"><span style="font-size: 20px;" class="fa fa-link"></span> &nbsp; &nbsp;Url Link </h6>
                                </button>
                                <a href="javascript:void(0);" id="url_left_btn_column">
                                    <span class="fa fa-columns card_plus_sign"></span>
                                </a>
                            </div>
                            <div class="card-body">
                                <div id="url_link_form" class="collapse" aria-labelledby="headingThree" data-parent="#url_link_form">
                                    <div class="card-body">
                                        <?php
                                        if (isset($jobs_data) && $jobs_data->link != NULL) {
                                        ?>
                                            <a target="_blank" href="<?= $jobs_data->link; ?>">
                                                <p><?= $jobs_data->link; ?></p>
                                            </a>
                                        <?php
                                        } else {
                                        ?>
                                            <label>Enter Url</label>
                                            <input type="url" name="link" class="form-control checkDescription">
                                        <?php
                                        } ?>
                                    </div>
                                    <br>
                                </div>

                            </div>
                        </div>

                        <?php if (isset($jobs_data) && $jobs_data->status == 'Started') : ?>
                            <div class="card" id="pd_left_card" style="display: <?= isset($jobs_data) && $jobs_data->status == 'Approved' ? 'none' : 'block'; ?>;">
                                <div class="card-header">
                                    <button style="display: flex;" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#payment" aria-expanded="true" aria-controls="payment">
                                        <h6 class="page-title"><span style="font-size: 20px;" class="fa fa-money"></span>&nbsp;&nbsp;Payment Details</h6>
                                    </button>
                                    <a href="javascript:void(0);" id="pd_left">
                                        <span class="fa fa-columns card_plus_sign"></span>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div id="payment" class="collapse" aria-labelledby="headingThree" data-parent="#payment">
                                        <div class="card-body">
                                            <form role="form">
                                                <div class="col-sm-12">
                                                    <div class="col-md-12">
                                                        <label for="">Method</label>
                                                        <select id="pay_method" name="method" class="form-control">
                                                            <option <?php if (isset($jobs_data) && $jobs_data->pay_method == 'CC') {
                                                                        echo 'selected';
                                                                    } ?> value="CC">Credit Card</option>
                                                            <option <?php if (isset($jobs_data) && $jobs_data->pay_method == 'CHECK') {
                                                                        echo 'selected';
                                                                    } ?> value="CHECK">Check</option>
                                                            <option <?php if (isset($jobs_data) && $jobs_data->pay_method == 'CASH') {
                                                                        echo 'selected';
                                                                    } ?> value="CASH">Cash</option>
                                                            <option <?php if (isset($jobs_data) && $jobs_data->pay_method == 'ACH') {
                                                                        echo 'selected';
                                                                    } ?> value="ACH">ACH</option>
                                                            <option <?php if (isset($jobs_data) && $jobs_data->pay_method == 'VENMO') {
                                                                        echo 'selected';
                                                                    } ?> value="VENMO">Venmo</option>
                                                            <option <?php if (isset($jobs_data) && $jobs_data->pay_method == 'PP') {
                                                                        echo 'selected';
                                                                    } ?> value="PP">Paypal</option>
                                                            <option <?php if (isset($jobs_data) && $jobs_data->pay_method == 'SQ') {
                                                                        echo 'selected';
                                                                    } ?> value="SQ">Square</option>
                                                            <option <?php if (isset($jobs_data) && $jobs_data->pay_method == 'WW') {
                                                                        echo 'selected';
                                                                    } ?> value="WW">Warranty Work</option>
                                                            <option <?php if (isset($jobs_data) && $jobs_data->pay_method == 'HOF') {
                                                                        echo 'selected';
                                                                    } ?> value="HOF">Home Owner Financing</option>
                                                            <option <?php if (isset($jobs_data) && $jobs_data->pay_method == 'eT') {
                                                                        echo 'selected';
                                                                    } ?> value="eT">e-Transfer</option>
                                                            <option <?php if (isset($jobs_data) && $jobs_data->pay_method == 'OCCP') {
                                                                        echo 'selected';
                                                                    } ?> value="OCCP">Other Credit Card Processor</option>
                                                            <option <?php if (isset($jobs_data) && $jobs_data->pay_method == 'OPT') {
                                                                        echo 'selected';
                                                                    } ?> value="OPT">Other Payment Type</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="">Amount <small class="help help-sm">(in dollar)</small></label>
                                                        <input class="form-control" id="pay_amount" value="<?= isset($jobs_data) ? $jobs_data->amount : ''; ?>" name="amount" type="text" placeholder="0.00">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <h6>Payment Details</h6>
                                                        <div class="row">
                                                            <div id="credit_card_form">
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <div class="input-group">
                                                                                    <input type="text" name="account_holder_name" class="form-control" id="cardNumber" placeholder="Account Holder Name" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <div class="input-group">
                                                                                    <input type="number" name="card_number" class="form-control" id="cardNumber" placeholder="1234 1234 1234 1234" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <input type="text" name="card_expiry" class="form-control" id="expityMonth" placeholder="MM/YY" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <input type="number" name="card_cvc" class="form-control" id="cvCode" placeholder="CVC" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12">
                                                                            <label>Save card to file</label>
                                                                            <div class="onoffswitch grid-onoffswitch" style="float: right;">
                                                                                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" value="1" data-customize="open" id="onoff-customize">
                                                                                <label class="onoffswitch-label" for="onoff-customize">
                                                                                    <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span></label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12" style="text-align: center !important;">
                                                                            <br>
                                                                            <button type="button" class="btn btn-sm btn-primary">
                                                                                <span class="fa fa-search-plus"></span> Scan Payment
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="check_form" style="display: none;">
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <div class="input-group">
                                                                                    <input type="number" name="route_number" class="form-control" id="cardNumber" placeholder="Routing #" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <div class="input-group">
                                                                                    <input type="number" name="account_number" class="form-control" id="cardNumber" placeholder="Account #" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12" style="text-align: center !important;">
                                                                            <br>
                                                                            <button type="button" class="btn btn-sm btn-primary">
                                                                                <span class="fa fa-search-plus"></span> Scan Payment
                                                                            </button>
                                                                            <br>
                                                                            <div class="form-group" style="text-align: center;">
                                                                                <input type="checkbox" name="notify_by" value="collected" id="notify_by_email">
                                                                                <label for="notify_by_email">Payment has been collected.</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="ach_form" style="display: none;">
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <div class="input-group">
                                                                                    <input type="number" name="route_number" class="form-control" id="cardNumber" placeholder="Routing #" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <div class="input-group">
                                                                                    <input type="number" name="account_number" class="form-control" id="cardNumber" placeholder="Account #" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <select id="day_of_month_ach" name="day_of_month" class="form-control">
                                                                                    <option value="">Select Day of Month</option>
                                                                                    <?php for ($x = 1; $x <= 31; $x++) { ?>
                                                                                        <option value="<?= $x; ?>"><?= $x; ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12" style="text-align: center !important;">
                                                                            <br>
                                                                            <button type="button" class="btn btn-sm btn-primary">
                                                                                <span class="fa fa-search-plus"></span> Scan Payment
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="cash_form" style="display: none;">
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-12" style="text-align: center !important;">
                                                                            <br>
                                                                            <button type="button" class="btn btn-sm btn-primary">
                                                                                <span class="fa fa-search-plus"></span> Scan Payment
                                                                            </button>
                                                                            <br>
                                                                        </div>
                                                                        <div class="form-group" style="text-align: center !important;">
                                                                            <input type="checkbox" name="is_collected" value="1" id="notify_by_email">
                                                                            <label for="notify_by_email">Payment has been collected.</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="others_warranty_form" style="display: none;">
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <div class="input-group">
                                                                                    <input type="number" name="acct_credential" class="form-control" id="cardNumber" placeholder="Account Credential" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <div class="input-group">
                                                                                    <textarea class="form-control" name="acct_note" id="cardNumber" placeholder="Account Note"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group" style="text-align: center;">
                                                                                <input type="checkbox" name="is_signed" value="1" id="notify_by_email">
                                                                                <label for="notify_by_email">Document Signed</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="svp_form" style="display: none;">
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <div class="input-group">
                                                                                    <input type="number" name="acct_credential" class="form-control" id="cardNumber" placeholder="Account Credential" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <div class="input-group">
                                                                                    <textarea class="form-control" name="acct_note" id="cardNumber" placeholder="Account Note"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <div class="input-group">
                                                                                    <textarea class="form-control" name="acct_confirm" id="cardNumber" placeholder="Confirmation"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12" style="text-align: center !important;">
                                                        <br>
                                                        <button type="button" id="save_payment" class="btn btn-sm btn-primary">
                                                            <span class="fa fa-paper-plane-o"></span> Save Payment
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card" style="display: <?= isset($jobs_data) && $jobs_data->status == 'Approved' ? 'none' : 'block'; ?>;">
                                <div class="card-header">
                                    <button style="display: flex;" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#fill-eSign" aria-expanded="true" aria-controls="fill-eSign">
                                        <h6 class="page-title"><span style="font-size: 20px;" class="fa fa-edit"></span>&nbsp;&nbsp;Fill & eSign</h6>
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div id="fill-eSign" class="collapse" aria-labelledby="headingThree" data-parent="#fill-eSign">
                                        <div class="card-body">
                                            <!--<a style="cursor: pointer;" id="fill_esign_btn" data-toggle="modal" data-target="#fill_esign" data-backdrop="static" data-keyboard="false">
                                            <center>
                                                <img width="100" id="" alt="Customer Signature" src="/assets/img/jobs/add_file.png">
                                            </center>
                                        </a>-->
                                        </div>
                                        <div style="float: right;">
                                            <a><span style="font-size: 20px;" class="fa fa-pencil"></span> &nbsp;</a>
                                            <span style="font-size: 20px;" class="fa fa-ellipsis-v"></span> &nbsp;
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card" id="approval_card_left" style="display: <?= isset($jobs_data) && $jobs_data->status == 'Approved' ? 'none' : 'block'; ?>;">
                                <div class="card-header" id="headingOne">
                                    <button style="display: flex;" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#approval" aria-expanded="true" aria-controls="approval">
                                        <h6 class="page-title"><span style="font-size: 20px;" class="fa fa-check-circle-o"></span> Approval</h6>
                                    </button>
                                    <a href="#" id="approval_btn_left">
                                        <span class="fa fa-columns card_plus_sign"></span>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div id="approval" class="collapse" aria-labelledby="headingThree" data-parent="#approval">
                                        <div class="card-body">
                                            <div class="col-sm-12">
                                                <div style="text-align: center;">
                                                    <center>
                                                        <img width="100" id="customer-signature" alt="Customer Signature" src="<?= isset($jobs_data) ? $jobs_data->signature_link : ''; ?>">
                                                    </center>
                                                    <span id="authorizer"><?= isset($jobs_data->authorize_name) ? $jobs_data->authorize_name : 'Xxxxx Xxxxxx'; ?></span><br>
                                                    <span>------------------------</span><br>
                                                    <span>Approved By</span><br><br>

                                                    <small id="date_signed"><?= isset($jobs_data->datetime_signed) ? $jobs_data->datetime_signed : '(date and time)'; ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="float: right;">
                                            <a href="#" data-toggle="modal" data-target="#updateSignature" data-backdrop="static" data-keyboard="false">
                                                <span style="font-size: 20px;" class="fa fa-pencil"></span> &nbsp;
                                            </a>
                                            <!--<span style="font-size: 20px;" class="fa fa-ellipsis-v"></span> &nbsp; -->
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>


                    </div>
                    <div class="col-md-8">
                        <div class="card table-custom">
                            <div class="card-body">
                                <div class="row">
                                    <div style="display: flex; margin: 0;margin-right: auto;">
                                        <b>Created By: </b>&nbsp;&nbsp; <span> <?= ' ' . $logged_in_user->FName . ' ' . $logged_in_user->LName; ?></span>
                                    </div>
                                    <a class="add_new_customer" href="javascript:void(0)" id="add_another_invoice" data-toggle="modal" data-target="#new_customer">
                                        <span class="fa fa-plus-square"></span> Add New Customer
                                    </a>
                                    <hr>
                                    <div class="col-md-4">
                                        <h6>Customer Info</h6>
                                        <select id="customer_id" name="customer_id" data-customer-source="dropdown" class="form-control searchable-dropdown" placeholder="Select" required>
                                            <?php if ($default_customer_id > 0) { ?>
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
                            </div>
                            <hr>
                            <h6 style="padding-left: 7px;">Job Items Listing</h6>
                            <table class="table table-striped">
                                <tbody>
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
                                    <?php if (isset($jobs_data)) : ?>
                                        <?php
                                        $subtotal = 0.00;
                                        foreach ($jobs_data_items as $item) :
                                            $total = $item->price * $item->qty;
                                        ?>
                                            <tr id=ss>
                                                <td width="35%"><small>Item name</small>
                                                    <input value="<?= $item->title; ?>" type="text" name="item_name[]" class="form-control">
                                                    <input type="hidden" value='"+idd+"' name="item_id[]">
                                                </td>
                                                <td width="20%"><small>Qty</small>
                                                    <input data-itemid='"+idd+"' id='"+idd+"' value='<?= $item->qty; ?>' type="number" name="item_qty[]" class="form-control qty">
                                                </td>
                                                <td width="20%"><small>Unit Price</small>
                                                    <input id='price"+idd+"' value='<?= $item->price; ?>' type="number" name="item_price[]" class="form-control" placeholder="Unit Price">
                                                </td>
                                                <!--<td width="10%"><small>Unit Cost</small><input type="text" name="item_cost[]" class="form-control"></td>-->
                                                <!--<td width="25%"><small>Inventory Location</small><input type="text" name="item_loc[]" class="form-control"></td>-->
                                                <td style="text-align: center" class="d-flex" width="15%">
                                                    <b data-subtotal='"+total_+"' id='sub_total"+idd+"' class="total_per_item"><?= number_format((float)$total, 2, '.', ','); ?></b>
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
                                <a class="link-modal-open" href="#" id="add_another_items" data-toggle="modal" data-target="#item_list">
                                    <span class="fa fa-plus-square fa-margin-right"></span>Add Items
                                </a>
                            </div>
                            <br>
                            <div class="col-sm-12">
                                <p>Description of Job</p>
                                <textarea name="job_description" class="form-control" required=""><?= isset($jobs_data) ? $jobs_data->job_description : ''; ?></textarea>
                                <hr />
                            </div>
                            <div class="col-md-12 table-responsive">
                                <div class="row">
                                    <div class="col-md-6">
                                        &nbsp;<div class="file-upload-drag">
                                            <div class="drop">
                                                <div class="cont">
                                                    <div class="tit">
                                                        <?php if (isset($jobs_data) && $jobs_data->attachment != "") : ?>
                                                            <img style="width: 100%" id="attachment-image" alt="Attachment" src="<?= isset($jobs_data) ? $jobs_data->attachment : "/uploads/jobs/attachment/placeholder.jpg"; ?> ">
                                                        <?php else : ?>
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
                                            <label id="invoice_sub_total">$<?= isset($jobs_data) ? number_format((float)$subtotal, 2, '.', ',') : '0.00'; ?></label>
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
                                            <label id="invoice_overall_total">$<?= isset($jobs_data) ? number_format((float)$subtotal, 2, '.', ',') : '0.00'; ?></label>
                                            <input type="hidden" name="sub_total" id="sub_total_form_input" value='0'>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <hr>
                                    </div>
                                    <div class="col-sm-12" id="approval_card_right" style="display: <?= isset($jobs_data) ? 'block' : 'none'; ?>;">
                                        <div style="float: right;">
                                            <?php if (isset($jobs_data) && $jobs_data->signature_link != '') : ?>
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
                                        <div class="card box_right" id="notes_right_card" style="display: <?= isset($jobs_data) ? 'block' : 'none'; ?>;">
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
                                                            <?php if (isset($jobs_data)) : ?>
                                                                <a href="#" class="fa fa-history box_footer_icon"></a> &nbsp;
                                                                <a href="#" class="fa fa-trash box_footer_icon"></a> &nbsp;
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="card box_right" id="url_right_card" style="display: <?= isset($jobs_data) ? 'block' : 'none'; ?>;">
                                            <div class="row">
                                                <div class="col-md-12 ">
                                                    <div class="card-header">
                                                        <a id="url_right_btn_column" href="javascript:void(0);"><span class="fa fa-columns" style="float: right;padding-right: 20px;"></span></a>
                                                        <h5 style="padding-left: 20px;">Url Link</h5>
                                                    </div>
                                                    <div class="card-body">

                                                        <?php
                                                        if (isset($jobs_data) && $jobs_data->link != NULL) {
                                                        ?>
                                                            <a target="_blank" href="<?= $jobs_data->link; ?>">
                                                                <p style="color: darkred;"><?= $jobs_data->link; ?></p>
                                                            </a>
                                                        <?php
                                                        } else {
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
                                    <?php if (isset($jobs_data) && $jobs_data->status == 'Invoiced') : ?>
                                        <div class="col-sm-12">
                                            <div class="card box_right" id="pd_right_card" style="display: <?= isset($jobs_data) ? 'block' : 'none'; ?>;">
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
                                                                                <?= isset($jobs_data) && $jobs_data->amount != NULL ? '$' . $jobs_data->amount : '$0.00'; ?>
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

                                    <?php if (isset($jobs_data) && $jobs_data->status != 'Scheduled') : ?>
                                        <div class="col-sm-12">
                                            <div class="card box_right">
                                                <div class="row">
                                                    <div class="col-md-12 ">
                                                        <div class="card-header">
                                                            <h5 style="padding-left: 20px;" class="mb-0">Devices Audit</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <span class="help help-sm help-block">Record all items used on jobs</span>
                                                            <a href="#" id="" data-toggle="modal" data-target="#new_inventory" type="button" class="btn btn-sm btn-primary"><span class="fa fa-plus" style="color:"></span> Add New Item</a>
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
                                                                    <?php if (isset($jobs_data_items)) : ?>
                                                                        <?php
                                                                        $subtotal = 0.00;
                                                                        foreach ($jobs_data_items as $item) :
                                                                            $total = $item->price * $item->qty;
                                                                        ?>
                                                                            <tr>
                                                                                <td><?= $item->title; ?></td>
                                                                                <td><?= $item->points; ?></td>
                                                                                <td><?= number_format((float)$item->price, 2, '.', ','); ?></td>
                                                                                <td id="device_qty<?= $item->id; ?>"><?= $item->qty; ?></td>
                                                                                <td><?= number_format((float)$total, 2, '.', ','); ?></td>
                                                                                <td>
                                                                                    <button class="nsm-button btn-sm SEE_LOCATION" data-bs-toggle="modal" data-bs-target="#inventory_location_modal" data-id="<?php echo $item[10]; ?>">See Location</button>
                                                                                </td>
                                                                                <td><a href="#" data-name='<?= $item->title; ?>' data-price='<?= $item->price; ?>' data-quantity='<?= $item->qty; ?>' id="<?= $item->id; ?>" class="edit_item_list">
                                                                                        <span class="fa fa-edit"></span>
                                                                                    </a>
                                                                                    <!--<a href="javascript:void(0)" class="remove_audit_item_row">
                                                                            <span class="fa fa-trash"></span></i>
                                                                        </a>-->
                                                                                </td>
                                                                            </tr>
                                                                        <?php $subtotal = $subtotal + $total;
                                                                        endforeach; ?>
                                                                    <?php endif; ?>
                                                                </tbody>
                                                            </table>
                                                            <br>
                                                            <style>
                                                                .table-bordered td,
                                                                .table-bordered th {
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
                                <div class="col-sm-12">
                                    <?php if (!isset($jobs_data) || $jobs_data->status == 'Scheduled') : ?>
                                        <button type="submit" class="btn btn-primary"><span class="fa fa-calendar-check-o"></span> Schedule</button>
                                    <?php endif; ?>
                                    <?php if (isset($jobs_data)) : ?>
                                        <a href="<?= base_url('job/job_preview/' . $this->uri->segment(3)) ?>" type="button" class="btn btn-primary"><span class="fa fa-search-plus"></span> Preview</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!--<div class="card">
                        <div class="card-body">
                            <div class="card box_right">
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <div class="card-header">
                                            <h5 style="padding-left: 20px;" class="mb-0">Activity Feeds</h5>
                                        </div>
                                        <div class="card-body">
                                            <span class="help help-sm help-block">History log of customer</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>

                        </div>
                    </div>-->
                    </div>

                </div>

        </div>
        </form>
    </div>
    <!-- end container-fluid -->
</div>

<!-- Modals -->
<?php include viewPath('job/modals/new_customer'); ?>
<?php include viewPath('job/modals/inventory_location'); ?>
<?php include viewPath('job/modals/new_inventory'); ?>
<?php include viewPath('job/modals/esign'); ?>

<!-- Signature Modal -->
<div class="modal fade" id="updateSignature" role="dialog">
    <div class="close-modal" data-dismiss="modal">&times;</div>
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

<?php include viewPath('job/modals/fill_esign'); ?>

<!-- Modal -->
<div class="modal fade" id="item_list" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
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
                                <?php if (!empty($items)) : ?>
                                    <?php foreach ($items as $item) : ?>
                                        <?php $item_qty = get_total_item_qty($item->id); ?>
                                        <tr>
                                            <td><?= $item->title; ?></td>
                                            <td><?= $item_qty[0]->total_qty > 0 ? $item_qty[0]->total_qty : 0; ?></td>
                                            <td><?= $item->price; ?></td>
                                            <td><?= ucfirst($item->type); ?></td>
                                            <td>
                                                <button id="<?= $item->id; ?>" data-item_type="<?= ucfirst($item->type); ?>" data-quantity="<?= $item->units; ?>" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>" type="button" data-dismiss="modal" class="btn btn-sm btn-default select_item">
                                                    <span class="fa fa-plus"></span>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fa fa-remove"></span> Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="estimates_import" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newcustomerLabel">Select Estimate To Make a Job</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                <?php if (!empty($estimates)) : ?>
                                    <?php foreach ($estimates as $estimate) : ?>
                                        <tr>
                                            <td><?= $estimate->estimate_number; ?></td>
                                            <td><?= $estimate->job_name; ?></td>
                                            <td><?= date('M d, Y', strtotime($estimate->estimate_date)); ?></td>
                                            <td>
                                                <a href="<?= base_url('job/estimate_job/' . $estimate->id) ?>" id="<?= $estimate->id; ?>" type="button" class="btn btn-sm btn-default">
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fa fa-remove"></span> Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Work Order Modal -->
<?php include viewPath('job/modals/wordorder_import'); ?>

<!-- Invoice Modal -->
<?php include viewPath('job/modals/invoice_import'); ?>

<!-- Signature Modal -->
<div class="modal fade" id="share_job_modal" role="dialog">
    <div class="close-modal" data-dismiss="modal">&times;</div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Share Job To Other Employee</h4>
            </div>
            <div class="modal-body">
                <label>Employee 1</label>
                <select id="employee2" name="employee2_" class="form-control">
                    <option value="">Select Employee</option>
                    <?php if (!empty($employees)) : ?>
                        <?php foreach ($employees as $employee) : ?>
                            <option <?php if (isset($jobs_data) && $jobs_data->employee2_id == $employee->id) {
                                        echo 'selected';
                                    } ?> value="<?= $employee->id; ?>"><?= $employee->LName . ',' . $employee->FName; ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>

                <label>Employee 2</label>
                <select id="employee3" name="employee3_" class="form-control">
                    <option value="">Select Employee</option>
                    <?php if (!empty($employees)) : ?>
                        <?php foreach ($employees as $employee) : ?>
                            <option <?php if (isset($jobs_data) && $jobs_data->employee3_id == $employee->id) {
                                        echo 'selected';
                                    } ?> value="<?= $employee->id; ?>"><?= $employee->LName . ',' . $employee->FName; ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>

                <label>Employee 3</label>
                <select id="employee4" name="employee4_" class="form-control">
                    <option value="">Select Employee</option>
                    <?php if (!empty($employees)) : ?>
                        <?php foreach ($employees as $employee) : ?>
                            <option <?php if (isset($jobs_data) && $jobs_data->employee4_id == $employee->id) {
                                        echo 'selected';
                                    } ?> value="<?= $employee->id; ?>"><?= $employee->LName . ',' . $employee->FName; ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" id="" class="btn btn-primary" data-dismiss="modal">
                    <span class="fa fa-paper-plane-o"></span> Save / Close
                </button>
            </div>
        </div>
    </div>
</div>

<!-- On My Way Modal -->
<div class="modal fade" id="omw_modal" role="dialog">
    <div class="close-modal" data-dismiss="modal">&times;</div>
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
                    <input type="hidden" name="id" id="jobid" value="<?php if (isset($jobs_data)) {
                                                                            echo $jobs_data->job_unique_id;
                                                                        } ?>">
                    <input type="hidden" name="status" id="status" value="Arrival">
                    <select id="omw_time" name="omw_time" class="form-control" required>
                        <?php for ($x = 0; $x < time_availability(0, TRUE); $x++) { ?>
                            <option <?= isset($jobs_data) && strtolower($jobs_data->start_time) == time_availability($x) ?  'selected' : '';  ?> value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <span class="fa fa-paper-plane-o"></span> Save
                    </button>
                    <button type="button" id="" class="btn btn-default" data-dismiss="modal">
                        <span class="fa fa-remove"></span> Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Start Job Modal -->
<div class="modal fade" id="start_modal" role="dialog">
    <div class="close-modal" data-dismiss="modal">&times;</div>
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
                    <input type="hidden" name="id" id="jobid" value="<?php if (isset($jobs_data)) {
                                                                            echo $jobs_data->job_unique_id;
                                                                        } ?>">
                    <input type="hidden" name="status" id="start_status" value="Started">
                    <select id="job_start_time" name="job_start_time" class="form-control" required>
                        <?php for ($x = 0; $x < time_availability(0, TRUE); $x++) { ?>
                            <option <?= isset($jobs_data) && strtolower($jobs_data->start_time) == time_availability($x) ?  'selected' : '';  ?> value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <span class="fa fa-paper-plane-o"></span> Save
                    </button>
                    <button type="button" id="" class="btn btn-default" data-dismiss="modal">
                        <span class="fa fa-remove"></span> Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Approved Job Modal -->
<div class="modal fade" id="approved_modal" role="dialog">
    <div class="close-modal" data-dismiss="modal">&times;</div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Approved Job</h4>
            </div>
            <form id="update_status_to_approved">
                <div class="modal-body">
                    <p>This will stop travel duration tracking and start on job duration tracking.</p>
                    <p>Approved job at:</p>
                    <input type="date" name="approved_job_date" id="approved_job_date" class="form-control" required>
                    <input type="hidden" name="id" id="jobid" value="<?php if (isset($jobs_data)) {
                                                                            echo $jobs_data->job_unique_id;
                                                                        } ?>">
                    <input type="hidden" name="status" id="approved_status" value="Started">
                    <select id="approved_job_time" name="approved_job_time" class="form-control" required>
                        <?php for ($x = 0; $x < time_availability(0, TRUE); $x++) { ?>
                            <option <?= isset($jobs_data) && strtolower($jobs_data->start_time) == time_availability($x) ?  'selected' : '';  ?> value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <span class="fa fa-paper-plane-o"></span> Save
                    </button>
                    <button type="button" id="" class="btn btn-default" data-dismiss="modal">
                        <span class="fa fa-remove"></span> Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Finish Job Modal -->
<div class="modal fade" id="finish_modal" role="dialog">
    <div class="close-modal" data-dismiss="modal">&times;</div>
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
                    <input type="hidden" name="id" id="jobid" value="<?php if (isset($jobs_data)) {
                                                                            echo $jobs_data->job_unique_id;
                                                                        } ?>"> <br>
                    <input type="hidden" name="status" id="status" value="Closed">
                    <select id="job_start_time" name="job_start_time" class="form-control" required>
                        <?php for ($x = 0; $x < time_availability(0, TRUE); $x++) { ?>
                            <option <?= isset($jobs_data) && strtolower($jobs_data->start_time) == time_availability($x) ?  'selected' : '';  ?> value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-12">
                    <div class="col-md-12">
                        <a href="<?= base_url('job/billing/') . $jobs_data->job_unique_id; ?>">
                            <button type="button" class="btn btn-primary">
                                <span class="fa fa-money"></span> Pay Now
                            </button>
                        </a>

                        <a href="<?= base_url('job/send_customer_invoice_email/') . $jobs_data->job_unique_id; ?>" class="btn btn-primary">
                            <span class="fa fa-paper-plane-o"></span> Send Invoice
                        </a>
                    </div>
                </div>
                <br>
                <div class="modal-footer">
                    <button type="button" id="" class="btn btn-default" data-dismiss="modal">
                        <span class="fa fa-remove"></span> Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .dataTables_empty {
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
    'assets/textEditor/summernote-bs4.js',

    'assets/js/esign/docusign/workorder.js',
    'assets/js/esign/jobs/esign.js',
));
include viewPath('includes/footer');
?>
<link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?= google_credentials()['api_key'] ?>&callback=initialize&libraries=&v=weekly"></script>
<script src="https://momentjs.com/downloads/moment-with-locales.js"></script>

<?php include viewPath('job/js/job_new_js'); ?>
<script>
    $(function() {
        $('#customer_id').select2({
            ajax: {
                url: base_url + 'autocomplete/_company_customer',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;

                    return {
                        results: data,
                        // pagination: {
                        //   more: (params.page * 30) < data.total_count
                        // }
                    };
                },
                cache: true
            },
            placeholder: 'Select Customer',
            minimumInputLength: 0,
            templateResult: formatRepoCustomer,
            templateSelection: formatRepoCustomerSelection
        });

        function formatRepoCustomerSelection(repo) {
            if (repo.first_name != null) {
                return repo.first_name + ' ' + repo.last_name;
            } else {
                return repo.text;
            }

        }

        function formatRepoCustomer(repo) {
            if (repo.loading) {
                return repo.text;
            }

            var $container = $(
                '<div>' + repo.first_name + ' ' + repo.last_name + '<br /><small>' + repo.phone_h + ' / ' + repo.email + '</small></div>'
            );

            return $container;
        }

        /*$("#customer_id").select2({
            placeholder: "Select Customer"
        });*/
        $("#employee_id").select2({
            placeholder: "Select Employee"
        });
        $("#sales_rep").select2({
            placeholder: "Sales Rep"
        });
        $("#priority").select2({
            placeholder: ""
        });

        <?php if ($default_customer_id > 0) { ?>
            $('#customer_id').click();
            load_customer_data('<?= $default_customer_id; ?>');
        <?php } ?>
    });
</script>

<script>
    var geocoder;

    function initMap(address = null) {
        if (address == null) {
            address = '6866 Pine Forest Rd Pensacola FL 32526';
        }
        const myLatLng = {
            lat: -25.363,
            lng: 131.044
        };
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 12,
            height: 220,
            center: myLatLng,
        });
        new google.maps.Marker({
            position: myLatLng,
            map,
            title: "Hello World!",
        });
        geocoder = new google.maps.Geocoder();
        codeAddress(geocoder, map, address);
    }

    function codeAddress(geocoder, map, address) {
        geocoder.geocode({
            'address': address
        }, function(results, status) {
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
</script>