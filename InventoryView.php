<?php
session_start();
include './ctrl/setUserPrivilege.php';
if (!isSessionAvailable()) {
    header('Location: ./Index.php');
}
if (!isStatusOK()) {
    header('Location: ./LockScreen.php');
}
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>HOVAEL</title>
        <link rel="shortcut icon" href="img/favicon.png">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.4 -->
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.
        -->
        <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link href="./com.ebox.hovael.css/portBox.css" rel="stylesheet" type="text/css" />
        <link href="css/hover.css" rel="stylesheet" type="text/css" />
    </head>

    <body class="skin-blue sidebar-mini">
        <div class="wrapper">

            <?php include './Header.php'; ?>
            <?php include './SideBar.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        INVENTORY<small>View Inventory</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="Home.php"><i class="fa fa-dashboard"></i> HOVAEL</a></li>
                        <li class="active">Inventory</li>
                    </ol>
                </section>

                <hr>

                <!-- Main content -->
                <section class="content">

                    <div class="row">
                        <div class="col-md-12">
                            <a href="InventoryInsert.php">
                                <img class="hvr-pulse-grow" src="img/add.png" 
                                     style="position: fixed; bottom: 60px; right: 15px; z-index: 5; width: 50px; height: 50px;">
                            </a>
                            <!--                            <a href="InventoryTypeInsert.php">
                                                            <img class="hvr-pulse-grow" src="img/add_blue.png" 
                                                                 style="position: fixed; bottom: 60px; right: 75px; z-index: 5; width: 50px; height: 50px;">
                                                        </a>
                                                        <a href="InventoryCategoryInsert.php">
                                                            <img class="hvr-pulse-grow" src="img/add_green.png" 
                                                                 style="position: fixed; bottom: 60px; right: 15px; z-index: 5; width: 50px; height: 50px;">
                                                        </a>-->
                            <?php
                            if (isset($_GET["msg"])) {
                                if ($_GET["msg"] == "error") {
                                    ?>
                                    <div class="pad margin no-print">
                                        <div class="callout callout-danger" style="margin-bottom: 0!important;">												
                                            <h4><i class="fa fa-warning"></i> Warning:</h4>
                                            An error has occurred. Please try again.
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>

                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Custom Tabs -->
                                    <div class="nav-tabs-custom" id="tabsection">
                                        <ul class="nav nav-tabs" id="tabs">
                                        </ul>
                                        <div class="tab-content" id="tab-content">
                                        </div><!-- /.tab-content -->
                                    </div><!-- nav-tabs-custom -->
                                </div><!-- /.col -->
                            </div>

                        </div>
                    </div>

                    <button data-display="modalWindow" data-animation="fade" data-animationspeed="300" data-closeBGclick="true" id="modalButton" style="display: none">My Project</button><br>
                    <!--portBox Content--> 
                    <div id="modalWindow" class="col-md-10 portBox"></div> 


                    <button data-display="modalWindowValidate" data-animation="fade" data-animationspeed="300" data-closeBGclick="true" id="modalButtonValidate" style="display: none">My Project</button><br>
                    <!--portBox Content--> 
                    <div id="modalWindowValidate" class="col-md-5 portBox">
                        <div class="callout callout-danger" style="margin-bottom: 0!important;">												
                            <h4><i class="fa fa-warning"></i> Warning:</h4>
                            Some of your  data seemed to be incorrect. Please try again.
                        </div>
                    </div>

                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            <?php include './Footer.php'; ?>
            <?php include './ControlSideBar.php'; ?>

        </div><!-- ./wrapper -->

        <!-- REQUIRED JS SCRIPTS -->

        <!-- jQuery 2.1.4 -->
        <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <script src="plugins/jQueryUI/jquery-ui.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="js/bootstrap.min.js"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/app.min.js" type="text/javascript"></script>
        <script src="dist/js/demo.js" type="text/javascript"></script>

        <!-- Optionally, you can add Slimscroll and FastClick plugins.
              Both of these plugins are recommended to enhance the
              user experience. Slimscroll is required when using the
              fixed layout. -->

        <script type="text/javascript" src="plugins/jQueryUI/jquery-ui.js"></script>
        <script type="text/javascript" src="./com.ebox.hovael.js/jquery-ui-1.10.3.custom.min.js"></script>
        <script type="text/javascript" src="./com.ebox.hovael.js/portBox.slimscroll.min.js"></script>
        <script type="text/javascript" src="./com.ebox.hovael.js/validation.js"></script> 

        <script>
            $(document).ready(function () {
                jQuery.ajax({
                    type: "POST",
                    url: './com.ebox.hovael.db/InventoryCategory.php',
                    dataType: 'json',
                    data: {functionname: 'search'},
                    success: function (obj, textstatus) {
                        if (!('error' in obj)) {
                            var category = obj.result.split(",");
                            var i = 1;
                            $.each(category, function (val, text) {
                                if (text != '') {
                                    if (i == 1) {
                                        $('#tabs').append("<li class=\"active\"><a data-toggle=\"tab\" id=\"li" + text.split(":")[1] + "\" href=\"#section" + text.split(":")[1] + "\">" + text.split(":")[0] + "</a></li>");
                                    } else {
                                        $('#tabs').append("<li><a data-toggle=\"tab\" id=\"li" + text.split(":")[1] + "\" href=\"#section" + text.split(":")[1] + "\">" + text.split(":")[0] + "</a></li>");
                                    }
                                    if (i == 1) {
                                        $('#tab-content').append("<div id=\"section" + text.split(":")[1] + "\"></div>");
                                        $("#section" + text.split(":")[1]).addClass("tab-pane active");
                                    } else {
                                        $('#tab-content').append("<div id=\"section" + text.split(":")[1] + "\" ></div>");
                                        $("#section" + text.split(":")[1]).addClass("tab-pane");
                                    }
                                    a(text.split(":")[0], text.split(":")[1]);
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
            function a(category, id) {
//                $('#section' + category).append("<div class=\"ui-widget\"><label for=\"search" + category + "\">Search  </label><input id=\"search" + category + "\"></div>");

                $('#section' + id).append("<table id=\"table" + id + "\" class=\"table table-bordered table-striped table-condensed\"><thead><tr><th>ID</th><th>Code</th><th>Reg No</th><th>Model</th><th>Make</th><th>Country</th><th>Eng No</th><th>S No</th><th>Capacity</th><th>Year</th><th>Operator</th><th>Hire Rate</th><th>Date</th><th>Location</th><th>Status</th><th></th></tr></thead></table>");
                jQuery.ajax({
                    type: "POST",
                    url: './com.ebox.hovael.db/Inventory.php', dataType: 'json', data: {functionname: 'searchForDisplay', category: category},
                    success: function (obj, textstatus) {
                        if (!('error' in obj)) {
                            var data = obj;
                            var i = 1;
                            $.each(data, function (val, text) {
                                var rowDetail = text.split(',');
                                var status = 'Not Available';
                                if ('1' == rowDetail[14]) {
                                    status = 'Available';
                                }
                                var inventoryTypeId = rowDetail[15];
                                if (status == 'Available') {
                                    $("#table" + id).append("<tr id=\"row" + i.toString() + id + "\"><td>" + rowDetail[0] + "</td><td>" + rowDetail[1] + "</td><td>" + rowDetail[2] + "</td><td>" + rowDetail[3] + "</td><td>" + rowDetail[4] + "</td><td>" + rowDetail[5] + "</td><td>" + rowDetail[6] + "</td><td>" + rowDetail[7] + "</td><td>" + rowDetail[8] + "</td><td>" + rowDetail[9] + "</td><td>" + rowDetail[10] + "</td><td>" + rowDetail[11] + "</td><td>" + rowDetail[12] + "</td><td>" + rowDetail[13] + "</td><td><span class=\"label label-success\">" + status + "</span></td><?php if (isAdmin()) { ?><td><button class=\"btn btn-primary btn-flat btn-xs\" onclick=\"update('" + i.toString() + id + "','" + inventoryTypeId + "')\" id=\"button" + i.toString() + id + "\">Update</button></td><?php } else { ?><td><button class=\"btn btn-primary btn-flat btn-xs\" disabled onclick=\"update('" + i.toString() + id + "','" + inventoryTypeId + "')\" id=\"button" + i.toString() + id + "\">Update</button></td><?php } ?></tr>");
                                } else {
                                    $("#table" + id).append("<tr id=\"row" + i.toString() + id + "\"><td>" + rowDetail[0] + "</td><td>" + rowDetail[1] + "</td><td>" + rowDetail[2] + "</td><td>" + rowDetail[3] + "</td><td>" + rowDetail[4] + "</td><td>" + rowDetail[5] + "</td><td>" + rowDetail[6] + "</td><td>" + rowDetail[7] + "</td><td>" + rowDetail[8] + "</td><td>" + rowDetail[9] + "</td><td>" + rowDetail[10] + "</td><td>" + rowDetail[11] + "</td><td>" + rowDetail[12] + "</td><td>" + rowDetail[13] + "</td><td><span class=\"label label-danger\">" + status + "</span></td><td></td></tr>");
                                }
                                i++;
                            });
                            $("#table" + id).DataTable();
                        } else {
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
                var columns = ["ID", "Code", "Reg No", "Model", "Make", "Country", "Eng No", "S No", "Capacity", "Year", "Operator", "Hire Rate", "Date"];
                var dbcolumns = ["id", "code", "regno", "model", "make", "country", "engno", "sno", "capacity", "year", "operator", "hireinternal", "date"];
                var columnCount = 0;
                var status;
                var id;
                $('#row' + rowCategory + ' td').each(function () {
                    if (columnCount < 13) {
                        oldValues[dbcolumns[columnCount]] = $(this).html();
                        if (dbcolumns[columnCount] == 'id') {
                            id = $(this).html();
                            $("#updateform").append("<div class=\"form-group\"><label class=\"col-sm-2 control-label\">" + columns[columnCount] + "</label><div class=\"col-sm-10\"><input type=\"text\" class=\"form-control\" name=\"" + dbcolumns[columnCount] + "\" id=\"" + dbcolumns[columnCount] + "\" value=\"" + $(this).html() + "\" disabled=\"\"></div></div>");
                        } else {
                            $("#updateform").append("<div class=\"form-group\"><label class=\"col-sm-2 control-label\">" + columns[columnCount] + "</label><div class=\"col-sm-10\"><input type=\"text\" class=\"form-control\" name=\"" + dbcolumns[columnCount] + "\" id=\"" + dbcolumns[columnCount] + "\" value=\"" + $(this).html() + "\"></div></div>");
                        }
                    }
                    if (columnCount == 13) {
                        status = $(this).html();
                    }
                    columnCount++;
                });

                $('#updateform').append("<input type=\"hidden\" name=\"id\" value=\"" + id + "\">");
                $('#updateform').append("<input type=\"hidden\" name=\"idinventorytype\" value=\"" + inventoryTypeId + "\">");
                $('#updateform').append("<input type=\"hidden\" name=\"function\" value=\"update\">");
                $('#updateform').append("<div id=\"updatealert\" class=\"alert alert-danger text-center\" role=\"alert\"><span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span><span class=\"sr-only\">Error:</span> Be careful when updating. It will be affect to other data as well.</div>");
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
                var now = new Date();
                var selectedDate = new Date($(this).val());
                if (isDate($(this).val()) && selectedDate <= now) {
                    $isDateOk = true;
                } else {
                    $isDateOk = false;
                }
            });

            $(document).on('submit', '#updateform', function () {
                if (!$isDateOk || !$isYearOk || !$isRegNoOk) {
                    event.preventDefault();
                    $('#modalButtonValidate').click();
                }
            });
        </script>
    </body>
</html>