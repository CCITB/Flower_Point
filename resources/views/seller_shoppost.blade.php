<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="Content-Script-Type" content="text/javascript">
  <meta http-equiv="Content-Style-Type" content="text/css">
  <title></title>
  <link rel="stylesheet" href="/css/header.css">
  <script type="text/javascript" src="/js/service/HuskyEZCreator.js" charset="utf-8"></script>

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
    <textarea name="ir1" id="weditor" rows="10" cols="100">에디터에 기본으로 삽입할 글(수정 모드)이 없다면 이 value 값을 지정하지 않으시면 됩니다.</textarea>
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

</script>
