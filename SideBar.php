<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <div class="user-panel">
<!--            <div class="image">
                <div class="text-center">
                    <a class="btn btn-social-icon btn-facebook" href="https://www.facebook.com/pages/Hovael-Construction-Private-Limited/160143250716202" target="_blank"><i class="fa fa-facebook"></i></a>
                    <a class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>
                    <a class="btn btn-social-icon btn-linkedin"><i class="fa fa-linkedin"></i></a>
                    <a class="btn btn-social-icon btn-google-plus"><i class="fa fa-google-plus"></i></a>
                </div>
            </div>-->
        </div>
        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">QUICK NAVIGATION</li>
            <!-- Optionally, you can add icons to the links -->
<!--            <li><a href="SampleInsert.php"><i class='fa fa-star'></i> <span>- SAMPLE Insert -</span></a></li>
            <li><a href="SampleView.php"><i class='fa fa-star'></i> <span>- SAMPLE View -</span></a></li>
            <li><a href="SampleUpdate.php"><i class='fa fa-star'></i> <span>- SAMPLE Update -</span></a></li>-->
            <li class="treeview">
                <a href="#"><i class='fa fa-database'></i> <span>Inventory</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="InventoryView.php"><i class="fa fa-circle-o text-aqua"></i> Inventory</a></li>
                    <li><a href="InventoryTypeView.php"><i class="fa fa-circle-o text-aqua"></i> Inventory Type</a></li>
                    <li><a href="InventoryCategoryView.php"><i class="fa fa-circle-o text-aqua"></i> Inventory Category</a></li>
                </ul>
            </li>
            <li><a href="ViewRate.php"><i class='fa fa-table'></i> <span>Rates</span></a></li>
            <li class="treeview">
                <a href="#"><i class='fa fa-building'></i> <span>Sites</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="SiteView.php"><i class="fa fa-circle-o text-aqua"></i> Site View</a></li>
                    <li><a href="SiteUpdate.php"><i class="fa fa-circle-o text-aqua"></i> Site Update</a></li>
                </ul>
            </li>
            <li><a href="ViewDRC.php"><i class='fa fa-car'></i> <span>DRC</span></a></li>
            <li><a href="ViewDRME.php"><i class='fa fa-truck'></i> <span>DRME</span></a></li>
            <li><a href="ViewTransferNotes.php"><i class='fa fa-edit'></i> <span>Transfer Note</span></a></li>
            <!--<li><a href="#"><i class='fa fa-list-ul'></i> <span>Job Card</span></a></li>-->
            <!--<li><a href="InsertPurchaseReqForm.php"><i class='fa fa-shopping-cart'></i> <span>Purchase Requisition Form</span></a></li>-->
            <li class="treeview">
                <a href="#"><i class='fa fa-tachometer'></i> <span>Fuel</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="FuelStockView.php"><i class="fa fa-circle-o text-aqua"></i> Fuel Stock</a></li>
                    <li><a href="FuelBookView.php"><i class="fa fa-circle-o text-aqua"></i> Fuel Book</a></li>
                </ul>
            </li>
            <!--            <li class="treeview">
                            <a href="#"><i class='fa fa-signal'></i> <span>Lubricant</span> <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                                <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> Lubricant Stock</a></li>
                                <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> Lubricant Book</a></li>
                            </ul>
                        </li>-->
            <?php if(isAdmin()){ ?>
            <li><a href="Invoice.php"><i class='fa fa-table'></i> <span>Monthly Bill</span></a></li>
            <?php } ?>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>