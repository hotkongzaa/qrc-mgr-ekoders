<?php

require '../model-db-connection/config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$teamCode = $_GET['teamCode'];
$teamName = $_GET['teamName'];
$teamLeadId = $_GET['teamLeadId'];
$tSkill = $_GET['tSkill'];
$tType = $_GET['tType'];
$tManagerID = $_GET['tManagerID'];
$tRemark = $_GET['tRemark'];

$sqlUpdateProjectById = "UPDATE QRC_TEAM_BUILDER"
        . " SET tName='$teamName',"
        . "tLead_memid='$teamLeadId',"
        . "tType='$tType',"
        . "tManager_memid='$tManagerID',"
        . "tSkill='$tSkill',"
        . "tRemark='$tRemark'"
        . " WHERE tCode='$teamCode';";
$resultSet = mysql_query($sqlUpdateProjectById);

$sqlDeleteMemAttr = "DELETE FROM QRC_SKILL_ATTR"
        . " WHERE M_T_REF_ID like '$teamCode';";
$resultSet2 = mysql_query($sqlDeleteMemAttr);

$skills = explode(",", $tSkill);

for ($i = 0; $i < count($skills); $i++) {
    $sqlAll = "INSERT INTO QRC_SKILL_ATTR (ATTR_ID,M_T_REF_ID,SKILL_ID)"
            . " VALUES "
            . "('" . md5(date('Y-m-d H:i:s')) . $i . "','$teamCode','$skills[$i]'); ";
    mysql_query($sqlAll);
}

$sqlUpdateMapping = "UPDATE QRC_TEAM_MAPPING"
        . " SET MEMBER_ID = '$teamLeadId'"
        . " WHERE TEAM_ID='$teamCode'";
mysql_query($sqlUpdateMapping);
if ($resultSet) {
    echo '1';
} else {
    echo '0';
}