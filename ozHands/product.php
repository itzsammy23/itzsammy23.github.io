<?php
session_start();

$_SESSION["logged_in"] = false;

$name = $_GET["name"];
$stripped = str_replace('-', ' ', $name);
$uStripped = ucfirst($stripped);

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
<?php
require 'connection.php';

$desc="Another high quality face moisturizer that keeps your face smooth, clean and free of spots, wrinkles, acne 
        and other skin issues so you can constantly look your best. All at a cut down and affordable price";

$sql = "SELECT * FROM product WHERE name = '$uStripped'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $product_name = $row['name'];
        $product_image = $row['image'];
        $product_desc = $row['description'];
        $product_price = $row['price'];
    }
}
?>
<div class="topnav" id="myTopnav">
    <a href="cart.php"><i class="fas fa-shopping-cart"></i></a>
    <a href="#contact">Contact</a>
    <a href="#about">About</a>
    <a href="login.php">Login</a>
    <a href="register.php">Register</a>
    <a href="javascript:void(0);" class="icon" id="toggler" onclick="myFunction()">
        <i class="fa fa-bars"></i>
    </a>

    <h1>oz<span class="hands">Hands</span></h1>
</div>


<div class="container">
        <div class="colon">
            <div class="colon-divisor">
                <img src="/img/<?php echo $product_image?>">
            </div>
            <div class="colon-divider">
                <div class="content name"><?php echo ucfirst($product_name)?></div>
                <div class="content desc"> <?php echo $product_desc?></div>
                <div class="content price"><span>&#36;</span><?php echo $product_price ?></div>
                <form method="POST" id="add-to-cart" data-route="addToCart.php">
                    <b>Quantity:</b>
                    <input type="number" name="quantity" value="1" min="1"><br>
                    <input type="hidden" name="vendor" value="Bruce Wayne">
                    <input type="hidden" name="product_name" value="<?php echo $product_name ?>">
                    <input type="hidden" name="product_image" value="<?php echo $product_image ?>">
                    <input type="hidden" name="product_desc" value="<?php echo $product_desc ?>">
                    <input type="hidden" name="product_price" value="<?php echo $product_price ?>">
                    <button type="submit" class="btn" id="cart-button">Add To GetPriceCart<i class="fas fa-cart-plus"></i></button>
                </form>
            </div>
    </div>


<script src="/js/ajaxcart.js"></script>
<script src="/js/toggler.js"></script>
</body>
</html>
