<?php
require_once('../utils/utils.php');
session_start();

if (!empty($_POST['login']) && !empty($_POST['password'])){
    $login = $_POST['login'];
    $password = $_POST['password'];
    $conn = connection();
    $query = "SELECT id from User WHERE `email` = '$login' AND `password` = '$password'";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['login'] = $login;
        header("Location: http://localhost:8888/menu/menu.php");
    }
    else {
        header("Location: http://localhost:8888/login/login.html");
    }
}
?>