<?php require_once '../includes/header.php' ?>
<?php
     session_start();
    
     if(!isset($_SESSION['user_id'])) {
         header('location:login.php');
     }

     include_once '../config/Database.php';
     include_once '../models/Orders.php';
     include_once '../models/Accounts.php';
 
    $id = $_SESSION['user_id'];
    $name = $_SESSION['name'];


     $database = new Database;
     $db = $database->connect();
     
    $accounts = new Accounts($db);
    $AccResult = $accounts->readSingle($id, $db);


     $orders = new Orders($db);
     $result = $orders->read();
?>

<!-- Begin page -->
<div id="wrapper">
    <!-- Top Bar Start -->
    <div class="topbar">
        <!-- LOGO -->
        <div class="topbar-left">
            <h1><a href="#" class="logo">Point Of Sale</a></h1>
        </div>

        <nav class="navbar-custom">
            
        </nav>
    </div>

    <!-- Left Sidebar -->
    <div class="left side-menu">
        <div class="user-details">
            <div class="pull-left">
                <img src="../assets/images/users/avatar-1.png" alt="" class="thumb-md rounded-circle">
            </div>
            <div class="user-info">
                <a href="#"><?php echo $name;?></a>
                <p class="text-muted m-0">Administrator</p>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Navigation</li>
                <li>
                    <a href="dashboard.php">
                        <i class="ti-home"></i><span> Dashboard </span>
                    </a>
                </li>

                <li>
                    <a href="cart.php" >
                        <i class="mdi mdi-cart"></i><span> Cashier </span>
                    </a>
                </li>
                
                <li>
                    <a href="#" class="text-success">
                        <i class="mdi mdi-cash-multiple"></i><span> Transactions and Sales </span>
                    </a>
                </li>

                <li>
                    <a href="products.php">
                        <i class="mdi mdi-cellphone-link"></i><span> Products </span>
                    </a>
                </li>
                
                <li>
                    <a href="#" >
                        <i class="mdi mdi-tag-multiple"></i> <span> Categories </span>
                    </a>
                </li>
                
                <li>
                    <a href="brands.php">
                        <i class="mdi mdi-apple"></i> <span> Brands </span>
                    </a>
                </li>

                <li>
                    <a href="accounts.php">
                        <i class="mdi mdi-account-settings-variant"></i><span> Accounts </span>
                    </a>
                </li>

                <li>
                    <a href="logout.php">
                        <i class="mdi mdi-logout-variant"></i> <span> Logout </span>
                    </a>
                </li>
            </ul>

        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>

    <!-- Page Content -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-sm-12">
                        <h4 class="header-title m-t-0">Transaction History and Sales</h4>
                    </div>
                </div>
                
                <!-- date range input -->
                <div class="row m-b-20">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Select Date range</label>
                            <div id="reportrange" class="pull-right form-control">
                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                <span></span>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- table -->
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>OrderDate</th>
                                <th>Amount paid</th>
                                <th>Grand Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php foreach ($result as $row) {?>
                                    <td><?php echo $row['order_date']?></td>
                                    <td><?php echo $row['amount_paid']?></td>
                                    <td><?php echo $row['grandtotal']?></td>
                                    <td>
                                        <button id="<?php echo $row['order_id']?>" class="btn btn-icon btn-default btn_view"> <i class=" mdi mdi-cart-outline"></i></button>
                                    </td>
                            </tr>
                                <?php }?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total</th>
                                <th>-</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div> <!-- container -->

            <!-- Page Footer -->
            <div class="footer">
                <strong>Point Of Sale</strong> - Copyright © 2018 - 2019
            </div>

        </div> <!-- content -->

    </div>
</div>
<!-- END wrapper -->

<?php require_once '../includes/footer.php' ?>
