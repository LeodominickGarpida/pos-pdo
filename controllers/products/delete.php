<?php
    // Include file
    include_once '../../config/Database.php';
    include_once '../../models/Products.php';

    // Instantiate Database and connect
    $database = new Database();
    $db = $database->connect();

    //  Instantiate categorie object
    $products = new Products($db);
    
    // ID to be deleted 
    $products->product_id = $_POST['product_id'];

    $products->delete();
    

    // header('location:../../views/categories.php');
?>