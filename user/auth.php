<?php
if(!isset($_SESSION["username"]))
{
	header("location:../login.php");
} 

elseif($_SESSION['usertype']=='HeadAdmin')
{
    header("Location: ../head/");
}
elseif($_SESSION['usertype']=='Admin')
{
    header("Location: ../admin/");
}
?>