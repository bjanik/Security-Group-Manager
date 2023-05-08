<?php
    require_once('../utils/utils.php');
    $conn = connection();
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $query = "SELECT email from user WHERE email = '$email";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            header("Location: http://localhost:8888/user/sign_up_page.php?error=alreadyExists");
        }
        $password = $_POST['password'];
        $passwordHash = hash("sha256", $password);
        $query = "INSERT INTO user (email, password_hash) VALUES ('$email', '$passwordHash')";
        $result = $conn->query($query) or die("DIED");
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['rights'] = 'Reader';
        header("Location: http://localhost:8888");
    }
    else {
        header("Location: http://localhost:8888/user/sign_up_page.php");
    }
?>