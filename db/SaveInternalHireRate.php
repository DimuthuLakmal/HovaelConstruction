<?php

session_start();
include '../DBCon.php';
$type = $_POST['type'];
$rate = $_POST['rate'];
$unit = $_POST['unit'];
$hrs = $_POST['hrs'];

$res = mysqli_query($con, "SELECT idinventorytype FROM internalhirerate WHERE idinventorytype='$type'");
if (mysqli_num_rows($res) == 0) {
    $res = mysqli_query($con, "INSERT INTO internalhirerate(idinventorytype,unit,estimatedhrs,rate,status) VALUES
        ('" . $type . "','" . $unit . "','" . $hrs . "','" . $rate . "','1')");
    if ($res) {
        header('location:../ViewRate.php');
    } else {
        header('location:../InsertInternalHireRate.php?msg=error');
    }
} else {
    header('location:../InsertInternalHireRate.php?msg=alreadyexists');
}
?>