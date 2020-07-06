<!DOCTYPE html>
{{-- 관리자 페이지에서 사업자등록증이 보여지는 페이지 -- 박소현 --}}
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
</head>

<body>
  @foreach ($seller as $sel)
    <form action="/ad_confirm{{$sel->st_no}}" method="post">
      @csrf
      <img class="img" id="reimg" src="/imglib/{{$sel->registration_img}}" alt="내가 올린 상품 사진">
      @if($sel->registration_status == '미승인')
      <input class="ad_bt" type="button" value="취소" onclick="self.close();" />
      <input class="ad_bt" id="sub" type='submit' value="확인">
    @else
      <input class="ad_bt" type="button" value="닫기" onclick="self.close();" />
    @endif
    </form>
  @endforeach

  <script type="text/javascript">


  </script>



</script>
</body>
</html>
