<?php
    require_once('../utils/utils.php');
    session_start();

    if (!empty($_POST['email']) && !empty($_POST['password'])){
        $email = $_POST['email'];
        $query = "SELECT password_hash from User WHERE email = '$email'";

        $conn = connection();
        $pwh = mysqli_query($conn, $query);
        if ($passwordHashDb = mysqli_fetch_assoc($pwh)) {

            $passwordHash = hash("sha256", $_POST['password']);
            echo $passwordHash . "\n";
            var_dump($passwordHashDb);
            if ($passwordHash == $passwordHashDb["password_hash"]) {
                echo "Password matching OK";
                $_SESSION['email'] = $email;
                header("Location: http://localhost:8888");
            }
            else {
                header("Location: http://localhost:8888/login/login_page.php?error=wrongpassword");    
            }

        }
        else {
            header("Location: http://localhost:8888/login/login_page.php?error=invalidemail");
        }


    }
?>