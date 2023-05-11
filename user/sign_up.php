<?php
    require_once('../utils/utils.php');
    $conn = connection();
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $query = "SELECT email from User WHERE email = '$email'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            header("Location:/user/sign_up_page.php?error=alreadyExists");
        }
        $password = $_POST['password'];
        $passwordHash = hash("sha256", $password);
        $query = "INSERT INTO User (email, password_hash) VALUES ('$email', '$passwordHash')";
        $result = $conn->query($query) or die("DIED");
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['rights'] = 'Reader';
        header("Location: /index.php");
    }
    else {
        header("Location: /user/sign_up_page.php");
    }
?>