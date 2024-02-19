<?php
if(!isset($_SESSION["username"]))
{
	header("location:../login.php");
} 

elseif($_SESSION['usertype']=='User')
{
    header("Location: ../user/");
}
elseif($_SESSION['usertype']=='HeadAdmin')
{
    header("Location: ../head/");
}
?>