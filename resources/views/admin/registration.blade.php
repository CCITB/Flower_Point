<!DOCTYPE html>
{{-- 관리자 페이지에서 사업자등록증이 보여지는 페이지 -- 박소현 --}}
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
</head>

<body>
  @foreach ($seller as $sel)
    <form action="/ad_confirm{{$sel->s_no}}" method="post">
      @csrf
      @if(isset($sel->registration_img))
        <img class="img" id="reimg" src="/imglib/{{$sel->registration_img}}">
        @if($sel->registeration_status == '미승인')
          <input class="ad_bt" type="button" value="취소" onclick="self.close();" />
          <input class="ad_bt" id="sub" type='submit' value="확인">
        @else
          <input class="ad_bt" type="button" value="닫기" onclick="self.close();" />
        @endif
      @else
        등록된 사업자등록증이 없습니다.
        <input class="ad_bt" type="button" value="닫기" onclick="self.close();" />
      @endif

      {{-- @else
        등록된 사업자등록증이 없습니다.
      @endif
      @if($sel->registration_status == '미승인')
        <input class="ad_bt" type="button" value="취소" onclick="self.close();" />
        <input class="ad_bt" id="sub" type='submit' value="확인">
      @else
        <input class="ad_bt" type="button" value="닫기" onclick="self.close();" />
      @endif --}}








    </form>
  @endforeach

  <script type="text/javascript">


  </script>



</script>
</body>
</html>
