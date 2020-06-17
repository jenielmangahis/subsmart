<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
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
                                            <th>Id</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <?php /*<th>Email</th>
                                            <th>Password</th>
                                            <th>Role</th>*/ ?>
                                            <th>Recorded Clock In/Clock Out</th>
                                            <th>Status</th>
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
                                                    <td width="50" class="text-center">
                                                        <?php 
                                                            /*$avatar = userProfile($row->id);
                                                            if ( !@getimagesize($avatar) ){
                                                                $avatar = base_url('uploads/users/default.png');
                                                            }*/
                                                        ?>
                                                        <!-- <img src="<?php //echo userProfile($row->id) ?>" width="40" height="40" alt="" class="img-avtar"> -->
                                                        <!-- <img src="<?php //echo $avatar; ?>" width="40" height="40" alt="" class="img-avtar"> -->
                                                        <img src="<?php echo base_url('uploads/users/default.png');?>" width="40" height="40" alt="Profile Picture" class="img-avatar" />
                                                    </td>
                                                    <td id="name">
                                                        <?php echo $row->FName.' '.$row->LName; ?>
                                                    </td>
                                                    <?php /*<td><?php //echo $row->email ?></td>
                                                    <td><?php //echo $row->password_plain ?></td>
                                                    <td><?php //echo ucfirst($this->roles_model->getById($row->role)->title) ?></td>*/ ?>
                                                    <td id="last_login">
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
                                                                    
                                                                }
                                                                                                                                
                                                            ?>
                                                        
                                                        </span>
                                                        
                                                        <?php //echo ($row->last_login != '0000-00-00 00:00:00') ? date(setting('date_format'), strtotime($row->last_login)) : 'No Record' ?>
                                                        <?php

                                                        ?>    
                                                    </td>
                                                    <td>
                                                        <?php if (logged('id') !== $row->id): ?>
                                                            <input type="checkbox" class="js-switch"
                                                                   onchange="updateUserStatus('<?php echo $row->id ?>', $(this).is(':checked') )" <?php echo ($row->status) ? 'checked' : '' ?> />
                                                        <?php endif ?>
                                                    </td>
                                                    <td>
                                                        <?php if (logged('id') !== $row->id): ?>
                                                            <input type="checkbox" class="js-switch"
                                                                   onchange="updateUserStatus('<?php echo $row->id ?>', $(this).is(':checked') )" <?php echo ($row->status) ? 'checked' : '' ?> />
                                                            <span>00:00PM </span>
                                                        <?php endif ?>
                                                    </td>
                                                    <td>
                                                        <?php if (logged('id') !== $row->id): ?>
                                                            <input type="checkbox" class="js-switch"
                                                                   onchange="updateUserStatus('<?php echo $row->id ?>', $(this).is(':checked') )" <?php echo ($row->status) ? 'checked' : '' ?> />
                                                            <span>00:00PM </span>
                                                        <?php endif ?>
                                                    </td>
                                                    <td>
                                                        <?php if (logged('id') !== $row->id): ?>
                                                            <input type="checkbox" class="js-switch"
                                                                   onchange="updateUserStatus('<?php echo $row->id ?>', $(this).is(':checked') )" <?php echo ($row->status) ? 'checked' : '' ?> />
                                                            <span>00:00PM </span>
                                                        <?php endif ?>
                                                    </td>
                                                    <td>
                                                        <?php if (logged('id') !== $row->id): ?>
                                                            <input type="checkbox" class="js-switch"
                                                                   onchange="updateUserStatus('<?php echo $row->id ?>', $(this).is(':checked') )" <?php echo ($row->status) ? 'checked' : '' ?> />
                                                            <span>00:00PM </span>
                                                        <?php endif ?>
                                                    </td>
                                                    <td>
                                                        <?php if (logged('id') !== $row->id): ?>
                                                            <!-- <input type="checkbox" class="js-switch"
                                                                   onchange="updateUserStatus('<?php //echo $row->id ?>', $(this).is(':checked') )" <?php //echo ($row->status) ? 'checked' : '' ?> /> -->
                                                            <input type="text" name="comments" placeholder="Comments">
                                                        <?php endif ?>
                                                    </td>
                                                    <td id="">
                                                        

                                                        <?php //if (hasPermissions('users_edit')): ?>
                                                            <form name="clockin_form" method="post">
                                                                <input type="hidden" name="current_time_in" value="<?php echo date('Y-m-d H:i'); ?>" />
                                                                <input type="hidden" name="clockin_user_id" value="<?php echo $row->id; ?>" />
                                                                <input type="hidden" name="clockin_company_id" value="<?php echo $users1->id; ?>" />
                                                                <input type="hidden" name="clockin_status" value="1" />
                                                                <input type="hidden" name="clockin_sess" value="<?php echo $clockin_sess; ?>" />
                                                                
                                                                

                                                                <?php if( !empty($clockin_arr) ):?>
                                                                    <?php if( $clockin_arr[0]->action == 'Clock In' && $clockin_arr[0]->timestamp != 0 ):?>
                                                                    <a id="clockin" style="display: none;" href="#"
                                                                       class="btn btn-sm btn-primary" title="Clock In"
                                                                       data-toggle="tooltip"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Clock In</a>
                                                                    <a id="clockout" style="display: inline-block;" href="#"
                                                                       class="btn btn-sm btn-danger" title="Clock Out"
                                                                       data-toggle="tooltip"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Clock Out</a>
                                                                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                                        Manual
                                                                    </button> -->
                                                                    <?php elseif( $clockin_arr[0]->action == 'Clock Out' && $clockin_arr[0]->timestamp != 0 ):?>
                                                                    <a id="clockin" style="" href="#"
                                                                   class="btn btn-sm btn-primary" title="Clock In"
                                                                   data-toggle="tooltip"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Clock In</a>
                                                                    <a id="clockout" style="display: none;" href="#"
                                                                   class="btn btn-sm btn-danger" title="Clock Out"
                                                                   data-toggle="tooltip"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Clock Out</a>
                                                                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                                    Manual
                                                                </button> -->
                                                                    <?php endif;?>
                                                                <?php else: ?>
                                                                    <a id="clockin" style="" href="#"
                                                                   class="btn btn-sm btn-primary" title="Clock In"
                                                                   data-toggle="tooltip"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Clock In</a>
                                                                    <a id="clockout" style="display: none;" href="#"
                                                                   class="btn btn-sm btn-danger" title="Clock Out"
                                                                   data-toggle="tooltip"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;Clock Out</a>
                                                                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                                    Manual
                                                                </button> -->
                                                                <?php endif;?>
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


</script>