<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style type="text/css">
    .red{
        background-color: red;
    }
    input[type='radio']:after {
        width: 25px;
        height: 24px;
        border-radius: 15px;
        top: -9px;
        left: -6px;
        position: relative;
        /*background-color: #d1d3d1;*/
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid white;
    }

    input[type='radio']:checked:after {
        width: 25px;
        height: 24px;
        border-radius: 15px;
        top: -9px;
        left: -6px;
        position: relative;
        background-color: red;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid white;
    }
    th{
        text-align: center;
    }
    #tsEmployeeDatepicker{
        width: 220px;
        margin-bottom: 12px;
    }
    #tsEmployeeDataTable .day{
        background: #53b84a;
    }
    #tsEmployeeDataTable .tbl-day,.tbl-date,.tbl-emp-name,.tbl-emp-role,.tbl-status{
        display: block;
    }
    #tsEmployeeDataTable .tbl-emp-name,.tbl-emp-status{
        font-weight: bold;
    }
    #tsEmployeeDataTable .tbl-emp-role{
        font-style: italic;
        color: grey;
    }
    .center{
        text-align: center;
    }
    .label-datepicker{
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
                        <h1 class="page-title">Time Employee Overview </h1>
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
                        <a href="<?php echo url('/timesheet/employee')?>" class="banking-tab<?php echo ($this->uri->segment(1)=="employee")?:'-active';?>"style="text-decoration: none">Employee</a>
                        <a href="<?php echo url('/timesheet/schedule')?>" class="banking-tab">Schedule</a>
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
                                <div class="col-lg-3" style="">
                                    <label for="tsEmployeeDatepicker" class="label-datepicker">Week of :</label>
                                    <input type="text" class="form-control" id="tsEmployeeDatepicker" value="<?php echo date('m/d/Y',strtotime('monday this week'))?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 table-responsive">
                                    <table id="tsEmployeeDataTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Employee</th>
                                                <th><span class="tbl-status">Current</span><span class="tbl-status">Status</span></th>
                                                <th class="day"><span class="tbl-day">Mon</span><span class="tbl-date"><?php echo $date_this_week['Monday']?></span></th>
                                                <th class="day"><span class="tbl-day">Tue</span><span class="tbl-date"><?php echo $date_this_week['Tuesday']?></span></th>
                                                <th class="day"><span class="tbl-day">Wed</span><span class="tbl-date"><?php echo $date_this_week['Wednesday']?></span></th>
                                                <th class="day"><span class="tbl-day">Thu</span><span class="tbl-date"><?php echo $date_this_week['Thursday']?></span></th>
                                                <th class="day"><span class="tbl-day">Fri</span><span class="tbl-date"><?php echo $date_this_week['Friday']?></span></th>
                                                <th class="day"><span class="tbl-day">Sat</span><span class="tbl-date"><?php echo $date_this_week['Saturday']?></span></th>
                                                <th class="day"><span class="tbl-day">Sun</span><span class="tbl-date"><?php echo $date_this_week['Sunday']?></span></th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $name = null;
                                                $role = null;
                                                $bg_color = '#f71111bf';
                                                $status = 'LOA';
                                                $mon_duration = null;
                                                $tue_duration = null;
                                                $wed_duration = null;
                                                $thu_duration = null;
                                                $fri_duration = null;
                                                $sat_duration = null;
                                                $sun_duration = null;
                                                $shift_duration = null;
                                            ?>
                                            <?php foreach ($users as $user): ?>
                                                <?php
                                                    $name = $user->FName." ".$user->LName;
                                                    foreach ($user_roles as $roles){
                                                        if ($roles->id == $user->role){
                                                            $role = $roles->title;
                                                        }
                                                    }
                                                foreach ($ts_logs as $log){
                                                    if ($log->action == 'Check in' && $log->user_id == $user->id && $log->date == date('Y-m-d')){
                                                        $bg_color = 'greenyellow';
                                                        $status = 'In';
                                                    }elseif($log->action == 'Check out' && $log->user_id == $user->id && $log->date == date('Y-m-d')){
                                                        $status = 'Out';
                                                        $bg_color = '#f71111bf';
                                                    }elseif ($log->action == 'Break in' && $log->user_id == $user->id && $log->date == date('Y-m-d')){
                                                        $status = 'On Lunch';
                                                        $bg_color = '#ffc859';
                                                    }elseif ($log->action == 'Break out' && $log->user_id == $user->id && $log->date == date('Y-m-d')) {
                                                        $status = 'In';
                                                        $bg_color = 'greenyellow';
                                                    }
                                                }
                                                foreach ($attendance as $attn){
                                                        if ($attn->user_id == $user->id && $attn->shift_duration > 0){
                                                            switch ($attn->date){
                                                                case (date('Y-m-d',strtotime('monday'))):
                                                                    $mon_duration = $attn->shift_duration;
                                                                break;
                                                                case (date('Y-m-d',strtotime('tuesday'))):
                                                                    $tue_duration = $attn->shift_duration;
                                                                break;
                                                                case (date('Y-m-d',strtotime('wednesday'))):
                                                                    $wed_duration = $attn->shift_duration;
                                                                break;
                                                                case (date('Y-m-d',strtotime('thursday'))):
                                                                    $thu_duration = $attn->shift_duration;
                                                                break;
                                                                case (date('Y-m-d',strtotime('friday'))):
                                                                    $fri_duration = $attn->shift_duration;
                                                                break;
                                                                case (date('Y-m-d',strtotime('saturday'))):
                                                                    $sat_duration = $attn->shift_duration;
                                                                break;
                                                                case (date('Y-m-d',strtotime('sunday'))):
                                                                    $sun_duration = $attn->shift_duration;
                                                                break;
                                                            }
                                                        }
                                                }
                                                foreach ($week_duration as $week){
                                                    if ($user->id == $week->user_id && $week->week_of == date('Y-m-d',strtotime('monday this week'))){
                                                        $shift_duration = $week->total_shift;
                                                    }
                                                }

                                                ?>
                                            <tr>
                                                <td><span class="tbl-emp-name"><?php echo $name;?></span><span class="tbl-emp-role"><?php echo $role;?></span></td>
                                                <td class="center" style="background-color: <?php echo $bg_color;?>"><span class="tbl-emp-status"><?php echo $status?></span></td>
                                                <td class="center"><?php echo $mon_duration;?></td>
                                                <td class="center"><?php echo $tue_duration;?></td>
                                                <td class="center"><?php echo $wed_duration;?></td>
                                                <td class="center"><?php echo $thu_duration;?></td>
                                                <td class="center"><?php echo $fri_duration;?></td>
                                                <td class="center"><?php echo $sat_duration;?></td>
                                                <td class="center"><?php echo $sun_duration;?></td>
                                                <td class="center"><?php echo $shift_duration;?></td>
                                            </tr>
                                                <?php
                                                    $name = null;
                                                    $role = null;
                                                    $bg_color = '#f71111bf';
                                                    $status = 'LOA';
                                                    $mon_duration = null;
                                                    $tue_duration = null;
                                                    $wed_duration = null;
                                                    $thu_duration = null;
                                                    $fri_duration = null;
                                                    $sat_duration = null;
                                                    $sun_duration = null;
                                                    $shift_duration = null;
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
        // DataTable
        $('#tsEmployeeDataTable').DataTable({
            "sort": false
        });
        // Datepicker
        $("#tsEmployeeDatepicker").datepicker();
    });

</script>