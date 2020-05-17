<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="Content-Script-Type" content="text/javascript">
  <meta http-equiv="Content-Style-Type" content="text/css">
  <title></title>
  <link rel="stylesheet" href="/css/header.css">
  <script type="text/javascript" src="/js/service/HuskyEZCreator.js" charset="utf-8"></script>

  <style media="screen">
table{
  border: 2px solid pink;
  margin: 0 auto;
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
      <div class="" style="">
        <input type="text" name="" value=""placeholder="상품명..." style="width:742px;">
      </div>

      <form action="sample/viewer/index.php" method="post">
        <textarea name="ir1" id="weditor" rows="10" cols="100">에디터에 기본으로 삽입할 글(수정 모드)이 없다면 이 value 값을 지정하지 않으시면 됩니다.</textarea>
        사진 업로드 들어가야하는 공간
      </form>
    </div>
    <table>

      <tr>
        <td>배송비<input type="text" name="" value="" placeholder="0원" style="text-align:right;"></td>
      </tr>
      <tr>
        <td>판매금액<input type="text" name="" value=""placeholder="0원"style="text-align:right;"></td>
      </tr>
      <tr>
        <td>적립금<input type="text" name="" value=""></td>
      </tr>
    </table>
    <button type="button" name="button">저장</button>
    <button type="button" name="button">취소</button>
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

</script>
<script type="text/javascript">
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
