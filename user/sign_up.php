<?php
    require_once('../utils/utils.php');
    $conn = connection();
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
?>