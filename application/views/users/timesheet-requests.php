<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>

<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/employee'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">

                <!-- <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Settings </h1>-->
                <!-- <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Manage Timesheets</li>
                        </ol> -->
                <!--</div>
                </div>-->

            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="padding: 0">
                        <div class="card-body">
                            <div class="col-sm-12">
                                <h3 class="page-title" style="margin-bottom: 10px !important;">Requests</h3>
                                <div class="pl-3 pr-3 mt-0 row">
                                    <!-- <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                        <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</span>
                                    </div> -->
                                </div>
                            </div>
                            <div class="row" style="padding: 10px 33px 20px 33px;">
                                <div class="col-md-12 banking-tab-container">
                                    <a href="<?php echo url('/timesheet/attendance') ?>" class="banking-tab" style="text-decoration: none">Attendance</a>
                                    <a href="<?php echo url('/timesheet/attendance_logs') ?>" class="banking-tab">Time Logs</a>
                                    <a href="<?php echo url('/timesheet/notification') ?>" class="banking-tab">Notification</a>
                                    <a href="<?php echo url('/timesheet/employee') ?>" class="banking-tab" style="text-decoration: none">Employee</a>
                                    <a href="<?php echo url('/timesheet/schedule') ?>" class="banking-tab">Schedule</a>
                                    <a href="<?php echo url('/timesheet/list') ?>" class="banking-tab">List</a>
                                    <a href="<?php echo url('/timesheet/requests') ?>" class="banking-tab<?php echo ($this->uri->segment(1) == "settings") ?: '-active'; ?>">Requests</a>
                                    <a href="<?php echo url('/timesheet/my_schedule') ?>" class="banking-tab">My Schedule</a>
                                </div>
                            </div>

                            <center>
                                <h3 class="mt-0 header-title" id="page_title">Attendance Correction Requests</h3>
                            </center>
                            <!-- Date Selector -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs">
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#empSchedule">Schedule</a>
                                        </li> -->
                                        <li class="nav-item">
                                            <a class="nav-link leave_request_tab " data-toggle="tab" href="#empPTO">Leave Requests</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link ot_request_tab" data-toggle="tab" href="#empOTRequest">OT Requests</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link attendance_correction_tab active" data-toggle="tab" href="#attendance_correction_requests">Attendance Correction Requests</a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#empInvite">Invite Members</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " data-toggle="tab" href="#empDepartment">Department</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#empWorkweekOT">
                                                Workweek & Overtime
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#empBreakPref">
                                                Break Preference
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#empManualEntries">
                                                Manual Entries
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#empNotifications">
                                                Notifications
                                            </a>
                                        </li> -->
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane container fade" id="empSchedule">
                                            <div class="ts-settings-menu">
                                                <div class="form-group" style="float: right">
                                                    <select name="" id="tsUsersList" class="form-control select2-employee-list">
                                                        <option></option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <!--                                            <button class="btn btn-default" type="button"><i class="fa fa-list"></i></button>-->
                                                </div>
                                                <!--                                        Present day-->
                                                <input type="hidden" id="presentDay" value="<?php echo date('m/d/Y') ?>">
                                                <div class="form-group" style="float: right">
                                                    <!--                                            <select name="" id="ts-sorting-week" class="form-control ts-sorting">-->
                                                    <!--                                                <option value="this week" selected>This week</option>-->
                                                    <!--                                                <option value="last week">Last week</option>-->
                                                    <!--                                                <option value="next week">Next week</option>-->
                                                    <!--                                            </select>-->
                                                    <input type="text" id="ts-sorting-week" class="form-control ts-settings-datepicker" value="<?php echo date('m/d/Y') ?>">
                                                    <!--                                            <button class="btn btn-default"><i class="fa fa-angle-left fa-lg"></i></button>-->
                                                    <!--                                            <button class="btn btn-default right"><i class="fa fa-angle-right fa-lg"></i></button>-->
                                                </div>
                                            </div>
                                            <div class="table-wrapper-settings">
                                                <table id="timesheet_settings" class="timesheet_settings-table"></table>
                                                <div class="table-ts-loader">
                                                    <img class="ts-loader-img" src="<?= base_url() ?>/assets/css/timesheet/images/ring-loader.svg" alt="">
                                                </div>
                                            </div>
                                            <div class="ts-bottom-btn-section">
                                                <!--                                        <div class="form-group">-->
                                                <!--                                            <button class="btn btn-default" id="btnAddRow"><i class="fa fa-plus" style="color: #0b97c4;"></i>&nbsp;Add new row</button>-->
                                                <!--                                        </div>-->
                                                <div class="form-group">
                                                    <button class="btn btn-default"><i class="fa fa-copy" style="color: #9da5af;"></i>&nbsp;Copy last week</button>
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-default"><i class="fa fa-save" style="color: #56bb4d;"></i>&nbsp;Save as template</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane container" id="empPTO">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button class="btn btn-info" id="leaveList" style="float: right"><i class="fa fa-plus"></i> Add Leave Type</button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <form id="leave_request_date_form_filter" action="#" target="_blank" method="POST">
                                                        <div class="row">
                                                            <div class="col-lg-6" style="margin-bottom: 12px">
                                                                <label for="from_date_correction_requests" class="week-label">From date filed:</label>
                                                                <input type="text" name="date_from" id="from_date_leave_requests" class="form-control ts_schedule" value="<?= date('m/d/Y', strtotime('monday this week')) ?>">
                                                            </div>
                                                            <div class="col-lg-6" style="margin-bottom: 12px">
                                                                <label for="to_date_correction_requests" class="week-label">To date filed:</label>
                                                                <input type="text" name="date_to" id="to_date_leave_requests" class="form-control ts_schedule" value="<?= date("m/d/Y") ?>">

                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-md-12">
                                                    <table id="pto-table-list" class="ptoTable cell-border hover" style="display: none;">
                                                        <thead>
                                                            <tr>
                                                                <th>Employee</th>
                                                                <th>Type</th>
                                                                <th>Date requested</th>
                                                                <th>Leave date</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="pto-table-list-body">
                                                            <?php foreach ($leave_request as $cnt => $request) : ?>
                                                                <?php
                                                                //PTO TYPE
                                                                foreach ($pto as $type) {
                                                                    if ($type->id == $request->pto_id) {
                                                                        $pto_type = $type->name;
                                                                    }
                                                                }
                                                                //Employee name
                                                                foreach ($users as $user) {
                                                                    if ($user->id == $request->user_id) {
                                                                        $name = $user->FName . " " . $user->LName;
                                                                    }
                                                                }
                                                                //Status request
                                                                if ($request->status == 1) {
                                                                    $status = 'Approved';
                                                                } elseif ($request->status == 2) {
                                                                    $status = 'Denied';
                                                                } else {
                                                                    $status = 'Pending';
                                                                }
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $name; ?></td>
                                                                    <td class="center"><?php echo $pto_type ?></td>
                                                                    <td class="center"><?php echo date('M d,Y', strtotime($request->date_created)); ?></td>
                                                                    <td class="center">
                                                                        <?php foreach ($leave_date as $date) :
                                                                            if ($date->leave_id == $request->id) {
                                                                        ?>
                                                                                <span style="display: block"><?php echo date('M d,Y', strtotime($date->date_time)); ?></span>
                                                                            <?php } ?>
                                                                        <?php endforeach; ?>
                                                                    </td>
                                                                    <td class="center"><?php echo $status ?></td>
                                                                    <td class="center" style="border-right: 0;">
                                                                        <?php if ($status != "Approved") {
                                                                        ?>
                                                                            <a href="javascript:void (0)" data-id="<?php echo $request->id ?>" title="Approve" data-toggle="tooltip" id="approveRequest" style="display: inline;"><i class="fa fa-thumbs-up fa-lg"></i></a>
                                                                        <?php
                                                                        } ?>
                                                                        <a href="javascript:void (0)" data-id="<?php echo $request->id ?>" title="Deny" data-toggle="tooltip" id="denyRequest" style="margin-left: 12px"><i class="fa fa-times fa-lg"></i></a>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                    <div class="">
                                                        <center><img class="all-leave-requests-loader" src="<?= base_url() ?>/assets/css/timesheet/images/ring-loader.svg" alt=""></center>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane container " id="empOTRequest">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table id="otrequest-table-list" class="table table-bordered table-striped no-footer dataTable" style="width: auto; display:none;" role="grid" aria-describedby="timeLogTable_info">
                                                        <thead>
                                                            <tr role="row">
                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 86px;">Employee</th>
                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 60px;">Shift Date</th>
                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 99px;">Clock in</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody class="employee-tbody">
                                                            <tr role="row" class="odd">
                                                                <td class="center" id="form_expected_hours"></td>
                                                                <td class="center" id="form_expected_break_duration"></td>
                                                                <td class="center" id="form_expected_work_hours"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="loading">
                                                        <center><img class="ts-loader-img" src="<?= base_url() ?>/assets/css/timesheet/images/ring-loader.svg" alt=""></center>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane container active" id="attendance_correction_requests">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form action="#" target="_blank" method="POST">
                                                        <div class="row">
                                                            <div class="col-lg-2" style="margin-bottom: 12px">
                                                                <label for="from_date_correction_requests" class="week-label">From:</label>
                                                                <input type="text" name="date_from" id="from_date_correction_requests" class="form-control ts_schedule" value="<?= date('m/d/Y', strtotime('monday last week')) ?>">
                                                            </div>
                                                            <div class="col-lg-2" style="margin-bottom: 12px">
                                                                <label for="to_date_correction_requests" class="week-label">To:</label>
                                                                <input type="text" name="date_to" id="to_date_correction_requests" class="form-control ts_schedule" value="<?= date("m/d/Y") ?>">
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <table id="attendance_correction_requests_table" class="table table-bordered table-striped no-footer dataTable" role="grid" aria-describedby="otrequest-table-list_info" style="display:none;">
                                                        <thead>
                                                            <tr role="row">
                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Employee</th>
                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Shift Date</th>
                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Login</th>
                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Break</th>
                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Worked Hours</th>
                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Break Duration</th>
                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Overtime</th>
                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Request Status</th>
                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr role="row" class="odd">
                                                                <td class="center">Lou Pinton</td>
                                                                <td><label class="gray">03-21-2021</label></td>
                                                                <td>
                                                                    <center>
                                                                        <label class="gray"><strong>Clock in: &nbsp;</strong> 03-21-2021 12:20 PM</label>
                                                                        <label class="gray"><strong>Clock out: &nbsp;</strong> 03-21-2021 12:20 PM</label>
                                                                    </center>
                                                                </td>
                                                                <td>
                                                                    <center>
                                                                        <label class="gray"><strong>Break in: &nbsp;</strong> 03-21-2021 12:20 PM</label>
                                                                        <label class="gray"><strong>Break out:&nbsp;</strong> 03-21-2021 12:20 PM</label>
                                                                    </center>
                                                                </td>
                                                                <td style="text-align:center;">9.3</td>
                                                                <td style="text-align:center;">1.30</td>
                                                                <td style="text-align:center;">1.30</td>
                                                                <td style="text-align:center;">Pending</td>
                                                                <td style="text-align:center;">
                                                                    <a href="#" title="" data-name="Jonah  Pacas-Abanil" data-user-id="14" data-attn-id="143" data-toggle="tooltip" class="approve-ot-request btn btn-danger btn-sm" data-original-title="Cancel Request"><i class="fa fa-times fa-lg"></i> Cancel</a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="table-ts-loader">
                                                        <center><img class="my-correction-requests-loader" src="<?= base_url() ?>/assets/css/timesheet/images/ring-loader.svg" alt=""></center>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane container" id="empInvite">
                                            <form action="" method="post" id="formInviteLink">
                                                <div class="form-group">
                                                    <label for="" style="font-weight: bold">EMAIL</label>
                                                    <input type="email" name="email" class="form-control invite-email" placeholder="sample@mail.com">
                                                    <a href="javascript:void(0)" title="Clear" id="clearEmailField"><i class="fa fa-times fa-lg remove-email-icon"></i></a>
                                                    <?php
                                                    $name = null;
                                                    $user_role = null;
                                                    foreach ($users as $user) {
                                                        if ($user->id == $this->session->userdata('logged')['id']) {
                                                            $name = $user->FName . " " . $user->LName;
                                                        }
                                                    }
                                                    ?>
                                                    <input type="hidden" name="name" value="<?php echo $name; ?>">
                                                </div>
                                                <div class="form-group" style="width: 200px">
                                                    <label for="" style="font-weight: bold">ROLE</label>
                                                    <select name="role" class="form-control invite-role">
                                                        <option value="Employee">Employee</option>
                                                        <option value="Manager">Manager</option>
                                                        <option value="Admin">Admin</option>
                                                    </select>
                                                </div>
                                            </form>
                                            <div class="form-group">
                                                <i class="fas fa-link"></i> <span style="font-size: 16px;font-weight: bold">Create an invite link</span>
                                            </div>
                                            <div class="form-group">
                                                <p>Create an invite link to share with your team members so they can join your account.</p>
                                            </div>
                                            <div class="form-group">
                                                <button type="button" class="btn btn-success" style="border-radius: 36px;width: 200px" id="sendInviteLink"><i class="fa fa-paper-plane fa-lg"></i> <span>SEND</span></button>
                                            </div>
                                        </div>
                                        <div class="tab-pane container " id="empDepartment">
                                            <?php
                                            if (isset($dept_id)) {
                                                $name = null;
                                                if ($this->uri->segment(3) != null) {
                                                    $hide = 'display:none';
                                            ?>
                                                    <div class="department-edit-view">
                                                        <div class="dept-header">
                                                            <a href="javascript:void(0)" id="deptBckBtn"><i class="fas fa-arrow-left fa-lg" style="margin-right: 10px;color: #a2a2a2;"></i></a>
                                                            <h3><?php echo $dept_id[0]->name; ?></h3>
                                                            <a href="javascript:void(0)" title="Edit" data-toggle="tooltip" id="deptEditName"><i class="fas fa-pencil-alt"></i></a>
                                                        </div>
                                                        <div class="dept-sub-header">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <span class="sub-header-title">Name</span>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <span class="sub-header-title">Role</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="dept-role-title">
                                                            <h6>Managers</h6>
                                                        </div>
                                                        <div class="dept-role-add">
                                                            <a href="javascript:void(0)">
                                                                <i class="fas fa-plus fa-lg"></i> <span class="dept-add-btn">Add Managers</span>
                                                            </a>
                                                        </div>
                                                        <div class="dept-role-title">
                                                            <h6>Members</h6>
                                                        </div>
                                                        <div class="dept-role-add">
                                                            <a href="javascript:void(0)" id="deptAddMembers">
                                                                <i class="fas fa-plus fa-lg"></i> <span class="dept-add-btn">Add Members</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                            <?php
                                                } else {
                                                    $hide = 'display:none';
                                                }
                                                if ($dept_id == 0) {
                                                    redirect('/timesheet/settings');
                                                }
                                            } else {
                                                $hide = null;
                                            }
                                            ?>
                                            <div class="department-table-list" style="<?php echo $hide ?>">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h5>Department List</h5>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <a href="#" class="add-department-btn" id="addDepartmentBtn"><i class="fa fa-plus"></i> Add New Department</a>
                                                    </div>
                                                </div>
                                                <!--class="departmentTbl cell-border hover-->
                                                <table id="department-table-list" class="table table-hover table-to-list">
                                                    <thead>
                                                        <tr>
                                                            <th>Departments</th>
                                                            <th>Members</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (isset($department)) : ?>
                                                            <?php foreach ($department as $dept) : ?>
                                                                <tr class="tbl-dept-row" data-id="<?php echo $dept->id ?>">
                                                                    <td style="border-left: 0;"><?php echo $dept->name; ?></td>
                                                                    <td><?php ?></td>
                                                                    <td class="center">
                                                                        <a href="#" data-id="<?php echo $dept->id ?>" data-name="<?php echo $dept->name; ?>" id="removeDept"><i class="fa fa-trash-alt fa-lg"></i></a>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane container" id="empWorkweekOT">
                                            <div class="workweek-overtime-header">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h4>Worksheet & Overtime</h4>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button class="btn btn-success" id="savedWorkweekOTsettings">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <form action="" method="post" id="formWorkweekOT">
                                                <div class="workweek-container">
                                                    <div class="workweek-header">
                                                        <span>Workweek Settings</span>
                                                    </div>
                                                    <div class="workweek-section">
                                                        <div class="workweek-title">
                                                            <span>Workweek Start Day</span>
                                                        </div>
                                                        <div class="workweek-menu">
                                                            <select name="start_day" class="form-control workweek-days">
                                                                <option value="Monday">Monday</option>
                                                                <option value="Tuesday">Tuesday</option>
                                                                <option value="Wednesday">Wednesday</option>
                                                                <option value="Thursday">Thursday</option>
                                                                <option value="Friday">Friday</option>
                                                                <option value="Saturday">Saturday</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="workweek-section">
                                                        <div class="workweek-title">
                                                            <span>Regular Hours per Week</span>
                                                        </div>
                                                        <div class="workweek-menu">
                                                            <input type="text" name="hours_week" class="form-control" style="width: 80px" value="00:00">
                                                        </div>
                                                    </div>
                                                    <div class="workweek-section">
                                                        <div class="workweek-title">
                                                            <span>Regular Hours per Day</span>
                                                        </div>
                                                        <div class="workweek-menu">
                                                            <input type="text" name="hours_day" class="form-control" style="width: 80px" value="00:00">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="workweek-container">
                                                    <div class="workweek-header">
                                                        <span>Overtime Settings</span>
                                                    </div>
                                                    <div class="workweek-section">
                                                        <div class="overtime-radio">
                                                            <input name="overtime" type="radio" id="radio1" value="No Overtime">
                                                            <label for="radio1"></label>
                                                        </div>
                                                        <div class="overtime-title-row">
                                                            <span class="overtime-title">No Overtime</span>
                                                            <span class="overtime-sub-title">Overtime hours will not be counted for your account.</span>
                                                        </div>
                                                    </div>
                                                    <div class="workweek-section">
                                                        <div class="overtime-radio">
                                                            <input name="overtime" type="radio" id="radio2" value="Daily Overtime">
                                                            <label for="radio2"></label>
                                                        </div>
                                                        <div class="overtime-title-row">
                                                            <span class="overtime-title">Daily Overtime</span>
                                                            <span class="overtime-sub-title">All hours worked over the selected regular hours per day will be counted as overtime.</span>
                                                        </div>
                                                    </div>
                                                    <div class="workweek-section">
                                                        <div class="overtime-radio">
                                                            <input name="overtime" type="radio" id="radio3" value="Weekly Overtime" checked>
                                                            <label for="radio3"></label>
                                                        </div>
                                                        <div class="overtime-title-row">
                                                            <span class="overtime-title">Weekly Overtime</span>
                                                            <span class="overtime-sub-title">All hours worked over the selected regular hours per week will be counted as overtime.</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane container" id="empBreakPref">
                                            <div class="workweek-overtime-header">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h4>Break Preferences</h4>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button class="btn btn-success" id="savedBreakPref">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <form action="" method="post" id="formBreakPreference">
                                                <div class="break-pref-container">
                                                    <div class="break-pref-section">
                                                        <div class="break-pref-title">Break Rule</div>
                                                        <div class="break-pref-dp">
                                                            <select name="break_rule" id="breakRule" class="form-control">
                                                                <option value="Manual">Manual</option>
                                                                <option value="Automatic">Automatic</option>
                                                            </select>
                                                        </div>
                                                        <div class="break-pref-length">
                                                            <div class="break-pref-title">Length</div>
                                                            <div class="break-pref-dp">
                                                                <input type="text" name="length" class="form-control" style="width: 100px" value="00:00">
                                                            </div>
                                                        </div>
                                                        <div class="break-pref-sub-title">
                                                            Team members can start and end breaks at any time while on the clock.
                                                        </div>
                                                    </div>
                                                    <div class="break-pref-section">
                                                        <div class="break-pref-title">Type</div>
                                                        <div class="break-pref-dp">
                                                            <select name="type" id="" class="form-control">
                                                                <option value="Paid">Paid</option>
                                                                <option value="Unpaid">Unpaid</option>
                                                            </select>
                                                        </div>
                                                        <div class="break-pref-sub-title">
                                                            Break hours will be added to the total number of hours for every pay period.
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane container" id="empManualEntries">
                                            <div class="workweek-overtime-header">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h4>Manual Entries</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="workweek-section" style="margin-bottom: 20px">
                                                <div class="overtime-radio">
                                                    <input name="overtime" type="checkbox" id="manualEntries" checked>
                                                    <label for="radio1"></label>
                                                </div>
                                                <div class="overtime-title-row">
                                                    <span class="overtime-title">Manual Entries</span>
                                                    <span class="overtime-sub-title">When enabled, users with the roles selected below will be allowed to add, edit or delete time entries.</span>
                                                </div>
                                            </div>
                                            <div class="workweek-container " id="rolesContainer">
                                                <div class="workweek-header">
                                                    <span>Roles</span>
                                                </div>
                                                <div class="workweek-section">
                                                    <div class="role-checkbox">
                                                        <input name="admins" type="checkbox" id="admins" checked value="Admins">
                                                        <label for="admins"></label>
                                                    </div>
                                                    <div class="overtime-title-row">
                                                        <span class="overtime-title">Admins</span>
                                                    </div>
                                                </div>
                                                <div class="workweek-section">
                                                    <div class="role-checkbox">
                                                        <input name="managers" type="checkbox" id="managers" checked value="Managers">
                                                        <label for="managers"></label>
                                                    </div>
                                                    <div class="overtime-title-row">
                                                        <span class="overtime-title">Managers</span>
                                                    </div>
                                                </div>
                                                <div class="workweek-section">
                                                    <div class="role-checkbox">
                                                        <input name="employees" type="checkbox" id="employees" checked value="Employees">
                                                        <label for="employees"></label>
                                                    </div>
                                                    <div class="overtime-title-row">
                                                        <span class="overtime-title">Employees</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane container" id="empNotifications">
                                            <div class="workweek-overtime-header">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h4>Notifications</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="workweek-container">
                                                <div class="workweek-header">
                                                    <span>Reminders</span>
                                                </div>
                                                <div class="notify-section">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="notify-checkbox">
                                                                <input type="checkbox">
                                                            </div>
                                                            <div class="notify-label">Clock In Reminder</div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div>
                                                                <i class="fa fa-arrow-right fa-lg notify-arrow"></i>
                                                                <span class="notify-text">Remind me at</span>
                                                                <input type="text" class="form-control notify-time-in">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="notify-section">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="notify-checkbox">
                                                                <input type="checkbox">
                                                            </div>
                                                            <div class="notify-label">Clock Out Reminder</div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div>
                                                                <i class="fa fa-arrow-right fa-lg notify-arrow"></i>
                                                                <span class="notify-text">Remind me at</span>
                                                                <input type="text" class="form-control notify-time-in">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="notify-section">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="notify-checkbox">
                                                                <input type="checkbox">
                                                            </div>
                                                            <div class="notify-label">When I Enter a Job Site</div>
                                                        </div>
                                                        <div class="col-md-4">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="notify-section">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="notify-checkbox">
                                                                <input type="checkbox">
                                                            </div>
                                                            <div class="notify-label">When I Leave a Job Site</div>
                                                        </div>
                                                        <div class="col-md-4">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="notify-section">
                                                    <div class="notify-row-days">
                                                        <div class="notify-day-cell" data="Monday">Monday</div>
                                                        <div class="notify-day-cell" data="Tuesday">Tuesday</div>
                                                        <div class="notify-day-cell" data="Wednesday">Wednesday</div>
                                                        <div class="notify-day-cell" data="Thursday">Thursday</div>
                                                        <div class="notify-day-cell" data="Friday">Friday</div>
                                                        <div class="notify-day-cell" data="Saturday">Saturday</div>
                                                        <div class="notify-day-cell" data="Sunday">Sunday</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->
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
<!--Adding Project Schedule-->
<div class="modal-right-side">
    <div class="modal right fade" id="createProject" tabindex="" role="dialog" aria-labelledby="newProjectSettings">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="newProjectSettings"><i class="fa fa-calendar-alt"></i> <span id="tsDate"><?php echo date('M d,Y') ?></span></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="" method="post" id="formNewProject">
                    <div class="modal-body">
                        <input type="hidden" name="timesheet_id" id="timesheetId">
                        <input type="hidden" name="user_id" id="userId">
                        <input type="hidden" name="day" id="selectedDay">
                        <input type="hidden" name="total_week_duration" id="totalWeekDuration">
                        <input type="hidden" name="day_id" id="tsScheduleId">
                        <input type="hidden" name="week" id="weekType">
                        <div class="form-group">
                            <label for="">Project name</label>
                            <input type="text" name="project" id="tsProjectName" class="form-control">
                        </div>
                        <div class="form-group hiddenSection">
                            <label for="">Start Date</label>
                            <input type="text" name="start_date" id="tsStartDate" class="form-control ts-start-date" value="<?php echo date('m/d/Y') ?>">
                        </div>
                        <div class="form-group hiddenSection">
                            <div class="ts-time-section">
                                <label for="">Start time</label>
                                <input type="text" name="start_time" id="tsStartTime" class="form-control ts-time start-time" autocomplete="off">
                            </div>
                            <div class="ts-time-section">
                                <label for="">End time</label>
                                <input type="text" name="end_time" id="tsEndTime" class="form-control ts-time end-time" autocomplete="off">
                            </div>
                            <div class="ts-time-section">
                                <span class="total-duration"></span>
                            </div>
                        </div>
                        <div class="form-group hiddenSection">
                            <label for="tsTeamMember">Team members</label>
                            <select name="team_member" id="tsTeamMember" class="form-control ts-team-member">
                                <option></option>
                            </select>
                        </div>
                        <div class="form-group countrySectionEmp hiddenSection">
                            <label for="tsTimezone">Timezone</label>
                            <select name="timezone" class="form-control" id="tsTimezone">
                                <option></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tsNotes">Notes</label>
                            <textarea name="notes" id="tsNotes" cols="30" rows="5" class="form-control" placeholder="(Optional)" style="height: 100%!important;"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" id="savedProject">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end of modal-->
