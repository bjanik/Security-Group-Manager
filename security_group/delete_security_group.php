<?php
    require_once('../utils/utils.php');

    session_start();
    checkSessionRights(['Administrator', 'Contributor']);

    parse_str($_SERVER['QUERY_STRING'], $params);
    $securityGroupId = $params["cloud_security_group_id"];
    $returnCode = delete_security_group_on_cloud_provider($securityGroupId);
    if ($returnCode != 0) {
        echo "Failed to delete security group with id " . $securityGroupId;
        header("Location: http://localhost:8888/security_group/security_group.php?error=$securityGroupId");
    }
    else {
        $conn = connection();
        $query = "DELETE FROM `security_group` where cloud_security_group_id = '$params[cloud_security_group_id]'";
        $conn->query($query);
        header("Location: http://localhost:8888/security_group/security_group.php");
    }
    
?>