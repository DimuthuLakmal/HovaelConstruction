<!DOCTYPE html>
<!--
This is to insert inventory category
author:Dimuthu
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <link rel="stylesheet" type="text/css" href="boostrap/css/bootstrap.min.css">
    <?php
        ob_start();
        session_start();
        $_SESSION['table']='inventorycat';
        include './com.ebox.hovael.db/autoIncrementID.php';
        
    ?>
    <body>
        <form action="com.ebox.hovael.db/InventoryCategory.php" method="POST">
            <label>Inventory Category ID : </label>
            <label ><?php echo $_SESSION['id'] ?></label><br>
            <input type="hidden" value="<?php echo $_SESSION['id'] ?>" name="id">
            <label>Type : </label>
            <select name="type">
                <option value="Vehicle">Vehicle</option>
                <option value="Machinery">Machinery</option>
                <option value="Equipment">Equipment</option>
            </select><br>
            <label> Category : </label><input type="text" name="category" required><br>
            <label> Service : </label><input type="text" name="service" required><br>
            <label> Status : </label><input type="checkbox" name="status"><br>
            <input type="hidden" value="insert" name="function">
            <input type="submit" value="Add">
        </form>
    </body>
</html>
