<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
    /*Tabs*/
    .tab-pane{
        margin-top: 20px;
    }
    .nav-item .active{
        border-bottom: 3px solid #498002!important;
        background-color: transparent!important;
        font-weight: bold;
    }
    .nav-tabs .nav-link{
        border: 0;
    }

  .trac360_main_sections {
    min-height: 400px;  /* The height is 400 pixels */
    width: 100%;  /* The width is the width of the web page */
  }

</style>
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
                            <li class="breadcrumb-item active">Track Employees Location</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">

                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body" style="padding: 0">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#trackMap">Map</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#trackPlaces">Add Places</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#trackSettings">Settings</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane container active" id="trackMap">
                                  <div class="row pt-2 pb-5">
                                    <div class="col-md-4 trac360_main_sections">
                                      <div class="card p-0 ToFit">
                                        <div class="card-header pl-1 pr-1">
                                          <div class="row">
                                            <div class="col-md-6">
                                              <h5 class="m-0" id="cur_tab_title" style="padding-left: 10px">People</h5> 
                                            </div> 
                                          </div>
                                        </div>
                                        <div class="card-body pt-0 pb-0 pl-1 pr-1" style="overflow: auto">
                                          <div class="tab-content">
                                            <div class="tab-pane container pl-0 pr-0 active" diventry="people_entry" title="People" id="trac360_groups_people" prev_tab="">
                                               
                                              <?php //print_r($categories);
                                              foreach ($categories as $categories) {   ?>
                                              <div class="card mb-0 p-1" id="trac360_card_1">
                                                <div class="card-header">
                                                  <a class="card-link collapsed trac360_card_table" data-catid="<?php echo $categories['id'] ?>" data-toggle="collapse" href="#trac360_card_table_<?php echo $categories['id'] ?>" aria-expanded="false">
                                                    <i class="fa fa-plus mr-2">
                                                    </i>
                                                    <strong><?php echo $categories['name'] ?>
                                                    </strong>
                                                  </a>
                                                  <br>
                                                   
                                                </div>
                                                <div id="trac360_card_table_<?php echo $categories['id'] ?>" categoryid="<?php echo $categories['id'] ?>" class=" trac360_card_table collapse" data-parent="#trac360_groups_people" style="">
                                                  <div class="card-body p-1">
                                                    <div class="table-responsive-">
                                                      <table class="table table-bordered mb-0" id="trac360_table_1">
                                                        <thead>
                                                          <tr>
                                                            <th class="d-none">
                                                            </th>
                                                            <th style="width: 60%" class="font-weight-bold">Name
                                                            </th>
                                                            <th style="width: 20%" class="font-weight-bold text-center">Latitude
                                                            </th>
                                                            <th style="width: 20%" class="font-weight-bold text-center">Longitude
                                                            </th>
                                                          </tr>
                                                        </thead>
                                                        <?php foreach ($categories['user'] as $user) {  

                                                          if($user['last_tracked_location']!=""){
                                                            $last_tracked_location = explode(",", $user['last_tracked_location']);
                                                            $Latitude = $last_tracked_location[0];
                                                            $Longitude = $last_tracked_location[1];
                                                        ?>
                                                        <tbody>
                                                          <tr class="marker_<?php echo $user['user_id']; ?> trac360_row" gtype="user_trace" card="people" categoryid="<?php echo $categories['id'] ?>">
                                                            <td class="d-none"><?php echo $user['user_id']; ?>
                                                            </td>
                                                            <td style="width: 60%"><?php echo $user['name']; ?>
                                                            </td>
                                                            <td style="width: 20%" class="text-center"><?php echo $Latitude; ?>
                                                            </td>
                                                            <td style="width: 20%" class="text-center"><?php echo $Longitude; ?>
                                                            </td>
                                                          </tr>
                                                        </tbody>
                                                        <?php  }
                                                        } ?>
                                                      </table>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                              <?php } ?>
                                              
                                              
                                              
                                            </div>
                                          </div>
                                        </div>
                                        <div class="card-footer">

                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-8 trac360_main_sections">
                                      <?php echo $map ?>
                                    </div>
                                  </div>
                                    <?php /* <div id="googleMap" style="width:100%;height:400px;"></div> */ ?>
                                </div>
                                <div class="tab-pane container fade" id="trackPlaces">
                                </div>
                                <div class="tab-pane container fade" id="trackSettings">
                                </div>
                            </div>
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
<?php echo $map_js; /* ?>
<script>
    function myMap() {
        let mapProp= {
            center:new google.maps.LatLng(29.8134,-95.4641),
            zoom:5,
        };
        let map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBK803I2sEIkUtnUPJqmyClYQy5OVV7-E4&callback=myMap"></script> */ ?>
<script type="text/javascript">

  $(document).ready(function(){
      // trac360_card_table

              $(".trac360_card_table").on('shown.bs.collapse', function () {

                var cur_catid = $(this).attr('categoryid');

                  $.ajax({
                    type: 'GET',
                    url: base_url + "users/getcategoryUser/" + cur_catid,
                    success: function(data){
                      var users = jQuery.parseJSON(data);
                      //console.log(users);
                      $.each(users, function(index, user){

                          //console.log(index);
                          //console.log(user);

                         var user_geo = $('#trac360_table_'+ cur_catid +' > tbody').children('tr.marker_' + user.user_id);
                         var user_old_lat = user_geo.children('td:eq(2)').text();
                         var user_old_lng = user_geo.children('td:eq(3)').text();

                         new_records_checker = setInterval(function(){
                              $.ajax({
                                type: 'GET',
                                url: base_url + "users/getusergeoposition/" + cur_catid,
                                success: function(data){
                                  var result = jQuery.parseJSON(data);
                                  //if(result.length > 0){
                                  if(data){
                                    var new_lat = result.latitude;
                                    var new_lng = result.longitude;

                                    if((user_old_lat != new_lat) || (user_old_lng != new_lng)){
                                      user_geo.children('td:eq(2)').text(new_lat);
                                      user_geo.children('td:eq(3)').text(new_lng);

                                      tMarker.setPosition(new google.maps.LatLng(new_lat, new_lng));     
                                    }
                                  }
                                },
                                complete: function(jqXHR, textStatus){
                                  track_info.process = 'idle';
                                }
                              });
                         }, 1500);
                      });
                    } 
                  });


                 

                /*$.each(cur_group, function(index, member){
                  var cur_marker = member.marker;
                  var cur_lat = parseFloat(member.info.latitude);
                  var cur_lon = parseFloat(member.info.longitude);

                  cur_marker.setVisible(true);

                  member.track_info.visible = true;

                  if(cur_first){
                    map.setCenter({lat:cur_lat,lng:cur_lon});

                    $("#trac360_table_"+ cur_catid + " > tbody").children('tr:eq(0)').addClass('table-primary');

                    cur_first = !cur_first;
                  }
                });*/
              });

              $(".trac360_card_table").on('hidden.bs.collapse', function () {
                var cur_catid = $(this).attr('categoryid');
                 

                /*$.each(cur_group, function(index, member){
                  var cur_marker = member.marker;

                  cur_marker.setVisible(false);

                  member.track_info.visible = false;
                });  */

                $('tr.table-primary').removeClass('table-primary');  
              });

    });
</script>