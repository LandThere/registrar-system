<?php

session_set_cookie_params(0);
session_start();
@include '../config.php';
@include '../inactivity.php';
@include 'auth.php';
?>
<?php
include '../config.php';
$id = $_GET['updatesid'];
$select = "SELECT * FROM `course` WHERE id = $id";
$result = mysqli_query($conn, $select);
$row = mysqli_fetch_assoc($result);
$id = $row['id'];
$course_name = $row['course_name'];
$major = $row['major'];
$description = $row['description'];
?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>EDIT COURSE</title>
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

<form action="" method="post">
   <img src="../lib/img/reg.png" width="120px" height="120px">
   <h3 style="color: red;"> REGISTRAR ARCHIVING</h3>
      <h4 style="text-align: left">Course Name:</h4>
    <input type="text" name="course_name" required placeholder="Enter Course Name" maxlength="60" value=<?php echo $course_name?>>
    <br>
    <h4 style="text-align: left">Major:</h4>
    <input type="text" name="major" placeholder="Enter Major" maxlength="60" value=<?php echo $major?>>
    <br>
    <h4 style="text-align: left">Description:</h4>
    <input type="text" name="description" required placeholder="Enter Description" maxlength="60" value=<?php echo $description?>>
    <br>
      <input type="submit" name="submit" value="Save " class="form-btn">
      <a href="javascript:history.back()"><input type="button" value="Back" class="form-btn"></input></a>
   </form>

</div>

<?php
$error = []; // Initialize an empty array to store validation errors

if (isset($_POST['submit'])) {
    $id = $_GET['updatesid'];
    $course_name = $_POST['course_name'];
    $major = $_POST['major'];
    $description = $_POST['description'];

    // Validate form inputs

    if (empty($course_name)) {
        $error[] = "Course name is required.";
    } // Add any additional validation rules for course name here

    // Validate description
    if (empty($description)) {
        $error[] = "Description is required.";
    } // Add any additional validation rules for description here

    // If there are any errors, display them and exit
    if (!empty($error)) {
        echo '<script src="../lib/JS/sweetalert.min.js"></script>'; // Make sure the path to the SweetAlert library is correct
        echo "<script>";
        echo "swal({ 
                title: 'Error!', 
                text: 'Please fix the following errors:\\n";
        foreach ($error as $errorMsg) {
            echo "- " . $errorMsg . "\\n";
        }
        echo "', 
                icon: 'error' 
            }).then(function() {
                window.history.back();
            });";
        echo "</script>";
        exit();
    }

    $updateQuery = "UPDATE `course`
                    SET id = $id, course_name = '$course_name', major = '$major', description = '$description'
                    WHERE id = '$id'";

    $result = mysqli_query($conn, $updateQuery);
    if ($result) {
        header('location:course.php');
        exit(); // Terminate the script after redirection
    } else {
        die("Connection failed: " . $conn->connect_error);
    }
}
?>

</body>
</html>