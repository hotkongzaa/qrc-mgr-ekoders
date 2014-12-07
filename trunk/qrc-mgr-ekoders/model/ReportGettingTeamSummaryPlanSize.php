<?php

require '../model-db-connection/config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$teamCodeSet = $_GET['teamCodeSet'];
$finalResult = "";
$isFirst = true;
$arrayTeamCodeSet = explode(",", $teamCodeSet);
for ($i = 0; $i < count($arrayTeamCodeSet); $i++) {
    if ($arrayTeamCodeSet[$i] == "on") {
        
    } else {
        $summaryPlanSize = 0;
        $sqlGetPlanSizeByWOID = "select plan_size"
                . " from qrc_project_order qpo"
                . " left join qrc_assign_order qao on qpo.assign_id = qao.ASSIGN_ID"
                . " where qao.TEAM_CODE like '$arrayTeamCodeSet[$i]';";
        $resultSetForPlansize = mysql_query($sqlGetPlanSizeByWOID);
        while ($rowPlanSize = mysql_fetch_array($resultSetForPlansize)) {
            $summaryPlanSize += $rowPlanSize['plan_size'];
        }

        if ($isFirst) {
            $finalResult .= $summaryPlanSize;
            $isFirst = false;
        } else {
            $finalResult .= "," . $summaryPlanSize;
        }
    }
}

echo $finalResult;
