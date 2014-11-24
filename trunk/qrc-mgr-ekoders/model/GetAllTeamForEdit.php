<?php

require '../model-db-connection/config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$teamID = $_GET['teamID'];
$sqlSelectTeamAll = "SELECT qtb.tCode AS t_code,"
        . "qtb.tName AS t_Name,"
        . "qtb.tLead_memid AS t_lead_id,"
        . "qtb.tType AS t_type,"
        . "qtb.tManager_memid AS t_manager_id,"
        . "qmr.memName AS t_lead_name,"
        . "qtb.tSkill AS tSkill,"
        . "qtb.tRemark AS t_remark"
        . " FROM QRC_TEAM_BUILDER qtb"
        . " LEFT JOIN QRC_MEMBERS qmr ON qtb.tLead_memid = qmr.memID"
        . " WHERE qtb.tCode like '$teamID'";
$sqlGetAllData = mysql_query($sqlSelectTeamAll);
$row = mysql_fetch_array($sqlGetAllData);
echo json_encode($row);
