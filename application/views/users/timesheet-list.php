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
    /*Swal2 css*/
    .swal2-image{
        height: 110px;
        width: 110px;
        border-radius: 50%;
    }
    .legend-container{
        position: absolute;
        bottom: 0;
        right: 0;
    }
    .legend-section{
        margin-right: 10px;
    }
    .legend-section,.legend-title,.legend-manual,.legend-missing{
        display: inline-block;
    }
    .legend-section,.legend-title{
        font-weight: bold;
    }
    .legend-section .legend-manual,.legend-missing{
        height: 20px;
        width: 20px;
        border-radius: 50%;
        border: 3px solid grey;
        vertical-align: bottom;
    }
    .legend-missing{
        background-color: #f71111bf;
    }
    .legend-manual{
        background-color: #ffc859;
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
                                <div class="col-lg-5">
                                    <div class="legend-container">
                                        <div class="legend-section">
                                            <div class="legend-manual"></div>
                                            <span class="legend-title">Manual</span>
                                        </div>
                                        <div class="legend-section">
                                            <div class="legend-missing"></div>
                                            <span class="legend-title">Possibly Missing Entry</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="action-btn-container">
                                        <button class="btn btn-success action-btn" id="listClockInOut" data-approved="<?php echo $this->session->userdata('logged')['id']?>">Clock In/Out</button>
                                        <button class="btn btn-info action-btn">Adjust Entry</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 table-responsive">
                                    <table id="tbl-list" class="table table-bordered table-striped"></table>
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
        // $('#tbl-list').DataTable({"sort": false});
        var week_of = $('.list_datepicker').val();
        $('#tbl-list').ready(showListTable(week_of));
        $(document).on('change','#tsListPicker',function () {
            $("#tbl-list").DataTable().destroy();
           var week = $(this).val();
           showListTable(week);
        });
        function showListTable(week) {
            $.ajax({
                url:"/timesheet/showListTable",
                type:"GET",
                dataType:"json",
                data:{week:week},
                success:function (data) {
                    $('#tbl-list').html(data).DataTable({"sort": false});
                }
            });
        }
        $(document).on('click','#listClockInOut',function () {
            var radio = $('input[name="selected"]:checked');
            var approved_by = $(this).attr('data-approved');
            if (radio.length == 0){

            }else{
                var user_id = radio.val();
                var status = radio.parent('td').next('td').next('td').children('span').text();
                var emp_name = radio.attr('data-name');
                var week_id = radio.attr('data-week');
                var attn_id = radio.attr('data-attn');
                if (status == 'In'){
                    clockOut(emp_name,user_id,week_id,attn_id,approved_by);
                }else if(status == ''){
                    clockIn(emp_name,user_id,approved_by);
                }else if(status == 'On Lunch'){
                    backToWork(emp_name,user_id,approved_by);
                }
            }
        });
        function clockIn(emp_name,user_id,approved_by) {
            var entry = 'Manual';
            Swal.fire({
                title: 'Clock in?',
                html: "Are you sure you want to Clock-in this person?<br> <strong>"+emp_name+"</strong>",
                imageUrl:"/assets/img/timesheet/default-profile.png",
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Clock in this!'
            }).then((result) => {
                if (result.value) {
                $.ajax({
                    url:'/timesheet/checkingInEmployee',
                    method:"POST",
                    dataType:"json",
                    data:{id:user_id,entry:entry,approved_by:approved_by},
                    success:function (data) {
                        if (data != 0){
                            $("#tbl-list").DataTable().destroy();
                            showListTable(week_of);
                            Swal.fire(
                                {
                                    showConfirmButton: false,
                                    timer: 2000,
                                    title: 'Success',
                                    html: '<strong>'+emp_name+"</strong> has been Clock-in",
                                    icon: 'success'
                                });
                        }else if (data == false){
                            Swal.fire(
                                {
                                    showConfirmButton: false,
                                    timer: 2000,
                                    title: 'Failed',
                                    text: "Something is wrong in the process",
                                    icon: 'warning'
                                });
                        }

                    }
                });
            }
            });
        }
        function clockOut(emp_name,user_id,week_id,attn_id,approved_by) {
            var entry = 'Manual';
            Swal.fire({
                title: 'Clock out?',
                html: "Are you sure you want to Clock-out this person?<br> <strong>"+emp_name+"</strong>",
                imageUrl:"/assets/img/timesheet/default-profile.png",
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Clock out this!'
            }).then((result) => {
                if (result.value) {
                $.ajax({
                    url:'/timesheet/checkingOutEmployee',
                    method:"POST",
                    dataType:"json",
                    data:{id:user_id,week_id:week_id,attn_id:attn_id,entry:entry,approved_by:approved_by},
                    success:function (data) {
                        if (data == 1){
                            $("#tbl-list").DataTable().destroy();
                            showListTable(week_of);
                            Swal.fire(
                                {
                                    showConfirmButton: false,
                                    timer: 2000,
                                    title: 'Success',
                                    html: '<strong>'+emp_name+"</strong> has been Clock-out",
                                    icon: 'success'
                                });
                        }else{
                            Swal.fire(
                                {
                                    showConfirmButton: false,
                                    timer: 2000,
                                    title: 'Failed',
                                    text: "Something is wrong in the process",
                                    icon: 'warning'
                                });
                        }

                    }
                });
            }
            });
        }
        function backToWork(emp_name,user_id,approved_by) {
            var entry = 'Manual';
            Swal.fire({
                title: 'Back to work?',
                html: "Are you sure you want to get back to work this person?<br> <strong>"+emp_name+"</strong>",
                imageUrl:"/assets/img/timesheet/default-profile.png",
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, back to work!'
            }).then((result) => {
                if (result.value) {
                $.ajax({
                    url:'/timesheet/breakOut',
                    method:"POST",
                    dataType:"json",
                    data:{id:user_id,entry:entry,approved_by:approved_by},
                    success:function (data) {
                        if (data == 1){
                            $("#tbl-list").DataTable().destroy();
                            showListTable(week_of);
                            Swal.fire(
                                {
                                    showConfirmButton: false,
                                    timer: 2000,
                                    title: 'Success',
                                    html: '<strong>'+emp_name+"</strong> is now back to work.",
                                    icon: 'success'
                                });
                        }else{
                            Swal.fire(
                                {
                                    showConfirmButton: false,
                                    timer: 2000,
                                    title: 'Failed',
                                    text: "Something is wrong in the process",
                                    icon: 'warning'
                                });
                        }

                    }
                });
            }
        });
        }
    });
</script>