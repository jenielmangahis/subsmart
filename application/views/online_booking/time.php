<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_booking'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/addons'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Online Booking</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Manage your online booking</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row time-container" id="time-container">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <?php include viewPath('includes/booking_tabs'); ?>   

                        <div class="row dashboard-container-1">
                            <div class="col-md-8"><strong>Time Slots</strong><br />Set the time intervals customers can book.</div>
                        </div>       

                        <div class="row dashboard-container-2 table-time-slots">
                            
                            <table class="table">
                              <thead>
                                <tr>
                                  <th width="" scope="col">Time Start - End</th>
                                  <th width="" scope="col">Mon</th>
                                  <th width="" scope="col">Tue</th>
                                  <th width="" scope="col">Wed</th>
                                  <th width="" scope="col">Thu</th>
                                  <th width="" scope="col">Fri</th>
                                  <th width="" scope="col">Sat</th>
                                  <th width="" scope="col">Sun</th>
                                  <th width="" scope="col">-</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                    <td width="">
                                        <div class="time-cnt">
                                            <input type="text" name="time_start[0]" value="8:00am" class="form-control time-input time_start ui-timepicker-input" autocomplete="off">
                                            &nbsp; - &nbsp;
                                            <input type="text" name="time_end[0]" value="10:00am" class="form-control time-input time_end ui-timepicker-input" autocomplete="off">
                                        </div>
                                    </td>
                                    <td width="">
                                        <div class="checkbox checkbox-sm">
                                            <input type="checkbox" name="weekday[0][]" value="Mon" class="checkbox-select" id="weekday_Mon_0">
                                            <label for="weekday_Mon_0"></label>
                                        </div>
                                    </td>
                                    <td width="">
                                        <div class="checkbox checkbox-sm">
                                            <input type="checkbox" name="weekday[0][]" value="Tue" class="checkbox-select" id="weekday_Tue_0">
                                            <label for="weekday_Tue_0"></label>
                                        </div>
                                    </td>
                                    <td width="">
                                        <div class="checkbox checkbox-sm">
                                            <input type="checkbox" name="weekday[0][]" value="Wed" class="checkbox-select" id="weekday_Wed_0">
                                            <label for="weekday_Wed_0"></label>
                                        </div>
                                    </td>
                                    <td width="">
                                        <div class="checkbox checkbox-sm">
                                            <input type="checkbox" name="weekday[0][]" value="Thu" class="checkbox-select" id="weekday_Thu_0">
                                            <label for="weekday_Thu_0"></label>
                                        </div>
                                    </td>
                                    <td width="">
                                        <div class="checkbox checkbox-sm">
                                            <input type="checkbox" name="weekday[0][]" value="Fri" class="checkbox-select" id="weekday_Fri_0">
                                            <label for="weekday_Fri_0"></label>
                                        </div>
                                    </td>
                                    <td width="">
                                        <div class="checkbox checkbox-sm">
                                            <input type="checkbox" name="weekday[0][]" value="Sat" class="checkbox-select" id="weekday_Sat_0">
                                            <label for="weekday_Sat_0"></label>
                                        </div>
                                    </td>
                                    <td width="">
                                        <div class="checkbox checkbox-sm">
                                            <input type="checkbox" name="weekday[0][]" value="Sun" class="checkbox-select" id="weekday_Sun_0">
                                            <label for="weekday_Sun_0"></label>
                                        </div>
                                    </td>
                                    <td width="">
                                        <a class="service-item-delete" data-category-delete-modal="open" data-id="13526" href="#">
                                            <span class="fa fa-trash"></span>
                                        </a>
                                    </td>
                                </tr>
                              </tbody>
                            </table>  

                            <a style="padding-left: 9px;" data-time-slot="btn-add" href="#"><span class="fa fa-plus-square fa-margin-right"></span> Add Time Slot</a> 

                        </div>

                        <div class="row dashboard-container-1">
                            <div class="col-md-8"><strong>Soonest Availability</strong><br />Select how many days should be excluded from the booking calendar starting from current day.
                            <select name="soonest_availability" class="form-control" style="width: 400px;">
                                <option value="1">Same Day</option>
                                <option value="2">Next Day</option>
                                <option value="3">2 days out</option>
                                <option value="3">3 days out</option>
                                <option value="3">1 week out</option>
                            </select>
                            </div>

                        </div>                         
                        <hr />
                        <div>
                            <button class="btn btn-success">Save</button>
                            <a style="float: right;" href="#" class="btn btn-success"> Continue >> </a>
                        </div>                                  
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer_booking'); ?>