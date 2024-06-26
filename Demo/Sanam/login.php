<?php

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="login_style.css">
    

</head>
<body>
    <div id="main">
        <div id="container">
            <h1>Login</h1><br>
        <form action="validate_password_login.php">
            <input type="text" name="username" id="username" placeholder="Username"><br>
            <input type="password" name="password" id="password" placeholder="Password"><br>
            <input type="submit" value="Login"><br>
        </form><br>
        <span>Don't have an account, <a href="#">Create a new account</a></span>
        </div>
    </div>
    <script src="header.js"></script>
    <script src="login_script.js"></script>
</body>
</html>