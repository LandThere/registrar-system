<?php

session_set_cookie_params(0);
session_start();
@include '../config.php';
@include '../inactivity.php';
@include 'auth.php';
?>
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
<body>
<section class="dashboard">
<div class="top">
            <i class="bi bi-list sidebar-toggle"></i>
            
        </div>
        <div class="dash-content">
            <div class="overview">
                <div class="title">
                <i class="bi bi-person-workspace"></i>
                    <span class="text">ABOUT DEVELOPERS</span>
                </div>
                </div>
        </div>

  <section class="swiper mySwiper">
    
    
    <div class="swiper-wrapper">

    <div class="card swiper-slide">
        <div class="card__image">
          <img src="../lib/img/male.jpg" alt="card image">
        </div>

        <div class="card__content">
          <span class="card__title">Jason Catadman</span>
          <span class="card__name">Subject Teacher</span>
          <p class="card__text"><b>SUBJECT:</b><br> Software Engineering</p>
          
        </div>
      </div>

      <div class="card swiper-slide">
        <div class="card__image">
          <img src="../lib/img/female.jpg" alt="card image">
        </div>

        <div class="card__content">
          <span class="card__title">Pauleen Gregana</span>
          <span class="card__name">Class Adviser</span>
          <p class="card__text">I.T Elective 3 Subject Teacher for 3rd year BS Information Technology.</p>
          
        </div>
      </div>

      <div class="card swiper-slide">
        <div class="card__image">
          <img src="../lib/img/shy.jpg" alt="card image">
        </div>

        <div class="card__content">
          <span class="card__title">Shyniemar Hassan</span>
          <span class="card__name">Project Manager</span>
          <p class="card__text">She managed to maintain open communication with all stakeholders, provide updates and address any concerns, manage risks, ensure quality deliverables, and closing out the project successfully.  </p>
          
        </div>
      </div>
      <div class="card swiper-slide">
        <div class="card__image">
          <img src="../lib/img/lander.jpg" alt="card image">
        </div>

        <div class="card__content">
          <span class="card__title">Lander Gucela</span>
          <span class="card__name">Backend Developer</span>
          <p class="card__text">Who was responsible for developing the server-side infrastructure that enables the front-end to deliver seamless user experience for the Registrar Archiving and Document Management System. </p>
        </div>
      </div>
      <div class="card swiper-slide">
        <div class="card__image">
          <img src="../lib/img/leo.jpg" alt="card image">
        </div>

        <div class="card__content">
          <span class="card__title">Leo Tulabing</span>
          <span class="card__name">Frontend Developer</span>
          <p class="card__text">Who focuses on making the application visually appealing, intuitive, and responsive. Develop the user interface by using his skills in programming languages such as HTML, CSS, and JavaScript.</p>
        </div>
      </div>
      <div class="card swiper-slide">
        <div class="card__image">
          <img src="../lib/img/margo.jpg" alt="card image">
        </div>

        <div class="card__content">
          <span class="card__title">Margo Mapasi</span>
          <span class="card__name">UI/UX Designer</span>
          <p class="card__text">She ensures that the Registrar Archiving and Management System is designed with the user's needs in mind.</p>
        </div>
      </div>

      <div class="card swiper-slide">
        <div class="card__image">
          <img src="../lib/img/cristian.jpg" alt="card image">
        </div>

        <div class="card__content">
          <span class="card__title">Cristian Jay Caasi</span>
          <span class="card__name">QA Engineer</span>
          <p class="card__text">He managed to ensure that the System is tested thoroughly and meets the project requirements.</p>
        </div>
      </div>

      <div class="card swiper-slide">
        <div class="card__image">
          <img src="../lib/img/joshua.jpg" alt="card image">
        </div>

        <div class="card__content">
          <span class="card__title">Joshua Villamin</span>
          <span class="card__name">Business Analyst</span>
          <p class="card__text">He was able to attend consultations with both clients and the team’s subject teacher. </p>

        </div>
      </div>

      <div class="card swiper-slide">
        <div class="card__image">
          <img src="../lib/img/kyla.jpg" alt="card image">
        </div>

        <div class="card__content">
          <span class="card__title">Kyla Malagueña</span>
          <span class="card__name">Assistant Manager</span>
          <p class="card__text">She supports the Project Manager and the whole team, and was able to catch up on consultations, other team meetings.</p>
        </div>
      </div>

    </div>
  </section>
  </section>
  <script src="../lib/JS/script.js"></script>
    <script src="../lib/JS/hakdok.js"></script>

<!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".mySwiper", {
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      coverflowEffect: {
        rotate: 0,
        stretch: 0,
        depth: 300,
        modifier: 1,
        slideShadows: false,
      },
      pagination: {
        el: ".swiper-pagination",
      },
    });
  </script>

</body>
</html>