<?php
    require('../utils/utils.php');
    session_start();
    checkSession();

    $conn = connection();
    $query = "SELECT name, security_group_id from security_group";
    $secGroups = mysqli_query($conn, $query);

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
<div>
    <h1>Instance creation</h1>
    <form action="instance_creation.php" method="POST">
        Instance name<input type="text" name="name" placeholder="Instance name" required>
        Instance type<input type="text" name="type" placeholder="Instance type" value="t2.nano" required>
        <div class="multiselect">
            <div class="selectBox" onclick="showCheckboxes()">
                <select>
                    <option>Select security groups</option>
                </select>
                <div class="overSelect"></div>
            </div>
            <div id="checkboxes">
                <?php
                    while ($securityGroups = mysqli_fetch_array($secGroups, MYSQLI_ASSOC)):;
                ?>
                    <label for="<?php echo $securityGroups["name"]?>">
                    <input type="checkbox" id="<?php echo $securityGroups["name"]?>" name="security_groups[]" value="<?php echo $securityGroups["security_group_id"]?>" /><?php echo $securityGroups["name"]?></label>
                <?php endwhile; ?>
            </div>
        </div>
        <input type="submit" value="Create instance">
    </form>
</div>
</body>
</html>