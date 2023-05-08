<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../index.css">
    <title>Sign in</title>
</head>
<body>
    <?php include('../header.php')?>
    <div class="container">
        <form action="sign_in.php" method="POST">
            <h2>Sign in</h2></br>
            <?php
                if (isset($_GET["error"])) {
                    $error = $_GET["error"];
                    if ($error === "invalidemail") {
                        echo "<p class='error'>Invalid email</p>";
                    }
                    else if ($error === "wrongpassword") {
                        echo "<p class='error'>Wrong password</p>";
                    }
                }
            ?>
            Email: <input type="text" name="email" required placeholder="Email"><?php ?></br>
            Password: <input type="password" name="password" required placeholder="Password"></br>
            <input type="submit" value="Sign in">
        </form>
    </div>

        
</body>
</html>