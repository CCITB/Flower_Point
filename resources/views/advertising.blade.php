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
        <img class="ad_img" src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcSaMR6IG-DroFbYHEuvqh95XDDU903t3tjHGgPwzG8oPNMugR9D&usqp=CAU" >
        <div class="text">전문인재, 바른인재, 창의인재로의 학생성장을 지향하는 중부대학교!</div>
      </div>

      <div class="mySlides fade">
        <div class="numbertext">2 / 3</div>
        <img class="ad_img" src="https://www.thechristy.com/wp-content/uploads/2014/09/The-Christy-logo-300x100.png" >
        <div class="text"></div>
      </div>

      <div class="mySlides fade">
        <div class="numbertext">3 / 3</div>
        <img class="ad_img" src="https://www.paxetv.com/news/thumbnail/202001/85227_56981_1928_v150.jpg">
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
