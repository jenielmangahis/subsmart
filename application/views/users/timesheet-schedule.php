<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style type="text/css">
    #ts_schedule_tbl thead td {
        text-align: center !important;
        font-size: 14px !important;
        font-weight: bold !important;
        padding: 10px;
    }

    #ts_schedule_tbl .day {
        background: #d6e6f3;
    }

    .week-day,
    .week-date,
    .employee-name,
    .sub-text {
        display: block;
    }

    .employee-name {
        font-weight: bold;
    }

    .sub-text {
        font-style: italic;
        color: grey;
    }

    .center {
        text-align: center;
    }

    .ts_schedule {
        width: 200px;
    }

    .week-label {
        font-weight: bold;
    }

    /*Table loader*/
    #ts_schedule_tbl_wrapper {
        display: none;
    }

    .table-ts-loader {
        display: block;
        margin: 0 auto;
        clear: both;
        position: relative;
        z-index: 20;
        width: 100%;
        min-height: 100px;
        background: rgb(128 128 128 / 18%);
    }

    .table-ts-loader img {
        width: 80px;
        height: 80px;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
    }

    .table-responsive {
        overflow-x: hidden;
    }
</style>
<?php
//dd(logged());die;
?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/employee'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">

                <!--<div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Time Schedule</h1>-->
                <!-- <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Manage Timesheets</li>
                        </ol> -->
                <!--</div>-->
                <!-- <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <?php //if (hasPermissions('users_add')): 
                                ?>
                                    <a href="<?php //echo url('users/add_timesheet_entry') 
                                                ?>" class="btn btn-primary"
                                       aria-expanded="false">
                                        <i class="mdi mdi-settings mr-2"></i> New Timesheet Entry
                                    </a>
                                <?php //endif 
                                ?>
                            </div>
                        </div>
                    </div> -->
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-sm-12">
                            <h3 class="page-title">Time Schedule</h3>
                        </div>
                        <div class="row" style="padding: 10px 33px 20px 33px;">
                            <div class="col-md-12 banking-tab-container">
                                <a href="<?php echo url('/timesheet/attendance') ?>" class="banking-tab" style="text-decoration: none">Attendance</a>
                                <a href="<?php echo url('/timesheet/notification') ?>" class="banking-tab">Notification</a>
                                <a href="<?php echo url('/timesheet/employee') ?>" class="banking-tab" style="text-decoration: none">Employee</a>
                                <a href="<?php echo url('/timesheet/schedule') ?>" class="banking-tab<?php echo ($this->uri->segment(1) == "schedule") ?: '-active'; ?>">Schedule</a>
                                <a href="<?php echo url('/timesheet/list') ?>" class="banking-tab">List</a>
                                <a href="<?php echo url('/timesheet/settings') ?>" class="banking-tab">Settings</a>
                            </div>
                        </div>
                        <!-- Date Selector -->
                        <div class="row">
                            <div class="col-lg-3" style="margin-bottom: 12px">
                                <label for="scheduleWeek" class="week-label">Week of :</label>
                                <input type="text" id="scheduleWeek" class="form-control ts_schedule" value="<?php echo date('m/d/Y', strtotime('monday this week')) ?>">
                            </div>
                            <div class="col-lg-5" style="margin-bottom: 12px"></div>
                            <div class="col-lg-4 eft">
                                <div class="action-btn-container">
                                    <button id="schedule_save_btn" class="btn btn-success action-btn" id="schedule_save_btn" data-approved="100" disabled="true"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save changes</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 table-responsive">
                                <div class="table-wrapper-settings">
                                    <table id="ts_schedule_tbl" class="table table-hover table-striped dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="ts_schedule_tbl_info">

                                    </table>
                                    <div class="table-ts-loader" style="display:none;">
                                        <img class="ts-loader-img" src="<?= base_url() ?>/assets/css/timesheet/images/ring-loader.svg" alt="">
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
    $(document).ready(function() {

        //Datepicker
        $(".ts_schedule").datepicker();

        let selected_week = $('#scheduleWeek').val();
        $('#ts_schedule_tbl').ready(showScheduleTable(selected_week));
        $(document).on('change', '#scheduleWeek', function() {
            let week = $(this).val();
            $("#ts_schedule_tbl").DataTable().destroy();
            showScheduleTable(week);
        });

        function showScheduleTable(week) {
            $('#ts_schedule_tbl_wrapper').css('display', 'none');
            $('#ts_schedule_tbl').css('display', 'none');
            $(".table-ts-loader").fadeIn('fast', function() {
                $('.table-ts-loader').css('display', 'block');
            });
            if (week != null) {
                $.ajax({
                    url: baseURL + "/timesheet/showScheduleTable",
                    type: "GET",
                    data: {
                        week: week
                    },
                    dataType: "json",
                    success: function(data) {
                        $(".table-ts-loader").fadeOut('fast', function() {
                            $('#ts_schedule_tbl').html(data).removeAttr('style').css('width', '100%').DataTable({
                                "sort": false
                            });
                            $('#ts_schedule_tbl_wrapper').css('display', 'block');
                            $('.table-ts-loader').css('display', 'none');
                            // console.log(data);
                        });
                    }
                });
            }
        }
    });
</script>