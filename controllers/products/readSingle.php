<?php

    // Include file
    include_once '../../config/Database.php';
    include_once '../../models/Products.php';
    

    // Instantiate Database and connect
    $database = new Database();
    $db = $database->connect();

    //  Instantiate categorie object
    $products = new Products($db);

    $products->product_id = $_POST['product_id'];


    $products->readSingle();

    $product_arr = array(
        'product_id' => $products->product_id,
        'product_name' => $products->product_name,
        'quantity' => $products->quantity,
        'price' => $products->price,
        'category_id' => $products->category_id,
        'brand_id' => $products->brand_id,
    );

   print_r(json_encode($product_arr));

?>