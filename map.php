<!DOCTYPE html>
<html>
  <head>
    <title>nSmart</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
      function initMap() {
        var originalMapCenter = new google.maps.LatLng(-25.363882, 131.044922);
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: originalMapCenter
        });

        var infowindow = new google.maps.InfoWindow({
          content: 'Change the zoom level',
          position: originalMapCenter
        });
        infowindow.open(map);

        map.addListener('zoom_changed', function() {
          infowindow.setContent('Zoom: ' + map.getZoom());
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlMWhWMHlxQzuolWb2RrfUeb0JyhhPO9c&callback=initMap">
    </script>
  </body>
</html>