<?php
session_start();
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
    <body onload="window.print();">

        <?php
        if (isset($_GET["msg"])) {
            $para = $_GET["msg"];
            $site = explode(":", $para)[0];
            $year = explode(":", $para)[1];
            $month = explode(":", $para)[2];
            switch ($month) {
                case 1: $monthname = 'Jan';
                    break;
                case 2: $monthname = 'Feb';
                    break;
                case 3: $monthname = 'Mar';
                    break;
                case 4: $monthname = 'Apr';
                    break;
                case 5: $monthname = 'May';
                    break;
                case 6: $monthname = 'Jun';
                    break;
                case 7: $monthname = 'Jul';
                    break;
                case 8: $monthname = 'Aug';
                    break;
                case 9: $monthname = 'Sep';
                    break;
                case 10: $monthname = 'Oct';
                    break;
                case 11: $monthname = 'Nov';
                    break;
                case 12: $monthname = 'Dec';
                    break;
                default : $monthname = '';
                    break;
            }
        } else {
            header('Location: ./Invoice.php');
        }
        ?>

        <div class="wrapper">
            <!-- Main content -->
            <section class="invoice">
                <!-- title row -->
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="page-header">
                            <i class="fa fa-globe"></i> HOVAEL CONSTRUCTIONS (PRIVATE) LIMITED<br/>
                            <small>
                                245/47, Old Avissawella Road, Orugodawatte, Sri Lanka<br>
                                <strong>Tel:</strong> (+94) 11 2531636/39, 2533044/46/48<br/>
                                <strong>Fax:</strong> (+94) 11 2532402/ 2531640/ 2572937<br/>
                                <strong>Email:</strong> construct@hovael.com<br>
                                <strong>URL:</strong> www.hovael.com
                            </small>
                            <hr/>
                            <small>Date: <b><?php echo date('Y.m.d'); ?></b> Time: <b><?php echo date('h.i A'); ?></b></small>
                        </h2>
                    </div><!-- /.col -->
                </div>

                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-8 invoice-col">
                        From
                        <address>
                            <strong>Swethe Feldano</strong><br>
                            245/47, Old Avissawella Road<br>
                            Orugodawatte, Sri Lanka<br>
                            <strong>Phone:</strong> (+94) 11 2531636/39, 2533044/46/48<br/>
                            <strong>Fax:</strong> (+94) 11 2532402/ 2531640/ 2572937<br/>
                            <strong>Email:</strong> construct@hovael.com<br>
                            <strong>URL:</strong> www.hovael.com
                        </address>
                    </div><!-- /.col -->

                    <div class="col-sm-4 invoice-col">
                        <b>Month :</b> <?php echo $monthname . ', ' . $year; ?><br/>
                        <?php
                        include './DBCon.php';
                        $sql = "SELECT location FROM site WHERE id='$site'";
                        $result = mysqli_query($con, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            if ($row = mysqli_fetch_assoc($result)) {
                                $sitename = $row['location'];
                            }
                        }
                        ?>
                        <b>Site :</b> <?php echo $sitename; ?>
                    </div><!-- /.col -->
                </div><!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Fuel Type</th>
                                    <th style="text-align: right;">Price (Rs.)</th>
                                    <th style="text-align: right;">Qty (Ltr)</th>
                                    <th style="text-align: right;">Total (Rs.)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM fuelstock WHERE idsite='$site' AND date LIKE '$year-$month%'";
                                $result = mysqli_query($con, $sql);
                                $count = 0;
                                $total = 0;
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $total += $row['price'] * $row['qty'];
                                        $count++;
                                        ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $row['date']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td style="text-align: right;"><?php echo $row['price']; ?></td>
                                            <td style="text-align: right;"><?php echo $row['qty']; ?></td>
                                            <td style="text-align: right;"><?php echo $row['price'] * $row['qty']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div><!-- /.col -->
                </div><!-- /.row -->

                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-xs-6">
                        <p class="lead">Payment Methods:</p>
                        <img src="./dist/img/credit/visa.png" alt="Visa"/>
                        <img src="./dist/img/credit/mastercard.png" alt="Mastercard"/>
                        <img src="./dist/img/credit/american-express.png" alt="American Express"/>
                        <img src="./dist/img/credit/paypal2.png" alt="Paypal"/>
                        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            <b>Payment Due :</b> within 30 days<br/>
                        </p>
                        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            <b>Account No :</b> 152368795625<br/>
                            <b>Account Details :</b><br/>
                            Hovael Constructions Pvt. Ltd.<br/>
                            Hatton National Bank<br/>
                            Maradana.
                        </p>
                    </div><!-- /.col -->
                    <div class="col-xs-6">
                        <p class="lead">Summary:</p>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th style="width:50%">Subtotal:</th>
                                    <td id="subtotal" style="text-align: right;">Rs.<?php echo $total; ?></td>
                                </tr>
                                <tr>
                                    <th>Transport (0.8%)</th>
                                    <td id="transport" style="text-align: right;">Rs.<?php echo $total * 0.8 / 100; ?></td>
                                </tr>
                                <tr class="bg-info">
                                    <th>Total:</th>
                                    <td id="total" style="text-align: right;">Rs.<?php echo $total + $total * 0.8 / 100; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->

            </section><!-- /.content -->
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

        <!-- Optionally, you can add Slimscroll and FastClick plugins.
              Both of these plugins are recommended to enhance the
              user experience. Slimscroll is required when using the
              fixed layout. -->

        <script type="text/javascript" src="plugins/jQueryUI/jquery-ui.js"></script>
        <script type="text/javascript" src="./com.ebox.hovael.js/jquery-ui-1.10.3.custom.min.js"></script>
        <script type="text/javascript" src="./com.ebox.hovael.js/portBox.slimscroll.min.js"></script>
    </body>
</html>