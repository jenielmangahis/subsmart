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
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Manage Timesheets</li>
                        </ol>
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
                        <a href="<?php echo url('/users/timesheet')?>" class="banking-tab">Attendance</a>
                        <a href="<?php echo url('/timesheet/employee')?>" class="banking-tab">Employee</a>
                        <a href="<?php echo url('/timesheet/schedule')?>" class="banking-tab">Schedule</a>
                        <a href="<?php echo url('/timesheet/list')?>" class="banking-tab<?php echo ($this->uri->segment(1)=="list")?:'-active';?>"style="text-decoration: none">List</a>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title mb-5">Timesheet</h4>
                            <div class="row">
                                <div class="col-lg-12 table-responsive">
                                    <table id="dataTable1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th rowspan="2">Employee</th>
                                            <th rowspan="2">Status</th>
                                            <th>Monday</th>
                                            <th>Tuesday</th>
                                            <th>Wednesday</th>
                                            <th>Thursday</th>
                                            <th>Friday</th>
                                            <th>Saturday</th>
                                            <th>Sunday</th>
                                            <!-- <th rowspan="2">TOTAL</th> -->
                                        </tr>
                                        <tr>
                                            <?php foreach($date_this_week as $k=>$dtw):?>
                                                <?php echo '<th>'.$dtw.'</th>';?>
                                            <?php endforeach; ?>
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
                                                    //echo "Today is " . date("Y/m/d");
                                                ?>
                                                <tr class="timesheet_row">
                                                    <!-- Employee -->
                                                    <td class="employee_name">
                                                        <?php echo '<b>'.ucfirst($row->FName).' '.ucfirst($row->LName).'</b><br />'; ?>
                                                        <?php echo ucfirst($this->roles_model->getById($row->role)->title); ?>
                                                    </td>
                                                    <!-- Status -->
                                                    <td class="status" style="text-align: center;">
                                                        <?php foreach($clockin_arr as $k => $clockin ): ?>
                                                            <?php if($clockin->action == "Clock In"): ?>
                                                                <?php echo "In"; ?>
                                                            <?php elseif($clockin->action == "Clock Out"): ?>
                                                                <?php echo "Out"; ?>
                                                            <?php elseif($clockin->action == "Lunch In"): ?>
                                                                <?php echo "On Lunch"; ?>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <!-- Monday -->
                                                    <td class="monday">
                                                        <?php 
                                                            $data['date'] = date("Y-m-d",strtotime('monday this week'));
                                                            //echo $data['date'];
                                                            $total_clockin1 = $this->timesheet_model->getTotalClockinDay($data);
                                                            echo $total_clockin1.' hrs';
                                                        ?>
                                                    </td>
                                                    <!-- Tuesday -->
                                                    <td class="tuesday">
                                                        <?php 
                                                            $data['date'] = date("Y-m-d",strtotime('tuesday this week'));
                                                            //echo $data['date'];
                                                            $total_clockin2 = $this->timesheet_model->getTotalClockinDay($data);
                                                            echo $total_clockin2.' hrs';
                                                        ?>
                                                    </td>
                                                    <!-- Wednesday -->
                                                    <td class="wednesday">
                                                        <?php 
                                                            $data['date'] = date("Y-m-d",strtotime('wednesday this week'));
                                                            //echo $data['date'];
                                                            $total_clockin3 = $this->timesheet_model->getTotalClockinDay($data);
                                                            echo $total_clockin3.' hrs';
                                                        ?>
                                                    </td>
                                                    <!-- Thursday -->
                                                    <td class="thursday">
                                                        <?php 
                                                            $data['date'] = date("Y-m-d",strtotime('thursday this week'));
                                                            //echo $data['date'];
                                                            $total_clockin4 = $this->timesheet_model->getTotalClockinDay($data);
                                                            echo $total_clockin4.' hrs';
                                                        ?>
                                                    </td>
                                                    <!-- Friday -->
                                                    <td class="friday">
                                                        <?php 
                                                            $data['date'] = date("Y-m-d",strtotime('friday this week'));
                                                            //echo $data['date'];
                                                            $total_clockin5 = $this->timesheet_model->getTotalClockinDay($data);
                                                            echo $total_clockin5.' hrs';
                                                        ?>
                                                    </td>
                                                    <!-- Saturday -->
                                                    <td class="saturday">
                                                        <?php 
                                                            $data['date'] = date("Y-m-d",strtotime('saturday this week'));
                                                            //echo $data['date'];
                                                            $total_clockin6 = $this->timesheet_model->getTotalClockinDay($data);
                                                            echo $total_clockin6.' hrs';
                                                        ?>
                                                    </td>
                                                    <!-- Sunday -->
                                                    <td class="sunday">
                                                        <?php 
                                                            $data['date'] = date("Y-m-d",strtotime('sunday this week'));
                                                            //echo $data['date'];
                                                            $total_clockin7 = $this->timesheet_model->getTotalClockinDay($data);
                                                            echo $total_clockin7.' hrs';
                                                        ?>
                                                    </td>
                                                    <!-- TOTAL -->
                                                    <!-- <td class="total">
                                                        <?php //echo #total_hours?>
                                                    </td> -->

                                                </tr>
                                            <?php //endif; ?>
                                        <?php endforeach ?>
                                        </tbody>
                                    </table>
                                    <button class="btn btn-primary">Check In/Out</button>
                                    <button class="btn btn-primary">Adjust Entry</button>
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