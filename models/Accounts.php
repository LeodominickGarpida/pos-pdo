<?php
    class Accounts {
        // Db params
        private $conn;
        private $table = 'accounts';

        // Accounts Properties
        public $id;
        public $name;
        public $username;
        public $password;
        public $type;
        public $passwordAttempt;

        public function __construct($db) {
            $this->conn = $db;
        }

        // Create Category
        function create()
        {      
            // Inser Query
            $query = 'INSERT INTO '.$this->table.'
                        SET
                            name = :name,
                            username = :username,
                            password = :password,
                            type = :type';
            
            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->username = htmlspecialchars(strip_tags($this->username));
            $this->password = htmlspecialchars(strip_tags($this->password));
            $this->type = htmlspecialchars(strip_tags($this->type));
            
            // Bidn Data
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':password', $this->password);
            $stmt->bindParam(':type', $this->type);

            // Execute Query
            if($stmt->execute()) {
                return true;
            }
            
            // Print Error is something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        // chech if the user exist
        function resolve_login() 
        {

            $query = 'SELECT * FROM accounts WHERE username = :username';

            $stmt = $this->conn->prepare($query);
           
            $stmt->bindParam(':username', $this->username);

            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->id = $user['id'];
            $this->name = $user['name'];
            $this->type = $user['type'];
            $this->username = $user['username'];

            if($user === false) {
                return false;
            }

            if(password_verify($this->passwordAttempt, $user['password'])) {
                return true;
            }
            else {
                echo 'error';   
            }
            // return true;
            // echo $validPassword;
        }

        // get all accounts
        function read() 
        {
            // Select Query
            $query = 'SELECT * FROM '.$this->table.' ';
               
           // Prepare Statement
           $stmt = $this->conn->prepare($query);

           // Execute query
           $stmt->execute();

           return $stmt;
        }

        // Get single account 
        function readSingle($id, $db) 
        {
            $this->id = $id;
            $this->conn = $db;

            // Select Query
            $query = 'SELECT * FROM '.$this->table.' WHERE id = :id';
               
           // Prepare Statement
           $stmt = $this->conn->prepare($query);

           $stmt->bindParam(':id', $this->id);

           // Execute query
           $stmt->execute();
            
           return $stmt;
            
        }

        // for edit account filename = readSingle.php
        function readSingle2() 
        {
            // Select Query
            $query = 'SELECT * FROM '.$this->table.' WHERE id = :id';
               
           // Prepare Statement
           $stmt = $this->conn->prepare($query);

           $stmt->bindParam(':id', $this->id);

           // Execute query
           $stmt->execute();
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set Properties
            $this->name = $row['name'];
            $this->username = $row['username'];
            $this->type = $row['type'];
        }

        function update() 
        {
            // update query
            $query = 'UPDATE '.$this->table.'
                        SET
                            name = :name,
                            username = :username,
                            type = :type,
                            updated_at = :updated_at
                        WHERE
                            id = :id';
            
            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->username = htmlspecialchars(strip_tags($this->username));
            $this->type = htmlspecialchars(strip_tags($this->type));
            
            // Bidn Data
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':type', $this->type);
            $stmt->bindParam(':updated_at', $this->updated_at);

            // Execute Query
            if($stmt->execute()) {
                return true;
            }
            
            // Print Error is something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        function updateOwn($id, $name, $new_username, $passwordHash, $db) {
           
             $this->id = $id;
             $this->name = $name;
             $this->new_username = $new_username;
             $this->passwordHash = $passwordHash;
             $this->conn = $db;

            $query = 'UPDATE '.$this->table.'
                        SET
                            name = :name,
                            username = :new_username,
                            password = :passwordHash
                        WHERE
                            id = :id';
            
            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->new_username = htmlspecialchars(strip_tags($this->new_username));
            $this->passwordHash = htmlspecialchars(strip_tags($this->passwordHash));
            
            // Bidn Data
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':new_username', $this->new_username);
            $stmt->bindParam(':passwordHash', $this->passwordHash);
            
            if($stmt->execute())
            {
                return true;
            }

            return false;
        }

        // Remove/Delete Account
        function remove() 
        {
            // Delete Query
            $query = 'DELETE FROM '.$this->table.' WHERE id = :id';
               
           // Prepare Statement
           $stmt = $this->conn->prepare($query);

           $stmt->bindParam(':id', $this->id);

           // Execute query
           $stmt->execute();

           return $stmt;
        }
    }
?>