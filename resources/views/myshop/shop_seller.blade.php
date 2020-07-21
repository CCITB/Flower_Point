<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/shop.css">
  <!-- <link rel="stylesheet" href="/css/postlist.css"> -->

  <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" type="text/css"/>
  <div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
    <img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnCloseLayer"
    style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
  </div>
  <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
  <script type="text/javascript" src="/js/service/HuskyEZCreator.js" charset="utf-8"></script>
</head>
<body>
  @include('lib.header')
  <!-- 정경진 -->
  <!-- seller에게 보이는 store화면 -->
  <div class="allwrap">
    <div class="wrap0">
      @foreach ($data as $data1)
        <div class="mytitle">{{$data1->st_name}}</div>
        <div class="wrap2">

          <div class="imgbox">
            <img src="imglib/{{$data1->st_img}}" onerror="this.src='imglib/profile.png'" class="shopimg" id="image-session">
            <form action="{{url('image')}}" method="post" id="send-text" name="index" accept-charset="utf-8" enctype="multipart/form-data" onsubmit="return postcheck();">
              @csrf
              <div class="image-upload">
                <input type="button" value="이미지 등록" onclick="showPopup();" />
              </div>
            </form>
          </div>

          <div class="tablewrap">
            <table id="shopinfo">
              <tr>
                <th class="st_th">대표</th>
                <td class="st_td">{{$data1->s_name}}</td>
              </tr>
              <tr>
                <th class="st_th">상호명</th>
                <td class="st_td">{{$data1->st_name}}</td>
              </tr>
              <form class="addressgroup" action="/shopinfo" method="get">
                <tr>
                  <th class="st_th">주소</th>
                  <td class="st_td">({{$data1->a_post}}) {{$data1->a_address}}, {{$data1->a_detail}}{{$data1->a_extra}}<input type="button" id=modiaddress value="주소수정" name="introduce" display="block" onclick="div_show(this.value,'addresswrap' );"></td>
                </tr>
              </form>
              <tr>
                <th class="st_th1"></th>
                <td class="st_td1">
                  <div class="addresswrap" id="addresswrap" style="display:none;">
                    <form action="/newaddress" method="get">
                      <div class="delivery_wrap">
                        <strong class="info">새 주소</strong>
                      </div>
                      <div class="delivery_wrap2">
                        <!-- 우편번호 -->
                        <input type="text" class="addr_input" id="postcode" name="postcode" placeholder="우편번호" readonly>
                        <input type="button" id="find_post" onclick="execDaumPostcode()" value="우편번호"><br>
                        <!--주소 -->
                        <input type="text" class="addr_input" id="address" name="address" placeholder="주소" readonly><br>
                        <input type="text" class="addr_input" name="extraAddress"id="extraAddress" placeholder="참고항목" readonly><br>
                        <input type="text" class="addr_input" name="detailAddress" id="detailAddress" placeholder="상세주소" >
                      </div>
                      <button type="submit" id="complete1" name="button" >수정완료</button>
                    </form>
                  </div>
                </td>
              </tr>
            </table>
          </div>

          <div class="shopintro">
            <div id="introducemodi">{{$data1->st_introduce}}</div>
            <form class="shop" action="/shopinfo" method="get">
              <input type="button" id="modiinfo" value="소개수정" name="introduce" display="block" onclick="div_show(this.value,'addressapi' );">
              <div id="addressapi" style="display:none;">
                <textarea type="text" id="content" name="newintroduce" placeholder="가게소개를 적으세요."></textarea>
                <button type="submit" id="complete2" name="button" >수정완료</button>
              </div>
            </form>
          </div>
        </div>
      @endforeach
    </div>


    <div class="wrap0">
      <div class="productname">
        판매물품
        <button class="favoritebtn" type="button" onclick="location.href = '/sellershoppost'">물품등록</button>
      </div>
      <div class="wrap5">
        @if( auth()->guard('seller')->user())
          <div class="productlist">
            <div class="productlist-item">

              <table id="myTable">
                <thead>
                  <tr class="p_tr">
                    <th class="registration-date">날짜</th>
                    <th class="product-name">이름</th>
                    <th class="product-price">가격</th>
                    <th class="product-modify">수정</th>
                    <th class="product-remove">삭제</th>
                  </tr>
                </thead>
                <tbody id="tdbody">
                  @foreach ($proro as $data3)
                    <tr>
                      <td class="upload">{{$data3->p_date}}</td>
                      <td class="upload" onclick="location.href = '/product/{{$data3->p_no}}'">{{$data3->p_name}}</td>
                      <td class="upload">{{$data3->p_price}}</td>
                      <td class="upload">
                        <form class="upload" action="/pd_modify{{$data3->p_no}}" method="post">
                          @csrf
                          <input type="submit" id="modify" class="modify" value="수정">
                        </form>
                      </td>
                      <td class="upload">
                        <form  class="upload" name="delete" action="/pd_remove{{$data3->p_no}}" method="post">
                          @csrf
                          <input type="submit" name="remove" id="removel" class="modify" value="삭제">
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        @endif
      </div>

    </div>

  </div>
