<?php

session_start();
include '../DBCon.php';
include '../ctrl/setUserPrivilege.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isAdmin()) {
        $id = $_GET['id'];
        $table = $_GET['table'];
        $url = $_GET['url'];
        $status = $_GET['status'];

        $res = mysqli_query($con, "UPDATE $table SET status=$status WHERE id='$id'");
        if ($res) {
            header('location:../' . $url . '.php');
        } else {
            header('location:../' . $url . '.php?msg=error');
        }
    } else {
        header('location: ../Home.php?msg=error');
    }
} else {
    $id = $_POST['id'];
    $table = $_POST['table'];
    $url = $_POST['url'];

    if (isAdmin()) {
        $res = mysqli_query($con, "UPDATE $table SET status='0' WHERE id='$id'");
    } else {
        $res = mysqli_query($con, "UPDATE $table SET status='2' WHERE id='$id'");
    }
    if ($res) {
        header('location:../' . $url . '.php');
    } else {
        header('location:../' . $url . '.php?msg=error');
    }
}
?>