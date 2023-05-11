<?php
    require_once('../utils/utils.php');

    session_start();
    checkSessionRights(['Administrator', 'Contributor']);

    parse_str($_SERVER['QUERY_STRING'], $params);
    $cloudRuleId = $params["cloud_rule_id"];
    $conn = connection();
    $query = "SELECT cloud_security_group_id 
        FROM security_group sg
        JOIN security_group_rule sgr ON sg.id = sgr.id_security_group AND sgr.cloud_rule_id = '$cloudRuleId'";
    $result = $conn->query($query);
    $securityGroupId = $result->fetch_assoc()["cloud_security_group_id"];
    $returnCode = delete_security_group_rule_on_cloud_provider($cloudRuleId, $securityGroupId);
    if ($returnCode != 0) {
        echo "Failed to delete security group rule with id " . $cloudRuleId;
        header("Location: /rule/rule.php?error=error");
    }
    else {
        $query = "DELETE FROM `security_group_rule` WHERE cloud_rule_id = '$params[cloud_rule_id]'";
        $conn->query($query) or die("Mysql error");
        header("Location: /rule/rule.php");
    }


?>