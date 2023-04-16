<?php
    session_start();
    require_once('../utils/utils.php');

    $conn = connection();
    parse_str($_SERVER['QUERY_STRING'], $params);

    $query = "SELECT * from `security_group_rule`";
    if (!empty($params['id_security_group'])) {
        // $query .= " WHERE `id_security_group` = '$params['id_security_group']'";
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
    <link rel="stylesheet" href="/index.css">
    <title>Security groups</title>
</head>
<body>
    <?php
        include("../header.php");
    ?>
    <table id="tblRule">
        <thead>
            <th>Name</th>
            <th>Source port</th>
            <th>Destination port</th>
            <th>Source IP</th>
            <th>Destination IP</th>
            <th>Protocol</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php if(!empty($arr_rules)) { ?>
                <?php foreach($arr_rules as $rule) { ?>
                    <tr>
                        <td><?php echo $sg['name']; ?></td>
                        <td><?php echo $sg['source_port']; ?></td>
                        <td><?php echo $sg['dest_port']; ?></td>
                        <td><?php echo $sg['source_ip']; ?></td>
                        <td><?php echo $sg['dest_ip']; ?></td>
                        <td><?php echo $sg['protocol']; ?></td>
                        <td><a href="delete.php?id=<?php echo $rule['id']; ?>">Delete</a></td>
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
