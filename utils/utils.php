<?php
function connection(){
  $conn = mysqli_connect("localhost", "root", "root")
    or die("Impossible to connect");
  
  //select current database
  mysqli_select_db($conn,"SGM")
    or die("Could not select SGM");
  return $conn;
}

function closeConnection($res, $conn){
  mysqli_free_result($res); 
  mysqli_close($conn); 
}

function checkSession() {
  if (empty($_SESSION['login'])) {
    header("Location: http://localhost:8888");
  }
}

?>