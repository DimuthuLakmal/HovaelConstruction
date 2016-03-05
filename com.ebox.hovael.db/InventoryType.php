<?php

include './connection.php';
header('Content-Type: application/json');

$searchForDisplay = array();

if (isset($_POST['functionname'])) {
    if ('searchForDisplay' == $_POST['functionname']) {
        searchForDisplay($_POST['category']);
        echo json_encode($searchForDisplay);
    }
}

function insert($con) {
    $id = $_POST['id'];
    $category = $_POST['category'];
    $make = $_POST['make'];
    $model = $_POST['model'];
    $capacity = $_POST['capacity'];
    $country = $_POST['country'];

//    echo $category . ' ' . $id . ' ' . $model . ' ' . $make . ' ' . $capacity . ' ' . $country . ' ' . $status;
    $r = mysql_query("INSERT INTO inventorytype(id, idinventorycat, model, make, capacity, country, status) VALUES('$id','$category','$model','$make','$capacity','$country','1')", $con);
    if (!$r) {
        header('Location: ../InventoryTypeInsert.php?msg=error');
    }
    header('Location: ../InventoryTypeView.php');
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

    global $searchForDisplay;
    $query = "SELECT it.id,it.model,it.make,it.country,it.capacity,it.status,count(i.id) as count FROM inventorytype it left join inventory i on i.idinventorytype = it.id inner join inventorycat itcat on itcat.id=it.idinventorycat where itcat.category='$category' group by it.id ;";
    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            while ($row = mysql_fetch_assoc($query_run)) {
                $searchForDisplay[] = $row['id'] . ',' . $row['model'] . ',' . $row['make'] . ',' . $row['country'] . ',' . $row['capacity'] . ',' . $row['count'] . ',' . $row['status'];
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

//    echo $id.' '.$model.' '.$make.' '.$capacity.' '.$country;
    $r = mysql_query("UPDATE hovael.inventorytype SET model='$model',make='$make',capacity='$capacity',country='$country' WHERE id='$id'", $con);
    if (!$r) {
        header('Location: ../InventoryTypeView.php?msg=error');
    }
    header('Location: ../InventoryTypeView.php');
}

if (isset($_POST['function']) && !empty($_POST['function']) && 'insert' == $_POST['function']) {
    insert($con);
}

if (isset($_POST['functionname']) && 'search' == $_POST['functionname']) {
    $aResult['result'] = search();
    echo json_encode($aResult);
}

//if (isset($_POST['functionname'])) {
//    $aResult['result'] = search();
//    echo json_encode($aResult);
//}

if (isset($_POST['function']) && !empty($_POST['function']) && 'update' == $_POST['function']) {
    update($con);
}
?>