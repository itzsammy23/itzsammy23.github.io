<?php
/* Template Name: Show Wholesale Cart */
session_start();

?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/ee654fe705.js" crossorigin="anonymous"></script>
    <style>
        * {
            font-family: Nunito;
        }

        body{
            background-color: #000d1a;
        }

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


        #cart a {
            float: right;
        }

        .container {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.19), 0 16px 32px rgba(0, 0, 0, 0.20);
            height: auto;
            width: 80%;
            margin: 120px auto 30px auto;
            padding: 25px;
            border: 1px solid #c3c3c3;
            border-radius: 8px;
            background-color: #fff;
        }

        .colon {
            width: 100%;
            display: flex;
        }

        .colon-divisor {
            width: 50%;
        }

        .colon-divisor img {
            width: 100%;
            height: 500px;
        }

        .colon-divider {
            width: 60%;
            padding-left: 80px;
            padding-top: 25px;
        }

        .content {
            padding: 20px 0;
        }

        .colon-divider .name {
            font-size: 25px;
            padding-bottom: 15px;
            color: #800000;
            font-weight: 900;
            padding-bottom: 15px;
            width: 60%;
        }

        .colon-divider input {
            width: 40px;
            padding: 5px;
        }

        hr {
            border: 1px solid #c3c3c3;
        }

        .colon-divider .desc {
            padding: 40px 0;
            font-size: 20px;
        }

        .colon-divider .price {
            font-weight: bold;
            font-size: 18px;
        }

        .colon-divider .price span{
            color: #003366;
        }

        input[type="number"]{
            width: 50px;
        }

        .colon-divider .btn {
            background: rgb(0, 0, 0) none repeat scroll 0 0;
            border-radius: 3px;
            font-size: 18px;
            margin-top: 15px; color:#fffef7;
            padding: 12px;
            width:50%;
        }

        .fa-shopping-cart, .fa-bars{
            color: #fff;
            font-size: 30px;
            margin-right: 15px;
        }

        .fa-cart-plus{
            color: #ffffff;
            font-size: 20px;
        }

        .colon-divider button:hover {
            background-image: none;
            color: #3366cc;
            border: 2px solid #3366cc;
            font-weight: bold;
        }

        #billed {
            font-weight: bold;
            font-size: 25px;
            color: #003366;
            width: 90%;
            text-align: center;
        }

        #total {
            font-size: 22px;
        }

        #checkout {
            width: 100%;
            color: #fff;
            background-color: inherit;
        }

        .cart-image img{
            width: 100%;
            height: 250px;
        }

        .cart .order,.cart h2 {
            padding: 5px 10px 10px 5px;
        }


        .cart h2{
            color: #800000;
        }

        .cart .link a{
            font-weight: bold;
            text-decoration: none;
            color: #003355;
        }

        .check-out{
            width: 95%;
            padding: 15px;
            margin:15px auto;
        }

        .check-out a{
            color: #fff;
            text-decoration: none;
        }

        .check-out a:hover{
            color: red;
        }

        #submit-checkout{
            width: 90%;
            padding: 12px;
            font-size: 18px;
            color: #fff;
            background-color: #000;
        }

        #no-items{
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            color: #c3c3c3;
        }

        #no-items a{
            color: red;
        }

        .delete{
            float: right;
        }

        .cart .link a:hover{
            text-decoration: underline;
        }

        .fa-trash-alt{
            color: red;
            font-size: 20px;
            cursor: pointer;
        }

        @media screen and (max-width: 800px){
            .colon{
                display: block;
            }

            .colon-divisor {
                width: 100%;
            }


            .colon-divisor img {
                display: block;
                margin: auto;
                width: 250px;
                height: 250px;
            }

            .colon-divider .name{
                width: 90%;
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
<div class="topnav" id="myTopnav">
    <a href="cart.php"><i class="fas fa-shopping-cart"></i></a>
    <a href="#contact">Contact</a>
    <a href="#about">About</a>
    <a href="login.php">Login</a>
    <a href="register.php">Register</a>
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

<script>
    $(document).ready(function () {
        load();

        var text = $('#hidden').text();

        if (text != 1){
            $('#submit-checkout').css('display', 'none');
            $('#no-items').append('<p>You need to be logged in to check-out. <a href="login.php">Login</a></p>')
        }

        $(document).on('click', '.delete', function () {
            var id = $('.delete').index(this);
            var cart_id = item_id[id];

            $.ajax({
                type: "POST",
                url: "https://wholesale.luckyit.com.au/cartdelete/",
                data: {
                    cart_id: cart_id,
                },
            });

            $('.colon').remove();
            $('hr').remove();
            $('#billed').remove();
            $('#amount').val('');

            load();
        })

    });

    var item_id = [];
    function load() {
        $.get("https://wholesale.luckyit.com.au/showcart/", function (response) {
            console.log(response);

            if (response.length == 0){
                $('#container').append('<p style=" text-align: center; color: #000d1a; font-size: 18px;">No items in cart</p>');
                $('.check-out').css('display', 'none');
            }else{
                if (response.items){
                    for (var i = 0; i < response.items.length; i++){
                        item = response.items[i];
                        item_id[i] = item.id;
                        console.log(i);

                        var link = item.name;
                        link = link.replace(/\s/g, "-");
                        $('#container').append(`
                  <div class="colon">
                <div class="colon-divisor cart-image" id="image">
                    <img src="/img/${item.image}">
                </div>

                <div class="colon-divider cart">
                <div class="delete"><i class="fas fa-trash-alt"></i></div>
                    <div class="order name" id="name" style="font-size: 22px;"><h4>${item.name}</h4></div>
                    <div class="order price" id="price"><b>Price: &#36;${item.price}</b></div>
                    <div class="order quantity" id="quantity"><b>Quantity: ${item.quantity}</b></div>
                    <div class="order link" id="link"><a href="product.php?name=${link}">View Product</a></div>
                </div>
            </div>
            <hr>


               `)

                    }

                    $('#amount').val(response.total_price);
                }
                $('#container').append(`<div id="billed"><p><b>Total amount billed: &#36;${response.total_price}</b></p></div>`)
            }

        });
    }

    function myFunction() {
        var x = $("#myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    }

</script>
</body>
</html>
