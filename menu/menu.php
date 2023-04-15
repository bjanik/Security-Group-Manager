<?php
    session_start();
    if (empty($_SESSION['login']) || $_SESSION['login'] == ''){
        header("Location: http://localhost:8888/login/login.html");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <title>Menu</title>
</head>
<body>
    <div class="container">
        <button>
            Security groups
        </button>
        <button>
            VMS
        </button>
        <button>
            <a href='../logout/logout.php'>Logout</a>
        </button>

    </div>
</body>
</html>
