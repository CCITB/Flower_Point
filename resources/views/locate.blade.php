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
    width: 70%;  /* The width is the width of the web page */
    margin : auto 30px;
  }
  #map2 {
    height: 400px;  /* The height is 400 pixels */
    width: 70%;  /* The width is the width of the web page */
    margin : auto 30px;
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

  <!-- store address 정보 -->
  @foreach ($store_address as $address)
  <input class="array" id="address_store{{$address->st_no}} "type="hidden" value="{{$address->a_address}}">
  @endforeach

  @foreach ($store_address as $address)
  <input class="address_extra" id="a_extra{{$address->st_no}} "type="hidden" value="{{$address->a_extra}}">
  @endforeach

  @foreach ($store_address as $address)
  <input class="address_detail" id="a_detail{{$address->st_no}} "type="hidden" value="{{$address->a_detail}}">
  @endforeach

  <!--store의 정보-->
  @foreach ($store as $name)
  <input class="store_name" id="{{$name->st_no}} "type="hidden" value="{{$name->st_name}}">
  @endforeach

  @foreach ($store as $intro)
  <input class="store_intro" id="{{$intro->st_no}} "type="hidden" value="{{$intro->st_introduce}}">
  @endforeach


  <!--여기서부터 맵이 생깁니다.-->

  <script>
  var user;
  //맵 가져오는 소스, 확대수치(zoom), 중심좌표(위도,경도)->(lat, lng);
  function initMap() {
    //contentString에 들어갈 나머지 주소들
    var detail = $(".address_detail");
    var extra = $(".address_extra");
    var name = $(".store_name");
    var intro = $(".store_intro");

    var arr_detail = new Array();
    var arr_extra = new Array();
    var arr_name = new Array();
    var arr_intro = new Array();

    for(var a=0; a<detail.length; a++){
      arr_detail.push(detail[a].value);
    }
    for(var a=0; a<extra.length; a++){
      arr_extra.push(extra[a].value);
    }
    for(var a=0; a<name.length; a++){
      arr_name.push(name[a].value);
    }
    for(var a=0; a<intro.length; a++){
      arr_intro.push(intro[a].value);
    }

    var user_address = $("#address").val();

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 15,
    });

    // 위도경도 변환하는 코드입니다.
    var geocoder = new google.maps.Geocoder();

    // Create a <script> tag and set the USGS URL as the source.
    var script = document.createElement('script');
    // This example uses a local copy of the GeoJSON stored at
    // http://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/2.5_week.geojsonp
    script.src = 'https://developers.google.com/maps/documentation/javascript/examples/json/earthquake_GeoJSONP.js';
    document.getElementsByTagName('head')[0].appendChild(script);

    var contentString =
    '<div id="content">' + '<h1 id="firstHeading" class="firstHeading">arr_name[i]</h1>' +
    '<div id="bodyContent">' +
    "<p>오늘안에 하면 <b>유미원딜</b>갑니다. 경진이도 포기한 Google Map API 조지기 Start " +
    "</div>" +
    "</div>";

    //User(seller/custsomer) 주소
    geocoder.geocode( { 'address': user_address }, function(results, status) {
      if (status == 'OK') {
        map.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
          // position: latLng,
          position: results[0].geometry.location,
          map: map
        });
      }
    });

    //Store 주소
    window.eqfeed_callback = function(results) {

      var arr = new Array();
      //var address = $("#address").val();
      var array = $('.array');
      // arr.push(address);
      for(var j=0; j < array.length; j++){
        arr.push(array[j].value);
      }

      var div = new Array();
      for(var a=0; a<arr_name.length; a++){
        div.push('<div>' + '<h1>'+arr_name[a]+'</h1>'+"</div>");
      }
      console.log(div);
      //사용자 아이콘
      var store_Icon = new google.maps.MarkerImage("/img/store_icon.png", null, null, null, new google.maps.Size(30,40));
      for( var i=0 ; i < arr.length; i++){
        //var div[i] = '<div>' + '<h1>'+arr_name[i]+'</h1>'+"</div>";
        // var geo_arr = new Array();
        geocoder.geocode( { 'address': arr[i] }, function(results, status) {
          if (status == 'OK') {
            // var coords = array.geo_arr[i];
            // var latLng = new google.maps.LatLng(위도, 경도);
            //map.setCenter(results[0].geometry.location);
            //console.log(results[0]);
            var marker = new google.maps.Marker({
              // position: latLng,
              position: results[0].geometry.location,
              icon : store_Icon,
              map: map
            });

            // for(a=0; a<3; a++){
            var infowindow = new google.maps.InfoWindow({
              content: div[i]
            });
            //}

            marker.addListener("click", function() {
              infowindow.open(map, marker);
            });

          }
          // else {
          //   alert('Geocode was not successful for the following reason: ' + status);
          // }
          //console.log(cont);
        });
      }
    }
  }

  //데이터베이스에서 로그인한 사람의 주소를 받아와서 지도에 마킹해주는 함수
  // function geocodeAddress(geocoder, map) {
  //   //사용자 Address
  //   var address = $("#address").val();
  //   //사용자 아이콘
  //   //var user_Icon = new google.maps.MarkerImage("/img/flower_icon.png", null, null, null, new google.maps.Size(100,40));
  //   geocoder.geocode({'address': address}, function(results, status) {
  //     //console.log(address);
  //     if (status === 'OK') {
  //       map.setCenter(results[0].geometry.location);
  //
  //       var faddr_lat = results[0].geometry.location.lat();//위도
  //       var faddr_lng = results[0].geometry.location.lng();//경도
  //       console.log(faddr_lat);
  //       console.log(faddr_lng);
  //
  //       var marker = new google.maps.Marker({
  //         map: map,
  //         // icon : user_Icon,
  //         position: results[0].geometry.location
  //       });
  //     }
  //
  //     //주소가 안잡힐때 일어나는 일
  //     else {
  //       alert('Geocode was not successful for the following reason: ' + status);
  //     }
  //   });
  // }
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNgEwwsTw1BLlld8mkOtzdN94EBExR7I0&callback=initMap">
</script>
</body>
</html>
