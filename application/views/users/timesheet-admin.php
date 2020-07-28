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
    td#name{
        width: auto !important;
    }

    /* progress bars for audit */
    .in-now{
        background-color: #03fcf4 !important;
    }
    .out-now{
        background-color: #ebe713 !important;
    }
    .not-logged-in-today{
        background-color: #c71230 !important;
    }
    .employees{
        background-color: #545ed6 !important;
    }
    .on-approved-leave{
        background-color: #a3c95d !important;
    }
    .on-unapproved-leave{
        background-color: #f5677e !important;
    }
    .on-leave{
        background-color: #8f30bf !important;
    }
    .on-business-travel{
        background-color: #5983de !important;
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
                        <h1 class="page-title">Attendance View</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Manage Timesheets</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
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
                    </div>
                </div>
                <div class="row" style="padding-bottom: 20px;">
                    <div class="col-md-12 banking-tab-container">
                        <a href="<?php echo url('/users/timesheet')?>" class="banking-tab<?php echo ($this->uri->segment(1)=="timesheet")?:'-active';?>" style="text-decoration: none">Attendance</a>
                        <a href="<?php echo url('/timesheet/employee')?>" class="banking-tab">Employee</a>
                        <a href="<?php echo url('/timesheet/schedule')?>" class="banking-tab">Schedule</a>
                        <a href="<?php echo url('/timesheet/list')?>" class="banking-tab">List</a>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title mb-5">Audit</h4>
                            <div class="row">
                                <div id="box1" class="card" style="width: 530px; height: 150px; font-size: 30px;">
                                    <b>0</b> 
                                    <span>In Now</span>
                                      <div class="progress">
                                        <div class="progress-bar in-now" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%; color: #000;">
                                          50%
                                        </div>
                                    </div>
                                </div>
                                <div id="box2" class="card" style="width: 400px; height: 150px; font-size: 30px;">
                                    <b>0</b>
                                    <span>Out Now</span>
                                    <div class="progress">
                                        <div class="progress-bar out-now" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%; color: #000;">
                                          50%
                                        </div>
                                    </div>
                                </div>
                                <div id="box3" class="card" style="width: 400px; height: 150px; font-size: 30px;">
                                    <b>0</b>
                                    <span>Not Logged In Today</span>
                                    <div class="progress">
                                        <div class="progress-bar not-logged-in-today" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%; color: #000;">
                                            50%
                                        </div>
                                    </div>
                                </div>
                                <div id="box4" class="card" style="width: 400px; height: 150px; font-size: 30px;">
                                    <b>22</b>
                                    <span>Employees</span>
                                    <div class="progress">
                                        <div class="progress-bar employees" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%; color: #000;">
                                            100%
                                        </div>
                                    </div>
                                </div>
                                <div id="box5" class="card" style="width: 400px; height: 150px; font-size: 30px;">
                                    <b>0</b>
                                    <span>On Approved Leave</span>
                                    <div class="progress">
                                        <div class="progress-bar on-approved-leave" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:70%; color: #000;">
                                            70%
                                        </div>
                                    </div>
                                </div>
                                <div id="box6" class="card" style="width: 400px; height: 150px; font-size: 30px;">
                                    <b>0</b>
                                    <span>On Unapproved Leave</span>
                                    <div class="progress">
                                        <div class="progress-bar on-unapproved-leave" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:20%; color: #000;">
                                            20%
                                        </div>
                                    </div>
                                </div>
                                <div id="box7" class="card" style="width: 400px; height: 150px; font-size: 30px;">
                                    <b>0</b>
                                    <span>On Leave</span>
                                    <div class="progress">
                                        <div class="progress-bar on-leave" role="progressbar" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100" style="width:15%; color: #000;">
                                            15%
                                        </div>
                                    </div>
                                </div>
                                <div id="box8" class="card" style="width: 400px; height: 150px; font-size: 30px;">
                                    <b>0</b>
                                    <span>On Business Travel</span>
                                    <div class="progress">
                                        <div class="progress-bar on-business-travel" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width:10%; color: #000;">
                                            10%
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h4 class="mt-0 header-title mb-5">Timesheet</h4>
                            <div class="row">
                                <div class="col-lg-12 table-responsive">

                                    <table id="dataTable1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th rowspan="2"><b>ID</b></th>
                                            <!-- <th>Image</th> -->
                                            <th rowspan="2" style="width: 150px !important;"><b>Name</b></th>
                                            <?php /*<th>Email</th>
                                            <th>Password</th>
                                            <th>Role</th>*/ ?>
                                            <!-- <th rowspan="2">Last Login</th> -->
                                            <!-- <th>Status</th> -->
                                            <th rowspan="2"><b>In</b></th>
                                            <th rowspan="2"><b>Out</b></th>

                                            <th colspan="2"><b>Lunch</b></th>
                                            <!-- <th>Out</th> -->
                                            <th rowspan="2" style="width: 150px;"><b>Action</b></th>
                                            <th rowspan="2" style="width: 305px;"><b>Comments/Schedule</b></th>
                                            
                                        </tr>
                                        <tr>
                                            <th>In</th>
                                            <th>Out</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            //print date('H:i');
                                            date_default_timezone_set('US/Central');
                                            //$current_time = date('Y-m-d H:i');
                                            $current_time_now = date('h:i a')." Manual Clock In";

                                            //session_start();
                                            /** check if session has started; session is started if you don't write this line can't use $_Session  global variable*/
                                            /*if (session_status() == PHP_SESSION_NONE) {
                                                session_start();
                                            }*/
                                            $clockin_sess = md5(uniqid());
                                            $_SESSION["clockin_sess"] = $clockin_sess;
                                        ?>
                                        
                                        <?php foreach ($users as $row): ?>
                                            <?php //if (logged('id') === $row->id): ?>
                                                <?php //echo "<pre>";print_r($users);echo "</pre>";?>
                                                <?php
                                                    $data['user_id'] = $row->id;
                                                    // clockin array for each user
                                                    $clockin_arr = $this->timesheet_model->getClockIn($data);
                                                    $clockout_arr = $this->timesheet_model->getClockOut($data);
                                                    //echo "<pre>";print_r($clockin_arr);echo "</pre>";


                                                ?>
                                                <tr class="timesheet_row">
                                                    <td width="60"><?php echo $row->id ?></td>
                                                    <td id="name">
                                                        <?php echo '<b>'.ucfirst($row->FName).' '.ucfirst($row->LName).'</b><br />'; ?>
                                                        <?php echo ucfirst($this->roles_model->getById($row->role)->title); ?>
                                                    </td>

                                                    <td class="clocked_in_<?php echo $row->id;?>" style="text-align: center;">
                                                        <?php //if (logged('id') !== $row->id): ?>
                                                            <!-- <input type="checkbox" class="js-switch"
                                                                   onchange="updateClockIn('<?php echo $row->id ?>', '<?php echo $current_time_now; ?>' )" <?php echo ($row->status) ? 'checked' : '' ?> /> -->
                                                            <?php //if( !empty($clockin_arr) ):?>

                                                                <?php foreach($clockin_arr as $k => $clockin ): ?>
                                                                    <?php if( $clockin->action == 'Clock In' && $k == 0 && $clockin->timestamp != 0 ):?>
                                                                        <input type="radio" name="clocked_in_<?php echo $row->id;?>" checked="checked" /><br />
                                                                        <span class="clocked_in_<?php echo $row->id;?>"><?php echo date('h:i a', strtotime($clockin->timestamp)); ?></span><br />
                                                                    <?php elseif( $clockin->action == 'Clock In' && $clockin_arr[0]->action != 'Clock In' && $clockin->timestamp != 0 ):?>
                                                                        <input type="radio" name="clocked_in_<?php echo $row->id;?>" style="visibility: hidden;" /><br />
                                                                        <span class="clocked_in_<?php echo $row->id;?>"><?php echo date('h:i a', strtotime($clockin->timestamp)); ?></span><br />
                                                                    <?php //else: ?>
                                                                        <!-- <input type="radio" name="clocked_in_<?php echo $row->id;?>" /><br />
                                                                        <span class="clocked_in_<?php echo $row->id;?>">00:00 </span> -->
                                                                    <?php endif;?>
                                                                <?php endforeach; ?>
                                                            <?php //endif;?>
                                                            <input type="hidden" name="clocked_in" value="" />
                                                            
                                                        <?php //endif ?>
                                                    </td>

                                                    <td class="clocked_out_<?php echo $row->id;?>" style="text-align: center;">
                                                        <?php //if (logged('id') !== $row->id): ?>
                                                            <!-- <input type="checkbox" class="js-switch"
                                                                   onchange="updateUserStatus('<?php echo $row->id ?>', $(this).is(':checked') )" <?php echo ($row->status) ? 'checked' : '' ?> /> -->
                                                            <?php //if( !empty($clockin_arr) ):?>
                                                                <?php foreach($clockin_arr as $k => $clockin ): ?>
                                                                    <?php if( $clockin->action == 'Clock Out' && $k == 0 && $clockin->timestamp != 0 ):?>
                                                                        <input type="radio" name="clocked_out_<?php echo $row->id;?>" checked="checked" /><br />
                                                                        <span class="clocked_out_<?php echo $row->id;?>"><?php echo date('h:i a', strtotime($clockin->timestamp)); ?></span><br />
                                                                    <?php elseif( $clockin->action == 'Clock Out' && $clockin_arr[0]->action != 'Clock Out' && $clockin->timestamp != 0 ):?>
                                                                        <input type="radio" name="clocked_out_<?php echo $row->id;?>" style="visibility: hidden;" /><br />
                                                                        <span class="clocked_out_<?php echo $row->id;?>"><?php echo date('h:i a', strtotime($clockin->timestamp)); ?></span><br />
                                                                    <?php //else: ?>
                                                                        <!-- <input type="radio" name="clocked_out_<?php echo $row->id;?>" /><br />
                                                                        <span class="clocked_out_<?php echo $row->id;?>">00:00 </span> -->
                                                                    <?php endif;?>
                                                                <?php endforeach; ?>
                                                            <?php //endif;?>
                                                            
                                                            <input type="hidden" name="clocked_out" value="" />
                                                            
                                                        <?php //endif ?>
                                                    </td>

                                                    <td class="lunched_in_<?php echo $row->id;?>" style="text-align: center;">
                                                        <?php //if (logged('id') !== $row->id): ?>
                                                            <!-- <input type="checkbox" class="js-switch"
                                                                   onchange="updateUserStatus('<?php echo $row->id ?>', $(this).is(':checked') )" <?php echo ($row->status) ? 'checked' : '' ?> /> -->
                                                            <?php //if( !empty($clockin_arr) ):?>
                                                                <?php foreach($clockin_arr as $k => $clockin ): ?>
                                                                    <?php if( $clockin->action == 'Lunch In' && $k == 0 && $clockin->timestamp != 0 ):?>
                                                                        <input type="radio" name="lunched_in_<?php echo $row->id;?>" checked="checked" /><br />
                                                                        <span class="lunched_in_<?php echo $row->id;?>"><?php echo date('h:i a', strtotime($clockin->timestamp)); ?></span><br />
                                                                    <?php elseif( $clockin->action == 'Lunch In' && $clockin_arr[0]->action != 'Lunch In' && $clockin->timestamp != 0 ):?>
                                                                        <input type="radio" name="lunched_in_<?php echo $row->id;?>" style="visibility: hidden;" /><br />
                                                                        <span class="lunched_in_<?php echo $row->id;?>"><?php echo date('h:i a', strtotime($clockin->timestamp)); ?></span><br />
                                                                    <?php //else: ?>
                                                                        <!-- <input type="radio" name="lunched_in_<?php echo $row->id;?>" /><br />
                                                                        <span class="lunched_in_<?php echo $row->id;?>">00:00 </span> -->
                                                                    <?php endif;?>
                                                                <?php endforeach;?>
                                                            <?php //endif;?>
                                                            
                                                            <input type="hidden" name="lunched_in" value="" />
                                                            
                                                        <?php //endif ?>
                                                    </td>

                                                    <td class="lunched_out_<?php echo $row->id;?>" style="text-align: center;">
                                                        <?php //if (logged('id') !== $row->id): ?>
                                                            <!-- <input type="checkbox" class="js-switch"
                                                                   onchange="updateUserStatus('<?php echo $row->id ?>', $(this).is(':checked') )" <?php echo ($row->status) ? 'checked' : '' ?> /> -->
                                                            <?php //if( !empty($clockin_arr) ):?>
                                                                <?php foreach($clockin_arr as $k => $clockin ): ?>
                                                                    <?php if( $clockin->action == 'Lunch Out' && $k == 0 && $clockin->timestamp != 0 ):?>
                                                                        <input type="radio" name="lunched_out_<?php echo $row->id;?>" checked="checked" /><br />
                                                                        <span class="lunched_out_<?php echo $row->id;?>"><?php echo date('h:i a', strtotime($clockin->timestamp)); ?></span><br />
                                                                    <?php elseif( $clockin->action == 'Lunch Out' && $clockin_arr[0]->action != 'Lunch Out' && $clockin->timestamp != 0 ):?>
                                                                        <input type="radio" name="lunched_out_<?php echo $row->id;?>" style="visibility: hidden;" /><br />
                                                                        <span class="lunched_out_<?php echo $row->id;?>"><?php echo date('h:i a', strtotime($clockin->timestamp)); ?></span><br />
                                                                    <?php //else: ?>
                                                                        <!-- <input type="radio" name="lunched_out_<?php echo $row->id;?>" /><br />
                                                                        <span class="lunched_out_<?php echo $row->id;?>">00:00 </span> -->
                                                                    <?php endif;?>
                                                                <?php endforeach;?>
                                                            <?php //endif;?>
                                                            
                                                            <input type="hidden" name="lunched_out" value="" />
                                                            
                                                        <?php //endif ?>
                                                    </td>
                                                    

                                                    <td id="">
                                                        <?php /*<!-- Clock In-->
                                                        <a id="clockin_btn" style="display:;" href="#" class="btn btn-sm btn-primary clockin_btn" title="Clock In" data-toggle="tooltip">
                                                            <i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Clock In
                                                        </a>
                                                        <!-- Lunch In-->
                                                        <a id="lunchin_btn" style="display: none; color: green;" href="#" class="btn btn-sm btn-primary lunchin_btn" title="Lunch In" data-toggle="tooltip">
                                                            <i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Lunch In
                                                        </a>
                                                        <!-- Lunch Out-->
                                                        <a id="lunchout_btn" style="display: none; color: red;" href="#" class="btn btn-sm btn-primary lunchout_btn" title="Lunch Out" data-toggle="tooltip">
                                                            <i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Lunch Out
                                                        </a>
                                                        <!-- Clock Out-->
                                                        <a id="clockout_btn" style="display: none; color: red;" href="#" class="btn btn-sm btn-primary clockout_btn" title="Clock Out" data-toggle="tooltip">
                                                            <i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Clock Out
                                                        </a>*/?>
                                                        <?php ////if (hasPermissions('users_edit')): ?>
                                                            <form name="clockin_form" method="post">
                                                                <input type="hidden" name="current_time_in" value="<?php echo date('Y-m-d H:i'); ?>" />
                                                                <input type="hidden" name="clockin_user_id" value="<?php echo $row->id; ?>" />
                                                                <input type="hidden" name="clockin_company_id" value="<?php echo $users1->id; ?>" />
                                                                <input type="hidden" name="clockin_status" value="1" />
                                                                <input type="hidden" name="clockin_sess" value="<?php echo $clockin_sess; ?>" />

                                                                
                                                                <?php if( empty($clockin_arr) ):?>
                                                                    <a id="clockin_btn" style="display:;" href="#" class="btn btn-sm btn-primary clockin_btn" title="Clock In" data-toggle="tooltip">
                                                                        <i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Clock In
                                                                    </a>
                                                                    <!-- <a id="lunchout_btn" style="display: ;" href="#" class="btn btn-sm btn-primary lunchout_btn" title="Lunch Out" data-toggle="tooltip">
                                                                        <i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Lunch Out
                                                                    </a>
                                                                    <a id="lunchin_btn" style="display:;" href="#" class="btn btn-sm btn-primary lunchin_btn" title="Lunch In" data-toggle="tooltip">
                                                                        <i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Lunch In
                                                                    </a> -->
                                                                    <!-- <a id="clockout_btn" style="display: ;" href="#" class="btn btn-sm btn-primary clockout_btn" title="Clock Out" data-toggle="tooltip">
                                                                        <i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Clock Out
                                                                    </a> -->
                                                                    <?php /*<select class="clock_action_dropdown" onchange="selectClockIn()">
                                                                        <option value="1">Clock In</option>
                                                                        <option value="2">Lunch In</option>
                                                                    </select>
                                                                    <select class="clock_action_dropdown" onchange="selectClockIn()">
                                                                        <option value="3">Clock Out</option>
                                                                        <option value="4">Lunch Out</option>
                                                                    </select>*/ ?>
                                                                <?php endif; ?>
                                                                <?php /*<select class="clock_action_dropdown" onchange="selectClockIn(this)">
                                                                    <option value="1">Clock In</option>
                                                                    <option value="2">Lunch In</option>
                                                                </select>
                                                                <select class="clock_action_dropdown" onchange="selectClockIn(this)">
                                                                    <option value="3">Clock Out</option>
                                                                    <option value="4">Lunch Out</option>
                                                                </select>*/ ?>
                                                                <!-- The following are new timesheet actions -->
                                                                <!-- Clock In-->
                                                                <?php if( !empty($clockin_arr) ):?>
                                                                    <?php if( $clockin_arr[0]->action == 'Clock In' && $clockin_arr[0]->timestamp != 0 ):?>
                                                                        <a id="clockin_btn" style="display: none;" href="#" class="btn btn-sm btn-primary clockin_btn" title="Clock In" data-toggle="tooltip">
                                                                            <i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Clock In
                                                                        </a>
                                                                    <?php else: ?>
                                                                        <a id="clockin_btn" style="display:;" href="#" class="btn btn-sm btn-primary clockin_btn" title="Clock In" data-toggle="tooltip">
                                                                            <i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Clock In
                                                                        </a>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                                <!-- Lunch In-->
                                                                <?php //if( !empty($clockin_arr) ):?>
                                                                    <?php //if( $clockin_arr[0]->action == 'Lunch In' && $clockin_arr[0]->timestamp != 0 ):?>
                                                                        <!-- <a id="lunchin_btn" style="display: none;" href="#" class="btn btn-sm btn-primary lunchin_btn" title="Lunch In" data-toggle="tooltip">
                                                                            <i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Lunch In
                                                                        </a> -->
                                                                    <?php //else: ?>
                                                                        <!-- <a id="lunchin_btn" style="display:;" href="#" class="btn btn-sm btn-primary lunchin_btn" title="Lunch In" data-toggle="tooltip">
                                                                            <i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Lunch In
                                                                        </a> -->
                                                                    <?php //endif; ?>
                                                                <?php //endif; ?>
                                                                <!-- Lunch Out-->
                                                                <?php //if( !empty($clockin_arr) ):?>
                                                                    <?php //if( $clockin_arr[0]->action == 'Lunch Out' && $clockin_arr[0]->timestamp != 0 ):?>
                                                                        <!-- <a id="lunchout_btn" style="display: none;" href="#" class="btn btn-sm btn-primary lunchout_btn" title="Lunch Out" data-toggle="tooltip">
                                                                            <i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Lunch Out
                                                                        </a> -->
                                                                    <?php //else: ?>
                                                                        <!-- <a id="lunchout_btn" style="display: ;" href="#" class="btn btn-sm btn-primary lunchout_btn" title="Lunch Out" data-toggle="tooltip">
                                                                            <i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Lunch Out
                                                                        </a> -->
                                                                    <?php //endif; ?>
                                                                <?php //endif; ?>
                                                                <!-- Clock Out-->
                                                                <?php if( !empty($clockin_arr) ):?>
                                                                    <?php if( $clockin_arr[0]->action == 'Clock Out' && $clockin_arr[0]->timestamp != 0 ):?>
                                                                        <a id="clockout_btn" style="display: none;" href="#" class="btn btn-sm btn-primary clockout_btn" title="Clock Out" data-toggle="tooltip">
                                                                            <i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Clock Out
                                                                        </a>
                                                                    <?php else: ?>
                                                                        <a id="clockout_btn" style="display: ;" href="#" class="btn btn-sm btn-primary clockout_btn" title="Clock Out" data-toggle="tooltip">
                                                                            <i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Clock Out
                                                                        </a>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>

                                                                <!-- Break In-->
                                                                <?php //if( !empty($clockin_arr) ):?>
                                                                    <?php //if( $clockin_arr[0]->action == 'Break In' && $clockin_arr[0]->timestamp != 0 ):?>
                                                                        <!-- <a id="breakin_btn" style="display: none;" href="#" class="btn btn-sm btn-primary breakin_btn" title="Clock Out" data-toggle="tooltip">
                                                                            <i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Break In
                                                                        </a> -->
                                                                    <?php //else: ?>
                                                                        <!-- <a id="breakin_btn" style="display: ;" href="#" class="btn btn-sm btn-primary breakin_btn" title="Clock Out" data-toggle="tooltip">
                                                                            <i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Break In
                                                                        </a> -->
                                                                    <?php //endif; ?>
                                                                <?php //endif; ?>

                                                                <!-- Break Out-->
                                                                <?php //if( !empty($clockin_arr) ):?>
                                                                    <?php //if( $clockin_arr[0]->action == 'Break Out' && $clockin_arr[0]->timestamp != 0 ):?>
                                                                        <!-- <a id="breakout_btn" style="display: none;" href="#" class="btn btn-sm btn-primary breakout_btn" title="Clock Out" data-toggle="tooltip">
                                                                            <i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Break Out
                                                                        </a> -->
                                                                    <?php //else: ?>
                                                                        <!-- <a id="breakout_btn" style="display: ;" href="#" class="btn btn-sm btn-primary breakout_btn" title="Clock Out" data-toggle="tooltip">
                                                                            <i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Break Out
                                                                        </a> -->
                                                                    <?php //endif; ?>
                                                                <?php //endif; ?>

                                                                <!-- <?php if( !empty($clockin_arr) ):?>
                                                                    <?php if( $clockin_arr[0]->action == 'Clock In' && $clockin_arr[0]->timestamp != 0 ):?>
                                                                    <a id="clockin" style="display: none;" href="#"
                                                                       class="btn btn-sm btn-primary" title="Clock In"
                                                                       data-toggle="tooltip"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Clock In</a>
                                                                    <a id="clockout" style="display: inline-block;" href="#"
                                                                       class="btn btn-sm btn-danger" title="Clock Out"
                                                                       data-toggle="tooltip"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Clock Out</a>
                                                                    
                                                                    <?php elseif( $clockin_arr[0]->action == 'Clock Out' && $clockin_arr[0]->timestamp != 0 ):?>
                                                                    <a id="clockin" style="" href="#"
                                                                   class="btn btn-sm btn-primary" title="Clock In"
                                                                   data-toggle="tooltip"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Clock In</a>
                                                                    <a id="clockout" style="display: none;" href="#"
                                                                   class="btn btn-sm btn-danger" title="Clock Out"
                                                                   data-toggle="tooltip"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Clock Out</a>
                                                                
                                                                    <?php endif;?>
                                                                <?php else: ?>
                                                                    <a id="clockin" style="" href="#"
                                                                   class="btn btn-sm btn-primary" title="Clock In"
                                                                   data-toggle="tooltip"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Clock In</a>
                                                                    <a id="clockout" style="display: none;" href="#"
                                                                   class="btn btn-sm btn-danger" title="Clock Out"
                                                                   data-toggle="tooltip"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Clock Out</a>
                                                                
                                                                <?php endif;?> -->
                                                            </form>
                                                        <?php //endif ?>
                                                    </td>

                                                    <td>
                                                        <?php //if (logged('id') !== $row->id): ?>
                                                            <!-- <input type="checkbox" class="js-switch"
                                                                   onchange="updateUserStatus('<?php //echo $row->id ?>', $(this).is(':checked') )" <?php //echo ($row->status) ? 'checked' : '' ?> /> -->
                                                            <input type="text" name="comments" placeholder="Comments/Schedule" disabled="disabled" />
                                                        <?php //endif ?>
                                                    </td>

                                                    <!-- Modal -->
                                                    <!-- Button trigger modal -->
                                                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                      Launch demo modal
                                                    </button> -->

                                                    <!-- Modal -->
                                                    <form name="manual_clockin_form" method="post">
                                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                          <div class="modal-dialog" role="document">
                                                            <div class="modal-content" style="width: 130%;">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">New Time Entry</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                      <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" style="text-align: left;">
                                                                    
                                                                    <div style="float: left; width: 500px;">
                                                                        <span style="margin-right: 25px;"><label>Entry Type</label> </span>
                                                                        <input id="workhours" type="radio" name="workhours"><span>Work Hours</span>
                                                                        <input id="pto" type="radio" name="pto"><span>PTO</span>
                                                                    </div>

                                                                    
                                                                    <div style="float: left; width: 380px;">

                                                                        <span style="margin-right: 62px;"><label>Date</label> </span>
                                                                        <input class="entry_date" type="text" placeholder="Select Date" name="date" autocomplete="off" />
                                                                    </div>

                                                                    <br>
                                                                    
                                                                    <div style="float: left; width: 500px;">
                                                                        <span style="margin-right: 15px;"><label>Clock In/Out</label> </span>
                                                                        <input type="text" placeholder="h:mm a" name="clockin" autocomplete="off" /> ->
                                                                        <input type="text" placeholder="h:mm a" name="clockout" autocomplete="off" />
                                                                    </div>
                                                                    
                                                                    <div style="float: left; width: 500px;">
                                                                        <span style="margin-right: 52px;"> <label>Breaks</label> </span>
                                                                        <input type="text" placeholder="h:mm a" name="breakin" autocomplete="off" /> ->
                                                                        <input type="text" placeholder="h:mm a" name="breakout" autocomplete="off" />
                                                                    </div>

                                                                    <br>
                                                                    
                                                                    <div style="float: left; width: 500px;">
                                                                        <span style="margin-right: 36px;"><label>Job Code</label> </span>
                                                                        <select name="jobcode">
                                                                            <option>Select Job Code</option>
                                                                            <option>Job Code 1</option>
                                                                            <option>Job Code 2</option>
                                                                            <option>Job Code 3</option>
                                                                        </select>
                                                                    </div>

                                                                    <div style="float: left; width: 500px;">
                                                                        <span style="margin-right: 56px;"> <label>Notes</label> </span>
                                                                        <textarea name="notes" placeholder="Type your notes here..." oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' style="width: 400px;"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                                                                    <button id="manual_add" type="submit" class="btn btn-primary" style="color: #45a73c;">ADD ENTRY</button>
                                                                </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </form>
                                                    <!-- end of Modal -->

                                                </tr>
                                            <?php //endif; ?>
                                        <?php endforeach ?>
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
    //$('#dataTable1').DataTable();

    $(document).ready(function () {
        $('#dataTable1').DataTable();


        /* Modal */
        $('#workhours').on('click', function(e){
            $("#pto").prop("checked", false);
        })
        $('#pto').on('click', function(e){
            $("#workhours").prop("checked", false);
        })

        $(".entry_date").datepicker();
        /* eol Modal */

        /*$('#dataTable1').on('click', 'tbody td', function() {

          //get textContent of the TD
          console.log('TD cell textContent : ', this.textContent)

          //get the value of the TD using the API 
          console.log('value by API : ', table.cell({ row: this.parentNode.rowIndex, column : this.cellIndex }).data());
        })*/

        /*$('#dataTable1').on('click', 'tbody tr', function(){
            //console.log('API row values : ', table.row(this).data());
            alert('asd');
        });*/

        $('.clockin_btn').on('click', function(e){
            var logged_in_id = "<?php echo logged('id');?>";

            $(this).hide();
            $('.lunchin_btn').show();

            // put indicator to show employee has clocked in
            /*$('td.clocked_out_'+logged_in_id).removeClass('red');
            $('td.clocked_in_'+logged_in_id).addClass('red');*/
            $('input[name=clocked_out_'+logged_in_id+']').prop("checked", false);
            $('input[name=clocked_in_'+logged_in_id+']').prop("checked", true);
            console.log(logged_in_id);
        });

        $('.lunchin_btn').on('click', function(e){
            var logged_in_id = "<?php echo logged('id');?>";
            $(this).hide();
            $('.lunchout_btn').show();

            // put indicator to show employee has clocked in
            /*$('td.clocked_in_'+logged_in_id).removeClass('red');
            $('td.lunched_in_'+logged_in_id).addClass('red');*/
            $('input[name=clocked_in_'+logged_in_id+']').prop("checked", false);
            $('input[name=lunched_in_'+logged_in_id+']').prop("checked", true);
            console.log(logged_in_id);
        });

        $('.lunchout_btn').on('click', function(e){
            var logged_in_id = "<?php echo logged('id');?>";
            $(this).hide();
            $('.clockout_btn').show();

            // put indicator to show employee has clocked in
            /*$('td.lunched_in_'+logged_in_id).removeClass('red');
            $('td.lunched_out_'+logged_in_id).addClass('red');*/
            $('input[name=lunched_in_'+logged_in_id+']').prop("checked", false);
            $('input[name=lunched_out_'+logged_in_id+']').prop("checked", true);
            console.log(logged_in_id);
        });

        $('.clockout_btn').on('click', function(e){
            var logged_in_id = "<?php echo logged('id');?>";
            $(this).hide();
            $('.clockin_btn').show();

            // put indicator to show employee has clocked in
            /*$('td.lunched_out_'+logged_in_id).removeClass('red');
            $('td.clocked_out_'+logged_in_id).addClass('red');*/
            $('input[name=lunched_out_'+logged_in_id+']').prop("checked", false);
            $('input[name=clocked_out_'+logged_in_id+']').prop("checked", true);
            console.log(logged_in_id);
        });


        function updateClockIn(){

            alert('Clock In updated');
        }

        $('a#clockin').on('click', function(e){
            //var values = $(this).parent('form').serializeArray();
            var values = {};
            $.each($(this).parent('form').serializeArray(), function (i, field) {
                values[field.name] = field.value;
            });
            //Value Retrieval Function
            var getValue = function (valueName) {
                return values[valueName];
            };
            var clockin_user_id = getValue('clockin_user_id');
            //console.log(clockin_user_id);

            e.preventDefault();
            //alert('Clock In this user');
            //
            $(this).css('display', 'none');
            // show clock out button
            $(this).next().css('display', 'inline-block');

            $("td#last_login span.last_login_now_" + clockin_user_id).css({"display":"inline-block", "color":"green"});
            $.ajax({
                type: "POST",
                url: "<?php echo url('users/clock_in') ?>",
                data: values,
                /*data: {
                    user_id: $("input[name='clockin_user_id']").val(),
                    clock_in: $("input[name='current_time_in']").val(),
                    status: $("input[name='clockin_status']").val()
                },*/
                success: function(result) {
                    alert('User has Clocked In');
                    //updateClockIn();
                    window.location.reload();
                    //console.log('okay');
                    //console.log(this);
                    //var last_login = result['current_time_in'];
                    //$(this).find('#last_login').append(last_login);
                },
                error: function(result) {
                    //console.log(data);
                    alert('error');
                }
            });
        })
        $('a#clockout').on('click', function(e){
            //var values = $(this).parent('form').serializeArray();
            var values = {};
            $.each($(this).parent('form').serializeArray(), function (i, field) {
                values[field.name] = field.value;
            });
            //Value Retrieval Function
            var getValue = function (valueName) {
                return values[valueName];
            };
            var clockout_user_id = getValue('clockin_user_id');
            //console.log(clockin_user_id);

            e.preventDefault();
            //alert('Clock In this user');
            //
            $(this).css('display', 'none');
            // show clock out button
            $(this).prev("a#clockin").css('display', 'inline-block');

            $("td#last_login span.last_login_now_" + clockout_user_id).css('display','inline-block');
            $.ajax({
                type: "POST",
                url: "<?php echo url('users/clock_out') ?>",
                data: values,
                /*data: {
                    user_id: $("input[name='clockin_user_id']").val(),
                    clock_in: $("input[name='current_time_in']").val(),
                    status: $("input[name='clockin_status']").val()
                },*/
                success: function(result) {
                    alert('User has Clocked Out');
                    window.location.reload();
                    //console.log('okay');
                    //console.log(this);
                    //var last_login = result['current_time_in'];
                    //$(this).find('#last_login').append(last_login);
                },
                error: function(result) {
                    //console.log(data);
                    alert('error');
                }
            });
        })

        $('#manual_add').on('click', function(e){
            /*var values = {};
            $.each($(this).parent('form').serializeArray(), function (i, field) {
                values[field.name] = field.value;
            });
            //Value Retrieval Function
            var getValue = function (valueName) {
                return values[valueName];
            };*/

            var $inputs = $(this).parent('form :input');

            // not sure if you wanted this, but I thought I'd add it.
            // get an associative array of just the values.
            var values = {};
            $inputs.each(function() {
                values[this.name] = $(this).val();
            });

            var values = $(this).parent('form.manual_clockin_form').serialize();

            console.log(values);
            //var clockin_user_id = getValue('clockin_user_id');
            $.ajax({
                type: "POST",
                url: "<?php echo url('users/manual_clock_in') ?>",
                data: values,
                success: function(result) {
                    //alert('Manual Entry Success');
                    //window.location.reload();
                },
                error: function(result) {
                    //console.log(data);
                    //alert('error');
                }
            });
        });


        // function
        function selectClockIn(select){
            alert(select.options[select.selectedIndex].text);
        }

        $('.clock_action_dropdown').on('change', function(e){
            var val = $(this).val();
            alert(val);
        });

        // Clocked In action
        $('.clockin_btn').on('click', function(e){
            //var values = $(this).parent('form').serializeArray();
            var values = {};
            $.each($(this).parent('form').serializeArray(), function (i, field) {
                values[field.name] = field.value;
            });
            //Value Retrieval Function
            var getValue = function (valueName) {
                return values[valueName];
            };
            var clockin_user_id = getValue('clockin_user_id');
            //console.log(clockin_user_id);

            e.preventDefault();
            //alert('Clock In this user');
            //
            
            //console.log(values);
            $.ajax({
                type: "POST",
                url: "<?php echo url('users/clock_in') ?>",
                data: values,
                /*data: {
                    user_id: $("input[name='clockin_user_id']").val(),
                    clock_in: $("input[name='current_time_in']").val(),
                    status: $("input[name='clockin_status']").val()
                },*/
                success: function(result) {
                    //alert('User has Clocked In');
                    //updateClockIn();
                    window.location.reload();
                    //console.log('okay');
                    //console.log(this);
                    //var last_login = result['current_time_in'];
                    //$(this).find('#last_login').append(last_login);
                },
                error: function(result) {
                    //console.log(data);
                    alert('error');
                }
            });
            
        })

        // Clocked Out action
        $('.clockout_btn').on('click', function(e){
            //var values = $(this).parent('form').serializeArray();
            var values = {};
            $.each($(this).parent('form').serializeArray(), function (i, field) {
                values[field.name] = field.value;
            });
            //Value Retrieval Function
            var getValue = function (valueName) {
                return values[valueName];
            };
            var clockin_user_id = getValue('clockin_user_id');
            //console.log(clockin_user_id);

            e.preventDefault();
            alert('Are you sure you want to Clock Out?');
            //
            
            //console.log(values);
            $.ajax({
                type: "POST",
                url: "<?php echo url('users/clock_out') ?>",
                data: values,
                /*data: {
                    user_id: $("input[name='clockin_user_id']").val(),
                    clock_in: $("input[name='current_time_in']").val(),
                    status: $("input[name='clockin_status']").val()
                },*/
                success: function(result) {
                    //alert('User has Clocked In');
                    //updateClockIn();
                    window.location.reload();
                    //console.log('okay');
                    //console.log(this);
                    //var last_login = result['current_time_in'];
                    //$(this).find('#last_login').append(last_login);
                },
                error: function(result) {
                    //console.log(data);
                    alert('error');
                }
            });
        })

        // Lunched In action
        $('.lunchin_btn').on('click', function(e){
            //var values = $(this).parent('form').serializeArray();
            var values = {};
            $.each($(this).parent('form').serializeArray(), function (i, field) {
                values[field.name] = field.value;
            });
            //Value Retrieval Function
            var getValue = function (valueName) {
                return values[valueName];
            };
            var clockin_user_id = getValue('clockin_user_id');
            //console.log(clockin_user_id);

            e.preventDefault();
            //alert('Clock In this user');
            //
            
            //console.log(values);
            $.ajax({
                type: "POST",
                url: "<?php echo url('users/lunch_in') ?>",
                data: values,
                /*data: {
                    user_id: $("input[name='clockin_user_id']").val(),
                    clock_in: $("input[name='current_time_in']").val(),
                    status: $("input[name='clockin_status']").val()
                },*/
                success: function(result) {
                    //alert('User has Lunch In');
                    //updateClockIn();
                    window.location.reload();
                    //console.log('okay');
                    //console.log(this);
                    //var last_login = result['current_time_in'];
                    //$(this).find('#last_login').append(last_login);
                },
                error: function(result) {
                    //console.log(data);
                    alert('error');
                }
            });
        })

        // Lunched Out action
        $('.lunchout_btn').on('click', function(e){
            //var values = $(this).parent('form').serializeArray();
            var values = {};
            $.each($(this).parent('form').serializeArray(), function (i, field) {
                values[field.name] = field.value;
            });
            //Value Retrieval Function
            var getValue = function (valueName) {
                return values[valueName];
            };
            var clockin_user_id = getValue('clockin_user_id');
            //console.log(clockin_user_id);

            e.preventDefault();
            alert('Are you sure you want to Lunch Out?');
            //
            
            //console.log(values);
            $.ajax({
                type: "POST",
                url: "<?php echo url('users/lunch_out') ?>",
                data: values,
                /*data: {
                    user_id: $("input[name='clockin_user_id']").val(),
                    clock_in: $("input[name='current_time_in']").val(),
                    status: $("input[name='clockin_status']").val()
                },*/
                success: function(result) {
                    //alert('User has Lunched Out');
                    //updateClockIn();
                    window.location.reload();
                    //console.log('okay');
                    //console.log(this);
                    //var last_login = result['current_time_in'];
                    //$(this).find('#last_login').append(last_login);
                },
                error: function(result) {
                    //console.log(data);
                    alert('error');
                }
            });
        })

        // Break In action
        $('.breakin_btn').on('click', function(e){
            //var values = $(this).parent('form').serializeArray();
            var values = {};
            $.each($(this).parent('form').serializeArray(), function (i, field) {
                values[field.name] = field.value;
            });
            //Value Retrieval Function
            var getValue = function (valueName) {
                return values[valueName];
            };
            var clockin_user_id = getValue('clockin_user_id');
            //console.log(clockin_user_id);

            e.preventDefault();
            //alert('Are you sure you want to Lunch Out?');
            //
            
            //console.log(values);
            $.ajax({
                type: "POST",
                url: "<?php echo url('users/break_in') ?>",
                data: values,
                /*data: {
                    user_id: $("input[name='clockin_user_id']").val(),
                    clock_in: $("input[name='current_time_in']").val(),
                    status: $("input[name='clockin_status']").val()
                },*/
                success: function(result) {
                    //alert('User has Break In');
                    //updateClockIn();
                    window.location.reload();
                    //console.log('okay');
                    //console.log(this);
                    //var last_login = result['current_time_in'];
                    //$(this).find('#last_login').append(last_login);
                },
                error: function(result) {
                    //console.log(data);
                    alert('error');
                }
            });
        });

        // Break Out action
        $('.breakout_btn').on('click', function(e){
            //var values = $(this).parent('form').serializeArray();
            var values = {};
            $.each($(this).parent('form').serializeArray(), function (i, field) {
                values[field.name] = field.value;
            });
            //Value Retrieval Function
            var getValue = function (valueName) {
                return values[valueName];
            };
            var clockin_user_id = getValue('clockin_user_id');
            //console.log(clockin_user_id);

            e.preventDefault();
            alert('Are you sure you want to Break Out?');
            //
            
            //console.log(values);
            $.ajax({
                type: "POST",
                url: "<?php echo url('users/break_out') ?>",
                data: values,
                /*data: {
                    user_id: $("input[name='clockin_user_id']").val(),
                    clock_in: $("input[name='current_time_in']").val(),
                    status: $("input[name='clockin_status']").val()
                },*/
                success: function(result) {
                    //alert('User has Break Out');
                    //updateClockIn();
                    window.location.reload();
                    //console.log('okay');
                    //console.log(this);
                    //var last_login = result['current_time_in'];
                    //$(this).find('#last_login').append(last_login);
                },
                error: function(result) {
                    //console.log(data);
                    alert('error');
                }
            });
        });

    });

    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));


    elems.forEach(function (html) {

        var switchery = new Switchery(html, {size: 'small'});

    });


    window.updateUserStatus = (id, status) => {

        $.get('<?php echo url('users/change_status') ?>/' + id, {

            status: status

        }, (data, status) => {

            if (data == 'done') {

                // code

            } else {

                alert('Unable to change Status ! Try Again');

            }

        })

    }

    window.updateClockIn = (id, clockIn) => {
        console.log(clockIn);
        $.get('<?php echo url('users/update_clockin') ?>/' + id, {

            clock_in_from: clockIn

        }, (data, clockIn) => {


            if (data == 'done') {

                // code

            } else {

                alert('Clock In Unsuccessful ! Try Again');

            }

        })

    }


</script>