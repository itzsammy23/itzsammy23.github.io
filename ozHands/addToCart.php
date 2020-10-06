<?php
session_start();

$host = "localhost";
$username = "root";
$password = "sam987412admin10";
$dbname = "products";

$conn = new mysqli($host, $username, $password, $dbname);

$name = $_POST["product_name"];
$vendor = $_POST["vendor"];
$image = $_POST["product_image"];
$desc = $_POST["product_desc"];
$price = $_POST["product_price"];
$quantity = $_POST["quantity"];


require "random.php";

if($_SESSION["order_id"] == null) {
    $_SESSION["order_id"] = generateRandomString(6);
}

$order_id = $_SESSION["order_id"];

$check = "SELECT * FROM cart WHERE order_id = '$order_id' AND seller_name = '$vendor'";
$check_result = $conn->query($check);

if ($check_result->num_rows > 0){
    cart_add($order_id, $name, $vendor, $image, $price, $quantity, 0.00, true);
}else{
    cart_add($order_id, $name, $vendor, $image, $price, $quantity, 2.00, false);
}



function cart_add($order_id, $name, $vendor, $image, $price, $quantity, $cost, $inserted_once)  {
    $host = "localhost";
    $username = "root";
    $password = "sam987412admin10";
    $dbname = "products";

    $conn = new mysqli($host, $username, $password, $dbname);

    $sql = "INSERT INTO cart (`order_id`, `name`, `seller_name`, `image`, `price`, `quantity`, `enquiry_cost`) VALUES 
('$order_id', '$name', '$vendor', '$image', '$price', '$quantity', '$cost')";
    $conn->query($sql);
    $order = $quantity . " units of " . $name;
    $order_query = "INSERT INTO orders (`order_id`, `vendor`, `order`, `inserted_once`) VALUES ('$order_id', '$vendor', '$order', '$inserted_once')";
    $conn->query($order_query);
}




