<?php

function checkSitesExpired() {
    include '../DBCon.php';
    $res = mysqli_query($con, "SELECT * FROM site WHERE status!=0 AND id!=1");
    while ($row = mysqli_fetch_array($res)) {
        $idsite = $row['id'];
        $enddate = $row['enddate'];
        $from = strtotime($enddate);
        $today = time();
        $difference = $from - $today;
        $x = floor($difference / (60 * 60 * 24));

        if ($x <= 0) {
            $res2 = mysqli_query($con, "UPDATE site SET status=0 WHERE id='$idsite'");
            if ($res2) {
                continue;
            }
        }
    }
}

function isSitesToBeExpired($enddate) {
    $from = strtotime($enddate);
    $today = time();
    $difference = $from - $today;
    $x = floor($difference / (60 * 60 * 24));
    if ($x <= 5 && $x > 0) {
        return TRUE;
    }
    return FALSE;
}

?>