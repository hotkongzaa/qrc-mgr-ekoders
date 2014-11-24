<?php

require '../model-db-connection/config.php';
$memId = $_GET['memId'];
$memName = $_GET['memName'];
$memRole = $_GET['memRole'];
$memberSkill = $_GET['memberSkill'];
$teamCode = $_GET['teamCode'];
$teamName = $_GET['teamName'];
$tel = $_GET['tel'];
$email = $_GET['email'];
$remark = $_GET['remark'];

$sqlInsertIntoMember = "INSERT INTO QRC_MEMBERS (memID,memName,memRole,memTCode,memTName,memTel,memSkill,memEmail,memRemark,created_date_time)"
        . " VALUES "
        . "('$memId','$memName','$memRole','$teamCode','$teamName','$tel','$memberSkill','$email','$remark',NOW());";
$resultSet = mysql_query($sqlInsertIntoMember);

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