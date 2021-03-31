<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<style type="text/css">
    th{
        text-align: center;
    }
    .tile-container{
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        -webkit-box-shadow: 0 2px 8px 0 rgba(0,0,0,.2);
        -moz-box-shadow: 0 2px 8px 0 rgba(0,0,0,.2);
        box-shadow:0 2px 8px 0 rgba(0,0,0,.2);
        background-color: #fff;
        background-image: none;
        border: 1px solid #d4d7dc;
        -webkit-transition: all .3s ease;
        position:relative;
        width: 100%;
        height: 90%;
        padding: 0;
        margin-right: 10px;
    }
    .inner-content .card-title{
        display: inline-block;
        width: 80%;
    }
    .inner-content .card-title span{
        font-weight: bold;
        font-size: 15px;
    }
    .inner-content .card-data{
        width: 10%;
        display: inline-block;
        vertical-align: middle;
    }
    .inner-content .card-data span{
        float: right;
        font-weight: bold;
        font-size: 20px;
        color: grey;
    }
    .inner-content .progress{
        margin-top: 10px;
    }
    .inner-content .progress .progress-bar{
        color: black;
    }
    .inner-content .progress .active{
        animation: progress-bar-stripes 2s linear infinite;
    }
    .inner-content .progress .progress-bar-success{
        background-color: #5abf51;
    }
    .inner-content .progress .progress-bar-danger{
        background-color: #ff6523;
    }
    .inner-content .progress .progress-bar-warning{
        background-color: #ffd176;
    }
    .tbl-employee-attendance .tbl-id-number{
        text-align: center;
    }
    .tbl-employee-attendance .tbl-employee-name{
        font-size: 12px;
        font-weight: bold;
    }
    .tbl-employee-attendance .tbl-emp-role{
        display: block;
        font-style: italic;
        color: grey;
        font-size: 11px;
    }
    .tbl-employee-attendance .tbl-emp-action,.tbl-chk-in, .tbl-chk-out, .tbl-lunch-in, .tbl-lunch-out{
        text-align: center;
    }
    .tbl-employee-attendance .tbl-emp-action .employee-in-out,.employee-break{
        color: grey;
    }
    .tbl-employee-attendance .tbl-emp-action .employee-in-out:hover{
        text-decoration: underline;
        color: #0b97c4;
    }
    .tbl-employee-attendance .fa-times-circle{
        color: orangered;
        vertical-align: bottom;
    }
    .tbl-employee-attendance .fa-check{
        color: greenyellow;
        vertical-align: bottom;
    }
    .swal2-image{
        height: 120px;
        width: 120px;
        border-radius: 50%;
    }
    .tbl-emp-action .employee-in-out[disabled="disabled"]{
        cursor: not-allowed;
        color: #92969d;
    }
    .tbl-emp-action .employee-in-out[disabled="disabled"]:hover{
        color: #92969d;
    }
    .tbl-emp-action .employee-break[disabled="disabled"]{
        cursor: not-allowed;
        color: #92969d;
    }
    .tbl-emp-action .employee-break[disabled="disabled"]:hover{
        color: #92969d;
    }
    .status{
        margin-left: 10px;
    }
    .fa-mug-hot{
        color: #ffc859;
    }
    .red-indicator{
        display: none;
        width: 10px;
        height: 10px;
        background-color: red;
        border-radius: 50%;
        border: 1px solid red;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 5px;
        box-shadow:0 2px 5px 2px rgba(0, 0, 0, 0.51);
    }
    /*Employee css*/
    .user-logs-container{
        height: 100%;
    }
    .user-logs-container .user-card-title{
        border-bottom: 1px solid #cbd0da;
        width: 100%;
        padding-bottom: 8px;
    }
    .user-clock-in-title,.user-clock-out-title,.user-lunch-in-title,.user-lunch-out-title{
        font-weight: bold;
        min-height: 31px;
        color: #92969d;
    }
    .user-clock-in,.user-clock-out,.user-lunch-in,.user-lunch-out,.user-shift-duration{
        min-height: 31px;
        display: block;
        text-align: right;
    }
    .user-clock-in span{
        font-size: 12px;
        display: inline-block;
        float: left;
    }
    .user-logs{
        width: 100%;
    }
    .user-logs-section{
        position: relative;
        width: 49%;
        display: inline-block;
        vertical-align: top;
    }
    .user-logs-title{
        display: inline-block;
        position: relative;
    }
    .user-logs-title .fa-coffee{
        color: #92969d;
    }
    .user-logs-title a[disabled="disabled"]{
        cursor: not-allowed;
    }
    .right{
        float: right;
    }

    /*Employee button lunch*/
    .employeeLunch .btn-lunch-hover{
        display: none;
        position: absolute;
        top: 0;
        z-index: 99;
    }
    .employeeLunch:hover .btn-lunch-hover{
        display: inline-block;
    }
    .employeeLunch:hover .btn-lunch{
        visibility: hidden;
    }
    /*Lunch button tooptip*/
    .employeeLunchBtn .employeeLunchTooltip{
        visibility: hidden;
        font-size: 14px!important;
        font-weight: bold!important;
        color: #ffffff;
        text-align: center;
        min-width: 110px;
        padding: 10px;
        position: absolute;
        border-radius: 2px;
        background-color: #0000008a;
        z-index: 1;
        bottom: 100%;
        left: 55%;
        margin-left: -60px;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    }
    .employeeLunchBtn .employeeLunchTooltip::after{
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #0000008a transparent transparent transparent;
    }
    .employeeLunchBtn:hover .employeeLunchTooltip{
        visibility: visible;
    }

    /*Employee button leave*/
    .employeeLeaveBtn .btn-leave-hover{
        visibility: hidden;
        position: absolute;
        top: -12px;
        z-index: 99;
    }
    .employeeLeaveBtn:hover .btn-leave-hover{
        visibility: visible;
    }
    .employeeLeaveBtn:hover .btn-leave-static{
        visibility: hidden;
    }
    /*Leave button tooltip*/
    .employeeLeaveBtn + .employeeLeaveTooltip{
        visibility: hidden;
        font-size: 14px!important;
        font-weight: bold!important;
        color: #ffffff;
        text-align: center;
        min-width: 150px;
        padding: 10px;
        position: absolute;
        border-radius: 2px;
        background-color: #0000008a;
        z-index: 1;
        bottom: 110%;
        left: 70%;
        margin-left: -60px;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    }
    .employeeLeaveBtn + .employeeLeaveTooltip::after{
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #0000008a transparent transparent transparent;
    }
    .employeeLeaveBtn:hover + .employeeLeaveTooltip{
        visibility: visible;
    }
    /*input tags*/
    .bootstrap-tagsinput .tag{
        border-radius: 3px;
        background: grey;
    }
