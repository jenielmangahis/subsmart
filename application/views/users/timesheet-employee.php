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
    /*Table loader*/
    #tsEmployeeDataTable_wrapper{
        display: none;
    }

    .table-ts-loader{
        display: block;
        margin: 0 auto;
        clear: both;
        position: relative;
        z-index: 20;
        width: 100%;
        height: 100%;
        min-height: 100px;
        background:rgb(128 128 128 / 18%);
    }
    .table-ts-loader img{
        width: 80px;
        height: 80px;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
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
                        <h1 class="page-title">Time Employee</h1>
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
                        <a href="<?php echo url('/timesheet/notification')?>" class="banking-tab">Notification</a>
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
                                    <div class="table-wrapper-settings">
                                        <table id="tsEmployeeDataTable" class="table table-bordered table-striped"></table>
                                        <div class="table-ts-loader">
                                            <img class="ts-loader-img" src="/assets/css/timesheet/images/ring-loader.svg" alt="">
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
    $(document).ready(function () {
        // Datepicker
        $("#tsEmployeeDatepicker").datepicker();
        let week_of = $('#tsEmployeeDatepicker').val();
        $('#tsEmployeeDataTable').ready(showEmployeeTable(week_of));

        $(document).on('change','#tsEmployeeDatepicker',function () {
            $("#tsEmployeeDataTable").DataTable().destroy();
            let week = $(this).val();
            showEmployeeTable(week);
        });
        function showEmployeeTable(week) {
            $('#tsEmployeeDataTable_wrapper').css('display','none');
            $('#tsEmployeeDataTable').css('display','none');
            $(".table-ts-loader").fadeIn('fast',function(){
                $('.table-ts-loader').css('display','block');
            });
            $.ajax({
                url:"/timesheet/showEmployeeTable",
                type:"GET",
                dataType:"json",
                data:{week:week},
                success:function (data) {
                    $(".table-ts-loader").fadeOut('fast',function(){
                        $('#tsEmployeeDataTable').html(data).removeAttr('style').DataTable({"sort": false});
                        $('#tsEmployeeDataTable_wrapper').css('display','block');
                        $('.table-ts-loader').css('display','none');
                    });
                }
            });
        }
    });

</script>