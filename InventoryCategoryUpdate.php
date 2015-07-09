<!DOCTYPE html>
<!--
This is to update inventory category
author:Dimuthu
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <link rel="stylesheet" type="text/css" href="boostrap/css/bootstrap.min.css">
    <body>
        <label> Select Category : </label>
        <select name="category" id="category">
        </select><br>
        <form action="com.ebox.hovael.db/InventoryCategory.php" method="POST">
            <label>Inventory Category ID : </label>
            <label id="idLabel"></label><br>
            <input type="hidden" name="id" id="id">
            <label>Type : </label>
            <select name="type" id="type">
                <option value="Vehicle">Vehicle</option>
                <option value="Machinery">Machinery</option>
                <option value="Equipment">Equipment</option>
            </select><br>
            <label> Service : </label><input type="text" name="service" id="service" required><br>
            <label> Status : </label><input type="checkbox" name="status" id="status"><br>
            <input type="hidden" value="update" name="function">
            <input type="submit" value="Update">
        </form>
        
        <script type="text/javascript" src="com.ebox.hovael.js/jquery-2.1.3.min.js"></script>
        <script type="text/javascript">
            $(window).ready(function () {
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
        
        <script type="text/javascript">
            $('#category').change(function () {
                var selectedId = $(this).val();
                jQuery.ajax({
                    type: "POST",
                    url: 'http://localhost/HovaelConstructions_v1.0/com.ebox.hovael.db/InventoryCategory.php',
                    dataType: 'json',
                    data: {functionname: 'searchfromid', id:selectedId},
                    success: function (obj, textstatus) {
                        if (!('error' in obj)) {
                            var data = obj;
                            $('#idLabel').html(data['id']);
                            $('#service').val(data['service']);
                            $('#type').val(data['type']);
                            if('1'==data['status']){
                                $('#status').prop('checked',true);
                            }
                            $('#id').val(data['id']);
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
