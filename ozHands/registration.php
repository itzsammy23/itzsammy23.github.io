<?php
/* Template Name: Board Messages */

session_start();

$table = $_SESSION["table_id"];

$host = "localhost";
$username = "latefaisal_ei10";
$password = "t30tcrc2";
$dbname = "latefaisal_ei10";

$conn = new mysqli($host, $username, $password, $dbname);

if ($_SESSION["retailer"] != null) {
    $sender = $_SESSION["retailer"];
    $seller = false;
}

if ($_SESSION["seller"] != null) {
    $sender = $_SESSION["seller"];
    $seller = true;
}

foreach($_FILES as $key) {
    $name = time().$key['name'];

    $path = 'files/'.$name;

    move_uploaded_file($key["tmp_name"], $path);
    $upload = "INSERT INTO `chat_$table` (`from`, `file`, `seller`) VALUES ('$sender', '$name', '$seller')";
    $conn->query($upload);

}

$result = array();
$message =isset($_POST["message"]) ? $_POST["message"] : null;
$from =isset($_POST["from"]) ? $_POST["from"] : null;

date_default_timezone_set("Australia/Adelaide");
$date = date("Y-m-d h:i:s");

$seller_row = "SELECT seller_last_seen FROM `chat_$table` WHERE seller = '1' ORDER BY id DESC LIMIT 1";
$buyer_row = "SELECT buyer_last_seen FROM `chat_$table` WHERE seller = '0' ORDER BY id DESC LIMIT 1";



if (!empty($message) && !empty($from)) {
    if($seller == true){
        $sql = "INSERT INTO `chat_$table` (`message`, `from`, `seller`, `seller_last_seen`) VALUES ('$message', '$from', '$seller', '$date')";

    }else{
        $sql = "INSERT INTO `chat_$table` (`message`, `from`, `seller`, `buyer_last_seen`) VALUES ('$message', '$from', '$seller', '$date')";

    }
    $result["send_status"] = $conn->query($sql);
}

$start = isset($_GET["start"]) ? intval($_GET["start"]) : 0;
$chat = $conn->query( "SELECT * FROM `chat_$table` WHERE `id` > " .$start);
while($row = $chat->fetch_assoc()) {
    $result['items'][] = $row;
}

$conn->close();

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


echo json_encode($result);