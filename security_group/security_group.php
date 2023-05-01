<?php
    require_once('../utils/utils.php');
    session_start();
    checkSession();

    $conn = connection();
    $query = "SELECT sg.`cloud_security_group_id`, sg.`name`, sg.`type`, sg.`cloud_provider`, sg2.name AS father_name FROM `security_group` sg LEFT JOIN security_group sg2 ON sg2.id = sg.id_father;";
    $result = $conn->query($query);
    $securityGroups = [];
    if ($result->num_rows > 0) {
        $securityGroups = $result->fetch_all(MYSQLI_ASSOC);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="/index.css">
    <title>Security groups</title>
</head>
<body>
    <?php include("../header.php");?>
    <h1>Security groups</h1>
    <table id="tblSg">
        <thead>
            <th>Security group id</th>
            <th>Name</th>
            <th>Inherits from</th>
            <th>Type</th>
            <th>Cloud provider</th>
            <th>Actions</th>
        </thead>
        <tbody>
            <?php if(!empty($securityGroups)) { ?>
                <?php foreach($securityGroups as $securityGroup) { ?>
                    <tr>
                        <td><?php echo $securityGroup['cloud_security_group_id']; ?></td>
                        <td><?php echo $securityGroup['name']; ?></td>
                        <td><?php echo $securityGroup['father_name']; ?></td>
                        <td><?php echo $securityGroup['type']; ?></td>
                        <td><?php echo $securityGroup['cloud_provider']; ?></td>
                        <td><a href="../rule/rule.php?security_group_name=<?php echo $securityGroup['name']; ?>"><button class="action-btn">Show rules</button></a> | <a href="delete_security_group.php?cloud_security_group_id=<?php echo $securityGroup['cloud_security_group_id']; ?>"><button class="action-btn">Delete</button></a></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
    <div>
        <a href="security_group_form.php"><button>Create security group</button></a>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        jQuery(document).ready(function($) {
            $('#tblSg').DataTable();
        })
    </script>
</body>
</html>