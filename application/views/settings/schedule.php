<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
    <!-- page wrapper start -->
    <div class="wrapper" role="wrapper">
        <?php include viewPath('includes/sidebars/schedule'); ?>
        <?php include viewPath('includes/notifications'); ?>
        <div wrapper__section>
            <div class="container-fluid">
                <!-- end row -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <h1 style="text-align: left;">Settings</h1>

                        <?php echo form_open('settings/schedule', ['class' => 'form-validate require-validation', 'id' => 'schedule_settings_form', 'autocomplete' => 'off']); ?>
                        <div class="validation-error hide" style="display:none;"></div>

                        <div class="card">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Calendar Timezone</label>
                                        <div class="help help-sm help-block">Select the timezone that will be used
                                            to display all calendar dates.
                                        </div>
                                        <select name="calendar_timezone" class="form-control">
                                            <?php foreach (config_item('calendar_timezone') as $key => $zone) { ?>
                                                <option value="<?php echo $key ?>" <?php echo ($settings['calendar_timezone'] === $key) ? "selected" : "" ?>>
                                                    <?php echo $zone ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-3">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Calendar Default View</label>
                                        <div class="help help-sm help-block">Set the caledar default view.</div>
                                        <select name="calendar_default_view" class="form-control">
                                            <?php foreach (config_item('calender_views') as $key => $zone) { ?>
                                                <option value="<?php echo $zone ?>" <?php echo ($settings['calendar_default_view'] === $key) ? "selected" : "" ?>>
                                                    <?php echo $zone ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Calendar Week Starts On</label>
                                        <div class="help help-sm help-block">Select the day when a week starts.
                                        </div>
                                        <select name="calendar_first_day" class="form-control">
                                            <option value="0" <?php echo ($settings['calendar_first_day'] === "Sunday") ? "selected" : "" ?>>
                                                Sunday
                                            </option>
                                            <option value="1" <?php echo ($settings['calendar_first_day'] === "Monday") ? "selected" : "" ?>>
                                                Monday
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-3">
                                <div class="col-md-6 col-sm-12">
                                    <div data-calendar="time-start-container">
                                        <label>Calendar Day Starts On</label>
                                        <div class="form-group">
                                            <div class='input-group date timepicker'>
                                                <input type='text'
                                                       name="calender_day_starts_on" class="form-control"
                                                       value="<?php echo (!empty($settings['calender_day_starts_on'])) ? $settings['calender_day_starts_on'] : '' ?>"
                                                       id="calender_day_starts_on"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div data-calendar="time-start-container">
                                        <label>Calendar Day Ends On</label>
                                        <div class="form-group">
                                            <div class='input-group date timepicker'>
                                                <input type='text'
                                                       name="calender_day_ends_on" class="form-control"
                                                       value="<?php echo (!empty($settings['calender_day_ends_on'])) ? $settings['calender_day_ends_on'] : '' ?>"
                                                       id="calender_day_ends_on"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="text-align: left;">
                                <div class="col-sm-6">
                                    <label><b>Calendar Account</b></label>
                                    <div class="form-group">
                                        <div class='input-group date timepicker'>
                                            <?php if($is_glink){ ?>
                                                <a href="javascript:void(0);" class="btn btn-outline-secondary" style="text-align: left; width: 100% !important;">
                                                  <small class="plan">Gmail Account</small><br/>
                                                  <i class="fab fa-google"></i>
                                                  <big>Gmail / G Suite - Connected</big>
                                                </a> 
                                            <?php }else{ ?>
                                                <a href="javascript:void(0);" onclick="javascript:checkAuth()" id="gp_login" class="gp_login btn btn-outline-secondary" style="text-align: left; width: 100% !important;">
                                                  <small class="plan">Gmail Account</small><br/>
                                                  <i class="fab fa-google"></i>
                                                  <big>Gmail / G Suite</big>
                                                </a> 
                                            <?php } ?>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class='input-group date timepicker'>
                                            <a href="javascript:void(0);" class="gp_login btn btn-outline-secondary" style="text-align: left; width: 100% !important;">
                                              <small class="plan">Hotmail Account</small><br/>
                                              <i class="fab fa-hotmail"></i>
                                              <big>Microsoft Hotmail</big>
                                            </a> 
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class='input-group date timepicker'>
                                            <a href="javascript:void(0);" class="gp_login btn btn-outline-secondary" style="text-align: left; width: 100% !important;">
                                              <small class="plan">Apple Account</small><br/>
                                              <i class="fab fa-apple"></i>
                                              <big>Apple</big>
                                            </a> 
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label><b>Calendar Event Display Options</b></label>
                                    <div class="help help-sm help-block">The details you will see for an event on
                                        main calendar
                                    </div>
                                    <div>
                                        <div class="checkbox checkbox-sec margin-right">
                                            <input type="checkbox" name="work_order_show_customer"
                                                   value="1"
                                                   checked="checked"
                                                <?php echo (!empty($settings['work_order_show_customer']) && ($settings['work_order_show_customer'] === 1)) ? "checked" : "" ?>
                                                   id="work_order_show_customer">
                                            <label for="work_order_show_customer"><span>Customer name, phone</span></label>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="checkbox checkbox-sec margin-right">
                                            <input type="checkbox" name="work_order_show_details"
                                                   value="1"
                                                <?php echo (!empty($settings['work_order_show_details']) && ($settings['work_order_show_details'] === 1)) ? "checked" : "" ?>
                                                   id="work_order_show_details">
                                            <label for="work_order_show_details">
                                                <span>Job address, name, description</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="checkbox checkbox-sec margin-right">
                                            <input type="checkbox" name="work_order_show_price"
                                                   value="1"
                                                   checked="checked"
                                                <?php echo (!empty($settings['work_order_show_price']) && ($settings['work_order_show_price'] === 1)) ? "checked" : "" ?>
                                                   id="work_order_show_price">
                                            <label for="work_order_show_price"><span>Job price</span></label>
                                        </div>
                                    </div>
                                    <hr class="card-hr" style="border-bottom: solid 2px #dfdfdf !important;">
                                    <div class="pt-3 pb-3">
                                        <a class="link-modal-open" href="<?php echo base_url('settings') .'/notifications' ?>">Manage schedule notifications</a>
                                    </div>
                                    <hr class="card-hr" style="border-bottom: solid 2px #dfdfdf !important;">
                                    <div class="pt-3">
                                        <button class="btn btn-primary" data-action="save">Save Changes</button>
                                    </div>             
                                </div>
                            </div>
                        </div>

                        <?php echo form_close(); ?>

                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
    </div>
    <!-- end container-fluid -->
    </div>


    <!-- MODAL CREATE EVENT -->
    <div id="modalCreateEvent" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Set Up a Schedule</h4>
                </div>
                <div class="modal-body">
                    <p>loading...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="button_submit_form">Confirm</button>
                </div>
            </div>

        </div>
    </div>


    <!-- MODAL EVENT DETAILS -->
    <div id="modalEventDetails" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Schedule</h4>
                </div>
                <div class="modal-body">
                    <p>loading...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="delete_schedule">Delete</button>
                    <button type="button" class="btn btn-primary" id="edit_schedule" style="display: none">Edit Schedule
                    </button>
                    <button type="button" class="btn btn-primary" id="edit_workorder" style="display: none">Edit
                        Wordorder
                    </button>
                </div>
            </div>

        </div>
    </div>
    <!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script src="https://apis.google.com/js/client.js?onload=checkAuth"/></script>
<script type="text/javascript">
function checkAuth() {
  gapi.auth.authorize({
    'client_id' : "<?= $google_credentials['client_id']; ?>",
    'scope' : 'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/calendar https://www.googleapis.com/auth/calendar.events',
    'prompt' : 'consent',
    'access_type' : 'offline',
    'response_type': 'code token',
  }, handleAuthResult);
}

function handleAuthResult(authResult) {
  //console.log(authResult);  
  var msg1 = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" style="display:inline;" /> Connecting Gmail Account...</div>';
  var url = base_url + "settings/create_google_account";
  var auth_code = authResult['code'];
  if (typeof auth_code !== "undefined") {
    $.ajax({
      type: 'POST',
      url: url,
      data:{token: authResult['code']},
      dataType: 'json',
      beforeSend: function(data) {
        
      },
      success: function(data) {  
        location.href = base_url + 'settings/schedule?calendar_update=1';        
      },    
      error: function(e) {
        console.log(e);
      }
    });
  } else {
    alert('warning!');
  }
}
</script>