<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="Content-Script-Type" content="text/javascript">
  <meta http-equiv="Content-Style-Type" content="text/css">
  <title></title>
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/sellerpost.css">
  <script type="text/javascript" src="/js/service/HuskyEZCreator.js" charset="utf-8"></script>

</head>
<body>
  @include('lib.header')
  <div class="hr-line">
    <div id="line">
      <h2>상품 게시물 수정</h2>
      <hr>
    </div>
  </div>
  <div class="post">
    @foreach ($pd_db as $pd)
      <div id="se2_sample" style="margin:10px 0;">

      <form action="/pd_modi{{$pd->p_no}}" method="post" id="send-text" name="index" accept-charset="utf-8" enctype="multipart/form-data" onsubmit="return postcheck();">
        @csrf
        <div class="" style="">
          <table>
            <tr>
              <th>상품평</th>
              <td>
                <input type="text" name="productname" id="productname" value="{{$pd->p_name}}"placeholder="제목" maxlength="180" class="post-title">
              </td>
            </tr>
          </table>
          <textarea name="ir1" id="weditor" rows="10" cols="100">{{$pd->p_contents}}</textarea>


          <!-- <div class="filebox">사진 업로드 부트스트랩 버튼 -->
          <div class="preview-wrap">
            <div class="preview-left">
              <div class="imginfo">기존 이미지</div>
              <div class="preview">
                <div class="preview-image">
                  <!-- 이미지 미리보기 -->
                  <img src="/imglib/{{$pd->p_filename}}" alt="내가 올린 상품 사진">
                </div>
              </div>
            </div>

            <div class="preview-center">
              <div class="imginfo">새로운 이미지</div>
              <div class="preview">
                <img src="#" alt="" id="image-session">
                <div class="preview-image">
                  <!-- 이미지 미리보기 -->
                </div>
              </div>
            </div>
            <div class="preview-right">
              <div class="image-upload">
                <label for="real-input">[사진 업로드] <br> 사진을 새로 올려주세요.</label><br><br>
                <input type="file" onchange="checkFile(this);" id="real-input" name="picture" class="image_inputType_file" accept="image/*">
              </div>
            </div>
          </div>

          <div class="input-guide" style="" >
            &nbsp;&nbsp;&nbsp;&#8251; 배송비, 판매금액, 적립금은 숫자만 입력 가능합니다.
          </div>
          <table>
            <tr>
              <th class="th-css">배송비</th>
              <td><input type="text" class="input-length" id="deliverycharge" numberonly="true" name="deliverycharge" onkeyup="removeChar(event)" onkeydown="return onlyNumber(event)" value="{{number_format($pd->p_delivery)}}" maxlength="10" placeholder="0" style="text-align:right;">원</td>
            </tr>
            <tr>
              <th class="th-css">판매금액</th>
              <td><input type="text" class="input-length" id="sellingprice" numberonly="true" name="sellingprice" onkeyup="removeChar(event)" onkeydown="return onlyNumber(event)" value="{{number_format($pd->p_price)}}" maxlength="10" placeholder="0"style="text-align:right;" >원</td>
            </tr>
            {{-- <tr>
              <th class="th-css">적립금</th>
              <td><input type="text" class="input-length" id="" numberonly="true" name="" onkeyup="removeChar(event)" onkeydown="return onlyNumber(event)" value="" maxlength="10" style="text-align:right;">원</td>
            </tr> --}}
          </table>
        </div>
        <div class="postbutton">
          <input type="submit" name="" value="저장" id="save" >
          <!-- <button type="submit" name="button" class="send-btn" id="submitBoardBtn" form="send-text">저장</button> -->
          <button type="button" name="button" class="Cancellation-btn">취소</button>
        </div>
      </form>
    </div>
  @endforeach
</div>


<script>
// function setThumbnail(event) {
//   for
//   (var image of event.target.files) {
//     var reader = new FileReader();
//     reader.onload = function(event) { var img = document.createElement("img"); img.setAttribute("src", event.target.result); document.querySelector("#preview").appendChild(img); };
//     console.log(image); reader.readAsDataURL(image); } }
// 파일용량제한 스크립트
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
  // console.log(file_name)
  // console.log(file_kind)

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
// 사진 바꿔주는 jquery
// $("#real-input").change(function(){
//   readURL(this);
// });
</script>
<script src="https://code.jquery.com/jquery-2.2.1.js"></script>
<script>
// 숫자만
$(document).on("keyup", "input:text[numberonly]", function() {
  $(this).val( $(this).val().replace(/[^0-9]/gi,"") );
  var regexp = /\B(?=(\d{3})+(?!\d))/g;
  $(this).val( $(this).val().toString().replace(regexp, ',') );
});
</script>
@include('lib.footer')
</body>
</html>
<script type="text/javascript">
var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
  oAppRef: oEditors,
  elPlaceHolder: "weditor",
  sSkinURI: "/SmartEditor2Skin.html",
  fCreator: "createSEditor2"
});

function onlyNumber(event){
  event = event || window.event;
  var keyID = (event.which) ? event.which : event.keyCode;
  if ( (keyID >= 48 && keyID <= 57) || (keyID >= 96 && keyID <= 105) || keyID == 8 || keyID == 46 || keyID == 37 || keyID == 39 ){
    return;
  }

  else{
    return false;
  }
  // alert('숫자만 입력 가능합니다.');

}
function removeChar(event) {
  event = event || window.event;
  var keyID = (event.which) ? event.which : event.keyCode;
  if ( keyID == 8 || keyID == 46 || keyID == 37 || keyID == 39 )
  return;
  else
  event.target.value = event.target.value.replace(/[^0-9]/g, "");
}
function postcheck(){
  if($('#weditor').val()==""){
    $('#weditor').focus();
    alert('상품설명을 입력해주세요');
    return false;
  }
  if($('#productname').val()==""){
    $('#productname').focus();
    alert('상품명을 입력해주세요');
    return false;
  }
  if($('#real-input').val()==""){
    $('#real-input').focus();
    alert('사진을 업로드 해주세요');
    return false;
  }
  if($('#deliverycharge').val()==""){
    $('#deliverycharge').focus();
    alert('배송비를 입력해주세요');
    return false;
  }
  if($('#sellingprice').val()==""){
    $('#sellingprice').focus();
    alert('상품 가격을 입력해주세요');
    return false;
  }
  oEditors.getById["weditor"].exec("UPDATE_CONTENTS_FIELD", []);
}

</script>
