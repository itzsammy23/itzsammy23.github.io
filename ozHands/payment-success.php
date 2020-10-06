<?php
    session_start();
    require "connection.php";

require "random.php";

    $user = $_SESSION["retailer"];
    $order_id = $_SESSION["order_id"];




$orders = "SELECT vendor FROM orders WHERE order_id = '$order_id' AND inserted_once = false";
    $order_result = $conn->query($orders);

    if($order_result->num_rows > 0){
        while($order_row = $order_result->fetch_assoc()){
            $table = generateRandomString(6);
            $vendor = $order_row["vendor"];

            $sql = "CREATE TABLE `chat_$table` (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
message VARCHAR(30000000) NOT NULL,
`from` VARCHAR(3000) NOT NULL,
seller BIT NOT NULL,
`file` VARCHAR(500) NOT NULL,
`created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
`seller_last_seen` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
`buyer_last_seen` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
            $conn->query($sql);

            $insert = "INSERT INTO vendor_chats (`table`,`order_id`, `vendor`, `buyer`) VALUES ('$table', '$order_id', '$vendor', '$user')";
            $conn->query($insert);
        }
    }

?>

<html>
<head>
    <meta charset="utf-8">
    <title>Account successfully created</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/product.css">
    <script src="https://kit.fontawesome.com/ee654fe705.js" crossorigin="anonymous"></script>
</head>
<body style="background-color: #f2f2f2; font-family: Nunito;">
<div class="topnav" id="myTopnav">
    <a href="/cart"><i class="fas fa-shopping-cart"></i></a>
    <a href="#contact">Contact</a>
    <a href="#about">About</a>
    <a href="login.php">Login</a>
    <a href="register.php">Register</a>
    <a href="javascript:void(0);" class="icon" id="toggler" onclick="myFunction()">
        <i class="fa fa-bars"></i>
    </a>

    <h1>oz<span class="hands" style="color: #003366;">Hands</span></h1>
</div>


<div id="loaded-content" style="margin: 200px auto; padding-top: 20px;  text-align: center;">
    <div id="loader"></div>

    <div class="further-content" id="further-views">
        <i class="fas fa-check-circle" style="font-size: 65px; color: #003366;"></i>
        <p style="font-size: 18px">Your payment was successful.</p>

        <?php
            $select = "SELECT * FROM vendor_chats WHERE order_id = '$order_id'";
            $select_query = $conn->query($select);

            if($select_query->num_rows > 0){
                while ($select_row = $select_query->fetch_assoc()){
                    $wholesaler = $select_row["vendor"];
                    $buyer = $select_row["buyer"];
                    $table = $select_row["table"];
                    $link = "chat.php?start_id=".$table."&wholesaler=".$wholesaler."&buyer=".$buyer;
        ?>
                    <div style="text-align: center;">
                        <h4>Chat with <?php echo $wholesaler ?></h4>
                        <div align="center"><a href="<?php echo $link; ?>">Chat with wholesaler</a></div>
                    </div>
        <?php

                }
            }
        ?>
    </div>
</div>

<script>
    var loadedContent = document.getElementById("loaded-content");

    function showPage() {
        document.getElementById("loader").style.display = "none";
        document.getElementById("further-views").style.display = "block";

    }

    window.onload = function(){
        loadedContent.style.display = "block";
        setTimeout(showPage, 1500);
    };
</script>
</body>
</html>
