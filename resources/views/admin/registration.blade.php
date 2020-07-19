<!DOCTYPE html>
{{-- 관리자 페이지에서 사업자등록증이 보여지는 페이지 -- 박소현 --}}
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>꽃갈피 관리자</title>
  <link rel="stylesheet" href="/css/ad_coupon.css">
</head>

<body>
  @foreach ($seller as $sel)
    <form action="/ad_confirm{{$sel->st_no}}" method="post">
      @csrf
      @if(isset($sel->registration_img))
        <div class="imgdiv">
          <img class="img" id="reimg" src="/imglib/{{$sel->registration_img}}">
        </div>
        @if($sel->s_approval == '미승인')
          <div class="but">
            <input class="ad_bt" type="button" value="취소" onclick="self.close();" />
            <input class="ad_bt" id="sub" type='submit' value="확인">
          </div>
        @else
          <div class="but">
            <input class="ad_bt" type="button" value="닫기" onclick="self.close();" />
          </div>
        @endif
      @else
        <div class="null">등록된 사업자등록증이 없습니다.</div>
        <div class="but">
          <input class="ad_bt" type="button" value="닫기" onclick="self.close();" />
        </div>
      @endif
    </form>
  @endforeach

  <script type="text/javascript">


  </script>



</script>
</body>
</html>
