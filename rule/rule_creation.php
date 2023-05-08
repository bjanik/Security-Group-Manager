<?php
    require_once('../utils/utils.php');
    session_start();
    checkSessionRights(['Administrator', 'Contributor']);

    $conn = connection();

    if (!empty($_POST["security_group_name"]) && !empty($_POST["rule_name"]) && !empty($_POST["source_port"]) &&
            !empty($_POST["dest_port_range"]) && !empty($_POST["source_ip"]) && !empty($_POST["protocol"])) {
        $securityGroupName = $_POST['security_group_name'];
        $ruleName = $_POST['rule_name'];
        $sourcePort = $_POST['source_port'];
        $destPortRange = $_POST['dest_port_range'];
        $sourceIp = $_POST['source_ip'];
        $protocol = $_POST['protocol'];

        $cloudRuleId = create_security_group_ingress_rule($securityGroupName, $ruleName, $protocol, $destPortRange, $sourceIp);
        if ($cloudRuleId === null) {
            echo "Something went bad on cloud side";
            echo "\n" . $returnCode;
        }
        else {
            $query = "SELECT id from security_group WHERE `name` = '$securityGroupName'";

            $result = $conn->query($query);
            $sgId = $result->fetch_assoc()['id'];
            $query = "INSERT INTO `security_group_rule` (`id_security_group`, `name`, `cloud_rule_id`, `source_port`, `dest_port_range`, `source_ip`, `dest_ip`, `protocol`)
                VALUES ('$sgId', '$ruleName', '$cloudRuleId', '$sourcePort', '$destPortRange', '$sourceIp', '$destIp', '$protocol')";
            $conn->query($query) or die("ERROR WHEN INSERTING NEW RULE INTO DATABASE");
            header("Location: http://localhost:8888/rule/rule.php");
        }
    }
?>