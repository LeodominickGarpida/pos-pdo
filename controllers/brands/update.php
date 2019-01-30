<?php
    // Include files
    include_once '../../config/Database.php';
    include_once '../../models/Brands.php';

    // Instantiate Database and connect
    $database = new Database();
    $db = $database->connect();

    //  Instantiate categorie object
    $brands = new brands($db);

    $brands->brand_id = $_POST['brand_id'];
    $brands->brand_name = $_POST['brand_name'];
    $brands->updated_at = date('F j, Y');
    
    $brands->update();

    header('location:../../views/brands.php');
   
?>