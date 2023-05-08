<?php
    require_once('../utils/utils.php');
    session_start();
    checkSessionRights();

    $disabled = set_disabled($_SESSION);
    $conn = connection();
    $query = "SELECT sg.`cloud_security_group_id`, sg.`name`, sg.`type`, sg.`cloud_provider`, sg2.name AS father_name
        FROM `security_group` sg
        LEFT JOIN security_group sg2 ON sg2.id = sg.id_father;";
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
    <a href="/index.php"><button>&#8592; Back</button></a>
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
            <?php if(!empty($securityGroups)) {
                foreach($securityGroups as $securityGroup) {
                    echo "<tr>";
                        echo "<td>$securityGroup[cloud_security_group_id]</td>";
                        echo "<td>$securityGroup[name]</td>";
                        echo "<td>$securityGroup[father_name]</td>";
                        echo "<td>$securityGroup[type]</td>";
                        echo "<td>$securityGroup[cloud_provider]</td>";
                        echo "<td><a href='../rule/rule.php?security_group_name=$securityGroup[name]'><button class='action-btn'>Show rules</button></a> | <a href='delete_security_group.php?cloud_security_group_id=$securityGroup[cloud_security_group_id]'><button class='action-btn' $disabled>Delete</button></a></td>";
                    echo "</tr>";
                }
            } ?>
        </tbody>
    </table>
    <div>
        <?php echo "<a href='security_group_form.php'><button echo $disabled>Create security group</button></a>"; ?>
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