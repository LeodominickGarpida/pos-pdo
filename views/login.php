<?php 
    require_once '../includes/header.php';
    session_start();
?>

<div class="wrapper-page">

    <div class="card-box">
        <div class="text-center">
            <h4 class="text-uppercase font-bold m-b-0">Sign In</h4>
        </div>
        <div class="account-content">
            <?php if(isset($_SESSION['message'])) {
                    $msg = $_SESSION['message'];
                    echo '
                    <div class="alert alert-icon alert-danger alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-block-helper"></i>
                        <strong>'.$msg.'!</strong> 
                    </div>
                    ';
                    unset($_SESSION['message']);
                 } 
            ?>

            <form class="form-horizontal" action="../controllers/accounts/login.php" method="post">
                <div class="form-group m-b-20">
                    <div class="col-xs-12">
                        <label for="username">Username</label>
                        <input class="form-control" type="text" name="username" id="username" required="" placeholder="Enter your username">
                    </div>
                </div>

                <div class="form-group m-b-20">
                    <div class="col-xs-12">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password" required="" id="password" placeholder="Enter your password">
                    </div>
                </div>

                <!-- <div class="form-group m-b-30">
                    <div class="col-xs-12">
                        <div class="checkbox checkbox-primary">
                            <input id="checkbox5" type="checkbox">
                            <label for="checkbox5">
                                Remember me
                            </label>
                        </div>
                    </div>
                </div> -->

                <div class="form-group account-btn text-center m-t-10">
                    <div class="col-xs-12">
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign In</button>
                    </div>
                </div>

            </form>

            <div class="clearfix"></div>

        </div>
    </div>
    <!-- end card-box-->

</div>
<!-- end wrapper -->

<?php require_once '../includes/footer.php';?>