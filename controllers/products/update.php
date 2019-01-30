<?php
    // Include files
    include_once '../../config/Database.php';
    include_once '../../models/Products.php';

    // Instantiate Database and connect
    $database = new Database();
    $db = $database->connect();

    //  Instantiate categorie object
    $products = new products($db);

    $products->product_id = $_POST['product_id'];
    $products->product_name = $_POST['product_name'];
    $products->quantity = $_POST['quantity'];
    $products->price = $_POST['price'];
    $products->category_id = $_POST['category_id'];
    $products->brand_id = $_POST['brand_id'];

    $products->update();

    header('Location:../../views/products.php');

?>