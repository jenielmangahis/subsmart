<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
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
            <?php echo form_open_multipart('settings/update_notification_setting', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>            
            <div class="row">

                <div class="col-xl-12">

                    <?php if($this->session->flashdata('message')) { ?>
                        <div class="row dashboard-container-1">
                            <div class="col-md-12">
                                <div class="alert <?php echo $this->session->flashdata('alert_class'); ?>">
                                  <button type="button" class="close" data-dismiss="alert">&times</button>
                                  <?php echo $this->session->flashdata('message'); ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="card" style="min-height: 400px !important;">  
                          
                        <div class="card">
                            <h3 class="margin-bottom">Notification preference</h3>
                            <div class="margin-bottom-sec">
                                <div class="checkbox checkbox-sec margin-right">
                                    <?php 
                                        $is_checked = "";
                                        if(isset($setting_data['default_notify_by_email']) && $setting_data['default_notify_by_email'] == 1) {
                                            $is_checked = 'checked="checked"';
                                        }
                                    ?>
                                    <input type="checkbox" name="default_notify_by_email" value="1" <?php echo $is_checked; ?> id="default_notify_by_email">
                                    <label for="default_notify_by_email"><span>Email notifications</span></label>
                                </div>
                                <p class="help help-sm">
                                    Receive all emails for various actions related to schedule, invoices, estimates.
                                </p>
                            </div>
                            <div class="form-group">
                                <div class="checkbox checkbox-sec margin-right">
                                    <?php 
                                        $is_checked = "";
                                        if(isset($setting_data['default_notify_by_sms']) && $setting_data['default_notify_by_sms'] == 1) {
                                            $is_checked = 'checked="checked"';
                                        }
                                    ?>                                    
                                    <input type="checkbox" name="default_notify_by_sms" value="1" <?php echo $is_checked; ?> id="default_notify_by_sms">
                                    <label for="default_notify_by_sms"><span>SMS notifications</span></label>
                                </div>
                                <p class="help help-sm">
                                    Receive all text messages for various actions related to schedule, invoices, estimates.
                                </p>
                            </div>
                        </div>        

                        <div class="card">
                            <h3 class="margin-bottom">Customer Schedule</h3>

                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Residential</a>
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Commercial</a>
                                </div>
                            </nav>

                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <br />
                                    <div class="form-group">
                                        <label>Residential Notification</label>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="checkbox checkbox-sec margin-right">
                                                    <?php 
                                                        $is_checked = "";
                                                        if(isset($setting_data['event_notify_customer_on_add']) && $setting_data['event_notify_customer_on_add'] == 1) {
                                                            $is_checked = 'checked="checked"';
                                                        }
                                                    ?>  
                                                    <input type="checkbox" name="event_notify_customer_on_add" value="1" id="event_notify_customer_on_add" <?php echo $is_checked;  ?>>
                                                    <label for="event_notify_customer_on_add"><span>Notify residential customer when scheduling an appointment</span></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="checkbox checkbox-sec margin-right">
                                                    <?php 
                                                        $is_checked = "";
                                                        if(isset($setting_data['event_notify_customer_on_update']) && $setting_data['event_notify_customer_on_update'] == 1) {
                                                            $is_checked = 'checked="checked"';
                                                        }
                                                    ?>                                                      
                                                    <input type="checkbox" name="event_notify_customer_on_update" value="1" id="event_notify_customer_on_update" <?php echo $is_checked; ?>>
                                                    <label for="event_notify_customer_on_update"><span>Notify residential customer during re-scheduling/canceling an appointment</span></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <br />
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <?php 
                                                    $is_checked = "";
                                                    if(isset($setting_data['same_as_residential']) && $setting_data['same_as_residential'] == 1) {
                                                        $is_checked = 'checked="checked"';
                                                    }
                                                ?>                                                
                                                <div class="checkbox checkbox-sec margin-right">
                                                    <input type="checkbox" name="same_as_residential" value="1" <?php echo $is_checked; ?> id="same_as_residential">
                                                    <label for="same_as_residential">Set default value as Residential</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Commercial Notification</label>
                                        <div class="row" style="margin-left: 10px;">
                                            <div class="col-sm-16">
                                                <div class="checkbox checkbox-sec margin-right">
                                                    <?php 
                                                        $is_checked = "";
                                                        if(isset($setting_data['event_notify_customer_on_add_commercial']) && $setting_data['event_notify_customer_on_add_commercial'] == 1) {
                                                            $is_checked = 'checked="checked"';
                                                        }
                                                    ?>                                                       
                                                    <input type="checkbox" name="event_notify_customer_on_add_commercial" value="1" id="event_notify_customer_on_add_commercial" <?php echo $is_checked; ?>>
                                                    <label for="event_notify_customer_on_add_commercial"><span>Notify commercial customer when scheduling an appointment</span></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-left: 10px;">
                                            <div class="col-sm-16">
                                                <div class="checkbox checkbox-sec margin-right">
                                                    <?php 
                                                        $is_checked = "";
                                                        if(isset($setting_data['event_notify_customer_on_update_commercial']) && $setting_data['event_notify_customer_on_update_commercial'] == 1) {
                                                            $is_checked = 'checked="checked"';
                                                        }
                                                    ?>                                                     
                                                    <input type="checkbox" name="event_notify_customer_on_update_commercial" value="1" id="event_notify_customer_on_update_commercial" <?php echo $is_checked; ?>>
                                                    <label for="event_notify_customer_on_update_commercial"><span>Notify commercial customer during re-scheduling/canceling an appointment</span></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                            <option <?php echo isset($setting_data['event_notify_at']) && $setting_data['event_notify_at'] == 'PT5M' ? 'selected="selected"' : '' ?> value="PT5M">5 minutes before</option>
                                            <option <?php echo isset($setting_data['event_notify_at']) && $setting_data['event_notify_at'] == 'PT15M' ? 'selected="selected"' : '' ?> value="PT15M">15 minutes before</option>
                                            <option <?php echo isset($setting_data['event_notify_at']) && $setting_data['event_notify_at'] == 'PT30M' ? 'selected="selected"' : '' ?> value="PT30M">30 minutes before</option>
                                            <option <?php echo isset($setting_data['event_notify_at']) && $setting_data['event_notify_at'] == 'PT1H' ? 'selected="selected"' : '' ?> value="PT1H">1 hour before</option>
                                            <option <?php echo isset($setting_data['event_notify_at']) && $setting_data['event_notify_at'] == 'PT2H' ? 'selected="selected"' : '' ?> value="PT2H">2 hours before</option>
                                            <option <?php echo isset($setting_data['event_notify_at']) && $setting_data['event_notify_at'] == 'PT4H' ? 'selected="selected"' : '' ?> value="PT4H">4 hours before</option>
                                            <option <?php echo isset($setting_data['event_notify_at']) && $setting_data['event_notify_at'] == 'PT6H' ? 'selected="selected"' : '' ?> value="PT6H">6 hours before</option>
                                            <option <?php echo isset($setting_data['event_notify_at']) && $setting_data['event_notify_at'] == 'PT8H' ? 'selected="selected"' : '' ?> value="PT8H">8 hours before</option>
                                            <option <?php echo isset($setting_data['event_notify_at']) && $setting_data['event_notify_at'] == 'PT12H' ? 'selected="selected"' : '' ?> value="PT12H">12 hours before</option>
                                            <option <?php echo isset($setting_data['event_notify_at']) && $setting_data['event_notify_at'] == 'PT16H' ? 'selected="selected"' : '' ?> value="PT16H">16 hours before</option>
                                            <option <?php echo isset($setting_data['event_notify_at']) && $setting_data['event_notify_at'] == 'P1D' ? 'selected="selected"' : '' ?> value="P1D" selected="selected">1 day before</option>
                                            <option <?php echo isset($setting_data['event_notify_at']) && $setting_data['event_notify_at'] == 'P2D' ? 'selected="selected"' : '' ?> value="P2D">2 days before</option>
                                            <option <?php echo isset($setting_data['event_notify_at']) && $setting_data['event_notify_at'] == 'PT0M' ? 'selected="selected"' : '' ?> value="PT0M">On date of event</option>
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
                                                <option <?php echo isset($setting_data['event_notify_at_headsup_1']) && $setting_data['event_notify_at_headsup_1'] == 'P3D' ? 'selected="selected"' : '' ?> value="P3D">3 days before</option>
                                                <option <?php echo isset($setting_data['event_notify_at_headsup_1']) && $setting_data['event_notify_at_headsup_1'] == 'P5D' ? 'selected="selected"' : '' ?> value="P5D">5 days before</option>
                                                <option <?php echo isset($setting_data['event_notify_at_headsup_1']) && $setting_data['event_notify_at_headsup_1'] == 'P7D' ? 'selected="selected"' : '' ?> value="P7D">7 days before</option>
                                                <option <?php echo isset($setting_data['event_notify_at_headsup_1']) && $setting_data['event_notify_at_headsup_1'] == 'P14D' ? 'selected="selected"' : '' ?> value="P14D">14 days before</option>
                                                <option <?php echo isset($setting_data['event_notify_at_headsup_1']) && $setting_data['event_notify_at_headsup_1'] == 'P21D' ? 'selected="selected"' : '' ?> value="P21D">21 days before</option>
                                                <option <?php echo isset($setting_data['event_notify_at_headsup_1']) && $setting_data['event_notify_at_headsup_1'] == 'P1M' ? 'selected="selected"' : '' ?> value="P1M">1 month before</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="weight-normal">Second Heads-up Notification</label>
                                            <select name="event_notify_at_headsup_2" class="form-control">
                                                <option value="0">None</option>
                                                <option <?php echo isset($setting_data['event_notify_at_headsup_2']) && $setting_data['event_notify_at_headsup_2'] == 'P3D' ? 'selected="selected"' : '' ?> value="P3D">3 days before</option>
                                                <option <?php echo isset($setting_data['event_notify_at_headsup_2']) && $setting_data['event_notify_at_headsup_2'] == 'P5D' ? 'selected="selected"' : '' ?> value="P5D">5 days before</option>
                                                <option <?php echo isset($setting_data['event_notify_at_headsup_2']) && $setting_data['event_notify_at_headsup_2'] == 'P7D' ? 'selected="selected"' : '' ?> value="P7D">7 days before</option>
                                                <option <?php echo isset($setting_data['event_notify_at_headsup_2']) && $setting_data['event_notify_at_headsup_2'] == 'P14D' ? 'selected="selected"' : '' ?> value="P14D">14 days before</option>
                                                <option <?php echo isset($setting_data['event_notify_at_headsup_2']) && $setting_data['event_notify_at_headsup_2'] == 'P21D' ? 'selected="selected"' : '' ?> value="P21D">21 days before</option>
                                                <option <?php echo isset($setting_data['event_notify_at_headsup_2']) && $setting_data['event_notify_at_headsup_2'] == 'P1M' ? 'selected="selected"' : '' ?> value="P1M">1 month before</option>
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
                                            <option <?php echo isset($setting_data['event_notify_at_business']) && $setting_data['event_notify_at_business'] == 'PT5M' ? 'selected="selected"' : '' ?> value="PT5M">5 minutes before</option>
                                            <option <?php echo isset($setting_data['event_notify_at_business']) && $setting_data['event_notify_at_business'] == 'PT15M' ? 'selected="selected"' : '' ?> value="PT15M">15 minutes before</option>
                                            <option <?php echo isset($setting_data['event_notify_at_business']) && $setting_data['event_notify_at_business'] == 'PT30M' ? 'selected="selected"' : '' ?> value="PT30M">30 minutes before</option>
                                            <option <?php echo isset($setting_data['event_notify_at_business']) && $setting_data['event_notify_at_business'] == 'PT1H' ? 'selected="selected"' : '' ?> value="PT1H">1 hour before</option>
                                            <option <?php echo isset($setting_data['event_notify_at_business']) && $setting_data['event_notify_at_business'] == 'PT2H' ? 'selected="selected"' : '' ?> value="PT2H" selected="selected">2 hours before</option>
                                            <option <?php echo isset($setting_data['event_notify_at_business']) && $setting_data['event_notify_at_business'] == 'PT4H' ? 'selected="selected"' : '' ?> value="PT4H">4 hours before</option>
                                            <option <?php echo isset($setting_data['event_notify_at_business']) && $setting_data['event_notify_at_business'] == 'PT6H' ? 'selected="selected"' : '' ?> value="PT6H">6 hours before</option>
                                            <option <?php echo isset($setting_data['event_notify_at_business']) && $setting_data['event_notify_at_business'] == 'PT8H' ? 'selected="selected"' : '' ?> value="PT8H">8 hours before</option>
                                            <option <?php echo isset($setting_data['event_notify_at_business']) && $setting_data['event_notify_at_business'] == 'PT12H' ? 'selected="selected"' : '' ?> value="PT12H">12 hours before</option>
                                            <option <?php echo isset($setting_data['event_notify_at_business']) && $setting_data['event_notify_at_business'] == 'PT16H' ? 'selected="selected"' : '' ?> value="PT16H">16 hours before</option>
                                            <option <?php echo isset($setting_data['event_notify_at_business']) && $setting_data['event_notify_at_business'] == 'P1D' ? 'selected="selected"' : '' ?> value="P1D">1 day before</option>
                                            <option <?php echo isset($setting_data['event_notify_at_business']) && $setting_data['event_notify_at_business'] == 'P2D' ? 'selected="selected"' : '' ?> value="P2D">2 days before</option>
                                            <option <?php echo isset($setting_data['event_notify_at_business']) && $setting_data['event_notify_at_business'] == 'PT0M' ? 'selected="selected"' : '' ?> value="PT0M">On date of event</option>
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
                                            <option <?php echo isset($setting_data['event_notify_at_task']) && $setting_data['event_notify_at_task'] == 'PT5M' ? 'selected="selected"' : '' ?> value="PT5M" selected="selected">5 minutes before</option>
                                            <option <?php echo isset($setting_data['event_notify_at_task']) && $setting_data['event_notify_at_task'] == 'PT10M' ? 'selected="selected"' : '' ?> value="PT10M">10 minutes before</option>
                                            <option <?php echo isset($setting_data['event_notify_at_task']) && $setting_data['event_notify_at_task'] == 'PT15M' ? 'selected="selected"' : '' ?> value="PT15M">15 minutes before</option>
                                            <option <?php echo isset($setting_data['event_notify_at_task']) && $setting_data['event_notify_at_task'] == 'PT30M' ? 'selected="selected"' : '' ?> value="PT30M">30 minutes before</option>
                                            <option <?php echo isset($setting_data['event_notify_at_task']) && $setting_data['event_notify_at_task'] == 'PT1H' ? 'selected="selected"' : '' ?> value="PT1H">1 hour before</option>
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
                                    <?php 
                                        $is_checked = "";
                                        if(isset($setting_data['estimate_send_to_business']) && $setting_data['estimate_send_to_business'] == 1) {
                                            $is_checked = 'checked="checked"';
                                        }
                                    ?>                                     
                                    <input type="checkbox" name="estimate_send_to_business" value="1" <?php echo $is_checked; ?> id="estimate_send_to_business">
                                    <label for="estimate_send_to_business"><span> Copy me when sending an estimate</span></label>
                                </div>
                                <div class="help help-sm help-block">Receive an email copy of the estimate sent to customer.</div>
                            </div>
                        </div>

                        

                        <div class="card">
                            <h3 class="margin-bottom">Invoice</h3>
                            <div class="form-group">
                                <div class="checkbox checkbox-sec margin-right">
                                    <?php 
                                        $is_checked = "";
                                        if(isset($setting_data['invoice_send_to_business']) && $setting_data['invoice_send_to_business'] == 1) {
                                            $is_checked = 'checked="checked"';
                                        }
                                    ?>                                     
                                    <input type="checkbox" name="invoice_send_to_business" value="1" <?php echo $is_checked; ?> id="invoice_send_to_business">
                                    <label for="invoice_send_to_business"><span> Copy me when sending an invoice</span></label>
                                </div>
                                <div class="help help-sm help-block">Receive an email copy of the invoice sent to customer.</div>
                            </div>
                        </div>

                        
                        <div class="card">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="margin-bottom">Job</h3>
                                    <div class="margin-bottom-sec">
                                        <div class="checkbox checkbox-sec margin-right">
                                            <?php 
                                                $is_checked = "";
                                                if(isset($setting_data['work_order_notify_on_employee_action']) && $setting_data['work_order_notify_on_employee_action'] == 1) {
                                                    $is_checked = 'checked="checked"';
                                                }
                                            ?>                                     
                                            <input type="checkbox" name="work_order_notify_on_employee_action" <?php echo $is_checked; ?> value="1" id="work_order_notify_on_employee_action">
                                            <label for="work_order_notify_on_employee_action"><span>Notify when employees Arrive to the job, Start, Pause and Complete the job</span></label>
                                        </div>
                                        <div class="help help-sm help-block">Receive a push notification everytime when employees arrive to the job, start, pause or complete the job.</div>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox checkbox-sec margin-right">
                                            <?php 
                                                $is_checked = "";
                                                if(isset($setting_data['event_notify_customer_address']) && $setting_data['event_notify_customer_address'] == 1) {
                                                    $is_checked = 'checked="checked"';
                                                }
                                            ?>                                     
                                            <input type="checkbox" <?php echo $is_checked; ?> name="event_notify_customer_address" value="1" id="event_notify_customer_address">
                                            <label for="event_notify_customer_address"><span>Notify tenant from service address when scheduling an appointment</span></label>
                                        </div>
                                        <div class="help help-sm help-block">
                                            If you've set a service address on job order, we'll notify the tenant from that service address.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <h3 class="margin-bottom">Events</h3>
                                    <div class="margin-bottom-sec">
                                        <div class="checkbox checkbox-sec margin-right">
                                            <?php 
                                                $is_checked = "";
                                                if(isset($setting_data['events_notify_user']) && $setting_data['events_notify_user'] == 1) {
                                                    $is_checked = 'checked="checked"';
                                                }
                                            ?>                                     
                                            <input type="checkbox" name="events_notify_user" <?= $is_checked; ?> value="1" id="events_notify_user">
                                            <label for="events_notify_user"><span>Notify upcoming and ongoing events</span></label>
                                        </div>
                                        <div class="help help-sm help-block">Receive a push notification of events.</div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="card">
                            
                        </div>

                        
                        <div>
                            <button class="btn btn-primary margin-right" name="btn-submit" data-form="submit" type="submit" data-on-click-label="Save Changes...">Save Changes</button>
                        </div>                                             

                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
            <?php echo form_close(); ?>
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>