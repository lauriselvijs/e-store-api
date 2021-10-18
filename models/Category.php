<?php

class Category
{

    // DB conn
    private $conn;
    private $table = 'categories';

    // Props
    public $id;
    public $name;
    public $created_at;

    // Constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get Products
    public function read()
    {
        // Create query
        $query = 'SELECT 
            c.id,
            c.name,
            c.created_at
            FROM 
            ' . $this->table . ' c
            ORDER BY
                c.created_at DESC';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }


    // Get single category
    public function read_single()
    {
        // Create query
        $query = 'SELECT 
            c.id,
            c.name,
            c.created_at
         FROM 
         ' . $this->table . ' c
         WHERE 
            c.id = ?
        LIMIT 0,1';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->id);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Create Product
    public function create()
    {
        // Create query
        $query = 'INSERT INTO ' . $this->table . '
        SET
            name = :name';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->name = htmlspecialchars(strip_tags($this->name));

        // Bind data
        $stmt->bindParam(':name', $this->name);

        if ($stmt->execute()) {
            return true;
        };

        // Print error if something goes wrong
        printf('Error: %s.\n', $stmt->error);

        return false;
    }

    // Update Product
    public function update()
    {
        // Create query
        $query = 'UPDATE ' . $this->table . '
        SET
            name = :name,
        WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->name = htmlspecialchars(strip_tags($this->name));

        // Bind data
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':id', $this->id);



        if ($stmt->execute()) {
            return true;
        };

        // Print error if something goes wrong
        printf('Error: %s.\n', $stmt->error);

        return false;
    }

    // Delete Product
    public function delete()
    {
        // Create query
        $query = "DELETE FROM " . $this->table . ' WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        };

        // Print error if something goes wrong
        printf('Error: %s.\n', $stmt->error);

        return false;
    }
}
