<?php
    require_once('../utils/utils.php');

    $conn = connection();
    $cloudName = $_POST["cloud_name"];
    $sgType = $_POST["type"];
    $query = "SELECT shortcut FROM cloud_type WHERE `name` = '$cloudName'";
    $result = mysqli_query($conn, $query) or die("mysql error");
    $shortcut = $result->fetch_assoc()['shortcut'];

    $sgName = $_POST["name"] . "-" . $shortcut;
    $query = "INSERT INTO `security_group` (`name`, `cloud_name`, `type`) VALUES ('$sgName', '$cloudName', '$sgType')";
    $done = mysqli_query($conn, $query) or die("mysql error");
    header("Location: http://localhost:8888/security_group/security_group.php");
?>