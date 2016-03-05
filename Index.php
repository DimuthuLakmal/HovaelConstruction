<?php
session_start();
include './ctrl/setUserPrivilege.php';
if (isSessionAvailable()) {
    if (isStatusOK()) {
        header('Location: ./Home.php');
    } else {
        header('Location: ./LockScreen.php');
    }
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
        <!-- Tell the browser to be responsive to screen width -->
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.4 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <!-- iCheck -->
        <link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

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

    <body class="login-page">
        <div class="login-box">

            <?php
            if (isset($_GET["msg"])) {
                if ($_GET["msg"] == "error") {
                    ?>
                    <div class="pad margin no-print">
                        <div class="callout callout-danger" style="margin-bottom: 0!important;">												
                            <h4><i class="fa fa-warning"></i> Warning:</h4>
                            Login incorrect. Please try again.
                        </div>
                    </div>
                    <?php
                }
            }
            ?>

            <div class="login-logo text-info">
                <b>HOVAEL</b> Constructions
            </div><!-- /.login-logo -->
            <div class="box box-info">
                <div class="login-box-body">
                    <div class="form-group">
                        <img class="img-circle center-block" src="img/user.png" width="200"/>
                    </div>
                    <form id="signinForm" action="db/SignInUser.php" method="POST">
                        <div class="form-group input-group">
                            <input type="text" name="un" class="form-control" placeholder="Username" required>
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        </div>
                        <div class="form-group input-group">
                            <input type="password" name="pw" class="form-control" placeholder="Password" required>
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <button type="submit" class="btn btn-primary">Sign In</button>
                            </div>
                        </div>
                    </form>
                    <br/>
                    <div class="form-group text-center">
                        <span>Not a member yet?</span> 
                        <span>
                            <a href="SignUp.php">Create an account</a>
                        </span>
                        <span class="a-btn-icon-right"><span></span></span>
                    </div>
                </div><!-- /.login-box-body -->
            </div>

        </div><!-- /.login-box -->

        <!-- REQUIRED JS SCRIPTS -->

        <!-- jQuery 2.1.4 -->
        <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>

        <!-- Optionally, you can add Slimscroll and FastClick plugins.
              Both of these plugins are recommended to enhance the
              user experience. Slimscroll is required when using the
              fixed layout. -->
    </body>
</html>