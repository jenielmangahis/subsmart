<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
?>
<?php include viewPath('includes/no_menu_header'); ?>
<style type="text/css">
.wrapper-onboarding {
  padding: 40px;
  max-width: 1340px;
  margin: 0 auto;
  width: 100%;
}
.card {
  box-shadow: none !important;
}
.profile-avatar-help-container span {
  color: #6b3a96;
}
.submit-onboard {
  width: 97.5%;
  float: right;
}
.validation-error-field {
  padding-top: 0px !important;
}
.margin-top-img {
  margin-top: 24px;
}
.text-right {
  text-align: right;
}
.card h3 {
  padding-bottom: 6px;
  border-bottom: 1px solid #e6e3e3;
  margin-bottom: 20px;
}
#form-business-details .card {
  padding: 20px 30px !important;
}
h3.sc-title {
  padding: 11px;
}
@media only screen and (max-width: 600px) {
  h3.sc-title {
    padding: 11px;
    margin: 0px;
  }
  .col-md-2 {
    padding-left: 0px;
  }
  .card.mb-0 h4, .card.mb-0 p {
    padding-left: 17px;
  }
  .col-md-2 input {
    margin-bottom: 5px;
  }
  button.btn, a.btn {
    width: 100px !important;
    font-size: 12px;
  }
  .col-md-12 {
    padding: 0px !important;
  }
  .text-right {
    text-align: right !important;
    padding-bottom: 10px !important;
    padding-right: 20px !important;
  }
  .margin-right {
    margin-right: 10px;
  }
  .margin-left {
    margin-left: 10px;
  }
  body #topnav {
    min-height: 0px;
  }
  .col-md-9, .col-md-3, .col-md-4, .col-md-6 {
      padding-left: 0px !important;
      padding-right: 0px !important;
  }
  .profile-avatar-container {
    margin-bottom: 15px;
  }
  .checkbox-sec label span {
    font-size: 13px !important;
  }
  #form-business-details .card {
    padding: 20px;
  }
  .submit-onboard {
    width: 100%;
    padding: 0px 8px;
  }
  .wrapper-onboarding {
    padding: 10px 5px 10px 5px;
  }
  .card {
    width: 100% !important;
  }
  .col-md-6 {
    padding-top: 10px !important;
  }
  .checkbox.checkbox-sec label span {
      width: 100% !important;
      font-size: 11px !important;
  }
}
.btn-copy-time{
  padding: 13px 13px;
}
</style>
<div>
   <div class="wrapper-onboarding">
      <div class="col-md-24 col-lg-24 col-xl-18">
        <h3 class="sc-title" style="background-color: #4A2268;color:#ffffff;">My Business Availability</h3>
        <?php echo form_open_multipart(null, [ 'id'=> 'form-business-availability', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
        <input type="hidden" name="id" value="<?php echo $profiledata->id; ?>">
        <div class="row">
            <div class="col-md-12">
                <form id="form-business-credentials" method="post" action="#">
                <div class="validation-error" style="display: none;"></div>
                <div class="card">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                    <form id="form-business-availability" method="post" action="#">
                    <div class="validation-error" style="display: none;"></div>

                    <div class="card">
                        <h4>Working Days</h3>
                        <p>Your working days will appear on your public profile.</p>
                        <div class="row">
                            <div class="col-md-12" style="margin-left: 14px;">
                            <div class="row">
                              <div class="col-md-2"></div>
                              <div class="col-md-2"></div>
                              <div class="col-md-2"></div>
                              <div class="col-md-6">Copy start and end time to :</div>
                            </div>
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
                    <div class="card mb-0">
                        <h4>Time Off / Unavailability</h3>
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
                        <br />
                        <div class="msg-container"></div>
                    </div>

                    <div class="row">
               <div class="col-xs-16 text-right submit-onboard">
                  <a class="btn btn-default btn-lg margin-right" href="<?php echo base_url("/dashboard");?>">Skip</a>
                  <a class="btn btn-default btn-lg" href="<?php echo base_url("/onboarding/industry_type");?>">« Back</a>
                  <button class="btn btn-primary btn-lg margin-left" name="action" value="availability" type="submit">Next »</button>
               </div>
            </div>
                </div>
        <?php echo form_close(); ?>
      </div>
    </div>
</div>
<script src="<?php echo $url->assets ?>dashboard/js/jquery.min.js"></script>
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
