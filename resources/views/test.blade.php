<script type="text/javascript">
//맵 가져오는 소스, 확대수치(zoom), 중심좌표(위도,경도)->(lat, lng);
function initMap() {
var map = new google.maps.Map(document.getElementById('map'), {
  zoom: 15,
  //center: {lat: -34.397, lng: 150.644}
});

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
