<?php
    require('../utils/utils.php');

    $conn = connection();
    $instanceName = $_POST['name'];
    $instanceType= "t2.nano";
    $securityGroups= $_POST['security_groups'];
    
    $securityGroupsStr = join(" ", $securityGroups);
    $securityGroups = join("','", $securityGroups);
    $query = "SELECT id FROM security_group WHERE security_group_id IN ('$securityGroups')";
    $result = mysqli_query($conn, $query);
    $securityGroupsIds = $result->fetch_all(MYSQLI_ASSOC);
    $instanceData = create_instance_on_cloud_provider($instanceName, $instanceType, $securityGroupsStr);
    if ($instanceData == null) {
        echo "NULL";
    }
    else {
        $conn = connection();
        $instanceId = $instanceData["Instances"][0]["InstanceId"];
        $instancePublicIp = $instanceData["Instances"][0]["PrivateIpAddress"];
        $instancePrivateIp = $instanceData["Instances"][0]["PublicIpAddress"];
        $query = "INSERT INTO instance (`instance_id`, `name`, `type`, `public_ip`, `private_ip`) VALUES ('$instanceId', '$instanceName', '$instanceType', '$instancePublicIp', '$instancePrivateIp')";
        mysqli_query($conn, $query) or die("Died while trying to insert new instance to database");
        $instanceId = (int) mysqli_insert_id($conn);

        $query = "";
        foreach($securityGroupsIds as $sgId) {
            $sgId = $sgId['id'];
            $query .=  "INSERT INTO `instance_security_group_assoc` (`id_instance`, `id_security_group`) VALUES ('$instanceId', '$sgId');"; 
        }
        mysqli_query($conn, $query);
        header("Location: http://localhost:8888/instance/instance.php");
    }

?>