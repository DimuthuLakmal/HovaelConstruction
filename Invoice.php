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
        <link href="./com.ebox.hovael.css/portBox.css" rel="stylesheet" type="text/css" />
        <link href="css/hover.css" rel="stylesheet" type="text/css" />
    </head>

    <body class="skin-blue sidebar-mini">
        <div class="wrapper">

            <?php include './Header.php'; ?>
            <?php include './SideBar.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" id="mydiv">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        INVOICE <small>Monthly Bill</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="Home.php"><i class="fa fa-dashboard"></i> HOVAEL</a></li>
                        <li class="active">Invoice</li>
                    </ol>
                </section>

                <hr>

                <!-- Main content -->
                <section class="invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-globe"></i> HOVAEL CONSTRUCTIONS (PRIVATE) LIMITED
                                <small class="pull-right">Date: <b><?php echo date('Y.m.d'); ?></b> Time: <b><?php echo date('h.i A'); ?></b></small>
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
                                Tel: (+94) 11 2531636/39, 2533044/46/48<br/>
                                Fax: (+94) 11 2532402/2531640/2572937<br/>
                                Email: <a href="mailto:construct@hovael.com">construct@hovael.com</a><br>
                                URL: <a href="http://www.hovael.com">www.hovael.com</a>
                            </address>
                        </div><!-- /.col -->

                        <div class="col-sm-4 invoice-col">
                            <a href="Invoice.php"><button class="pull-right" type="button"><i class="fa fa-refresh"></i></button></a>
                            <br/>
                            <b>Month :</b> <input id="month" name="month" type="month" class="form-control" required=""><br/>
                            <b>Site :</b> 
                            <select id="site" name="site" class="form-control" required disabled="">
                                <option value="select" selected="" disabled="">Select Site</option>
                            </select>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <hr/>

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table id="viewtable" class="table table-bordered table-striped table-condensed">
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
                                <tbody></tbody>
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
                                        <td id="subtotal" style="text-align: right;">---</td>
                                    </tr>
                                    <tr>
                                        <th>Transport (0.8%)</th>
                                        <td id="transport" style="text-align: right;">---</td>
                                    </tr>
                                    <tr class="bg-info">
                                        <th>Total:</th>
                                        <td id="total" style="text-align: right;">---</td>
                                    </tr>
                                </table>
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <a id="link" href="" target="_blank" class="btn btn-danger pull-right"><i class="fa fa-print"></i> Print</a>
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
            $('#month').change(function () {
                var inputs = document.getElementsByClassName('form-control');
                for (var i = 0; i < inputs.length; i++) {
                    inputs[i].disabled = false;
                }
            });

            $('#site').change(function () {
                var inputs = document.getElementsByClassName('form-control');
                for (var i = 0; i < inputs.length; i++) {
                    inputs[i].disabled = true;
                }
                var site = $(this).val();
                var year = $('#month').val().split("-")[0];
                var month = $('#month').val().split("-")[1];
                var total = 0;

                document.getElementById('link').href = 'InvoicePrint.php?msg=' + site + ':' + year + ':' + month;

                jQuery.ajax({
                    type: "POST",
                    url: './com.ebox.hovael.db/FuelStock.php',
                    dataType: 'json',
                    data: {functionname: 'selectForInvoice', site: site, year: year, month: month},
                    success: function (obj, textstatus) {
                        if (!('error' in obj)) {
                            var columns = ['id','date', 'name', 'price', 'qty'];
                            var count = 1;
                            $.each(obj, function (key, value) {
                                var cellData = value.split(':');
                                $('#viewtable tbody').append("<tr id=\"row" + cellData[0] + "\"><td>" + count + "</td></tr>");
                                count++;
                                var columnNumber = 0;
                                var price = 0;
                                var qty = 0;
                                $.each(cellData, function (key, value) {
                                    if (columnNumber != 0) {
                                        if (columnNumber == 3) {
                                            price = value;
                                            $('#row' + cellData[0]).append("<td style=\"text-align: right;\" id=\"row" + cellData[0] + columns[columnNumber] + "\">" + value + "</td>");
                                        } else if (columnNumber == 4) {
                                            qty = value;
                                            $('#row' + cellData[0]).append("<td style=\"text-align: right;\" id=\"row" + cellData[0] + columns[columnNumber] + "\">" + value + "</td>");
                                        }
                                        if (columnNumber != 3 && columnNumber != 4) {
                                            $('#row' + cellData[0]).append("<td id=\"row" + cellData[0] + columns[columnNumber] + "\">" + value + "</td>");
                                        }
                                    }
                                    columnNumber++;
                                });
                                $('#row' + cellData[0]).append("<td style=\"text-align: right;\">" + price * qty + "</td>");
                                total += (price * qty);
                            });
                            $('#subtotal').html('Rs.' + total);
                            $('#transport').html('Rs.' + total * 0.8 / 100);
                            var nettotal = total + (total * 0.8 / 100);
                            $('#total').html('Rs.' + nettotal);
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
                    url: './com.ebox.hovael.db/SiteToController.php',
                    dataType: 'json',
                    data: {functionname: 'search'},
                    success: function (obj, textstatus) {
                        if (!('error' in obj)) {
                            var category = obj.result.split(",");
                            $.each(category, function (val, text) {
                                if (text != '') {
                                    $('#site').append($('<option></option>').val(text.split(':')[1]).html(text.split(':')[0]));
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
    </body>
</html>
