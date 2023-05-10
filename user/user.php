
<?php
    require_once('../utils/utils.php');
    session_start();
    checkSessionRights(['Administrator']);

    $switchRights = array(
        "Reader" => "Contributor",
        "Contributor" => "Reader"
    );
    
    $conn = connection();
    $query = "SELECT email, rights from user WHERE rights != 'Administrator'";
    $users = $conn->query($query);
    $users = $users->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="../index.css">
    <title>Users</title>
</head>
<body>
    <?php include("../header.php");?>
    <a href="../index.php"><button>&#8592; Back</button></a>
    <h1>Users</h1>
    <table id="tblUser">
        <thead>
            <th>Email</th>
            <th>Rights</th>
            <th>Actions</th>
        </thead>
        <tbody>
            <?php if(!empty($users)) {
                foreach($users as $user) {
                    $rights = $user['rights'];
                    echo "<tr>";
                        echo "<td>$user[email]</td>";
                        echo "<td>$rights</td>";
                        echo "<td><a href='change_user_rights.php?email=$user[email]&rights=$switchRights[$rights]'><button class='action-btn'>Switch to $switchRights[$rights]</button></a></td>";
                    echo "</tr>";
                }
            } ?>
        </tbody>
    </table>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        jQuery(document).ready(function($) {
            $('#tblUser').DataTable();
        })
    </script>
</body>
</html>