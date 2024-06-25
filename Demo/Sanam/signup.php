<?php
    $usernameerror = $emailerror = $gendererror = "";
    $username = $email = $gender = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_POST["username"])){
            $usernameerror = "The username is empty!";
        }
        else{
            $username = test_input($_POST["username"]);
            if(!preg_match("/^\w+$/", $username)){
                $usernameerror = "Only alphabets and digits are accepted in username";
            }
        }
        

        if(empty($_POST["email"])){
            $emailerror = "The email is empty!";
        }
        else{
            $email = test_input($_POST["email"]);
            if(!preg_match("/^\w+@(gmail|hotmail|outlook)\.com$/", $email)){
                $emailerror = "Invalid email!";
            }
        }

        if(empty($_POST["gender"])){
            $gendererror = "Gender Unchecked!";
        }
        else{
            $gender = test_input($_POST["gender"]);
        }
    }


    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="login_style.css">
</head>
<body>
    <div id="main">
        <div id="container">
            <h1>Sign Up</h1><br>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="text" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>"><br>
                <span class="error"><?php echo $usernameerror; ?></span>

                <input type="text" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>"><br>
                <span class="error"><?php echo $emailerror; ?></span>

                <div id="radio-container">
                    <input type="radio" name="gender" id="male" value="male" <?php if(isset($gender) && $gender == "male") echo "checked"; ?>>Male <br>
                    <input type="radio" name="gender" id="female" value="female" <?php if(isset($gender) && $gender == "female") echo "checked"; ?>>Female <br>
                    <input type="radio" name="gender" id="others" value="others" <?php if(isset($gender) && $gender == "others") echo "checked"; ?>>Others <br>
                    <span class="error"><?php echo $gendererror; ?></span>

                </div>

                <input type="password" name="password" id="password" placeholder="Password"><br>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password">
                
                <div class="checkbox-container">
                    <input type="checkbox" name="checkbox" id="checkbox">
                    <label for="checkbox">By signing up, you <a href="#">accept the terms and conditions.</a></label>
                </div>
                <input type="submit" value="Sign Up"><br>
            </form>
        </div>
    </div>
</body>
</html>
