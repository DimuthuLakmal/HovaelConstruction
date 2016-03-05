<?php

session_start();
include '../DBCon.php';
$inventoryID = $_POST["invID"];
$idsitefrom = $_POST["siteIDfrom"];
$idsiteto = $_POST["siteIDto"];
$date = $_POST["date"];
$departuretime = $_POST["depttime"];
$arrivaltime = $_POST["arrivaltime"];
$driver = $_POST["drivername"];
$cleaner = $_POST["cleanername"];

echo '<br>';
echo "Inventory ID : " . $inventoryID . '<br>';
echo "Site ID from : " . $idsitefrom . '<br>';
echo "Site ID to : " . $idsiteto . '<br>';
echo "date : " . $date . '<br>';
echo "daparture time  : " . $departuretime . '<br>';
echo "arrival time : " . $arrivaltime . '<br>';
echo " driver name : " . $driver . '<br>';
echo "cleaner name : " . $cleaner . '<br>';

if ($idsitefrom != $idsiteto) {
    $sql = "INSERT INTO transfernote(idinventory,idsitefrom,idsiteto,date,departuretime,arrivaltime,driver,cleaner,status) VALUES('" . $inventoryID . "','" . $idsitefrom . "','" . $idsiteto . "','" . $date . "','" . $departuretime . "','" . $arrivaltime . "','" . $driver . "','" . $cleaner . "','1')";

    if (mysqli_query($con, $sql)) {
        echo "New record created successfully";
        header("Location: ../ViewTransferNotes.php");
    } else {
        header("Location: ../InsertTransferNote.php?msg=error");
    }
}else{
    header("Location: ../InsertTransferNote.php?msg=samesite");
}
?>
