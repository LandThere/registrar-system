<?php

session_set_cookie_params(0);
session_start();
@include '../config.php';
@include '../inactivity.php';
@include 'auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ADD COLLEGE</title>
   <link rel="icon" href="../lib/img/reg.png">

   <link href="../lib/CSS/container.css" rel="stylesheet">

</head>
<style>
body {
  background-image: url('../lib/img/bg.png');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}
</style>
<body>
   
<div class="form-container">



    <form method="POST" action="">
    <img src="../lib/img/reg.png" width="150px" height="150px">
   <h3 style="color: red;"> REGISTRAR ARCHIVING</h3>
   <h4 style="text-align: left">College Code:</h4>
    <input type="text" name="code" required placeholder="Enter College Code" maxlength="60"><br>
    <h4 style="text-align: left">College Name:</h4>
    <input type="text" name="college_name" required placeholder="Enter College Name" maxlength="70"><br>
    <input type="submit" name="submit" value="Add College " class="form-btn">
    <a href="javascript:history.back()"><input type="button" value="Back" class="form-btn"></input></a>
    </form>
    <?php
// check if the form has been submitted
if (isset($_POST['submit'])) {

    // validate the input
    $code = mysqli_real_escape_string($conn, $_POST['code']);
    $college_name = mysqli_real_escape_string($conn, $_POST['college_name']);

    // check if the inputs are not empty
    if (!empty($code) && !empty($college_name)) {

        // insert the data into the database
        $select = "INSERT INTO college ( code,college_name) VALUES ('$code', '$college_name')";
        mysqli_query($conn, $select);
        echo '<script src="../lib/JS/sweetalert.min.js"></script>';
        echo "<script>";
        echo "swal({ 
                title: 'Success!', 
                text: 'College added successfully.', 
                icon: 'success' 
            }).then(function() {
                window.location = 'college.php';
            });";
        echo "</script>";
        exit();

    } else {
        // inputs are empty, display an error message and redirect back to the form page
        echo '<script src="../lib/JS/sweetalert.min.js"></script>';
        echo "<script>";
        echo "swal({ 
                title: 'Error!', 
                text: 'Please enter all required fields.', 
                icon: 'error' 
            }).then(function() {
                window.location = 'addcollege.php';
            });";
        echo "</script>";
        exit();
    }

}

$conn->close();

?>


</div>

</body>
</html>