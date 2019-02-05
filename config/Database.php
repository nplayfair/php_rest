<?php
    class Database {
        //Database params
        private $host = 'localhost';
        private $db_name = 'php_rest';
        private $username = 'nick';
        private $password = 'GdJzUiY15xym';
        private $conn;

        // DB Connect
        public function connect() {
            $this->conn = null;

            try {
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name,
                $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo 'Connection Error: ' . $e->getMessage();
            }

            return $this->conn;
        }

    }