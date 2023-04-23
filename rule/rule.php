<?php
    session_start();
    require_once('../utils/utils.php');

    $conn = connection();
    parse_str($_SERVER['QUERY_STRING'], $params);

    $query = "SELECT `security_group_rule_id`, `name`, `source_port`, `port_range`, `source_ip`, `port_range`, `protocol`
        FROM `security_group_rule`";
    if (!empty($params['id_security_group'])) {
        $query .= " WHERE `id_security_group` = $params[id_security_group]";
    }
    $result = mysqli_query($conn, $query);
    $arr_rules = [];
    if ($result->num_rows > 0) {
        $arr_rules = $result->fetch_all(MYSQLI_ASSOC);
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
        if (isset($_GET["security_group_id"])) {
            echo "<h2> Rules for security group $_GET[security_group_id]</h2>";
        }
    ?>

    <table id="tblRule">
        <thead>
            <th>Rule name</th>
            <th>Rule id</th>
            <th>Source port</th>
            <th>Port range</th>
            <th>Source IP</th>
            <th>Protocol</th>
            <th>Actions</th>
        </thead>
        <tbody>
            <?php if(!empty($arr_rules)) { ?>
                <?php foreach($arr_rules as $rule) { ?>
                    <tr>
                        <td><?php echo $rule['name']; ?></td>
                        <td><?php echo $rule['security_group_rule_id']; ?></td>
                        <td><?php echo $rule['source_port']; ?></td>
                        <td><?php echo $rule['port_range']; ?></td>
                        <td><?php echo $rule['source_ip']; ?></td>
                        <td><?php echo $rule['protocol']; ?></td>
                        <td><a href="delete_rule.php?security_group_rule_id=<?php echo $rule['security_group_rule_id']; ?>">Delete</a></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
    <a href="rule_form.php"><button>Create rule</button></a>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        jQuery(document).ready(function($) {
            $('#tblRule').DataTable();
        })
    </script>
</body>
</html>
