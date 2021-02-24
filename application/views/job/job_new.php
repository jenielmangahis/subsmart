<?php
defined('BASEPATH') or exit('No direct script access allowed');
add_css(array(
    'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
    'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
    //"assets/css/accounting/sidebar.css",
    'assets/textEditor/summernote-bs4.css',
));
?>
<?php include viewPath('includes/header'); ?>

<!-- add css for this page -->
<?php include viewPath('job/css/job_new'); ?>
<style>
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
</style>

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
                                            <a href="#step-1" type="button" class="btn btn-circle <?= !isset($jobs_data) || $jobs_data->status == 'New'  ? 'btn-success' : 'btn-default' ; ?>"><i style="font-size: 24px;" class="fa fa-pencil"></i></a>
                                            <p class=""><small>Draft</small></p>
                                        </div>
                                        <div class="stepwizard-step col-xs-3">
                                            <a href="#step-2" type="button" class="btn btn-circle <?= isset($jobs_data) && $jobs_data->status == 'Scheduled'  ? 'btn-success' : 'btn-default' ; ?>" disabled><span style="font-size: 24px;" class="fa fa-calendar-check-o"></span></a>
                                            <p class=""><small>Schedule</small></p>
                                        </div>
                                        <div class="stepwizard-step col-xs-3">
                                            <a href="#step-2" type="button" class="btn btn-circle <?= isset($jobs_data) && $jobs_data->status == 'On My Way'  ? 'btn-success' : 'btn-default' ; ?>"" disabled="disabled"><span style="font-size: 24px;" class="fa fa-ship"></span></a>
                                            <p><small>OMW</small></p>
                                        </div> &nbsp;&nbsp;
                                        <div class="stepwizard-step col-xs-3">
                                            <a href="#step-3" type="button" class="btn btn-circle <?= isset($jobs_data) && $jobs_data->status == 'Started'  ? 'btn-success' : 'btn-default' ; ?>"" disabled="disabled"><span style="font-size: 24px;" class="fa fa-hourglass-start"></span></a>
                                            <p><small>Start</small></p>
                                        </div>
                                        <div class="stepwizard-step col-xs-3">
                                            <a href="#step-4" type="button" class="btn btn-circle <?= isset($jobs_data) && $jobs_data->status == 'Completed'  ? 'btn-success' : 'btn-default' ; ?>"" disabled="disabled"><span style="font-size: 24px;" class="fa fa-check-circle-o"></span></a>
                                            <p><small>Approved</small></p>
                                        </div>
                                        <div class="stepwizard-step col-xs-3">
                                            <a href="#step-5" type="button" class="btn btn-circle <?= isset($jobs_data) && $jobs_data->status == 'Finished'  ? 'btn-success' : 'btn-default' ; ?>"" disabled="disabled"><span style="font-size: 24px;" class="fa fa-stop"></span></a>
                                            <p><small>Finish</small></p>
                                        </div>
                                        <div class="stepwizard-step col-xs-3">
                                            <a href="#step-6" type="button" class="btn btn-circle <?= isset($jobs_data) && $jobs_data->status == 'Invoiced'  ? 'btn-success' : 'btn-default' ; ?>"" disabled="disabled"><span style="font-size: 24px;" class="fa fa-paper-plane"></span></a>
                                            <p><small>Invoice</small></p>
                                        </div>
                                        <div class="stepwizard-step col-xs-3">
                                            <a href="#step-7" type="button" class="btn btn-circle <?= isset($jobs_data) && $jobs_data->status == 'Withdrawn'  ? 'btn-success' : 'btn-default' ; ?>"" disabled="disabled">
                                                <span style="font-size: 24px;" class="fa  fa-credit-card"></span></a>
                                            <p><small>Pay</small></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="alert alert-warning" role="alert" style="color:black;display: flex;position: relative;margin-right: 15px;"
                                <p> With a few clicks, you will be on your way to storing all information about the job performed for an account.
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
                                <span style="font-size: 20px;"  class="fa fa-calendar"></span>&nbsp; &nbsp;Schedule Job</h6>
                            <hr>
                            <?php if(!isset($jobs_data)): ?>
                            <p>Import Data from Wordorder/Invoice/Estimates</p>
                            <div id="import_buttons">
                                <a href="#" data-toggle="modal" data-target="#estimates_import" data-backdrop="static" data-keyboard="false" class="btn btn-sm btn-primary"><span class="fa fa-upload"></span> Estimates</a> &nbsp;&nbsp;
                                <a href="#" data-toggle="modal" data-target="#workorder_import" data-backdrop="static" data-keyboard="false" type="button" class="btn btn-sm btn-primary"><span class="fa fa-upload"></span> WorkOrder</a> &nbsp;&nbsp;
                                <a href="#" data-toggle="modal" data-target="#invoice_import" data-backdrop="static" data-keyboard="false" type="button" class="btn btn-sm btn-primary"><span class="fa fa-upload"></span> Invoice</a>
                            </div>
                            <hr>
                            <?php endif; ?>
                            <div class="form-group label-width d-flex align-items-center">
                                <label>From</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" value="<?= isset($jobs_data) ?  $jobs_data->start_date : '';  ?>" required>
                                <select id="inputState" name="start_time" class="form-control" required>
                                    <option selected="">Start time</option>
                                    <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                        <option <?= isset($jobs_data) && strtolower($jobs_data->start_time) == time_availability($x) ?  'selected' : '';  ?> value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group label-width d-flex align-items-center">
                                <label >To</label>
                                <input type="date" name="end_date" id="end_date" class="form-control mr-2" value="<?= isset($jobs_data) ?  $jobs_data->end_date : '';  ?>" required>
                                <select id="inputState" name="end_time" class="form-control" required>
                                    <option selected="">End time</option>
                                    <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                        <option <?= isset($jobs_data) && strtolower($jobs_data->end_time) == time_availability($x) ?  'selected' : '';  ?> value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <select id="employee_id" name="employee_id" class="form-control">
                                <option selected="">Select Employee</option>
                                <?php if(!empty($employees)): ?>
                                    <?php foreach ($employees as $employee): ?>
                                        <option <?= isset($jobs_data) && $jobs_data->employee_id == $employee->id ? 'selected' : '';  ?> value="<?= $employee->id; ?>"><?= $employee->LName.','.$employee->FName; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <div class="color-box-custom">
                                <h6>Event Color on Calendar</h6>
                                <ul>
                                    <?php if(isset($color_settings)): ?>
                                        <?php foreach ($color_settings as $color): ?>
                                            <li>
                                                <a style="background-color: <?= $color->color_code; ?>;" id="<?= $color->id; ?>" type="button" class="btn btn-default color-scheme btn-circle bg-1">
                                                    <?php if(isset($jobs_data) && $jobs_data->event_color == $color->id) {echo '<i class="fa fa-check calendar_button" aria-hidden="true"></i>'; } ?>
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
                                <option selected="">Central Time (UTC -5)</option>
                            </select>
                            <h6>Select Job Type</h6>
                            <select id="job_type_option" name="jobtypes" class="form-control">
                                <option value="">Select Tag</option>
                                <?php if(!empty($job_types)): ?>
                                    <?php foreach ($job_types as $type): ?>
                                        <option <?php if(isset($jobs_data) && $jobs_data->job_type == $type->title) {echo 'selected'; } ?> value="<?= $type->title; ?>"><?= $type->title; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>

                            <h6>Select Job Tag</h6>
                            <select id="job_tags" name="tags" class="form-control">
                                <?php if(!empty($tags)): ?>
                                    <?php foreach ($tags as $tag): ?>
                                        <option <?php if(isset($jobs_data) && $jobs_data->tags == $tag->id) {echo 'selected'; } ?> value="<?= $tag->id; ?>"><?= $tag->name; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <hr>
                            <a href="#" data-toggle="modal" data-target="#share_job_modal" data-backdrop="static" data-keyboard="false" class="btn btn-primary pull-right text-link"> <span class="fa fa-plus"></span> Share Job</a>
                        </div>
                        <br>
                    </div>
                    <!--<div class="card">
                        <div class="card-body">
                            <h6 class="page-title">
                                Map
                            </h6>

                            <br>
                        </div>
                    </div>-->

                    <div class="card" id="notes_left_card" style="display: <?= isset($jobs_data) ? 'none' : 'block' ;?>;">
                        <div class="card-header">
                            <button style="display: flex;" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <h6 class="page-title"> <span class="fa fa-book box_footer_icon"></span> &nbsp; Private Notes </h6>
                            </button>
                            <a href="javascript:void(0);" id="notes_left"><span class="fa fa-columns" style="float: right;padding-right: 40px;font-size: 20px;display: block;margin-top: -38px;"></span></a>
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
                                <?php if(isset($jobs_data)) : ?>
                                <a href="#"  class="fa fa-history box_footer_icon"></a> &nbsp;
                                <a href="#"  class="fa fa-trash box_footer_icon"></a> &nbsp;
                                <?php endif; ?>
                            </div>
                        </div>
                            <br>
                        </div>
                    </div>
                    <div class="card" id="attach_left_card" style="display: <?= isset($jobs_data) ? 'none' : 'block' ;?>;">
                        <div class="card-header" >
                            <button style="display: flex;" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#photos_attachment" aria-expanded="true" aria-controls="photos_attachment">
                                <h6 class="page-title"><span style="font-size: 20px;"  class="fa fa-image"></span>&nbsp; &nbsp;Photos / Attachments</h6>
                            </button>
                            <a href="javascript:void(0);" id="attach_left_btn_column">
                                <span class="fa fa-columns card_plus_sign"></span>
                            </a>
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
                    <div class="card" id="url_left_card" style="display: <?= isset($jobs_data) ? 'none' : 'block' ;?>;">
                        <div class="card-header" id="headingThree">
                            <button style="display: flex;" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#url_link_form" aria-expanded="true" aria-controls="url_link_form">
                                <h6 class="page-title"><span style="font-size: 20px;"  class="fa fa-link"></span> &nbsp; &nbsp;Url Link </h6>
                            </button>
                            <a href="javascript:void(0);" id="url_left_btn_column">
                                <span class="fa fa-columns card_plus_sign"></span>
                            </a>
                        </div>
                        <div class="card-body">
                            <div id="url_link_form" class="collapse" aria-labelledby="headingThree" data-parent="#url_link_form">
                                <div class="card-body">
                                    <?php
                                    if(isset($jobs_data) && $jobs_data->link != NULL) {
                                        ?>
                                        <a target="_blank" href="<?= $jobs_data->link; ?>"><p><?= $jobs_data->link; ?></p></a>
                                        <?php
                                    }else{
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
                    <div class="card" id="pd_left_card" style="display: <?= isset($jobs_data) ? 'none' : 'block' ;?>;">
                        <div class="card-header">

                            <button style="display: flex;" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#payment" aria-expanded="true" aria-controls="payment">
                                <h6 class="page-title"><span style="font-size: 20px;"  class="fa fa-money"></span>&nbsp;&nbsp;Payment Details</h6>
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
                                                    <option <?php if(isset($jobs_data) && $jobs_data->pay_method == 'CC') {echo 'selected'; } ?> value="CC">Credit Card</option>
                                                    <option <?php if(isset($jobs_data) && $jobs_data->pay_method == 'CHECK') {echo 'selected'; } ?> value="CHECK">Check</option>
                                                    <option <?php if(isset($jobs_data) && $jobs_data->pay_method == 'CASH') {echo 'selected'; } ?> value="CASH">Cash</option>
                                                    <option <?php if(isset($jobs_data) && $jobs_data->pay_method == 'ACH') {echo 'selected'; } ?> value="ACH">ACH</option>
                                                    <option <?php if(isset($jobs_data) && $jobs_data->pay_method == 'VENMO') {echo 'selected'; } ?> value="VENMO">Venmo</option>
                                                    <option <?php if(isset($jobs_data) && $jobs_data->pay_method == 'PP') {echo 'selected'; } ?> value="PP">Paypal</option>
                                                    <option <?php if(isset($jobs_data) && $jobs_data->pay_method == 'SQ') {echo 'selected'; } ?> value="SQ">Square</option>
                                                    <option <?php if(isset($jobs_data) && $jobs_data->pay_method == 'WW') {echo 'selected'; } ?> value="WW">Warranty Work</option>
                                                    <option <?php if(isset($jobs_data) && $jobs_data->pay_method == 'HOF') {echo 'selected'; } ?> value="HOF">Home Owner Financing</option>
                                                    <option <?php if(isset($jobs_data) && $jobs_data->pay_method == 'eT') {echo 'selected'; } ?> value="eT">e-Transfer</option>
                                                    <option <?php if(isset($jobs_data) && $jobs_data->pay_method == 'OCCP') {echo 'selected'; } ?> value="OCCP">Other Credit Card Processor</option>
                                                    <option <?php if(isset($jobs_data) && $jobs_data->pay_method == 'OPT') {echo 'selected'; } ?> value="OPT">Other Payment Type</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="">Amount <small class="help help-sm" >(in dollar)</small></label>
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
                                                                    <label >Save card to file</label>
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
                                                                            <input type="number" name="route_number" class="form-control" id="cardNumber" placeholder="Routing #"  />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <input type="number" name="account_number" class="form-control" id="cardNumber" placeholder="Account #"  />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <select id="day_of_month_ach" name="day_of_month" class="form-control">
                                                                            <option value="">Select Day of Month</option>
                                                                            <?php for($x=1;$x<=31;$x++){ ?>
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
                                                                            <input type="number" name="acct_credential" class="form-control" id="cardNumber" placeholder="Account Credential"  />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <textarea  class="form-control" name="acct_note" id="cardNumber" placeholder="Account Note"></textarea>
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
                                                                            <input type="number" name="acct_credential" class="form-control" id="cardNumber" placeholder="Account Credential"  />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <textarea  class="form-control" name="acct_note" id="cardNumber" placeholder="Account Note"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <textarea  class="form-control" name="acct_confirm" id="cardNumber" placeholder="Confirmation"></textarea>
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
                    <div class="card" style="display: <?= isset($jobs_data) ? 'none' : 'block' ;?>;">
                        <div class="card-header">
                            <button  style="display: flex;" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#fill-eSign" aria-expanded="true" aria-controls="fill-eSign">
                                <h6 class="page-title"><span style="font-size: 20px;"  class="fa fa-edit"></span>&nbsp;&nbsp;Fill & eSign</h6>
                            </button>
                        </div>
                        <div class="card-body">
                            <div id="fill-eSign" class="collapse" aria-labelledby="headingThree" data-parent="#fill-eSign">
                                <div class="card-body">
                                    <a style="cursor: pointer;" id="fill_esign_btn" data-toggle="modal" data-target="#fill_esign" data-backdrop="static" data-keyboard="false">
                                        <center>
                                            <img width="100" id="" alt="Customer Signature" src="/assets/img/jobs/add_file.png">
                                        </center>
                                    </a>
                                </div>
                                <div style="float: right;">
                                    <a ><span style="font-size: 20px;" class="fa fa-pencil"></span> &nbsp;</a>
                                    <span style="font-size: 20px;" class="fa fa-ellipsis-v"></span> &nbsp;
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card" id="approval_card_left" style="display: <?= isset($jobs_data) ? 'none' : 'block' ;?>;">
                        <div class="card-header" id="headingOne">
                            <button style="display: flex;" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#approval" aria-expanded="true" aria-controls="approval">
                                <h6 class="page-title"><span style="font-size: 20px;"  class="fa fa-check-circle-o"></span> Approval</h6>
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
                    <!-- <div class="prev-btn float-right">
                       <button type="button" class="btn btn-primary">Preview</button>
                    </div> -->

                </div>
                <div class="col-md-8">

                    <div class="card table-custom">
                        <div class="card-body">
                            <div class="row">
                                <div style="display: flex; margin: 0;margin-right: auto;" >
                                    <b>Created By: </b> <span> <?= ' '.$logged_in_user->FName.' '.$logged_in_user->LName; ?></span>
                                </div>
                                <a  class="add_new_customer" href="javascript:void(0)" id="add_another_invoice" data-toggle="modal" data-target="#new_customer">
                                    <span class="fa fa-plus-square"></span> Add New Customer
                                </a>
                                <hr>
                                <div class="col-md-4">
                                    <h6>Customer Info</h6>
                                    <select id="customer_id" name="customer_id" class="form-control" required>
                                        <option value="">Select Existing Customer</option>
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
                                            <td><a href="<?= base_url('customer'); ?>"><span class="fa fa-user customer_right_icon"></span></a></td>
                                        </tr>
                                        <tr>
                                            <td id="cust_address">-------------</td>
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
                                        <div id="streetViewBody" class="col-md-6 float-left no-padding" style="padding-right:15px;"></div>
                                        <div id="map" class="col-md-6 float-left"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td>
                                    <h6>Job Items Listing</h6>
                                </td>
                            </tr>
                            </thead>
                            <tbody id="jobs_items_table_body">
                            <tr>
                                <td>
                                    <small>Job Type</small>
                                    <input type="text" id="job_type" name="job_type" value="<?= isset($jobs_data) ? $jobs_data->job_type : ''; ?>" class="form-control" readonly>
                                </td>
                                <td>
                                </td>
                                <td>
                                    <small>Job Tags</small>
                                    <input type="text" name="job_tag" class="form-control" value="<?= isset($jobs_data) ? $jobs_data->name : ''; ?>" id="job_tags_right" readonly>
                                </td>
                                <td>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary"><span class="fa fa-paper-plane-o"  style=""></span></button>
                                    <button type="button" class="btn btn-sm btn-primary"><span class="fa fa-file"  style="color:"></span></button>
                                    <button type="button" class="btn btn-sm btn-primary"><span class="fa fa-print" style="color:"></span></button>
                                    <button type="button" class="btn btn-sm btn-primary"><span class="fa fa-plus"  style="color:"></span></button>
                                </td>
                                <td>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="col-sm-12">
                            <a class="link-modal-open" href="#" id="add_another_items" data-toggle="modal" data-target="#item_list">
                                <span class="fa fa-plus-square fa-margin-right"></span>Add Items
                            </a>
                        </div>
                        <br>
                        <div class="col-sm-12">
                            <p>Description of Job (optional)</p>
                            <textarea name="job_description" class="form-control"><?= isset($jobs_data) ? $jobs_data->job_description : ''; ?></textarea>
                            <hr/>
                        </div>
                        <div class="col-md-12 table-responsive">
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
                                                        <p>PDF</p>
                                                        <p class="or-text">Or</p>
                                                        <p>URL Link</p>
                                                        <p>To see import source</p>
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
                                        <label id="invoice_sub_total">$0.00</label>
                                        <input type="hidden" name="sub_total" id="sub_total_form_input" value='0'>
                                    </div>
                                    <div class="col-sm-12">
                                        <hr>
                                    </div>
                                    <div class="col-sm-6">
                                        <small>Tax Rate</small>
                                        <select id="tax_rate" name="tax_rate" class="form-control">
                                            <option value="">None</option>
                                            <option value="0.075">FL Tax(7.5%)</option>
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
                                        <label id="invoice_overall_total">$0.00</label>
                                        <input type="hidden" name="sub_total" id="sub_total_form_input" value='0'>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <hr>
                                </div>
                                <div class="col-sm-12" id="approval_card_right" style="display: <?= isset($jobs_data) ? 'block' : 'none' ;?>;">
                                    <div style="float: right;">
                                        <a href="javascript:void(0);" id="approval_btn_right"><span class="fa fa-columns" style="float: right;padding-right: 20px;"></span></a>
                                        <center>
                                            <img width="150" id="customer_signature_right" alt="Customer Signature" src="<?= isset($jobs_data) ? $jobs_data->signature_link : ''; ?>">
                                        </center>
                                        <center><span id="appoval_name_right"><?= isset($jobs_data->authorize_name) ? $jobs_data->authorize_name : 'Xxxxx Xxxxxx'; ?></span></center><br>
                                        <span>-----------------------------</span><br>
                                        <center><small>Approved By</small></center><br>
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
                                                        <a target="_blank" href="<?= $jobs_data->link; ?>"><p><?= $jobs_data->link; ?></p></a>
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
                                    <input class="form-control" value="Thank you for your business, Please call <?= $company_info->business_name; ?> at <?= $company_info->business_phone; ?> for quality customer service.">
                                </div>
                                <div class="col-sm-12">
                                    <hr>
                                </div>
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
                                <div class="col-sm-12">
                                    <div class="card box_right">
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <div class="card-header">
                                                    <h5 style="padding-left: 20px;" class="mb-0">Devices Audit</h5>
                                                </div>
                                                <div class="card-body">
                                                    <span class="help help-sm help-block">Record all items used on jobs</span>
                                                    <a href="#" id="" data-toggle="modal" data-target="#new_items" type="button" class="btn btn-sm btn-primary"><span class="fa fa-plus"  style="color:"></span> Add New Item</a>
                                                    <br>
                                                    <table style="width: 100%;" id="device_audit" class="table table-hover table-bordered table-striped">
                                                        <thead>
                                                        <tr>
                                                            <td>Name</td>
                                                            <td>Sold By</td>
                                                            <td>Points</td>
                                                            <td>Retail Cost</td>
                                                            <td>Purchase Price</td>
                                                            <td>Qty</td>
                                                            <td>Tot Points</td>
                                                            <td>Tot Cost</td>
                                                            <td>Tot Purchase Price</td>
                                                            <td>Net</td>
                                                            <td>Action</td>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="device_audit_datas">

                                                        <?php if (isset($device_info)) : ?>
                                                            <?php foreach ($device_info as $device) { ?>
                                                                <tr>
                                                                    <td style="text-align: left; border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                                                                        <?= $device->device_name; ?>
                                                                    </td>
                                                                    <td style="text-align: left; border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                                                                        <?= $device->sold_by; ?>
                                                                    </td>
                                                                    <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                                                                        <?= $device->device_points; ?>
                                                                    </td>
                                                                    <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px; color: #336699; text-align: right">
                                                                        <?= '$'.$device->retail_cost; ?>
                                                                    </td>
                                                                    <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px; color: #CC3300; text-align: right">
                                                                        <?= '$'.$device->purch_price; ?>
                                                                    </td>
                                                                    <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                                                                        <?= $device->device_qty; ?>
                                                                    </td>
                                                                    <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px">
                                                                        <?= $device->total_points; ?>
                                                                    </td>
                                                                    <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px; color: #336699; text-align: right">
                                                                        <?= '$'.$device->total_cost; ?>
                                                                    </td>
                                                                    <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px; color: #CC3300; text-align: right">
                                                                        <?= '$'.$device->total_purch_price; ?>
                                                                    </td>
                                                                    <td style="border-color: #525759; border-style: solid; border-collapse: collapse; border-width: 1px; color: Green; text-align: right">
                                                                        <?= '$'.$device->device_net; ?>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        <?php endif ?>
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
                            </div>
                            <br>
                        </div>
                        <div class="row">
                            <input id="signature_link" type="hidden" name="signature_link">
                            <input id="name" type="hidden" name="authorize_name">
                            <input id="datetime_signed" type="hidden" name="datetime_signed">
                            <input id="attachment" type="hidden" name="attachment">
                            <input id="created_by" type="hidden" name="created_by" value="<?= $logged_in_user->id; ?>">
                            <input id="employee2_id" type="hidden" name="employee2_id" value="<?= isset($jobs_data) ? $jobs_data->employee2_id : ''; ?>">
                            <input id="employee3_id" type="hidden" name="employee3_id" value="<?= isset($jobs_data) ? $jobs_data->employee3_id : ''; ?>">
                            <input id="employee4_id" type="hidden" name="employee4_id" value="<?= isset($jobs_data) ? $jobs_data->employee4_id : ''; ?>">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary"><span class="fa fa-calendar-check-o"></span> Schedule</button>
                                <button type="button" class="btn btn-primary"><span class="fa fa-search-plus"></span> Preview</button>

                            </div>
                        </div>
                    </div>
                    <div class="card">
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
                    </div>
                </div>

        </div>

    </div>
    </form>
</div>
<!-- end container-fluid -->
</div>

<!-- Modal -->
<div class="modal fade" id="new_customer" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newcustomerLabel">Add new customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="new_customer_form">
                <div class="modal-body">
                    <div class="contact-info">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" name="first_name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" name="last_name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Middle Initial</label>
                                            <input type="text" name="middle_name" class="form-control" placeholder="optional" >
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" name="phone_h" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" name="mail_add" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" name="city" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>State</label>
                                            <input type="text" name="state" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Zip Code</label>
                                            <input type="text" name="zip_code" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>

                </div>
                <div class="modal-footer modal-footer-detail">
                    <div class="button-modal-list">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fa fa-remove"></span> Close</button>
                        <button type="submit" class="btn btn-primary"><span class="fa fa-paper-plane-o"></span> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="new_items" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="item_details_title">Add New Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="new_customer_form">
                <div class="modal-body">
                    <div class="contact-info">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Item Name</label>
                                            <input type="text" id="item_details_name" name="item_details_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="last_name" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Qty</label>
                                            <input type="text" id="item_details_qty" name="middle_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Cost</label>
                                            <input type="number" id="item_details_cost" name="email" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Cost Per</label>
                                            <select class="form-control" name="cost_per" id="cost_per" required>
                                                <option value="each" selected>Each</option>
                                                <option>Weight</option>
                                                <option>Length</option>
                                                <option>Area</option>
                                                <option>Volume</option>
                                                <option>Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Unit</label>
                                            <input type="text" name="mail_add" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Brand</label>
                                            <input type="text" name="middle_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Vendor</label>
                                            <select class="form-control" name="vendor" id="exampleFormControlSelect1">
                                                <option disabled>Select</option>
                                                <option value="1">Vendor A</option>
                                                <option value="2">Vendor B</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Product Url</label>
                                            <input type="text" name="state" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Cost of Goods</label>
                                            <input type="text" name="zip_code" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Model Number</label>
                                            <input type="text" name="zip_code" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Item Group</label>
                                            <input type="text" name="zip_code" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Sold By</label>
                                            <select id="employee_id_sold" name="employee_id_sold" class="form-control">
                                                <option selected="">Select Employee</option>
                                                <?php if(!empty($employees)): ?>
                                                    <?php foreach ($employees as $employee): ?>
                                                        <option <?php if(isset($jobs_data) && $jobs_data->employee_ids == $employee->id) {echo 'selected'; } ?> value="<?= $employee->id; ?>"><?= $employee->LName.','.$employee->FName; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Points</label>
                                            <input type="text" name="zip_code" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Location</label>
                                            <button class="btn btn-default" type="button" data-id="<?php echo $item[3]; ?>" id="seeLocation" data-toggle="dropdown" aria-expanded="true">
                                                <span class="btn-label">See Location <i class="fa fa-caret-down fa-sm" style="margin-left:10px;"></i></span></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right" id="<?php echo 'locQtyList' . $item[3]; ?>" style="width:300px;" role="menu" aria-labelledby="dropdown-edit">
                                                <li role="presentation" style="background-color:#D3D3D3;">
                                                    <a role="menuitem" tabindex="-1" href="javascript:void(0)" class="editItemBtn"><span style="padding-right:150px;">
                                                            <strong>Location</strong></span><span style="border-left:1px solid black;"> <strong>Qty</strong></span>
                                                </li>
                                                <li role="separator" class="divider"></li>
                                            </ul>
                                            <input type="text" name="zip_code" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>

                </div>
                <div class="modal-footer modal-footer-detail">
                    <div class="button-modal-list">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fa fa-remove"></span> Close</button>
                        <button type="submit" class="btn btn-primary"><span class="fa fa-paper-plane-o"></span> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Signature Modal -->
<div class="modal fade" id="updateSignature" role="dialog">
    <div class="close-modal" data-dismiss="modal">&times;</div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Approval</h4>
            </div>
            <div class="modal-body">
                <label>Authorizer Name</label>
                <input type="text" name="authorizer_name" id="authorizer_name" class="form-control" >
                <br>
                <small>Signature Below</small>
                <hr>
                <div id="signature" style='border:none;'>
                    <canvas id="signature-pad" class="signature-pad" width="430px" height="230px"></canvas>
                </div>
                <textarea style="display: none;" name="data[output]" id='output'></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" id="click" class="btn btn-primary save-signature" data-dismiss="modal">
                    <span class="fa fa-paper-plane-o"></span> Save
                </button>
                <button type="button" id="cancel-signature" class="btn btn-default" data-dismiss="modal">
                    <span class="fa fa-close"></span> Cancel
                </button>
                <button type="button" id="clear-signature" class="btn btn-default">
                    <span class="fa fa-close"></span> Clear
                </button>
            </div>
        </div>
    </div>
</div>

<!-- eSgin Modal -->
<div class="modal fade" id="fill_esign" role="dialog">
    <div class="close-modal" data-dismiss="modal">&times;</div>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Fill & eSign</h4>
            </div>
            <div class="modal-body">
                <a href="<?= base_url('esign/createTemplate'); ?>" style="float: right;" class="btn btn-sm btn-primary"><span class="fa fa-plus"></span> Add New</a>
                <select name="library_template" id="library_template" class="select2LibrarySelection dropdown form-control">
                    <option>Select Library Template</option>
                    <?php if(isset($esign_templates)) : ?>
                        <?php foreach($esign_templates as $esign_template){ ?>
                            <option value="<?= $esign_template->esignLibraryTemplateId; ?>"><?= $esign_template->title; ?></option>
                        <?php } ?>
                    <?php endif; ?>
                </select>
                <br>
                <small>Template</small>
                <hr>
                <textarea id="summernote" name="template"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> Close</button>
                <button type="button" id="click" class="btn btn-primary save-signature"><span class="fa fa-paper-plane-o"></span> Save</button>
            </div>
        </div>
    </div>
</div>

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
                                <td> Action</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($items)): ?>
                                <?php foreach ($items as $item): ?>
                                    <tr>
                                        <td><?= $item->title; ?></td>
                                        <td><?= $item->units; ?></td>
                                        <td><?= $item->price; ?></td>
                                        <td><button id="<?= $item->id; ?>" data-quantity="<?= $item->units; ?>" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>" type="button" data-dismiss="modal" class="btn btn-sm btn-default select_item"><span class="fa fa-plus"></span></button></td>
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
                            <?php if(!empty($estimates)): ?>
                                <?php foreach ($estimates as $estimate): ?>
                                    <tr>
                                        <td><?= $estimate->estimate_number; ?></td>
                                        <td><?= $estimate->job_name; ?></td>
                                        <td><?= date('M d, Y', strtotime($estimate->estimate_date)); ?></td>
                                        <td>
                                            <button id="<?= $estimate->customer_id; ?>" type="button" data-dismiss="modal" class="btn btn-sm btn-default estimate_select">
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
<div class="modal fade" id="workorder_import" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newcustomerLabel">Select WorkOrder To Make a Job</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="workorder_table" class="table table-hover" style="width: 100%;">
                            <thead>
                            <tr>
                                <td> WorkOrder #</td>
                                <td> Job Name</td>
                                <td> Date</td>
                                <td> </td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($workorders)): ?>
                                <?php foreach ($workorders as $workorder): ?>
                                    <tr>
                                        <td><?= $workorder->work_order_number; ?></td>
                                        <td><?= $workorder->job_name; ?></td>
                                        <td><?= date('M d, Y', strtotime($workorder->start_date)); ?></td>
                                        <td>
                                            <button id="<?= $workorder->customer_id; ?>" type="button" data-dismiss="modal" class="btn btn-sm btn-default workorder_select">
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
<div class="modal fade" id="invoice_import" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newcustomerLabel">Select Invoice To Make a Job</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="invoices_table" class="table table-hover" style="width: 100%;">
                            <thead>
                            <tr>
                                <td> Invoice #</td>
                                <td> Job Name</td>
                                <td> Date</td>
                                <td> </td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($invoices)): ?>
                                <?php foreach ($invoices as $invoice): ?>
                                    <tr>
                                        <td><?= $invoice->invoice_number; ?></td>
                                        <td><?= $invoice->job_name; ?></td>
                                        <td><?= date('M d, Y', strtotime($invoice->date_issued)); ?></td>
                                        <td>
                                            <button id="<?= $invoice->customer_id; ?>" type="button" data-dismiss="modal" class="btn btn-sm btn-default invoice_select">
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


