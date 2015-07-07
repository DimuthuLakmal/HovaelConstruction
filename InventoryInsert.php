<!--
This is to insert inventory items
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
    $_SESSION['table'] = 'inventory';
    include './com.ebox.hovael.db/autoIncrementID.php';
    ?>
    <body>
        <form action="com.ebox.hovael.db/Inventory.php" method="POST">
            <label>Inventory Type ID : </label>
            <label ><?php echo $_SESSION['id'] ?></label><br>
            <input type="hidden" value="<?php echo $_SESSION['id'] ?>" name="id">
            <label>Model : </label>
            <select id="type" name="type" id="type">
            </select><br>
            <label> Registration No : </label><input type="text" name="regno" id="regno" required><div class="alert alert-danger" role="alert" style="display:none" id="alertdiv">Not a valid number</div><br>
            <label> Engine No : </label><input type="text" name="engno" required><br>
            <label> Serial No : </label><input type="text" name="sno" required><br>
            <label> Year : </label><input type="text" name="year" required id="year"><div class="alert alert-danger" role="alert" style="display:none" id="alertdiv">Not a valid year</div><br>
            <label> Date : </label><input type="text" name="date" required id="date" placeholder="yyyy-mm-dd"><div class="alert alert-danger" role="alert" style="display:none" id="alertdiv">Not a valid date</div><br>
            <label> Internal Hire Rate: </label><input type="text" name="hireinternal" required><br>
            <label> Operator : </label><input type="text" name="operator" required id="operator"><br>
            <label> Status : </label><input type="checkbox" name="status" id="status"><br>
            <input type="hidden" value="insert" name="function">
            <input type="submit" value="Add" id="submit" disabled>
        </form>

        <script type="text/javascript" src="./com.ebox.hovael.js/jquery-2.1.3.min.js"></script> 
        <script type="text/javascript" src="./com.ebox.hovael.js/validation.js"></script> 
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
        <script>

            $isRegNoOk = false;
            $isYearOk = false;
            $isDateOk = false;
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
            $('#year').focusout(function () {
                if ($.isNumeric($('#year').val()) && $('#year').val() <= (new Date).getFullYear() && $('#year').val() >= 1900) {
                    $isYearOk = true;
                }
                else {
                    $isYearOk = false;
                }

            });
            $('#date').focusout(function () {
                if (isDate($(this).val())) {
                    $isDateOk = true;
                } else {
                    $isDateOk = false;
                }
            });



            var allInputs = $(":input");

//            $('#operator').focusout(function () {
//                alert($isRegNoOk);
//
//            });

            $.each(allInputs, function (key, value) {
                $(value).focusout(function () {
                    if ($isDateOk && $isYearOk && $isRegNoOk) {
                        $('#submit').removeAttr('disabled');
                    } else {
                        $('#submit').attr('disabled', true);
                    }
                });
                $('#type').change(function () {
                    if ($isDateOk && $isYearOk && $isRegNoOk) {
                        $('#submit').removeAttr('disabled');
                    } else {
                        $('#submit').attr('disabled', true);
                    }
                });

                $('#status').change(function () {
                    if ($isDateOk && $isYearOk && $isRegNoOk) {
                        $('#submit').removeAttr('disabled');
                    } else {
                        $('#submit').attr('disabled', true);
                    }
                });
            });
        </script>
    </body>
</html>
