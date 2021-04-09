<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
.input-group-addon:first-child {
    border-right: 0;
}
.input-group-addon:last-child {
    border-left: 0;
}
.input-group-addon {
    padding: 14px 12px;
    font-size: 14px;
    font-weight: 400;
    line-height: 1;
    color: #555;
    text-align: center;
    background-color: #eee;
    border: 1px solid #ccc;
    border-radius: 4px;
}
.input-group-addon, .input-group-btn {
    /* width: 1%; */
    white-space: nowrap;
    vertical-align: middle;
}
.page-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.p-40 {
  padding-top: 40px !important;
}
@media only screen and (max-width: 600px) {
  .p-40 {
    padding-top: 0px !important;
  }
  .pr-b10 {
    position: relative;
    bottom: 0px;
  }
}
.list-icon{
  list-style: none;
  height: 400px;
  overflow: auto;
  padding: 6px;
}
.list-icon li{
  display: inline-block;
  /*width: 30%;*/
  height:100px;
  margin: 3px;
}
.mtc-18 {
  margin-top: 36px;
}
.mt-18 {
  margin-top: 10px;
}
.page-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.p-40 {
  padding-top: 40px !important;
}
@media only screen and (max-width: 600px) {
  .p-40 {
    padding-top: 0px !important;
  }
  .pr-b10 {
    position: relative;
    bottom: 0px;
  }
}
.list-icon{
  list-style: none;
  height: 400px;
  overflow: auto;
  padding: 6px;
}
.list-icon li{
  display: inline-block;
  /*width: 30%;*/
  height:100px;
  margin: 3px;
}
.mt-18 {
  margin-top: 2px;
}
</style>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div role="wrapper">
   <?php include viewPath('includes/sidebars/business'); ?>
   <div wrapper__section>
      <div class="col-md-12 col-lg-12">
        <?php echo form_open_multipart('users/savebusinessdetail', [ 'id'=> 'form-business-details', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
        <input type="hidden" name="id" value="<?php echo $profiledata->id; ?>">
        <div class="row">
            <div class="col-md-12">
                <form id="form-business-credentials" method="post" action="#">
                <div class="validation-error" style="display: none;"></div>
                <div>
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                    <form id="form-business-availability" method="post" action="#">
                    <div class="validation-error" style="display: none;"></div>

                    <div class="card pl-4" style="margin-top:40px;">
                        <h3 class="page-title mb-0 mt-18">Availability</h3>
                        <hr class="mt-2"/>
                        <h4>Working Days</h4>
                        <p>Your working days will appear on your public profile.</p>
                        <div class="row">
                            <div class="col-md-12" style="margin-left: 14px;">

                            <div class="row pt-2">
                                <div class="col-md-2 checkbox checkbox-sec">
                                    <input type="checkbox" name="weekday[0]" value="Monday" <?= array_key_exists("Monday", $data_working_days) ? 'checked="checked"' : ''; ?> id="weekday_0">
                                    <label for="weekday_0"><span>Monday</span></label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="monHoursFromAvail" value="<?= $data_working_days['Monday']['time_from']; ?>" placeholder="Start Time" id="mondayHoursFromAvail" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="monHoursToAvail" value="<?= $data_working_days['Monday']['time_to']; ?>" placeholder="End Time" id="mondayHoursToAvail" class="form-control">
                                </div>

                                <div class="col-md-6">
                                  <a class="btn btn-default btn-sm btn-copy-time" data-key="tuesday" href="javascript:void(0);"><i class="fa fa-copy"></i> Tue</a>
                                  <a class="btn btn-default btn-sm btn-copy-time" data-key="wednesday" href="javascript:void(0);"><i class="fa fa-copy"></i> Wed</a>
                                  <a class="btn btn-default btn-sm btn-copy-time" data-key="thursday" href="javascript:void(0);"><i class="fa fa-copy"></i> Thu</a>
                                  <a class="btn btn-default btn-sm btn-copy-time" data-key="friday" href="javascript:void(0);"><i class="fa fa-copy"></i> Fri</a>
                                  <a class="btn btn-default btn-sm btn-copy-time" data-key="saturday" href="javascript:void(0);"><i class="fa fa-copy"></i> Sat</a>
                                  <a class="btn btn-default btn-sm btn-copy-time" data-key="sunday" href="javascript:void(0);"><i class="fa fa-copy"></i> Sun</a>
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-md-2 checkbox checkbox-sec">
                                    <input type="checkbox" name="weekday[1]" value="Tuesday" <?= array_key_exists("Tuesday", $data_working_days) ? 'checked="checked"' : ''; ?> id="weekday_1">
                                    <label for="weekday_1"><span>Tuesday</span></label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="tueHoursFromAvail" value="<?= $data_working_days['Tuesday']['time_from']; ?>" placeholder="Start Time" id="tuesdayHoursFromAvail" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="tueHoursToAvail" value="<?= $data_working_days['Tuesday']['time_to']; ?>" placeholder="End Time" id="tuesdayHoursToAvail" class="form-control">
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-md-2 checkbox checkbox-sec">
                                    <input type="checkbox" name="weekday[2]" value="Wednesday" <?= array_key_exists("Wednesday", $data_working_days) ? 'checked="checked"' : ''; ?> id="weekday_2">
                                    <label for="weekday_2"><span>Wednesday</span></label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="wedHoursFromAvail" value="<?= $data_working_days['Wednesday']['time_from']; ?>" placeholder="Start Time" id="wednesdayHoursFromAvail" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="wedHoursToAvail" value="<?= $data_working_days['Wednesday']['time_to']; ?>" placeholder="End Time" id="wednesdayHoursToAvail" class="form-control">
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-md-2 checkbox checkbox-sec">
                                    <input type="checkbox" name="weekday[3]" value="Thursday" <?= array_key_exists("Thursday", $data_working_days) ? 'checked="checked"' : ''; ?> id="weekday_3">
                                    <label for="weekday_3"><span>Thursday</span></label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="thuHoursFromAvail" value="<?= $data_working_days['Thursday']['time_from']; ?>" placeholder="Start Time" id="thursdayHoursFromAvail" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="thuHoursToAvail" value="<?= $data_working_days['Thursday']['time_to']; ?>" placeholder="End Time" id="thursdayHoursToAvail" class="form-control">
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-md-2 checkbox checkbox-sec">
                                    <input type="checkbox" name="weekday[4]" value="Friday" <?= array_key_exists("Friday", $data_working_days) ? 'checked="checked"' : ''; ?> id="weekday_4">
                                    <label for="weekday_4"><span>Friday</span></label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="friHoursFromAvail" value="<?= $data_working_days['Friday']['time_from']; ?>" placeholder="Start Time" id="fridayHoursFromAvail" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="friHoursToAvail" value="<?= $data_working_days['Friday']['time_to']; ?>" placeholder="End Time" id="fridayHoursToAvail" class="form-control">
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-md-2 checkbox checkbox-sec">
                                    <input type="checkbox" name="weekday[5]" value="Saturday" <?= array_key_exists("Saturday", $data_working_days) ? 'checked="checked"' : ''; ?> id="weekday_5">
                                    <label for="weekday_5"><span>Saturday</span></label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="satHoursFromAvail" value="<?= $data_working_days['Saturday']['time_from']; ?>" placeholder="Start Time" id="saturdayHoursFromAvail" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="satHoursToAvail" value="<?= $data_working_days['Saturday']['time_to']; ?>" placeholder="End Time" id="saturdayHoursToAvail" class="form-control">
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-md-2 checkbox checkbox-sec">
                                    <input type="checkbox" name="weekday[6]" value="Sunday" <?= array_key_exists("Sunday", $data_working_days) ? 'checked="checked"' : ''; ?> id="weekday_6">
                                    <label for="weekday_6"><span>Sunday</span></label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="sunHoursFromAvail" value="<?= $data_working_days['Sunday']['time_from']; ?>" placeholder="Start Time" id="sundayHoursFromAvail" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="sunHoursToAvail" value="<?= $data_working_days['Sunday']['time_to']; ?>" placeholder="End Time" id="sundayHoursToAvail" class="form-control">
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <h4>Time Off / Unavailability</h4>
                        <p>Please set your unavailable timings and time-off.</p>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-4 times-availability">
                                    <label>Time Off From</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="timeoff_from" id="timeoff_date_from" value="<?= $profiledata->start_time_of_day; ?>" class="form-control default-datepicker">
                                        <div class="input-group-append" data-for="timeoff_date_from">
                                            <span class="input-group-text"><span class="fa fa-calendar"></span></span>
                                        </div>
                                    </div>
                                    <span class="validation-error-field" style="display: none;"></span>
                                </div>
                                <div class="col-lg-4 times-availability">
                                    <label>Time Off To</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="timeoff_to" id="timeoff_date_to" value="<?= $profiledata->end_time_of_day; ?>" class="form-control default-datepicker">
                                        <div class="input-group-append" data-for="timeoff_date_to">
                                            <span class="input-group-text"><span class="fa fa-calendar"></span></span>
                                        </div>
                                    </div>
                                    <span class="validation-error-field" style="display: none;"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="card-hr">
                    <div class="card">
                        <div class="row">
                        <div class="col-md-8">
                            <button class="btn btn-primary btn-lg" name="btn-continue" value="availability" type="submit">Save</button> <span class="alert-inline-text margin-left hide">Saved</span>
                        </div>
                        <div class="col-md-4 text-right">
                        </div>
                        <!-- <div class="col-md-4 text-right">
                            <a class="btn btn-default btn-lg" href="credentials">« Back</a>
                            <a href="<?php echo base_url('users/portfolio'); ?>" class="btn btn-primary btn-lg margin-left" name="btn-continue">Next »</a>
                        </div> -->
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="mdc-top-app-bar-fixed-adjust demo-container demo-container-1 d-flex d-lg-none">
   <div class="mdc-bottom-navigation">
      <nav class="mdc-bottom-navigation__list">
         <span class="mdc-bottom-navigation__list-item mdc-ripple-surface mdc-ripple-surface--primary" data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
         <span class="material-icons mdc-bottom-navigation__list-item__icon">history</span>
         <span class="mdc-bottom-navigation__list-item__text">Recents</span>
         </span>
         <span class="mdc-bottom-navigation__list-item mdc-bottom-navigation__list-item--activated mdc-ripple-surface mdc-ripple-surface--primary" data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
         <span class="material-icons mdc-bottom-navigation__list-item__icon">favorite</span>
         <span class="mdc-bottom-navigation__list-item__text">Favourites</span>
         </span>
         <span class="mdc-bottom-navigation__list-item mdc-ripple-surface mdc-ripple-surface--primary" data-mdc-auto-init="MDCRipple" data-mdc-ripple-is-unbounded>
            <span class="material-icons mdc-bottom-navigation__list-item__icon">
               <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                  <path d="M12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,12.5A1.5,1.5 0 0,1 10.5,11A1.5,1.5 0 0,1 12,9.5A1.5,1.5 0 0,1 13.5,11A1.5,1.5 0 0,1 12,12.5M12,7.2C9.9,7.2 8.2,8.9 8.2,11C8.2,14 12,17.5 12,17.5C12,17.5 15.8,14 15.8,11C15.8,8.9 14.1,7.2 12,7.2Z"></path>
               </svg>
            </span>
            <span class="mdc-bottom-navigation__list-item__text">Nearby</span>
         </span>
      </nav>
   </div>
</div>
<?php include viewPath('includes/footer'); ?>
<script>
$(function(){
    $('.default-datepicker').datepicker({
        format: 'mm-dd-yyyy',
        autoclose: true
    });

    $('#mondayHoursFromAvail').timepicker();
    $('#tuesdayHoursFromAvail').timepicker();
    $('#wednesdayHoursFromAvail').timepicker();
    $('#thursdayHoursFromAvail').timepicker();
    $('#fridayHoursFromAvail').timepicker();
    $('#saturdayHoursFromAvail').timepicker();
    $('#sundayHoursFromAvail').timepicker();

    $('#mondayHoursToAvail').timepicker();
    $('#tuesdayHoursToAvail').timepicker();
    $('#wednesdayHoursToAvail').timepicker();
    $('#thursdayHoursToAvail').timepicker();
    $('#fridayHoursToAvail').timepicker();
    $('#saturdayHoursToAvail').timepicker();
    $('#sundayHoursToAvail').timepicker();

    $("#form-business-availability").submit(function(e){
      e.preventDefault();

      var msg = '<img src="'+base_url+'/assets/img/spinner.gif" style="display:inline-block;" /> Saving...';
      var url = base_url + 'onboarding/_save_business_availability';

      $(".msg-container").html(msg);

      setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: "json",
             data: $("#form-business-availability").serialize(),
             success: function(o)
             {
                if( o.is_success ){
                  $(".msg-container").html('');
                  location.href = base_url + 'onboarding/credentials';
                }else{
                  var msg = '<div class="alert alert-danger" role="alert">'+o.msg+'</div>';
                  $(".msg-container").html(msg);
                }
             }
          });
      }, 500);
    });

    $(".btn-copy-time").click(function(){
      var dayKey = $(this).attr("data-key");
      var startToCopy = $("#mondayHoursFromAvail").val();
      var endToCopy   = $("#mondayHoursToAvail").val();

      $("#" + dayKey + "HoursFromAvail").val(startToCopy);
      $("#" + dayKey + "HoursToAvail").val(endToCopy);
    });
});
</script>
