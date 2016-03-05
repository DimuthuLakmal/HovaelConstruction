<?php

header('Content-Type: application/json');
include './connection.php';

$aResult = array();
$searchResultFromId = array();

if (isset($_POST['functionname'])) {
    if ('searchfromid' == $_POST['functionname']) {
        searchFromId($_POST['id']);
        echo json_encode($searchResultFromId);
    }
}

function searchFromId($id) {
    $query = "SELECT s.id FROM site s JOIN transfernote tn ON tn.idsiteto=s.id WHERE tn.idinventory=$id ORDER BY tn.id DESC LIMIT 1";

    $result = '';
    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            while ($row = mysql_fetch_assoc($query_run)) {
                global $searchResultFromId;
                $searchResultFromId = $row;
            }
        }else{
            global $searchResultFromId;
                $searchResultFromId = array("id"=>"1");
        }
    }
}
?>

