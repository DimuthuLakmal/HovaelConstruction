<?php

include '../com.ebox.hovael.db/connection.php';

class InventoryTypeController {

    function __construct() {
        
    }

    function insert(InventoryType $inventoryType) {

        global $con;
        $id = $inventoryType->getId();
        $category = $inventoryType->getCategory();
        $make = $inventoryType->getMake();
        $model = $inventoryType->getModel();
        $capacity = $inventoryType->getCapacity();
        $country = $inventoryType->getCountry();
        $status = $inventoryType->getStatus();

        $r = mysql_query("INSERT INTO inventorytype(id, idinventorycat, model, make, capacity, country, status) VALUES('$id','$category','$model','$make','$capacity','$country','$status')", $con);

        header('Location: ../InventoryView.php');
    }

}

?>