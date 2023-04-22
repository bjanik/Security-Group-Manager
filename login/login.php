<?php
require_once('../utils/utils.php');
session_start();

if (!empty($_POST['login']) && !empty($_POST['password'])){
    $login = $_POST['login'];
    $passwordHash = hash("sha256", $_POST['password']);
    $conn = connection();
    $query = "SELECT id from User WHERE `email` = '$login' AND `password_hash` = '$passwordHash'";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['login'] = $login;
        header("Location: http://localhost:8888");
    }
    else {
        header("Location: http://localhost:8888/login/login.html");
    }
}
?>