<?php

header('Content-Type: application/json');
include './connection.php';


$aResult = array();
$searchForDisplay = array();
$searchByRegNo = array();

if (isset($_POST['functionname'])) {
    if ('search' == $_POST['functionname']) {
        $aResult['result'] = search();
        echo json_encode($aResult);
    }if ('searchForDisplay' == $_POST['functionname']) {
        searchForDisplay($_POST['category']);
        echo json_encode($searchForDisplay);
    }
    if ('searchByRegNo' == $_POST['functionname']) {
        $searchByRegNo[0]=searchByRegistrationNumber($_POST['regno']);
        echo json_encode($searchByRegNo);
    }
}

function insert($con) {
    $id = $_POST['id'];
    $inventoryType = $_POST['type'];
    $regno = $_POST['regno'];
    $engno = $_POST['engno'];
    $sno = $_POST['sno'];
    $year = $_POST['year'];
    $date = $_POST['date'];
    $hireinternal = $_POST['hireinternal'];
    $operator = $_POST['operator'];
    $status = $_POST['status'];

    if ($status == 'on') {
        $status = 1;
    } else {
        $status = 0;
    }


    $r = mysql_query("INSERT INTO inventory(id, idinventorytype, regno, engno, sno, year, date, hireinternal, operator, status) VALUES('$id','$inventoryType','$regno','$engno','$sno','$year','$date','$hireinternal','$operator','$status')", $con);

    header('Location: http://localhost/HovaelConstructions_v1.0/InventoryInsert.php');
}

function searchForDisplay($category) {
    
    global $searchForDisplay;
    $query = "SELECT i.id,i.regno,it.model,it.make,it.country,i.engno,i.sno,it.capacity,i.year,i.operator,i.hireinternal,i.date,i.status,i.idinventorytype FROM inventory i inner join inventorytype it on i.idinventorytype = it.id inner join inventorycat itcat on itcat.id=it.idinventorycat where itcat.category='$category';";
    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            while ($row = mysql_fetch_assoc($query_run)) {                
                $searchForDisplay[]=$row['id'].','.$row['regno'].','.$row['model'].','.$row['make'].','.$row['country'].','.$row['engno'].','.$row['sno'].','.$row['capacity'].','.$row['year'].','.$row['operator'].','.$row['hireinternal'].','.$row['date'].','.$row['status'].','.$row['idinventorytype'];
            }
        }
    }
    
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

function search() {

    $query = "SELECT * FROM inventorycat";

    $result = '';
    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            while ($row = mysql_fetch_assoc($query_run)) {
                $result.=$row['category'] . ':' . $row['id'] . ',';
            }
        }
    }
    return $result;
}

function update($con) {
    $idinventorytype = $_POST['idinventorytype'];
    $id = $_POST['id'];
    $regno = $_POST['regno'];
    $sno = $_POST['sno'];
    $engno = $_POST['engno'];
    $year = $_POST['year'];
    $date = $_POST['date'];
    $hireinternal = $_POST['hireinternal'];
    $operator = $_POST['operator'];
    $status = $_POST['status'];
    
    $model = $_POST['model'];
    $make = $_POST['make'];
    $capacity = $_POST['capacity'];
    $country = $_POST['country'];
    
    echo $status;
    if ($status == '1') {
        $status = 1;
    } else {
        $status = 0;
    }
    $r = mysql_query("UPDATE hovael.inventorytype SET model='$model',make='$make',capacity='$capacity',country='$country' WHERE id='$idinventorytype'", $con);
    if (!$r) {
        die('Could not update data: ' . mysql_error());
    }
    else{
        $r = mysql_query("UPDATE hovael.inventory SET regno='$regno',sno='$sno',engno='$engno',year='$year',date='$date',hireinternal='$hireinternal',operator='$operator',status='$status' WHERE id='$id'", $con);
        if(!$r){
            die('Could not update data: ' . mysql_error());
        }
    }
    header('Location: http://localhost/HovaelConstructions_v1.0/InventoryUpdate.php');
}

if (isset($_POST['function']) && !empty($_POST['function']) && 'insert' == $_POST['function']) {
    insert($con);
}

if (isset($_POST['function']) && !empty($_POST['function']) && 'update' == $_POST['function']) {
    update($con);
}
?>