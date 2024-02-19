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
$select = "SELECT * FROM `college` WHERE id = $id";
$result = mysqli_query($conn, $select);
$row = mysqli_fetch_assoc($result);
$id = $row['id'];
$code = $row['code'];
$college_name = $row['college_name'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>EDIT COLLEGE</title>
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
   <h4 style="text-align: left">College Code:</h4>
    <input type="text" name="code" required placeholder="Enter College Code" maxlength="60" value=<?php echo $code?>>
    <br>
   <h4 style="text-align: left">College Name:</h4>
    <input type="text" name="college_name" placeholder="Enter College Name" maxlength="70" value=<?php echo $college_name?>>
    <br>
      <input type="submit" name="submit" value="Save" class="form-btn">
      <a href="javascript:history.back()"><input type="button" value="Back" class="form-btn"></input></a>
   </form>

</div>

<?php
$error = []; // Initialize an empty array to store validation errors

if (isset($_POST['submit'])) {
    $id = $_GET['updatesid'];
    $code = $_POST['code'];
    $college_name = $_POST['college_name'];

    // Validate form inputs

    if (empty($code)) {
        $error[] = "Code is required.";
    } elseif (!preg_match('/^[a-zA-Z0-9]+$/', $code)) {
        $error[] = "Code should only contain alphanumeric characters.";
    }

    if (empty($college_name)) {
        $error[] = "College name is required.";
    } // Add any additional validation rules for college name here

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

    $updateQuery = "UPDATE `college`
                    SET id = $id, code = '$code', college_name = '$college_name'
                    WHERE id = '$id'";

    $result = mysqli_query($conn, $updateQuery);
    if ($result) {
        header('location:college.php');
        exit(); // Terminate the script after redirection
    } else {
        die("Connection failed: " . $conn->connect_error);
    }
}
?>

</body>
</html>