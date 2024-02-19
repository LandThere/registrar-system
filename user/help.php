<?php

session_set_cookie_params(0);
session_start();
@include '../config.php';
@include '../inactivity.php';
@include 'auth.php';
?>
<!DOCTYPE html>
<html lang="en">


<?php include 'includes/header.php'?>

<style>
body {
  background-color: white;
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
        <div class="container" style="display: flex; justify-content: space-between;">
        <div class="title" style="text-decoration: none; color: black;">
        <i class="bi bi-question-square-fill"></i>
      <span class="text">Help</span>
  </div>
</div>


<h1 class="text1" style="text-align: center;">System Manual</h1>
<br>
<object data="../lib/USERMANUAL.pdf" type="application/pdf" width="100%" height="800px">
</section>



    <script src="../lib/JS/script.js"></script>

</body>

</html>