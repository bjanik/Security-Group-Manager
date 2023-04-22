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

function create_security_group_on_cloud_provider($providerId, $sgName) {
  $returnCode = 0;
  $output = "";
  $groupId = exec("/Users/bart/.aws/create-sg $sgName", $output, $returnCode);
  if ($returnCode != 0) {
    return null;
  }
  return $groupId;
}

function delete_security_group_on_cloud_provider($securityGroupId) {
  $returnCode = 0;
  $output = "";
  exec("/Users/bart/.aws/delete-sg $securityGroupId", $output, $returnCode);
  return $returnCode;
}

function create_security_group_ingress_rule($securityGroupName, $protocol, $portRange, $cidr) {
  if (strpos($portRange, "-")){
    list($fromPort, $toPort) = explode("-", $portRange);
  }
  else {
    $fromPort = $toPort = $portRange;
  }
  echo $securityGroupName;
  echo $fromPort;
  echo $toPort;
  echo $protocol;
  echo $cidr;

  $returnCode = 0;
  $output = "";
  $securityGroupRuleId = exec("/Users/bart/.aws/create-ingress-rule.sh '$securityGroupName' '$protocol' '$fromPort' '$toPort' '$cidr'", $output, $returnCode);
  if ($returnCode != 0) {
    return null;
  }
  return $securityGroupRuleId;
}

function delete_security_group_rule_on_cloud_provider($securityGroupRuleId) {

  $returnCode = 0;
  $output = "";
  $securityGroupRuleId = exec("/Users/bart/.aws/revoke-ingress-rule.sh '$securityGroupRuleId'", $output, $returnCode);
  if ($returnCode != 0) {
    return null;
  }
  return $securityGroupRuleId;
}

?>