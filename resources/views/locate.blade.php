<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta name = "viewport"content = "initial-scale = 1.0, user-scalable = no">
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
  /* Optional: Makes the sample page fill the window. */
  html, body {
    height: 100%;
    margin: 0;
    padding: 0;
  }

  </style>
  <!--구매자일 때-->
  @if(auth()->guard('seller')->user())
  @foreach ($store_address as $address)

  <!--주소를 검색하는 부분을 숨겨놨음-->
  <div id="floating-panel">
    <input id="address" type="hidden" value="{{$address->a_address}}">
  </div>
  <div id="map"></div>
  @endforeach

  <!--판매자일 때-->
  @elseif (auth()->guard('customer')->user())
  @foreach ($customer_address as $address)
  <div id="floating-panel">
    <input id="address" type="hidden" value="{{$address->a_address}}">
  </div>
  <div id="map"></div>
  @endforeach
  @endif

  @foreach ($store_address as $address)
  <input id="store_address" type="hidden" value="{{$address->a_address}}">
  @endforeach

  <!--여기서부터 맵이 생깁니다.-->
  <script>
  var store_marker = new Array();
  var store_address = $("#store_address").value;
  console.log(store_address);


  $(document).ready(function() {
    for(i=0; i<store_marker.length; i++){
      store_marker.push(store_address);
    }
    console.log(store_marker);
  });

  //맵 가져오는 소스, 확대수치(zoom), 중심좌표(위도,경도)->(lat, lng);
  function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 15,
      //center: {lat: -34.397, lng: 150.644}
    });

    //전역변수사용
    var store_address = $("#store_address").val();


    var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
    var beachMarker = new google.maps.Marker({
      position: {lat: -33.890, lng: 151.274} ,
      map: map,
      icon: image
    });

    //주소 좌표로 변환하는 코드입니다.
    var geocoder = new google.maps.Geocoder();
    $(document).ready(function() { geocodeAddress(geocoder, map);});
  }

  //데이터베이스에서 로그인한 사람의 주소를 받아와서 지도에 마킹해주는 함수
  function geocodeAddress(geocoder, resultsMap) {
    //사용자 Address
    var address = $("#address").val();

    //사용자 아이콘
    //var user_Icon = new google.maps.MarkerImage("/img/flower_icon.png", null, null, null, new google.maps.Size(100,40));

    geocoder.geocode({'address': address}, function(results, status) {
      if (status === 'OK') {
        resultsMap.setCenter(results[0].geometry.location);
        // var faddr_lat = results[0].geometry.location.lat();//위도
        // var faddr_lng = results[0].geometry.location.lng();//경도
        // console.log(faddr_lat);
        // console.log(faddr_lng);

        var marker = new google.maps.Marker({
          map: resultsMap,
          // icon : user_Icon,
          position: results[0].geometry.location
        });
      }

      //주소가 안잡힐때 일어나는 일
      else {
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
