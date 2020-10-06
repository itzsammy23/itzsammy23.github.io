<?php
/* Template Name: Board Messages */

session_start();

require "connection.php";

if ($_SESSION["retailer"] != null) {
    $sender = $_SESSION["retailer"];
    $seller = false;
}

if ($_SESSION["seller"] != null) {
    $sender = $_SESSION["seller"];
    $seller = true;
}



$result = array();
$message =isset($_POST["message"]) ? $_POST["message"] : null;
$from =isset($_POST["from"]) ? $_POST["from"] : null;
$wholesaler =isset($_POST["wholesaler"]) ? $_POST["wholesaler"] : null;
$buyer =isset($_POST["buyer"]) ? $_POST["buyer"] : null;
$table =isset($_POST["table"]) ? $_POST["table"] : null;

foreach($_FILES as $key) {
    $name = time().$key['name'];

    $path = 'files/'.$name;

    move_uploaded_file($key["tmp_name"], $path);
    $upload = "INSERT INTO `chat_$table` (`from`, `file`, `seller`) VALUES ('$sender', '$name', '$seller')";
    $conn->query($upload);

}

date_default_timezone_set("Australia/Adelaide");
$date = date("Y-m-d h:i:s");


if (!empty($message) && !empty($from)) {
    if($seller == true){
        $sql = "INSERT INTO `chat_$table` (`message`, `from`, `seller`, `seller_last_seen`) VALUES ('$message', '$from', '$seller', '$date')";

    }else{
        $sql = "INSERT INTO `chat_$table` (`message`, `from`, `seller`, `buyer_last_seen`) VALUES ('$message', '$from', '$seller', '$date')";

    }
    $result["send_status"] = $conn->query($sql);
}

$start = isset($_GET["start"]) ? intval($_GET["start"]) : 0;
$tableID = isset($_GET["table"]) ?  $_GET["table"] : null;
if (!empty($tableID)){
    $chat = $conn->query( "SELECT * FROM `chat_$tableID` WHERE `id` > " .$start);
    while($row = $chat->fetch_assoc()) {
        $result['items'][] = $row;
    }

    $seller_row = "SELECT seller_last_seen FROM `chat_$tableID` WHERE seller = '1' ORDER BY id DESC LIMIT 1";
    $buyer_row = "SELECT buyer_last_seen FROM `chat_$tableID` WHERE seller = '0' ORDER BY id DESC LIMIT 1";

    $answer = $conn->query($seller_row);
    if ($answer->num_rows > 0){
        while($answer_row = $answer->fetch_assoc()){
            $seller_time = $answer_row["seller_last_seen"];
        }
    }else{
        $seller_time = $date;
    }

    $display = $conn->query($buyer_row);
    while($display_row = $display->fetch_assoc()){
        $buyer_time = $display_row["buyer_last_seen"];
    }

    $seller_date_time = new DateTime($seller_time);
    $current_time = new DateTime($date);
    $time_diff = $current_time->diff($seller_date_time);
    $buyer_date_time = new DateTime($buyer_time);
    $interval = $current_time->diff($buyer_date_time);
    $seller_last_seen = $time_diff->i;
    $buyer_last_seen = $interval->i;

    $result['seller_time'] = $seller_last_seen;
    $result['buyer_time'] = $buyer_last_seen;

}


$conn->close();

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


echo json_encode($result);