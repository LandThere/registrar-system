<?php
include 'config.php';

if(isset($_SESSION["username"]))
{
	if($_SESSION["usertype"] == "Admin") {
		header("location: admin/");
	} elseif($_SESSION["usertype"] == "User") {
		header("location: user/");
	} else {
		header("location: head/");
	}
	die();
} 
?>