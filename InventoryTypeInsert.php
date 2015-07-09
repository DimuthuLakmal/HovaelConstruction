
<!--
This is to insert inventory type
author:Dimuthu
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <link rel="stylesheet" type="text/css" href="boostrap/css/bootstrap.min.css">
    <?php
    session_start();
    $_SESSION['table'] = 'inventorytype';
    include './com.ebox.hovael.db/autoIncrementID.php';
    ?>
    <body>
        <form action="com.ebox.hovael.db/InventoryTypeToController.php" method="POST">
            <label>Inventory Type ID : </label>
            <label ><?php echo $_SESSION['id'] ?></label><br>
            <input type="hidden" value="<?php echo $_SESSION['id'] ?>" name="id">
            <label>Category : </label>
            <select id="category" name="category">
            </select><br>
            <label> Model : </label><input type="text" name="model" required><br>
            <label> Make : </label><input type="text" name="make" required><br>
            <label> Capacity : </label><input type="text" name="capacity" required><br>
            <label> Country : </label><input type="text" name="country" required><br>
            <label> Status : </label><input type="checkbox" name="status"><br>
            <input type="hidden" value="insert" name="function">
            <input type="submit" value="Add" id="submit">
        </form>
        
        <script type="text/javascript" src="./com.ebox.hovael.js/jquery-2.1.3.min.js"></script>      
        <script>
            $(document).ready(function () {
                jQuery.ajax({
                    type: "POST",
                    url: 'http://localhost/HovaelConstructions_v1.0/com.ebox.hovael.db/InventoryCategory.php',
                    dataType: 'json',
                    data: {functionname: 'search'},
                    success: function (obj, textstatus) {
                        if (!('error' in obj)) {
                            var category = obj.result.split(",");
                            $.each(category, function (val, text) {
                                if (text != '') {
                                    $('#category').append($('<option></option>').val(text.split(':')[1]).html(text.split(':')[0]));
                                }
                            });
                        }
                        else {
                            console.log(obj.error);
                        }
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function () {
                jQuery.ajax({
                    type: "POST",
                    url: 'http://localhost/HovaelConstructions_v1.0/com.ebox.hovael.db/InventoryType.php',
                    dataType: 'json',
                    data: {functionname: 'search'},
                    success: function (obj, textstatus) {
                        if (!('error' in obj)) {
                            var category = obj.result.split(",");
                            $.each(category, function (val, text) {
                                if (text != '') {
                                    $('#type').append($('<option></option>').val(text.split(':')[1]).html(text.split(':')[0]));
                                }
                            });
                        }
                        else {
                            console.log(obj.error);
                        }
                    }
                });
            });
        </script>
       
    </body>
</html>
