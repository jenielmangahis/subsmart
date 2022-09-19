<?php include viewPath('v2/includes/header'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('settings/create_sms_template') ?>'">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/email_templates_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            Manage your notification options.
                        </div>
                    </div>
                </div>
                <?php echo form_open_multipart('settings/update_notification_setting', ['class' => 'form-validate', 'autocomplete' => 'off']); ?>
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <div class="nsm-card">
                            <div class="nsm-card-header d-block">
                                <div class="nsm-card-title">
                                    <span>Notification Preference</span>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <?php
                                        $is_checked = "";
                                        if (isset($setting_data['default_notify_by_email']) && $setting_data['default_notify_by_email'] == 1) {
                                            $is_checked = 'checked="checked"';
                                        }
                                        ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="default_notify_by_email" value="1" id="default_notify_by_email" <?php echo $is_checked; ?>>
                                            <label class="form-check-label" for="default_notify_by_email">Email notifications</label>
                                        </div>
                                        <label class="content-subtitle">Receive all emails for various actions related to schedule, invoices, estimates.</label>
                                    </div>
                                    <div class="col-12">
                                        <?php
                                        $is_checked = "";
                                        if (isset($setting_data['default_notify_by_sms']) && $setting_data['default_notify_by_sms'] == 1) {
                                            $is_checked = 'checked="checked"';
                                        }
                                        ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="default_notify_by_sms" value="1" id="default_notify_by_sms" <?php echo $is_checked; ?>>
                                            <label class="form-check-label" for="default_notify_by_sms">SMS notifications</label>
                                        </div>
                                        <label class="content-subtitle">Receive all text messages for various actions related to schedule, invoices, estimates.</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="nsm-card">
                            <div class="nsm-card-content">
                                <div class="nsm-tab">
                                    <nav>
                                        <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                                            <button name="btn_nav" class="nav-link active" id="nav-residential-tab" data-bs-toggle="tab" data-bs-target="#nav-residential" type="button" role="tab" aria-controls="nav-residential" aria-selected="true">Residential</button>
                                            <button name="btn_nav" class="nav-link" id="nav-commercial-tab" data-bs-toggle="tab" data-bs-target="#nav-commercial" type="button" role="tab" aria-controls="nav-commercial" aria-selected="false">Commercial</button>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-residential" role="tabpanel" aria-labelledby="nav-residential-tab">
                                            <div class="row g-2">
                                                <div class="col-12">
                                                    <div class="nsm-card-title mb-3">
                                                        <span>Residential Notification</span>
                                                    </div>
                                                    <div class="row g-3">
                                                        <div class="col-12">
                                                            <?php
                                                            $is_checked = "";
                                                            if (isset($setting_data['event_notify_customer_on_add']) && $setting_data['event_notify_customer_on_add'] == 1) {
                                                                $is_checked = 'checked="checked"';
                                                            }
                                                            ?>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="event_notify_customer_on_add" value="1" id="event_notify_customer_on_add" <?php echo $is_checked;  ?>>
                                                                <label class="form-check-label" for="event_notify_customer_on_add">Notify residential customer when scheduling an appointment</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <?php
                                                            $is_checked = "";
                                                            if (isset($setting_data['event_notify_customer_on_update']) && $setting_data['event_notify_customer_on_update'] == 1) {
                                                                $is_checked = 'checked="checked"';
                                                            }
                                                            ?>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="event_notify_customer_on_update" value="1" id="event_notify_customer_on_update" <?php echo $is_checked;  ?>>
                                                                <label class="form-check-label" for="event_notify_customer_on_update">Notify residential customer during re-scheduling/canceling an appointment</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-commercial" role="tabpanel" aria-labelledby="nav-commercial-tab">
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <?php
                                                    $is_checked = "";
                                                    if (isset($setting_data['same_as_residential']) && $setting_data['same_as_residential'] == 1) {
                                                        $is_checked = 'checked="checked"';
                                                    }
                                                    ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="1" id="same_as_residential" name="same_as_residential" <?php echo $is_checked; ?>>
                                                        <label class="form-check-label" for="same_as_residential">
                                                            Set default value as Residential
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12">
                                                    <div class="nsm-card-title mb-3">
                                                        <span>Commercial Notification</span>
                                                    </div>
                                                    <div class="row g-3">
                                                        <div class="col-12">
                                                            <?php
                                                            $is_checked = "";
                                                            if (isset($setting_data['event_notify_customer_on_add_commercial']) && $setting_data['event_notify_customer_on_add_commercial'] == 1) {
                                                                $is_checked = 'checked="checked"';
                                                            }
                                                            ?>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="event_notify_customer_on_add_commercial" value="1" id="event_notify_customer_on_add_commercial" <?php echo $is_checked;  ?>>
                                                                <label class="form-check-label" for="event_notify_customer_on_add_commercial">Notify commercial customer when scheduling an appointment</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <?php
                                                            $is_checked = "";
                                                            if (isset($setting_data['event_notify_customer_on_update_commercial']) && $setting_data['event_notify_customer_on_update_commercial'] == 1) {
                                                                $is_checked = 'checked="checked"';
                                                            }
                                                            ?>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="event_notify_customer_on_update_commercial" value="1" id="event_notify_customer_on_update_commercial" <?php echo $is_checked;  ?>>
                                                                <label class="form-check-label" for="event_notify_customer_on_update_commercial">Notify commercial customer during re-scheduling/canceling an appointment</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="nsm-card">
                            <div class="nsm-card-header d-block">
                                <div class="nsm-card-title">
                                    <span>Reminder Notification</span>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-3">
                                    <div class="col-12 col-md-4">
                                        <label class="content-title">Customer Reminder Notification</label>
                                        <label class="content-subtitle">Select the default value for customer notification sent to residential customer.</label>

                                        <select class="nsm-field form-select mt-3" name="event_notify_at">
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
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="content-title">Customer Heads-up Notification</label>
                                        <label class="content-subtitle">Send extra notifications to customer before scheduled event.</label>

                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label class="content-subtitle fw-bold mt-3 mb-2">First Heads-up Notification</label>
                                                <select class="nsm-field form-select" name="event_notify_at_headsup_1">
                                                    <option value="0">None</option>
                                                    <option <?php echo isset($setting_data['event_notify_at_headsup_1']) && $setting_data['event_notify_at_headsup_1'] == 'P3D' ? 'selected="selected"' : '' ?> value="P3D">3 days before</option>
                                                    <option <?php echo isset($setting_data['event_notify_at_headsup_1']) && $setting_data['event_notify_at_headsup_1'] == 'P5D' ? 'selected="selected"' : '' ?> value="P5D">5 days before</option>
                                                    <option <?php echo isset($setting_data['event_notify_at_headsup_1']) && $setting_data['event_notify_at_headsup_1'] == 'P7D' ? 'selected="selected"' : '' ?> value="P7D">7 days before</option>
                                                    <option <?php echo isset($setting_data['event_notify_at_headsup_1']) && $setting_data['event_notify_at_headsup_1'] == 'P14D' ? 'selected="selected"' : '' ?> value="P14D">14 days before</option>
                                                    <option <?php echo isset($setting_data['event_notify_at_headsup_1']) && $setting_data['event_notify_at_headsup_1'] == 'P21D' ? 'selected="selected"' : '' ?> value="P21D">21 days before</option>
                                                    <option <?php echo isset($setting_data['event_notify_at_headsup_1']) && $setting_data['event_notify_at_headsup_1'] == 'P1M' ? 'selected="selected"' : '' ?> value="P1M">1 month before</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label class="content-subtitle fw-bold mb-2">Second Heads-up Notification</label>
                                                <select class="nsm-field form-select" name="event_notify_at_headsup_2">
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
                                    <div class="col-12 col-md-4">
                                        <label class="content-title">Business Reminder Notification</label>
                                        <label class="content-subtitle">Select the default value for reminder notification sent to you.</label>

                                        <select class="nsm-field form-select mt-3" name="event_notify_at_business">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="nsm-card">
                            <div class="nsm-card-header d-block">
                                <div class="nsm-card-title">
                                    <span>Task</span>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <label class="content-title">Task Reminder Notification</label>
                                <label class="content-subtitle">Select the value task reminder notification sent to you.</label>

                                <select class="nsm-field form-select mt-3" name="event_notify_at_task">
                                    <option value="0">None</option>
                                    <option <?php echo isset($setting_data['event_notify_at_task']) && $setting_data['event_notify_at_task'] == 'PT5M' ? 'selected="selected"' : '' ?> value="PT5M" selected="selected">5 minutes before</option>
                                    <option <?php echo isset($setting_data['event_notify_at_task']) && $setting_data['event_notify_at_task'] == 'PT10M' ? 'selected="selected"' : '' ?> value="PT10M">10 minutes before</option>
                                    <option <?php echo isset($setting_data['event_notify_at_task']) && $setting_data['event_notify_at_task'] == 'PT15M' ? 'selected="selected"' : '' ?> value="PT15M">15 minutes before</option>
                                    <option <?php echo isset($setting_data['event_notify_at_task']) && $setting_data['event_notify_at_task'] == 'PT30M' ? 'selected="selected"' : '' ?> value="PT30M">30 minutes before</option>
                                    <option <?php echo isset($setting_data['event_notify_at_task']) && $setting_data['event_notify_at_task'] == 'PT1H' ? 'selected="selected"' : '' ?> value="PT1H">1 hour before</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="nsm-card">
                            <div class="nsm-card-header d-block">
                                <div class="nsm-card-title">
                                    <span>Estimate</span>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <?php
                                        $is_checked = "";
                                        if (isset($setting_data['estimate_send_to_business']) && $setting_data['estimate_send_to_business'] == 1) {
                                            $is_checked = 'checked="checked"';
                                        }
                                        ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="estimate_send_to_business" value="1" id="estimate_send_to_business" <?php echo $is_checked; ?>>
                                            <label class="form-check-label" for="estimate_send_to_business">Copy me when sending an estimate</label>
                                        </div>
                                        <label class="content-subtitle">Receive an email copy of the estimate sent to customer.</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="nsm-card">
                            <div class="nsm-card-header d-block">
                                <div class="nsm-card-title">
                                    <span>Invoice</span>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <?php
                                        $is_checked = "";
                                        if (isset($setting_data['invoice_send_to_business']) && $setting_data['invoice_send_to_business'] == 1) {
                                            $is_checked = 'checked="checked"';
                                        }
                                        ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="invoice_send_to_business" value="1" id="invoice_send_to_business" <?php echo $is_checked; ?>>
                                            <label class="form-check-label" for="invoice_send_to_business">Copy me when sending an invoice</label>
                                        </div>
                                        <label class="content-subtitle">Receive an email copy of the invoice sent to customer.</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="nsm-card">
                            <div class="nsm-card-header d-block">
                                <div class="nsm-card-title">
                                    <span>Job</span>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <?php
                                        $is_checked = "";
                                        if (isset($setting_data['work_order_notify_on_employee_action']) && $setting_data['work_order_notify_on_employee_action'] == 1) {
                                            $is_checked = 'checked="checked"';
                                        }
                                        ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="work_order_notify_on_employee_action" value="1" id="work_order_notify_on_employee_action" <?php echo $is_checked; ?>>
                                            <label class="form-check-label" for="work_order_notify_on_employee_action">Notify when employees Arrive to the job, Start, Pause and Complete the job</label>
                                        </div>
                                        <label class="content-subtitle">Receive a push notification everytime when employees arrive to the job, start, pause or complete the job.</label>
                                    </div>
                                    <div class="col-12">
                                        <?php
                                        $is_checked = "";
                                        if (isset($setting_data['event_notify_customer_address']) && $setting_data['event_notify_customer_address'] == 1) {
                                            $is_checked = 'checked="checked"';
                                        }
                                        ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="event_notify_customer_address" value="1" id="event_notify_customer_address" <?php echo $is_checked; ?>>
                                            <label class="form-check-label" for="event_notify_customer_address">Notify tenant from service address when scheduling an appointment</label>
                                        </div>
                                        <label class="content-subtitle">If you've set a service address on job order, we'll notify the tenant from that service address.</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="nsm-card">
                            <div class="nsm-card-header d-block">
                                <div class="nsm-card-title">
                                    <span>Events</span>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <?php
                                        $is_checked = "";
                                        if (isset($setting_data['events_notify_user']) && $setting_data['events_notify_user'] == 1) {
                                            $is_checked = 'checked="checked"';
                                        }
                                        ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="events_notify_user" value="1" id="events_notify_user" <?php echo $is_checked; ?>>
                                            <label class="form-check-label" for="events_notify_user">Notify upcoming and ongoing events</label>
                                        </div>
                                        <label class="content-subtitle">Receive a push notification of events.</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-end">
                        <button  name="btn_notification_save" type="submit" data-action="save" class="nsm-button primary">
                            Save Changes
                        </button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

    });
</script>
<?php include viewPath('v2/includes/footer'); ?>