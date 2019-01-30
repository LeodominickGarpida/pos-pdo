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

    $categories->delete();
    

    header('location:../../views/categories.php');
?>