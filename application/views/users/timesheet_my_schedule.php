<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>

<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/employee'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="card">
                <div class="col-sm-12">
                    <h3 class="page-title left">Shift Schedule</h3>
                </div>
                <div class="row" style="padding: 10px 33px 20px 33px;">
                    <div class="col-md-12 banking-tab-container">
                        <a href="<?php echo url('/timesheet/attendance') ?>" class="banking-tab" style="text-decoration: none">Attendance</a>
                        <?php if ($this->session->userdata('logged')['role'] < 5) : ?>
                            <a href="<?php echo url('/timesheet/attendance_logs') ?>" class="banking-tab">Time Logs</a>
                            <a href="<?php echo url('/timesheet/notification') ?>" class="banking-tab">Notification</a>
                            <a href="<?php echo url('/timesheet/employee') ?>" class="banking-tab">Employee</a>
                            <a href="<?php echo url('/timesheet/schedule') ?>" class="banking-tab">Schedule</a>
                            <a href="<?php echo url('/timesheet/list') ?>" class="banking-tab">List</a>
                            <a href="<?php echo url('/timesheet/requests') ?>" class="banking-tab">Requests</a>
                        <?php endif; ?>
                        <a href="<?php echo url('/timesheet/my_schedule') ?>" class="banking-tab-active">My Schedule</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div id='calendar'></div>
                    </div>
                </div>

            </div>
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>