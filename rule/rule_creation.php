<?php
    require_once('../utils/utils.php');

    $conn = connection();

    $ruleName = $_POST['name'];
    $sourcePort = $_POST['source_port'];
    $destPort = $_POST['dest_port'];
    $sourceIp = $_POST['source_ip'];
    $destIp = $_POST['dest_ip'];
    $protocol = $_POST['protocol'];

    $sgName = $_POST['security_group_name'];
    $query = "SELECT id from security_group WHERE name = $sgName";
    $result = mysqli_query($conn, $query);
    $sgId = $result->fetch_assoc();
    echo $sgId['id'];

?>