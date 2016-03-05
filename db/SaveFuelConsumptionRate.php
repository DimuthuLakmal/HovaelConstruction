<?php

session_start();
include '../DBCon.php';
$isvehicle = $_POST['isvehicle'];
$type = $_POST['type'];
$unit = $_POST['unit'];

if ($isvehicle == 'machine') {
    $rate = $_POST['rate'];
    $remarks = $_POST['remarks'];
} else if ($isvehicle == 'vehicle') {
    $lrate = $_POST['lrate'];
    $erate = $_POST['erate'];
    $rate = "{$lrate}#{$erate}";
    $remarks = $_POST['vremarks'];
}


$res = mysqli_query($con, "SELECT idinventorytype FROM fuelconsumptionrate WHERE idinventorytype='$type'");
if (mysqli_num_rows($res) == 0) {
    $res = mysqli_query($con, "INSERT INTO fuelconsumptionrate(idinventorytype,unit,remarks,hirerate,status) VALUES
        ('" . $type . "','" . $unit . "','" . $remarks . "','" . $rate . "','1')");
    if ($res) {
        header('location:../ViewRate.php');
    } else {
        header('location:../InsertFuelConsumptionRate.php?msg=error');
    }
}else{
    header('location:../InsertFuelConsumptionRate.php?msg=alreadyexists');
}
?>