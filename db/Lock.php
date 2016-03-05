<?php

session_start();
include '../DBCon.php';
$_SESSION['status'] = '0';
$date_time = date('Y-m-d H:i:s');
$iduser = $_SESSION['iduser'];

$res = mysqli_query($con, "UPDATE loginsession SET outtime='$date_time' WHERE iduser='$iduser' ORDER BY id DESC LIMIT 1");
if ($res) {
    header('location:../LockScreen.php');
} else {
    header('location:../Home.php?msg=error');
}
?>