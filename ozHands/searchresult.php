<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset=utf-8>
    <meta name=description content="">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <title>Search Results for...</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/ee654fe705.js" crossorigin="anonymous"></script>
    <style>

        .topnav {
            background-color: rgba(0, 13, 26, 0.2);
            position: fixed;
            top:0;
            left: 0;
            width: 100%;
            overflow: hidden;
            padding: 12px;
        }

        .topnav a {
            float: left;
            display: block;
            color: #fff;
            text-align: center;
            padding: 14px 16px;
            font-weight: bold;
            text-decoration: none;
            font-size: 17px;
        }

        .topnav h1{
            font-weight: 900;
            color: red;
            float: right;
            margin: 0 20px 0 0;
        }

        .hands{
            color: #c3c3c3;
        }

        .topnav a:hover {
            color: #800000;
        }

        .topnav a.active {
            background-color: #800000;
            color: white;
        }

        .topnav .icon {
            display: none;
        }

        .fa-bars{
            position: fixed;
        }

        @media screen and (max-width: 600px) {
            .topnav h1{display: none;}
            .topnav a:not(:first-child) {display: none;}
            .topnav a.icon {
                float: right;
                display: block;
            }

            .topnav{
                animation: 0.5s scroll-out;
            }

            @-webkit-keyframes scroll-out {
                from{height: 160px;}
                to{height: 60px;}
            }

            @-moz-keyframes scroll-out {
                from{height: 160px;}
                to{height: 60px;}
            }

            @keyframes scroll-out {
                from{height: 160px;}
                to{height: 60px;}
            }
        }

        @media screen and (max-width: 600px) {
            .topnav.responsive {
                position: fixed;
                top: 0;
                left: 0;
                animation: 0.5s scroll-in;
            }

            @-webkit-keyframes scroll-in {
                from{height: 100px;}
                to{height: 160px;}
            }

            @-moz-keyframes scroll-in {
                from{height: 100px;}
                to{height: 160px;}
            }

            @keyframes scroll-in {
                from{height: 100px;}
                to{height: 160px;}
            }

            .topnav.responsive a.icon {
                position: fixed;
                right: 0;
                top: 0;
            }

            .fa-bars{
                position: fixed;
                right: 15px;
            }
            .topnav.responsive a {
                float: none;
                display: block;
                text-align: left;

            }
        }

        #cart {
            width: 90%;
            padding: 20px 0;
        }
    .result{
        margin: 100px auto 20px auto;
        width: 60%;
    }

        #cart a {
            float: right;
        }

        .result{
            margin: 100px auto;
        }

        .chat-container{
            width:75%;
            margin: auto;
        }

        .chats{
            width: 75%;
            margin: 20px;
            border-bottom: 1px solid #000000;
            padding: 15px;
        }

        .chats a{
            text-decoration: none;
            font-weight: bold;
        }

        .chats:last-child{
            border-bottom: none;
        }

        .created{
            float: right;
            color: #800000;
        }

        .chats h3{
            color: #000d1a;
        }

        @media screen and (max-width: 800px){
            .chats{width: 90%;}
        }
    </style>
</head>
<body style="background-color: #c3c3c3;">
<div class="topnav" id="myTopnav">
    <a href="cart.php"><i class="fas fa-shopping-cart"></i></a>
    <a href="#contact">Contact</a>
    <a href="#about">About</a>
    <a href="login.php">Login</a>
    <a href="register.php">Register</a>
    <a href="javascript:void(0);" class="icon" id="toggler" onclick="myFunction()">
        <i class="fa fa-bars"></i>
    </a>

    <h1>oz<span class="hands" style="color: #000d1a">Hands</span></h1>
</div>

    <div class="result">
        <p>Search Results For '<?php echo $_GET["value"]; ?>'</p>
    </div>

    <?php
    require "connection.php";
    $buyer = "";
    $message = "";
    $query = $_GET["value"];
    $min_length = 3;

    if (strlen($query) >= $min_length) {
        $query = htmlspecialchars($query);
        $sql = "SELECT * FROM vendor_chats WHERE (`buyer` LIKE '%".$query."%') AND vendor = 'Lara Croft' ORDER BY created DESC";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            $message = "No results.";
        }

        ?>
        <span class="no-result"><p  style="text-align: center; font-size: 25px; margin-top: 70px;"><?php echo $message ?></p></span>

        <div class="chat-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $table = $row["table"];
                $wholesaler = $row["vendor"];
                $buyer = $row["buyer"];
                $created = $row["created"];

                $link = "chat.php?start_id=".$table."&wholesaler=".$wholesaler."&buyer=".$buyer;
                ?>

                <div class="chats">
                <h3>With <?php echo $buyer; ?></h3>
                <a href="<?php echo $link; ?>">View Chat</a>
                <div class="created">Started on <?php echo $created ?></div>
            </div>

        <?php
    }
    }
    }
    ?>
        </div>



</body>
</html>
