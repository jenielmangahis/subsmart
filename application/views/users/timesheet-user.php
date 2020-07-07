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
        background-color: #d1d3d1;
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
                        <h1 class="page-title">Employees</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Manage Timesheets</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <?php //if (hasPermissions('users_add')): ?>
                                    <a href="<?php echo url('users/add_timesheet_entry') ?>" class="btn btn-primary"
                                       aria-expanded="false">
                                        <i class="mdi mdi-settings mr-2"></i> New Timesheet Entry
                                    </a>
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
                            <h4 class="mt-0 header-title mb-5">List of Employees</h4>
                            <div class="row">
                                <div class="col-lg-12 table-responsive">
                                    <table id="dataTable1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <!-- <th>Id</th>
                                            <th>Image</th> -->
                                            <th>Name</th>
                                            <?php /*<th>Email</th>
                                            <th>Password</th>
                                            <th>Role</th>*/ ?>
                                            <th>Last Login</th>
                                            <!-- <th>Status</th> -->
                                            <th>In</th>
                                            <th>Out</th>
                                            <th>Lunch In</th>
                                            <th>Lunch Out</th>
                                            <th>Comments/Schedule</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            //print date('H:i');
                                            date_default_timezone_set('UTC');
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
                                            <?php if (logged('id') === $row->id): ?>
                                                <?php //echo "<pre>";print_r($users);echo "</pre>";?>
                                                <?php
                                                    $data['user_id'] = $row->id;
                                                    // clockin array for each user
                                                    $clockin_arr = $this->timesheet_model->getClockIn($data);
                                                    $clockout_arr = $this->timesheet_model->getClockOut($data);
                                                    //echo "<pre>";print_r($clockin_arr);echo "</pre>";


                                                ?>
                                                <tr class="timesheet_row">

                                                    <td id="name">
                                                        <?php echo $row->FName.' '.$row->LName; ?>
                                                    </td>
                                                    
                                                    <td id="last_login">
                                                        <!-- last recorded clock in  -->
                                                        <?php 
                                                            if( !empty($clockin_arr) ){
                                                        ?>
                                                                <span class="last_login_now_<?php echo $row->id;?> clock_in" style="display: inline-block;">
                                                        <?php    
                                                            }
                                                            else{
                                                        ?>
                                                                <span class="last_login_now_<?php echo $row->id;?> clock_in" style="display: none;">
                                                                <?php echo $current_time_now; ?>
                                                        <?php
                                                            }
                                                        ?>
                                                        <!-- <span class="last_login_now_<?php //echo $row->id;?> clock_in" style="display: none;"> -->
                                                            <?php //echo $current_time_now; ?>
                                                            <?php 
                                                                // clock in for each user; temporarily specifying the first data in the array
                                                                if( !empty($clockin_arr) ){

                                                                    if( $clockin_arr[0]->action == 'Clock In' ){
                                                                        $user_clock_in = $clockin_arr[0]->timestamp;
                                                                        echo date('h:i a', strtotime($user_clock_in))." Manual Clock In";    
                                                                    }
                                                                    elseif( $clockin_arr[0]->action == 'Clock Out' ){
                                                                        $user_clock_in = $clockin_arr[0]->timestamp;
                                                                        echo date('h:i a', strtotime($user_clock_in))." Manual Clock Out";
                                                                    }
                                                                    elseif( $clockin_arr[0]->action == 'Lunch In' ){
                                                                        $user_clock_in = $clockin_arr[0]->timestamp;
                                                                        echo date('h:i a', strtotime($user_clock_in))." Manual Lunch In";
                                                                    }
                                                                    elseif( $clockin_arr[0]->action == 'Lunch Out' ){
                                                                        $user_clock_in = $clockin_arr[0]->timestamp;
                                                                        echo date('h:i a', strtotime($user_clock_in))." Manual Lunch Out";
                                                                    }
                                                                    elseif( $clockin_arr[0]->action == 'Break In' ){
                                                                        $user_clock_in = $clockin_arr[0]->timestamp;
                                                                        echo date('h:i a', strtotime($user_clock_in))." Manual Break In";
                                                                    }
                                                                    elseif( $clockin_arr[0]->action == 'Break Out' ){
                                                                        $user_clock_in = $clockin_arr[0]->timestamp;
                                                                        echo date('h:i a', strtotime($user_clock_in))." Manual Break Out";
                                                                    }
                                                                }
                                                                                                                                
                                                            ?>
                                                        </span>
                                                        <!-- EOL: last recorded clock in  -->
                                                        <?php //echo ($row->last_login != '0000-00-00 00:00:00') ? date(setting('date_format'), strtotime($row->last_login)) : 'No Record' ?>  
                                                    </td>

                                                    
                                                    <td class="clocked_in_<?php echo $row->id;?>" style="text-align: center;">
                                                        <?php //if (logged('id') !== $row->id): ?>
                                                            <!-- <input type="checkbox" class="js-switch"
                                                                   onchange="updateClockIn('<?php echo $row->id ?>', '<?php echo $current_time_now; ?>' )" <?php echo ($row->status) ? 'checked' : '' ?> /> -->
                                                            <?php if( !empty($clockin_arr) ):?>

                                                                <?php foreach($clockin_arr as $k => $clockin ): ?>
                                                                    <?php if( $clockin->action == 'Clock In' && $k == 0 && $clockin->timestamp != 0 ):?>
                                                                        <input type="radio" name="clocked_in_<?php echo $row->id;?>" checked="checked" /><br />
                                                                        <span class="clocked_in_<?php echo $row->id;?>"><?php echo date('h:i a', strtotime($clockin->timestamp)); ?></span><br />
                                                                    <?php elseif( $clockin->action == 'Clock In' && $clockin_arr[0]->action != 'Clock In' && $clockin->timestamp != 0 ):?>
                                                                        <input type="radio" name="clocked_in_<?php echo $row->id;?>" /><br />
                                                                        <span class="clocked_in_<?php echo $row->id;?>"><?php echo date('h:i a', strtotime($clockin->timestamp)); ?></span><br />
                                                                    <?php //else: ?>
                                                                        <!-- <input type="radio" name="clocked_in_<?php echo $row->id;?>" /><br />
                                                                        <span class="clocked_in_<?php echo $row->id;?>">00:00 </span> -->
                                                                    <?php endif;?>
                                                                <?php endforeach; ?>
                                                            <?php endif;?>
                                                            <input type="hidden" name="clocked_in" value="" />
                                                            
                                                        <?php //endif ?>
                                                    </td>

                                                    <td class="clocked_out_<?php echo $row->id;?>" style="text-align: center;">
                                                        <?php //if (logged('id') !== $row->id): ?>
                                                            <!-- <input type="checkbox" class="js-switch"
                                                                   onchange="updateUserStatus('<?php echo $row->id ?>', $(this).is(':checked') )" <?php echo ($row->status) ? 'checked' : '' ?> /> -->
                                                            <?php if( !empty($clockin_arr) ):?>
                                                                <?php foreach($clockin_arr as $k => $clockin ): ?>
                                                                <?php if( $clockin->action == 'Clock Out' && $k == 0 && $clockin->timestamp != 0 ):?>
                                                                    <input type="radio" name="clocked_out_<?php echo $row->id;?>" checked="checked" /><br />
                                                                    <span class="clocked_out_<?php echo $row->id;?>"><?php echo date('h:i a', strtotime($clockin->timestamp)); ?></span><br />
                                                                <?php elseif( $clockin->action == 'Clock Out' && $clockin_arr[0]->action != 'Clock Out' && $clockin->timestamp != 0 ):?>
                                                                    <input type="radio" name="clocked_out_<?php echo $row->id;?>" /><br />
                                                                    <span class="clocked_out_<?php echo $row->id;?>"><?php echo date('h:i a', strtotime($clockin->timestamp)); ?></span><br />
                                                                <?php //else: ?>
                                                                    <!-- <input type="radio" name="clocked_out_<?php echo $row->id;?>" /><br />
                                                                    <span class="clocked_out_<?php echo $row->id;?>">00:00 </span> -->
                                                                <?php endif;?>
                                                                <?php endforeach; ?>
                                                            <?php endif;?>
                                                            
                                                            <input type="hidden" name="clocked_out" value="" />
                                                            
                                                        <?php //endif ?>
                                                    </td>

                                                    <td class="lunched_in_<?php echo $row->id;?>" style="text-align: center;">
                                                        <?php //if (logged('id') !== $row->id): ?>
                                                            <!-- <input type="checkbox" class="js-switch"
                                                                   onchange="updateUserStatus('<?php echo $row->id ?>', $(this).is(':checked') )" <?php echo ($row->status) ? 'checked' : '' ?> /> -->
                                                            <?php if( !empty($clockin_arr) ):?>
                                                                <?php foreach($clockin_arr as $k => $clockin ): ?>
                                                                    <?php if( $clockin->action == 'Lunch In' && $k == 0 && $clockin->timestamp != 0 ):?>
                                                                        <input type="radio" name="lunched_in_<?php echo $row->id;?>" checked="checked" /><br />
                                                                        <span class="lunched_in_<?php echo $row->id;?>"><?php echo date('h:i a', strtotime($clockin->timestamp)); ?></span><br />
                                                                    <?php elseif( $clockin->action == 'Lunch In' && $clockin_arr[0]->action != 'Lunch In' && $clockin->timestamp != 0 ):?>
                                                                        <input type="radio" name="lunched_in_<?php echo $row->id;?>" /><br />
                                                                        <span class="lunched_in_<?php echo $row->id;?>"><?php echo date('h:i a', strtotime($clockin->timestamp)); ?></span><br />
                                                                    <?php //else: ?>
                                                                        <!-- <input type="radio" name="lunched_in_<?php echo $row->id;?>" /><br />
                                                                        <span class="lunched_in_<?php echo $row->id;?>">00:00 </span> -->
                                                                    <?php endif;?>
                                                                <?php endforeach;?>
                                                            <?php endif;?>
                                                            
                                                            <input type="hidden" name="lunched_in" value="" />
                                                            
                                                        <?php //endif ?>
                                                    </td>

                                                    <td class="lunched_out_<?php echo $row->id;?>" style="text-align: center;">
                                                        <?php //if (logged('id') !== $row->id): ?>
                                                            <!-- <input type="checkbox" class="js-switch"
                                                                   onchange="updateUserStatus('<?php echo $row->id ?>', $(this).is(':checked') )" <?php echo ($row->status) ? 'checked' : '' ?> /> -->
                                                            <?php if( !empty($clockin_arr) ):?>
                                                                <?php foreach($clockin_arr as $k => $clockin ): ?>
                                                                    <?php if( $clockin->action == 'Lunch Out' && $k == 0 && $clockin->timestamp != 0 ):?>
                                                                        <input type="radio" name="lunched_out_<?php echo $row->id;?>" checked="checked" /><br />
                                                                        <span class="lunched_out_<?php echo $row->id;?>"><?php echo date('h:i a', strtotime($clockin->timestamp)); ?></span><br />
                                                                    <?php elseif( $clockin->action == 'Lunch Out' && $clockin_arr[0]->action != 'Lunch Out' && $clockin->timestamp != 0 ):?>
                                                                        <input type="radio" name="lunched_out_<?php echo $row->id;?>" /><br />
                                                                        <span class="lunched_out_<?php echo $row->id;?>"><?php echo date('h:i a', strtotime($clockin->timestamp)); ?></span><br />
                                                                    <?php //else: ?>
                                                                        <!-- <input type="radio" name="lunched_out_<?php echo $row->id;?>" /><br />
                                                                        <span class="lunched_out_<?php echo $row->id;?>">00:00 </span> -->
                                                                    <?php endif;?>
                                                                <?php endforeach;?>
                                                            <?php endif;?>
                                                            
                                                            <input type="hidden" name="lunched_out" value="" />
                                                            
                                                        <?php //endif ?>
                                                    </td>

                                                    <!-- Add Breaked In here -->

                                                    <!-- Add Breaked Out here -->

                                                    <td>
                                                        <?php //if (logged('id') !== $row->id): ?>
                                                            <!-- <input type="checkbox" class="js-switch"
                                                                   onchange="updateUserStatus('<?php //echo $row->id ?>', $(this).is(':checked') )" <?php //echo ($row->status) ? 'checked' : '' ?> /> -->
                                                            <input type="text" name="comments" placeholder="Comments/Schedule" disabled="disabled" />
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
                                                                <!-- Lunch Out-->
                                                                <?php if( !empty($clockin_arr) ):?>
                                                                    <?php if( $clockin_arr[0]->action == 'Lunch Out' && $clockin_arr[0]->timestamp != 0 ):?>
                                                                        <a id="lunchout_btn" style="display: none;" href="#" class="btn btn-sm btn-primary lunchout_btn" title="Lunch Out" data-toggle="tooltip">
                                                                            <i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Lunch Out
                                                                        </a>
                                                                    <?php else: ?>
                                                                        <a id="lunchout_btn" style="display: ;" href="#" class="btn btn-sm btn-primary lunchout_btn" title="Lunch Out" data-toggle="tooltip">
                                                                            <i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Lunch Out
                                                                        </a>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                                <!-- Lunch In-->
                                                                <?php if( !empty($clockin_arr) ):?>
                                                                    <?php if( $clockin_arr[0]->action == 'Lunch In' && $clockin_arr[0]->timestamp != 0 ):?>
                                                                        <a id="lunchin_btn" style="display: none;" href="#" class="btn btn-sm btn-primary lunchin_btn" title="Lunch In" data-toggle="tooltip">
                                                                            <i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Lunch In
                                                                        </a>
                                                                    <?php else: ?>
                                                                        <a id="lunchin_btn" style="display:;" href="#" class="btn btn-sm btn-primary lunchin_btn" title="Lunch In" data-toggle="tooltip">
                                                                            <i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Lunch In
                                                                        </a>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
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
                                                                <?php if( !empty($clockin_arr) ):?>
                                                                    <?php if( $clockin_arr[0]->action == 'Break In' && $clockin_arr[0]->timestamp != 0 ):?>
                                                                        <a id="breakin_btn" style="display: none;" href="#" class="btn btn-sm btn-primary breakin_btn" title="Clock Out" data-toggle="tooltip">
                                                                            <i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Break In
                                                                        </a>
                                                                    <?php else: ?>
                                                                        <a id="breakin_btn" style="display: ;" href="#" class="btn btn-sm btn-primary breakin_btn" title="Clock Out" data-toggle="tooltip">
                                                                            <i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Break In
                                                                        </a>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>

                                                                <!-- Break Out-->
                                                                <?php if( !empty($clockin_arr) ):?>
                                                                    <?php if( $clockin_arr[0]->action == 'Break Out' && $clockin_arr[0]->timestamp != 0 ):?>
                                                                        <a id="breakout_btn" style="display: none;" href="#" class="btn btn-sm btn-primary breakout_btn" title="Clock Out" data-toggle="tooltip">
                                                                            <i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Break Out
                                                                        </a>
                                                                    <?php else: ?>
                                                                        <a id="breakout_btn" style="display: ;" href="#" class="btn btn-sm btn-primary breakout_btn" title="Clock Out" data-toggle="tooltip">
                                                                            <i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Break Out
                                                                        </a>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>

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
                                            <?php endif; ?>
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