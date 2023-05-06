<?php
    require_once('../utils/utils.php');
    session_start();

    if (!empty($_POST['email']) && !empty($_POST['password'])){
        $email = $_POST['email'];
        $query = "SELECT password_hash, rights from User WHERE email = '$email'";

        $conn = connection();
        $pwh = $conn->query($query);
        if ($user = mysqli_fetch_assoc($pwh)) {
            $passwordHash = hash("sha256", $_POST['password']);
            if ($passwordHash == $user["password_hash"]) {
                $_SESSION['email'] = $email;
                $_SESSION['rights'] = $user["rights"];
                header("Location: http://localhost:8888");
            }
            else {
                header("Location: http://localhost:8888/user/login_page.php?error=wrongpassword");    
            }
        }
        else {
            header("Location: http://localhost:8888/user/login_page.php?error=invalidemail");
        }
    }
?>