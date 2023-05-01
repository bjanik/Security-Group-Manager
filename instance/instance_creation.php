<?php
    require('../utils/utils.php');

    $conn = connection();
    $instanceName = $_POST['name'];
    $instanceType = "t2.nano";
    $securityGroups = $_POST['security_groups'];
    $securityGroupsStr = join(" ", $securityGroups);
    $securityGroups = join("','", $securityGroups);
    
    $query = "SELECT id, id_father FROM `security_group` WHERE cloud_security_group_id IN ('$securityGroups')";

    $result = $conn->query($query);
    $result = $result->fetch_all(MYSQLI_ASSOC);
    $idsFather = [];
    $ids = [];
    foreach($result as $row) {
        if ($row['id_father']) {
            $idsFather[] = $row['id_father'];
            $ids[] = $row['id_father'];
        }
        $ids[] = $row['id'];
    }
    $idsFather = array_unique($idsFather);
    $ids = array_unique($ids);
    $idsFatherStr = join("','", array_unique($idsFather));

    $query = "SELECT cloud_security_group_id FROM security_group WHERE id IN ('$idsFatherStr')";
    $result = $conn->query($query);
    $result = $result->fetch_all(MYSQLI_ASSOC);
    $cloudIds = [];
    foreach($result as $row) {
        $cloudIds[] = $row['cloud_security_group_id'];
    }
    $cloudIds = array_unique($cloudIds);

    if ($cloudIds) {
        $cloudIds = join(" ", $cloudIds) . " " . $securityGroupsStr;
    }
    else {
        $cloudIds = $securityGroupsStr;
    }
    $instanceData = create_instance_on_cloud_provider($instanceName, $instanceType, $cloudIds);
    if ($instanceData == null) {
        echo "NULL";
    }
    else {
        $conn = connection();
        $cloudInstanceId = $instanceData["Instances"][0]["InstanceId"];
        $instancePublicIp = $instanceData["Instances"][0]["PublicIpAddress"];
        $instancePrivateIp = $instanceData["Instances"][0]["PrivateIpAddress"];
        $query = "INSERT INTO instance (`cloud_instance_id`, `name`, `type`, `public_ip`, `private_ip`) VALUES ('$cloudInstanceId', '$instanceName', '$instanceType', '$instancePublicIp', '$instancePrivateIp')";
        $conn->query($query) or die("Died while trying to insert new instance to database");
        $instanceId = (int) mysqli_insert_id($conn);

        $query = "INSERT INTO `instance_security_group_assoc` (`id_instance`, `id_security_group`) VALUES ";
        $queryParts = array();
        foreach($ids as $id) {
            $id = (int) $id;
            $queryParts[] =  "('" . $instanceId . "','" . $id . "')"; 
        }
        $query .= implode(",", $queryParts);
        $conn->query($query) or die("");
        header("Location: http://localhost:8888/instance/instance.php");
    }

?>