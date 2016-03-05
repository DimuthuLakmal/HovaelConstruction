<?php

include '../com.ebox.hovael.model/InventoryType.php';
include '../com.ebox.hovael.controller/InventoryTypeController.php';

if (isset($_POST['function']) && !empty($_POST['function']) && 'insert' == $_POST['function']) {
    insert();
}

function insert() {
    $id = $_POST['id'];
    $category = $_POST['category'];
    $make = $_POST['make'];
    $model = $_POST['model'];
    $capacity = $_POST['capacity'];
    $country = $_POST['country'];

    $inventoryType = new InventoryType($id, $category, $make, $model, $capacity, $country, 1);
    $inventoryTypeController = new InventoryTypeController();
    $inventoryTypeController->insert($inventoryType);
}

?>