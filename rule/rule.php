<?php
    require_once('../utils/utils.php');
    session_start();
    checkSession();

    $conn = connection();
    parse_str($_SERVER['QUERY_STRING'], $params);
    $query = "SELECT `cloud_rule_id`, sgr.`name`, `source_port`, `dest_port_range`, `source_ip`, `protocol`
        FROM `security_group_rule` sgr JOIN `security_group` sg ON sg.id = sgr.id_security_group";
    if (!empty($params['security_group_name'])) {
        $query .= " AND sg.`name` = '$params[security_group_name]'";
    }
    $result = $conn->query($query);
    $rules = [];
    if ($result->num_rows > 0) {
        $rules = $result->fetch_all(MYSQLI_ASSOC);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" type="text/css" href="/index.css">
    <title>Security groups</title>
</head>
<body>
    <?php
        include("../header.php");
        if (isset($_GET["security_group_name"])) {
            echo "<h2> Rules for security group $_GET[security_group_name]</h2>";
        }
    ?>

    <table id="tblRule">
        <thead>
            <th>Rule name</th>
            <th>Rule id</th>
            <th>Source port</th>
            <th>Destination port range</th>
            <th>Source IP</th>
            <th>Protocol</th>
            <th>Actions</th>
        </thead>
        <tbody>
            <?php if(!empty($rules)) { ?>
                <?php foreach($rules as $rule) { ?>
                    <tr>
                        <td><?php echo $rule['name']; ?></td>
                        <td><?php echo $rule['cloud_rule_id']; ?></td>
                        <td><?php echo $rule['source_port']; ?></td>
                        <td><?php echo $rule['dest_port_range']; ?></td>
                        <td><?php echo $rule['source_ip']; ?></td>
                        <td><?php echo $rule['protocol']; ?></td>
                        <td><a href="delete_rule.php?cloud_rule_id=<?php echo $rule['cloud_rule_id']; ?>"><button class="action-btn">Delete</button></a></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
    <div>
        <a href="rule_form.php"><button>Create rule</button></a>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        jQuery(document).ready(function($) {
            $('#tblRule').DataTable();
        })
    </script>
</body>
</html>
