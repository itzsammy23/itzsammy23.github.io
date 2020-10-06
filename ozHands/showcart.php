<?php
session_start();

require 'connection.php';

$order_id = $_SESSION["order_id"];

if (isset($_POST["id"])){
    $id = $_POST["id"];

    $delete = "DELETE * FROM cart WHERE id='$id' AND order_id = '$order_id'";
    $conn->query($delete);
}


$sql = "SELECT * FROM cart WHERE order_id = '$order_id'";

$result = $conn->query($sql);

$items = array();
$response = array();
$total_price = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
       $response['items'][] = $row;
    }
}

$select = "SELECT enquiry_cost FROM cart WHERE order_id = '$order_id'";
$check = $conn->query($select);

while ($output = $check->fetch_assoc()){
    foreach ($output as $x => $x_value) {
        $total_price = $total_price + $x_value;
    }

    $response['total_price'] = $total_price;
}


$conn->close();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

echo json_encode($response);
