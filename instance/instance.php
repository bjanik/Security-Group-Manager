<?php
    require_once('../utils/utils.php');
    session_start();

    $conn = connection();
    $query = "SELECT * FROM `instance`";
    $result = mysqli_query($conn, $query);
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
            <th>Type</th>
            <th>Public IP</th>
            <th>Private IP</th>
            <th>Actions</th>
        </thead>
        <tbody>
            <?php if(!empty($instances)) { ?>
                <?php foreach($instances as $instance) { ?>
                    <tr>
                        <td><?php echo $instance['instance_id']; ?></td>
                        <td><?php echo $instance['name']; ?></td>
                        <td><?php echo $instance['type']; ?></td>
                        <td><?php echo $instance['public_ip']; ?></td>
                        <td><?php echo $instance['private_ip']; ?></td>
                        <td><a href="delete_instance.php?instance_id=<?php echo $sg['instance_id']; ?>">Delete</a></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
    <button><a href="instance_form.php">Create instance</a></button>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        jQuery(document).ready(function($) {
            $('#tblInstance').DataTable();
        })
    </script>
</body>
</html>