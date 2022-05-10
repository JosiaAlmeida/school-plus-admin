<?php
    class Database{
        private $host = "localhost";
        private $db_name = "escola";
        private $username="root";
        private $pass = "root";
        private $conn;

        public function connect(){
            $this->conn = null;
            try {
                $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name,
                $this->username, $this->pass);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $PE) {
                echo "Connection Error:" .$PE->getMessage();
            }
            return $this->conn;
        }
    }
?>