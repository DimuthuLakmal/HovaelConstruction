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
                        WELCOME<small>HOVAEL Constructions</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="Home.php"><i class="fa fa-dashboard"></i> HOVAEL</a></li>
                        <li class="active">Home</li>
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
                                            An error has occurred. Please try again.
                                        </div>
                                    </div>
                                    <?php
                                }
                            }

                            include './DBCon.php';
                            $res = mysqli_query($con, "SELECT * FROM inventory WHERE status!=0");
                            $countInventory = mysqli_num_rows($res);

                            $res = mysqli_query($con, "SELECT qty FROM fuelstock WHERE status!=0");
                            $countFuel = 0;
                            while ($row = mysqli_fetch_array($res)) {
                                $countFuel += $row['qty'];
                            }
                            $res = mysqli_query($con, "SELECT qty FROM fuelbook WHERE status!=0");
                            while ($row = mysqli_fetch_array($res)) {
                                $countFuel -= $row['qty'];
                            }
                            $countFuel = round($countFuel, 0);

                            $res = mysqli_query($con, "SELECT * FROM user WHERE status!=0");
                            $countUsers = mysqli_num_rows($res);

                            $res = mysqli_query($con, "SELECT * FROM site WHERE status!=0");
                            $countSites = mysqli_num_rows($res);
                            ?>

                            <div class="box box-solid">
                                <div class="box-header with-border text-center">
                                    <img src="img/logo.jpg"/>
                                </div><!-- /.box-header -->
                                <div class="box-body">

                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-lg-6 col-xs-6">
                                                <!-- small box -->
                                                <div class="small-box bg-aqua">
                                                    <div class="inner">
                                                        <h3><?php echo $countInventory; ?></h3>
                                                        <p>Inventory Items</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fa fa-database"></i>
                                                    </div>
                                                    <a href="InventoryView.php" class="small-box-footer">
                                                        More info <i class="fa fa-arrow-circle-right"></i>
                                                    </a>
                                                </div>
                                            </div><!-- ./col -->
                                            <div class="col-lg-6 col-xs-6">
                                                <!-- small box -->
                                                <div class="small-box bg-green">
                                                    <div class="inner">
                                                        <h3><?php echo $countFuel; ?><sup style="font-size: 20px">Ltr</sup></h3>
                                                        <p>Fuel Stock</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="ion ion-speedometer"></i>
                                                    </div>
                                                    <a href="FuelStockView.php" class="small-box-footer">
                                                        More info <i class="fa fa-arrow-circle-right"></i>
                                                    </a>
                                                </div>
                                            </div><!-- ./col -->
                                            <div class="col-lg-6 col-xs-6">
                                                <!-- small box -->
                                                <div class="small-box bg-yellow">
                                                    <div class="inner">
                                                        <h3><?php echo $countUsers; ?></h3>
                                                        <p>Users</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="ion ion-person-stalker"></i>
                                                    </div>
                                                    <a href="ViewUser.php" class="small-box-footer">
                                                        More info <i class="fa fa-arrow-circle-right"></i>
                                                    </a>
                                                </div>
                                            </div><!-- ./col -->
                                            <div class="col-lg-6 col-xs-6">
                                                <!-- small box -->
                                                <div class="small-box bg-red">
                                                    <div class="inner">
                                                        <h3><?php echo $countSites; ?></h3>
                                                        <p>Sites Islandwide</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="ion ion-location"></i>
                                                    </div>
                                                    <a href="SiteView.php" class="small-box-footer">
                                                        More info <i class="fa fa-arrow-circle-right"></i>
                                                    </a>
                                                </div>
                                            </div><!-- ./col -->
                                        </div><!-- /.row -->
                                    </div>

                                    <div class="col-md-6">
                                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                            <ol class="carousel-indicators">
                                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                                <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                                                <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                                            </ol>
                                            <div class="carousel-inner">
                                                <div class="item active">
                                                    <img src="img/slider/img1.jpg" alt="First slide">
                                                    <div class="carousel-caption">
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <img src="img/slider/img2.jpg" alt="Second slide">
                                                    <div class="carousel-caption">
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <img src="img/slider/img3.jpg" alt="Third slide">
                                                    <div class="carousel-caption">
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                                <span class="fa fa-angle-left"></span>
                                            </a>
                                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                                <span class="fa fa-angle-right"></span>
                                            </a>
                                        </div>
                                        <p class="bg-gray text-center"><strong>Copyright © 2015 Hovel Construction. All rights reserved.</strong></p>
                                    </div>

                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
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
    </body>
</html>