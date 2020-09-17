<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style type="text/css">
    #ts_schedule_tbl thead td{
        text-align: center!important;
        font-size: 14px!important;
        font-weight: bold!important;
    }
    #ts_schedule_tbl .day{
        background: #d6e6f3;
    }
    .week-day, .week-date,.employee-name,.sub-text{
        display: block;
    }
    .employee-name{
        font-weight: bold;
    }
    .sub-text{
        font-style: italic;
        color: grey;
    }
    .center{
        text-align: center;
    }
    .ts_schedule{
        width: 200px;
    }
    .week-label{
        font-weight: bold;
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

                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Time Schedule</h1>
                        <!-- <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Manage Timesheets</li>
                        </ol> -->
                    </div>
                    <!-- <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <?php if (hasPermissions('users_add')): ?>
                                    <a href="<?php echo url('users/add_timesheet_entry') ?>" class="btn btn-primary"
                                       aria-expanded="false">
                                        <i class="mdi mdi-settings mr-2"></i> New Timesheet Entry
                                    </a>
                                <?php endif ?>
                            </div>
                        </div>
                    </div> -->
                </div>
                <div class="row" style="padding-bottom: 20px;">
                    <div class="col-md-12 banking-tab-container">
                        <a href="<?php echo url('/timesheet/attendance')?>" class="banking-tab" style="text-decoration: none">Attendance</a>
                        <a href="<?php echo url('/timesheet/employee')?>" class="banking-tab"style="text-decoration: none">Employee</a>
                        <a href="<?php echo url('/timesheet/schedule')?>" class="banking-tab<?php echo ($this->uri->segment(1)=="schedule")?:'-active';?>">Schedule</a>
                        <a href="<?php echo url('/timesheet/list')?>" class="banking-tab">List</a>
                        <a href="<?php echo url('/timesheet/settings')?>" class="banking-tab">Settings</a>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Date Selector -->
                            <div class="row">
                                <div class="col-lg-3" style="margin-bottom: 12px">
                                    <label for="scheduleWeek" class="week-label">Week of :</label>
                                    <input type="text" id="scheduleWeek" class="form-control ts_schedule" value="<?php echo date('m/d/Y',strtotime('monday this week'))?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 table-responsive">
                                    <table id="ts_schedule_tbl" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <td>Dept</td>
                                                <td>Employee</td>
                                                <td>Status</td>
                                                <td class="day"><span class="week-day">Mon</span><span class="week-date"><?php echo $date_this_week['Monday']?></span></td>
                                                <td class="day"><span class="week-day">Tue</span><span class="week-date"><?php echo $date_this_week['Tuesday']?></span></td>
                                                <td class="day"><span class="week-day">Wed</span><span class="week-date"><?php echo $date_this_week['Wednesday']?></span></td>
                                                <td class="day"><span class="week-day">Thu</span><span class="week-date"><?php echo $date_this_week['Thursday']?></span></td>
                                                <td class="day"><span class="week-day">Fri</span><span class="week-date"><?php echo $date_this_week['Friday']?></span></td>
                                                <td class="day"><span class="week-day">Sat</span><span class="week-date"><?php echo $date_this_week['Saturday']?></span></td>
                                                <td class="day"><span class="week-day">Sun</span><span class="week-date"><?php echo $date_this_week['Sunday']?></span></td>
                                                <td>Hours</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $roles = null;
                                            $name = null;
                                            $status = null;
                                        ?>
                                        <?php foreach ($users as $user): ?>
                                            <?php
                                                $name = $user->FName." ".$user->LName;
                                                foreach ($user_roles as $role){
                                                    if ($user->role == $role->id){
                                                        $roles = $role->title;
                                                    }
                                                }

                                            switch ($user->status) {
                                                case 1:
                                                    $status = 'Fulltime';
                                                    break;
                                                default:
                                                    $status = null;
                                            }
                                            ?>
                                            <tr>
                                                <td class="center"><?php echo $roles;?></td>
                                                <td><span class="employee-name"><?php echo $name;?></span><span class="sub-text"><?php echo $roles?></span></td>
                                                <td class="center"><?php echo $status;?></td>
                                                <td class="center"></td>
                                                <td class="center"></td>
                                                <td class="center"></td>
                                                <td class="center"></td>
                                                <td class="center"></td>
                                                <td class="center"></td>
                                                <td class="center"></td>
                                                <td></td>
                                            </tr>
                                            <?php
                                            $roles = null;
                                            $name = null;
                                            $status = null;
                                            ?>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
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
    $(document).ready(function () {

        //Datepicker
        $(".ts_schedule").datepicker();

        var selected_week = $('#scheduleWeek').val();
        $('#ts_schedule_tbl').ready(showScheduleTable(selected_week));
        $(document).on('change','#scheduleWeek',function () {
            var week = $(this).val();
            console.log(week);
            showScheduleTable(week);
        });
        function showScheduleTable(week) {
            $("#ts_schedule_tbl").DataTable().destroy();
            if(week != null){
                $.ajax({
                    url: "/timesheet/showScheduleTable",
                    type:"GET",
                    data:{week:week},
                    dataType:"json",
                    success:function (data) {
                        $('#ts_schedule_tbl').html(data).DataTable({"sort": false});
                    }
                });
            }
        }
    });
</script>