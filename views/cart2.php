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

    $db = $database->connect();

    $resultCategories = $categories->read();
    $resultBrands = $brands->read($db);
    $resultProducts = $products->read();
    $accounts = new Accounts($db);
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

    <!-- Left Sidebar -->
    <div class="left side-menu">
        <div class="user-details">
            <div class="pull-left">
                <img src="../assets/images/users/avatar-1.png" alt="" class="thumb-md rounded-circle">
            </div>
            <div class="user-info">
                <a href="#"><?php echo $name;?></a>
                <p class="text-muted m-0">Cashier</p>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Navigation</li>

                <li>
                    <a href="#" class="text-success">
                        <i class="mdi mdi-cart"></i><span> Cashier </span>
                    </a>
                </li>
                
                <li>
                    <a href="accountSettings.php">
                        <i class="mdi mdi-account-settings-variant"></i><span> Account Settings </span>
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
    <form action="../controllers/orders/create.php" method="post" class="form-validation m-b-20" id="orders-form-add">

    <!-- Page Content -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Form -->
                    <div class="col-lg-4">
                        <div class="">

                            <h4 class="header-title">Cash Register</h4>

                            <div class="m-b-20">
                                    <?php if(isset($_SESSION['message'])) {
                                            $msg = $_SESSION['message'];
                                            echo '
                                            <div class="alert alert-icon alert-success alert-dismissible fade show" role="alert">
                                                <i class="mdi mdi-check-all"></i>
                                                <strong>'.$msg.'!</strong> 
                                            </div>
                                            ';
                                            unset($_SESSION['message']);
                                        } 
                                    ?>

                                <h6 class="font-14 mt-4" id="categories-form-title">Add Product To Cart</h6>
                                    <div class="input-group m-t-10">
                                        <select class="form-control select2" name="product_id" id="product_id">
                                            <?php foreach($resultProducts as $row) { ?>
                                                <option value="<?php echo $row['product_id']?>"><?php echo $row['product_name']?></option>
                                            <?php }?>
                                        </select>
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-primary" id="add-cart">Add</button>
                                        </span>
                                    </div>

                                <table class="table table-striped p-10 m-t-35">
                        
                                    <tbody>
                                        <tr>
                                            <td>Subt Total</td>
                                            <td ><input type="number" name="subtotal" class="form-control" id="subtotal" value="0"></td>
                                        </tr>
                                        <!-- <tr>
                                            <td>VAT</td>
                                            <td ><input type="number" name="vat" class="form-control"  id="vat" value="600"></td>
                                        </tr> -->
                                        <tr>
                                            <td>Discount</td>
                                            <td ><input type="number" name="discount" class="form-control"  id="discount" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td>Grand Total</td>
                                            <td><input type="text" name="grandtotal"  class="form-control input-lg" id="grandTotal" value="0" ></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="amount_paid"  class="form-control input-lg" placeholder="Amout Paid" id="amountPaid"></td>
                                            <td><input type="text" name="amount_due" class="form-control input-lg" placeholder="Amout Due" id="amountDue"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- <button class="btn btn-primary btn-block btn-lg" id="process-order" type="submit">Process Order</button> -->
                            </div>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="col-lg-8">
                        <div class="p-20">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="cart">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Stocks</th>
                                            <th>Qty</th>
                                            <th>PPI</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody id="order">
                                        
                                    </tbody>
                                </table>
                                <button class="btn btn-primary btn-block btn-lg" id="process-order" type="submit">Process Order</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
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
