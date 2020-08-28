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
    .swal2-title{
        font-size: 20px!important;
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
                        <a href="<?php echo url('/users/timesheet')?>" class="banking-tab" style="text-decoration: none">Attendance</a>
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
                                            <select name="" id="" class="form-control select2-employee-list">
                                                <option value="teammates" selected>Teammates</option>
<!--                                                --><?php //foreach ($users as $user): ?>
<!--                                                    <option value="--><?php //echo $user->id?><!--">--><?php //echo $user->FName?><!-- --><?php //echo $user->LName;?><!--</option>-->
<!--                                                --><?php //endforeach;?>
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
<div class="alert-message">
    <div class="alert alert-success">
        <strong>Success!</strong> You've updated a duration.
    </div>
</div>
<!--end of modal-->
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
        //Toggle edit pen
        $(document).on('click','#showEditPen',function () {
            if($(this).next('a').css('display') =='none'){
                $(this).next('a').css('display','inline-block');
            }else{
                $(this).next('a').css('display','none');
            }
        });

        var selected_week = $('#ts-sorting-week').val();
        $('#timesheet_settings').ready(showWeekList(selected_week));
        function showWeekList(week) {
            if(week != null){
                $.ajax({
                    url:"/timesheet/showTimesheetSettings",
                    type:"GET",
                    dataType:"json",
                    data:{week:week},
                    success:function (data) {
                        $('#timesheet_settings').html(data);
                        // Restriction of input field
                        var options =  {
                            onKeyPress: function(cep, e, field, options) {
                                var masks = ['00:00'];
                                var mask = (cep.length>4) ? masks[1] : masks[0];
                                $('.ts-duration').mask(mask, options);
                            }};
                        $('.ts-duration').mask("00:00",options);
                    }
                });
            }
        }
        $(document).on('change','#ts-sorting-week',function () {
            var week = $(this).val();
            showWeekList(week);
        });
        //Updating duration
        // Monday
        $(document).on('change','#tsMonday',function () {
           var project_id = $(this).closest('tr').attr('data-id');
           var day_id = $(this).attr('data-id');
           var duration = $(this).val();
           var day = "Monday";
           var date = $(this).attr('data-date');
           $.ajax({
              url:"/timesheet/updateDuration",
              type:"POST",
              dataType:"json",
              cache:false,
              data:{day_id:day_id,project_id:project_id,duration:duration,day:day,date:date},
              success:function (data) {

              }
           });
        });
        // Tuesday
        $(document).on('change','#tsTuesday',function () {

            var project_id = $(this).closest('tr').attr('data-id');
            var day_id = $(this).attr('data-id');
            var duration = $(this).val();
            var day = "Tuesday";
            var date = $(this).attr('data-date');
            $.ajax({
                url:"/timesheet/updateDuration",
                type:"POST",
                dataType:"json",
                cache:false,
                data:{day_id:day_id,project_id:project_id,duration:duration,day:day,date:date},
                success:function (data) {

                }
            });
        });
        //Wednesday
        $(document).on('change','#tsWednesday',function () {
            var project_id = $(this).closest('tr').attr('data-id');
            var day_id = $(this).attr('data-id');
            var duration = $(this).val();
            var day = "Wednesday";
            var date = $(this).attr('data-date');
            $.ajax({
                url:"/timesheet/updateDuration",
                type:"POST",
                dataType:"json",
                cache:false,
                data:{day_id:day_id,project_id:project_id,duration:duration,day:day,date:date},
                success:function () {

                }
            });
        });
        //Thursday
        $(document).on('change','#tsThursday',function () {
            var project_id = $(this).closest('tr').attr('data-id');
            var day_id = $(this).attr('data-id');
            var duration = $(this).val();
            var day = "Thursday";
            var date = $(this).attr('data-date');
            $.ajax({
                url:"/timesheet/updateDuration",
                type:"POST",
                dataType:"json",
                cache:false,
                data:{day_id:day_id,project_id:project_id,duration:duration,day:day,date:date},
                success:function () {

                }
            });
        });
        //Friday
        $(document).on('change','#tsFriday',function () {
            var project_id = $(this).closest('tr').attr('data-id');
            var day_id = $(this).attr('data-id');
            var duration = $(this).val();
            var day = "Friday";
            var date = $(this).attr('data-date');
            $.ajax({
                url:"/timesheet/updateDuration",
                type:"POST",
                dataType:"json",
                cache:false,
                data:{day_id:day_id,project_id:project_id,duration:duration,day:day,date:date},
                success:function () {

                }
            });
        });
        //Saturday
        $(document).on('change','#tsSaturday',function () {
            var project_id = $(this).closest('tr').attr('data-id');
            var day_id = $(this).attr('data-id');
            var duration = $(this).val();
            var day = "Saturday";
            var date = $(this).attr('data-date');
            $.ajax({
                url:"/timesheet/updateDuration",
                type:"POST",
                dataType:"json",
                cache:false,
                data:{day_id:day_id,project_id:project_id,duration:duration,day:day,date:date},
                success:function () {

                }
            });
        });
        //Sunday
        $(document).on('change','#tsSunday',function () {
            var project_id = $(this).closest('tr').attr('data-id');
            var day_id = $(this).attr('data-id');
            var duration = $(this).val();
            var day = "Sunday";
            var date = $(this).attr('data-date');
            $.ajax({
                url:"/timesheet/updateDuration",
                type:"POST",
                dataType:"json",
                cache:false,
                data:{day_id:day_id,project_id:project_id,duration:duration,day:day,date:date},
                success:function () {

                }
            });
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
            totalWeekDuration(day_date);
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
                data:{id:day_total_id,total:total,day_date:day_date,day:day},
                success:function () {
                    showWeekList(selected_week);
                }
            });

        }

        function totalWeekDuration(day_date) {
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
            $('#totalWeekDuration').text(total);
            $.ajax({
               url:'/timesheet/updateTotalDuration',
               type:"POST",
               dataType:"json",
               data:{total:total,date:day_date,week:selected_week},
               success:function () {

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

        // Adding Project
        $(document).on('click','#addProject',function () {
            Swal.fire({
                title: 'Please enter project name',
                input: 'text',
                // html:
                // '<input id="swal-input1" class="swal2-input">' +
                // '<input id="swal-input2" class="swal2-input">',
                // inputAttributes: {
                //     autocapitalize: 'off'
                // },
                showCancelButton: true,
                confirmButtonText: 'Submit',
                confirmButtonColor: '#2ca01c',
                // preConfirm: function () {
                //     return new Promise(function (resolve) {
                //         resolve([
                //             $('#swal-input1').val(),
                //             $('#swal-input2').val()
                //         ])
                //     })
                // },
                // onOpen: function () {
                //     $('#swal-input1').focus()
                // },
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url:"/timesheet/addingProjects",
                        method:"POST",
                        dataType:"json",
                        data:{project:result.value},
                        cache:false,
                        success:function (data) {
                            showWeekList(selected_week)
                            if(data == 1){
                                Swal.fire(
                                    {
                                        showConfirmButton: false,
                                        timer: 2000,
                                        title: 'Success',
                                        text: "New Project has been added!",
                                        icon: 'success'
                                    });
                            }else{
                                Swal.fire(
                                    {
                                        showConfirmButton: false,
                                        timer: 2000,
                                        title: 'Failed',
                                        text: "Something is wrong in the process!",
                                        icon: 'warning'
                                    });
                            }
                        }
                    });
                }
            })

        });
        //Updating Project name
        $(document).on('click','#editProjectName',function () {
            var id = $(this).attr('data-id');
            var project_name = $(this).attr('data-name');
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
                        showWeekList(selected_week);
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
                        showWeekList(selected_week);
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