<!-- Signature Modal -->
<div class="modal fade" id="share_job_modal" role="dialog">
    <div class="close-modal" data-dismiss="modal">&times;</div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Share Job To Other Employee</h4>
            </div>
            <div class="modal-body">
                <label>Employee 2</label>
                <select id="employee2" name="employee2_" class="form-control">
                    <option value="">Select Employee</option>
                    <?php if(!empty($employees)): ?>
                        <?php foreach ($employees as $employee): ?>
                            <option <?php if(isset($jobs_data) && $jobs_data->employee2_id == $employee->id) {echo 'selected'; } ?> value="<?= $employee->id; ?>"><?= $employee->LName.','.$employee->FName; ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>

                <label>Employee 3</label>
                <select id="employee3" name="employee3_" class="form-control">
                    <option value="">Select Employee</option>
                    <?php if(!empty($employees)): ?>
                        <?php foreach ($employees as $employee): ?>
                            <option <?php if(isset($jobs_data) && $jobs_data->employee3_id == $employee->id) {echo 'selected'; } ?> value="<?= $employee->id; ?>"><?= $employee->LName.','.$employee->FName; ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>

                <label>Employee 4</label>
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
                <button type="button" id="" class="btn btn-primary">
                    <span class="fa fa-paper-plane-o"></span> Save
                </button>
                <button type="button" id="" class="btn btn-default" data-dismiss="modal">
                    <span class="fa fa-remove"></span> Close
                </button>
            </div>
        </div>
    </div>
</div>

<?php
add_footer_js(array(
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
    'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
    'https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/javascript.util/0.12.12/javascript.util.min.js',
    'assets/textEditor/summernote-bs4.js',
));
include viewPath('includes/footer');
?>
<link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?= google_credentials()['api_key'] ?>&callback=initialize&libraries=&v=weekly"></script>

<?php include viewPath('job/js/job_new_js'); ?>

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
                console.log(status);
                console.log('Geocode was not successful for the following reason: ' + status);
            }
        });
    }
</script>

