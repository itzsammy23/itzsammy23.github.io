<?php
session_start();

require 'connection.php';

$order_id = $_SESSION["order_id"];

$id = $_POST["cart_id"];

    $delete = "DELETE FROM cart WHERE id='$id' AND order_id = '$order_id'";
    if ($conn->query($delete) == true){
        echo "Deleted";
    }else{
        echo $conn->error;
    }


$conn->close();