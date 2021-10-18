<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Product.php';

// Instantiate DB and connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$product = new Product($db);



// Get ID
$product->id = isset($_GET['id']) ? $_GET['id'] : die();

// Read single record
$result = $product->read_single();

$row = $result->fetch(PDO::FETCH_ASSOC);

// Get row count
$num = $result->rowCount();

if ($num > 0) {
    // Set props
    $product->name = $row['name'];
    $product->price = $row['price'];
    $product->quantity = $row['quantity'];
    $product->category_id = $row['category_id'];
    $product->category_name = $row['category_name'];
    $product->created_at = $row['created_at'];


    // Create array
    $product_arr = array(
        'id' => $product->id,
        'name' => $product->name,
        'price' => $product->price,
        'quantity' => $product->quantity,
        'category_id' => $product->category_id,
        'category_name' => $product->category_name,
        'created_at' => $product->created_at
    );

    // Make JSON
    print_r(json_encode($product_arr));
} else {
    // No Products
    echo json_encode(
        array('message' => 'No product found')
    );
}
