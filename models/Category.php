<?php 
    class Category {
        // Database actions
        private $conn;
        private $table = 'categories';

        // Category properties
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
        // Create Category
        public function create() {
            // Create query
            $query = 'INSERT INTO ' . $this->table . '
                SET name = :name,
                    created_at = :created_at';
            
            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean up data
            $this->name = htmlspecialchars(strip_tags($this->name));;
            $this->created_at = htmlspecialchars(strip_tags($this->created_at));

            // Bind data
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':created_at', $this->created_at);

            // Run query
            if ($stmt->execute()) {
                return true;
            } else {
                // Print error if failure
                printf("Error: %s.\n", $stmt->error);
                return false;
            }

        }

        // Update category
        public function update() {
            // Create query
            $query = 'UPDATE ' . $this->table . '
                SET name = :name,
                    created_at = :created_at
                WHERE id = :id';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->created_at = htmlspecialchars(strip_tags($this->created_at));
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind data

            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':created_at', $this->created_at);
            $stmt->bindParam(':id', $this->id);

            // Run query
            if ($stmt->execute()) {
                return true;
            } else {
                // Print error if failure
                printf("Error: %s.\n", $stmt->error);
                return false;
            }

        }

    }