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
$verify_code = $_SESSION["verify_code"];

use PHPMailer\PHPMailer\PHPMailer;

$email = $_SESSION["email"];
require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/Exception.php";
require_once "PHPMailer/SMTP.php";

$mail = new PHPMailer();

$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->Username = "immaculate88888@gmail.com";
$mail->Password = "sam987412admin10";
$mail->Port = 465;
$mail->SMTPSecure = "ssl";

$mail->isHTML(true);
$mail->setFrom("ozhands@gmail.com", "ozHands");
$mail->addAddress($email);
$mail->Subject = "Email verification";
$message = "Hello there. Please use this code for your email verification: " .$verify_code;
$mail->Body = $message;

if ($mail->send()){
    echo "Mail sent";
}else{
    echo $mail->ErrorInfo;
}



$codeErr = $minutes = "";
$code = $created = $sent_code = "";

if (isset($_POST["submit"])) {
    if (empty($_POST["code"])) {
        $codeErr = "Please enter the code sent to your mail";
    } else {
        $code = $_POST["code"];


        if ($code != $verify_code){
            $codeErr = "Invalid code";
        }

    }

};

$next = "";
if (!empty($_POST["code"]) && $code == $verify_code) {
    $next = 'success.php';
} else {
    $next = htmlspecialchars($_SERVER["PHP_SELF"]);
};
?>



<div class="content-setter">
    <h2 style="color: #000d1a;text-align: center">Enter the verification code</h2>
    <div class="form-content">
        <form action="<?php echo $next?>" method="POST">
            <div class="block-content">
                <input class="form-input" type="text" autocomplete="off" value="<?php echo $code ?>" name="code" placeholder="Enter the code sent to your mail..">
                <input type="hidden" name="email" value="<?php echo $email; ?>">
                <div class="error_message"><?php echo $codeErr; ?></div>
            </div>

            <button type="submit" name="submit">Verify Code</button>
        </form>

    </div>
</div>


<script src="/js/toggler.js"></script>
</body>
</html>



