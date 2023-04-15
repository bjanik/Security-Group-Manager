<?php
    require_once('../utils/utils.php');
    
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
    <div class="title">
        <h1>Rule creation</h1>
        <form action="rule_creation.php" method="POST">
            Name: <input type="text" name="name" placeholder="name" required></br>
            Ip source: <input type="text" name="ip_source" placeholder="ip_source" pattern="^((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$" required></br>
            Ip dest: <input type="text" name="ip_dest" placeholder="ip_dest" pattern="^((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$" required></br>
            Port source: <input type="text" name="port_source" placeholder="port_source" pattern="\d+" required></br>
            Port dest: <input type="text" name="port_dest" placeholder="port_dest" pattern="\d+" required></br>
            Protocol: <input type="text" name="protocol" placeholder="protocol" required></br>
            Security group: <select name='Security group' placeholder="security group name" required>
            <?php
                while ($sg = mysqli_fetch_array($sgNames, MYSQLI_ASSOC)):;
            ?>
                <option value="<?php echo $sg["name"];?>">
                    <?php echo $sg["name"];?>
                </option>
            <?php
                endwhile;
            ?>
        </select></br>
        <input type="submit" value="Create rule">
        </form>
    </div>
</body>
</html>