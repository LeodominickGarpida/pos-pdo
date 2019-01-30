<?php
    class Database {
        // Database Parameters
        private $host = 'localhost';
        private $username = 'root';
        private $password = '';
        private $db_name = 'pos';
        private $conn;

        function connect() {
            $this->conn = null;

            try {
                $this->conn = new PDO('mysql:host='. $this->host . ';dbname='. $this->db_name,
                $this->username, $this->password);

                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }   
            catch (PDOException $e) {
                echo 'Connection Error: ', $e->getMessage();
            }
            
            return $this->conn;
        }
    }

?>