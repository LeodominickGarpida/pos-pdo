<?php
    // Include file
    include_once '../../config/Database.php';
    include_once '../../models/Accounts.php';

    // Instantiate Database and connect
    $database = new Database();
    $db = $database->connect();

    //  Instantiate categorie object
    $accounts = new Accounts($db);

    $accounts->id = $_POST['id'];
    $accounts->name = $_POST['name'];
    $accounts->username = $_POST['username'];
    $accounts->type = $_POST['type'];
    $accounts->updated_at = date('Y-m-d');

    $accounts->update();
    
    $_SESSION['name'] = $name;
    header('location:../../views/accounts.php');
?>