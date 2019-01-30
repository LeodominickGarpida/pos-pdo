<?php 

    session_start();
    // Include files
    include_once '../../config/Database.php';
    include_once '../../models/Accounts.php';

    // Instantiate Database and connect
    $database = new Database();
    $db = $database->connect();
    //  Instantiate categorie object
    $accounts = new Accounts;

    $name = $_POST['name'];

    $new_username = $_POST['username'];
    $username = $_SESSION['username'];

    $passwordAttempt = $_POST['old_password'];
    $password = $_POST['password'];

    $passwordHash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));


    if($accounts->resolve_login($username, $passwordAttempt, $db))
    {
        $id = $accounts->id;
        if($accounts->updateOwn($id, $name, $new_username, $passwordHash, $db))
        {
  
            $_SESSION['name'] = $accounts->name;
            $_SESSION['username'] = $username;
            
            $_SESSION['message'] = 'Account Updated';
            header('location:../../views/accountSettings.php'); 

        }
        else {


        }
    }
    else {
        $_SESSION['error'] = 'Old Password not match';
        header('location:../../views/accountSettings.php'); 

    }
?>