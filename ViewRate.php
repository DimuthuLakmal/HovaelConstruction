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
                        RATES <small>View Rates</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="Home.php"><i class="fa fa-dashboard"></i> HOVAEL</a></li>
                        <li class="active">View Rates</li>
                    </ol>
                </section>

                <hr>

                <!-- Main content -->
                <section class="content">

                    <div class="row">
                        <div class="col-md-12">

                            <?php
                            if (isset($_GET["msg"])) {
                                if ($_GET["msg"] == "error") {
                                    ?>
                                    <div class="pad margin no-print">
                                        <div class="callout callout-danger" style="margin-bottom: 0!important;">												
                                            <h4><i class="fa fa-warning"></i> Warning:</h4>
                                            Some of your data seemed to be incorrect. Please try again.
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
                                            <li class="active"><a href="#tab_1" data-toggle="tab">Internal Hire Rate</a></li>
                                            <li><a href="#tab_2" data-toggle="tab">Fuel Consumption Rate</a></li>
                                            <li><a href="#tab_3" data-toggle="tab">Plant Rate</a></li>
                                            <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1">
                                                <a href="InsertInternalHireRate.php">
                                                    <img class="hvr-pulse-grow" src="img/add.png" 
                                                         style="position: fixed; bottom: 60px; right: 15px; z-index: 5; width: 50px; height: 50px;">
                                                </a>
                                                <table id="table_hire" class="table table-bordered table-striped table-condensed">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Category</th>
                                                            <th>Model Name</th>
                                                            <th>Unit</th>
                                                            <th>Estimated Hours</th>
                                                            <th>Rate</th>
                                                            <th></th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        include './DBCon.php';
                                                        $res = mysqli_query($con, "SELECT * FROM inventorytype b, inventorycat c, internalhirerate a WHERE a.idinventorytype=b.id AND b.idinventorycat=c.id AND a.status!=0");
                                                        while ($row = mysqli_fetch_array($res)) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $row['id']; ?></td>
                                                                <td><?php echo $row['category']; ?></td>
                                                                <td><?php echo $row['model']; ?></td>
                                                                <td>
                                                                    <?php
                                                                    $unit = $row['unit'];
                                                                    if ($unit == '0') {
                                                                        echo 'HOURS';
                                                                    } else if ($unit == '1') {
                                                                        echo 'DAY';
                                                                    } else if ($unit == '2') {
                                                                        echo 'MONTH';
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td><?php echo $row['estimatedhrs']; ?></td>
                                                                <td><?php echo $row['rate']; ?></td>
                                                                <td style="max-width: 50px;">
                                                                    <?php if ($row['status'] == '1') { ?>
                                                                        <form action="db/ChangeStatus.php" method="POST">
                                                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
                                                                            <input type="hidden" name="table" value="internalhirerate"/>
                                                                            <input type="hidden" name="url" value="ViewRate"/>
                                                                            <div class="btn-group">
                                                                                <button type="submit" class="btn btn-xs btn-danger"><span class='glyphicon glyphicon-remove'></span></button>
                                                                            </div>
                                                                        </form>
                                                                    <?php } else { ?>
                                                                        <div class="btn-group">
                                                                            <?php if (isAdmin()) { ?>
                                                                                <button type="button" class="btn btn-warning btn-flat btn-xs" disabled>Pending</button>
                                                                                <button type="button" class="btn btn-warning btn-flat btn-xs dropdown-toggle" data-toggle="dropdown">
                                                                                    <span class="caret"></span>
                                                                                </button>  
                                                                                <ul class="dropdown-menu" role="menu">
                                                                                    <li><a href="db/ChangeStatus.php?id=<?php echo $row['id']; ?>&status=0&table=internalhirerate&url=ViewRate">Approve</a></li>
                                                                                    <li><a href="db/ChangeStatus.php?id=<?php echo $row['id']; ?>&status=1&table=internalhirerate&url=ViewRate">Cancel</a></li>
                                                                                </ul>
                                                                            <?php } else { ?>
                                                                                <button type="button" class="btn btn-warning btn-flat btn-xs" disabled>Pending</button>                                               
                                                                            <?php } ?>
                                                                        </div>
                                                                    <?php } ?>
                                                                </td>
                                                                <td style="max-width: 30px;">
                                                                    <form action="UpdateInternalHireRate.php" method="POST">
                                                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
                                                                        <?php if (isAdmin()) { ?>
                                                                            <button type="submit" class="btn btn-primary btn-flat btn-xs">Update</button>
                                                                        <?php } else { ?>
                                                                            <button type="submit" class="btn btn-primary btn-flat btn-xs" disabled="">Update</button>
                                                                        <?php } ?>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>

                                            </div><!-- /.tab-pane -->
                                            <div class="tab-pane" id="tab_2">
                                                <a href="InsertFuelConsumptionRate.php">
                                                    <img class="hvr-pulse-grow" src="img/add.png" 
                                                         style="position: fixed; bottom: 60px; right: 15px; z-index: 5; width: 50px; height: 50px;">
                                                </a>
                                                <table id="table_fuel" class="table table-bordered table-striped table-condensed">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Category</th>
                                                            <th>Model Name</th>
                                                            <th>Unit</th>
                                                            <th>Remarks</th>
                                                            <th>Hire Rate</th>
                                                            <th></th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        include './DBCon.php';
                                                        $res = mysqli_query($con, "SELECT * FROM inventorytype b, inventorycat c, fuelconsumptionrate a WHERE a.idinventorytype=b.id AND b.idinventorycat=c.id AND  a.status!=0 GROUP BY a.idinventorytype");
                                                        while ($row = mysqli_fetch_array($res)) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $row['id']; ?></td>
                                                                <td><?php echo $row['category']; ?></td>
                                                                <td><?php echo $row['model']; ?></td>
                                                                <td>
                                                                    <?php
                                                                    $unit = $row['unit'];
                                                                    if ($unit == '0') {
                                                                        echo 'LTS/HOUR';
                                                                    } else if ($unit == '1') {
                                                                        echo 'KMS/LTS';
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td><?php echo $row['remarks']; ?></td>
                                                                <td><?php echo $row['hirerate']; ?></td>
                                                                <td style="max-width: 50px;">
                                                                    <?php if ($row['status'] == '1') { ?>
                                                                        <form action="db/ChangeStatus.php" method="POST">
                                                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
                                                                            <input type="hidden" name="table" value="fuelconsumptionrate"/>
                                                                            <input type="hidden" name="url" value="ViewRate"/>
                                                                            <div class="btn-group">
                                                                                <button type="submit" class="btn btn-xs btn-danger"><span class='glyphicon glyphicon-remove'></span></button>
                                                                            </div>
                                                                        </form>
                                                                    <?php } else { ?>
                                                                        <div class="btn-group">
                                                                            <?php if (isAdmin()) { ?>
                                                                                <button type="button" class="btn btn-warning btn-flat btn-xs" disabled>Pending</button>
                                                                                <button type="button" class="btn btn-warning btn-flat btn-xs dropdown-toggle" data-toggle="dropdown">
                                                                                    <span class="caret"></span>
                                                                                </button>  
                                                                                <ul class="dropdown-menu" role="menu">
                                                                                    <li><a href="db/ChangeStatus.php?id=<?php echo $row['id']; ?>&status=0&table=fuelconsumptionrate&url=ViewRate">Approve</a></li>
                                                                                    <li><a href="db/ChangeStatus.php?id=<?php echo $row['id']; ?>&status=1&table=fuelconsumptionrate&url=ViewRate">Cancel</a></li>
                                                                                </ul>
                                                                            <?php } else { ?>
                                                                                <button type="button" class="btn btn-warning btn-flat btn-xs" disabled>Pending</button>                                                  
                                                                            <?php } ?>
                                                                        </div>
                                                                    <?php } ?>
                                                                </td>
                                                                <td style="max-width: 30px;">
                                                                    <form action="UpdateFuelConsumptionRate.php" method="POST">
                                                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
                                                                        <?php if (isAdmin()) { ?>
                                                                            <button type="submit" class="btn btn-primary btn-flat btn-xs">Update</button>
                                                                        <?php } else { ?>
                                                                            <button type="submit" class="btn btn-primary btn-flat btn-xs" disabled>Update</button>
                                                                        <?php } ?>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>

                                            </div><!-- /.tab-pane -->
                                            <div class="tab-pane" id="tab_3">
                                                <a href="InsertPlantRate.php">
                                                    <img class="hvr-pulse-grow" src="img/add.png" 
                                                         style="position: fixed; bottom: 60px; right: 15px; z-index: 5; width: 50px; height: 50px;">
                                                </a>
                                                <table id="table_plant" class="table table-bordered table-striped table-condensed">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Category</th>
                                                            <th>Model Name</th>
                                                            <th>Description</th>
                                                            <th>Min Charge</th>
                                                            <th></th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        include './DBCon.php';
                                                        $res = mysqli_query($con, "SELECT * FROM inventorytype b, inventorycat c, plantrate a WHERE a.idinventorytype=b.id AND b.idinventorycat=c.id AND a.status!=0 GROUP BY a.idinventorytype");
                                                        while ($row = mysqli_fetch_array($res)) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $row['id']; ?></td>
                                                                <td><?php echo $row['category']; ?></td>
                                                                <td><?php echo $row['model']; ?></td>
                                                                <td><?php echo $row['description']; ?></td>
                                                                <td><?php echo $row['mincharge']; ?></td>
                                                                <td style="max-width: 50px;">
                                                                    <?php if ($row['status'] == '1') { ?>
                                                                        <form action="db/ChangeStatus.php" method="POST">
                                                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
                                                                            <input type="hidden" name="table" value="plantrate"/>
                                                                            <input type="hidden" name="url" value="ViewRate"/>
                                                                            <div class="btn-group">
                                                                                <button type="submit" class="btn btn-xs btn-danger"><span class='glyphicon glyphicon-remove'></span></button>
                                                                            </div>
                                                                        </form>
                                                                    <?php } else { ?>
                                                                        <div class="btn-group">
                                                                            <?php if (isAdmin()) { ?>
                                                                                <button type="button" class="btn btn-warning btn-flat btn-xs" disabled>Pending</button>
                                                                                <button type="button" class="btn btn-warning btn-flat btn-xs dropdown-toggle" data-toggle="dropdown">
                                                                                    <span class="caret"></span>
                                                                                </button>  
                                                                                <ul class="dropdown-menu" role="menu">
                                                                                    <li><a href="db/ChangeStatus.php?id=<?php echo $row['id']; ?>&status=0&table=plantrate&url=ViewRate">Approve</a></li>
                                                                                    <li><a href="db/ChangeStatus.php?id=<?php echo $row['id']; ?>&status=1&table=plantrate&url=ViewRate">Cancel</a></li>
                                                                                </ul>
                                                                            <?php } else { ?>
                                                                                <button type="button" class="btn btn-warning btn-flat btn-xs" disabled>Pending</button>                                               
                                                                            <?php } ?>
                                                                        </div>
                                                                    <?php } ?>
                                                                </td>
                                                                <td style="max-width: 30px;">
                                                                    <form action="UpdatePlantRate.php" method="POST">
                                                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
                                                                        <?php if (isAdmin()) { ?>
                                                                            <button type="submit" class="btn btn-primary btn-flat btn-xs">Update</button>
                                                                        <?php } else { ?>
                                                                            <button type="submit" class="btn btn-primary btn-flat btn-xs" disabled>Update</button>
                                                                        <?php } ?>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>

                                            </div><!-- /.tab-pane -->
                                        </div><!-- /.tab-content -->
                                    </div><!-- nav-tabs-custom -->
                                </div><!-- /.col -->
                            </div>

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

        <script type="text/javascript">
            $(function () {
                $("#table_hire").DataTable();
                $("#table_fuel").DataTable();
                $("#table_plant").DataTable();
            });
        </script>

    </body>
</html>