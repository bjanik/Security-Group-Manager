<?php
    require_once('../utils/utils.php');
    session_start();
    checkSession();

    $securityGroupPrefixes = array(
        "Father" => "sgfa-",
        "Son" => "sgso-",
        "Default" => "sgde-"
    );

    $cloudProvider = $_POST["cloud_provider"];
    $sgType = $_POST["type"];
    if ($sgType === "Son" && !empty($_POST["father"])) {
        $idFather = $_POST["father"];
    }
    else {
        $idFather = "NULL";
    }
    $sgName = $securityGroupPrefixes[$sgType] . $_POST["name"];
    $cloudSecurityGroupId = create_security_group_on_cloud_provider($cloudProvider, $sgName);
    if ($cloudSecurityGroupId === null) {
        echo "An error occured on cloud side";
    }
    else {
        $conn = connection();
        $query = "INSERT INTO `security_group` (`cloud_security_group_id`, `name`, `cloud_provider`, `type`, `id_father`) VALUES ('$cloudSecurityGroupId', '$sgName', '$cloudProvider', '$sgType', $idFather)";
        $conn->query($query) or die("ERROR");
        header("Location: http://localhost:8888/security_group/security_group.php");
    }
?>