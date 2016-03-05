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
        $searchByRegNo[0] = searchByRegistrationNumber($_POST['regno']);
        echo json_encode($searchByRegNo);
    }
    if ('searchCode' == $_POST['functionname']) {
        $aResult['result'] = searchCode();
        echo json_encode($aResult);
    }
    if ('searchRegNo' == $_POST['functionname']) {
        $aResult['result'] = searchRegNo($_POST['id']);
        echo json_encode($aResult);
    }
}

function insert($con) {
    $id = $_POST['id'];
    $inventoryType = $_POST['type'];
    $code = $_POST['code'];
    $regno = $_POST['regno'];
    $engno = $_POST['engno'];
    $sno = $_POST['sno'];
    $year = $_POST['year'];
    $date = $_POST['date'];
    $hireinternal = $_POST['hireinternal'];
    $operator = $_POST['operator'];

    $r = mysql_query("INSERT INTO inventory(id, idinventorytype, code, regno, engno, sno, year, date, hireinternal, operator, status) VALUES('$id','$inventoryType','$code','$regno','$engno','$sno','$year','$date','$hireinternal','$operator','1')", $con);
    if (!$r) {
        header('Location: ../InventoryInsert.php?msg=error');
    }
    header('Location: ../InventoryView.php');
}

function searchForDisplay($category) {
    global $searchForDisplay;
    $query = "SELECT i.id,i.code,i.regno,it.model,it.make,it.country,i.engno,i.sno,it.capacity,i.year,i.operator,i.hireinternal,i.date,i.status,i.idinventorytype FROM inventory i INNER JOIN inventorytype it ON i.idinventorytype = it.id INNER JOIN inventorycat itcat ON itcat.id=it.idinventorycat WHERE itcat.category='$category'";
    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            while ($row = mysql_fetch_assoc($query_run)) {
                $id = $row['id'];
                $query2 = "SELECT s.location FROM site s JOIN transfernote tn ON tn.idsiteto=s.id WHERE tn.idinventory=$id ORDER BY tn.id DESC LIMIT 1";
                if ($query_run2 = mysql_query($query2)) {
                    if (mysql_num_rows($query_run2) != NULL) {
                        if ($row2 = mysql_fetch_assoc($query_run2)) {
                            $searchForDisplay[] = $row['id'] . ',' . $row['code'] . ',' . $row['regno'] . ',' . $row['model'] . ',' . $row['make'] . ',' . $row['country'] . ',' . $row['engno'] . ',' . $row['sno'] . ',' . $row['capacity'] . ',' . $row['year'] . ',' . $row['operator'] . ',' . $row['hireinternal'] . ',' . $row['date'] . ',' . $row2['location'] . ',' . $row['status'] . ',' . $row['idinventorytype'];
                        }
                    } else {
                        $searchForDisplay[] = $row['id'] . ',' . $row['code'] . ',' . $row['regno'] . ',' . $row['model'] . ',' . $row['make'] . ',' . $row['country'] . ',' . $row['engno'] . ',' . $row['sno'] . ',' . $row['capacity'] . ',' . $row['year'] . ',' . $row['operator'] . ',' . $row['hireinternal'] . ',' . $row['date'] . ',' . "Head Office" . ',' . $row['status'] . ',' . $row['idinventorytype'];
                    }
                }
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

function searchCode() {

    $query = "SELECT * FROM inventory";

    $result = '';
    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            while ($row = mysql_fetch_assoc($query_run)) {
                $result.=$row['id'] . ':' . $row['code'] . ',';
            }
        }
    }
    return $result;
}

function searchRegNo($code) {

    $query = "SELECT regno FROM inventory WHERE code='$code'";

    $result = '';
    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            while ($row = mysql_fetch_assoc($query_run)) {
                $result.=$row['regno'] . ',';
            }
        }
    }
    return $result;
}

function update($con) {
    $idinventorytype = $_POST['idinventorytype'];
    $id = $_POST['id'];
    $code = $_POST['code'];
    $regno = $_POST['regno'];
    $sno = $_POST['sno'];
    $engno = $_POST['engno'];
    $year = $_POST['year'];
    $date = $_POST['date'];
    $hireinternal = $_POST['hireinternal'];
    $operator = $_POST['operator'];

    $model = $_POST['model'];
    $make = $_POST['make'];
    $capacity = $_POST['capacity'];
    $country = $_POST['country'];

    $r = mysql_query("UPDATE hovael.inventorytype SET model='$model',make='$make',capacity='$capacity',country='$country' WHERE id='$idinventorytype'", $con);
    if (!$r) {
        header('Location: ../InventoryView.php?msg=error');
    } else {
        $r = mysql_query("UPDATE hovael.inventory SET code='$code',regno='$regno',sno='$sno',engno='$engno',year='$year',date='$date',hireinternal='$hireinternal',operator='$operator' WHERE id='$id'", $con);
        if (!$r) {
            header('Location: ../InventoryView.php?msg=error');
        }
    }
    header('Location: ../InventoryView.php');
}

if (isset($_POST['function']) && !empty($_POST['function']) && 'insert' == $_POST['function']) {
    insert($con);
}

if (isset($_POST['function']) && !empty($_POST['function']) && 'update' == $_POST['function']) {
    update($con);
}
?>