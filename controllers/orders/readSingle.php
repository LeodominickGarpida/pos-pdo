<?php

    // Include file
    include_once '../../config/Database.php';
    include_once '../../models/Orders.php';
    

    // Instantiate Database and connect
    $database = new Database();
    $db = $database->connect();

    //  Instantiate categorie object
    $orders = new Orders($db);

    $orders->order_id = $_POST['order_id'];

    $result = $orders->readSingle();

    // Row count
    $num = $result->rowCount();

    // Check if any Product
    if($num > 0) {
        // Product array
        $order_arr = array();
        $order_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $product_item = array(
                'product_name' => $product_name,
                'quantity' => $quantity
            );

            // push to data
            array_push($order_arr['data'], $product_item);
        }// end while loop

        // turn to json
        echo json_encode($order_arr);
    }
?>