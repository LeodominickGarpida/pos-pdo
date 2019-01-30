<?php

    // Include file
    include_once '../../config/Database.php';
    include_once '../../models/Accounts.php';
    

    // Instantiate Database and connect
    $database = new Database();
    $db = $database->connect();

    //  Instantiate categorie object
    $accounts = new Accounts($db);

    // ID to delete
    $accounts->id = $_POST['id'];

    $accounts->remove();


?>