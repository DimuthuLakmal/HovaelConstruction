<?php
session_start();
$_SESSION['table'] = 'transfernote';
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
                        TRANSFER NOTE <small>Insert Transfer Note </small>
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
                                if ($_GET["msg"] == "samesite") {
                                    ?>
                                    <div class="pad margin no-print">
                                        <div class="callout callout-danger" style="margin-bottom: 0!important;">												
                                            <h4><i class="fa fa-warning"></i> Warning:</h4>
                                            Transfer to the same site not allowed. Please try again.
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>

                            <div class="box box-info">
                                <!-- form start -->
                                <form class="form-horizontal" action="db/SaveTransferNote.php" method="POST" id="insertForm">

                                    <div class="box-body">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"> ID :</label>
                                            <div id="divid" class="col-sm-10">
                                                <label class="control-label"> <?php echo $_SESSION['id']; ?></label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"> Date :</label>
                                            <div id="divdate" class="col-sm-2">
                                                <input id="date" name="date" type="date" class="form-control" >
                                            </div>
                                            <label class="col-sm-2 control-label"> Departure Time :</label>
                                            <div id="divdeparturetime" class="col-sm-2">
                                                <input id="depttime" name="depttime" type="time" class="form-control" placeholder="Departure Time">
                                                <span id="spandeparturetime" class="" aria-hidden="true"></span>
                                            </div>
                                            <label class="col-sm-2 control-label"> Arrival time :</label>
                                            <div id="divarrivaltime" class="col-sm-2">
                                                <input id="arrivaltime" name="arrivaltime" type="time" class="form-control" placeholder="Arrival Time">
                                                <span id="spanarrivaltime" class="" aria-hidden="true"></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"> Driver :</label>
                                            <div id="divdriver" class="col-sm-4">
                                                <input id="drivername" name="drivername" type="text" class="form-control" placeholder="Name of the Driver" required="">
                                                <span id="spandriver" class="" aria-hidden="true"></span>
                                            </div>
                                            <label class="col-sm-2 control-label"> Cleaner :</label>
                                            <div id="divcleaner" class="col-sm-4">
                                                <input id="cleanername" name="cleanername" type="text" class="form-control" placeholder="Name of the Cleaner">
                                                <span id="spancleaner" class="" aria-hidden="true"></span>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <label class="col-sm-2 control-label"> Inventory Code :</label>
                                            <div id="divinvID" class="col-sm-2">
                                                <select id="invID" name="invID" class="form-control" >
                                                    <option value = "select" selected = "" disabled = "">Select Inventory Code</option>
                                                    <?php
                                                    include './DBCon.php';
                                                    $sql = "SELECT inventory.id,inventory.code FROM inventory WHERE inventory.status!=0";
                                                    $result = mysqli_query($con, $sql);
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        ?>
                                                        <option value="<?php echo $row["id"]; ?>"> <?php echo $row["code"]; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <span id="spaninvID" class="" aria-hidden="true"></span>
                                            </div>
                                            <label class="col-sm-2 control-label"> Site From :</label>
                                            <div id="divsiteIDfrom" class="col-sm-2">
                                                <select id="siteIDfrom" name="siteIDfrom" class="form-control" disabled="">
                                                    <option value = "select" selected = "" disabled = "">Site From</option>
                                                    <?php
                                                    $sql = "SELECT id,location FROM site";
                                                    $result = mysqli_query($con, $sql);
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        ?>
                                                        <option value="<?php echo $row["id"]; ?>" > <?php echo $row["location"]; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <span id="spansiteIDfrom" class="" aria-hidden="true"></span>
                                            </div>
                                            <label class="col-sm-2 control-label"> Site To :</label>
                                            <div id="divsiteIDto" class="col-sm-2">
                                                <select id="siteIDto" name="siteIDto" class="form-control" >
                                                    <option value = "select" selected = "" disabled = "">Site To</option>
                                                    <?php
                                                    $sql = "SELECT id,location FROM site WHERE status!=0";
                                                    $result = mysqli_query($con, $sql);
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        ?>
                                                        <option value="<?php echo $row["id"]; ?>"> <?php echo $row["location"]; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <span id="spansiteIDto" class="" aria-hidden="true"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="box-footer">
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button id="submit" type="submit" class="btn btn-primary pull-right">Insert</button>
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
        <script type="text/javascript" src="./com.ebox.hovael.js/validation.js"></script> 

        <script type="text/javascript">
            $('#invID').change(function () {
                var selectedId = $(this).val();
                jQuery.ajax({
                    type: "POST",
                    url: './com.ebox.hovael.db/transfernote.php',
                    dataType: 'json',
                    data: {functionname: 'searchfromid', id: selectedId},
                    success: function (obj, textstatus) {
                        if (!('error' in obj)) {
                            var data = obj;
                            $('#siteIDfrom').val(data['id']);
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
            var input = document.getElementById('siteIDfrom');
            input.disabled = true;

            $isDateOk = false;

            $('#date').focusout(function () {
                var now = new Date();
                var selectedDate = new Date($(this).val());
                if (isDate($(this).val()) && selectedDate <= now) {
                    $isDateOk = true;
                } else {
                    $isDateOk = false;
                }
            });

            $(document).on('submit', '#insertForm', function () {
                var inputs = document.getElementsByClassName('form-control');
                for (var i = 0; i < inputs.length; i++) {
                    inputs[i].disabled = false;
                }

                if (!$isDateOk || $('#invID').val() === null || $('#siteIDfrom').val() === null || $('#siteIDto').val() === null) {
                    event.preventDefault();
                    $('#modalButtonValidate').click();
                }
            }
            );
        </script>
    </body>
</html>