<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<style>
.btn-right-nav-hide-show{
    position: relative;
    left: 48%;
    top: -35px;
}
img.datagrid-image {
    width: 50px;
    height: 50px;
    border-radius: 50px;
    margin: 0 auto;
    object-fit: cover;
    margin-top: 10px;
}
a.calendar-profile-contact {
    color: black;
    position: relative;
    top: 2px;
    font-size: 16px;
    width: 39%;
    display: block;
    float: left;
}
a.calendar-profile-contact:hover {
    color: green;
}
.btn-calendar-small {
    font-size: 12px;
}
td.fc-datagrid-cell.fc-resource {
    text-align: center;
}
.right-col .fc-left{
    font-size: 10px;
}
.right-col .fc-left h2{
    margin-top: 10px;
    font-weight: 300;
}
span.calendar-email {
    font-size: 12px;
    position: relative;
    left: 3px;
}
#right-calendar{
    margin-top: 10px;
    padding: 10px;
}
img.calendar-user-profile {
    border-radius: 100px;
    object-fit: cover;
    position: relative;
    top: 6px;
}
a.top-1 {
  position: relative;
  top: 1px;
}
.dot {
  height: 25px;
  width: 25px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  padding: 2px;
  text-align: center;
  color:#ffffff;
}
.fc-button-group{
    margin: 15px 0;
}
.dot-red{
    background-color: #ff2a26;
}
.dot-green{
    background-color: #bee336;
}
.dot-yellow{
    background-color: #f7f016;
}
.dot-blue{
    background-color: #16b7f7;
}
.right-list-events li{
    text-align: left;
    margin: 5px;
    padding: 10px;
}
.right-filter-header, .left-header{
    font-size: 16px;
    text-align: left;
    background-color: #76828E;
    padding: 10px;
    color: #ffffff;
}
.list-group li{
    padding: 0px;
    margin-top: 20px;
    border: none;
}
.hide{
    display: none;
}

