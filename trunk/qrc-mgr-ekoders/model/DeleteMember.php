<?php

require '../model-db-connection/config.php';
$mem_id = $_GET['mem_id'];
$sqlDeleteProjectById = "DELETE FROM QRC_MEMBERS"
        . " WHERE memID='$mem_id';";
$sqlDeleteMemAttr = "DELETE FROM QRC_SKILL_ATTR"
        . " WHERE M_T_REF_ID like '$mem_id';";
$result = mysql_query($sqlDeleteProjectById);
$result2 = mysql_query($sqlDeleteMemAttr);
$sqlDeleteOutOfTeam = "DELETE FROM QRC_TEAM_MAPPING WHERE MEMBER_ID='$mem_id';";
mysql_query($sqlDeleteOutOfTeam);
if ($result) {
    echo '1';
} else {
    echo '2';
}

