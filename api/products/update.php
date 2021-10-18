<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Product.php';

// Instantiate DB and connect
$database = new Database();
$db = $database->connect();

// Instantiate product object
$category = new Product($db);

// Get raw product data
$data = json_decode(file_get_contents('php://input'));

// Set ID to update
$products->id = $data->id;

$products->name = $data->name;
$products->price = $data->price;
$products->quantity = $data->quantity;
$products->category_id = $data->category_id;

// Update product
if ($products->update()) {
    echo json_encode(
        array('message' => 'Product Updated')
    );
} else {
    echo json_encode(
        array('message' => 'Product Not Updated')
    );
}
