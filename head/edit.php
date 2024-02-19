<?php

session_set_cookie_params(0);
session_start();
@include '../config.php';
@include '../inactivity.php';
@include 'auth.php';
?>
<?php
include '../config.php';
$id = $_GET['updateid'];
$select = "SELECT * FROM `users` WHERE id = $id";
$result = mysqli_query($conn, $select);
$row = mysqli_fetch_assoc($result);
$fname = $row['fname'];
$lname = $row['lname'];
$usertype = $row['usertype'];
$username = $row['username'];
$status = $row['status'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>EDIT USER</title>
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
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <h4 style="text-align: left">First Name:</h4>
      <input type="firstname" name="fname" required placeholder="Enter First Name" maxlength="25" value=<?php echo $fname?>> 
      <br>
      <h4 style="text-align: left">Last Name:</h4>
      <input type="lastname" name="lname" required placeholder="Enter Last Name" maxlength="25" value=<?php echo $lname?>>
      <br>
      <h4 style="text-align: left">User Type:</h4>
      <select name="usertype">
         <option value="User" <?php if ($usertype == 'User') echo 'selected'?>>User</option>
         <option value="Admin" <?php if ($usertype == 'Admin') echo 'selected'?>>Admin</option>
         <option value="HeadAdmin" <?php if ($usertype == 'HeadAdmin') echo 'selected'?>>HeadAdmin</option>
      </select>
      <br>
      <h4 style="text-align: left">Username:</h4>
      <input type="username" name="username" required placeholder="Enter Username" maxlength="25" value=<?php echo $username?>>
      <br>
      <h4 style="text-align: left">Status:</h4>
      <select name="status">
        <option value="Active" <?php if ($status == 'Active') echo 'selected'?>>Active</option>
        <option value="Inactive" <?php if ($status == 'Inactive') echo 'selected'?>>Inactive</option>
      </select>
      <h4 style="text-align: left">New Password:</h4>
      <input type="password" name="password" required placeholder="Password" maxlength="25">
      <h4 style="text-align: left">Confirm New Password:</h4>
      <input type="password" name="cpassword" required placeholder="Confirm Password" maxlength="25">
      <input type="submit" name="submit" value="Save " class="form-btn">
      <a href="javascript:history.back()"><input type="button" value="Back" class="form-btn"></input></a>
   </form>

</div>
<?php
$error = []; // Initialize an empty array to store validation errors

if (isset($_POST['submit'])) {
    $id = $_GET['updateid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $usertype = $_POST['usertype'];
    $username = $_POST['username'];
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $status = $_POST['status'];

    // Validate form inputs

    if (empty($fname)) {
        $error[] = "First name is required.";
    } elseif (!preg_match('/^[a-zA-Z\s]+$/', $fname)) {
        $error[] = "First name should only contain alphabetic characters and spaces.";
    }

    if (empty($lname)) {
        $error[] = "Last name is required.";
    } elseif (!preg_match('/^[a-zA-Z\s]+$/', $lname)) {
        $error[] = "Last name should only contain alphabetic characters and spaces.";
    }

    if (empty($usertype)) {
        $error[] = "User type is required.";
    }

    if (empty($username)) {
        $error[] = "Username is required.";
    }

    if (empty($_POST['password'])) {
        $error[] = "Password is required.";
    }

    if ($_POST['password'] !== $_POST['cpassword']) {
        $error[] = "Passwords do not match.";
    }

    if (empty($status)) {
        $error[] = "Status is required.";
    }

    // If there are any errors, display them and exit
    if (!empty($error)) {
      echo '<script src="../lib/JS/sweetalert.min.js"></script>';
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

    $updateQuery = "UPDATE `users`
                    SET id = $id, fname = '$fname', lname = '$lname', usertype = '$usertype',
                        username = '$username', status = '$status', password = '$pass'
                    WHERE id = '$id'";

    $result = mysqli_query($conn, $updateQuery);
    if ($result) {
        header('location:users.php');
        exit(); // Terminate the script after redirection
    } else {
        die("Connection failed: " . $conn->connect_error);
    }
}
?>

</body>
</html>