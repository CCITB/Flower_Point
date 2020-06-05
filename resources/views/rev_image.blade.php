<!DOCTYPE html> <!-- 박소현 -->
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>후기작성</title>
  <link rel="stylesheet" type="text/css" href="/css/buy_information.css">
  <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic+Coding&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@1,200&display=swap" rel="stylesheet">
</head>
<body>
  <div class="review_total">
    <div class="pd_info">
      <div class="rev_thumbnail">

      </div>
      <div class="rev_pd_name">

      </div>
    </div>
    <form name="file_up" action = '/review' onsubmit="return temporaryFileUpload(1)">
      <div class="file_upload">
        <input class="file_up" type="file" id="upImgFiles" onChange="uploadImgPreview(1);" accept="image/*" multiple>
      </div>
      <div class="thumimg" id="thumbnailImgs"></div>
    </form>


    <div class="under">
      <input class="rev_bt" type="button" value="취소" onclick="history.back()" />
      <input class="rev_bt" type='submit' value="확인">
    </div>
  </div>

  <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
  <script type="text/javascript">

  function uploadImgPreview() {
    // @breif 업로드 파일 읽기
    let fileList = document.getElementById( "upImgFiles" ).files;
    // @breif 업로드 파일 읽기

    function readAndPreview( fileList ) {
      // @breif 이미지 확장자 검사
      if ( /\.(jpe?g|png|gif|webp|bmp|tif)$/i.test( fileList.name ) == true ) {
        let reader = new FileReader();
        reader.addEventListener( "load", function() {
          let image = new Image();
          image.width = "150";
          image.height = "150";
          image.title = fileList.name;
          image.src = this.result;

          // @details 이미지 확장자 검사
          document.getElementById( "thumbnailImgs" ).appendChild( image );
        }, );

        // @details readAsDataURL( )을 통해 파일의 URL을 읽어온다.
        if( fileList ) {
          reader.readAsDataURL( fileList );
        }
      } else{
        alert('확장자 다름');
      }
    }
    if( fileList ) {
      // @details readAndPreview() 함수를 forEach문을통한 반복 수행
      [].forEach.call( fileList, readAndPreview );
    }
  }



  //이미지를 업로드 할 준비를 시작한다.
  function temporaryFileUpload(num) {

    // 이미지파일의 정보를 받을 배열을 선언한다.
    var tmpFile = new Object();
    tmpFile['file'] = new Array();     // tmpFile['file'] 파일의 정보를 담을 변수
    tmpFile['img'] = new Array();    // tmpFile['file'] 이미지의 경로를 담을 변수
    var tmpNum = 0;
    var addPlus = 0;

    // 먼저 업로드 된 파일의 존재 유무를 확인한다.
    if(jQuery(".temporaryFile").eq(num).val()) {

      // 파일이 존재하면 우선 기존 파일을 삭제한 이후에 작업을 진행한다.
      if(confirm("해당 이미지를 삭제 하시겠습니까?") == true) {

        // 먼저 업로드 하지 않을 파일을 제거한다.
        jQuery(".temporaryFile").eq(num).val("");

        // 파일이 제거되면 <input type="file"/>의 수만큼 반복문을 돌린다.
        jQuery(".temporaryFile").each(function(idx) {

          // 반복문을 돌리는 중에 <input type="file"/>의 값이 존재한는 순서로 배열에 담는다.
          if(jQuery(".temporaryFile").eq(idx).val()) {
            tmpFile['file'][tmpNum] = [jQuery(".temporaryFile").eq(idx).clone()];
            tmpFile['img'][tmpNum] = jQuery(".thumbnailImg").eq(idx).attr("src");
            tmpNum++;
          }
        });

        // 모든 썸네일 이미지 정보를 초기화 한다.
        jQuery(".temporaryFile").val("");
        jQuery(".thumbnailImg").attr("src", "./plusimg.png");
        jQuery(".thumbnailImg").css("display", "none");

        // 배열로 받은 파일의 정보를 바탕으로 순서를 재정렬한다.
        for(var key in tmpFile['file']) {
          jQuery(".temporaryFile").eq(key).replaceWith(tmpFile['file'][key][0].clone(true));
          jQuery(".thumbnailImg").eq(key).css("display", "inline");
          jQuery(".thumbnailImg").eq(key).attr("src", tmpFile['img'][key]);
          addPlus++;
        }

        if(addPlus < 5) {
          jQuery(".thumbnailImg").eq(addPlus).css("display", "inline");
        }

      } else {
        return false;
      }
    }

    // 파일이 존재하지 않다면 업로드를 시작한다.
    else {

      jQuery(".temporaryFile").eq(num).click();
    }
  }

  // 임시폴더에 파일을 업로드하고 그 경로를 받아온다.
  function temporaryFileTransmit(num) {
    var form = jQuery("#uploadFrom")[0];
    var formData = new FormData(form);
    formData.append("mode", "temporaryImageUpload");
    formData.append("tmpFile", jQuery(".temporaryFile").eq(num)[0].files[0]);

    // ajax로 파일을 업로드 한다.
    jQuery.ajax({
      url : "./upload_class.php"
      , type : "POST"
      , processData : false
      , contentType : false
      , data : formData
      , success:function(json) {
        var obj = JSON.parse(json);
        if(obj.ret == "succ") {

          // 업로드된 버튼을 임시폴더에 업로드된 경로의 이미지 파일로 교체한다.
          jQuery(".thumbnailImg").eq(num).attr("src", obj.img);

          // 업로드 버튼이 4개 이하인경우 업로드 버튼을 하나 생성한다.
          if(num < 5) {
            jQuery(".thumbnailImg").eq(++num).css("display", "inline");
          }

        } else {
          alert(obj.message);
          return false;
        }
      }
    });
  }

</script>
</body>
</html>
