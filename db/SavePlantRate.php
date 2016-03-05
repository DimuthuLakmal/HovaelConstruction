<?php
session_start();
include '../DBCon.php';
$type = $_POST['type'];
$rate = $_POST['rate'];
$desc = $_POST['desc'];

$res = mysqli_query($con, "SELECT idinventorytype FROM plantrate WHERE idinventorytype='$type'");
if (mysqli_num_rows($res) == 0) {
    $res = mysqli_query($con, "INSERT INTO plantrate(idinventorytype,description,mincharge,status) VALUES
        ('" . $type . "','" . $desc . "','" . $rate . "','1')");
    if ($res) {
        header('location:../ViewRate.php');
    } else {
        header('location:../InsertPlantRate.php?msg=error');
    }
} else {
    header('location:../InsertFuelConsumptionRate.php?msg=alreadyexists');
}
?>
?>

