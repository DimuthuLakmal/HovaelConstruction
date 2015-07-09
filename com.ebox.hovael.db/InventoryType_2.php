<?php

include './connection.php';
header('Content-Type: application/json');

$searchForDisplay_1 = array();

if (isset($_POST['functionname'])) {
    if ('searchForDisplay' == $_POST['functionname']) {
        searchForDisplay($_POST['category']);
        echo json_encode($searchForDisplay_1);
    }
}

function searchForDisplay($category) {

    global $searchForDisplay_1;
    $query = "SELECT it.id,it.model,it.make,it.country,it.capacity,it.status,count(i.id) as count FROM inventorytype it left join inventory i on i.idinventorytype = it.id inner join inventorycat itcat on itcat.id=it.idinventorycat where itcat.category='$category' group by it.id ;";
    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            while ($row = mysql_fetch_assoc($query_run)) {
                $searchForDisplay_1[] = $row['id'] . ',' . $row['model'] . ',' . $row['make'] . ',' . $row['country'] . ',' . $row['capacity'] . ',' . $row['count'] . ',' . $row['status'];
            }
        }
    }
}

?>