/*Tooltip*/
.tooltip-table td{
  text-align: left;
}
/*.fc .fc-scrollgrid, .fc .fc-scrollgrid table {
    width: 101% !important;
}*/
.tooltip{
  opacity: 1;
}
.calendar-tooltip .tooltip-inner{
  background: #0B92FB;
  color : #ffffff;
}
.calendar-tooltip .popper,.calendar-tooltip .tooltip {
    position: absolute;
    z-index: 9999;
    background: #0B92FB;
    color: #ffffff;
    width: auto;
    border-radius: 3px;
    box-shadow: 0 0 2px rgba(0,0,0,0.5);
    padding: 10px;
    text-align: center;
  }
  .calendar-tooltip .style5 .tooltip {
    background: #1E252B;
    color: #FFFFFF;
    max-width: 200px;
    width: auto;
    font-size: .8rem;
    padding: .5em 1em;
  }
  .calendar-tooltip .popper .popper__arrow,
  .calendar-tooltip .tooltip .tooltip-arrow {
    width: 0;
    height: 0;
    border-style: solid;
    position: absolute;
    margin: 5px;
  }

  .calendar-tooltip .tooltip .tooltip-arrow,
  .calendar-tooltip .popper .popper__arrow {
    border-color: #0B92FB;
  }
  .calendar-tooltip .style5 .tooltip .tooltip-arrow {
    border-color: #1E252B;
  }
  .calendar-tooltip .popper[x-placement^="top"],
  .calendar-tooltip .tooltip[x-placement^="top"] {
    margin-bottom: 5px;
  }
  .calendar-tooltip .popper[x-placement^="top"] .popper__arrow,
  .calendar-tooltip .tooltip[x-placement^="top"] .tooltip-arrow {
    border-width: 5px 5px 0 5px;
    border-left-color: transparent;
    border-right-color: transparent;
    border-bottom-color: transparent;
    bottom: -5px;
    left: calc(50% - 5px);
    margin-top: 0;
    margin-bottom: 0;
  }
  .calendar-tooltip .popper[x-placement^="bottom"],
  .calendar-tooltip .tooltip[x-placement^="bottom"] {
    margin-top: 5px;
  }
  .calendar-tooltip .tooltip[x-placement^="bottom"] .tooltip-arrow,
  .calendar-tooltip .popper[x-placement^="bottom"] .popper__arrow {
    border-width: 0 5px 5px 5px;
    border-left-color: transparent;
    border-right-color: transparent;
    border-top-color: transparent;
    top: -5px;
    left: calc(50% - 5px);
    margin-top: 0;
    margin-bottom: 0;
  }
  .calendar-tooltip .tooltip[x-placement^="right"],
  .calendar-tooltip .popper[x-placement^="right"] {
    margin-left: 5px;
  }
  .calendar-tooltip .popper[x-placement^="right"] .popper__arrow,
  .calendar-tooltip .tooltip[x-placement^="right"] .tooltip-arrow {
    border-width: 5px 5px 5px 0;
    border-left-color: transparent;
    border-top-color: transparent;
    border-bottom-color: transparent;
    left: -5px;
    top: calc(50% - 5px);
    margin-left: 0;
    margin-right: 0;
  }
  .calendar-tooltip .popper[x-placement^="left"],
  .calendar-tooltip .tooltip[x-placement^="left"] {
    margin-right: 5px;
  }
  .page-title {
    font-family: Sarabun, sans-serif !important;
    font-size: 1.75rem !important;
    font-weight: 600 !important;
  }
  .calendar-tooltip .popper[x-placement^="left"] .popper__arrow,
  .calendar-tooltip .tooltip[x-placement^="left"] .tooltip-arrow {
    border-width: 5px 0 5px 5px;
    border-top-color: transparent;
    border-right-color: transparent;
    border-bottom-color: transparent;
    right: -5px;
    top: calc(50% - 5px);
    margin-left: 0;
    margin-right: 0;
  }
  .right-calendar-loading{
    position: absolute;
    width: 50%;
    left: 28%;
    top: 217px;
    z-index: 99999;
  }
  .left-calendar-loading{
    position: absolute;
    width: 90%;
    left: 5%;
    top: 50%;
    z-index: 99999;
  }
  .right-calendar-loading .alert-info{
    border: 1px solid;
  }
  .right-calendar-loading img{
    display: inline-block;
    margin-right: 10px;
  }
  .fc .fc-toolbar-title {
  	font-size: 23px;
  }
  .btn-gcustom {
    min-width: 24px;
    padding: 0px 3px;
    min-height: 24px;
  }
  a.btn-gcustom i {
    position: relative;
    left: 1px;
    top: 2px;
  }
  .br-99 {
    border-radius: 99px;
  }
  .sc-bottom-2 {
    position: relative;
    bottom: 3px;
  }
  .pr-b10 {
    position: relative;
    bottom: 10px;
  }
  .p-40 {
    padding-top: 40px !important;
  }
  .p-20 {
    padding-top: 25px !important;
    padding-bottom: 25px !important;
    padding-right: 20px !important;
    padding-left: 20px !important;
  }
  .mt-40 {
    margin-top: 55px !important;
    border-radius: 5px;
  }
  @media only screen and (max-width: 600px) {
    .p-40 {
      padding-top: 0px !important;
    }
    .mt-40 {
      margin-top: 0px !important;
    }
    .pr-b10 {
      position: relative;
      bottom: 0px;
    }
  }
  @media screen and (max-width: 1190px) {
    div#calender_toolbar div {
        width: 100%;
    }
  }
  @media screen and (max-width: 1080px) {
    div.fc-toolbar-chunk div.btn-group {
      display: contents !important;
    }
  }
  @media screen and (max-width: 600px) {
    #calender_toolbar {
      display: block;
      margin-bottom: 0px;
    }
    .stcs-print.cs-float-print {
      width: 85px !important;
      float: left;
    }
    .stcs-1.cs-float {
        width: 60% !important;
        float: left !important;
    }
  }
  .fc-timeline-lane, .fc-resource {
    height: 102px;
  }
  #calendar .fc-direction-ltr .fc-timeline-slot {
    vertical-align: middle;
    text-align: center;
  }
  #calendar .fc-timeline-slot-cushion{
    margin: 0 auto;
  }
  .fc-daygrid-event:hover, .fc-timeline-event:hover{
    cursor: pointer;
  }
  .fc-datagrid-cell-cushion{
    width: 100%;
  }
  .fc-datagrid-cell-main{
    text-align: center;
  }
  .recent-contacts-container{
    overflow-y: scroll;
    height: 400px;
    overflow-x: hidden;
  }
