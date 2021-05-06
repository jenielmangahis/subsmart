<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
include viewPath('includes/header');
function get_differenct_of_dates($date_start, $date_end)
{
    $start = new DateTime($date_start);
    $end =  new DateTime($date_end);
    $interval = $start->diff($end);

    $difference = ($interval->days * 24 * 60) * 60;
    $difference += ($interval->h * 60) * 60;
    $difference += ($interval->i) * 60;
    $difference += $interval->s;
    return ($difference / 60) / 60;
}
?>

<!-- page wrapper start -->
<!-- <div class="wrapper" role="wrapper"> -->
<!--<div wrapper__section>-->
<div id="main_body" class="container-fluid" style="background-color: #6241A4; margin-bottom:-20px;">
  <div class="row">
    <div class="col-md-4">
      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-8 page-title-box align-items-center">
          <h1 class="page-title text-white">Trac360</h1>
          <ol class="breadcrumb">
            <li class="breadcrumb-item active text-white">Search the globe online</li>
          </ol>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3 trac360_main_sections">
          <div class="btn-group-vertical" style="width: 100%;">
            <ul class="trac360-side-bar-menu">
              <li>
                <a href="<?= base_url() ?>trac360"
                  class="btn btn-primary  trac360_side_controls current-page" id=""><span class="fa fa-users fa-2x"
                    class="text-center"></span><br>Group</a>
              </li>
              <li>
                <a href="<?= base_url() ?>trac360/"
                  class="btn btn-primary  trac360_side_controls" id=""><span class="fa fa-commenting-o fa-2x"
                    class="text-center"></span><br>Messages</a>
              </li>
              <li>
                <a href="<?= base_url() ?>trac360/places"
                  class="btn btn-primary  trac360_side_controls" id=""><span class="fa fa-map-marker fa-2x"
                    class="text-center"></span><br>Places</a>
              </li>
              <li><a href="<?= base_url() ?>trac360/"
                  class="btn btn-primary  trac360_side_controls" id=""><span class="fa fa-map fa-2x"
                    class="text-center"></span><br>History</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-9 overflow-auto trac360_main_sections" style="background-color: #fff;">
          <?php
          $active_html = "";
          $inactive_html = "";
          foreach ($user_locations as $user) {
              $exploded = explode(",", $user->last_tracked_location);
              if ($user->last_tracked_location == "") {
                  $profile_status = "inactive";
                  $onclick = "";
              } else {
                  $profile_status = "active";
                  $onclick = 'onclick="user_selected( ' . $exploded[0] . ', ' . $exploded[1] . ',' . $user->user_id . ')"';
              }

              $image = base_url() . '/uploads/users/user-profile/' . $user->profile_img;
              if (!@getimagesize($image)) {
                  $image = base_url('uploads/users/default.png');
              }

              if ($user_id == $user->user_id) {
                  $current_view = "current_view";
                  $current_user_profile_img = $image;
                  $current_user_name = $user->FName . ' ' . $user->LName;
              } else {
                  $current_view = "";
              }
              $html = '<div id="sec-2-option-' . $user->user_id . '" class="sec-2-option ' . $current_view . '" ' . $onclick . '>';
              $html .= '<div class="row ">
                      <div class="col-md-4 profile">';
              $html .= '<center><img src="' . $image . '" alt="user" class="rounded-circle user-profile ' . $profile_status . '"></center>';
              $html .= '<p class="name"> ' . $user->FName . '</p>
            </div>
            <div class="col-md-8 details">
              <p id="last_tract_location_' . $user->user_id . '" class="last_tract_location"><span class="fa fa-map-marker" class="text-center"></span> ';
              if ($user->last_tracked_location_address == "") {
                  $last_loc =  "Lost connection";
              } else {
                  $last_loc = $user->last_tracked_location_address;
              }
              $html .= $last_loc;
              $html .= '<p><span class="fa fa-clock-o" class="text-center"></span> ';
              $hours_diff = get_differenct_of_dates($user->last_tracked_location_date, date('Y-m-d H:i:s'));
              if ($hours_diff >= 24) {
                  $time_display = round($hours_diff / 24, 0) . " Days ago";
              } elseif ($hours_diff >= 1) {
                  $time_display = round($hours_diff, 0) . " Hours ago";
              } else {
                  if (round($hours_diff * 60, 2) < 1) {
                      $time_display = " Few seconds ago";
                  } else {
                      $time_display = round($hours_diff * 60, 0) . " Minutes ago";
                  }
              }
              $html .= $time_display . '</p></div>
            </div>
          </div>';
              if ($profile_status == "inactive") {
                  $inactive_html .= $html;
              } else {
                  $html .= '<div style="display:none;"><div id="map_marker_' . $user->user_id . '" class="popup-map-marker"><img src="' . $image . '" class="popup-map-marker" title="' . $user->FName . ' ' . $user->LName . '" /></div></div>';
                  $active_html .= $html;
              }
          }
          echo $active_html . "" . $inactive_html;
          ?>

          <div class="people-informaton-btn">
            <img src="<?=base_url()?>" />
            </divs>
          </div>
        </div>

      </div>
    </div>
    <div class="col-md-8 map-section">
      <div id="map-loader">
        <center>
          <img
            src="<?=base_url("assets/img/trac360/loader.gif")?>" />
        </center>
        <h1 class="page-title">Initializing...</h1>
      </div>
      <div id="map-holder" style="display:none;">
        <div id="map"></div>
      </div>
    </div>
  </div>
