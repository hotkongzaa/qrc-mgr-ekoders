<?php

require '../model-db-connection/config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$mem_id = $_GET['mem_id'];
$sqlSelectMemberAll = "SELECT qm.memID AS mem_id,"
        . "qm.memName AS mem_name,"
        . "qm.memRole AS mem_role,"
        . "qm.memTel AS mem_tel,"
        . "qm.memEmail AS mem_email,"
        . "qm.memSkill AS mem_skill,"
        . "qm.memTCode AS mem_t_code,"
        . "qm.memTName AS mem_t_name,"
        . "qm.memRemark AS mem_remark"
        . " FROM QRC_MEMBERS qm"
        . " LEFT JOIN QRC_TEAM_BUILDER qtb ON qm.memTCode =qtb.tCode"
        . " LEFT JOIN QRC_MEMBER_ROLE qmr ON qm.memRole = qmr.role_id"
        . " WHERE qm.memID like '$mem_id'";
$sqlGetAllData = mysql_query($sqlSelectMemberAll);
$row = mysql_fetch_array($sqlGetAllData);
echo json_encode($row);
