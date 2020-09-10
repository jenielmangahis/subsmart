<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style type="text/css">
    th{
        text-align: center;
    }
    .center{
        text-align: center;
    }
    .label-date{
        font-weight: bold;
    }
    .list_datepicker{
        width: 200px;
    }
    .action-btn-container{
        position: absolute;
        bottom: 0;
        right: 0;
    }
    .action-btn-container .action-btn{
        display: inline-block;
        margin-right: 8px;
    }
    #tbl-list .thead-day,.thead-date{
        display: block;
        color: #ffffff;
    }
    #tbl-list .day{
        background: #0b97c4;
    }
    #tbl-list .list-emp-name,.list-emp-role{
        display: block;
    }
    #tbl-list .list-emp-name,.list-emp-status{
        font-weight: bold;
    }
    #tbl-list .list-emp-role{
        font-style: italic;
        color: grey;
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
                        <h1 class="page-title">List View</h1>
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
                        <a href="<?php echo url('/timesheet/attendance')?>" class="banking-tab">Attendance</a>
                        <a href="<?php echo url('/timesheet/employee')?>" class="banking-tab">Employee</a>
                        <a href="<?php echo url('/timesheet/schedule')?>" class="banking-tab">Schedule</a>
                        <a href="<?php echo url('/timesheet/list')?>" class="banking-tab<?php echo ($this->uri->segment(1)=="list")?:'-active';?>"style="text-decoration: none">List</a>
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
                            <div class="row" style="margin-bottom: 12px">
                                <div class="col-lg-3" style="">
                                    <label class="label-date" for="tsListPicker">Week of :</label>
                                    <input type="text" id="tsListPicker" class="form-control list_datepicker" value="<?php echo date('m/d/Y',strtotime('monday this week'))?>">
                                </div>
                                <div class="col-lg-5"></div>
                                <div class="col-lg-4">
                                    <div class="action-btn-container">
                                        <button class="btn btn-success action-btn">Clock In/Out</button>
                                        <button class="btn btn-info action-btn">Adjust Entry</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 table-responsive">
                                    <table id="tbl-list" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Employee</th>
                                                <th>Status</th>
                                                <th class="day"><span class="thead-day">Mon</span><span class="thead-date"><?php echo $date_this_week['Monday']?></span></th>
                                                <th class="day"><span class="thead-day">Tue</span><span class="thead-date"><?php echo $date_this_week['Tuesday']?></span></th>
                                                <th class="day"><span class="thead-day">Wed</span><span class="thead-date"><?php echo $date_this_week['Wednesday']?></span></th>
                                                <th class="day"><span class="thead-day">Thu</span><span class="thead-date"><?php echo $date_this_week['Thursday']?></span></th>
                                                <th class="day"><span class="thead-day">Fri</span><span class="thead-date"><?php echo $date_this_week['Friday']?></span></th>
                                                <th class="day"><span class="thead-day">Sat</span><span class="thead-date"><?php echo $date_this_week['Saturday']?></span></th>
                                                <th class="day"><span class="thead-day">Sun</span><span class="thead-date"><?php echo $date_this_week['Sunday']?></span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $user_id = 0;
                                                $name = null;
                                                $role = null;
                                                $status = null;
                                                $mon_logtime = null;
                                                $tue_logtime = null;
                                                $wed_logtime = null;
                                                $thu_logtime = null;
                                                $fri_logtime = null;
                                                $sat_logtime = null;
                                                $sun_logtime = null;
                                            ?>
                                            <?php foreach ($users as $user): ?>
                                            <?php
                                                $user_id = $user->id;
                                                $name = $user->FName." ".$user->LName;
                                                foreach ($user_roles as $roles){
                                                    if ($roles->id == $user->role){
                                                        $role = $roles->title;
                                                    }
                                                }
                                                foreach ($ts_logs as $log){
                                                    if ($log->action == 'Check in' && $log->user_id == $user->id && $log->date == date('Y-m-d')){
                                                        $status = 'In';
                                                        switch ($log->date){
                                                            case (date('Y-m-d',strtotime('monday'))):
                                                                $mon_logtime = date('h:i A',strtotime($log->time));
                                                                break;
                                                            case (date('Y-m-d',strtotime('tuesday'))):
                                                                $tue_logtime = date('h:i A',strtotime($log->time));
                                                                break;
                                                            case (date('Y-m-d',strtotime('wednesday'))):
                                                                $wed_logtime = date('h:i A',strtotime($log->time));
                                                                break;
                                                            case (date('Y-m-d',strtotime('thursday'))):
                                                                $thu_logtime = date('h:i A',strtotime($log->time));
                                                                break;
                                                            case (date('Y-m-d',strtotime('friday'))):
                                                                $fri_logtime = date('h:i A',strtotime($log->time));
                                                                break;
                                                            case (date('Y-m-d',strtotime('saturday'))):
                                                                $sat_logtime = date('h:i A',strtotime($log->time));
                                                                break;
                                                            case (date('Y-m-d',strtotime('sunday'))):
                                                                $sun_logtime = date('h:i A',strtotime($log->time));
                                                                break;
                                                        }
                                                    }elseif($log->action == 'Check out' && $log->user_id == $user->id && $log->date == date('Y-m-d')){
                                                        $status = 'Out';
                                                        switch ($log->date){
                                                            case (date('Y-m-d',strtotime('monday'))):
                                                                $mon_logtime = date('h:i A',strtotime($log->time));
                                                                break;
                                                            case (date('Y-m-d',strtotime('tuesday'))):
                                                                $tue_logtime = date('h:i A',strtotime($log->time));
                                                                break;
                                                            case (date('Y-m-d',strtotime('wednesday'))):
                                                                $wed_logtime = date('h:i A',strtotime($log->time));
                                                                break;
                                                            case (date('Y-m-d',strtotime('thursday'))):
                                                                $thu_logtime = date('h:i A',strtotime($log->time));
                                                                break;
                                                            case (date('Y-m-d',strtotime('friday'))):
                                                                $fri_logtime = date('h:i A',strtotime($log->time));
                                                                break;
                                                            case (date('Y-m-d',strtotime('saturday'))):
                                                                $sat_logtime = date('h:i A',strtotime($log->time));
                                                                break;
                                                            case (date('Y-m-d',strtotime('sunday'))):
                                                                $sun_logtime = date('h:i A',strtotime($log->time));
                                                                break;
                                                        }
                                                    }elseif ($log->action == 'Break in' && $log->user_id == $user->id && $log->date == date('Y-m-d')){
                                                        $status = 'On Lunch';
                                                        switch ($log->date){
                                                            case (date('Y-m-d',strtotime('monday'))):
                                                                $mon_logtime = date('h:i A',strtotime($log->time));
                                                                break;
                                                            case (date('Y-m-d',strtotime('tuesday'))):
                                                                $tue_logtime = date('h:i A',strtotime($log->time));
                                                                break;
                                                            case (date('Y-m-d',strtotime('wednesday'))):
                                                                $wed_logtime = date('h:i A',strtotime($log->time));
                                                                break;
                                                            case (date('Y-m-d',strtotime('thursday'))):
                                                                $thu_logtime = date('h:i A',strtotime($log->time));
                                                                break;
                                                            case (date('Y-m-d',strtotime('friday'))):
                                                                $fri_logtime = date('h:i A',strtotime($log->time));
                                                                break;
                                                            case (date('Y-m-d',strtotime('saturday'))):
                                                                $sat_logtime = date('h:i A',strtotime($log->time));
                                                                break;
                                                            case (date('Y-m-d',strtotime('sunday'))):
                                                                $sun_logtime = date('h:i A',strtotime($log->time));
                                                                break;
                                                        }
                                                    }elseif ($log->action == 'Break out' && $log->user_id == $user->id && $log->date == date('Y-m-d')) {
                                                        $status = 'In';
                                                        switch ($log->date){
                                                            case (date('Y-m-d',strtotime('monday'))):
                                                                $mon_logtime = date('h:i A',strtotime($log->time));
                                                                break;
                                                            case (date('Y-m-d',strtotime('tuesday'))):
                                                                $tue_logtime = date('h:i A',strtotime($log->time));
                                                                break;
                                                            case (date('Y-m-d',strtotime('wednesday'))):
                                                                $wed_logtime = date('h:i A',strtotime($log->time));
                                                                break;
                                                            case (date('Y-m-d',strtotime('thursday'))):
                                                                $thu_logtime = date('h:i A',strtotime($log->time));
                                                                break;
                                                            case (date('Y-m-d',strtotime('friday'))):
                                                                $fri_logtime = date('h:i A',strtotime($log->time));
                                                                break;
                                                            case (date('Y-m-d',strtotime('saturday'))):
                                                                $sat_logtime = date('h:i A',strtotime($log->time));
                                                                break;
                                                            case (date('Y-m-d',strtotime('sunday'))):
                                                                $sun_logtime = date('h:i A',strtotime($log->time));
                                                                break;
                                                        }
                                                    }
                                                }
                                            ?>
                                            <tr>
                                                <td class="center"><input type="radio" name="selected" value="<?php echo $user_id?>"></td>
                                                <td><span class="list-emp-name"><?php echo $name;?></span><span class="list-emp-role"><?php echo $role;?></span></td>
                                                <td class="center"><span class="list-emp-status"><?php echo $status;?></span></td>
                                                <td class="center"><?php echo $mon_logtime?></td>
                                                <td class="center"><?php echo $tue_logtime?></td>
                                                <td class="center"><?php echo $wed_logtime?></td>
                                                <td class="center"><?php echo $thu_logtime?></td>
                                                <td class="center"><?php echo $fri_logtime?></td>
                                                <td class="center"><?php echo $sat_logtime?></td>
                                                <td class="center"><?php echo $sun_logtime?></td>
                                            </tr>
                                            <?php
                                                $user_id = 0;
                                                $name = null;
                                                $role = null;
                                                $status = null;
                                                $mon_logtime = null;
                                                $tue_logtime = null;
                                                $wed_logtime = null;
                                                $thu_logtime = null;
                                                $fri_logtime = null;
                                                $sat_logtime = null;
                                                $sun_logtime = null;
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
        $(".list_datepicker").datepicker();
        //DataTables
        $('#tbl-list').DataTable({"sort": false});
    });
</script>