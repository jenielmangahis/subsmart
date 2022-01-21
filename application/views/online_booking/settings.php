<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
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
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/upgrades'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-20">
            <div class="row">
                <div class="col">
                  <h3 class="page-title mt-0">Online Booking</h3>
                </div>
            </div>
            <div class="pl-3 pr-3 mt-2 row" style="position: relative;top: 7px;">
              <div class="col mb-4 left alert alert-warning mt-0 mb-0">
                  <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Manage your online booking settings.</span>
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
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Page Title</label>
                                            <div class="help help-block">
                                                Set your own title for the booking page
                                            </div>
                                            <input type="text" name="page_title" value="<?php echo $setting['page_title']; ?>"  class="form-control"  autocomplete="off" />
                                        </div>
                                        <div class="form-group">
                                            <label>Page Instructions</label>
                                            <div class="help help-block">
                                                Optionally, input a text with some help or instructions, that will appear below title.
                                            </div>
                                            <textarea name="page_intro" cols="40" rows="10" class="form-control ft-instruction ckeditor"><?php echo $setting['page_instructions']; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Products listing mode</label>
                                            <div class="help help-block">How the products shoulds be listed on widget page, like a grid of boxes or a list.</div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <select name="product_list_mode" class="form-control">
                                                        <option <?php echo($setting['product_list_mode'] == 'grid' ? 'selected="selected"' : ''); ?> value="grid" selected="selected">Grid View</option>
                                                        <option <?php echo($setting['product_list_mode'] == 'list' ? 'selected="selected"' : ''); ?> value="list">List View</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group p-relative-bottom-36">
                                            <label>Appointments per time slot</label>
                                            <div class="help help-block">How many appointments can be made for same time slot and date.</div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <select name="time_slot_bookings" class="form-control" style="width:50%;">
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
                                              <input type="number" min="0" name="cart_total_min" value="<?php echo $setting['cart_total_min']; ?>"  class="form-control" id="cart_total_min"  autocomplete="off" />
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
                                              <input type="number" min="0" name="cart_total_min_alert" value="<?php echo $setting['cart_total_min']; ?>"  class="form-control" />
                                            </div>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Notifications</label>
                                            <div class="help help-block">Select how you want to be notified on a new booking.</div>
                                            <div class="checkbox checkbox-sec margin-right">
                                                <input type="checkbox" name="notify_email" value="1" <?php echo $setting['notify_email'] == 1 ? 'checked="checked"' : ''; ?>  id="notify_email" />
                                                <label for="notify_email"> Email</label>
                                            </div>
                                            <div class="checkbox checkbox-sec">
                                                <input type="checkbox" name="notify_push" value="1" <?php echo $setting['notify_push'] == 1 ? 'checked="checked"' : ''; ?> id="notify_push" />
                                                <label for="notify_push"> App Notification</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Don't accept booking during blocked time</label>
                                            <div class="help help-block">Customers should not be able to book your services during blocked time.</div>
                                            <div class="row">
                                                <div class="col-sm-24">
                                                    <div class="checkbox checkbox-sec margin-right ml-cs-20">
                                                        <input type="checkbox" name="event_blocked_check" value="1" <?php echo $setting['event_blocked_check'] == 1 ? 'checked="checked"' : ''; ?>  id="event_blocked_check" />
                                                        <label for="event_blocked_check"><span>Don't accept booking during blocked time</span></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Don't accept booking if it overlaps with a calendar event</label>
                                            <div class="help help-block">Customers should not be able to book your services if another event exists in calendar.</div>
                                            <div class="row">
                                                <div class="col-sm-24">
                                                    <div class="checkbox checkbox-sec margin-right ml-cs-20">
                                                        <input type="checkbox" name="event_all_check" value="1" <?php echo $setting['event_all_check'] == 1 ? 'checked="checked"' : ''; ?>  id="event_all_check" />
                                                        <label for="event_all_check"><span>Don't accept booking if it overlaps with a calendar event</span></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Auto-Schedule a Work Order</label>
                                            <div class="help help-block">
                                                When a booking is made automatically schedule a Work Order.
                                            </div>
                                            <div class="checkbox checkbox-sec margin-right">
                                                <input type="checkbox" name="convert_lead_to_work_order" value="1" <?php echo $setting['convert_lead_to_work_order'] == 1 ? 'checked="checked"' : ''; ?>  id="convert_lead_to_work_order" />
                                                <label for="convert_lead_to_work_order"><span>Auto-Schedule a Work Order</span></label>
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
                                            <ul class="employees clearfix pl-2">
                                                <?php foreach($employees as $e){ ?>
                                                    <li>
                                                        <div class="checkbox checkbox-sm">
                                                            <?php
                                                                $is_checked = '';
                                                                if( in_array($e->id, $aasignedUsers) ){
                                                                    $is_checked = 'checked="checked"';
                                                                }
                                                            ?>
                                                            <input type="checkbox" name="lead_work_order_employees[]" value="<?php echo $e->id; ?>" <?php echo $is_checked; ?>  id="<?php echo "eid_" . $e->id; ?>" />
                                                            <label for="<?php echo "eid_" . $e->id; ?>"><span><?php echo $e->FName . ' ' . $e->LName; ?></span>
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Google Analytics Tracking Id</label>
                                            <div class="help help-block">
                                                The unique id set on your Google tracking code. e.g. UA-12345678-1
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="text" name="google_analytics_tracking_id" value="<?php echo $setting['google_analytics_tracking_id']; ?>"  class="form-control" autocomplete="off" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Website URL</label>
                                            <div class="help help-block">
                                                Your website URL where the widget is placed.
                                            </div>
                                            <input type="text" name="google_analytics_origin" value="<?php echo $setting['google_analytics_origin']; ?>"  class="form-control" autocomplete="off" />
                                        </div>
                                        <div class="form-group">
                                            <label>Widget status</label>
                                            <div class="help help-block">Switch the booking widget off while you are on vacation.</div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <select name="status" class="form-control" style="width:50%;">
                                                        <option value="1" <?php echo ($setting['status'] == '1' ? 'selected="selected"' : ''); ?>>Active</option>
                                                        <option value="2" <?php echo ($setting['status'] == '2' ? 'selected="selected"' : ''); ?>>Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row-fluid margin-top">
                                    <div class="col-sm-12">
                                        <button type="button" class="btn btn-primary btn-update-setting">Save</button>
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

        var msg = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" style="display:inline;" /> Saving...</div>';
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

    $("#convert_lead_to_work_order").change(function(){
        if ($(this).is(':checked')) {
            $("#convert_lead_to_work_order_employees").removeClass('hide');
        }else{
            $("#convert_lead_to_work_order_employees").addClass('hide');
        }
    });
});
</script>
