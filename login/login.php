<?php
session_start();

echo "You just logged in M. " . $_POST['login'];

// function connection(){
//   $Macon = mysqli_connect("localhost", "root", "root")
//     or die("Impossible de se connecter");
  
//   //selectionner la base courrante
//   mysqli_select_db($Macon,"SGM")
//     or die("Could not select SGM");
//   return $Macon;
// }

// function fermerConnection($res, $Macon){
//   mysqli_free_result($res); 
//   mysqli_close($Macon); 
// }
if (!empty($_POST['login'])){
    echo "Login not empty";
}

if (empty($_POST['password'])){
    echo "Password empty";
}

echo "READY";
if (!empty($_POST['login']) && !empty($_POST['password'])){
    echo "READY";
    // $login = $_POST['login'];
    // $password = $_POST['password'];
    // $conn = connection();
    // $query = "SELECT id from User WHERE `email` = '$login' AND `password` = '$password'";
    // $result = mysqli_query($conn, $query);
    header("Location: http://localhost:8888/main/main.php");
}
// else {
//     echo "<h1> Incorrect credentials </h1>";
// }
?>