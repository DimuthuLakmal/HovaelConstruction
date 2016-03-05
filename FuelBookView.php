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
                        FUEL BOOK<small>View Fuel Book</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="Home.php"><i class="fa fa-dashboard"></i> HOVAEL</a></li>
                        <li class="active">Fuel Book</li>
                    </ol>
                </section>

                <hr>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <a href="FuelBookInsert.php">
                                <img class="hvr-pulse-grow" src="img/add.png" 
                                     style="position: fixed; bottom: 60px; right: 15px; z-index: 5; width: 50px; height: 50px;">
                            </a>

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
                                    <div class="box box-info">
                                        <div class="register-box-body">

                                            <form class="form-horizontal">
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label"> From :</label>
                                                    <div class="col-sm-4">
                                                        <input id="fromdate" type="date" name="fromdate" class="form-control" placeholder="From Date" required>
                                                    </div>
                                                    <label class="col-sm-2 control-label"> To :</label>
                                                    <div class="col-sm-4">
                                                        <input id="todate" type="date" name="todate" class="form-control" placeholder="To Date" required>
                                                    </div>
                                                </div>
                                            </form>

                                            <table id="viewtable" class="table table-bordered table-striped table-condensed">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Code</th>
                                                        <th>Reg No</th>
                                                        <th>Site</th>
                                                        <th>Fuel Type</th>
                                                        <th>Date</th>
                                                        <th>Qty (Liters)</th>
                                                        <th>Meter Reading</th>
                                                        <th>Remarks</th>
                                                        <th>Status</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div><!-- /.col -->
                            </div>

                        </div>
                    </div>

                    <button data-display="modalWindow" data-animation="fade" data-animationspeed="300" data-closeBGclick="true" id="modalButton" style="display: none">My Project</button><br>
                    <!-- portBox Content -->
                    <div id="modalWindow" class="col-md-5 portBox">
                        <form id="updateForm" class="form-horizontal" action="./com.ebox.hovael.db/FuelBook.php" method="POST">
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> ID :</label>
                                        <div class="col-sm-9">
                                            <label id="idLabel" class="control-label"></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Code :</label>
                                        <div class="col-sm-9">
                                            <label id="codeLabel" class="control-label"></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Reg No :</label>
                                        <div class="col-sm-9">
                                            <label id="regno" name="regno" class="control-label"></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Fuel :</label>
                                        <div class="col-sm-9">
                                            <select id="fuel" name="fuel" class="form-control" required>
                                                <option value="select" selected="" disabled="">Select Fuel Type</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Date :</label>
                                        <div class="col-sm-9">
                                            <input id="date" type="date" name="date" class="form-control" placeholder="Date" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Qty (Liters) :</label>
                                        <div class="col-sm-9">
                                            <input id="qty" type="text" name="qty" class="form-control" placeholder="Qty (Liters)" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Meter Reading :</label>
                                        <div class="col-sm-9">
                                            <input id="meterreading" type="text" name="meterreading" class="form-control" placeholder="Meter Reading" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Remarks :</label>
                                        <div class="col-sm-9">
                                            <input id="remarks" type="text" name="remarks" class="form-control" placeholder="Remarks">
                                        </div>
                                    </div>
                                    <input type="hidden" id="id" name="id">
                                    <input type="hidden" id="code" name="code">
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
                    url: './com.ebox.hovael.db/FuelStock.php',
                    dataType: 'json',
                    data: {functionname: 'search'},
                    success: function (obj, textstatus) {
                        if (!('error' in obj)) {
                            var category = obj.result.split(",");
                            $.each(category, function (val, text) {
                                if (text != '') {
//                                    $('#fuel').append($('<option></option>').val(text.split(':')[0]).html(text.split(':')[0]));
                                    $('#fuel').append($('<option></option>').val(text).html(text));
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
            $(document).ready(function () {
                jQuery.ajax({
                    type: "POST",
                    url: './com.ebox.hovael.db/FuelBook.php', dataType: 'json',
                    data: {functionname: 'selectAll'},
                    success: function (obj, textstatus) {
                        if (!('error' in obj)) {
                            var columns = ['id', 'code', 'regno', 'site', 'fuel', 'date', 'qty', 'meterreading', 'remarks'];
                            $.each(obj, function (key, value) {
                                var cellData = value.split(':');
                                $('#viewtable tbody').append("<tr id=\"row" + cellData[0] + "\"></tr>");
                                var columnNumber = 0;
                                $.each(cellData, function (key, value) {
                                    if (columnNumber != 9) {
                                        $('#row' + cellData[0]).append("<td id=\"row" + cellData[0] + columns[columnNumber] + "\">" + value + "</td>");
                                    }
                                    columnNumber++;
                                });

                                if (cellData[9] == '1') {
                                    $('#row' + cellData[0]).append("<td><label id=\"row" + cellData[0] + "\status\" value=\"1\"></label><span class=\"label label-success\">Available</span></td>");
                                } else {
                                    $('#row' + cellData[0]).append("<td><label id=\"row" + cellData[0] + "\status\" value=\"1\"></label><span class=\"label label-danger\">Not Available</span></td>");
                                }
//                                $('#row' + cellData[0]).append("<td><label id=\"row" + cellData[0] + "\status\" value=\"1\"></td>");
                                $('#row' + cellData[0]).append("<td><button class=\"btn btn-primary btn-flat btn-xs\" onclick=\"update('" + cellData[0] + "')\" id=\"button" + cellData[0] + "\">Update</button></td>");
                            });
                            $("#viewtable").DataTable();
                        }
                        else {
                            console.log(obj.error);
                        }
                    }
                });
            });
        </script>

        <script>
            function update(id) {
                var columns = ['id', 'idinventory', 'fuel', 'date', 'qty', 'meterreading', 'remarks'];
                $('#idLabel').html(id);
                $('#id').val(id);
                $('#codeLabel').html($('#row' + id + 'code').html());
                $('#code').val($('#row' + id + 'code').html());
                $('#regno').html($('#row' + id + 'regno').html());
                $("#fuel option[value='" + $('#row' + id + 'fuel').html() + "']").attr("selected", "selected");
                $('#date').val($('#row' + id + 'date').html());
                $('#qty').val($('#row' + id + 'qty').html());
                $('#meterreading').val($('#row' + id + 'meterreading').html());
                $('#remarks').val($('#row' + id + 'remarks').html());

                if ($('#row' + id + "status").val() == '1') {
                    $('#status').prop('checked', true);
                }

                $('#modalButton').click();
            }
        </script>
        <script>
            $('#todate').change(function () {
                $('#viewtable tbody tr').hide('slow');
                $fromdate = $('#fromdate').val();
                $todate = $('#todate').val();
                jQuery.ajax({type: "POST",
                    url: './com.ebox.hovael.db/FuelBook.php',
                    dataType: 'json',
                    data: {functionname: 'searchBetween', fromdate: $fromdate, todate: $todate},
                    success: function (obj, textstatus) {
                        if (!('error' in obj)) {
                            var columns = ['id', 'code', 'regno', 'fuel', 'date', 'qty', 'meterreading', 'remarks'];
                            $.each(obj, function (key, value) {
                                var cellData = value.split(':');
                                $('#viewtable tbody').append("<tr id=\"row" + cellData[0] + "\"></tr>");
                                var columnNumber = 0;
                                $.each(cellData, function (key, value) {
                                    if (columnNumber != 8) {
                                        $('#row' + cellData[0]).append("<td id=\"row" + cellData[0] + columns[columnNumber] + "\">" + value + "</td>");
                                    }
                                    columnNumber++;
                                });

                                if (cellData[8] == '1') {
                                    $('#row' + cellData[0]).append("<td><label id=\"row" + cellData[0] + "\status\" value=\"1\"></label><span class=\"label label-success\">Available</span></td>");
                                } else {
                                    $('#row' + cellData[0]).append("<td><label id=\"row" + cellData[0] + "\status\" value=\"1\"></label><span class=\"label label-danger\">Not Available</span></td>");
                                }
//                                $('#row' + cellData[0]).append("<td><label id=\"row" + cellData[0] + "\status\" value=\"1\"></td>");
                                $('#row' + cellData[0]).append("<td><button class=\"btn btn-primary btn-flat btn-xs\" onclick=\"update('" + cellData[0] + "')\" id=\"button" + cellData[0] + "\">Update</button></td>");
                            });
                        }
                    }
                });
            });
        </script>

        <!--Validation-->
        <script>
            $isDateOk = true;

            $('#date').change(function () {
                var now = new Date();
                var selectedDate = new Date($(this).val());
                if (isDate($(this).val()) && selectedDate <= now) {
                    $isDateOk = true;
                } else {
                    $isDateOk = false;
                }
            });

            $(document).on('submit', '#updateForm', function () {
                if ($('#fuel').val() === null || !$.isNumeric($('#meterreading').val()) || !$.isNumeric($('#qty').val()) || !$isDateOk) {
                    event.preventDefault();
                    $('#modalButtonValidate').click();
                }
            });
        </script>
    </body>
</html>