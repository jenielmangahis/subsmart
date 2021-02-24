<?php if( $center_lng != '' && !empty($locations) ){ ?>
  <style>#dvMap {width: 100%;height: 100vh;}</style>
  <div id="dvMap"></div>
  <script>
  var markes = [];
  var count = 1;
  markes[0] = <?= json_encode($locations); ?>;
  console.log(markes);

  window.onload = function() {
    
  } // window.onload = function () 
  $(function(){
    var mapOptions = {
      center: new google.maps.LatLng(markes[0][1].lat, markes[0][1].lng),
      zoom: 15,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
    var infoWindow = new google.maps.InfoWindow();

    var latlngbounds = new google.maps.LatLngBounds();



    //Creating Markers


    var data = [];
    var myLatlng = [];
    var marker = [];
    //var lat_lng = new Array();
    var lat_lng = [];
    for (var i = 0; i < count; i++) {
      for (j = 0; j < markes[i].length; j++) {
        data[j] = markes[i][j];
        myLatlng[j] = new google.maps.LatLng(data[j].lat, data[j].lng);
        lat_lng.push(myLatlng[j]);
        //lat_lng[j]=myLatlng[j];
        marker[j] = new google.maps.Marker({
          position: myLatlng[j],
          map: map,
          title: data[j].title

        });


        latlngbounds.extend(marker[j].position);

        (
          function(marker, data) {
            google.maps.event.addListener(marker, "click", function(e) {
              infoWindow.setContent(data.description);
              infoWindow.open(map, marker);
            });
          }
        )(marker[j], data[j]);
      }
      map.setCenter(latlngbounds.getCenter());
      map.fitBounds(latlngbounds);
    }



    //Initialize the Path Array


    //Initialize the Direction Service
    //Set the Path Stroke Color
    var color = ['#F0280E', '#FF0000', '#FFFF00', '#00FF00', '#00FFFF', '#0000FF', '#000000', 'FFFFFF'];
    var src_des = [];
    var j = 0;
    for (i = 0; i < lat_lng.length; i++) {
      src_des[j] = [lat_lng[i], lat_lng[i + 1]];
      j += 1;
      i += 1;
    }
    for (var t = 0; t < src_des.length; t++) {
      //Intialize the Direction Service
      var service = new google.maps.DirectionsService();
      var directionsDisplay = new google.maps.DirectionsRenderer();

      var bounds = new google.maps.LatLngBounds();
      if ((t + 1) < lat_lng.length) {
        var src = src_des[t][0];
        var des = src_des[t][1];
        service.route({
            origin: src,
            destination: des,
            travelMode: google.maps.DirectionsTravelMode.DRIVING
          },
          (function(color) {
            return function(result, status) {
              if (status == google.maps.DirectionsStatus.OK) {
                // new path for the next result
                var path = new google.maps.MVCArray();
                //Set the Path Stroke Color
                // new polyline for the next result
                var poly = new google.maps.Polyline({
                  map: map,
                  strokeColor: color
                });
                poly.setPath(path);
                for (var k = 0, len = result.routes[0].overview_path.length; k < len; k++) {
                  path.push(result.routes[0].overview_path[k]);
                  bounds.extend(result.routes[0].overview_path[k]);
                  map.fitBounds(bounds);
                }
              } else alert("Directions Service failed:" + status);
            }
          }(color[t])))
      };
    }
  });
  google.maps.event.addDomListener(window, "load", initialize);
  </script>
<?php }else{ ?>
  <style>#map-canvas {width: 100%;height: 300px;}</style>
  <div id="map-canvas"></div>
  <script>
      function initMap() {
        var myLatLng = {lat: 1.523208409167528, lng: 103.67841453967287};

        // Create a map object and specify the DOM element for display.
        var map = new google.maps.Map(document.getElementById('map-canvas'), {
          center: myLatLng,
          // scrollwheel: false,
          zoom: 16
        });

        // Create a marker and set its position.
        var marker = new google.maps.Marker({
          map: map,
          position: myLatLng,
          title: ''
        });
      }
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASLBI1gI3Kx9K__jLuwr9xuQaBkymC4Jo&callback=initMap&sensor=false" async defer></script>
<?php } ?>
