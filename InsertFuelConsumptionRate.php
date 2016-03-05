<?php
session_start();
$_SESSION['table'] = 'fuelconsumptionrate';
include './com.ebox.hovael.db/autoIncrementID.php';
include './ctrl/setUserPrivilege.php';
if (!isSessionAvailable()) {
    header('Location: ./Index.php');
}
if (!isStatusOK()) {
    header('Location: ./LockScreen.php');
}
if (!isAdmin()) {
    header('Location: ./ErrorPage.php');
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
                        FUEL CONSUMPTION RATE <small>Insert New Rate</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="Home.php"><i class="fa fa-dashboard"></i> HOVAEL</a></li>
                        <li class="active">Fuel Consumption Rate</li>
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
                                if ($_GET["msg"] == "alreadyexists") {
                                    ?>
                                    <div class="pad margin no-print">
                                        <div class="callout callout-danger" style="margin-bottom: 0!important;">												
                                            <h4><i class="fa fa-warning"></i> Warning:</h4>
                                            Data already exists in database. Please try with another.
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>

                            <div class="box box-info">
                                <!-- form start -->
                                <form id="insertForm" class="form-horizontal" action="db/SaveFuelConsumptionRate.php" method="POST">

                                    <div class="box-body">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"> ID :</label>
                                            <div id="divid" class="col-sm-10">
                                                <label class="control-label"> <?php echo $_SESSION['id'] ?></label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"> Vehicle/Machine :</label>
                                            <div id="group" class="radio col-md-10">
                                                <label class="col-md-5">
                                                    <input type="radio" name="isvehicle" id="vehicle" value="vehicle" onclick="vehichecked()"> Vehicle
                                                </label>
                                                <label class="col-md-5">
                                                    <input type="radio" name="isvehicle" id="machine" value="machine" onclick="macchecked()"> Machine
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"> Type :</label>
                                            <div id="divtype" class="col-sm-4">
                                                <select id="type" name="type" class="form-control" required="" disabled="">
                                                    <option value="select" selected="" disabled="">Select Type</option>
                                                </select>
                                            </div>
                                            <label class="col-sm-2 control-label"> Unit :</label>
                                            <div id="divtype" class="col-sm-4">
                                                <select id="unit" name="unit" class="form-control" required="" disabled="">
                                                    <option value="select" selected="" disabled="">Select Unit</option>
                                                    <option value="0">LTS/HOUR</option>
                                                    <option value="1">KMS/LTS</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"> Hire Rate :</label>
                                            <div id="divrate" class="col-sm-4">
                                                <input id="rate" name="rate" type="text" class="form-control" placeholder="Hire Rate" required="" disabled="">
                                            </div>
                                            <label class="col-sm-2 control-label"> Remarks :</label>
                                            <div id="divremarks" class="col-sm-4">
                                                <input id="remarks" name="remarks" type="text" class="form-control" placeholder="Remarks" disabled="">
                                            </div>
                                        </div>
                                        <div class="form-group" >
                                            <label class="col-sm-2 control-label"> Loaded Hire Rate :</label>
                                            <div id="divlrate" class="col-sm-2">
                                                <input id="lrate" name="lrate" type="text" class="form-control" placeholder="Loaded Hire Rate" required="" disabled="">
                                            </div>
                                            <label class="col-sm-2 control-label"> Empty Hire Rate :</label>
                                            <div id="diverate" class="col-sm-2">
                                                <input id="erate" name="erate" type="text" class="form-control" placeholder="Empty Hire Rate" disabled="">
                                            </div>
                                            <label class="col-sm-2 control-label"> Remarks :</label>
                                            <div id="divremarks" class="col-sm-2">
                                                <input id="vremarks" name="vremarks" type="text" class="form-control" placeholder="Remarks" disabled="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="box-footer">
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-primary pull-right">Insert</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
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

        <script type="text/javascript">

                                                        function removeOptions(selectbox) {
                                                            var i;
                                                            for (i = selectbox.options.length - 1; i >= 0; i--) {
                                                                selectbox.remove(i);
                                                            }
                                                        }

                                                        function vehichecked() {
                                                            var inputs = document.getElementsByClassName('form-control');
                                                            for (var i = 0; i < inputs.length; i++) {
                                                                inputs[i].disabled = false;
                                                            }
                                                            removeOptions(document.getElementById("type"));
                                                            document.getElementById("rate").disabled = true;
                                                            document.getElementById("remarks").disabled = true;
                                                            document.getElementById("lrate").disabled = false;
                                                            document.getElementById("erate").disabled = false;
                                                            document.getElementById("vremarks").disabled = false;

<?php
$query = "SELECT * FROM inventorytype a, inventorycat b WHERE b.id = a.idinventorycat GROUP BY category, model";
include './DBCon.php';
$res = mysqli_query($con, $query);
while ($row = mysqli_fetch_array($res)) {
    if ($row['type'] == 'Vehicle') {
        ?>
                                                                    el = document.createElement('option');
                                                                    el.value = "<?php echo $row[0]; ?>";
                                                                    el.innerHTML = "<?php echo $row['category'] . " | " . $row['model']; ?>";
                                                                    document.getElementById('type').appendChild(el);
        <?php
    }
}
?>
                                                        }

                                                        function macchecked() {
                                                            var inputs = document.getElementsByClassName('form-control');
                                                            for (var i = 0; i < inputs.length; i++) {
                                                                inputs[i].disabled = false;
                                                            }
                                                            removeOptions(document.getElementById("type"));
                                                            document.getElementById("lrate").disabled = true;
                                                            document.getElementById("erate").disabled = true;
                                                            document.getElementById("vremarks").disabled = true;
                                                            document.getElementById("rate").disabled = false;
                                                            document.getElementById("remarks").disabled = false;

<?php
$query = "SELECT * FROM inventorytype a ,inventorycat b WHERE b.id = a.idinventorycat GROUP BY category, model";
include './DBCon.php';
$res = mysqli_query($con, $query);
while ($row = mysqli_fetch_array($res)) {
    if ($row['type'] == 'Machine') {
        ?>
                                                                    el = document.createElement('option');
                                                                    el.value = "<?php echo $row[0]; ?>";
                                                                    el.innerHTML = "<?php echo $row['category'] . " | " . $row['model']; ?>";
                                                                    document.getElementById('type').appendChild(el);
        <?php
    }
}
?>
                                                        }

        </script>

        <!--Validation-->
        <script>
            $(document).on('submit', '#insertForm', function () {
                if ($('#type').val() === null || $('#unit').val() === null || (!$.isNumeric($('#rate').val()) && (!$.isNumeric($('#lrate').val()) || !$.isNumeric($('#erate').val())))) {
                    event.preventDefault();
                    $('#modalButtonValidate').click();
                }
            });
        </script>
    </body>
</html>