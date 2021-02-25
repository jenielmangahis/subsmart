<style>
.page-title, .box-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
  padding-top: 5px;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.p-40 {
  padding-top: 40px !important;
}
.p-20 {
  padding-top: 25px !important;
  padding-bottom: 25px !important;
  padding-right: 20px !important;
  padding-left: 20px !important;
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
.dropdown .btn {
    padding: 6px 12px;
}
.dropdown .btn {
    padding: 6px 12px;
}
.btn-default {
    color: #363636;
    background: #fff;
    border: 1px solid #cccccc;
}
.btn {
    padding: 10px 25px;
    border: 1px solid transparent;
    border-radius: 2px;
    box-shadow: none;
    font-size: 16px;
    transition: none;
}
.btn-default {
    color: #333;
    background-color: #fff;
    border-color: #ccc;
}
.btn {
    display: inline-block;
    margin-bottom: 0;
    font-weight: 400;
    text-align: center;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    border: 1px solid transparent;
    white-space: nowrap;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    border-radius: 4px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

</style>
<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
    <!-- page wrapper start -->
    <div class="wrapper" role="wrapper">
<?php include viewPath('includes/sidebars/schedule'); ?>
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <form id="map-filter">
        <div class="container-fluid p-40">
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card p-20">
                        <div class="col-sm-12 pl-0 pr-0">
                            <h3 class="mt-0 page-title pb-0 mb-0">Bird's Eye View</h3>
                            <span style="margin-top:4px;margin-bottom: 8px;display: block;font-size: 14px;color: rgba(42, 49, 66, 0.7);">Manage Bird's Eye View</span>
                        </div>
                        <div class="pl-3 pr-3 mt-1 row">
                          <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                              <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Get a birds-eye view of your calendar events and jobs’ location scheduled for the day.  With this tool your be able to see your team location and better position them to maximize the current day.</span>
                          </div>
                        </div>
                        <div class="filter-container mb-3">
                            <input type="text" id="date-range-picker" class="form-control">                            
                            <select class="form-control">
                                <option value="all">All Statuses</option>
                                <option value="new">New</option>
                                <option value="scheduled">Scheduled</option>
                                <option value="started">Started</option>
                                <option value="paused">Paused</option>
                                <option value="completed">Completed</option>
                            </select>
                            <select class="form-control" name="user" id="filter-user">
                                <option value="">- Select Employee -</option>
                                <option value="all">All Employees</option>
                                <?php foreach($companyUsers as $u){ ?>
                                  <option value="<?= $u->id; ?>"><?= $u->FName . ' ' . $u->LName; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="map-container"></div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        </form>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
$(function(){
    $('#date-range-picker').daterangepicker({
        "timePicker": false
    }, function(start, end, label) {
      //console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
    });

    load_map_route();

    function load_map_route(){
        var msg = '<div class="alert alert-info" role="alert"><img style="display:inline-block;" src="'+base_url+'/assets/img/spinner.gif" /> Loading map...</div>';
        var url = base_url + '/workorder/_load_map_routes';

        $(".map-container").html(msg);
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: $("#map-filter").serialize(),
               success: function(o)
               {
                  $(".map-container").html(o);
               }
            });
        }, 1000);
    }

    $("#filter-user").change(function(){
      load_map_route();
    });
});
</script>
