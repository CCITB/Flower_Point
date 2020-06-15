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
          <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=fdadb926ed142395efd36876fec312dc&libraries=services"></script>
          <div class="map_wrap">
              <div id="map" style="width:80%;height:450px;position:relative;overflow:hidden;"></div>

              <div id="menu_wrap" class="bg_white">
                  <div class="option">
                      <div>
                          <form onsubmit="searchPlaces(); return false;">
                              키워드 : <input type="text" value="이태원 꽃집" id="keyword" size="15">
                              <button type="submit">검색하기</button>
                          </form>
                      </div>
                  </div>
                  <hr>
                  <ul id="placesList"></ul>
                  <div id="pagination"></div>
              </div>
          </div>
          <script>
          var mapContainer = document.getElementById('map'), // 지도를 표시할 div
              mapOption = {
                  center: new kakao.maps.LatLng(33.450701, 126.570667), // 지도의 중심좌표
                  level: 3 // 지도의 확대 레벨
              };

          var map = new kakao.maps.Map(mapContainer, mapOption); // 지도를 생성합니다

          // HTML5의 geolocation으로 사용할 수 있는지 확인합니다
          if (navigator.geolocation) {

              // GeoLocation을 이용해서 접속 위치를 얻어옵니다
              navigator.geolocation.getCurrentPosition(function(position) {

                  var lat = position.coords.latitude, // 위도
                      lon = position.coords.longitude; // 경도

                  var locPosition = new kakao.maps.LatLng(lat, lon), // 마커가 표시될 위치를 geolocation으로 얻어온 좌표로 생성합니다
                      message = '<div style="padding:5px;">현재 사용자위치</div>'; // 인포윈도우에 표시될 내용입니다

                  // 마커와 인포윈도우를 표시합니다
                  displayMarker(locPosition, message);

                });

          }
          //  else { // HTML5의 GeoLocation을 사용할 수 없을때 마커 표시 위치와 인포윈도우 내용을 설정합니다
          //
          //     var locPosition = new kakao.maps.LatLng(33.450701, 126.570667),
          //         message = 'geolocation을 사용할수 없어요..'
          //
          //     displayMarker(locPosition, message);
          // }

          // 지도에 마커와 인포윈도우를 표시하는 함수입니다
          function displayMarker(locPosition, message) {

              // 마커를 생성합니다
              var marker = new kakao.maps.Marker({
                  map: map,
                  position: locPosition
              });

              var iwContent = message, // 인포윈도우에 표시할 내용
                  iwRemoveable = true;

              // 인포윈도우를 생성합니다
              var infowindow = new kakao.maps.InfoWindow({
                  content : iwContent,
                  removable : iwRemoveable
              });

              // 인포윈도우를 마커위에 표시합니다
              infowindow.open(map, marker);

              // 지도 중심좌표를 접속위치로 변경합니다
              map.setCenter(locPosition);
}

//           // 장소 검색 객체를 생성합니다
//           var ps = new kakao.maps.services.Places();
//
//           // 키워드로 장소를 검색합니다
//           ps.keywordSearch('꽃집', placesSearchCB);
//
//           // 키워드 검색 완료 시 호출되는 콜백함수 입니다
//           function placesSearchCB (data, status, pagination) {
//               if (status === kakao.maps.services.Status.OK) {
//
//
//                 for (var i=0; i<data.length; i++) {
//            displayMarker(data[i]);
//          }
//    }
// }
// }
// // 지도에 마커를 표시하는 함수입니다
// function displayMarker(place) {
//     // 마커를 생성하고 지도에 표시합니다
//     var marker = new kakao.maps.Marker({
//         map: map,
//         position: new kakao.maps.LatLng(place.y, place.x)
//     });
//
//     // 마커에 클릭이벤트를 등록합니다
//     kakao.maps.event.addListener(marker, 'click', function() {
//         // 마커를 클릭하면 장소명이 인포윈도우에 표출됩니다
//         infowindow.setContent('<div style="padding:5px;font-size:12px;">' + place.place_name + '</div>');
//         infowindow.open(map, marker);
//     });
// }





