<?php require_once '../includes/header.php' ?>
<?php
    session_start();
    
    if(!isset($_SESSION['user_id'])) {
        header('location:login.php');
    }
    include_once '../config/Database.php';
    include_once '../models/Categories.php';
    include_once '../models/Accounts.php';

    $id = $_SESSION['user_id'];
    $name = $_SESSION['name'];

    $database = new Database;
    $db = $database->connect();

    $categories = new Categories($db);
    $result = $categories->read();

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

                <li>
                    <a href="products.php">
                        <i class="mdi mdi-cellphone-link"></i><span> Products </span>
                    </a>
                </li>
                
                <li>
                    <a href="#" class="text-success">
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
                    <!-- Form -->
                    <div class="col-lg-4">
                        <div class="p-20">

                            <h4 class="header-title m-t-0">Categories</h4>
                            <p class="text-muted font-13 ">
                                you can add, edit and update category here.
                            </p>

                            <div class="m-b-20">
                                <h6 class="font-14 mt-4" id="categories-form-title">Add New Category</h6>
                                <form action="../controllers/categories/create.php" method="post" class="form-validation" id="categories-form-add">
                                    <div class="form-group" id="c-f-g">
                                        <label for="category_name">Category<span class="text-danger">*</span></label>
                                        <input type="text" name="category_name" placeholder="Enter new category" class="form-control" id="category_name">
                                        <input type="hidden" name="category_id" id="category_id">
                                    </div>

                                    <div class="form-group text-right m-b-0">
                                        <input type="submit" value="Submit" class="btn btn-primary" id="submit">
                                        <button class="btn btn-default" id="cancel-button">Cancel</button>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>

                    <!-- Table -->
                    <div class="col-lg-8">
                        <div class="p-20">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tb">
                                        <tr>
                                            <?php foreach ($result as $row) {?>
                                                <td><?php echo $row['category_name']?></td>
                                                <td><?php echo $row['created_at']?></td>
                                                <td><?php
                                                        if($row['updated_at'] == '') {
                                                            echo 'Not updated';
                                                        }
                                                        else {
                                                            echo $row['updated_at'];
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <a id="<?php echo $row['category_id']?>" class="btn btn-icon btn-default categories-edit-data"> <i class=" mdi mdi-pencil"></i> </a>
                                                    <a id="<?php echo $row['category_id']?>" class="btn btn-icon btn-default categories-remove-data"> <i class="mdi mdi-delete-forever"></i> </a>
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

            <!-- Page Footer -->
            <div class="footer">
                <strong>INVENTORY</strong> - Copyright © 2018 - 2019
            </div>

        </div> <!-- content -->

    </div>
</div>
<!-- END wrapper -->

<?php require_once '../includes/footer.php' ?>
