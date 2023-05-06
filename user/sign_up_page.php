<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="/index.css">
    <title>Sign up</title>
</head>
<body>
    <?php include('../header.php')?>
    <form action="sign_up.php" method="POST">
    <h2>Sign up</h2></br>
    Email: <input type="text" name="email" required placeholder="Email"><?php ?></br>
    Password: <input id="password" type="password" name="password" required placeholder="Password"></br>
    Confirm password: <input id="confirm_password" type="password" name="password" required placeholder="Confirm Password"></br>
    <input type="submit" value="Create account">
    </form>
    <?php
        if (isset($_GET["error"])) {
            $error = $_GET["error"];
            if ($error === "alreadyExists") {
                echo "<p class='error'>Email already exists</p>";
            }
        }
    ?>
    <script src="pwd_confirmation.js" type="text/javascript"></script>
</body>
</html>