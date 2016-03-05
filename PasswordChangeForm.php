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

        <style>
            .example-modal .modal {
                position: relative;
                top: auto;
                bottom: auto;
                right: auto;
                left: auto;
                display: block;
                z-index: 1;
            }
            .example-modal .modal {
                background: transparent!important;
            }
        </style>
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
                        Profile<small>Change Password</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="Home.php"><i class="fa fa-dashboard"></i> HOVAEL</a></li>
                        <li class="active">Profile</li>
                    </ol>
                </section>

                <hr>

                <?php
                $iduser = $_SESSION['iduser'];
                ?>

                <!-- Main content -->
                <section class="content">

                    <?php
                    if (isset($_GET["msg"])) {
                        if ($_GET["msg"] == "error") {
                            ?>
                            <div class="pad margin no-print">
                                <div class="callout callout-danger" style="margin-bottom: 0!important;">												
                                    <h4><i class="fa fa-warning"></i> Warning:</h4>
                                    An error has occurred when updating. Please try again.
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>

                    <div class="example-modal">
                        <div class="modal modal-primary">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Change Password</h4>
                                    </div>
                                    <form id="reg_form" action="db/UpdatePassword.php" method="POST">
                                        <div class="modal-body">
                                            <div class="box box-info">
                                                <div class="register-box-body">
                                                    <?php
                                                    include './DBCon.php';
                                                    $res = mysqli_query($con, "SELECT * FROM user JOIN log ON user.idlog = log.id WHERE user.id='$iduser'");
                                                    if ($rowMain = mysqli_fetch_array($res)) {
                                                        ?>
                                                        <div class="form-group text-center">
                                                            <i class="fa fa-cog fa-lg fa-5x fa-spin"></i>
                                                        </div>
                                                        <br/>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Username</label>
                                                            <div class="col-sm-9 input-group">
                                                                <input name="un" type="text" class="form-control" placeholder="Username" required>
                                                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Old Password</label>
                                                            <div class="col-sm-9 input-group">
                                                                <input name="oldpw" type="password" class="form-control" placeholder="Old Password" required>
                                                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">New Password</label>
                                                            <div class="col-sm-9 input-group">
                                                                <input name="newpw1" type="password" class="form-control" placeholder="New Password" required>
                                                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">New Password (Again)</label>
                                                            <div class="col-sm-9 input-group">
                                                                <input name="newpw2" type="password" class="form-control" placeholder="New Password (Again)" required>
                                                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div><!-- /.form-box -->
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="Profile.php"><button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Profile</button></a>
                                            <button type="submit" class="btn btn-outline">Update</button>
                                        </div>
                                    </form>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div><!-- /.example-modal -->

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
    </body>
</html>