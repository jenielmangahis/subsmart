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
    #tsSettingsRow > td > input:read-only{
        cursor: pointer;
    }
    #timesheet_settings .fa-times, th{
        font-weight: lighter!important;
        color: #92969d;
    }
    #timesheet_settings .fa-times:hover{
        color: orangered;
    }
    #timesheet_settings .fa-times[disabled]{
        cursor: not-allowed;
        color: #92969d;
    }
    #timesheet_settings thead,tfoot{
       background: #d6e6f3;
    }
    #timesheet_settings thead{
       background: #d6e6f3;
    }
    #timesheet_settings td{
        border-right: 0;
        border-left: 0;
        text-align: center;
    }
    .ts-duration{
        width: 90px;
        height: 36px!important;
        margin: 0 auto;
        text-align: center;
    }
    .ts-project-name{
        font-weight: bold;
        cursor: pointer;
    }
    .ts-project-name:hover{
        text-decoration: underline;
        color: #0b97c4;
    }
    .ts-status{
        color: greenyellow;
        margin-right: 10px;
        font-size: 8px;
        vertical-align: middle;
    }
    .ts-settings-menu{
        float: right;
        margin-bottom: 10px;
    }
    .ts-settings-menu .form-group{
        display: inline-block;
        margin-right: 10px;
        margin-bottom: 0!important;
        width: auto;
    }
    .ts-settings-menu .form-group .ts-sorting{
        width: 200px;
    }

    .ts-settings-menu .form-group .btn{
        width: 50px;
        height: 45.99px;
        display: inline-block;
        padding: 0;
        margin-top: -4px;
    }
    .ts-settings-menu .form-group .right{
        margin-left: -4px;
    }
    .ts-settings-menu .form-group .btn > i{
        margin: 0 auto;
    }
    .ts-settings-menu .ts-sorting{
        margin-right: -5px!important;
    }
    .ts-bottom-btn-section{
        float: left;
        margin-top: 10px;
    }
    .ts-bottom-btn-section .form-group{
        display: inline-block;
    }
    .ts-settings-menu .select2-container--default .select2-selection--single{
        width: 250px!important;
    }
    .text-details{
        white-space: nowrap;
    }
    .subtext{
        font-style: italic;
        color: grey;
        position: relative;
    }
    #tsSettingsRow .fa-pencil-alt{
        color: grey;
    }
    #tsSettingsRow .fa-pencil-alt:hover{
        text-decoration: underline;
        color: #0b97c4;
    }
    #tsSettingsRow #editProjectName{
        display: none;
        margin-left: 5px;
    }
    .alert-message{
        position: fixed;
        bottom: 20px;
        left: 50px;
        z-index: 10000;
        display: none;
    }
    /*Sweet Alert Css*/
    .swal2-title{
        font-size: 20px!important;
    }
    .swal2-checkbox{
        float: left;
    }
    .swal2-label{
        font-weight: bold!important;
    }
    /*Creating project css*/
    .modal-right-side .modal.right .modal-dialog {
        position: fixed;
        margin: auto;
        min-width: 520px;
        height: 100%;
        -webkit-transform: translate3d(0%, 0, 0);
        -ms-transform: translate3d(0%, 0, 0);
        -o-transform: translate3d(0%, 0, 0);
        transform: translate3d(0%, 0, 0);
    }
    .modal-right-side .modal.right .modal-content {
        height: 100%;
        overflow-y: auto;
    }
    .modal-right-side.modal-body {
        padding: 20px;
    }

    .modal-right-side .modal.right.fade .modal-dialog {
        right: 0;
        -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
        -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
        -o-transition: opacity 0.3s linear, right 0.3s ease-out;
        transition: opacity 0.3s linear, right 0.3s ease-out;
    }

    .modal-right-side .modal.right.fade.in .modal-dialog {
        right: 0;
    }
    .modal-right-side .modal-content {
        border-radius: 0;
        border: none;
    }
    .modal-right-side .modal-body .form-group label{
        font-size: 16px;
        color: #333333;
        font-weight: 600;
        margin-bottom: 5px;
    }
    .modal-right-side .modal-body .form-group .form-control{
        height: 36px!important;
    }
    .ts-start-date{
        width: 212px;
    }
    .ts-time-section{
        display: inline-block;
        margin-right: 10px;
    }
    .ts-time{
        width: 180px;
    }
    .modal-right-side .modal-body .form-group .select2-container{
        display: block;
        width: 250px!important;
    }
    .modal-right-side .modal-body{
        margin-bottom: 30px;
    }
    .modal-right-side .modal-footer{
        position: fixed;
        bottom: 0;
        width: 100%;
        background-color: #FFFFFF;
    }
    .ui-timepicker-container {
        z-index: 3500 !important;
    }
    #addProject:hover{
        text-decoration: underline;
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
                        <h1 class="page-title">Settings </h1>
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
                        <a href="<?php echo url('/timesheet/schedule')?>" class="banking-tab">Schedule</a>
                        <a href="<?php echo url('/timesheet/list')?>" class="banking-tab">List</a>
                        <a href="<?php echo url('/timesheet/settings')?>" class="banking-tab<?php echo ($this->uri->segment(1)=="settings")?:'-active';?>">Settings</a>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Settings Overview</h4>
                            <!-- Date Selector -->
                            <div class="row">
                                <div class="col-lg-12 table-responsive">
                                    <div class="ts-settings-menu">
                                        <div class="form-group">
                                            <select name="" id="tsUsersList" class="form-control select2-employee-list">
                                                <option value="0" selected>Teammates</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-default" type="button"><i class="fa fa-list"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <select name="" id="ts-sorting-week" class="form-control ts-sorting">
                                                <option value="this week" selected>This week</option>
                                                <option value="last week">Last week</option>
                                                <option value="next week">Next week</option>
                                            </select>
                                            <button class="btn btn-default"><i class="fa fa-angle-left fa-lg"></i></button>
                                            <button class="btn btn-default right"><i class="fa fa-angle-right fa-lg"></i></button>
                                        </div>
                                    </div>
                                    <table id="timesheet_settings" class="timesheet_settings-table"></table>
                                    <div class="ts-bottom-btn-section">
                                        <div class="form-group">
                                            <button class="btn btn-default" id="btnAddRow"><i class="fa fa-plus" style="color: #0b97c4;"></i>&nbsp;Add new row</button>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-default"><i class="fa fa-copy" style="color: #9da5af;"></i>&nbsp;Copy last week</button>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-default"><i class="fa fa-save" style="color: #56bb4d;"></i>&nbsp;Save as template</button>
                                        </div>
                                    </div>
