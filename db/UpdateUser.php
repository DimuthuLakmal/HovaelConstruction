<?php

session_start();
include '../DBCon.php';
$iduser = $_SESSION['iduser'];
$fn = $_POST['fn'];
$ln = $_POST['ln'];
$desig = $_POST['desig'];
$work = $_POST['work'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];

$res = mysqli_query($con, "UPDATE user SET fname='$fn', lname='$ln', email='$email' WHERE id='$iduser'");
if ($res) {
    $res = mysqli_query($con, "UPDATE userinfo JOIN user ON user.idusertype = userinfo.id SET designation='$desig', work='$work', mobile='$mobile' WHERE user.id='$iduser' AND userinfo.id=user.idusertype");
    if ($res) {
        header('location:../Profile.php');
    } else {
        header('location:../Profile.php?msg=error');
    }
} else {
    header('location:../Profile.php?msg=error');
}
?>

