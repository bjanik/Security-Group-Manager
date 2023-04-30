<?php
    require_once('../utils/utils.php');
    session_start();
    checkSession();

    parse_str($_SERVER['QUERY_STRING'], $params);
    $securityGroupRuleId = $params["security_group_rule_id"];
    $returnCode = delete_security_group_rule_on_cloud_provider($securityGroupRuleId);
    if ($returnCode != 0) {
        echo "Failed to delete security group rule with id " . $securityGroupRuleId;
        header("Location: http://localhost:8888/rule/rule.php?error=error");
    }
    else {
        $conn = connection();
        $query = "DELETE FROM `security_group_rule` where security_group_rule_id = '$params[security_group_rule_id]'";
        $conn->query($query) or die("Mysql error");
        header("Location: http://localhost:8888/rule/rule.php");
    }


?>