//여기는 전 코드//
          // 키워드로 장소를 검색합니다
          // searchPlaces();

          // 키워드 검색을 요청하는 함수입니다
          // function searchPlaces() {
          //     var keyword = document.getElementById('keyword').value;
          //
          //
          //     if (!keyword.replace(/^\s+|\s+$/g, '')) {
          //         alert('키워드를 입력해주세요!');
          //         return false;
          //     }
          //
          //
          //
          //     if(keyword.indexOf('꽃') != -1) {
          //
          //
          //     }
          //     else if(keyword.indexOf('플라워') != -1) {
          //
          //
          //     }
          //     else if(keyword.indexOf('flower') != -1) {
          //
          //
          //     }
          //
          //     else {
          //       alert('키워드를 확인해주세요! 예)일산 꽃집, 종로 플라워샵');
          //       return false;
          //     }
          //
          //
          //
          //     // 장소검색 객체를 통해 키워드로 장소검색을 요청합니다
          //     ps.keywordSearch( keyword, placesSearchCB);
          // }
          //
          // // 장소검색이 완료됐을 때 호출되는 콜백함수 입니다
          // function placesSearchCB(data, status, pagination) {
          //     if (status === kakao.maps.services.Status.OK) {
          //
          //         // 정상적으로 검색이 완료됐으면
          //         // 검색 목록과 마커를 표출합니다
          //         displayPlaces(data);
          //
          //         // 페이지 번호를 표출합니다
          //         displayPagination(pagination);
          //
          //     } else if (status === kakao.maps.services.Status.ZERO_RESULT) {
          //
          //         alert('검색 결과가 존재하지 않습니다.');
          //         return;
          //
          //     } else if (status === kakao.maps.services.Status.ERROR) {
          //
          //         alert('검색 결과 중 오류가 발생했습니다.');
          //         return;
          //
          //     }
          // }
          // // 검색 결과 목록과 마커를 표출하는 함수입니다
          // function displayPlaces(places) {
          //
          //     var listEl = document.getElementById('placesList'),
          //     menuEl = document.getElementById('menu_wrap'),
          //     fragment = document.createDocumentFragment(),
          //     bounds = new kakao.maps.LatLngBounds(),
          //     listStr = '';
          //
          //     // 검색 결과 목록에 추가된 항목들을 제거합니다
          //     removeAllChildNods(listEl);
          //
          //     // 지도에 표시되고 있는 마커를 제거합니다
          //     removeMarker();
          //
          //     for ( var i=0; i<places.length; i++ ) {
          //
          //         // 마커를 생성하고 지도에 표시합니다
          //         var placePosition = new kakao.maps.LatLng(places[i].y, places[i].x),
          //             marker = addMarker(placePosition, i),
          //             itemEl = getListItem(i, places[i]); // 검색 결과 항목 Element를 생성합니다
          //
          //         // 검색된 장소 위치를 기준으로 지도 범위를 재설정하기위해
          //         // LatLngBounds 객체에 좌표를 추가합니다
          //         bounds.extend(placePosition);
          //
          //         // 마커와 검색결과 항목에 mouseover 했을때
          //         // 해당 장소에 인포윈도우에 장소명을 표시합니다
          //         // mouseout 했을 때는 인포윈도우를 닫습니다
          //         (function(marker, title) {
          //             kakao.maps.event.addListener(marker, 'mouseover', function() {
          //                 displayInfowindow(marker, title);
          //             });
          //
          //             kakao.maps.event.addListener(marker, 'mouseout', function() {
          //                 infowindow.close();
          //             });
          //
          //             itemEl.onmouseover =  function () {
          //                 displayInfowindow(marker, title);
          //             };
          //
          //             itemEl.onmouseout =  function () {
          //                 infowindow.close();
          //             };
          //         })(marker, places[i].place_name);
          //
          //         fragment.appendChild(itemEl);
          //     }
          //
          //     // 검색결과 항목들을 검색결과 목록 Elemnet에 추가합니다
          //     listEl.appendChild(fragment);
          //     menuEl.scrollTop = 0;
          //
          //     // 검색된 장소 위치를 기준으로 지도 범위를 재설정합니다
          //     map.setBounds(bounds);
          // }
          //
          // // 검색결과 항목을 Element로 반환하는 함수입니다
          // function getListItem(index, places) {
          //
          //     var el = document.createElement('li'),
          //     itemStr = '<span class="markerbg marker_' + (index+1) + '"></span>' +
          //                 '<div class="info">' +
          //                 '   <h5>' + places.place_name + '</h5>';
          //
          //     if (places.road_address_name) {
          //         itemStr += '    <span>' + places.road_address_name + '</span>' +
          //                     '   <span class="jibun gray">' +  places.address_name  + '</span>';
          //     } else {
          //         itemStr += '    <span>' +  places.address_name  + '</span>';
          //     }
          //
          //       itemStr += '  <span class="tel">' + places.phone  + '</span>' +
          //                 '</div>';
          //
          //     el.innerHTML = itemStr;
          //     el.className = 'item';
          //
          //     return el;
          // }
          //
          // // 마커를 생성하고 지도 위에 마커를 표시하는 함수입니다
          // function addMarker(position, idx, title) {
          //     var imageSrc = 'https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/marker_number_blue.png', // 마커 이미지 url, 스프라이트 이미지를 씁니다
          //         imageSize = new kakao.maps.Size(36, 37),  // 마커 이미지의 크기
          //         imgOptions =  {
          //             spriteSize : new kakao.maps.Size(36, 691), // 스프라이트 이미지의 크기
          //             spriteOrigin : new kakao.maps.Point(0, (idx*46)+10), // 스프라이트 이미지 중 사용할 영역의 좌상단 좌표
          //             offset: new kakao.maps.Point(13, 37) // 마커 좌표에 일치시킬 이미지 내에서의 좌표
          //         },
          //         markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize, imgOptions),
          //             marker = new kakao.maps.Marker({
          //             position: position, // 마커의 위치
          //             image: markerImage
          //         });
          //
          //     marker.setMap(map); // 지도 위에 마커를 표출합니다
          //     markers.push(marker);  // 배열에 생성된 마커를 추가합니다
          //
          //     return marker;
          // }
          //
          // // 지도 위에 표시되고 있는 마커를 모두 제거합니다
          // function removeMarker() {
          //     for ( var i = 0; i < markers.length; i++ ) {
          //         markers[i].setMap(null);
          //     }
          //     markers = [];
          // }
          //
          // // 검색결과 목록 하단에 페이지번호를 표시는 함수입니다
          // function displayPagination(pagination) {
          //     var paginationEl = document.getElementById('pagination'),
          //         fragment = document.createDocumentFragment(),
          //         i;
          //
          //     // 기존에 추가된 페이지번호를 삭제합니다
          //     while (paginationEl.hasChildNodes()) {
          //         paginationEl.removeChild (paginationEl.lastChild);
          //     }
          //
          //     for (i=1; i<=pagination.last; i++) {
          //         var el = document.createElement('a');
          //         el.href = "#";
          //         el.innerHTML = i;
          //
          //         if (i===pagination.current) {
          //             el.className = 'on';
          //         } else {
          //             el.onclick = (function(i) {
          //                 return function() {
          //                     pagination.gotoPage(i);
          //                 }
          //             })(i);
          //         }
          //
          //         fragment.appendChild(el);
          //     }
          //     paginationEl.appendChild(fragment);
          // }
          //
          // // 검색결과 목록 또는 마커를 클릭했을 때 호출되는 함수입니다
          // // 인포윈도우에 장소명을 표시합니다
          // function displayInfowindow(marker, title) {
          //     var content = '<div style="padding:5px;z-index:1;">' + title + '</div>';
          //
          //     infowindow.setContent(content);
          //     infowindow.open(map, marker);
          // }
          //
          //  // 검색결과 목록의 자식 Element를 제거하는 함수입니다
          // function removeAllChildNods(el) {
          //     while (el.hasChildNodes()) {
          //         el.removeChild (el.lastChild);
          //     }
          // }
          </script>








    @include('lib.footer')
