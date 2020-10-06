<?php
/* Template Name: Wholesale Cart */


session_start();

$host = "localhost";
$username = "latefaisal_ei10";
$password = "t30tcrc2";
$dbname = "latefaisal_ei10";

$conn = new mysqli($host, $username, $password, $dbname);

$name = $_POST["product_name"];
$image = $_POST["product_image"];
$desc = $_POST["product_desc"];
$price = $_POST["product_price"];
$quantity = $_POST["quantity"];
$cost = $price * $quantity;


function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if ($_SESSION["order_id"] == null) {
    $_SESSION["order_id"] = generateRandomString(6);
}

$order_id = $_SESSION["order_id"];

$sql = "INSERT INTO cart (`order_id`, `name`, `image`, `price`, `quantity`, `cost`) VALUES ('$order_id', '$name', '$image', '$price', '$quantity', '$cost')";
if ($conn->query($sql) == true) {
    echo "Created";
} else {
    echo $conn->error;
}



