<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate DB and connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$category = new Category($db);



// Get ID
$category->id = isset($_GET['id']) ? $_GET['id'] : die();

// Read single record
$result = $category->read_single();

$row = $result->fetch(PDO::FETCH_ASSOC);

// Get row count
$num = $result->rowCount();

if ($num > 0) {
    // Set props
    $category->id = $row['id'];
    $category->name = $row['name'];
    $category->created_at = $row['created_at'];



    // Create array
    $category_arr = array(
        'id' => $category->id,
        'name' => $category->name,
        'created_at' => $category->created_at
    );

    // Make JSON
    print_r(json_encode($category_arr));
} else {
    // No Categories
    echo json_encode(
        array('message' => 'No categories found')
    );
}
