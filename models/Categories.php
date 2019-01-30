<?php
    class Categories {
        // Db params
        private $conn;
        private $table = 'categories';

        // Categories Properties
        public $category_id;
        public $category_name;
        public $created_at;
        public $updated_at;

        public function __construct($db) {
            $this->conn = $db;
        }

        // Create Category
        function create()
        {   
            $query = 'INSERT INTO '.$this->table.'
                        SET
                            category_name = :category_name,
                            created_at = :created_at';
            
            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->category_name = htmlspecialchars(strip_tags($this->category_name));
            
            // Bidn Data
            $stmt->bindParam(':category_name', $this->category_name);
            $stmt->bindParam(':created_at', $this->created_at);

            // Execute Query
            if($stmt->execute()) {
                return true;
            }
            
            // Print Error is something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        // Get all Categories
        function read() {
            // $this->conn = $db;

             // Select Query
             $query = 'SELECT * FROM '.$this->table.' WHERE status = 1';
                
            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        function readSingle() {

             // Select Query
             $query = 'SELECT * FROM '.$this->table.' WHERE category_id = :category_id';
                
            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));
            
            // Bidn Data
            $stmt->bindParam(':category_id', $this->category_id);

            // Execute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set Properties
            $this->category_id = $row['category_id'];
            $this->category_name = $row['category_name'];
            
        }

        // update specific category
        function update()
        {   
            $query = 'UPDATE '.$this->table.'
                        SET
                            category_name = :category_name,
                            updated_at = :updated_at
                        WHERE
                            category_id = :category_id';
            
            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));
            $this->category_name = htmlspecialchars(strip_tags($this->category_name));
            
            // Bidn Data
            $stmt->bindParam(':category_id', $this->category_id);
            $stmt->bindParam(':category_name', $this->category_name);
            $stmt->bindParam(':updated_at', $this->updated_at);

            // Execute Query
            if($stmt->execute()) {
                return true;
            }
            
            // Print Error is something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        // remove single record
        function delete() 
        {
            // Delete Query
            $query = 'DELETE FROM '.$this->table.' WHERE category_id = :category_id'; 
            
            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));
            
            // Bidn Data
            $stmt->bindParam(':category_id', $this->category_id);

            // Execute query
            $stmt->execute();
            
            // -------------------------------------------
            $query1 = 'DELETE FROM products WHERE category_id = :category_id ';
            
            // Prepare Statement
            $stmt1 = $this->conn->prepare($query);

            // Clean Data
            // $this->brand_id = htmlspecialchars(strip_tags($this->brand_id));
            
            // Bidn Data
            $stmt1->bindParam(':category_id', $this->category_id);
            
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