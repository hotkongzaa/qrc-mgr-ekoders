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
        $sqlAVGunit = 0;
        $sqlGetUnitPrice = "select unit_price as unit_price"
                . " from qrc_project_order qpo"
                . " left join qrc_assign_order qao on qpo.assign_id = qao.ASSIGN_ID"
                . " where qao.TEAM_CODE like '$arrayTeamCodeSet[$i]';";
        $resultForAVG = mysql_query($sqlGetUnitPrice);
        while ($rowAVG = mysql_fetch_array($resultForAVG)) {
            $sqlAVGunit += $rowAVG['unit_price'];
        }
        $sqlGetCount = "select count(*) as total"
                . " from qrc_project_order qpo  "
                . " left join qrc_assign_order qao on qpo.assign_id = qao.ASSIGN_ID"
                . " where qao.TEAM_CODE like '$arrayTeamCodeSet[$i]';";
        $rowTotalRec = mysql_fetch_assoc(mysql_query($sqlGetCount));

        if ($isFirst) {
            $finalResult .= ($sqlAVGunit / $rowTotalRec['total']);
            $isFirst = false;
        } else {
            $finalResult .= "," . ($sqlAVGunit / $rowTotalRec['total']);
        }
    }
}

echo $finalResult;
