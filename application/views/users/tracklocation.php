<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header');
function get_differenct_of_dates($date_start, $date_end)
{
  $start = new DateTime($date_start);
  $end =  new DateTime($date_end);
  $interval = $start->diff($end);

  $difference = ($interval->days * 24 * 60) * 60;
  $difference += ($interval->h * 60) * 60;
  $difference += ($interval->i) * 60;
  $difference += $interval->s;
  return ($difference / 60) / 60; // hours
} 

?>

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
                            $image = base_url() . '/uploads/users/user-profile/' . $lasttracklocation_employee[$i]->profile_img;
                            if (!@getimagesize($image)) {
                            $image = base_url('uploads/users/default.png');
                        }
                        $exploded = explode(",", $lasttracklocation_employee[$i]->user_location);
                        if($lasttracklocation_employee[$i]->user_id == $current_user_id){
                            $current_user_location = $exploded;
                            $current_location_has_set = true;
                        }
                        if($lasttracklocation_employee[$i]->action == "Check in" || $lasttracklocation_employee[$i]->action == "Break out"){
                            $online_sttaus = "active";
                        }elseif($lasttracklocation_employee[$i]->action == "Break in" ){
                            $online_sttaus = "active-break";
                        }else{
                            $online_sttaus = "active-offline";
                        }
                        $time_deference = get_differenct_of_dates($lasttracklocation_employee[$i]->date_created, date("Y-m-d H:i:s"));
                        ?>
                    <div id="sec-2-option-<?=$lasttracklocation_employee[$i]->user_id ?>" class="sec-2-option <?=$lasttracklocation_employee[$i]->user_id==$current_user_id?"current_view":""?>" onclick="employee_selected(<?=$exploded[0]?>,<?=$exploded[1]?>,<?=$lasttracklocation_employee[$i]->user_id?>)"><div class="row ">
                        <div class="col-md-4 profile"><center><img src="<?=$image?>" alt="user" class="rounded-circle user-profile <?=$online_sttaus?>"></center><p class="name"> <?=$lasttracklocation_employee[$i]->FName?> </p>
                        </div>
                        <div class="col-md-8 details">
                        <p id="last_tract_location_14"><span class="fa fa-map-marker"></span> <?=($lasttracklocation_employee[$i]->user_location_address=="")?"Location Not Available.": $lasttracklocation_employee[$i]->user_location_address ?></p><p><span class="fa fa-clock-o"></span> 
                        <?php 
                        if($time_deference > 24){
                            echo round(($time_deference/24),0)
                            ." days ago";
                        }elseif($time_deference > 0.59){
                            echo round(($time_deference),0)
                            ." hours ago";
                        }else{
                            echo round(($time_deference*60),0)
                            ." minutes ago";
                        }
                        ?>
                        </p></div>
                        </div>
                    </div>
                    <div style="display:none;"><div id="map_marker_<?=$lasttracklocation_employee[$i]->user_id ?>" class="popup-map-marker"><img src="<?=$image ?>" class="popup-map-marker" title="<?=$lasttracklocation_employee[$i]->FName . ' ' . $lasttracklocation_employee[$i]->LName ?>" /></div></div>
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
    function myMap2() {
        let mapProp= {
            center:new google.maps.LatLng(29.8134,-95.4641),
            zoom:5,
        };
        let map = new google.maps.Map(document.getElementById("map"),mapProp);
    }
    
</script>
<script>
var map;
var popup, Popup;
    function initMap() {
        var lat =7.3087;
        var lng = 125.6841;
        <?php 
        if($current_location_has_set == true){
            echo "lat=".$current_user_location[0].";";
            echo "lng=".$current_user_location[1].";";
        }
        ?>
        let mapProp= {
            center:new google.maps.LatLng(lat,lng),
            zoom:5,
        };
         map = new google.maps.Map(document.getElementById("map"),mapProp);

    /**
     * A customized popup on the map.
     */
    class Popup extends google.maps.OverlayView {
      constructor(position, content) {
        super();
        this.position = position;
        content.classList.add("popup-bubble");
        // This zero-height div is positioned at the bottom of the bubble.
        const bubbleAnchor = document.createElement("div");
        bubbleAnchor.classList.add("popup-bubble-anchor");
        bubbleAnchor.appendChild(content);
        // This zero-height div is positioned at the bottom of the tip.
        this.containerDiv = document.createElement("div");
        this.containerDiv.classList.add("popup-container");
        this.containerDiv.appendChild(bubbleAnchor);
        // Optionally stop clicks, etc., from bubbling up to the map.
        Popup.preventMapHitsAndGesturesFrom(this.containerDiv);
      }
      /** Called when the popup is added to the map. */
      onAdd() {
        this.getPanes().floatPane.appendChild(this.containerDiv);
      }
      /** Called when the popup is removed from the map. */
      onRemove() {
        if (this.containerDiv.parentElement) {
          this.containerDiv.parentElement.removeChild(this.containerDiv);
        }
      }
      /** Called each frame when the popup needs to draw itself. */
      draw() {
        const divPosition = this.getProjection().fromLatLngToDivPixel(
          this.position
        );
        // Hide the popup when it is far out of view.
        const display =
          Math.abs(divPosition.x) < 4000 && Math.abs(divPosition.y) < 4000 ?
          "block" :
          "none";

        if (display === "block") {
          this.containerDiv.style.left = divPosition.x + "px";
          this.containerDiv.style.top = divPosition.y + "px";
        }

        if (this.containerDiv.style.display !== display) {
          this.containerDiv.style.display = display;
        }
      }
    }

    <?php
    for ($i=0;$i<count($lasttracklocation_employee);$i++) {
      
        $exploded = explode(",", $lasttracklocation_employee[$i]->user_location);
    ?>
        popup = new Popup(
          new google.maps.LatLng(<?= $exploded[0] ?>, <?= $exploded[1] ?>),
          document.getElementById("map_marker_<?= $lasttracklocation_employee[$i]->user_id ?>")
        );
        popup.setMap(map);
      
    <?php
      }
    ?>
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg27wLl6BoSPmchyTRgvWuGHQhUUHE5AU&callback=initMap&libraries=&v=weekly" async></script>
<script src="https://maps.googleapis.com/maps/api/geocode/json?address=Winnetka&key=AIzaSyBg27wLl6BoSPmchyTRgvWuGHQhUUHE5AU"></script>
