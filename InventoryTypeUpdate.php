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

        <div id="modalWindow" class="col-md-5 portBox" style="display: none">
            <form action="com.ebox.hovael.db/InventoryType.php" method="POST">
                <label>Inventory Type ID : </label>
                <label id="idLabel"></label><br>
                <input type="hidden" id="id" name="id">
                <label> Model : </label><input type="text" id="model" name="model" required><br>
                <label> Make : </label><input type="text" id="make" name="make" required><br>
                <label> Capacity : </label><input type="text" id="capacity" name="capacity" required><br>
                <label> Country : </label><input type="text" id="country" name="country" required><br>
                <input type="hidden" value="update" name="function">
                <input type="submit" value="Update" id="submit" id="submit">
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

                $('#section' + category).append("<table id=\"table" + category + "\" class=\"table table-hover\"><thead><tr><th>ID</th><th>Model</th><th>Make</th><th>Country</th><th>Capacity</th><th>No of Items</th><th>Status</th></tr></thead></table>");
                jQuery.ajax({
                    type: "POST",
                    url: 'http://localhost/HovaelConstructions_v1.0/com.ebox.hovael.db/InventoryType_2.php', dataType: 'json', data: {functionname: 'searchForDisplay', category: category},
                    success: function (obj, textstatus) {
                        if (!('error' in obj)) {
                            var data = obj;
                            var i = 1;
                            $.each(data, function (val, text) {
                                var rowDetail = text.split(',');
                                var status = 'Not Available';
                                if ('1' == rowDetail[6]) {
                                    status = 'Available';
                                }
                                var inventoryTypeId = rowDetail[13];
                                $("#table" + category).append("<tr id=\"row" + i.toString() + category + "\"><td id=\"row" + i.toString() + category + "ID\">" + rowDetail[0] + "</td><td id=\"row" + i.toString() + category + "model\">" + rowDetail[1] + "</td><td id=\"row" + i.toString() + category + "make\">" + rowDetail[2] + "</td><td id=\"row" + i.toString() + category + "country\">" + rowDetail[3] + "</td><td id=\"row" + i.toString() + category + "capacity\">" + rowDetail[4] + "</td><td>" + rowDetail[5] + "</td><td>" + status + "</td><td><button class=\"btn btn-primary\"  onclick=\"update('" + i.toString() + "','" + category + "')\" id=\"button" + i.toString() + category + "\">Update</button></td></tr>");
                                i++;
                            });
                        }
                        else {
                            console.log(obj.error);
                        }
                    }

                });
            }
        </script>
        <script>
            function update(id, category) {
                $('#idLabel').html($('#row' + id + category + 'ID').html());
                $('#id').val($('#row' + id + category + 'ID').html());
                $("#category option[value='" + category + "']").attr("selected", "selected");
                $('#model').val($('#row' + id + category + 'model').html());
                $('#make').val($('#row' + id + category + 'make').html());
                $('#capacity').val($('#row' + id + category + 'capacity').html());
                $('#country').val($('#row' + id + category + 'country').html());
                $('#modalWindow').show();
                $('#modalButton').click();
            }
        </script>
    </body>
</html>

