<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
    /* Set the size of the div element that contains the map */
   #map {
     height: 50vh;  /* The height is 400 pixels */
     width: 100%;  /* The width is the width of the web page */
    }

 </style>

<!-- page wrapper start -->
<!-- <div class="wrapper" role="wrapper"> -->
   <!--<div wrapper__section>-->
   <div class="container-fluid" style="margin-top: 7rem">     
      <div class="row">
         <div class="col-md-12">
            <div class="page-title-box">
               <div class="row align-items-center">
                  <div class="col-sm-6">
                     <h1 class="page-title">Trac360</h1>
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Search the globe online</li>
                     </ol>
                  </div>
                  <div class="col-sm-6">
                     
                  </div>
               </div>
            </div>
         </div>
      </div>               
      <div class="row">
        <div class="col-md-5">
          <div class="table-responsive">
            <table class="table table-bordered bg-white" id="table_users_positions">
              <thead>
                <th class="d-none"></th>
                <th class="font-weight-bold" style="width: 60%">User</th>
                <th class="font-weight-bold text-center" style="width: 20%">Latitude</th>
                <th class="font-weight-bold text-center" style="width: 20%">Longitude</th>
              </thead>
              <tbody>
                <?php foreach ($users_geo as $user_geo) { ?>
                  <tr>
                    <td class="d-none"><?php echo $user_geo->user_id; ?></td>
                    <td><?php echo $user_geo->FName . ' ' . $user_geo->LName; ?></td>
                    <td class="text-center"><?php echo $user_geo->latitude; ?></td>
                    <td class="text-center"><?php echo $user_geo->longitude; ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-7">
          <?php echo $map ?>
        </div>
         <!-- end row -->           
      </div>
   </div>
   <!--</div>-->
   <!-- end container-fluid -->
<!-- </div> -->

<!-- page wrapper end -->

<?php include viewPath('includes/footer'); ?>
<?php echo $map_js; ?>
<script>
  var vTLat = 49.152011;
  var vTLon = -123.157000;
  var vT = setInterval(function(){
    vTLat += .000500;
    marker_2.setPosition(new google.maps.LatLng(vTLat, vTLon));
  }, 2000);
</script>