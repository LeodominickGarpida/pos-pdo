<?php
    class Products {
        // Db params
        private $conn;
        private $table = 'products';

        // Products Properties
        public $product_id;
        public $product_name;
        public $quantity;
        public $price;
        public $category_id;
        public $brand_id;

        public function __construct($db) {
            $this->conn = $db;
        }

        // Create product
        function create() 
        {
            // Insert Query
            $query = 'INSERT INTO '.$this->table.'
                        SET
                            product_name = :product_name,
                            quantity = :quantity,
                            price = :price,
                            category_id = :category_id,
                            brand_id = :brand_id';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->product_name = htmlspecialchars(strip_tags($this->product_name));
            $this->quantity = htmlspecialchars(strip_tags($this->quantity));
            $this->price = htmlspecialchars(strip_tags($this->price));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));
            $this->brand_id = htmlspecialchars(strip_tags($this->brand_id));

            // Bidn Data
            $stmt->bindParam(':product_name', $this->product_name);
            $stmt->bindParam(':quantity', $this->quantity);
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':category_id', $this->category_id);
            $stmt->bindParam(':brand_id', $this->brand_id);

            // Execute Query
            if($stmt->execute()) {
                return true;
            }

            // Print Error is something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;

        }

        // Get all products
        function read() {

             // Select Query
             $query = 'SELECT
                            p.product_id, 
                            p.product_name,
                            p.quantity,
                            p.price,
                            p.category_id,
                            p.brand_id,
                            c.category_id,
                            c.category_name,
                            b.brand_id,
                            b.brand_name
                         FROM '.$this->table.' as p
                         JOIN categories as c
                         ON p.category_id = c.category_id
                         JOIN brands as b
                         ON p.brand_id = b.brand_id ';
                
            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        // Get single product
        function readSingle() 
        {
             // Select Query
             $query = 'SELECT
                            p.product_id, 
                            p.product_name,
                            p.quantity,
                            p.price,
                            p.category_id,
                            p.brand_id,
                            c.category_id,
                            c.category_name,
                            b.brand_id,
                            b.brand_name
                        FROM '.$this->table.' as p
                        JOIN categories as c
                        ON p.category_id = c.category_id
                        JOIN brands as b
                        ON p.brand_id = b.brand_id
                        WHERE p.product_id = :product_id';
                
            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->product_id = htmlspecialchars(strip_tags($this->product_id));
            
            // Bidn Data
            $stmt->bindParam(':product_id', $this->product_id);

            // Execute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set Properties
            $this->product_id = $row['product_id'];
            $this->product_name = $row['product_name'];
            $this->quantity = $row['quantity'];
            $this->price = $row['price'];
            $this->category_id = $row['category_id'];
            $this->brand_id = $row['brand_id'];
        }

        // Update Specific Product
        function update() {
                
                // Update Query
                $query = 'UPDATE '.$this->table.'
                            SET
                                product_name = :product_name,
                                quantity = :quantity,
                                price = :price,
                                category_id = :category_id,
                                brand_id = :brand_id
                            WHERE
                                product_id = :product_id';

                // Prepare Statement
                $stmt = $this->conn->prepare($query);

                // Clean Data
                $this->product_id = htmlspecialchars(strip_tags($this->product_id));
                $this->product_name = htmlspecialchars(strip_tags($this->product_name));
                $this->quantity = htmlspecialchars(strip_tags($this->quantity));
                $this->price = htmlspecialchars(strip_tags($this->price));
                $this->category_id = htmlspecialchars(strip_tags($this->category_id));
                $this->brand_id = htmlspecialchars(strip_tags($this->brand_id));

                // Bidn Data
                $stmt->bindParam(':product_id', $this->product_id);
                $stmt->bindParam(':product_name', $this->product_name);
                $stmt->bindParam(':quantity', $this->quantity);
                $stmt->bindParam(':price', $this->price);
                $stmt->bindParam(':category_id', $this->category_id);
                $stmt->bindParam(':brand_id', $this->brand_id);

                // Execute Query
                if($stmt->execute()) {
                    return true;
                }

                // Print Error is something goes wrong
                printf("Error: %s.\n", $stmt->error);

                return false;
        }


        function updateQty($product_id, $quantity, $db) {
                $this->conn = $db;
                $this->product_id = $product_id;
                $this->quantity = $quantity - 1;

                $query = 'UPDATE '.$this->table.'
                            SET
                                quantity = :quantity,
                            WHERE
                                product_id = :product_id';
                
                $stmt = $this->conn->prepare($query);

                // Clean Data
                $this->product_id = htmlspecialchars(strip_tags($this->product_id));
                $this->quantity = htmlspecialchars(strip_tags($this->quantity));

                // Bidn Data
                $stmt->bindParam(':product_id', $this->product_id);
                $stmt->bindParam(':quantity', $this->quantity);

                // Execute Query
                if($stmt->execute()) {
                    return true;
                }

                // Print Error is something goes wrong
                printf("Error: %s.\n", $stmt->error);

                return false;
        }

        // Delete product
        function delete() 
        {
            // Delete Query
            $query = 'DELETE FROM '.$this->table.' WHERE product_id = :product_id'; 
            
            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->product_id = htmlspecialchars(strip_tags($this->product_id));
            
            // Bidn Data
            $stmt->bindParam(':product_id', $this->product_id);

            // Execute query
            if($stmt->execute()) {
                return true;
            }

            return false;
        }
    }
?>