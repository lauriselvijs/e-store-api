<?php

class Product
{

    // DB conn
    private $conn;
    private $table = 'products';

    // Props
    public $id;
    public $category_id;
    public $category_name;
    public $name;
    public $price;
    public $quantity;
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
            c.name as category_name,
            p.id,
            p.category_id,
            p.name,
            p.price,
            p.quantity,
            p.created_at
            FROM 
            ' . $this->table . ' p
            LEFT JOIN 
            categories c ON p.category_id = c.id
            ORDER BY
                p.created_at DESC';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }


    // Get single product
    public function read_single()
    {
        // Create query
        $query = 'SELECT 
            c.name as category_name,
            p.id,
            p.category_id,
            p.name,
            p.price,
            p.quantity,
            p.created_at
         FROM 
         ' . $this->table . ' p
         LEFT JOIN 
            categories c ON p.category_id = c.id
         WHERE 
            p.id = ?
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
            name = :name,
            price = :price,
            quantity = :quantity,
            category_id = :category_id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        // Bind data
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':quantity', $this->quantity);
        $stmt->bindParam(':category_id', $this->category_id);



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
            price = :price,
            quantity = :quantity,
            category_id = :category_id
        WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':quantity', $this->quantity);
        $stmt->bindParam(':category_id', $this->category_id);
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
