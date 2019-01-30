<?php

    // Include file
    include_once '../../config/Database.php';
    include_once '../../models/Categories.php';
    

    // Instantiate Database and connect
    $database = new Database();
    $db = $database->connect();

    //  Instantiate categorie object
    $categories = new Categories($db);

    $categories->category_id = $_POST['category_id'];

    $categories->readSingle();

    $category_arr = array(
        'category_name' => $categories->category_name,
    );

   echo json_encode($category_arr);

?>