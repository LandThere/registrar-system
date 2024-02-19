<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
include 'session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="lib/CSS/login.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="lib/JS/sweetalert.min.js"></script>
    <title>WMSU | LOGIN</title>
    <link rel="icon" href="lib/img/reg.png">


</head>

<style>
body {
  background-image: url('lib/img/bg.png');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}
</style>
<body style="background-image: url('lib/img/bg.png');">
<div class="container">
  <form action="" method="post">
    <div style="display: flex; justify-content: center;">
      <img src="lib/img/reg.png" width="180px" height="180px">
    </div>
    <h2 style="color: red;" align="center">WMSU Registrar's Office</h2>
    <div class="input-box underline">
      <input type="username" name="username" placeholder="Username" maxlength="25" required>
      <div class="underline"></div>
    </div>
    <div class="input-box">
      <input type="password" name="password" placeholder="Password" maxlength="25" required>
      <div class="underline"></div>
    </div>
    <div class="input-box button">
      <input type="submit" name="submit" value="Continue">
    </div>
  </form>
</div>
<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "archsys";

$data = mysqli_connect($host, $user, $password, $db);

if ($data === false) {
    die("connection error");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $pass = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE BINARY username = ? AND BINARY password = ?";
    $stmt = mysqli_prepare($data, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ss", $username, $pass);

    // Execute the prepared statement
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        if ($row['usertype'] == 'Admin') {
            if ($row['status'] != 'Active') {
                echo '<script type="text/javascript">';
                echo 'swal("Error!", "Your account is inactive", "error").then(function() { window.location = "login.php"; });';
                echo '</script>';
                exit();
            }

            $_SESSION["username"] = $username;
            $_SESSION["usertype"] = 'Admin';

            header("location:admin/");
        } elseif ($row['usertype'] == 'User') {
            if ($row['status'] != 'Active') {
                echo '<script type="text/javascript">';
                echo 'swal("Error!", "Your account is inactive", "error").then(function() { window.location = "login.php"; });';
                echo '</script>';
                exit();
            }

            $_SESSION["username"] = $username;
            $_SESSION["usertype"] = 'User';

            header("location:user/");
        } elseif ($row['usertype'] == 'HeadAdmin') {
            if ($row['status'] != 'Active') {
                echo '<script type="text/javascript">';
                echo 'swal("Error!", "Your account is inactive", "error").then(function() { window.location = "login.php"; });';
                echo '</script>';
                exit();
            }

            $_SESSION["username"] = $username;
            $_SESSION["usertype"] = 'HeadAdmin';

            header("location:head/");
        } else {
            echo '<script type="text/javascript">';
            echo 'swal("Error!", "Username or password incorrect", "error").then(function() { window.location = "login.php"; });';
            echo '</script>';
        }
    } else {
        echo '<script type="text/javascript">';
        echo 'swal("Error!", "Username or password incorrect", "error").then(function() { window.location = "login.php"; });';
        echo '</script>';
    }
}
?>



            

    <script>
        const container = document.querySelector(".container"),
      pwShowHide = document.querySelectorAll(".showHidePw"),
      pwFields = document.querySelectorAll(".password"),
      login = document.querySelector(".login-link");

    pwShowHide.forEach(eyeIcon =>{
        eyeIcon.addEventListener("click", ()=>{
            pwFields.forEach(pwField =>{
                if(pwField.type ==="password"){
                    pwField.type = "text";

                    pwShowHide.forEach(icon =>{
                        icon.classList.replace("uil-eye-slash", "uil-eye");
                    })
                }else{
                    pwField.type = "password";

                    pwShowHide.forEach(icon =>{
                        icon.classList.replace("uil-eye", "uil-eye-slash");
                    })
                }
            }) 
        })
    })

    login.addEventListener("click", ( )=>{
        container.classList.remove("active");
    });

    </script>
</body>
</html>


 