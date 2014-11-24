<?php

require '../model-db-connection/config.php';
$t_code = $_GET['t_code'];
$memID = $_GET['memID'];
$sqlDeleteProjectById = "DELETE FROM QRC_TEAM_BUILDER"
        . " WHERE tCode='$t_code';";
$sqlDeleteMemAttr = "DELETE FROM QRC_SKILL_ATTR"
        . " WHERE M_T_REF_ID like '$t_code';";
$result = mysql_query($sqlDeleteProjectById);
$result2 = mysql_query($sqlDeleteMemAttr);
$sqlDeleteOutOfTeam = "DELETE FROM QRC_TEAM_MAPPING WHERE TEAM_ID='$t_code';";
mysql_query($sqlDeleteOutOfTeam);
$sqlUpdateBackToMember = "UPDATE QRC_MEMBERS"
        . " SET memTCode = '',"
        . "memTName=''"
        . " WHERE memTCode LIKE '$t_code'";
mysql_query($sqlUpdateBackToMember);
if ($result) {
    echo '1';
} else {
    echo '2';
}

