<?php
    require_once('../utils/utils.php');
    session_start();
    checkSession();
    
    $conn = connection();
    $query = "SELECT name from `cloud_provider`";
    $cloudProviders = mysqli_query($conn, $query);
    $query = "SELECT type from `security_group_type`";
    $sgTypes = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <title>Create security group</title>
</head>
<body>
    <?php include("../header.php");?>
    <h1>Security group creation</h1>
    <form action="security_group_creation.php" method="POST">
        Name <input type="text" name="name" placeholder="name" required maxlength="64"><br>
        Cloud provider <select name="cloud_provider" required>
        <?php
            while ($cloudProvider = mysqli_fetch_array($cloudProviders, MYSQLI_ASSOC)):;
        ?>
            <option value="<?php echo $cloudProvider["name"];?>">
                <?php echo $cloudProvider["name"];?>
            </option>
        <?php
            endwhile;
        ?>
        </select><br>
        Security group type
        <select name="type" required>
        <?php
            while ($sgType = mysqli_fetch_array($sgTypes, MYSQLI_ASSOC)):;
        ?>
            <option value="<?php echo $sgType["type"];?>">
                <?php echo $sgType["type"];?>
            </option>
        <?php
            endwhile;
        ?>
        </select><br>
        <input type="submit" value="Create security group">
    </form>
</body>
</html>