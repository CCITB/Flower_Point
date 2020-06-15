<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>꽃갈피</title>
<link rel="stylesheet" href="/css/header.css">
<link rel="stylesheet" href="/css/locate.css">
  </head>
  <body>
@include('lib.header')
        <div class="menu4"><!--탑헤더 밑-->
            <h3>내 주변 꽃집</h3>
            <hr align="left" class="one">
            </hr>
        </head>
        <body>
          <style>

             /* Set the size of the div element that contains the map */

            #map {

              height: 400px;  /* The height is 400 pixels */

              width: 100%;  /* The width is the width of the web page */

             }

          </style>


          <!--The div element for the map -->

          <div id="map"></div>
  <script src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyBNgEwwsTw1BLlld8mkOtzdN94EBExR7I0&libraries=places"></script>
          <script>
            // Note: This example requires that you consent to location sharing when
            // prompted by your browser. If you see the error "The Geolocation service
            // failed.", it means you probably did not give permission for the browser to
            // locate you.
            var map, infoWindow;
            function initMap() {
              map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -34.397, lng: 150.644},
                zoom: 17

              });
              infoWindow = new google.maps.InfoWindow;

              // Try HTML5 geolocation.
              if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                  var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                  };

                  infoWindow.setPosition(pos);
                  infoWindow.setContent('사용자위치.');
                  infoWindow.open(map);
                  map.setCenter(pos);
                }, function() {
                  handleLocationError(true, infoWindow, map.getCenter());
                });

              } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
              }
            }

            function handleLocationError(browserHasGeolocation, infoWindow, pos) {
              infoWindow.setPosition(pos);
              infoWindow.setContent(browserHasGeolocation ?
                                    'Error: The Geolocation service failed.' :
                                    'Error: Your browser doesn\'t support geolocation.');
              infoWindow.open(map);

            }
            var map;

                 // function initMap() {
                 //   // Create the map.
                 //   var pos = {lat: -33.866, lng: 151.196};
                 //   map = new google.maps.Map(document.getElementById('map'), {
                 //     center: pos,
                 //     zoom: 17
                 //   });
                 //
                 //   // Create the places service.
                 //   var service = new google.maps.places.PlacesService(map);
                 //   var getNextPage = null;
                 //   var moreButton = document.getElementById('more');
                 //   moreButton.onclick = function() {
                 //     moreButton.disabled = true;
                 //     if (getNextPage) getNextPage();
                 //   };
                 //
                 //   // Perform a nearby search.
                 //   service.nearbySearch(
                 //       {location: pos, radius: 500, type: ['store']},
                 //       function(results, status, pagination) {
                 //         if (status !== 'OK') return;
                 //
                 //         createMarkers(results);
                 //         moreButton.disabled = !pagination.hasNextPage;
                 //         getNextPage = pagination.hasNextPage && function() {
                 //           pagination.nextPage();
                 //         };
                 //       });
                 // }
                 //
                 // function createMarkers(places) {
                 //   var bounds = new google.maps.LatLngBounds();
                 //   var placesList = document.getElementById('places');
                 //
                 //   for (var i = 0, place; place = places[i]; i++) {
                 //     var image = {
                 //       url: place.icon,
                 //       size: new google.maps.Size(71, 71),
                 //       origin: new google.maps.Point(0, 0),
                 //       anchor: new google.maps.Point(17, 34),
                 //       scaledSize: new google.maps.Size(25, 25)
                 //     };
                 //
                 //     var marker = new google.maps.Marker({
                 //       map: map,
                 //       icon: image,
                 //       title: place.name,
                 //       position: place.geometry.location
                 //     });
                 //
                 //     var li = document.createElement('li');
                 //     li.textContent = place.name;
                 //     placesList.appendChild(li);
                 //
                 //     bounds.extend(place.geometry.location);
                 //   }
                 //   map.fitBounds(bounds);
                 // }




          </script>
          <script async defer
          src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNgEwwsTw1BLlld8mkOtzdN94EBExR7I0&callback=initMap">
          </script>

</body>
</html>
