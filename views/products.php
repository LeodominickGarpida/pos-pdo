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
    include_once '../models/Accounts.php';

    $id = $_SESSION['user_id'];
    $name = $_SESSION['name'];


    $database = new Database;
    $db = $database->connect();

    $categories = new Categories($db);
    $brands = new Brands($db);
    $products = new Products($db);
    $accounts = new Accounts($db);


    $resultCategories = $categories->read();
    $resultBrands = $brands->read();
    $resultProducts = $products->read($db);
    $AccResult = $accounts->readSingle($id, $db);

?>
<!-- Begin page -->
<div id="wrapper">
    <!-- Top Bar Start -->
    <div class="topbar">
        <!-- LOGO -->
        <div class="topbar-left">
            <h1><a href="#" class="logo">INVENTORY</a></h1>
        </div>

        <nav class="navbar-custom">
        </nav>
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
                    <a href="dashboard.php">
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

                <li class="">
                    <a href="#" class="text-success">
                        <i class="mdi mdi-cellphone-link"></i><span> Products </span>
                    </a>
                </li>
                
                <li>
                    <a href="categories.php">
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
                <div class="row">
                    <!-- form -->
                    <div class="col-lg-4">
                        <div class="p-20">
                            <h4 class="header-title m-t-0">Products</h4>
                            <p class="text-muted font-13 ">
                                you can add, edit and update products here.
                            </p>
                            <div class="m-b-20">
                                <h6 class="font-14 mt-4" id="products-form-title">Add New Product</h6>
                                <form action="../controllers/products/create.php" class="form-validation" method="post" id="products-form-add">
                                    <div class="form-group">
                                        <label for="category_id">Category<span class="text-danger">*</span></label>
                                        <select class="form-control select2" name="category_id" id="category_id">
                                            <?php foreach($resultCategories as $row) { ?>
                                                <option value="<?php echo $row['category_id']?>"><?php echo $row['category_name']?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                         <label for="brand_id">Brand<span class="text-danger">*</span></label>
                                        <select class="form-control select2" name="brand_id" id="brand_id">
                                            <?php foreach($resultBrands as $row) { ?>
                                                <option value="<?php echo $row['brand_id']?>"><?php echo $row['brand_name']?></option>
                                            <?php }?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="product_name">Name<span class="text-danger">*</span></label>
                                        <input type="text" name="product_name" placeholder="Product Name" class="form-control" id="product_name">
                                        <input type="hidden" name="product_id" placeholder="Product Name" class="form-control" id="product_id">
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="quantity">Quantity<span class="text-danger">*</span></label>
                                                <input type="number" name="quantity" class="form-control" id="quantity">
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="price">Price per Item<span class="text-danger">*</span></label>
                                                <input type="text" name="price" class="form-control" id="price">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group text-right m-b-0">
                                        <input type="submit" value="Submit" class="btn btn-primary" id="submit">
                                        <button class="btn btn-default" id="cancel-button">Cancel</button>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                    <!-- table -->
                    <div class="col-lg-8">
                        <div class="p-20">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>PPI</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>


                                    <tbody id="tb">
                                        <tr>
                                            <?php foreach ($resultProducts as $row) {?>
                                                <td><?php echo $row['product_name']?></td>
                                                <td><?php 
                                                        if($row['quantity'] == 0) {
                                                            echo 'out of stock';
                                                        }
                                                        else {
                                                           echo $row['quantity'];
                                                        }
                                                ?></td>
                                                <td> P <?php echo $row['price']?></td>
                                                <td>
                                                    <a id="<?php echo $row['product_id']?>" class="btn btn-icon btn-default products-edit-data"> <i class=" mdi mdi-pencil"></i> </a>
                                                    <a id="<?php echo $row['product_id']?>" class="btn btn-icon btn-default products-remove-data"> <i class="mdi mdi-delete-forever"></i> </a>
                                                </td>
                                        </tr>
                                            <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div> <!-- container -->

            <!-- Page Footer                                  -->
            <div class="footer">
                <strong>INVENTORY</strong> - Copyright © 2018 - 2019
            </div>
        </div> <!-- content -->
    </div>
</div>
<!-- END wrapper -->
<?php require_once '../includes/footer.php' ?>