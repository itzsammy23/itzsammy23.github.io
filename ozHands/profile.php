<?php
session_start();

/*if ($_SESSION["vendor_logged_in"] == false || $_SESSION["vendor_logged_in"] == null){
    header("Location: login.php");
}*/
?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chats</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/product.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/ee654fe705.js" crossorigin="anonymous"></script>
    <style>
        .search-container {
            margin: 100px auto 20px auto;
            display: flex;
            width: 35%;
        }

        input[type=text] {
            padding: 10px;
            margin-top: 8px;
            font-size: 17px;
            border: none;
            border-radius: 15px;
            margin-left: 5px;
        }

        #search:hover {
            border: 1px solid #c3c3c3;
        }

        .search-container button{
            padding: 8px;
            font-size: 15px;
            border: 1px solid #c3c3c3;
            background-color: #000d1a;
            color: #c3c3c3;
            font-weight: bold;
            border-radius: 5px;
        }

        .fa-shopping-cart, .fa-bars{
            color: #fff;
            font-size: 30px;
            margin-right: 15px;
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
            .search-container {width: 75%;}
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

<div class="search-container">
    <form action="searchresult.php" method="GET">
        <input type="text" placeholder="Search chats.." name="value" id="search">
        <button type="submit" name="submit">Search</button>
    </form>
</div>

    <div class="chat-container">
        <h2>Chats</h2>
        <?php
        require "connection.php";
        $sql = "SELECT * FROM vendor_chats WHERE vendor = 'Lara Croft' ORDER BY created DESC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $table = $row["table"];
                $wholesaler = $row["vendor"];
                $buyer = $row["buyer"];
                $created = $row["created"];

                $link = "chat.php?start_id=" . $table . "&wholesaler=" . $wholesaler . "&buyer=" . $buyer;
                ?>
                <div class="chats">
                    <h3>With <?php echo $buyer; ?></h3>
                    <a href="<?php echo $link; ?>">View Chat</a>
                    <div class="created">Started on <?php echo $created ?></div>
                </div>
                <?php
            }
        }
        ?>
    </div>

    <script src="/js/toggler.js"></script>
</body>
</html>
