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
    <div class="title">
        <h1>Security group manager</h1>
        <?php
            if (!empty($_SESSION['login'])) {
                echo "<a href='security_group/security_group.php'><button>Security groups</button></a>";
                echo "<a href='rule/rule.php'><button>Security group rules</button></a>";
                echo "<button>VMS</button>";
            }
        ?>
        
    </div>
</body>
</html>