<?php

$inactive = 2600;

if (isset($_SESSION['timeout']) && time() - $_SESSION['timeout'] > $inactive) {

    session_unset();


    session_destroy();


    header("Location: ../login.php");
    exit(); 
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
?>