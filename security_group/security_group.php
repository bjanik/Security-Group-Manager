<?php
    session_start();
    require_once('../utils/utils.php');

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
    <?php include("/header.php");?>
    <table id="tblSg">
        <thead>
            <th>Name</th>
            <th>Type</th>
            <th>Cloud name</th>
            <th>Actions</th>
        </thead>
        <tbody>
            <?php if(!empty($arr_sg)) { ?>
                <?php foreach($arr_sg as $sg) { ?>
                    <tr>
                        <td><?php echo $sg['name']; ?></td>
                        <td><?php echo $sg['type']; ?></td>
                        <td><?php echo $sg['cloud_name']; ?></td>
                        <td><a href="../rule/rule.php?id_security_group=<?php echo $sg['id']; ?>">Show rules</a> | <a href="delete.php?id=<?php echo $sg['id']; ?>">Delete</a></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
    <a href="security_group_form.php"><button>Create security group</button></a>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        jQuery(document).ready(function($) {
            $('#tblSg').DataTable();
        })
    </script>
</body>
</html>