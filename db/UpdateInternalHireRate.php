<?php

session_start();
include '../DBCon.php';
$id = $_POST['id'];
$rate = $_POST['rate'];
$unit = $_POST['unit'];
$hrs = $_POST['hrs'];

$res = mysqli_query($con, "UPDATE internalhirerate SET unit='$unit' ,estimatedhrs='$hrs',rate='$rate' WHERE id=$id");
if ($res) {
    header('location:../ViewRate.php');
} else {
    header('location:../ViewRate.php?msg=error');
}
?>