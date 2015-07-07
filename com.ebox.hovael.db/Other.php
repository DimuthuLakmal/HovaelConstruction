<?php

include './connection.php';

$selectAll = array();
$nextId = array();

if (isset($_POST['functionname'])) {
    if ('search' == $_POST['functionname']) {
        $aResult = search();
        echo json_encode($aResult);
    }
    if ('nextid' == $_POST['functionname']) {
        $nextId[0] = getNextID();
        echo json_encode($nextId);
    }
}

function search() {
    $jobcardid = $_POST['idjobcard'];
    $query = "SELECT * FROM other where idjobcard='$jobcardid'";
    $data = array();
    $index = 0;

    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            $result = '';
            while ($row = mysql_fetch_assoc($query_run)) {
                $result .= $row['id'] . ':' . $row['description'] . ':' . $row['cost'] . ':' . $row['status'];
                $data[$index] = $result;
                $index++;
                $result = '';
            }
        }
    }
    return $data;
}

function getNextID() {
    $query = "SELECT * FROM other order by id desc limit 1;";

    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            while ($row = mysql_fetch_assoc($query_run)) {
                $id = $row["id"] + 1;
            }
        }
    }
    if (isset($id)) {
        return $id;
    } else {
        return 1;
    }
}

?>