<!--                                    --><?php //echo $this->session->userdata('logged')['id'];?>
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
<div class="modal-right-side">
    <div class="modal right fade" id="createProject" tabindex="" role="dialog" aria-labelledby="newProjectSettings">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="newProjectSettings" ><i class="fa fa-calendar-alt"></i> <span id="tsDate"><?php echo date('M d,Y')?></span></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="" method="post" id="formNewProject">
                <div class="modal-body">
                    <input type="hidden" name="timesheet_id" id="timesheetId">
                    <input type="hidden" name="user_id" id="userId">
                    <input type="hidden" name="day" id="selectedDay">
                    <input type="hidden" name="total_week_duration" id="totalWeekDuration">
                    <input type="hidden" name="day_id" id="tsScheduleId">
                    <input type="hidden" name="week" id="weekType">
                    <div class="form-group">
                        <label for="">Project name</label>
                        <input type="text" name="project" id="tsProjectName" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Start Date</label>
                        <input type="text" name="start_date" id="tsStartDate" class="form-control ts-start-date" value="<?php echo date('m/d/Y')?>">
                    </div>
                    <div class="form-group">
                        <div class="ts-time-section">
                            <label for="">Start time</label>
                            <input type="text" name="start_time" id="tsStartTime" class="form-control ts-time start-time">
                        </div>
                        <div class="ts-time-section">
                            <label for="">End time</label>
                            <input type="text" name="end_time" id="tsEndTime" class="form-control ts-time end-time">
                        </div>
                        <div class="ts-time-section">
                            <span class="total-duration"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Team members</label>
                        <select name="team_member" id="tsTeamMember" class="form-control ts-team-member" >
                            <option></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Location</label>
                        <select name="location" id="tsLocation" class="form-control">
                            <option value=""></option>
                            <option value="ph">Philippines</option>
                            <option value="ml">Malaysia</option>
                            <option value="tw">Taiwan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Notes</label>
                        <textarea name="notes" id="tsNotes" cols="30" rows="5" class="form-control" style="height: 100%!important;"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="savedProject">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="alert-message">
    <div class="alert alert-success">
        <strong>Success!</strong> You've updated a duration.
    </div>
