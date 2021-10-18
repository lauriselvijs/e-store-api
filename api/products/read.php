<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Product.php';

// Instantiate DB and connect
$database = new Database();
$db = $database->connect();

// Instantiate product object
$product = new Product($db);

// Product query
$result = $product->read();

// Get row count
$num = $result->rowCount();

// Check if any products
if ($num > 0) {
    // Product array
    $products_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $product_item = array(
            'id' => $id,
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity,
            'category_id' => $category_id,
            'category_name' => $category_name,
            'created_at' => $created_at

        );

        // Push to 'data'
        array_push($products_arr['data'], $product_item);
    }

    // Turn to JSON and output
    echo json_encode($products_arr);
} else {
    // No Products
    echo json_encode(
        array('message' => 'No product found')
    );
}
