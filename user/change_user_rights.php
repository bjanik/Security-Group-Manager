<?php
    require_once('../utils/utils.php');
    $conn = connection();
    parse_str($_SERVER['QUERY_STRING'], $params);

    $newRights = $params['rights'];
    $email = $params['email'];
    $query = "UPDATE user SET rights = '$newRights' WHERE email = '$email'";
    $conn->query($query);
    header("Location: http://localhost:8888/user/user.php");
?>