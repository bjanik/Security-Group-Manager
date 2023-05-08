<?php
    require_once('../utils/utils.php');
    session_start();
    checkSessionRights();

    $disabled = set_disabled($_SESSION);
    $conn = connection();
    $query = "SELECT i.cloud_instance_id, i.name, i.type, i.private_ip, i.public_dns, GROUP_CONCAT(sg.name SEPARATOR ', ') as security_groups
        FROM instance i
        JOIN instance_security_group_assoc assoc ON i.id = assoc.`id_instance`
        JOIN security_group sg ON sg.id = assoc.`id_security_group`
        GROUP BY i.name";
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
    <a href="../index.php"><button>&#8592; Back</button></a></br>
    <h1>Instances</h1>
    <table id="tblInstance">
        <thead>
            <th>Instance id</th>
            <th>Name</th>
            <th>Security groups</th>
            <th>Type</th>
            <th>Public DNS</th>
            <th>Private IP</th>
            <th>Actions</th>
        </thead>
        <tbody>
            <?php if(!empty($instances)) {
                foreach($instances as $instance) {
                    echo "<tr>";
                        echo "<td>$instance[cloud_instance_id]</td>";
                        echo "<td>$instance[name]</td>";
                        echo "<td>$instance[security_groups]</td>";
                        echo "<td>$instance[type]</td>";
                        echo "<td>$instance[public_dns]</td>";
                        echo "<td>$instance[private_ip]</td>";
                        echo "<td><a href='delete_instance.php?cloud_instance_id=$instance[cloud_instance_id]'><button class='action-btn' $disabled>Delete</button></a></td>";
                    echo "</tr>";
                }
            } ?>
        </tbody>
    </table>
    <div>
        <?php echo "<a href='instance_form.php'><button $disabled>Create instance</button></a>"; ?> 
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