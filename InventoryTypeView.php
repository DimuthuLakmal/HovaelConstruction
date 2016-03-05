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
                        INVENTORY <small>View Inventory Type</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="Home.php"><i class="fa fa-dashboard"></i> HOVAEL</a></li>
                        <li class="active">Inventory</li>
                    </ol>
                </section>

                <hr>

                <!-- Main content -->
                <section class="content">

                    <!-- portBox Content -->
                    <div id="modalWindow" class="col-md-5 portBox" style="display: none">
                        <form class="form-horizontal" action="./com.ebox.hovael.db/InventoryType.php" method="POST">
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> ID :</label>
                                        <div class="col-sm-9">
                                            <label id="idLabel" class="control-label"></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Model :</label>
                                        <div class="col-sm-9">
                                            <input id="model" type="text" name="model" class="form-control" placeholder="Model" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Make :</label>
                                        <div class="col-sm-9">
                                            <input id="make" type="text" name="make" class="form-control" placeholder="Make" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Capacity :</label>
                                        <div class="col-sm-9">
                                            <input id="capacity" type="text" name="capacity" class="form-control" placeholder="Capacity">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Country :</label>
                                        <div class="col-sm-9">
                                            <input id="country" type="text" name="country" class="form-control" placeholder="Country" required>
                                        </div>
                                    </div>
                                    <input type="hidden" id="id" name="id">
                                    <input type="hidden" value="update" name="function">
                                </div>

                                <div class="box-footer">
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary pull-right">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="row">
                        <div class="col-md-12">

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
                                    <a href="InventoryTypeInsert.php">
                                        <img class="hvr-pulse-grow" src="img/add.png" 
                                             style="position: fixed; bottom: 60px; right: 15px; z-index: 5; width: 50px; height: 50px;">
                                    </a>
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

                $('#section' + id).append("<table id=\"table" + id + "\" class=\"table table-bordered table-striped table-condensed\"><thead><tr><th>ID</th><th>Model</th><th>Make</th><th>Country</th><th>Capacity</th><th>No of Items</th><th>Status</th><th></th></tr></thead></table>");
                jQuery.ajax({
                    type: "POST",
                    url: './com.ebox.hovael.db/InventoryType.php', dataType: 'json', data: {functionname: 'searchForDisplay', category: category},
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
                                if (status == 'Available') {
                                    $("#table" + id).append("<tr id=\"row" + i.toString() + id + "\"><td id=\"row" + i.toString() + id + "ID\">" + rowDetail[0] + "</td><td id=\"row" + i.toString() + id + "model\">" + rowDetail[1] + "</td><td id=\"row" + i.toString() + id + "make\">" + rowDetail[2] + "</td><td id=\"row" + i.toString() + id + "country\">" + rowDetail[3] + "</td><td id=\"row" + i.toString() + id + "capacity\">" + rowDetail[4] + "</td><td>" + rowDetail[5] + "</td><td><span class=\"label label-success\">" + status + "</span></td><?php if (isAdmin()) { ?><td><button class=\"btn btn-primary btn-flat btn-xs\"  onclick=\"update('" + i.toString() + "','" + id + "')\" id=\"button" + i.toString() + id + "\">Update</button></td><?php } else { ?><td><button class=\"btn btn-primary btn-flat btn-xs\" disabled onclick=\"update('" + i.toString() + "','" + id + "')\" id=\"button" + i.toString() + id + "\">Update</button></td><?php } ?></tr>");
                                } else {
                                    $("#table" + id).append("<tr id=\"row" + i.toString() + id + "\"><td id=\"row" + i.toString() + id + "ID\">" + rowDetail[0] + "</td><td id=\"row" + i.toString() + id + "model\">" + rowDetail[1] + "</td><td id=\"row" + i.toString() + id + "make\">" + rowDetail[2] + "</td><td id=\"row" + i.toString() + id + "country\">" + rowDetail[3] + "</td><td id=\"row" + i.toString() + id + "capacity\">" + rowDetail[4] + "</td><td>" + rowDetail[5] + "</td><td><span class=\"label label-danger\">" + status + "</span></td><td></td></tr>");
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
