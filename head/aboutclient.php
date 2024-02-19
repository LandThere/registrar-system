<!DOCTYPE html>
<html lang="en">

<?php include 'includes/about.php'?>

<style>
body {
  background-image: url('../lib/img/bg.png');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}
</style>

<section class="dashboard">
<div class="top">
            <i class="bi bi-list sidebar-toggle"></i>
            
        </div>
        <div class="dash-content">
            <div class="overview">
                <div class="title">
                <i class="bi bi-person-lines-fill"></i>
                    <span class="text">About Client</span>
                </div>
                <section class="about-us">
                <div class="slider-container">

<div class="slides fade">
    <div class="slider-numbers">1/3</div>
    <div class="slider-image"><img src="../lib/img/reg.jpg" alt="background_1"></div>
    <div class="slider-caption">WMSU Registrar's Office</div>
</div> <!-- slider -->

<div class="slides fade">
    <div class="slider-numbers">2/3</div>
    <div class="slider-image"><img src="../lib/img/client.jpg" alt="background_2"></div>
    <div class="slider-caption">First Meeting/Consultation</div>
</div> <!-- slider -->

<div class="slides fade">
    <div class="slider-numbers">3/3</div>
    <div class="slider-image"><img src="../lib/img/client2.jpg" alt="background_3"></div>
    <div class="slider-caption">Caption 3</div>
</div> <!-- slider -->

<!-- Slider Next and Previous buttons -->
<a class="prev" onclick="plusIndex(-1)">❮</a>
<a class="next" onclick="plusIndex(+1)">❯</a>

<!-- Slider Selection Bullets -->
<div class="slider-bullets" id="slider-bullets">
    <span class="dots" onclick="currentSlide(1)"></span>
    <span class="dots" onclick="currentSlide(2)"></span>
    <span class="dots" onclick="currentSlide(3)"></span>
</div> <!-- Slider Bullets -->

</div>
<div class="text">
    <p>The company’s client name is Ms. Myra Abduhari, 27 years of age. She graduated from Western Mindanao State University in 2016 with a degree of Bachelor of Science in Computer Science, major in Information Technology. 
In the year 2017–2019, she worked as technical staff at MISTO in Zamboanga City, and starting from 2019 to present, since she’s a Bachelor of Science in Computer Science graduate student, she was hired to work at the registrar’s office of the school where she was graduated from as a head administrator. She’s a record keeper, who manage to keep important documents of students enrolled at Western Mindanao State University</p>
    </div>
    </div>
</section>

</div>


</section>
<script>
    var slideIndex = 1;

function showImage(n) { // for Display the first Image
    
    'use strict';
    
    var slide = document.getElementsByClassName('slides'),
        
        dots = document.getElementsByClassName('dots'),
        
        i;
    
    if (n > slide.length) { // to prevent larger values than the slide length
        
        slideIndex = 1;
    }
    
    if (n < 1) { // to avoide negative values
        
        slideIndex = slide.length;
    }
    
    for (i = 0; i < slide.length; i++) { // to make other images dispaly: none
        
        slide[i].style.display = 'none';
    }
    slide[slideIndex - 1].style.display = 'block';
    
    for (i = 0; i < dots.length; i++) { // to remove the active class from other dots
        
        dots[i].className = dots[i].className.replace(' active', '');
    }
    
    dots[slideIndex - 1].className += ' active';
}

showImage(slideIndex);

function plusIndex(n) { // for Next & Prev Actions
    
    'use strict';
    
    showImage(slideIndex += n);
}

function currentSlide(n) { // for Slide Bullets Selection
    
    'use strict';
    
    showImage(slideIndex = n);
}
</script>
    <script src="../lib/JS/script.js"></script>
    <script src="../lib/JS/hakdok.js"></script>


</body>

</html>