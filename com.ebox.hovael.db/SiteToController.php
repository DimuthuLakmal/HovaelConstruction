<?php

include '../com.ebox.hovael.model/Site.php';
include '../com.ebox.hovael.controller/SiteController.php';

$aResult = array();

if (isset($_POST['function']) && !empty($_POST['function']) && 'insert' == $_POST['function']) {
    insert();
}
if (isset($_POST['function']) && !empty($_POST['function']) && 'update' == $_POST['function']) {
    update_form($con);
}

function insert() {
    $id = $_POST['id'];
    $location = $_POST['location'];
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $projectmanager = $_POST['projectmanager'];
    $sitemanager = $_POST['sitemanager'];
    $permanent = $_POST['permanent'];

    if ($permanent == 'on') {
        $permanent = 1;
    } else {
        $permanent = 0;
    }

    $site = new Site($id, $location, $startdate, $enddate, $projectmanager, $sitemanager, $permanent, 1);

    //echo $id . ' ' . $location . ' ' . $permanent . ' ' . $startdate . ' ' . $enddate . ' ' . $projectmanager . ' ' . $sitemanager . ' ' . $status;

    $siteController = new SiteController();
    $siteController->insert($site);

    //header('Location: http://localhost/HovaelConstructions_v1.0/SiteInsert.php');
}

if (isset($_POST['functionname'])) {
    $siteController = new SiteController();
    if ('search' == $_POST['functionname']) {
        $aResult = $siteController->search();
        $result = '';
        for ($i = 0; $i < count($aResult); $i++) {
            $site = $aResult[$i];
            $result.= ($site->getLocation()) . ':' . ($site->getid()) . ',';
        }
        $final['result'] = $result;
        echo json_encode($final);
    }
}

function update_form($con) {
    $id = $_POST['id'];
    $location = $_POST['locationForm'];
    $sitemanager = $_POST['sitemanager'];
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $projectmanager = $_POST['projectmanager'];
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

    $site = new Site($id, $location, $startdate, $enddate, $projectmanager, $sitemanager, $permanent, $status);

    //echo $id . ' ' . $location . ' ' . $permanent . ' ' . $startdate . ' ' . $enddate . ' ' . $projectmanager . ' ' . $sitemanager . ' ' . $status;

    $siteController = new SiteController();
    $siteController->update($site);
}

?>
