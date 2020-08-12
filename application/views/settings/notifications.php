<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_setting'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/setting'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Notifications</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Manage your notification options.</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">  
                          

                        <div class="card">
                            <h3 class="margin-bottom">Notification preference</h3>
                            <div class="margin-bottom-sec">
                                <div class="checkbox checkbox-sec margin-right">
                                    <input type="checkbox" name="global_notify_by_email" value="1" checked="checked" id="global_notify_by_email">
                                    <label for="global_notify_by_email"><span>Email notifications</span></label>
                                </div>
                                <p class="help help-sm">
                                    Receive all emails for various actions related to schedule, invoices, estimates.
                                </p>
                            </div>
                            <div class="form-group">
                                <div class="checkbox checkbox-sec margin-right">
                                    <input type="checkbox" name="global_notify_by_sms" value="1" checked="checked" id="global_notify_by_sms">
                                    <label for="global_notify_by_sms"><span>SMS notifications</span></label>
                                </div>
                                <p class="help help-sm">
                                    Receive all text messages for various actions related to schedule, invoices, estimates.
                                </p>
                            </div>
                        </div>        
                        
                        

                        <div class="card">
                            <h3 class="margin-bottom">Customer Schedule</h3>
                            <div class="tabs">
                                <ul class="clearfix">
                                    <li data-tab="residential" class="active">
                                        <a href="#tab_residential">Residential</a>
                                    </li>
                                    <li data-tab="commercial">
                                        <a href="#tab_commercial">Commercial</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Tab Section Start -->
                            <div class="tab-content">
                                <div id="tab_residential" class="tab-panel">
                                    <div class="form-group">
                                        <label>Residential Notification</label>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="checkbox checkbox-sec margin-right">
                                                    <input type="checkbox" name="event_notify_customer_on_add" value="1" id="event_notify_customer_on_add">
                                                    <label for="event_notify_customer_on_add"><span>Notify residential customer when scheduling an appointment</span></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="checkbox checkbox-sec margin-right">
                                                    <input type="checkbox" name="event_notify_customer_on_update" value="1" id="event_notify_customer_on_update">
                                                    <label for="event_notify_customer_on_update"><span>Notify residential customer during re-scheduling/canceling an appointment</span></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="tab_commercial" class="tab-panel" style="display: none;">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="checkbox checkbox-sec margin-right">
                                                    <input type="checkbox" name="same_as_residential" value="1" checked="checked" id="same_as_residential">
                                                    <label for="same_as_residential">Set default value as Residential</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Commercial Notification</label>
                                        <div class="row">
                                            <div class="col-sm-16">
                                                <div class="checkbox checkbox-sec margin-right">
                                                    <input type="checkbox" name="event_notify_customer_on_add_commercial" value="1" id="event_notify_customer_on_add_commercial" disabled="disabled">
                                                    <label for="event_notify_customer_on_add_commercial"><span>Notify commercial customer when scheduling an appointment</span></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-16">
                                                <div class="checkbox checkbox-sec margin-right">
                                                    <input type="checkbox" name="event_notify_customer_on_update_commercial" value="1" id="event_notify_customer_on_update_commercial" disabled="disabled">
                                                    <label for="event_notify_customer_on_update_commercial"><span>Notify commercial customer during re-scheduling/canceling an appointment</span></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Tab Section End -->
                        </div>  
                        
                        

                        <div class="card">
                            <h3 class="margin-bottom">Reminder Notification</h3>
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label>Customer Reminder Notification</label>
                                        <div class="help help-sm help-block">Select the default value for customer notification sent to residential customer.</div>
                                        <select name="event_notify_at" class="form-control">
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
                                        <span class="validation-error-field hide" data-formerrors-for-name="event_notify_at" data-formerrors-message="true"></span>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label>Customer Heads-up Notification</label>
                                        <div class="help help-sm help-block">Send extra notifications to customer before scheduled event.</div>
                                        <div class="margin-bottom-sec">
                                            <label class="weight-normal">First Heads-up Notification</label>
                                            <select name="event_notify_at_headsup_1" class="form-control">
                                                <option value="0">None</option>
                                                <option value="P3D">3 days before</option>
                                                <option value="P5D">5 days before</option>
                                                <option value="P7D">7 days before</option>
                                                <option value="P14D">14 days before</option>
                                                <option value="P21D">21 days before</option>
                                                <option value="P1M">1 month before</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="weight-normal">Second Heads-up Notification</label>
                                            <select name="event_notify_at_headsup_2" class="form-control">
                                                <option value="0">None</option>
                                                <option value="P3D">3 days before</option>
                                                <option value="P5D">5 days before</option>
                                                <option value="P7D">7 days before</option>
                                                <option value="P14D">14 days before</option>
                                                <option value="P21D">21 days before</option>
                                                <option value="P1M">1 month before</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Business Reminder Notification</label>
                                <div class="help help-sm help-block">Select the default value for reminder notification sent to you.</div>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <select name="event_notify_at_business" class="form-control">
                                            <option value="0">None</option>
                                            <option value="PT5M">5 minutes before</option>
                                            <option value="PT15M">15 minutes before</option>
                                            <option value="PT30M">30 minutes before</option>
                                            <option value="PT1H">1 hour before</option>
                                            <option value="PT2H" selected="selected">2 hours before</option>
                                            <option value="PT4H">4 hours before</option>
                                            <option value="PT6H">6 hours before</option>
                                            <option value="PT8H">8 hours before</option>
                                            <option value="PT12H">12 hours before</option>
                                            <option value="PT16H">16 hours before</option>
                                            <option value="P1D">1 day before</option>
                                            <option value="P2D">2 days before</option>
                                            <option value="PT0M">On date of event</option>
                                        </select>
                                        <span class="validation-error-field hide" data-formerrors-for-name="event_notify_at_business" data-formerrors-message="true"></span>
                                    </div>
                                </div>
                            </div>

                            <h3 class="margin-bottom">Task</h3>
                            <div class="form-group">
                                <label>Task Reminder Notification</label>
                                <div class="help help-sm help-block">Select the value task reminder notification sent to you.</div>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <select name="event_notify_at_task" class="form-control">
                                            <option value="0">None</option>
                                            <option value="PT5M" selected="selected">5 minutes before</option>
                                            <option value="PT10M">10 minutes before</option>
                                            <option value="PT15M">15 minutes before</option>
                                            <option value="PT30M">30 minutes before</option>
                                            <option value="PT1H">1 hour before</option>
                                        </select>
                                        <span class="validation-error-field hide" data-formerrors-for-name="event_notify_at_task" data-formerrors-message="true"></span>
                                    </div>
                                </div>
                            </div>
                        </div>   
                        
                        

                        <div class="card">
                            <h3 class="margin-bottom">Estimate</h3>
                            <div class="form-group">
                                <div class="checkbox checkbox-sec margin-right">
                                    <input type="checkbox" name="estimate_send_to_business" value="1" checked="checked" id="estimate_send_to_business">
                                    <label for="estimate_send_to_business"><span> Copy me when sending an estimate</span></label>
                                </div>
                                <div class="help help-sm help-block">Receive an email copy of the estimate sent to customer.</div>
                            </div>
                        </div>

                        

                        <div class="card">
                            <h3 class="margin-bottom">Invoice</h3>
                            <div class="form-group">
                                <div class="checkbox checkbox-sec margin-right">
                                    <input type="checkbox" name="invoice_send_to_business" value="1" checked="checked" id="invoice_send_to_business">
                                    <label for="invoice_send_to_business"><span> Copy me when sending an invoice</span></label>
                                </div>
                                <div class="help help-sm help-block">Receive an email copy of the invoice sent to customer.</div>
                            </div>
                        </div>

                        
                        <div class="card">
                            <h3 class="margin-bottom">Work Order</h3>
                            <div class="margin-bottom-sec">
                                <div class="checkbox checkbox-sec margin-right">
                                    <input type="checkbox" name="work_order_notify_on_employee_action" value="1" id="work_order_notify_on_employee_action">
                                    <label for="work_order_notify_on_employee_action"><span>Notify when employees Arrive to the work, Start, Pause and Complete the work</span></label>
                                </div>
                                <div class="help help-sm help-block">Receive a push notification everytime when employees arrive to the work, start, pause or complete the work.</div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox checkbox-sec margin-right">
                                    <input type="checkbox" name="event_notify_customer_address" value="1" id="event_notify_customer_address">
                                    <label for="event_notify_customer_address"><span>Notify tenant from service address when scheduling an appointment</span></label>
                                </div>
                                <div class="help help-sm help-block">
                                    If you've set a service address on work order, we'll notify the tenant from that service address.
                                </div>
                            </div>
                        </div>

                        
                        <div>
                            <button class="btn btn-primary margin-right" name="btn-submit" data-form="submit" type="button" data-on-click-label="Save Changes...">Save Changes</button>
                        </div>                                             

                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>