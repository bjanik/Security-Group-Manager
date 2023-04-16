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
    <div class="title">
        <h1>Rule creation</h1>
        <form action="rule_creation.php" method="POST">
            Name: <input type="text" name="name" placeholder="name" required></br>
            Ip source: <input type="text" name="source_ip" placeholder="Source IP" pattern="^((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$" required></br>
            Ip dest: <input type="text" name="dest_ip" placeholder="Destination IP" pattern="^((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$" required></br>
            Port source: <input type="text" name="source_port" placeholder="Source port" pattern="\d+" required></br>
            Port dest: <input type="text" name="dest_port" placeholder="Destination port" pattern="\d+" required></br>
            Protocol: <input type="text" name="protocol" placeholder="Protocol" required></br>
            Security group: <select name='security_group_name' placeholder="Security group name" required>
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