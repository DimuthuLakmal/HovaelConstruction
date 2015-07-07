<?php

include './connection.php';

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

    echo $category.' '.$id.' '.$model.' '.$make.' '.$capacity.' '.$country.' '.$status;
    $r = mysql_query("INSERT INTO inventorytype(id, idinventorycat, model, make, capacity, country, status) VALUES('$id','$category','$model','$make','$capacity','$country','$status')", $con);

    header('Location: http://localhost/HovaelConstructions_v1.0/InventoryTypeInsert.php');
}

function update($con) {
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

    echo $category.' '.$id.' '.$model.' '.$make.' '.$capacity.' '.$country.' '.$status;
    $r = mysql_query("INSERT INTO inventorytype(id, idinventorycat, model, make, capacity, country, status) VALUES('$id','$category','$model','$make','$capacity','$country','$status')", $con);

    header('Location: http://localhost/HovaelConstructions_v1.0/InventoryTypeInsert.php');
}

function search() {

    $query = "SELECT * FROM inventorytype";

    $result='';
    if ($query_run = mysql_query($query)) {
        if (mysql_num_rows($query_run) != NULL) {
            while ($row = mysql_fetch_assoc($query_run)) {
                $result.=$row['model'].':'.$row['id'].',';
            }
        }
    }
    return $result;
}

if (isset($_POST['function']) && !empty($_POST['function']) && 'insert' == $_POST['function']) {
    insert($con);
}

if(isset($_POST['functionname'])){
    $aResult['result']=  search();
    echo json_encode($aResult);
}

?>