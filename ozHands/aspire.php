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
$_SESSION["seller"] = "Harry Kane";
$_SESSION["retailer"] = "override";
$_SESSION["order"] = null;
?>
<a href="http://localhost/chat.php?wholesaler=Harry-Kane&buyer=Dele-Alli">Chat</a>
</body>
</html>
