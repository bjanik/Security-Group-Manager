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

  function checkSessionRights($rights = null) {
    if (
      empty($_SESSION['email']) ||
      ($rights && !in_array($_SESSION['rights'], $rights))
    ) {
      header("Location: http://localhost:8888");
    }
  }

  function create_security_group_on_cloud_provider($providerId, $sgName) {
    $returnCode = 0;
    $output = "";
    $groupId = exec("../aws/create-security-group.sh $sgName", $output, $returnCode);
    if ($returnCode !== 0) {
      return null;
    }
    return $groupId;
  }

  function delete_security_group_on_cloud_provider($securityGroupId) {
    $returnCode = 0;
    $output = "";
    exec("../aws/delete-security-group.sh '$securityGroupId'", $output, $returnCode);
    return $returnCode;
  }

  function create_security_group_ingress_rule($securityGroupName, $ruleName, $protocol, $portRange, $cidr) {
    if (strpos($portRange, "-")){
      list($fromPort, $toPort) = explode("-", $portRange);
    }
    else {
      $fromPort = $toPort = $portRange;
    }

    $returnCode = 0;
    $output = "";
    $securityGroupRuleId = exec("../aws/create-ingress-rule.sh '$securityGroupName' '$ruleName' '$protocol' '$fromPort' '$toPort' '$cidr'", $output, $returnCode);
    if ($returnCode != 0) {
      return null;
    }
    return $securityGroupRuleId;
  }

  function delete_security_group_rule_on_cloud_provider($securityGroupRuleId, $securityGroupId) {
    $returnCode = 0;
    $output = "";
    $securityGroupRuleId = exec("../aws/revoke-ingress-rule.sh '$securityGroupId' '$securityGroupRuleId'", $output, $returnCode);
    if ($returnCode != 0) {
      return null;
    }
    return 0;
  }

  function create_instance_on_cloud_provider($instanceName, $instanceType, $securityGroups) {
    $returnCode = 0;
    $output = "";
    $input = "../aws/create-instance.sh '$instanceName' '$instanceType' '$securityGroups'";
    exec("../aws/create-instance.sh '$instanceName' '$instanceType' '$securityGroups'", $output, $returnCode);
    if ($returnCode != 0) {
      return null;
    }
    $instanceData = json_decode(implode("", $output), TRUE);
    if ($instanceData) {
      $output = "";
      $instanceId = $instanceData["Instances"][0]["InstanceId"];
      exec("../aws/get-instance-public-dns.sh '$instanceId'", $output, $returnCode);
      if ($returnCode != 0) {
        return null;
      }
      $instanceData["publicDns"] = $output[0];
    }
    return $instanceData;
  }

  function delete_instance_on_cloud_provider($instanceId) {
    $returnCode = 0;
    exec("../aws/delete-instance.sh '$instanceId'", $output, $returnCode);
    if ($returnCode !== 0) {
      return null;
    }
    return 0;
  }

  function set_disabled($session) {
    $disabled = '';
    if ($session['rights'] === 'Reader') {
       $disabled = 'disabled';
    }
    return $disabled;
  }

  function run_query($conn, $query) {
    $result = $conn->query($query);
    if ($conn->error) {

    }
    else {
      return $result;
    }
  }

?>