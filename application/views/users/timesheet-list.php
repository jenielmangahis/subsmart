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
    .employee-name{
        font-size: 17px;
        color: grey;
    }
    #tbl-modal{
        width: 100%;
    }
    .modal-body{
        padding: 10px!important;
    }
    #tbl-modal > thead > tr> th{
        border-bottom: 0;
        padding: 10px;
        width: 103px;
        margin-right: 5px;
    }
    #tbl-modal > tbody > tr> td{
        margin-top: 10px;
        width: 103px;
        margin-right: 5px;
    }
    #tbl-modal .thead-date{
        color: black;
    }
    #tbl-modal .thead-day{
        font-weight: bold;
    }
    /*modal Css*/
    #adjustEntryModal .modal-content{
        width: 780px;
        margin-right: auto;
        margin-left: auto;
    }
    #adjustEntryModal .modal-dialog{
        max-width: 780px!important;
    }
    /*Timepicker*/
    .ui-timepicker-container {
        z-index: 3500 !important;
        width: 150px!important;
    }
    .week-timepicker{
        display: none;
        width: 103px;
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
                        <h1 class="page-title">List</h1>
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
                                            <span class="legend-title">Manual Entry</span>
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
                                        <button class="btn btn-info action-btn" id="listAdjustEntry">Adjust Entry</button>
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
<!--    Adjust Entry modal-->
    <div class="modal" id="adjustEntryModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5>Adjust Entry for: <span class="employee-name"></span></h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="" method="post" id="formAdjustEntry" autocomplete="off">
                <div class="modal-body">
                    <input type="hidden" name="user_id" id="tblUserId">
                    <table id="tbl-modal">
                        <thead>
                        <tr>
                            <th><span class="thead-day">Mon</span><span class="thead-date" id="dateMon"></span></th>
                            <th><span class="thead-day">Tue</span><span class="thead-date" id="dateTue"></span></th>
                            <th><span class="thead-day">Wed</span><span class="thead-date" id="dateWed"></span></th>
                            <th><span class="thead-day">Thu</span><span class="thead-date" id="dateThu"></span></th>
                            <th><span class="thead-day">Fri</span><span class="thead-date" id="dateFri"></span></th>
                            <th><span class="thead-day">Sat</span><span class="thead-date" id="dateSat"></span></th>
                            <th><span class="thead-day">Sun</span><span class="thead-date" id="dateSun"></span></th>
                        </tr>
                        </thead>
                       <tbody>
                       <tr>
                           <td class="center"><input type="checkbox" name="adjust[]" id="valMon" <?php echo (date('Y-m-d',strtotime('monday this week')) > date('Y-m-d'))?"disabled":null; ?>></td>
                           <td class="center"><input type="checkbox" name="adjust[]" id="valTue" <?php echo (date('Y-m-d',strtotime('tuesday this week')) > date('Y-m-d'))?"disabled":null; ?>></td>
                           <td class="center"><input type="checkbox" name="adjust[]" id="valWed" <?php echo (date('Y-m-d',strtotime('wednesday this week')) > date('Y-m-d'))?"disabled":null; ?>></td>
                           <td class="center"><input type="checkbox" name="adjust[]" id="valThu" <?php echo (date('Y-m-d',strtotime('thursday this week')) > date('Y-m-d'))?"disabled":null; ?>></td>
                           <td class="center"><input type="checkbox" name="adjust[]" id="valFri" <?php echo (date('Y-m-d',strtotime('friday this week')) > date('Y-m-d'))?"disabled":null; ?>></td>
                           <td class="center"><input type="checkbox" name="adjust[]" id="valSat" <?php echo (date('Y-m-d',strtotime('saturday this week')) > date('Y-m-d'))?"disabled":null; ?>></td>
                           <td class="center"><input type="checkbox" name="adjust[]" id="valSun" <?php echo (date('Y-m-d',strtotime('sunday this week')) > date('Y-m-d'))?"disabled":null; ?>></td>
                       </tr>
                       <tr>
                           <td class="center"><input type="text" name="monday" class="form-control week-timepicker"></td>
                           <td class="center"><input type="text" name="tuesday" class="form-control week-timepicker"></td>
                           <td class="center"><input type="text" name="wednesday" class="form-control week-timepicker"></td>
                           <td class="center"><input type="text" name="thursday" class="form-control week-timepicker"></td>
                           <td class="center"><input type="text" name="friday" class="form-control week-timepicker"></td>
                           <td class="center"><input type="text" name="saturday" class="form-control week-timepicker"></td>
                           <td class="center"><input type="text" name="sunday" class="form-control week-timepicker"></td>
                       </tr>
                       </tbody>
                    </table>
                </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal" id="savedAdjustEntry">Save</button>
                </div>

            </div>
        </div>
    </div>
<!--    end of modal-->
</div>
<?php include viewPath('includes/footer'); ?>
<script>
    $(document).ready(function () {
        var week_of = $('.list_datepicker').val();
        $('#tbl-list').ready(showListTable(week_of));

        $(document).on('click','#listAdjustEntry',function () {
            // Timepicker
            $(".week-timepicker").timepicker({interval: 60});
            var radio = $('input[name="selected"]:checked');
            var emp_name = radio.attr('data-name');
            var week_id = radio.attr('data-week');
            var attn_id = radio.attr('data-attn');
            var day_id = [];
            day_id.push(radio.parent('td').next('td').next('td').next('td').attr('data-id'));
            day_id.push(radio.parent('td').next('td').next('td').next('td').next('td').attr('data-id'));
            day_id.push(radio.parent('td').next('td').next('td').next('td').next('td').next('td').attr('data-id'));
            day_id.push(radio.parent('td').next('td').next('td').next('td').next('td').next('td').next('td').attr('data-id'));
            day_id.push(radio.parent('td').next('td').next('td').next('td').next('td').next('td').next('td').next('td').attr('data-id'));
            day_id.push(radio.parent('td').next('td').next('td').next('td').next('td').next('td').next('td').next('td').next('td').attr('data-id'));
            day_id.push(radio.parent('td').next('td').next('td').next('td').next('td').next('td').next('td').next('td').next('td').next('td').attr('data-id'));
            var week_of = $('#tsListPicker').val();
            if (radio.length == 1){
                $('#adjustEntryModal').modal({backdrop: 'static', keyboard: false});
                $('.employee-name').text(emp_name);
                $('#tblUserId').val(radio.val());
                getWeekOf(week_of,day_id);
            }
        });
        function getWeekOf(week_of,day_id) {
            $.ajax({
                url:'/timesheet/getWeekOf',
                type:"GET",
                dataType:"json",
                data:{week_of:week_of,day_id:day_id},
                success:function (data) {
                    $('#dateMon').text(data.monday);
                    $('#dateTue').text(data.tuesday);
                    $('#dateWed').text(data.wednesday);
                    $('#dateThu').text(data.thursday);
                    $('#dateFri').text(data.friday);
                    $('#dateSat').text(data.saturday);
                    $('#dateSun').text(data.sunday);
                    $('#valMon').val(data.input_mon);
                    $('#valTue').val(data.input_tue);
                    $('#valWed').val(data.input_wed);
                    $('#valThu').val(data.input_thu);
                    $('#valFri').val(data.input_fri);
                    $('#valSat').val(data.input_sat);
                    $('#valSun').val(data.input_sun);
                    $('input[name="monday"]').attr('data-attn',data.mon_attnId).attr('data-id',day_id[0]).val(data.mon_logtime);
                    $('input[name="tuesday"]').attr('data-attn',data.tue_attnId).attr('data-id',day_id[1]).val(data.tue_logtime);
                    $('input[name="wednesday"]').attr('data-attn',data.wed_attnId).attr('data-id',day_id[2]).val(data.wed_logtime);
                    $('input[name="thursday"]').attr('data-attn',data.thu_attnId).attr('data-id',day_id[3]).val(data.thu_logtime);
                    $('input[name="friday"]').attr('data-attn',data.fri_attnId).attr('data-id',day_id[4]).val(data.fri_logtime);
                    $('input[name="saturday"]').attr('data-attn',data.sat_attnId).attr('data-id',day_id[5]).val(data.sat_logtime);
                    $('input[name="sunday"]').attr('data-attn',data.sun_attnId).attr('data-id',day_id[6]).val(data.sun_logtime);
                    if(data.mon_logtime == null){
                        $('#valMon').attr('disabled',true);
                    }else{
                        $('#valMon').attr('disabled',false);
                    }
                    if(data.tue_logtime == null){
                        $('#valTue').attr('disabled',true);
                    }else{
                        $('#valTue').attr('disabled',false);
                    }
                    if(data.wed_logtime == null){
                        $('#valWed').attr('disabled',true);
                    }else{
                        $('#valWed').attr('disabled',false);
                    }
                    if(data.thu_logtime == null){
                        $('#valThu').attr('disabled',true);
                    }else{
                        $('#valThu').attr('disabled',false);
                    }
                    if(data.fri_logtime == null){
                        $('#valFri').attr('disabled',true);
                    }else{
                        $('#valFri').attr('disabled',false);
                    }
                    if(data.sat_logtime == null){
                        $('#valSat').attr('disabled',true);
                    }else{
                        $('#valSat').attr('disabled',false);
                    }
                    if(data.sun_logtime == null){
                        $('#valSun').attr('disabled',true);
                    }else{
                        $('#valSun').attr('disabled',false);
                    }

                }
            });
        }
        function getCheckedDate(checkbox) {
            var list = [];
            $(checkbox).each(function(index, element) {
                list.push($(element).val());
            });
            return list;
        }
        $(document).on('click','#savedAdjustEntry',function () {
            var name = $('input[name="selected"]:checked').attr('data-name');
            var date = getCheckedDate($('input[name*="adjust"]'));
            var values = {};
            $.each($('#formAdjustEntry').serializeArray(), function (i, field) {
                values[field.name] = field.value;
            });
            var day_id = [];
            day_id.push($('input[name="monday"]').attr('data-id'));
            day_id.push($('input[name="tuesday"]').attr('data-id'));
            day_id.push($('input[name="wednesday"]').attr('data-id'));
            day_id.push($('input[name="thursday"]').attr('data-id'));
            day_id.push($('input[name="friday"]').attr('data-id'));
            day_id.push($('input[name="saturday"]').attr('data-id'));
            day_id.push($('input[name="sunday"]').attr('data-id'));
            // var attn_id = [];
            // attn_id.push($('input[name="monday"]').attr('data-attn'));
            // attn_id.push($('input[name="tuesday"]').attr('data-attn'));
            // attn_id.push($('input[name="wednesday"]').attr('data-attn'));
            // attn_id.push($('input[name="thursday"]').attr('data-attn'));
            // attn_id.push($('input[name="friday"]').attr('data-attn'));
            // attn_id.push($('input[name="saturday"]').attr('data-attn'));
            // attn_id.push($('input[name="sunday"]').attr('data-attn'));

            $.ajax({
                url:"/timesheet/adjustEntry",
                type:"POST",
                dataType:"json",
                data:{values:values,day_id:day_id,date:date},
                success:function (data) {
                    if (data != 0){
                        $("#tbl-list").DataTable().destroy();
                        showListTable(week_of);
                        Swal.fire(
                            {
                                showConfirmButton: false,
                                timer: 2000,
                                title: 'Success',
                                html: '<strong>'+name+"</strong> timelogged has been adjusted",
                                icon: 'success'
                            });
                    }

                }
            });
        });
        $('#valMon').click(function () {
            $('input[name="monday"]').toggle(this.checked);

        });
        $('#valTue').click(function () {
            $('input[name="tuesday"]').toggle(this.checked);
        });
        $('#valWed').click(function () {
            $('input[name="wednesday"]').toggle(this.checked);
        });
        $('#valThu').click(function () {
            $('input[name="thursday"]').toggle(this.checked);
        });
        $('#valFri').click(function () {
            $('input[name="friday"]').toggle(this.checked);
        });
        $('#valSat').click(function () {
            $('input[name="saturday"]').toggle(this.checked);
        });
        $('#valSun').click(function () {
            $('input[name="sunday"]').toggle(this.checked);
        });
        //Datepicker
        $(".list_datepicker").datepicker();
        //DataTables
        // $('#tbl-list').DataTable({"sort": false});
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