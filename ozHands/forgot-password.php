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

require "random.php";


function testInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

$emailErr = $passwordErr = "";
$email = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

};

$next = "";
if (!empty($_POST["email"]) && $confirm->num_rows > 0 && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $reset_id = generateRandomString(8);
    $reset_code = generateRandomString(6);
    $_SESSION["reset_id"] = $reset_id;
    $_SESSION["reset_code"] = $reset_code;


    $sql = "INSERT INTO password_reset (`email`, `reset_id`, `reset_code`) VALUES ('$email', '$reset_id', '$reset_code')";
    $conn->query($sql);
    $next = 'password-reset.php';
} else {
    $next = htmlspecialchars($_SERVER["PHP_SELF"]);
};
?>



<div class="content-setter">
    <h2 style="color: #000d1a;text-align: center">Enter your email address</h2>
    <div class="form-content">
        <form action="<?php echo $next?>" method="POST">
            <div class="block-content">
                <label>Email</label>
                <input class="form-input" type="email" autocomplete="off" value="<?php echo $email ?>" name="email" placeholder="Enter your email..">
                <div class="error_message"><?php echo $emailErr ?></div>
            </div>

            <button type="submit" name="submit">Request Reset Code</button>
        </form>

    </div>
</div>


<script src="/js/toggler.js"></script>
</body>
</html>

