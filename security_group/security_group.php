<?php
    require_once('../utils/utils.php');
    session_start();

    $conn = connection();
    $query = "SELECT * from `security_group`";
    $result = mysqli_query($conn, $query);
    $arr_sg = [];
    if ($result->num_rows > 0) {
        $arr_sg = $result->fetch_all(MYSQLI_ASSOC);
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
    <table id="tblSg">
        <thead>
            <th>Security group id</th>
            <th>Name</th>
            <th>Type</th>
            <th>Cloud provider</th>
            <th>Actions</th>
        </thead>
        <tbody>
            <?php if(!empty($arr_sg)) { ?>
                <?php foreach($arr_sg as $sg) { ?>
                    <tr>
                        <td><?php echo $sg['security_group_id']; ?></td>
                        <td><?php echo $sg['name']; ?></td>
                        <td><?php echo $sg['type']; ?></td>
                        <td><?php echo $sg['cloud_provider']; ?></td>
                        <td><button><a href="../rule/rule.php?security_group_id=<?php echo $sg['security_group_id']; ?>">Show rules</a></button> | <a href="delete_security_group.php?security_group_id=<?php echo $sg['security_group_id']; ?>">Delete</a></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
    <button><a href="security_group_form.php">Create security group</a></button>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        jQuery(document).ready(function($) {
            $('#tblSg').DataTable();
        })
    </script>
</body>
</html>