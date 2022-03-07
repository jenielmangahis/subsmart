<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>

</style>
<style>
.modal.fade {
  background: rgba(0, 0, 0, 0.5);
}
.modal-backdrop.fade {
  opacity: 0;
}
.hoverEffect {
    font-size: 29px;
    position: absolute;
    margin: 30px 55px;
    cursor: pointer;
}
.bs-popover-top .arrow:after, .bs-popover-top .arrow:before {
  border-top-color: #32243D !important;
}
.bs-popover-bottom .arrow:after, .bs-popover-bottom .arrow:before {
  border-bottom-color: #32243D !important;
}
</style>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/timepicker@1.13.18/jquery.timepicker.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
<?php if( $onlinePaymentAccount ){ ?>
    <?php if( $onlinePaymentAccount->paypal_client_id != '' && $onlinePaymentAccount->paypal_client_secret != '' ){ ?>
        <script src="https://www.paypal.com/sdk/js?client-id=<?= $onlinePaymentAccount->paypal_client_id; ?>&currency=USD&disable-funding=credit,card"></script>
    <?php } ?>
<?php } ?>
<script src="https://js.stripe.com/v3/"></script>
<script src="https://checkout.stripe.com/checkout.js"></script>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
    <div class="row">
        <div class="col-12 col-md-9 left-col pr-0">
            <?php include viewPath('includes/sidebars/schedule'); ?>
            <?php include viewPath('includes/notifications'); ?>
            <div wrapper__section>
                <div class="container-fluid p-40">
                    <!-- end row -->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card p-20">
                                <div class="d-block d-none">
                                    <?php
                                        if (count($wordorders) > 0) {
                                            // output data of each row
                                             foreach($wordorders as $row) {
                                                $ss = $row['id'];
                                                ?>
                                                <div card__columns>
                                                    <div class="c__header">
                                                        <h4> <?php echo 'WO-00' . $row['id']; ?></h4>
                                                        <div class="card__columns_dec">
                                                            <div><i class="fa fa-user"
                                                                    aria-hidden="true"></i> <?php echo $row['contact_name']; ?>
                                                            </div>
                                                            <div><i class="fa fa-users"
                                                                    aria-hidden="true"></i> <?php echo $row['contact_mobile']; ?>
                                                            </div>
                                                            <div><i class="fa fa-calendar"
                                                                    aria-hidden="true"></i><?php echo date('M d, Y', strtotime($row->create_at)); ?>
                                                            </div>
                                                            <h4>
                                                                <span><a href="<?= base_url('workorder/edit/'.$ss); ?>">View Workorder</a></span>
                                                            </h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        } 
                                    ?>
                                </div>
                                <div class="card-body col-12 pt-0 pl-0 pr-0" style="text-align: left;">
                                    <a class="btn-right-nav-hide-show show-right" style="color:#45a73c !important; display:none !important;" href="javascript:void(0);"><i class="fa fa-gear"></i> Right Nav</a>
                                    <div class="calender-toolbar" id="calender_toolbar">
                                        <div class="stcs-2 left">
                                          <h3 class="page-title left">Schedule</h3>                                                                                    
                                        </div>
                                        <div class="stcs-cover left">
                                          <form id="frm_calender_filter_events" method="post">
                                              <div class="stcs-4 left">
                                                <div class="form-group">
                                                    <!--<select id='time-zone-selector' class="form-control custom-select">
                                                        <option value='local' selected>local</option>
                                                        <option value='UTC'>UTC</option>
                                                    </select>-->
                                                    <?php
                                                      $aTimezone  = config_item('calendar_timezone');
                                                      $a_settings = unserialize($settings[0]->value);
                                                      if( $a_settings ){
                                                        if( isset($aTimezone[$a_settings['calendar_timezone']]) ){
                                                          $timezone = $aTimezone[$a_settings['calendar_timezone']];
                                                        }
                                                        //$timezone = $a_settings['calendar_timezone'];
                                                      }else{
                                                        $timezone = 'Central Time (UTC -5)';
                                                      }
                                                    ?>
                                                    <input type="hidden" id="time-zone-selector" value="<?= $timezone; ?>">
                                                    <span class="text-ter left"><?= $timezone; ?> &nbsp;</span><a class="margin-right-sec left text-green" href="<?= base_url()?>settings/schedule"><span class="fa fa-cog left"></span> Change</a>
                                                </div>
                                              </div>
                                              <?php if (!empty($users)) { ?>
                                              <div class="stcs-3-full left">
                                                  <div class="select-group">
                                                      <select class="form-control custom-select" id="select-employee" multiple="multiple">
                                                          <!-- <option value="0">All Employees</option> -->
                                                          <?php foreach ($users as $user) { ?>
                                                              <option value="<?php echo $user->id ?>"><?php echo $user->FName ?> <?php echo $user->LName ?></option>
                                                          <?php } ?>
                                                      </select>
                                                  </div>
                                              </div>
                                              <?php } ?>
                                              <div class="stcs-print cs-float-print">
                                                <div class="form-group margin-left-sec c-1" role="group" aria-label="...">
                                                     <a class="text-white btn btn-sec btn-md" id="print-calender"  data-calendar="print" href="#">
                                                        <span class="fa fa-print fa-margin-right"></span> Print
                                                    </a>
                                                </div>
                                              </div>
                                              <div class="stcs-1 cs-float">
                                                <div class="form-group margin-left-sec d-1" role="group" aria-label="...">
                                                    <a class="text-white btn btn-primary btn-md" data-calendar="print"
                                                       href="<?php echo base_url('job/new_job1') ?>" target="_blank">
                                                        <span class="fa fa-plus"></span>&nbsp;&nbsp;Create New Job
                                                    </a>
                                                </div>
                                              </div>
                                              <div class="stcs-3 pos-2 cs-float">
                                                <div class="form-group margin-left-sec e-1" role="group" aria-label="...">
                                                    <div class="btn-group btn-with-dropdown">
                                                        <button type="button" class="text-white btn btn-primary btn-md btn-create-event">
                                                            <span class="fa fa-plus fa-margin-right"></span>&nbsp;&nbsp;Create Event
                                                        </button>
                                                        <!-- <button type="button" class="btn btn-primary btn-md dropdown-toggle"
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            <span class="caret"></span>
                                                            <span class="text-white sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <ul class="dropdown-menu text-dark-c1">
                                                            <li><a data-calendar="add-event" data-calendar-event-type="3" href="#" data-toggle="modal"
                                                                   data-target="#modalCreateEvent">
                                                                    Add Blocked Event</a></li>
                                                            <li><a data-calendar="add-event" data-calendar-event-type="3" href="#" data-toggle="modal"
                                                                   data-target="#modalCreateEvent">
                                                                    Assign New Lead</a></li>
                                                            <li><a data-calendar="event-modal-open" href="#" data-toggle="modal"
                                                                   data-target="#modalCreateEvent">Create Event</a></li>
                                                            <li><a data-calendar="event-modal-open" href="#" data-toggle="modal"
                                                                   data-target="#modalCreateEvent">Cancel Schedule</a></li>
                                                            <li><a data-calendar="event-modal-open" href="#" data-toggle="modal"
                                                                   data-target="#modalCreateEvent">Reschedule</a></li>
                                                        </ul> -->
                                                    </div>
                                                </div>
                                              </div>
                                          </form>
                                        </div>
                                        <br class="clearfix"/>
                                        <div class="alert alert-warning mt-2 mb-4" role="alert">
                                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">With Calendar, you can quickly schedule meetings and events and get reminders about upcoming activities, so you always know what’s next. Calendar is designed for teams, so it’s easy to share. </span>
                                        </div>

                                    </div>
                                    <div class="left-calendar-loading"></div>
                                    <div id='calendar'></div>
                                    <a class="btn btn-primary btn-add-gcalendar" title="Add Calendar" href="javascript:void(0);" style="margin-top: 15px;"><i class="far fa-calendar-plus"></i> Add Calendar</a>
                                </div>
                                <div class="calendar-menu" style="text-align: left;">
                                    <div style="background: #f2f2f2; padding: 20px;">
                                        <div class="margin-bottom">
                                            <div>
                                                <a class="text-right" style="position: absolute;text-align: right;right: 50px;color: #ffffff;margin-top: 5px;" href="<?= base_url()?>job">SEE ALL JOBS</a>
                                                <h3 class="left-header">
                                                    <i class="fa fa-calendar"></i> Upcoming Jobs
                                                </h3>

                                            </div>
                                            <div id="upcoming-jobs-container"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="calendar-menu" style="text-align: left;">
                                    <div style="background: #f2f2f2; padding: 20px;">
                                        <div class="margin-bottom">
                                            <div>
                                                <a class="text-right" style="position: absolute;text-align: right;right: 50px;color: #ffffff;margin-top: 5px;" href="<?= base_url()?>events">SEE ALL EVENTS</a>
                                                <h3 class="left-header">
                                                    <i class="fa fa-calendar"></i> Upcoming Events
                                                </h3>

                                            </div>
                                            <div id="upcoming-events-container"></div>
                                        </div>
                                    </div>
                                </div>

                              <div class="calendar-menu" style="text-align: left;">
                                  <div style="background: #f2f2f2; padding: 20px;">
                                      <div class="margin-bottom">
                                        <!--
                                          <div><h3 class="left-header" style="background-color: #4eb245;"><i class="fa fa-calendar"></i> Upcoming Jobs</h3></div>

                                          <div class="row d-none d-lg-flex">
                                              <div class="col-md-12">
                                                  <div class="cus-dashboard-div">
                                                      <div id="upcoming-jobs-container"></div>
                                                  </div>
                                              </div>
                                          </div>
                                        -->
                                        <!--
                                          <div><h3 class="left-header" style="background-color: #9775fa;"><i class="fa fa-calendar"></i> Upcoming Events</h3></div>

                                          <div class="row d-none d-lg-flex">
                                              <div class="col-md-12">
                                                  <div class="cus-dashboard-div">
                                                      <div id="upcoming-events-container"></div>
                                                  </div>
                                              </div>
                                          </div>
                                        -->

                                          <div><h3 class="left-header"><i class="fa fa-calendar"></i> Unshceduled Estimates</h3></div>
                                          <div id="scheduled-estimates-container"></div>
                                      </div>
                                  </div>
                              </div>
                            </div>
                            <!-- end card -->
                        </div>
                    </div>
                    <!-- end row -->
                </div>
            </div>
        </div>
        <?php //if( !$is_mobile ){ ?>
        <div class="col-12 col-md-3 mt-40 right-col pl-1" style="background-color: #ffffff;display: block !important;padding-bottom: 20px;">
            <div class="row" style="padding:10px;">
                <div class="col-12">
                    <div class="right-calendar-loading"></div>
                    <a class="btn-mini-calendar" href="javascript:void(0);"><h4  class="right-filter-header"><i class="fa fa-minus cmini-icon icon-plus-cz"></i><span class="pl-1">MINI CALENDAR</span></h4></a>
                    <div class="min-calendar-container">
                      <div id="right-calendar"></div>
                    </div>

                    <div class="calendar-tooltip"></div>
                </div>
                <!-- <div class="col-12" style="margin-top: 15px;">
                    <h4  class="right-filter-header">FILTER BY TIME OFF</h4>


                    <ul class="right-list-events">
                        <li><span class="dot dot-red"><i class="fa fa-check"></i></span> Events</li>
                        <li><span class="dot dot-green"><i class="fa fa-check"></i></span> National Holiday</li>
                        <li><span class="dot dot-yellow"><i class="fa fa-check"></i></span> Interview</li>
                        <li><span class="dot dot-blue"><i class="fa fa-check"></i></span> Leave</li>
                    </ul>
                </div> -->
                <div class="col-12" style="margin-top: 15px;">
                    <a class="btn-calendar-list" href="javascript:void(0);"><h4  class="right-filter-header"><i class="fa fa-plus clist-icon icon-plus-cz"></i><span class="pl-1">CALENDARS</span></h4></a>
                    <div class="public-calendar-list" style="display: none;">
                    <?php if(!empty($calendar_list)){ ?>
                      <p style="font-size: 13px;text-align: left;">Which calendar entries do you wish to show</p>
                      <?php if(!empty($calendar_list)) { ?>
                          <table class="table">
                            <thead>
                              <tr>
                                <th style="font-size: 12px;">Main</th>
                                <th style="font-size: 12px;">Mini</th>
                                <th style="font-size: 12px;">Calendar Name</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach($calendar_list as $calendar) { ?>
                                <tr>
                                    <?php
                                        $is_checked = "";
                                        $is_mini_checked = "";

                                        if(!empty($enabled_calendar)) {
                                          if(in_array($calendar['id'], $enabled_calendar)){
                                              $is_checked = 'checked="checked"';
                                          }
                                        }

                                        if(!empty($enabled_mini_calendar)) {
                                          if(in_array($calendar['id'], $enabled_mini_calendar)){
                                              $is_mini_checked = 'checked="checked"';
                                          }
                                        }

                                        $rowBgColor = '#38a4f8';
                                        if( $calendar['backgroundColor'] != '' ){
                                          $rowBgColor = $calendar['backgroundColor'];
                                        }
                                    ?>
                                    <td style="background-color: <?php echo $rowBgColor; ?>"><input type="checkbox" class="chk-calendar-entries" <?php echo $is_checked; ?> data-id="<?php echo $calendar['id']; ?>"></td>
                                    <td style="background-color: <?php echo $rowBgColor; ?>"><input type="checkbox" class="chk-calendar-mini-entries" <?php echo $is_mini_checked; ?> data-id="<?php echo $calendar['id']; ?>"></td>
                                    <td style="background-color: <?php echo $rowBgColor; ?>"><?php echo $calendar['summary']; ?></td>
                                    <td style="background-color: <?php echo $rowBgColor; ?>">
                                      <!-- <a class="btn btn-sm btn-info pull-right btn-add-gevent btn-gcustom top-1 br-99" title="Add Event" href="javascript:void(0);" data-id="<?php echo $calendar['id']; ?>"><i class="far fa-edit"></i></a> -->
                                    </td>
                              </tr>
                            <?php } ?>
                            </tbody>
                          </table>
                      <?php } ?>
                    <?php }else{ ?>
                      <p style="font-size: 13px;text-align: left;">To enable mini calendar events filtering, bind your gmail account in <a style="color:#44a73c;" href="<?= base_url()?>settings/schedule">Calendar Settings</a></p>
                    <?php } ?>
                    </div>
                </div>
                <div class="col-12" style="margin-top: 15px;">
                    <a class="btn-contacts-list" href="javascript:void(0);"><h4  class="right-filter-header"><i class="fa fa-plus contact-list-icon icon-plus-cz"></i><span class="pl-1">RECENT CONTACTS</span></h4></a>

                    <div class="recent-contacts-container" style="display: none;">
                      <ul class="list-group">
                      <?php if(isset($get_recent_users)){
                                foreach ($get_recent_users as $key => $recent_user) {  ?>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-xs-12 col-2 col-sm-2 col-md-2">
                                             <?php
                                               if( $recent_user->profile_img != null) {
                                                    $img_filename = userProfileImage($recent_user->id);
                                                    $default_imp_img = $img_filename;
                                                } else {
                                                    $default_imp_img = base_url('uploads/users/default.png');
                                                }
                                             ?>
                                            <img class="calendar-user-profile" src="<?php echo $default_imp_img ?>" alt="user" class="rounded-circle" style="inline">
                                        </div>
                                        <div class="col-xs-12 col-6 col-sm-6 col-md-6" style="text-align: left;">
                                            <span class="name"><i class="fa fa-user"></i> <?php echo $recent_user->FName . " " . $recent_user->LName  ?></span><br/>
                                            <span><i class="fa fa-envelope-open"></i><span class="calendar-email"><?php echo $recent_user->email ?></span></span>
                                            <span class="visible-xs"> <span class="text-muted"></span>
                                        </div>
                                        <div class="col-xs-12 col-4 col-sm-4 col-md-4" style="text-align: left;">
                                            <a href="tel:<?= $recent_user->phone; ?>" class="calendar-profile-contact"><i class="fa fa-phone"></i></a>
                                            <a href="mailto:<?= $recent_user->email; ?>" class="calendar-profile-contact"><i class="fa fa-envelope-o"></i></a>
                                            <!-- <a href="#" class="calendar-profile-contact"><i class="fa fa-comments-o"></i></a> -->
                                            <a href="<?= base_url('workcalender/print_contact/'.$recent_user->id); ?>" target="_blank" class="calendar-profile-contact"><i class="fa fa-print"></i></a>
                                            <!-- <a class="btn-calendar-small btn btn-default" href="javascript:void(0)">Contact</a> -->
                                        </div>
                                    </div>
                                </li>
                      <?php     }
                            } ?>


                    </ul>
                    </div>
                </div>

                <div class="col-12" style="margin-top: 15px;">
                    <a class="btn-wait-list" href="javascript:void(0);"><h4  class="right-filter-header"><i class="fa fa-plus wait-list-icon icon-plus-cz"></i><span class="pl-1">WAIT LIST</span></h4></a>

                    <div class="wait-list-container" style="display: none;">
                        <a class="btn btn-sm btn-primary float-right btn-add-wait-list" href="javascript:void(0);">Add Wait List</a>
                        <div class="clear"></div>
                        <div class="wait-list"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php //} ?>
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
                <h4 class="modal-title">Set Up a Schedule</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
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

<!-- MODAL CREATE APPOINTMENT -->
<div class="modal fade modal-enhanced" id="modal-create-appointment" role="dialog" aria-labelledby="addLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Create Appointment</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button>
          </div>
            <form id="frm-create-appointment" method="post">
                <div class="modal-body" style="padding:1.5rem;margin-bottom: 50px;">
                  <div class="form-group">
                      <label for="" style="width:100%;text-align: left;"><i class="fa fa-calendar"></i> When</label>
                      <div class="row g-3">
                        <div class="col-sm-8">
                          <input type="text" name="appointment_date" class="form-control appointment-datepicker appointment-date field-popover" placeholder="Date" aria-label="Date" data-trigger="hover" data-original-title="When" data-container="body" data-placement="right" autocomplete="off" data-content="Appointment Date">
                        </div>
                        <div class="col-sm-4">
                          <input type="text" name="appointment_time" class="form-control appointment-time field-popover" placeholder="Time" aria-label="Time" data-trigger="hover" data-original-title="Time" data-container="body" data-placement="right" data-content="Appointment Time">
                        </div>
                      </div>
                  </div>  
                  <div class="form-group">
                      <label for="" style="width:100%;text-align: left;"><i class="fa fa-address-card-o"></i> Which Employee</label>
                      <div class="row g-3">
                        <div class="col-sm-12">
                            <span id="wait-list-add-employee-popover"
                              data-content="Assign employee that will handle the appointment"
                              data-original-title="Which Employee"
                              data-placement="right"
                              data-trigger="hover"
                              data-container="body">
                            <select name="appointment_user_id" id="appointment-user" class="form-control"></select>
                            </span>
                        </div>
                      </div>
                  </div> 
                  <div class="form-group">
                      <label for="" style="width:100%;text-align: left;"><i class="fa fa-user"></i> 
                      Which Customer
                      <a href="javascript:void(0);" class="btn-ql-customer" data-modal="modal-create-appointment" style="float: right; color:rgb(255,129,89); font-size: 15px;"><i class="fa fa-plus"></i> Add New Customer</a>
                      </label>
                      <div class="row g-3">
                        <div class="col-sm-12">
                          <span id="add-customer-popover"
                              data-content="Pick customer from the list which the appointment will be set"
                              data-original-title="Which Customer"
                              data-placement="right"
                              data-trigger="hover"
                              data-container="body">
                          <select name="appointment_customer_id" id="appointment-customer" class="form-control"></select>
                          </span>
                        </div>
                      </div>
                  </div> 
                  <div class="form-group">
                      <label for="" style="width:100%;text-align: left;"><i class="fa fa-list"></i> Appointment Type</label>
                      <div class="row g-3">
                        <div class="col-sm-12">
                          <select name="appointment_type_id" id="appointment-type" class="form-control field-popover" style="border:solid 1px rgba(0,0,0,0.35);" data-trigger="hover" data-original-title="Appointment Type" data-container="body" data-placement="right" data-content="Select what kind of appointment will this be">
                            <?php $start = 0; ?>
                            <?php foreach($appointmentTypes as $a){ ?>
                                <option <?= $start == 0 ? 'selected="selected"' : ''; ?> value="<?= $a->id; ?>"><?= $a->name; ?></option>
                            <?php $start++;} ?>
                          </select>
                        </div>
                      </div>
                  </div>  
                  <div class="form-group">
                      <label for="" style="width:100%;text-align: left;"><i class="fa fa-tag"></i> Tags</label>
                      <div class="row g-3">
                        <div class="col-sm-12">
                            <span id="add-tag-popover"
                              data-content="Pick a tags that will describe this appointment"
                              data-original-title="Tags"
                              data-placement="right"
                              data-trigger="hover"
                              data-container="body">
                            <select name="appointment_tags[]" id="appointment-tags" multiple="multiple" class="form-control"></select>
                            </span>
                        </div>
                      </div>
                  </div>                 
                </div>
                <div class="modal-footer custom-modal-footer" style="margin-top:-2.5rem;">
                  <button type="button" style="" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary btn-create-appointment" name="action" value="create_appointment">Schedule</button>
                </div>
            </form>
      </div>
  </div>
</div>

<!-- MODAL CREATE WAIT LIST -->
<div class="modal fade modal-enhanced" id="modal-create-wait-list" role="dialog" aria-labelledby="addLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Create Wait List</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button>
          </div>
            <form id="frm-create-appointment-wait-list" method="post">
                <div class="modal-body" style="padding:1.5rem;margin-bottom: 50px;">
                  <div class="form-group">
                      <label for="" style="width:100%;text-align: left;"><i class="fa fa-calendar"></i> Preferred Date</label>
                      <div class="row g-3">
                        <div class="col-sm-8">
                          <input type="text" name="appointment_date" class="form-control appointment-datepicker appointment-date field-popover" placeholder="Date" aria-label="Date" data-trigger="hover" data-original-title="When" data-container="body" data-placement="right" autocomplete="off" data-content="Your Preferred Appointment Date">
                        </div>
                        <div class="col-sm-4">
                          <input type="text" name="appointment_time" class="form-control appointment-time field-popover" placeholder="Time" aria-label="Time" data-trigger="hover" data-original-title="Time" data-container="body" data-placement="right" data-content="Your Preferred Appointment Time">
                        </div>
                      </div>
                  </div>  
                  <!-- <div class="form-group">
                      <label for="" style="width:100%;text-align: left;"><i class="fa fa-address-card-o"></i> Preferred Employee</label>
                      <div class="row g-3">
                        <div class="col-sm-12">
                            <span id="add-employee-popover"
                              data-content="Your preferred employee that will assign to this appointment"
                              data-original-title="Which Employee"
                              data-placement="right"
                              data-trigger="hover"
                              data-container="body">
                            <select name="appointment_user_id" id="wait-list-appointment-user" class="form-control"></select>
                            </span>
                        </div>
                      </div>
                  </div> --> 
                  <div class="form-group">
                      <label for="" style="width:100%;text-align: left;"><i class="fa fa-user"></i> 
                      Which Customer
                      <a href="javascript:void(0);" class="btn-ql-customer" data-modal="modal-create-appointment" style="float: right; color:rgb(255,129,89); font-size: 15px;"><i class="fa fa-plus"></i> Add New Customer</a>
                      </label>
                      <div class="row g-3">
                        <div class="col-sm-12">
                          <span id="wait-list-add-customer-popover"
                              data-content="Pick customer from the list which the appointment will be set"
                              data-original-title="Which Customer"
                              data-placement="right"
                              data-trigger="hover"
                              data-container="body">
                          <select name="appointment_customer_id" id="wait-list-appointment-customer" class="form-control"></select>
                          </span>
                        </div>
                      </div>
                  </div> 
                  <div class="form-group">
                      <label for="" style="width:100%;text-align: left;"><i class="fa fa-list"></i> Appointment Type</label>
                      <div class="row g-3">
                        <div class="col-sm-12">
                          <select name="appointment_type_id" id="appointment-type" class="form-control field-popover" style="border:solid 1px rgba(0,0,0,0.35);" data-trigger="hover" data-original-title="Appointment Type" data-container="body" data-placement="right" data-content="Select what kind of appointment will this be">
                            <?php $start = 0; ?>
                            <?php foreach($appointmentTypes as $a){ ?>
                                <option <?= $start == 0 ? 'selected="selected"' : ''; ?> value="<?= $a->id; ?>"><?= $a->name; ?></option>
                            <?php $start++;} ?>
                          </select>
                        </div>
                      </div>
                  </div>  
                  <!-- <div class="form-group">
                      <label for="" style="width:100%;text-align: left;"><i class="fa fa-tag"></i> Tags</label>
                      <div class="row g-3">
                        <div class="col-sm-12">
                            <span id="wait-list-add-tag-popover"
                              data-content="Pick a tags that will describe this appointment"
                              data-original-title="Tags"
                              data-placement="right"
                              data-trigger="hover"
                              data-container="body">
                            <select name="appointment_tags[]" id="wait-list-appointment-tags" multiple="multiple" class="form-control"></select>
                            </span>
                        </div>
                      </div>
                  </div>  -->                
                </div>
                <div class="modal-footer custom-modal-footer" style="margin-top:-2.5rem;">
                  <button type="button" style="" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary btn-create-appointment-wait-list" name="action" value="create_appointment">Save</button>
                </div>
            </form>
      </div>
  </div>
</div>

<!-- MODAL VIEW APPOINTMENT -->
<div class="modal fade modal-enhanced" id="modal-view-appointment" role="dialog" aria-labelledby="addLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Appointment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding:1.5rem;margin-bottom: 50px;">
                <div class="view-appointment-container"></div>
            </div>
            <div class="modal-footer custom-modal-footer view-appointment-actions" style="margin-top:-2.5rem;display: none;">                                                    
                <a class="btn btn-primary btn-edit-appointment" data-id="" href="javascript:void(0);"><i class="fa fa-pencil"></i> Edit</a>                
                <a class="btn btn-danger btn-checkout-appointment" data-id="" href="javascript:void(0);"><i class="fa fa-check"></i> Check out</a>                
                <a class="btn btn-primary btn-payment-details-appointment" href="javascript:void(0);" style="display: none;"><i class="fa fa-list"></i> Payment Details</a>
                <a class="btn btn-danger btn-delete-appointment" href="javascript:void(0);" data-id=""><i class="fa fa-trash"></i> Delete</a>
            </div>
      </div>
  </div>
</div>

<!-- MODAL WAIT LIST SET AN APPOINTMENT -->
<div class="modal fade modal-enhanced" id="modal-edit-wait-list" role="dialog" aria-labelledby="addLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Wait List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="frm-update-appointment-wait-list" method="post">
            <input type="hidden" name="wid" value="" id="wid">
            <div class="modal-body" style="padding:1.5rem;margin-bottom: 50px;">
                <div class="view-wait-list-container"></div>
            </div>
            <div class="modal-footer custom-modal-footer" style="margin-top:-2.5rem;">
                <button type="submit" class="btn btn-primary btn-update-appointment-wait-list" name="action" value="update_appointment">Update</button>      
                <a class="btn btn-primary btn-set-as-appointment field-popover" href="javascript:void(0);" data-trigger="hover" data-original-title="Set as Appointment" data-container="body" data-placement="top" data-content="Will move wait list to calendar"><i class="fa fa-calendar"></i> Set as Appointment</a>
                <a class="btn btn-danger btn-delete-appointment-waitlist" href="javascript:void(0);"><i class="fa fa-trash"></i> Delete</a>
            </div>
            </form>
      </div>
  </div>
</div>

<!-- MODAL VIEW APPOINTMENT PAYMENT DETAILS -->
<div class="modal fade modal-enhanced" id="modal-view-appointment-payment-details" role="dialog" aria-labelledby="addLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="width: 964px;">
            <div class="modal-header">
                <h5 class="modal-title">Appointment Payment Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding:1.5rem;margin-bottom: 50px;">
                <div class="view-appointment-payment-details-container"></div>
            </div>
            <div class="modal-footer custom-modal-footer" style="margin-top:-2.5rem;">
                <button type="button" style="" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
      </div>
  </div>
</div>

<!-- MODAL EDIT APPOINTMENT -->
<div class="modal fade modal-enhanced" id="modal-edit-appointment" role="dialog" aria-labelledby="addLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Appointment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="frm-update-appointment" method="post">
                <input type="hidden" name="aid" id="edit-aid" value="">
                <div class="modal-body" style="padding:1.5rem;margin-bottom: 50px;">
                    <div class="edit-appointment-container"></div>
                </div>
                <div class="modal-footer custom-modal-footer" style="margin-top:-2.5rem;">                                    
                    <button type="button" style="" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-update-appointment" name="action" value="update_appointment">Update</button>
                </div>
            </form>
      </div>
  </div>
</div>

<!-- MODAL CHECKOUT APPOINTMENT -->
<div class="modal fade modal-enhanced" id="modal-checkout-appointment" role="dialog" aria-labelledby="addLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Checkout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
            </div>           
            <div class="modal-body" style="padding:1.5rem;margin-bottom: 50px;">
                <div class="checkoout-appointment-container"></div>
            </div>
            <!-- <div class="modal-footer custom-modal-footer" style="margin-top:-2.5rem;">                                    
                <button type="button" style="" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-update-appointment" name="action" value="update_appointment">Update</button>
            </div> -->
      </div>
  </div>
</div>

<!-- MODAL CREATE GOOGLE CALENDAR EVENT -->
<div id="modalCreateGoogleEvent" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Google Calendar Event</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open_multipart('', ['id' => 'create-google-event', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
            <div class="modal-body">
                <input type="hidden" name="gevent_gcid" id="gevent_gcid" value="">
                <div class="form-group" style="text-align: left;">
                  <label>Event Name</label> <span class="form-required">*</span>
                  <input type="text" name="gevent_name" value=""  class="form-control" required="" autocomplete="off" required />
                </div>
                <div class="form-group" style="text-align: left;">
                  <label>Event Description</label> <span class="form-required">*</span>
                  <input type="text" name="gevent_description" value=""  class="form-control" required="" autocomplete="off" required />
                </div>
                <div class="form-group" style="text-align: left;">
                  <label>Date from</label> <span class="form-required">*</span>
                  <input type="text" name="gevent_date_from" value=""  class="form-control default-datepicker" required="" autocomplete="off" required />
                </div>
                <div class="form-group" style="text-align: left;">
                  <label>Date to</label> <span class="form-required">*</span>
                  <input type="text" name="gevent_date_to" value=""  class="form-control default-datepicker" required="" autocomplete="off" required />
                </div>
                <div class="form-group" style="text-align: left;">
                  <label>Start Time</label> <span class="form-required">*</span>
                  <div class="form-group">
                    <div class='input-group date' id='gevent-start-time'>
                       <input type='text' name="gevent_start_time" class="form-control" />
                       <span class="input-group-addon">
                       <span class="fa fa-clock"></span>
                       </span>
                    </div>
                  </div>
                </div>
                <div class="form-group" style="text-align: left;">
                  <label>End Time</label> <span class="form-required">*</span>
                  <div class="form-group">
                    <div class='input-group date' id='gevent-end-time'>
                       <input type='text' name="gevent_end_time" class="form-control" />
                       <span class="input-group-addon">
                       <span class="fa fa-clock"></span>
                       </span>
                    </div>
                  </div>
                </div>
                <div class="form-group" style="text-align: left;">
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
                <hr />
                <div class="form-group" style="text-align: left;">
                  <label>Customer</label> <span class="form-required">*</span>
                  <select name="customer_id" id="google-business-customer" class="form-control select2-hidden-accessible" placeholder="Select customer" tabindex="-1" aria-hidden="true"></select>
                </div>
                <div class="form-group" style="text-align: left;">
                  <label>Assigned to</label> <span class="form-required">*</span>
                  <select name="user_id[]" id="google-assign-users" class="form-control">
                      <option value="0" selected="selected">All employees</option>
                  </select>
                </div>
                <div class="form-group" style="text-align: left;">
                  <label>Type of Event</label> <span class="form-required">*</span>
                  <select name="what_of_even" id="what_of_even" class="form-control">
                      <option>SELECT</option>
                      <option value="Service">Service</option>
                      <option value="Service">Reasign</option>
                      <option value="Service">Install</option>
                  </select>
                </div>
                <div class="create-gevent-validation-error" style="text-align: left;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-create-google-event">Save</button>
            </div>
            <?php echo form_close(); ?>
        </div>

    </div>
</div>

<!-- MODAL CREATE GOOGLE CALENDAR -->
<div id="modalCreateGoogleCalendar" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Google Calendar</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open_multipart('', ['id' => 'create-google-calendar', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
            <div class="modal-body">
                <input type="hidden" name="gevent_gcid" id="gevent_gcid" value="">
        <div class="form-group" style="text-align: left;">
          <label>Calendar Name</label> <span class="form-required">*</span>
          <input type="text" name="gcalendar_name" value=""  class="form-control" required="" autocomplete="off" required />
        </div>
        <div class="create-gcalendar-validation-error" style="text-align: left;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-create-google-calendar">Save</button>
            </div>
            <?php echo form_close(); ?>
        </div>

    </div>
</div>

<!-- MODAL EVENT DETAILS -->
<div id="modalEventDetails" class="modal fade" role="dialog" style="">
    <div class="modal-dialog modal-md">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 style="" class="modal-title">Schedule</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>                
            </div>
            <div class="modal-body" style="padding-top: 0px; padding-bottom: 2px;">
                <p>loading...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger btn-event-delete" id="delete_schedule" style="display: none">Delete</button>
                <button type="button" class="btn btn-primary btn-event-edit" id="edit_schedule" style="display: none">Edit Schedule
                </button>
                <!-- <button type="button" class="btn btn-primary btn-event-edit-workorder" id="edit_workorder" style="display: none">Edit Wordorder
                </button> -->
            </div>
        </div>

    </div>
</div>

<!-- MODAL SELECT ITEM -->
<div class="modal fade modal-enhanced" id="modal-checkout-items" role="dialog" aria-labelledby="addLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width:664px;">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" style="color:#ffffff;">Select Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" style="color:#ffffff;">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding:1.5rem;margin-bottom: 0px;">
                <div class="select-checkout-item"></div>
            </div>
      </div>
  </div>
</div>

<div id="modalEditEvent" class="modal fade" role="dialog" style="">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 style="" class="modal-title">Edit Event</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body edit-event-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="button_submit_form">Confirm</button>
            </div>
        </div>

    </div>
</div>

<style>
    .hid-deskx {
        display: none !important;
    }


    @media only screen and (max-width: 600px) {
        .hid-desk {
            display: none !important;
        }

        .hid-deskx {
            display: block !important;
        }
    }
</style>
<!-- page wrapper end -->
<?php include viewPath('includes/quick_launch_modals'); ?>
<?php include viewPath('includes/footer'); ?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/timepicker@1.13.18/jquery.timepicker.min.js"></script>
<script src='https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js'></script>
<script src='https://unpkg.com/popper.js/dist/umd/popper.min.js'></script>
<script>
    var calendar;


    $('#dataTable1').DataTable({

        "ordering": false
    });

    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function (html) {
        var switchery = new Switchery(html, {
            size: 'small'
        });
    });

    window.updateUserStatus = (id, status) => {
        $.get('<?php echo url('company/change_status') ?>/' + id, {
            status: status
        }, (data, status) => {
            if (data == 'done') {
                // code
            } else {
                alert('Unable to change Status ! Try Again');
            }
        })
    }

    $("#edit_schedule").click(function(){
      var event_id = $(this).attr("data-event-id");
      var message = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" /> Loading...</div>';
      var url = base_url + 'event/get_event_form';

      $("#modalEventDetails").modal('hide');
      $("#modalEditEvent").modal('show');

      $(".edit-event-body").html(message);

      setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {event_id:event_id},
             success: function(o)
             {
                $(".edit-event-body").html(o);
             }
          });
      }, 800);
    });



    function get_employee_dropdown() {
        jQuery.ajax({
            url: base_url + 'users/ajax_user_dropdown',
            // dataType: 'json',
            data: '',
            beforeSend: function () {
                jQuery('.tiva-calendar').html('<div class="loading"><img src="images/temp/loading.gif" /></div>');
            },
            success: function (response) {

                //console.log(response);

                // $('.tiva-events-calendar > .events-calendar-bar').append(response);

                $('#calender_toolbar').append(response);
            }
        });
    }


    $(document).ready(function () {

        var event_details_popup;

        var action = "<?php echo isset($_GET['action']) ? $_GET['action'] : '' ?>";
        var customer_id = "<?php echo isset($_GET['customer_id']) ? $_GET['customer_id'] : '' ?>";


        if (action === 'open_event_modal') {

            //console.log('opening modal...');
            var data = {
                id: "<?php echo (!empty($_GET['customer_id'])) ? get_customer_by_id($_GET['customer_id'])->id : 0 ?>",
                contact_name: "<?php echo (!empty($_GET['customer_id'])) ?  get_customer_by_id($_GET['customer_id'])->contact_name : '' ?>",
                contact_email: "<?php echo (!empty($_GET['customer_id'])) ?  get_customer_by_id($_GET['customer_id'])->contact_email : '' ?>",
            }
            open_create_event_modal_for_customer(customer_id, data);
        }

        // client on any event, a pop will be shown with event details
        // $(document).on('click', '#calendar .fc-event-container', function(e) {

        //     var html = '<div class="calendar-event-details"><div class="img-loading"><img src="./assets/img/loading.gif"></div></div>';

        //     $('#calendar').append(html);

        //     var top = $(this).position().top + 323;
        //     var left = $(this).position().left + 4;

        //     console.log(top, left);

        //     $('#calendar .calendar-event-details').css({
        //         'left': left,
        //         'top': top
        //     });
        // });

        // close event detailspopup
        // $(document).on('click', '#calendar .calendar-event-details .close-details', function(e) {

        //     $(this).parent().remove();
        // });


        // filter calender events by emloyess
        $(document).on('change', '#select-employee', function (e) {
            var url = base_url + 'calendar/_update_employee_filter';
            // $('#frm_calender_filter_events').submit();

            //$("#calendar").css('opacity', '.5');
            //$("#calendar").attr('disabled', true);

            var eids = $(this).val();
            $.ajax({
               type: "POST",
               url: url,
               data: {eids:eids},
               dataType: 'json',
               success: function(o)
               {
                 reload_calendar();
               }
            });


            /*jQuery.ajax({
                //url: base_url + 'event/filter_events/',
                url: base_url + 'event/filter_events/',
                type: 'post',
                // dataType: 'json',
                data: 'employee_id=' + $(this).val(),
                // beforeSend: function() {
                //     jQuery('.tiva-calendar').html('<div class="loading"><img src="images/temp/loading.gif" /></div>');
                // },
                success: function (response) {

                    console.log(response);

                    $("#calendar").css('opacity', '1');
                    $("#calendar").attr('disabled', false);

                    var calendarEl = document.getElementById('calendar');
                    var timeZoneSelectorEl = document.getElementById('time-zone-selector');

                    $(calendarEl).empty();

                    render_calender(calendarEl, timeZoneSelectorEl, JSON.parse(response));
                }
            });*/
        });

        $('#select-employee').multiselect({
            enableFiltering: true,
            includeSelectAllOption: true,
            buttonWidth: '480px',
            selectAllValue: 'multiselect-all',
        });

        multiselect_selectAll($('#select-employee'));
        function multiselect_selectAll($el) {
            $('option', $el).each(function(element) {
              $el.multiselect('select', $(this).val());
            });
        }

        // $(document).on('submit', '#frm_calender_filter_events', function(e) {

        //     e.preventDefault();


        // });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var timeZoneSelectorEl = document.getElementById('time-zone-selector');
        var events = <?php echo json_encode($events) ?>;
        var customer_events = <?php echo json_encode($resources_user_events) ?>

        render_calender(calendarEl, timeZoneSelectorEl, events);
    });

    function reload_calendar(){
        var calendarEl = document.getElementById('calendar');
        var timeZoneSelectorEl = document.getElementById('time-zone-selector');
        var events = <?php echo json_encode($events) ?>;
        var customer_events = <?php echo json_encode($resources_user_events) ?>

        render_calender(calendarEl, timeZoneSelectorEl, events);

        //location.reload();  
    }


    function render_calender(calendarEl, timeZoneSelectorEl, events) {
        var bc_events_url    = base_url + "calendar/_get_main_calendar_events";
        var bc_resources_url = base_url + "calendar/_get_main_calendar_resources";
        var bc_resource_users_url    = base_url + "calendar/_get_main_calendar_resource_users";
        var scrollTime = moment().format("HH") + ":00:00";

        calendar = new FullCalendar.Calendar(calendarEl, {
           schedulerLicenseKey: '0531798248-fcs-1598103289',
            headerToolbar: {
            center: 'employeeTimeline,monthView,dayView,threeDaysView,weekView,listView' // buttons for switching between views
          },
          themeSystem : 'bootstrap',
          eventDisplay: 'block',
          contentHeight: 750,
          initialView: 'threeDaysView',
          views: {
            employeeTimeline: {
              type: 'resourceTimeGridDay',
              buttonText: 'Employee',
              allDaySlot: false,
              nowIndicator: true,
              slotDuration: '00:15',
              slotLabelInterval : '01:00',
              scrollTime: scrollTime
            },            
            dayView: {
              type: 'timeGridDay',
              nowIndicator: true,
              allDaySlot: false,
              buttonText: 'Day',
              slotDuration: '00:15',
              slotLabelInterval : '01:00'
            },
            monthView: {
              type: 'dayGridMonth',
              buttonText: 'Month'
            },
            weekView: {
              type: 'timeGridWeek',
              buttonText: 'Week',
              allDaySlot: false,
              slotDuration: '00:15',
              slotLabelInterval : '01:00'
            },
            listView: {
              type: 'listWeek',
              buttonText: 'List'
            },
            threeDaysView: {
              type: 'resourceTimeGrid',                
              //type: 'timeGrid',
              datesAboveResources: true,
              allDaySlot: false,
              slotLabelFormat: [
                { hour: 'numeric', minute: 'numeric', meridiem: true }
              ],
              nowIndicator: true,
              expandRows: true,
              buttonText: '3 days',
              duration: { days: 3 },              
              slotDuration: '00:15',
              slotLabelInterval : '01:00',
              scrollTime: scrollTime
            },
            displayEventEnd: true,
            allDaySlot: false,
            //timeFormat: 'h(:mm)a'
          }, 
          dayCellDidMount(info) {
           $(info.el).find('.fc-daygrid-day-top').popover({               
               placement: 'top',
               trigger: 'hover',
               container: 'body',
               html:true,
               content: '<i class="fa fa-plus"></i> Create an Appointment',
           });

           $('.fc-timegrid-slot:before').popover({               
               placement: 'left',
               trigger: 'hover',
               container: 'body',
               html:true,
               content: '<i class="fa fa-plus"></i> Create an Appointment',
           });
          },   
          selectable: true,
          select: function(info) {
            //console.log(info);
            //alert('selected ' + info.startStr + ' to ' + info.endStr);
            let result = info.hasOwnProperty('resource');
            if( result ){
                var user_id = info.resource._resource.id;
                user_id     = user_id.replace("user", "");
                var user_name = info.resource._resource.extendedProps.employee_name;
            }else{
                var user_id = 0;
                var user_name = '';
            }
            
            
            if( user_id > 0 ){
                var $newOption = $("<option selected='selected'></option>").val(user_id).text(user_name) 
                $("#appointment-user").append($newOption).trigger('change');
            }else{
                $("#appointment-user").empty().trigger('change');
            }            
            
            $(".appointment-date").val(moment(info.startStr).format('dddd, MMMM DD, YYYY'));
            $(".appointment-time").val(moment(info.startStr).format('hh:mm A'));            
            $("#appointment-customer").empty().trigger('change');
            $("#appointment-tags").empty().trigger('change');
            $("#modal-create-appointment").modal('show');
          },
          slotEventOverlap: false,
          /*dayCellDidMount: function(info) {
                info.el.prepend("test");
          },*/
          /*dayRender: function (date, cell) {
              cell.append("<span class='hoverEffect' style='display:none;'>+</span>");
              cell.mouseenter(function() {
                  cell.find(".hoverEffect").show();
                  cell.css("background", "rgba(0,0,0,.1)");
              }).mouseleave(function() {
                  $(".hoverEffect").hide();
                  cell.removeAttr('style');
              });
          },*/
          resourceLabelDidMount: function(info) {
            //console.log(info);
            let img = document.createElement('img');
            img.src = info.resource.extendedProps.imageurl;
            img.setAttribute("class", "datagrid-image");
            info.el.prepend(img);
          },
          eventContent: function(eventInfo) {
            return { html: eventInfo.event.extendedProps.customHtml }
          },
          /*eventRender: function (event, element) {
                alert(event.title);
                  element.find('.fc-event-title').html(event.title);
              },*/
          defaultDate: "<?php echo date('Y-m-d'); ?>",
          editable: true,
          droppable: true, // this allows things to be dropped onto the calendar
          drop: function(arg) {
           //console.log(arg);
           //console.log(arg.draggedEl.dataset.event);

           var url  = base_url + "calendar/_update_calendar_drop_waitlist";
           var wid  = arg.draggedEl.dataset.event;
           var start_date = moment(arg.date).format('dddd, MMMM DD, YYYY hh:mm A');
           var user_id = 0;

            if(arg.hasOwnProperty('resource')){
                if( arg.resource != null ){
                    var user_id = arg.resource._resource.id;
                    user_id     = user_id.replace("user", "");
                }
            }

            $.ajax({
               type: "POST",
               url: url,
               data: {wid:wid, start_date:start_date, user_id:user_id},
               dataType: 'json',
               success: function(o)
               {
                 if( o.is_error == 1 ){
                  Swal.fire({
                    icon: 'error',
                    title: 'Cannot update wait list',
                    text: o.msg
                  });
                  //arg.draggedEl.parentNode.removeChild(arg.draggedEl);                  
                 }else{
                    Swal.fire({
                      title: 'Success',
                      text: 'Appointment was successfully created.',
                      icon: 'success',
                      showCancelButton: false,
                      confirmButtonColor: '#32243d',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Ok'
                    });

                    reload_calendar();
                    load_wait_list();
                 }
               }
            });
          },
          eventDrop: function(info) {
              console.log(info);
              //alert(info.event.extendedProps.eventType);
              //alert(info.event.title + " was dropped on " + info.event.start.toDateString());

                let result = info.hasOwnProperty('newResource');
                if( result.newResource != null ){
                    var user_id = info.newResource._resource.id;
                    user_id     = user_id.replace("user", "");
                }else{
                    var user_id = 0;
                }

              if( info.event.extendedProps.eventType != 'google_events' ){
                var start_date = moment(info.event.start).format('dddd, MMMM DD, YYYY HH:mm:ss');
                if( info.event.end !== null ){
                  var end_date = moment(info.event.end).format('dddd, MMMM DD, YYYY HH:mm:ss');
                }else{
                  var end_date    = start_date;
                }
                
                var event_id   = info.event.extendedProps.eventId;
                var event_type = info.event.extendedProps.eventType;
                var url        = base_url + 'calendar/_update_drop_event';
                
                $.ajax({
                   type: "POST",
                   url: url,
                   data: {event_id:event_id,event_type:event_type,start_date:start_date,end_date:end_date,user_id:user_id},
                   dataType: 'json',
                   success: function(o)
                   {

                   }
                });
              }else{                
                var start_date = moment(info.event.start).format('dddd, MMMM DD, YYYY');
                if( info.event.end !== null ){
                  var end_date = moment(info.event.end).format('dddd, MMMM DD, YYYY');
                }else{
                  var end_date    = start_date;
                }
                
                var event_id    = info.event.extendedProps.geventID;
                var calendar_id = info.event.extendedProps.calendarID;
                var url         = base_url + 'calendar/_update_drop_google_event';
                $.ajax({
                   type: "POST",
                   url: url,
                   data: {event_id:event_id,calendar_id:calendar_id,start_date:start_date,end_date:end_date},
                   dataType: 'json',
                   success: function(o)
                   {
                     if( o.is_success == false ){
                      Swal.fire({
                        icon: 'error',
                        title: 'This calendar is read-only. Cannot change start and end date.',
                        text: o.msg
                      });
                      info.revert();
                     }
                   }
                });
              }
            },
            navLinks: true, // can click day/week names to navigate views
            eventLimit: true, // allow "more" link when too many events
            events: events,
            eventClick: function (arg) {
                var apiUrl = '';
                var isGet  = 1;
                if (typeof arg.event._def.extendedProps.eventId != 'undefined') {
                    //alert(arg.event._def.extendedProps.eventType);
                    if( arg.event._def.extendedProps.eventType == 'jobs' ){
                        location.href = base_url + 'job/job_preview/' + arg.event._def.extendedProps.eventId;
                    }else if(arg.event._def.extendedProps.eventType == 'booking' ){
                        location.href = base_url + 'promote/view_booking/' + arg.event._def.extendedProps.eventId;
                    }else if( arg.event._def.extendedProps.eventType == 'appointments' ){
                        viewAppointment(arg.event._def.extendedProps.eventId);
                    }else{
                        location.href = base_url + 'events/event_preview/' + arg.event._def.extendedProps.eventId;
                    }
                }else if( typeof arg.event._def.extendedProps.geventID != 'undefined' ){
                  window.open(
                    arg.event._def.extendedProps.googleCalendarLink,
                    '_blank' // <- This is what makes it open in a new window.
                  );
                }
            },
            loading: function (isLoading) {
              if (isLoading) {
                  $(".left-calendar-loading").html('<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" style="display:inline;" /> Loading Events...</div>');
              }
              else {
                  $(".left-calendar-loading").html('');
              }

            },
            resourceAreaColumns: [
              {
                field: 'title',
                headerContent: 'Employees'
              }
            ],
            resources: {
                url: bc_resource_users_url,
                method: 'POST'
            },
            events: {
              url: bc_events_url,
              method: 'POST'

            },
            eventOrder: ["starttime"]
        });

        calendar.render();

        // load the list of available timezones, build the <select> options
        // it's HIGHLY recommended to use a different library for network requests, not this internal util func
        FullCalendar.requestJson('GET', base_url + 'packages/fullcalendar/examples/php/get-time-zones.php', {}, function (timeZones) {

            timeZones.forEach(function (timeZone) {
                var optionEl;

                if (timeZone !== 'UTC') { // UTC is already in the list
                    optionEl = document.createElement('option');
                    optionEl.value = timeZone;
                    optionEl.innerText = timeZone;
                    timeZoneSelectorEl.appendChild(optionEl);
                }
            });

        }, function () {

            // get_employee_dropdown();
            // TODO: handle error
        });

        // when the timezone selector changes, dynamically change the calendar option
        timeZoneSelectorEl.addEventListener('change', function () {
            calendar.setOption('timeZone', this.value);
        });
    }

    // add the responsive classes after page initialization
    window.onload = function () {
        $('.fc-toolbar.fc-header-toolbar').addClass('row col-lg-12');
    };

    // add the responsive classes when navigating with calendar buttons
    $(document).on('click', '.fc-button', function(e) {
        $('.fc-toolbar.fc-header-toolbar').addClass('row col-lg-12');
    });
