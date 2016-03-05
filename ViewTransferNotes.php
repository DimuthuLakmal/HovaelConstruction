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
                        TRANSFER NOTE<small>View Transfer Notes</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="Home.php"><i class="fa fa-dashboard"></i> HOVAEL</a></li>
                        <li class="active">Transfer Note</li>
                    </ol>
                </section>

                <hr>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <a href="InsertTransferNote.php">
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
                                            <table id="table_site" class="table table-bordered table-striped table-condensed">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Code</th>
                                                        <th>Reg No</th>
                                                        <th>Site From</th>
                                                        <th>Site To</th>
                                                        <th>Date</th>
                                                        <th>Departure Time</th>
                                                        <th>Arrival Time</th>
                                                        <th>Driver</th>
                                                        <th>Cleaner</th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    include './DBCon.php';
                                                    $sql = "SELECT * FROM transfernote JOIN inventory ON transfernote.idinventory=inventory.id JOIN site ON transfernote.idsitefrom=site.id WHERE transfernote.status!='0'";
                                                    $result = mysqli_query($con, $sql);
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_array($result)) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $row[0] ?></td>
                                                                <td><?php echo $row["code"] ?></td>
                                                                <td><?php echo $row["regno"] ?></td>
                                                                <td><?php echo $row["location"] ?></td>
                                                                <?php
                                                                $sql1 = "SELECT site.location FROM site INNER JOIN transfernote ON site.id=$row[idsiteto]";
                                                                $to = mysqli_query($con, $sql1);
                                                                if (mysqli_num_rows($to) > 0) {
                                                                    if ($rowTo = mysqli_fetch_assoc($to)) {
                                                                        ?>
                                                                        <td><?php echo $rowTo["location"] ?></td>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                                <td><?php echo $row[4] ?></td>
                                                                <td><?php echo $row["departuretime"] ?></td>
                                                                <td><?php echo $row["arrivaltime"] ?></td>
                                                                <td><?php echo $row["driver"] ?></td>
                                                                <td><?php echo $row["cleaner"] ?></td>
                                                                <td>
                                                                    <?php if ($row[9] == '1') { ?>
                                                                        <form action="db/ChangeStatus.php" method="POST">
                                                                            <input type="hidden" name="id" value="<?php echo $row[0]; ?>"/>
                                                                            <input type="hidden" name="table" value="transfernote"/>
                                                                            <input type="hidden" name="url" value="ViewTransferNotes"/>
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
                                                                                    <li><a href="db/ChangeStatus.php?id=<?php echo $row[0]; ?>&status=0&table=transfernote&url=ViewTransferNotes">Approve</a></li>
                                                                                    <li><a href="db/ChangeStatus.php?id=<?php echo $row[0]; ?>&status=1&table=transfernote&url=ViewTransferNotes">Cancel</a></li>
                                                                                </ul>
                                                                            <?php } else { ?>
                                                                                <button type="button" class="btn btn-warning btn-flat btn-xs" disabled>Pending</button>                                                  
                                                                            <?php } ?>
                                                                        </div>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <form action="UpdateTransferNote.php" method="POST">
                                                                        <input type="hidden" name="id" value="<?php echo $row[0]; ?>"/>
                                                                        <button type="submit" class="btn btn-primary btn-flat btn-xs">Update</button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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
                $("#table_site").DataTable();
            });
        </script>

    </body>
</html>