</div>


<!--</div>-->
<!-- end container-fluid -->
<!-- </div> -->
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
  var user_id = <?= $user_id ?> ;
  var company_id = <?= $company_id ?> ;

  var map;
  var markers = [];
  var current_user_latitude;
  var current_user_longitude;
  var popup;
  var current_user_profile_img = "<?= $current_user_profile_img ?>";
  var current_user_name = "<?= $current_user_name ?>";

  current_user_getLocation();

  function initMap() {
    set_initmap();
  }

  function set_initmap() {
    $("#map-loader").hide();
    $("#map-holder").show();
    map = new google.maps.Map(document.getElementById("map"), {
      center: {
        lat: 37.0902,
        lng: 95.7129
      },
      zoom: 2,
    });

    <?php
        foreach ($user_locations as $user) {
            if ($user->last_tracked_location != "") {
                $exploded = explode(",", $user->last_tracked_location);
                echo 'set_popup("map_marker_'.$user->user_id.'",'.$exploded[0].','.$exploded[1].');';
          
                if ($user->user_id == $user_id) {
                    echo 'setMapCenter('.$exploded[0].','.$exploded[1].');';
                }
            }
        }
        ?>

  }


  function current_user_getLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(current_user_showPosition);
    } else {
      console.log("Geolocation is not supported by this browser.");
    }
  }

  function current_user_showPosition(position) {
    current_user_latitude = position.coords.latitude;
    current_user_longitude = position.coords.longitude;

    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({
        latLng: new google.maps.LatLng(
          current_user_latitude,
          current_user_longitude
        ),
      },
      function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          if (results[0]) {
            var formattedAddress = "";
            var lat;
            var lng;
            if (results[0].formatted_address != null) {
              formattedAddress = results[0].formatted_address;
            }

            //debugger;

            var location = results[0].geometry.location;

            lat = location.lat;
            lng = location.lng;
            console.log(formattedAddress);
            $.ajax({
              url: baseURL + "/trac360/current_user_update_last_tracked_location",
              type: "POST",
              dataType: "json",
              data: {
                user_id: user_id,
                company_id: company_id,
                lat: current_user_latitude,
                lng: current_user_longitude,
                formatted_address: formattedAddress,
              },
              success: function(data) {},
            });

            $("#last_tract_location_" + user_id).html(
              `<span class="fa fa-map-marker" class="text-center"></span> ` +
              formattedAddress +
              ""
            );
            $("#sec-2-option-" + user_id).attr("onclick", "user_selected( " + current_user_latitude + "," +
              current_user_longitude + "," + user_id + ")")
            var marker_parent = $("#map_marker_" + user_id).parent().parent();
            set_popup(("map_marker_" + user_id), current_user_latitude, current_user_longitude);
            marker_parent.remove();
            setMapCenter(current_user_latitude, current_user_longitude);


          }
        }
      }
    );
  }
  //remove

  function set_popup(selector, lat, lng) {

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

    popup = new Popup(
      new google.maps.LatLng(lat, lng),
      document.getElementById(selector)
    );
    popup.setMap(map);

  }
  $(document).ready(function() {
    <?php
    foreach ($user_locations as $user) {
        if ($user->last_tracked_location != "" && $user->user_id != $user_id) {
            $exploded = explode(",", $user->last_tracked_location);
            echo "getLatLongDetail(new google.maps.LatLng(" . $exploded[0] . ", " . $exploded[1] . ")," .  $user->user_id . ");";
        }
    }
    ?>
  });
</script>
<script
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg27wLl6BoSPmchyTRgvWuGHQhUUHE5AU&callback=initMap&libraries=&v=weekly"
  async></script>
<script
  src="https://maps.googleapis.com/maps/api/geocode/json?address=Winnetka&key=AIzaSyBg27wLl6BoSPmchyTRgvWuGHQhUUHE5AU">
</script>