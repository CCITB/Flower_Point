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
@if(auth()->guard('seller')->user())
@foreach ($store_address as $store_address)

  <!--The div element for the map -->
  <div id="floating-panel">
    <input id="address" type="hidden" value="{{$store_address->a_address}}">
    </div>
        <div id="map"></div>
  @endforeach
@elseif (auth()->guard('customer')->user())
  @foreach ($data1 as $customer_address)
    <div id="floating-panel">
      <input id="address" type="hidden" value="{{$customer_address->a_address}}">
      </div>
    <div id="map"></div>
  @endforeach
@endif

    <script>
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: {lat: -34.397, lng: 150.644}

        });
        var geocoder = new google.maps.Geocoder();
        $(document).ready(function() { geocodeAddress(geocoder, map);});
        // document.getElementById('submit').addEventListener('click', function() {
        //
        // });
      }

      function geocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: resultsMap,
              position: results[0].geometry.location
            });
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }

    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNgEwwsTw1BLlld8mkOtzdN94EBExR7I0&callback=initMap">
    </script>
</body>
</html>
