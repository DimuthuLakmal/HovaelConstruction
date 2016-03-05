<?php

session_start();
include '../DBCon.php';
$type = $_POST['type'];
$fn = $_POST['fn'];
$ln = $_POST['ln'];
$desig = $_POST['desig'];
$work = $_POST['work'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$un = $_POST['un'];
$pw = md5($_POST['pw']);

$res = mysqli_query($con, "SELECT un FROM log WHERE un='$un'");
if (mysqli_num_rows($res) == 0) {
    $res = mysqli_query($con, "INSERT INTO userinfo(designation,work,mobile) VALUES
        ('" . $desig . "','" . $work . "','" . $mobile . "')");
    if ($res) {
        $res = mysqli_query($con, "SELECT MAX(id) FROM userinfo");
        if ($row = mysqli_fetch_array($res)) {
            $userinfo_id = $row['MAX(id)'];
        }
        $res = mysqli_query($con, "INSERT INTO log(un,pw) VALUES
        ('" . $un . "','" . $pw . "')");
        if ($res) {
            $res = mysqli_query($con, "SELECT MAX(id) FROM log");
            if ($row = mysqli_fetch_array($res)) {
                $log_id = $row['MAX(id)'];
            }
            $res = mysqli_query($con, "INSERT INTO user(fname,lname,email,status,iduserinfo,idlog,idusertype) VALUES
        ('" . $fn . "','" . $ln . "','" . $email . "','0','" . $userinfo_id . "','" . $log_id . "','" . $type . "')");
            if ($res) {
                header('location:../Index.php');
            } else {
                header('location:../SignUp.php?msg=error');
            }
        } else {
            header('location:../SignUp.php?msg=error');
        }
    } else {
        header('location:../SignUp.php?msg=error');
    }
} else {
    header('location:../SignUp.php?msg=available');
}
?>