</div>
@include('lib.footer')
</body>
<script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript" ></script>
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" type="text/javascript" ></script>

<script type="text/javascript">

$('#modify').click(function(){
  var test = confirm("상품을 수정하시겠습니까?");
  if(test == false){
    return false;
  }
});

$('#removel').click(function(){
  var test = confirm("정말로 삭제하시겠습니까?");
  if(test == true){
    alert("삭제되었습니다.");
  }else{
    return false;
  }
});

function showPopup() {
  var url="image_popup";
  var option="width=300, height=300, top=200"
  window.open(url, "", option);
}

$(document).ready(function(){
  $("#myTable").DataTable({
    "language": {
      "emptyTable": "데이터가 없습니다.",
      "lengthMenu": "페이지당 _MENU_ 개씩 보기",
      "info": "현재 _START_ - _END_ / _TOTAL_건",
      "infoEmpty": "데이터 없음",
      "infoFiltered": "( 전체 _MAX_건의 데이터에서 필터링됨 )",
      "search": "검색",
      "zeroRecords": "일치하는 데이터가 없습니다.",
      "loadingRecords": "로딩중...",
      "processing":     "잠시만 기다려 주세요...",
      "paginate": { "next": "다음", "previous": "이전"  }
    }
  });
});

//버튼 클릭 이벤트
function div_show(s,ss){
  if(s == "주소수정"){
    document.getElementById(ss).style.display="block";
    ad.style.display="none";
    complete1.style.display="block";
    addresswrap.style.display="block";
  }
  else if(s== "소개수정"){
    document.getElementById(ss).style.display="block";
    modiinfo.style.display="none";
    introducemodi.style.display="none";
  }
}
//이미지 등록관련코드
function checkFile(el){
  $('imgbox').attr('src', '#');
  var file = el.files;
  if(file[0].size > 1024 * 1024 * 2){
    alert('2MB 이하 파일만 등록할 수 있습니다.\n\n' +
    '현재파일 용량 : ' + (Math.round(file[0].size / 1024 / 1024 * 100) / 100) + 'MB');
    el.outerHTML = el.outerHTML;
  }
  else chk_file_type(el);

}
function chk_file_type(el) {
  var file_kind = el.value.lastIndexOf('.');
  var file_name = el.value.substring(file_kind+1,el.length);
  var file_type = file_name.toLowerCase();
  var check_file_type=new Array();
  check_file_type=['jpg','gif','png','jpeg','bmp','tif'];
  if(check_file_type.indexOf(file_type)==-1) {
    alert('이미지 파일만 업로드 가능합니다.');
    var parent_Obj=el.parentNode;
    console.log(parent_Obj);
    var node=parent_Obj.replaceChild(el.cloneNode(true),el);
    document.getElementById("real-input").value = "";    //초기화를 위한 추가 코드
    document.getElementById("real-input").select();        //초기화를 위한 추가 코드                                               //일부 브라우저 미지원
  }
  else{readURL(el);
    $("#real-input").change(function(){
      readURL(this);
    });
  }
}
// 사진을 올릴때마다 파일을 새로 변경시켜주는 함수입니다.
function readURL(el) {
  if (el.files && el.files[0]) {
    var reader = new FileReader();
    // 이미지 미리보기해주는 jquery
    reader.onload = function (e) {
      $('#image-session').attr('src', e.target.result);
    }

    reader.readAsDataURL(el.files[0]);
  }
}


function postcheck(){
  if($('#real-input').val()==""){
    $('#real-input').focus();
    alert('사진을 업로드 해주세요');
    return false;
  }
}
function check(){
  if($('#registration').val()==""){
    $('#registration').focus();
    alert('사진을 업로드 해주세요');
    return false;
  }
}
</script>
<!--POST API Link -->
<script type="text/javascript" src="/js/postAPI.js" charset="utf-8"></script>
<script type="text/javascript" src="/js/radio.js" charset="utf-8"></script>

</html>
