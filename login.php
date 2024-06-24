<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="../../css/login_style.css">
	
</head>
<body>


<?php
include '../split/nav_bar.php';
?>


    <div id="login">
        <div id="container">
            <h1>Login</h2><br>
        <form action="validate_password_login.php">
            <input type="text" name="username" id="username" placeholder="Username"><br>
            <input type="password" name="password" id="password" placeholder="Password"><br>
            <input type="submit" value="Login"><br>
        </form><br>
        <span>Don't have an account, <a href="../signup/signup.php">Create a new account</a></span>
        </div>
    </div>
    <script src="login_script.js"></script>
</body>
</html>