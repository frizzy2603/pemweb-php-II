<?php
include 'config.php';

$user_id = $_GET['id'];
$query = "DELETE FROM `religion` WHERE `religion_id` = '$religion_id'";
$result = mysqli_query($conn, $query);
header("Location: user.php");
exit();
?>