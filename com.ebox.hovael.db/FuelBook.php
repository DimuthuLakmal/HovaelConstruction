<?php

header('Content-Type: application/json');
include './connection.php';

$selectAll = array();
$aResult = array();

if (isset($_POST['functionname'])) {
    if ('selectAll' == $_POST['functionname']) {
        $aResult = selectAll();
        echo json_encode($aResult);
    }
    if ('searchBetween' == $_POST['functionname']) {
        $aResult = searchBetween();
        $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $aResult[0]);

        fclose($myfile);
        echo json_encode($aResult);
    }
}

if (isset($_POST['function']) && !empty($_POST['function']) && 'insert' == $_POST['function']) {
    insert($con);
}

if (isset($_POST['function']) && !empty($_POST['function']) && 'update' == $_POST['function']) {
    update($con);
}

function searchBetween() {
    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];
    $query = "SELECT * FROM fuelbook where date between '$fromdate' and '$todate'";
    $data = array();
    $index = 0;

    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            $result = '';
            while ($row = mysql_fetch_assoc($query_run)) {
                $regno = searchInventory($row['idinventory']);
                $fuel = searchFuel($row['idfuelstock']);
                $result .= $row['id'] . ':' . $regno . ':' . $fuel . ':' . $row['date'] . ':' . $row['qty'] . ':' . $row['meterreading'] . ':' . $row['remarks'] . ':' . $row['status'];
                $data[$index] = $result;
                $index++;
                $result = '';
            }
        }
    }
    return $data;
}

function insert($con) {
    $id = $_POST['id'];
    $regno = $_POST['regno'];
    $fuelName = $_POST['fuel'];
    $date = $_POST['date'];
    $qty = $_POST['qty'];
    $meterReading = $_POST['meterreading'];
    $remarks = $_POST['remarks'];
    $status = $_POST['status'];

    $fuelId = searchFromName($fuelName);
    $idinventory = searchByRegistrationNumber($regno);

    if ($status == 'on') {
        $status = 1;
    } else {
        $status = 0;
    }

    //echo $id . ' ' . $location . ' ' . $permanent . ' ' . $startdate . ' ' . $enddate . ' ' . $projectmanager . ' ' . $sitemanager . ' ' . $status;

    $r = mysql_query("INSERT INTO fuelbook(id,idinventory,idfuelstock,date,qty,meterreading,remarks ,status) VALUES('$id','$idinventory','$fuelId','$date','$qty','$meterReading','$remarks','$status')", $con);

    header('Location: http://localhost/HovaelConstructions_v1.0/FuelBookInsert.php');
}

function searchFromName($name) {
    $query = "SELECT * FROM fuelstock WHERE id=$name";

    $result = '';
    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            while ($row = mysql_fetch_assoc($query_run)) {
                $result = $row['id'];
            }
        }
    }
    return $result;
}

function searchByRegistrationNumber($regno) {

    $query = "SELECT * FROM inventory where regno='$regno'";

    $result = '';
    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            while ($row = mysql_fetch_assoc($query_run)) {
                $result.=$row['id'];
            }
        }
    }
    return $result;
}

function searchInventory($id) {

    $query = "SELECT * FROM inventory where id='$id'";

    $result = '';
    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            while ($row = mysql_fetch_assoc($query_run)) {
                $result.=$row['regno'];
            }
        }
    }
    return $result;
}

function searchFuel($id) {

    $query = "SELECT * FROM fuelstock where id='$id'";

    $result = '';
    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            while ($row = mysql_fetch_assoc($query_run)) {
                $result.=$row['name'];
            }
        }
    }
    return $result;
}

function selectAll() {
    $query = "SELECT * FROM fuelbook";
    $data = array();
    $index = 0;

    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            $result = '';
            while ($row = mysql_fetch_assoc($query_run)) {
                $regno = searchInventory($row['idinventory']);
                $fuel = searchFuel($row['idfuelstock']);
                $result .= $row['id'] . ':' . $regno . ':' . $fuel . ':' . $row['date'] . ':' . $row['qty'] . ':' . $row['meterreading'] . ':' . $row['remarks'] . ':' . $row['status'];
                $data[$index] = $result;
                $index++;
                $result = '';
            }
        }
    }
    return $data;
}

function update($con) {
    $id = $_POST['id'];
    $regno = $_POST['regno'];
    $fuelName = $_POST['fuel'];
    $date = $_POST['date'];
    $qty = $_POST['qty'];
    $meterReading = $_POST['meterreading'];
    $remarks = $_POST['remarks'];
    $status = $_POST['status'];

    $fuelId = searchFromName($fuelName);
    $idinventory = searchByRegistrationNumber($regno);

    if ($status == '1') {
        $status = 1;
    } else {
        $status = 0;
    }

    $r = mysql_query("UPDATE fuelbook SET idinventory='$idinventory',idfuelstock='$fuelId',date='$date',qty='$qty',meterreading='$meterReading',remarks='$remarks',status='$status' WHERE id='$id'", $con);
    if (!$r) {
        die('Could not update data: ' . mysql_error());
    }

    header('Location: http://localhost/HovaelConstructions_v1.0/FuelBookUpdate.php');
}

?>
