<?php
    require_once('../utils/utils.php');

    $conn = connection();

    $securityGroupName = $_POST['security_group_name'];
    $sourcePort = $_POST['source_port'];
    $portRange = $_POST['port_range'];
    $sourceIp = $_POST['source_ip'];
    $destIp = $_POST['dest_ip'];
    $protocol = $_POST['protocol'];

    $securityGroupRuleId = create_security_group_ingress_rule($securityGroupName, $protocol, $portRange, $sourceIp);
    if ($securityGroupRuleId === null) {
        echo "Something went bad on cloud side";
        echo "\n" . $returnCode;
    }
    else {
        $query = "SELECT id from security_group WHERE `name` = '$securityGroupName'";
        $result = mysqli_query($conn, $query);
        $sgId = $result->fetch_assoc()['id'];
        $query = "INSERT INTO `security_group_rule` (`id_security_group`, `security_group_rule_id`, `source_port`, `port_range`, `source_ip`, `dest_ip`, `protocol`)
            VALUES ('$sgId', '$securityGroupRuleId', '$sourcePort', '$portRange', '$sourceIp', '$destIp', '$protocol')";
        mysqli_query($conn, $query) or die("ERROR WHEN INSERTING NEW RULE INTO DATABASE");
        header("Location: http://localhost:8888/rule/rule.php");
    }
?>