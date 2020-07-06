<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
    <link rel="stylesheet" href="/css/image.css">
  <body>
          @foreach ($data as $data1)
    <form action="{{url('image')}}" method="post" id="send-text" name="index" accept-charset="utf-8" enctype="multipart/form-data" onsubmit="return postcheck();">
      @csrf
    <div class="preview-wrap">
      <div class="preview-left">
        <div class="preview">
          <img src="imglib/{{$data1->st_img}}" onerror="this.src='imglib/image.png'" id="image-session">
          <div class="preview-image">
            <!-- 이미지 미리보기 -->
          </div>
        </div>
      </div>
      <div class="preview-right">
        <div class="image-upload">
          <label for="real-input">사진 업로드</label>
        </div>
      </div>
    </div>
  @endforeach
<input type="file" onchange="checkFile(this);" id="real-input" name="picture" class="image_inputType_file" accept="image/*">
<div class="postbutton">
  <input type="submit" name="" value="저장" id="save" >
  <input type="submit" value="창닫기"  id="close" onclick="window.close()">
</div>


</form>
</body>
<script type="text/javascript">
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
  function check(){
    if($('#registration').val()==""){
      $('#registration').focus();
      alert('사진을 업로드 해주세요');
      return false;
    }
  }
</script>
<script src="https://code.jquery.com/jquery-2.2.1.js"></script>
</html>
