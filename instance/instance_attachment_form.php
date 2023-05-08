<?php
    require_once('../utils/utils.php');
    session_start();
    checkSessionRights();
    
    parse_str($_SERVER['QUERY_STRING'], $params);
    $conn = connection();
    $query = "SELECT id, name, security_group_id FROM security_group WHERE type != 'Father'";
    $securityGroups = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <script src="../script.js" type="text/javascript"></script>

    <title>Attachment management</title>
</head>
<body>
    <?php include("../header.php");?>
    <form action="./instance_attachment.php" method="POST" class="container">
        Security groups
        <div class="selectBox" onclick="showCheckboxes()">
            <select>
                <option>Select security groups to attach</option>
            </select>
            <div class="overSelect"></div>
        </div>
        <div id="checkboxes">
            <?php foreach($securityGroups as $securityGroup) { ?>
                <label for="<?php echo $securityGroup["name"]?>">
                <input type="checkbox" id="<?php echo $securityGroup["name"]?>" name="security_groups[]" value="<?php echo $securityGroup["security_group_id"]?>" /><?php echo $securityGroup["name"]?></label>
                <?php } ?>
        </div>
        <input type="submit" value="Apply">

    </form>
</body>
</html>