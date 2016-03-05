<?php session_start(); ?>
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

    <body class="register-page">
        <div class="register-box">

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
                if ($_GET["msg"] == "available") {
                    ?>
                    <div class="pad margin no-print">
                        <div class="callout callout-danger" style="margin-bottom: 0!important;">												
                            <h4><i class="fa fa-warning"></i> Warning:</h4>
                            Username is available. Please try with another.
                        </div>
                    </div>
                    <?php
                }
            }
            ?>

            <div class="register-logo text-info">
                <b>HOVAEL</b> Constructions
            </div>
            <div class="box box-info">
                <div class="register-box-body">
                    <p class="login-box-msg">Register to HOVAEL Constructions</p>
                    <form id="insertForm" action="db/SaveUser.php" method="POST">
                        <div class="form-group input-group">
                            <select id="type" name="type" class="form-control" required>
                                <option value="select" selected="" disabled="">Select User Type</option>
                                <?php
                                include './DBCon.php';
                                $res = mysqli_query($con, "SELECT * FROM usertype WHERE type != 'Super Admin'");
                                while ($row = mysqli_fetch_array($res)) {
                                    ?>
                                    <option value="<?php echo $row['id']; ?>"> <?php echo $row['type']; ?></option>
                                <?php } ?>
                            </select>
                            <span class="input-group-addon"><i class="fa fa-star"></i></span>
                        </div>
                        <div class="form-group input-group">
                            <input name="fn" type="text" class="form-control" placeholder="First Name" required>
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        </div>
                        <div class="form-group input-group">
                            <input name="ln" type="text" class="form-control" placeholder="Last Name" required>
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        </div>
                        <div class="form-group input-group">
                            <input name="desig" type="text" class="form-control" placeholder="Designation" required>
                            <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
                        </div>
                        <div class="form-group input-group">
                            <select id="work" name="work" class="form-control" required>
                                <option value="select" selected="" disabled="">Select Work Place</option>
                                <?php
                                $res = mysqli_query($con, "SELECT * FROM site WHERE status!='0'");
                                while ($row = mysqli_fetch_array($res)) {
                                    ?>
                                    <option value="<?php echo $row['id']; ?>"> Site - <?php echo $row['location']; ?></option>
                                <?php } ?>
                            </select>
                            <span class="input-group-addon"><i class="fa fa-building"></i></span>
                        </div>
                        <div class="form-group input-group">
                            <input id="mobile" name="mobile" type="text" class="form-control" placeholder="Mobile No" maxlength="10" required>
                            <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                        </div>
                        <div class="form-group input-group">
                            <input name="email" type="email" class="form-control" placeholder="E-Mail" required>
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        </div>
                        <hr>
                        <div class="form-group input-group">
                            <input name="un" type="text" class="form-control" placeholder="Username" required>
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        </div>
                        <div class="form-group input-group">
                            <input name="pw" type="password" class="form-control" placeholder="Password" required>
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </div>
                    </form>        
                    <br/>
                    <div class="form-group">
                        <span>By registering above, you confirm that you accept the <a>Terms of Use</a> of HOVAEL Pvt. Ltd.</span>
                    </div>
                    <p></p>
                    <a href="Index.php" class="center-block text-center">I already have a account</a>
                </div><!-- /.form-box -->
            </div>
        </div><!-- /.register-box -->

        <button data-display="modalWindowValidate" data-animation="fade" data-animationspeed="300" data-closeBGclick="true" id="modalButtonValidate" style="display: none">My Project</button><br>
        <!--portBox Content--> 
        <div id="modalWindowValidate" class="col-md-5 portBox">
            <div class="callout callout-danger" style="margin-bottom: 0!important;">												
                <h4><i class="fa fa-warning"></i> Warning:</h4>
                Some of your  data seemed to be incorrect. Please try again.
            </div>
        </div>

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

        <!--Validation-->
        <script>
            $(document).on('submit', '#insertForm', function () {
                if ($('#type').val() === null || $('#work').val() === null || !$.isNumeric($('#mobile').val())) {
                    event.preventDefault();
                    $('#modalButtonValidate').click();
                }
                if ($('#mobile').val().length != 10) {
                    event.preventDefault();
                    $('#modalButtonValidate').click();
                }
            });
        </script>
    </body>
</html>
