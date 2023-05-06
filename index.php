<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Document</title>
</head>
<body>
    <?php include("header.php");?>
    <div class="main-page">
        <h1>Security group manager</h1>
        <div class="menu">
            <?php
                if (!empty($_SESSION['email'])) {
                    echo "<a href='security_group/security_group.php'><button>Security groups</button></a>";
                    echo "<a href='instance/instance.php'><button>Instances</button></a>";
                }
                if (!empty($_SESSION['rights']) && $_SESSION['rights'] === 'Administrator') {
                    echo "<a href='user/user.php'><button>Manage rights</button></a>";
                }
            ?>
        <div>
    </div>
</body>
</html>