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
                        FUEL STOCK<small>View Fuel Stock</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="Home.php"><i class="fa fa-dashboard"></i> HOVAEL</a></li>
                        <li class="active">Fuel Stock</li>
                    </ol>
                </section>

                <hr>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <a href="FuelStockInsert.php">
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
                                    <!-- Custom Tabs -->
                                    <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#tab_1" data-toggle="tab">Summary</a></li>
                                            <li><a href="#tab_2" data-toggle="tab">Detailed Stock</a></li>
                                            <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1">
                                                <?php
                                                include './DBCon.php';
                                                $res = mysqli_query($con, "SELECT id,location FROM site WHERE status!=0");
                                                while ($row = mysqli_fetch_array($res)) {
                                                    $inPetrol = 0;
                                                    $inDiesel = 0;
                                                    $inKerosene = 0;
                                                    $outPetrol = 0;
                                                    $outDiesel = 0;
                                                    $outKerosene = 0;
                                                    $netTotal = 0;

                                                    $res2 = mysqli_query($con, "SELECT * FROM fuelstock WHERE idsite=$row[0] AND status!=0");
                                                    while ($row2 = mysqli_fetch_array($res2)) {
                                                        $type = $row2['name'];
                                                        $qty = $row2['qty'];
                                                        $netTotal+=$qty;
                                                        if ($type == 'Petrol') {
                                                            $inPetrol+=$qty;
                                                        } else if ($type == 'Diesel') {
                                                            $inDiesel+=$qty;
                                                        } else if ($type == 'Kerosene') {
                                                            $inKerosene+=$qty;
                                                        }
                                                    }

                                                    $res3 = mysqli_query($con, "SELECT name,qty FROM fuelbook WHERE idsite='$row[0]' AND status!=0");
                                                    while ($row3 = mysqli_fetch_array($res3)) {
                                                        $type = $row3['name'];
                                                        $qty = $row3['qty'];
                                                        $netTotal-=$qty;
                                                        if ($type == 'Petrol') {
                                                            $outPetrol+=$qty;
                                                        } else if ($type == 'Diesel') {
                                                            $outDiesel+=$qty;
                                                        } else if ($type == 'Kerosene') {
                                                            $outKerosene+=$qty;
                                                        }
                                                    }

                                                    $netPetrol = $inPetrol - $outPetrol;
                                                    $netDiesel = $inDiesel - $outDiesel;
                                                    $netKerosene = $inKerosene - $outKerosene;
                                                    ?>
                                                    <div class="col-md-3">
                                                    <div class="box box-info">
                                                        <div class="box-header with-border">
                                                            <h3 class="box-title"><?php echo $row['location']; ?></h3><div class="box-tools pull-right">
                                                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                                            </div>
                                                        </div><!-- /.box-header -->
                                                        <div class="box-body">
                                                            <!-- Info Boxes Style 2 -->
                                                            <div class="info-box bg-red">
                                                                <span class="info-box-icon"><i class="ion ion-fireball"></i></span>
                                                                <div class="info-box-content">
                                                                    <span class="info-box-text">Petrol</span>
                                                                    <span class="info-box-number"><?php echo $netPetrol; ?> Ltr</span>
                                                                    <div class="progress">
                                                                        <?php $ratio = round(($netPetrol / $netTotal) * 100, 2); ?>
                                                                        <div class="progress-bar" style="width: <?php echo $ratio; ?>%"></div>
                                                                    </div>
                                                                    <span class="progress-description">
                                                                        <?php echo $ratio; ?>%
                                                                    </span>
                                                                </div><!-- /.info-box-content -->
                                                            </div><!-- /.info-box -->
                                                            <div class="info-box bg-aqua">
                                                                <span class="info-box-icon"><i class="ion ion-flame"></i></span>
                                                                <div class="info-box-content">
                                                                    <span class="info-box-text">Diesel</span>
                                                                    <span class="info-box-number"><?php echo $netDiesel; ?> Ltr</span>
                                                                    <div class="progress">
                                                                        <?php $ratio = round(($netDiesel / $netTotal) * 100, 2); ?>
                                                                        <div class="progress-bar" style="width: <?php echo $ratio; ?>%"></div>
                                                                    </div>
                                                                    <span class="progress-description">
                                                                        <?php echo $ratio; ?>%
                                                                    </span>
                                                                </div><!-- /.info-box-content -->
                                                            </div><!-- /.info-box -->
                                                            <div class="info-box bg-yellow">
                                                                <span class="info-box-icon"><i class="ion-ios-flame-outline"></i></span>
                                                                <div class="info-box-content">
                                                                    <span class="info-box-text">Kerosene</span>
                                                                    <span class="info-box-number"><?php echo $netKerosene; ?> Ltr</span>
                                                                    <div class="progress">
                                                                        <?php $ratio = round(($netKerosene / $netTotal) * 100, 2); ?>
                                                                        <div class="progress-bar" style="width: <?php echo $ratio; ?>%"></div>
                                                                    </div>
                                                                    <span class="progress-description">
                                                                        <?php echo $ratio; ?>%
                                                                    </span>
                                                                </div><!-- /.info-box-content -->
                                                            </div><!-- /.info-box -->
                                                        </div>
                                                    </div>
                                                    </div><!-- col -->
                                                <?php } ?>
                                            </div>
                                            <div class="tab-pane" id="tab_2">
                                                <table id="viewtable" class="table table-bordered table-striped table-condensed">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Site</th>
                                                            <th>Date</th>
                                                            <th>Name</th>
                                                            <th>Price</th>
                                                            <th>Qty</th>
                                                            <th>Status</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <button data-display="modalWindow" data-animation="fade" data-animationspeed="300" data-closeBGclick="true" id="modalButton" style="display: none">My Project</button><br>
                    <!-- portBox Content -->
                    <div id="modalWindow" class="col-md-5 portBox">
                        <form class="form-horizontal" action="./com.ebox.hovael.db/FuelStock.php" method="POST" id="updateForm">
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> ID :</label>
                                        <div class="col-sm-9">
                                            <label id="idLabel" class="control-label"></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Site :</label>
                                        <div class="col-sm-9">
                                            <select id="site" name="site" class="form-control" required>
                                                <option value="select" selected="" disabled="">Select Site</option>
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
                                        <label class="col-sm-3 control-label"> Type :</label>
                                        <div class="col-sm-9">
                                            <!--<input id="name" type="text" name="name" class="form-control" placeholder="Name" required>-->
                                            <select id="name" name="name" class="form-control" required>
                                                <option value="select" selected="" disabled="">Select Fuel Type</option>
                                                <option value="Petrol">Petrol</option>
                                                <option value="Diesel">Diesel</option>
                                                <option value="Kerosene">Kerosene</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Price :</label>
                                        <div class="col-sm-9">
                                            <input id="price" type="text" name="price" class="form-control" placeholder="Price">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"> Qty :</label>
                                        <div class="col-sm-9">
                                            <input id="qty" type="text" name="qty" class="form-control" placeholder="Qty" required>
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

        <script>
            $(document).ready(function () {
                jQuery.ajax({
                    type: "POST",
                    url: './com.ebox.hovael.db/SiteToController.php', dataType: 'json',
                    data: {functionname: 'search'},
                    success: function (obj, textstatus) {
                        if (!('error' in obj)) {
                            var category = obj.result.split(",");
                            $.each(category, function (val, text) {
                                if (text != '') {
                                    $('#site').append($('<option></option>').val(text.split(':')[0]).html(text.split(':')[0]));
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
                    url: './com.ebox.hovael.db/FuelStock.php',
                    dataType: 'json',
                    data: {functionname: 'selectAll'},
                    success: function (obj, textstatus) {
                        if (!('error' in obj)) {
                            var columns = ['id', 'site', 'date', 'name', 'price', 'qty', 'status'];
                            $.each(obj, function (key, value) {
                                var cellData = value.split(':');
                                $('#viewtable tbody').append("<tr id=\"row" + cellData[0] + "\"></tr>");
                                var columnNumber = 0;
                                $.each(cellData, function (key, value) {
                                    if (columnNumber != 6) {
                                        $('#row' + cellData[0]).append("<td id=\"row" + cellData[0] + columns[columnNumber] + "\">" + value + "</td>");
                                    }
                                    columnNumber++;
                                });

                                if (cellData[columnNumber - 1] == '1') {
                                    $('#row' + cellData[0]).append("<td><label id=\"row" + cellData[0] + "\status\" value=\"1\"></label><span class=\"label label-success\">Available</span></td>");
                                } else {
                                    $('#row' + cellData[0]).append("<td><label id=\"row" + cellData[0] + "\status\" value=\"1\"></label><span class=\"label label-danger\">Not Available</span></td>");
                                }
                                $('#row' + cellData[0]).append("<td><?php if (isAdmin()) { ?><button class=\"btn btn-primary btn-flat btn-xs\" onclick=\"update('" + cellData[0] + "')\" id=\"button" + cellData[0] + "\">Update</button><?php } else { ?><button class=\"btn btn-primary btn-flat btn-xs\" onclick=\"update('" + cellData[0] + "')\" id=\"button" + cellData[0] + "\" disabled>Update</button><?php } ?></td>");
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
                var columns = ['id', 'site', 'date', 'name', 'price', 'qty', 'status'];
                $('#idLabel').html(id);
                $('#id').val(id);
                $("#site option[value='" + $('#row' + id + 'site').html() + "']").attr("selected", "selected");
                $('#date').val($('#row' + id + 'date').html());
                $('#name').val($('#row' + id + 'name').html());
                $('#price').val($('#row' + id + 'price').html());
                $('#qty').val($('#row' + id + 'qty').html());

                if ($('#row' + id + "status").val() == '1') {
                    $('#status').prop('checked', true);
                }

                $('#modalButton').click();
            }
        </script>

        <!--Validation-->
        <script>
            $(document).on('submit', '#updateForm', function () {
                if ($('#site').val() === null || !$.isNumeric($('#price').val()) || !$.isNumeric($('#qty').val())) {
                    event.preventDefault();
                    $('#modalButtonValidate').click();
                }
            });
        </script>
    </body>
</html>