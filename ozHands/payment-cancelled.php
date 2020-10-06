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
        <i class="fas fa-user-times" style="font-size: 65px; color: red;"></i>
        <p style="font-size: 18px">Your cancelled your payment.</p>
        <div align="center"><a href="cart.php" style="font-size: 18px; padding: 12px; background-color: #000; color: #fff; border-radius: 10px; text-decoration: none;">View Cart</a></div>
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
