<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="Content-Script-Type" content="text/javascript">
  <meta http-equiv="Content-Style-Type" content="text/css">
  <title></title>
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/sellerpost.css">
  <script>
  // const browseBtn = document.querySelector('.browse-btn');
  // 무슨 코드인지 모름
  // const realInput = document.querySelector('#real-input');
  //
  // browseBtn.addEventListener('click',()=>{
  //   realInput.click();
  // });
  </script>

  <script type="text/javascript" src="/js/service/HuskyEZCreator.js" charset="utf-8"></script>

</head>
<body>
  @include('lib.header')
  <div class="hr-line">
    <div id="line">
      <h2>물품등록</h2>
      <hr>
    </div>
  </div>
  <div class="post">
    <div id="se2_sample" style="margin:10px 0;">
      <!-- <div class="">
      <input type="button" onclick="pasteHTML();" value="본문에 내용 넣기" />
      <input type="button" onclick="showHTML();" value="본문 내용 가져오기" />
      <input type="button" onclick="submitContents();" value="서버로 내용 전송" />
      <input type="button" onclick="setDefaultFont();" value="기본 폰트 지정하기 (궁서_24)" />
    </div> -->
    <form action="{{url('index')}}" method="post" id="send-text" name="index" accept-charset="utf-8" enctype="multipart/form-data">
      @csrf
      <div class="" style="">
        <table>
          <tr>
            <th>상품명</th>
            <td>
              <input type="text" name="productname" value=""placeholder="상품명..." maxlength="180" class="post-title">
            </td>
          </tr>
        </table>
        <textarea name="ir1" id="weditor" rows="10" cols="100"> 텍스트를 적으시지 않으면 기본값으로 출력됩니다.</textarea>


        <!-- <div class="filebox">사진 업로드 부트스트랩 버튼 -->
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
              <label for="real-input">사진 업로드</label>
              <input type="file" onchange="checkFile(this);" id="real-input" name="picture" class="image_inputType_file" accept="image/*">
            </div>
          </div>
        </div>
        <!-- chk_file_type(this); checkFile(this); readURL();함수 주석 -->
        <!-- <button class="browse-btn">사진업로드</button> -->


        <!-- </div>사진 업로드 부트스트랩 버튼 -->

        <table>
          <tr>
            <th>배송비</th>
            <td><input type="text"  name="deliverycharge"  onkeydown="return onlyNumber(event)" value="" maxlength="15" placeholder="0" style="text-align:right;">원</td>
          </tr>
          <tr>
            <th>판매금액</th>
            <td><input type="text" name="sellingprice" onkeyup="removeChar(event)" onkeydown="return onlyNumber(event)" value=""placeholder="0"style="text-align:right;" >원</td>
          </tr>
          <tr>
            <th>적립금</th>
            <td><input type="text" name="" onkeyup="removeChar(event)" onkeydown="return onlyNumber(event)" value="" style="text-align:right;">원</td>
          </tr>
        </table>
      </div>
      <div class="postbutton">
        <input type="submit" name="" value="저장" id="save">
        <!-- <button type="submit" name="button" class="send-btn" id="submitBoardBtn" form="send-text">저장</button> -->
        <button type="button" name="button" class="Cancellation-btn">취소</button>
      </div>
    </form>
  </div>

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
// // 숫자만
// $(document).on("keyup", "input:text[numberonly]", function() {
//   $(this).val( $(this).val().replace(/[^0-9]/gi,"") );
//   var regexp = /\B(?=(\d{3})+(?!\d))/g;
//   // $(this).val( $(this).val().toString().replace(regexp, ',') );
// });
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
$("#save").click(function(){ oEditors.getById["weditor"].exec("UPDATE_CONTENTS_FIELD", []);
$("#send-text").submit(); }); //?? 이코드 뭐냐;;//



// $("#submitBoardBtn").click(function(){
//   var boardAccount = $('#boardAccount').val();
//   var boardSubject= $('#boardSubject').val();
//   var smartEditor= $('#smartEditor').val();
//   if(boardSubject.trim().length < 4){
//     alert("4글자 이상 입력하세요.");
//     $('#boardSubject').focus();
//   } else{
//     $.ajax({
//       url : '/index',
//       type : 'post',
//       datatype : 'json',
//       data : {
//         "boardAccount" : boardAccount,
//         "boardSubject" : boardSubject,
//         "smartEditor" : smartEditor
//       },
//       success : function(data){
//         if(data=="ok"){
//           location.href="/index";
//         }
//       }
//     });
//   }
// });
function onlyNumber(event){
    event = event || window.event;
    var keyID = (event.which) ? event.which : event.keyCode;
    if ( (keyID >= 48 && keyID <= 57) || (keyID >= 96 && keyID <= 105) || keyID == 8 || keyID == 46 || keyID == 37 || keyID == 39 )
        return;
    else
    // alert('숫자만 입력 가능합니다.');
        return false;
}
function removeChar(event) {
    event = event || window.event;
    var keyID = (event.which) ? event.which : event.keyCode;
    if ( keyID == 8 || keyID == 46 || keyID == 37 || keyID == 39 )
        return;
    else
        event.target.value = event.target.value.replace(/[^0-9]/g, "");
}
</script>
<!-- <script type="text/javascript">
if(window.frameElement){
jindo.$("se2_sample").style.display = "none";
}else{
var oEditor = createSEditor2(jindo.$("weditor"), {
bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
//bSkipXssFilter : true,		// client-side xss filter 무시 여부 (true:사용하지 않음 / 그외:사용)
//aAdditionalFontList : [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]],	// 추가 글꼴 목록
fOnBeforeUnload : function(){
//예제 코드
//return "내용이 변경되었습니다.";
}
});

oEditor.run({
fnOnAppReady: function(){
//예제 코드
//oEditor.exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
}
});

function pasteHTML() {
var sHTML = "<span style='color:#FF0000;'>이미지도 같은 방식으로 삽입합니다.<\/span>";
oEditor.exec("PASTE_HTML", [sHTML]);
}

function showHTML() {
var sHTML = oEditor.getIR();
alert(sHTML);
}

function submitContents() {
oEditor.exec("UPDATE_CONTENTS_FIELD");	// 에디터의 내용이 textarea에 적용됩니다.

// 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.
jindo.$("weditor").form.submit();
}

function setDefaultFont() {
var sDefaultFont = '궁서';
var nFontSize = 24;
oEditor.setDefaultFont(sDefaultFont, nFontSize);
}
}
</script>
<!--Example End-->
