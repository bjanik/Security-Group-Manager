<?php
    require_once('../utils/utils.php');

    $securityGroupPrefixes = array(
        "Father" => "sgfa-",
        "Son" => "sgso-",
        "Default" => "sgde-"
    );

    $conn = connection();
    $cloudProvider = $_POST["cloud_provider"];
    $sgType = $_POST["type"];

    $sgName = $securityGroupPrefixes[$sgType] . $_POST["name"] ;
    $groupId = create_security_group_on_cloud_provider($cloudProvider, $sgName);
    if ($groupId === null) {
        echo "An error occured on cloud side";
    }
    else {
        $query = "INSERT INTO security_group (`security_group_id`, `name`, `cloud_provider`, `type`) VALUES ('$groupId', '$sgName', '$cloudProvider', '$sgType')";
        mysqli_query($conn, $query) or die("Failed to insert new sg in database");
        header("Location: http://localhost:8888/security_group/security_group.php");
    }
?>