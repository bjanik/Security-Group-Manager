<?php
    require_once('../utils/utils.php');
    
    $conn = connection();
    $query = "SELECT type from `cloud_type`";
    $cloudTypes = mysqli_query($conn, $query);
    $query = "SELECT type from `security_group_type`";
    $sgTypes = mysqli_query($conn, $query);

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
    <h1>Security group creation</h1>
    <form action="security_group.php" method="post">
        Name: <input type="text" name="name" placeholder="name" required><br>
        Cloud type: <select name="cloudtype" required>
        <?php
            while ($cloudType = mysqli_fetch_array($cloudTypes, MYSQLI_ASSOC)):;
        ?>
            <option value="<?php echo $cloudType["type"];?>">
                <?php echo $cloudType["type"];?>
            </option>
        <?php
            endwhile;
        ?>
        </select><br>
        Security group type :
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