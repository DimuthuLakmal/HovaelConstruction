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
                        INVENTORY <small>View Inventory Category</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="Home.php"><i class="fa fa-dashboard"></i> HOVAEL</a></li>
                        <li class="active">Inventory</li>
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
                            }
                            ?>

                            <div class="row">
                                <div class="col-md-12"> 

                                    <a href="InventoryCategoryInsert.php">
                                        <img class="hvr-pulse-grow" src="img/add.png" 
                                             style="position: fixed; bottom: 60px; right: 15px; z-index: 5; width: 50px; height: 50px;">
                                    </a>

                                    <div class="box box-info">
                                        <div class="register-box-body">
                                            <table id="table_inventorycat" class="table table-bordered table-striped table-condensed">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Category</th>
                                                        <th>Type</th>
                                                        <th>Service (hrs/km)</th>
                                                        <th>Status</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    include './DBCon.php';
                                                    $res = mysqli_query($con, "SELECT * FROM inventorycat");
                                                    while ($row = mysqli_fetch_array($res)) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $row[0]; ?></td>
                                                            <td><?php echo $row['category']; ?></td>
                                                            <td><?php echo $row['type']; ?></td>
                                                            <td><?php echo $row['service']; ?></td>
                                                            <td>
                                                                <?php if ($row['status'] == '1') { ?>
                                                                    <span class="label label-success">Available</span>
                                                                <?php } else if ($row['status'] == '2') { ?>
                                                                    <span class="label label-warning">Pending</span>
                                                                <?php } else { ?>
                                                                    <span class="label label-danger">Not Available</span>
                                                                <?php } ?>
                                                            </td>
                                                            <td style="max-width: 50px;">
                                                                <?php if ($row['status'] == '1') { ?>
                                                                    <form action="db/ChangeStatus.php" method="POST">
                                                                        <input type="hidden" name="id" value="<?php echo $row[0]; ?>"/>
                                                                        <input type="hidden" name="table" value="inventorycat"/>
                                                                        <input type="hidden" name="url" value="InventoryCategoryView"/>
                                                                        <div class="btn-group">
                                                                            <button type="submit" class="btn btn-xs btn-danger"><span class='glyphicon glyphicon-remove'></span></button>
                                                                        </div>
                                                                    </form>
                                                                <?php } else if ($row['status'] == '2') { ?>
                                                                    <div class="btn-group">
                                                                        <?php if (isAdmin()) { ?>
                                                                            <button type="button" class="btn btn-warning btn-flat btn-xs" disabled>Pending</button>
                                                                            <button type="button" class="btn btn-warning btn-flat btn-xs dropdown-toggle" data-toggle="dropdown">
                                                                                <span class="caret"></span>
                                                                            </button>  
                                                                            <ul class="dropdown-menu" role="menu">
                                                                                <li><a href="db/ChangeStatus.php?id=<?php echo $row[0]; ?>&status=0&table=inventorycat&url=InventoryCategoryView">Approve</a></li>
                                                                                <li><a href="db/ChangeStatus.php?id=<?php echo $row[0]; ?>&status=1&table=inventorycat&url=InventoryCategoryView">Cancel</a></li>
                                                                            </ul>
                                                                        <?php } else { ?>
                                                                            <button type="button" class="btn btn-warning btn-flat btn-xs" disabled>Pending</button>                                                  
                                                                        <?php } ?>
                                                                    </div>
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div><!-- /.col -->
                            </div>

                            <div class="box box-info">
                                <form class="form-horizontal" action="./com.ebox.hovael.db/InventoryCategory.php" method="POST">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"> Category :</label>
                                            <div class="col-sm-10">
                                                <?php if (isAdmin()) { ?>
                                                    <select id="category" name="category" class="form-control" required>
                                                        <option value="select" selected="" disabled="">Select Category</option>
                                                    </select>
                                                <?php } else { ?>
                                                    <select id="category" name="category" class="form-control" required disabled="">
                                                        <option value="select" selected="" disabled="">Select Category</option>
                                                    </select>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"> ID :</label>
                                            <div class="col-sm-2">
                                                <label id="idLabel" class="control-label"></label>
                                            </div>
                                            <label class="col-sm-2 control-label"> Type :</label>
                                            <div class="col-sm-2">
                                                <select id="type" name="type" class="form-control" required disabled="">
                                                    <option value="select" selected="" disabled="">Select Type</option>
                                                    <option value="Vehicle">Vehicle</option>
                                                    <option value="Machine">Machine</option>
                                                    <option value="Equipment">Equipment</option>
                                                </select>
                                            </div>
                                            <label class="col-sm-2 control-label"> Service :</label>
                                            <div class="col-sm-2">
                                                <input id="service" type="number" name="service" class="form-control" placeholder="Service" required disabled="">
                                            </div>
                                        </div>
                                        <input type="hidden" id="id" name="id">
                                        <input type="hidden" value="update" name="function">
                                    </div>

                                    <div class="box-footer">
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <?php if (isAdmin()) { ?>
                                                    <button type="submit" class="btn btn-primary pull-right">Update</button>
                                                <?php } else { ?>
                                                    <button type="submit" class="btn btn-primary pull-right" disabled="">Update</button>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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

        <script type="text/javascript">
            $(function () {
                $("#table_inventorycat").DataTable();
            });
        </script>

        <script type="text/javascript">
            $(window).ready(function () {
                jQuery.ajax({
                    type: "POST",
                    url: './com.ebox.hovael.db/InventoryCategory.php',
                    dataType: 'json',
                    data: {functionname: 'search'},
                    success: function (obj, textstatus) {
                        if (!('error' in obj)) {
                            var category = obj.result.split(",");
                            $.each(category, function (val, text) {
                                if (text != '') {
                                    $('#category').append($('<option></option>').val(text.split(':')[1]).html(text.split(':')[0]));
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
            $('#category').change(function () {
                var inputs = document.getElementsByClassName('form-control');
                for (var i = 0; i < inputs.length; i++) {
                    inputs[i].disabled = false;
                }
                var selectedId = $(this).val();
                jQuery.ajax({
                    type: "POST",
                    url: './com.ebox.hovael.db/InventoryCategory.php',
                    dataType: 'json',
                    data: {functionname: 'searchfromid', id: selectedId},
                    success: function (obj, textstatus) {
                        if (!('error' in obj)) {
                            var data = obj;
                            $('#idLabel').html(data['id']);
                            $('#service').val(data['service']);
                            $('#type').val(data['type']);
                            if ('1' == data['status']) {
                                $('#status').prop('checked', true);
                            }
                            $('#id').val(data['id']);
                        }
                        else {
                            console.log(obj.error);
                        }
                    }
                });
            });
        </script>
    </body>
</html>