</div>
<?php include viewPath('includes/footer'); ?>
<script>
    //Add row
    $(document).on('click','#btnAddRow',function () {
        $('#tsSettingsTblTbody tr:last').prev('tr').clone('#tsSettingsRow').insertBefore('#tsSettingsTblTbody tr:last');
        $('td > .ts-project-name').last().text('Unnamed');
    });
    //Select2 employee list
    $('.select2-employee-list').select2({
        placeholder: 'Select employee',
        width: 'resolve',
        ajax:{
            url:'/timesheet/getEmployees',
            type:"GET",
            dataType:"json",
            delay:250,
            data:function (params) {
                var query = {
                    search: params.term
                };
                return query;
            },
            processResults:function (response) {
                return{results:response};
            },
            cache:true
        },
        escapeMarkup: function (markup) {
            return markup;
        },
        templateResult: function (d) {
            var subtext = d.subtext;
            if(subtext == undefined){subtext=''}
            return '<span class="text-details">'+d.text+'</span><span class="pull-right subtext">'+subtext+'</span>';
        }
    });

    $('.ts-team-member').select2({
        placeholder: 'Select employee',
        width: 'resolve',
        ajax:{
            url:'/timesheet/getEmployees',
            type:"GET",
            dataType:"json",
            delay:250,
            data:function (params) {
                var query = {
                    search: params.term
                };
                return query;
            },
            processResults:function (response) {
                return{results:response};
            },
            cache:true
        },
        escapeMarkup: function (markup) {
            return markup;
        },
        templateResult: function (d) {
            var subtext = d.subtext;
            if(subtext == undefined){subtext=''}
            return '<span class="text-details">'+d.text+'</span><span class="pull-right subtext">'+subtext+'</span>';
        }
    });

    $(document).ready(function () {
        // DataTables
        $('.timesheet_settings-table').DataTable({
            "paging": false,
            "filter":false,
            "info":false,
            "sort": false
        });
    });
    $(document).ready(function() {
        var selected_week = $('#ts-sorting-week').val();
        var user_id = $('#tsUsersList').val();
        $('#timesheet_settings').ready(showWeekList(selected_week,user_id));
        //Datetime picker
        $(".ts-start-date").datepicker();
        $(".start-time").timepicker({interval: 60,change: differenceTime});
        $(".end-time").timepicker({change: differenceTime,interval: 60});
        function differenceTime() {
            var start_hour = null;
            var end_hour = null;
            if ($(this).attr('id') == 'tsStartTime'){
                start_hour = convertTime12to24($(this).val()).split(':')[0];
                end_hour = convertTime12to24($(this).parent('div').next('div').children('input').val()).split(':')[0];
            }else{
                start_hour = convertTime12to24($(this).parent('div').prev('div').children('input').val()).split(':')[0];
                end_hour = convertTime12to24($(this).val()).split(':')[0];
            }
            var duration = end_hour - start_hour;
            if(end_hour != '' && start_hour != '' || duration < 0){
                $('.total-duration').text(duration+"h");
            }


        }
        const convertTime12to24 = (time12h) => {
            const [time, modifier] = time12h.split(' ');

            let [hours, minutes] = time.split(':');

            if (hours === '12') {
                hours = '00';
            }

            if (modifier === 'PM') {
                hours = parseInt(hours, 10) + 12;
            }

            return `${hours}:${minutes}`;
        }

        // Adding Project
        $(document).on('click','#addProject',function () {
            $('#createProject').modal({backdrop: 'static', keyboard: false});
            $('#tsProjectName').attr('disabled',null);
            $('#tsTeamMember').attr('disabled',null);
            $('#tsLocation').attr('disabled',null);
            $('#tsNotes').attr('disabled',null);
            var week = $('#ts-sorting-week').val();
            $('#weekType').val(week);

        });
        $(document).on('click','#savedProject',function () {
            var week = $('#ts-sorting-week').val();
            var user_id = $('#tsUsersList').val();
            var values = {};
            $.each($('#formNewProject').serializeArray(), function (i, field) {
                values[field.name] = field.value;
            });
            var duration = $('.total-duration').text();
            $.ajax({
                url:"/timesheet/addingProjects",
                type:"POST",
                dataType:"json",
                data:{values:values,duration:duration},
                cache:false,
                success:function (data) {
                    $("#createProject").modal('hide');
                    showWeekList(week,user_id);
                    if(data == 1){
                        Swal.fire(
                            {
                                showConfirmButton: false,
                                timer: 2000,
                                title: 'Success',
                                html: "New project has been set",
                                icon: 'success'
                            });
                    }else{
                        Swal.fire(
                            {
                                showConfirmButton: false,
                                timer: 2000,
                                title: 'Failed',
                                html: "Something is wrong in the process!",
                                icon: 'warning'
                            });
                    }
                }
            });
        });
        //Toggle edit pen
        $(document).on('click','#showEditPen',function () {
            if($(this).next('a').css('display') =='none'){
                $(this).next('a').css('display','inline-block');
            }else{
                $(this).next('a').css('display','none');
            }
        });
        function showWeekList(week,user_id) {
            if(week != null){
                $.ajax({
                    url:"/timesheet/showTimesheetSettings",
                    type:"GET",
                    dataType:"json",
                    data:{week:week,user:user_id},
                    success:function (data) {
                        $('#timesheet_settings').html(data);
                        // Restriction of input field
                        // var options =  {
                        //     onKeyPress: function(cep, e, field, options) {
                        //         var masks = ['00:00'];
                        //         var mask = (cep.length>4) ? masks[1] : masks[0];
                        //         $('.ts-duration').mask(mask, options);
                        //     }};
                        // $('.ts-duration').mask("00:00",options);
                    }
                });
            }
        }
        $(document).on('change','#tsUsersList',function () {
             var user = $(this).val();
             var week = $('#ts-sorting-week').val();
            showWeekList(week,user);
        });
        $(document).on('change','#ts-sorting-week',function () {
            var week = $(this).val();
            var user = $('#tsUsersList').val();
            showWeekList(week,user);
        });
        $.date = function(dateObject,text) {
            var d = new Date(dateObject);
            var day = d.getDate();
            var month = d.getMonth() + 1;
            var year = d.getFullYear();
            if (day < 10) {
                day = "0" + day;
            }
            if (month < 10) {
                month = "0" + month;
            }
            var date;
            if(text == 1){
                 date = month + "/" + day + "/" + year;
            }else{
                const monthNames = ["January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"
                ];
                 date = monthNames[d.getMonth()] + " " + day + "," + year;
            }


            return date;
        };
        $(document).on('click','#updateSchedule',function () {
            var week = $('#ts-sorting-week').val();
            var user_id = $('#tsUsersList').val();
            var values = {};
            $.each($('#formNewProject').serializeArray(), function (i, field) {
                values[field.name] = field.value;
            });
            var duration = $('.total-duration').text();
            var date = $('#tsStartDate').val();
            $.ajax({
                url:'/timesheet/updateSchedule',
                type:"POST",
                dataType:"json",
                data:{values:values,duration:duration,date:date},
                success:function (data) {
                    showWeekList(week,user_id);
                    if(data == 1){
                        $("#createProject").modal('hide');
                        Swal.fire(
                            {
                                showConfirmButton: false,
                                timer: 2000,
                                title: 'Success',
                                html: "Project has been updated",
                                icon: 'success'
                            });
                    }
                }
            });
        });
        function getTimesheetData(timesheet_id,user_id,day_id,date,day,twd_id,week) {
            $('#tsProjectName').attr('disabled','disabled');
            $('#tsTeamMember').attr('disabled','disabled');
            $('#tsLocation').attr('disabled','disabled');
            $('#tsNotes').attr('disabled','disabled');
            $('#tsStartDate').val($.date(date,1)).attr('disabled','disabled');
            $('#tsDate').text($.date(date,0));
            $('#savedProject').text('Update').attr('id','updateSchedule');
            $('#timesheetId').val(timesheet_id);
            $('#userId').val(user_id);
            $('#selectedDay').val(day);
            $('#totalWeekDuration').val(twd_id);
            $('#tsScheduleId').val(day_id);
            $('#weekType').val(week);

            $.ajax({
                url:"/timesheet/getTimesheetData",
                type:"GET",
                data:{timesheet_id:timesheet_id,day_id:day_id},
                dataType:"json",
                success:function (data) {
                    $('#tsProjectName').val(data.project_name);
                    $('#tsLocation').val(data.location);
                    $('#tsNotes').val(data.notes);
                    $('#tsTeamMember').next($('#select2-tsTeamMember-container').attr('title',data.team_member).html(data.team_member));
                    $('#tsStartTime').val(data.start_time);
                    $('#tsEndTime').val(data.end_time);
                    $('.total-duration').text(data.total_duration+"h");
                }
            });
        }
        //Updating duration
        // Monday
        $(document).on('click','#tsMonday',function () {
            $('#createProject').modal({backdrop: 'static', keyboard: false});
            var day_id = $(this).attr('data-id');
            var timesheet_id = $(this).closest('tr').attr('data-id');
            var date = $(this).attr('data-date');
            var user_id = $(this).attr('data-user');
            var day = $(this).attr('data-day');
            var twd_id = $('#totalWeekDuration-'+user_id).attr('data-id');
            var week = $('#ts-sorting-week').val();
            getTimesheetData(timesheet_id,user_id,day_id,date,day,twd_id,week);
        });
        // Tuesday
        $(document).on('click','#tsTuesday',function () {
            $('#createProject').modal({backdrop: 'static', keyboard: false});
            var day_id = $(this).attr('data-id');
            var timesheet_id = $(this).closest('tr').attr('data-id');
            var date = $(this).attr('data-date');
            var user_id = $(this).attr('data-user');
            var day = $(this).attr('data-day');
            var twd_id = $('#totalWeekDuration-'+user_id).attr('data-id');
            var week = $('#ts-sorting-week').val();
            getTimesheetData(timesheet_id,user_id,day_id,date,day,twd_id,week);
        });
        //Wednesday
        $(document).on('click','#tsWednesday',function () {
            $('#createProject').modal({backdrop: 'static', keyboard: false});
            var day_id = $(this).attr('data-id');
            var timesheet_id = $(this).closest('tr').attr('data-id');
            var date = $(this).attr('data-date');
            var user_id = $(this).attr('data-user');
            var day = $(this).attr('data-day');
            var twd_id = $('#totalWeekDuration-'+user_id).attr('data-id');
            var week = $('#ts-sorting-week').val();
            getTimesheetData(timesheet_id,user_id,day_id,date,day,twd_id,week);
        });
        //Thursday
        $(document).on('click','#tsThursday',function () {
            $('#createProject').modal({backdrop: 'static', keyboard: false});
            var day_id = $(this).attr('data-id');
            var timesheet_id = $(this).closest('tr').attr('data-id');
            var date = $(this).attr('data-date');
            var user_id = $(this).attr('data-user');
            var day = $(this).attr('data-day');
            var twd_id = $('#totalWeekDuration-'+user_id).attr('data-id');
            var week = $('#ts-sorting-week').val();
            getTimesheetData(timesheet_id,user_id,day_id,date,day,twd_id,week);
        });
        //Friday
        $(document).on('click','#tsFriday',function () {
            $('#createProject').modal({backdrop: 'static', keyboard: false});
            var day_id = $(this).attr('data-id');
            var timesheet_id = $(this).closest('tr').attr('data-id');
            var date = $(this).attr('data-date');
            var user_id = $(this).attr('data-user');
            var day = $(this).attr('data-day');
            var twd_id = $('#totalWeekDuration-'+user_id).attr('data-id');
            var week = $('#ts-sorting-week').val();
            getTimesheetData(timesheet_id,user_id,day_id,date,day,twd_id,week);
        });
        //Saturday
        $(document).on('click','#tsSaturday',function () {
            $('#createProject').modal({backdrop: 'static', keyboard: false});
            var day_id = $(this).attr('data-id');
            var timesheet_id = $(this).closest('tr').attr('data-id');
            var date = $(this).attr('data-date');
            var user_id = $(this).attr('data-user');
            var day = $(this).attr('data-day');
            var twd_id = $('#totalWeekDuration-'+user_id).attr('data-id');
            var week = $('#ts-sorting-week').val();
            getTimesheetData(timesheet_id,user_id,day_id,date,day,twd_id,week);
        });
        //Sunday
        $(document).on('click','#tsSunday',function () {
            $('#createProject').modal({backdrop: 'static', keyboard: false});
            var day_id = $(this).attr('data-id');
            var timesheet_id = $(this).closest('tr').attr('data-id');
            var date = $(this).attr('data-date');
            var user_id = $(this).attr('data-user');
            var day = $(this).attr('data-day');
            var twd_id = $('#totalWeekDuration-'+user_id).attr('data-id');
            var week = $('#ts-sorting-week').val();
            getTimesheetData(timesheet_id,user_id,day_id,date,day,twd_id,week);
        });
        //Calculation total duration
        $(document).on('change','.ts-duration',function () {
            $(".alert-message").fadeIn('fast',function(){
                $('.alert-message').show();
            });
            var day = $(this).attr('name');
            var day_date = $(this).attr('data-date');
            var total = 0;
            var total_mins = 0;
            var total_hrs = 0;
            var hrs = 0;
            var min = 0;
            var id = $(this).closest('tr').attr('data-id');
            $('td > .ts-duration'+id).each(function () {
                var duration = $(this).val();
                var split = duration.split(":");
                var hours = parseInt(split[0]);
                var mins = parseInt(split[1]);
                if (!isNaN(mins)){
                    total_mins += mins;
                }
                if (!isNaN(hours)){
                    total_hrs += hours;
                }
            });
            hrs = Math.floor(total_mins / 60);
            min = total_mins % 60;
            total_hrs += hrs;
            total = total_hrs+':'+leftPad(min,2);
            $('#totalWeekDuration'+id).text(total);
            totalPerDay(id,day,day_date);
            totalWeekDuration(day_date,day);
            $.ajax({
               url:"/timesheet/updateTotalWeekDuration",
               type:"POST",
               dataType:"json",
               data:{id:id,total:total},
               success:function (data) {
                   if (data == 1){
                       $(".alert-message").fadeOut(5000,function(){
                           $('.alert-message').hide();
                       });
                   }

               }
            });
        });
        function totalPerDay(id,day,day_date) {
            var total = 0;
            var total_mins = 0;
            var total_hrs = 0;
            var hrs = 0;
            var min = 0;
            var user = $('#tsUsersList').val();
            $("input[name$='"+day+"']").each(function () {
               var duration = $(this).val();
               var split = duration.split(":");
                var hours = parseInt(split[0]);
                var mins = parseInt(split[1]);
                if (!isNaN(mins)){
                    total_mins += mins;
                }
                if (!isNaN(hours)){
                    total_hrs += hours;
                }
            });
            hrs = Math.floor(total_mins / 60);
            min = total_mins % 60;
            total_hrs += hrs;
            total = total_hrs+':'+leftPad(min,2);
            var day_total_id = 0;
            switch(day) {
                case "monday":
                    $('#totalMonday').text(total);
                    day_total_id = $('#totalMonday').attr('data-id');
                    break;
                case "tuesday":
                    $('#totalTuesday').text(total);
                    day_total_id = $('#totalTuesday').attr('data-id');
                    break;
                case "wednesday":
                    $('#totalWednesday').text(total);
                    day_total_id = $('#totalWednesday').attr('data-id');
                    break;
                case "thursday":
                    $('#totalThursday').text(total);
                    day_total_id = $('#totalThursday').attr('data-id');
                    break;
                case "friday":
                    $('#totalFriday').text(total);
                    day_total_id = $('#totalFriday').attr('data-id');
                    break;
                case "saturday":
                    $('#totalSaturday').text(total);
                    day_total_id = $('#totalSaturday').attr('data-id');
                    break;
                case "sunday":
                    $('#totalSunday').text(total);
                    day_total_id = $('#totalSunday').attr('data-id');
                    break;
                default:
                break;
            }
            $.ajax({
                url:"/timesheet/addingTotalInDay",
                type:"POST",
                dataType:"json",
                data:{id:day_total_id,total:total,day_date:day_date,day:day,user_id:user},
                success:function () {
                    var week = $('#ts-sorting-week').val();
                    var user = $('#tsUsersList').val();
                    showWeekList(week,user);
                }
            });

        }

        function totalWeekDuration(day_date) {
            var week = $('#ts-sorting-week').val();
            var user = $('#tsUsersList').val();
            var total = 0;
            var total_mins = 0;
            var total_hrs = 0;
            var hrs = 0;
            var min = 0;
            $('.totalWeek').each(function () {
                var duration = $(this).text();
                var split = duration.split(":");
                var hours = parseInt(split[0]);
                var mins = parseInt(split[1]);
                if (!isNaN(mins)){
                    total_mins += mins;
                }
                if (!isNaN(hours)){
                    total_hrs += hours;
                }
            });
            hrs = Math.floor(total_mins / 60);
            min = total_mins % 60;
            total_hrs += hrs;
            total = total_hrs+':'+leftPad(min,2);
            $('#totalWeekDuration-'+user).text(total);
            var twd_id = $('#totalWeekDuration-'+user).attr('data-id');
            $.ajax({
               url:'/timesheet/updateTotalDuration',
               type:"POST",
               dataType:"json",
               data:{total:total,date:day_date,week:week,user_id:user,twd_id:twd_id},
               success:function (data) {

               }
            });
        }
        function leftPad(number, targetLength) {
            var output = number + '';
            while (output.length < targetLength) {
                output = '0' + output;
            }
            return output;
        }

        //Updating Project name
        $(document).on('click','#editProjectName',function () {
            var id = $(this).attr('data-id');
            var project_name = $(this).attr('data-name');
            var week = $('#ts-sorting-week').val();
            var user = $('#tsUsersList').val();
            Swal.fire({
                title: 'Do you want to rename this project?',
                input: 'text',
                inputValue: project_name,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, rename it!',
            }).then((result) => {
                if (result.value) {
                $.ajax({
                    url:'/timesheet/updateProjectName',
                    method:"POST",
                    data:{id:id,name:result.value},
                    success:function (data) {
                        showWeekList(week,user);
                        Swal.fire(
                            {
                                showConfirmButton: false,
                                timer: 2000,
                                title: 'Success',
                                html: "Project: <strong>"+project_name+"</strong> has been updated to <strong>"+data+"</strong>",
                                icon: 'success'
                            });
                    }
                });
            }
        });
        });
        //Deleting Project
        $(document).on('click','#removeProject',function () {
            var id = $(this).attr('data-id');
            var project_name = $(this).attr('data-name');
            var week = $('#ts-sorting-week').val();
            var user = $('#tsUsersList').val();
            Swal.fire({
                title: 'Are you sure to delete this?',
                html: "Project name: <strong>"+project_name+"</strong>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.value) {
                $.ajax({
                    url:'/timesheet/deleteProjectData',
                    method:"POST",
                    data:{id:id},
                    success:function () {
                        showWeekList(week,user);
                        Swal.fire(
                            {
                                showConfirmButton: false,
                                timer: 2000,
                                title: 'Success',
                                html: "Project <strong>"+project_name+"</strong> has been deleted!",
                                icon: 'success'
                            });
                    }
                });
            }
        });
        });

    });

</script>