<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
    #timeLogTable th{
        text-align: center;
    }
    .employee-section{
        display: inline-block;
    }
    .emp-photo{
        width: 25%;
        vertical-align: middle;
    }
    .emp-photo img{
        width: 35px;
        height: 35px;
        border-radius: 50%;
    }
    .emp-details{
        width: 70%;
    }
    .emp-details .employee-name,.employee-role{
        display: block;
    }
    .emp-details .employee-name{
        font-weight: bold;
    }
    .emp-details .employee-role{
        font-style: italic;
        color: grey;
    }
    .center{
        text-align: center;
    }
    #timeLogDate{
        width: 210px;
    }
    .thead-title,.thead-sub{
        display: block;
    }
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/employee'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Time Log</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Manage Time Log</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <?php ////if (hasPermissions('users_add')): ?>
                                <!--                                    <a href="--><?php //echo url('users/add_timesheet_entry') ?><!--" class="btn btn-primary"-->
                                <!--                                       aria-expanded="false">-->
                                <!--                                        <i class="mdi mdi-settings mr-2"></i> Log Time-->
                                <!--                                    </a>-->
                                <?php //endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Date Selector -->
                            <div class="row" style="margin-bottom: 20px">
                                <div class="col-lg-3" style="">
                                    <input type="text" class="form-control" id="timeLogDate" name="timelog_date" value="<?php echo date('m/d/Y');?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 table-responsive">
                                    <table id="timeLogTable" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Clock In</th>
                                            <th>Clock Out</th>
                                            <th><span class="thead-title">Shift Duration</span><span class="thead-sub">(HH:MM)</span></th>
                                            <th style="width: 150px !important;">Name</th>
                                            <th style="width: 150px !important;">Type</th>
                                            <th>Notes</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="employee-tbody">
<!--                                        --><?php
//                                        $emp_role = null;
//                                        $clock_in = null;
//                                        $clock_out = null;
//                                        $shift_duration = null;
//                                        $entry_type = null;
//                                        ?>
<!--                                        --><?php //foreach ($users as $user): ?>
<!--                                            --><?php
//                                            $name = $user->FName." ".$user->LName;
//                                            foreach ($user_roles as $role){
//                                                if ($user->role == $role->id){
//                                                    $emp_role = $role->title;
//                                                }
//                                            }
//                                            foreach ($attendance as $attn){
//                                                if ($attn->user_id == $user->id){
//                                                    foreach ($ts_logs as $log){
//                                                        if ($attn->id == $log->attendance_id){
//                                                            $entry_type = $log->entry_type;
//                                                            if ($log->action == 'Check in'){
//                                                                $clock_in = date('h:i A',$log->time);
//                                                            }elseif ($log->action == 'Check out'){
//                                                                $clock_out = date('h:i A',$log->time);
//                                                            }
//                                                        }
//                                                    }
//                                                    $shift_duration = $attn->shift_duration;
//                                                }
//                                            }
//                                            ?>
<!--                                            <tr>-->
<!--                                                <td class="center">--><?php //echo $clock_in; ?><!--</td>-->
<!--                                                <td class="center">--><?php //echo $clock_out; ?><!--</td>-->
<!--                                                <td class="center">--><?php //echo $shift_duration;?><!--</td>-->
<!--                                                <td>-->
<!--                                                    <div class="employee-section emp-photo">-->
<!--                                                        <img src="--><?php //echo site_url()?><!--/assets/img/timesheet/default-profile.png" alt="" class="employee-profile">-->
<!--                                                    </div>-->
<!--                                                    <div class="employee-section emp-details">-->
<!--                                                        <span class="employee-name">--><?php //echo $name;?><!--</span><span class="employee-role">--><?php //echo $emp_role;?><!--</span>-->
<!--                                                    </div>-->
<!--                                                </td>-->
<!--                                                <td class="center">--><?php //echo $entry_type;?><!--</td>-->
<!--                                                <td class="center"></td>-->
<!--                                                <td class="center">-->
<!--                                                    <a href="javascript:void (0)" title="View" data-toggle="tooltip"><i class="btn-view fa fa-eye fa-lg"></i></a>-->
<!--                                                </td>-->
<!--                                            </tr>-->
<!--                                            --><?php
//                                            $clock_in = null;
//                                            $clock_out = null;
//                                            $shift_duration = null;
//                                            $entry_type = null;
//                                            ?>
<!--                                        --><?php //endforeach;?>
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
        $('#timeLogDate').datepicker();
        $(document).on('change','#timeLogDate',function () {
             var date = $(this).val();
             showTimeLogTbl(date);

        });
        var selected_day = $('#timeLogDate').val();
        $('.employee-tbody').ready(showTimeLogTbl(selected_day));
        function showTimeLogTbl(date) {
            $("#timeLogTable").DataTable().destroy();
            $.ajax({
                url:"/users/showTimeLogTable",
                type:"GET",
                dataType:'json',
                data:{date:date},
                success:function (data) {
                    $('.employee-tbody').html(data).tooltip({ selector: '[data-toggle=tooltip]' });
                    $('#timeLogTable').DataTable({
                        "sort": false
                    });
                }
            });
        }

    });
</script>
