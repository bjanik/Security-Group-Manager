<?php
    require_once('../utils/utils.php');
    session_start();
    checkSession();

    parse_str($_SERVER['QUERY_STRING'], $params);
    $instanceId = $params["instance_id"];
    $returnCode = delete_instance_on_cloud_provider($instanceId);
    if ($returnCode != 0) {
        echo "Failed to delete instance with id " . $securityGroupId;
        header("Location: http://localhost:8888/instance/instance.php?error=$instanceId");
    }
    else {
        $conn = connection();
        $query = "DELETE FROM `instance` WHERE `instance_id` = '$params[instance_id]'";
        echo $query;
        $conn->query($query);
        header("Location: http://localhost:8888/instance/instance.php");
    }
?>