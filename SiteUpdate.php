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


    <body>
        <label> Select Site : </label>
        <select name="location" id="location">
        </select><br>
        <form action="com.ebox.hovael.db/Site.php" method="POST">
            <label>Site Type ID : </label>
            <label id="idLabel"></label><br>
            <input type="hidden" name="id" id="id">
            <label> Location : </label><input type="text" id="locationForm" name="locationForm" required><br>
            <label> Start Date : </label><input type="text" id="startdate" name="startdate" size="30" required><br>
            <label> End Date : </label><input type="text" id="enddate" name="enddate" size="30" required><br>
            <label> Project Manager : </label><input type="text" id="projectmanager" name="projectmanager" required><br>
            <label> Site Manager : </label><input type="text" id="sitemanager" name="sitemanager" required><br>
            <label> Permanent : </label><input type="checkbox" id="permanent" name="permanent"><br>
            <label> Status : </label><input type="checkbox" id="status" name="status"><br>
            <input type="hidden" value="update" name="function">
            <input type="submit" value="Update" id="submit">
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
        <script type="text/javascript">
            $(window).ready(function () {
                jQuery.ajax({
                    type: "POST",
                    url: 'http://localhost/HovaelConstructions_v1.0/com.ebox.hovael.db/Site.php',
                    dataType: 'json',
                    data: {functionname: 'search'},
                    success: function (obj, textstatus) {
                        if (!('error' in obj)) {
                            var category = obj.result.split(",");
                            $.each(category, function (val, text) {
                                if (text != '') {
                                    $('#location').append($('<option></option>').val(text.split(':')[1]).html(text.split(':')[0]));
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
            $('#location').change(function () {
                var selectedId = $(this).val();
                jQuery.ajax({
                    type: "POST",
                    url: 'http://localhost/HovaelConstructions_v1.0/com.ebox.hovael.db/site.php',
                    dataType: 'json',
                    data: {functionname: 'searchfromid', id: selectedId},
                    success: function (obj, textstatus) {
                        if (!('error' in obj)) {
                            var data = obj;
                            $('#idLabel').html(data['id']);
                            $('#locationForm').val(data['location']);
                            $('#startdate').val(data['startdate']);
                            $('#enddate').val(data['enddate']);
                            $('#projectmanager').val(data['projectmanager']);
                            $('#sitemanager').val(data['sitemanager']);
                            if ('1' == data['status']) {
                                $('#status').prop('checked', true);
                            }
                            if ('1' == data['permanent']) {
                                $('#permanent').prop('checked', true);
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
        <script>
            $isStartDateOk = true;
            $isEndDateOk = true;
            $('#startdate').change(function () {
                if (isDate($(this).val())) {
                    //alert('aaa');
                    $isStartDateOk = true;
                    if ($isEndDateOk && $isStartDateOk) {
                        $('#submit').removeAttr('disabled');
                    } else {
                        $('#submit').attr('disabled', true);
                    }
                } else {
                    $isStartDateOk = false;
                }
            });

            $('#enddate').change(function () {
                if (isDate($(this).val())) {
                    //alert('bbb');
                    $isEndDateOk = true;
                    if ($isEndDateOk && $isStartDateOk) {
                        $('#submit').removeAttr('disabled');
                    } else {
                        $('#submit').attr('disabled', true);
                    }
                } else {
                    $isEndDateOk = false;
                }
            });

            var allInputs = $(":input");

            $.each(allInputs, function (key, value) {
                $(value).focusout(function () {
                    if ($isEndDateOk && $isStartDateOk) {
                        $('#submit').removeAttr('disabled');
                    } else {
                        $('#submit').attr('disabled', true);
                    }
                });

            });
            $('#permanent').change(function () {
                if ($isEndDateOk && $isStartDateOk) {
                    $('#submit').removeAttr('disabled');
                } else {
                    $('#submit').attr('disabled', true);
                }
            });

            $('#status').change(function () {
                if ($isEndDateOk && $isStartDateOk) {
                    $('#submit').removeAttr('disabled');
                } else {
                    $('#submit').attr('disabled', true);
                }
            });


        </script>
    </body>
</html>
