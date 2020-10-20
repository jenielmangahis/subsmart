<form name="calendar-event-modal-form" id="frm_create_event">
    <input name="type" type="hidden" value="1">

    <?php if (!empty($event)) { ?>
        <input name="event_id" type="hidden" value="<?php echo $event->id; ?>">
    <?php } ?>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <label>Customer1</label> <span class="form-required">*</span>
                <select name="customer_id" id="business-customer" class="form-control select2-hidden-accessible"
                        placeholder="Select customer" tabindex="-1" aria-hidden="true">
                </select>
            </div>
            <div class="col-md-6 col-sm-12">
                <label for="what_of_even">Type of Event</label>
                <select name="what_of_even" id="what_of_even" class="form-control">
                    <option>SELECT</option>
                    <option value="Service">Service</option>
                    <option value="Service">Reasign</option>
                    <option value="Service">Install</option>
                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-12 col-sm-24">
                <label>Schedule Description</label> <span class="form-required">*</span> <span class="help help-sm">(write few words about this)</span>
                <input type="text" name="description" value="<?php echo (!empty($event)) ? $event->description : '' ?>"
                       class="form-control" autocomplete="off">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <label>Assigned To</label> <span class="form-required">*</span> <span class="help help-sm">(who can see this event)</span>
                <select name="user_id[]" id="assign_users" class="form-control">
                    <option value="0" selected="selected">All employees</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <label>Start Date</label>
                        <div class="form-group">
                            <div class='input-group date datepicker'>
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
                            <label>Start Time</label>
                            <div class="form-group">
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
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <label>End Date</label>
                        <div class="form-group">
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
                            <label>End Time</label>
                            <div class="form-group">
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
    <div class="form-group">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <label>Event Color</label>
                <div class="calendar-modal-color-selector" data-calendar="color-selector">

                    <?php if (!empty(get_config_item('event_colors'))) { ?>

                        <?php foreach (get_config_item('event_colors') as $k => $color) { ?>

                            <span class="calendar-modal-color-sq" data-calendar-color-id="<?php echo $color ?>"
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

            <div class="col-md-6 col-sm-12">
                <label>Customer Reminder Notification</label>
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
    <div class="form-group">
        <div class="row">
            <div class="col-md-12 col-sm-24">
                <label>Instructions</label> <span class="help help-sm">(optional internal notes)</span>
                <input type="text" name="instructions"
                       value="<?php echo (!empty($event)) ? $event->instructions : '' ?>" class="form-control"
                       autocomplete="off">
            </div>
        </div>
    </div>

    <hr>

    <div>
        <div class="checkbox checkbox-sec">
            <input type="checkbox" name="is_recurring" value="1" id="is_recurring"
                   data-calendar="recurring-toggle-checkbox" <?php echo (!empty($event) && $event->is_recurring) ? 'checked' : '' ?>>
            <label style="font-weight: 500;" for="is_recurring">Repeat this schedule</label>
        </div>
        <span class="" data-calendar="recurring-toggle-edit" style="display: none;">
            <span class="middot">·</span>
            <span data-calendar="recurring-rule"></span>
            <span class="middot">·</span>
            <a data-calendar="recurring-toggle" data-label-open="edit" data-label-close="close" href="#">edit</a>
        </span>
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
</script>