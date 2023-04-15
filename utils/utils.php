<?php
function connection(){
  $conn = mysqli_connect("localhost", "root", "root")
    or die("Impossible de se connecter");
  
  //select current database
  mysqli_select_db($conn,"SGM")
    or die("Could not select SGM");
  return $conn;
}

function fermerConnection($res, $conn){
  mysqli_free_result($res); 
  mysqli_close($conn); 
}

?>