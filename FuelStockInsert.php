
<!--
This is to insert fuel stock
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
    $_SESSION['table'] = 'fuelstock';
    include './com.ebox.hovael.db/autoIncrementID.php';
    ?>
    <body>
        <form action="com.ebox.hovael.db/FuelStock.php" method="POST" id="insertForm">
            <label>Fuel ID : </label>
            <label ><?php echo $_SESSION['id'] ?></label><br>
            <input type="hidden" value="<?php echo $_SESSION['id'] ?>" name="id">
            <label>Site : </label>
            <select id="site" name="site">
            </select><br>
            <label> Name : </label><input type="text" name="name" id="name" required><br>
            <label> Price : </label><input type="text" name="price" id="price" required><br>
            <label> Qty : </label><input type="text" name="qty" id="qty" required><br>
            <label> Status : </label><input type="checkbox" name="status" id="status"><br>
            <input type="hidden" value="insert" name="function">
            <input type="submit" value="Add" id="submit">
        </form>

        <script type="text/javascript" src="./com.ebox.hovael.js/jquery-2.1.3.min.js"></script>      
        <script>
            $(document).ready(function () {
                jQuery.ajax({
                    type: "POST",
                    url: 'http://localhost/HovaelConstructions_v1.0/com.ebox.hovael.db/SiteToController.php',
                    dataType: 'json',
                    data: {functionname: 'search'},
                    success: function (obj, textstatus) {
                        if (!('error' in obj)) {
                            var category = obj.result.split(",");
                            $.each(category, function (val, text) {
                                if (text != '') {
                                    $('#site').append($('<option></option>').val(text.split(':')[1]).html(text.split(':')[0]));
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
//            var allInputs = $(":input");
//
//            $.each(allInputs, function (key, value) {
//
//                $(value).focusout(function () {
//                    if ($.isNumeric($('#price').val()) && $.isNumeric($('#qty').val())) {
//                        $('#submit').removeAttr('disabled');
//                    } else {
//                        $('#submit').attr('disabled', true);
//                    }
//                });
//
//            });
//            $('#site').change(function () {
//
//                if ($.isNumeric($('#price').val()) && $.isNumeric($('#qty').val())) {
//                    $('#submit').removeAttr('disabled');
//                } else {
//                    $('#submit').attr('disabled', true);
//                }
//            });
//
//            $('#status').change(function () {
//                if ($.isNumeric($('#price').val()) && $.isNumeric($('#qty').val())) {
//                    $('#submit').removeAttr('disabled');
//                } else {
//                    $('#submit').attr('disabled', true);
//                }
//            });
            $(document).on('submit', '#insertForm', function () {
                if (!$.isNumeric($('#price').val()) || !$.isNumeric($('#qty').val())) {
                    event.preventDefault();
                    alert('Please fill correctly');
                }
            });
        </script>

    </body>
</html>
