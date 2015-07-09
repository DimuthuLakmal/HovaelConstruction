<!DOCTYPE html>
<!--
This is to update inventory type
author:Dimuthu
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <link rel="stylesheet" type="text/css" href="boostrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>

    <style type="text/css">
        #tabsection{
            margin: 20px;
        }
        table{
            font-size: 16px;
        }
        li{
            font-size: 18px;
        }
        #updatealert{
            display: none;
        }
        .ui-widget{
            padding-top: 10px;
            padding-bottom: 10px;
        }
    </style>
    <body>
        <button data-display="modalWindow" data-animation="fade" data-animationspeed="300" data-closeBGclick="true" id="modalButton" style="display: none">My Project</button><br>
        <!-- portBox Content -->

        <div id="modalWindow" class="col-md-10 portBox">
            <form action="#" method="POST">
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
        </div>
        <div id="tabsection">
            <ul class="nav nav-tabs" id="tabs">      
            </ul>
            <div class="tab-content" id="tab-content">
            </div>
        </div>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>      
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="com.ebox.hovael.js/jquery-ui-1.10.3.custom.min.js"></script>
        <script src="com.ebox.hovael.js/portBox.slimscroll.min.js"></script>
        <link href="com.ebox.hovael.css/portBox.css" rel="stylesheet" />
        <script type="text/javascript" src="./com.ebox.hovael.js/validation.js"></script> 
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
                            var i = 1;
                            $.each(category, function (val, text) {
                                if (text != '') {
                                    $('#tabs').append("<li><a data-toggle=\"tab\" id=\"li" + text.split(":")[0] + "\" href=\"#section" + text.split(":")[0] + "\">" + text.split(":")[0] + "</a></li>");
                                    if (i == 1) {
                                        $('#tab-content').append("<div id=\"section" + text.split(":")[0] + "\"></div>");
                                        $("#section" + text.split(":")[0]).addClass("tab-pane fade in active");
                                    } else {
                                        $('#tab-content').append("<div id=\"section" + text.split(":")[0] + "\" ></div>");
                                        $("#section" + text.split(":")[0]).addClass("tab-pane fade");
                                    }
                                    a(text.split(":")[0]);
                                    i++;
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
            function a(category) {
                $('#section' + category).append("<div class=\"ui-widget\"><label for=\"search" + category + "\">Search  </label><input id=\"search" + category + "\"></div>");

                $('#section' + category).append("<table id=\"table" + category + "\" class=\"table table-hover\"><thead><tr><th>ID</th><th>Reg No</th><th>Model</th><th>Make</th><th>Country</th><th>Eng No</th><th>S No</th><th>Capacity</th><th>Year</th><th>Operator</th><th>Hire Rate</th><th>Date</th><th>Status</th></tr></thead></table>");
                jQuery.ajax({
                    type: "POST",
                    url: 'http://localhost/HovaelConstructions_v1.0/com.ebox.hovael.db/InventoryType.php', dataType: 'json', data: {functionname: 'searchForDisplay', category: 'qwq'},
                    success: function (obj, textstatus) {
                        if (!('error' in obj)) {
                            var data = obj;
                            var i = 1;
                            alert('fsad');
//                            $.each(data, function (val, text) {
//                                var rowDetail = text.split(',');
//                                var status = 'Not Available';
//                                if ('1' == rowDetail[12]) {
//                                    status = 'Available';
//                                }
//                                var inventoryTypeId = rowDetail[13];
//                                $("#table" + category).append("<tr id=\"row" + i.toString() + category + "\"><td>" + rowDetail[0] + "</td><td>" + rowDetail[1] + "</td><td>" + rowDetail[2] + "</td><td>" + rowDetail[3] + "</td><td>" + rowDetail[4] + "</td><td>" + rowDetail[5] + "</td><td>" + rowDetail[6] + "</td><td>" + rowDetail[7] + "</td><td>" + rowDetail[8] + "</td><td>" + rowDetail[9] + "</td><td>" + rowDetail[10] + "</td><td>" + rowDetail[11] + "</td><td>" + status + "</td><td><button class=\"btn btn-primary\" onclick=\"update('" + i.toString() + category + "','" + inventoryTypeId + "')\" id=\"button" + i.toString() + category + "\">Update</button></td></tr>")
//                            });
                        }
                        else {
                            console.log(obj.error);
                        }
                    }
                });
            }
        </script>

    </body>
</html>

