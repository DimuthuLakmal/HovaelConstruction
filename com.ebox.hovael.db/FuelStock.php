<?php

session_start();
header('Content-Type: application/json');
include './connection.php';

$selectAll = array();
$selectForInvoice = array();
$aResult = array();

if (isset($_POST['functionname'])) {
    if ('selectAll' == $_POST['functionname']) {
        $aResult = selectAll();
        echo json_encode($aResult);
    }
    if ('selectForInvoice' == $_POST['functionname']) {
        $aResult = selectForInvoice();
        echo json_encode($aResult);
    }
    if ('search' == $_POST['functionname']) {
        $aResult['result'] = search();
        echo json_encode($aResult);
    }
}


if (isset($_POST['function']) && !empty($_POST['function']) && 'insert' == $_POST['function']) {
    insert($con);
}

if (isset($_POST['function']) && !empty($_POST['function']) && 'update' == $_POST['function']) {
    update($con);
}

function selectAll() {
    $query = "SELECT * FROM fuelstock";
    $data = array();
    $index = 0;

    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            $result = '';
            while ($row = mysql_fetch_assoc($query_run)) {
                $siteLocation = searchSite($row['idsite']);
                $result .= $row['id'] . ':' . $siteLocation . ':' . $row['date'] . ':' . $row['name'] . ':' . $row['price'] . ':' . $row['qty'] . ':' . $row['status'];
                $data[$index] = $result;
                $index++;
                $result = '';
//                $handle = fopen('count.txt', 'a');
//                fwrite($handle, $row['id'] . ':' . $siteLocation . ':' . $row['name'] . ':' . $row['price'] . ':' . $row['qty'] . ':' . $row['status']);
//                fclose($handle);
            }
        }
    }
    return $data;
}

function selectForInvoice() {
    $site = $_POST['site'];
    $year = $_POST['year'];
    $month = $_POST['month'];
    $query = "SELECT * FROM fuelstock WHERE idsite='$site' AND date LIKE '$year-$month%'";
    $data = array();
    $index = 0;

    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            $result = '';
            while ($row = mysql_fetch_assoc($query_run)) {
                $result .= $row['id'] . ':' . $row['date'] . ':' . $row['name'] . ':' . $row['price'] . ':' . $row['qty'];
                $data[$index] = $result;
                $index++;
                $result = '';
            }
        }
    }
    return $data;
}

function searchSite($id) {

    $query = "SELECT * FROM site where id='$id'";

    $result = '';
    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            while ($row = mysql_fetch_assoc($query_run)) {
                $result.=$row['location'];
            }
        }
    }
    return $result;
}

function insert($con) {
    $id = $_POST['id'];
    $idsite = $_POST['site'];
    $date = $_POST['date'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];

    //echo $id . ' ' . $location . ' ' . $permanent . ' ' . $startdate . ' ' . $enddate . ' ' . $projectmanager . ' ' . $sitemanager . ' ' . $status;

    $r = mysql_query("INSERT INTO fuelstock(id,idsite,date,name,price,qty ,status) VALUES('$id','$idsite','$date','$name','$price','$qty','1')", $con);
    if (!$r) {
        header('Location: ../FuelStockInsert.php?msg=error');
    }
    header('Location: ../FuelStockView.php');
}

function update($con) {
    $id = $_POST['id'];
    $siteid = $_POST['site'];
    $date = $_POST['date'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];

    $siteid = searchSiteByLocation($_POST['site']);

    $r = mysql_query("UPDATE fuelstock SET idsite='$siteid',date='$date',name='$name',price='$price',qty='$qty' WHERE id='$id'", $con);
    if (!$r) {
        header('Location: ../FuelStockView.php?msg=error');
    }
    header('Location: ../FuelStockView.php');
}

function searchSiteByLocation($location) {

    $query = "SELECT * FROM site where location='$location'";

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

function search() {
    $site = $_SESSION['location'];
    $query = "SELECT DISTINCT fuelstock.name FROM fuelstock JOIN site ON fuelstock.idsite=site.id WHERE site.location='$site'";
//    $query = "SELECT * FROM fuelstock";

    $result = '';
    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            while ($row = mysql_fetch_assoc($query_run)) {
//                $result.=$row['name'] . ':' . $row['id'] . ',';
                $result.=$row['name'] . ',';
            }
        }
    }
    return $result;
}

?>