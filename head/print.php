<?php
session_set_cookie_params(0);
session_start();
include '../config.php';
        $result = mysqli_query($conn, "select * from stdmain");

// Set the session timeout period to 30 minutes
$inactive = 1800; // 30 minutes in seconds

// Check if the user has been inactive for too long
if (isset($_SESSION['timeout']) && time() - $_SESSION['timeout'] > $inactive) {
    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect the user to the login page or any other appropriate page
    header("Location: ../login.php");
    exit(); // Exit the script after redirecting
}

// Update the session timeout to the current time
$_SESSION['timeout'] = time();

// Logout functionality
if (isset($_GET['logout'])) {
    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect the user to the login page or any other appropriate page
    header("Location: ../login.php");
    exit(); // Exit the script after redirecting
}

if(!isset($_SESSION["username"]))
{
	header("location:../login.php");
	exit(); // Exit the script if user is not logged in
} 
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/print.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">
    <script src="../JS/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>
    
    <title>WMSU REGISTRAR'S OFFICE</title>

</head>

<body onload="print()">

<div class="">
<center>
                <img src="../img/wmsu.png" width="70" height="70">
                <h3 style="margin-top: 30px;">Western Mindanao State University</h3>
                <h4>Office of the University Registrar</h4>
                <h6>Normal Road, Baliwasan, Zamboanga City</h6>
                </div>
        <hr>
</center>
<table id="example" class="content-table">
    <thead>
        <tr>
            <th>Student Name</th>
            <th>Courses</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        <?php
        include '../config.php';
        $result = mysqli_query($conn, "select * from stdmain ;");

        while($row = mysqli_fetch_array($result)){
            ?>

            <tr>
                <td><?php echo $row['lname'],', ', $row['fname'], ' ',$row['mname']?></td>
                <td><?php echo $row['courname']?></td>
            </tr>
            <?php } ?>
    </tbody>
</div>
<div class="container">
    <button type="">
    <script src="../JS/script.js"></script>
</body>

</html>