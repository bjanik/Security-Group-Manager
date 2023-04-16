<?php
    require_once('../utils/utils.php');

    session_start();
    checkSession();

    $conn = connection();
    parse_str($_SERVER['QUERY_STRING'], $params);
    $query = "DELETE FROM `security_group` where id = '$params[id]'";
    mysqli_query($conn, $query) or die("Mysql error");
    header("Location: http://localhost:8888/security_group/security_group.php");
?>