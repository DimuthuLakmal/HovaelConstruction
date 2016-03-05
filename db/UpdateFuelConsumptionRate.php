<?php

session_start();
include '../DBCon.php';
$id = $_POST['id'];
$unit = $_POST['unit'];

$remarks = $_POST['remarks'];
$lrate = $_POST['lrate'];
$erate = $_POST['erate'];

if (!$lrate == '') {
    $rate = "{$lrate}#{$erate}";
} else {
    $rate = $_POST['rate'];
}

$res = mysqli_query($con, "UPDATE fuelconsumptionrate SET unit='$unit', remarks='$remarks', hirerate='$rate' WHERE id=$id");
if ($res) {
    header('location:../ViewRate.php');
} else {
    header('location:../ViewRate.php?msg=error');
}
?>