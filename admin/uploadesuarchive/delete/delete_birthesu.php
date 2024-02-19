<?php
include "../../../config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM `tbl_birthesu` WHERE `id` = " . $_GET["id"];
    $conn->query($sql);

    // Set session variable to indicate successful deletion
    $_SESSION['delete_success'] = true;
}

header('location: ' . $_SERVER['HTTP_REFERER']);
exit;
?>