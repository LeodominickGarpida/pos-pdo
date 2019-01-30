<?php require_once '../includes/header.php' ?>
<?php
    session_start();
    
    if(!isset($_SESSION['user_id'])) {
        header('location:login.php');
    }
    include_once '../config/Database.php';
    include_once '../models/Accounts.php';

    $id = $_SESSION['user_id'];

    $database = new Database;
    $db = $database->connect();

    $accounts = new Accounts($db);
    $result = $accounts->read();
    
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
                <a href="#"><?php echo $_SESSION['name'];?></a>
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
                    <a href="" class="text-success">
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

                            <h4 class="header-title m-t-0">Accounts</h4>
                            <p class="text-muted font-13 ">
                                you can add, edit and update accounts here.
                            </p>

                            <div class="m-b-20">
                                <h6 class="font-14 mt-4" id="accounts-form-title">Add New Account</h6>
                                
                                <form action="../controllers/accounts/create.php" method="post" class="form-validation"  id="accounts-form-add">
                                    <div class="form-group">
                                        <label for="name">Name<span class="text-danger">*</span></label>
                                        <input type="text" name="name" placeholder="Name" class="form-control" id="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Username<span class="text-danger">*</span></label>
                                        <input type="text" name="username" placeholder="Username" class="form-control" id="username">
                                        <input type="hidden" name="id" id="id">
                                    </div>

                                    <div class="form-group" id="pass">
                                        <label for="password">Password<span class="text-danger">*</span></label>
                                        <input type="password" name="password" placeholder="Password" class="form-control" id="password">
                                    </div>

                                    <div class="form-group" id="cpass">
                                        <label for="confirm_password">Confirm Password<span class="text-danger">*</span></label>
                                        <input type="password" name="confirm_password" placeholder="confirm password" class="form-control" id="confirm_password">
                                    </div>

                                    <div class="form-group">
                                        <label for="type">Account Type<span class="text-danger">*</span></label>
                                        <select name="type" id="type" class="form-control">
                                            <option value="1">Admin</option>
                                            <option value="0">Cashier</option>
                                        </select>
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
                                            <th>Username</th>
                                            <th>Account Type</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tb">
                                        <tr>
                                            <?php foreach ($result as $row) {?>
                                                <td><?php echo $row['name']?></td>
                                                <td><?php echo $row['username']?></td>
                                                <td>
                                                    <?php
                                                        if($row['type'] == 1) {
                                                            echo 'Admin';
                                                        }
                                                        else {
                                                            echo 'Cashier';
                                                        }
                                                    ?>
                                                </td>
                                                
                                                <td>
                                                    <a id="<?php echo $row['id']?>" class="btn btn-icon btn-default accounts-edit-data"> <i class=" mdi mdi-pencil"></i> </a>
                                                    <a id="<?php echo $row['id']?>" class="btn btn-icon btn-default accounts-remove-data"> <i class="mdi mdi-delete-forever"></i> </a>
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
