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
   <title>ADD STUDENT</title>
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
        <form method="POST" action="">
        <img src="../lib/img/reg.png" width="120px" height="120px">
        <h3 style="color: red;"> REGISTRAR ARCHIVING</h3>
        <input type="number" name="std_id" placeholder="Enter Student ID" style="-moz-appearance: textfield; -webkit-appearance: textfield; appearance: textfield;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10">
        <input type="text" name="lname" required placeholder="Enter Last Name" maxlength="15"><br>
        <input type="text" name="fname" required placeholder="Enter First Name" maxlength="20"><br>
        <input type="text" name="mname" placeholder="Enter Middle Name" maxlength="15"><br>
        <select id="college" name="college" required>
            <option value="">Select College</option>
        </select>
        <select id="courname" name="courname" required>
            <option value="">Select Course</option>
        </select>
        <select name="gender">
            <option value="M">Male</option>
            <option value="F">Female</option>
        </select><br>
        <input type="text" name="started" required placeholder="S.Y. Started" maxlength="9" style="-moz-appearance: textfield; -webkit-appearance: textfield; appearance: textfield;">
        <input type="text" name="folder"  placeholder="Folder" maxlength="10"><br>
        <select name="status">
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
            </select><br>
        <input type="text" name="remarks" placeholder="Remarks" maxlength="50"><br>
        <input type="text" name="date" id="theDate"><br>
        <input type="hidden" name="username" value=<?php echo $_SESSION['username'] ;?>>
        <input type="submit" name="submit" value="Add Student " class="form-btn">
        <a href="javascript:history.back()"><input type="button" value="Back" class="form-btn"></input></a>
        </form>
        
        <?php
if (isset($_POST['submit'])) {
    $std_id = $_POST['std_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mname = $_POST['mname'];
    $gender = $_POST['gender'];
    $college = $_POST['college'];
    $courname = $_POST['courname'];
    $started = $_POST['started'];
    $folder = $_POST['folder'];
    $status = $_POST['status'];
    $remarks = $_POST['remarks'];
    $date = $_POST['date'];
    $username = $_POST['username'];

    // Validate form inputs
    $errors = array();

    if (!empty($std_id) && !preg_match('/^[a-zA-Z0-9]+$/', $std_id)) {
        $errors[] = "Student ID should only contain alphanumeric characters.";
    }

    if (empty($fname)) {
        $errors[] = "First name is required.";
    } elseif (!preg_match('/^[a-zA-Z\s]+$/', $fname)) {
        $errors[] = "First name should only contain alphabetic characters and spaces.";
    }

    if (empty($lname)) {
        $errors[] = "Last name is required.";
    } elseif (!preg_match('/^[a-zA-Z\s]+$/', $lname)) {
        $errors[] = "Last name should only contain alphabetic characters and spaces.";
    }

    if (!empty($mname) && !preg_match('/^[a-zA-Z\s]+$/', $mname)) {
        $errors[] = "Middle name should only contain alphabetic characters and spaces.";
    }

    if (empty($gender)) {
        $errors[] = "Gender is required.";
    }

    if (empty($college)) {
        $errors[] = "College is required.";
    }

    if (empty($courname)) {
        $errors[] = "Course name is required.";
    }

    if (!empty($folder) && !preg_match('/^[a-zA-Z0-9]+$/', $folder)) {
        $errors[] = "Folder should only contain alphanumeric characters.";
    }   

    if (empty($status)) {
        $errors[] = "Status is required.";
    }



    if (empty($date)) {
        $errors[] = "Date is required.";
    }


    // If there are any errors, display them and exit
    if (!empty($errors)) {
        echo '<script src="../lib/JS/sweetalert.min.js"></script>';
        echo "<script>";
        echo "swal({ 
                title: 'Error!', 
                text: 'Please fix the following errors:\\n";
        foreach ($errors as $error) {
            echo "- " . $error . "\\n";
        }
        echo "', 
                icon: 'error' 
            }).then(function() {
                window.history.back();
            });";
        echo "</script>";
        exit();
    }

    // Insert the new record
    $insert_query = "INSERT INTO stdmain(std_id, fname, lname, mname, gender, college, courname, started, folder, status, remarks, date, username)
                     VALUES('$std_id', '$fname', '$lname', '$mname', '$gender', '$college','$courname', '$started', '$folder','$status', '$remarks', '$date', '$username')";

    if (mysqli_query($conn, $insert_query)) {
        echo '<script src="../lib/JS/sweetalert.min.js"></script>';
        echo "<script>";
        echo "swal({ 
                title: 'Success!', 
                text: 'Record added successfully.', 
                icon: 'success' 
            }).then(function() {
                window.location = 'main.php';
            });";
        echo "</script>";
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

    </div>
    


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
</body>
</html>

