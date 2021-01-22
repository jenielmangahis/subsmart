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
        top:20px;
        width: 100%;
        height: 90%;
        padding: 0;
        margin-right: 10px;
    }
    .inner-content{
        padding: 20px;
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
        font-size: 15px;
        font-weight: bold;
    }
    .tbl-employee-attendance .tbl-emp-role{
        display: block;
        font-style: italic;
        color: grey;
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
<div class="col-sm-4 module ui-state-default" id="bulletin">
    <div class="expenses tile-container">
        <div class="inner-container">
            <div class="tileContent">
                <div class="clear">
                    <div class="inner-content">
                        <div class="header-container" style="border-bottom:1px solid gray;">
                            <h3 class="header-content"><i class="fa fa-bullhorn" aria-hidden="true"></i> Timesheet</h3>
                        </div>
                        <div class="expenses-money-section" style="margin-top:10px;">
                            <div class="inner-news" style="height: 300px; overflow-x: scroll;">
                            <table id="ts-attendance" class="table table-bordered table-striped tbl-employee-attendance">
                                            <thead>
                                            <tr>
                                                <th rowspan="2">ID</th>
                                                <th rowspan="2">Employee Name</th>
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
                                            <tbody>
                                            <?php
                                            $u_role = null;
                                            $status = 'fa-times-circle';
                                            $tooltip_status = 'Not logged in';
                                            $time_in = null;
                                            $time_out = null;
                                            $btn_action = 'employeeCheckIn';
                                            $disabled = null;
                                            $break = 'disabled="disabled"';
                                            $break_id = null;
                                            $break_in = null;
                                            $break_out = null;
                                            $indicator_in = 'display:none';
                                            $indicator_out = 'display:none';
                                            $indicator_in_break = 'display:none';
                                            $indicator_out_break = 'display:none';
                                            $week_id = null;
                                            $attn_id = null;
                                            $yesterday_in = null;
                                            $yesterday_out = null;
                                            $clock_in_2nd = 0;
                                            $out_count = 0;
                                            $in_count = 0;
                                            $company_id = 0;
                                            ?>
                                            <?php $counter = 0;?>
                                            <?php foreach ($users as $cnt => $user): ?>
                                                <?php $counter += 1;?>
                                                <?php
                                                $user_photo = userProfileImage($user->id);
                                                $company_id = $user->company_id;
                                                foreach ($user_roles as $role){
                                                    if ($role->id == $user->role){
                                                        $u_role = $role->title;
                                                    }
                                                }
                                                foreach ($attendance as $attn){
                                                        foreach ($logs as $log){
                                                            if ($user->id == $attn->user_id){
                                                                $attn_id = $attn->id;
                                                                if ($attn_id == $log->attendance_id){
                                                                    if ($log->action == 'Check in'){
                                                                        if (date('Y-m-d',strtotime($log->date_created)) == date('Y-m-d',strtotime('yesterday'))){
                                                                            $yesterday_in = "(Yesterday)";
                                                                        }else{
                                                                            $yesterday_in = null;
                                                                        }
                                                                        $time_in = date('h:i A',strtotime($log->date_created));
                                                                        $time_out = null;
                                                                        $break_in = null;
                                                                        $break_out = null;
                                                                        $btn_action = 'employeeCheckOut';
                                                                        $status = 'fa-check';
                                                                        $break = null;
                                                                        $disabled = null;
                                                                        $break_id = 'employeeBreakIn';
                                                                        $indicator_in = 'display:block';
                                                                        $indicator_out = 'display:none';
                                                                        $indicator_in_break = 'display:none';
                                                                        $indicator_out_break = 'display:none';
                                                                        $tooltip_status = 'Logged in';
                                                                    }
                                                                    if ($log->action == 'Break in'){
                                                                        $break_id = 'employeeBreakOut';
                                                                        $status = 'fa-mug-hot';
                                                                        $break_in = date('h:i A',strtotime($log->date_created));
                                                                        $indicator_in = 'display:none';
                                                                        $indicator_out = 'display:none';
                                                                        $indicator_in_break = 'display:block';
                                                                        $indicator_out_break = 'display:none';
                                                                        $tooltip_status = 'On break';
                                                                        $break_out = null;
                                                                    }
                                                                    if ($log->action == 'Break out'){
                                                                        $status = 'fa-check';
                                                                        $break_out = date('h:i A',strtotime($log->date_created));
//                                                                    $break = 'disabled="disabled"';
                                                                        $break_id = 'employeeBreakIn';
                                                                        $indicator_in = 'display:none';
                                                                        $indicator_out = 'display:none';
                                                                        $indicator_in_break = 'display:none';
                                                                        $indicator_out_break = 'display:block';
                                                                        $tooltip_status = 'Back to work';
                                                                    }
                                                                    if($log->action == 'Check out'){
                                                                        $status = 'fa-times-circle';
                                                                        $btn_action = 'employeeCheckIn';
                                                                        $time_out = date('h:i A',strtotime($log->date_created));
                                                                        $disabled = null;
                                                                        $break = 'disabled="disabled"';
                                                                        $break_id = null;
                                                                        $indicator_in = 'display:none';
                                                                        $indicator_out = 'display:block';
                                                                        $indicator_in_break = 'display:none';
                                                                        $indicator_out_break = 'display:none';
                                                                        $tooltip_status = 'Logged out';
                                                                    }
                                                                }
                                                            }
                                                        }
                                                }
                                                if ($indicator_in == 'display:block' || $indicator_in_break == 'display:block' || $indicator_out_break == 'display:block'){
                                                    $in_count++;
                                                }
                                                if ($indicator_out == 'display:block'){
                                                    $out_count++;
                                                }
                                                ?>
                                                <tr>
                                                    <td class="tbl-id-number"><?php echo $user->id?></td>
                                                    <td>
                                                        <span class="tbl-employee-name"><?php echo $user->FName;?></span> <span class="tbl-employee-name"><?php echo $user->LName; ?></span>
                                                        <span class="tbl-emp-role"><?php echo $u_role;?></span>
                                                    </td>
                                                    <td class="tbl-chk-in" data-count="<?php echo $in_count?>"><div class="red-indicator" style="<?php echo $indicator_in?>"></div> <span class="clock-in-time"><?php echo $time_in?></span> <span class="clock-in-yesterday" style="display: block;"><?php echo $yesterday_in;?></span></td>
                                                    <td class="tbl-chk-out" data-count="<?php echo $time_out?>"><div class="red-indicator" style="<?php echo $indicator_out?>"></div> <span class="clock-out-time"><?php echo $time_out?></span></td>
                                                    <td class="tbl-lunch-in"><div class="red-indicator" style="<?php echo $indicator_in_break?>"></div> <span class="break-in-time"><?php echo $break_in;?></span></td>
                                                    <td class="tbl-lunch-out"><div class="red-indicator" style="<?php echo $indicator_out_break?>"></div> <span class="break-out-time"><?php echo $break_out;?></span></td>
                                                    <!-- <td class="tbl-emp-action">
                                                        <a href="javascript:void(0)" title="Lunch in/out" data-toggle="tooltip" class="employee-break" id="<?php echo $break_id?>" <?php echo $break;?> data-id="<?php echo $user->id?>" data-name="<?php echo $user->FName;?> <?php echo $user->LName; ?>" data-approved="<?php echo $this->session->userdata('logged')['id'];?>" data-photo="<?php echo $user_photo;?>" data-company="<?php echo $company_id?>"><i class="fa fa-coffee fa-lg"></i></a>
                                                        <a href="javascript:void(0)" title="Clock in/out" data-toggle="tooltip" class="employee-in-out" <?php echo $disabled?> id="<?php echo $btn_action;?>" data-attn="<?php echo $attn_id;?>" data-name="<?php echo $user->FName;?> <?php echo $user->LName; ?>" data-id="<?php echo $user->id;?>" data-approved="<?php echo $this->session->userdata('logged')['id'];?>" data-photo="<?php echo $user_photo;?>" data-company="<?php echo $company_id?>"><i class="fa fa-user-clock fa-lg"></i></a>
                                                        <i class="fa <?php echo $status;?> status" title="<?php echo $tooltip_status; ?>" data-toggle="tooltip"></i>
                                                    </td>
                                                    <td></td> -->
                                                </tr>
                                                <?php
                                                $u_role = null;
                                                $status = 'fa-times-circle';
                                                $tooltip_status = 'Not logged in';
                                                $time_in = null;
                                                $time_out = null;
                                                $btn_action = 'employeeCheckIn';
                                                $disabled = null;
                                                $break = 'disabled="disabled"';
                                                $break_id = null;
                                                $break_in = null;
                                                $break_out = null;
                                                $indicator_in = 'display:none';
                                                $indicator_out = 'display:none';
                                                $indicator_in_break = 'display:none';
                                                $indicator_out_break = 'display:none';
                                                $week_id = null;
                                                $attn_id = null;
                                                $yesterday_in = null;
                                                $yesterday_out = null;
                                                ?>
                                            <?php endforeach;?>
                                            </tbody>
                                        </table>
                                        <a href="<?php echo base_url() . "timesheet/attendance"; ?>">See More</a>
                                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>