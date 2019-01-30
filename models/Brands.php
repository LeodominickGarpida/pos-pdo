<?php

    class Brands {
        // Db params
        private $conn;
        private $table = 'brands';

        // Brands Properties
        public $brand_id;
        public $brand_name;
        public $created_at;
        public $updated_at;

        public function __construct($db) {
            $this->conn = $db;
        }

        // Create brand
        function create() 
        {   
            // Insert Query         
            $query = 'INSERT INTO '.$this->table.'
                        SET
                            brand_name = :brand_name,
                            created_at = :created_at';
            
            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->brand_name = htmlspecialchars(strip_tags($this->brand_name));
            
            // Bidn Data
            $stmt->bindParam(':brand_name', $this->brand_name);
            $stmt->bindParam(':created_at', $this->created_at);

            // Execute Query
            if($stmt->execute()) {
                return true;
            }
            
            // Print Error is something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        // Get all brands
        function read() 
        {
             // Select Query
             $query = 'SELECT * FROM '.$this->table.' WHERE status = 1';
                
            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        // Get Single Brand
        function readSingle()
        {
            // Select Query
            $query = 'SELECT * FROM '.$this->table.' WHERE brand_id = :brand_id';
                
            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->brand_id = htmlspecialchars(strip_tags($this->brand_id));
            
            // Bidn Data
            $stmt->bindParam(':brand_id', $this->brand_id);

            // Execute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set Properties
            $this->brand_id = $row['brand_id'];
            $this->brand_name = $row['brand_name'];
        }

        // Update Brand
        function update() 
        {
            // Update Query
            $query = 'UPDATE '.$this->table.'
                        SET
                            brand_name = :brand_name,
                            updated_at = :updated_at
                        WHERE
                            brand_id = :brand_id';
            
            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->brand_id = htmlspecialchars(strip_tags($this->brand_id));
            $this->brand_name = htmlspecialchars(strip_tags($this->brand_name));
            
            // Bidn Data
            $stmt->bindParam(':brand_id', $this->brand_id);
            $stmt->bindParam(':brand_name', $this->brand_name);
            $stmt->bindParam(':updated_at', $this->updated_at);

            // Execute Query
            if($stmt->execute()) {
                return true;
            }
            
            // Print Error is something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        // Delete Brand
        function delete() 
        {
            // Delete Query
            $query = 'DELETE FROM '.$this->table.' WHERE brand_id = :brand_id';
            
            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->brand_id = htmlspecialchars(strip_tags($this->brand_id));
            
            // Bidn Data
            $stmt->bindParam(':brand_id', $this->brand_id);
            
            $stmt->execute();

            // -------------------------------------------

            $query1 = 'DELETE FROM '.$this->table.' WHERE brand_id = :brand_id ';
            
            // Prepare Statement
            $stmt1 = $this->conn->prepare($query);

            // Clean Data
            // $this->brand_id = htmlspecialchars(strip_tags($this->brand_id));
            
            // Bidn Data
            $stmt1->bindParam(':brand_id', $this->brand_id);
            
            $stmt1->execute();
            

            // Execute Query
            if($stmt1->execute()) {
                return true;
            }
            
            // Print Error is something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;            
        }
    }
?>