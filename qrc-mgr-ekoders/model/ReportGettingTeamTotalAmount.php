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
        $totalAVGAmount = 0;
        $sqlGetTotalAmount = "select qpo.amount as amount
                                                from qrc_project_order qpo
                                                left join qrc_assign_order qao on qpo.assign_id = qao.ASSIGN_ID
                                                where qao.TEAM_CODE like '$arrayTeamCodeSet[$i]';";
        $resultForAVGAmount = mysql_query($sqlGetTotalAmount);
        while ($rowAVGAmount = mysql_fetch_array($resultForAVGAmount)) {
            $totalAVGAmount += $rowAVGAmount['amount'];
        }

        if ($isFirst) {
            $finalResult .= $totalAVGAmount;
            $isFirst = false;
        } else {
            $finalResult .= "," . $totalAVGAmount;
        }
    }
}

echo $finalResult;
