<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate DB and connect
$database = new Database();
$db = $database->connect();

// Instantiate category object
$category = new Category($db);

// Category query
$result = $category->read();

// Get row count
$num = $result->rowCount();

// Check if any categories
if ($num > 0) {
    // Product array
    $category_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $category = array(
            'id' => $id,
            'name' => $name,
            'created_at' => $created_at,
        );



        // Push to 'data'
        array_push($category_arr['data'], $category);
    }

    // Turn to JSON and output
    echo json_encode($category_arr);
} else {
    // No Categories
    echo json_encode(
        array('message' => 'No category found')
    );
}
