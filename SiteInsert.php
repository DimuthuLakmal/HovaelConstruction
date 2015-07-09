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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> 


    <?php
    session_start();
    $_SESSION['table'] = 'site';
    include './com.ebox.hovael.db/autoIncrementID.php';
    ?>

    <link rel="stylesheet" type="text/css" href="boostrap/css/bootstrap.min.css">

    <body>
        <form action="com.ebox.hovael.db/SiteToController.php" method="POST" id="insertForm">
            <label>Site Type ID : </label>
            <label ><?php echo $_SESSION['id'] ?></label><br>
            <input type="hidden" value="<?php echo $_SESSION['id'] ?>" name="id">
            <label> Location : </label><input type="text" name="location" required><br>
            <label> Start Date : </label><input type="text" id="startdate" name="startdate" size="30" required><br>
            <label> End Date : </label><input type="text" id="enddate" name="enddate" size="30" required><br>
            <label> Project Manager : </label><input type="text" name="projectmanager" id="projectmanager" required><br>
            <label> Site Manager : </label><input type="text" name="sitemanager" required><br>
            <label> Permanent : </label><input type="checkbox" name="permanent" ><br>
            <label> Status : </label><input type="checkbox" name="status"><br>
            <input type="hidden" value="insert" name="function">
            <input type="submit" value="Add" id="submit">
        </form>

        <script type="text/javascript" src="./com.ebox.hovael.js/jquery-2.1.3.min.js"></script>  
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script type="text/javascript" src="./com.ebox.hovael.js/validation.js"></script> 
        <script>
            $(function () {
                $("#startdate").datepicker({
                    dateFormat: 'yy-mm-dd'
                });
                $("#enddate").datepicker({
                    dateFormat: 'yy-mm-dd'
                });
            });

        </script>
        <script>
            $isStartDateOk = false;
            $isEndDateOk = false;
            $('#startdate').change(function () {
                if (isDate($(this).val())) {
                    //alert('aaa');
                    $isStartDateOk = true;
//                    if ($isEndDateOk && $isStartDateOk) {
//                        $('#submit').removeAttr('disabled');
//                    } else {
//                        $('#submit').attr('disabled', true);
//                    }
                } else {
                    $isStartDateOk = false;
                }
            });

            $('#enddate').change(function () {
                if (isDate($(this).val())) {
                    //alert('bbb');
                    $isEndDateOk = true;
//                    if ($isEndDateOk && $isStartDateOk) {
//                        $('#submit').removeAttr('disabled');
//                    } else {
//                        $('#submit').attr('disabled', true);
//                    }
                } else {
                    $isEndDateOk = false;
                }
            });

            var allInputs = $(":input");

//            $.each(allInputs, function (key, value) {
//                $(value).focusout(function () {
//                    if ($isEndDateOk && $isStartDateOk) {
//                        $('#submit').removeAttr('disabled');
//                    } else {
//                        $('#submit').attr('disabled', true);
//                    }
//                });
//
//            });
//            $('#permanent').change(function () {
//                if ($isEndDateOk && $isStartDateOk) {
//                    $('#submit').removeAttr('disabled');
//                } else {
//                    $('#submit').attr('disabled', true);
//                }
//            });
//
//            $('#status').change(function () {
//                if ($isEndDateOk && $isStartDateOk) {
//                    $('#submit').removeAttr('disabled');
//                } else {
//                    $('#submit').attr('disabled', true);
//                }
//            });

            $(document).on('submit', '#insertForm', function () {
                if (!$isEndDateOk || !$isStartDateOk) {
                    event.preventDefault();
                    alert('Please fill correctly');
                } 
            });

        </script>
    </body>
</html>
