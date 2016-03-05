<?php

include '../com.ebox.hovael.db/connection.php';

class SiteController {

    function __construct() {
        
    }

    function insert(Site $site) {
        global $con;
        $id = $site->getId();
        $location = $site->getLocation();
        $startdate = $site->getStartdate();
        $enddate = $site->getEnddate();
        $projectmanager = $site->getProjectmanager();
        $sitemanager = $site->getSitemanager();
        $permanent = $site->getPermanent();
        $status = $site->getStatus();

        echo $id . ' ' . $location . ' ' . $permanent . ' ' . $startdate . ' ' . $enddate . ' ' . $projectmanager . ' ' . $sitemanager . ' ' . $status;

        $r = mysql_query("INSERT INTO site(id, location, permanent, startdate, enddate, projectmanager, sitemanager, status) VALUES('$id','$location','$permanent','$startdate','$enddate','$projectmanager','$sitemanager','$status')", $con);

        header('Location: ../SiteView.php');
    }

    function search() {

        $query = "SELECT * FROM site WHERE status!=0";

        $result = array();
        $i = 0;
        if ($query_run = mysql_query($query)) {
            if (mysql_num_rows($query_run) != NULL) {
                while ($row = mysql_fetch_assoc($query_run)) {
                    $site = new Site('', '', '', '', '', '', '', '');
                    $site->setId($row['id']);
                    $site->setLocation($row['location']);
                    $result[$i] = $site;
                    $i++;
                    //$result.=$row['location'] . ':' . $row['id'] . ',';
                }
            }
        }
        return $result;
    }

}

function searchFromId($id) {
    $query = "SELECT * FROM site WHERE id=$id";

    $result = '';
    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            while ($row = mysql_fetch_assoc($query_run)) {
                return new Site($row['id'], $row['location'], $row['startdate'], $row['enddate'], $row['projectmanager'], $row['sitemanager'], $row['permanent'], $row['status']);
            }
        }
    }
}

function update(Site $site) {
    global $con;
    $id = $site->getId();
    $location = $site->getLocation();
    $startdate = $site->getStartdate();
    $enddate = $site->getEnddate();
    $projectmanager = $site->getProjectmanager();
    $sitemanager = $site->getSitemanager();
    $permanent = $site->getPermanent();
    $status = $site->getStatus();

    $r = mysql_query("UPDATE hovael.site SET location='$location',projectmanager='$projectmanager',sitemanager='$sitemanager',enddate='$enddate',startdate='$startdate',permanent='$permanent',status='$status' WHERE id='$id'", $con);
    if (!$r) {
        die('Could not update data: ' . mysql_error());
    }
    header('Location: ../SiteUpdate.php');
}

?>