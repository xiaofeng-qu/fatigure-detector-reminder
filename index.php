<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Fatigue Detection</title>
        <!-- Bootstrap -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <!-- Customized style -->
        <link href="css/style.css" rel="stylesheet">
        
        <script src="js/websocket_client.js"></script>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script>
          // This example requires the Places library. Include the libraries=places
          // parameter when you first load the API. For example:
          // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

          var map;
          var infowindow;

          function initMap() {
            var pyrmont = {lat: 41.0814447, lng: -81.5190053};

            map = new google.maps.Map(document.getElementById('map'), {
              center: pyrmont,
              zoom: 12
            });

            infowindow = new google.maps.InfoWindow();
            var service = new google.maps.places.PlacesService(map);
            service.nearbySearch({
              location: pyrmont,
              radius: 1000,
              type: ['lodging']
            }, callback);
          }

          function callback(results, status) {
            if (status === google.maps.places.PlacesServiceStatus.OK) {
              for (var i = 0; i < results.length; i++) {
                createMarker(results[i]);
              }
            }
          }

          function createMarker(place) {
            var placeLoc = place.geometry.location;
            var marker = new google.maps.Marker({
              map: map,
              position: place.geometry.location
            });

            google.maps.event.addListener(marker, 'click', function() {
              infowindow.setContent(place.name);
              infowindow.open(map, this);
            });
          }
        </script>
  </head>
  <body onload="javascript:WebSocketSupport()">      
      <!--Jumbotron with sign up button-->
      <div class="jumbotron">
          <div id="ws_support"></div>
          <div id="wrapper">
              <h1>Fatigue Detection</h1>
              <div id="chatbox"></div>
          </div>
          <div style="width: 100vw; height: 480px; visibility: hidden;" id="map"></div>
          <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPccB5Dok4zOB12nYPGX51Zr533DgD1jc&libraries=places&callback=initMap" async defer></script>
      </div>
      <!--Footer-->
      <div class="footer">
          <div class="container">
              <p>Xiaofeng & Phong Copyright &copy; 2018-<?php echo date("Y")?>.</p>
          </div>
      </div>
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="js/bootstrap.min.js"></script>
  </body>
</html>