</body>
</html>
<style media="screen">

.map_wrap, .map_wrap * {margin:0;padding:0;font-family:'Malgun Gothic',dotum,'돋움',sans-serif;font-size:12px;}
.map_wrap a, .map_wrap a:hover, .map_wrap a:active{color:#000;text-decoration: none;}
.map_wrap {position:relative;width:100%;height:500px;}
#menu_wrap {position:absolute;top:0;left:0;bottom:0;width:280px;margin-left: 80%; border: 2px solid; padding:5px;overflow-y:auto;background:rgba(255, 255, 255, 0.7);z-index: 1;font-size:12px;border-radius: 10px;}
.bg_white {background:#fff;}
#menu_wrap hr {display: block; height: 1px;border: 0; border-top: 2px solid #5F5F5F;margin:3px 0;}
#menu_wrap .option{text-align: center;}
#menu_wrap .option p {margin:10px 0;}
#menu_wrap .option button {margin-left:5px;}
#placesList li {list-style: none;}
#placesList .item {position:relative;border-bottom:1px solid #888;overflow: hidden;cursor: pointer;min-height: 65px;}
#placesList .item span {display: block;margin-top:4px;}
#placesList .item h5, #placesList .item .info {text-overflow: ellipsis;overflow: hidden;white-space: nowrap;}
#placesList .item .info{padding:10px 0 10px 55px;}
#placesList .info .gray {color:#8a8a8a;}
#placesList .info .jibun {padding-left:26px;background:url(https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/places_jibun.png) no-repeat;}
#placesList .info .tel {color:#009900;}
#placesList .item .markerbg {float:left;position:absolute;width:36px; height:37px;margin:10px 0 0 10px;background:url(https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/marker_number_blue.png) no-repeat;}
#placesList .item .marker_1 {background-position: 0 -10px;}
#placesList .item .marker_2 {background-position: 0 -56px;}
#placesList .item .marker_3 {background-position: 0 -102px}
#placesList .item .marker_4 {background-position: 0 -148px;}
#placesList .item .marker_5 {background-position: 0 -194px;}
#placesList .item .marker_6 {background-position: 0 -240px;}
#placesList .item .marker_7 {background-position: 0 -286px;}
#placesList .item .marker_8 {background-position: 0 -332px;}
#placesList .item .marker_9 {background-position: 0 -378px;}
#placesList .item .marker_10 {background-position: 0 -423px;}
#placesList .item .marker_11 {background-position: 0 -470px;}
#placesList .item .marker_12 {background-position: 0 -516px;}
#placesList .item .marker_13 {background-position: 0 -562px;}
#placesList .item .marker_14 {background-position: 0 -608px;}
#placesList .item .marker_15 {background-position: 0 -654px;}
#pagination {margin:10px auto;text-align: center;}
#pagination a {display:inline-block;margin-right:10px;}
#pagination .on {font-weight: bold; cursor: default;color:#777;}
</style>
