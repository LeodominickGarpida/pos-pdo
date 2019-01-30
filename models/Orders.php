<?php
    class Orders {
        // Db params
        private $conn;
        private $table = 'orders';
        
        // Orders Params
        public $product_id;
        public $quantity;
        public $subtotal;
        public $amount_paid;
        public $amount_due;
        public $discount;
        public $grandtotal;
        public $cashier;
        public $order_date;

        public function __construct($db) {
            $this->conn = $db;
        }

        function create() 
        {
            $number = count($this->product_id);

            $query = 'INSERT INTO orders
                        SET
                            subtotal = :subtotal,
                            amount_paid = :amount_paid,
                            amount_due = :amount_due,
                            discount = :discount,
                            grandtotal = :grandtotal,
                            cashier = :cashier,
                            order_date = :order_date ';
            
            // Prepare Statement
            $stmt = $this->conn->prepare($query);
            // Bind paramters
            $stmt->bindParam(':subtotal', $this->subtotal);
            $stmt->bindParam(':amount_paid', $this->amount_paid);
            $stmt->bindParam(':amount_due', $this->amount_due);
            $stmt->bindParam(':discount', $this->discount);
            $stmt->bindParam(':grandtotal', $this->grandtotal);
            $stmt->bindParam(':cashier', $this->cashier);
            $stmt->bindParam(':order_date', $this->order_date);

            $stmt->execute();
            
            $order_id = $this->conn->lastInsertId();     
                        
            
            for($x = 0; $x < $number; $x++) {			
                $updateProductQuantitySql = "SELECT quantity FROM products WHERE product_id = ".$this->product_id[$x]."";
                $stmt = $this->conn->prepare($updateProductQuantitySql);
                $stmt->execute();
                
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $updateProductQuantityResult = $row['quantity']; 
                    $updateQuantity[$x] = $updateProductQuantityResult - $this->quantity[$x];							
                    
                    $updateProductTable = "UPDATE products SET quantity = '".$updateQuantity[$x]."' WHERE product_id = ".$this->product_id[$x]."";
                    $stmt1 = $this->conn->prepare($updateProductTable);
                    $stmt1->execute();

                    
                    $orderItemSql = "INSERT INTO order_items (order_id, product_id, quantity) 
                    VALUES ('$order_id', '".$this->product_id[$x]."', '".$this->quantity[$x]."')";
                    $stmt2 = $this->conn->prepare($orderItemSql);

                    $stmt2->execute();
                } // while	
            } // /for quantity
        }

        function read() {

             // Select Query
             $query = 'SELECT * FROM '.$this->table.' ORDER BY order_date DESC';
                
            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        function readSingle() 
        {
            // Select Query
            $query = 'SELECT
                        a.order_id,
                        a.subtotal,
                        a.amount_paid,
                        a.amount_due,
                        a.discount,
                        a.grandtotal,
                        b.order_id,
                        b.product_id,
                        b.quantity,
                        c.product_id,
                        c.product_name
                    FROM '.$this->table.' as a
                    JOIN order_items as b
                    ON a.order_id = b.order_id
                    JOIN products as c
                    ON c.product_id = b.product_id
                    WHERE a.order_id = :order_id';
            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->order_id = htmlspecialchars(strip_tags($this->order_id));
            
            // Bidn Data
            $stmt->bindParam(':order_id', $this->order_id);

            // Execute query
            $stmt->execute();

            return $stmt;
        }
    }
?>