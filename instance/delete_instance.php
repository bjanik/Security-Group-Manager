<?php
    require_once('../utils/utils.php');
    session_start();
    checkSessionRights(['Administrator', 'Contributor']);


    parse_str($_SERVER['QUERY_STRING'], $params);
    $cloudInstanceId = $params["cloud_instance_id"];
    $returnCode = delete_instance_on_cloud_provider($cloudInstanceId);
    if ($returnCode != 0) {
        echo "Failed to delete instance with id " . $securityGroupId;
        header("Location: /instance/instance.php?error=$instanceId");
    }
    else {
        $conn = connection();
        $query = "DELETE FROM `instance` WHERE `cloud_instance_id` = '$params[cloud_instance_id]'";
        $conn->query($query);
        header("Location: /instance/instance.php");
    }
?>