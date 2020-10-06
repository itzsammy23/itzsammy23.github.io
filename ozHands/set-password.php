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
    <a href="/cart"><i class="fas fa-shopping-cart"></i></a>
    <a href="#contact">Contact</a>
    <a href="#about">About</a>
    <a href="login.php">Login</a>
    <a href="register.php">Register</a>
    <a href="javascript:void(0);" class="icon" id="toggler" onclick="myFunction()">
        <i class="fa fa-bars"></i>
    </a>

    <h1>oz<span class="hands">Hands</span></h1>
</div>

<?php
require "connection.php";

$codeErr ="";
$code = "";

$email = $_SESSION["email"];

if (isset($_POST["submit"])) {
    if (empty($_POST["password"])) {
        $codeErr = "Please enter a password";
    } else {
        $code = $_POST["password"];

        if (strlen($code) < 8){
            $codeErr = "Your password must be at least 8 characters long.";
        }

    }

};

$next = "";
if (!empty($_POST["password"]) && strlen($code) >= 8) {
    $hashed = password_hash($code, PASSWORD_DEFAULT);
    $sql = "UPDATE customers SET password = '$hashed' WHERE email = '$email'";
    $conn->query($sql);
    $_SESSION["updated"] = true;
    $next = 'login.php';
} else {
    $next = htmlspecialchars($_SERVER["PHP_SELF"]);
};
?>



<div class="content-setter">
    <h2 style="color: #000d1a;text-align: center">Enter the reset code</h2>
    <div class="form-content">
        <form action="<?php echo $next?>" method="POST">
            <div class="block-content">
                <input class="form-input" type="text" autocomplete="off" value="<?php echo $code ?>" name="password" placeholder="Enter your new password..">
                <div class="error_message"><?php echo $codeErr ?></div>
            </div>

            <button type="submit" name="submit">Set New Password</button>
        </form>

    </div>
</div>


<script src="/js/toggler.js"></script>
</body>
</html>


