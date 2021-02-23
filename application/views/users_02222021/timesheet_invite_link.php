<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style type="text/css">
    .card-body{
        min-height: 446px;
    }
    .invite-link-container{
        width: 60%;
        height: 100%;
        margin: 0 auto;
        text-align: center;
    }
</style>
<div class="wrapper" role="wrapper">
<!--    --><?php //include viewPath('includes/sidebars/employee'); ?>
    <!-- page wrapper start -->
    <div wrapper__section style="margin-left: 0;">
        <div class="container-fluid">
            <div class="page-title-box">
<!--                <div class="row" style="padding-bottom: 20px;">-->
<!--                    <div class="col-md-12 banking-tab-container">-->
<!--                        <a href="--><?php //echo url('/timesheet/attendance')?><!--" class="banking-tab" style="text-decoration: none">Attendance</a>-->
<!--                        <a href="--><?php //echo url('/timesheet/employee')?><!--" class="banking-tab"style="text-decoration: none">Employee</a>-->
<!--                        <a href="--><?php //echo url('/timesheet/schedule')?><!--" class="banking-tab">Schedule</a>-->
<!--                        <a href="--><?php //echo url('/timesheet/list')?><!--" class="banking-tab">List</a>-->
<!--                        <a href="--><?php //echo url('/timesheet/settings')?><!--" class="banking-tab--><?php //echo ($this->uri->segment(1)=="settings")?:'-active';?><!--">Settings</a>-->
<!--                    </div>-->
<!--                </div>-->
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="padding: 0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="invite-link-container">
                                        <h5>Someone invited you to be part of a team.</h5>
                                        <span>Do you want to join there team?</span>
                                        <div class="form-group">
                                            <button class="btn btn-success">Accept</button>
                                            <button class="btn btn-default">Decline</button>
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

<?php include viewPath('includes/footer'); ?>
<script>


</script>