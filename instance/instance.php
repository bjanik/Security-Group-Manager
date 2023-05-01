<?php
    require_once('../utils/utils.php');
    session_start();

    $conn = connection();
    $query = "SELECT instance.cloud_instance_id, instance.name, instance.type, instance.private_ip, instance.public_ip, GROUP_CONCAT(sg.name SEPARATOR ', ') as security_groups FROM instance 
        JOIN instance_security_group_assoc assoc ON instance.id = assoc.`id_instance`
        JOIN security_group sg ON sg.id = assoc.`id_security_group`
        GROUP BY instance.name";
    $result = $conn->query($query);
    $instances = [];
    if ($result->num_rows > 0) {
        $instances = $result->fetch_all(MYSQLI_ASSOC);
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
    <title>Instances</title>
</head>
<body>
    <?php include("../header.php");?>
    <table id="tblInstance">
        <thead>
            <th>Instance id</th>
            <th>Name</th>
            <th>Security groups</th>
            <th>Type</th>
            <th>Private IP</th>
            <th>Actions</th>
        </thead>
        <tbody>
            <?php if(!empty($instances)) { ?>
                <?php foreach($instances as $instance) { ?>
                    <tr>
                        <td><?php echo $instance['cloud_instance_id']; ?></td>
                        <td><?php echo $instance['name']; ?></td>
                        <td><?php echo $instance['security_groups']; ?></td>
                        <td><?php echo $instance['type']; ?></td>
                        <td><?php echo $instance['private_ip']; ?></td>
                        <td><a href="./instance_attachment_form.php?instance_name=<?php echo $instance['name']; ?>"><button class="action-btn">Manage attachment</button></a> | <a href="delete_instance.php?instance_id=<?php echo $instance['instance_id']; ?>"><button class="action-btn">Delete</button></a></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
    <div>
        <a href="instance_form.php"><button>Create instance</button></a>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        jQuery(document).ready(function($) {
            $('#tblInstance').DataTable();
        })
    </script>
</body>
</html>