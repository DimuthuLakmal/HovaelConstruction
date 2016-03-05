<?php

session_start();
include '../DBCon.php';
$id = $_POST['ID'];
$idinventory = $_POST["invID"];
$idsitefrom = $_POST["siteIDfrom"];
$idsiteto = $_POST["siteIDto"];
$date = $_POST["date"];
$departuretime = $_POST["depttime"];
$arrivaltime = $_POST["arrivaltime"];
$driver = $_POST["drivername"];
$cleaner = $_POST["cleanername"];

echo '<br>';
echo "ID : " . $id . '<br>';
echo "Date : " . $date . '<br>';
echo "Departure time  : " . $departuretime . '<br>';
echo "Arrival Time : " . $arrivaltime . '<br>';
echo "Driver Name :" . $driver . '<br>';
echo "Cleaner Name : " . $cleaner . '<br>';
echo "Inventory ID : " . $idinventory . '<br>';
echo "Site ID From : " . $idsitefrom . '<br>';
echo "Site ID to : " . $idsiteto;
'<br>';

$sql = "UPDATE transfernote SET idinventory = '" . $idinventory . "', idsitefrom ='" . $idsitefrom . "', idsiteto ='" . $idsiteto . "', date='" . $date . "',departuretime='" . $departuretime . "',arrivaltime='" . $arrivaltime . "',driver='" . $driver . "' ,cleaner='" . $cleaner . "'  WHERE id='" . $id . "' ";

if (mysqli_query($con, $sql)) {
    echo "New record created successfully";
    header("Location: ../ViewTransferNotes.php");
} else {
    header("Location: ../ViewTransferNotes.php?msg=error");
}
?>
 