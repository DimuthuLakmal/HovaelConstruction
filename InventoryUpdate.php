<!--
This is to update inventory category
author:Dimuthu
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
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
            });</script>
        <script>
            function a(category) {
                $('#section' + category).append("<div class=\"ui-widget\"><label for=\"search" + category + "\">Search  </label><input id=\"search" + category + "\"></div>");

                $('#section' + category).append("<table id=\"table" + category + "\" class=\"table table-hover\"><thead><tr><th>ID</th><th>Reg No</th><th>Model</th><th>Make</th><th>Country</th><th>Eng No</th><th>S No</th><th>Capacity</th><th>Year</th><th>Operator</th><th>Hire Rate</th><th>Date</th><th>Status</th></tr></thead></table>");
                jQuery.ajax({
                    type: "POST",
                    url: 'http://localhost/HovaelConstructions_v1.0/com.ebox.hovael.db/Inventory.php', dataType: 'json', data: {functionname: 'searchForDisplay', category: category},
                    success: function (obj, textstatus) {
                        if (!('error' in obj)) {
                            var data = obj;
                            var i = 1;
                            $.each(data, function (val, text) {
                                var rowDetail = text.split(',');
                                var status = 'Not Available';
                                if ('1' == rowDetail[12]) {
                                    status = 'Available';
                                }
                                var inventoryTypeId = rowDetail[13];
                                $("#table" + category).append("<tr id=\"row" + i.toString() + category + "\"><td>" + rowDetail[0] + "</td><td>" + rowDetail[1] + "</td><td>" + rowDetail[2] + "</td><td>" + rowDetail[3] + "</td><td>" + rowDetail[4] + "</td><td>" + rowDetail[5] + "</td><td>" + rowDetail[6] + "</td><td>" + rowDetail[7] + "</td><td>" + rowDetail[8] + "</td><td>" + rowDetail[9] + "</td><td>" + rowDetail[10] + "</td><td>" + rowDetail[11] + "</td><td></td><td><button class=\"btn btn-primary\" onclick=\"update('" + i.toString() + category + "','" + inventoryTypeId + "')\" id=\"button" + i.toString() + category + "\">Update</button></td></tr>")
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
            var oldValues = new Array(12);
            function update(rowCategory, inventoryTypeId) {
                $('#modalWindow').empty();
                $('#modalWindow').append("<form class=\"form-horizontal\" method=\"POST\" action=\"com.ebox.hovael.db/Inventory.php\" id=\"updateform\"></form>");
                var columns = ["ID", "Reg No", "Model", "Make", "Country", "Eng No", "S No", "Capacity", "Year", "Operator", "Hire Rate", "Date", "Status"];
                var dbcolumns = ["id", "regno", "model", "make", "country", "engno", "sno", "capacity", "year", "operator", "hireinternal", "date", "status"];
                var columnCount = 0;
                var status;
                $('#row' + rowCategory + ' td').each(function () {
                    if (columnCount < 12) {
                        oldValues[dbcolumns[columnCount]] = $(this).html();
                        $("#updateform").append("<div class=\"form-group\"><label  class=\"col-sm-2 control-label\">" + columns[columnCount] + "</label><div class=\"col-sm-10\"><input type=\"text\" class=\"form-control\" name=\"" + dbcolumns[columnCount] + "\" id=\"" + dbcolumns[columnCount] + "\" value=\"" + $(this).html() + "\" required></div></div>");
                    }
                    if (columnCount == 12) {
                        status = $(this).html();
                    }
                    columnCount++;
                });

                $('#updateform').append("<input type=\"hidden\" name=\"idinventorytype\" value=\"" + inventoryTypeId + "\">");
                $('#updateform').append("<input type=\"hidden\" name=\"function\" value=\"update\">");
                $('#updateform').append("<div id=\"updatealert\" class=\"alert alert-danger\" role=\"alert\"><span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span><span class=\"sr-only\">Error:</span>If you update, It will effect to other data</div>");
                $("#updateform").append("<div class=\"form-group\"><div class=\"col-sm-offset-2 col-sm-10\"><button type=\"submit\"  class=\"btn btn-primary\" id=\"updateButton\">Update</button></div></div>");
                $('#modalButton').click();

            }
        </script>

        <script>
            $(document).on('keyup', "#updateform input[type='text']", function () {
                if (oldValues['model'] != $('#model').val() || oldValues['capacity'] != $('#capacity').val() || oldValues['country'] != $('#country').val() || oldValues['make'] != $('#make').val()) {
                    $('#updatealert').show('fast');
                } else {
                    $('#updatealert').hide('fast');
                }
            });
        </script> 
        <script>
            $(function () {
                var availableTags;

                $("#tags").autocomplete({
                    source: availableTags
                });
            });
        </script>

        <script>



            $isRegNoOk = true;
            $isYearOk = true;
            $isDateOk = true;
            $(document).on('focusout', '#regno', function () {
                var x = $(this).val().split('-');
                if ($.isNumeric(x[0]) && $.isNumeric(x[1])) {
                    $isRegNoOk = true;
                } else {
                    var matches = $(this).val().match(/\d+/g);
                    if (matches != null && $.isNumeric(x[1])) {
                        $isRegNoOk = true;
                    } else {
                        $isRegNoOk = false;
                    }
                }
            });
            $(document).on('focusout', '#year', function () {
                if ($.isNumeric($('#year').val()) && $('#year').val() <= (new Date).getFullYear() && $('#year').val() >= 1900) {
                    $isYearOk = true;
                } else {
                    $isYearOk = false;
                }

            });

            $(document).on('focusout', '#date', function () {
                if (isDate($(this).val())) {
                    $isDateOk = true;
                } else {
                    $isDateOk = false;
                }
            });


            var allInputs = $(":input");

//            $.each(allInputs, function (key, value) {
//                $(document).on('focusout', value, function () {
//                    if (!$isDateOk || !$isYearOk || !$isRegNoOk) {
//                        $('#updateButton').attr('disabled', true);
//                    } else {
//                        $('#updateButton').attr('disabled', false);
//                    }
//                });
//                $(document).on('change', value, function () {
//                    if (!$isDateOk || !$isYearOk || !$isRegNoOk) {
//                        $('#updateButton').attr('disabled', true);
//                    } else {
//                        $('#updateButton').attr('disabled', false);
//                    }
//                });
//            });
//            $(document).on('change', '#type', function () {
//                if (!$isDateOk || !$isYearOk || !$isRegNoOk) {
//                    $('#updateButton').attr('disabled', true);
//                } else {
//                    $('#updateButton').attr('disabled', false);
//                }
//            });
            $(document).on('submit', '#updateform', function () {
                if (!$isDateOk || !$isYearOk || !$isRegNoOk) {
                    event.preventDefault();
                    alert('Please fill correctly');
                } 
            });
        </script>
    </body>
</html>
