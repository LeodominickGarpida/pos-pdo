<?php
    // Include file
    include_once '../../config/Database.php';
    include_once '../../models/Categories.php';
    
    // Instantiate Database and connect
    $database = new Database();
    $db = $database->connect();

    //  Instantiate categorie object
    $categories = new Categories($db);

    // $categories->conn = $db;
    $categories->created_at = date('F j, Y');
    $categories->category_name = $_POST['category_name'];
    
    $categories->create();

    header('Location:../../views/categories.php');
    
?>