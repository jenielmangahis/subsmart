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
</style>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/upgrades_tabs'); ?>
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
                                        <label>Page Title</label>
                                        <div class="help help-block">
                                            Set your own title for the booking page
                                        </div>
                                        <input type="text" name="page_title" value="<?php echo $setting['page_title']; ?>"  class="form-control"  autocomplete="off" <?= $input_disabled; ?> />
                                    </div>
                                    <div class="form-group">
                                        <label>Page Instructions</label>
                                        <div class="help help-block">
                                            Optionally, input a text with some help or instructions, that will appear below title.
                                        </div>
                                        <textarea cols="40" rows="10" class="form-control ft-instruction ckeditor" <?= $input_disabled; ?>><?php echo $setting['page_instructions']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Products listing mode</label>
                                        <div class="help help-block">How the products shoulds be listed on widget page, like a grid of boxes or a list.</div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <select name="product_list_mode" class="form-control" <?= $input_disabled; ?>>
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
                                        <label>Appointments per time slot</label>
                                        <div class="help help-block">How many appointments can be made for same time slot and date.</div>
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
                                    <div class="form-group">
                                        <label>Minimum price for entire booking</label>
                                        <div class="help help-block">
                                            Customers have to book products with total value over this minimum price.<br>
                                            Set 0 for no minimum.
                                        </div>
                                        <div class="input-group mb-3" style="width: 50%;">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">$</span>
                                            </div>
                                            <input type="number" step="any" min="0" name="cart_total_min" value="<?php echo $setting['cart_total_min']; ?>"  class="form-control" id="cart_total_min"  autocomplete="off" <?= $input_disabled; ?> />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Minimum price alert</label>
                                        <div class="help help-block">
                                            A notification text displayed to customer if min price is not met.<br>
                                            The tag {{amount}} will be replaced with min price value.
                                        </div>
                                        <div class="input-group mb-3" style="width: 50%;">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Minimum booking amount is</span>
                                            </div>
                                            <input type="number" step="any" min="0" name="cart_total_min_alert" value="<?php echo $setting['cart_total_min']; ?>"  class="form-control" <?= $input_disabled; ?> />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Notifications</label>
                                        <div class="help help-block">Select how you want to be notified on a new booking.</div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="notify_email" value="1" <?php echo $setting['notify_email'] == 1 ? 'checked="checked"' : ''; ?>  id="notify_email" <?= $input_disabled; ?> />
                                            <label class="form-check-label" for="notify_email">Email</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="notify_push" value="1" <?php echo $setting['notify_push'] == 1 ? 'checked="checked"' : ''; ?> id="notify_push" <?= $input_disabled; ?> />
                                            <label class="form-check-label" for="notify_push">App Notification</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end second col -->
                    </div>
                    <!-- end first row -->
                    <div class="row" style="margin-top: 20px;">
                        <div class="col-6">
                            <div class="nsm-card primary">
                                <div class="nsm-card-content">
                                    <div class="form-group">
                                        <label>Don't accept booking during blocked time</label>
                                        <div class="help help-block">Customers should not be able to book your services during blocked time.</div>
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
                                        <label>Don't accept booking if it overlaps with a calendar event</label>
                                        <div class="help help-block">Customers should not be able to book your services if another event exists in calendar.</div>
                                        <div class="row">
                                            <div class="col-sm-24">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="event_all_check" value="1" <?php echo $setting['event_all_check'] == 1 ? 'checked="checked"' : ''; ?>  id="event_all_check" <?= $input_disabled; ?> />
                                                    <label class="form-check-label" for="event_all_check">Don't accept booking if it overlaps with a calendar event</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Auto-Schedule a Work Order</label>
                                        <div class="help help-block">
                                            When a booking is made automatically schedule a Work Order.
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="convert_lead_to_work_order" value="1" <?php echo $setting['convert_lead_to_work_order'] == 1 ? 'checked="checked"' : ''; ?>  id="convert_lead_to_work_order" <?= $input_disabled; ?> />
                                            <label class="form-check-label" for="convert_lead_to_work_order">Auto-Schedule a Work Order</label>
                                        </div>
                                    </div>
                                    <?php
                                        $hide = 'hide';
                                        if( $setting['convert_lead_to_work_order'] == 1){
                                            $hide = '';
                                        }
                                    ?>
                                    <div class="form-group">
                                        <label>Assign To</label>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <select class="form-control" name="lead_work_order_employees[]" id="workoder-employees" <?= $input_disabled; ?>>
                                                    <?php foreach($employees as $e){ ?>
                                                    <option value="<?= $e->id; ?>" <?= in_array($e->id, $aasignedUsers) ? 'selected="selected"' : ''; ?>><?= $e->FName . ' ' . $e->LName; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end of 3rd col -->
                        <div class="col-6">
                            <div class="nsm-card primary">
                                <div class="nsm-card-content">
                                    <div class="form-group">
                                        <label>Google Analytics Tracking Id</label>
                                        <div class="help help-block">
                                            The unique id set on your Google tracking code. e.g. UA-12345678-1
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" name="google_analytics_tracking_id" value="<?php echo $setting['google_analytics_tracking_id']; ?>"  class="form-control" autocomplete="off" <?= $input_disabled; ?> />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Website URL</label>
                                        <div class="help help-block">
                                            Your website URL where the widget is placed.
                                        </div>
                                        <input type="text" name="google_analytics_origin" value="<?php echo $setting['google_analytics_origin']; ?>"  class="form-control" autocomplete="off" <?= $input_disabled; ?> />
                                    </div>
                                    <div class="form-group">
                                        <label>Widget status</label>
                                        <div class="help help-block">Switch the booking widget off while you are on vacation.</div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <select name="status" class="form-control" style="width:50%;" <?= $input_disabled; ?>>
                                                    <option value="1" <?php echo ($setting['status'] == '1' ? 'selected="selected"' : ''); ?>>Active</option>
                                                    <option value="2" <?php echo ($setting['status'] == '2' ? 'selected="selected"' : ''); ?>>Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end 2nd row -->
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
    $("#frm-booking-settings").on('submit', function(e){
        e.preventDefault();

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

