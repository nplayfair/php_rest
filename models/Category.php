<?php 
    class Category {
        // Database actions
        private $conn;
        private $table = 'categories';

        // Post properties
        public $id;
        public $name;
        public $created_at;

        // Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get categories
        public function read() {
            // Create query
            $query = 'SELECT id, name, created_at
                FROM ' . $this->table . 
                ' ORDER BY created_at desc';
            
            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

    }