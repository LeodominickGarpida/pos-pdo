<?php

    // Include file
    include_once '../../config/Database.php';
    include_once '../../models/Accounts.php';
    

    // Instantiate Database and connect
    $database = new Database();
    $db = $database->connect();

    //  Instantiate account object
    $accounts = new Accounts($db);

    $accounts->id = $_POST['id'];

    $accounts->readSingle2();

    $accounts_arr = array(
        'name' => $accounts->name,
        'username' => $accounts->username,
        'type' => $accounts->type
    );

   echo json_encode($accounts_arr);

?>