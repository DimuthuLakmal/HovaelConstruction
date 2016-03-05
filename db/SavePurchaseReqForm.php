<?php

session_start();
include '../DBCon.php';
$stock = $_POST['stock'];
$desc = $_POST['desc'];
$unit = $_POST['unit'];
$avail = $_POST['avail'];
$req = $_POST['req'];
$remarks = $_POST['remarks'];

$res = mysqli_query($con, "INSERT INTO purchaseitem(stockcode) VALUES
        ('" . $stock . "')");
if ($res) {
    header('location:../index.php');
} else {
    echo 'hjdsadgajisd';
    //header('location:../insertPurchaseReqForm.php?msg=error');
}
?>

