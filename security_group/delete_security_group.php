<?php
    require_once('../utils/utils.php');

    session_start();
    checkSession();

    
    parse_str($_SERVER['QUERY_STRING'], $params);
    $securityGroupId = $params["security_group_id"];
    $returnCode = delete_security_group_on_cloud_provider($securityGroupId);
    if ($returnCode != 0) {
        echo "Failed to delete security group with id " . $securityGroupId;
    }
    else {
        $conn = connection();
        $query = "DELETE FROM `security_group` where security_group_id = '$params[security_group_id]'";
        mysqli_query($conn, $query) or die("Mysql error");
        header("Location: http://localhost:8888/security_group/security_group.php");
    }
    
?>