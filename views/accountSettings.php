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
    $result = $accounts->read($db);
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
                <a href="#"><?php echo $_SESSION['name']?></a>
                <p class="text-muted m-0">Administrator</p>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Navigation</li>

                <li>
                    <a href="cart2.php">
                        <i class="mdi mdi-cart"></i><span> Cashier </span>
                    </a>
                </li>
                
                <li>
                    <a href="#" class="text-success">
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

    <!-- Page Content -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Form -->
                    <div class="col-lg-6">
                        <div class="p-20">

                            <h4 class="header-title m-t-0">Account Settings</h4>
                            <p class="text-muted font-13 ">
                                you can add, edit and update accounts here.
                            </p>

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

                                        } elseif(isset($_SESSION['error'])) {
                                            $msg = $_SESSION['error'];
                                            echo '
                                            <div class="alert alert-icon alert-danger alert-dismissible fade show" role="alert">
                                                <i class="mdi mdi-block-helper"></i>
                                                <strong>'.$msg.'!</strong> 
                                            </div>
                                            ';
                                            unset($_SESSION['error']);
                                        }
                                    ?>
                                <h6 class="font-14 mt-4" id="accounts-form-title">Edit Account</h6>
                                <form action="../controllers/accounts/settings.php" method="post" class="form-validation">
                                    <div class="form-group">
                                        <label for="name">Name<span class="text-danger">*</span></label>
                                        <input type="text" name="name" placeholder="Name" class="form-control" id="name" value="<?php echo $_SESSION['name']?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Username<span class="text-danger">*</span></label>
                                        <input type="text" name="username" placeholder="Username" class="form-control" id="username" value="<?php echo $_SESSION['username']?>">
                                        <input type="hidden" name="id" id="id">
                                    </div>

                                    <div class="form-group" id="opass">
                                        <label for="old_password">Old Password<span class="text-danger">*</span></label>
                                        <input type="password" name="old_password" placeholder="Old Password" class="form-control" id="old_password">
                                    </div>

                                    <div class="form-group" id="pass">
                                        <label for="password">New Password<span class="text-danger">*</span></label>
                                        <input type="password" name="password" placeholder="New Password" class="form-control" id="password">
                                    </div>

                                    <!-- <div class="form-group" id="cpass">
                                        <label for="confirm_password">Confirm Password<span class="text-danger">*</span></label>
                                        <input type="password" name="confirm_password" placeholder="confirm password" class="form-control" id="confirm_password">
                                    </div> -->


                                    <div class="form-group text-right m-b-0">
                                        <input type="submit" value="Save" class="btn btn-primary" id="submit">
                                    </div>

                                </form>
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
