<?php
    require('../utils/utils.php');
    session_start();
    checkSession();

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
    <div class="container">
    <h1>Instance creation</h1>
    <form action="instance_creation.php" method="POST" class="container">
        Instance name<input type="text" name="name" placeholder="Instance name" required>
        Instance type
        <select name='type' placeholder="Instance type" required>
            <option value="t2.nano">t2.nano</option>
            <option value="t2.micro">t2.micro</option>
            <option value="t2.small">t2.small</option>
        </select>
        <div class="multiselect">
            <div class="selectBox" onclick="showCheckboxes()">
                <select>
                    <option>Select security groups</option>
                </select>
                <div class="overSelect"></div>
            </div>
            <div id="checkboxes">
                <?php foreach($securityGroups as $securityGroup) { ?>
                    <label for="<?php echo $securityGroup["name"]?>">
                    <input type="checkbox" id="<?php echo $securityGroup["name"]?>" name="security_groups[]" value="<?php echo $securityGroup["cloud_security_group_id"]?>" /><?php echo $securityGroup["name"]?></label>
                <?php } ?>
            </div>
            </div>
                <br>
                <div class="openModal" onClick="openModal()">
                    <button type="button">test</button>
                </div>
                    <div class="confirmationModal">
                        <span class="close" onClick="closeModal()">&times;</span>
                        <p>Some text in the Modal..</p>
                        <input type="submit" value="Create instance">
                    </div>
            </form>
        </div>
    </body>
<script src="../modal.js" type="text/javascript"></script>
</html>