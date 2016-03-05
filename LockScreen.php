<?php
session_start();
include './ctrl/setUserPrivilege.php';
if (isSessionAvailable()) {
    if (isStatusOK()) {
        header('Location: ./Home.php');
    }
} else {
    header('Location: ./Index.php');
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

        <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="lockscreen">
        <!-- Automatic element centering -->
        <div class="lockscreen-wrapper">

            <?php
            if (isset($_GET["msg"])) {
                if ($_GET["msg"] == "error") {
                    ?>
                    <div class="pad margin no-print">
                        <div class="callout callout-danger" style="margin-bottom: 0!important;">												
                            <h4><i class="fa fa-warning"></i> Warning:</h4>
                            Password incorrect. Please try again.
                        </div>
                    </div>
                    <?php
                }
            }
            ?>

            <div class="login-logo text-info">
                <b>HOVAEL</b> Constructions
            </div>
            <!-- User name -->
            <div class="lockscreen-name">
                <?php
                echo $_SESSION['fname'];
                echo ' ';
                echo $_SESSION['lname'];
                ?>
            </div>

            <!-- START LOCK SCREEN ITEM -->
            <div class="lockscreen-item">
                <!-- lockscreen image -->
                <div class="lockscreen-image">
                    <img src="img/user.png" alt="user image"/>
                </div>
                <!-- /.lockscreen-image -->

                <!-- lockscreen credentials (contains the form) -->
                <form class="lockscreen-credentials" action="db/SignInUser.php" method="POST">
                    <div class="input-group">
                        <input type="password" class="form-control" name="pw" placeholder="password" />
                        <div class="input-group-btn">
                            <button class="btn" type="submit"><i class="fa fa-arrow-right text-muted"></i></button>
                        </div>
                    </div>
                </form><!-- /.lockscreen credentials -->

            </div><!-- /.lockscreen-item -->
            <div class="help-block text-center">
                Enter your password to retrieve your session
            </div>
            <div class='text-center'>
                <a href="db/SignOut.php">Or sign in as a different user</a>
            </div>
        </div><!-- /.center -->

        <!-- jQuery 2.1.4 -->
        <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="js/bootstrap.min.js"></script>

        <!-- Optionally, you can add Slimscroll and FastClick plugins.
              Both of these plugins are recommended to enhance the
              user experience. Slimscroll is required when using the
              fixed layout. -->
    </body>
</html>