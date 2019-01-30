<?php require_once '../includes/header.php' ?>
<?php
    session_start();
    
    if(!isset($_SESSION['user_id'])) {
        header('location:login.php');
    }

    include_once '../config/Database.php';
    include_once '../models/Categories.php';
    include_once '../models/Brands.php';
    include_once '../models/Products.php';

    $id = $_SESSION['user_id'];
    $name = $_SESSION['name'];
    
    $database = new Database();
    $db = $database->connect();

    $categories = new Categories($db);
    $brands = new Brands($db);
    $products = new Products($db);

    $db = $database->connect();

    $resultCategories = $categories->read();
    $resultBrands = $brands->read();
    $resultProducts = $products->read();

    $categoriesCount = $resultCategories->rowCount();
    $brandsCount = $resultBrands->rowCount();
    $productsCount = $resultProducts->rowCount();

?>

<!-- Begin page -->
<div id="wrapper">
    <!-- Top Bar Start -->
    <div class="topbar">
        <!-- LOGO -->
        <div class="topbar-left">
            <h1><a href="#" class="logo">INVENTORY</a></h1>
        </div>

        <nav class="navbar-custom"></nav>
    </div>
    <!-- Top Bar End -->

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
                    <a href="#" class="text-success">
                        <i class="ti-home"></i><span> Dashboard </span>
                    </a>
                </li>
                
                <li>
                    <a href="cart.php">
                        <i class="mdi mdi-cart"></i><span> Cashier </span>
                    </a>
                </li>
                
                <li>
                    <a href="sales.php">
                        <i class="mdi mdi-cash-multiple"></i><span> Transactions and Sales </span>
                    </a>
                </li>
                
                <li>
                    <a href="products.php">
                        <i class="mdi mdi-cellphone-link"></i><span> Products </span>
                    </a>
                </li>
                
                <li>
                    <a href="categories.php" >
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
            <!-- Page Title -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="header-title m-t-0">Dashboard</h4>
                    </div>
                </div>
                <!-- widgets -->
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card-box">
                            <a href="products.php" class="btn btn-sm btn-default pull-right">View</a>
                            <h6 class="text-muted font-13 m-t-0 text-uppercase">Products</h6>
                            <h3 class="m-b-20 mt-3"><span><?php echo $productsCount;?></span></h3>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="card-box">
                            <a href="categories.php" class="btn btn-sm btn-default pull-right">View</a>
                            <h6 class="text-muted font-13 m-t-0 text-uppercase">Categories</h6>
                            <h3 class="m-b-20 mt-3"><span><?php echo $categoriesCount; ?></span></h3>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="card-box">
                            <a href="brands.php" class="btn btn-sm btn-default pull-right">View</a>
                            <h6 class="text-muted m-t-0 font-13 text-uppercase">Brands</h6>
                            <h3 class="m-b-20"><?php echo $brandsCount?></h3>
                        </div>
                    </div>

                </div>
                <!-- Table -->
                <div class="card-box">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Quantity</th>
                                    <th>PPI</th>
                                </tr>
                            </thead>


                            <tbody>
                                <tr>
                                    <?php foreach ($resultProducts as $row) {?>
                                        <td><?php echo $row['product_name']?></td>
                                        <td><?php echo $row['category_name']?></td>
                                        <td><?php echo $row['brand_name']?></td>
                                        <td><?php echo $row['quantity']?></td>
                                        <td>P <?php echo $row['price']?></td>
                                </tr>
                                    <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 

            <!-- Page Footer -->
            <div class="footer">
                <strong>INVENTORY</strong> - Copyright © 2018 - 2019
            </div>
        </div> 
    </div>
</div>
<!-- END wrapper -->

<?php require_once '../includes/footer.php' ?>
