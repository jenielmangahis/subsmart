<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
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
        height: 100%;
        padding: 0;
        margin-bottom: 10px;
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
        font-size: 14px;
        /*font-weight: bold;*/
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

    .page-title {
      font-family: Sarabun, sans-serif !important;
      font-size: 1.75rem !important;
      font-weight: 600 !important;
    }
    .left {
      float: left;
    }
    .p-40 {
        padding-left: 25px !important;
        padding-top: 55px !important;
    }
    .card.p-20 {
        padding-top: 25px !important;
    }
    .col.col-4.pd-17.left.alert.alert-warning.mt-0.mb-2 {
        position: relative;
        left: 13px;
    }
    .fr-right {
      float: right;
      justify-content: flex-end;
    }
    .p-20 {
      padding-top: 25px !important;
      padding-bottom: 25px !important;
      padding-right: 20px !important;
      padding-left: 20px !important;
    }
    .pd-17 {
      position: relative;
      left: 17px;
    }
    @media only screen and (max-width: 600px) {
      .p-40 {
        padding-top: 0px !important;
      }
      .pr-b10 {
        position: relative;
        bottom: 0px;
      }
    }
    .table-responsive {
        overflow-x:hidden;
    }
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/employee'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">

                <div class="row align-items-center" style="display:none;">
                    <div class="col-sm-6">
                        <h1 class="page-title">Notification</h1>
                    </div>
                    <div class="col-sm-6">
                    </div>
                </div>
            </div>
            <!-- end row -->
            <input type="hidden" id="employeeTotal" value="<?php echo  $total_users;?>">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                      <div class="col-sm-12">
                          <h3 class="page-title left">Notification</h3>
                      </div>
                      <!--<div class="pl-4 pr-4 row">
                        <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span>
                        </div>
                      </div>-->
                      <div class="row" style="padding: 10px 33px 20px 33px;">
                          <div class="col-md-12 banking-tab-container">
                              <a href="<?php echo url('/timesheet/attendance')?>" class="banking-tab">Attendance</a>
                              <?php if ($this->session->userdata('logged')['role'] < 5):?>
                                  <a href="<?php echo url('/timesheet/notification')?>"  class="banking-tab<?php echo ($this->uri->segment(1)=="notification")?:'-active';?>" style="text-decoration: none">Notification</a>
                                  <a href="<?php echo url('/timesheet/employee')?>" class="banking-tab">Employee</a>
                                  <a href="<?php echo url('/timesheet/schedule')?>" class="banking-tab">Schedule</a>
                                  <a href="<?php echo url('/timesheet/list')?>" class="banking-tab">List</a>
                                  <a href="<?php echo url('/timesheet/settings')?>" class="banking-tab">Settings</a>
                              <?php endif; ?>
                          </div>
                      </div>

                        <div class="card-body">
                            <div class="today-date">
                               <center> <h6><i class="fa fa-calendar-alt"></i> Today: <span style="color: grey"><?php echo date('M d, Y')." ".date_default_timezone_get();?></span></h6></center>
                            </div>
                            <?php if ($this->session->userdata('logged')['role'] < 5):?>

                                <div class="row">
                                    <div class="col-lg-12 table-responsive">
                                    <table id="ts-notification" class="table table-hover table-to-list">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Employee Name</th>
                                                    <th>Clock In Out</th>
                                                    <th>Status</th>
                                                    <th><input type="checkbox" id="checkAl"> Select All
                                                        <button class="btn btn-primary btn-md"
                                                        id="btn_delete"><i class="fa fa-trash"></i></button>
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody id="notifytd">
                                            <?php  
                                            $i=0; 
                                            foreach ($notification as $cnt => $notify){
                                            if($notify->title == 'Clock In'){$color='green';}else{$color='red';}
                                            ?>
                                        <tr id="<?php echo $notify->id; ?>">
                                        <td class="tbl-id-number"><?php echo ++$i; ?></td>
                                        <td>
                                            <center>
                                                <span class="tbl-employee-name"><?php echo $notify->FName; ?></span> 
                                                <span class="tbl-employee-name"><?php echo $notify->LName; ?></span>
                                            </center>
                                        </td>
                                        <td>
                                        <center>
                                        <i class="fa fa-circle" aria-hidden="true" style="color:<?php echo $color; ?>"></i>&nbsp; <?php echo $notify->content; ?>
                                        </center>
                                        </td>
                                        <td class="tbl-status">
                                            <center>
                                                <a href="<?php echo site_url(); ?>'timesheet/attendance" 
                                                id="notificationDP" 
                                                data-id="<?php echo $notify->id; ?>" title="" data-toggle="tooltip" 
                                                data-original-title="Notification Not Viewed ">
                                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                </a>
                                            </center>
                                        </td>
                                        <td>
                                        <center><input type="checkbox" id="checkItem" name="check[]" 
                                        value="<?php echo $notify->id; ?>">
                                        </center>
                                        </td>

                                    </tr>
                                    <?php } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <?php endif;?>
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
$("#checkAl").click(function () {
    $('input:checkbox').not(this).prop('checked', this.checked);
});
    //DataTable Table Attendance
    $('#ts-notification').DataTable({
        "sort": false
    });
$(document).ready(function(){
 
 $('#btn_delete').click(function(){
  
  if(confirm("Are you sure you want to delete this?"))
  {
   var id = []; 
   
   $(':checkbox:checked').each(function(i){ 
    //if(i != 0){
    id[i] = $(this).val(); //alert(id[i]);
    //}
   });

   if(id.length === 0) //tell you if the array is empty
   {
    alert("Please Select atleast one checkbox");
   }
   else
   { 
    $.ajax({
    type:"POST",
    async: true,
    cache: false,
    url: base_url + 'timesheet/removeNotification',
    data:{notificationid:id},
     success:function()
     {

      for(var i=0; i<id.length; i++)
      {
       $('tr#'+id[i]+'').css('background-color', '#ccc');
       $('tr#'+id[i]+'').fadeOut('slow');
      }
      //location.reload();
     }
     
    });
   }
   
  }
  else
  {
   return false;
  }
 });
 
});

    /*function notificationTbl() {
        $.ajax({
            type: "GET",
            url: "/timesheet/getNotificationTbl",
            async: true,
            cache: false,
            timeout: 10000,
            success: function (data) {
                //var obj = JSON.parse(data);
                $('#notifytd').html(data);
                setTimeout(notificationTbl,2000);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                addmsg("error", textStatus + " (" + errorThrown + ")");
                setTimeout(notificationTbl,15000);
            }
        });
    };

    $(document).ready(function () {
        var TimeStamp = null;
        notificationTbl();
    });*/

</script>
