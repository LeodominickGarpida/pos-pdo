<?php

    // Include file
    include_once '../../config/Database.php';
    include_once '../../models/Brands.php';
    

    // Instantiate Database and connect
    $database = new Database();
    $db = $database->connect();

    //  Instantiate categorie object
    $brands = new Brands($db);

    // Brand Id to get
    $brands->brand_id = $_POST['brand_id'];

    $brands->readSingle();

    $brand_arr = array(
        'brand_name' => $brands->brand_name,
    );

   echo json_encode($brand_arr);

?>