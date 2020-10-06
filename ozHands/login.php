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
    <script src="https://www.google.com/recaptcha/api.js?render=6Lc3DdQZAAAAAAas6Alo91Dje4H1NJYkugvOHBZg"></script>
    <script>
        grecaptcha.ready(function () {
            grecaptcha.execute('6Lc3DdQZAAAAAAas6Alo91Dje4H1NJYkugvOHBZg', { action: 'contact' }).then(function (token) {
                var recaptchaResponse = document.getElementById('recaptchaResponse');
                recaptchaResponse.value = token;
            });
        });
    </script>
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


function testInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

$emailErr = $passwordErr = "";
$email = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['recaptcha_response'])) {

    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = '6Lc3DdQZAAAAAH4CCLih0kvTHAgfUrvUVMgdfAoO';
    $recaptcha_response = $_POST['recaptcha_response'];

    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $recaptcha = json_decode($recaptcha);

    if (empty($_POST["email"])) {
        $emailErr = "Email address is required";
    } else {
        $email = testInput($_POST["email"]);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }

        $check = "SELECT email FROM customers WHERE email = '$email'";
        $confirm = $conn->query($check);

        if ($confirm->num_rows == 0) {
            $emailErr = "Email does not exist in our records";
        }
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Please enter your password";
    } else {
        $password = testInput($_POST["password"]);

        $sql = "SELECT firstname, lastname, password FROM customers WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $hashed = $row["password"];
                $firstname = $row["firstname"];
                $lastname = $row["lastname"];
                if (!password_verify($password, $hashed)) {
                    $passwordErr = "Incorrect password";
                }
            }
        }

    };


};


$next = "";
if (!empty($_POST["email"]) && !empty($_POST["password"]) && $confirm->num_rows > 0 &&
    password_verify($password, $hashed) && filter_var($email, FILTER_VALIDATE_EMAIL) && $recaptcha->score >= 0.5) {
    $next = 'cart.php';
    $_SESSION["retailer"] = $firstname ." ". $lastname;
    $_SESSION["seller"] = null;
    $_SESSION["logged_in"] = true;
} else {
    $next = htmlspecialchars($_SERVER["PHP_SELF"]);
};
?>

<?php
    if ($_SESSION["updated"] == true) {
        ?>
        <div align="center" style="font-weight: bold; font-size: 20px; color: mediumspringgreen;padding-top: 200px">Your new password has been set</div>

        <?php
    }
?>

<div class="content-setter">
    <h2 style="color: #000d1a;text-align: center">Sign In</h2>
    <div class="form-content">
        <form action="<?php echo $next?>" method="POST">
            <div class="block-content">
                <label>Email</label>
                <input class="form-input" type="email" autocomplete="off" value="<?php echo $email ?>" name="email" placeholder="Enter your email..">
                <div class="error_message"><?php echo $emailErr ?></div>
            </div>

            <div class="block-content">
                <label>Password</label>
                <input class="form-input" type="password" autocomplete="off" value="<?php echo $password ?>" name="password" placeholder="Type in a password..">
                <div class="error_message"><?php echo $passwordErr ?></div>
            </div>

            <input type="hidden" name="recaptcha_response" id="recaptchaResponse">

            <div class="block-content"><a href="forgot-password.php">Forgotten your password?</a></div>

            <button type="submit" name="submit">Login</button>
            <div align="center" class="register-link"><a href="register.php">Don't have an account? Register</a></div>
        </form>

    </div>
</div>


<script src="/js/toggler.js"></script>
</body>
</html>

