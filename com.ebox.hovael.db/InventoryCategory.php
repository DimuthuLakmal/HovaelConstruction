<?php

header('Content-Type: application/json');
include './connection.php';

$aResult = array();
$searchResultFromId = array();

if (isset($_POST['functionname'])) {
    if ('search' == $_POST['functionname']) {
        $aResult['result'] = search();
        echo json_encode($aResult);
    }if ('searchfromid' == $_POST['functionname']) {
        searchFromId($_POST['id']);
        echo json_encode($searchResultFromId);
    }
}

function insert($con) {
    $id = $_POST['id'];
    $category = $_POST['category'];
    $type = $_POST['type'];
    $service = $_POST['service'];

    $r = mysql_query("INSERT INTO inventorycat(id, category, type, service, status) VALUES('$id','$category','$type','$service','1')", $con);
    if (!$r) {
        header('Location: ../InventoryCategoryInsert.php?msg=error');
    }
    header('Location: ../InventoryCategoryView.php');
}

function update($con) {
    $id = $_POST['id'];
    $type = $_POST['type'];
    $service = $_POST['service'];
    $status = $_POST['status'];

    if ($status == 'on') {
        $status = 1;
    } else {
        $status = 0;
    }

    $r = mysql_query("UPDATE hovael.inventorycat SET type='$type',service='$service',status='$status' WHERE id='$id'", $con);
    if (!$r) {
        header('Location: ../InventoryCategoryView.php?msg=error');
    }
    header('Location: ../InventoryCategoryView.php');
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

function searchFromId($id) {
    $query = "SELECT * FROM inventorycat WHERE id=$id";

    $result = '';
    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            while ($row = mysql_fetch_assoc($query_run)) {
                global $searchResultFromId;
                $searchResultFromId = $row;
            }
        }
    }
}

if (isset($_POST['function']) && !empty($_POST['function']) && 'insert' == $_POST['function']) {
    insert($con);
}

if (isset($_POST['function']) && !empty($_POST['function']) && 'update' == $_POST['function']) {
    update($con);
}
?>