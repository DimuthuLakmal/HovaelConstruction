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
                        DRME <small>Update DRME</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="Home.php"><i class="fa fa-dashboard"></i> HOVAEL</a></li>
                        <li class="active">DRME</li>
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
                            $sql = "SELECT * FROM drme WHERE id=$id";
                            $res = mysqli_query($con, $sql);
                            if ($row = mysqli_fetch_array($res)) {
                                ?>

                                <div class="box box-info">
                                    <form id="updateForm" class="form-horizontal" action="db/UpdateDRME.php" method="POST">

                                        <div class="box-body">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"> ID :</label>
                                                <div id="divid" class="col-sm-10">
                                                    <label class="control-label"><?php echo $row["id"] ?></label>
                                                    <input id="ID" type="hidden" value="<?php echo $id; ?>" name="ID" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"> Machine Name :</label>
                                                <div id="divmachineID" class="col-sm-4">
                                                    <select id="machineID" name="machineID" class="form-control" required="">
                                                        <?php
                                                        $sql3 = "SELECT inventory.code, inventory.id FROM inventory INNER JOIN drc ON inventory.id = '" . $row["idinventory"] . "'";
                                                        $result = mysqli_query($con, $sql3);
                                                        if ($regno = mysqli_fetch_assoc($result)) {
                                                            ?>
                                                            <option value="<?php echo $regno["id"]; ?>" selected=""><?php echo $regno["code"] ?></option>
                                                            <?php
                                                        }
                                                        ?>

                                                        <?php
                                                        $sql1 = "SELECT inventory.code, inventory.id FROM inventory INNER JOIN inventorytype ON inventorytype.id = inventory.idinventorytype INNER JOIN inventorycat ON inventorytype.idinventorycat = inventorycat.id WHERE inventorycat.type = 'Machine' AND inventory.status!=0";
                                                        $result = mysqli_query($con, $sql1);
                                                        while ($rowinventory = mysqli_fetch_array($result)) {
                                                            if ($regno["id"] != $rowinventory["id"]) {
                                                                ?>
                                                                <option value="<?php echo $rowinventory["id"]; ?>"> <?php echo $rowinventory["code"]; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <span id="spanmachineID" class="" aria-hidden="true"></span>
                                                </div>
                                                <label class="col-sm-2 control-label"> Date :</label>
                                                <div id="divdate" class="col-sm-4">
                                                    <input id="date" name="date" type="date" class="form-control" value="<?php echo $row["date"] ?>" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"> Operator :</label>
                                                <div id="divoperatorname" class="col-sm-4">
                                                    <input id="operatorname" name="operatorname" type="text" class="form-control" placeholder="Name of the Driver" value="<?php echo $row["operator"] ?>" required="">
                                                    <span id="spanoperatorname" class="" aria-hidden="true"></span>
                                                </div>
                                                <label class="col-sm-2 control-label"> Helper :</label>
                                                <div id="divhelpername" class="col-sm-4">
                                                    <input id="helpername" name="helpername" type="text" class="form-control" placeholder="Name of the Officer" value="<?php echo $row["helper"] ?>">
                                                    <span id="spanhelpername" class="" aria-hidden="true"></span>
                                                </div>                  
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"> Start Meter :</label>
                                                <div id="divstartmeter" class="col-sm-4">
                                                    <input id="startmeter" name="startmeter" type="text" class="form-control" placeholder="Start Meter" value="<?php echo $row["startmeter"] ?>" required="">
                                                    <span id="spanstartmeter" class="" aria-hidden="true"></span>
                                                </div>
                                                <label class="col-sm-2 control-label"> End Meter :</label>
                                                <div id="divendmeter" class="col-sm-4">
                                                    <input id="endmeter" name="endmeter" type="text" class="form-control" placeholder="End Meter" value="<?php echo $row["endmeter"] ?>" required="">
                                                    <span id="spanendmeter" class="" aria-hidden="true"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"> Remarks :</label>
                                                <div id="divremarks" class="col-sm-10">
                                                    <textarea name="remarks" rows="3" cols="30" class="form-control" placeholder="Journey Details"  ><?php echo $row["remarks"] ?></textarea>
                                                </div>
                                            </div>

                                            <div id="divinnertable" class="col-sm-12">

                                                <table id="innertable" class="table table-hover" >
                                                    <thead>
                                                        <tr>
                                                            <th>Activity No</th>
                                                            <th>Work Type</th>
                                                            <th>Area (Cut)</th>
                                                            <th>Area (Fill)</th>
                                                            <th>Material</th>
                                                            <th>Hours</th>
                                                            <th>Remarks</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sql = "SELECT * FROM drmeactivity WHERE iddrme = $id ";
                                                        $result = mysqli_query($con, $sql);
                                                        $number = 0;
                                                        if (mysqli_num_rows($result) > 0) {
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                ?>
                                                                <tr>                               
                                                                    <td><label class="control-label" ><?php echo $row["activityno"] ?></label></td>
                                                                    <td><input id="<?php echo $number . "1" ?>" name="<?php echo $number . "1" ?>" type="text" class="form-control" placeholder="Work Type" value="<?php echo $row["worktype"] ?>"></td>
                                                                    <td><input id="<?php echo $number . "2" ?>" name="<?php echo $number . "2" ?>" type="text" class="form-control" placeholder="Area (Cut)" value="<?php echo $row["areacut"] ?>"></td>
                                                                    <td><input id="<?php echo $number . "3" ?>" name="<?php echo $number . "3" ?>" type="text" class="form-control" placeholder="Area (Fill)" value="<?php echo $row["areafill"] ?>"></td>
                                                                    <td><input id="<?php echo $number . "4" ?>" name="<?php echo $number . "4" ?>" type="text" class="form-control" placeholder="Material" value="<?php echo $row["material"] ?>"></td>
                                                                    <td><input id="<?php echo $number . "5" ?>" name="<?php echo $number . "5" ?>" type="number" class="form-control" placeholder="hours" value="<?php echo $row["hours"] ?>"></td>
                                                                    <td><input id="<?php echo $number . "6" ?>" name="<?php echo $number . "6" ?>" type="text" class="form-control" placeholder="remarks" value="<?php echo $row["remarks"] ?>" ></td>
                                                                    <td><button type="button" class="btn btn-primary" onclick="uniCharCode()" >+</button></td>
                                                                </tr>

                                                                <?php
                                                                $number++;
                                                            }
                                                        } else {
                                                            echo "No matching records found";
                                                        }
                                                        ?>
                                                    <input type="hidden" id="numberofrows" name="numberofrows" value="<?php echo $number; ?>"> 
                                                    <input type="hidden" id="initialrows" name="initialrows" value="<?php echo $number; ?>">
                                                    <script>
                                                        var k = <?php echo $number ?>;

                                                        function uniCharCode() {
                                                            var table = document.getElementById("innertable");
                                                            var row = table.insertRow(-1);
                                                            var cell1 = row.insertCell(0);
                                                            var cell2 = row.insertCell(1);
                                                            var cell3 = row.insertCell(2);
                                                            var cell4 = row.insertCell(3);
                                                            var cell5 = row.insertCell(4);
                                                            var cell6 = row.insertCell(5);
                                                            var cell7 = row.insertCell(6);
                                                            var cell8 = row.insertCell(7);
                                                            var cell9 = row.insertCell(8);

                                                            cell1.innerHTML = k + 1;
                                                            cell2.innerHTML = '<input id="worktype" type="text" class="form-control" placeholder="Work Type"></td>';
                                                            cell3.innerHTML = '<input id="areacut" name="areacut"+i type="text" class="form-control" placeholder="Area (Cut)">';
                                                            cell4.innerHTML = '<input id="areafill" name="areafill"+i type="text" class="form-control" placeholder="Area (Fill)">';
                                                            cell5.innerHTML = '<input id="material" name="material"+i type="text" class="form-control" placeholder="Material">';
                                                            cell6.innerHTML = '<input id="hours" name="hours"+i type="text" class="form-control" placeholder="hours">';
                                                            cell7.innerHTML = '<input id="tblremarks" name="tblremarks"+i type="text" class="form-control" placeholder="remarks" >';
                                                            cell8.innerHTML = '<button type="button" class="btn btn-primary" onclick="uniCharCode()">+</button>';

                                                            document.getElementById("numberofrows").value = k + 1;
                                                            document.getElementById("worktype").name = k + "1";
                                                            document.getElementById("worktype").id = k + "1";
                                                            document.getElementById("areacut").name = k + "2";
                                                            document.getElementById("areacut").id = k + "2";
                                                            document.getElementById("areafill").name = k + "3";
                                                            document.getElementById("areafill").id = k + "3";
                                                            document.getElementById("material").name = k + "4";
                                                            document.getElementById("material").id = k + "4";
                                                            document.getElementById("hours").name = k + "5";
                                                            document.getElementById("hours").id = k + "5";
                                                            document.getElementById("tblremarks").name = k + "6";
                                                            document.getElementById("tblremarks").id = k + "6";
                                                            k++;
                                                        }

                                                    </script>

                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="box-footer">
                                                <div class="form-group">
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                        <button type="submit" class="btn btn-primary pull-right">Update</button>
                                                    </div>
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
                                                            if (!$isDateOk || !$.isNumeric($('#startmeter').val()) || !$.isNumeric($('#endmeter').val())) {
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