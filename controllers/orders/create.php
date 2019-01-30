<?php
    session_start();

    // Include file
    include_once '../../config/Database.php';
    include_once '../../models/Orders.php';
    
    // Instantiate Database and connect
    $database = new Database();
    $db = $database->connect();
    
    $orders = new Orders($db);

    $orders->product_id = $_POST['product_id'];
    $orders->quantity = $_POST['quantity'];

    $orders->subtotal = $_POST['subtotal'];
    $orders->amount_paid = $_POST['amount_paid'];
    $orders->amount_due = $_POST['amount_due'];
    $orders->discount = $_POST['discount'];
    $orders->grandtotal = $_POST['grandtotal'];
    $orders->cashier = $_SESSION['user_id'];
    $orders->order_date = date('F j, Y');
    
    $orders->create($product_id, $quantity);


    $_SESSION['message'] = 'Order Complete';
    
    $type = $_SESSION['type'];

    if($type == 1) {
        header('location:../../views/cart.php');     
    }
    else {
        header('location:../../views/cart2.php');     
    }
?>