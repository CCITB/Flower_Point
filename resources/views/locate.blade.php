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

    <div>
      <div class="void-container">내 주변 꽃집
        <input id="search_input" class="search_input" type="text" placeholder="내 주변 꽃집 검색"/>
      </div>

    </div>
    <div class="under">
      <div id="map"></div>


      {{-- <input id="search_btn" class="search_btn" type="button" value="검색"/> --}}



      {{-- <div class="title" id="title">
      <p></p>
    </div> --}}

  </div>
</div>
</body>
@include('lib.footer')
</html>

<!--판매자일 때-->
@if(auth()->guard('seller')->user())
  @foreach ($store_address as $address)
    <!--주소를 검색하는 부분을 숨겨놨음 (정경진)-->
    <div id="floating-panel">
      <input id="user_address" type="hidden" value="{{$address->a_address}}">
    </div>
  @endforeach

  <!--구매자일 때 check-->
@elseif (auth()->guard('customer')->user())
  @foreach ($customer_address as $address)
    <div id="floating-panel">
      <input id="user_address" class="address_c" type="hidden" value="{{$address->a_address}}">
    </div>
  @endforeach
@endif


<!-- store address 정보 -->

@foreach ($store_info as $address)
  <input class="array_url" id="address_url{{$address->st_name}} "type="hidden" value="{{$address->st_name}}">
@endforeach

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
  <input class="store_name" id="{{$store_name->st_no}}  "type="hidden" value="{{$store_name->st_name}}">
@endforeach

@foreach ($store_info as $store_tel)
  <input class="store_tel" id="{{$store_tel->st_no}} "type="hidden" value="{{$store_tel->st_tel}}">
@endforeach

<script>


//맵 가져오는 소스, 확대수치(zoom), 중심좌표(위도,경도)->(lat, lng);
function initMap() {
  //contentString에 들어갈 나머지 주소들
  var url = $('.array_url');
  var array = $('.array');
  var detail = $(".address_detail");
  var extra = $(".address_extra");
  var name = $(".store_name");
  var tel = $(".store_tel");
  var intro = $(".store_intro");

  //store 주소 정보를 담을 배열
  var arr_url = new Array();
  var arr = new Array();
  var arr_detail = new Array();
  var arr_extra = new Array();
  var arr_name = new Array();
  var arr_intro = new Array();
  var arr_tel = new Array();



  for(var j=0; j < array.length; j++){
    arr.push(array[j].value);
  }
  for(var a=0; a < url.length; a++){
    arr_url.push(url[a].value);
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


  var user_address = $("#user_address").val();
  console.log(user_address);

  // Map
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 14,
    mapTypeId: "roadmap"
  });

  // 위도경도 변환하는 코드
  var geocoder = new google.maps.Geocoder();

  var script = document.createElement('script');
  script.src = 'https://developers.google.com/maps/documentation/javascript/examples/json/earthquake_GeoJSONP.js';
  document.getElementsByTagName('head')[0].appendChild(script);

  //User(seller/custsomer) 주소
  geocoder.geocode( { 'address': user_address }, function(results, status) {
    if (status == 'OK') {
      console.log(results);
      map.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
        // position: latLng,
        position: results[0].geometry.location,
        map: map
      });
    }
    // 지도에 표시할 원을 생성
        // var circle = new google.maps.Circle({
        //   center :results[0].geometry.location,  // 원의 중심좌표 입니다
        //   radius: 2000, // 미터 단위의 원의 반지름입니다
        //   strokeWeight: 5, // 선의 두께입니다
        //   strokeColor: '#75B8FA', // 선의 색깔입니다
        //   strokeOpacity: 1, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
        //   strokeStyle: 'dashed', // 선의 스타일 입니다
        //   fillColor: '#CFE7FF', // 채우기 색깔입니다
        //   fillOpacity: 0.7  // 채우기 불투명도 입니다
        // });
        //
        // circle.setMap(map);
  });

  //Store 주소
  window.eqfeed_callback = function(results) {

    var div = new Array();

    for(var a=0; a<arr_name.length; a++){
      div.push('<div id="main">'+
      '<p><h1>'+arr_name[a]+'</h1><a href="store/'+arr_url[a]+'">< 바로가기</a><h5>'+arr_tel[a]+'</h5></p><hr>'+
      '<div id="bodyContent">'
      +'<p><h4 id="intro"><b>'+arr_intro[a]+'</b></h4></p>'+"</div>"+
      '<div id="address"><h4 id="array">'+arr[a]+', '+arr_detail[a]+arr_extra[a]+'<h4></div>'
      +"</div>");
    }
    //사용자 아이콘
    // var input = $("#search_input").val();
    var store_Icon = new google.maps.MarkerImage("/imglib/flower_icon.png", null, null, null, new google.maps.Size(135,95));

    for( i=0 ; i < arr.length; i++){
      // $("#search_btn").click(function(){
      //   if(arr_name.indexof(input)){
      //     console.log(arr_name[i]);
      //   }
      // });

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
              mapTypeId: "roadmap"
            });
            //console.log(results[0]);

            var infowindow = new google.maps.InfoWindow({
              content: div[i]
            });
            // google.maps.event.addListener(marker, "click", function() {
            //   infowindow.open(map, this);
            // });
            // marker.addListener("mouseover", function() {
            //   infowindow.open(map, this);
            // });
            // marker.addListener("mouseout", function() {
            //   infowindow.close(map, this);
            // });
            marker.addListener("click", function() {
              infowindow.open(map, this);
            });


          } //if문
        };
      })(i)
    );
  }//for

  //Search
  //  find_id 이름 입력란
  // $("#search_btn").click(function() {
  //   var input = $("#search_input").val();
  //   console.log(input);
  //   console.log(arr_name);
  //   if(arr_name.find(/input/)){
  //     alert('gd.');
  //   }
  //   else{
  //     alert('123');
  //   }
  // markers = [];
  // markers.push(
  //       new google.maps.Marker({
  //         map: map,
  //         icon: store_Icon,
  //         // title: arr_name,
  //         // position: place.geometry.location
  //       })
  //     );
  //   }
  //});
}//call

