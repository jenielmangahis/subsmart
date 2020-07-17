<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_booking'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/addons'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row-fluid align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Online Booking</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Manage your online booking</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <?php include viewPath('flash'); ?>
            <?php echo form_open_multipart('booking/save_setting', ['id' => 'frm-booking-setting', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
            <div class="row-fluid">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <?php include viewPath('includes/booking_tabs'); ?>

                        <div class="row-fluid dashboard-container-1">
                            <div class="col-md-8"><strong></strong></div>
                        </div>
                        <div class="row-fluid dashboard-container-2 pr-4">
                            <form name="" data-form="form" style="width:100%;">
                                <div class="validation-error hide"></div>

                                <div class="row-fluid">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Page Title</label>
                                            <div class="help help-block">
                                                Set your own title for the booking page
                                            </div>
                                            <input type="text" name="page_title" value="Sample booking"  class="form-control"  autocomplete="off" />
                                        </div>
                                        <div class="form-group">
                                            <label>Page Instructions</label>
                                            <div class="help help-block">
                                                Optionally, input a text with some help or instructions, that will appear below title.
                                            </div>
                                            <textarea name="page_intro" cols="40" rows="3"  class="form-control">this is a sample booking page</textarea>
                                        </div>
                                    </div>
                                </div>
                                <br class="clear"/>
                                <div class="row-fluid">
                                    <div class="col-sm-12 form-cs-group">
                                        <div class="form-group">
                                            <label>Products listing mode</label>
                                            <div class="help help-block">How the products shoulds be listed on widget page, like a grid of boxes or a list.</div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <select name="product_list_mode" class="form-control">
                            <option value="grid" selected="selected">Grid View</option>
                            <option value="list">List View</option>
                            </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 form-cs-group">
                                        <div class="form-group">
                                            <label>Appointments per time slot</label>
                                            <div class="help help-block">How many appointments can be made for same time slot and date.</div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <select name="time_slot_bookings" class="form-control">
                            <option value="0" selected="selected">Any number</option>
                            <option value="1">Only 1</option>
                            <option value="2">Only 2</option>
                            <option value="3">Only 3</option>
                            <option value="4">Only 4</option>
                            <option value="5">Only 5</option>
                            <option value="6">Only 6</option>
                            <option value="7">Only 7</option>
                            <option value="8">Only 8</option>
                            <option value="9">Only 9</option>
                            <option value="10">Only 10</option>
                            </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row-fluid">
                                    <div class="col-sm-12 form-cs-group">
                                        <div class="form-group">
                                            <label>Minimum price for entire booking</label>
                                            <div class="help help-block">
                                                Customers have to book products with total value over this minimum price.<br>
                                                Set 0 for no minimum.
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">$</div>
                                                        <input type="text" name="cart_total_min" value="50"  class="form-control" id="cart_total_min"  autocomplete="off" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div>
                                            <label>Minimum price alert</label>
                                            <div class="help help-block">
                                                A notification text displayed to customer if min price is not met.<br>
                                                The tag {{amount}} will be replaced with min price value.
                                            </div>
                                            <input type="text" name="cart_total_min_alert" value="Minimum booking amount is {{amount}}"  class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <br class="clear-both"/>
                                <div>
                                    <label>Notifications</label>
                                    <div class="help help-block">Select how you want to be notified on a new booking.</div>
                                    <div class="checkbox checkbox-sec margin-right">
                                        <input type="checkbox" name="notify_email" value="1" checked="checked"  id="notify_email" />
                                        <label for="notify_email"> Email</label>
                                    </div>
                                    <div class="checkbox checkbox-sec">
                                        <input type="checkbox" name="notify_push" value="1" checked="checked"  id="notify_push" />
                                        <label for="notify_push"> App Notification</label>
                                    </div>
                                </div>

                                <hr class="card-hr">

                                <div class="row-fluid">
                                    <div class="col-sm-12">
                                        <label>Don't accept booking during blocked time</label>
                                        <div class="help help-block">Customers should not be able to book your services during blocked time.</div>
                                        <div class="row">
                                            <div class="col-sm-24">
                                                <div class="checkbox checkbox-sec margin-right ml-cs-20">
                                                    <input type="checkbox" name="event_blocked_check" value="1" checked="checked"  id="event_blocked_check" />
                                                    <label for="event_blocked_check"><span>Don't accept booking during blocked time</span></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label>Don't accept booking if it overlaps with a calendar event</label>
                                        <div class="help help-block">Customers should not be able to book your services if another event exists in calendar.</div>
                                        <div class="row">
                                            <div class="col-sm-24">
                                                <div class="checkbox checkbox-sec margin-right ml-cs-20">
                                                    <input type="checkbox" name="event_all_check" value="1" checked="checked"  id="event_all_check" />
                                                    <label for="event_all_check"><span>Don't accept booking if it overlaps with a calendar event</span></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br class="clear-both"/>
                                <hr class="card-hr">

                                <div class="row-fluid">
                                    <div class="col-sm-12">
                                        <div>
                                            <label>Auto-Schedule a Work Order</label>
                                            <div class="help help-block">
                                                When a booking is made automatically schedule a Work Order.
                                            </div>
                                            <div class="checkbox checkbox-sec margin-right">
                                                <input type="checkbox" name="convert_lead_to_work_order" value="1"  id="convert_lead_to_work_order" />
                                                <label for="convert_lead_to_work_order"><span>Auto-Schedule a Work Order</span></label>
                                            </div>
                                        </div>
                                        <div class="margin-top-ter" id="convert_lead_to_work_order_employees">
                                            <label>Assign To</label>
                                            <ul class="employees clearfix pl-2">
                                                                    <li>
                                                    <div class="checkbox checkbox-sm">
                                                        <input type="checkbox" name="convert_lead_to_work_order_employees[]" value="14278" checked="checked"  id="employee_id_14278" />
                                                        <label for="employee_id_14278"><span>Alarm Direct</span>
                                                         <span class="text-ter">(owner)</span>                            </label>
                                                    </div>
                                                </li>
                                                                    <li>
                                                    <div class="checkbox checkbox-sm">
                                                        <input type="checkbox" name="convert_lead_to_work_order_employees[]" value="14291"  id="employee_id_14291" />
                                                        <label for="employee_id_14291"><span>Brannon Nguyen</span>
                                                                                    </label>
                                                    </div>
                                                </li>
                                                                    <li>
                                                    <div class="checkbox checkbox-sm">
                                                        <input type="checkbox" name="convert_lead_to_work_order_employees[]" value="14281"  id="employee_id_14281" />
                                                        <label for="employee_id_14281"><span>TC Nguyen</span>
                                                                                    </label>
                                                    </div>
                                                </li>
                                                                    <li>
                                                    <div class="checkbox checkbox-sm">
                                                        <input type="checkbox" name="convert_lead_to_work_order_employees[]" value="14285"  id="employee_id_14285" />
                                                        <label for="employee_id_14285"><span>Tommy Nguyen</span>
                                                                                    </label>
                                                    </div>
                                                </li>
                                                                </ul>
                                        </div>
                                    </div>
                                </div>
                                <br class="clear-both"/>
                                <hr class="card-hr">

                                <div class="row-fluid">
                                    <div class="col-sm-12">
                                        <div>
                                            <label>Google Analytics Tracking Id</label>
                                            <div class="help help-block">
                                                The unique id set on your Google tracking code. e.g. UA-12345678-1
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="text" name="google_analytics_tracking_id" value=""  class="form-control" autocomplete="off" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label>Website URL</label>
                                        <div class="help help-block">
                                            Your website URL where the widget is placed.
                                        </div>
                                        <input type="text" name="google_analytics_origin" value=""  class="form-control" autocomplete="off" />
                                    </div>
                                </div>
                                <br class="clear-both"/>
                                <hr class="card-hr">

                                <div class="row-fluid" style="display: block;">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Widget status</label>
                                            <div class="help help-block">Switch the booking widget off while you are on vacation.</div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <select name="status" class="form-control">
                            <option value="1" selected="selected">Active</option>
                            <option value="2">Inactive</option>
                            </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br class="clear-both"/>
                                <hr class="margin-top margin-bottom">
                                <div class="row-fluid margin-top">
                                    <div class="col-sm-12">
                                        <button type="button" class="btn btn-primary btn-update-setting">Save</button>
                                        <span class="alert-inline-text margin-left hide">Saved</span>
                                    </div>
                                    <div class="col-sm-12 text-right">
                                        <button class="btn btn-primary mr-4" data-form="submit" data-on-click-label="Saving...">Continue &raquo;</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <?php echo form_close(); ?>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/booking_modals'); ?>
<?php include viewPath('includes/footer_booking'); ?>

<script>
$(function(){
    $(".btn-update-setting").click(function(){
        $("#modalUpdateSetting").modal('show');

        var msg = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" /> Saving...</div>';
        var url = base_url + '/booking/_save_setting';

        $(".modal-setting-msg").html(msg);
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: $("#frm-booking-setting").serialize(),
               success: function(o)
               {
                  $(".modal-setting-msg").html("<p class='alert alert-info'><i class='fa fa-check'></i> Setting was successfully updated</p>");
               }
            });
        }, 1000);

    });
});
</script>
