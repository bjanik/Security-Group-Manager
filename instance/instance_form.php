<?php
    require('../utils/utils.php');
    session_start();
    checkSessionRights(['Administrator', 'Contributor']);

    $conn = connection();
    $query = "SELECT name, cloud_security_group_id from security_group WHERE type != 'Father'";

    $result = $conn->query($query);
    $securityGroups = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <script src="../script.js" type="text/javascript"></script>

    <title>Instance creation form</title>
</head>
<body>
    <?php include("../header.php");?>
    <a href="instance.php"><button>&#8592; Back</button></a>
    </br>
    <div class="container">
        <form action="create_instance.php" method="POST">
            <h1>Instance creation</h1>
            <?php
                if (isset($_GET["error"])) {
                    $error = $_GET["error"];
                    if ($error === "missing_security_groups") {
                        echo "<p class='error'>At least one security group must be specified</p>";
                    }
                    else if (isset($_GET["cloud_error"])) {
                        echo "<p class='error'>Error on cloud side</p>";
                    }
                }
            ?>
            Instance name<input type="text" name="name" placeholder="Instance name" required></br>
            Instance type
            <select name='type' placeholder="Instance type" required>
                <option value="t2.nano">t2.nano</option>
                <option value="t2.micro">t2.micro</option>
                <option value="t2.small">t2.small</option>
            </select></br>
            <div class="multiselect">
                <div class="selectBox" onclick="showCheckboxes()">
                    <select>
                        <option>Select security groups</option>
                    </select>
                    <div class="overSelect"></div>
                </div>
                <div id="checkboxes">
                    <?php foreach($securityGroups as $securityGroup) {
                        echo "<label for=$securityGroup[name]>";
                        echo "<input type='checkbox' id=$securityGroup[name] name=security_groups[] value=$securityGroup[cloud_security_group_id]>$securityGroup[name]</label>";
                    } ?>
                </div>
            </div></br>
            <input type="submit" value="Create instance">
        </form>
    </div>
</body>
</html>