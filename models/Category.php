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

        // Get single category
        public function read_single() {
            // Create query
            $query = 'SELECT id, name, created_at
                FROM ' . $this->table . 
                ' WHERE id = ? LIMIT 0,1';
            
            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind ID
            $stmt->bindParam(1, $this->id);

            // Execute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties
            $this->name = $row['name'];
            $this->created_at = $row['created_at'];
        }

    }