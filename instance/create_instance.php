<?php
    require('../utils/utils.php');

    session_start();
    checkSessionRights(['Administrator', 'Contributor']);
    $conn = connection();

    if (!empty($_POST["name"]) && !empty($_POST["security_groups"])) {
        $instanceName = $_POST['name'];
        $instanceType = "t2.nano";
        $securityGroups = $_POST['security_groups'];
        $securityGroupsStr = join(" ", $securityGroups);
        $securityGroups = join("','", $securityGroups);

        $query = "SELECT DISTINCT sg.cloud_security_group_id, sg.id, sg2.cloud_security_group_id AS father_cloud_id, sg2.id AS father_id
            FROM security_group sg
            LEFT JOIN security_group sg2 ON sg2.id = sg.id_father
            WHERE sg.cloud_security_group_id IN ('$securityGroups')";

        $result = $conn->query($query);
        $result = $result->fetch_all(MYSQLI_ASSOC);
        $cloudIds = [];
        $ids = [];
        foreach($result as $row) {
            if ($row['father_id']) {
                $cloudIds[] = $row['father_cloud_id'];
                $ids[] = $row['father_id'];
            }
            $cloudIds[] = $row['cloud_security_group_id'];
            $ids[] = $row['id'];
        }
        $cloudIds = array_unique($cloudIds);
        $ids = array_unique($ids);

        if ($cloudIds) {
            $cloudIds = join(" ", $cloudIds) . " " . $securityGroupsStr;
        }
        else {
            $cloudIds = $securityGroupsStr;
        }
        $instanceData = create_instance_on_cloud_provider($instanceName, $instanceType, $cloudIds);
        if ($instanceData == null) {
            header("Location: http://localhost:8888/instance/instance_form.php?cloud_error");
        }
        else {
            $conn = connection();
            $cloudInstanceId = $instanceData["Instances"][0]["InstanceId"];
            $instancePublicIp = $instanceData["Instances"][0]["PublicIpAddress"];
            $instancePrivateIp = $instanceData["Instances"][0]["PrivateIpAddress"];
            $instancePublicDns = $instanceData["publicDns"];
            $query = "INSERT INTO instance (`cloud_instance_id`, `name`, `type`, `public_dns`, `private_ip`) VALUES ('$cloudInstanceId', '$instanceName', '$instanceType', '$instancePublicDns', '$instancePrivateIp')";
            $conn->query($query) or die("Died while trying to insert new instance to database");
            $instanceId = (int) mysqli_insert_id($conn);

            $query = "INSERT INTO `instance_security_group_assoc` (`id_instance`, `id_security_group`) VALUES ";
            $queryParts = [];
            foreach($ids as $id) {
                $id = (int) $id;
                $queryParts[] =  "('" . $instanceId . "','" . $id . "')";
            }
            $query .= implode(",", $queryParts);
            $conn->query($query) or die("");
            header("Location: /instance/instance.php");
        }
    }
    if (empty($_POST["security_groups"])) {
        header("Location: /instance/instance_form.php?error=missing_security_groups");
    }

?>