<!--Leave type modal-->
<div class="modal md-effect-11 " id="listLeaveType">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h6 class="modal-title">Types of Leave</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <button class="btn btn-default" id="addLeaveRow"><i class="fa fa-plus"></i> Add Row</button>
                <table id="leaveTableList" class="ptoTable cell-border hover">
                    <thead>
                        <tr>
                            <th style="width: 15px">#</th>
                            <th style="width: 247px">Type</th>
                            <th style="width: 248px">Description</th>
                            <th style="width: 50px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="" method="post" id="formLeaveType">
                            <?php if ($pto == null) { ?>
                                <tr class="leave-type-row">
                                    <td class="center" style="border-left: 0;">1</td>
                                    <td class="center leave-type-column">
                                        <span class="display"></span>
                                        <input type="text" name="type[]" class="leave-type-data form-control hidden" value="" required>
                                        <input type="hidden" class="leave-id" name="id[]" value="0">
                                    </td>
                                    <td class="center">
                                        <span class="display"></span>
                                        <textarea name="description[]" class="leave-desc-data form-control hidden" cols="30" rows="10" readonly></textarea>
                                    </td>
                                    <td class="center" style="border-right: 0;">
                                        <a href="javascript:void (0)" class="removeLeaveRow" title="Remove" data-toggle="tooltip" style="margin-left: 12px"><i class="fa fa-times fa-lg"></i></a>
                                    </td>
                                </tr>
                            <?php } else { ?>
                                <?php foreach ($pto as $cnt => $type) : ?>
                                    <tr class="leave-type-row">
                                        <td class="center" style="border-left: 0;"><?php echo $cnt + 1 ?></td>
                                        <td class="center leave-type-column">
                                            <span class="display"><?php echo $type->name ?></span>
                                            <input type="text" name="type[]" class="leave-type-data form-control hidden" value="<?php echo $type->name ?>" required>
                                            <input type="hidden" class="leave-id" name="id[]" value="<?php echo $type->id ?>">
                                        </td>
                                        <td class="center">
                                            <span class="display"></span>
                                            <textarea name="description[]" class="leave-desc-data form-control hidden" cols="30" rows="10" readonly></textarea>
                                        </td>
                                        <td class="center" style="border-right: 0;">
                                            <a href="javascript:void (0)" data-id="<?php echo $type->id ?>" class="removeLeaveRow" title="Remove" data-toggle="tooltip" style="margin-left: 12px"><i class="fa fa-times fa-lg"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php } ?>
                        </form>
                    </tbody>
                </table>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="savedLeaveType">Save & Exit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<!--end of modal-->
<!--Add Department modal-->
<div class="modal md-effect-11" id="departmentModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h6 class="modal-title">Add New Department</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form action="" method="post" id="departmentForm">
                    <label for="" style="color: #92969d;">Departments</label>
                    <div class="department-row">
                        <div class="input-department">
                            <input type="text" name="department[]" class="form-control deptArray" placeholder="Add department name">
                        </div>
                        <div class="remove-row-dept">
                            <a href="javascript:void (0)"><i class="fa fa-times fa-lg"></i></a>
                        </div>
                    </div>
                </form>
                <div class="add-department-row">
                    <a href="javascript:void (0)" id="addDeptRow">Add New Department</a>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="savedDepartment">Save & Exit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<!--end of modal-->
<!--Add Members modal-->
<div class="modal md-effect-11" id="addMembersModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h6 class="modal-title">Add Members to Department</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="add-member-container">
                    <div class="add-member-dept-row">
                        <div class="add-member-header">No Department</div>
                        <div class="add-member-section">
                            <input type="radio" name="member">
                            <span class="add-member-name">Hello World</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="savedDepartment">Add members</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<!--end of modal-->
<?php include viewPath('includes/footer'); ?>
<script>

</script>