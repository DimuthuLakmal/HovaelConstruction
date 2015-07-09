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

function insert($con) {
    $id = $_POST['id'];
    $category = $_POST['category'];
    $make = $_POST['make'];
    $model = $_POST['model'];
    $capacity = $_POST['capacity'];
    $country = $_POST['country'];
    $status = $_POST['status'];

    if ($status == 'on') {
        $status = 1;
    } else {
        $status = 0;
    }

    echo $category . ' ' . $id . ' ' . $model . ' ' . $make . ' ' . $capacity . ' ' . $country . ' ' . $status;
    $r = mysql_query("INSERT INTO inventorytype(id, idinventorycat, model, make, capacity, country, status) VALUES('$id','$category','$model','$make','$capacity','$country','$status')", $con);

    header('Location: http://localhost/HovaelConstructions_v1.0/InventoryTypeInsert.php');
}


function search() {

    $query = "SELECT * FROM inventorytype";

    $result = '';
    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            while ($row = mysql_fetch_assoc($query_run)) {
                $result.=$row['model'] . ':' . $row['id'] . ',';
            }
        }
    }
    return $result;
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

function update($con) {
    $id = $_POST['id'];
    $model = $_POST['model'];
    $make = $_POST['make'];
    $capacity = $_POST['capacity'];
    $country = $_POST['country'];

    echo $id.' '.$model.' '.$make.' '.$capacity.' '.$country;
    $r = mysql_query("UPDATE hovael.inventorytype SET model='$model',make='$make',capacity='$capacity',country='$country' WHERE id='$id'", $con);
    if (!$r) {
        die('Could not update data: ' . mysql_error());
    }
    header('Location: http://localhost/HovaelConstructions_v1.0/InventoryTypeUpdate.php');
}

if (isset($_POST['function']) && !empty($_POST['function']) && 'insert' == $_POST['function']) {
    insert($con);
}

if (isset($_POST['functionname'])) {
    $aResult['result'] = search();
    echo json_encode($aResult);
}

if (isset($_POST['function']) && !empty($_POST['function']) && 'update' == $_POST['function']) {
    update($con);
}
?>