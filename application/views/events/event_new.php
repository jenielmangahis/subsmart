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
    .card{
        box-shadow: 0 0 13px 0 rgb(116 116 117 / 44%) !important;
    }
</style>

<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/events'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <form method="post" name="myform" id="events_form">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h1 style="font-size: 1.75rem;">Event Scheduler Tool</h1>
                            </div>
                            <div class="card-body">
                                <div class="stepwizard">
                                    <div class="stepwizard-row setup-panel">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <div class="stepwizard-step col-xs-3">
                                            <a href="#" type="button" class="btn btn-circle <?= !isset($jobs_data) || $jobs_data->status == '0'  ? 'btn-success' : 'btn-default' ; ?>"><i style="font-size: 24px;" class="fa fa-pencil"></i></a>
                                            <p class=""><small>Draft</small></p>
                                        </div>&nbsp;
                                        <div class="stepwizard-step col-xs-3">
                                            <a href="#" type="button" class="btn btn-circle <?= isset($jobs_data) && $jobs_data->status == '1'  ? 'btn-success' : 'btn-default' ; ?>" disabled><span style="font-size: 24px;" class="fa fa-calendar-check-o"></span></a>
                                            <p class=""><small>Schedule</small></p>
                                        </div>&nbsp;
                                        <div class="stepwizard-step col-xs-3" id="btn_omw_status" style="display:none;">
                                            <a href="#" <?php if(isset($jobs_data) && $jobs_data->status == '1'): ?>data-toggle="modal" data-target="#omw_modal" data-backdrop="static" data-keyboard="false" <?php endif; ?> type="button" class="btn btn-circle <?= isset($jobs_data) && $jobs_data->status == '2'  ? 'btn-success' : 'btn-default' ; ?>" disabled="disabled"><span style="font-size: 24px;" class="fa fa-ship"></span></a>
                                            <p><small>OMW</small></p>
                                        </div> &nbsp;
                                        <div class="stepwizard-step col-xs-3">
                                            <a href="#" <?php if(isset($jobs_data) && ($jobs_data->status == '2' || $jobs_data->status == '1')): ?>data-toggle="modal" data-target="#start_modal" data-backdrop="static" data-keyboard="false" <?php endif; ?> type="button" class="btn btn-circle <?= isset($jobs_data) && $jobs_data->status == '3'  ? 'btn-success' : 'btn-default' ; ?>" disabled="disabled"><span style="font-size: 24px;" class="fa fa-hourglass-start"></span></a>
                                            <p><small>Started</small></p>
                                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                        <div class="stepwizard-step col-xs-3">
                                            <a href="#" <?php if(isset($jobs_data) && $jobs_data->status == '3'): ?>data-toggle="modal" data-target="#finish_modal" data-backdrop="static" data-keyboard="false" <?php endif; ?> type="button" class="btn btn-circle <?= isset($jobs_data) && $jobs_data->status == '4'  ? 'btn-success' : 'btn-default' ; ?>" disabled="disabled"><span style="font-size: 24px;" class="fa fa-stop"></span></a>
                                            <p><small>Finished</small></p>
                                        </div>

                                        <div class="stepwizard-step col-xs-3" id="convert_to_job" style="display:none;">
                                            <a href="#" type="button" class="btn btn-circle <?= isset($jobs_data) && $jobs_data->status == '5'  ? 'btn-success' : 'btn-default' ; ?>" disabled="disabled">
                                                <span style="font-size: 24px;" class="fa fa-copy"></span>
                                            </a>
                                            <p><small>Convert To Job</small></p>
                                        </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="alert alert-warning" role="alert" style="color:black;display: flex;position: relative;margin-right: 15px;"
                                <p>
                                    Use this Event Scheduler Tool to start tracking the flow and success of each event.
                                    However the main function is to schedule appointments, reminders, estimates, tasks, project timelines,
                                    meetings or anything else required by your company or organization.
                                </p>
                            </div>
                        </div>
                    </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="page-title">
                                <span style="font-size: 20px;"  class="fa fa-calendar"></span>&nbsp; &nbsp;Schedule Event</h6>
                            <hr>
                            <div class="form-group label-width d-flex align-items-center">
                                <label>From</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" value="<?= isset($jobs_data) ?  $jobs_data->start_date : '';  ?>" required>
                                <select id="start_time" name="start_time" class="form-control" required>
                                    <option selected="">Start time</option>
                                    <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                        <option <?= isset($jobs_data) && strtolower($jobs_data->start_time) == time_availability($x) ?  'selected' : '';  ?> value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group label-width d-flex align-items-center">
                                <label >To</label>
                                <input type="date" name="end_date" id="end_date" class="form-control mr-2" value="<?= isset($jobs_data) ?  $jobs_data->end_date : '';  ?>" required>
                                <select id="end_time" name="end_time" class="form-control" required>
                                    <option selected="">End time</option>
                                    <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                        <option <?= isset($jobs_data) && strtolower($jobs_data->end_time) == time_availability($x) ?  'selected' : '';  ?> value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <select id="employee_id" name="employee_id" class="form-control" required>
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
                                                <a data-color="<?= $color->color_code; ?>" style="background-color: <?= $color->color_code; ?>;" id="<?= $color->id; ?>" type="button" class="btn btn-default color-scheme btn-circle bg-1" title="<?= $color->color_name; ?>">
                                                    <?php if(isset($jobs_data) && $jobs_data->event_color == $color->color_code) {echo '<i class="fa fa-check calendar_button" aria-hidden="true"></i>'; } ?>
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

                            <h6>Select Event Tag</h6>
                            <select id="job_tags" name="tags" class="form-control">
                                <option value="">Select Event Tag</option>
                                <?php if(!empty($tags)): ?>
                                    <?php foreach ($tags as $tag): ?>
                                        <option <?php if(isset($jobs_data) && $jobs_data->event_tag == $tag->name) {echo 'selected'; } ?> value="<?= $tag->id; ?>"><?= $tag->name; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>

                            <h6>Select Event Type</h6>
                            <select id="job_type_option" name="jobtypes" class="form-control" required>
                                <option value="">Select Event Type</option>
                                <?php if(!empty($job_types)): ?>
                                    <?php foreach ($job_types as $type): ?>
                                        <option <?php if(isset($jobs_data) && $jobs_data->event_type == $type->title) {echo 'selected'; } ?> value="<?= $type->title; ?>"><?= $type->title; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <p></p>
                            <div id="pac-container">
                                <input id="event_address" value="<?= isset($jobs_data) ?  $jobs_data->event_address : '';  ?>" name="event_address" class="form-control" type="text" placeholder="Enter a location" />
                            </div>

                            <hr>
                            <!--<a href="#" data-toggle="modal" data-target="#share_job_modal" data-backdrop="static" data-keyboard="false" class="btn btn-primary pull-right text-link">
                                <span class="fa fa-plus"></span> Share Event</a>-->
                        </div>
                        <br>
                    </div>

                    <div class="card" id="notes_left_card" style="display: <?= isset($jobs_data) ? 'none' : 'block' ;?>;">
                        <div class="card-header">
                            <span style="display: flex;" class="btn" type="button">
                                <h6 class="page-title"> <span class="fa fa-book box_footer_icon"></span> &nbsp; Private Notes </h6>
                            </span>
                        </div>
                        <div id="collapseOne" class="collapses" aria-labelledby="headingOne" data-parent="#collapseOne">
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
                                        <textarea name="description" cols="40" style="width: 100%;" rows="3" id="note_txt" class="input"><?= isset($jobs_data) ? $jobs_data->message : ''; ?></textarea>
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
                    <div class="card" id="attach_left_card" style="display:none;">
                        <div class="card-header" >
                            <button style="display: flex;" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#photos_attachment" aria-expanded="true" aria-controls="photos_attachment">
                                <h6 class="page-title"><span style="font-size: 20px;"  class="fa fa-image"></span>&nbsp; &nbsp;Photos / Attachments</h6>
                            </button>
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
                            <button style="display: flex;" class="btn btn-link " type="button">
                                <h6 class="page-title"><span style="font-size: 20px;"  class="fa fa-link"></span> &nbsp; &nbsp;Url Link </h6>
                            </button>
                        </div>
                        <div class="card-body">
                            <div id="url_link_form" class="collapses" aria-labelledby="headingThree" data-parent="#url_link_form">
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

                </div>
                <div class="col-md-8">
                    <div class="card table-custom">
                        <div class="card-body">
                            <div class="row">
                                <div style="display: flex; margin: 0;margin-right: auto;" >
                                    <b>Created By:</b>&nbsp;&nbsp;<span> <?= ' '.$logged_in_user->FName.' '.$logged_in_user->LName; ?></span>
                                </div>
                                <a  class="add_new_customer" href="#" id="add_another_invoice" data-toggle="modal" data-target="#new_customer" style="display: none;">
                                    <span class="fa fa-plus-square"></span> Add New Customer
                                </a>
                                <hr>
                                <div class="col-md-4" id="customer_select" style="display: none;">
                                    <h6>Customer Info</h6>
                                    <select id="customer_id" name="customer_id" class="form-control">
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
                                <div class="col-md-8" id="customer_maps" style="display: none;">
                                    <div class="col-md-12">
                                        <div id="streetViewBody" class="col-md-6 float-left no-padding" style="padding-right:15px;"></div>
                                        <div id="map" class="col-md-6 float-left"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td>
                                    <h6>Event Items Listing</h6>
                                </td>
                            </tr>
                            </thead>
                            <tbody id="jobs_items_table_body">
                            <tr>
                                <td>
                                    <small>Event Type</small>
                                    <input type="text" id="job_type" name="event_type" value="<?= isset($jobs_data) ? $jobs_data->job_type : ''; ?>" class="form-control" readonly >
                                </td>
                                <td>
                                </td>
                                <td>
                                    <small>Event Tags</small>
                                    <input type="text" name="event_tag" class="form-control" value="<?= isset($jobs_data) ? $jobs_data->name : ''; ?>" id="job_tags_right" readonly>
                                </td>
                                <td>
                                </td>
                                <td>

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
                            <p>Description of Event (optional)</p>
                            <textarea name="event_description" class="form-control"><?= isset($jobs_data) ? $jobs_data->job_description : ''; ?></textarea>
                            <hr/>
                        </div>
                        <div class="col-md-12 table-responsive">
                            <div class="row">

                                <div class="col-md-6 row pr-0">
                                        <!--<div class="col-sm-6 ">
                                            <label style="padding: 0 .75rem;">Subtotal</label>
                                        </div>
                                        <div class="col-sm-6 text-right pr-3">
                                            <label id="invoice_sub_total">$<?= isset($jobs_data) ? number_format((float)$subtotal,2,'.',',') : '0.00'; ?></label>
                                            <input type="hidden" name="sub_total" id="sub_total_form_input" value='0'>
                                        </div>
                                        <div class="col-sm-12 tax_area">
                                            <hr>
                                        </div>
                                        <div class="col-sm-6 tax_area">
                                            <small>Tax Rate</small>
                                            <a href="<?= base_url('job/settings') ?>"><span class="fa fa-plus" style="margin-left:50px;"></span></a>
                                            <select id="tax_rate" name="tax_rate" class="form-control">
                                                <option value="">None</option>
                                                <?php foreach ($tax_rates as $rate) : ?>
                                                    <option value="<?= $rate->percentage / 100; ?>"><?= $rate->name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6 text-right pr-3 tax_area">
                                            <label id="invoice_tax_total">$0.00</label>
                                            <input type="hidden" name="sub_total" id="sub_total_form_input" value='0'>
                                        </div>
                                        <div class="col-sm-12 tax_area">
                                            <hr>
                                        </div>-->

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
                                <br>
                                <div class="col-sm-12">
                                    <div class="card box_right" id="notes_right_card" style="display: <?= isset($jobs_data) ? 'block' : 'none' ;?>;">
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <div class="card-header">
                                                    <h5 style="padding-left: 20px;" class="mb-0">Notes</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div id="notes_edit_btn_right" class="pencil" style="width:100%; height:100px;cursor: pointer;">
                                                        <?= isset($jobs_data) ? $jobs_data->description : ''; ?>
                                                    </div>
                                                    <div id="notes_input_div_right" style="display:none;">
                                                        <div style=" height:70px;margin-bottom: 10px;">
                                                            <textarea name="message" cols="40" style="width: 100%;" rows="3" id="note_txt_right" class="input"><?= isset($jobs_data) ? $jobs_data->description : ''; ?></textarea>
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
                                                    <h5 style="padding-left: 20px;">Url Link</h5>
                                                </div>
                                                <div class="card-body">
                                                    <?php
                                                    if(isset($jobs_data) && $jobs_data->url_link != NULL) {
                                                        ?>
                                                        <a target="_blank" href="<?= $jobs_data->url_link; ?>"><p><?= $jobs_data->url_link; ?></p></a>
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

                           </div>
                            <br>
                        </div>
                        <!--<div class="col-md-12 table-responsive">
                            <div class="row">
                                <div class="col-sm-12">
                                    <input class="form-control" value="Thank you for your business, Please call <?= $company_info->business_name; ?> at <?= $company_info->business_phone; ?> for quality customer service.">
                                </div>
                            </div>
                            <br>
                        </div>-->
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
                                <?php if(!isset($jobs_data) || $jobs_data->status == 'Scheduled' || $jobs_data->status == 'Draft') : ?>
                                    <button type="submit" class="btn btn-primary"><span class="fa fa-calendar-check-o"></span> Schedule</button>
                                <?php endif; ?>
                                <?php if(isset($jobs_data)): ?>
                                    <a href="<?= base_url('events/job_preview/'.$this->uri->segment(3)) ?>" type="button" class="btn btn-primary"><span class="fa fa-search-plus"></span> Preview</a>
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
                                    <?php $item_qty = get_total_item_qty($item->id); ?>
                                    <tr>
                                        <td><?= $item->title; ?></td>
                                        <td><?= $item_qty[0]->total_qty > 0 ? $item_qty[0]->total_qty : 0; ?></td>
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

<!-- On My Way Modal -->
<div class="modal fade" id="omw_modal" role="dialog">
    <div class="close-modal" data-dismiss="modal">&times;</div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">On My Way</h4>
            </div>
            <form id="update_status_to_omw">
                <div class="modal-body">
                    <p>This will start travel duration tracking.</p>
                    <p>On my way at:</p>
                    <input type="date" name="event_omw_date" id="event_omw_date" class="form-control" required>
                    <input type="hidden" name="id" value="<?php if(isset($jobs_data)){echo $jobs_data->job_unique_id;} ?>">
                    <input type="hidden" name="status" id="status" value="2">
                    <select id="event_omw_time" name="event_omw_time" class="form-control" required>
                        <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
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
                <h4 class="modal-title">Start Event</h4>
            </div>
            <form id="update_status_to_started">
                <div class="modal-body">
                    <p>This will stop travel duration tracking and start on event duration tracking.</p>
                    <p>Start event at:</p>
                    <input type="date" name="event_start_date" id="event_start_date" class="form-control" required>
                    <input type="hidden" name="id" value="<?php if(isset($jobs_data)){echo $jobs_data->job_unique_id;} ?>">
                    <input type="hidden" name="status" id="status" value="3">
                    <select id="event_start_time" name="event_start_time" class="form-control" required>
                        <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
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
<div class="modal fade" id="finish_modal" role="dialog">
    <div class="close-modal" data-dismiss="modal">&times;</div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Finish Event</h4>
            </div>
            <form id="update_status_to_finished">
                <div class="modal-body">
                    <p>This will stop travel duration tracking and start on event duration tracking.</p>
                    <p>Start event at:</p>
                    <input type="date" name="event_finish_date" id="event_finish_date" class="form-control" required>
                    <input type="hidden" name="id" value="<?php if(isset($jobs_data)){echo $jobs_data->job_unique_id;} ?>">
                    <input type="hidden" name="status" id="status" value="4">
                    <select id="event_finish_time" name="event_finish_time" class="form-control" required>
                        <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
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
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?= google_credentials()['api_key'] ?>&callback=initMap&libraries=places&v=weekly&sensor=false"></script>
<script src="https://momentjs.com/downloads/moment-with-locales.js"></script>


<?php include viewPath('events/js/job_new_js'); ?>

<script>
    var geocoder;
    function initMap(address=null) {

        var input = document.getElementById('event_address');
        new google.maps.places.Autocomplete(input);

        if(address == null){
            address = '6866 Pine Forest Rd Pensacola FL 32526';
        }else{
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

