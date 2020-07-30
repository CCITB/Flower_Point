<!DOCTYPE html>  <!--박소현 -->
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="/css/adver.css">
</head>
<body>

  <div class="slideshow-container">
    <div class="slides">
      <div class="mySlides fade">
        <div class="numbertext">1 / 3</div>
        <a href="http://ccit2020.cafe24.com:8080/"><img class="ad_img" src="/imglib/중고땅땅.png"></a>
        <div class="text"></div>
      </div>

      <div class="mySlides fade">
        <div class="numbertext">2 / 3</div>
        <img class="ad_img" src="/imglib/ccit.png" >
        <div class="text"></div>
      </div>

      <div class="mySlides fade">
        <div class="numbertext">3 / 3</div>
        <img class="ad_img" src="https://cdn.crowdpic.net/list-thumb/thumb_l_F8DAD781A80FA926DF5C7B86ADF0E0CF.jpeg">
        {{-- <img class="ad_img" src="http://placehold.it/300x100"> --}}
        <div class="text"></div>
      </div>
    </div> <br>
    {{-- <div class="dotss">
      <span class="dot"></span>
      <span class="dot"></span>
      <span class="dot"></span>
    </div> --}}
  </div>

</body>
<script>

var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  // var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  // for (i = 0; i < dots.length; i++) {
  //   dots[i].className = dots[i].className.replace(" active", "");
  // }
  slides[slideIndex-1].style.display = "block";
  // dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 2500); // Change image every 2 seconds
}

</script>
</html>
