<?php

session_start();
include '../DBCon.php';
$iduser = $_SESSION['iduser'];
$un = $_POST['un'];
$oldpw = md5($_POST['oldpw']);
$newpw1 = md5($_POST['newpw1']);
$newpw2 = md5($_POST['newpw2']);

$res = mysqli_query($con, "SELECT * FROM log JOIN user ON user.idlog=log.id WHERE user.id='$iduser'");
if ($row = mysqli_fetch_array($res)) {
    $pw = $row['pw'];
} else {
    header('location:../PasswordChangeForm.php?msg=error');
}
if ($oldpw == $pw && $newpw1 == $newpw2) {
    $res = mysqli_query($con, "UPDATE log JOIN user ON user.idlog=log.id SET un='$un', pw='$newpw1' WHERE user.id='$iduser' AND user.idlog = log.id");
    if ($res) {
        header('location:../db/Lock.php');
    } else {
        header('location:../PasswordChangeForm.php?msg=error');
    }
} else {
    header('location:../PasswordChangeForm.php?msg=error');
}
?>

