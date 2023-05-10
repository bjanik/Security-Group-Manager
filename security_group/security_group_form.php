<?php
    require_once('../utils/utils.php');
    session_start();
    checkSessionRights(['Administrator', 'Contributor']);

    $conn = connection();
    $query = "SELECT name from `cloud_provider`";
    $cloudProviders = $conn->query($query);
    $cloudProviders = $cloudProviders->fetch_all(MYSQLI_ASSOC);

    $query = "SELECT type from `security_group_type`";
    $sgTypes = $conn->query($query);
    $sgTypes = $sgTypes->fetch_all(MYSQLI_ASSOC);

    $query = "SELECT id, name from `security_group` WHERE type = 'Father'";
    $fathers = $conn->query($query);
    $fathers = $fathers->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/index.css">
    <title>Security group creation</title>
</head>
<body>
    <?php include("../header.php");?>
    <a href="security_group.php"><button>&#8592; Back</button></a>
    <div class="container">
        <?php if (isset($_GET["cloud_error"])) {
            echo "<p class='error'>Error on cloud side</p>";
        }
        ?>
        <form action="create_security_group.php" method="POST">
            <h1>Security group creation</h1>
            Name <input type="text" name="name" placeholder="Name" required maxlength="64"><br>
            Cloud provider <select name="cloud_provider" required>
                <?php foreach($cloudProviders as $cloudProvider) {
                    echo "<option value=$cloudProvider[name]>$cloudProvider[name]</option>";
                } ?>
            </select><br>
            Security group type
            <select id="sgType" name="type" type="text" required>
                <?php foreach($sgTypes as $sgType) {
                    echo "<option value=$sgType[type]>$sgType[type]</option>";
                }?>
            </select><br>
            <div class="sgList" id="fathersList">
                Select Father
                <select id="fatherSelection" name="father" type="text">
                    <?php foreach($fathers as $father) { 
                        echo "<option value=$father[id]>$father[name]</option>";
                    }?>
                </select>
            </div></br>
            <input type="submit" value="Create security group">
        </form>
    </div>
</body>
<script src="../script.js" type="text/javascript"></script>
</html>