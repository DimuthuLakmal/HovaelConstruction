<?php
session_start();
$_SESSION['table'] = 'fuelbook';
include './com.ebox.hovael.db/autoIncrementID.php';
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
                        FUEL BOOK <small>Insert Fuel Book</small>
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
                                if ($_GET["msg"] == "notenough") {
                                    ?>
                                    <div class="pad margin no-print">
                                        <div class="callout callout-danger" style="margin-bottom: 0!important;">												
                                            <h4><i class="fa fa-warning"></i> Warning:</h4>
                                            Not enough amount of fuel in the stock. Please check again.
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>

                            <div class="box box-info">
                                <!-- form start -->
                                <form class="form-horizontal" action="./com.ebox.hovael.db/FuelBook.php" method="POST" id="insertForm">

                                    <?php
                                    include './DBCon.php';
                                    $locationName = $_SESSION['location'];
                                    $sql = "SELECT id FROM site WHERE location='$locationName'";
                                    $result = mysqli_query($con, $sql);
                                    if ($row = mysqli_fetch_array($result)) {
                                        $locationId = $row["id"];
                                    }
                                    ?>

                                    <div class="box-body">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"> ID :</label>
                                            <div class="col-sm-4">
                                                <label class="control-label"> <?php echo $_SESSION['id'] ?></label>
                                            </div>
                                            <label class="col-sm-2 control-label"> Site :</label>
                                            <div class="col-sm-4">
                                                <label class="control-label"> <?php echo $_SESSION['location'] ?></label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"> Code :</label>
                                            <div class="col-sm-4">
                                                <select id="code" name="code" class="form-control" required>
                                                    <option value="select" selected="" disabled="">Select Vehicle/Machine Code</option>
                                                </select>
                                            </div>
                                            <label class="col-sm-2 control-label"> Reg No :</label>
                                            <div class="col-sm-4">
                                                <input type="text" id="regno" name="regno" class="form-control" placeholder="Reg No" disabled="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"> Fuel Type :</label>
                                            <div class="col-sm-4">
                                                <select id="fuel" name="fuel" class="form-control" required>
                                                    <option value="select" selected="" disabled="">Select Fuel Type</option>
                                                </select>
                                            </div>
                                            <label class="col-sm-2 control-label"> Date :</label>
                                            <div class="col-sm-4">
                                                <input type="date" id="date" name="date" class="form-control" placeholder="Date" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"> Qty (Liters) :</label>
                                            <div class="col-sm-4">
                                                <input type="text" id="qty" name="qty" class="form-control" placeholder="Qty (Liters)" required>
                                            </div>
                                            <label class="col-sm-2 control-label"> Meter Reading :</label>
                                            <div class="col-sm-4">
                                                <input type="text" id="meterreading" name="meterreading" class="form-control" placeholder="Meter Reading" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"> Remarks :</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="remarks" name="remarks" class="form-control" placeholder="Remarks">
                                            </div>
                                        </div>
                                        <input type="hidden" value="<?php echo $locationId ?>" name="idsite">
                                        <input type="hidden" value="<?php echo $_SESSION['id'] ?>" name="id">
                                        <input type="hidden" value="insert" name="function">
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

                    <button data-display="modalWindowValidate" data-animation="fade" data-animationspeed="300" data-closeBGclick="true" id="modalButton" style="display: none">My Project</button><br>
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
                    url: './com.ebox.hovael.db/Inventory.php',
                    dataType: 'json',
                    data: {functionname: 'searchCode'},
                    success: function (obj, textstatus) {
                        if (!('error' in obj)) {
                            var category = obj.result.split(",");
                            $.each(category, function (val, text) {
                                if (text != '') {
                                    $('#code').append($('<option></option>').val(text.split(':')[1]).html(text.split(':')[1]));
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
        <script type="text/javascript">
            $('#code').change(function () {
                var selectedCode = $(this).val();
                jQuery.ajax({
                    type: "POST",
                    url: './com.ebox.hovael.db/Inventory.php',
                    dataType: 'json',
                    data: {functionname: 'searchRegNo', id: selectedCode},
                    success: function (obj, textstatus) {
                        if (!('error' in obj)) {
                            var data = obj.result.split(",");
                            $.each(data, function (val, text) {
                                if (text != '') {
                                    $('#regno').val(text.split(':')[0]);
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
                    data: {functionname: 'search'},
                    success: function (obj, textstatus) {
                        if (!('error' in obj)) {
                            var category = obj.result.split(",");
                            $.each(category, function (val, text) {
                                if (text != '') {
//                                    $('#fuel').append($('<option></option>').val(text.split(':')[1]).html(text.split(':')[0]));
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

        <!--Validation-->
        <script>
            $isDateOk = false;
            $('#date').change(function () {
                var now = new Date();
                var selectedDate = new Date($(this).val());
                if (isDate($(this).val()) && selectedDate <= now) {
                    $isDateOk = true;
                } else {
                    $isDateOk = false;
                }
            });

            $(document).on('submit', '#insertForm', function () {
                if (!$.isNumeric($('#meterreading').val()) || !$.isNumeric($('#qty').val()) || !$isDateOk) {
                    event.preventDefault();
                    $('#modalButton').click();
                }
            });
        </script>
    </body>
</html>
