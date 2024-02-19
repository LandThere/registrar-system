<?php
$db = mysqli_connect("localhost", "root", "", "archsys");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'config.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sanitized_username = 
    mysqli_real_escape_string($db, $username);
      
$sanitized_password = 
    mysqli_real_escape_string($db, $password);
      
$sql = "SELECT * FROM users WHERE username = '" 
    . $sanitized_username . "' AND password = '" 
    . $sanitized_password . "'";
      
$result = mysqli_query($db, $sql) 
    or die(mysqli_error($db));
      
$num = mysqli_fetch_array($result);
      
if($num > 0) {
    echo "Login Success";
}
else {
    echo "Wrong User id or password";
}
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>GFG SQL Injection Article</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div id="form">
        <h1>LOGIN FOR SQL INJECTION</h1>
        <form name="form" action="" method="POST">

            <p>
                <label>USER NAME:</label>
                <input type="text" id="user" name="username" />
            </p>

            <p>
                <label>PASSWORD:</label>
                <input type="password" id="pass" name="password" />
            </p>

            <p>
                <input type="submit" id="button" value="Login" />
            </p>
        </form>
    </div>
</body>

</html>
