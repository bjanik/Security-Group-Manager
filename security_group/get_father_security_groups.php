<?php
    require_once('../utils/utils.php');
    session_start();
    checkSessionRights();

    $cloudProvider = $_REQUEST["cloud_provider"];

    if ($cloudProvider !== '') {
        $conn = connection();
        $query = "SELECT `name` FROM `security_group` WHERE `cloud_provider` = '$cloudProvider' AND `type` = 'Father'";
        $result = $conn->query($query);
        $result = $result->fetch_all(MYSQLI_ASSOC);
    }
?>