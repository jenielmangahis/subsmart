<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include viewPath('v2/includes/header'); ?>
<style>
.p-20 {
  padding-top: 25px !important;
  padding-bottom: 25px !important;
  padding-right: 5px !important;
  padding-left: 39px !important;
  margin-top: 55px !important;
}
.row-category, .row-category a{
    background-color: #32243d;
    color: #ffffff;
}
.help-block {
    display: block;
    margin-top: 5px;
    margin-bottom: 10px;
    color: #737373;
}
label{
    padding-top: 5px;
}
#frm-booking-setting .form-check-input{
    position:relative;
    top:5px;
}
.form-check .form-check-input{
    position: relative;
    top:4px;
}
</style>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/online_booking_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/online_booking_subtabs'); ?>
    </div>
    <!-- end tabs -->

    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            Manage your online booking settings.
                        </div>
                    </div>
                </div>
                <?php 
                    $input_disabled = '';
                    if(!checkRoleCanAccessModule('online-booking', 'write')){
                        $input_disabled = 'disabled="disabled"';
                    }
                ?>
                <?php if(checkRoleCanAccessModule('online-booking', 'write')){ ?>
                <form id="frm-booking-settings" style="width:100%;">
                <?php } ?>
                    <div class="row">
                        <div class="col-6">
                            <div class="nsm-card primary">
                                <div class="nsm-card-content">
                                    <div class="form-group">
                                        <label>Page Title <span class="bx bx-fw bx-help-circle" id="popover-page-title"></span></label>
                                        <input type="text" name="page_title" value="<?php echo $setting['page_title']; ?>"  class="form-control"  autocomplete="off" <?= $input_disabled; ?> />
                                    </div>
                                    <div class="form-group mt-2">
                                        <label>Page Instructions <span class="bx bx-fw bx-help-circle" id="popover-page-instructions"></span></label>
                                        <textarea cols="40" rows="10" name="page_intro" class="form-control ft-instruction ckeditor" <?= $input_disabled; ?>><?php echo $setting['page_instructions']; ?></textarea>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label>Products listing mode <span class="bx bx-fw bx-help-circle" id="popover-product-listing-mode"></span></label>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <select name="product_list_mode" class="form-select" <?= $input_disabled; ?>>
                                                    <option <?php echo($setting['product_list_mode'] == 'grid' ? 'selected="selected"' : ''); ?> value="grid" selected="selected">Grid View</option>
                                                    <option <?php echo($setting['product_list_mode'] == 'list' ? 'selected="selected"' : ''); ?> value="list">List View</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end first col -->
                        <div class="col-6">
                            <div class="nsm-card primary">
                                <div class="nsm-card-content">
                                    <div class="form-group p-relative-bottom-36">
                                        <label>Appointments per time slot <span class="bx bx-fw bx-help-circle" id="popover-appointments-per-time-slot"></span></label>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <select name="time_slot_bookings" class="form-control" <?= $input_disabled; ?>>
                                                    <option <?php echo($setting['time_slot_bookings'] == '0' ? 'selected="selected"' : ''); ?> value="0" selected="selected">Any number</option>
                                                    <option <?php echo($setting['time_slot_bookings'] == '1' ? 'selected="selected"' : ''); ?> value="1">Only 1</option>
                                                    <option <?php echo($setting['time_slot_bookings'] == '2' ? 'selected="selected"' : ''); ?> value="2">Only 2</option>
                                                    <option <?php echo($setting['time_slot_bookings'] == '3' ? 'selected="selected"' : ''); ?> value="3">Only 3</option>
                                                    <option <?php echo($setting['time_slot_bookings'] == '4' ? 'selected="selected"' : ''); ?> value="4">Only 4</option>
                                                    <option <?php echo($setting['time_slot_bookings'] == '5' ? 'selected="selected"' : ''); ?> value="5">Only 5</option>
                                                    <option <?php echo($setting['time_slot_bookings'] == '6' ? 'selected="selected"' : ''); ?> value="6">Only 6</option>
                                                    <option <?php echo($setting['time_slot_bookings'] == '7' ? 'selected="selected"' : ''); ?> value="7">Only 7</option>
                                                    <option <?php echo($setting['time_slot_bookings'] == '8' ? 'selected="selected"' : ''); ?> value="8">Only 8</option>
                                                    <option <?php echo($setting['time_slot_bookings'] == '9' ? 'selected="selected"' : ''); ?> value="9">Only 9</option>
                                                    <option <?php echo($setting['time_slot_bookings'] == '10' ? 'selected="selected"' : ''); ?> value="10">Only 10</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Minimum price for entire booking <span class="bx bx-fw bx-help-circle" id="popover-min-price-entire-booking"></span></label>
                                        <div class="input-group mb-3" style="width: 50%;">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">$</span>
                                            </div>
                                            <input type="number" step="any" min="0" name="cart_total_min" value="<?php echo $setting['cart_total_min']; ?>"  class="form-control" id="cart_total_min"  autocomplete="off" <?= $input_disabled; ?> />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Minimum price alert <span class="bx bx-fw bx-help-circle" id="popover-min-price-alert"></span></label>
                                        <div class="input-group mb-3" style="width: 50%;">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Minimum booking amount is</span>
                                            </div>
                                            <input type="number" step="any" min="0" name="cart_total_min_alert" value="<?php echo $setting['cart_total_min']; ?>"  class="form-control" <?= $input_disabled; ?> />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Notifications <span class="bx bx-fw bx-help-circle" id="popover-customer-notification"></span></label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="notify_email" value="1" <?php echo $setting['notify_email'] == 1 ? 'checked="checked"' : ''; ?>  id="notify_email" <?= $input_disabled; ?> />
                                            <label class="form-check-label" for="notify_email">Email</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="notify_push" value="1" <?php echo $setting['notify_push'] == 1 ? 'checked="checked"' : ''; ?> id="notify_push" <?= $input_disabled; ?> />
                                            <label class="form-check-label" for="notify_push">App Notification</label>
                                        </div>
                                    </div>

                                    <div class="form-group mt-4">
                                        <label>Don't accept booking during blocked time <span class="bx bx-fw bx-help-circle" id="popover-booking-blocked-time"></span></label>
                                        <div class="row">
                                            <div class="col-sm-24">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="event_blocked_check" value="1" <?php echo $setting['event_blocked_check'] == 1 ? 'checked="checked"' : ''; ?>  id="event_blocked_check" <?= $input_disabled; ?> />
                                                    <label class="form-check-label" for="event_blocked_check">Don't accept booking during blocked time</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-24">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="event_all_check" value="1" <?php echo $setting['event_all_check'] == 1 ? 'checked="checked"' : ''; ?>  id="event_all_check" <?= $input_disabled; ?> />
                                                    <label class="form-check-label" for="event_all_check">Don't accept booking if it overlaps with a calendar event</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>     

                                    <div class="form-group mt-4">
                                        <label>Google Analytics Tracking Id <span class="bx bx-fw bx-help-circle" id="popover-google-analytics"></span></label>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" name="google_analytics_tracking_id" value="<?php echo $setting['google_analytics_tracking_id']; ?>"  class="form-control" autocomplete="off" <?= $input_disabled; ?> />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label>Website URL <span class="bx bx-fw bx-help-circle" id="popover-website-url"></span></label>                                        
                                        <input type="text" name="google_analytics_origin" value="<?php echo $setting['google_analytics_origin']; ?>"  class="form-control" autocomplete="off" <?= $input_disabled; ?> />
                                    </div>
                                    <div class="form-group mt-2">
                                        <label>Widget status <span class="bx bx-fw bx-help-circle" id="popover-widget-status"></span></label>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <select name="status" class="form-select" style="width:50%;" <?= $input_disabled; ?>>
                                                    <option value="1" <?php echo ($setting['status'] == '1' ? 'selected="selected"' : ''); ?>>Active</option>
                                                    <option value="2" <?php echo ($setting['status'] == '2' ? 'selected="selected"' : ''); ?>>Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end second col -->
                    </div>
                    <!-- end first row -->
                    <?php if(checkRoleCanAccessModule('online-booking', 'write')){ ?>
                    <div class="row-fluid margin-top">
                        <div class="col-sm-12">
                            <button type="submit" class="nsm-button primary" id="btn-update-setting" style="margin-top: 20px;">Save</button>
                        </div>
                    </div>
                    <?php } ?>
                <?php if(checkRoleCanAccessModule('online-booking', 'write')){ ?>
                </form>                
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php include viewPath('includes/booking_modals'); ?>
<?php //include viewPath('includes/footer_booking'); ?>

<script>
$(function(){    
    <?php if(checkRoleCanAccessModule('online-booking', 'write')){ ?>
    $('#workoder-employees').select2({});

    $('#popover-page-title').popover({
        placement: 'top',
        html: true,
        trigger: "hover focus",
        content: function() {
            return 'Set your own title for the booking page';
        }
    });

    $('#popover-page-instructions').popover({
        placement: 'top',
        html: true,
        trigger: "hover focus",
        content: function() {
            return 'Optionally, a text with help or instructions that will appear below title.';
        }
    });

    $('#popover-product-listing-mode').popover({
        placement: 'top',
        html: true,
        trigger: "hover focus",
        content: function() {
            return 'How the products shoulds be listed on widget page, like a grid of boxes or a list.';
        }
    });

    $('#popover-appointments-per-time-slot').popover({
        placement: 'top',
        html: true,
        trigger: "hover focus",
        content: function() {
            return 'How many appointments can be made for same time slot and date.';
        }
    });

    $('#popover-min-price-entire-booking').popover({
        placement: 'top',
        html: true,
        trigger: "hover focus",
        content: function() {
            return 'Customers have to book products with total value over this minimum price. Set 0 for no minimum.';
        }
    });

    $('#popover-min-price-alert').popover({
        placement: 'top',
        html: true,
        trigger: "hover focus",
        content: function() {
            return 'A notification text displayed to customer if min price is not met. The tag {{amount}} will be replaced with min price value.';
        }
    });

    $('#popover-customer-notification').popover({
        placement: 'top',
        html: true,
        trigger: "hover focus",
        content: function() {
            return 'Select how you want to be notified on a new booking.';
        }
    });

    $('#popover-booking-blocked-time').popover({
        placement: 'top',
        html: true,
        trigger: "hover focus",
        content: function() {
            return 'Customers should not be able to book your services during blocked time.';
        }
    });

    $('#popover-google-analytics').popover({
        placement: 'top',
        html: true,
        trigger: "hover focus",
        content: function() {
            return 'The unique id set on your Google tracking code. e.g. UA-12345678-1';
        }
    });

    $('#popover-website-url').popover({
        placement: 'top',
        html: true,
        trigger: "hover focus",
        content: function() {
            return 'Your website URL where the widget is placed.';
        }
    });

    $('#popover-widget-status').popover({
        placement: 'top',
        html: true,
        trigger: "hover focus",
        content: function() {
            return 'Switch the booking widget off while you are on vacation.';
        }
    });

    $("#frm-booking-settings").on('submit', function(e){
        e.preventDefault();
        for ( instance in CKEDITOR.instances ){
            CKEDITOR.instances[instance].updateElement();        
        }

        var url = base_url + 'booking/_save_setting';
        $.ajax({
            type: "POST",
            url: url,
            data: $("#frm-booking-settings").serialize(),
            dataType:'json',
            success: function(o)
            {
                $('#btn-update-setting').html('Save');
                Swal.fire({
                    title: "Booking Settings",
                    text: "Data was successfully upated",
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    //if (result.value) {
                        
                    //}
                });   
            },
            beforeSend: function(){
                $('#btn-update-setting').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });
    <?php }else{ ?>
        $('#workoder-employees').select2({"disabled", true});
    <?php } ?>

    $("#convert_lead_to_work_order").change(function(){
        if ($(this).is(':checked')) {
            $("#workoder-employees").prop("disabled", false);
        }else{
            $("#workoder-employees").prop("disabled", true);            
        }
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>

