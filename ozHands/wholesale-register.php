<?php
    /* Template Name: Wholesale Register */
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

$first_name = $last_name = $email = $password = $password_confirm = $checkbox = "";
$error_first_name = $error_last_name = $error_email = $error_password = $error_password_confirm = $error_checkbox = "";

function testInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);

    return $input;
}

$route = "";
if ($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty($_POST["firstname"])){
        $error_first_name = "This field is required";
    }else{
        $first_name = testInput($_POST["firstname"]);

        if (!preg_match("/^[a-zA-Z-' ]*$/",$first_name)) {
            $error_first_name = "Only letters allowed";
        }
    }


   if(empty($_POST["lastname"])){
        $error_last_name = "This field is required.";
    }else{
        $last_name = testInput($_POST["lastname"]);

        if (!preg_match("/^[a-zA-Z-' ]*$/",$last_name)) {
            $error_last_name = "Only letters allowed.";
        }
    }

    if(empty($_POST["email"])){
        $error_email = "This field is required.";
    }else{
        $email = testInput($_POST["email"]);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_email = "Invalid email address.";
        }

        $sql = "SELECT email FROM customers WHERE email = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
            $error_email= "E-mail address is already taken";
        }
    }

    if(empty($_POST["password"])){
        $error_password = "This field is required.";
    }else{
        $password = testInput($_POST["password"]);

        if (strlen($password) < 8) {
            $error_password = "Password must be at least 8 characters long.";
        }
    }


    if(empty($_POST["confirm_password"])){
        $error_password_confirm = "This field is required.";
    }else{
        $password_confirm = testInput($_POST["confirm_password"]);

        if ($password != $password_confirm) {
            $error_password_confirm = "Passwords do not match.";
        }
    }

    if (empty($_POST["checkbox"])){
        $error_checkbox = "Please tick the checkbox";
    }else{
        $checkbox = $_POST["checkbox"];
    }

}

if (!empty($_POST["firstname"]) && preg_match("/^[a-zA-Z-' ]*$/",$first_name) &&
    !empty($_POST["lastname"]) && preg_match("/^[a-zA-Z-' ]*$/",$last_name) &&
    !empty($_POST["email"]) && filter_var($email, FILTER_VALIDATE_EMAIL) &&
    !empty($_POST["password"]) && strlen($_POST["password"]) >= 8 && !empty($_POST["confirm_password"])
    && $password == $password_confirm && !empty($_POST["checkbox"])){
    $hashed = password_hash($password_confirm, PASSWORD_DEFAULT);
    $insert = "INSERT INTO customers (firstname, lastname, email, password)
            VALUES ('$first_name', '$last_name', '$email', '$hashed')";
    $conn->query($insert);
    $_SESSION["logged_in"] = true;
    $route = "success.php";
}else{
    $route = htmlspecialchars($_SERVER["PHP_SELF"]);
}

?>

<div class="content-setter">
    <h2 style="color: #000d1a;text-align: center">Sign Up</h2>
    <div class="form-content">
        <form action="<?php echo $route;?>" method="post" id="request-form">
            <div class="colon">
                <div class="flex-content">
                    <label>First Name</label>
                    <input class="form-input" type="text" autocomplete="off" name="firstname" id="firstname" value="<?php echo $first_name;?>" placeholder="Enter your first name..">
                    <div class="error_message"><?php echo $error_first_name;?></div>
                </div>

                <div class="flex-content">
                    <label>Last Name</label>
                    <input class="form-input" type="text" autocomplete="off" name="lastname" value="<?php echo $last_name;?>" id="lastname" placeholder="Enter your last name..">
                    <div class="error_message"><?php echo $error_last_name;?></div>
                </div>
            </div>

            <div class="block-content">
                <label>Email</label>
                <input class="form-input" type="email" autocomplete="off" id="email" name="email" value="<?php echo $email;?>" placeholder="Enter your email..">
                <div class="error_message" id="error_email"><?php echo $error_email;?></div>
            </div>

            <div class="block-content">
                <label>Password</label>
                <input class="form-input" type="password" autocomplete="off" id="password" name="password" value="<?php echo $password;?>" placeholder="Type in a password..">
                <div class="error_message"><?php echo $error_password;?></div>
            </div>

            <div class="block-content">
                <label>Confirm password</label>
                <input class="form-input" type="password" autocomplete="off" id="confirm_password" value="<?php echo $password_confirm;?>" name="confirm_password" placeholder="Re-type the password..">
                <div class="error_message"><?php echo $error_password_confirm;?></div>
            </div>
            <div class="flexcheck">
                <input type="checkbox" name="checkbox"  <?php if (isset($checkbox)) echo "checked";?> style="width: 15px; margin-top: 18px;" id="checkbox">
                <p> I agree to the <a href="#" class="terms">Terms Of Service</a> and <a href="#" class="privacy">Privacy Policy</a></p>
            </div>
            <div class="error_message"><?php echo $error_checkbox;?></div>
            <button type="submit" name="submit" id="submit-button">Login</button>
        </form>

    </div>
</div>

<script src="/js/toggler.js"></script>
</body>
</html>
