<?php
@include '../config.php';

if($_POST['type'] == ""){
    $select = "SELECT * FROM college";
    $result = mysqli_query($conn, $select);

    $str = "";
    while($row = mysqli_fetch_assoc($result)){
        $str .= "<option value='{$row['id']}'>{$row['college_name']}</option>";
    }
} else if($_POST['type'] == "courseData"){
    
    $select = "SELECT * FROM course WHERE course_id = {$_POST['id']}";
    $result = mysqli_query($conn, $select);

    $str = "";
    while($row = mysqli_fetch_assoc($result)){
        $str .= "<option value='{$row['course_name']}'>{$row['course_name']}</option>";
    }
}

echo $str;
?>
