<?php

session_set_cookie_params(0);
session_start();
@include '../config.php';
@include '../inactivity.php';
@include 'auth.php';
?>





<!DOCTYPE html>
<html lang="en">
<?php include 'includes/home.php'?>

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
                    <i class="bi bi-bar-chart-fill"></i>
                    <span class="text">Dashboard</span>
                </div>

                <div class="boxes">
                    <div class="box box1">
                    <i class="bi bi-person-check"></i>
                        <span class="text">Total Students</span>
                        <span class="number">
                        <?php
                        require '../config.php';

                        $select1 = "SELECT id from stdmain";
                        $select1_run = mysqli_query($conn, $select1);
                        $row1 = mysqli_num_rows($select1_run);

                        $select2 = "SELECT id from std_esu";
                        $select2_run = mysqli_query($conn, $select2);
                        $row2 = mysqli_num_rows($select2_run);

                        $total = $row1 + $row2;

                        echo " ".$total;
                        ?>
                        </span>
                    </div>
                    <div class="box box2">
                    <i class="bi bi-houses-fill"></i>
                        <span class="text">MAIN</span>
                        <span class="number">
                        <?php
                        require '../config.php';

                        $select = "SELECT id from stdmain ORDER BY id";
                        $select_run = mysqli_query($conn, $select);

                        $row = mysqli_num_rows($select_run);

                        echo ''.$row.'';
                        ?></span>
                    </div>
                    <div class="box box3">
                    <i class="bi bi-houses"></i>
                        <span class="text">E.S.U</span>
                        <span class="number">
                        <?php
                        require '../config.php';

                        $select = "SELECT id from std_esu ORDER BY id";
                        $select_run = mysqli_query($conn, $select);

                        $row = mysqli_num_rows($select_run);

                        echo ''.$row.'';
                        ?>
                        </span>
                    </div>
                </div>
            </div>
        

</section>
<script src="../lib/JS/script.js"></script>

</body>

</html>