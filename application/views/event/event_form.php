<style type="text/css">
.left {
  float: left !important;
}
span.help.help-sm.left {
  margin-left: 4px;
}
input.form-control::placeholder {
  color: #999;
}
span#select2-business-customer-container {
  float: left;
}
select.gray-first option:first-child {
  color: #999 !important;
}
select.gray-first option {
  color: #000000;
}
table.table-condensed thead tr td {
  border-radius: 0px !important;
}
span.calendar-modal-color-sq i {
  position: relative;
  top: 10px;
  left: 7px;
}
.calendar-modal-color-sq {
  width: 35px !important;
  height: 35px !important;
}
span.color-name {
  text-align: center;
  position: absolute;
  top: 58px;
  width: inherit;
  margin: 0 auto;
  display: block;
}
table.table-condensed thead tr th {
    border-radius: 0px !important;
}
th.dow {
    border-radius: 0px !important;
}
table.table-condensed tbody tr td {
  border-radius: 0px !important;
}
.mbc-1 {
  margin-bottom: 0px !important;
}
.mbc-15 {
  margin-bottom: 15px !important;
}
select.gray-first:invalid,
select.gray-first option[value=""] {
  color: #999999;
}
label.center {
  font-size: 14px;
}
.modal-body {
  padding: 40px 30px 10px 30px !important;
}
.color-container {
  width: auto;
  float: left;
  margin: 0 auto;
  padding-right: 25px;
  margin-right: 20px;
}
.calendar-modal-color-selector {
  margin-top: 10px;
  margin-bottom: 10px;
  text-align: center;
  width: max-content;
  margin: 0 auto;
  position: relative;
  left: 6px;
  padding-top: 10px;
}
input#datepicker_startdate {
  position: relative;
  bottom: 4.5px;
}
.input-group.date.datepicker.left {
  border: 0px;
}
.checkbox.checkbox-sec {
  float: right;
}
.spacing {
  margin-top: 10px;
  width: 100%;
  display: block;
  height: 20px;
}
.row.r-date {
    position: relative;
    right: 15px;
}
.spacing {
  margin-top: 10px;
  width: 100%;
  display: block;
  height: 20px;
}
@media only screen and (max-width: 800px) {
  .modal-body {
      padding: 20px 10px 20px 10px !important;
  }
  .col-md-6.col-sm-12 {
      margin-bottom: 20px !important;
  }
  .col-md-12.col-sm-12 {
      margin-bottom: 20px;
  }
  .form-group {
      margin-bottom: 0px !important;
      width: 100% !important;
  }
  label.left {
      clear: both;
      float: left;
      width: auto;
      display: block;
      text-align: left;
  }
  .spacing {
      margin-top: 0px;
      width: 100%;
      display: block;
      height: 0px;
  }
}
</style>
<form name="calendar-event-modal-form" id="frm_create_event">
    <input name="type" type="hidden" value="1">

    <?php if (!empty($event)) { ?>
        <input name="event_id" type="hidden" value="<?php echo $event->id; ?>">
    <?php } ?>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <label class="left">Customer</label> <span class="form-required left">*</span>
                <select name="customer_id" id="acs-customer" class="form-control" placeholder="Select customer" tabindex="-1" aria-hidden="true">
                  <option></option>
                  <?php foreach($customers as $c){ ?>
                    <?php if (!empty($event)) { ?>
                      <option <?= $event->customer_id == $c->prof_id ? 'selected="selected"' : ''; ?> value="<?= $c->prof_id; ?>"><?= $c->first_name . ' ' . $c->last_name; ?></option>
                    <?php }else{ ?>
                      <option value="<?= $c->prof_id; ?>"><?= $c->first_name . ' ' . $c->last_name; ?></option>
                    <?php } ?>
                  <?php } ?>
                </select>
            </div>
            <div class="col-md-6 col-sm-12">
                <label for="what_of_even" class="left">Type of Event</label>
                <select name="what_of_even" id="what_of_even" class="form-control gray-first">
                    <option value="">Select type of event</option>
                    <?php foreach($eventTypes as $e){ ?>
                      <?php if (!empty($event)) { ?>
                        <option <?= $event->what_of_even == $e->title ? 'selected="selected"' : ''; ?> value="<?= $e->id; ?>"><?= $e->title; ?></option>
                      <?php }else{ ?>
                        <option value="<?= $e->id; ?>"><?= $e->title; ?></option>
                      <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <?php
              $is_checked = '';
              $container_hidden = 'display: none;';
              if( !empty($event) ){
                $event_address = '';
                $event_zip_code = '';
                $event_state = '';
                
                if( $event->event_address != '' ){
                  $event_address = $event->event_address;
                  $event_zip_code = $event->event_zip_code;
                  $event_state = $event->event_state;
                  $is_checked = 'checked="checked"';
                  $container_hidden = '';
                }
              }

            ?>
            <div class="col-md-12 col-sm-12">
                <label class="left">Schedule Description</label> <span class="form-required left">*</span><!-- &nbsp;<span class="help help-sm left">(write few words about this)</span> -->
                <input placeholder="Write few words about this..." type="text" name="description" value="<?php echo (!empty($event)) ? $event->description : '' ?>"
                       class="form-control" autocomplete="off">
                <div class="checkbox checkbox-sec" style="margin-bottom: 22px;text-align: left; ">
                    <input type="checkbox" <?= $is_checked; ?> class="chk-event-address" id="event-add-address" name="event_add_address" />
                    <label class="" style="font-weight: 500;" for="event-add-address">Add Address</label>
                </div>
            </div>
        </div>
        <div class="event-location" style="<?= $container_hidden; ?>">
          <div class="row">
              <div class="col-md-12 col-sm-12">
                  <label class="left">Address</label>
                  <input placeholder="" required="" id="event-location" type="text" name="event_address" value="<?php echo $event_address; ?>"
                         class="form-control" autocomplete="off">
              </div>
          </div>
          <div class="row">
              <div class="col-md-6 col-sm-6">
                  <label class="left">Zip / Postal Code</label>
                  <input placeholder="" required="" id="event-location" type="text" name="event_zip_code" value="<?php echo $event_zip_code; ?>"
                         class="form-control" autocomplete="off">
              </div>
              <div class="col-md-6 col-sm-6">
                  <label class="left">State / Province</label>
                  <select name="event_state" id="customer_address_modal_state" class="form-control state-province">
                    <option value="" selected="selected">- select -</option>
                    <?php $states = statesList(); ?>
                    <?php foreach($states as $key => $value){ ?>
                      <option <?= $event_state == $key ? 'selected="selected"' : ''; ?> value="<?= $key; ?>"><?= $value; ?></option>
                    <?php } ?>
                  </select>
              </div>
          </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <label class="left">Assigned To</label> <span class="form-required left">*</span>&nbsp;<span class="help help-sm left">(who can see this event)</span>
                <select name="user_id[]" id="assign_users" class="form-control">
                    <option value="0" selected="selected">All employees</option>
                </select>
            </div>
            <div class="col-md-6 col-sm-12">
                <label class="left">Customer Reminder Notification</label>
                <select name="notify_at" class="form-control">
                    <?php foreach (get_notification_details() as $key => $notification) { ?>
                        <?php if ($event->notify_at == $key) { ?>
                            <option value="<?php echo $key ?>" selected><?php echo $notification ?></option>
                        <?php } else { ?>
                            <option value="<?php echo $key ?>"><?php echo $notification ?></option>
                        <?php } ?>
                    <?php } ?>
                    <option value="0">None</option>
                </select>
            </div>
        </div>
    </div>
    <div class="spacing"></div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <label class="center">Select an event Color</label>
                <br/>
                <div class="calendar-modal-color-selector" data-calendar="color-selector">
                  <?php if( $colorSettings ){ ?>
                    <?php $counter = 0; foreach($colorSettings as $c){ ?>
                      <!-- <div class="color-container"> -->
                        <span class="calendar-modal-color-sq color-container" data-calendar-color-name="<?php echo $c->color_name; ?>" data-calendar-color-id="<?php echo $c->color_code; ?>" style="background:<?php echo $c->color_code; ?>">
                          <?php if(!empty($event)) { ?>
                            <?php if ($event->event_color == $color) { ?>
                                <i class="calendar-modal-color-icon fa fa-check " aria-hidden="true"></i>
                            <?php } ?>
                          <?php }else{ ?>
                            <?php if( $counter == 0 ){ ?>
                              <i class="calendar-modal-color-icon fa fa-check " aria-hidden="false"></i>
                            <?php } ?>
                          <?php } ?>
                          <span class="color-name"><?= $c->color_name; ?></span>
                        </span>
                        <!-- <br/> -->
                      <!-- </div> -->
                    <?php $counter++;} ?>
                  <?php }else{ ?>
                    <?php if (!empty(get_config_item('event_colors'))) { ?>

                        <?php foreach (get_config_item('event_colors') as $k => $color) { ?>

                            <span class="calendar-modal-color-sq" data-calendar-color-id="<?php echo $color ?>" data-calendar-color-name=""
                                  style="background:<?php echo $color ?>">
                                <?php if (!empty($event)) { ?>
                                    <?php if ($event->event_color == $color) { ?>
                                        <i class="calendar-modal-color-icon fa fa-check " aria-hidden="true"></i>
                                    <?php } ?>
                                <?php } else { ?>
                                    <?php if ($k === 0) { ?>
                                        <i class="calendar-modal-color-icon fa fa-check " aria-hidden="true"></i>
                                    <?php } ?>
                                <?php } ?>
                            </span>
                        <?php } ?>
                    <?php } ?>
                  <?php } ?>

                    <!-- <span class="calendar-modal-color-sq" data-calendar-color-id="#4cb052" style="background:#4cb052">
                        <i class="calendar-modal-color-icon fa fa-check " aria-hidden="true"></i>
                    </span>
                    <span class="calendar-modal-color-sq" data-calendar-color-id="#d96666" style="background:#d96666">

                    </span>
                    <span class="calendar-modal-color-sq" data-calendar-color-id="#e67399" style="background:#e67399">

                    </span>
                    <span class="calendar-modal-color-sq" data-calendar-color-id="#b373b3" style="background:#b373b3">

                    </span>
                    <span class="calendar-modal-color-sq" data-calendar-color-id="#8c66d9" style="background:#8c66d9">

                    </span>
                    <span class="calendar-modal-color-sq" data-calendar-color-id="#668cd9" style="background:#668cd9">

                    </span>
                    <span class="calendar-modal-color-sq" data-calendar-color-id="#59bfb3" style="background:#59bfb3">

                    </span>
                    <span class="calendar-modal-color-sq" data-calendar-color-id="#65ad89" style="background:#65ad89">

                    </span>
                    <span class="calendar-modal-color-sq" data-calendar-color-id="#f2a640" style="background:#f2a640">

                    </span> -->
                </div>
                <input name="event_color" type="hidden"
                       value="<?php echo (!empty($event)) ? $event->event_color : get_config_item('event_colors')[0] ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="form-group mbc-1">
                <div class="row r-date">
                    <div class="col-md-6 col-sm-12">
                        <label class="left">Start Date</label>
                        <div class="form-group">
                            <div class='input-group date datepicker left'>
                                <input type='text'
                                       value="<?php echo (!empty($event)) ? date('m/d/Y', strtotime($event->start_date)) : '' ?>"
                                       name="start_date" class="form-control" id="datepicker_startdate"/>
                            </div>
                        </div>
                        <span class="validation-error-field" data-formerrors-for-name="date_start"
                              data-formerrors-message="true" style="display: none;"></span>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div data-calendar="time-start-container">
                            <label class="left">Start Time</label>
                            <div class="form-group left">
                                <div class='input-group date timepicker'>
                                    <input type='text' value="<?php echo (!empty($event)) ? $event->start_time : '' ?>"
                                           name="start_time" class="form-control" id="datepicker_starttime"/>
                                </div>
                            </div>
                            <span class="validation-error-field" data-formerrors-for-name="time_start"
                                  data-formerrors-message="true" style="display: none;"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="form-group mbc-1">
                <div class="row r-date">
                    <div class="col-md-6 col-sm-12">
                        <label class="left">End Date</label>
                        <div class="form-group left">
                            <div class='input-group date timepicker'>
                                <input type='text'
                                       value="<?php echo (!empty($event)) ? date('m/d/Y', strtotime($event->end_date)) : '' ?>"
                                       name="end_date" class="form-control" id="datepicker_enddate"/>
                            </div>
                        </div>
                        <span class="validation-error-field" data-formerrors-for-name="date_end"
                              data-formerrors-message="true" style="display: none;"></span>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div data-calendar="time-end-container">
                            <label class="left">End Time</label>
                            <div class="form-group left">
                                <div class='input-group date timepicker'>
                                    <input type='text' value="<?php echo (!empty($event)) ? $event->end_time : '' ?>"
                                           name="end_time" class="form-control" id="datepicker_endtime"/>
                                </div>
                            </div>
                            <span class="validation-error-field" data-formerrors-for-name="time_end"
                                  data-formerrors-message="true" style="display: none;"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">

            <div class="calendar-modal-datetime-bracket"></div>

            <!-- <div style="position: absolute; top: 80px; left: 60px;">
                Timezone<br>
                <a id="timezone" href="#">Central Time (UTC -5)</a>
                <div class="hide" id="timezone-div">
                    <select name="timezone" class="form-control">
                        <option value="Pacific/Honolulu">Hawaii Time (UTC -10)</option>
                        <option value="America/Adak">Hawaii Daylight Time (UTC -9)</option>
                        <option value="America/Anchorage">Alaska Time (UTC -8)</option>
                        <option value="America/Los_Angeles">Pacific Time (UTC -7)</option>
                        <option value="America/Phoenix">Arizona Time (UTC -7)</option>
                        <option value="America/Denver">Mountain Time (UTC -6)</option>
                        <option value="America/Chicago" selected="selected">Central Time (UTC -5)</option>
                        <option value="America/New_York">Eastern Time (UTC -4)</option>
                    </select>
                </div>
            </div>

            <div style="position: absolute; top: 0px; right: 20px;">
                <label>Options</label>
                <div>
                    <label><input type="checkbox" name="all_day" value="1" data-calendar="all-day">
                        All day event</label>
                </div>
            </div> -->
        </div>
    </div>
    <div class="form-group mbc-15">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <label class="left">Instructions</label> <span class="help help-sm left">(optional internal notes)</span>
                <input type="text" name="instructions"
                       value="<?php echo (!empty($event)) ? $event->instructions : '' ?>" class="form-control"
                       autocomplete="off">
            </div>
        </div>
    </div>
    <div>
      <div class="checkbox checkbox-sec">
          <input type="checkbox" name="is_recurring" value="1" id="is_recurring"
                 data-calendar="recurring-toggle-checkbox" <?php echo (!empty($event) && $event->is_recurring) ? 'checked' : '' ?>>
          <label class="left" style="font-weight: 500;" for="is_recurring">Repeat this schedule</label>
      </div>
      <span class="" data-calendar="recurring-toggle-edit" style="display: none;">
          <span class="middot">·</span>
          <span data-calendar="recurring-rule"></span>
          <span class="middot">·</span>
          <a data-calendar="recurring-toggle" data-label-open="edit" data-label-close="close" href="#">edit</a>
      </span>
    </div>
        <!-- </div>
        <div class="margin-top-sec" data-calendar="recurring-container" style="display: none;">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="margin-bottom-sec">
                        <label>Repeats</label>
                        <select name="recurring_frequency" data-calendar="recurring-frequency" class="form-control">
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                        </select>
                    </div>
                    <div class="margin-bottom-sec" data-calendar="recurring-interval" style="display: block;">
                        <label>Repeat Every</label>
                        <div>
                            <select name="recurring_interval" class="recurring-interval form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                            </select>
                            <span data-calendar="recurring-interval-text">days</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <label>Ends</label>
                    <div class="recurring-ends-row"><label class="weight-normal"><input type="radio" name="recurring_end" value="count">
                            After</label> <input type="text" name="recurring_count" value="" class="recurring-count text-center">
                        occurences</div>
                    <div class="recurring-ends-row"><label class="weight-normal"><input type="radio" name="recurring_end" value="until">
                            On</label> <input type="text" name="recurring_until" value="" id="recurring_until" class="hasDatepicker">
                    </div>
                    <div class="recurring-ends-row"><label class="weight-normal"><input type="radio" name="recurring_end" value="" checked="checked">
                            Never</label></div>
                </div>
            </div>
            <div class="" data-calendar="recurring-frequency-week" style="display: none;">
                <div>
                    <label>Repeat on</label>
                    <div>
                        <div class="checkbox checkbox-sec margin-right-sec">
                            <input type="checkbox" name="recurring_frequency_weekday[]" value="mo" id="recurring_frequency_weekday_mo">
                            <label for="recurring_frequency_weekday_mo">Mo</label>
                        </div>
                        <div class="checkbox checkbox-sec margin-right-sec">
                            <input type="checkbox" name="recurring_frequency_weekday[]" value="tu" id="recurring_frequency_weekday_tu">
                            <label for="recurring_frequency_weekday_tu">Tu</label>
                        </div>
                        <div class="checkbox checkbox-sec margin-right-sec">
                            <input type="checkbox" name="recurring_frequency_weekday[]" value="we" id="recurring_frequency_weekday_we">
                            <label for="recurring_frequency_weekday_we">We</label>
                        </div>
                        <div class="checkbox checkbox-sec margin-right-sec">
                            <input type="checkbox" name="recurring_frequency_weekday[]" value="th" id="recurring_frequency_weekday_th">
                            <label for="recurring_frequency_weekday_th">Th</label>
                        </div>
                        <div class="checkbox checkbox-sec margin-right-sec">
                            <input type="checkbox" name="recurring_frequency_weekday[]" value="fr" id="recurring_frequency_weekday_fr">
                            <label for="recurring_frequency_weekday_fr">Fr</label>
                        </div>
                        <div class="checkbox checkbox-sec margin-right-sec">
                            <input type="checkbox" name="recurring_frequency_weekday[]" value="sa" id="recurring_frequency_weekday_sa">
                            <label for="recurring_frequency_weekday_sa">Sa</label>
                        </div>
                        <div class="checkbox checkbox-sec margin-right-sec">
                            <input type="checkbox" name="recurring_frequency_weekday[]" value="su" id="recurring_frequency_weekday_su">
                            <label for="recurring_frequency_weekday_su">Su</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="" data-calendar="recurring-frequency-month" style="display: none;">
                <div>
                    <label>Repeat by</label>
                    <div>
                        <label class="weight-normal"><input type="radio" name="recurring_frequency_month" value="day_of_month" checked="checked">
                            Day of the month</label>
                        <span class="text-ter text-sm margin-right">(e.g. every 5th of month)</span>
                        <label class="weight-normal"><input type="radio" name="recurring_frequency_month" value="day_of_week">
                            Day of the week</label>
                        <span class="text-ter text-sm">(e.g. every last Friday of month)</span>
                    </div>
                </div>
            </div>
        </div> -->

</form>

<script>
    $(document).ready(function () {

        // select the customer
        $('#acs-customer').select2();
        $('.state-province').select2();
        $('#business-customer')
            .empty() //empty select
            .append($("<option/>") //add option tag in select
                .val("<?php echo $event->customer_id ?>") //set value for option to post it
                .text("<?php echo get_customer_by_id($event->customer_id)->contact_name ?>")) //set a text for show in select
            .val("<?php echo $event->customer_id ?>") //select option of select2
            .trigger("change"); //apply to select2


        // select the employee / user
        $('#assign_users')
            .empty() //empty select
            .append($("<option/>") //add option tag in select
                .val("<?php echo $event->user->user_id ?>") //set value for option to post it
                .text("<?php echo get_user_by_id($event->user->user_id)->name ?>")) //set a text for show in select
            .val("<?php echo $event->user->user_id ?>") //select option of select2
            .trigger("change"); //apply to select2
        });

    $(".chk-event-address").change(function(){
      if($(this).prop("checked") == true){
        $(".event-location").show();
      }else{
        $(".event-location").hide();
      }
    });
</script>
