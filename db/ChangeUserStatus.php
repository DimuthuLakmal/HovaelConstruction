<?php

session_start();
include '../DBCon.php';
$iduser = $_POST['iduser'];
$userstatus = $_POST['userstatus'];

$res = mysqli_query($con, "SELECT status FROM user WHERE id='$iduser'");
if ($row = mysqli_fetch_array($res)) {
    if ($userstatus == '1') {
        $res = mysqli_query($con, "UPDATE user SET status='0' WHERE id='$iduser'");
        if ($res) {
            header('location:../ViewUser.php');
        } else {
            header('location:../ViewUser.php?msg=error');
        }
    } else {
        $res = mysqli_query($con, "UPDATE user SET status='1' WHERE id='$iduser'");
        if ($res) {
            header('location:../ViewUser.php');
        } else {
            header('location:../ViewUser.php?msg=error');
        }
    }
} else {
    header('location:../ViewUser.php?msg=error');
}
?>