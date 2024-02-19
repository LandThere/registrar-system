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
$select = "SELECT * FROM `main_archive` WHERE id=$id";
$result = mysqli_query($conn, $select);
$row = mysqli_fetch_assoc($result);
$std_id = $row['std_id'];
$lname = $row['lname'];
$fname = $row['fname'];
$mname = $row['mname'];
$gender = $row['gender'];
$college = $row['college'];
$courname = $row['courname'];
$started = $row['started'];
$folder = $row['folder'];
$status = $row['status'];
$remarks = $row['remarks'];
$date = $row['date'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>EDIT STUDENT</title>
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
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}

input[type=number]::-moz-number-spin-box {
  -moz-appearance: none;
  margin: 0;
}
</style>
<body>
   
<div class="form-container">
        <form action="" method="post">
   <img src="../lib/img/reg.png" width="120px" height="120px">
   <h3 style="color: red;"> REGISTRAR ARCHIVING</h3>
      <h4 style="text-align: left">Student ID:</h4>
      <input type="number" name="std_id" placeholder="Enter Student ID" style="-moz-appearance: textfield; -webkit-appearance: textfield; appearance: textfield;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10"  value=<?php echo $std_id?>>
      <br>
      <h4 style="text-align: left">Last Name:</h4>
      <input type="lastname" name="lname" required placeholder="Enter Last Name" maxlength="15"value=<?php echo $lname?>>
      <br>
      <h4 style="text-align: left">First Name:</h4>
      <input type="firstname" name="fname" required placeholder="Enter First Name" maxlength="20"value=<?php echo $fname?>>
      <br>
      <h4 style="text-align: left">Middle Name:</h4>
      <input type="text" name="mname" placeholder="Enter Middle Name" maxlength="15" value=<?php echo $mname?>>
      <br>
      <h4 style="text-align: left">Gender:</h4>
      <select name="gender">
        <option value="M" <?php if ($gender == 'M') echo 'selected'?>>Male</option>
        <option value="F" <?php if ($gender == 'F') echo 'selected'?>>Female</option>
        </select>
      <h4 style="text-align: left">College:</h4>
        <select id="college" name="college" required>
            <option value="">Select College</option>
        </select>
        <h4 style="text-align: left">Course:</h4>
        <select id="courname" name="courname" required>
            <option value="">Select Course</option>
        </select>
        <br>
      <h4 style="text-align: left">S.Y. Started:</h4>
      <input type="text" name="started" required placeholder="S.Y. Started" maxlength="9" value=<?php echo $started?>>
      <h4 style="text-align: left">Folder:</h4>
      <input type="text" name="folder" placeholder="Folder" maxlength="10" value=<?php echo $folder?>>
      <br>
      <h4 style="text-align: left">Status:</h4>
      <select name="status">
        <option value="Active" <?php if ($status == 'Active') echo 'selected'?>>Active</option>
        <option value="Inactive" <?php if ($status == 'Inactive') echo 'selected'?>>Inactive</option>
      </select>
      <br>
      <h4 style="text-align: left">Remarks:</h4>
      <input type="text" name="remarks" placeholder="Remarks" maxlength="50" value=<?php echo $remarks?>>
      <br>
      <input type="submit" name="submit" value="Save " class="form-btn">
      <a href="javascript:history.back()"><input type="button" value="Back" class="form-btn"></input></a>
   </form>
    </div>
</body>


<?php
$error = []; // Initialize an empty array to store validation errors

if (isset($_POST['submit'])) {
    $id = $_GET['updateid'];
    $std_id = $_POST['std_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mname = $_POST['mname'];
    $gender = $_POST['gender'];
    $newCollege = $_POST['college'];
    $newCourname = $_POST['courname'];
    $started = $_POST['started'];
    $folder = $_POST['folder'];
    $status = $_POST['status'];
    $remarks = $_POST['remarks'];

    // Validate form inputs

    if (!empty($std_id) && !preg_match('/^[a-zA-Z0-9]+$/', $std_id)) {
        $error[] = "Student ID should only contain alphanumeric characters.";
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

    if (!empty($mname) && !preg_match('/^[a-zA-Z\s]+$/', $mname)) {
        $error[] = "Middle name should only contain alphabetic characters and spaces.";
    }

    if (empty($gender)) {
        $error[] = "Gender is required.";
    }

    if (empty($newCollege)) {
        $error[] = "College is required.";
    }

    if (empty($newCourname)) {
        $error[] = "Course name is required.";
    }


    if (!empty($folder) && !preg_match('/^[a-zA-Z0-9]+$/', $folder)) {
        $error[] = "Folder should only contain alphanumeric characters.";
    }

    if (empty($status)) {
        $error[] = "Status is required.";
    }


    if (empty($date)) {
        $error[] = "Date is required.";
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

    if ($college !== $newCollege || $courname !== $newCourname) {
        // Insert previous college and course into stdmain_logs
        $insertLogQuery = "INSERT INTO stdmain_logs (log_id, lname, fname, mname, started, college, courname)
                           VALUES ('$id','$lname', '$fname', '$mname', '$started', '$college', '$courname')";
        mysqli_query($conn, $insertLogQuery);
    }

    $updateQuery = "UPDATE `main_archive`
                    SET id = $id, std_id = '$std_id', fname = '$fname', lname = '$lname', mname = '$mname',
                        gender = '$gender', college = '$newCollege', courname = '$newCourname', started = '$started',
                        folder = '$folder', status = '$status', remarks = '$remarks'
                    WHERE id = '$id'";
    
    $result = mysqli_query($conn, $updateQuery);
    if ($result) {
        //echo "New record created successfully.";
        header('location:main.php');
    } else {
        die("Connection failed: " . $conn->connect_error);
    } 
}
?>

<script src="../lib/JS/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        function loadData(type, id){
            $.ajax({
                url: "fetch.php",
                type: "POST",
                data: {type : type, id : id},
                success: function(data){
                    if(type == "courseData"){
                        $("#courname").html(data); 
                    }else{
                        $("#college").append(data);     
                    }
                     
                }
            });
        }

        loadData();

        $("#college").on("change",function(){
            var college = $("#college").val();

            loadData("courseData", college);
        })
    });
</script>
<script>
    var date = new Date();

var day = date.getDate();
var month = date.getMonth() + 1;
var year = date.getFullYear();

if (month < 10) month = "0" + month;
if (day < 10) day = "0" + day;

var today = year + "-" + month + "-" + day;       
document.getElementById("theDate").value = today;
</script>
<script>
    const form = document.querySelector("form"),
        nextBtn = form.querySelector(".nextBtn"),
        backBtn = form.querySelector(".backBtn"),
        allInput = form.querySelectorAll(".first input");


nextBtn.addEventListener("click", ()=> {
    allInput.forEach(input => {
        if(input.value != ""){
            form.classList.add('secActive');
        }else{
            form.classList.remove('secActive');
        }
    })
})

backBtn.addEventListener("click", () => form.classList.remove('secActive'));

</script>
</html>
