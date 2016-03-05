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
    $location = $_POST['location'];
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $projectmanager = $_POST['projectmanager'];
    $sitemanager = $_POST['sitemanager'];
    $permanent = $_POST['permanent'];
    $status = $_POST['status'];

    if ($status == 'on') {
        $status = 1;
    } else {
        $status = 0;
    }

    if ($permanent == 'on') {
        $permanent = 1;
    } else {
        $permanent = 0;
    }

//    echo $id . ' ' . $location . ' ' . $permanent . ' ' . $startdate . ' ' . $enddate . ' ' . $projectmanager . ' ' . $sitemanager . ' ' . $status;

    $r = mysql_query("INSERT INTO site(id, location, permanent, startdate, enddate, projectmanager, sitemanager, status) VALUES('$id','$location','$permanent','$startdate','$enddate','$projectmanager','$sitemanager','$status')", $con);
    if (!$r) {
        header('Location: ../SiteInsert.php?msg=error');
    }
    header('Location: ../SiteView.php');
}

function search() {

    $query = "SELECT * FROM site";

    $result = '';
    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            while ($row = mysql_fetch_assoc($query_run)) {
                $result.=$row['location'] . ':' . $row['id'] . ',';
            }
        }
    }
    return $result;
}

function update($con) {
    $id = $_POST['id'];
    $location = $_POST['locationForm'];
    $sitemanager = $_POST['sitemanager'];
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $projectmanager = $_POST['projectmanager'];
    $permanent = $_POST['permanent'];
    
    if ($permanent == 'on') {
        $permanent = 1;
    } else {
        $permanent = 0;
    }

    $r = mysql_query("UPDATE site SET location='$location',projectmanager='$projectmanager',sitemanager='$sitemanager',enddate='$enddate',startdate='$startdate',permanent='$permanent' WHERE id='$id'", $con);
    if (!$r) {
        header('Location: ../SiteUpdate.php?msg=error');
    }
    header('Location: ../SiteView.php');
}

function searchFromId($id) {
    $query = "SELECT * FROM site WHERE id=$id";

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

