<?php
    require_once('../utils/utils.php');
    session_start();
    checkSession();
    
    $conn = connection();
    $query = "SELECT name from `security_group`";
    $sgNames = mysqli_query($conn, $query);
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
    <div class="container">
        <h1>Rule creation</h1>
        <form action="rule_creation.php" method="POST">
            Security group name: <select name='security_group_name' placeholder="Security group name" required>
            <?php
                while ($sg = mysqli_fetch_array($sgNames, MYSQLI_ASSOC)):;
            ?>
                <option value="<?php echo $sg["name"];?>">
                    <?php echo $sg["name"];?>
                </option>
            <?php endwhile; ?>
            </select></br>
            Rule name: <input type="text" name="rule_name" placeholder="Rule name" required></br>
            Ip source: <input type="text" name="source_ip" placeholder="Source IP" pattern="^((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){3}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})(?:\/(?:[0-9]|[12][0-9]|3[0-2]))?$)|^((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){3}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})-((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){3}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})$" required></br>
            Port source: <input value="Any" type="text" name="source_port" placeholder="Source port" pattern="(\d+)|Any" required></br>
            Port range: <input type="text" name="port_range" placeholder="Destination port" pattern="(\d+)|(\d+)-(\d+)" required></br>
            Protocol: <input type="text" name="protocol" placeholder="Protocol" required></br>
        <input type="submit" value="Create rule">
        </form>
    </div>
</body>
</html>