var input = document.getElementById("search_input");
var searchBox = new google.maps.places.SearchBox(input);
map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

// Bias the SearchBox results towards current map's viewport.
map.addListener("bounds_changed", function() {
  searchBox.setBounds(map.getBounds());
});

var markers = [];
// Listen for the event fired when the user selects a prediction and retrieve
// more details for that place.
searchBox.addListener("places_changed", function() {
  var places = searchBox.getPlaces();

  if (places.length == 0) {
    return;
  }

  // Clear out the old markers.
  markers.forEach(function(marker) {
    marker.setMap(null);
  });
  //markers = [];

  // For each place, get the icon, name and location.
  var bounds = new google.maps.LatLngBounds();
  places.forEach(function(place) {
    if (!place.geometry) {
      console.log("Returned place contains no geometry");
      return;
    }
    var icon = {
      url: place.icon,
      size: new google.maps.Size(71, 71),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(17, 34),
      scaledSize: new google.maps.Size(0, 0)
    };

    // Create a marker for each place.
    markers.push(
      new google.maps.Marker({
        map: map,
        icon: icon,
        title: place.name,
        position: place.geometry.location
      })
    );
    console.log(markers);
    //console.log(markers);

    if (place.geometry.viewport) {
      // Only geocodes have viewport.
      bounds.union(place.geometry.viewport);
    } else {
      bounds.extend(place.geometry.location);
    }
  });
  map.fitBounds(bounds);
});
}//init


</script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<!-- <script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNgEwwsTw1BLlld8mkOtzdN94EBExR7I0&callback=initMap">
</script> -->
<script
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNgEwwsTw1BLlld8mkOtzdN94EBExR7I0&callback=initAutocomplete&libraries=places&v=weeklykey=AIzaSyBNgEwwsTw1BLlld8mkOtzdN94EBExR7I0&callback=initMap"
defer
></script>
