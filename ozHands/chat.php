<?php
    session_start();
        $retailer = $_SESSION["retailer"];
    if ($retailer == null && $retailer != "override"){
        header("Location: login.php");
    }

    $str = $_GET["wholesaler"];
    $table = $_GET["start_id"];

    $wholesaler = str_replace("-", " ", $str);
    $another_str = $_GET["buyer"];
    $buyer = str_replace("-", " ", $another_str);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/chat.css">
    <title>Message Board of <?php echo $wholesaler; ?> and <?php echo $buyer; ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/ee654fe705.js" crossorigin="anonymous"></script>
</head>
<body>
<?php
    if ($_SESSION["retailer"] != null && $_SESSION["retailer"] != "override") {
        $sender = $_SESSION["retailer"];
    }

    if ($_SESSION["seller"] != null) {
        $sender = $_SESSION["seller"];
    }


?>

<div class="sidebar">
   <img src="https://www.ozhands.com.au/wp-content/uploads/2020/03/logo.png" class="logo">

    <h3>PEOPLE</h3>

    <div class="user">
        <div class="name" id="wholesaler"><?php echo $wholesaler; ?> <span class="indicator" id="seller-indicator"></span></div>
        <div id="seller-presence" class="presence"></div>
    </div>

    <div class="user">
        <div class="name" id="buyer"><?php echo $buyer; ?> <span class="indicator" id="buyer-indicator"></span></div>
        <div id="buyer-presence" class="presence"></div>
    </div>

    <div class="back-to-shop" align="center">
        <a href="#">Back to shop</a>
    </div>

</div>

<?php
    require "connection.php";

    $order_id = $_SESSION["order_id"];
    $sql = "SELECT `order` FROM orders WHERE order_id = '$order_id' AND vendor = '$wholesaler'";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()){
        $order = $row["order"];
?>
<div id="order" style="display: none;">Hello I want to purchase <?php echo $order;?></div>
<?php
    }
?>
<div id="sender" style="display: none;"><?php echo $sender?></div>
<div id="table" style="display: none;"><?php echo $table;?></div>
<div class="chat">
    <div id="messages">

    </div>

    <form>
        <input type="file" name="file" id="file" class="inputfile">
        <label for="file"><i class="fas fa-paperclip"></i></label>
        <input type="text" name="message" id="message" autocomplete="off" autofocus placeholder="Type a message...">
        <button type="submit" class="send">Send</button>
    </form>

</div>
</div>

<script src="/js/ajaxchat.js"></script>
</body>
</html>
