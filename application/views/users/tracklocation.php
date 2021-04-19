<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>

<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/employee'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid tracklocation">
            <div class="row" style="margin:0;">
                <div class="col-md-4 overflow-auto" style="margin-top:30px; padding:0; height:80vh">
                    <div class="col-sm-12">
                            <h3 class="page-title" style="margin-bottom:20px !important;"> Employees Last Aux Locations</h3>
                        
                    </div>
                    
                    <?php
                    
                    for($i =0;$i < count($lasttracklocation_employee);$i++){
                        ?><div id="sec-2-option-14" class="sec-2-option <?=$lasttracklocation_employee[$i]->user_id==$current_user_id?"current_view":""?>" onclick="user_selected( 8.045953500047293, 123.51302520681782,14)"><div class="row ">
                        <div class="col-md-4 profile"><center><img src="https://localhost/nsmartrac/uploads/users/default.png" alt="user" class="rounded-circle user-profile active"></center><p class="name"> <?=$lasttracklocation_employee[$i]->FName?> </p>
                        </div>
                        <div class="col-md-8 details">
                        <p id="last_tract_location_14"><span class="fa fa-map-marker"></span> <?=($lasttracklocation_employee[$i]->user_location_address=="")?"Location Not Available.": $lasttracklocation_employee[$i]->user_location_address ?></p><p><span class="fa fa-clock-o"></span> 58 Days ago</p></div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="col-md-8 map-section">
                    <div id="map">
                        
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
    function myMap() {
        let mapProp= {
            center:new google.maps.LatLng(29.8134,-95.4641),
            zoom:5,
        };
        let map = new google.maps.Map(document.getElementById("map"),mapProp);
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBK803I2sEIkUtnUPJqmyClYQy5OVV7-E4&callback=myMap"></script>