</script>


<script>
  $(".btn-calendar-list").click(function(){
    if( $(".clist-icon").hasClass("fa-plus") ){
      $(".public-calendar-list").slideDown();
      $(".clist-icon").removeClass("fa-plus");
      $(".clist-icon").addClass("fa-minus");
    }else{
      $(".public-calendar-list").slideUp();
      $(".clist-icon").removeClass("fa-minus");
      $(".clist-icon").addClass("fa-plus");
    }
  });

  $(".btn-mini-calendar").click(function(){
    if( $(".cmini-icon").hasClass("fa-plus") ){
      $(".min-calendar-container").slideDown();
      $(".cmini-icon").removeClass("fa-plus");
      $(".cmini-icon").addClass("fa-minus");
    }else{
      $(".min-calendar-container").slideUp();
      $(".cmini-icon").removeClass("fa-minus");
      $(".cmini-icon").addClass("fa-plus");
    }
  });

  $(".btn-contacts-list").click(function(){
    if( $(".contact-list-icon").hasClass("fa-plus") ){
      $(".recent-contacts-container").slideDown();
      $(".contact-list-icon").removeClass("fa-plus");
      $(".contact-list-icon").addClass("fa-minus");
    }else{
      $(".recent-contacts-container").slideUp();
      $(".contact-list-icon").removeClass("fa-minus");
      $(".contact-list-icon").addClass("fa-plus");
    }
  });

  $(".btn-wait-list").click(function(){
    if( $(".wait-list-icon").hasClass("fa-plus") ){
      $(".wait-list-container").slideDown();
      $(".wait-list-icon").removeClass("fa-plus");
      $(".wait-list-icon").addClass("fa-minus");
    }else{
      $(".wait-list-container").slideUp();
      $(".wait-list-icon").removeClass("fa-minus");
      $(".wait-list-icon").addClass("fa-plus");
    }
  });

  $(".btn-add-gevent").click(function(){
    var gid = $(this).attr("data-id");

    $("#gevent_gcid").val(gid);
    $("#modalCreateGoogleEvent").modal('show');
    $('#create-google-event').trigger("reset");
  });

  $(".btn-add-gcalendar").click(function(){
    $("#modalCreateGoogleCalendar").modal('show');
    $('#create-google-calendar').trigger("reset");
  });

  $('.default-datepicker').datepicker({
      format: 'yyyy-mm-dd',      
      autoclose: true,
  });

  $('.appointment-datepicker').datepicker({
      //format: 'yyyy-mm-dd',
      format: 'DD, MM dd, yyyy',
      autoclose: true,
  });

  $('.appointment-time').timepicker({'timeFormat': 'h:i A'});

  $("#btn-create-google-event").click(function(){
    var msg = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" style="display:inline-block;" /> Saving...</div>';
    var url = base_url + '/calendar/_create_google_event';
        $(".create-gevent-validation-error").html(msg);
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: $("#create-google-event").serialize(),
               dataType: 'json',
               success: function(o)
               {


                  if( o.is_success ){
                    var msg = "<div class='alert alert-success'>"+ o.message +"</div>";
                    $(".create-gevent-validation-error").html(msg);

                    $("#modalCreateGoogleEvent").modal("hide");

                    //Reload calendar
                    load_calendar();
                    var calendarEl = document.getElementById('calendar');
                    var timeZoneSelectorEl = document.getElementById('time-zone-selector');
                    render_calender(calendarEl, timeZoneSelectorEl);
                  }else{
                    var msg = "<div class='alert alert-danger'>"+ o.message +"</div>";
                    $(".create-gevent-validation-error").html(msg);
                  }
               }
            });
        }, 1000);
  });

  $("#btn-create-google-calendar").click(function(){
    var msg = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" style="display:inline-block;" /> Saving...</div>';
        var url = base_url + '/calendar/_create_google_calendar';
        $(".create-gcalendar-validation-error").html(msg);
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: $("#create-google-calendar").serialize(),
               dataType: 'json',
               success: function(o)
               {
                  if( o.is_success ){
                    var msg = "<div class='alert alert-success'>"+ o.message +"</div>";
                    $(".create-gcalendar-validation-error").html(msg);

                    location.reload();

                  }else{
                    var msg = "<div class='alert alert-danger'>"+ o.message +"</div>";
                    $(".create-gcalendar-validation-error").html(msg);
                  }
               }
            });
        }, 1000);
  });

    $(".btn-right-nav-hide-show").click(function(){
        if( $(this).hasClass("show-right") ){
            $(this).removeClass("show-right");
            $(this).addClass("hide-right");

            $(".left-col").removeClass('col-md-9');
            $(".left-col").addClass('col-md-12');
            $(".right-col").hide();

        }else{
            $(this).removeClass("hide-right");
            $(this).addClass("show-right");

            $(".left-col").removeClass('col-md-12');
            $(".left-col").addClass('col-md-9');
            $(".right-col").show();
        }
    });

    $('#print-calender').click(function(){
        var defaultView = calendar.view.type;
        var defaultDate = calendar.view.type;

        window.open("<?php echo base_url('workcalender/print_calender') ?>"+'?default_view='+defaultView, '_blank');
        //+'&default_date='+defaultDate;
    });

    $(".chk-calendar-entries").change(function(){
        var cid = $(this).attr("data-id");
        var url = base_url + '/settings/_update_enabled_google_calendar';
        if ($(this).is(':checked')) {
            var show_calendar = 1;
        }else{
            var show_calendar = 0;
        }

        $.ajax({
           type: "POST",
           url: url,
           data: {cid:cid, show_calendar:show_calendar},
           success: function(o)
           {
              var calendarEl = document.getElementById('calendar');
              var timeZoneSelectorEl = document.getElementById('time-zone-selector');
              render_calender(calendarEl, timeZoneSelectorEl);
           }
        });
    });

    $(".chk-calendar-mini-entries").change(function(){
        var cid = $(this).attr("data-id");
        var url = base_url + '/settings/_update_enabled_google_mini_calendar';

        $('.chk-calendar-mini-entries').not(this).prop('checked', false);

        $.ajax({
           type: "POST",
           url: url,
           data: {cid:cid},
           success: function(o)
           {
              load_calendar();
           }
        });
    });

    function load_calendar(){
        var events_url = base_url + "settings/_get_google_enabled_calendars";
        var calendarEl = document.getElementById('right-calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
          schedulerLicenseKey: '0531798248-fcs-1598103289',
          initialView: 'dayGridMonth',
          events: {
            url: events_url,
            method: 'POST'
          },
          loading: function (isLoading) {
            if (isLoading) {
                $(".right-calendar-loading").html('<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" style="display:inline;" /> Loading Events...</div>');
            }
            else {
                $(".right-calendar-loading").html('');
            }

          },
          eventDidMount: function(info) {
            var tooltip = new Tooltip(info.el, {
              title: info.event.extendedProps.description,
              placement: 'top',
              trigger: 'hover',
              html:true,
              container: '.calendar-tooltip'
            });
          },
        });

        calendar.render();
    }

    load_calendar();

    $(".btn-create-event").click(function(){
      location.href = base_url + "events/new_event";
    });

    $('#gevent-start-time').datetimepicker({
       format: 'LT',
       allowInputToggle: true
    });

    $('#gevent-end-time').datetimepicker({
       format: 'LT',
       allowInputToggle: true
    });

    $('#google-business-customer').select2({
        ajax: {
            url: base_url + 'customer/json_dropdown_customer_list',
            dataType: 'json',
            delay: 250,
            data: function (params) {
              return {
                q: params.term, // search term
                page: params.page
              };
            },
            processResults: function (data, params) {
              // parse the results into the format expected by Select2
              // since we are using custom formatting functions we do not need to
              // alter the remote JSON data, except to indicate that infinite
              // scrolling can be used
              params.page = params.page || 1;

              return {
                results: data,
                // pagination: {
                //   more: (params.page * 30) < data.total_count
                // }
              };
            },
            cache: true
          },
          placeholder: 'Select customer',
          minimumInputLength: 0,
          templateResult: formatRepo,
          templateSelection: formatRepoSelection
    });

    $('#appointment-user').select2({
        ajax: {
            url: base_url + 'autocomplete/_company_users',
            dataType: 'json',
            delay: 250,
            data: function (params) {
              return {
                q: params.term, // search term
                page: params.page
              };
            },
            processResults: function (data, params) {
              // parse the results into the format expected by Select2
              // since we are using custom formatting functions we do not need to
              // alter the remote JSON data, except to indicate that infinite
              // scrolling can be used
              params.page = params.page || 1;

              return {
                results: data,
                // pagination: {
                //   more: (params.page * 30) < data.total_count
                // }
              };
            },
            formatResult: function(item){ 
                //console.log(item);
                return '<div>'+item.FName + ' ' + item.LName +'<br /><small>'+item.email+'</small></div>';
            },
            cache: true
          },
          placeholder: 'Select User',
          minimumInputLength: 0,
          templateResult: formatRepoUser,
          templateSelection: formatRepoSelectionUser
    });

    $('#wait-list-appointment-user').select2({
        ajax: {
            url: base_url + 'autocomplete/_company_users',
            dataType: 'json',
            delay: 250,
            data: function (params) {
              return {
                q: params.term, // search term
                page: params.page
              };
            },
            processResults: function (data, params) {
              // parse the results into the format expected by Select2
              // since we are using custom formatting functions we do not need to
              // alter the remote JSON data, except to indicate that infinite
              // scrolling can be used
              params.page = params.page || 1;

              return {
                results: data,
                // pagination: {
                //   more: (params.page * 30) < data.total_count
                // }
              };
            },
            formatResult: function(item){ 
                //console.log(item);
                return '<div>'+item.FName + ' ' + item.LName +'<br /><small>'+item.email+'</small></div>';
            },
            cache: true
          },
          placeholder: 'Select User',
          minimumInputLength: 0,
          templateResult: formatRepoUser,
          templateSelection: formatRepoSelectionUser
    });

    $('#appointment-customer').select2({
        ajax: {
            url: base_url + 'autocomplete/_company_customer',
            dataType: 'json',
            delay: 250,
            data: function (params) {
              return {
                q: params.term, // search term
                page: params.page
              };
            },
            processResults: function (data, params) {
              // parse the results into the format expected by Select2
              // since we are using custom formatting functions we do not need to
              // alter the remote JSON data, except to indicate that infinite
              // scrolling can be used
              params.page = params.page || 1;

              return {
                results: data,
                // pagination: {
                //   more: (params.page * 30) < data.total_count
                // }
              };
            },
            cache: true
          },
          placeholder: 'Select Customer',
          minimumInputLength: 0,
          templateResult: formatRepoCustomer,
          templateSelection: formatRepoCustomerSelection
    });

    $('#wait-list-appointment-customer').select2({
        ajax: {
            url: base_url + 'autocomplete/_company_customer',
            dataType: 'json',
            delay: 250,
            data: function (params) {
              return {
                q: params.term, // search term
                page: params.page
              };
            },
            processResults: function (data, params) {
              // parse the results into the format expected by Select2
              // since we are using custom formatting functions we do not need to
              // alter the remote JSON data, except to indicate that infinite
              // scrolling can be used
              params.page = params.page || 1;

              return {
                results: data,
                // pagination: {
                //   more: (params.page * 30) < data.total_count
                // }
              };
            },
            cache: true
          },
          placeholder: 'Select Customer',
          minimumInputLength: 0,
          templateResult: formatRepoCustomer,
          templateSelection: formatRepoCustomerSelection
    });

    $('#appointment-tags').select2({
        ajax: {
            url: base_url + 'autocomplete/_company_event_tags',
            dataType: 'json',
            delay: 250,
            data: function (params) {
              return {
                q: params.term, // search term
                page: params.page
              };
            },
            processResults: function (data, params) {
              // parse the results into the format expected by Select2
              // since we are using custom formatting functions we do not need to
              // alter the remote JSON data, except to indicate that infinite
              // scrolling can be used
              params.page = params.page || 1;

              return {
                results: data,
                // pagination: {
                //   more: (params.page * 30) < data.total_count
                // }
              };
            },
            cache: true
          },
          placeholder: 'Select Tags',
          minimumInputLength: 0,
          templateResult: formatRepoTag,
          templateSelection: formatRepoTagSelection
    });

    $('#wait-list-appointment-tags').select2({
        ajax: {
            url: base_url + 'autocomplete/_company_event_tags',
            dataType: 'json',
            delay: 250,
            data: function (params) {
              return {
                q: params.term, // search term
                page: params.page
              };
            },
            processResults: function (data, params) {
              // parse the results into the format expected by Select2
              // since we are using custom formatting functions we do not need to
              // alter the remote JSON data, except to indicate that infinite
              // scrolling can be used
              params.page = params.page || 1;

              return {
                results: data,
                // pagination: {
                //   more: (params.page * 30) < data.total_count
                // }
              };
            },
            cache: true
          },
          placeholder: 'Select Tags',
          minimumInputLength: 0,
          templateResult: formatRepoTag,
          templateSelection: formatRepoTagSelection
    });

    function formatRepoTagSelection(repo) {
        if( repo.name != null ){
            return repo.name;      
        }else{
            return repo.text;
        }
      
    }

    function formatRepoCustomerSelection(repo) {
        if( repo.first_name != null ){
            return repo.first_name + ' ' + repo.last_name;      
        }else{
            return repo.text;
        }
      
    }

    function formatRepoTag(repo) {
      if (repo.loading) {
        return repo.text;
      }

      var $container = $(
        '<div><div class="autocomplete-left"><img class="autocomplete-img" src="'+repo.img_marker+'" /></div><div class="autocomplete-right">'+repo.name +'</div></div>'
      );

      return $container;
    }

    function formatRepoUser(repo) {
      if (repo.loading) {
        return repo.text;
      }

      var $container = $(
        '<div><div class="autocomplete-left"><img class="autocomplete-img" src="'+repo.user_image+'" /></div><div class="autocomplete-right">'+repo.FName + ' ' + repo.LName +'<br /><small>'+repo.email+'</small></div></div>'
      );

      return $container;
    }

    function formatRepoCustomer(repo) {
      if (repo.loading) {
        return repo.text;
      }

      var $container = $(
        '<div>'+repo.first_name + ' ' + repo.last_name +'<br /><small>'+repo.phone_h+' / '+repo.email+'</small></div>'
      );

      return $container;
    }

    $('#google-assign-users').select2({
        ajax: {
            url: base_url + 'users/json_dropdown_user_list',
            dataType: 'json',
            delay: 250,
            data: function (params) {
              return {
                q: params.term, // search term
                page: params.page
              };
            },
            processResults: function (data, params) {
              // parse the results into the format expected by Select2
              // since we are using custom formatting functions we do not need to
              // alter the remote JSON data, except to indicate that infinite
              // scrolling can be used
              params.page = params.page || 1;

              return {
                results: data,
                // pagination: {
                //   more: (params.page * 30) < data.total_count
                // }
              };
            },
            cache: true
          },
          placeholder: 'Select user',
          minimumInputLength: 0,
          templateResult: formatRepoUser,
          templateSelection: formatRepoSelectionUser
    });

    load_upcoming_events();
    load_scheduled_estimates();
    load_upcoming_jobs();

    function load_upcoming_events(){
      var url = base_url + 'calendar/_load_upcoming_events';
       $("#upcoming-events-container").html('<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" style="display:inline;" /> Loading Upcoming Events...</div>');

      $.ajax({
         type: "POST",
         url: url,
         data: {},
         success: function(o)
         {
            $("#upcoming-events-container").html(o);
         }
      });
    }

    function load_scheduled_estimates(){
      var url = base_url + 'estimate/_load_scheduled_estimates';
       $("#scheduled-estimates-container").html('<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" style="display:inline;" /> Loading Estimates...</div>');

      $.ajax({
         type: "POST",
         url: url,
         data: {},
         success: function(o)
         {
            $("#scheduled-estimates-container").html(o);
         }
      });
    }

    function load_upcoming_jobs(){
      var url = base_url + 'job/_load_upcoming_jobs';
       $("#upcoming-jobs-container").html('<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" style="display:inline;" /> Loading Upcoming Jobs...</div>');

      $.ajax({
         type: "POST",
         url: url,
         data: {},
         success: function(o)
         {
            $("#upcoming-jobs-container").html(o);
         }
      });
    }

    $("#frm-create-appointment").submit(function(e){
        e.preventDefault();

        var url = base_url + 'calendar/_create_appointment';
        $(".btn-create-appointment").html('<span class="spinner-border spinner-border-sm m-0"></span> Saving');
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               dataType: "json",
               data: $("#frm-create-appointment").serialize(),
               success: function(o)
               {
                  if( o.is_success ){
                      $("#modal-create-appointment").modal('hide');
                      Swal.fire({
                          title: 'Success',
                          text: 'Appointment was successfully created.',
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonColor: '#32243d',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'Ok'
                      }).then((result) => {
                          if (result.value) {
                            reload_calendar();
                          }
                      });
                  }else{
                      Swal.fire({
                        icon: 'error',
                        title: 'Cannot save data.',
                        text: o.msg
                      });
                  }

                  $(".btn-create-appointment").html('Schedule');
               }
            });
        }, 1000);
    });

    $(".btn-set-as-appointment").click(function(){
        Swal.fire({
          title: 'Move selected wait list to calendar?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Set as Appointment',
          confirmButtonColor: '#32243d'
        }).then((result) => {          
          if (result.isConfirmed) {
            $("#w_is_wait_list").val(0);
            $("#frm-update-appointment-wait-list").submit();
          } 
        });
    });

    $("#frm-create-appointment-wait-list").submit(function(e){
        e.preventDefault();

        var url = base_url + 'calendar/_create_appointment_wait_list';
        $(".btn-create-appointment-wait-list").html('<span class="spinner-border spinner-border-sm m-0"></span> Saving');
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               dataType: "json",
               data: $("#frm-create-appointment-wait-list").serialize(),
               success: function(o)
               {
                  if( o.is_success ){
                      $("#modal-create-appointment").modal('hide');
                      Swal.fire({
                          title: 'Success',
                          text: 'Appointment wait list was successfully created.',
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonColor: '#32243d',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'Ok'
                      }).then((result) => {
                          if (result.value) {
                            $("#modal-create-wait-list").modal('hide');
                            load_wait_list();
                          }
                      });
                  }else{
                      Swal.fire({
                        icon: 'error',
                        title: 'Cannot save data.',
                        text: o.msg
                      });
                  }

                  $(".btn-create-appointment-wait-list").html('Schedule');
               }
            });
        }, 1000);
    });

    $("#frm-update-appointment").submit(function(e){
        e.preventDefault();

        var url = base_url + 'calendar/_update_appointment';
        $(".btn-update-appointment").html('<span class="spinner-border spinner-border-sm m-0"></span> Saving');
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               dataType: "json",
               data: $("#frm-update-appointment").serialize(),
               success: function(o)
               {
                  if( o.is_success ){
                      $("#modal-edit-appointment").modal('hide');
                      Swal.fire({
                          title: 'Success',
                          text: 'Appointment was successfully updated.',
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonColor: '#32243d',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'Ok'
                      }).then((result) => {
                          if (result.value) {                            
                            reload_calendar();
                          }
                      });
                  }else{
                      Swal.fire({
                        icon: 'error',
                        title: 'Cannot find data.',
                        text: o.msg
                      });
                  }

                  $(".btn-update-appointment").html('Update');
               }
            });
        }, 1000);
    });

    function viewAppointment( appointment_id ){
        var url = base_url + 'calendar/_view_appointment';

        $("#modal-view-appointment").modal('show');
        $(".view-appointment-actions").hide();
        $(".btn-checkout-appointment").show();
        $(".btn-edit-appointment").show();
        $(".btn-payment-details-appointment").hide();

        $(".view-appointment-container").html('<span class="spinner-border spinner-border-sm m-0"></span>');
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: {appointment_id:appointment_id},
               success: function(o)
               {
                    $(".btn-edit-appointment").attr("data-id", appointment_id);
                    $(".btn-delete-appointment").attr("data-id", appointment_id);
                    $(".btn-checkout-appointment").attr("data-id", appointment_id);
                    $(".btn-payment-details-appointment").attr("data-id", appointment_id);
                    
                    $('.view-appointment-container').hide().html(o).fadeIn(800);
               }
            });
        }, 800);
    }

    $(".btn-delete-appointment-waitlist").click(function(){
        Swal.fire({
          title: 'Do you want to delete selected wait list?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Delete',
          confirmButtonColor: '#ec4561'
        }).then((result) => {          
          if (result.isConfirmed) {
            var url = base_url + 'calendar/_delete_appointment';
            var appointment_id = $(this).attr('data-id');

            $.ajax({
               type: "POST",
               url: url,
               dataType: 'json',
               data: {appointment_id:appointment_id},
               success: function(o)
               {     
                    if( o.is_success ){
                        Swal.fire({
                          title: 'Success',
                          text: 'Wait list was successfully deleted.',
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonColor: '#32243d',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'Ok'
                        }).then((result) => {
                          if (result.value) {
                            load_wait_list();
                          }
                        });
                        $("#modal-edit-wait-list").modal('hide');
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Cannot find data.',
                            text: o.msg
                        });
                    }            
               }
            });
          } 
        });
    });

    $(".btn-delete-appointment").click(function(){
        Swal.fire({
          title: 'Do you want to delete selected appointment?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Delete',
          confirmButtonColor: '#ec4561'
        }).then((result) => {          
          if (result.isConfirmed) {
            var url = base_url + 'calendar/_delete_appointment';
            var appointment_id = $(this).attr('data-id');

            $.ajax({
               type: "POST",
               url: url,
               dataType: 'json',
               data: {appointment_id:appointment_id},
               success: function(o)
               {     
                    if( o.is_success ){
                        $('#modal-view-appointment').modal('hide');
                        Swal.fire({
                          title: 'Success',
                          text: 'Appointment was successfully deleted.',
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonColor: '#32243d',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'Ok'
                        }).then((result) => {
                          if (result.value) {
                            reload_calendar();
                          }
                        });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Cannot find data.',
                            text: o.msg
                        });
                    }            
               }
            });
          } 
        });
    });

    $(".btn-edit-appointment").click(function(){
        var appointment_id = $(this).attr('data-id');

        $("#edit-aid").val(appointment_id);
        $("#modal-view-appointment").modal('hide');
        $("#modal-edit-appointment").modal('show');

        var url = base_url + 'calendar/_edit_appointment';

        $(".edit-appointment-container").html('<span class="spinner-border spinner-border-sm m-0"></span>');
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: {appointment_id:appointment_id},
               success: function(o)
               {

                    $('.edit-appointment-container').hide().html(o).fadeIn(800);
               }
            });
        }, 800);
    });

    function load_wait_list(){
        var url = base_url + 'calendar/_load_wait_list';
        $(".wait-list").html('<span class="spinner-border spinner-border-sm m-0"></span>');
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,               
               success: function(o)
               {

                    $('.wait-list').hide().html(o).fadeIn(800);
               }
            });
        }, 800);
    }

    load_wait_list();

    $(".btn-checkout-appointment").click(function(){
        var appointment_id = $(this).attr('data-id');

        $("#modal-checkout-appointment").modal('show');
        $("#modal-view-appointment").modal('hide');

        var url = base_url + 'calendar/_appointment_checkout';

        $(".checkoout-appointment-container").html('<span class="spinner-border spinner-border-sm m-0"></span>');
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: {appointment_id:appointment_id},
               success: function(o)
               {

                    $('.checkoout-appointment-container').hide().html(o).fadeIn(800);
               }
            });
        }, 800);
    });

    $('.field-popover').popover();
    $('#add-employee-popover').popover();
    $('#add-customer-popover').popover();
    $('#add-tag-popover').popover();
    $('#wait-list-add-employee-popover').popover();
    $('#wait-list-add-customer-popover').popover();
    $('#wait-list-add-tag-popover').popover();

    $(".btn-payment-details-appointment").click(function(){
        var appointment_id = $(this).attr('data-id');
        var url = base_url + 'calendar/_view_appointment_payment_details';

        $("#modal-view-appointment-payment-details").modal('show');
        $(".view-appointment-payment-details-container").html('<span class="spinner-border spinner-border-sm m-0"></span>');

        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: {appointment_id:appointment_id},
               success: function(o)
               {

                    $('.view-appointment-payment-details-container').hide().html(o).fadeIn(800);
               }
            });
        }, 800);
    });

    $(document).on('click', '.btn-add-item-row', function(){
        var url = base_url + 'items/_get_item_details';    
        var itemid = $(this).attr('data-id');

        $(this).html('<span class="spinner-border spinner-border-sm m-0"></span>');

        $.ajax({
           type: "POST",
           url: url,
           data: {itemid:itemid},
           dataType: 'json',
           success: function(o)
           {
              if( o.is_exists ){
                var item_price = parseFloat(o.item_price);
                var append_row = '<tr style="background: none !important;"><td style="width:55%;"><input type="text" class="form-control" name="item_name[]" placeholder="Item Name" value="'+o.item_name+'"><input type="hidden" name="item_id[]" value="'+o.item_id+'" /></td><td><input type="text" class="form-control item-price" name="price[]" placeholder="Item Price" value="'+item_price.toFixed(2)+'"></td><td><input type="text" class="form-control item-qty" name="qty[]" placeholder="Item Quantity" value="1"></td><td><input type="text" class="form-control item-tax" name="tax[]" placeholder="Tax Percentage" value="0.00"></td><td><input type="text" class="form-control item-discount" name="discount[]" placeholder="Item Discount" value="0.00"></td><td class="td-actions"><a href="javascript:void(0);" class="btn btn-sm btn-primary btn-item-delete"><i class="fa fa-trash"></i></a></td></tr>';

                $(".tbl-items tbody").append(append_row).find("tr:last").hide().fadeIn("slow");
                c_compute_totals();

              }else{
                Swal.fire({
                  icon: 'error',
                  title: 'Cannot find item.',
                  text: o.msg
                });
              }    

              $(".btn-add-item-row").html('<i class="fa fa-plus"></i>');
              $("#modal-checkout-items").modal('hide');
           }
        });
      });

    function onlinepayment_set_appointment_paid(payment_gateway, form_id){
        var url = base_url + 'calendar/_set_appointment_paid';
        
        $("#payment-method").val(payment_gateway);
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               dataType: "json",
               data: $("#"+form_id).serialize(),
               success: function(o)
               {    
                    if( o.is_success == 1 ){
                        Swal.fire({
                            title: 'Payment Completed!',
                            text: 'Appointment was successfully updated and marked as paid.',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#32243d',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value) {
                                reload_calendar();
                            }
                        });

                        $("#modal-checkout-appointment").modal('hide');
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Cannot update data.',
                            text: o.msg
                          });
                    }                    
               }
            });
        }, 500);
    }

    function c_compute_totals(){
        var total_price    = 0;
        var total_discount = 0;
        var total_amount   = 0;
        var total_tax = 0;
        var total_qty = 0;

        $('#frm-checkout-items .form-control').each(function(){
          var $el = $(this); // element we're testing
          var n   = parseFloat($el.val());

          if( $el.hasClass('item-price') ){        
            if ($.isNumeric(n)){
              var item_qty = parseFloat($el.closest('tr').find('.item-qty').val());
              if( item_qty > 0 ){
                total_price  = total_price + (parseFloat($el.val()) * item_qty);
              }else{
                total_price  = total_price + 0;
              }
            }
          }

          if( $el.hasClass('item-discount') ){        
            if ($.isNumeric(n)){
              total_discount = total_discount + parseFloat($el.val());
            }
          }

          if( $el.hasClass('item-tax') ){        
            if ($.isNumeric(n)){
              var item_price = parseFloat($el.closest('tr').find('.item-price').val());
              var item_qty   = parseFloat($el.closest('tr').find('.item-qty').val());
              var tax_amount = (parseFloat($el.val()) / 100) * (item_price * item_qty);              
              total_tax = total_tax + tax_amount;
            }
          }
        });

        total_amount = (parseFloat(total_price) - parseFloat(total_discount)) + parseFloat(total_tax);
        if( total_amount < 0 ){
            total_amount = 0;
        }

        $(".c-total-amount").text(parseFloat(total_amount).toFixed(2));
        $(".c-total-price").text(parseFloat(total_price).toFixed(2));
        $(".c-total-discount").text(parseFloat(total_discount).toFixed(2));
        $(".c-total-tax").text(parseFloat(total_tax).toFixed(2));
        $("#cash-amount-received").val(parseFloat(total_amount).toFixed(2));
        $("#converge-amount-received").val(parseFloat(total_amount).toFixed(2));
        $("#appointment-total-amount").val(parseFloat(total_amount).toFixed(2));
        $("#stripe-appointment-total-amount").val(parseFloat(total_amount).toFixed(2));

      }

      $(".btn-add-wait-list").click(function(){
        $("#modal-create-wait-list").modal('show');
      });

      $(document).on('click', '.btn-edit-waitlist', function(){
        var appointment_id = $(this).attr('data-id');
        var url = base_url + 'calendar/_load_edit_wait_list';    

        $("#modal-edit-wait-list").modal('show');

        $(".view-wait-list-container").html('<span class="spinner-border spinner-border-sm m-0"></span>');
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: {appointment_id:appointment_id},
               success: function(o)
               {
                $("#wid").val(appointment_id);
                $(".btn-delete-appointment-waitlist").attr("data-id", appointment_id);
                $('.view-wait-list-container').hide().html(o).fadeIn(800);
               }
            });
        }, 800);
      });

      $("#frm-update-appointment-wait-list").submit(function(e){
        e.preventDefault();

        var url = base_url + 'calendar/_update_appointment_wait_list';
        if( $("#w_is_wait_list").val() == 0 ){
            $(".btn-set-as-appointment").html('<span class="spinner-border spinner-border-sm m-0"></span>');
        }else{
            $(".btn-update-appointment-wait-list").html('<span class="spinner-border spinner-border-sm m-0"></span>');
        }
        
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               dataType: "json",
               data: $("#frm-update-appointment-wait-list").serialize(),
               success: function(o)
               {
                  if( o.is_success ){ 
                      if( o.is_wait_list == 0 ){
                        var swal_text = "Wait list was successfully moved to calendar."; 
                      }else{
                        var swal_text = "Appointment wait list was successfully updated.";
                      }

                      $("#modal-edit-wait-list").modal('hide');                     
                      Swal.fire({
                          title: 'Success',
                          text: swal_text,
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonColor: '#32243d',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'Ok'
                      }).then((result) => {
                          if (result.value) {                            
                            load_wait_list();
                          }
                      });
                  }else{
                      $("#w_is_wait_list").val(0);
                      Swal.fire({
                        icon: 'error',
                        title: 'Cannot save data.',
                        text: o.msg
                      });
                  }

                  $(".btn-set-as-appointment").html('<i class="fa fa-calendar"></i>  Set as Appointment');
                  $(".btn-update-appointment-wait-list").html('Update');
               }
            });
        }, 1000);
    });
</script>

