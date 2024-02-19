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
   <title>ADD COURSE</title>
   <link rel="icon" href="../lib/img/reg.png">
   <script src="../lib/JS/sweetalert.min.js"></script>
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
    <h4 style="text-align: left">College Name:</h4>
    <?php
$select = "SELECT id, code, college_name FROM college";
$result = $conn->query($select);

if ($result->num_rows > 0) {
    echo '<select name="college" onchange="updateCourseId(this.value)">';
    echo '<option value="" selected disabled>Choose College</option>'; // Added line
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row["id"] . '">' . $row["college_name"] . '</option>';
    }
    echo '</select>';
    echo '<br>';
} else {
    echo "No results found";
}

echo '<input type="hidden" name="course_id" id="courseId">';
?>

    <h4 style="text-align: left">Course Name:</h4>
    <input type="text" name="course_name" required placeholder="Enter Course Name" maxlength="50"><br>
    <h4 style="text-align: left">Major:</h4>
    <input type="text" name="major" placeholder="Enter Major" maxlength="30">
    <h4 style="text-align: left">Description:</h4>
    <input type="text" name="description" required placeholder="Enter Description" maxlength="60"><br>
    <input type="submit" name="submit" value="Add Course " class="form-btn">
    <a href="javascript:history.back()"><input type="button" value="Back" class="form-btn"></input></a>
    </form>
    <?php

if (isset($_POST['submit'])) { // check if form has been submitted

    $course_name = mysqli_real_escape_string($conn, $_POST['course_name']);
    $major = isset($_POST['major']) ? mysqli_real_escape_string($conn, $_POST['major']) : '';
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $course_id = mysqli_real_escape_string($conn, $_POST['course_id']);

    $errors = []; // Initialize an empty array to store validation errors

    // Perform form validation

    if (empty($course_name)) {
        $errors[] = "Course name is required.";
    }

    if (empty($description)) {
        $errors[] = "Description is required.";
    }

    if (empty($course_id)) {
        $errors[] = "Course ID is required.";
    }

    // If there are validation errors, display the error message using SweetAlert

    if (!empty($errors)) {
        echo '<script src="../lib/JS/sweetalert.min.js"></script>';
        echo '<script>';
        echo "swal({
                title: 'Error!',
                text: 'Please fix the following errors:\\n";
        foreach ($errors as $errorMessage) {
            echo "- " . $errorMessage . "\\n";
        }
        echo "',
                icon: 'error'
            }).then(function() {
                window.history.back();
            });";
        echo '</script>';
        exit();
    }

    // If there are no validation errors, proceed with inserting the data

    $insert = "INSERT INTO course (course_name, major, description, course_id) VALUES ('$course_name', '$major', '$description', '$course_id')";
    mysqli_query($conn, $insert);

    echo '<script src="../lib/JS/sweetalert.min.js"></script>';
    echo "<script>";
    echo "swal({
            title: 'Success!',
            text: 'Course added successfully.',
            icon: 'success'
        }).then(function() {
            window.location = 'course.php';
        });";
    echo "</script>";
    exit();
}

$conn->close();

?>



</div>
</body>
<script>
function updateCourseId(collegeId) {
    document.getElementById("courseId").value = collegeId;
}
</script>
</html>