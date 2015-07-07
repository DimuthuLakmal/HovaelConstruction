<?php

header('Content-Type: application/json');
include './connection.php';

$selectAll = array();
$aResult = array();

if (isset($_POST['functionname'])) {
    if ('selectAll' == $_POST['functionname']) {
        $aResult = selectAll();
        echo json_encode($aResult);
    }if ('search' == $_POST['functionname']) {
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
                $result .= $row['id'] . ':' . $siteLocation . ':' . $row['name'] . ':' . $row['price'] . ':' . $row['qty'] . ':' . $row['status'];
                $data[$index] = $result;
                $index++;
                $result = '';
                $handle = fopen('count.txt', 'a');
                fwrite($handle, $row['id'] . ':' . $siteLocation . ':' . $row['name'] . ':' . $row['price'] . ':' . $row['qty'] . ':' . $row['status']);
                fclose($handle);
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
    $name = $_POST['name'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $status = $_POST['status'];

    if ($status == 'on') {
        $status = 1;
    } else {
        $status = 0;
    }

    //echo $id . ' ' . $location . ' ' . $permanent . ' ' . $startdate . ' ' . $enddate . ' ' . $projectmanager . ' ' . $sitemanager . ' ' . $status;

    $r = mysql_query("INSERT INTO fuelstock(id,idsite,name,price,qty ,status) VALUES('$id','$idsite','$name','$price','$qty','$status')", $con);

    header('Location: http://localhost/HovaelConstructions_v1.0/FuelStockInsert.php');
}

function update($con) {
    $id = $_POST['id'];
    $siteid = $_POST['site'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $status = $_POST['status'];
    
    $siteid=  searchSiteByLocation($_POST['site']);
    if ($status == '1') {
        $status = 1;
    } else {
        $status = 0;
    }
    
    $r = mysql_query("UPDATE fuelstock SET idsite='$siteid',name='$name',price='$price',qty='$qty',status='$status' WHERE id='$id'", $con);
    if (!$r) {
        die('Could not update data: ' . mysql_error());
    }
    
    header('Location: http://localhost/HovaelConstructions_v1.0/FuelStockUpdate.php');
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

    $query = "SELECT * FROM fuelstock";

    $result = '';
    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            while ($row = mysql_fetch_assoc($query_run)) {
                $result.=$row['name'] . ':' . $row['id'] . ',';
            }
        }
    }
    return $result;
}

?>