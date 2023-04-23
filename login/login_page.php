<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="/index.css">
    <title>Document</title>
</head>
<body>
    <form action="login.php" method="POST">
        Sign-in
        </br>
            Email: <input type="text" name="email" required placeholder="email"><?php ?></br>
            Password: <input type="password" name="password" required placeholder="password">
        </br>
        <input type="submit" value="Submit">
    </form>
    <?php
        if (isset($_GET["error"])) {
            $error = $_GET["error"];
            if ($error == "invalidemail") {
                echo "<p class='error'>Invalid email</p>";
            }
            else if ($error == "wrongpassword") {
                echo "<p class='error'>Wrong password</p>";
            }
        }
    ?>
</body>
</html>