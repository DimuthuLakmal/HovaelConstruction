<?php
include '../com.ebox.hovael.model/Site.php';

class SiteController {

    
    function insert(Site $site) {
        $id = $site->getId();
        $location = $site->getLocation();
        $startdate = $site->getStartdate();
        $enddate = $site->getEnddate();
        $projectmanager = $site->getProjectmanager();
        $sitemanager = $site->getSitemanager();
        $permanent = $site->getPermanent();
        $status = $site->getStatus();

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

        echo $id . ' ' . $location . ' ' . $permanent . ' ' . $startdate . ' ' . $enddate . ' ' . $projectmanager . ' ' . $sitemanager . ' ' . $status;

        $r = mysql_query("INSERT INTO site(id, location, permanent, startdate, enddate, projectmanager, sitemanager, status) VALUES('$id','$location','$permanent','$startdate','$enddate','$projectmanager','$sitemanager','$status')", $con);

        header('Location: http://localhost/HovaelConstructions_v1.0/SiteInsert.php');
    }

}

?>