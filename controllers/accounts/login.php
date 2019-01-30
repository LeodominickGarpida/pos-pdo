<?php
    session_start();
    // Include files
    include_once '../../config/Database.php';
    include_once '../../models/Accounts.php';

    // Instantiate Database and connect
    $database = new Database();
    $db = $database->connect();
    //  Instantiate categorie object
    $accounts = new Accounts($db);

    $accounts->username = $_POST['username'];
    $accounts->passwordAttempt = $_POST['password'];


    if($accounts->resolve_login())
    {
        $_SESSION['user_id'] = $accounts->id;
        $_SESSION['type'] = $accounts->type;
        $_SESSION['name'] = $accounts->name;
        $_SESSION['username'] = $accounts->username;
        
        if($_SESSION['type'] == 1) {
            header('location:../../views/dashboard.php'); 
        }
        else {
            header('location:../../views/cart2.php'); 
        }
    }
    else {
        $_SESSION['message'] = 'Wrong Username or Password';

        header('location:../../views/login.php'); 
    }


        // if($accounts->resolve) {
        //     header('location:../../views/dashboard.php'); 
        // } else {
        //     echo 'tang ina mo';
        // }
    

    // $accounts->create($username, $passwordHash, $db);

    // echo 'Working';
    // header('Location:../../views/accounts.php');
?>