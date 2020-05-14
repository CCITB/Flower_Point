<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>꽃갈피</title>
<link rel="stylesheet" href="/css/header.css">
  </head>
  <body>
@include('header')
        <div class="menu4"><!--탑헤더 밑-->
            <h3>내 주변 꽃집</h3>
            <hr align="left" class="one">
            </hr>
            <select id="input" onchange="random_function()">
       <option>지역선택</option>
       <option>서울</option>
       <option>부산</option>
   </select>
   <div>
      <select id="output" onchange="random_function1()">
      </select>
   </div>

        <div class="menu5">
            <div class="shopname">
                <h3>ccit3</h3>
                <p>서울시 종로구 익선동</p>
                <hr align="left" class="one">
                </hr>
            </div>
            <div class="shopimg">
                <img src="img/dummy.png">
            </div>
            <div class="shopname">
                <h3>ccit2</h3>
                <p>서울시 종로구</p>
                <hr align="left" class="one">
                </hr>
            </div>
            <div class="shopname">
                <h3>ccit1</h3>
                <p>서울시 종로구~~~</p>
                <hr align="left" class="one">
                </hr>
            </div>
        </div>
    </div>
    @include('footer')
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    function random_function()
    {
        var a=document.getElementById("input").value;
        if(a==="서울")
        {
            var arr=["서대문구","종로구"];
        }
        else if(a==="부산")
        {
            var arr=["해운대구","서구","동구"];
        }

        var string="";

        for(i=0;i<arr.length;i++)
        {
            string=string+"<option value="+arr[i]+">"+arr[i]+"</option>";
        }
        document.getElementById("output").innerHTML=string;
    }
</script>
