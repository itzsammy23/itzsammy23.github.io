<?php
    session_start();
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/product.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/ee654fe705.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="topnav" id="myTopnav">
    <a href="cart.php"><i class="fas fa-shopping-cart"></i></a>
    <a href="#contact">Contact</a>
    <a href="#about">About</a>
    <?php
        if ($_SESSION["logged_in"] == false) {
            ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
            <?php
        }else {
            ?>
            <a href="#">Home</a>
            <?php
        }
    ?>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
    </a>

    <h1>oz<span class="hands">Hands</span></h1>
</div>

<div id="hidden" style="display: none;"><?php echo $_SESSION["logged_in"]; ?></div>

<div class="container" id="container">

</div>

<div id="no-items" align="center"></div>

<div id="billed"></div>
<div class="check-out" align="center">
    <form class="paypal" action="payments.php" method="post" id="paypal_form">
        <input type="hidden" name="cmd" value="_xclick" />
        <input type="hidden" name="no_note" value="1" />
        <input type="hidden" name="lc" value="UK" />
        <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
        <input type="hidden" name="first_name" value="John" />
        <input type="hidden" name="last_name" value="Doe" />
        <input type="hidden" name="item_name" value="Wholesale Order" />
        <input type="hidden" name="amount" id="amount" value="" />
        <input type="hidden" name="payer_email" value="itzsammy23@gmail.com" />
        <input type="hidden" name="item_number" value="123456" / >
        <input type="submit" name="submit" id="submit-checkout" value="Proceed to checkout"/>
    </form>
</div>

    <script src="/js/cart.js"></script>
<script src="/js/toggler.js"></script>
</body>
</html>

