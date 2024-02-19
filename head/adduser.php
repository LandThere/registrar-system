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
   <title>ADD USER</title>
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
   <img src="../lib/img/reg.png" width="150px" height="150px">
   <h3 style="color: red;"> REGISTRAR ARCHIVING</h3>
      <input type="username" name="username" required placeholder="Enter Username" maxlength="25">
      <input type="password" name="password" required placeholder="Enter Password" maxlength="25">
      <input type="password" name="cpassword" required placeholder="Enter Confirm Password" maxlength="25">
      <input type="firstname" name="fname" required placeholder="Enter First Name" maxlength="25">
      <input type="lastname" name="lname" required placeholder="Enter Last Name" maxlength="25">
      <select name="usertype">
         <option value="User">User</option>
         <option value="Admin">Admin</option>
         <option value="HeadAdmin">HeadAdmin</option>
      </select>
      <select name="status">
         <option value="Active">Active</option>
         <option value="Inactive">Inactive</option>
      </select>
      <input type="text" name="date" id="theDate"><br>
      <input type="submit" name="submit" value="Add User " class="form-btn">
      <a href="javascript:history.back()"><input type="button" value="Back" class="form-btn"></input></a>
   </form>
<?php

@include '../config.php';

$error = []; // Initialize an empty array to store validation errors

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $usertype = $_POST['usertype'];
    $status = $_POST['status'];
    $date = date('Y-m-d', strtotime($_POST['date']));

    // Perform form validation

    if (empty($username)) {
        $error[] = "Username is required.";
    }

    if (empty($pass)) {
        $error[] = "Password is required.";
    }

    if (empty($cpass)) {
        $error[] = "Confirm Password is required.";
    }

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

    if (empty($status)) {
        $error[] = "Status is required.";
    }

    if (empty($date)) {
        $error[] = "Date is required.";
    }

    // Perform additional validations if needed

    if ($pass != $cpass) {
        $error[] = "Password does not match.";
    }

    // If there are validation errors, display the error message using SweetAlert

    if (!empty($error)) {
        echo '<script src="../lib/JS/sweetalert.min.js"></script>';
        echo '<script>';
        echo "swal({
                title: 'Error!',
                text: 'Please fix the following errors:\\n";
        foreach ($error as $errorMessage) {
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

    $select = "SELECT * FROM users WHERE username = '$username' && password = '$pass' && fname= '$fname' && lname = '$lname' && usertype = '$usertype'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $error[] = 'User already exists!';
    } else {
        $insert = "INSERT INTO users(username, password, fname, lname, usertype, status, date) VALUES('$username','$pass', '$fname','$lname','$usertype', '$status', '$date')";
        mysqli_query($conn, $insert);
        header('location:users.php');
        exit(); // Terminate the script after redirection
    }
}

?>

</div>
<script>
var date = new Date();

var options = { year: 'numeric', month: 'short', day: 'numeric' };
var today = date.toLocaleDateString('en-US', options); // Format the date using "Mar/13/2023" format

document.getElementById("theDate").value = today;

</script>
</body>
</html>