
<!--
This is to insert fuel book
author:Dimuthu
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <link rel="stylesheet" type="text/css" href="boostrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> 

    <?php
    session_start();
    $_SESSION['table'] = 'fuelbook';
    include './com.ebox.hovael.db/autoIncrementID.php';
    ?>
    <body>
        <form action="com.ebox.hovael.db/FuelBook.php" method="POST" id="insertForm">
            <label>Fuel Book ID : </label>
            <label ><?php echo $_SESSION['id'] ?></label><br>
            <input type="hidden" value="<?php echo $_SESSION['id'] ?>" name="id">

            <label> Reg No : </label><input type="text" name="regno" id="regno"><br>
            <label>Fuel : </label>
            <select id="fuel" name="fuel">
            </select><br>
            <label> Date : </label><input type="text" id="date" name="date" size="30" required><br>
            <label> Qty : </label><input type="text" name="qty" id="qty" required><br>
            <label> Meter Reading : </label><input type="text" name="meterreading" id="meterreading" required><br>
            <label> Remarks : </label><input type="text" name="remarks" id="remarks"><br>
            <label> Status : </label><input type="checkbox" name="status" id="status"><br>
            <input type="hidden" value="insert" name="function">
            <input type="submit" value="Add" id="submit">
        </form>
        <script type="text/javascript" src="./com.ebox.hovael.js/jquery-2.1.3.min.js"></script> 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>         
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="com.ebox.hovael.js/validation.js"></script>
        <script>
            $(document).ready(function () {
                jQuery.ajax({
                    type: "POST",
                    url: 'http://localhost/HovaelConstructions_v1.0/com.ebox.hovael.db/FuelStock.php',
                    dataType: 'json',
                    data: {functionname: 'search'},
                    success: function (obj, textstatus) {
                        if (!('error' in obj)) {
                            var category = obj.result.split(",");
                            $.each(category, function (val, text) {
                                if (text != '') {
                                    $('#fuel').append($('<option></option>').val(text.split(':')[1]).html(text.split(':')[0]));
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
            $(function () {
                $("#date").datepicker({
                    dateFormat: 'yy-mm-dd'
                });
            });</script>
        <script>
            $isDateOk = false;
            $isRegNoOk = false;
            $('#date').change(function () {
                if (isDate($(this).val())) {
                    $isDateOk = true;
                } else {
                    $isDateOk = false;
                }
            });

            $('#regno').focusout(function () {
                var x = $(this).val().split('-');
                if ($.isNumeric(x[0]) && $.isNumeric(x[1])) {
                    $isRegNoOk = true;
                } else {
                    var matches = $(this).val().match(/\d+/g);
                    if (matches != null && $.isNumeric(x[1])) {
                        $isRegNoOk = true;
                    }
                    else {
                        $isRegNoOk = false;
                    }
                }
            });

//            var allInputs = $(":input");
//
//            $.each(allInputs, function (key, value) {
//
//                $(value).focusout(function () {
//                    if ($isDateOk && $isRegNoOk && $.isNumeric($('#meterreading').val()) && $.isNumeric($('#qty').val())) {
//                        $('#submit').removeAttr('disabled');
//                    } else {
//                        $('#submit').attr('disabled', true);
//                    }
//                });
//
//            });
//            $('#fuel').change(function () {
//                
//                if ($isDateOk && $isRegNoOk && $.isNumeric($('#meterreading').val()) && $.isNumeric($('#qty').val())) {
//                    $('#submit').removeAttr('disabled');
//                } else {
//                    $('#submit').attr('disabled', true);
//                }
//            });
//
//            $('#status').change(function () {
//                if ($isDateOk && $isRegNoOk && $.isNumeric($('#meterreading').val()) && $.isNumeric($('#qty').val())) {
//                    $('#submit').removeAttr('disabled');
//                } else {
//                    $('#submit').attr('disabled', true);
//                }
//            });

            $(document).on('submit', '#insertForm', function () {
                if (!$isDateOk || !$isRegNoOk || !$.isNumeric($('#meterreading').val()) || !$.isNumeric($('#qty').val())) {
                    event.preventDefault();
                    alert('Please fill correctly');
                }
            });
        </script>
    </body>
</html>
