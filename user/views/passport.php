<?php
@include "../../config.php";
$sql = "SELECT * FROM `passport` WHERE `id` = " . $_GET["id"];
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) ==0)
{
die("File does not exist.");
}
$row = mysqli_fetch_object($result);
if($row->type == "application/pdf"){
    header("content-type: application/pdf");
    echo($row->image);
} else if ($row->type == "image/jpeg"){
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=BirthCertificate.jpg");
    echo $row->image;
} else {
    die("Invalid file type.");
}
?>