</style>
<div class="<?= $class ?>" data-id="<?= $id ?>"  id="widget_<?= $id ?>">
    <div  style="width: 300px; border: 1px solid #58c04e; background: #58c04e; color:white;  border-radius: 10px; text-align: center;padding: 5px;position: relative;margin: 0 auto;top: 21px;z-index: 1000;">
        <i class="fa fa-book" aria-hidden="true"></i> Timesheet
        
        <div class="float-right">
            <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                <span type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                    &nbsp;<span class="fa fa-ellipsis-v"></span></span>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#" class="dropdown-item" onclick="removeWidget('<?= $id ?>')">Close</a></li>
                    <li><a href="#" class="dropdown-item" onclick="addToMain('<?= $id ?>',<?php echo ($isMain?'1':'0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain?'Remove From Main':'Add to Main') ?></a></li>
                    <li><a href="#" class="dropdown-item">Move</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card" style="border: 2px solid #30233d; margin-top:0; border-radius: 40px; padding:5px;">
        <div style="border: 5px solid #30233d; margin-top:0; border-radius: 40px; box-shadow: 1px 0px 15px 5px rgb(48, 35, 61);">
            <div class="card-body mt-2" style="padding:5px 10px;  height: <?= $rawHeight+10 ?>px; overflow: hidden">
                <div class="expenses-money-section" style="margin-top:10px;">
                    <div class="inner-news">
                        <table id="ts-attendance" class="table table-bordered table-striped tbl-employee-attendance">
                            <thead>
                                <tr>
                                    <th style="width:40%" rowspan="2">Employee Name</th>
                                    <th rowspan="2">In</th>
                                    <th rowspan="2">Out</th>
                                    <th colspan="2">Lunch</th>
                                    <!-- <th rowspan="2">Action</th>
                                    <th rowspan="2">Comments/Location</th> -->
                                </tr>
                                <tr>
                                    <th>In</th>
                                    <th>Out</th>
                                </tr>
                            </thead>
                            <tbody  id="timesheetBody">
                                <tr>
                                    <td colspan="6"><div class="progress" style="height:40px;"><div class="progress-bar progress-bar-striped bg-warning active" role="progressbar" style="width: 100%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">System is fetching data</div></div></td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="<?php echo base_url() . "timesheet/attendance"; ?>">See More</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        loadTimesheet();
        //alert('hey');

    });
    function loadTimesheet() {

        $.ajax({
            url: '<?php echo base_url(); ?>widgets/loadTimesheet',
            method: 'get',
            data: {},
            beforeSend: function () {
                // $('#timesheetBody').html('')
            },
            success: function (response) {
                $('#timesheetBody').html(response);
            }

        });

    }
    ;
</script>