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

<!--어지수-->
<body>
  @include('lib.header')
  <div class="menu4"><!--탑헤더 밑-->
    <h2 class="void-container">내 주변 꽃집</h2>
    <hr>
  </hr>
</head>
<body>
  <style>

  /* Set the size of the div element that contains the map */
  #map {
    height: 700px;  /* The height is 400 pixels */
    width: 70%;  /* The width is the width of the web page */
    margin : auto auto 100px 30px;
  }
  /* Optional: Makes the sample page fill the window. */
  html, body {
    height: 100%;
    padding: 0;
  }
  #main {
    width:500px;
  }
  #array{
    color:#7d7d7d;
  }
  </style>
  <!--구매자일 때-->
  @if(auth()->guard('seller')->user())
  @foreach ($store_address as $address)
  <!--주소를 검색하는 부분을 숨겨놨음 (정경진)-->
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

  @foreach ($store_info as $intro)
  <input class="store_intro" id="{{$intro->st_no}} "type="hidden" value="{{$intro->st_introduce}}">
  @endforeach

  @foreach ($store_info as $store_name)
  <input class="store_name" id="{{$store_name->st_no}} "type="hidden" value="{{$store_name->st_name}}">
  @endforeach

  @foreach ($store_info as $store_tel)
  <input class="store_tel" id="{{$store_tel->st_no}} "type="hidden" value="{{$store_tel->st_tel}}">
  @endforeach

  <script>
  //var user;
  //맵 가져오는 소스, 확대수치(zoom), 중심좌표(위도,경도)->(lat, lng);
  function initMap() {
    //contentString에 들어갈 나머지 주소들
    var array = $('.array');
    var detail = $(".address_detail");
    var extra = $(".address_extra");
    var name = $(".store_name");
    var tel = $(".store_tel");
    var intro = $(".store_intro");
    console.log(tel);

    //store 주소 정보를 담을 배열
    var arr = new Array();
    var arr_detail = new Array();
    var arr_extra = new Array();
    var arr_name = new Array();
    var arr_intro = new Array();
    var arr_tel = new Array();

    for(var j=0; j < array.length; j++){
      arr.push(array[j].value);
    }
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
    for(var a=0; a<tel.length; a++){
      arr_tel.push(tel[a].value);
    }

    var user_address = $("#address").val();
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 15,
    });

    // 위도경도 변환하는 코드
    var geocoder = new google.maps.Geocoder();

    var script = document.createElement('script');
    script.src = 'https://developers.google.com/maps/documentation/javascript/examples/json/earthquake_GeoJSONP.js';
    document.getElementsByTagName('head')[0].appendChild(script);

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

      var div = new Array();

      for(var a=0; a<arr_name.length; a++){
        div.push('<div id="main">'+
        '<p><h1>'+arr_name[a]+'</h1><h5>'+arr_tel[a]+'</h5></p><hr>'+
        '<div id="bodyContent">'
        +'<p><h4 id="intro"><b>'+arr_intro[a]+'</b></h4></p>'+"</div>"+
        '<div id="address"><h4 id="array">'+arr[a]+', '+arr_detail[a]+arr_extra[a]+'<h4></div>'
        +"</div>");
      }
      //사용자 아이콘
      var store_Icon = new google.maps.MarkerImage("/img/store_icon.png", null, null, null, new google.maps.Size(30,40));

        for( i=0 ; i < arr.length; i++){
          //console.log(arr[i]);
          geocoder.geocode( {'address': arr[i] },(function (i) {
            return  function(results, status) {
              //console.log(i);
              if (status == 'OK') {
                var marker = new google.maps.Marker({
                  // position: latLng,
                  position: results[0].geometry.location,
                  icon : store_Icon,
                  map: map,
                });
                //console.log(results[0]);

                var infowindow = new google.maps.InfoWindow({
                  content: div[i]
                });
                //console.log(div[i]);

                marker.addListener("mouseover", function() {

                  infowindow.open(map, marker);
                });
              } //if문
            };
          })(i)
        );
      }
    }
}
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNgEwwsTw1BLlld8mkOtzdN94EBExR7I0&callback=initMap">
</script>
</body>
</html>
