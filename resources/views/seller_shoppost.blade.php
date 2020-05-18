<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="Content-Script-Type" content="text/javascript">
  <meta http-equiv="Content-Style-Type" content="text/css">
  <title></title>
  <link rel="stylesheet" href="/css/header.css">
  <script>
  // const browseBtn = document.querySelector('.browse-btn');
  const realInput = document.querySelector('#real-input');

  browseBtn.addEventListener('click',()=>{
    realInput.click();
  });
  </script>

  <script type="text/javascript" src="/js/service/HuskyEZCreator.js" charset="utf-8"></script>
  <script src="https://code.jquery.com/jquery-2.2.1.js"></script>

  <style media="screen">
  table{
    border: 2px solid pink;
    margin: 0 auto;

  }
  .post-title{
    width: 680px;
  }
  th{

  }
  .send-btn{
    cursor: pointer;
  }
  .Cancellation-btn{
    cursor: pointer;
  }
  /* .filebox label {
  display: inline-block;
  padding: .5em .75em;
  color: #fff;
  font-size: inherit;
  line-height: normal;
  vertical-align: middle;
  background-color: #5cb85c;
  cursor: pointer;
  border: 1px solid #4cae4c;
  border-radius: .25em;
  -webkit-transition: background-color 0.2s;
  transition: background-color 0.2s;
}

.filebox label:hover {
background-color: #6ed36e;
}

.filebox label:active {
background-color: #367c36;
}

.filebox input[type="file"] {
position: absolute;
width: 1px;
height: 1px;
padding: 0;
margin: -1px;
overflow: hidden;
clip: rect(0, 0, 0, 0);
border: 0;
} */
#preview img{
  width: 200px;
  height: 200px;
}

</style>
</head>
<body>
  @include('header')
  <div class="hr-line">
    <div id="line">
      <h2>물품등록</h2>
      <hr>
    </div>
  </div>
  <div class="post">
    <div id="se2_sample" style="margin:10px 0;">
      <input type="button" onclick="pasteHTML();" value="본문에 내용 넣기" />
      <input type="button" onclick="showHTML();" value="본문 내용 가져오기" />
      <input type="button" onclick="submitContents();" value="서버로 내용 전송" />
      <input type="button" onclick="setDefaultFont();" value="기본 폰트 지정하기 (궁서_24)" />


      <form action="{{url('index')}}" method="post" id="send-text" name="index" accept-charset="utf-8">
        @csrf
        <div class="" style="">
          <table>
            <tr>
              <th>상품명</th>
              <td>
                <input type="text" name="productname" value=""placeholder="상품명..." class="post-title">
              </td>
            </tr>
          </table>
          <textarea name="ir1" id="weditor" rows="10" cols="100"> 텍스트를 적으시지 않으면 기본값으로 출력됩니다.</textarea>

          <div class="filebox">
            <label for="real-input">사진 업로드</label>
            <input type="file" onchange=" chk_file_type(this); checkFile(this); readURL();" id="real-input" name="picture" class="image_inputType_file" accept="image/*" required multiple>
            <div id="preview">
              <img src="#" alt="??" id="image-session">
              사진공간

            </div>
            <!-- <button class="browse-btn">사진업로드</button> -->
          </div>

          <table>
            <tr>
              <th>배송비</th>
              <td><input type="text"numberonly="true" name="deliverycharge" value="" placeholder="0" style="text-align:right;">원</td>
            </tr>
            <tr>
              <th>판매금액</th>
              <td><input type="text" name="sellingprice" value=""placeholder="0"style="text-align:right;"numberonly="true">원</td>
            </tr>
            <tr>
              <th>적립금</th>
              <td><input type="text"numberonly="true" name="" value="">원</td>
            </tr>
          </table>
        </div>
        <input type="submit" name="" value="저장" id="save">
        <!-- <button type="submit" name="button" class="send-btn" id="submitBoardBtn" form="send-text">저장</button> -->
        <button type="button" name="button" class="Cancellation-btn">취소</button>
      </form>
    </div>

  </div>

  <style media="screen">
  .post{
    border: 5px solid pink;
    width: 1130px;
    margin: 0 auto;
    padding: 0 30px;
    text-align: center;
  }
  </style>
  @include('footer')
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
$("#send-text").submit(); }) //?? 이코드 뭐냐;;//





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
<script>
// function setThumbnail(event) {
//   for
//   (var image of event.target.files) {
//     var reader = new FileReader();
//     reader.onload = function(event) { var img = document.createElement("img"); img.setAttribute("src", event.target.result); document.querySelector("#preview").appendChild(img); };
//     console.log(image); reader.readAsDataURL(image); } }
    // 파일용량제한 스크립트
    function checkFile(el){

    	// files 로 해당 파일 정보 얻기.
    	var file = el.files;

    	// file[0].size 는 파일 용량 정보입니다.
    	if(file[0].size > 1024 * 1024 * 2){
    		// 용량 초과시 경고후 해당 파일의 용량도 보여줌
    		alert('2MB 이하 파일만 등록할 수 있습니다.\n\n' + '현재파일 용량 : ' + (Math.round(file[0].size / 1024 / 1024 * 100) / 100) + 'MB');
    	}
    	// 체크를 통과했다면 종료.
    	else return;
    	// 체크에 걸리면 선택된 내용 취소 처리를 해야함.
    	// 파일선택 폼의 내용은 스크립트로 컨트롤 할 수 없습니다.
    	// 그래서 그냥 새로 폼을 새로 써주는 방식으로 초기화 합니다.
    	// 이렇게 하면 간단 !?
    	el.outerHTML = el.outerHTML;
    }
    function chk_file_type(obj) {
	var file_kind = obj.value.lastIndexOf('.');
	var file_name = obj.value.substring(file_kind+1,obj.length);
	var file_type = file_name.toLowerCase();
	var check_file_type=new Array();
	check_file_type=['jpg','gif','png','jpeg','bmp','tif'];
	if(check_file_type.indexOf(file_type)==-1) {
		alert('이미지 파일만 업로드 가능합니다.');
		var parent_Obj=obj.parentNode;
		var node=parent_Obj.replaceChild(obj.cloneNode(true),obj);
		document.getElementById("wfb-field-219958876").value = "";    //초기화를 위한 추가 코드
		document.getElementById("wfb-field-219958876").select();        //초기화를 위한 추가 코드
		document.selection.clear();                                                //일부 브라우저 미지원
		return false;
	}
}
// 사진을 올릴때마다 파일을 새로 변경시켜주는 함수입니다.
function readURL(input) {
 if (input.files && input.files[0]) {
  var reader = new FileReader();

  reader.onload = function (e) {
   $('#image-session').attr('src', e.target.result);
  }

  reader.readAsDataURL(input.files[0]);
  }
}

$("#real-input").change(function(){
   readURL(this);
});
  </script>
  <script>
  $(document).on("keyup", "input:text[numberonly]", function() {
      $(this).val( $(this).val().replace(/[^0-9]/gi,"") );
  });
  </script>
