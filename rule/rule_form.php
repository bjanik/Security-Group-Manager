<?php
    require_once('../utils/utils.php');
    session_start();
    checkSessionRights(['Administrator', 'Contributor']);

    
    $conn = connection();
    $query = "SELECT name from `security_group`";
    $sgNames = $conn->query($query);
    $sgNames = $sgNames->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <title>Rule creation</title>
</head>
<body>
    <?php include("../header.php");?>
    <a href="instance.php"><button>&#8592; Back</button></a>
    </br>
    <div class="container">
        <form action="rule_creation.php" method="POST">
            <h1>Rule creation</h1>
            Security group name: 
            <select name='security_group_name' placeholder="Security group name" required>
                <?php foreach($sgNames as $sg) {
                    echo "<option value=$sg[name]>$sg[name]</option>";
                } ?>
            </select></br>
            Rule name: <input type="text" name="rule_name" placeholder="Rule name" required></br>
            Ip source: <input type="text" name="source_ip" placeholder="Source IP" pattern="^((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){3}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})(?:\/(?:[0-9]|[12][0-9]|3[0-2]))?$)|^((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){3}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})-((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){3}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})$" required></br>
            Port source: <input value="Any" type="text" name="source_port" placeholder="Source port" pattern="(\d+)|Any" required></br>
            Destination port range: <input type="text" name="dest_port_range" placeholder="Destination port range" pattern="(\d+)|(\d+)-(\d+)" required></br>
            Protocol: <input type="text" name="protocol" placeholder="Protocol" required></br>
            <input type="submit" value="Create rule">
        </form>
    </div>
</body>
</html>