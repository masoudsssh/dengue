<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>KBD | Latest dengue hotspot</title>
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px;
      }
      #map-canvas{
        width: 100%;
        height: 500px;
      }
    </style>
    <!-- Latest compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"> -->
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
    <script>
    // Create an object containing LatLng, population.
    var cityPoints = {};
    cityPoints[0] = {
      center: new google.maps.LatLng(3.858113, 101.999798),
      id: 0,
      addr: '<b>Nama Lokaliti Wabak :</b> APT SEMARAK BB <br/> <b>Tempoh Masa Wabak Berlaku :</b> 4',
      magnitude: 3000
    };
    cityPoints[1] = {
      center: new google.maps.LatLng(3.714352, 102.000073),
      id: 1, 
      addr: 'avenue1',
      magnitude: 2500
    };
    cityPoints[2] = {
      center: new google.maps.LatLng(3.552234, 101.943684),
      id: 2,
      addr: 'avenue2',
      magnitude: 5000
    }
    var cityCircle;
    var infoWindow = new google.maps.InfoWindow();  

    function initialize() {
      var mapOptions = {
        zoom: 9,
        center: new google.maps.LatLng(3.552234, 101.943684),
        mapTypeId: google.maps.MapTypeId.TERRAIN
      };

    var map = new google.maps.Map(document.getElementById('map-canvas'),
        mapOptions);

    for (i in cityPoints) {
     var magnitudeOptions = {
      strokeColor: '#FF0000',
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: '#FF0000',
      fillOpacity: 0.35,
      map: map,
      center: cityPoints[i].center,
      radius: cityPoints[i].magnitude,
      id:cityPoints[i].id,
      addr:cityPoints[i].addr,
      infoWindowIndex: i
    };
     cityCircle = new google.maps.Circle(magnitudeOptions);

      google.maps.event.addListener(cityCircle, 'click', (function(cityCircle, i) {
          return function() {
              infoWindow.setContent(cityPoints[i].addr);
              infoWindow.setPosition(cityCircle.getCenter());
              infoWindow.open(map);
          }
        })(cityCircle, i));
  }
  }
  google.maps.event.addDomListener(window, 'load', initialize);
  
  </script>
  </head>
  <body style="background-color: #f5f5f5;">
    <div class="well" style="margin-bottom: 0px; padding-left: 20px">
      <h3>Latest dengue hotspot</h3>
    </div>
    <div id="map-canvas"></div>
  </body>
</html>