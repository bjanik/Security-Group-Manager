<?php
    require_once('../utils/utils.php');
    session_start();
    checkSessionRights();

    $disabled = set_disabled($_SESSION);
    $conn = connection();
    parse_str($_SERVER['QUERY_STRING'], $params);
    $query = "SELECT cloud_rule_id, sgr.name, source_port, dest_port_range, source_ip, protocol, sg2.name AS inherited_from
        FROM security_group_rule sgr
        JOIN security_group sg ON sg.id = sgr.id_security_group
        LEFT JOIN security_group sg2 ON sg2.id = sg.id_father";
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
    <?php include("../header.php");?>
    <a href='/security_group/security_group.php'><button>&#8592;</button></a>
    <?php
        if (isset($_GET["security_group_name"])) {
            echo "<h2> Rules for security group $_GET[security_group_name]</h2>";
        }
    ?>
    <table id="tblRule">
        <thead>
            <th>Rule name</th>
            <th>Rule id</th>
            <th>Rule inherited from</th>
            <th>Source port</th>
            <th>Destination port range</th>
            <th>Source IP</th>
            <th>Protocol</th>
            <th>Actions</th>
        </thead>
        <tbody>
            <?php if(!empty($rules)) {
                foreach($rules as $rule) {
                    echo "<tr>";
                        echo "<td>$rule[name]</td>";
                        echo "<td>$rule[cloud_rule_id]</td>";
                        echo "<td>$rule[inherited_from]</td>";
                        echo "<td>$rule[source_port]</td>";
                        echo "<td>$rule[dest_port_range]</td>";
                        echo "<td>$rule[source_ip]</td>";
                        echo "<td>$rule[protocol]</td>";
                        echo "<td><a href='delete_rule.php?cloud_rule_id=$rule[cloud_rule_id]'><button class='action-btn' $disabled>Delete</button></a></td>";
                    echo "</tr>";
                }
            } ?>
        </tbody>
    </table>
    <div>
        <a href="rule_form.php"><button <?php echo $disabled?>>Create rule</button></a>
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
