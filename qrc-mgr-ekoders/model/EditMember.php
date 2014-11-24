<?php

require '../model-db-connection/config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$memId = $_GET['memId'];
$memName = $_GET['memName'];
$memRole = $_GET['memRole'];
$memberSkill = $_GET['memberSkill'];
$teamCode = $_GET['teamCode'];
$teamName = $_GET['teamName'];
$tel = $_GET['tel'];
$email = $_GET['email'];
$remark = $_GET['remark'];

$sqlUpdateProjectById = "UPDATE QRC_MEMBERS"
        . " SET memName='$memName',"
        . "memRole='$memRole',"
        . "memTCode='$teamCode',"
        . "memTName='$teamName',"
        . "memTel='$tel',"
        . "memSkill='$memberSkill',"
        . "memEmail='$email',"
        . "memRemark='$remark'"
        . " WHERE memID='$memId'";
$resultSet = mysql_query($sqlUpdateProjectById);

$sqlDeleteMemAttr = "DELETE FROM QRC_SKILL_ATTR"
        . " WHERE M_T_REF_ID like '$memId';";
$resultSet2 = mysql_query($sqlDeleteMemAttr);

$skills = explode(",", $memberSkill);

for ($i = 0; $i < count($skills); $i++) {
    $sqlAll = "INSERT INTO QRC_SKILL_ATTR (ATTR_ID,M_T_REF_ID,SKILL_ID)"
            . " VALUES "
            . "('" . md5(date('Y-m-d H:i:s')) . $i . "','$memId','$skills[$i]'); ";
    mysql_query($sqlAll);
}
if ($teamCode != "" || $teamCode != null) {
    $sqlInsertIntoTMapping = "INSERT INTO QRC_TEAM_MAPPING (ID,TEAM_ID,MEMBER_ID,MAPPING_DATE)"
            . " VALUES "
            . "('" . str_shuffle(md5(date('Y-m-d H:i:s'))) . "','$teamCode','$memId',NOW())";
    mysql_query($sqlInsertIntoTMapping);
} else {
    $sqlDeleteOutOfTeam = "DELETE FROM QRC_TEAM_MAPPING WHERE MEMBER_ID='$memId';";
    mysql_query($sqlDeleteOutOfTeam);
}

if ($resultSet) {
    echo '1';
} else {
    echo '0';
}