<!-- Main Header -->
<!--<header class="main-header" style="z-index: 825;">-->
<header class="main-header">

    <!-- Logo -->
    <a href="Index.php" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>H</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>HOVAEL</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- Messages: style can be found in dropdown.less-->
                <?php
                if (isAdmin()) {
                    include './DBCon.php';
                    include './ctrl/checkSiteValidity.php';
                    $res = mysqli_query($con, "SELECT * FROM site WHERE status!='0'");
                    ?>
                    <li class="dropdown messages-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-building-o"></i>
                            <span class="label label-success"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have sites to be expired</li>
                            <li>
                                <!-- inner menu: contains the messages -->
                                <ul class="menu">
                                    <?php
                                    while (($row = mysqli_fetch_array($res))) {
                                        $enddate = $row['enddate'];
                                        if (isSitesToBeExpired($enddate)) {
                                            ?>
                                            <li><!-- start message -->
                                                <a href="SiteView.php">
                                                    <div class="pull-left">
                                                        <!-- User Image -->
                                                        <img src="img/site.png" class="img-circle" alt="Expire Image"/>
                                                    </div>
                                                    <!-- Message title and timestamp -->
                                                    <h4>
                                                        <?php echo $row['location']; ?>
                                                        <small><i class="fa fa-clock-o"></i> Expired : <strong><?php echo $row['enddate']; ?></strong></small>
                                                    </h4>
                                                    <!-- The message -->
                                                    <p>Site Manager : <?php echo $row['sitemanager']; ?></p>
                                                </a>
                                            </li><!-- end message -->
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul><!-- /.menu -->
                            </li>
                            <li class="footer"><a href="SiteView.php">See Details</a></li>
                        </ul>
                    </li><!-- /.messages-menu -->
                <?php } ?>

                <!-- Notifications Menu -->
                <?php
                if (isAdmin()) {
                    include './DBCon.php';
                    $res = mysqli_query($con, "SELECT * FROM fuelconsumptionrate JOIN inventory ON fuelconsumptionrate.idinventorytype=inventory.idinventorytype WHERE fuelconsumptionrate.status!='0'");
                    ?>
                    <li class="dropdown tasks-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-tachometer"></i>
                            <span class="label label-warning"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have fuel over use notifications</li>
                            <li>
                                <!-- Inner Menu: contains the notifications -->
                                <ul class="menu">
                                    <?php
                                    while (($row = mysqli_fetch_array($res))) {
                                        $idinventory = $row[6];
                                        $code = $row['code'];
                                        $regno = $row['regno'];
                                        $fuelConsumptionRate = $row['hirerate'];
                                        $unit = $row['unit'];
                                        $splits = explode("#", $fuelConsumptionRate);
//                                        $splits = explode("-", $splits[0]);
                                        $splits = $splits[0];
                                        $res1 = mysqli_query($con, "SELECT * FROM fuelbook WHERE idinventory=$idinventory AND fuelbook.status!='0'");
                                        $count = 0;
                                        $consumedLtr = 0;
                                        $startMeter = 0;
                                        $endMeter = 0;
                                        while (($row1 = mysqli_fetch_array($res1))) {
                                            $count++;
                                            if ($count == 1) {
                                                $startMeter = $row1['meterreading'];
                                            }
                                            $consumedLtr += $row1['qty'];
                                            $endMeter = $row1['meterreading'];
                                        }
                                        $monthMeter = $endMeter - $startMeter;
                                        if ($startMeter == $endMeter) {
                                            $monthMeter = $startMeter;
                                        }
                                        if ($consumedLtr > 0) {
                                            if ($unit == 1) { // Km/Ltr
                                                $proposedLtr = round($monthMeter / $splits[0], 3);
                                            } else if ($unit == 1) { // Ltr/Hrs
                                                $proposedLtr = round($monthMeter * $splits[0], 3);
                                            }
                                            $ratio = round($consumedLtr / $proposedLtr, 4) * 100;
                                            if ($ratio > 75) {
                                                ?>
                                                <li><!-- start notification -->
                                                    <a href="FuelBookView.php">
                                                        <h5>
                                                            <span class="label label-primary"><?php echo $code; ?></span> <?php echo $regno; ?>
                                                            <small class="pull-right"><?php echo $ratio; ?>%</small>
                                                        </h5>
                                                        <div class="progress xs">
                                                            <!-- Change the css width attribute to simulate progress -->
                                                            <?php if ($ratio > 100) { ?>
                                                                <div class="progress-bar progress-bar-danger" style="width: <?php echo $ratio; ?>%" role="progressbar" aria-valuenow="<?php echo $ratio; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <?php } else if ($ratio > 90) { ?>
                                                                <div class="progress-bar progress-bar-warning" style="width: <?php echo $ratio; ?>%" role="progressbar" aria-valuenow="<?php echo $ratio; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <?php } else { ?>
                                                                <div class="progress-bar progress-bar-info" style="width: <?php echo $ratio; ?>%" role="progressbar" aria-valuenow="<?php echo $ratio; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                            <?php } ?>
                                                        </div>
                                                    </a>
                                                </li><!-- end notification -->
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </ul>
                            </li>
                            <li class="footer"><a href="ViewUser.php">View all</a></li>
                        </ul>
                    </li>
                <?php } ?>

                <!-- Tasks Menu -->
                <?php
                if (isAdmin()) {
                    include './DBCon.php';
                    $search = array("inventorycat" => 0, "inventorytype" => 0, "inventory" => 0, "internalhirerate" => 0, "plantrate" => 0, "fuelconsumptionrate" => 0, "site" => 0, "drc" => 0, "drme" => 0, "transfernote" => 0, "fuelstock" => 0, "fuelbook" => 0);
                    $name = array("Inventory Category", "Inventory Type", "Inventory", "Internal Hire Rate", "Plant Rate", "Fuel Consumption Rate", "Site", "DRC", "DRME", "Transfer Note", "Fuel Stock", "Fuel Book",);
                    $url = array("InventoryCategoryView", "InventoryTypeView", "InventoryView", "ViewRate", "ViewRate", "ViewRate", "SiteView", "ViewDRC", "ViewDRME", "ViewTransferNotes", "FuelStockView", "FuelBookView",);
                    $totCount = 0;
                    foreach ($search as $x => $x_value) {
                        $search[$x] = mysqli_num_rows(mysqli_query($con, "SELECT * FROM $x WHERE status='2'"));
                        $totCount+=$search[$x];
                    }
                    ?>
                    <li class="dropdown tasks-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-warning"></i>
                            <span class="label label-danger"><?php echo $totCount; ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have <?php echo $totCount; ?> delete requests pending</li>
                            <li>
                                <!-- Inner menu: contains the tasks -->
                                <ul class="menu">
                                    <?php
                                    $count = 0;
                                    $index = 0;
                                    foreach ($search as $x => $x_value) {
                                        if ($search[$x] > 0) {
                                            $ratio = round(($x_value * 100 / $totCount), 2);
                                            ?>
                                            <li><!-- Task item -->
                                                <?php
//                                                $file = 'http://localhost/HOVAEL/View' . str_replace(' ', '', $name[$index]) . '.php';
//                                                $headers = @get_headers($file);
//                                                if (strpos($headers[0], '404') === false) {
//                                                    $exists = false;
//                                                } else {
//                                                    $exists = true;
//                                                    $file = 'http://localhost/HOVAEL/' . str_replace(' ', '', $name[$index]) . 'View.php';
//                                                }
                                                $file = 'http://localhost/HOVAEL/' . $url[$index] . '.php';
                                                ?>
                                                <a href="<?php echo $file; ?>">
                                                    <!-- Task title and progress text -->
                                                    <h3>
                                                        <?php if ($count % 4 == 0) { ?>
                                                            <span class="label label-primary"><?php echo $x_value; ?></span> <?php echo $name[$index]; ?>
                                                        <?php } else if ($count % 4 == 1) { ?>
                                                            <span class="label label-danger"><?php echo $x_value; ?></span> <?php echo $name[$index]; ?>
                                                        <?php } else if ($count % 4 == 2) { ?>
                                                            <span class="label label-success"><?php echo $x_value; ?></span> <?php echo $name[$index]; ?>
                                                        <?php } else if ($count % 4 == 3) { ?>
                                                            <span class="label label-warning"><?php echo $x_value; ?></span> <?php echo $name[$index]; ?>
                                                        <?php } ?>
                                                        <small class="pull-right"><?php echo $ratio; ?>%</small>
                                                    </h3>
                                                </a>
                                            </li><!-- end task item -->
                                            <?php
                                            $count++;
                                        }
                                        $index++;
                                    }
                                    ?>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="#">View all</a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>

                <!-- Messages: style can be found in dropdown.less-->
                <?php
                if (isAdmin()) {
                    include './DBCon.php';
                    $res = mysqli_query($con, "SELECT * FROM user JOIN userinfo ON user.iduserinfo = userinfo.id JOIN site ON userinfo.work = site.id WHERE user.status='0'");
                    $count = mysqli_num_rows($res);
                    ?>
                    <li class="dropdown messages-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-users"></i>
                            <span class="label label-success"><?php echo $count; ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have <?php echo $count; ?> new users</li>
                            <li>
                                <!-- inner menu: contains the messages -->
                                <ul class="menu">
                                    <?php while (($row = mysqli_fetch_array($res))) { ?>
                                        <li><!-- start message -->
                                            <a href="ViewUser.php">
                                                <div class="pull-left">
                                                    <!-- User Image -->
                                                    <img src="img/user.png" class="img-circle" alt="User Image"/>
                                                </div>
                                                <!-- Message title and timestamp -->
                                                <h4>
                                                    <?php echo $row['fname'] . ' ' . $row['lname']; ?>
                                                    <small><i class="fa fa-building-o"></i> Site : <strong><?php echo $row['location']; ?></strong></small>
                                                </h4>
                                                <!-- The message -->
                                                <p><?php echo $row['designation'] . ' - ' . $row['mobile']; ?></p>
                                            </a>
                                        </li><!-- end message -->
                                    <?php } ?>
                                </ul><!-- /.menu -->
                            </li>
                            <li class="footer"><a href="ViewUser.php">See Details</a></li>
                        </ul>
                    </li><!-- /.messages-menu -->
                <?php } ?>

                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="img/user.png" class="user-image" alt="User Image"/>
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">
                            <?php
                            echo $_SESSION['fname'];
                            echo ' ';
                            echo $_SESSION['lname'];
                            ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header" style="height: 180px;">
                            <img src="img/user.png" class="img-circle" alt="User Image" />
                            <p>
                                <?php
                                echo '<b>' . $_SESSION['fname'];
                                echo ' ';
                                echo $_SESSION['lname'] . '</b>';
                                echo '<br/>';
                                echo $_SESSION['desig'];
                                ?>
                                <small><?php echo $_SESSION['location']; ?></small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <!--                            <li class="user-body">
                                                            <div class="col-xs-4 text-center">
                                                                <a href="#">Users</a>
                                                            </div>
                                                            <div class="col-xs-4 text-center">
                                                                <a href="#">User Type</a>
                                                            </div>
                                                            <div class="col-xs-4 text-center">
                                                                <a href="#">User Sessions</a>
                                                            </div>
                                                        </li>-->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="Profile.php" class="btn btn-default btn-flat">Profile</a>
                                <?php
                                $user_type = $_SESSION['type'];
                                if ($user_type == 'Super Admin' || $user_type == 'Admin' || $user_type == 'Manager') {
                                    ?>
                                    <a href="ViewUser.php" class="btn btn-default btn-flat">Users</a>
                                <?php } ?>
                            </div>
                            <div class="pull-right">
                                <a href="db/Lock.php" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>