<?php
    session_start();
?>

<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
<?php
require "connection.php";

$_SESSION["retailer"] = "Dele Alli";
$_SESSION["seller"] = null;
$product = 'Tecno Pouvoir';
$encoded = str_replace(' ', '-', $product);

$url = "http://localhost/product/" .$encoded;
$desc = "Another top quality face moisturizer to keep your skin soft, smooth and silky so you
        can always look your best anyday, anytime";

$order = "Hello. I want to purchase 30 units of Essentials face moisturizer";

$_SESSION["order"] = $order;

?>
<a href="<?php echo $url ?>">Get</a>
    <a href="http://localhost/chat.php?wholesaler=Harry-Kane&buyer=Dele-Alli">Chat</a>
</body>
</html>


