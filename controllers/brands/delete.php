<?php

    // Include file
    include_once '../../config/Database.php';
    include_once '../../models/Brands.php';
    

    // Instantiate Database and connect
    $database = new Database();
    $db = $database->connect();

    //  Instantiate categorie object
    $brands = new Brands($db);

    // Brand ID to be deleted
    $brands->brand_id = $_POST['brand_id'];

    $brands->delete();


?>