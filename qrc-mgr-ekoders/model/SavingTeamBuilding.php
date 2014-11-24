<?php

require '../model-db-connection/config.php';

$teamCode = $_GET['teamCode'];
$teamName = $_GET['teamName'];
$teamLeadId = $_GET['teamLeadId'];
$tSkill = $_GET['tSkill'];
$tType = $_GET['tType'];
$tManagerID = $_GET['tManagerID'];
$tRemark = $_GET['tRemark'];

$sqlInsertIntoTeamBuilder = "INSERT INTO QRC_TEAM_BUILDER (tCode,tName,tLead_memid,tType,tManager_memid,tSkill,tRemark,created_date_time)"
        . " VALUES "
        . "('$teamCode','$teamName','$teamLeadId','$tType','$tManagerID','$tSkill','$tRemark',NOW());";
$resultSet = mysql_query($sqlInsertIntoTeamBuilder);

$sqlInsertIntoTMapping = "INSERT INTO QRC_TEAM_MAPPING (ID,TEAM_ID,MEMBER_ID,MAPPING_DATE)"
        . " VALUES "
        . "('" . str_shuffle(md5(date('Y-m-d H:i:s'))) . "','$teamCode','$teamLeadId',NOW())";
mysql_query($sqlInsertIntoTMapping);

$sqlUpdateMember = "UPDATE QRC_MEMBERS"
        . " SET memTCode ='$teamCode', memTName='$teamName'"
        . " WHERE memID LIKE '$teamLeadId'";
mysql_query($sqlUpdateMember);
$skills = explode(",", $tSkill);

for ($i = 0; $i < count($skills); $i++) {
    $sqlAll = "INSERT INTO QRC_SKILL_ATTR (ATTR_ID,M_T_REF_ID,SKILL_ID)"
            . " VALUES "
            . "('" . md5(date('Y-m-d H:i:s')) . $i . "','$teamCode','$skills[$i]'); ";
    mysql_query($sqlAll);
}

if ($resultSet) {
    echo '1';
} else {
    echo '0';
}