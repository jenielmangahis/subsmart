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
                                <h3 class="page-title" style="margin-bottom: 10px !important;">Settings</h3>
                                <div class="pl-3 pr-3 mt-0 row">
                                    <!-- <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                        <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</span>
                                    </div> -->
                                </div>
                            </div>
                            <div class="row" style="padding: 10px 33px 20px 33px;">
                                <div class="col-md-12 banking-tab-container">
                                    <a href="<?php echo url('/timesheet/attendance') ?>" class="banking-tab" style="text-decoration: none">Attendance</a>
                                    <a href="<?php echo url('/timesheet/attendance_logs') ?>" class="banking-tab">Logs</a>
                                    <a href="<?php echo url('/timesheet/notification') ?>" class="banking-tab">Notification</a>
                                    <a href="<?php echo url('/timesheet/employee') ?>" class="banking-tab" style="text-decoration: none">Employee</a>
                                    <a href="<?php echo url('/timesheet/schedule') ?>" class="banking-tab">Schedule</a>
                                    <a href="<?php echo url('/timesheet/list') ?>" class="banking-tab">List</a>
                                    <a href="<?php echo url('/timesheet/settings') ?>" class="banking-tab<?php echo ($this->uri->segment(1) == "settings") ?: '-active'; ?>">Requests</a>
                                    <a href="<?php echo url('/timesheet/my_schedule') ?>" class="banking-tab">My Schedule</a>
                                </div>
                            </div>

                            <center>
                                <h3 class="mt-0 header-title" id="page_title">Employee Leave Requests</h3>
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
                                            <a class="nav-link leave_request_tab active " data-toggle="tab" href="#empPTO">Leave Requests</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link ot_request_tab" data-toggle="tab" href="#empOTRequest">OT Requests</a>
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
                                        <div class="tab-pane container active" id="empPTO">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button class="btn btn-info" id="leaveList" style="float: right"><i class="fa fa-plus"></i> Add Leave Type</button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table id="pto-table-list" class="ptoTable cell-border hover">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Employee</th>
                                                                <th>Type</th>
                                                                <th>Date requested</th>
                                                                <th>Leave date</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
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
                                                                    <td class="center" style="border-left: 0;"><?php echo $cnt + 1 ?></td>
                                                                    <td><?php echo $name; ?></td>
                                                                    <td class="center"><?php echo $pto_type ?></td>
                                                                    <td class="center"><?php echo date('M d,Y', strtotime($request->date_created)); ?></td>
                                                                    <td class="center">
                                                                        <?php foreach ($leave_date as $date) :
                                                                            if ($date->leave_id == $request->id) {
                                                                        ?>
                                                                                <span style="display: block"><?php echo date('M d,Y', strtotime($date->date)); ?></span>
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
    //Add row
    // $(document).on('click','#btnAddRow',function () {
    //     $('#tsSettingsTblTbody tr:last').prev('tr').clone('#tsSettingsRow').insertBefore('#tsSettingsTblTbody tr:last');
    //     $('td > .ts-project-name').last().text('Unnamed');
    // });

    $(document).ready(function() {
        // PTO Leave list DataTable




        //Approve
        $(document).on('click', '#approveRequest', function() {
            let id = $(this).attr('data-id');
            let selected = $(this);
            Swal.fire({
                title: 'Approve?',
                html: "Are you sure you want to approve this request?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Approve it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '<?= base_url() ?>/timesheet/approveRequest',
                        type: "POST",
                        dataType: 'json',
                        data: {
                            id: id
                        },
                        success: function(data) {
                            if (data == 1) {
                                selected.parent('td').prev('td').text('Approved');
                                Swal.fire({
                                    showConfirmButton: false,
                                    timer: 2000,
                                    title: 'Success',
                                    html: "Leave request <strong>Approved</strong>",
                                    icon: 'success'
                                });
                                // window.location.reload(true);
                            }

                        }
                    });
                }
            });
        });
        //Deny
        $(document).on('click', '#denyRequest', function() {
            let id = $(this).attr('data-id');
            let selected = $(this);
            Swal.fire({
                title: 'Deny?',
                html: "Are you sure you want to deny this request?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Deny it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '<?= base_url() ?>/timesheet/denyRequest',
                        type: "POST",
                        dataType: 'json',
                        data: {
                            id: id
                        },
                        success: function(data) {
                            if (data == 1) {
                                selected.parent('td').prev('td').text('Denied');
                                Swal.fire({
                                    showConfirmButton: false,
                                    timer: 2000,
                                    title: 'Success',
                                    html: "Leave request <strong>Denied</strong>",
                                    icon: 'success'
                                });
                            }
                        }
                    });
                }
            });
        });

        // Leave list modal
        $(document).on('click', '#leaveList', function() {
            $('#listLeaveType').modal({
                backdrop: 'static',
                keyboard: false
            });
            let table = $('#leaveTableList');
            table.children('tbody').children('tr').children('td').children('input.leave-type-data').addClass('hidden');
            table.children('tbody').children('tr').children('td').children('textarea').addClass('hidden');
            table.children('tbody').children('tr').children('td').children('span').removeClass('hidden').addClass('display');
        });
        //Leave modal dataTable
        $('#leaveTableList').DataTable({
            "paging": false,
            "sort": false,
        });
        //Row add/edit
        $(document).on('click', '.leave-type-row', function() {
            $(this).parent('tbody').children('tr').children('td').children('input.leave-type-data').addClass('hidden');
            $(this).parent('tbody').children('tr').children('td').children('textarea').addClass('hidden');
            $(this).parent('tbody').children('tr').children('td').children('span').removeClass('hidden').addClass('display');

            $(this).children('td').children('span').removeClass('display').addClass('hidden');
            $(this).children('td').children('input.leave-type-data').removeClass('hidden').addClass('display');
            $(this).children('td').children('textarea').removeClass('hidden').addClass('display');
        });
        //Add row Leave type
        $(document).on('click', '#addLeaveRow', function() {
            let last = $('#leaveTableList tbody tr:last td:first').text();
            let counter = parseInt(last) + 1;
            let row = '     <tr class="leave-type-row">\n' +
                '                        <td class="center" style="border-left: 0;">' + counter + '</td>\n' +
                '                        <td class="center leave-type-column">\n' +
                '                            <span class="display"></span>\n' +
                '                            <input type="text" name="type[]" class="leave-type-data form-control hidden" value="">\n' +
                '                            <input type="hidden" class="leave-id" name="id[]" value="0">\n' +
                '                        </td>\n' +
                '                        <td class="center">\n' +
                '                            <span class="display"></span>\n' +
                '                            <textarea name="description[]" class="leave-desc-data form-control hidden" id="" cols="30" rows="10"></textarea>\n' +
                '                        </td>\n' +
                '                        <td class="center" style="border-right: 0;">\n' +
                '                            <a href="javascript:void (0)" class="removeLeaveRow" title="Remove" data-toggle="tooltip" style="margin-left: 12px"><i class="fa fa-times fa-lg"></i></a>\n' +
                '                        </td>\n' +
                '                    </tr>'
            $('#leaveTableList tbody tr:last').after(row);
        });
        //Remove leave row
        $(document).on('click', '.removeLeaveRow', function() {
            let type = $(this).parent('td').parent('tr').children('td.leave-type-column').children('span').text();
            let id = $(this).attr('data-id');
            let row = $(this).parent('td').parent('tr');
            if (type == '') {
                row.remove();
            } else {
                Swal.fire({
                    title: 'Remove leave type?',
                    html: "Are you sure you want to remove <strong>" + type + "</strong> ?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: '#2ca01c',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Remove it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: '<?= base_url() ?>/timesheet/removePTO',
                            type: "POST",
                            dataType: 'json',
                            data: {
                                id: id
                            },
                            success: function(data) {
                                if (data == 1) {
                                    let row_cnt = $('#leaveTableList').children('tbody').children('tr').length;
                                    if (row_cnt == 1) {
                                        row.children('td.leave-type-column').children('span').text(null);
                                        row.children('td.leave-type-column').children('input.leave-type-data').val(null).removeClass('display').addClass('hidden');
                                        row.children('td').children('textarea.leave-desc-data').val(null).removeClass('display').addClass('hidden');
                                        row.children('td.leave-type-column').children('input.leave-id').val(null);
                                    } else if (row_cnt > 1) {
                                        row.remove();
                                    }
                                    Swal.fire({
                                        showConfirmButton: false,
                                        timer: 2000,
                                        title: 'Success',
                                        html: "<strong>" + type + "</strong> has been removed.",
                                        icon: 'success'
                                    });
                                }
                            }
                        });
                    }
                });
            }
        });
        //Save Leave type
        $(document).on('click', '#savedLeaveType', function() {
            let type = getArrayType($('.leave-type-data'));
            let desc = getArrayDesc($('.leave-desc-data'));
            let id = getArrayID($('.leave-id'));

            $.ajax({
                url: '<?= base_url() ?>/timesheet/savedPTO',
                type: "POST",
                dataType: "json",
                data: {
                    id: id,
                    type: type
                },
                success: function(data) {
                    $("#listLeaveType").modal('hide');
                    Swal.fire({
                        showConfirmButton: false,
                        timer: 2000,
                        title: 'Success',
                        html: "New PTO has been added",
                        icon: 'success'
                    });

                }
            });
        });

        function getArrayDesc(description) {
            let list = [];
            $(description).each(function(index, element) {
                list.push($(element).val());
            });
            return list;
        }

        function getArrayType(type) {
            let list = [];
            $(type).each(function(index, element) {
                list.push($(element).val());
            });
            return list;
        }

        function getArrayID(id) {
            let list = [];
            $(id).each(function(index, element) {
                list.push($(element).val());
            });
            return list;
        }

        // Invite link email field remove icon
        $(document).on('change', '.invite-email', function() {
            if ($(this).val() != '') {
                $('.remove-email-icon').css('visibility', 'visible');
                if (isEmail($(this).val()) == false) {
                    $(this).css('border-bottom', '2px solid red');
                } else {
                    $(this).css('border-bottom', '2px solid #e0e0e0');
                }
            } else {
                $('.remove-email-icon').css('visibility', 'hidden');
            }
        });
        $(document).on('keyup', '.invite-email', function() {
            if ($(this).val() != '') {
                $(this).css('border-bottom', '2px solid #e0e0e0');
            }
        });

        function isEmail(email) {
            let regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }

        $(document).on('click', '#clearEmailField', function() {
            $(this).prev('input').val(null);
            $(this).children('i').css('visibility', 'hidden');
            $('.invite-email').css('border-bottom', '2px solid #e0e0e0');
        });
        //Sending invite link
        $(document).on('click', '#sendInviteLink', function() {
            if ($('.invite-email').val() != '' && isEmail($('.invite-email').val()) == true) {
                let values = {};
                $.each($('#formInviteLink').serializeArray(), function(i, field) {
                    values[field.name] = field.value;
                });
                let button = $(this);
                button.attr('disabled', true).children('i').removeClass('fa-paper-plane').addClass('fa-spinner').addClass('fa-pulse');
                button.children('span').text('SENDING');
                $.ajax({
                    url: '<?= base_url() ?>/timesheet/inviteLinkEntry',
                    type: "POST",
                    dataType: "json",
                    data: {
                        values: values
                    },
                    success: function(data) {
                        if (data == 1) {
                            button.attr('disabled', false).children('i').addClass('fa-paper-plane').removeClass('fa-spinner').removeClass('fa-pulse');
                            button.children('span').text('SEND');
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: 'Success',
                                html: "Invite link has been sent",
                                icon: 'success'
                            });
                        }
                    }
                });
            } else {
                $('.invite-email').css('border-bottom', '2px solid red');
            }
        });
        //Select2 role list
        $('.invite-role').select2();

        //Department dataTable
        $('#department-table-list').DataTable({
            "paging": true,
            "filter": false,
            "info": false,
            "sort": false
        });
        // Department modal
        $(document).on('click', '#addDepartmentBtn', function() {
            $('#departmentModal').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('.input-department').children('input').val(null);
        });
        //Adding department
        $(document).on('click', '#savedDepartment', function() {
            let dept = getDepartment($('.deptArray'));
            $.ajax({
                url: '<?= base_url() ?>/timesheet/addDepartment',
                type: "POST",
                dataType: "json",
                data: {
                    dept: dept
                },
                success: function(data) {
                    $("#departmentModal").modal('hide');
                    if (data == 1) {
                        Swal.fire({
                            showConfirmButton: false,
                            timer: 2000,
                            title: 'Success',
                            html: "New department has been added",
                            icon: 'success'
                        });
                    } else {
                        Swal.fire({
                            showConfirmButton: false,
                            timer: 2000,
                            title: 'Failed',
                            html: "Department name already exist",
                            icon: 'warning'
                        });
                    }

                }
            });
        });

        function getDepartment(dept) {
            let list = [];
            $(dept).each(function(index, element) {
                list.push($(element).val());
            });
            return list;
        }
        //Department add row
        $(document).on('click', '#addDeptRow', function() {
            let select = $('#departmentForm');
            if ($('.input-department').children('input').val() !== '') {
                select.append($('.department-row').last().clone());
                $('.department-row:last').children('.input-department').children('input').val(null);
            }
        });
        //Deleting department
        $(document).on('click', '#removeDept', function() {
            let id = $(this).attr('data-id');
            let name = $(this).attr('data-name');
            Swal.fire({
                title: 'Are you sure to delete this?',
                html: "Department: <strong>" + name + "</strong>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "<?= base_url() ?>/timesheet/removeDepartment",
                        type: "POST",
                        dataType: "json",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            if (data == 1) {
                                Swal.fire({
                                    showConfirmButton: false,
                                    timer: 2000,
                                    title: 'Success',
                                    html: name + " department has been removed",
                                    icon: 'success'
                                });
                            }
                        }
                    });
                }
            });
        });
        //Department update
        $(document).on('click', '.tbl-dept-row td:not(:last-child)', function() {
            let dept_id = $(this).parent('tr').attr('data-id');
            let refresh = window.location.protocol + "//" + window.location.host + window.location.pathname + '/' + dept_id;
            window.history.pushState({
                path: refresh
            }, '', refresh);
            $.ajax({
                url: "<?= base_url() ?>/timesheet/showDeptUpdate",
                type: "GET",
                dataType: "json",
                data: {
                    dept_id: dept_id
                },
                success: function(data) {
                    $('.department-table-list').hide();
                    $('#empDepartment').append(data);
                }
            });
        });
        //Department back button
        $(document).on('click', '#deptBckBtn', function() {
            let url = window.location.href.replace(window.location.search, '');
            let refresh = url.slice(0, url.lastIndexOf('/'));
            window.history.pushState({
                path: refresh
            }, '', refresh)
            $('.department-edit-view').hide();
            $('.department-table-list').show();
        });
        //Department add members
        $(document).on('click', '#deptAddMembers', function() {
            $('#addMembersModal').modal({
                backdrop: 'static',
                keyboard: false
            });
        });
        $(document).on('click', '#deptEditName', function() {
            let name = $(this).prev('h3').text();
            Swal.fire({
                title: "Edit Department",
                html: '<input type="text" id="editField" value="' + name + '" class="form-control">',
                preConfirm: function() {
                    return new Promise(function(resolve) {
                        resolve([
                            $('#editField').val(),
                        ])
                    })
                },
                didOpen: function() {
                    $('#editField').focus();
                },
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Save changes',
            }).then((result) => {
                if (result.value) {
                    console.log(result.value);
                }
            });
        });

        //Workweek and Overtime settings
        $('.workweek-days').select2();

        //Workweek and Overtime save changes
        $(document).on('click', '#savedWorkweekOTsettings', function() {
            let values = {};
            $.each($('#formWorkweekOT').serializeArray(), function(i, field) {
                values[field.name] = field.value;
            });
            $.ajax({
                url: "<?= base_url() ?>/timesheet/workweekOvertimeSettings",
                type: "POST",
                dataType: "json",
                data: {
                    values: values
                },
                success: function(data) {
                    if (data == 1) {
                        Swal.fire({
                            showConfirmButton: false,
                            timer: 2000,
                            title: 'Success',
                            html: "Workweek and Overtime has been updated",
                            icon: 'success'
                        });
                    } else {
                        Swal.fire({
                            showConfirmButton: false,
                            timer: 2000,
                            title: 'Failed',
                            html: "Something is wrong in the process",
                            icon: 'warning'
                        });
                    }
                }
            });
        });
        $(document).on('keyup', 'input[name="hours_week"]', function() {
            $(this).val(function(i, val) {
                let timeParts = val.split(':'),
                    totalSeconds = parseInt(timeParts[0], 10) * 60 + parseInt(timeParts[1], 10),
                    minutes = Math.floor(totalSeconds / 60),
                    seconds = totalSeconds - (minutes * 60);
                return [minutes < 10 ? 0 : '', minutes, ':', seconds < 10 ? 0 : '', seconds].join('');
            });
        });

        //Break Preference
        //Prompt for automatic break rule
        $(document).on('change', '#breakRule', function() {
            let select = $(this).val();
            if (select == 'Automatic') {
                $('.break-pref-length').css('display', 'block');
            } else {
                $('.break-pref-length').css('display', 'none');
            }
        });
        //Break Preference save changes
        $(document).on('click', '#savedBreakPref', function() {
            let values = {};
            $.each($('#formBreakPreference').serializeArray(), function(i, field) {
                values[field.name] = field.value;
            });
            $.ajax({
                url: "<?= base_url() ?>/timesheet/breakPreference",
                method: "POST",
                dataType: "json",
                data: {
                    values: values
                },
                success: function(data) {
                    if (data == 1) {
                        Swal.fire({
                            showConfirmButton: false,
                            timer: 2000,
                            title: 'Success',
                            html: "Break Preference has been updated",
                            icon: 'success'
                        });
                    } else {
                        Swal.fire({
                            showConfirmButton: false,
                            timer: 2000,
                            title: 'Failed',
                            html: "Something is wrong in the process",
                            icon: 'warning'
                        });
                    }
                }
            });
        });
        //Manual Entries
        $(document).on('click', '#manualEntries', function() {
            let checkbox = $(this).is(':checked');
            if (checkbox == false) {
                $('#rolesContainer').addClass('disabled-section');
                $('#rolesContainer input[name="admins"]').attr('disabled', true);
                $('#rolesContainer input[name="managers"]').attr('disabled', true);
                $('#rolesContainer input[name="employees"]').attr('disabled', true);
            } else {
                $('#rolesContainer').removeClass('disabled-section');
                $('#rolesContainer input[name="admins"]').attr('disabled', false);
                $('#rolesContainer input[name="managers"]').attr('disabled', false);
                $('#rolesContainer input[name="employees"]').attr('disabled', false);
            }
        });
        // Notifications
        $(".notify-time-in").timepicker({
            interval: 60
        });
        // Notifications
        $(document).on('click', '.notify-day-cell', function() {
            $('.notify-day-cell').css('background', 'none');
            $(this).css('background', '#5ec355');
            console.log($(this).attr('data'));
        });

        //Select2 employee list
        $('.select2-employee-list').select2({
            placeholder: 'Select employee',
            width: 'resolve',
            ajax: {
                url: '<?= base_url() ?>/timesheet/getEmployees',
                type: "GET",
                dataType: "json",
                delay: 250,
                data: function(params) {
                    let query = {
                        search: params.term
                    };
                    return query;
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            },
            escapeMarkup: function(markup) {
                return markup;
            },
            templateResult: function(d) {
                let subtext = d.subtext;
                if (subtext == undefined) {
                    subtext = ''
                }
                return '<span class="text-details">' + d.text + '</span><span class="pull-right subtext">' + subtext + '</span>';
            }
        });

        $('.ts-team-member').select2({
            placeholder: 'Select employee',
            width: 'resolve',
            ajax: {
                url: '<?= base_url() ?>/timesheet/getEmployees',
                type: "GET",
                dataType: "json",
                delay: 250,
                data: function(params) {
                    let query = {
                        search: params.term
                    };
                    return query;
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            },
            escapeMarkup: function(markup) {
                return markup;
            },
            templateResult: function(d) {
                let subtext = d.subtext;
                if (subtext == undefined) {
                    subtext = ''
                }
                return '<span class="text-details">' + d.text + '</span><span class="pull-right subtext">' + subtext + '</span>';
            }
        });

        //Load dataTable
        let selected_week = $('#ts-sorting-week').val();
        let user_id = $('#tsUsersList').val();
        $('#timesheet_settings').ready(showWeekList(selected_week, user_id));

        //Country selector
        // $('#tsLocation').countrySelect();
        // Timezone picker
        $('#tsTimezone').select2({
            placeholder: 'Select Timezone',
            allowClear: true
        }).timezones().val(null);

        //Datetime picker
        $(".ts-start-date").datepicker();
        $(".ts-settings-datepicker").datepicker();
        $(".start-time").timepicker({
            interval: 60,
            change: differenceTime
        });
        $(".end-time").timepicker({
            change: differenceTime,
            interval: 60
        });

        //Show Timesheet settings table
        function showWeekList(week, user_id) {
            $('#timesheet_settings_wrapper').css('display', 'none');
            $('#timesheet_settings').css('display', 'none');
            $(".table-ts-loader").fadeIn('fast', function() {
                $('.table-ts-loader').css('display', 'block');
            });
            if (week != null) {
                $.ajax({
                    url: "<?= base_url() ?>/timesheet/showTimesheetSettings",
                    type: "GET",
                    dataType: "json",
                    data: {
                        week: week,
                        user: user_id
                    },
                    success: function(data) {
                        $(".table-ts-loader").fadeOut('fast', function() {
                            $('#timesheet_settings').html(data).removeAttr('style').DataTable({
                                "paging": false,
                                "filter": false,
                                "info": false,
                                "sort": false
                            });
                            $('#timesheet_settings_wrapper').css('display', 'block');
                            $('.table-ts-loader').css('display', 'none');
                            totalPerDay();
                            totalWeekDuration();
                        });
                        // Restriction of input field
                        // var options =  {
                        //     onKeyPress: function(cep, e, field, options) {
                        //         var masks = ['00:00'];
                        //         var mask = (cep.length>4) ? masks[1] : masks[0];
                        //         $('.ts-duration').mask(mask, options);
                        //     }};
                        // $('.ts-duration').mask("00:00",options);
                    }
                });
            }
        }

        const convertTime12to24 = (time12h) => {
            const [time, modifier] = time12h.split(' ');

            let [hours, minutes] = time.split(':');

            if (hours === '12') {
                hours = '00';
            }

            if (modifier === 'PM') {
                hours = parseInt(hours, 10) + 12;
            }

            return `${hours}:${minutes}`;
        }

        function differenceTime() {
            let start_hour = null;
            let end_hour = null;
            if ($(this).attr('id') == 'tsStartTime') {
                start_hour = convertTime12to24($(this).val()).split(':')[0];
                end_hour = convertTime12to24($(this).parent('div').next('div').children('input').val()).split(':')[0];
            } else {
                start_hour = convertTime12to24($(this).parent('div').prev('div').children('input').val()).split(':')[0];
                end_hour = convertTime12to24($(this).val()).split(':')[0];
            }
            let duration = "0h";
            if (end_hour > start_hour || duration > 0) {
                duration = end_hour - start_hour + "h";
            } else {
                duration = 'Invalid';
            }
            $('.total-duration').text(duration);

        }
        // Adding Project
        $(document).on('click', '#addProject', function() {
            $('#createProject').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('.hiddenSection').show();
            $('#tsProjectName').attr('disabled', null).val(null);
            $('#tsTeamMember').attr('disabled', null).select2('val', 'All');
            $('#tsTimezone').attr('disabled', false);
            $('#tsNotes').attr('disabled', false);
            let week = $('#ts-sorting-week').val();
            $('#weekType').val(week);
            // Clear fields
            $('#tsStartTime').val(null);
            $('#tsEndTime').val(null);
            $('#tsNotes').val(null);
            $('#tsStartDate').attr('disabled', false).val($('#presentDay').val());
            $('.total-duration').text('0h');
            if ($('#updateTSProject').length == 1) {
                $('#updateTSProject').attr('id', 'savedProject').text('Save');
            } else if ($('#updateSchedule').length == 1) {
                $('#updateSchedule').attr('id', 'savedProject').text('Save');
            }

        });
        $(document).on('click', '#savedProject', function() {
            let week = $('#ts-sorting-week').val();
            let user_id = $('#tsUsersList').val();
            let values = {};
            $.each($('#formNewProject').serializeArray(), function(i, field) {
                values[field.name] = field.value;
            });
            let duration = $('.total-duration').text();
            let timezone = values['timezone'].replace(/\s*\(.*?\)\s*/g, '');
            $.ajax({
                url: "<?= base_url() ?>/timesheet/addingProjects",
                type: "POST",
                dataType: "json",
                data: {
                    values: values,
                    timezone: timezone,
                    duration: duration
                },
                cache: false,
                success: function(data) {
                    $("#createProject").modal('hide');
                    $('#timesheet_settings').DataTable().destroy();
                    showWeekList(week, user_id);
                    if (data == 1) {
                        Swal.fire({
                            showConfirmButton: false,
                            timer: 2000,
                            title: 'Success',
                            html: "New project has been set",
                            icon: 'success'
                        });
                    } else {
                        Swal.fire({
                            showConfirmButton: false,
                            timer: 2000,
                            title: 'Failed',
                            html: "Something is wrong in the process!",
                            icon: 'warning'
                        });
                    }
                }
            });
        });
        //Toggle edit pen
        $(document).on('click', '#showEditPen', function() {
            if ($(this).next('a').css('display') === 'none') {
                $(this).next('a').css('display', 'inline-block');
            } else {
                $(this).next('a').css('display', 'none');
            }
        });

        $(document).on('change', '#tsUsersList', function() {
            let user = $(this).val();
            let week = $('#ts-sorting-week').val();
            $('#timesheet_settings').DataTable().destroy();
            showWeekList(week, user);
        });
        $(document).on('change', '#ts-sorting-week', function() {
            var week = $(this).val();
            var user = $('#tsUsersList').val();
            $('#timesheet_settings').DataTable().destroy();
            showWeekList(week, user);
        });
        $.date = function(dateObject, text) {
            var d = new Date(dateObject);
            var day = d.getDate();
            var month = d.getMonth() + 1;
            var year = d.getFullYear();
            if (day < 10) {
                day = "0" + day;
            }
            if (month < 10) {
                month = "0" + month;
            }
            var date;
            if (text == 1) {
                date = month + "/" + day + "/" + year;
            } else {
                const monthNames = ["January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"
                ];
                date = monthNames[d.getMonth()] + " " + day + "," + year;
            }


            return date;
        };
        $(document).on('click', '#updateSchedule', function() {
            let week = $('#ts-sorting-week').val();
            let user_id = $('#tsUsersList').val();
            let values = {};
            $.each($('#formNewProject').serializeArray(), function(i, field) {
                values[field.name] = field.value;
            });
            let duration = $('.total-duration').text();
            let date = $('#tsStartDate').val();
            $.ajax({
                url: '<?= base_url() ?>/timesheet/updateSchedule',
                type: "POST",
                dataType: "json",
                data: {
                    values: values,
                    duration: duration,
                    date: date
                },
                success: function(data) {
                    $('#timesheet_settings').DataTable().destroy();
                    showWeekList(week, user_id);
                    if (data === 1) {
                        $("#createProject").modal('hide');
                        Swal.fire({
                            showConfirmButton: false,
                            timer: 2000,
                            title: 'Success',
                            html: "Project has been updated",
                            icon: 'success'
                        });
                    }
                }
            });
        });

        function getTimesheetData(timesheet_id, user_id, day_id, date, day, twd_id, week) {
            $('#tsProjectName').attr('disabled', 'disabled');
            $('#tsTeamMember').attr('disabled', 'disabled');
            $('#tsTimezone').attr('disabled', 'disabled');
            $('#tsNotes').attr('disabled', 'disabled');
            $('#tsStartDate').val($.date(date, 1)).attr('disabled', 'disabled');
            $('#tsDate').text($.date(date, 0));
            if ($('#updateTSProject').length === 1) {
                $('#updateProject').attr('id', 'updateSchedule').text('Update');
            } else if ($('#savedProject').length === 1) {
                $('#savedProject').text('Update').attr('id', 'updateSchedule');
            }
            $('#timesheetId').val(timesheet_id);
            $('#userId').val(user_id);
            $('#selectedDay').val(day);
            $('#totalWeekDuration').val(twd_id);
            $('#tsScheduleId').val(day_id);
            $('#weekType').val(week);
            $('.hiddenSection').show();

            $.ajax({
                url: "<?= base_url() ?>/timesheet/getTimesheetData",
                type: "GET",
                data: {
                    timesheet_id: timesheet_id,
                    day_id: day_id
                },
                dataType: "json",
                success: function(data) {
                    $('#tsProjectName').val(data.project_name);
                    // $('#tsLocation').val(data.location);
                    $('#tsNotes').val(data.notes);
                    $('#tsTeamMember').next($('#select2-tsTeamMember-container').attr('title', data.team_member).html(data.team_member));
                    $('#tsTimezone').next($('#select2-tsTimezone-container').attr('title', data.timezone).html(data.timezone));
                    $('#tsStartTime').val(data.start_time);
                    $('#tsEndTime').val(data.end_time);
                    $('.total-duration').text(data.total_duration + "h");
                }
            });
        }
        //Updating duration
        // Monday
        $(document).on('click', '#tsMonday', function() {
            $('#createProject').modal({
                backdrop: 'static',
                keyboard: false
            });
            let day_id = $(this).attr('data-id');
            let timesheet_id = $(this).closest('tr').attr('data-id');
            let date = $(this).attr('data-date');
            let user_id = $(this).attr('data-user');
            let day = $(this).attr('data-day');
            let twd_id = $('#totalWeekDuration-' + user_id).attr('data-id');
            let week = $('#ts-sorting-week').val();
            getTimesheetData(timesheet_id, user_id, day_id, date, day, twd_id, week);
        });
        // Tuesday
        $(document).on('click', '#tsTuesday', function() {
            $('#createProject').modal({
                backdrop: 'static',
                keyboard: false
            });
            var day_id = $(this).attr('data-id');
            var timesheet_id = $(this).closest('tr').attr('data-id');
            var date = $(this).attr('data-date');
            var user_id = $(this).attr('data-user');
            var day = $(this).attr('data-day');
            var twd_id = $('#totalWeekDuration-' + user_id).attr('data-id');
            var week = $('#ts-sorting-week').val();
            getTimesheetData(timesheet_id, user_id, day_id, date, day, twd_id, week);
        });
        //Wednesday
        $(document).on('click', '#tsWednesday', function() {
            $('#createProject').modal({
                backdrop: 'static',
                keyboard: false
            });
            var day_id = $(this).attr('data-id');
            var timesheet_id = $(this).closest('tr').attr('data-id');
            var date = $(this).attr('data-date');
            var user_id = $(this).attr('data-user');
            var day = $(this).attr('data-day');
            var twd_id = $('#totalWeekDuration-' + user_id).attr('data-id');
            var week = $('#ts-sorting-week').val();
            getTimesheetData(timesheet_id, user_id, day_id, date, day, twd_id, week);
        });
        //Thursday
        $(document).on('click', '#tsThursday', function() {
            $('#createProject').modal({
                backdrop: 'static',
                keyboard: false
            });
            var day_id = $(this).attr('data-id');
            var timesheet_id = $(this).closest('tr').attr('data-id');
            var date = $(this).attr('data-date');
            var user_id = $(this).attr('data-user');
            var day = $(this).attr('data-day');
            var twd_id = $('#totalWeekDuration-' + user_id).attr('data-id');
            var week = $('#ts-sorting-week').val();
            getTimesheetData(timesheet_id, user_id, day_id, date, day, twd_id, week);
        });
        //Friday
        $(document).on('click', '#tsFriday', function() {
            $('#createProject').modal({
                backdrop: 'static',
                keyboard: false
            });
            var day_id = $(this).attr('data-id');
            var timesheet_id = $(this).closest('tr').attr('data-id');
            var date = $(this).attr('data-date');
            var user_id = $(this).attr('data-user');
            var day = $(this).attr('data-day');
            var twd_id = $('#totalWeekDuration-' + user_id).attr('data-id');
            var week = $('#ts-sorting-week').val();
            getTimesheetData(timesheet_id, user_id, day_id, date, day, twd_id, week);
        });
        //Saturday
        $(document).on('click', '#tsSaturday', function() {
            $('#createProject').modal({
                backdrop: 'static',
                keyboard: false
            });
            var day_id = $(this).attr('data-id');
            var timesheet_id = $(this).closest('tr').attr('data-id');
            var date = $(this).attr('data-date');
            var user_id = $(this).attr('data-user');
            var day = $(this).attr('data-day');
            var twd_id = $('#totalWeekDuration-' + user_id).attr('data-id');
            var week = $('#ts-sorting-week').val();
            getTimesheetData(timesheet_id, user_id, day_id, date, day, twd_id, week);
        });
        //Sunday
        $(document).on('click', '#tsSunday', function() {
            $('#createProject').modal({
                backdrop: 'static',
                keyboard: false
            });
            let day_id = $(this).attr('data-id');
            let timesheet_id = $(this).closest('tr').attr('data-id');
            let date = $(this).attr('data-date');
            let user_id = $(this).attr('data-user');
            let day = $(this).attr('data-day');
            let twd_id = $('#totalWeekDuration-' + user_id).attr('data-id');
            let week = $('#ts-sorting-week').val();
            getTimesheetData(timesheet_id, user_id, day_id, date, day, twd_id, week);
        });
        //Calculation total duration
        function totalPerDay() {
            let mon_total = 0,
                tue_total = 0,
                wed_total = 0,
                thu_total = 0,
                fri_total = 0,
                sat_total = 0,
                sun_total = 0;
            //Monday total
            $("input[name$='monday']").each(function() {
                let monday = parseInt($(this).val());
                if (isNaN(monday)) {
                    monday = 0;
                }
                mon_total += parseInt($(this).val());
            });
            if (isNaN(mon_total)) {
                mon_total = 0;
            }
            $('#totalMonday').text(mon_total + "h");
            //Tuesday total
            $("input[name$='tuesday']").each(function() {
                let tuesday = parseInt($(this).val());
                if (isNaN(tuesday)) {
                    tuesday = 0
                }
                tue_total += tuesday;
            });
            if (isNaN(tue_total)) {
                tue_total = 0;
            }
            $('#totalTuesday').text(tue_total + "h");
            //Wednesday total
            $("input[name$='wednesday']").each(function() {
                let wednesday = parseInt($(this).val());
                if (isNaN(wednesday)) {
                    wednesday = 0;
                }
                wed_total += wednesday;
            });
            if (isNaN(wed_total)) {
                wed_total = 0;
            }
            $('#totalWednesday').text(wed_total + "h");
            //Thursday total
            $("input[name$='thursday']").each(function() {
                let thursday = parseInt($(this).val());
                if (isNaN(thursday)) {
                    thursday = 0;
                }
                thu_total += thursday;
            });
            if (isNaN(thu_total)) {
                thu_total = 0;
            }
            $('#totalThursday').text(thu_total + "h");
            //Friday total
            $("input[name$='friday']").each(function() {
                let friday = parseInt($(this).val());
                if (isNaN(friday)) {
                    friday = 0;
                }
                fri_total += friday;
            });
            if (isNaN(fri_total)) {
                fri_total = 0;
            }
            $('#totalFriday').text(fri_total + "h");
            //Saturday total
            $("input[name$='saturday']").each(function() {
                let saturday = parseInt($(this).val());
                if (isNaN(saturday)) {
                    saturday = 0;
                }
                sat_total += saturday;
            });
            if (isNaN(sat_total)) {
                sat_total = 0;
            }
            $('#totalSaturday').text(sat_total + "h");
            //Sunday total
            $("input[name$='sunday']").each(function() {
                let sunday = parseInt($(this).val());
                if (isNaN(sunday)) {
                    sunday = 0;
                }
                sun_total += sunday;
            });
            if (isNaN(sun_total)) {
                sun_total = 0;
            }
            $('#totalSunday').text(sun_total + "h");

        }

        function totalWeekDuration() {
            let total_week = 0;
            $('.totalWeek').each(function() {
                total_week += parseInt($(this).text());
            });
            if (isNaN(total_week)) {
                total_week = 0;
            }
            $('#totalWeekDuration').text(total_week + "h");
        }

        function leftPad(number, targetLength) {
            let output = number + '';
            while (output.length < targetLength) {
                output = '0' + output;
            }
            return output;
        }

        //Updating Project data
        $(document).on('click', '#showProjectData', function() {
            let id = $(this).attr('data-id');
            $('#createProject').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('.hiddenSection').hide();
            $.ajax({
                url: '<?= base_url() ?>/timesheet/getProjectData',
                type: "GET",
                dataType: "json",
                data: {
                    id: id
                },
                success: function(data) {
                    $('#tsProjectName').val(data.name).attr('disabled', false);
                    $('#tsNotes').val(data.notes).attr('disabled', false);
                    $('#tsTimezone').attr('disabled', false).val(data.location).next('.flag-dropdown').children('.selected-flag').attr('title', data.location).children('.flag').removeClass('us').addClass('ph');
                    if ($('#savedProject').length == 1) {
                        $('#savedProject').attr('id', 'updateTSProject').text('Update').attr('data-id', id);
                    } else if ($('#updateSchedule').length == 1) {
                        $('#updateSchedule').attr('id', 'updateTSProject').attr('data-id', id);
                    }
                }
            });
        });
        $(document).on('click', '#updateTSProject', function() {
            let week = $('#ts-sorting-week').val();
            let user = $('#tsUsersList').val();
            let id = $(this).attr('data-id');
            let values = {};
            $.each($('#formNewProject').serializeArray(), function(i, field) {
                values[field.name] = field.value;
            });
            let timezone = null;
            if (values['timezone'] != null) {
                timezone = values['timezone'].replace(/\s*\(.*?\)\s*/g, '');
            } else {
                timezone = null;
            }
            $.ajax({
                url: "<?= base_url() ?>/timesheet/updateTSProject",
                type: "POST",
                dataType: 'json',
                data: {
                    values: values,
                    timezone: timezone,
                    id: id
                },
                success: function(data) {
                    if (data == 1) {
                        $('#timesheet_settings').DataTable().destroy();
                        showWeekList(week, user);
                        $("#createProject").modal('hide');
                        Swal.fire({
                            showConfirmButton: false,
                            timer: 2000,
                            title: 'Success',
                            html: "Project <strong>" + values['project'] + "</strong> has been updated",
                            icon: 'success'
                        });
                    } else {
                        console.log('test');
                    }
                }
            });
        });

        //Deleting Project
        $(document).on('click', '#removeProject', function() {
            let id = $(this).attr('data-id');
            let project_name = $(this).attr('data-name');
            let week = $('#ts-sorting-week').val();
            let user = $('#tsUsersList').val();
            Swal.fire({
                title: 'Are you sure to delete this?',
                html: "Project name: <strong>" + project_name + "</strong>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '<?= base_url() ?>/timesheet/deleteProjectData',
                        method: "POST",
                        data: {
                            id: id
                        },
                        success: function() {
                            $('#timesheet_settings').DataTable().destroy();
                            showWeekList(week, user);
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: 'Success',
                                html: "Project <strong>" + project_name + "</strong> has been deleted!",
                                icon: 'success'
                            });
                        }
                    });
                }
            });
        });

    });
</script>