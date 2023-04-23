<?php
    require('../utils/utils.php');

    $instanceName = $_POST['name'];
    $instanceType= $_POST['type'];
    $securitygroups= $_POST['security_groups'];
    
    $securitygroups = join(" ", $securitygroups);
    
    $instanceData = create_instance_on_cloud_provider($instanceName, $instanceType, $securitygroups);
    if ($instanceData == null) {
        echo "NULL";
    }
    else {
        $conn = connection();
        $instanceId = $instanceData["Instances"][0]["InstanceId"];
        $instancePublicIp = $instanceData["Instances"][0]["PrivateIpAddress"];
        $instancePrivateIp = $instanceData["Instances"][0]["PublicIpAddress"];
        $query = "INSERT INTO instance (`instance_id`, `name`, `type`, `public_ip`, `private_ip`) VALUES ('$instanceId', '$instanceName', '$instanceType', '$instancePublicIp', '$instancePrivateIp')";
        echo $query;
        mysqli_query($conn, $query) or die("Died while trying to insert new instance to database");
        header("Location: ")
    }


?>