</style>
<div class="wrapper" role="wrapper">
    <div class="row">
        <div class="col-12 col-md-9 left-col">
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
                                                                <span><a href="http://nsmartrac.com/workorder/edit/<?php echo $ss; ?>">View Workorder</a></span>
                                                            </h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        } else {
                                            // Remove UI Improvement task echo "No Workorders";
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
                                                      <select class="form-control custom-select" id="select-employee">
                                                          <option value="0">All Employees</option>
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
                                                        <button type="button" class="text-white btn btn-primary btn-md" data-toggle="modal"
                                                                data-target="#modalCreateEvent">
                                                            <span class="fa fa-plus fa-margin-right"></span>&nbsp;&nbsp;Create Event
                                                        </button>
                                                        <button type="button" class="btn btn-primary btn-md dropdown-toggle"
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
                                                        </ul>
                                                    </div>
                                                </div>
                                              </div>
                                          </form>
                                        </div>
                                        <br class="clearfix"/>
                                        <div class="alert alert-warning mt-2 mb-4" role="alert">
                                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">With Calendar, you can quickly schedule meetings and events and get reminders about upcoming activities, so you always know what’s next. Calendar is designed for teams, so it’s easy to share... </span>
                                        </div>

                                    </div>
                                    <div class="left-calendar-loading"></div>
                                    <div id='calendar'></div>
                                    <a class="btn btn-primary btn-add-gcalendar" title="Add Calendar" href="javascript:void(0);" style="margin-top: 15px;"><i class="far fa-calendar-plus"></i> Add Calendar</a>
                                </div>

                              <div class="calendar-menu" style="text-align: left;">
                                  <div style="background: #f2f2f2; padding: 20px;">
                                      <div class="margin-bottom">
                                          <div><h3 class="left-header"><i class="fa fa-calendar"></i> Upcoming Jobs</h3></div>
                                          <div id="upcoming-jobs-container"></div>
                                          <div><h3 class="left-header"><i class="fa fa-calendar"></i> Upcoming Events</h3></div>
                                          <div id="upcoming-events-container"></div>
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
        <div class="col-12 col-md-3 mt-40 right-col" style="background-color: #ffffff;overflow-y: scroll;overflow-x: hidden;height: max-content;display: block !important;padding-bottom: 20px;">
            <div class="row" style="padding:10px;">
                <div class="col-12">
                    <div class="right-calendar-loading"></div>
                    <h4  class="right-filter-header"><a class="btn-mini-calendar" href="javascript:void(0);"><i class="fa fa-minus cmini-icon icon-plus-cz"></i></a> <span class="pl-1">MINI CALENDAR</span></h4>
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
                    <h4  class="right-filter-header"><a class="btn-calendar-list" href="javascript:void(0);"><i class="fa fa-plus clist-icon icon-plus-cz"></i></a> <span class="pl-1">CALENDARS</span></h4>
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
                                      <a class="btn btn-sm btn-info pull-right btn-add-gevent btn-gcustom top-1 br-99" title="Add Event" href="javascript:void(0);" data-id="<?php echo $calendar['id']; ?>"><i class="far fa-edit"></i></a>
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
                    <h4  class="right-filter-header"><a class="btn-contacts-list" href="javascript:void(0);"><i class="fa fa-plus contact-list-icon icon-plus-cz"></i></a><span class="pl-1">RECENT CONTACTS</span></h4>

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
                                            <a href="#" class="calendar-profile-contact"><i class="fa fa-comments-o"></i></a>
                                            <a href="#" class="calendar-profile-contact"><i class="fa fa-print"></i></a>
                                            <!-- <a class="btn-calendar-small btn btn-default" href="javascript:void(0)">Contact</a> -->
                                        </div>
                                    </div>
                                </li>
                      <?php     }
                            } ?>


                    </ul>
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
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 style="" class="modal-title">Schedule</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>loading...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger btn-event-delete" id="delete_schedule">Delete</button>
                <button type="button" class="btn btn-primary btn-event-edit" id="edit_schedule" style="display: none">Edit Schedule
                </button>
                <button type="button" class="btn btn-primary btn-event-edit-workorder" id="edit_workorder" style="display: none">Edit Wordorder
                </button>
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
<?php include viewPath('includes/footer'); ?>
<script type="text/javascript" src="<?php echo $url->assets ?>/js/tooltip.min.js"></script>
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



    function get_employee_dropdown() {
        jQuery.ajax({
            url: base_url + 'users/ajax_user_dropdown',
            // dataType: 'json',
            data: '',
            beforeSend: function () {
                jQuery('.tiva-calendar').html('<div class="loading"><img src="images/temp/loading.gif" /></div>');
            },
            success: function (response) {

                console.log(response);

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

            console.log('opening modal...');
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

            // $('#frm_calender_filter_events').submit();

            $("#calendar").css('opacity', '.5');
            $("#calendar").attr('disabled', true);


            jQuery.ajax({
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
            });
        });

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

        console.log(events);

        render_calender(calendarEl, timeZoneSelectorEl, events);
    });


    function render_calender(calendarEl, timeZoneSelectorEl, events) {
        var bc_events_url    = base_url + "calendar/_get_main_calendar_events";
        var bc_resources_url = base_url + "calendar/_get_main_calendar_resources";

        calendar = new FullCalendar.Calendar(calendarEl, {
           schedulerLicenseKey: '0531798248-fcs-1598103289',
            headerToolbar: {
            center: 'employeeTimeline,monthView,dayView,weekView,listView' // buttons for switching between views
          },
          themeSystem : 'bootstrap',
          eventDisplay: 'block',
          views: {
            employeeTimeline: {
              type: 'resourceTimelineDay',
              buttonText: 'Employee'
            },
            dayView: {
              type: 'timeGridDay',
              buttonText: 'Day'
            },
            monthView: {
              type: 'dayGridMonth',
              buttonText: 'Month'
            },
            weekView: {
              type: 'timeGridWeek',
              buttonText: 'Week'
            },
            listView: {
              type: 'listWeek',
              buttonText: 'List'
            }
          },
          resourceLabelDidMount: function(info) {
            console.log(info);
            let img = document.createElement('img');
            img.src = info.resource.extendedProps.imageurl;
            img.setAttribute("class", "datagrid-image");
            info.el.prepend(img);
          },
          defaultDate: "<?php echo date('Y-m-d') ?>",
            editable: false,
            navLinks: true, // can click day/week names to navigate views
            eventLimit: true, // allow "more" link when too many events
            events: events,
            eventClick: function (arg) {
                //console.log(arg.event._def.extendedProps);

                $("#modalEventDetails").modal('show');
                $('#modalEventDetails .modal-body').html("loading...");

                var apiUrl = '';
                var isGet  = 1;
                if (typeof arg.event._def.extendedProps.eventId != 'undefined') {

                    apiUrl = base_url + 'event/modal_details/' + arg.event._def.extendedProps.eventId;

                    $("#edit_schedule").show();
                    $("#edit_workorder").hide();

                    $("#edit_schedule").attr('data-event-id', arg.event._def.extendedProps.eventId);
                }else if( typeof arg.event._def.extendedProps.geventID != 'undefined' ){
                    apiUrl = base_url + 'workcalender/modal_gevent_details';
                    isGet = 0;
                    var gData = {
                      'gevent_id' : arg.event._def.extendedProps.geventID,
                      'title' : arg.event._def.extendedProps.description,
                      'start_date' : arg.event._def.extendedProps.start,
                      'end_date' : arg.event._def.extendedProps.end,
                    };
                } else {

                    apiUrl = base_url + 'workcalender/short_details/' + arg.event._def.extendedProps.wordOrderId;

                    $("#edit_schedule").hide();
                    $("#edit_workorder").show();

                    $("#edit_workorder").attr('data-workorder-id', arg.event._def.extendedProps.wordOrderId);
                }

                if( isGet == 1 ){
                  jQuery.ajax({
                      url: apiUrl,
                      // dataType: 'json',
                      data: '',
                      beforeSend: function () {
                          jQuery('.tiva-calendar').html('<div class="loading"><img src="./assets/img/loading.gif" /></div>');
                      },
                      success: function (response) {

                          // console.log(response);
                          $(".btn-event-edit").show();
                          $(".btn-event-delete").show();
                          $(".btn-event-edit-workorder").show();
                          $("#modalEventDetails").find('.modal-body').html(response);
                      }
                  });
                }else{
                  jQuery.ajax({
                      url: apiUrl,
                      type: "POST",
                      data: gData,
                      beforeSend: function () {
                          jQuery('.tiva-calendar').html('<div class="loading"><img src="./assets/img/loading.gif" /></div>');
                      },
                      success: function (response) {

                          // console.log(response);
                          $(".btn-event-edit").hide();
                          $(".btn-event-delete").hide();
                          $(".btn-event-edit-workorder").hide();
                          $("#modalEventDetails").find('.modal-body').html(response);
                      }
                  });
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
            resources: <?php echo json_encode($resources_users); ?>,
            events: {
              url: bc_events_url,
              method: 'POST'
            },
            //events: <?php echo json_encode($resources_user_events); ?>,

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
	    autoclose: true
	});

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

</script>
