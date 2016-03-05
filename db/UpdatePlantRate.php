<?php

session_start();
include '../DBCon.php';
$id = $_POST['id'];
$rate = $_POST['rate'];
$desc = $_POST['desc'];

$res = mysqli_query($con, "UPDATE plantrate SET description='$desc', mincharge='$rate' WHERE id=$id");
if ($res) {
    header('location:../ViewRate.php');
} else {
    header('location:../ViewRate.php?msg=error');
}
?>