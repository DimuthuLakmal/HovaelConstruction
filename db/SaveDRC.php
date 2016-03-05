<?php

session_start();
include '../DBCon.php';

$driver = $_POST["drivername"];
$officer = $_POST["officername"];
$date = $_POST["date"];
$journey = $_POST["message"];
$starttime = $_POST["starttime"];
$endtime = $_POST["endtime"];
$startmeter = $_POST["startmeter"];
$endmeter = $_POST["endmeter"];
$officialkm = $_POST["officialkm"];
$privatekm = $_POST["privatekm"];
$idsite = $_POST["siteID"];
$idinventory = $_POST["inventoryID"];

echo '<br>';
echo "Driver Name :" . $driver . '<br>';
echo "Officer Name : " . $officer . '<br>';
echo "Date : " . $date . '<br>';
echo "Journey Details : " . $journey . '<br>';
echo "Start time  : " . $starttime . '<br>';
echo "End Time : " . $endtime . '<br>';
echo "Start Meter :" . $startmeter . '<br>';
echo "End Meter : " . $endmeter . '<br>';
echo "Official KM : " . $officialkm . '<br>';
echo "Private KM : " . $privatekm . '<br>';
echo "Site ID : " . $idsite . '<br>';
echo "Inventory ID : " . $idinventory . '<br>';


$sql = "INSERT INTO drc(idinventory,idsite,officer,driver,date,journey,starttime,endtime,startmeter,endmeter,officialkm,privatekm,status) VALUES('" . $idinventory . "','" . $idsite . "','" . $officer . "','" . $driver . "','" . $date . "','" . $journey . "','" . $starttime . "','" . $endtime . "','" . $startmeter . "','" . $endmeter . "','" . $officialkm . "','" . $privatekm . "','1')";

if (mysqli_query($con, $sql)) {
    echo "New record created successfully";
    header("Location: ../ViewDRC.php");
} else {
    header("Location: ../InsertDRC.php?msg=error");
}
?>
 