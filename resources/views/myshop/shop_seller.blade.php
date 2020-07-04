<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/shop.css">
  <link rel="stylesheet" href="/css/postlist.css">
  <link rel="stylesheet" href="/css/image.css">
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
      @if( auth()->guard('seller')->user())
        @foreach ($data as $data1)
          <h3 class="shopname">{{$data1->st_name}}</h3>
          <hr>
          <div class="wrap2">
            <div class="imgbox">
              <img class="shopimg" src="/imglib/{{$data1->st_img}}" alt="등록된 가게이미지가 없습니다." >
            </div>
            <div id="tablewrap">
              <table id="shopinfo">
                <tr>
                  <th>대표</th>
                  <td><div class="thcell">{{$data1->s_name}}</div></td>
                </tr>

                <tr>
                  <th>상호명</th>
                  <td><div class="thcell">{{$data1->st_name}}</div></td>
                </tr>
              @endforeach
              <form class="addressgroup" action="/shopinfo" method="get">
                <tr>
                  <th>주소</th>
                  @foreach ($store_address as $a)
                    <td>{{$a->a_address}}<input type="button" id=modiaddress value="주소수정" name="introduce" display="block" onclick="div_show(this.value,'addresswrap' );"></td>


                    <tr>
                      <th>우편번호</th>
                      <td>{{$a->a_post}}</td>
                    </tr>
                    <tr>
                      <th>참고항목</th>
                      <td>{{$a->a_extra}}</td>
                    </tr>
                  @endforeach
                  @foreach ($detail_address as $b)
                    <tr>
                      <th>상세주소</th>
                      <td>{{$b->a_detail}}</td>
                    </tr>
                  @endforeach
                </tr>
              </form>
              <tr>
                <th>사업자 인증</th>
                <td>
                  <form action="/registration" method="post"  enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="registration" id="registration" class="my_img" accept="image/*" >
                    <input type="submit" onclick="check()" value="등록">
                  </form>
                </td>
              </tr>

            </div>
          </table>
        </div>
        <form class="shop" action="/shopinfo" method="get">
          <div class="shopintro">
            <div id="introducemodi">{{$data1->st_introduce}}</div>
            <input type="button" id="modiinfo" value="소개수정" name="introduce" display="block" onclick="div_show(this.value,'addressapi' );">
            <div id="addressapi" style="display:none;">
              <textarea type="text" id="content" name="newintroduce" placeholder="가게소개를 적으세요."></textarea>
              <button type="submit" id="complete2" name="button" >수정완료</button>
            </div>
          </div>
        </form>


      @endif
          </div>

    <form action="/newaddress" method="get">
      <div id="addresswrap" style="display:none;">
        <div id="addressmodi">
          <div class="delivery_wrap">
            <strong class="info">주 소</strong>
            <!-- 우편번호 -->
            <input type="text" id="postcode" name="postcode" placeholder="우편번호" readonly>
            <input type="button" id="find_post" onclick="execDaumPostcode()" value="우편번호"><br>
          </div>
          <!--주소 -->
          <div class="delivery_wrap2">
            <input type="text"  id="address" name="address" placeholder="주소" readonly>
            <div class="detail">
              <input type="text" class="delivery_address_list" name="extraAddress"id="extraAddress" placeholder="참고항목" readonly>
            </div>
            <div class="delivery_address_detail">
              <input type="text" class="delivery_address_list" name="detailAddress" id="detailAddress" placeholder="상세주소" >
            </div>
          </div>
        </div>
        <button type="submit" id="complete1" name="button" >수정완료</button>
      </div>
    </form>
    <div class="wrap4">
      <h3 class="productname">판매물품</h3>
    </div>
    <div class="wrap5">
      @if( auth()->guard('seller')->user())
        <div class="wrap6">
          <div class="wrap6-1">
            <img src="\imglib\" alt="" width="100px" height="100px">
          </div>

          <div class="productlist">
            <div class="productlist-item">
              <div class="">
                <form class="date-sort">
                  <select id="id-sort"name="language" onchange="sortTable(value)">
                    <option value="0" selected>내림차순</option>
                    <option value="0">오름차순</option>
                  </select>
                </form>
                <div class="write-post">
                  <a href="/sellershoppost">물품등록</a>
                </div>

                <input type="text" name="" value="">
                <button type="submit" name="button" >검색</button>
              </div>

              <table id="myTable">
                <thead>
                  <tr>
                    <th class="registration-date">날짜</th>
                    <th class="product-name">이름</th>
                    <th class="product-price">가격</th>
                    <th class="product-amount">주문량</th>
                    <th class="product-modify">수정</th>
                    <th class="product-remove">삭제</th>
                  </tr>
                </thead>
                <tbody>

                @foreach ($proro as $data3)
                  <tr>
                    <td class="upload-date">{{$data3->p_date}}</td>
                    <td class="upload-name">{{$data3->p_name}}</td>
                    <td class="upload-price">{{$data3->p_price}}</td>
                    <td></td>
                    <td>
                      <form class="" action="/pd_modify{{$data3->p_no}}" method="post">
                        @csrf
                        <input type="submit" value="수정">
                      </form>
                    </td>
                    <td>
                      <form name="delete" action="/pd_remove{{$data3->p_no}}" method="post">
                        @csrf
                        <input type="submit" name="remove" id="remove" value="삭제">
                      </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <div>
              {{ $proro->links()}}
            </div>
          </div>
        </div>
      @endif

    </div>
  </div>

  <form action="{{url('image')}}" method="post" id="send-text" name="index" accept-charset="utf-8" enctype="multipart/form-data" onsubmit="return postcheck();">
    @csrf
    <div class="preview-wrap">
      <div class="preview-left">
        <div class="preview">
          <img src="#" alt="" id="image-session">
          <div class="preview-image">
            <!-- 이미지 미리보기 -->
          </div>
        </div>
      </div>
      <div class="preview-right">
        <div class="image-upload">
          <label for="real-input">대표사진 변경</label>
          <input type="file" onchange="checkFile(this);" id="real-input" name="picture" class="image_inputType_file" accept="image/*">
        </div>
      </div>
    </div>
    <div class="postbutton">
      <input type="submit" name="" value="저장" id="save" >
            <button type="button" name="button" class="Cancellation-btn">취소</button>
    </div>
  </form>
</div>
</div>
@include('lib.footer')
</body>
<script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript" ></script>

<script type="text/javascript">
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
  $('#image-session').attr('src', '#');
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



function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  dir = "asc";
  while (switching) {
    switching = false;
    rows = table.rows;
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchcount ++;
    } else {
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
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
