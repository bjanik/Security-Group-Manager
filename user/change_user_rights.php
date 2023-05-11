<?php
    require_once('../utils/utils.php');
    $conn = connection();
    checkSessionRights(['Administrator']);
    parse_str($_SERVER['QUERY_STRING'], $params);

    $newRights = $params['rights'];
    $email = $params['email'];
    $query = "UPDATE User SET rights = '$newRights' WHERE email = '$email'";
    $conn->query($query);
    header("Location: /user/user.php");
?>