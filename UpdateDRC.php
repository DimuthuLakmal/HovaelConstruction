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
                        DRC <small>Update DRC</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="Home.php"><i class="fa fa-dashboard"></i> HOVAEL</a></li>
                        <li class="active">DRC</li>
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

                            if (isset($_POST["id"])) {
                                $id = $_POST["id"];
                            }

                            include './DBCon.php';
                            $sql = "SELECT * FROM drc WHERE id=$id";
                            $res = mysqli_query($con, $sql);
                            if ($row = mysqli_fetch_array($res)) {
                                ?>

                                <div class="box box-info">
                                    <form id="updateForm" class="form-horizontal" action="db/UpdateDRC.php" method="POST">

                                        <div class="box-body">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"> ID :</label>
                                                <div class="col-sm-4">
                                                    <label id="id" class="control-label"> <?php echo $id; ?></label>
                                                </div>
                                                <label class="col-sm-2 control-label"> Date :</label>
                                                <div class="col-sm-4">
                                                    <input id="date" name="date" type="date" class="form-control" value="<?php echo $row['date']; ?>" required="">
                                                </div>
                                            </div>
                                            <div class="form-group" >
                                                <label class="col-sm-2 control-label"> Driver :</label>
                                                <div class="col-sm-4">
                                                    <input id="drivername" name="drivername" type="text" class="form-control" placeholder="Driver" value="<?php echo $row['driver']; ?>" required="">
                                                </div>
                                                <label class="col-sm-2 control-label"> Officer :</label>
                                                <div class="col-sm-4">
                                                    <input id="officername" name="officername" type="text" class="form-control" placeholder="Officer" value="<?php echo $row['officer']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group" >
                                                <label class="col-sm-2 control-label"> Journey :</label>
                                                <div class="col-sm-10">
                                                    <textarea id="message" name="message" rows="2" cols="30" type="text" placeholder="Journey Details" class="form-control"><?php echo $row["journey"] ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"> Start Time :</label>
                                                <div class="col-sm-4">
                                                    <input id="starttime" name="starttime" type="time" class="form-control" placeholder="Start Time" value="<?php echo $row["starttime"] ?>" required="">
                                                </div>
                                                <label class="col-sm-2 control-label"> End time :</label>
                                                <div class="col-sm-4">
                                                    <input id="endtime" name="endtime" type="time" class="form-control" placeholder="Start Time" value="<?php echo $row["endtime"] ?>" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"> Start Meter :</label>
                                                <div class="col-sm-4">
                                                    <input id="startmeter" name="startmeter" type="text" class="form-control" placeholder="Start Meter" value="<?php echo $row["startmeter"] ?>" required="">
                                                </div>
                                                <label class="col-sm-2 control-label"> End Meter :</label>
                                                <div class="col-sm-4">
                                                    <input id="endmeter" name="endmeter" type="text" class="form-control" placeholder="End Meter" value="<?php echo $row["endmeter"] ?>" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"> Official KM :</label>
                                                <div class="col-sm-4">
                                                    <input id="officialkm" name="officialkm" type="text" class="form-control" placeholder="Official K.M." value="<?php echo $row["officialkm"] ?>">
                                                </div>
                                                <label class="col-sm-2 control-label"> Private KM :</label>
                                                <div class="col-sm-4">
                                                    <input id="privatekm" name="privatekm" type="text" class="form-control" placeholder="Private K.M." value="<?php echo $row["privatekm"] ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"> Inventory Reg No :</label>
                                                <div class="col-sm-4">
                                                    <select id="inventoryID" name="inventoryID" class="form-control">                                           
                                                        <?php
                                                        $sql3 = "SELECT inventory.regno,inventory.id FROM inventory INNER JOIN drc ON inventory.id = '" . $row["idinventory"] . "'";
                                                        $result = mysqli_query($con, $sql3);
                                                        if ($regno = mysqli_fetch_assoc($result)) {
                                                            ?>
                                                            <option value="<?php echo $regno["id"]; ?>" selected="" ><?php echo $regno["regno"] ?></option>
                                                            <?php
                                                        }
                                                        ?>

                                                        <?php
                                                        $sql1 = "SELECT inventory.regno, inventory.id FROM inventory INNER JOIN inventorytype ON inventorytype.id = inventory.idinventorytype INNER JOIN inventorycat ON inventorytype.idinventorycat = inventorycat.id WHERE inventorycat.type = 'Vehicle' AND inventory.status!=0";
                                                        $result = mysqli_query($con, $sql1);
                                                        while ($rowinventory = mysqli_fetch_array($result)) {
                                                            if ($regno["id"] != $rowinventory["id"]) {
                                                                ?>
                                                                <option value="<?php echo $rowinventory["id"]; ?>"> <?php echo $rowinventory["regno"]; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <label class="col-sm-2 control-label"> Site Location :</label>
                                                <div class="col-sm-4">
                                                    <select id="siteID" name="siteID" class="form-control" >
                                                        <?php
                                                        $sql2 = "SELECT site.location, site.id FROM site INNER JOIN drc ON site.id = '" . $row["idsite"] . "'";
                                                        $result = mysqli_query($con, $sql2);
                                                        if ($location = mysqli_fetch_assoc($result)) {
                                                            ?>
                                                            <option  value="<?php echo $location["id"]; ?>" selected="" ><?php echo $location["location"] ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                        <?php
                                                        $sql2 = "SELECT id,location FROM site";
                                                        $result = mysqli_query($con, $sql2);
                                                        while ($rowsite = mysqli_fetch_array($result)) {
                                                            ?>
                                                            <option value="<?php echo $rowsite["id"]; ?>"> <?php echo $rowsite["location"]; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <input name="id" type="hidden" value="<?php echo $id; ?>">                                                    
                                        </div>

                                        <div class="box-footer">
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" class="btn btn-primary pull-right">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div><!-- /.box -->
                            <?php } ?>
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

        <!--Validation-->
        <script>
            $isDateOk = true;

            $('#date').focusout(function () {
                var now = new Date();
                var selectedDate = new Date($(this).val());
                if (isDate($(this).val()) && selectedDate <= now) {
                    $isDateOk = true;
                } else {
                    $isDateOk = false;
                }
            });

            $(document).on('submit', '#updateForm', function () {
                if (!$isDateOk || !$.isNumeric($('#startmeter').val()) || !$.isNumeric($('#endmeter').val()) || !$.isNumeric($('#privatekm').val()) || !$.isNumeric($('#officialkm').val())) {
                    event.preventDefault();
                    $('#modalButtonValidate').click();
                }
                if ($('#startmeter').val() >= $('#endmeter').val()) {
                    event.preventDefault();
                    $('#modalButtonValidate').click();
                }
            });
        </script>
    </body>
</html>