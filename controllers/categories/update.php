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
    $categories->category_name = $_POST['category_name'];
    $categories->updated_at = date('F j, Y');

    $categories->update();
    
    header('location:../../views/categories.php');
?>